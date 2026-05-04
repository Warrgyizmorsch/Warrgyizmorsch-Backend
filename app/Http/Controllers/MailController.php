<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VisaAssistanceFormSubmitted; // Import the Mailable class
use App\Mail\ContactFormSubmitted; // Import the Mailable class
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class MailController extends Controller
{
    public function sendOtp(Request $request)
    {
        $phone = $request->phone; // E.g., +919772196309
        $phone = ltrim($phone, '+'); // Remove + prefix for Aisensy

        $otp = rand(100000, 999999);
        $otpString = (string) $otp;

        // Store OTP and timestamp
        Session::put('otp', $otpString);
        Session::put('otp_phone', $phone);
        Session::put('otp_created_at', now());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AISENSY_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', [
            "apiKey" => env('AISENSY_API_KEY'),
            "campaignName" => env('AISENSY_CAMPAIGN'), // e.g., 'user_verification'
            "destination" => $phone, // E.g., 919772196309
            "userName" => env('AISENSY_USERNAME'), // e.g., 'WTS Visa Consultancy'
            "templateParams" => [$otpString],
            "buttons" => [
                [
                    "type" => "button",
                    "sub_type" => "url",
                    "index" => 0,
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => $otpString // <-- this fills {{1}} in button URL
                        ]
                    ]
                ]
            ],
            "source" => "otp-verification"
        ]);

        if ($response->successful()) {
            \Log::info('Aisensy OTP Sent Successfully: ' . $response->body());
            return response()->json(['success' => true, 'message' => 'OTP sent! Check WhatsApp in 5-30 mins.']);
        } else {
            $error = $response->json()['reason'] ?? $response->body();
            \Log::error('Aisensy OTP Error: ' . $error);
            return response()->json(['success' => false, 'message' => 'OTP send failed: ' . $error], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        $phone = ltrim($request->phone, '+'); // Normalize phone
        $createdAt = Session::get('otp_created_at');

        // Expiry check
        if ($createdAt && now()->diffInMinutes($createdAt) > 5) {
            Session::forget(['otp', 'otp_phone', 'otp_created_at']);
            return response()->json(['success' => false, 'message' => 'OTP expired']);
        }

        // Match OTP + Phone
        if (Session::get('otp') === $otp && Session::get('otp_phone') === $phone) {
            Session::forget(['otp', 'otp_phone', 'otp_created_at']);
            return response()->json(['success' => true, 'message' => 'OTP verified!']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP or phone number']);
    }

    public function sendVisaAssistanceEmail(Request $request)
    {
        // Define custom error messages
        $customMessages = [
            'name.required' => 'The name field is mandatory.',
            'phone_number.main.required' => 'Please enter your phone number.',
            'phone_number.main.regex' => 'The phone number must be a 10-digit number.',
            'phone_number.full.required' => 'Please enter your full phone number.',
            'phone_number.full.regex' => 'The full phone number must be in international format.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'visa_country.required' => 'The visa country field is required.',
            'visa_type.required' => 'The visa type is required.',
            'counselling_mode.required' => 'Please select a preferred counselling mode.',
            'tac_check.required' => 'You must agree to the Terms & Conditions.',
            'tac_check.in' => 'You must agree to the Terms & Conditions.',
        ];

        // Validate the incoming request data with custom messages
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
            'phone_number.main' => 'required|string|regex:/^[0-9]{10}$/',
            'phone_number.full' => 'required|string|regex:/^\+[1-9]{1}[0-9]{3,14}$/',
            'email' => 'required|email|max:255',
            'visa_country' => 'required|string|max:255',
            'visa_type' => 'required|string|max:255',
            // 'counselling_mode' => 'required|string|in:Phone,Video,Home',
            // ✅ counselling_mode is only required if visa_type == 'Student Visa'
            'counselling_mode' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->visa_type === 'Student Visa';
                }),
                'string',
                Rule::in(['Phone', 'Video', 'Home']),
            ],
            'tac_check' => 'required|in:on',
        ], $customMessages);

        // Extract the full phone number (e.g., +911234567890)
        $fullPhoneNumber = $validatedData['phone_number']['full'];

        // Extract the main phone number (e.g., 1234567890)
        $mainPhoneNumber = $validatedData['phone_number']['main'];

        // Extract the country code by removing the main phone number part from the full phone number
        $countryCode = str_replace($mainPhoneNumber, '', $fullPhoneNumber);
        
        // Create a new array with the form data
        $formData = [
            'name' => $validatedData['name'],
            'phone_number_main' => $validatedData['phone_number']['main'], // Get the main phone number
            'country_code' => $countryCode,
            'email' => $validatedData['email'],
            'visa_country' => $validatedData['visa_country'],
            'visa_type' => $validatedData['visa_type'],
            
            // 'counselling_mode' => $validatedData['counselling_mode'],
        ];
        // ✅ Only include counselling_mode if it was submitted (in case it's not required)
        if (isset($validatedData['counselling_mode'])) {
            $formData['counselling_mode'] = $validatedData['counselling_mode'];
        }

        Mail::to('vikramsuthar.wm@gmail.com') // Replace with the recipient email address
                ->send(new VisaAssistanceFormSubmitted($formData));
        // try {
        //     // Try sending the email to the recipient
        //     Mail::to('vikramsuthar.wm@gmail.com') // Replace with the recipient email address
        //         ->send(new VisaAssistanceFormSubmitted($formData));

        //     // If successful, return a success message
        //     return back()->with('success', 'Your form has been submitted successfully!');
        // } catch (\Exception $e) {
        //     // If an error occurs, catch the exception and log the error
        //     \Log::error('Email sending failed: ' . $e->getMessage());

        //     // Optionally, you can provide a user-friendly message to the user
        //     return back()->with('error', 'There was an issue sending your email. Please try again later.');
        // }

        Session::put('visa_form_submitted', true);

        return response()->json([
            'success' => true,
            'redirect_url' => route('thankyou')
        ]);
    }
    
    public function contactSubmit(Request $request)
    {
        // Define custom error messages
        $customMessages = [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a valid string.',
            'email.required' => 'The email field is mandatory.',
            'email.email' => 'Please provide a valid email address.',
            'phone_number.main.required' => 'Please enter your phone number.',
            'phone_number.main.regex' => 'The phone number must be a 10-digit number.',
            'phone_number.full.required' => 'Please enter your full phone number.',
            'phone_number.full.regex' => 'The full phone number must be in international format.',
            'message.required' => 'The message field is mandatory.',
            'message.string' => 'The message must be a valid string.',
            'tac_check.required' => 'You must agree to the Terms & Conditions.',
            'tac_check.in' => 'You must agree to the Terms & Conditions.',
        ];

        // Validate the incoming request data with custom messages
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|max:255',
            'phone_number.main' => 'required|string|regex:/^\d{10}$/', // 10-digit phone number validation
            'phone_number.full' => 'required|string|regex:/^\+[1-9]{1}[0-9]{3,14}$/', // Full phone number validation (international format)
            'message' => 'required|string|max:500',
            'tac_check' => 'required|in:on',
        ], $customMessages);

        // Extract the full phone number (e.g., +911234567890)
        $fullPhoneNumber = $validatedData['phone_number']['full'];

        // Extract the main phone number (e.g., 1234567890)
        $mainPhoneNumber = $validatedData['phone_number']['main'];

        // Extract the country code by removing the main phone number part from the full phone number
        $countryCode = str_replace($mainPhoneNumber, '', $fullPhoneNumber);
        
         $user = User::where('email', $request->email)
            ->where('contact_no', $mainPhoneNumber)
            ->first();

        if (!$user) {
            
            $existingEmailUser = User::where('email', $request->email)->first();
            if ($existingEmailUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered with a different phone number.',
                ], 422);
            }

            
            $existingPhoneUser = User::where('contact_no', $mainPhoneNumber)->first();
            if ($existingPhoneUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'This phone number is already registered with a different email.',
                ], 422);
            }

            
            try {
                $user = User::create([
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'contact_no'   => $mainPhoneNumber,
                    'country_code' => $countryCode,
                    'role_id'      => 2,
                    'password'     => Hash::make('user@123'),
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                if ($e->getCode() == 23000) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email or phone already exists. Please use a different one.',
                    ], 422);
                }
                throw $e;
            }
        }

    
        $defaultBucketId = 1;

        $defaultStatus = \DB::table('buckets')
            ->where('id', 2)
            ->value('name');

        Leads::create([
            'lead_bucket_id' => $defaultBucketId,
            'lead_status'    => $defaultStatus,
            'lead_owner'     => null,
            'date'           => now()->format('Y-m-d'),
            'platform'       => 'Website',
            'page_url'       => $request->page_url ?? null,
            'description'        => $request->message,
            'uid'            => $user->id,
        ]);

        // Create a new array with the form data
        $formData = [
            'name' => $validatedData['name'],
            'phone_number_main' => $validatedData['phone_number']['main'], // Get the main phone number
            'country_code' => $countryCode,
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ];
        try {
            // Try sending the email to the recipient
            Mail::to('vikramsuthar.wm@gmail.com') // Replace with the recipient email address
                ->send(new ContactFormSubmitted($formData));

            // If successful, return a success message
            // return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
        } catch (\Exception $e) {
            // If an error occurs, catch the exception and log the error
            \Log::error('Email sending failed: ' . $e->getMessage());

            // Optionally, you can provide a user-friendly message to the user
            return back()->with('error', 'There was an issue sending your email. Please try again later.');
        }

        Session::put('visa_form_submitted', true);

        return response()->json([
            'success' => true,
            'redirect_url' => route('thankyou')
        ]);
        
    }
    public function sendLeadToCrm(Request $request)
    {
        $customMessages = [
            'name.required' => 'The name field is mandatory.',
            'phone_number.main.required' => 'Please enter your phone number.',
            'phone_number.main.regex' => 'The phone number must be a 10-digit number.',
            'phone_number.full.required' => 'Please enter your full phone number.',
            'phone_number.full.regex' => 'The full phone number must be in international format.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'visa_country.required' => 'The visa country field is required.',
            'visa_type.required' => 'The visa type is required.',
            'counselling_mode.required' => 'Please select a preferred counselling mode.',
            'tac_check.required' => 'You must agree to the Terms & Conditions.',
            'tac_check.in' => 'You must agree to the Terms & Conditions.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number.main' => 'required|string|regex:/^[0-9]{10}$/',
            'phone_number.full' => 'required|string|regex:/^\+[1-9]{1}[0-9]{3,14}$/',
            'email' => 'required|email|max:255', // ❌ removed 'unique' rule here
            'visa_country' => 'required|string|max:255',
            'visa_type' => 'required|string|max:255',
            'counselling_mode' => [
                Rule::requiredIf(fn() => $request->visa_type === 'Student Visa'),
                'string',
                Rule::in(['Phone', 'Video', 'Home']),
            ],
            'tac_check' => 'required|in:on',
        ], $customMessages);

        // Extract phone & country code properly
        $fullPhoneNumber = $validatedData['phone_number']['full'];
        $mainPhoneNumber = $validatedData['phone_number']['main'];
        $countryCode = substr(
            $fullPhoneNumber,
            0,
            strlen($fullPhoneNumber) - strlen($mainPhoneNumber)
        );

        // -----------------------------
        // 1. Check if the user already exists
        // -----------------------------
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            // Create new user if not exists
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'contact_no' => $mainPhoneNumber,
                'country_code' => $countryCode,
                'role_id' => 2,
                'password' => Hash::make('user@123'),
            ]);
        } else {
            // Optional: Update user contact info if changed
            $user->update([
                'name' => $validatedData['name'],
                'contact_no' => $mainPhoneNumber,
                'country_code' => $countryCode,
            ]);
        }

        // ==============================
        // ✅ AUTO ASSIGN DEFAULT BUCKET & STATUS
        // ==============================
        
        // Example: Assign default bucket "New Leads"
        $defaultBucketId = 1; // your lead bucket ID

        // Example: Assign default status bucket
        $defaultStatus = \DB::table('buckets')
                            ->where('id', 2)   // your status bucket
                            ->value('name');
                            
        // -----------------------------
        // 2. Create the Lead for this user
        // -----------------------------
        $lead = Leads::create([
            'lead_bucket_id' => $defaultBucketId,
            'lead_status' => $defaultStatus,
            'lead_owner' => null,
            'date' => now()->format('Y-m-d'),
            'campaign_name' => null,
            'adset_name' => null,
            'ad_name' => null,
            'platform' => 'Website',
            'page_url' => $request->page_url ?? null,
            'whats_your_preferred_intake' => null,
            'highest_completed' => null,
            'any_academic_gap' => null,
            'budget' => null,
            'applying_country_for_a_visa' => $validatedData['visa_country'],
            'visa_type' => $validatedData['visa_type'],
            'uid' => $user->id,  // ✅ attach to existing or new user
        ]);

        // Flag session & return response
        Session::put('visa_form_submitted', true);

        return response()->json([
            'success' => true,
            'redirect_url' => route('thankyou'),
            'lead_id' => $lead->id,
            'user_id' => $user->id,
        ]);
    }


    public function sendLandingPageLeadToCrm(Request $request)
    {
        $customMessages = [
            'name.required' => 'The name field is mandatory.',
            'phone_number.main.required' => 'Please enter your phone number.',
            'phone_number.main.regex' => 'The phone number must be a 10-digit number.',
            'phone_number.full.required' => 'Please enter your full phone number.',
            'phone_number.full.regex' => 'The full phone number must be in international format.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'visa_country.required' => 'The visa country field is required.',
            'visa_type.required' => 'The visa type is required.',
            'counselling_mode.required' => 'Please select a preferred counselling mode.',
            'tac_check.required' => 'You must agree to the Terms & Conditions.',
            'tac_check.in' => 'You must agree to the Terms & Conditions.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number.main' => 'required|string|regex:/^[0-9]{10}$/',
            'phone_number.full' => 'required|string|regex:/^\+[1-9]{1}[0-9]{3,14}$/',
            'email' => 'required|email|max:255', // ❌ removed 'unique' rule here
            'visa_country' => 'required|string|max:255',
            'visa_type' => 'required|string|max:255',
            'counselling_mode' => [
                Rule::requiredIf(fn() => $request->visa_type === 'Student Visa'),
                'string',
                Rule::in(['Phone', 'Video', 'Home']),
            ],
            'tac_check' => 'required|in:on',
        ], $customMessages);

        // Extract phone & country code properly
        $fullPhoneNumber = $validatedData['phone_number']['full'];
        $mainPhoneNumber = $validatedData['phone_number']['main'];
        $countryCode = substr(
            $fullPhoneNumber,
            0,
            strlen($fullPhoneNumber) - strlen($mainPhoneNumber)
        );

        // -----------------------------
        // 1. Check if the user already exists
        // -----------------------------
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            // Create new user if not exists
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'contact_no' => $mainPhoneNumber,
                'country_code' => $countryCode,
                'role_id' => 2,
                'password' => Hash::make('user@123'),
            ]);
        } else {
            // Optional: Update user contact info if changed
            $user->update([
                'name' => $validatedData['name'],
                'contact_no' => $mainPhoneNumber,
                'country_code' => $countryCode,
            ]);
        }

        // ==============================
        // ✅ AUTO ASSIGN DEFAULT BUCKET & STATUS
        // ==============================
        
        // Example: Assign default bucket "New Leads"
        $defaultBucketId = 1; // your lead bucket ID

        // Example: Assign default status bucket
        $defaultStatus = \DB::table('buckets')
                            ->where('id', 2)   // your status bucket
                            ->value('name');

        // -----------------------------
        // 2. Create the Lead for this user
        // -----------------------------
        $lead = Leads::create([
            'lead_bucket_id' => $defaultBucketId,
            'lead_status' => $defaultStatus,
            'lead_owner' => null,
            'date' => now()->format('Y-m-d'),
            'campaign_name' => null,
            'adset_name' => null,
            'ad_name' => null,
            'platform' => 'Website',
            'page_url' => $request->page_url ?? null,
            'whats_your_preferred_intake' => null,
            'highest_completed' => null,
            'any_academic_gap' => null,
            'budget' => null,
            'applying_country_for_a_visa' => $validatedData['visa_country'],
            'visa_type' => $validatedData['visa_type'],
            'uid' => $user->id,  // ✅ attach to existing or new user

            'city' => $request->city ?? null,
        ]);

        // Flag session & return response
        Session::put('visa_form_submitted', true);

        return response()->json([
            'success' => true,
            'redirect_url' => route('thank-you'),
            'lead_id' => $lead->id,
            'user_id' => $user->id,
        ]);
    }



}
