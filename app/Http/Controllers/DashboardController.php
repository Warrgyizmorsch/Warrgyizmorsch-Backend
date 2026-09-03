<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Leads;
use App\Models\User;
use App\Models\CallBack;
use App\Models\Category;
use App\Models\LeadSource;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        @session_write_close();

        $currentUser = Auth::user();

        if ($currentUser->role_id == 2) {
            return view('crm.users.dashboard');
        }

        $leadQuery = Leads::query()->where(function($q) {
            $q->where('is_archived', 0)->orWhereNull('is_archived');
        });
        $totalLeads = (clone $leadQuery)->count();

        if ($currentUser->role_id != 1) {
            $leadQuery->where('lead_owner', $currentUser->id);
            $totalLeads = (clone $leadQuery)->count();
        }

        // Handle date filtering
        $startInput = $request->input('start');
        $endInput = $request->input('end');
        $filterStart = null;
        $filterEnd = null;

        if ($startInput || $endInput) {
            if ($startInput && $endInput) {
                $filterStart = Carbon::parse($startInput)->startOfDay();
                $filterEnd = Carbon::parse($endInput)->endOfDay();
            } elseif ($startInput) {
                $filterStart = Carbon::parse($startInput)->startOfDay();
                $filterEnd = $filterStart->copy()->endOfDay();
            } elseif ($endInput) {
                $filterStart = Carbon::parse($endInput)->startOfDay();
                $filterEnd = $filterStart->copy()->endOfDay();
            }

            $leadQuery->whereBetween('created_at', [$filterStart, $filterEnd]);
            $totalLeads = (clone $leadQuery)->count();
        }

        // 1. Buckets & Dynamic Status Overview
        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->with([
                'children' => function ($q) {
                    $q->where('is_deleted', 0);
                }
            ])
            ->get();

        foreach ($buckets as $bucket) {
            $childIds = $bucket->children->pluck('id')->toArray();
            $allBucketIds = array_merge([$bucket->id], $childIds);

            $bucket->total_leads = (clone $leadQuery)
                ->whereIn('lead_bucket_id', $allBucketIds)
                ->count();
        }

        // Build dynamic status summary across all buckets/statuses
        $allStatusCounts = (clone $leadQuery)
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as norm_status, lead_status, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_id')
            ->get();

        $overviewStatuses = [];
        $seenStatusKeys = [];

        foreach ($buckets as $b) {
            if ($b->children && $b->children->isNotEmpty()) {
                foreach ($b->children as $child) {
                    $childNameNorm = strtolower(trim($child->name));
                    $statusKey = $b->id . '_' . $childNameNorm;
                    if (isset($seenStatusKeys[$statusKey])) continue;
                    $seenStatusKeys[$statusKey] = true;

                    $matchingCount = $allStatusCounts->filter(function($item) use ($childNameNorm, $child, $b) {
                        return $item->norm_status === $childNameNorm || $item->lead_bucket_id == $child->id;
                    })->sum('cnt');

                    if ($matchingCount > 0 || in_array($child->name, ['Yet to Call', 'Qualifying', 'Proposal Sent', 'Negotiation', 'Awaiting Confirmation', 'No Response', 'Closed', 'In Progress', 'Not Qualified'])) {
                        $overviewStatuses[] = [
                            'id' => $child->id,
                            'name' => $child->name,
                            'bucket_id' => $b->id,
                            'bucket_name' => $b->name,
                            'count' => $matchingCount,
                        ];
                    }
                }
            } else {
                $bNameNorm = strtolower(trim($b->name));
                $matchingCount = $allStatusCounts->filter(function($item) use ($bNameNorm, $b) {
                    return $item->norm_status === $bNameNorm || $item->lead_bucket_id == $b->id;
                })->sum('cnt');

                $overviewStatuses[] = [
                    'id' => $b->id,
                    'name' => $b->name,
                    'bucket_id' => $b->id,
                    'bucket_name' => $b->name,
                    'count' => $matchingCount,
                ];
            }
        }

        // Check for other / unassigned
        $unassignedCount = (clone $leadQuery)
            ->where(function($q) {
                $q->whereNull('lead_bucket_id')
                  ->orWhere('lead_bucket_id', 0)
                  ->orWhereNull('lead_status')
                  ->orWhere('lead_status', '');
            })->count();

        if ($unassignedCount > 0) {
            $overviewStatuses[] = [
                'id' => 'other',
                'name' => 'Other / Unassigned',
                'bucket_id' => 'other',
                'bucket_name' => 'Unassigned',
                'count' => $unassignedCount,
            ];
        }

        $firstBucket = $buckets->first();
        $statusCounts = [];

        // 2. Engagement Status Counts
        $engagementCounts = [
            'hot' => (clone $leadQuery)->where('lead_engagement_status', 'hot')->count(),
            'warm' => (clone $leadQuery)->where('lead_engagement_status', 'warm')->count(),
            'cold' => (clone $leadQuery)->where('lead_engagement_status', 'cold')->count(),
            'dead' => (clone $leadQuery)->where('lead_engagement_status', 'dead')->count(),
        ];
        $totalEngagement = array_sum($engagementCounts);
        $engagementPercentages = [];
        foreach ($engagementCounts as $status => $count) {
            $engagementPercentages[$status] = $totalEngagement > 0 ? round(($count / $totalEngagement) * 100) : 0;
        }

        // 3. Sales Performance
        $salesUsers = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->get();
        $salesUserPerformance = [];
        foreach ($salesUsers as $sUser) {
            $uQuery = Leads::where('lead_owner', $sUser->id);
            if ($filterStart && $filterEnd) {
                $uQuery->whereBetween('created_at', [$filterStart, $filterEnd]);
            }
            $salesUserPerformance[] = [
                'user' => $sUser,
                'total_leads' => (clone $uQuery)->count(),
                'converted' => (clone $uQuery)->where('is_converted', 1)->count(),
            ];
        }

        // 4. Monthly Leads Chart
        $now = Carbon::now();
        $chartStart = $now->copy()->startOfYear();
        $chartEnd = $now->copy()->endOfYear();

        if ($filterStart && $filterEnd) {
            $chartStart = $filterStart->copy()->startOfMonth();
            $chartEnd = $filterEnd->copy()->endOfMonth();
        }

        $chartCategories = [];
        $current = $chartStart->copy();
        while ($current->lte($chartEnd)) {
            $chartCategories[] = $current->format('M y');
            $current->addMonthNoOverflow();
        }

        $monthlyChartData = [];
        $usersForChart = ($currentUser->role_id == 1)
            ? User::whereIn('role_id', [1, 3])->orderBy('name')->get(['id', 'name'])
            : User::where('id', $currentUser->id)->get(['id', 'name']);

        foreach ($usersForChart as $u) {
            $query = Leads::where('lead_owner', $u->id)
                ->whereBetween('created_at', [$chartStart, $chartEnd])
                ->selectRaw("DATE_FORMAT(created_at, '%b %y') as month, COUNT(*) as total")
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $userData = collect($chartCategories)->map(fn($m) => (int) ($query[$m] ?? 0))->toArray();
            $monthlyChartData[] = [
                'user_id' => $u->id,
                'user_name' => $u->name,
                'series' => $userData,
                'total' => array_sum($userData),
            ];
        }

        // 5. Source Chart Data
        $fixedSources = ['website', 'referral', 'social media', 'facebook', 'instagram', 'whatsapp', 'advertisement', 'other', 'landing page', 'manual import'];
        $sourceChartData = [];
        foreach ($fixedSources as $source) {
            $normalizedSource = strtolower(trim($source));
            $query = Leads::whereRaw("LOWER(TRIM(platform)) = ?", [$normalizedSource])
                ->whereBetween('created_at', [$chartStart, $chartEnd])
                ->selectRaw("DATE_FORMAT(created_at, '%b %y') as month, COUNT(*) as total")
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $series = collect($chartCategories)->map(fn($m) => (int) ($query[$m] ?? 0))->toArray();
            $sourceChartData[] = [
                'source_name' => ucfirst($source),
                'series' => $series,
                'total' => array_sum($series),
            ];
        }

        // 6. Modern Lead Pipeline Board Data
        $mainStatuses = [
            'yet to call',
            'new lead',
            'call done',
            'lead qualification',
            'connected / in conversation',
            'hot lead',
            'warm lead',
            'cold lead',
            'application / deal in progress',
            'won / enrolled',
            'lost / closed'
        ];

        $pipelineBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->with('children')
            ->orderByRaw("FIELD(LOWER(TRIM(name)), '" . implode("','", $mainStatuses) . "') = 0, FIELD(LOWER(TRIM(name)), '" . implode("','", $mainStatuses) . "'), id ASC")
            ->get();

        $statusCountsQuery = Leads::query();
        if ($currentUser->role_id != 1) {
            $statusCountsQuery->where('lead_owner', $currentUser->id);
        }
        if ($filterStart && $filterEnd) {
            $statusCountsQuery->whereBetween('created_at', [$filterStart, $filterEnd]);
        }

        $statusCountsDb = $statusCountsQuery
            ->reorder()
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_id')
            ->get();

        $columnCards = [];
        $perPage = 15;

        foreach ($pipelineBuckets as $b) {
            $bName = strtolower(trim($b->name));
            $bId = $b->id;
            $childIds = $b->children ? $b->children->pluck('id')->toArray() : [];
            $childNames = $b->children ? $b->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray() : [];

            $colTotal = $statusCountsDb->filter(function ($item) use ($bName, $bId, $childNames, $childIds) {
                $itemStatus = strtolower(trim($item->status_name));
                if ($itemStatus === $bName || $item->lead_bucket_id == $bId) return true;
                if (in_array($itemStatus, $childNames) || in_array($item->lead_bucket_id, $childIds)) return true;
                if ($bName === 'yet to call' && ($itemStatus === '' || is_null($itemStatus))) return true;
                return false;
            })->sum('cnt');

            $cardQuery = Leads::with([
                'user:id,name,email,contact_no,city,state,address',
                'owner:id,name',
                'bucket:id,name,bucket_color',
                'category:id,category_name',
                'tags:id,name,color',
                'latestMessage.user:id,name'
            ]);

            if ($currentUser->role_id != 1) {
                $cardQuery->where('lead_owner', $currentUser->id);
            }
            if ($filterStart && $filterEnd) {
                $cardQuery->whereBetween('created_at', [$filterStart, $filterEnd]);
            }

            $cardQuery->where(function ($q) use ($bName, $bId, $childNames, $childIds) {
                $q->where('lead_bucket_id', $bId)
                  ->orWhere('lead_status', $bName);
                if (!empty($childIds)) {
                    $q->orWhereIn('lead_bucket_id', $childIds);
                }
                if (!empty($childNames)) {
                    $q->orWhereIn('lead_status', $childNames);
                }
                if ($bName === 'yet to call') {
                    $q->orWhereNull('lead_status')->orWhere('lead_status', '');
                }
            });

            $paginator = $cardQuery->orderBy('id', 'desc')->paginate($perPage, ['*'], 'col_' . $bId, 1);

            $columnCards[$bId] = [
                'bucket' => $b,
                'total' => $colTotal,
                'leads' => $paginator->items(),
                'has_more' => $paginator->hasMorePages(),
                'next_page' => $paginator->hasMorePages() ? 2 : null,
            ];
        }

        $parentBuckets = Bucket::whereNull('parent_id')->where('name', '!=', 'Lost')->where('is_deleted', 0)->get();
        $totalParentBuckets = $parentBuckets->count();
        $progressPerBucket = $totalParentBuckets > 0 ? 100 / $totalParentBuckets : 0;
        $bucketPositionMap = [];
        foreach ($parentBuckets as $index => $bucket) {
            $bucketPositionMap[$bucket->id] = $index + 1;
        }

        $rQuery = Leads::with(['bucket', 'user', 'owner'])->orderBy('id', 'desc');
        if ($currentUser->role_id != 1) {
            $rQuery->where('lead_owner', $currentUser->id);
        }
        if ($filterStart && $filterEnd) {
            $rQuery->whereBetween('created_at', [$filterStart, $filterEnd]);
        }

        $recentLeads = (clone $rQuery)->take(5)->get();

        $recentLeadsProgress = $recentLeads->map(function ($lead) use ($bucketPositionMap, $progressPerBucket, $totalParentBuckets) {
            if (!$lead->bucket) return null;
            $parentBucketId = $lead->bucket->parent_id ? $lead->bucket->parent_id : $lead->bucket->id;
            $position = $bucketPositionMap[$parentBucketId] ?? 0;
            $progress = round($position * $progressPerBucket);
            return [
                'user' => $lead->user,
                'lead_name' => $lead->id,
                'bucket_name' => $lead->bucket->name,
                'stage_position' => $position,
                'total_stages' => $totalParentBuckets,
                'progress' => $progress
            ];
        })->filter();

        $categorys = Category::where('is_active', 1)->get();
        $categories = $categorys;
        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->get();
        $sources = LeadSource::pluck('source_name')->toArray();
        $allTags = Tag::where('is_active', true)->orderBy('name')->get();
        $childBuckets = $buckets;

        return view('dashboard', compact(
            'buckets',
            'pipelineBuckets',
            'columnCards',
            'overviewStatuses',
            'firstBucket',
            'statusCounts',
            'totalLeads',
            'engagementCounts',
            'engagementPercentages',
            'totalEngagement',
            'salesUserPerformance',
            'recentLeads',
            'recentLeadsProgress',
            'monthlyChartData',
            'chartCategories',
            'sourceChartData',
            'categorys',
            'categories',
            'owners',
            'sources',
            'allTags',
            'childBuckets'
        ));
    }
}
