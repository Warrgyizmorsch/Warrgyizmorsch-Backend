<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class MetaWebhookController extends Controller
{
    public function verify(Request $request)
    {
        if ($request->input('hub_verify_token') === env('META_VERIFY_TOKEN')) {
            return response($request->input('hub_challenge'), 200);
        }

        return response('Invalid verify token', 403);
    }

    public function handle(Request $request)
    {
        Log::info('META WEBHOOK HIT', [
            'payload' => $request->all()
        ]);

        $data = $request->all();

        foreach (($data['entry'] ?? []) as $entry) {
            foreach (($entry['changes'] ?? []) as $change) {

                $leadId = $change['value']['leadgen_id'] ?? null;

                if (!$leadId) {
                    continue;
                }

                $response = Http::get("https://graph.facebook.com/" . env('META_GRAPH_VERSION', 'v25.0') . "/{$leadId}", [
                    'access_token' => env('META_PAGE_ACCESS_TOKEN')
                ]);

                $lead = $response->json();

                Log::info('META LEAD RESPONSE', [
                    'lead_id' => $leadId,
                    'response' => $lead
                ]);

                if (isset($lead['error'])) {
                    Log::error('META LEAD ERROR', $lead);
                    continue;
                }

                $fullName = $this->getField($lead, 'full_name');

            $email = strtolower(trim(
                $this->getField($lead, 'email') ?? ''
            ));

            $phoneRaw = trim(
                $this->getField($lead, 'whatsapp_number') ?? ''
            );

            $city = $this->getField($lead, 'city');

            $studyLevel = $this->getField($lead, 'what_level_of_study_are_you_planning_in_uk?');

            $intake = $this->getField($lead, 'which_intake_are_you_planning_for?');

            $budget = $this->getField($lead, 'what_is_your_approximate_annual_budget_for_tuition_in_lakhs?');

            [$countryCode, $phone] = $this->extractPhoneAndCountry($phoneRaw);

            $user = User::where(function ($q) use ($phone, $email) {

                if ($phone) {
                    $q->where('contact_no', $phone);
                }

                if ($email && !str_contains($email, '@demo.com')) {
                    $q->orWhere('email', $email);
                }
            })->first();

            if (!$user) {

                $user = User::create([
                    'name' => $fullName,
                    'email' => $email,
                    'contact_no' => $phone,
                    'country_code' => $countryCode,
                    'city' => $city,
                    'role_id' => 2,
                    'password' => Hash::make('user@123'),
                ]);
            }

            $existingLead = Leads::where('lead_id', $lead['id'])
                ->first();

            if ($existingLead) {
                continue;
            }

            $leadCreated = Leads::create([

                'lead_id' => $lead['id'],

                'uid' => $user->id,

                'date' => Carbon::parse($lead['created_time'])->toDateString(),

                'city' => $city,

                'highest_completed' => $studyLevel,

                'whats_your_preferred_intake' => $intake,

                'budget' => $budget,

                'platform' => 'meta',

                'lead_status' => 'Meta leads',

                'lead_bucket_id' => 1,

                'raw_data' => json_encode($lead),
            ]);

            Log::info('LEAD SAVED', [
                'lead_id' => $leadCreated->id,
                'user_id' => $user->id,
                'meta_lead_id' => $lead['id'],
            ]);

                // Leads::updateOrCreate(
                //     ['meta_lead_id' => $leadId],
                //     [
                //         'name' => $this->getField($lead, 'full_name') ?? $this->getField($lead, 'name'),
                //         'email' => $this->getField($lead, 'email'),
                //         'phone' => $this->getField($lead, 'phone_number') ?? $this->getField($lead, 'phone'),
                //         'source' => 'meta',
                //     ]
                // );
            }
        }

        return response('EVENT_RECEIVED', 200);
    }

    private function getField($lead, $field)
    {
        foreach (($lead['field_data'] ?? []) as $data) {
            if (($data['name'] ?? '') === $field) {
                return $data['values'][0] ?? null;
            }
        }

        return null;
    }


    public function fetchFormLeads($formId)
    {
        $response = Http::get("https://graph.facebook.com/" . env('META_GRAPH_VERSION', 'v25.0') . "/{$formId}/leads", [
            'access_token' => env('META_PAGE_ACCESS_TOKEN'),
            'fields' => 'id,created_time,field_data'
        ]);

        $data = $response->json();


        Log::info('META FORM LEADS RESPONSE', $data);

        foreach (($data['data'] ?? []) as $lead) {

            $fullName = $this->getField($lead, 'full_name');

            $email = strtolower(trim(
                $this->getField($lead, 'email') ?? ''
            ));

            $phoneRaw = trim(
                $this->getField($lead, 'whatsapp_number') ?? ''
            );

            $city = $this->getField($lead, 'city');

            $studyLevel = $this->getField($lead, 'what_level_of_study_are_you_planning_in_uk?');

            $intake = $this->getField($lead, 'which_intake_are_you_planning_for?');

            $budget = $this->getField($lead, 'what_is_your_approximate_annual_budget_for_tuition_in_lakhs?');

            [$countryCode, $phone] = $this->extractPhoneAndCountry($phoneRaw);

            $user = User::where(function ($q) use ($phone, $email) {

                if ($phone) {
                    $q->where('contact_no', $phone);
                }

                if ($email && !str_contains($email, '@demo.com')) {
                    $q->orWhere('email', $email);
                }
            })->first();

            if (!$user) {

                $user = User::create([
                    'name' => $fullName,
                    'email' => $email,
                    'contact_no' => $phone,
                    'country_code' => $countryCode,
                    'city' => $city,
                    'role_id' => 2,
                    'password' => Hash::make('user@123'),
                ]);
            }

            $existingLead = Leads::where('lead_id', $lead['id'])
                ->first();

            if ($existingLead) {
                continue;
            }

            // Leads::updateOrCreate(
            //     ['meta_lead_id' => $lead['id']],
            //     [
            //         'name' => $this->getField($lead, 'full_name'),
            //         'email' => $this->getField($lead, 'email'),
            //         'phone' => $this->getField($lead, 'whatsapp_number'),
            //         'city' => $this->getField($lead, 'city'),
            //         'study_level' => $this->getField($lead, 'what_level_of_study_are_you_planning_in_uk?'),
            //         'intake' => $this->getField($lead, 'which_intake_are_you_planning_for?'),
            //         'budget' => $this->getField($lead, 'what_is_your_approximate_annual_budget_for_tuition_in_lakhs?'),
            //         'source' => 'meta',
            //         'raw_data' => json_encode($lead),
            //     ]
            // );

          $leadCreated = Leads::create([

                'lead_id' => $lead['id'],

                'uid' => $user->id,

                'date' => Carbon::parse($lead['created_time'])->toDateString(),

                'city' => $city,

                'highest_completed' => $studyLevel,

                'whats_your_preferred_intake' => $intake,

                'budget' => $budget,

                'platform' => 'meta',

                'lead_status' => 'Meta leads',

                'lead_bucket_id' => 1,

                'raw_data' => json_encode($lead),
            ]);

            Log::info('LEAD SAVED', [
                'lead_id' => $leadCreated->id,
                'user_id' => $user->id,
                'meta_lead_id' => $lead['id'],
            ]);
        }

        return response()->json($data);
    }

    private function extractPhoneAndCountry(string $phoneRaw): array
    {
        $phoneRaw = preg_replace('/[^\d\+]/', '', $phoneRaw);

        if (preg_match('/^\+?(\d{1,3})(\d{10})$/', $phoneRaw, $matches)) {
            return ['+' . $matches[1], $matches[2]];
        }

        if (preg_match('/^0?(\d{10})$/', $phoneRaw, $matches)) {
            return ['+91', $matches[1]];
        }

        return [null, null];
    }
}
