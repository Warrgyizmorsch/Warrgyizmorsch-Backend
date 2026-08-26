<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CallBack;
use App\Models\Leads;
use App\Models\Bucket;
use App\Models\User;
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

        $tab = $request->get('tab', 'all'); // 'all', 'next', 'due'
        $today = Carbon::today();

        // Base Query for CallBack / callback_messages with Lead and User relations
        $query = CallBack::with([
            'user:id,name',
            'lead' => function ($q) {
                $q->with([
                    'user:id,name,email,contact_no,city,state,pincode,address',
                    'owner:id,name,email',
                    'bucket:id,name,bucket_color,parent_id',
                ]);
            }
        ])->whereHas('lead');

        // Role 3 restriction (Sales executive sees only their assigned leads)
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->whereHas('lead', function ($q) {
                $q->where('lead_owner', auth()->id());
            });
        }

        // Apply Tab Filter
        if ($tab === 'next') {
            $query->whereNotNull('next_followup_date')
                  ->where('next_followup_date', '>=', $today);
        } elseif ($tab === 'due') {
            $query->whereNotNull('next_followup_date')
                  ->where('next_followup_date', '<', $today);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('message', 'like', "%{$search}%")
                  ->orWhere('followup_type', 'like', "%{$search}%")
                  ->orWhere('followup_status', 'like', "%{$search}%")
                  ->orWhereHas('lead.user', function ($uQ) use ($search) {
                      $uQ->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('contact_no', 'like', "%{$search}%");
                  })
                  ->orWhereHas('lead', function ($lQ) use ($search) {
                      $lQ->where('business_name', 'like', "%{$search}%");
                  });
            });
        }

        // Date Filter on Followup Created Date
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        // Calculate Counts for all 3 Tabs
        $baseCountQuery = CallBack::whereHas('lead');
        if (auth()->check() && auth()->user()->role_id == 3) {
            $baseCountQuery->whereHas('lead', function ($q) {
                $q->where('lead_owner', auth()->id());
            });
        }

        $allCount = (clone $baseCountQuery)->count();
        $nextCount = (clone $baseCountQuery)->whereNotNull('next_followup_date')->where('next_followup_date', '>=', $today)->count();
        $dueCount = (clone $baseCountQuery)->whereNotNull('next_followup_date')->where('next_followup_date', '<', $today)->count();

        // Pagination
        $perPage = (int) $request->get('per_page', 20);
        $perPage = in_array($perPage, [20, 50, 100, 250, 500]) ? $perPage : 20;

        $followups = $query->orderBy('created_at', 'desc')->paginate($perPage);

        // Fetch Buckets and Owners for Offcanvas actions
        $childBuckets = Bucket::with('children')
            ->whereNull('parent_id')
            ->where('is_deleted', 0)
            ->get();

        $owners = User::whereIn('role_id', [1, 3])
            ->where('is_deleted', 0)
            ->select('id', 'name', 'email')
            ->get();

        return view('crm.lead.followups', compact(
            'followups',
            'tab',
            'allCount',
            'nextCount',
            'dueCount',
            'childBuckets',
            'owners'
        ));
    }
}
