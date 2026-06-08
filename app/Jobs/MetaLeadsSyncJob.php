<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Leads;
use App\Models\LeadAttribute;
use App\Models\LeadQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetaLeadsSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $formId;
    public ?int $uploadedBy;

    public function __construct(string $formId, ?int $uploadedBy = null)
    {
        $this->formId = $formId;
        $this->uploadedBy = $uploadedBy;
        $this->onQueue('default');
    }

   public function handle(): void
    {
        $since = now()->subDay()->timestamp;

        $url = "https://graph.facebook.com/" . env('META_GRAPH_VERSION', 'v25.0') . "/{$this->formId}/leads";

        $params = [
            'access_token' => env('META_PAGE_ACCESS_TOKEN'),
            'fields' => 'id,created_time,field_data,campaign_name,adset_name,ad_name,form_name,platform',
            'limit' => 100,
            'filtering' => json_encode([
                [
                    'field' => 'time_created',
                    'operator' => 'GREATER_THAN',
                    'value' => $since,
                ]
            ]),
        ];

        do {
            $response = Http::get($url, $params);
            $data = $response->json();

            if (isset($data['error'])) {
                Log::error('Meta lead sync error', [
                    'form_id' => $this->formId,
                    'error' => $data['error'],
                ]);
                return;
            }

            DB::beginTransaction();

            try {
                foreach (($data['data'] ?? []) as $metaLead) {
                    $this->saveLead($metaLead);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error('Meta lead save failed: ' . $e->getMessage());
                throw $e;
            }

            $url = $data['paging']['next'] ?? null;

            // IMPORTANT: next URL already contains cursor, but keep token safe
           $params = [
                'access_token' => env('META_PAGE_ACCESS_TOKEN'),
                'fields' => 'id,created_time,field_data,campaign_name,adset_name,ad_name,form_name,platform',
                'limit' => 100,
                'filtering' => json_encode([
                    [
                        'field' => 'time_created',
                        'operator' => 'GREATER_THAN',
                        'value' => now()->subDay()->timestamp,
                    ],
                ]),
            ];

        } while ($url);
    }

    private function saveLead(array $metaLead): void
    {
        $metaLeadId = $metaLead['id'] ?? null;
        if (Leads::where('lead_id', $metaLeadId)->exists()) {
        Log::info('Meta lead already exists, skipped', [
            'lead_id' => $metaLeadId,
        ]);
        return;
        }
        $fieldData = $metaLead['field_data'] ?? [];
        if (!$metaLeadId) {
            return;
        }


        $fullName = $this->getField($fieldData, 'full_name') ?? $this->getField($fieldData, 'name');
        $email = strtolower(trim($this->getField($fieldData, 'email') ?? ''));
        $phoneRaw = $this->getField($fieldData, 'whatsapp_number')
            ?? $this->getField($fieldData, 'phone_number')
            ?? $this->getField($fieldData, 'phone');

        [$countryCode, $phone] = $this->extractPhoneAndCountry((string)$phoneRaw);

        if (!$phone) {
            Log::warning('Meta lead skipped due to invalid phone', [
                'lead_id' => $metaLead['id'] ?? null,
                'phone' => $phoneRaw,
            ]);
            return;
        }

        if (!$email) {
            $email = 'meta_' . ($metaLead['id'] ?? uniqid()) . '@demo.com';
        }

        $nameParts = preg_split('/\s+/', trim((string)$fullName), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

       
        $user = User::where(function ($q) use ($phone, $email) {
        $q->where('contact_no', $phone);

        if ($email && !str_contains($email, '@demo.com')) {
            $q->orWhere('email', $email);
        }
        })->first();

        if (!$user) {
            $user = User::create([
                'name' => trim($firstName . ' ' . $lastName) ?: 'Meta User',
                'email' => $email,
                'contact_no' => $phone,
                'country_code' => $countryCode,
                'city' => $this->getField($fieldData, 'city'),
                'role_id' => 2,
                'password' => Hash::make('user@123'),
            ]);
        }

        $duplicateLead = Leads::where('uid', $user->id)
                        ->whereNull('lead_id')
                        ->latest()
                        ->first();


        $date = isset($metaLead['created_time'])
            ? Carbon::parse($metaLead['created_time'])->toDateString()
            : now()->toDateString();


        $existingLead = Leads::where('lead_id', $metaLead['id'])->first();

        if ($existingLead) {
            Log::info('Meta lead skipped because already exists', [
                'lead_id' => $metaLead['id'],
            ]);
            return;
        }


        $lead = Leads::create(
            [
                'lead_id' => $metaLead['id'],
                'uid' => $user->id,
                'date' => $date,
                'campaign_name' => $metaLead['campaign_name'] ?? null,
                'adset_name' => $metaLead['adset_name'] ?? null,
                'ad_name' => $metaLead['ad_name'] ?? null,
                'form_name' => $metaLead['form_name'] ?? null,
                'platform' => $metaLead['platform'] ?? 'facebook',

                'whats_your_preferred_intake' => $this->getField($fieldData, 'which_intake_are_you_planning_for?'),
                'budget' => $this->getField($fieldData, 'what_is_your_approximate_annual_budget_for_tuition_in_lakhs?'),
                'applying_country_for_a_visa' => $this->detectCountry($fieldData),
                'what_course_are_you_planning_to_study' => $this->getField($fieldData, 'what_level_of_study_are_you_planning_in_uk?'),
                'highest_completed' => $this->getField($fieldData, 'highest_completed'),
                'english_test_status' => $this->getField($fieldData, 'english_test_status'),

                'lead_status' => 'Meta leads',
                'lead_bucket_id' => 1,
                'lead_owner' => $this->uploadedBy,
                'imported_by' => $this->uploadedBy,
                'is_duplicate' => $duplicateLead ? 1 : 0,
                'duplicate_of' => $duplicateLead?->id,
                'duplicate_reason' => $duplicateLead ? 'Same user already exists from manual upload' : null,
            ]
        );

        $this->saveDynamicFields($lead->id, $fieldData);
    }

    private function getField(array $fieldData, string $field): ?string
    {
        foreach ($fieldData as $item) {
            if (($item['name'] ?? '') === $field) {
                return $item['values'][0] ?? null;
            }
        }

        return null;
    }

    private function detectCountry(array $fieldData): ?string
    {
        foreach ($fieldData as $item) {
            $name = strtolower($item['name'] ?? '');
            $value = $item['values'][0] ?? null;

            if (
                str_contains($name, 'country') ||
                str_contains($name, 'destination') ||
                str_contains($name, 'planning_in')
            ) {
                return $value;
            }
        }

        return null;
    }

    private function saveDynamicFields(int $leadId, array $fieldData): void
    {
        $norm = fn($h) => trim(preg_replace('/[^a-z0-9]+/i', '_', mb_strtolower(str_replace(['’', "'"], '', $h))), '_');

        $activeQuestions = LeadQuestion::where('is_active', 1)
            ->pluck('field_name')
            ->map(fn($f) => $norm($f))
            ->toArray();

        foreach ($fieldData as $field) {
            $fieldName = $norm($field['name'] ?? '');
            $fieldValue = $field['values'][0] ?? null;

            if (!$fieldName || !$fieldValue) {
                continue;
            }

            if (!in_array($fieldName, $activeQuestions)) {
                continue;
            }

            LeadAttribute::updateOrCreate(
                [
                    'lead_id' => $leadId,
                    'field_name' => $fieldName,
                ],
                [
                    'field_value' => $fieldValue,
                ]
            );
        }
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