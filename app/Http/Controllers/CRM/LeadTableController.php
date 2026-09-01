<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\User;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeadTableController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        @session_write_close();

        // 1. Eager Load Essential Relations with Specific Columns
        $query = Leads::with([
            'user:id,name,email,contact_no,city,state,pincode,address',
            'owner:id,name,email',
            'bucket:id,name,bucket_color,parent_id',
            'category',
            'latestMessage.user:id,name',
        ]);

        // 2. Role-based restrictions
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // 3. APPLY FILTERS
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

        // Other Filters
        if ($request->filled('source'))
            $query->where('platform', 'like', "%{$request->source}%");
        if ($request->filled('status'))
            $query->where('lead_status', $request->status);
        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        if ($request->filled('duplicate_of')) {
            $lead = Leads::find($request->duplicate_of);
            if ($lead) {
                $query->where('uid', $lead->uid);
            }
        }

        if ($request->filled('deleted_leads')) {
            $mainBucketIds = Bucket::whereNull('parent_id')
                ->where('is_deleted', 0)
                ->pluck('id')
                ->toArray();

            $targetBucketIdForFilter = $request->bucket_id ?? 46;
            $childNames = Bucket::where('parent_id', $targetBucketIdForFilter)
                ->where('is_deleted', 0)
                ->pluck('name')
                ->map(fn($n) => strtolower(trim($n)))
                ->toArray();

            $query->where(function($q) use ($mainBucketIds, $childNames) {
                $q->whereNotIn('lead_bucket_id', $mainBucketIds)
                  ->orWhere(function($subQ) use ($childNames) {
                      $subQ->whereNotIn(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $childNames)
                           ->where(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), '!=', 'yet to call')
                           ->whereNotNull('lead_status')
                           ->where('lead_status', '!=', '');
                  });
            });
        }

        if ($request->filled('country'))
            $query->where('applying_country_for_a_visa', 'like', "%{$request->country}%");
        if ($request->filled('course'))
            $query->where('what_course_are_you_planning_to_study', 'like', "%{$request->course}%");

        $orderBucketIds = Bucket::whereNull('parent_id')->order()->pluck('id')->toArray();
        if (empty($orderBucketIds)) {
            $orderBucketIds = Bucket::whereNull('parent_id')
                ->where('is_deleted', 0)
                ->where('name', 'NOT LIKE', '%lead%')
                ->pluck('id')
                ->toArray();
        }

        if (($request->filled('converted') && $request->converted == 1) || ($request->filled('is_converted') && $request->is_converted == 1)) {
            $query->where('is_converted', 1);
        } elseif ($request->filled('bucket_id')) {
            if ($request->bucket_id === 'all_orders') {
                $query->where(function($q) use ($orderBucketIds) {
                    $q->where('is_converted', 1)
                      ->orWhereIn('lead_bucket_id', $orderBucketIds);
                });
            } else {
                $targetBucketObj = Bucket::with('children')->find($request->bucket_id);
                if ($targetBucketObj && $targetBucketObj->children->isNotEmpty()) {
                    $childBucketIds = $targetBucketObj->children->pluck('id')->toArray();
                    $allIds = array_merge([$targetBucketObj->id], $childBucketIds);
                    $query->whereIn('lead_bucket_id', $allIds);
                } else {
                    $query->where('lead_bucket_id', $request->bucket_id);
                }
            }
        } else {
            $query->where(function ($q) {
                $q->whereNull('is_converted')
                  ->orWhere('is_converted', 0);
            });

            if (!$request->filled('search') && !$request->filled('search_uid') && !$request->filled('deleted_leads')) {
                $query->where(function ($q) use ($orderBucketIds) {
                    $q->whereNull('lead_bucket_id')
                      ->orWhereNotIn('lead_bucket_id', $orderBucketIds);
                });

                // Exclude "Deal Created" leads from default view
                $query->where(function ($q) {
                    $q->where(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), 'not like', '%deal created%')
                      ->orWhereNull('lead_status');
                })->whereDoesntHave('bucket', function ($bQ) {
                    $bQ->where(DB::raw('LOWER(TRIM(COALESCE(name, "")))'), 'like', '%deal created%');
                });
            }
        }

        if ($request->filled('lead_status') && $request->bucket_id !== 'all_orders' && !$request->filled('search') && !$request->filled('search_uid')) {
            $query->where('lead_status', $request->lead_status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('campaign_name'))
            $query->where('campaign_name', 'like', "%{$request->campaign_name}%");
        if ($request->filled('adset_name'))
            $query->where('adset_name', 'like', "%{$request->adset_name}%");
        if ($request->filled('ad_name'))
            $query->where('ad_name', 'like', "%{$request->ad_name}%");

        if ($request->filled('has_followups')) {
            $has = $request->has_followups;
            if ($has == '1' || $has === 1) {
                $query->whereHas('callbacks', function ($cbQ) {
                    $cbQ->whereNotNull('next_followup_date')
                        ->where('is_done', 0);
                });
            } elseif ($has == '0' || $has === 0) {
                $query->whereDoesntHave('callbacks', function ($cbQ) {
                    $cbQ->whereNotNull('next_followup_date')
                        ->where('is_done', 0);
                });
            }
        }

        if ($request->filled('lead_engagement_status')) {
            $engStatus = strtolower(trim($request->lead_engagement_status));
            if ($engStatus === 'new') {
                $query->where(function ($q) {
                    $q->whereNull('lead_engagement_status')
                      ->orWhere('lead_engagement_status', '')
                      ->orWhere('lead_engagement_status', 'new');
                });
            } else {
                $query->where('lead_engagement_status', $engStatus);
            }
        }

        if ($request->filled('company')) {
            $companyUserIds = User::where('company_name', 'like', "%{$request->company}%")->pluck('id')->toArray();
            $query->where(function ($q) use ($request, $companyUserIds) {
                $q->where('business_name', 'like', "%{$request->company}%");
                if (!empty($companyUserIds)) {
                    $q->orWhereIn('uid', $companyUserIds);
                }
            });
        }

        // 4. Counts & Pagination
        $user = auth()->user();
        if ($user && ($user->role_id == 1 || $user->role_id == 2)) {
            $totalLeadsCount = Leads::count();
        } elseif ($user) {
            $totalLeadsCount = Leads::where('lead_owner', $user->id)->count();
        } else {
            $totalLeadsCount = 0;
        }

        $perPage = request('per_page', 20);
        $leads = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());
        $filteredLeadCount = $leads->total();

        // Batch calculation for duplicate leads
        $uids = $leads->getCollection()->pluck('uid')->filter()->unique();
        $duplicateGroup = collect();
        if ($uids->isNotEmpty()) {
            $duplicateGroup = Leads::whereIn('uid', $uids)
                ->select('id', 'uid')
                ->get()
                ->groupBy('uid');
        }

        $leads->getCollection()->transform(function ($lead) use ($duplicateGroup) {
            $matching = $duplicateGroup->get($lead->uid, collect());
            $otherIds = $matching->pluck('id')->reject(fn($id) => $id == $lead->id)->values();

            $lead->duplicate_count = $otherIds->count();
            $lead->duplicate_ids = $otherIds;
            $lead->lastMessage = $lead->latestMessage;

            return $lead;
        });

        // 5. Dynamic Status Buckets & Hierarchy Counts
        $childBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->where(DB::raw('LOWER(TRIM(name))'), 'NOT LIKE', '%deal created%')
            ->with(['children' => function($cq) {
                $cq->where('is_deleted', 0);
            }])
            ->orderBy('id', 'asc')
            ->get();

        $statusCountsQuery = (clone $query)
            ->where(function($lq) {
                $lq->whereNull('is_converted')->orWhere('is_converted', 0);
            })
            ->where(function($sq2) {
                $sq2->whereNull('lead_status')
                    ->orWhere(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), 'NOT LIKE', '%deal created%');
            });

        $statusCounts = $statusCountsQuery
            ->reorder()
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_id')
            ->get();

        $childBuckets->each(function ($b) use ($statusCounts) {
            if ($b->children->isNotEmpty()) {
                $b->children->each(function ($child) use ($statusCounts) {
                    $cName = strtolower(trim($child->name));
                    $cId = $child->id;
                    $childCnt = $statusCounts->filter(function ($item) use ($cName, $cId) {
                        $itemStatus = strtolower(trim($item->status_name));
                        return ($itemStatus === $cName || $item->lead_bucket_id == $cId);
                    })->sum('cnt');
                    $child->leads_count = $childCnt;
                });
            }

            $bName = strtolower(trim($b->name));
            $bId = $b->id;
            $childIds = $b->children->pluck('id')->toArray();
            $childNames = $b->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray();

            $cnt = $statusCounts->filter(function ($item) use ($bName, $bId, $childNames, $childIds) {
                $itemStatus = strtolower(trim($item->status_name));
                if ($itemStatus === $bName || $item->lead_bucket_id == $bId) {
                    return true;
                }
                if (in_array($itemStatus, $childNames) || in_array($item->lead_bucket_id, $childIds)) {
                    return true;
                }
                if ($bName === 'yet to call' && ($itemStatus === '' || is_null($itemStatus))) {
                    return true;
                }
                return false;
            })->sum('cnt');
            $b->leads_count = $cnt;
        });

        $hasActiveFilter = $request->filled('search') || $request->filled('search_uid') || $request->filled('from') || $request->filled('source') || $request->filled('owner_id') || $request->filled('lead_engagement_status') || $request->filled('category_id') || $request->filled('company') || $request->filled('campaign_name') || $request->filled('has_followups');

        $systemTotalLeadsCount = $hasActiveFilter ? $leads->total() : Leads::when(auth()->check() && auth()->user()->role_id == 3, fn($qq) => $qq->where('lead_owner', auth()->id()))->count();

        if ($hasActiveFilter && empty($request->lead_status)) {
            $childtotalLeadsCount = $leads->total();
        } else {
            $childtotalLeadsCount = $childBuckets->sum('leads_count');
        }

        $mainBucketIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->pluck('id')
            ->toArray();

        $deletedLeadsCount = Leads::whereNotNull('lead_bucket_id')
            ->where('lead_bucket_id', '!=', '')
            ->whereNotIn('lead_bucket_id', $mainBucketIds)
            ->when(auth()->check() && auth()->user()->role_id == 3, function ($q) {
                $q->where('lead_owner', auth()->id());
            })
            ->count();

        $categorys = Category::where('is_active', 1)->get();
        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->select('id', 'name', 'email')->get();
        $sources = LeadSource::pluck('source_name')->toArray();

        $today = Carbon::today();
        $followupsQuery = CallBack::query();
        if (auth()->check() && auth()->user()->role_id == 3) {
            $followupsQuery->whereHas('lead', function ($lq) {
                $lq->where('lead_owner', auth()->id());
            });
        }
        $type = $request->followup_type_filter ?? 'upcoming';
        $followupsQuery->whereNotNull('next_followup_date');
        if ($type == 'missed') {
            $followupsQuery->whereDate('next_followup_date', '<', $today)
                ->where('is_done', 0);
        } else {
            $followupsQuery->whereDate('next_followup_date', '>=', $today);
        }
        $followupsCount = $followupsQuery->count();

        $otherLeadsCount = $deletedLeadsCount;
        $allBucketsWithChildren = Bucket::with('children')->where('is_deleted', 0)->get()->keyBy('id');

        return view('crm.lead.tableindex', compact(
            'leads',
            'childBuckets',
            'childtotalLeadsCount',
            'categorys',
            'deletedLeadsCount',
            'owners',
            'totalLeadsCount',
            'filteredLeadCount',
            'sources',
            'followupsCount',
            'otherLeadsCount',
            'systemTotalLeadsCount',
            'allBucketsWithChildren'
        ));
    }

    /* =========================================================================
       NEW LEADS TABLE PIPELINE (KANBAN) VIEW METHODS
       ========================================================================= */

    private function applyPipelineFilters(Request $request, $query)
    {
        // 1. Role-based ownership restriction
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // 2. Global Search
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

        // 3. Date Filters
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $query->whereDate('date', Carbon::parse($request->from)->toDateString());
        }

        // 4. Source Filter
        if ($request->filled('source')) {
            $query->where('platform', 'like', "%{$request->source}%");
        }

        // 5. Lead Owner Filter
        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        // 6. Country Filter
        if ($request->filled('country')) {
            $query->where('applying_country_for_a_visa', 'like', "%{$request->country}%");
        }

        // 7. Category Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 8. Exclude Converted Orders & Deal Created leads by default
        $query->where(function ($q) {
            $q->whereNull('is_converted')->orWhere('is_converted', 0);
        })->where(function ($q2) {
            $q2->whereNull('lead_status')
               ->orWhere(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), 'NOT LIKE', '%deal created%');
        });

        // 9. Exclude Order Buckets by default
        $orderBucketIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('type', 'order')
            ->pluck('id')
            ->toArray();

        if (!empty($orderBucketIds)) {
            $query->where(function ($q) use ($orderBucketIds) {
                $q->whereNull('lead_bucket_id')->orWhereNotIn('lead_bucket_id', $orderBucketIds);
            });
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
            if ($bName === 'yet to call') {
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

        // 2. Fetch Top-Level Lead Buckets (Excluding Deal Created)
        $mainStatuses = [
            'yet to call',
            'connected / in conversation',
            'hot lead',
            'warm lead',
            'cold lead',
            'application / deal in progress',
            'won / enrolled',
            'lost / closed'
        ];

        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->where(DB::raw('LOWER(TRIM(name))'), 'NOT LIKE', '%deal created%')
            ->with('children')
            ->orderByRaw("FIELD(LOWER(name), '" . implode("','", $mainStatuses) . "')")
            ->get();

        // 3. Fast Aggregated Count Query matching both lead_status and lead_bucket_id
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
                if ($bName === 'yet to call' && ($itemStatus === '' || is_null($itemStatus))) {
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

        return view('crm.lead.table-pipeline', compact('buckets', 'owners', 'sources', 'categories', 'columnCards'));
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
        $targetBucket = Bucket::find($targetBucketId);

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
