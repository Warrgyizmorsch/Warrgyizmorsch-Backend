<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\LeadAttribute;
use App\Models\LeadQuestion;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MetaWebhookController extends Controller
{
    public function verify(Request $request)
    {
        $mode = $request->input('hub.mode') ?? $request->input('hub_mode');
        $token = $request->input('hub.verify_token') ?? $request->input('hub_verify_token');
        $challenge = $request->input('hub.challenge') ?? $request->input('hub_challenge');

        if ($mode === 'subscribe' && $token === env('META_VERIFY_TOKEN')) {
            return response($challenge, 200);
        }

        return response('Invalid verify token', 403);
    }

    // public function handle(Request $request)
    // {
    //     Log::info('META WEBHOOK HIT', [
    //         'payload' => $request->all()
    //     ]);

    //     return response()->json([
    //         'received' => true,
    //         'data' => $request->all()
    //     ]);
    // }


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
                    'access_token' => env('META_PAGE_ACCESS_TOKEN'),
                    'fields' => 'id,created_time,field_data,campaign_name,adset_name,ad_name,form_name,platform'
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

                $this->saveMetaLead($lead);
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
            'fields' => 'id,created_time,field_data,campaign_name,adset_name,ad_name,form_name,platform'
        ]);

        $data = $response->json();


        Log::info('META FORM LEADS RESPONSE', $data);

        foreach (($data['data'] ?? []) as $lead) {
            $this->saveMetaLead($lead);
        }

        return response()->json($data);
    }

    private function saveMetaLead(array $lead): ?Leads
    {
        $metaLeadId = $lead['id'] ?? null;

        if (!$metaLeadId) {
            return null;
        }

        if (Leads::where('lead_id', $metaLeadId)->exists()) {
            Log::info('META LEAD SKIPPED - ALREADY EXISTS', [
                'meta_lead_id' => $metaLeadId,
            ]);

            return null;
        }

        $fullName = $this->getLeadFieldValue($lead, 'full_name', ['name', 'full name']) ?? 'Meta User';
        $email = strtolower(trim($this->getLeadFieldValue($lead, 'email', ['email address']) ?? ''));
        $phoneRaw = trim(
            $this->getLeadFieldValue($lead, 'whatsapp_number', [
                'phone_number',
                'phone',
                'mobile',
                'mobile number',
                'contact number',
                'whatsapp',
            ])
            ?? ''
        );

        [$countryCode, $phone] = $this->extractPhoneAndCountry($phoneRaw);

        if (!$phone) {
            Log::warning('META LEAD SKIPPED - INVALID PHONE', [
                'meta_lead_id' => $metaLeadId,
                'phone' => $phoneRaw,
            ]);

            return null;
        }

        if (!$email) {
            $email = 'meta_' . $metaLeadId . '@demo.com';
        }

        $city = $this->getLeadFieldValue($lead, 'city');
        $leadFields = $this->mapCrmLeadFields($lead);

        return DB::transaction(function () use ($lead, $metaLeadId, $fullName, $email, $phone, $countryCode, $city, $leadFields) {
            $user = User::where('contact_no', $phone)
                ->when(!str_contains($email, '@demo.com'), function ($query) use ($email) {
                    $query->orWhere('email', $email);
                })
                ->first();

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

            $leadCreated = Leads::create([
                'lead_id' => $metaLeadId,
                'uid' => $user->id,
                'date' => isset($lead['created_time'])
                    ? Carbon::parse($lead['created_time'])->toDateString()
                    : now()->toDateString(),
                'city' => $city,
                'campaign_name' => $lead['campaign_name'] ?? null,
                'adset_name' => $lead['adset_name'] ?? null,
                'ad_name' => $lead['ad_name'] ?? null,
                'form_name' => $lead['form_name'] ?? null,
                'platform' => $lead['platform'] ?? 'meta',
                'highest_completed' => $leadFields['highest_completed'],
                'whats_your_preferred_intake' => $leadFields['whats_your_preferred_intake'],
                'budget' => $leadFields['budget'],
                'applying_country_for_a_visa' => $leadFields['applying_country_for_a_visa'],
                'what_course_are_you_planning_to_study' => $leadFields['what_course_are_you_planning_to_study'],
                'english_test_status' => $leadFields['english_test_status'],
                'lead_status' => DB::table('buckets')->where('id', 2)->value('name') ?? 'Meta leads',
                'lead_bucket_id' => 1,
            ]);

            $this->saveDynamicFields($leadCreated->id, $lead);

            Log::info('META LEAD SAVED', [
                'lead_id' => $leadCreated->id,
                'user_id' => $user->id,
                'meta_lead_id' => $metaLeadId,
            ]);

            return $leadCreated;
        });
    }

    private function mapCrmLeadFields(array $lead): array
    {
        return [
            'highest_completed' => $this->getLeadFieldValue($lead, 'highest_completed', [
                'highest_completed',
                'highest education',
                'highest qualification',
                'education level',
                'qualification',
            ]),
            'whats_your_preferred_intake' => $this->getLeadFieldValue($lead, 'whats_your_preferred_intake', [
                'whats_your_preferred_intake',
                'preferred intake',
                'intake',
                'admission intake',
                'target intake',
            ]),
            'budget' => $this->getLeadFieldValue($lead, 'budget', [
                'budget',
                'estimated budget',
                'approximate budget',
                'expected budget',
            ]),
            'applying_country_for_a_visa' => $this->getLeadFieldValue($lead, 'applying_country_for_a_visa', [
                'applying_country_for_a_visa',
                'country',
                'destination',
                'study destination',
                'preferred country',
                'interested country',
            ]),
            'what_course_are_you_planning_to_study' => $this->getLeadFieldValue($lead, 'what_course_are_you_planning_to_study', [
                'what_course_are_you_planning_to_study',
                'course',
                'program',
                'programme',
                'study program',
                'course interested',
            ]),
            'english_test_status' => $this->getLeadFieldValue($lead, 'english_test_status', [
                'english_test_status',
                'english test',
                'ielts',
                'pte',
                'toefl',
            ]),
        ];
    }

    private function getLeadFieldValue(array $lead, string $crmField, array $aliases = []): ?string
    {
        $needles = array_unique(array_merge([$crmField], $aliases));

        foreach (($lead['field_data'] ?? []) as $data) {
            if ($this->fieldMatches($data['name'] ?? '', $needles)) {
                return $data['values'][0] ?? null;
            }
        }

        return null;
    }

    private function saveDynamicFields(int $leadId, array $lead): void
    {
        $questions = LeadQuestion::where('is_active', 1)->get(['id', 'field_name']);

        foreach (($lead['field_data'] ?? []) as $field) {
            $fieldName = $field['name'] ?? '';
            $fieldValue = $field['values'][0] ?? null;

            if (!$fieldName || !$fieldValue) {
                continue;
            }

            $question = $questions->first(function ($question) use ($fieldName) {
                return $this->fieldMatches($fieldName, [$question->field_name]);
            });

            if (!$question) {
                continue;
            }

            LeadAttribute::updateOrCreate(
                [
                    'lead_id' => $leadId,
                    'field_name' => $this->normalizeFieldName($question->field_name),
                ],
                [
                    'field_value' => $fieldValue,
                    'lead_question_id' => $question->id,
                ]
            );
        }
    }

    private function fieldMatches(string $fieldName, array $needles): bool
    {
        $normalizedField = $this->normalizeFieldName($fieldName);

        foreach ($needles as $needle) {
            $normalizedNeedle = $this->normalizeFieldName($needle);

            if (!$normalizedField || !$normalizedNeedle) {
                continue;
            }

            if (
                $normalizedField === $normalizedNeedle ||
                str_contains($normalizedField, $normalizedNeedle) ||
                str_contains($normalizedNeedle, $normalizedField)
            ) {
                return true;
            }
        }

        return false;
    }

    private function normalizeFieldName(string $fieldName): string
    {
        return trim(preg_replace('/[^a-z0-9]+/i', '_', mb_strtolower(str_replace(["'", "\xE2\x80\x99"], '', $fieldName))), '_');
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

        if (preg_match('/^(\d{11,14})$/', $phoneRaw, $matches)) {
            $number = substr($matches[1], -10);
            $code = '+' . substr($matches[1], 0, strlen($matches[1]) - 10);

            return [$code, $number];
        }

        return [null, null];
    }
}
