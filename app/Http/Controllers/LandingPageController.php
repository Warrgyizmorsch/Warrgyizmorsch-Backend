<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class LandingPageController extends Controller
{
    public function studyAbroadConsultantV1(Request $request)
    {        
        return view('landing-page-study-abroad-v1');
    }
    /**
     * Submit form → create lead (verified_lead = 0)
     */
    public function submitLead(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^\+91[6-9]\d{9}$/',
            'preferredCountry' => 'required|string',
            'preferredIntake' => 'required|string',
            'highestLevelEducation' => 'required|string',
            'city' => 'required|string',
        ]);

        $fullPhone = $request->phone;
        $mainPhone = preg_replace('/\D/', '', substr($fullPhone, 3)); // remove +91
        $countryCode = '+91';

        // === 1. FIND USER BY EMAIL + PHONE ===
        $user = User::where('email', $request->email)
            ->where('contact_no', $mainPhone)
            ->first();
        if (!$user) {
            // === 2. CHECK IF EMAIL IS USED WITH DIFFERENT PHONE ===
            $existingEmailUser = User::where('email', $request->email)->first();
            if ($existingEmailUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered with a different phone number.',
                ], 422);
            }

            // === 3. CHECK IF PHONE IS USED WITH DIFFERENT EMAIL ===
            $existingPhoneUser = User::where('contact_no', $mainPhone)->first();
            if ($existingPhoneUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This phone number is already registered with a different email.',
                ], 422);
            }

            // === 4. CREATE NEW USER ===
            
            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact_no' => $mainPhone,
                    'country_code' => $countryCode,
                    'city' => $request->city,
                    'role_id' => 2,
                    'password' => Hash::make('user@123'),
                ]);
            }  catch (\Illuminate\Database\QueryException $e) {

                if ($e->getCode() == 23000) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email or phone already exists. Please use a different one.',
                    ], 422);
                }

                throw $e;
            }
        }

        // Example: Assign default bucket "New Leads"
        $defaultBucketId = 1; // your lead bucket ID

        // Example: Assign default status bucket
        $defaultStatus = \DB::table('buckets')
                            ->where('id', 2)   // your status bucket
                            ->value('name');

        // Create lead with verified_lead = 0        
        $lead = Leads::create([
            'lead_bucket_id' => $defaultBucketId,
            'lead_status' => $defaultStatus,
            'lead_owner' => null,
            'date' => now()->format('Y-m-d'),
            
            // UTM SAFE HANDLING
            'campaign_name'  => $request->input('utm_campaign', ''),
            'adset_name'     => $request->input('utm_medium', ''),
            'ad_name'        => $request->input('utm_term', ''),
            'form_name'      => $request->input('utm_source', ''),
            'platform' => 'Website',
            'page_url' => $request->page_url ?? null,
            'whats_your_preferred_intake' => $request->preferredIntake,
            'highest_completed' => $request->highestLevelEducation,
            'any_academic_gap' => null,
            'budget' => null,
            'applying_country_for_a_visa' => $request->preferredCountry,
            'uid' => $user->id,
            'verified_lead' => false, // Not verified yet
        ]);

        // Store lead ID in session for OTP step
        Session::put('pending_lead_id', $lead->id);

        return response()->json([
            'success' => true,
            'show_otp_step' => true,
            'lead_id' => $lead->id,
        ]);
    }

    /**
     * Send OTP via Aisensy WhatsApp
     */
    public function sendOtp(Request $request)
    {
        $phone = ltrim($request->phone, '+');
        $leadId = $request->lead_id ?? Session::get('pending_lead_id');

        $otp = rand(100000, 999999);
        $otpString = (string) $otp;

        // Store in session
        Session::put('otp', $otpString);
        Session::put('otp_phone', $phone);
        Session::put('otp_lead_id', $leadId);
        Session::put('otp_created_at', now());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AISENSY_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', [
            "apiKey" => env('AISENSY_API_KEY'),
            "campaignName" => env('AISENSY_CAMPAIGN'),
            "destination" => $phone,
            "userName" => env('AISENSY_USERNAME'),
            "templateParams" => [$otpString],
            "buttons" => [
                [
                    "type" => "button",
                    "sub_type" => "url",
                    "index" => 0,
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => $otpString
                        ]
                    ]
                ]
            ],
            "source" => "landing-page-otp"
        ]);

        if ($response->successful()) {
            \Log::info('Aisensy OTP Sent', ['phone' => $phone, 'otp' => $otpString]);
            return response()->json(['success' => true, 'message' => 'OTP sent to WhatsApp!']);
        }

        \Log::error('Aisensy OTP Failed', $response->json());
        return response()->json(['success' => false, 'message' => 'Failed to send OTP'], 500);
    }

    /**
     * Verify OTP → set verified_lead = 1
     */
    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        $phone = ltrim($request->phone, '+');
        $createdAt = Session::get('otp_created_at');

        // Check expiry (5 mins)
        if ($createdAt && now()->diffInMinutes($createdAt) > 5) {
            Session::forget(['otp', 'otp_phone', 'otp_lead_id', 'otp_created_at']);
            return response()->json(['success' => false, 'message' => 'OTP expired. Please request a new one.']);
        }

        // Validate OTP
        if (Session::get('otp') === $otp && Session::get('otp_phone') === $phone) {
            $leadId = Session::get('otp_lead_id');            

            // === ALL GOOD → VERIFY LEAD ===
            if ($leadId) {
                Leads::where('id', $leadId)->update(['verified_lead' => true]);
            }

            Session::forget(['otp', 'otp_phone', 'otp_lead_id', 'otp_created_at', 'pending_lead_id']);
            
            Session::put('visa_form_submitted', true);

            return response()->json(['success' => true, 'message' => 'Phone verified successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
    }
}