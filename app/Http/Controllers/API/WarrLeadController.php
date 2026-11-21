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
            'page_url' => 'nullable|string|max:2048',
            'interested_services' => 'nullable',
            'intrested_services' => 'nullable',
            'monthly_spend' => 'nullable|string|max:255',
            'growth_goal' => 'nullable|string',
        ]);

        $phone = $request->input('phone_number')
            ?? $request->input('phone')
            ?? $request->input('mobile_no');

        // Resolve landing page / website URL where the ad actually brought the visitor
        $pageUrl = $request->input('page_url');
        $rawWebsite = $request->input('website_url') ?? $request->input('website');
        $growthGoal = $request->input('growth_goal') ?? $request->input('goal') ?? $request->input('message');

        // Check if page_url is present in request or in growth_goal
        $finalWebsiteUrl = null;
        if (!empty($pageUrl) && filter_var($pageUrl, FILTER_VALIDATE_URL) && str_contains(strtolower($pageUrl), 'warrgyizmorsch')) {
            $finalWebsiteUrl = trim($pageUrl);
        } elseif (!empty($rawWebsite) && str_contains(strtolower($rawWebsite), 'warrgyizmorsch')) {
            $finalWebsiteUrl = trim($rawWebsite);
        } elseif (!empty($growthGoal) && preg_match('/Page URL:\s*(https?:\/\/[^\s\|]+)/i', $growthGoal, $matches)) {
            $finalWebsiteUrl = trim($matches[1]);
        } elseif ($request->header('referer') && str_contains(strtolower($request->header('referer')), 'warrgyizmorsch')) {
            $finalWebsiteUrl = trim($request->header('referer'));
        } else {
            // Default to official WarrgyizMorsch ad landing URL
            $finalWebsiteUrl = 'https://www.warrgyizmorsch.co.uk/';
        }

        // Clean local/dev URLs if any
        if (str_contains($finalWebsiteUrl, 'localhost') || str_contains($finalWebsiteUrl, '127.0.0.1') || str_contains($finalWebsiteUrl, 'devtunnels')) {
            $finalWebsiteUrl = 'https://www.warrgyizmorsch.co.uk/';
        }

        // If client provided their own company website and it's not Warrgyizmorsch, append to growth_goal for reference
        if (!empty($rawWebsite) && !str_contains(strtolower($rawWebsite), 'warrgyizmorsch') && !str_contains($growthGoal ?? '', $rawWebsite)) {
            $growthGoal = trim(($growthGoal ? $growthGoal . ' | ' : '') . 'Client Company Website: ' . $rawWebsite);
        }

        $servicesRaw = $request->input('interested_services')
            ?? $request->input('intrested_services')
            ?? $request->input('services');

        $interestedServices = is_array($servicesRaw)
            ? implode(', ', array_filter($servicesRaw))
            : (is_string($servicesRaw) ? trim($servicesRaw) : null);

        $monthlySpend = $request->input('monthly_spend')
            ?? $request->input('spend')
            ?? $request->input('budget');

        $seoLead = SeoLead::create([
            'name' => trim($request->input('name')),
            'email' => trim($request->input('email')),
            'phone_number' => $phone ? trim($phone) : null,
            'website_url' => $finalWebsiteUrl,
            'interested_services' => $interestedServices,
            'monthly_spend' => $monthlySpend ? trim($monthlySpend) : null,
            'growth_goal' => $growthGoal ? trim($growthGoal) : null,
            'status' => 'new',
            'is_converted' => false,
        ]);
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ads lead saved successfully',
            'data' => $seoLead,
        ], 201);
    }
}
