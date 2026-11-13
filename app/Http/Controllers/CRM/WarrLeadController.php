<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WarrLead;

class WarrLeadController extends Controller
{
    public function index(Request $request)
    {
        // Total count (without filters)
        $totalLeadsCount = WarrLead::count();

        // Dropdown options
        $sources = WarrLead::query()->whereNotNull('source')->where('source', '!=', '')
            ->distinct()->orderBy('source')->pluck('source');

        $page_url = WarrLead::query()->whereNotNull('page_url')->where('page_url', '!=', '')
            ->distinct()->orderBy('page_url')->pluck('page_url');

        $statuses = WarrLead::query()->whereNotNull('status')->where('status', '!=', '')
            ->distinct()->orderBy('status')->pluck('status');

        // Build filtered query
        $query = WarrLead::query()->latest();

        // Search: name/email/mobile/company
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile_no', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Date range (created_at)
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        // Source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Status
        if ($request->filled('status')) {
            $statusVal = strtolower(trim($request->status));
            if ($statusVal === 'hold') {
                $query->whereIn('status', ['hold', 'dead']);
            } else {
                $query->where('status', $request->status);
            }
        }

        // Status counts for top metric cards
        $newCount = WarrLead::where(function($q) {
            $q->where('status', 'new')->orWhereNull('status')->orWhere('status', '');
        })->count();
        $holdCount = WarrLead::where('status', 'hold')->count();
        $deadCount = WarrLead::where('status', 'dead')->count();
        $holdTotalCount = WarrLead::whereIn('status', ['hold', 'dead'])->count();
        $executedCount = WarrLead::where('status', 'executed')->count();

        // Pagination + keep query string
        $perPage = (int) $request->input('per_page', 15);
        $leads = $query->paginate($perPage)->withQueryString();

        // Filtered count (after filters)
        $filteredLeadCount = $leads->total();

        return view('crm.warr-leads.index', compact(
            'leads',
            'sources',
            'page_url',
            'statuses',
            'totalLeadsCount',
            'filteredLeadCount',
            'newCount',
            'holdCount',
            'deadCount',
            'holdTotalCount',
            'executedCount'
        ));
    }

    public function update(Request $request, WarrLead $lead)
    {
        $request->validate([
            'status' => 'sometimes|nullable|in:new,hold,executed,dead',
            'comment' => 'sometimes|nullable|string|max:2000',
        ]);

        if ($request->has('status')) {
            $lead->status = $request->status;
        }
        if ($request->has('comment')) {
            $lead->comment = $request->comment;
        }

        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Lead updated successfully',
            'data' => $lead,
        ]);
    }
}
