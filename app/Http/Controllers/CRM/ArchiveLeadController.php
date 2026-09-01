<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\LeadSource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArchiveLeadController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(auth()->check(), 401);

        $query = Leads::with([
            'user:id,name,email,contact_no,city,state,pincode,address',
            'owner:id,name,email',
            'bucket:id,name,bucket_color,parent_id',
            'category',
            'latestMessage.user:id,name',
            'tags:id,name,color',
        ])
        ->where('is_archived', 1)
        ->where(function ($q) {
            $q->whereNull('is_converted')->orWhere('is_converted', 0);
        });

        if (auth()->user()->role_id == 3) {
            $query->where('lead_owner', auth()->id());
        }

        // Search Filter
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
            })->pluck('id')->toArray();

            $query->where(function ($q) use ($searchUserIds, $search) {
                if (!empty($searchUserIds)) {
                    $q->whereIn('uid', $searchUserIds);
                } else {
                    $q->where('business_name', 'like', "%{$search}%");
                }
            });
        }

        // Date Filters
        if ($request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to = Carbon::parse($request->to)->endOfDay();
            $query->whereBetween('date', [$from, $to]);
        } elseif ($request->filled('from')) {
            $query->whereDate('date', Carbon::parse($request->from)->toDateString());
        }

        if ($request->filled('source')) {
            $query->where('platform', 'like', "%{$request->source}%");
        }

        if ($request->filled('owner_id')) {
            if ($request->owner_id === 'null') {
                $query->whereNull('lead_owner');
            } else {
                $query->where('lead_owner', $request->owner_id);
            }
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
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

        $perPage = request('per_page', 20);
        $leads = $query->orderBy('updated_at', 'desc')->paginate($perPage)->appends($request->query());
        $filteredLeadCount = $leads->total();
        $totalLeadsCount = Leads::where('is_archived', 1)->where(function($q) {
            $q->whereNull('is_converted')->orWhere('is_converted', 0);
        })->when(auth()->user()->role_id == 3, fn($q) => $q->where('lead_owner', auth()->id()))->count();

        $owners = User::whereIn('role_id', [1, 3])->where('is_deleted', 0)->select('id', 'name', 'email')->get();
        $categories = Category::where('is_active', 1)->orderBy('category_name')->get();
        $sources = LeadSource::where('is_active', 1)->pluck('source_name')->toArray();
        $allTags = Tag::where('is_active', true)->orderBy('name')->get();
        $childBuckets = collect();
        $isArchiveView = true;
        $isDealView = false;
        $categorys = $categories;
        $systemTotalLeadsCount = $totalLeadsCount;
        $allBucketsWithChildren = collect();

        return view('crm.archive.leads', compact(
            'leads',
            'owners',
            'categories',
            'categorys',
            'sources',
            'totalLeadsCount',
            'systemTotalLeadsCount',
            'filteredLeadCount',
            'allTags',
            'childBuckets',
            'allBucketsWithChildren',
            'isArchiveView',
            'isDealView'
        ));
    }

    public function archive(Request $request, $id)
    {
        abort_unless(auth()->check(), 401);
        $lead = Leads::findOrFail($id);
        if (auth()->user()->role_id == 3 && $lead->lead_owner != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Permission denied'], 403);
        }

        $lead->update(['is_archived' => 1]);
        Order::where('lead_id', $lead->id)->update(['is_archived' => 1]);

        return response()->json([
            'status' => true,
            'message' => 'Lead moved to archive successfully',
        ]);
    }

    public function bulkArchive(Request $request)
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

        $validIds = $query->pluck('id')->toArray();
        Leads::whereIn('id', $validIds)->update(['is_archived' => 1]);
        Order::whereIn('lead_id', $validIds)->update(['is_archived' => 1]);

        return response()->json([
            'status' => true,
            'message' => count($validIds) . ' lead(s) moved to archive successfully',
            'count' => count($validIds),
        ]);
    }

    public function restore(Request $request, $id)
    {
        abort_unless(auth()->check(), 401);
        $lead = Leads::findOrFail($id);
        if (auth()->user()->role_id == 3 && $lead->lead_owner != auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Permission denied'], 403);
        }

        $lead->update(['is_archived' => 0]);
        Order::where('lead_id', $lead->id)->update(['is_archived' => 0]);

        return response()->json([
            'status' => true,
            'message' => 'Lead restored successfully',
        ]);
    }

    public function bulkRestore(Request $request)
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

        $validIds = $query->pluck('id')->toArray();
        Leads::whereIn('id', $validIds)->update(['is_archived' => 0]);
        Order::whereIn('lead_id', $validIds)->update(['is_archived' => 0]);

        return response()->json([
            'status' => true,
            'message' => count($validIds) . ' lead(s) restored successfully',
            'count' => count($validIds),
        ]);
    }

    public function bulkDelete(Request $request)
    {
        abort_unless(auth()->check(), 401);
        if (auth()->user()->role_id == 3) {
            return response()->json(['status' => false, 'message' => 'Only admins can permanently delete leads'], 403);
        }

        $rawIds = $request->input('ids', []);
        $ids = is_array($rawIds) ? $rawIds : (is_string($rawIds) ? explode(',', $rawIds) : []);
        $ids = array_filter(array_map('intval', $ids));

        if (empty($ids)) {
            return response()->json(['status' => false, 'message' => 'No leads selected'], 400);
        }

        DB::transaction(function () use ($ids) {
            DB::table('taggables')->where('taggable_type', Leads::class)->whereIn('taggable_id', $ids)->delete();
            DB::table('callbacks')->whereIn('lead_id', $ids)->delete();
            DB::table('lead_histories')->whereIn('lead_id', $ids)->delete();
            Order::whereIn('lead_id', $ids)->delete();
            Leads::whereIn('id', $ids)->delete();
        });

        return response()->json([
            'status' => true,
            'message' => count($ids) . ' lead(s) permanently deleted',
        ]);
    }
}
