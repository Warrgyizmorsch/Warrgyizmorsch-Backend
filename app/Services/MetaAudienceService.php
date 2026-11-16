<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaAudienceService
{
    protected string $version;
    protected string $appId;
    protected string $adAccountId;
    protected string $pageId;
    protected string $accessToken;
    protected string $pageAccessToken;
    protected string $datasetId;

    public function __construct()
    {
        $this->version = config('meta_integration.graph_version', 'v21.0');
        $this->appId = trim((string) config('meta_integration.app_id', ''));
        
        $rawAdId = trim((string) config('meta_integration.ad_account_id', '1663040125607325'));
        $cleanAdId = preg_replace('/^act_/', '', $rawAdId);
        $this->adAccountId = 'act_' . ($cleanAdId ?: '1663040125607325');
        
        $this->pageId = trim((string) config('meta_integration.page_id', '1449192344936976'));
        $this->accessToken = trim((string) config('meta_integration.access_token', ''));
        $this->pageAccessToken = trim((string) config('meta_integration.page_access_token', ''));
        $this->datasetId = trim((string) config('meta_integration.dataset_id', ''));
    }

    /**
     * Get list of Custom Audiences from Meta Ad Account
     */
    public function getCustomAudiences(): array
    {
        if (empty($this->accessToken)) {
            return [
                'success' => false,
                'error' => 'META_ACCESS_TOKEN is not configured in .env',
                'data' => []
            ];
        }

        try {
            $url = "https://graph.facebook.com/{$this->version}/{$this->adAccountId}/customaudiences";
            $response = Http::timeout(15)->get($url, [
                'access_token' => $this->accessToken,
                'fields' => 'id,name,description,subtype,approximate_count_lower_bound,approximate_count_upper_bound,operation_status,time_updated,delivery_status',
                'limit' => 100,
            ]);

            if ($response->failed()) {
                Log::error('Meta Graph API getCustomAudiences error', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);
                return [
                    'success' => false,
                    'error' => $response->json()['error']['message'] ?? 'Failed to fetch audiences from Meta',
                    'data' => []
                ];
            }

            return [
                'success' => true,
                'data' => $response->json()['data'] ?? [],
            ];
        } catch (\Throwable $e) {
            Log::error('Meta Graph API getCustomAudiences exception', ['msg' => $e->getMessage()]);
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => []
            ];
        }
    }

    /**
     * Create a new Custom Audience on Meta Ad Account
     */
    public function createCustomAudience(string $name, string $description = ''): array
    {
        if (empty($this->accessToken)) {
            return ['success' => false, 'error' => 'META_ACCESS_TOKEN is not set in .env'];
        }

        try {
            $url = "https://graph.facebook.com/{$this->version}/{$this->adAccountId}/customaudiences";
            $response = Http::timeout(15)->post($url, [
                'access_token' => $this->accessToken,
                'name' => $name,
                'subtype' => 'CUSTOM',
                'description' => $description ?: 'Audience synced from Warrgyizmorsch CRM',
                'customer_file_source' => 'USER_PROVIDED_ONLY',
            ]);

            if ($response->failed()) {
                $err = $response->json()['error'] ?? [];
                Log::error('Meta Graph API createCustomAudience error', [
                    'response' => $response->json(),
                ]);
                return [
                    'success' => false,
                    'error' => $err['error_user_msg'] ?? $err['message'] ?? 'Failed to create audience',
                ];
            }

            return [
                'success' => true,
                'audience_id' => $response->json()['id'] ?? null,
                'data' => $response->json()
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Sync leads list to a specific Meta Custom Audience
     */
    public function syncLeadsToAudience(string $audienceId, $leads): array
    {
        if (empty($this->accessToken)) {
            return ['success' => false, 'error' => 'META_ACCESS_TOKEN is not set in .env'];
        }

        $rows = [];
        $skippedCount = 0;

        foreach ($leads as $lead) {
            $user = $lead->user ?? null;
            $cleanEmail = $this->normalizeEmail($user->email ?? $lead->email ?? null);
            $cleanPhone = $this->normalizePhone($user->contact_no ?? $lead->phone ?? null, $user->country_code ?? '+91');

            if (!$cleanEmail && !$cleanPhone) {
                $skippedCount++;
                continue;
            }

            $name = trim($user->name ?? $lead->name ?? '');
            $nameParts = preg_split('/\s+/', $name);
            $fn = $nameParts[0] ?? '';
            $ln = $nameParts[1] ?? '';
            $city = trim($lead->city ?? $user->city ?? '');

            $rows[] = [
                $cleanEmail ? hash('sha256', $cleanEmail) : '',
                $cleanPhone ? hash('sha256', $cleanPhone) : '',
                $fn ? hash('sha256', strtolower(trim($fn))) : '',
                $ln ? hash('sha256', strtolower(trim($ln))) : '',
                $city ? hash('sha256', strtolower(trim($city))) : '',
                hash('sha256', 'in'),
            ];
        }

        if (empty($rows)) {
            return [
                'success' => false,
                'error' => 'No valid leads with email or phone found to sync.',
                'synced_count' => 0,
                'skipped_count' => $skippedCount,
            ];
        }

        // Send in smaller, safe batches of 1000
        $batches = array_chunk($rows, 1000);
        $totalUploaded = 0;
        $url = "https://graph.facebook.com/{$this->version}/{$audienceId}/users";

        try {
            foreach ($batches as $batch) {
                $payload = [
                    'schema' => ['EMAIL', 'PHONE', 'FN', 'LN', 'CT', 'COUNTRY'],
                    'data' => $batch,
                ];

                $response = Http::timeout(45)->asForm()->post($url, [
                    'access_token' => $this->accessToken,
                    'payload' => json_encode($payload),
                ]);

                if ($response->failed()) {
                    $err = $response->json()['error'] ?? [];
                    Log::error('Meta syncLeadsToAudience batch error', [
                        'audience_id' => $audienceId,
                        'response' => $response->json(),
                    ]);

                    $errorMsg = $err['error_user_msg'] ?? $err['message'] ?? 'Failed during sync to Meta';
                    if (!empty($err['error_user_title'])) {
                        $errorMsg = $err['error_user_title'] . ': ' . $errorMsg;
                    }

                    return [
                        'success' => false,
                        'error' => $errorMsg,
                        'synced_count' => $totalUploaded,
                        'skipped_count' => $skippedCount,
                    ];
                }

                $totalUploaded += count($batch);
            }

            return [
                'success' => true,
                'synced_count' => $totalUploaded,
                'skipped_count' => $skippedCount,
                'audience_id' => $audienceId,
            ];
        } catch (\Throwable $e) {
            Log::error('Meta syncLeadsToAudience exception', ['msg' => $e->getMessage()]);
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'synced_count' => $totalUploaded,
                'skipped_count' => $skippedCount,
            ];
        }
    }

    /**
     * Send batch CRM events to Meta Dataset (Conversions API for CRM)
     */
    public function syncLeadsToDataset($leads, string $eventName = 'Lead'): array
    {
        if (empty($this->accessToken)) {
            return ['success' => false, 'error' => 'META_ACCESS_TOKEN is missing'];
        }

        if (empty($this->datasetId)) {
            return ['success' => false, 'error' => 'META_DATASET_ID is not configured in .env'];
        }

        $events = [];
        $synced = 0;
        $skipped = 0;

        foreach ($leads as $lead) {
            $userData = $this->buildUserData($lead);

            if (empty($userData['em']) && empty($userData['ph']) && empty($userData['lead_id'])) {
                $skipped++;
                continue;
            }

            // Meta Conversions API strictly requires event_time to be within the last 7 days!
            $eventTime = !empty($lead->date) ? strtotime($lead->date) : (!empty($lead->created_at) ? strtotime($lead->created_at) : time());
            if ($eventTime <= 0 || (time() - $eventTime) > 6 * 86400 || $eventTime > time()) {
                $eventTime = time();
            }

            $events[] = [
                'event_name' => $eventName,
                'event_time' => $eventTime,
                'action_source' => 'system_generated',
                'user_data' => $userData,
                'custom_data' => [
                    'lead_event_source' => 'WM CRM',
                    'event_source' => 'crm',
                ],
            ];
            $synced++;
        }

        if (empty($events)) {
            return [
                'success' => false,
                'error' => 'No valid leads with phone or email to send.',
                'synced_count' => 0,
                'skipped_count' => $skipped,
            ];
        }

        $chunks = array_chunk($events, 1000);
        $totalReceived = 0;

        foreach ($chunks as $chunk) {
            $res = Http::timeout(30)->post("https://graph.facebook.com/{$this->version}/{$this->datasetId}/events", [
                'access_token' => $this->accessToken,
                'data' => json_encode($chunk),
            ]);

            if ($res->failed()) {
                $err = $res->json()['error'] ?? [];
                Log::error('Meta CAPI Dataset Event error', ['body' => $res->json()]);
                $errorMsg = $err['error_user_msg'] ?? $err['message'] ?? 'Failed to send events to Meta Dataset';
                if (!empty($err['error_user_title'])) {
                    $errorMsg = $err['error_user_title'] . ': ' . $errorMsg;
                }
                return [
                    'success' => false,
                    'error' => $errorMsg,
                    'synced_count' => $totalReceived,
                ];
            }

            $totalReceived += ($res->json()['events_received'] ?? count($chunk));
        }

        return [
            'success' => true,
            'synced_count' => $totalReceived,
            'skipped_count' => $skipped,
            'dataset_id' => $this->datasetId,
        ];
    }

    /**
     * Send single lead conversion event to Meta Dataset
     */
    public function sendSingleLeadEvent(string $eventName, $lead, array $extra = []): bool
    {
        try {
            if (empty($this->accessToken) || empty($this->datasetId)) {
                return false;
            }

            $userData = $this->buildUserData($lead, $extra);

            if (empty($userData['em']) && empty($userData['ph']) && empty($userData['lead_id'])) {
                return false;
            }

            $event = [
                'event_name' => $eventName,
                'event_time' => time(),
                'action_source' => 'system_generated',
                'user_data' => $userData,
                'custom_data' => [
                    'lead_event_source' => 'WM CRM',
                    'event_source' => 'crm',
                ],
            ];

            $res = Http::timeout(10)->post("https://graph.facebook.com/{$this->version}/{$this->datasetId}/events", [
                'access_token' => $this->accessToken,
                'data' => json_encode([$event]),
            ]);

            return $res->successful();
        } catch (\Throwable $e) {
            Log::warning('Meta sendSingleLeadEvent failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Build rich Meta CAPI user_data with all recommended matching parameters
     */
    public function buildUserData($lead, array $extra = []): array
    {
        $user = is_object($lead) ? ($lead->user ?? null) : null;
        $isArr = is_array($lead);
        $userData = [];

        // 1. Email (Hashed)
        $email = $this->normalizeEmail($extra['email'] ?? ($isArr ? ($lead['email'] ?? null) : ($user->email ?? $lead->email ?? null)));
        if ($email) {
            $userData['em'] = [hash('sha256', $email)];
        }

        // 2. Phone Number (Hashed)
        $phone = $this->normalizePhone($extra['phone'] ?? ($isArr ? ($lead['phone'] ?? null) : ($user->contact_no ?? $lead->phone ?? null)), $user->country_code ?? '+91');
        if ($phone) {
            $userData['ph'] = [hash('sha256', $phone)];
        }

        // 3. First Name & Last Name (Hashed)
        $name = trim($extra['name'] ?? ($isArr ? ($lead['name'] ?? trim(($lead['first_name'] ?? '') . ' ' . ($lead['last_name'] ?? ''))) : ($user->name ?? $lead->name ?? '')));
        if (!empty($name)) {
            $parts = preg_split('/\s+/', $name);
            if (!empty($parts[0])) {
                $userData['fn'] = [hash('sha256', strtolower(trim($parts[0])))];
            }
            if (isset($parts[1])) {
                $userData['ln'] = [hash('sha256', strtolower(trim(end($parts))))];
            }
        }

        // 4. Meta Lead ID (Not hashed, instant form ID)
        $leadId = $extra['lead_id'] ?? ($isArr ? ($lead['lead_id'] ?? $lead['leadgen_id'] ?? null) : ($lead->lead_id ?? $lead->leadgen_id ?? null));
        if ($leadId && is_numeric($leadId)) {
            $userData['lead_id'] = (string)$leadId;
        }

        // 5. External ID (CRM Lead ID - Hashed)
        $crmId = (string)($isArr ? ($lead['id'] ?? '') : ($lead->id ?? '')) ?: (string)($extra['crm_id'] ?? '');
        if (!empty($crmId)) {
            $userData['external_id'] = [hash('sha256', 'wm_' . $crmId)];
        }

        // 6. City (ct) - Hashed
        $city = trim($extra['city'] ?? ($isArr ? ($lead['city'] ?? null) : ($lead->city ?? $user->city ?? '')));
        if (!empty($city)) {
            $cleanCity = strtolower(preg_replace('/[^a-zA-Z]/', '', $city));
            if (!empty($cleanCity)) {
                $userData['ct'] = [hash('sha256', $cleanCity)];
            }
        }

        // Look up dynamic attributes from LeadAttribute table if available
        $attrs = [];
        if (is_object($lead) && !empty($lead->id)) {
            try {
                $attrs = \App\Models\LeadAttribute::where('lead_id', $lead->id)
                    ->pluck('field_value', 'field_name')
                    ->toArray();
            } catch (\Throwable $e) {
                $attrs = [];
            }
        }

        // 7. State (st) - Hashed
        $state = trim($extra['state'] ?? (is_object($lead) ? $lead->state : null) ?? $attrs['state'] ?? $attrs['st'] ?? '');
        if (!empty($state)) {
            $cleanState = strtolower(preg_replace('/[^a-zA-Z]/', '', $state));
            if (!empty($cleanState)) {
                $userData['st'] = [hash('sha256', $cleanState)];
            }
        }

        // 8. ZIP / Postal Code (zp) - Hashed
        $zip = trim($extra['zip'] ?? (is_object($lead) ? $lead->pincode : null) ?? $attrs['zip'] ?? $attrs['pincode'] ?? $attrs['postal_code'] ?? '');
        if (!empty($zip)) {
            $cleanZip = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $zip));
            if (!empty($cleanZip)) {
                $userData['zp'] = [hash('sha256', $cleanZip)];
            }
        }

        // 9. Country (country) - Hashed (Default 'in' / India)
        $countryCode = strtolower(trim($extra['country'] ?? (is_object($lead) ? $lead->applying_country_for_a_visa : null) ?? 'in'));
        if (strlen($countryCode) !== 2) {
            $countryCode = 'in';
        }
        $userData['country'] = [hash('sha256', $countryCode)];

        // 10. Date of Birth (dobd, dobm, doby) - Hashed
        $dob = $extra['dob'] ?? $attrs['dob'] ?? $attrs['date_of_birth'] ?? null;
        if ($dob) {
            $dobTime = strtotime($dob);
            if ($dobTime) {
                $userData['doby'] = [hash('sha256', date('Y', $dobTime))];
                $userData['dobm'] = [hash('sha256', date('m', $dobTime))];
                $userData['dobd'] = [hash('sha256', date('d', $dobTime))];
            }
        }

        // 11. Click ID (fbc) - NOT hashed
        $fbc = $extra['fbc'] ?? $attrs['fbc'] ?? (function_exists('request') && request() ? (request()->cookie('_fbc') ?? request()->input('fbc')) : null);
        if ($fbc) {
            $userData['fbc'] = (string)$fbc;
        }

        // 12. Browser ID (fbp) - NOT hashed
        $fbp = $extra['fbp'] ?? $attrs['fbp'] ?? (function_exists('request') && request() ? (request()->cookie('_fbp') ?? request()->input('fbp')) : null);
        if ($fbp) {
            $userData['fbp'] = (string)$fbp;
        }

        // 13. Client IP Address - NOT hashed
        $clientIp = $extra['client_ip_address'] ?? $attrs['client_ip_address'] ?? $attrs['ip_address'] ?? (function_exists('request') && request() && !app()->runningInConsole() ? request()->ip() : null);
        if ($clientIp && filter_var($clientIp, FILTER_VALIDATE_IP)) {
            $userData['client_ip_address'] = (string)$clientIp;
        }

        // 14. Client User Agent - NOT hashed
        $userAgent = $extra['client_user_agent'] ?? $attrs['client_user_agent'] ?? $attrs['user_agent'] ?? (function_exists('request') && request() && !app()->runningInConsole() ? request()->userAgent() : null);
        if ($userAgent) {
            $userData['client_user_agent'] = (string)$userAgent;
        }

        return $userData;
    }

    /**
     * Map CRM Lead Statuses to Meta Conversions API (CAPI) Events
     */
    public const STATUS_TO_META_EVENT = [
        'Counselling in Progress' => 'QualifiedLead',
        'Application Process'     => 'SubmitApplication',
        'Offer Stage'             => 'OfferReceived',
        'Converted'               => 'Purchase',
        'Next Intake'             => 'NextIntakeLead',
        'Lost'                    => 'UnqualifiedLead',
    ];

    /**
     * Handle lead status change and dispatch CAPI event to Meta Dataset
     */
    public function handleLeadStatusChange($lead, ?string $newStatus): bool
    {
        if (empty($newStatus)) {
            return false;
        }

        $eventName = self::STATUS_TO_META_EVENT[$newStatus] ?? null;
        if (!$eventName) {
            return false;
        }

        $platform = strtolower(trim($lead->platform ?? ''));
        $hasMetaLeadId = !empty($lead->lead_id);
        $isMetaSource = $hasMetaLeadId || str_contains($platform, 'meta') || str_contains($platform, 'facebook') || str_contains($platform, 'instagram');

        if (!$isMetaSource) {
            return false;
        }

        $attrKey = 'meta_capi_sent_' . $eventName;
        $alreadySent = \App\Models\LeadAttribute::where('lead_id', $lead->id)
            ->where('field_name', $attrKey)
            ->exists();

        if ($alreadySent) {
            return false;
        }

        $sent = $this->sendSingleLeadEvent($eventName, $lead);

        if ($sent) {
            \App\Models\LeadAttribute::create([
                'lead_id' => $lead->id,
                'field_name' => $attrKey,
                'field_value' => date('Y-m-d H:i:s'),
            ]);
            Log::info("Meta CAPI Event [{$eventName}] sent for Lead ID: {$lead->id}");
            return true;
        }

        return false;
    }

    /**
     * Auto-subscribe Facebook Page to Meta Leadgen Webhooks
     */
    public function subscribePageToWebhook(): array
    {
        if (empty($this->accessToken) && empty($this->pageAccessToken)) {
            return ['success' => false, 'error' => 'Meta Token is not set.'];
        }

        try {
            $url = "https://graph.facebook.com/{$this->version}/{$this->pageId}/subscribed_apps";
            $response = Http::timeout(15)->post($url, [
                'subscribed_fields' => 'leadgen',
                'access_token' => $this->pageAccessToken ?: $this->accessToken,
            ]);

            if ($response->failed()) {
                $err = $response->json()['error'] ?? [];
                return [
                    'success' => false,
                    'error' => $err['error_user_msg'] ?? $err['message'] ?? 'Failed to subscribe page',
                ];
            }

            return [
                'success' => true,
                'data' => $response->json(),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get connection diagnostic details
     */
    public function getConnectionStatus(): array
    {
        $status = [
            'app_id' => $this->appId,
            'page_id' => $this->pageId,
            'ad_account_id' => $this->adAccountId,
            'token_valid' => false,
            'page_name' => null,
            'ad_account_name' => null,
            'error' => null,
        ];

        if (empty($this->accessToken)) {
            $status['error'] = 'META_ACCESS_TOKEN is not configured in .env';
            return $status;
        }

        try {
            $tokenRes = Http::timeout(10)->get("https://graph.facebook.com/{$this->version}/me", [
                'access_token' => $this->accessToken,
            ]);

            if ($tokenRes->successful()) {
                $status['token_valid'] = true;
            } else {
                $status['error'] = $tokenRes->json()['error']['message'] ?? 'Invalid Access Token';
                return $status;
            }

            $adRes = Http::timeout(10)->get("https://graph.facebook.com/{$this->version}/{$this->adAccountId}", [
                'access_token' => $this->accessToken,
                'fields' => 'name,account_status',
            ]);

            if ($adRes->successful()) {
                $status['ad_account_name'] = $adRes->json()['name'] ?? 'Active';
            } else {
                $status['error'] = $adRes->json()['error']['message'] ?? 'Ad Account access issue';
            }

            $pageRes = Http::timeout(10)->get("https://graph.facebook.com/{$this->version}/{$this->pageId}", [
                'access_token' => $this->pageAccessToken ?: $this->accessToken,
                'fields' => 'name',
            ]);

            if ($pageRes->successful()) {
                $status['page_name'] = $pageRes->json()['name'] ?? null;
            }
        } catch (\Throwable $e) {
            $status['error'] = $e->getMessage();
        }

        return $status;
    }

    /**
     * Normalize email for Meta hashing
     */
    private function normalizeEmail(?string $email): ?string
    {
        if (!$email) return null;
        $email = strtolower(trim($email));
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !str_contains($email, '@demo.com')) {
            return $email;
        }
        return null;
    }

    /**
     * Normalize phone to E.164 without '+' or special chars (e.g. 919876543210)
     */
    private function normalizePhone(?string $phone, ?string $countryCode = '+91'): ?string
    {
        if (!$phone) return null;
        $clean = preg_replace('/[^\d]/', '', $phone);

        if (strlen($clean) === 10) {
            $cc = preg_replace('/[^\d]/', '', $countryCode ?: '91');
            return ($cc ?: '91') . $clean;
        }

        if (strlen($clean) >= 11) {
            return $clean;
        }

        return null;
    }
}

