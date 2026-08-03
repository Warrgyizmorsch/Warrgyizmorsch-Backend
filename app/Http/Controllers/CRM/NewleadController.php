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

        // 1. Eager Load Relations (Same as your old code)
        $query = Leads::with([
            'user',
            'owner',
            'bucket.children',
            'messages.user',
            'messages.lead',
            'attributes',
            'todoTasks.assignee',
            'latestAssignHistory',
            'category',
        ])->withCount([
                    'messages as call_followup_count' => function ($q) {
                        $q->where('followup_type', 'Call');
                    }
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
        // The list is paginated, while the pipeline must show every lead that
        // matches the same active filters.
        $pipelineLeads = (clone $query)
            ->orderBy('created_at', 'desc')
            ->get();

        $pipelineLeads->each(function ($lead) {
            $lead->lastMessage = $lead->messages->sortByDesc('created_at')->first();
        });

        // 5. Pagination (Appends query preserves filters on next pages)
        $perPage = request('per_page', 20);
        $leads = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());


        $leads->getCollection()->transform(function ($lead) {

            $duplicateLeads = Leads::where('uid', $lead->uid)
                ->where('id', '!=', $lead->id)
                ->pluck('id');

            $lead->duplicate_count = $duplicateLeads->count();
            $lead->duplicate_ids = $duplicateLeads;

            return $lead;
        });
        // echo "<pre>";print_r($leads->toArray());exit;

        // Attach last message
        $leads->getCollection()->transform(function ($lead) {
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

        $mainbuckets = Bucket::whereNull('parent_id')
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



        // Return to your new view
        return view('crm.lead.newindex', compact('leads', 'pipelineLeads', 'childBuckets', 'filterBucket', 'mainbuckets', 'childtotalLeadsCount', 'categorys', 'buckets', 'deletedLeadsCount', 'owners', 'totalLeadsCount', 'filteredLeadCount', 'sources', 'followupsCount', 'otherLeadsCount', 'systemTotalLeadsCount'));
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
}
