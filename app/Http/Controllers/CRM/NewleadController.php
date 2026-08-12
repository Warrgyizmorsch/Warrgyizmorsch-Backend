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
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class NewleadController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 1. Eager Load Essential Relations
        $query = Leads::with([
            'user',
            'owner',
            'bucket',
            'category',
        ]);

        // 2. Role-based restrictions
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // 3. APPLY ALL YOUR FILTERS
        // Global Search

        if ($request->filled('search')) {
            $search = $request->search;
            $digitsOnly = preg_replace('/\D+/', '', $search);

            $query->whereHas('user', function ($q) use ($search, $digitsOnly) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

                if ($digitsOnly !== '') {
                    $q->orWhereRaw("REPLACE(contact_no, ' ', '') LIKE ?", ['%' . $digitsOnly . '%']);
                } else {
                    $q->orWhere('contact_no', 'like', "%{$search}%");
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

            $query->whereNotNull('lead_bucket_id')
                ->where('lead_bucket_id', '!=', '')
                ->whereNotIn('lead_bucket_id', $mainBucketIds);
        }

        if ($request->filled('country'))
            $query->where('applying_country_for_a_visa', 'like', "%{$request->country}%");
        if ($request->filled('course'))
            $query->where('what_course_are_you_planning_to_study', 'like', "%{$request->course}%");
        $orderBucketIds = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where('name', 'NOT LIKE', '%lead%')
            ->pluck('id')
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
            })->where(function ($q) use ($orderBucketIds) {
                $q->whereNull('lead_bucket_id')
                  ->orWhereNotIn('lead_bucket_id', $orderBucketIds);
            });
        }

        if ($request->filled('lead_status') && $request->bucket_id !== 'all_orders') {
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

        // 4. Counts
        $user = auth()->user();
        $filteredLeadCount = $query->count();
        if ($user && ($user->role_id == 1 || $user->role_id == 2)) {
            $totalLeadsCount = Leads::count();
        } elseif ($user) {
            $totalLeadsCount = Leads::where('lead_owner', $user->id)->count();
        } else {
            $totalLeadsCount = 0;
        }
        // Pipeline leads set to lightweight collection (paginated table view is active)
        $pipelineLeads = collect();

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
            $lead->lastMessage = $lead->messages->sortByDesc('created_at')->first();

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
        $buckets = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->withCount([
                'leads' => function ($q) {
                    if (auth()->check() && auth()->user()->role_id == 3) {
                        $q->where('lead_owner', auth()->id());
                    }
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

        if ($targetBucketId) {
            $childBuckets = Bucket::where('parent_id', $targetBucketId)
                ->where('is_deleted', 0)
                ->select('buckets.*')
                ->selectSub(function ($q) use ($allTargetBucketIds, $isLeadBucket) {
                    $q->from('leads')
                        ->selectRaw('COUNT(*)')
                        ->where(function($bQ) use ($allTargetBucketIds, $isLeadBucket) {
                            $bQ->whereIn('leads.lead_bucket_id', $allTargetBucketIds);
                            if ($isLeadBucket) {
                                $bQ->orWhereNull('leads.lead_bucket_id');
                            }
                        })
                        ->where(function($sQ) {
                            $sQ->whereColumn('leads.lead_status', 'buckets.name')
                               ->orWhereColumn('leads.lead_bucket_id', 'buckets.id')
                               ->orWhere(function($emptyQ) {
                                   $emptyQ->where('buckets.name', 'Yet to Call')
                                          ->where(function($nullQ) {
                                              $nullQ->whereNull('leads.lead_status')
                                                    ->orWhere('leads.lead_status', '');
                                          });
                               });
                        })
                        ->where(function($lq) {
                            $lq->whereNull('leads.is_converted')
                               ->orWhere('leads.is_converted', 0);
                        })
                        ->when(auth()->check() && auth()->user()->role_id == 3, function ($qq) {
                            $qq->where('leads.lead_owner', auth()->id());
                        });
                }, 'leads_count')
                ->get();

            $systemTotalLeadsCount = Leads::when(auth()->check() && auth()->user()->role_id == 3, fn($qq) => $qq->where('lead_owner', auth()->id()))->count();
            $childtotalLeadsCount = $systemTotalLeadsCount;
        }

        $filterBucket = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->withCount([
                'leads' => function ($q) {
                    if (auth()->check() && auth()->user()->role_id == 3) {
                        $q->where('lead_owner', auth()->id());
                    }
                }
            ])
            ->orderByRaw("FIELD(name, '" . implode("','", $mainStatuses) . "')")
            ->get();

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

        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->get();
        $sources = LeadSource::pluck('source_name')->toArray();
        $today = Carbon::today();
        $followupsQuery = Leads::query();
        // Role restriction same rakho
        if (auth()->check() && auth()->user()->role_id == 3) {
            $followupsQuery->where('lead_owner', auth()->id());
        }

        $type = $request->followup_type_filter ?? 'upcoming';

        $followupsQuery->whereHas('messages', function ($q) use ($today, $type) {

            $q->whereNotNull('next_followup_date');

            if ($type == 'missed') {
                $q->whereDate('next_followup_date', '<', $today)
                    ->where('is_done', 0);
            } else {
                $q->whereDate('next_followup_date', '>=', $today);
            }
        });
        $followupsCount = $followupsQuery->count();



        $allBucketsWithChildren = Bucket::with('children')->where('is_deleted', 0)->get()->keyBy('id');

        // Return to your new view
        return view('crm.lead.newindex', compact('leads', 'pipelineLeads', 'childBuckets', 'filterBucket', 'mainbuckets', 'childtotalLeadsCount', 'categorys', 'buckets', 'deletedLeadsCount', 'owners', 'totalLeadsCount', 'filteredLeadCount', 'sources', 'followupsCount', 'otherLeadsCount', 'systemTotalLeadsCount', 'allBucketsWithChildren'));
    }

    public function updateQuick(Request $request, Leads $lead)
    {
        $request->validate([
            'lead_engagement_status' => 'nullable|string',
            'lead_bucket_id' => 'required|integer|exists:buckets,id',
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

        $bucketObj = Bucket::find($request->lead_bucket_id);
        $isLeadBucket = false;
        if ($bucketObj) {
            $isLeadBucket = str_contains(strtolower($bucketObj->name), 'lead') || $bucketObj->id == 1;
        }

        $lead->update([
            'lead_engagement_status' => $request->lead_engagement_status,
            'lead_bucket_id'         => $request->lead_bucket_id,
            'lead_status'            => $request->lead_status,
            'is_converted'           => $isLeadBucket ? 0 : 1,
        ]);

        if (!$isLeadBucket) {
            \App\Models\Order::updateOrCreate(
                ['lead_id' => $lead->id],
                [
                    'order_number'            => 'ORD-' . (10000 + $lead->id),
                    'uid'                     => $lead->uid,
                    'order_bucket_id'         => $request->lead_bucket_id,
                    'order_status'            => $request->lead_status,
                    'order_engagement_status' => $request->lead_engagement_status,
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
        $bucketName = Bucket::find($request->lead_bucket_id)->name ?? '';
        CallBack::create([
            'lead_id' => $lead->id,
            'message' => $request->message,
            'status' => $request->lead_status,
            'bucket' => $bucketName,
            'lead_engagement_status' => $request->lead_engagement_status,
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
        }

        if ($request->has('lead_engagement_status')) {
            $lead->lead_engagement_status = strtolower(trim($request->lead_engagement_status));
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
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:20480',
        ]);

        try {
            // 2. Store the uploaded file in 'temp_imports' directory inside storage/app
            $file = $request->file('file');
            $tempFilename = 'import_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp_imports', $tempFilename);

            $fullPath = storage_path('app/' . $path);

            // 3. Load the spreadsheet to read row 1 (the headers)
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();

            // 4. Get the highest data column (e.g. 'G')
            $highestColumn = $sheet->getHighestDataColumn();

            // 5. Read row 1 as array
            $headerRow = $sheet->rangeToArray("A1:{$highestColumn}1", null, true, true, true)[1] ?? [];

            // 6. Format headers cleanly
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

            // 7. Get first 3 data rows for live preview in modal
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

            // 8. Return JSON response with temp_file_id and headers list
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
            'mapping' => 'required|array',
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

        // 3. Receive field mapping selected by user (db_field => excel_header_name)
        $mapping = $request->mapping;

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

            // Get default bucket & status for new imported leads
            $defaultBucketId = \App\Models\Bucket::whereNull('parent_id')
                ->where('is_deleted', 0)
                ->where(function($q) {
                    $q->where('name', 'LIKE', '%lead%')->orWhere('id', 1);
                })
                ->value('id') ?? 1;

            $defaultStatus = \App\Models\Bucket::where('parent_id', $defaultBucketId)
                ->where('is_deleted', 0)
                ->value('name') ?? 'Yet to Call';

            $importedCount = 0;

            // 6. Start database transaction for safety
            DB::beginTransaction();

            for ($r = 2; $r <= $highestRow; $r++) {

                // --- A. Extract User / Contact Info ---
                $name = $getVal($r, $mapping['name'] ?? '');
                $email = strtolower(trim((string)$getVal($r, $mapping['email'] ?? '')));
                $phoneRaw = $getVal($r, $mapping['contact_no'] ?? '');

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

                // --- B. Find or Create User in users table ---
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
                    // Create new User record safely based on existing columns in users table
                    $userData = [
                        'name' => $name ?: 'Lead ' . $cleanPhone,
                        'email' => $email,
                        'contact_no' => $cleanPhone,
                        'country_code' => $getVal($r, $mapping['country_code'] ?? '') ?: '+91',
                        'role_id' => 2, // Standard Lead Client Role
                        'password' => \Illuminate\Support\Facades\Hash::make('user@123'),
                    ];

                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'city')) {
                        $userData['city'] = $getVal($r, $mapping['user_city'] ?? '') ?: $getVal($r, $mapping['city'] ?? '');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'address')) {
                        $userData['address'] = $getVal($r, $mapping['address'] ?? '');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'state')) {
                        $userData['state'] = $getVal($r, $mapping['state'] ?? '');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'pincode')) {
                        $userData['pincode'] = $getVal($r, $mapping['pincode'] ?? '');
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'company_name')) {
                        $userData['company_name'] = $getVal($r, $mapping['company_name'] ?? '');
                    }

                    $user = User::create($userData);
                }

                // --- C. Extract Lead Specific Fields ---
                $dateVal = $getVal($r, $mapping['date'] ?? '');
                if ($dateVal) {
                    try { $leadDate = \Carbon\Carbon::parse($dateVal)->toDateString(); }
                    catch (\Throwable) { $leadDate = now()->toDateString(); }
                } else {
                    $leadDate = now()->toDateString();
                }

                // --- D. Collect Extra Unmapped Data into custom_attributes JSON ---
                $customAttributes = [];
                
                // Get list of standard mapped headers
                $mappedStandardHeaders = array_values(array_filter($mapping, fn($v) => is_string($v) && !empty($v)));

                foreach ($colMap as $headerName => $colLetter) {
                    // If header was NOT mapped to any standard DB field
                    if (!in_array($headerName, $mappedStandardHeaders)) {
                        $cellVal = $getVal($r, $headerName);
                        if (!is_null($cellVal) && $cellVal !== '') {
                            $customAttributes[$headerName] = $cellVal;
                        }
                    }
                }

                // --- E. Create Lead Record in leads table ---
                $rawLeadData = [
                    'uid' => $user->id, // Link to User ID
                    'date' => $leadDate,
                    'campaign_name' => $getVal($r, $mapping['campaign_name'] ?? ''),
                    'adset_name' => $getVal($r, $mapping['adset_name'] ?? ''),
                    'ad_name' => $getVal($r, $mapping['ad_name'] ?? ''),
                    'form_name' => $getVal($r, $mapping['form_name'] ?? ''),
                    'platform' => $getVal($r, $mapping['platform'] ?? ''),
                    'page_url' => $getVal($r, $mapping['page_url'] ?? ''),
                    'whats_your_preferred_intake' => $getVal($r, $mapping['whats_your_preferred_intake'] ?? ''),
                    'budget' => $getVal($r, $mapping['budget'] ?? ''),
                    'applying_country_for_a_visa' => $getVal($r, $mapping['applying_country_for_a_visa'] ?? ''),
                    'what_course_are_you_planning_to_study' => $getVal($r, $mapping['what_course_are_you_planning_to_study'] ?? ''),
                    'highest_completed' => $getVal($r, $mapping['highest_completed'] ?? ''),
                    'any_academic_gap' => $getVal($r, $mapping['any_academic_gap'] ?? ''),
                    'english_test_status' => $getVal($r, $mapping['english_test_status'] ?? ''),
                    'visa_type' => $getVal($r, $mapping['visa_type'] ?? ''),
                    'product' => $getVal($r, $mapping['product'] ?? ''),
                    'services' => $getVal($r, $mapping['services'] ?? ''),
                    'business_name' => $getVal($r, $mapping['business_name'] ?? ''),
                    'industry' => $getVal($r, $mapping['industry'] ?? ''),
                    'employee_strength' => $getVal($r, $mapping['employee_strength'] ?? ''),
                    'website' => $getVal($r, $mapping['website'] ?? ''),
                    'gst_number' => $getVal($r, $mapping['gst_number'] ?? ''),
                    'pain_points' => $getVal($r, $mapping['pain_points'] ?? ''),
                    'description' => $getVal($r, $mapping['description'] ?? ''),
                    'city' => $getVal($r, $mapping['city'] ?? ''),
                    'state' => $getVal($r, $mapping['state'] ?? ''),
                    'pincode' => $getVal($r, $mapping['pincode'] ?? ''),
                    'address' => $getVal($r, $mapping['address'] ?? ''),
                    'lead_status' => $getVal($r, $mapping['lead_status'] ?? '') ?: $defaultStatus,
                    'lead_engagement_status' => $getVal($r, $mapping['lead_engagement_status'] ?? ''),
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

                // --- F. Create Callback Message / Followup Remark in callback_messages table ---
                $callbackMessageText = $getVal($r, $mapping['callback_message'] ?? '') ?: $getVal($r, $mapping['description'] ?? '');
                $nextFollowupVal = $getVal($r, $mapping['next_followup_date'] ?? '');

                if ($callbackMessageText || $nextFollowupVal) {
                    $parsedNextFollowup = null;
                    if ($nextFollowupVal) {
                        try {
                            $parsedNextFollowup = \Carbon\Carbon::parse($nextFollowupVal);
                        } catch (\Throwable) {
                            $parsedNextFollowup = null;
                        }
                    }

                    CallBack::create([
                        'lead_id' => $lead->id,
                        'created_by' => auth()->id(),
                        'message' => $callbackMessageText ?: 'Imported Lead Remark',
                        'status' => $lead->lead_status ?? $defaultStatus,
                        'bucket' => $bucketName,
                        'lead_engagement_status' => $lead->lead_engagement_status,
                        'followup_type' => $getVal($r, $mapping['followup_type'] ?? '') ?: 'Imported Note',
                        'followup_status' => $getVal($r, $mapping['followup_status'] ?? '') ?: null,
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
}
