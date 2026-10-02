<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WarrLead;

use App\Models\SeoLead;

class WarrLeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_no' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',

            // ✅ new fields (rules must be strings, NOT values)
            'company_size' => 'nullable|string|max:255',
            'service_categories' => 'nullable|string',
            'comment' => 'nullable|string',
            'page_url' => 'nullable|string|max:2048',

            'message' => 'nullable|string',
        ]);

        $source = 'Website';

        if (!empty($validated['page_url']) && str_contains($validated['page_url'], '/lp')) {
            $source = 'Landing page';
        }

        $lead = WarrLead::create(array_merge(
            $validated,
            [
                'source' => $source,
                'status' => 'new'
            ]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Lead submitted successfully',
            'data' => $lead
        ], 201);
    }

    public function adsLead(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'mobile_no' => 'nullable|string|max:50',
            'website_url' => 'nullable|string|max:2048',
            'website' => 'nullable|string|max:2048',
            'interested_services' => 'nullable',
            'intrested_services' => 'nullable',
            'monthly_spend' => 'nullable|string|max:255',
            'growth_goal' => 'nullable|string',
        ]);

        $phone = $request->input('phone_number')
            ?? $request->input('phone')
            ?? $request->input('mobile_no');

        $website = $request->input('website_url')
            ?? $request->input('website');

        $servicesRaw = $request->input('interested_services')
            ?? $request->input('intrested_services')
            ?? $request->input('services');

        $interestedServices = is_array($servicesRaw)
            ? implode(', ', array_filter($servicesRaw))
            : (is_string($servicesRaw) ? trim($servicesRaw) : null);

        $monthlySpend = $request->input('monthly_spend')
            ?? $request->input('spend')
            ?? $request->input('budget');

        $growthGoal = $request->input('growth_goal')
            ?? $request->input('goal')
            ?? $request->input('message');

        $seoLead = SeoLead::create([
            'name' => trim($request->input('name')),
            'email' => trim($request->input('email')),
            'phone_number' => $phone ? trim($phone) : null,
            'website_url' => $website ? trim($website) : null,
            'interested_services' => $interestedServices,
            'monthly_spend' => $monthlySpend ? trim($monthlySpend) : null,
            'growth_goal' => $growthGoal ? trim($growthGoal) : null,
            'status' => 'new',
            'is_converted' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ads lead saved successfully',
            'data' => $seoLead,
        ], 201);
    }
}
