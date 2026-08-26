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
        ]);

        // 2. Role-based restrictions (Role 3 sees only assigned leads)
        if (auth()->check() && auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // 3. Filter ONLY "Deal Created" leads
        $query->where(function ($q) {
            $q->where(DB::raw('LOWER(TRIM(COALESCE(lead_status, "")))'), 'like', '%deal created%')
              ->orWhereHas('bucket', function ($bQ) {
                  $bQ->where(DB::raw('LOWER(TRIM(COALESCE(name, "")))'), 'like', '%deal created%');
              });
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

        // Clone query for total count calculation
        $countQuery = clone $query;
        $totalDealsCount = $countQuery->count();

        // 5. Sorting & Pagination
        $perPage = (int) $request->get('per_page', 20);
        $perPage = in_array($perPage, [20, 50, 100, 250, 500]) ? $perPage : 20;

        $leads = $query->orderBy('created_at', 'desc')->paginate($perPage);

        // Fetch parent/child buckets for offcanvas status change
        $childBuckets = Bucket::with('children')
            ->whereNull('parent_id')
            ->where('is_deleted', 0)
            ->get();

        $owners = User::whereIn('role_id', [1, 3])
            ->where('is_deleted', 0)
            ->select('id', 'name', 'email')
            ->get();

        return view('crm.lead.created_deals', compact(
            'leads',
            'childBuckets',
            'owners',
            'totalDealsCount'
        ));
    }
}
