<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\Category;
use App\Models\User;
use App\Models\LeadSource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeadTableController extends Controller
{
    public function convertToDeal(Request $request, $lead)
    {
        abort_unless(auth()->check(), 401);
        $leadObj = $lead instanceof Leads ? $lead : Leads::findOrFail($lead);
        if (auth()->user()->role_id == 3 && $leadObj->lead_owner != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'You are not allowed to convert this lead.'], 403);
        }

        DB::transaction(function () use ($leadObj) {
            $dealBucket = Bucket::where('is_deleted', 0)
                ->where('type', 'order')
                ->whereRaw('LOWER(TRIM(name)) LIKE ?', ['%deal created%'])
                ->first() ?? Bucket::where('is_deleted', 0)->where('type', 'order')->orderBy('id')->first();

            $dealStatus = $dealBucket?->name ?? 'Deal Created';
            $dealBucketId = $dealBucket?->id ?? 82;

            $leadObj->update([
                'is_converted' => 1,
                'lead_status' => $dealStatus,
                'lead_bucket_id' => $dealBucketId,
            ]);

            Order::updateOrCreate(
                ['lead_id' => $leadObj->id],
                [
                    'order_number' => 'ORD-' . (10000 + $leadObj->id),
                    'uid' => $leadObj->uid,
                    'order_bucket_id' => $dealBucketId,
                    'order_status' => $dealStatus,
                    'order_engagement_status' => $leadObj->lead_engagement_status ?? 'hot',
                    'order_owner' => $leadObj->lead_owner,
                    'converted_by' => auth()->id(),
                    'category_id' => $leadObj->category_id,
                    'product' => $leadObj->product,
                    'services' => is_array($leadObj->services) ? $leadObj->services : (json_decode($leadObj->services, true) ?? null),
                    'pain_points' => $leadObj->pain_points,
                    'client_details' => is_array($leadObj->client_details) ? $leadObj->client_details : (json_decode($leadObj->client_details, true) ?? null),
                    'documents' => is_array($leadObj->documents) ? $leadObj->documents : (json_decode($leadObj->documents, true) ?? null),
                    'converted_at' => now(),
                ]
            );

            \App\Models\CallBack::create([
                'lead_id' => $leadObj->id,
                'created_by' => auth()->id(),
                'message' => 'Lead successfully converted to Deal.', // Agar column ka naam 'remark' hai, to 'remark' likhein
                'is_done' => 1 // Taki yeh pending follow-up ki tarah show na ho
            ]);
        });

        return response()->json(['status' => true, 'message' => 'Lead converted to deal successfully']);
    }

    public function bulkConvertToDeal(Request $request)
    {
        abort_unless(auth()->check(), 401);
        $rawIds = $request->input('ids', []);
        $ids = is_array($rawIds) ? $rawIds : (is_string($rawIds) ? explode(',', $rawIds) : []);
        $ids = array_filter(array_map('intval', $ids));

        if (empty($ids)) {
            return response()->json(['status' => false, 'message' => 'No leads selected'], 400);
        }

        $query = Leads::whereIn('id', $ids);
        if (auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        $leadsToConvert = $query->get();
        if ($leadsToConvert->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No matching leads found to convert'], 404);
        }

        $dealBucket = Bucket::where('is_deleted', 0)
            ->where('type', 'order')
            ->whereRaw('LOWER(TRIM(name)) LIKE ?', ['%deal created%'])
            ->first() ?? Bucket::where('is_deleted', 0)->where('type', 'order')->orderBy('id')->first();

        $dealStatus = $dealBucket?->name ?? 'Deal Created';
        $dealBucketId = $dealBucket?->id ?? 82;

        DB::transaction(function () use ($leadsToConvert, $dealBucketId, $dealStatus) {
            foreach ($leadsToConvert as $leadObj) {
                $leadObj->update([
                    'is_converted' => 1,
                    'lead_status' => $dealStatus,
                    'lead_bucket_id' => $dealBucketId,
                ]);

                Order::updateOrCreate(
                    ['lead_id' => $leadObj->id],
                    [
                        'order_number' => 'ORD-' . (10000 + $leadObj->id),
                        'uid' => $leadObj->uid,
                        'order_bucket_id' => $dealBucketId,
                        'order_status' => $dealStatus,
                        'order_engagement_status' => $leadObj->lead_engagement_status ?? 'hot',
                        'order_owner' => $leadObj->lead_owner,
                        'converted_by' => auth()->id(),
                        'category_id' => $leadObj->category_id,
                        'product' => $leadObj->product,
                        'services' => is_array($leadObj->services) ? $leadObj->services : (json_decode($leadObj->services, true) ?? null),
                        'pain_points' => $leadObj->pain_points,
                        'client_details' => is_array($leadObj->client_details) ? $leadObj->client_details : (json_decode($leadObj->client_details, true) ?? null),
                        'documents' => is_array($leadObj->documents) ? $leadObj->documents : (json_decode($leadObj->documents, true) ?? null),
                        'converted_at' => now(),
                    ]
                );
                \App\Models\CallBack::create([
                    'lead_id' => $leadObj->id,
                    'created_by' => auth()->id(),
                    'message' => 'Lead successfully converted to Deal (Bulk Action).',
                    'is_done' => 1
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'message' => count($leadsToConvert) . ' lead(s) converted to deal successfully',
            'count' => count($leadsToConvert),
        ]);
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
            'tags:id,name,color',
            'messages' => function ($mQ) {
                $mQ->where('is_done', 0)
                   ->whereNotNull('next_followup_date')
                   ->orderBy('next_followup_date', 'asc');
            },
        ]);

        // 2. Role-based restrictions & Exclude Archived
        $query->where(function($q) {
            $q->where('is_archived', 0)->orWhereNull('is_archived');
        });

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
            $query->where(function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to])
                  ->orWhere(function ($sub) use ($from, $to) {
                      $sub->whereNull('date')->whereBetween('created_at', [$from, $to]);
                  });
            });
        } elseif ($request->filled('from')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $query->where(function ($q) use ($from) {
                $q->where('date', '>=', $from)
                  ->orWhere(function ($sub) use ($from) {
                      $sub->whereNull('date')->where('created_at', '>=', $from);
                  });
            });
        } elseif ($request->filled('to')) {
            $to = Carbon::parse($request->to)->endOfDay();
            $query->where(function ($q) use ($to) {
                $q->where('date', '<=', $to)
                  ->orWhere(function ($sub) use ($to) {
                      $sub->whereNull('date')->where('created_at', '<=', $to);
                  });
            });
        }

        // Source Filter
        if ($request->filled('source')) {
            $query->where(function($sq) use ($request) {
                $sq->where('platform', 'like', "%{$request->source}%")
                   ->orWhere('form_name', 'like', "%{$request->source}%");
            });
        }

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


        if ($request->filled('country'))
            $query->where('applying_country_for_a_visa', 'like', "%{$request->country}%");
        if ($request->filled('course'))
            $query->where('what_course_are_you_planning_to_study', 'like', "%{$request->course}%");

        $orderBucketsAll = Bucket::with('children')->where('type', 'order')->get();
        $orderBucketIds = $orderBucketsAll->pluck('id')
            ->merge($orderBucketsAll->pluck('children')->flatten()->pluck('id'))
            ->filter()
            ->unique()
            ->toArray();
        if (empty($orderBucketIds)) {
            $orderBucketIds = Bucket::whereNull('parent_id')
                ->where('is_deleted', 0)
                ->where('name', 'NOT LIKE', '%lead%')
                ->pluck('id')
                ->toArray();
        }
        $orderStatusNames = $orderBucketsAll->pluck('name')
            ->merge($orderBucketsAll->pluck('children')->flatten()->pluck('name'))
            ->filter()
            ->map(fn($n) => strtolower(trim($n)))
            ->unique()
            ->toArray();

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
            // Standard Leads view: strictly exclude converted deals, order buckets, and Deal Created leads
            $query->where(function ($q) {
                $q->whereNull('is_converted')->orWhere('is_converted', 0);
            });
            if (!empty($orderBucketIds)) {
                $query->whereNotIn('lead_bucket_id', $orderBucketIds);
            }
            $query->where(function ($q) {
                $q->whereNull('lead_status')
                  ->orWhere(DB::raw('LOWER(TRIM(lead_status))'), 'NOT LIKE', '%deal created%');
            })->where(function ($q) {
                $q->whereNull('lead_bucket_name')
                  ->orWhere(DB::raw('LOWER(TRIM(lead_bucket_name))'), 'NOT LIKE', '%deal created%');
            });
            if (!empty($orderStatusNames)) {
                $query->whereNotIn(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $orderStatusNames)
                      ->whereNotIn(DB::raw('LOWER(TRIM(COALESCE(lead_bucket_name, "")))'), $orderStatusNames);
            }
        }

        if ($request->filled('lead_status') && $request->lead_status !== 'all' && $request->bucket_id !== 'all_orders' && !$request->filled('search') && !$request->filled('search_uid')) {
            $statusTerm = trim($request->lead_status);
            $matchedMainBucket = Bucket::whereNull('parent_id')
                ->where(DB::raw('LOWER(TRIM(name))'), strtolower($statusTerm))
                ->with('children')
                ->first();

            if ($matchedMainBucket) {
                $childNames = $matchedMainBucket->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray();
                $childIds = $matchedMainBucket->children->pluck('id')->toArray();
                $allIds = array_merge([$matchedMainBucket->id], $childIds);
                $allNames = array_merge([strtolower($statusTerm)], $childNames);

                $query->where(function($q) use ($statusTerm, $allNames, $allIds) {
                    $q->where(DB::raw('LOWER(TRIM(COALESCE(lead_bucket_name, "")))'), strtolower($statusTerm))
                      ->orWhereIn(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $allNames)
                      ->orWhereIn('lead_bucket_id', $allIds);
                });
            } else {
                $query->where(function($q) use ($statusTerm) {
                    $q->where('lead_status', $statusTerm)
                      ->orWhere('lead_bucket_name', $statusTerm);
                });
            }
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
        $totalLeadsBaseQuery = Leads::where(function ($q) {
            $q->whereNull('is_archived')->orWhere('is_archived', 0);
        })->where(function ($q) {
            $q->whereNull('is_converted')->orWhere('is_converted', 0);
        });
        if (!empty($orderBucketIds)) {
            $totalLeadsBaseQuery->whereNotIn('lead_bucket_id', $orderBucketIds);
        }
        $totalLeadsBaseQuery->where(function ($q) {
            $q->whereNull('lead_status')->orWhere(DB::raw('LOWER(TRIM(lead_status))'), 'NOT LIKE', '%deal created%');
        })->where(function ($q) {
            $q->whereNull('lead_bucket_name')->orWhere(DB::raw('LOWER(TRIM(lead_bucket_name))'), 'NOT LIKE', '%deal created%');
        });

        if ($user && ($user->role_id == 1 || $user->role_id == 2)) {
            $totalLeadsCount = (clone $totalLeadsBaseQuery)->count();
        } elseif ($user) {
            $totalLeadsCount = (clone $totalLeadsBaseQuery)->where('lead_owner', $user->id)->count();
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

        // 5. Dynamic Status Buckets & Hierarchy Counts (100% accurate count matching)
        // 1. Fetch active lead-type buckets (deduplicated by lowercase name)
        $activeLeadBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->where('name', 'NOT LIKE', '%deal created%')
            ->with(['children' => function($cq) {
                $cq->where('is_deleted', 0);
            }])
            ->orderBy('id', 'asc')
            ->get()
            ->unique(fn($b) => strtolower(trim($b->name)))
            ->values();

        // 2. Fetch deleted main buckets (candidates if leads_count > 0)
        $deletedBuckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 1)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->where('name', 'NOT LIKE', '%deal created%')
            ->with('children')
            ->orderBy('id', 'asc')
            ->get();

        $statusCounts = (clone $query)
            ->without(['user', 'owner', 'bucket', 'category', 'latestMessage', 'tags'])
            ->reorder()
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, LOWER(TRIM(COALESCE(lead_bucket_name, ""))) as bucket_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_name', 'lead_bucket_id')
            ->get();

        $calculateCounts = function ($b) use ($statusCounts) {
            $bName = strtolower(trim($b->name));
            $bId = $b->id;
            $childIds = $b->children ? $b->children->pluck('id')->toArray() : [];

            if ($b->children && $b->children->isNotEmpty()) {
                $b->children->each(function ($child) use ($statusCounts, $bName) {
                    $cName = strtolower(trim($child->name));
                    $cId = $child->id;
                    $childCnt = $statusCounts->filter(function ($item) use ($cName, $cId, $bName) {
                        $itemStatus = strtolower(trim($item->status_name ?? ''));
                        $itemBucket = strtolower(trim($item->bucket_name ?? ''));
                        if ($itemBucket !== '' && $itemBucket === $bName) {
                            return $itemStatus === $cName || $item->lead_bucket_id == $cId;
                        }
                        if ($itemStatus !== '') {
                            return $itemStatus === $cName;
                        }
                        return $item->lead_bucket_id == $cId;
                    })->sum('cnt');
                    $child->leads_count = $childCnt;
                });

                // Filter child statuses: keep active ones, and for deleted ones only keep if leads_count > 0
                $b->setRelation('children', $b->children->filter(function($c) {
                    return empty($c->is_deleted) || ($c->leads_count ?? 0) > 0;
                })->values());
            }

            $cnt = $statusCounts->filter(function ($item) use ($bName, $bId, $childIds) {
                $itemBucket = strtolower(trim($item->bucket_name ?? ''));
                if ($itemBucket !== '') {
                    return $itemBucket === $bName;
                }
                $itemStatus = strtolower(trim($item->status_name ?? ''));
                if ($itemStatus === $bName) {
                    return true;
                }
                return ($item->lead_bucket_id == $bId || in_array($item->lead_bucket_id, $childIds));
            })->sum('cnt');

            $b->leads_count = $cnt;
        };

        $activeLeadBuckets->each(function($b) use ($calculateCounts) {
            $b->is_deleted = 0;
            $calculateCounts($b);
        });

        $activeNames = $activeLeadBuckets->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray();

        // Process deleted buckets (only if leads_count > 0)
        $deletedBucketsWithLeads = collect();
        $deletedBuckets->each(function($b) use ($calculateCounts, &$activeNames, &$deletedBucketsWithLeads) {
            $b->is_deleted = 1;
            $calculateCounts($b);
            $bName = strtolower(trim($b->name));
            if (($b->leads_count ?? 0) > 0 && !in_array($bName, $activeNames)) {
                $deletedBucketsWithLeads->push($b);
                $activeNames[] = $bName;
            }
        });

        // Check for any orphaned lead_bucket_name (excluding deal created or order buckets)
        $orphanedBuckets = collect();
        $distinctLeadBucketNames = $statusCounts->pluck('bucket_name')->filter()->unique();
        foreach ($distinctLeadBucketNames as $dbName) {
            $dbNameLower = strtolower(trim($dbName));
            if (str_contains($dbNameLower, 'deal created') || in_array($dbNameLower, $orderStatusNames)) {
                continue;
            }
            if ($dbNameLower !== '' && !in_array($dbNameLower, $activeNames)) {
                $cnt = $statusCounts->filter(fn($item) => strtolower(trim($item->bucket_name ?? '')) === $dbNameLower)->sum('cnt');
                if ($cnt > 0) {
                    $orphan = new Bucket();
                    $orphan->id = null;
                    $orphan->name = ucwords($dbName);
                    $orphan->is_deleted = 1;
                    $orphan->leads_count = $cnt;
                    $orphan->setRelation('children', collect());
                    $orphanedBuckets->push($orphan);
                    $activeNames[] = $dbNameLower;
                }
            }
        }

        $childBuckets = $activeLeadBuckets
            ->concat($deletedBucketsWithLeads)
            ->concat($orphanedBuckets);

        $hasActiveFilter = $request->filled('search') 
            || $request->filled('search_uid') 
            || $request->filled('from') 
            || $request->filled('to') 
            || $request->filled('source') 
            || $request->filled('owner_id') 
            || $request->filled('lead_engagement_status') 
            || $request->filled('category_id') 
            || $request->filled('company') 
            || $request->filled('campaign_name') 
            || $request->filled('adset_name') 
            || $request->filled('ad_name') 
            || $request->filled('has_followups');

        $systemTotalLeadsCount = $hasActiveFilter ? $leads->total() : $childBuckets->sum('leads_count');

        if ($hasActiveFilter && empty($request->lead_status)) {
            $childtotalLeadsCount = $leads->total();
        } else {
            $childtotalLeadsCount = $childBuckets->sum('leads_count');
        }

        // Existing leads are never dumped into "Other" because their master status was deleted
        $deletedLeadsCount = 0;
        $otherLeadsCount = 0;

        $categorys = Category::where('is_active', 1)->get();
        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->select('id', 'name', 'email')->get();
        $sources = LeadSource::pluck('source_name')->toArray();

        $today = Carbon::today();
        $followupsQuery = CallBack::query();
        if (auth()->check() && auth()->user()->role_id == 3) {
            $followupsQuery->join('leads', 'callback_messages.lead_id', '=', 'leads.id')
                           ->where('leads.lead_owner', auth()->id());
        }
        $type = $request->followup_type_filter ?? 'upcoming';
        $followupsQuery->whereNotNull('next_followup_date');
        if ($type == 'missed') {
            $followupsQuery->where('next_followup_date', '<', $today)
                ->where('is_done', 0);
        } else {
            $followupsQuery->where('next_followup_date', '>=', $today);
        }
        $followupsCount = $followupsQuery->count();

        $otherLeadsCount = $deletedLeadsCount;
        $allBucketsWithChildren = Bucket::with('children')->where('is_deleted', 0)->get()->keyBy('id');
        $allTags = \App\Models\Tag::where('is_active', true)->orderBy('name')->get();

        return view('crm.lead.tableindex', compact(
            'leads',
            'childBuckets',
            'activeLeadBuckets',
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
            'allBucketsWithChildren',
            'allTags'
        ));
    }

    // SINGLE STATUS UPDATE: Sets lead_status, lead_bucket_name, and active lead_bucket_id
    public function updateStatus(Request $request, $lead)
    {
        abort_unless(auth()->check(), 401);
        $leadObj = Leads::findOrFail($lead);
        
        // Check permission for role 3
        if (auth()->user()->role_id == 3 && $leadObj->lead_owner != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Permission denied.'], 403);
        }

        $bucketId = $request->bucket_id;
        $statusName = $request->status_name;
        $bucketName = null;

        if ($bucketId) {
            $bucketObj = Bucket::find($bucketId);
            if ($bucketObj) {
                if ($bucketObj->parent_id) {
                    $parentObj = Bucket::find($bucketObj->parent_id);
                    $bucketName = $parentObj ? $parentObj->name : $bucketObj->name;
                } else {
                    $bucketName = $bucketObj->name;
                }
                if (empty($statusName)) {
                    $statusName = $bucketObj->name;
                }
            }
        } elseif (!empty($statusName)) {
            $bucketObj = Bucket::whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($statusName))])->first();
            if ($bucketObj) {
                $bucketId = $bucketObj->id;
                if ($bucketObj->parent_id) {
                    $parentObj = Bucket::find($bucketObj->parent_id);
                    $bucketName = $parentObj ? $parentObj->name : $bucketObj->name;
                } else {
                    $bucketName = $bucketObj->name;
                }
            }
        }

        $oldStatus = $leadObj->lead_status;
        $oldBucket = $leadObj->lead_bucket_name;

        $updateData = [
            'lead_status' => $statusName,
            'lead_bucket_id' => $bucketId,
        ];
        if ($bucketName) {
            $updateData['lead_bucket_name'] = $bucketName;
        }

        $leadObj->update($updateData);

        \App\Models\Order::where('lead_id', $leadObj->id)->update([
            'order_bucket_id' => $bucketId,
            'order_status' => $statusName,
        ]);

        \App\Models\CallBack::create([
            'lead_id' => $leadObj->id,
            'status' => $statusName,
            'bucket' => $bucketName ?: $statusName,
            'message' => $oldStatus && $oldStatus !== $statusName 
                ? "Status changed from '{$oldStatus}' to '{$statusName}'"
                : "Status set to '{$statusName}'",
            'is_done' => 1,
            'created_by' => auth()->id(),
        ]);

        try {
            \App\Models\LeadHistory::create([
                'lead_id' => $leadObj->id,
                'user_id' => auth()->id(),
                'action' => 'status_update',
                'changes' => json_encode([
                    'from_status' => $oldStatus,
                    'to_status' => $statusName,
                    'from_bucket' => $oldBucket,
                    'to_bucket' => $bucketName,
                ]),
            ]);
        } catch (\Throwable $e) {}

        return response()->json([
            'status' => true,
            'message' => 'Status updated successfully',
            'bucket_name' => $bucketName,
            'status_name' => $statusName,
        ]);
    }

    // BULK STATUS UPDATE: Sets lead_status, lead_bucket_name, and active lead_bucket_id
    public function bulkUpdateStatus(Request $request)
    {
        abort_unless(auth()->check(), 401);
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return response()->json(['status' => false, 'message' => 'No leads selected'], 400);
        }

        $bucketId = $request->bucket_id;
        $statusName = $request->status_name;
        $bucketName = null;

        if ($bucketId) {
            $bucketObj = Bucket::find($bucketId);
            if ($bucketObj) {
                if ($bucketObj->parent_id) {
                    $parentObj = Bucket::find($bucketObj->parent_id);
                    $bucketName = $parentObj ? $parentObj->name : $bucketObj->name;
                } else {
                    $bucketName = $bucketObj->name;
                }
                if (empty($statusName)) {
                    $statusName = $bucketObj->name;
                }
            }
        } elseif (!empty($statusName)) {
            $bucketObj = Bucket::whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($statusName))])->first();
            if ($bucketObj) {
                $bucketId = $bucketObj->id;
                if ($bucketObj->parent_id) {
                    $parentObj = Bucket::find($bucketObj->parent_id);
                    $bucketName = $parentObj ? $parentObj->name : $bucketObj->name;
                } else {
                    $bucketName = $bucketObj->name;
                }
            }
        }

        $query = Leads::whereIn('id', $ids);
        if (auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        $leadsToUpdate = $query->get();
        foreach ($leadsToUpdate as $leadObj) {
            $oldStatus = $leadObj->lead_status;
            $oldBucket = $leadObj->lead_bucket_name;

            \App\Models\CallBack::create([
                'lead_id' => $leadObj->id,
                'status' => $statusName,
                'bucket' => $bucketName ?: $statusName,
                'message' => $oldStatus && $oldStatus !== $statusName 
                    ? "Status changed from '{$oldStatus}' to '{$statusName}' (Bulk Action)"
                    : "Status set to '{$statusName}' (Bulk Action)",
                'is_done' => 1,
                'created_by' => auth()->id(),
            ]);

            try {
                \App\Models\LeadHistory::create([
                    'lead_id' => $leadObj->id,
                    'user_id' => auth()->id(),
                    'action' => 'bulk_status_update',
                    'changes' => json_encode([
                        'from_status' => $oldStatus,
                        'to_status' => $statusName,
                        'from_bucket' => $oldBucket,
                        'to_bucket' => $bucketName,
                    ]),
                ]);
            } catch (\Throwable $e) {}
        }

        $updateData = [
            'lead_status' => $statusName,
            'lead_bucket_id' => $bucketId,
        ];
        if ($bucketName) {
            $updateData['lead_bucket_name'] = $bucketName;
        }

        $query->update($updateData);

        \App\Models\Order::whereIn('lead_id', $ids)->update([
            'order_bucket_id' => $bucketId,
            'order_status' => $statusName,
        ]);

        return response()->json(['status' => true, 'message' => count($ids) . ' leads updated successfully']);
    }

    /* =========================================================================
       NEW LEADS TABLE PIPELINE (KANBAN) VIEW METHODS
       ========================================================================= */

    private function applyPipelineFilters(Request $request, $query)
    {
        // 1. Role-based ownership restriction & Exclude Archived
        $query->where(function($q) {
            $q->where('is_archived', 0)->orWhereNull('is_archived');
        });

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
            $query->where(function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to])
                  ->orWhere(function ($sub) use ($from, $to) {
                      $sub->whereNull('date')->whereBetween('created_at', [$from, $to]);
                  });
            });
        } elseif ($request->filled('from')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $query->where(function ($q) use ($from) {
                $q->where('date', '>=', $from)
                  ->orWhere(function ($sub) use ($from) {
                      $sub->whereNull('date')->where('created_at', '>=', $from);
                  });
            });
        } elseif ($request->filled('to')) {
            $to = Carbon::parse($request->to)->endOfDay();
            $query->where(function ($q) use ($to) {
                $q->where('date', '<=', $to)
                  ->orWhere(function ($sub) use ($to) {
                      $sub->whereNull('date')->where('created_at', '<=', $to);
                  });
            });
        }

        // 4. Source Filter
        if ($request->filled('source')) {
            $query->where(function($sq) use ($request) {
                $sq->where('platform', 'like', "%{$request->source}%")
                   ->orWhere('form_name', 'like', "%{$request->source}%");
            });
        }

        // 5. Lead Owner Filter
        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        // 6. Company Filter
        if ($request->filled('company')) {
            $companyUserIds = User::where('company_name', 'like', "%{$request->company}%")->pluck('id')->toArray();
            $query->where(function ($q) use ($request, $companyUserIds) {
                $q->where('business_name', 'like', "%{$request->company}%");
                if (!empty($companyUserIds)) {
                    $q->orWhereIn('uid', $companyUserIds);
                }
            });
        }

        // 7. Campaign, Adset, Ad Name Filters
        if ($request->filled('campaign_name')) {
            $query->where('campaign_name', 'like', "%{$request->campaign_name}%");
        }
        if ($request->filled('adset_name')) {
            $query->where('adset_name', 'like', "%{$request->adset_name}%");
        }
        if ($request->filled('ad_name')) {
            $query->where('ad_name', 'like', "%{$request->ad_name}%");
        }

        // 8. Engagement Status Filter
        if ($request->filled('lead_engagement_status')) {
            $query->where('lead_engagement_status', strtolower($request->lead_engagement_status));
        }

        // 9. Country Filter
        if ($request->filled('country')) {
            $query->where('applying_country_for_a_visa', 'like', "%{$request->country}%");
        }

        // 10. Category Filter
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

        $isYetToCall = ($bName === 'yet to call');
        $isLostClosed = ($bName === 'lost / closed' || $bName === 'closed' || $bName === 'lost' || str_contains($bName, 'lost') || str_contains($bName, 'closed'));
        $lostClosedStatuses = ['closed', 'lost', 'lost / closed', 'not qualified', 'wrong number'];
        $matchingStatuses = array_unique(array_filter(array_merge([$bName], $childNames, $isLostClosed ? $lostClosedStatuses : [])));

        $query->where(function ($q) use ($bName, $bId, $childIds, $isYetToCall, $matchingStatuses) {
            $q->where(DB::raw('LOWER(TRIM(COALESCE(lead_bucket_name, "")))'), $bName)
              ->orWhere(function ($sq) use ($matchingStatuses) {
                  $sq->whereIn(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), $matchingStatuses);
              });

            if ($isYetToCall) {
                $q->orWhere(function ($sq) use ($bId, $childIds) {
                    $sq->where(function ($emptyStatus) {
                        $emptyStatus->whereNull('lead_status')
                                    ->orWhere(DB::raw('TRIM(COALESCE(lead_status, ""))'), '');
                    })->where(function ($bk) use ($bId, $childIds) {
                        $bk->where('lead_bucket_id', $bId)
                           ->orWhereNull('lead_bucket_id')
                           ->orWhere('lead_bucket_id', 0);
                        if (!empty($childIds)) {
                            $bk->orWhereIn('lead_bucket_id', $childIds);
                        }
                    });
                });
            } else {
                $q->orWhere(function ($sq) use ($bId, $childIds) {
                    $sq->where(function ($emptyStatus) {
                        $emptyStatus->whereNull('lead_status')
                                    ->orWhere(DB::raw('TRIM(COALESCE(lead_status, ""))'), '');
                    })->where(function ($bk) use ($bId, $childIds) {
                        $bk->where('lead_bucket_id', $bId);
                        if (!empty($childIds)) {
                            $bk->orWhereIn('lead_bucket_id', $childIds);
                        }
                    });
                });
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

        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function($q) {
                $q->where('type', 'lead')->orWhereNull('type');
            })
            ->where(DB::raw('LOWER(TRIM(name))'), 'NOT LIKE', '%deal created%')
            ->with('children')
            ->orderByRaw("FIELD(LOWER(TRIM(name)), '" . implode("','", $mainStatuses) . "') = 0, FIELD(LOWER(TRIM(name)), '" . implode("','", $mainStatuses) . "'), id ASC")
            ->get();

        // 3. Fast Aggregated Count Query matching lead_bucket_name, lead_status and lead_bucket_id
        $statusCountsQuery = Leads::query();
        $this->applyPipelineFilters($request, $statusCountsQuery);

        $statusCounts = $statusCountsQuery
            ->reorder()
            ->selectRaw('LOWER(TRIM(COALESCE(lead_status, ""))) as status_name, LOWER(TRIM(COALESCE(lead_bucket_name, ""))) as bucket_name, lead_bucket_id, COUNT(*) as cnt')
            ->groupBy('lead_status', 'lead_bucket_name', 'lead_bucket_id')
            ->get();

        $columnCards = [];
        $perPage = 15;

        foreach ($buckets as $b) {
            $bName = strtolower(trim($b->name));
            $bId = $b->id;
            $childIds = $b->children ? $b->children->pluck('id')->toArray() : [];
            $childNames = $b->children ? $b->children->pluck('name')->map(fn($n) => strtolower(trim($n)))->toArray() : [];

            $isYetToCall = ($bName === 'yet to call');
            $isLostClosed = ($bName === 'lost / closed' || $bName === 'closed' || $bName === 'lost' || str_contains($bName, 'lost') || str_contains($bName, 'closed'));
            $lostClosedStatuses = ['closed', 'lost', 'lost / closed', 'not qualified', 'wrong number'];
            $matchingStatuses = array_unique(array_filter(array_merge([$bName], $childNames, $isLostClosed ? $lostClosedStatuses : [])));

            $colTotal = $statusCounts->filter(function ($item) use ($bName, $bId, $childIds, $isYetToCall, $matchingStatuses) {
                $itemStatus = strtolower(trim($item->status_name ?? ''));
                $itemBucket = strtolower(trim($item->bucket_name ?? ''));
                if ($itemBucket !== '' && $itemBucket === $bName) {
                    return true;
                }
                if ($itemStatus !== '') {
                    return in_array($itemStatus, $matchingStatuses);
                }
                if ($isYetToCall) {
                    return ($item->lead_bucket_id == $bId || in_array($item->lead_bucket_id, $childIds) || is_null($item->lead_bucket_id) || $item->lead_bucket_id == 0);
                }
                return ($item->lead_bucket_id == $bId || in_array($item->lead_bucket_id, $childIds));
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

            $leadsItems = $cardQuery->orderBy('id', 'desc')->take($perPage + 1)->get();
            $hasMore = $leadsItems->count() > $perPage;
            $displayLeads = $hasMore ? $leadsItems->slice(0, $perPage) : $leadsItems;

            $columnCards[$bId] = [
                'bucket' => $b,
                'total' => $colTotal,
                'leads' => $displayLeads,
                'has_more' => $hasMore,
                'next_page' => $hasMore ? 2 : null,
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
        if ($targetBucket->parent_id) {
            $parent = Bucket::find($targetBucket->parent_id);
            $lead->lead_bucket_name = $parent ? $parent->name : $targetBucket->name;
        } else {
            $lead->lead_bucket_name = $targetBucket->name;
        }

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
