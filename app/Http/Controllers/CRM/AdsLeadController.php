<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoLead;
use App\Models\Leads;
use App\Models\User;
use App\Models\Bucket;
use App\Models\LeadHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdsLeadController extends Controller
{
    /**
     * Display a listing of Ads Leads.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'active'); // 'active' or 'converted'

        $totalActiveCount = SeoLead::where('is_converted', false)->count();
        $totalConvertedCount = SeoLead::where('is_converted', true)->count();

        $query = SeoLead::query()->latest();

        if ($tab === 'converted') {
            $query->where('is_converted', true);
        } else {
            // Default: only unconverted active leads so converted ones disappear from this list
            $query->where('is_converted', false);
        }

        // Search: name, email, phone, website
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('website_url', 'like', "%{$search}%")
                  ->orWhere('interested_services', 'like', "%{$search}%");
            });
        }

        // Date range
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $leads = $query->paginate(15)->withQueryString();
        $filteredCount = $leads->total();

        return view('crm.ads-leads.index', compact(
            'leads',
            'tab',
            'totalActiveCount',
            'totalConvertedCount',
            'filteredCount'
        ));
    }

    /**
     * Convert an Ads Lead to a normal CRM Lead and remove it from active list.
     */
    public function sendToLead(Request $request, $id)
    {
        $seoLead = SeoLead::findOrFail($id);

        if ($seoLead->is_converted) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This lead has already been sent to CRM Leads.',
                ], 422);
            }
            return redirect()->back()->with('error', 'This lead has already been sent to CRM Leads.');
        }

        // 1. Find or create the User
        $user = null;
        if (!empty($seoLead->phone_number)) {
            $user = User::where('contact_no', $seoLead->phone_number)->first();
        }
        if (!$user && !empty($seoLead->email)) {
            $user = User::where('email', $seoLead->email)->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $seoLead->name,
                'email' => !empty($seoLead->email) ? $seoLead->email : ('lead_' . time() . '@crm.com'),
                'contact_no' => $seoLead->phone_number,
                'role_id' => 2,
                'password' => Hash::make('user@123'),
            ]);
        }

        // 2. Determine default lead bucket & status
        $defaultBucketId = Bucket::whereNull('parent_id')
            ->where('is_deleted', 0)
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%lead%')
                  ->orWhere('id', 1);
            })
            ->value('id') ?? 1;

        $defaultSubStatus = Bucket::where('parent_id', $defaultBucketId)
            ->where('is_deleted', 0)
            ->where(function ($q) {
                $q->where('name', 'LIKE', '%Yet to Call%')
                  ->orWhere('name', 'Yet to Call');
            })
            ->value('name')
            ?? Bucket::where('parent_id', $defaultBucketId)->where('is_deleted', 0)->value('name')
            ?? 'Yet to Call';

        $leadBucketName = Bucket::where('id', $defaultBucketId)->value('name') ?? 'Lead';

        // 3. Prepare Lead Data
        $leadData = [
            'uid' => $user->id,
            'platform' => 'Ads',
            'website' => $seoLead->website_url,
            'budget' => $seoLead->monthly_spend,
            'services' => !empty($seoLead->interested_services) ? [$seoLead->interested_services] : null,
            'description' => "Growth Goal: " . ($seoLead->growth_goal ?? 'N/A') . "\nInterested Services: " . ($seoLead->interested_services ?? 'N/A'),
            'date' => now()->toDateString(),
            'lead_bucket_id' => $defaultBucketId,
            'lead_status' => $defaultSubStatus,
            'lead_bucket_name' => $leadBucketName,
            'is_converted' => 0,
            'is_archived' => 0,
        ];

        // Filter valid columns in leads table
        $tableColumns = Schema::getColumnListing('leads');
        if (!empty($tableColumns)) {
            $leadData = array_intersect_key($leadData, array_flip($tableColumns));
        }

        $lead = Leads::create($leadData);

        // 4. Log Lead History
        try {
            LeadHistory::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id() ?? 1,
                'action' => 'created',
                'changes' => [
                    'source' => 'Converted from Ads Lead #' . $seoLead->id,
                    'created_data' => $leadData,
                ],
            ]);
        } catch (\Exception $e) {
            // Non-blocking history log
        }

        // 5. Mark SeoLead as converted so it disappears from the active list
        $seoLead->is_converted = true;
        $seoLead->status = 'converted';
        $seoLead->converted_lead_id = $lead->id;
        $seoLead->converted_at = now();
        $seoLead->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead successfully sent to CRM Leads!',
                'lead_id' => $lead->id,
            ]);
        }

        return redirect()->back()->with('success', 'Lead successfully sent to CRM Leads (Lead ID: #' . $lead->id . ')!');
    }

    /**
     * Delete an Ads Lead.
     */
    public function destroy($id)
    {
        $seoLead = SeoLead::findOrFail($id);
        $seoLead->delete();

        return redirect()->back()->with('success', 'Ads lead deleted successfully.');
    }
}
