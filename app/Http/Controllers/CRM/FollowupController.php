<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\User;
use App\Models\Order;
use App\Models\Tag;
use App\Models\Category;
use App\Models\LeadSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FollowupController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        @session_write_close();

        $requestedTab = strtolower(trim($request->get('tab', 'lead')));
        if (in_array($requestedTab, ['deal', 'deals'])) {
            $tab = 'deal';
        } elseif (in_array($requestedTab, ['missed', 'due'])) {
            $tab = 'missed';
        } else {
            $tab = 'lead';
        }

        $now = Carbon::now();

        // Base Query for CallBack / callback_messages with Lead, User, and Tags relations
        $query = CallBack::with([
            'user:id,name',
            'lead' => function ($q) {
                $q->with([
                    'user:id,name,email,contact_no,city,state,pincode,address',
                    'owner:id,name,email',
                    'bucket:id,name,bucket_color,parent_id',
                    'tags:id,name,color',
                ]);
            }
        ])->whereHas('lead')
          ->where('is_done', 0)
          ->whereNotNull('next_followup_date')
          ->whereIn('id', function ($subQuery) {
              $subQuery->selectRaw('MAX(id)')
                  ->from('callback_messages')
                  ->where('is_done', 0)
                  ->whereNotNull('next_followup_date')
                  ->groupBy('lead_id');
          });

        // Role 3 restriction (Sales executive sees only their assigned leads)
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->whereHas('lead', function ($q) {
                $q->where('lead_owner', auth()->id());
            });
        }

        // Apply Tab Filter:
        // 'lead'   => upcoming / today onwards for leads (is_converted = 0)
        // 'deal'   => upcoming / today onwards for deals (is_converted = 1)
        // 'missed' => past due follow-ups (next_followup_date < now())
        if ($tab === 'lead') {
            $query->where('next_followup_date', '>=', $now)
                  ->whereHas('lead', function ($q) {
                      $q->where('is_converted', 0);
                  });
        } elseif ($tab === 'deal') {
            $query->where('next_followup_date', '>=', $now)
                  ->whereHas('lead', function ($q) {
                      $q->where('is_converted', 1);
                  });
        } else { // 'missed'
            $query->where('next_followup_date', '<', $now);
        }

        // Search Filter (Lead name, email, phone, company, remark, followup_type, followup_status)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $digitsOnly = preg_replace('/\D+/', '', $search);
            $last10 = (strlen($digitsOnly) >= 10) ? substr($digitsOnly, -10) : $digitsOnly;

            $query->where(function ($q) use ($search, $digitsOnly, $last10) {
                $q->where('message', 'like', "%{$search}%")
                  ->orWhere('followup_type', 'like', "%{$search}%")
                  ->orWhere('followup_status', 'like', "%{$search}%")
                  ->orWhereHas('lead', function ($lQ) use ($search, $digitsOnly, $last10) {
                      $lQ->where('business_name', 'like', "%{$search}%")
                         ->orWhereHas('user', function ($uQ) use ($search, $digitsOnly, $last10) {
                             $uQ->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('contact_no', 'like', "%{$search}%");
                             if ($digitsOnly !== '') {
                                 $uQ->orWhere('contact_no', 'like', "%{$digitsOnly}%")
                                    ->orWhere('contact_no', 'like', "%{$last10}%");
                             }
                         });
                  });
            });
        }

        // Date Filter strictly on next_followup_date
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('next_followup_date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $query->where('next_followup_date', '>=', $from);
        } elseif ($request->filled('to')) {
            $to = Carbon::parse($request->to)->endOfDay();
            $query->where('next_followup_date', '<=', $to);
        }

        // Calculate Counts for all 3 Tabs (Lead, Deal, Missed)
        $baseCountQuery = CallBack::whereHas('lead')
            ->where('is_done', 0)
            ->whereNotNull('next_followup_date')
            ->whereIn('id', function ($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                    ->from('callback_messages')
                    ->where('is_done', 0)
                    ->whereNotNull('next_followup_date')
                    ->groupBy('lead_id');
            });
        if (auth()->check() && auth()->user()->role_id == 3) {
            $baseCountQuery->whereHas('lead', function ($q) {
                $q->where('lead_owner', auth()->id());
            });
        }

        $leadCount = (clone $baseCountQuery)
            ->where('next_followup_date', '>=', $now)
            ->whereHas('lead', fn($q) => $q->where('is_converted', 0))
            ->count();

        $dealCount = (clone $baseCountQuery)
            ->where('next_followup_date', '>=', $now)
            ->whereHas('lead', fn($q) => $q->where('is_converted', 1))
            ->count();

        $missedCount = (clone $baseCountQuery)
            ->where('next_followup_date', '<', $now)
            ->count();

        $allCount = $leadCount + $dealCount + $missedCount;

        // Pagination
        $perPage = (int) $request->get('per_page', 20);
        $perPage = in_array($perPage, [20, 50, 100, 250, 500]) ? $perPage : 20;

        $followups = $query
            ->orderBy('next_followup_date', $tab === 'missed' ? 'desc' : 'asc')
            ->paginate($perPage);

        // Fetch Buckets and Owners for Offcanvas actions
        $childBuckets = Bucket::with('children')
            ->whereNull('parent_id')
            ->where('is_deleted', 0)
            ->get();

        $owners = User::whereIn('role_id', [1, 3])
            ->where('is_deleted', 0)
            ->select('id', 'name', 'email')
            ->get();

        $allTags = Tag::where('is_active', true)->orderBy('name')->get();
        $categorys = Category::where('is_active', 1)->orderBy('category_name')->get();
        $sources = LeadSource::where('is_active', 1)->pluck('source_name')->toArray();

        return view('crm.lead.followups', compact(
            'followups',
            'tab',
            'leadCount',
            'dealCount',
            'missedCount',
            'allCount',
            'childBuckets',
            'owners',
            'allTags',
            'categorys',
            'sources'
        ));
    }

    public function markDone(Request $request, CallBack $followup)
    {
        abort_unless(auth()->check(), 401);
        $followup->loadMissing('lead');
        if (auth()->user()->role_id == 3 && optional($followup->lead)->lead_owner != auth()->id()) {
            abort(403, 'You are not allowed to update this follow-up.');
        }
        $followup->update(['is_done' => 1]);

        return response()->json(['status' => true, 'message' => 'Follow-up marked as done successfully']);
    }

    public function reschedule(Request $request, CallBack $followup)
    {
        abort_unless(auth()->check(), 401);
        $followup->loadMissing('lead');
        if (auth()->user()->role_id == 3 && optional($followup->lead)->lead_owner != auth()->id()) {
            abort(403, 'You are not allowed to update this follow-up.');
        }
        $data = $request->validate([
            'next_followup_date' => 'required|date',
            'message' => 'nullable|string|max:1000',
        ]);

        $nextFollowup = $followup->replicate();
        $nextFollowup->next_followup_date = Carbon::parse($data['next_followup_date']);
        $nextFollowup->message = $data['message'] ?: $followup->message;
        $nextFollowup->is_done = 0;
        $nextFollowup->created_at = now();
        $nextFollowup->updated_at = now();
        $nextFollowup->save();

        $followup->update(['is_done' => 1]);

        return response()->json(['status' => true, 'message' => 'Next follow-up scheduled successfully']);
    }

    public function convertToDeal(Request $request, CallBack $followup)
    {
        abort_unless(auth()->check(), 401);
        $followup->loadMissing('lead');
        $lead = $followup->lead;
        abort_unless($lead, 404, 'Lead not found.');

        if (auth()->user()->role_id == 3 && $lead->lead_owner != auth()->id()) {
            abort(403, 'You are not allowed to convert this lead.');
        }

        DB::transaction(function () use ($lead) {
            $dealBucket = Bucket::where('is_deleted', 0)
                ->where('type', 'order')
                ->whereRaw('LOWER(TRIM(name)) LIKE ?', ['%deal created%'])
                ->first() ?? Bucket::where('is_deleted', 0)->where('type', 'order')->orderBy('id')->first();

            $dealStatus = $dealBucket?->name ?? 'Deal Created';
            $lead->update([
                'is_converted' => 1,
                'lead_status' => $dealStatus,
                'lead_bucket_id' => $dealBucket?->id ?? $lead->lead_bucket_id,
            ]);

            Order::updateOrCreate(
                ['lead_id' => $lead->id],
                [
                    'order_number' => 'ORD-' . (10000 + $lead->id),
                    'uid' => $lead->uid,
                    'order_bucket_id' => $dealBucket?->id ?? $lead->lead_bucket_id,
                    'order_status' => $dealStatus,
                    'order_engagement_status' => $lead->lead_engagement_status ?? 'hot',
                    'order_owner' => $lead->lead_owner,
                    'converted_by' => auth()->id(),
                    'category_id' => $lead->category_id,
                    'product' => $lead->product,
                    'services' => is_array($lead->services) ? $lead->services : (json_decode($lead->services, true) ?? null),
                    'pain_points' => $lead->pain_points,
                    'client_details' => is_array($lead->client_details) ? $lead->client_details : (json_decode($lead->client_details, true) ?? null),
                    'documents' => is_array($lead->documents) ? $lead->documents : (json_decode($lead->documents, true) ?? null),
                    'converted_at' => now(),
                ]
            );
        });

        return response()->json(['status' => true, 'message' => 'Lead converted to deal successfully']);
    }
}
