<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\User;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatedDealController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        @session_write_close();

        // 1. Eager Load Essential Relations
        $query = Leads::with([
            'user:id,name,email,contact_no,city,state,pincode,address',
            'owner:id,name,email',
            'bucket:id,name,bucket_color,parent_id',
            'category',
            'latestMessage.user:id,name',
            'tags:id,name,color',
        ]);

        // 2. Role-based restrictions (Role 3 sees only assigned leads)
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // Show every non-archived converted lead throughout the complete deal lifecycle.
        $query->where('is_converted', 1)->where(function($q) {
            $q->where('is_archived', 0)->orWhereNull('is_archived');
        });

        // 4. Search Filter
        $searchUserIds = [];
        if ($request->filled('search_uid')) {
            $query->where('uid', $request->search_uid);
        } elseif ($request->filled('search')) {
            $search = trim($request->search);
            $digitsOnly = preg_replace('/\D+/', '', $search);
            $last10 = (strlen($digitsOnly) >= 10) ? substr($digitsOnly, -10) : $digitsOnly;

            $searchUserIds = User::where(function ($uQ) use ($search, $digitsOnly, $last10) {
                $uQ->where('name', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%")
                   ->orWhere('contact_no', 'like', "%{$search}%");

                if ($digitsOnly !== '') {
                    $uQ->orWhere('contact_no', 'like', "%{$digitsOnly}%")
                       ->orWhere('contact_no', 'like', "%{$last10}%")
                       ->orWhereRaw("REPLACE(REPLACE(REPLACE(contact_no, ' ', ''), '+', ''), '-', '') LIKE ?", ['%' . $digitsOnly . '%'])
                       ->orWhereRaw("REPLACE(REPLACE(REPLACE(contact_no, ' ', ''), '+', ''), '-', '') LIKE ?", ['%' . $last10 . '%']);
                }
            })
            ->pluck('id')
            ->toArray();

            $query->where(function ($q) use ($searchUserIds, $search) {
                if (!empty($searchUserIds)) {
                    $q->whereIn('uid', $searchUserIds);
                } else {
                    $q->where('business_name', 'like', "%{$search}%");
                }
            });
        }

        // Date Filter
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $from = Carbon::parse($request->from)->toDateString();
            $query->whereDate('date', $from);
        }

        // Engagement Status Filter
        if ($request->filled('lead_engagement_status')) {
            $query->where('lead_engagement_status', $request->lead_engagement_status);
        }

        // Owner Filter
        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        if ($request->filled('source')) {
            $query->where('platform', 'like', '%' . $request->source . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('company')) {
            $query->where('business_name', 'like', '%' . $request->company . '%');
        }
        if ($request->filled('campaign_name')) {
            $query->where('campaign_name', 'like', '%' . $request->campaign_name . '%');
        }
        if ($request->filled('adset_name')) {
            $query->where('adset_name', 'like', '%' . $request->adset_name . '%');
        }
        if ($request->filled('ad_name')) {
            $query->where('ad_name', 'like', '%' . $request->ad_name . '%');
        }
        $dealStatusFilter = $request->input('lead_status', $request->input('status'));
        if (!empty($dealStatusFilter)) {
            $query->where('lead_status', $dealStatusFilter);
        }

        // 5. Sorting & Pagination
        $perPage = (int) $request->get('per_page', 20);
        $perPage = in_array($perPage, [20, 50, 100, 250, 500]) ? $perPage : 20;

        $leads = $query->orderBy('updated_at', 'desc')->paginate($perPage)->appends($request->query());
        $totalDealsCount = $leads->total();

        // Fetch parent/child buckets for offcanvas status change
        $childBuckets = Bucket::with('children')
            ->whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('type', 'order')
            ->get();

        // Pre-aggregate deal counts in 1 fast query instead of N queries in loop
        $dealCounts = Leads::where('is_converted', 1)
            ->when(auth()->user()->role_id == 3, fn($q) => $q->where('lead_owner', auth()->id()))
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_id')
            ->get();

        $childBuckets->each(function ($bucket) use ($dealCounts) {
            $bucketIds = collect([$bucket->id])->merge($bucket->children->pluck('id'))->all();
            $statusNames = collect([$bucket->name])->merge($bucket->children->pluck('name'))->map(fn($n) => strtolower(trim($n)))->all();
            $bName = strtolower(trim($bucket->name));

            $bucket->leads_count = $dealCounts->filter(function ($item) use ($bucketIds, $statusNames, $bName) {
                if (in_array($item->lead_bucket_id, $bucketIds) || in_array($item->status_name, $statusNames)) {
                    return true;
                }
                if ($bName === 'deal created' && (empty($item->lead_bucket_id) || empty($item->status_name))) {
                    return true;
                }
                return false;
            })->sum('cnt');
        });

        $owners = User::whereIn('role_id', [1, 3])
            ->where('is_deleted', 0)
            ->select('id', 'name', 'email')
            ->get();

        $categorys = Category::where('is_active', 1)->orderBy('category_name')->get();
        $sources = LeadSource::where('is_active', 1)->pluck('source_name')->toArray();
        $totalLeadsCount = $totalDealsCount;
        $filteredLeadCount = $leads->total();
        $systemTotalLeadsCount = Leads::where('is_converted', 1)
            ->when(auth()->user()->role_id == 3, fn($q) => $q->where('lead_owner', auth()->id()))
            ->count();
        $childtotalLeadsCount = $childBuckets->sum('leads_count');
        $deletedLeadsCount = 0;
        $followupsCount = 0;
        $otherLeadsCount = 0;
        $allBucketsWithChildren = $childBuckets->keyBy('id');
        $isDealView = true;
        $allTags = \App\Models\Tag::where('is_active', true)->orderBy('name')->get();

        return view('crm.lead.tableindex', compact(
            'leads',
            'childBuckets',
            'owners',
            'totalDealsCount',
            'categorys',
            'sources',
            'totalLeadsCount',
            'filteredLeadCount',
            'systemTotalLeadsCount',
            'childtotalLeadsCount',
            'deletedLeadsCount',
            'followupsCount',
            'otherLeadsCount',
            'allBucketsWithChildren',
            'isDealView',
            'allTags'
        ));
    }

    /* =========================================================================
       CREATED DEALS PIPELINE (KANBAN) VIEW METHODS
       ========================================================================= */

    private function applyPipelineFilters(Request $request, $query)
    {
        // 1. Role-based ownership restriction
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // Keep non-archived converted deals visible while they move through order statuses.
        $query->where('is_converted', 1)->where(function($q) {
            $q->where('is_archived', 0)->orWhereNull('is_archived');
        });

        // 3. Global Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $digitsOnly = preg_replace('/\D+/', '', $search);
            $last10 = (strlen($digitsOnly) >= 10) ? substr($digitsOnly, -10) : $digitsOnly;

            $searchUserIds = User::where(function ($uQ) use ($search, $digitsOnly, $last10) {
                $uQ->where('name', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%")
                   ->orWhere('contact_no', 'like', "%{$search}%");

                if ($digitsOnly !== '') {
                    $uQ->orWhere('contact_no', 'like', "%{$digitsOnly}%")
                       ->orWhere('contact_no', 'like', "%{$last10}%")
                       ->orWhereRaw("REPLACE(REPLACE(REPLACE(contact_no, ' ', ''), '+', ''), '-', '') LIKE ?", ['%' . $digitsOnly . '%'])
                       ->orWhereRaw("REPLACE(REPLACE(REPLACE(contact_no, ' ', ''), '+', ''), '-', '') LIKE ?", ['%' . $last10 . '%']);
                }
            })->pluck('id')->toArray();

            $query->where(function ($q) use ($searchUserIds, $search) {
                if (!empty($searchUserIds)) {
                    $q->whereIn('uid', $searchUserIds);
                } else {
                    $q->where('business_name', 'like', "%{$search}%");
                }
            });
        }

        // 4. Date Filters
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $query->whereDate('date', Carbon::parse($request->from)->toDateString());
        }

        // 5. Source Filter
        if ($request->filled('source')) {
            $query->where('platform', 'like', "%{$request->source}%");
        }

        // 6. Lead Owner Filter
        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        // 7. Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 8. Company Filter
        if ($request->filled('company')) {
            $query->where('business_name', 'like', '%' . $request->company . '%');
        }

        // 9. Campaign, Adset, Ad Name Filters
        if ($request->filled('campaign_name')) {
            $query->where('campaign_name', 'like', '%' . $request->campaign_name . '%');
        }
        if ($request->filled('adset_name')) {
            $query->where('adset_name', 'like', '%' . $request->adset_name . '%');
        }
        if ($request->filled('ad_name')) {
            $query->where('ad_name', 'like', '%' . $request->ad_name . '%');
        }
    }

    private function applyBucketQueryFilter($query, $bucket)
    {
        $bName = strtolower(trim($bucket->name));
        $bId = $bucket->id;
        $childIds = $bucket->children ? $bucket->children->pluck('id')->toArray() : [];
        $childNames = $bucket->children ? $bucket->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray() : [];

        $query->where(function ($q) use ($bName, $bId, $childNames, $childIds) {
            $q->where('lead_bucket_id', $bId);
            if (!empty($childIds)) {
                $q->orWhereIn('lead_bucket_id', $childIds);
            }
            if ($bName !== '') {
                $q->orWhere(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $bName);
            }
            if (!empty($childNames)) {
                $q->orWhereIn(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $childNames);
            }
            if ($bName === 'deal created' || $bName === 'yet to call') {
                $q->orWhereNull('lead_bucket_id')
                  ->orWhere('lead_bucket_id', 0)
                  ->orWhereNull('lead_status')
                  ->orWhere(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), '');
            }
        });
    }

    public function pipelineIndex(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        @session_write_close();

        // 1. Filter Options Data
        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->orderBy('name')->get(['id', 'name', 'email']);
        $sources = LeadSource::where('is_active', 1)->pluck('source_name')->toArray();
        $categories = Category::where('is_active', 1)->orderBy('category_name')->get();

        // 2. Fetch Top-Level Deal/Order Buckets
        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('type', 'order')
            ->with('children')
            ->orderBy('id', 'asc')
            ->get();

        // 3. Fast Aggregated Count Query
        $statusCountsQuery = Leads::query();
        $this->applyPipelineFilters($request, $statusCountsQuery);

        $statusCounts = $statusCountsQuery
            ->reorder()
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_id')
            ->get();

        $columnCards = [];
        $perPage = 15;

        foreach ($buckets as $b) {
            $bName = strtolower(trim($b->name));
            $bId = $b->id;
            $childIds = $b->children ? $b->children->pluck('id')->toArray() : [];
            $childNames = $b->children ? $b->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray() : [];

            $colTotal = $statusCounts->filter(function ($item) use ($bName, $bId, $childNames, $childIds) {
                $itemStatus = strtolower(trim($item->status_name));
                if ($itemStatus === $bName || $item->lead_bucket_id == $bId) {
                    return true;
                }
                if (in_array($itemStatus, $childNames) || in_array($item->lead_bucket_id, $childIds)) {
                    return true;
                }
                if (($bName === 'deal created' || $bName === 'yet to call') && ($itemStatus === '' || is_null($itemStatus))) {
                    return true;
                }
                return false;
            })->sum('cnt');

            $cardQuery = Leads::with([
                'user:id,name,email,contact_no,city,state,address',
                'owner:id,name',
                'bucket:id,name,bucket_color',
                'category:id,category_name',
                'latestMessage.user:id,name'
            ]);

            $this->applyPipelineFilters($request, $cardQuery);
            $this->applyBucketQueryFilter($cardQuery, $b);

            $paginator = $cardQuery->orderBy('id', 'desc')->paginate($perPage, ['*'], 'col_' . $bId, 1);

            $columnCards[$bId] = [
                'bucket' => $b,
                'total' => $colTotal,
                'leads' => $paginator->items(),
                'has_more' => $paginator->hasMorePages(),
                'next_page' => $paginator->hasMorePages() ? 2 : null,
            ];
        }

        if ($request->ajax() || $request->wantsJson()) {
            $columnHtmlMap = [];
            foreach ($buckets as $b) {
                $bId = $b->id;
                $colData = $columnCards[$bId];
                $cardsHtml = '';
                foreach ($colData['leads'] as $leadItem) {
                    $cardsHtml .= view('crm.lead.pipeline-card', ['lead' => $leadItem])->render();
                }
                $columnHtmlMap[$bId] = [
                    'cards_html' => $cardsHtml,
                    'total' => $colData['total'],
                    'has_more' => $colData['has_more'],
                    'next_page' => $colData['next_page'],
                ];
            }

            return response()->json([
                'success' => true,
                'columns' => $columnHtmlMap,
            ]);
        }

        return view('crm.lead.created-deals-pipeline', compact('buckets', 'owners', 'sources', 'categories', 'columnCards'));
    }

    public function pipelineCards(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        @session_write_close();

        $bucketId = $request->input('bucket_id');
        $page = (int) $request->input('page', 1);
        $perPage = 15;

        if (!$bucketId) {
            return response()->json(['success' => false, 'message' => 'Bucket ID required'], 400);
        }

        $bucket = Bucket::with('children')->find($bucketId);
        if (!$bucket) {
            return response()->json(['success' => false, 'message' => 'Bucket not found'], 404);
        }

        $cardQuery = Leads::with([
            'user:id,name,email,contact_no,city,state,address',
            'owner:id,name',
            'bucket:id,name,bucket_color',
            'category:id,category_name',
            'latestMessage.user:id,name'
        ]);

        $this->applyPipelineFilters($request, $cardQuery);
        $this->applyBucketQueryFilter($cardQuery, $bucket);

        $paginator = $cardQuery->orderBy('id', 'desc')->paginate($perPage, ['*'], 'col_' . $bucketId, $page);

        $cardsHtml = '';
        foreach ($paginator->items() as $leadItem) {
            $cardsHtml .= view('crm.lead.pipeline-card', ['lead' => $leadItem])->render();
        }

        return response()->json([
            'success' => true,
            'cards_html' => $cardsHtml,
            'has_more' => $paginator->hasMorePages(),
            'next_page' => $paginator->hasMorePages() ? ($page + 1) : null,
        ]);
    }

    public function pipelineDragUpdate(Request $request, Leads $lead)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        if (auth()->user()->role_id == 3 && $lead->lead_owner != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Permission denied'], 403);
        }

        $targetBucketId = $request->input('target_bucket_id');
        $targetBucket = Bucket::where('type', 'order')->find($targetBucketId);

        if (!$targetBucket) {
            return response()->json(['success' => false, 'message' => 'Target bucket invalid'], 400);
        }

        $oldBucketId = $lead->lead_bucket_id;
        $oldStatus = $lead->lead_status;

        $lead->lead_bucket_id = $targetBucket->id;
        if ($request->filled('lead_status')) {
            $lead->lead_status = $request->input('lead_status');
        } else {
            $lead->lead_status = $targetBucket->name;
        }
        $lead->save();

        \App\Models\Order::where('lead_id', $lead->id)->update([
            'order_bucket_id' => $targetBucket->id,
            'order_status' => $lead->lead_status,
        ]);

        try {
            \App\Models\LeadHistory::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'action' => 'pipeline_drag_update',
                'changes' => json_encode([
                    'from_bucket' => $oldBucketId,
                    'to_bucket' => $targetBucket->id,
                    'from_status' => $oldStatus,
                    'to_status' => $lead->lead_status,
                ]),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit log error silently
        }

        return response()->json([
            'success' => true,
            'message' => 'Lead status updated successfully',
            'lead_id' => $lead->id,
            'new_bucket_id' => $targetBucket->id,
            'new_status' => $lead->lead_status,
        ]);
    }
}
