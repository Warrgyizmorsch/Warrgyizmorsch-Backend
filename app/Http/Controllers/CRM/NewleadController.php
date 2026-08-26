<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\User;
use App\Models\LeadSource;
use App\Models\LeadQuestion;
use App\Models\LeadAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class NewleadController extends Controller
{
    public function searchSuggestions(Request $request)
    {
        try {
            @session_write_close();
            $search = trim($request->get('search', ''));
            if (strlen($search) < 1) {
                return response()->json([]);
            }

            $digitsOnly = preg_replace('/\D+/', '', $search);

            // 1. Direct query on User table for Name, Email, Contact No
            $users = User::where(function ($q) use ($search, $digitsOnly) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('contact_no', 'like', "%{$search}%");
                    if ($digitsOnly !== '') {
                        $q->orWhere('contact_no', 'like', "%{$digitsOnly}%")
                          ->orWhereRaw("REPLACE(REPLACE(contact_no, ' ', ''), '+', '') LIKE ?", ['%' . $digitsOnly . '%']);
                    }
                })
                ->select('id', 'name', 'email', 'contact_no')
                ->limit(20)
                ->get();

            $userIds = $users->pluck('id')->toArray();

            // 2. Map associated lead status if exists
            $leadsByUser = collect();
            if (!empty($userIds)) {
                $leadsByUser = Leads::whereIn('uid', $userIds)
                    ->select('id', 'uid', 'business_name', 'lead_status')
                    ->get()
                    ->keyBy('uid');
            }

            // 3. Return users table data directly
            $results = $users->map(function ($u) use ($leadsByUser) {
                $lead = $leadsByUser->get($u->id);
                return [
                    'id' => $lead ? $lead->id : 0,
                    'user_id' => $u->id,
                    'uid' => $u->id,
                    'name' => $u->name ?? 'N/A',
                    'email' => $u->email ?? '',
                    'contact_no' => $u->contact_no ?? 'N/A',
                    'company' => $lead ? ($lead->business_name ?? '') : '',
                    'status' => $lead ? ($lead->lead_status ?? 'Yet to Call') : 'User',
                ];
            });

            return response()->json($results->values());
        } catch (\Throwable $e) {
            \Log::error('searchSuggestions error: ' . $e->getMessage());
            return response()->json([]);
        }
    }

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

        // 3. APPLY ALL YOUR FILTERS
        // Global Search

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
        // dd($query->get()->toArray());
        // Date Filter
        if ($request->filled('from') && $request->filled('to')) {
            $from = \Carbon\Carbon::parse($request->from)->startOfDay();
            $to = \Carbon\Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $from = \Carbon\Carbon::parse($request->from)->toDateString();
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
                    $allTargetIds = array_merge([$targetBucketObj->id], $childBucketIds);
                    $query->where(function($q) use ($allTargetIds, $request) {
                        $q->whereIn('lead_bucket_id', $allTargetIds);
                        if ($request->bucket_id == 46 || $request->bucket_id == 1) {
                            $q->orWhereNull('lead_bucket_id');
                        }
                    });
                } else {
                    $query->where('lead_bucket_id', $request->bucket_id);
                }
            }
        } else {
            // Default Modern Leads view: Exclude converted orders and order buckets
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

            $today = \Carbon\Carbon::today();
            $type = $request->followup_type_filter ?? 'upcoming';

            $query->whereHas('messages', function ($q) use ($today, $type) {

                $q->whereNotNull('next_followup_date');

                if ($type == 'missed') {
                    $q->whereDate('next_followup_date', '<', $today)
                        ->where('is_done', 0);
                } else {
                    $q->whereDate('next_followup_date', '>=', $today);
                }
            });
        }
        if ($request->filled('lead_engagement_status')) {
            $query->where('lead_engagement_status', strtolower($request->lead_engagement_status));
        }
        $companyUserIds = [];
        if ($request->filled('company')) {
            $company = trim($request->company);
            $companyUserIds = User::where('company_name', 'like', "%{$company}%")->pluck('id')->toArray();
            $query->where(function ($q) use ($companyUserIds, $company) {
                $q->where('business_name', 'like', "%{$company}%");
                if (!empty($companyUserIds)) {
                    $q->orWhereIn('uid', $companyUserIds);
                }
            });
        }

        // 4. Counts
        $user = auth()->user();
        // $filteredLeadCount = $query->count();
        $filteredLeadCount = 0; // Calculated via pagination $leads->total() below
        if ($user && ($user->role_id == 1 || $user->role_id == 2)) {
            $totalLeadsCount = Leads::count();
        } elseif ($user) {
            $totalLeadsCount = Leads::where('lead_owner', $user->id)->count();
        } else {
            $totalLeadsCount = 0;
        }
        // Fetch pipeline leads conditionally only when pipeline view is requested
        $pipelineLeads = collect();
        if ($request->view === 'pipeline') {
            $pipelineLeads = (clone $query)->orderBy('created_at', 'desc')->take(200)->get();

            $pipelineUids = $pipelineLeads->pluck('uid')->filter()->unique();
            $pipelineDuplicateGroup = collect();
            if ($pipelineUids->isNotEmpty()) {
                $pipelineDuplicateGroup = Leads::whereIn('uid', $pipelineUids)
                    ->select('id', 'uid')
                    ->get()
                    ->groupBy('uid');
            }

            $pipelineLeads->transform(function ($lead) use ($pipelineDuplicateGroup) {
                $matching = $pipelineDuplicateGroup->get($lead->uid, collect());
                $otherIds = $matching->pluck('id')->reject(fn($id) => $id == $lead->id)->values();

                $lead->duplicate_count = $otherIds->count();
                $lead->duplicate_ids = $otherIds;
                $lead->lastMessage = $lead->latestMessage;

                return $lead;
            });
        }

        // 5. Pagination (Appends query preserves filters on next pages)
        $perPage = request('per_page', 20);
        $leads = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());


        // Batch calculation for duplicate leads to eliminate N+1 queries
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

        // 6. Dynamic Buckets (From your old logic)
        $mainStatuses = [
            'Untouched leads',
            'Not Connected',
            'Counselling in Progress',
            'Application Process',
            'Offer Stage',
            'Visa Process',
            'Converted',
            'Lost'
        ];
        $applyLeadFilters = function ($q) use ($request, $searchUserIds, $companyUserIds) {
            $isEloquent = ($q instanceof \Illuminate\Database\Eloquent\Builder || $q instanceof \Illuminate\Database\Eloquent\Relations\Relation);

            if ($request->filled('search')) {
                $search = trim($request->search);
                $q->where(function ($sQ) use ($searchUserIds, $search) {
                    if (!empty($searchUserIds)) {
                        $sQ->whereIn('leads.uid', $searchUserIds);
                    }
                    $sQ->orWhere('leads.business_name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('company')) {
                $comp = trim($request->company);
                $q->where(function ($cQ) use ($companyUserIds, $comp) {
                    $cQ->where('leads.business_name', 'like', "%{$comp}%");
                    if (!empty($companyUserIds)) {
                        $cQ->orWhereIn('leads.uid', $companyUserIds);
                    }
                });
            }
            if ($request->filled('campaign_name')) {
                $q->where('leads.campaign_name', 'like', "%{$request->campaign_name}%");
            }
            if ($request->filled('adset_name')) {
                $q->where('leads.adset_name', 'like', "%{$request->adset_name}%");
            }
            if ($request->filled('ad_name')) {
                $q->where('leads.ad_name', 'like', "%{$request->ad_name}%");
            }
            if ($request->filled('has_followups')) {
                $today = \Carbon\Carbon::today();
                $type = $request->followup_type_filter ?? 'upcoming';
                if ($isEloquent) {
                    $q->whereHas('messages', function ($mQ) use ($today, $type) {
                        $mQ->whereNotNull('next_followup_date');
                        if ($type == 'missed') {
                            $mQ->whereDate('next_followup_date', '<', $today)->where('is_done', 0);
                        } else {
                            $mQ->whereDate('next_followup_date', '>=', $today);
                        }
                    });
                } else {
                    $q->whereExists(function ($subQ) use ($today, $type) {
                        $subQ->select(\DB::raw(1))
                            ->from('callback_messages')
                            ->whereColumn('callback_messages.lead_id', 'leads.id')
                            ->whereNotNull('callback_messages.next_followup_date');
                        if ($type == 'missed') {
                            $subQ->whereDate('callback_messages.next_followup_date', '<', $today)
                                 ->where('callback_messages.is_done', 0);
                        } else {
                            $subQ->whereDate('callback_messages.next_followup_date', '>=', $today);
                        }
                    });
                }
            }
        };

        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->withCount([
                'leads' => function ($q) use ($applyLeadFilters) {
                    if (auth()->check() && auth()->user()->role_id == 3) {
                        $q->where('lead_owner', auth()->id());
                    }
                    $applyLeadFilters($q);
                }
            ])
            ->orderByRaw("FIELD(name, '" . implode("','", $mainStatuses) . "')")
            ->get();

        $parentLeadBucket = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('name', 'LIKE', '%lead%')
                  ->orWhere('id', 1);
            })
            ->first();

        $defaultLeadBucketId = $parentLeadBucket ? $parentLeadBucket->id : 1;
        $targetBucketId = $request->bucket_id ?? $defaultLeadBucketId;
        $isLeadBucket = ($targetBucketId == $defaultLeadBucketId);

        $targetBucketObj = Bucket::with('children')->find($targetBucketId);
        $targetBucketChildIds = $targetBucketObj ? $targetBucketObj->children->pluck('id')->toArray() : [];
        $allTargetBucketIds = array_merge([$targetBucketId], $targetBucketChildIds);

        // Calculate Total Leads Count for the active target bucket
        if (!$request->filled('bucket_id') && !$request->filled('deleted_leads')) {
            $totalLeadsCount = $leads->total();
        } else {
            if ($user && ($user->role_id == 1 || $user->role_id == 2)) {
                $totalLeadsCount = Leads::where(function($q) use ($allTargetBucketIds, $isLeadBucket) {
                    $q->whereIn('lead_bucket_id', $allTargetBucketIds);
                    if ($isLeadBucket) {
                        $q->orWhereNull('lead_bucket_id');
                    }
                })
                ->where(function($lq) {
                    $lq->whereNull('is_converted')->orWhere('is_converted', 0);
                })
                ->count();
            } elseif ($user) {
                $totalLeadsCount = Leads::where('lead_owner', $user->id)
                    ->where(function($q) use ($allTargetBucketIds, $isLeadBucket) {
                        $q->whereIn('lead_bucket_id', $allTargetBucketIds);
                        if ($isLeadBucket) {
                            $q->orWhereNull('lead_bucket_id');
                        }
                    })
                    ->where(function($lq) {
                        $lq->whereNull('is_converted')->orWhere('is_converted', 0);
                    })
                    ->count();
            } else {
                $totalLeadsCount = 0;
            }
        }

        $filteredLeadCount = $leads->total();

        $allMappedBucketIds = Bucket::where('is_deleted', 0)->pluck('id')->toArray();
        $otherLeadsCount = Leads::where(function ($q) use ($allMappedBucketIds) {
            $q->whereNotIn('lead_bucket_id', $allMappedBucketIds)->orWhereNull('lead_bucket_id');
        })
        ->where(function ($q) {
            $q->whereNull('is_converted')->orWhere('is_converted', 0);
        })
        ->when(auth()->check() && auth()->user()->role_id == 3, function ($qq) {
            $qq->where('lead_owner', auth()->id());
        })
        ->count();

        $childBuckets = collect();
        $childtotalLeadsCount = 0;

        $hasActiveFilter = $request->filled('search') || $request->filled('search_uid') || $request->filled('from') || $request->filled('source') || $request->filled('owner_id') || $request->filled('lead_engagement_status') || $request->filled('category_id') || $request->filled('company') || $request->filled('campaign_name') || $request->filled('has_followups');

        // Auto-promote any sub-statuses under container 'Lead' (e.g. id=46 or name='Lead') to Root Main Statuses
        $leadContainerIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('name', 'LIKE', 'Lead')->orWhere('name', 'LIKE', 'lead');
            })
            ->pluck('id')
            ->toArray();

        if (!empty($leadContainerIds)) {
            Bucket::whereIn('parent_id', $leadContainerIds)->update(['parent_id' => null]);
            Bucket::whereIn('id', $leadContainerIds)->update(['is_deleted' => 1]);
        }

        $childBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->with(['children' => function($cq) {
                $cq->where('is_deleted', 0);
            }])
            ->orderBy('id', 'asc')
            ->get();

        $statusCountsQuery = (clone $query)
            ->where(function($lq) {
                $lq->whereNull('is_converted')->orWhere('is_converted', 0);
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

        $systemTotalLeadsCount = $hasActiveFilter ? $leads->total() : Leads::when(auth()->check() && auth()->user()->role_id == 3, fn($qq) => $qq->where('lead_owner', auth()->id()))->count();

        if ($hasActiveFilter && empty($request->lead_status)) {
            $childtotalLeadsCount = $leads->total();
        } else {
            $childtotalLeadsCount = $childBuckets->sum('leads_count');
        }

        $filterBucket = $buckets;
        $mainbuckets = $filterBucket;

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



        $allBucketsWithChildren = Bucket::with('children')->where('is_deleted', 0)->get()->keyBy('id');

        // Return to your new view
        return view('crm.lead.newindex', compact('leads', 'pipelineLeads', 'childBuckets', 'filterBucket', 'mainbuckets', 'childtotalLeadsCount', 'categorys', 'buckets', 'deletedLeadsCount', 'owners', 'totalLeadsCount', 'filteredLeadCount', 'sources', 'followupsCount', 'otherLeadsCount', 'systemTotalLeadsCount', 'allBucketsWithChildren'));
    }

    public function updateQuick(Request $request, Leads $lead)
    {
        $request->validate([
            'lead_engagement_status' => 'nullable|string',
            'lead_bucket_id' => 'nullable|integer',
            'lead_status' => 'required|string',
            'followup_type' => 'nullable|string',
            'next_followup_date' => 'nullable|date',
            'message' => 'nullable|string|max:1000',
            'call_recording' => 'nullable|file|mimes:mp3,wav,m4a,ogg,aac,amr,3gp,mp4|max:51200 ',
            'followup_documents' => 'nullable|array',
            'followup_documents.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,xls,xlsx,txt|max:10240',
        ]);

        $uploadedFollowupDocs = [];
        if ($request->hasFile('followup_documents')) {
            foreach ($request->file('followup_documents') as $file) {
                $path = $file->store('leads/followup_documents', 'public');
                $uploadedFollowupDocs[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ];
            }
        }

        $bucketId = $request->lead_bucket_id;
        $bucketObj = null;
        if (!empty($bucketId)) {
            $bucketObj = Bucket::find($bucketId);
        }

        if (!$bucketObj) {
            if (!empty($lead->lead_bucket_id)) {
                $bucketObj = Bucket::find($lead->lead_bucket_id);
            }
            if (!$bucketObj && !empty($request->lead_status)) {
                $bucketObj = Bucket::whereRaw('LOWER(name) = ?', [strtolower(trim($request->lead_status))])->first();
            }
            if (!$bucketObj) {
                $bucketObj = Bucket::where('is_deleted', 0)->first() ?? Bucket::first();
            }
            $bucketId = $bucketObj ? $bucketObj->id : 1;
        }

        $isLeadBucket = false;
        if ($bucketObj) {
            $isLeadBucket = str_contains(strtolower($bucketObj->name), 'lead') || $bucketObj->id == 1;
        }

        $engStatus = strtolower(trim($request->lead_engagement_status ?? ''));
        $validEngStatuses = ['hot', 'warm', 'cold', 'dead'];

        $updateData = [
            'lead_bucket_id' => $bucketId,
            'lead_status'    => $request->lead_status,
            'is_converted'   => $isLeadBucket ? 0 : 1,
        ];

        if (in_array($engStatus, $validEngStatuses)) {
            $updateData['lead_engagement_status'] = $engStatus;
        }

        $lead->update($updateData);

        if (!$isLeadBucket) {
            \App\Models\Order::updateOrCreate(
                ['lead_id' => $lead->id],
                [
                    'order_number'            => 'ORD-' . (10000 + $lead->id),
                    'uid'                     => $lead->uid,
                    'order_bucket_id'         => $bucketId,
                    'order_status'            => $request->lead_status,
                    'order_engagement_status' => in_array($engStatus, $validEngStatuses) ? $engStatus : $lead->lead_engagement_status,
                    'order_owner'             => $lead->lead_owner,
                    'converted_by'            => auth()->id(),
                    'category_id'             => $lead->category_id,
                    'product'                 => $lead->product,
                    'converted_at'            => now(),
                ]
            );
        } else {
            \App\Models\Order::where('lead_id', $lead->id)->delete();
        }
        $audioPath = null;

        if ($request->hasFile('call_recording')) {
            $audioPath = $request->file('call_recording')->store('call_recordings', 'public');
        }
        $bucketName = $bucketObj ? $bucketObj->name : '';
        CallBack::create([
            'lead_id' => $lead->id,
            'message' => $request->message,
            'status' => $request->lead_status,
            'bucket' => $bucketName,
            'lead_engagement_status' => in_array($engStatus, $validEngStatuses) ? $engStatus : null,
            'followup_type' => $request->followup_type,
            'followup_status' => $request->followup_status ?? null,
            'created_by' => auth()->user()->id,
            'next_followup_date' => $request->next_followup_date
                ? Carbon::parse($request->next_followup_date)
                : null,
            'is_done' => 0,
            'call_recording' => $audioPath,
            'followup_documents' => $uploadedFollowupDocs,
        ]);

        return redirect()->back()->with('success', 'Details updated successfully!');
    }

    public function storeTodo(Request $request, $leadId)
    {
        $isAdmin = auth()->check() && auth()->user()->role_id == 1;

        $rules = [
            'summary' => 'required|string',
            'due_date' => 'required|date',
        ];

        if ($isAdmin) {
            $rules['assign_to'] = 'required|integer|exists:users,id';
        }

        $request->validate($rules);

        \App\Models\TodoTask::create([
            'lead_id' => $leadId,
            'assigned_to' => $isAdmin ? $request->assign_to : auth()->id(),
            'created_by' => auth()->id(),
            'summary' => $request->summary,
            'due_date' => $request->due_date,
            'status' => 'Pending'
        ]);

        return back()->with('success', 'To-Do Task assigned successfully!');
    }

    // To-Do Task Update Karne Ke Liye (Optional/Future use)
    public function updateTaskStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $task = \App\Models\TodoTask::findOrFail($id);
        $task->status = $request->status;
        $task->save();
        return back()->with('success', 'Task status updated!');
    }

    public function campaignDetails($id)
    {
        $data = DB::table('leads')
            ->select(
                'adset_name',
                'ad_name',
                'form_name',
                DB::raw('COUNT(*) as total')
            )
            ->where('campaign_id', $id)
            ->groupBy('adset_name', 'ad_name', 'form_name')
            ->get();

        return view('crm.lead.campaign-details', compact('data'));
    }

    public function viewDocument(Request $request)
    {
        $path = $request->query('path');
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }
        return response()->file(storage_path('app/public/' . $path));
    }

    public function downloadDocument(Request $request)
    {
        $path = $request->query('path');
        $name = $request->query('name');
        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }
        return response()->download(storage_path('app/public/' . $path), $name);
    }

    public function dragUpdate(Request $request, Leads $lead)
    {
        $request->validate([
            'lead_bucket_id'         => 'nullable|integer|exists:buckets,id',
            'lead_status'            => 'nullable|string|max:255',
            'lead_engagement_status' => 'nullable|string|max:255',
        ]);

        if ($request->has('lead_bucket_id') && !empty($request->lead_bucket_id)) {
            $lead->lead_bucket_id = $request->lead_bucket_id;
            $tBucket = Bucket::find($request->lead_bucket_id);
            if ($tBucket) {
                $isLeadB = str_contains(strtolower($tBucket->name), 'lead') || $tBucket->id == 1;
                $lead->is_converted = $isLeadB ? 0 : 1;
            }
        }

        if ($request->has('lead_status') && !is_null($request->lead_status)) {
            $lead->lead_status = $request->lead_status;
            if (!$request->filled('lead_bucket_id')) {
                $matchedBucket = Bucket::where('name', $request->lead_status)->where('is_deleted', 0)->first();
                if ($matchedBucket) {
                    $lead->lead_bucket_id = $matchedBucket->id;
                }
            }
        }

        if ($request->has('lead_engagement_status')) {
            $engS = strtolower(trim($request->lead_engagement_status));
            if (in_array($engS, ['hot', 'warm', 'cold', 'dead'])) {
                $lead->lead_engagement_status = $engS;
            }
        }

        $lead->save();

        if (isset($tBucket) && !$isLeadB) {
            \App\Models\Order::updateOrCreate(
                ['lead_id' => $lead->id],
                [
                    'order_number'            => 'ORD-' . (10000 + $lead->id),
                    'uid'                     => $lead->uid,
                    'order_bucket_id'         => $lead->lead_bucket_id,
                    'order_status'            => $lead->lead_status,
                    'order_engagement_status' => $lead->lead_engagement_status,
                    'order_owner'             => $lead->lead_owner,
                    'converted_by'            => auth()->id(),
                    'category_id'             => $lead->category_id,
                    'product'                 => $lead->product,
                    'converted_at'            => now(),
                ]
            );
        } elseif (isset($tBucket) && $isLeadB) {
            \App\Models\Order::where('lead_id', $lead->id)->delete();
        }

        return response()->json(['status' => 'success', 'success' => true, 'message' => 'Lead updated successfully.']);
    }

    public function bulkConvert(Request $request)
    {
        try {
            $request->validate([
                'lead_ids' => 'required|array',
            ]);

            $activeProductionBucket = Bucket::where('name', 'LIKE', '%Active production%')->first();
            if (!$activeProductionBucket) {
                $activeProductionBucket = Bucket::whereNull('parent_id')
                    ->where('is_deleted', 0)
                    ->where('name', 'NOT LIKE', '%lead%')
                    ->first();
            }

            $activeBucketId = $activeProductionBucket ? $activeProductionBucket->id : null;
            $activeStatusName = $activeProductionBucket ? $activeProductionBucket->name : 'Active production';

            $leads = Leads::whereIn('id', $request->lead_ids)->get();

            foreach ($leads as $lead) {
                $lead->is_converted = 1;
                $lead->lead_status = $activeStatusName;
                if ($activeBucketId) {
                    $lead->lead_bucket_id = $activeBucketId;
                }
                $lead->save();

                \App\Models\Order::updateOrCreate(
                    ['lead_id' => $lead->id],
                    [
                        'order_number'            => 'ORD-' . (10000 + $lead->id),
                        'uid'                     => $lead->uid,
                        'order_bucket_id'         => $activeBucketId ?? $lead->lead_bucket_id,
                        'order_status'            => $activeStatusName,
                        'order_engagement_status' => $lead->lead_engagement_status ?? 'hot',
                        'order_owner'             => $lead->lead_owner,
                        'converted_by'            => auth()->id(),
                        'category_id'             => $lead->category_id,
                        'product'                 => $lead->product,
                        'services'                => is_array($lead->services) ? $lead->services : (json_decode($lead->services, true) ?? null),
                        'pain_points'             => $lead->pain_points,
                        'client_details'          => is_array($lead->client_details) ? $lead->client_details : (json_decode($lead->client_details, true) ?? null),
                        'documents'               => is_array($lead->documents) ? $lead->documents : (json_decode($lead->documents, true) ?? null),
                        'converted_at'            => now(),
                    ]
                );
            }

            return response()->json([
                'status' => 'success',
                'message' => count($leads) . ' lead(s) successfully converted to Order (' . $activeStatusName . ')!'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * STEP 1: Upload Excel/CSV temporarily and extract sheet column headers.
     * The data is NOT saved to the database yet.
     */
    public function uploadImportFile(Request $request)
    {
        // 1. Validate that a file is provided and is an excel/csv file
        $validator = \Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => implode(' ', $validator->errors()->all()),
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'xlsx');
            $tempFilename = 'import_' . time() . '_' . uniqid() . '.' . $ext;

            // Ensure temp_imports directory exists in storage
            $storageDir = storage_path('app/temp_imports');
            if (!file_exists($storageDir)) {
                mkdir($storageDir, 0777, true);
            }

            $destinationPath = $storageDir . DIRECTORY_SEPARATOR . $tempFilename;
            copy($file->getRealPath(), $destinationPath);

            // Load spreadsheet using PhpSpreadsheet
            $filePathToLoad = file_exists($destinationPath) ? $destinationPath : $file->getRealPath();

            if (in_array($ext, ['csv', 'txt'])) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $reader->setInputEncoding('UTF-8');
                $spreadsheet = $reader->load($filePathToLoad);
            } else {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePathToLoad);
            }

            $sheet = $spreadsheet->getActiveSheet();

            // Get highest data column
            $highestColumn = $sheet->getHighestDataColumn();

            // Read row 1 as array
            $headerRow = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, true, true)[1] ?? [];

            // Format headers cleanly
            $headers = [];
            foreach ($headerRow as $colLetter => $headerName) {
                $trimmed = trim((string)$headerName);
                if ($trimmed !== '') {
                    $headers[] = [
                        'col' => $colLetter,
                        'name' => $trimmed,
                    ];
                }
            }

            if (empty($headers)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Uploaded file has no headers in row 1. Please ensure row 1 contains column titles.',
                ], 422);
            }

            // Get first 3 data rows for live preview in modal
            $previewRows = [];
            $highestRow = min($sheet->getHighestDataRow(), 4);
            for ($r = 2; $r <= $highestRow; $r++) {
                $rowData = [];
                foreach ($headers as $h) {
                    $val = $sheet->getCell($h['col'] . $r)->getValue();
                    $rowData[$h['name']] = is_null($val) ? '' : (string)$val;
                }
                $previewRows[] = $rowData;
            }

            return response()->json([
                'status' => 'success',
                'temp_file_id' => $tempFilename,
                'headers' => $headers,
                'preview' => $previewRows,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Upload import file error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to read uploaded file: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * STEP 2: Process the mapped data and save to Users & Leads tables.
     * Unmapped fields will be saved inside the 'custom_attributes' JSON column.
     */
    public function processImport(Request $request)
    {
        // 1. Validate temp_file_id and mapping inputs
        $request->validate([
            'temp_file_id' => 'required|string',
            'mapping' => 'nullable|array',
            'column_mappings' => 'nullable|array',
            'selected_rows' => 'nullable|array',
        ]);

        $tempFilename = $request->temp_file_id;
        $fullPath = storage_path('app/temp_imports/' . $tempFilename);

        // 2. Check if temporary file exists
        if (!file_exists($fullPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Temporary import file not found or expired. Please upload again.',
            ], 400);
        }

        // 3. Receive field mapping selected by user
        $mapping = $request->mapping ?? [];
        $columnMappings = $request->column_mappings ?? [];
        $selectedRows = $request->selected_rows ?? [];

        if (empty($columnMappings) && !empty($mapping)) {
            foreach ($mapping as $target => $hdr) {
                if ($target && $hdr) {
                    $columnMappings[] = [
                        'excel_header' => $hdr,
                        'db_field' => $target
                    ];
                }
            }
        }

        try {
            // 4. Load spreadsheet and get active sheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();
            $highestColumn = $sheet->getHighestDataColumn();

            // 5. Read row 1 headers map (Header Name -> Column Letter)
            $row1 = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, true, true)[1] ?? [];
            $colMap = [];
            foreach ($row1 as $colLetter => $hdr) {
                $colMap[trim((string)$hdr)] = $colLetter;
            }

            // Helper closure to read cell value by header name
            $getVal = function (int $row, string $headerName) use ($colMap, $sheet) {
                if (empty($headerName) || !isset($colMap[$headerName])) {
                    return null;
                }
                $col = $colMap[$headerName];
                $val = $sheet->getCell("{$col}{$row}")->getValue();
                return is_null($val) ? null : trim((string)$val);
            };

            // Helper closure to get value for a target DB field from columnMappings
            $getValueForField = function (string $targetField) use ($columnMappings, $getVal, &$r) {
                foreach ($columnMappings as $cm) {
                    if (($cm['db_field'] ?? '') === $targetField) {
                        $val = $getVal($r, $cm['excel_header'] ?? '');
                        if (!is_null($val) && trim((string)$val) !== '') {
                            return trim((string)$val);
                        }
                    }
                }
                return null;
            };

            $defaultBucketId = \App\Models\Bucket::whereNull('parent_id')
                ->where('is_deleted', 0)
                ->where(function($q) {
                    $q->where('name', 'LIKE', '%lead%')->orWhere('id', 1);
                })
                ->value('id') ?? 1;

            $bucketName = \App\Models\Bucket::where('id', $defaultBucketId)->value('name') ?? 'Lead Bucket';

            $defaultStatus = \App\Models\Bucket::where('parent_id', $defaultBucketId)
                ->where('is_deleted', 0)
                ->where(function($q) {
                    $q->where('name', 'LIKE', '%Yet to Call%')
                      ->orWhere('name', 'Yet to Call');
                })
                ->value('name')
                ?? \App\Models\Bucket::where('parent_id', $defaultBucketId)
                    ->where('is_deleted', 0)
                    ->value('name')
                ?? 'Yet to Call';

            $importedCount = 0;

            // 6. Start database transaction for safety
            DB::beginTransaction();

            for ($r = 2; $r <= $highestRow; $r++) {

                // Filter selected rows if specified
                if (!empty($selectedRows) && !in_array($r, $selectedRows) && !in_array((string)$r, $selectedRows)) {
                    continue;
                }

                // --- A. Extract User / Contact Info ---
                $name = $getValueForField('name');
                $email = strtolower(trim((string)($getValueForField('email') ?? '')));
                $phoneRaw = $getValueForField('contact_no');

                // Clean phone number (keep digits only)
                $cleanPhone = preg_replace('/[^\d]/', '', (string)$phoneRaw);
                if (strlen($cleanPhone) > 10) {
                    $cleanPhone = substr($cleanPhone, -10);
                }

                // Skip row if completely empty (no phone, name, or email)
                if (empty($cleanPhone) && empty($name) && empty($email)) {
                    continue;
                }

                // Dummy fallback email if missing
                if (empty($email)) {
                    $email = 'lead_' . time() . '_' . $r . '@crmtemp.com';
                }

                $user = User::where(function ($q) use ($cleanPhone, $email) {
                    if ($cleanPhone && $email) {
                        $q->where('contact_no', $cleanPhone)->orWhere('email', $email);
                    } elseif ($cleanPhone) {
                        $q->where('contact_no', $cleanPhone);
                    } elseif ($email) {
                        $q->where('email', $email);
                    }
                })->first();

                if (!$user) {
                    $rawCountryCode = $getValueForField('country_code');
                    if ($rawCountryCode) {
                        $countryCode = substr(trim((string)$rawCountryCode), 0, 10);
                    } else {
                        $countryCode = '+91';
                    }

                    // Create new User record safely based on existing columns in users table
                    $userData = [
                        'name' => $name ?: 'Lead ' . $cleanPhone,
                        'email' => $email,
                        'contact_no' => $cleanPhone,
                        'country_code' => $countryCode,
                        'role_id' => 2, // Standard Lead Client Role
                        'password' => \Illuminate\Support\Facades\Hash::make('user@123'),
                    ];

                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'city')) {
                        $userData['city'] = $getValueForField('user_city') ?: $getValueForField('city');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'address')) {
                        $userData['address'] = $getValueForField('address');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'state')) {
                        $userData['state'] = $getValueForField('state');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'pincode')) {
                        $userData['pincode'] = $getValueForField('pincode');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'company_name')) {
                        $userData['company_name'] = $getValueForField('company_name');
                    }

                    $user = User::create($userData);
                }

                // --- C. Extract Lead Specific Fields ---
                $dateVal = $getValueForField('date');
                if ($dateVal) {
                    try { $leadDate = \Carbon\Carbon::parse($dateVal)->toDateString(); }
                    catch (\Throwable $th) { $leadDate = now()->toDateString(); }
                } else {
                    $leadDate = now()->toDateString();
                }

                // --- D. Process Custom Attributes ---
                $customAttributes = [];
                $existingLeadColumns = \Illuminate\Support\Facades\Schema::getColumnListing('leads');
                $reservedFields = [
                    'name', 'contact_no', 'email', 'country_code', 'user_city', 'city', 'state',
                    'pincode', 'address', 'company_name', 'date', 'callback_message', 'description',
                    'comment', 'remarks', 'next_followup_date', 'followup_type', 'followup_status'
                ];

                foreach ($columnMappings as $cm) {
                    $mappedTarget = $cm['db_field'] ?? '';
                    $excelHeader = $cm['excel_header'] ?? '';
                    if (empty($excelHeader)) {
                        continue;
                    }
                    if (empty($mappedTarget)) {
                        $mappedTarget = \Illuminate\Support\Str::slug($excelHeader, '_');
                    }
                    if (in_array($mappedTarget, $reservedFields)) {
                        continue;
                    }
                    // If target field is NOT a standard column in leads table, save to custom_attributes
                    if (!in_array($mappedTarget, $existingLeadColumns)) {
                        $cellVal = $getVal($r, $excelHeader);
                        if (!is_null($cellVal) && trim((string)$cellVal) !== '') {
                            $customAttributes[$mappedTarget] = trim((string)$cellVal);
                        }
                    }
                }

                $statusMapped = $getValueForField('lead_status');
                $leadStatusVal = (!is_null($statusMapped) && trim((string)$statusMapped) !== '') ? trim((string)$statusMapped) : 'Yet to Call';

                // --- E. Create Lead Record in leads table ---
                $rawLeadData = [
                    'uid' => $user->id, // Link to User ID
                    'date' => $leadDate,
                    'campaign_name' => $getValueForField('campaign_name'),
                    'campaign_id' => $getValueForField('campaign_id'),
                    'adset_name' => $getValueForField('adset_name'),
                    'adset_id' => $getValueForField('adset_id'),
                    'ad_name' => $getValueForField('ad_name'),
                    'ad_id' => $getValueForField('ad_id'),
                    'form_name' => $getValueForField('form_name'),
                    'form_id' => $getValueForField('form_id'),
                    'platform' => $getValueForField('platform'),
                    'page_url' => $getValueForField('page_url'),
                    'whats_your_preferred_intake' => $getValueForField('whats_your_preferred_intake'),
                    'budget' => $getValueForField('budget'),
                    'applying_country_for_a_visa' => $getValueForField('applying_country_for_a_visa'),
                    'what_course_are_you_planning_to_study' => $getValueForField('what_course_are_you_planning_to_study'),
                    'highest_completed' => $getValueForField('highest_completed'),
                    'any_academic_gap' => $getValueForField('any_academic_gap'),
                    'english_test_status' => $getValueForField('english_test_status'),
                    'visa_type' => $getValueForField('visa_type'),
                    'product' => $getValueForField('product'),
                    'services' => $getValueForField('services'),
                    'business_name' => $getValueForField('business_name'),
                    'industry' => $getValueForField('industry'),
                    'employee_strength' => $getValueForField('employee_strength'),
                    'website' => $getValueForField('website'),
                    'gst_number' => $getValueForField('gst_number'),
                    'pain_points' => $getValueForField('pain_points'),
                    'description' => $getValueForField('description'),
                    'city' => $getValueForField('city'),
                    'state' => $getValueForField('state'),
                    'pincode' => $getValueForField('pincode'),
                    'address' => $getValueForField('address'),
                    'lead_status' => $leadStatusVal,
                    'lead_engagement_status' => $getValueForField('lead_engagement_status'),
                    'lead_bucket_id' => $defaultBucketId,
                    'lead_owner' => auth()->id(),
                    'imported_by' => auth()->id(),
                    'custom_attributes' => !empty($customAttributes) ? $customAttributes : null,
                ];

                // Dynamically filter fields to match existing database table columns
                $existingLeadColumns = \Illuminate\Support\Facades\Schema::getColumnListing('leads');
                $leadData = array_filter(
                    $rawLeadData,
                    fn($key) => in_array($key, $existingLeadColumns),
                    ARRAY_FILTER_USE_KEY
                );

                $lead = Leads::create($leadData);

                // --- E2. Persist Custom Attributes in leads.custom_attributes JSON column ---
                if (!empty($customAttributes)) {
                    foreach ($customAttributes as $attrKey => $attrVal) {
                        try {
                            $question = LeadQuestion::where('field_name', $attrKey)
                                ->orWhere('field_name', str_replace('_', ' ', $attrKey))
                                ->orWhere('label', $attrKey)
                                ->first();
                            if ($question) {
                                LeadAttribute::updateOrCreate([
                                    'lead_id' => $lead->id,
                                    'field_name' => $attrKey,
                                ], [
                                    'field_value' => $attrVal,
                                    'lead_question_id' => $question->id,
                                ]);
                            }
                        } catch (\Throwable $thAttr) {
                            \Log::warning("LeadAttribute save notice for key {$attrKey}: " . $thAttr->getMessage());
                        }
                    }
                }

                // --- F. Create Callback Message / Followup Remark in callback_messages table ---
                // Support MULTIPLE comment fields (if multiple columns mapped to callback_message/description/comment/remarks)
                $commentColumns = [];
                foreach ($columnMappings as $cm) {
                    $dbField = $cm['db_field'] ?? '';
                    $excelHeader = $cm['excel_header'] ?? '';
                    if (in_array($dbField, ['callback_message', 'description', 'comment', 'remarks']) && !empty($excelHeader)) {
                        $commentColumns[] = $excelHeader;
                    }
                }

                $nextFollowupVal = $getValueForField('next_followup_date');
                $parsedNextFollowup = null;
                if ($nextFollowupVal) {
                    try {
                        $parsedNextFollowup = \Carbon\Carbon::parse($nextFollowupVal);
                    } catch (\Throwable $th) {
                        $parsedNextFollowup = null;
                    }
                }

                $insertedCommentCount = 0;
                foreach ($commentColumns as $cHeader) {
                    $commentText = $getVal($r, $cHeader);
                    if (!is_null($commentText) && trim((string)$commentText) !== '') {
                        CallBack::create([
                            'lead_id' => $lead->id,
                            'created_by' => auth()->id(),
                            'message' => trim((string)$commentText),
                            'status' => $lead->lead_status ?? $defaultStatus,
                            'bucket' => $bucketName,
                            'lead_engagement_status' => $lead->lead_engagement_status,
                            'followup_type' => $getValueForField('followup_type') ?: 'Imported Note',
                            'followup_status' => $getValueForField('followup_status') ?: null,
                            'next_followup_date' => $parsedNextFollowup,
                            'is_done' => 0,
                        ]);
                        $insertedCommentCount++;
                    }
                }

                // Fallback: If no comments were found in mapped columns, but next_followup_date exists
                if ($insertedCommentCount === 0 && $parsedNextFollowup) {
                    CallBack::create([
                        'lead_id' => $lead->id,
                        'created_by' => auth()->id(),
                        'message' => 'Imported Lead Remark',
                        'status' => $lead->lead_status ?? $defaultStatus,
                        'bucket' => $bucketName,
                        'lead_engagement_status' => $lead->lead_engagement_status,
                        'followup_type' => $getValueForField('followup_type') ?: 'Imported Note',
                        'followup_status' => null,
                        'next_followup_date' => $parsedNextFollowup,
                        'is_done' => 0,
                    ]);
                }

                $importedCount++;
            }

            // 7. Commit database transaction
            DB::commit();

            // 8. Delete temporary uploaded file
            @unlink($fullPath);

            return response()->json([
                'status' => 'success',
                'imported_count' => $importedCount,
                'message' => "Successfully imported {$importedCount} lead(s) into database!",
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Import process error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

            return response()->json([
                'status' => 'error',
                'message' => 'Error processing import file: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getDetailsData(Leads $lead)
    {
        @session_write_close();
        $lead->load([
            'user',
            'owner',
            'category',
            'bucket.children',
            'messages.user',
            'todoTasks.assignee',
        ]);

        $messages = $lead->messages->sortByDesc('created_at')->values()->map(function ($msg) {
            return [
                'id' => $msg->id,
                'bucket' => $msg->bucket,
                'status' => $msg->status,
                'message' => $msg->message,
                'is_done' => $msg->is_done ?? 0,
                'followup_type' => $msg->followup_type,
                'followup_status' => $msg->followup_status,
                'next_followup_date' => $msg->next_followup_date ? \Carbon\Carbon::parse($msg->next_followup_date)->format('d M y, h:i A') : null,
                'next_followup_date_raw' => $msg->next_followup_date,
                'call_recording' => $msg->call_recording ? asset('storage/' . $msg->call_recording) : null,
                'followup_documents' => is_array($msg->followup_documents) ? $msg->followup_documents : (is_string($msg->followup_documents) ? json_decode($msg->followup_documents, true) : []),
                'user_name' => $msg->user->name ?? 'Unknown',
                'created_at_formatted' => $msg->created_at ? $msg->created_at->format('d M y, h:i A') : '',
                'created_at_raw' => $msg->created_at ? $msg->created_at->toIso8601String() : null,
            ];
        });

        $todoTasks = $lead->todoTasks->sortByDesc('created_at')->values()->map(function ($task) {
            return [
                'id' => $task->id,
                'summary' => $task->summary,
                'status' => $task->status,
                'due_date' => $task->due_date,
                'due_day' => \Carbon\Carbon::parse($task->due_date)->format('d'),
                'due_month' => \Carbon\Carbon::parse($task->due_date)->format('M'),
                'due_time' => \Carbon\Carbon::parse($task->due_date)->format('h:i A'),
                'assignee_name' => optional($task->assignee)->name ?? 'Unassigned',
            ];
        });

        return response()->json([
            'status' => 'success',
            'lead' => $lead,
            'user' => $lead->user,
            'owner' => $lead->owner,
            'messages' => $messages,
            'todoTasks' => $todoTasks,
        ]);
    }

    /**
     * Compare uploaded Excel against database records by email/mobile.
     * Returns lists of existing leads vs new non-existing leads.
     */
    public function compareExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:20480',
        ]);

        try {
            $file = $request->file('file');
            $tempFileName = 'temp_' . time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('temp_imports', $tempFileName);
            $fullPath = storage_path('app/temp_imports/' . $tempFileName);

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestDataRow();
            $highestColumn = $sheet->getHighestDataColumn();

            $row1 = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, true, true)[1] ?? [];
            $colMap = [];
            $headersList = [];
            foreach ($row1 as $colLetter => $hdr) {
                $hdrName = trim((string)$hdr);
                if ($hdrName !== '') {
                    $colMap[strtolower($hdrName)] = $colLetter;
                    $headersList[] = ['name' => $hdrName, 'col' => $colLetter];
                }
            }

            // Identify email & phone column letters
            $emailCol = null;
            $phoneCol = null;
            $nameCol = null;

            foreach ($colMap as $hName => $col) {
                if (!$emailCol && (str_contains($hName, 'email') || str_contains($hName, 'mail'))) {
                    $emailCol = $col;
                }
                if (!$phoneCol && (str_contains($hName, 'phone') || str_contains($hName, 'mobile') || str_contains($hName, 'contact'))) {
                    $phoneCol = $col;
                }
                if (!$nameCol && (str_contains($hName, 'name') || str_contains($hName, 'client') || str_contains($hName, 'student'))) {
                    $nameCol = $col;
                }
            }

            // Fallbacks if not auto-detected
            if (!$emailCol) $emailCol = reset($colMap);
            if (!$phoneCol) $phoneCol = count($colMap) > 1 ? array_values($colMap)[1] : reset($colMap);
            if (!$nameCol) $nameCol = reset($colMap);

            $excelRows = [];
            for ($r = 2; $r <= $highestRow; $r++) {
                $rawEmail = strtolower(trim((string)$sheet->getCell("{$emailCol}{$r}")->getValue()));
                $rawPhone = preg_replace('/[^\d]/', '', (string)$sheet->getCell("{$phoneCol}{$r}")->getValue());
                if (strlen($rawPhone) > 10) {
                    $rawPhone = substr($rawPhone, -10);
                }
                $rawName = trim((string)$sheet->getCell("{$nameCol}{$r}")->getValue());

                if (empty($rawEmail) && empty($rawPhone) && empty($rawName)) {
                    continue;
                }

                $excelRows[] = [
                    'row' => $r,
                    'name' => $rawName ?: ('Row #' . $r),
                    'email' => $rawEmail,
                    'phone' => $rawPhone,
                ];
            }

            // Fetch DB users matching collected emails and phones
            $emails = array_filter(array_column($excelRows, 'email'));
            $phones = array_filter(array_column($excelRows, 'phone'));

            $existingUsers = User::where(function($q) use ($emails, $phones) {
                if (!empty($emails)) $q->whereIn('email', $emails);
                if (!empty($phones)) $q->orWhereIn('contact_no', $phones);
            })->get();

            $existingEmailMap = $existingUsers->pluck('email')->filter()->map(fn($e) => strtolower($e))->toArray();
            $existingPhoneMap = $existingUsers->pluck('contact_no')->filter()->toArray();

            $existingList = [];
            $newList = [];

            foreach ($excelRows as $item) {
                $isEmailMatch = !empty($item['email']) && in_array($item['email'], $existingEmailMap);
                $isPhoneMatch = !empty($item['phone']) && in_array($item['phone'], $existingPhoneMap);

                if ($isEmailMatch || $isPhoneMatch) {
                    $matchedUser = $existingUsers->first(function($u) use ($item) {
                        return ($item['email'] && strtolower($u->email) === $item['email']) || 
                               ($item['phone'] && $u->contact_no === $item['phone']);
                    });

                    $existingList[] = [
                        'row' => $item['row'],
                        'name' => $item['name'],
                        'email' => $item['email'] ?: 'N/A',
                        'phone' => $item['phone'] ?: 'N/A',
                        'db_name' => $matchedUser->name ?? 'DB User',
                        'match_type' => ($isEmailMatch && $isPhoneMatch) ? 'Email & Phone' : ($isEmailMatch ? 'Email' : 'Phone'),
                    ];
                } else {
                    $newList[] = [
                        'row' => $item['row'],
                        'name' => $item['name'],
                        'email' => $item['email'] ?: 'N/A',
                        'phone' => $item['phone'] ?: 'N/A',
                    ];
                }
            }

            // Generate sample preview rows (first 3 rows) for mapping step
            $previewRows = [];
            $maxPreview = min($highestRow, 4);
            for ($r = 2; $r <= $maxPreview; $r++) {
                $rowData = [];
                foreach ($headersList as $hdrObj) {
                    $cVal = $sheet->getCell("{$hdrObj['col']}{$r}")->getValue();
                    $rowData[$hdrObj['name']] = is_null($cVal) ? '' : trim((string)$cVal);
                }
                $previewRows[] = $rowData;
            }

            return response()->json([
                'status' => 'success',
                'temp_file_id' => $tempFileName,
                'headers' => $headersList,
                'preview' => $previewRows,
                'total_scanned' => count($excelRows),
                'existing_count' => count($existingList),
                'new_count' => count($newList),
                'existing_list' => $existingList,
                'new_list' => $newList,
            ]);

        } catch (\Throwable $e) {
            \Log::error('Excel Compare Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Error comparing Excel file: ' . $e->getMessage(),
            ], 500);
        }
    }


}
