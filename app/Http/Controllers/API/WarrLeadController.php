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
            'name' => 'nullable|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'fullName' => 'nullable|string|max:255',
            'your_name' => 'nullable|string|max:255',
            'yourName' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'work_email' => 'nullable|email|max:255',
            'workEmail' => 'nullable|email|max:255',
            'business_email' => 'nullable|email|max:255',
            'businessEmail' => 'nullable|email|max:255',
            'mobile_no' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'phone_number' => 'nullable|string|max:50',
            'phoneNumber' => 'nullable|string|max:50',
            'country_code' => 'nullable|string|max:10',
            'phone_country_code' => 'nullable|string|max:10',
            'designation' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'service_categories' => 'nullable',
            'what_do_you_need' => 'nullable',
            'current_website' => 'nullable|string|max:2048',
            'budget' => 'nullable|string|max:255',
            'ideal_launch_date' => 'nullable|string|max:255',
            'launch_date' => 'nullable|string|max:255',
            'biggest_manufacturing_challenge' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'message' => 'nullable|string',
            'comment' => 'nullable|string',
            'form_type' => 'nullable|string|max:100',
            'page_url' => 'nullable|string|max:2048',
            'source_url' => 'nullable|string|max:2048',
        ]);

        $pageUrl = $validated['source_url']
            ?? $validated['page_url']
            ?? $request->headers->get('referer');
        $phone = $validated['mobile_no']
            ?? $validated['phone_number']
            ?? $validated['phone']
            ?? $validated['phoneNumber']
            ?? null;
        $countryCode = $validated['country_code']
            ?? $validated['phone_country_code']
            ?? null;

        if ($phone && $countryCode) {
            $phone = trim($countryCode . ' ' . $phone);
        }

        $serviceCategories = $validated['service_categories']
            ?? $validated['what_do_you_need']
            ?? $validated['biggest_manufacturing_challenge']
            ?? null;
        if (\is_array($serviceCategories)) {
            $serviceCategories = implode(', ', array_filter($serviceCategories, '\is_scalar'));
        }

        $source = 'Website';

        if ($pageUrl && str_contains($pageUrl, '/lp')) {
            $source = 'Landing page';
        }

        $formType = $validated['form_type'] ?? $this->inferFormType($request->all(), $pageUrl);
        $formDetails = $request->except(['_token', 'form_type', 'page_url', 'source_url']);
        $message = $validated['message'] ?? $validated['requirements'] ?? null;

        $lead = WarrLead::create([
            'name' => $validated['name']
                ?? $validated['full_name']
                ?? $validated['fullName']
                ?? $validated['your_name']
                ?? $validated['yourName']
                ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'email' => $validated['email']
                ?? $validated['work_email']
                ?? $validated['workEmail']
                ?? $validated['business_email']
                ?? $validated['businessEmail']
                ?? null,
            'mobile_no' => $phone,
            'designation' => $validated['designation'] ?? null,
            'company_size' => $validated['company_size'] ?? null,
            'service_categories' => \is_scalar($serviceCategories) ? $serviceCategories : null,
            'message' => $message,
            'comment' => $validated['comment'] ?? null,
            'source' => $source,
            'page_url' => $pageUrl,
            'form_type' => $formType,
            'form_details' => $formDetails,
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lead submitted successfully',
            'data' => $lead
        ], 201);
    }

    private function inferFormType(array $input, ?string $pageUrl): ?string
    {
        if (isset($input['biggest_manufacturing_challenge']) || isset($input['requirements'])) {
            return 'erp_consultation';
        }

        if (isset($input['current_website']) || isset($input['budget']) || isset($input['ideal_launch_date'])) {
            return 'website_quote';
        }

        $path = strtolower((string) parse_url($pageUrl ?? '', PHP_URL_PATH));
        if (str_contains($path, 'erp') || str_contains($path, 'consultation')) {
            return 'erp_consultation';
        }
        if (str_contains($path, 'website-development')) {
            return 'website_quote';
        }

        if (isset($input['what_do_you_need']) || isset($input['message'])) {
            return 'schedule_call';
        }

        return null;
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
