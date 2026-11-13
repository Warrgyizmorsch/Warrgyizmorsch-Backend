<?php

namespace App\Services;

use App\Models\PluginSetting;
use App\Models\TwilioCallLog;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class TwilioVoiceService
{
    private Client $httpClient;
    private ?PluginSetting $plugin;

    public function __construct()
    {
        $this->httpClient = new Client([
            'timeout' => 20,
            'http_errors' => false,
        ]);
        $this->plugin = (class_exists(PluginSetting::class) && \Illuminate\Support\Facades\Schema::hasTable('plugin_settings'))
            ? PluginSetting::where('plugin_key', 'twilio_call')->first() 
            : null;

    }

    /**
     * Resolves setting values from DB or .env fallback
     */
    public function getSettingValue(string $key): ?string
    {
        $val = $this->plugin ? ($this->plugin->settings[$key] ?? null) : null;
        if (!empty($val)) {
            return (string) $val;
        }

        return match ($key) {
            'account_sid'   => env('TWILIO_ACCOUNT_SID', env('TWILIO_SID')),
            'auth_token'    => env('TWILIO_AUTH_TOKEN', env('TWILIO_TOKEN')),
            'twilio_number' => env('TWILIO_NUMBER', env('TWILIO_PHONE_NUMBER', env('TWILIO_FROM'))),
            'api_key_sid'   => env('TWILIO_API_KEY_SID', env('TWILIO_API_KEY')),
            'api_secret'    => env('TWILIO_API_SECRET', env('TWILIO_SECRET')),
            'twiml_app_sid' => env('TWILIO_TWIML_APP_SID', env('TWILIO_APP_SID')),
            default         => null,
        };
    }

    /**
     * Formats phone numbers to international standard (+E.164)
     */
    public static function formatPhoneNumber(?string $countryCode, ?string $number): string
    {
        $countryCode = trim((string) $countryCode);
        $number = trim((string) $number);

        $countryCode = preg_replace('/[^\d+]/', '', $countryCode);
        $number = preg_replace('/\D/', '', $number);

        if (empty($number)) {
            return '';
        }

        // Strip leading zeros (e.g. 09876543210 -> 9876543210)
        $number = ltrim($number, '0');
        if (empty($number)) {
            return '';
        }

        if (!empty($countryCode)) {
            $cc = ltrim($countryCode, '+');
            if (str_starts_with($number, $cc)) {
                return '+' . $number;
            }
            return '+' . $cc . $number;
        }

        // 12-digit Indian number starting with 91
        if (str_starts_with($number, '91') && strlen($number) === 12) {
            return '+' . $number;
        }

        // 10-digit Indian standard mobile starting with 6, 7, 8, 9
        if (strlen($number) === 10 && in_array($number[0], ['6', '7', '8', '9'])) {
            return '+91' . $number;
        }

        return '+' . $number;
    }

    /**
     * Generates a Twilio Voice Access Token (JWT) for browser WebRTC clients
     */
    public function generateAccessToken(string $identity, int $ttl = 86400): array
    {
        $accountSid   = $this->getSettingValue('account_sid');
        $apiKey       = $this->getSettingValue('api_key_sid');
        $apiSecret    = $this->getSettingValue('api_secret');
        $appSid       = $this->getSettingValue('twiml_app_sid');
        $twilioNumber = $this->getSettingValue('twilio_number');

        if (empty($accountSid) || empty($apiKey) || empty($apiSecret) || empty($appSid)) {
            return [
                'success' => false,
                'message' => 'WebRTC configuration is incomplete. Check Account SID, API Key SID, API Secret, and TwiML App SID.',
            ];
        }

        try {
            // Option 1: Official Twilio SDK
            if (class_exists(\Twilio\Jwt\AccessToken::class) && class_exists(\Twilio\Jwt\Grants\VoiceGrant::class)) {
                $accessToken = new \Twilio\Jwt\AccessToken(
                    $accountSid,
                    $apiKey,
                    $apiSecret,
                    $ttl,
                    $identity
                );

                $voiceGrant = new \Twilio\Jwt\Grants\VoiceGrant();
                $voiceGrant->setOutgoingApplicationSid($appSid);
                $voiceGrant->setIncomingAllow(true);

                $accessToken->addGrant($voiceGrant);
                $jwt = $accessToken->toJWT();
            } else {
                // Option 2: Resilient Native HMAC-SHA256 JWT Generator
                $now = time();
                $header = ['typ' => 'JWT', 'alg' => 'HS256', 'cty' => 'twilio-fpa;v=1'];
                $payload = [
                    'jti' => $apiKey . '-' . $now,
                    'iss' => $apiKey,
                    'sub' => $accountSid,
                    'exp' => $now + $ttl,
                    'grants' => [
                        'identity' => $identity,
                        'voice' => [
                            'incoming' => ['allow' => true],
                            'outgoing' => ['application_sid' => $appSid],
                        ],
                    ],
                ];
                $encodedHeader  = self::base64UrlEncode(json_encode($header, JSON_UNESCAPED_SLASHES));
                $encodedPayload = self::base64UrlEncode(json_encode($payload, JSON_UNESCAPED_SLASHES));
                $signature      = hash_hmac('sha256', "{$encodedHeader}.{$encodedPayload}", $apiSecret, true);
                $jwt            = "{$encodedHeader}.{$encodedPayload}." . self::base64UrlEncode($signature);
            }

            return [
                'success'       => true,
                'token'         => $jwt,
                'identity'      => $identity,
                'twilio_number' => $twilioNumber,
            ];
        } catch (\Throwable $e) {
            Log::error('Twilio JWT Token Generation Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Token Generation Error: ' . $e->getMessage(),
            ];
        }
    }

    public static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Generates TwiML XML when Twilio hits /api/twilio/voice
     */
    public function generateTwiMLResponse(Request $request): string
    {
        $rawTo    = trim((string) ($request->input('To') ?? $request->input('phoneNumber') ?? ''));
        $rawFrom  = trim((string) $request->input('From', ''));
        $callerId = $this->getSettingValue('twilio_number') ?: env('TWILIO_NUMBER');

        $cleanTo           = preg_replace('/[^\d\+]/', '', $rawTo);
        $formattedCallerId = self::formatPhoneNumber('', $callerId);
        $formattedTo       = self::formatPhoneNumber('', $cleanTo);

        $statusCallbackUrl    = url('api/twilio/status-callback');
        $recordingCallbackUrl = url('api/twilio/recording-callback');

        // Case 1: Outbound Call from Browser Softphone -> Customer Phone
        if (!empty($cleanTo) && !str_starts_with($cleanTo, 'client:') && $formattedTo !== $formattedCallerId && strlen($cleanTo) >= 7) {
            return '<?xml version="1.0" encoding="UTF-8"?>'
                . '<Response>'
                . '<Dial callerId="' . htmlspecialchars($formattedCallerId) . '" answerOnBridge="true" record="record-from-answer-dual" recordingStatusCallback="' . htmlspecialchars($recordingCallbackUrl) . '">'
                . '<Number statusCallback="' . htmlspecialchars($statusCallbackUrl) . '" statusCallbackEvent="initiated ringing answered completed">' . htmlspecialchars($formattedTo) . '</Number>'
                . '</Dial>'
                . '</Response>';
        }

        // Case 2: Inbound Call from Customer -> Rings Browser Softphones
        $callSid = $request->input('CallSid');
        if (!empty($callSid)) {
            try {
                TwilioCallLog::firstOrCreate(
                    ['call_sid' => $callSid],
                    [
                        'direction'   => 'inbound',
                        'status'      => 'missed', // Defaults to missed until answered
                        'from_number' => $rawFrom ?: 'Unknown',
                        'to_number'   => $callerId,
                        'started_at'  => now(),
                    ]
                );
            } catch (\Throwable $e) {
                Log::error('Failed to pre-log inbound Twilio call: ' . $e->getMessage());
            }
        }

        // If this is a callback from a completed or cancelled dial, hang up cleanly
        $dialCallStatus = strtolower((string) ($request->input('DialCallStatus') ?? ''));
        if (in_array($dialCallStatus, ['completed', 'answered', 'canceled'])) {
            return '<?xml version="1.0" encoding="UTF-8"?><Response><Hangup/></Response>';
        }

        // Priority Tiers Configuration:
        // Priority 1: Mahipal (ID: 1) -> mahipal.rathore@warrgyizmorsch.com
        // Priority 2: Karan Sharma (ID: 2) -> Karan.sharma@warrgyizmorsch.com
        // Priority 3: Erhan (ID: 449) -> erhan.uckun@warrgyizmorsch.com
        // Priority 4: Sajid (ID: 90), Jonal (ID: 453), Ali (ID: 74), Kaif (ID: 452)
        // Priority 5 (Last Option): Yash (ID: 5) -> yash@gmail.com
        $priorityTiers = [
            1 => [
                'name'  => 'Mahipal',
                'ids'   => [1],
                'extra' => ['agent_admin'],
            ],
            2 => [
                'name'  => 'Karan Sharma',
                'ids'   => [2],
            ],
            3 => [
                'name'  => 'Erhan',
                'ids'   => [449],
            ],
            4 => [
                'name'  => 'Counselors / Executives',
                'ids'   => [90, 453, 74, 452],
            ],
            5 => [
                'name'  => 'Yash',
                'ids'   => [5],
            ],
        ];

        $currentTierParam = (int) $request->input('tier', 1);
        if ($currentTierParam < 1) {
            $currentTierParam = 1;
        }

        $targetTier = null;
        $agentsToDial = [];

        // Check tiers sequentially starting from currentTierParam
        for ($t = $currentTierParam; $t <= 5; $t++) {
            if (!isset($priorityTiers[$t])) {
                continue;
            }

            $onlineIds = [];
            foreach ($priorityTiers[$t]['ids'] as $uId) {
                if ($this->isUserOnline($uId)) {
                    $onlineIds[] = $uId;
                }
            }

            if (!empty($onlineIds)) {
                $targetTier = $t;
                foreach ($onlineIds as $uId) {
                    $agentsToDial[] = 'agent_' . $uId;
                }
                if (!empty($priorityTiers[$t]['extra'])) {
                    foreach ($priorityTiers[$t]['extra'] as $extra) {
                        $agentsToDial[] = $extra;
                    }
                }
                break; // Stop at highest priority tier that has online agent(s)
            }
        }

        // If no online agent was found in current and subsequent tiers:
        if ($targetTier === null || empty($agentsToDial)) {
            // If already fell back through all tiers, announce unavailable
            if ($currentTierParam > 1) {
                return '<?xml version="1.0" encoding="UTF-8"?>'
                    . '<Response>'
                    . '<Say voice="alice">No agent was available to take your call. Please try again later.</Say>'
                    . '<Hangup/>'
                    . '</Response>';
            }

            // If it's the very first attempt and no agent was detected online,
            // fallback to ringing active CRM staff for 18 seconds as safeguard
            $agentsToDial = ['agent_1', 'agent_2', 'agent_449', 'agent_90', 'agent_453', 'agent_74', 'agent_452', 'agent_5', 'agent_admin'];
            $targetTier = 5;
        }

        $agentsToDial = array_values(array_unique($agentsToDial));
        // Twilio hard limit: max 10 nouns in a single <Dial>
        $agentsToDial = array_slice($agentsToDial, 0, 10);

        $clientXml = '';
        foreach ($agentsToDial as $clientId) {
            $clientXml .= '<Client statusCallback="' . htmlspecialchars($statusCallbackUrl) . '" statusCallbackEvent="initiated ringing answered completed">' . htmlspecialchars($clientId) . '</Client>';
        }

        // The fallback action will trigger the next tier if no one answers within 18 seconds
        $nextTier = $targetTier + 1;
        $nextTierActionUrl = url('api/twilio/voice?tier=' . $nextTier);

        $greetingXml = ($currentTierParam === 1 && empty($dialCallStatus))
            ? '<Say voice="alice">Connecting to customer support, please hold.</Say>'
            : '';

        return '<?xml version="1.0" encoding="UTF-8"?>'
            . '<Response>'
            . $greetingXml
            . '<Dial timeout="18" record="record-from-answer" recordingStatusCallback="' . htmlspecialchars($recordingCallbackUrl) . '" action="' . htmlspecialchars($nextTierActionUrl) . '">'
            . $clientXml
            . '</Dial>'
            . '<Say voice="alice">No agent was available to take your call. Please try again later.</Say>'
            . '</Response>';
    }

    /**
     * Checks if a CRM user is currently online and active
     */
    public function isUserOnline(int $userId): bool
    {
        // Check active and not deleted
        try {
            $user = User::where('id', $userId)->where('is_active', 1)->where('is_deleted', 0)->first();
            if (!$user) {
                return false;
            }
        } catch (\Throwable $e) {
            return false;
        }

        // 1. Softphone Device Cache (Heartbeat or token fetched within 15 minutes)
        if (Cache::has('softphone_online_' . $userId)) {
            return true;
        }

        // 2. Active Session in database (last activity within 15 minutes)
        try {
            if (Schema::hasTable('sessions')) {
                $hasSession = DB::table('sessions')
                    ->where('user_id', $userId)
                    ->where('last_activity', '>=', now()->subMinutes(15)->timestamp)
                    ->exists();
                if ($hasSession) {
                    return true;
                }
            }
        } catch (\Throwable $e) {}

        // 3. User Work Logs in database (CRM header saves every 15s)
        try {
            if (Schema::hasTable('user_work_logs')) {
                $hasWorkLog = DB::table('user_work_logs')
                    ->where('user_id', $userId)
                    ->where('updated_at', '>=', now()->subMinutes(15))
                    ->exists();
                if ($hasWorkLog) {
                    return true;
                }
            }
        } catch (\Throwable $e) {}

        return false;
    }

    /**
     * Programmatically generates Twilio API Key & Secret via REST API (1-Click Auto Fix)
     */
    public function autoGenerateAndSaveApiKey(): array
    {
        $accountSid = $this->getSettingValue('account_sid');
        $authToken  = $this->getSettingValue('auth_token');

        if (empty($accountSid) || empty($authToken)) {
            return ['success' => false, 'message' => 'Please configure Account SID and Auth Token first.'];
        }

        try {
            $client = new Client(['timeout' => 15, 'http_errors' => false]);
            $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Keys.json";
            $res = $client->post($url, [
                'auth' => [$accountSid, $authToken],
                'form_params' => [
                    'FriendlyName' => 'CRM Auto Key ' . date('Y-m-d H:i'),
                ],
            ]);

            if ($res->getStatusCode() === 201) {
                $data = json_decode((string) $res->getBody(), true);
                $keySid = $data['sid'] ?? '';
                $secret = $data['secret'] ?? '';

                if ($this->plugin) {
                    $settings = $this->plugin->settings ?? [];
                    $settings['api_key_sid'] = $keySid;
                    $settings['api_secret'] = $secret;
                    $this->plugin->settings = $settings;
                    $this->plugin->save();
                }

                return [
                    'success'     => true,
                    'message'     => 'New Twilio API Key generated and saved automatically!',
                    'api_key_sid' => $keySid,
                    'api_secret'  => $secret,
                ];
            }

            return ['success' => false, 'message' => 'Twilio REST API Error: ' . $res->getBody()];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
        }
    }

    /**
     * Programmatically finds or creates TwiML Application in Twilio
     */
    public function getOrCreateTwiMLApp(string $baseUrl = ''): array
    {
        $accountSid = $this->getSettingValue('account_sid');
        $authToken  = $this->getSettingValue('auth_token');

        if (empty($accountSid) || empty($authToken)) {
            return ['success' => false, 'message' => 'Please configure Account SID and Auth Token first.'];
        }

        try {
            $client = new Client(['timeout' => 15, 'http_errors' => false]);
            $listUrl = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Applications.json";
            $res = $client->get($listUrl, ['auth' => [$accountSid, $authToken]]);

            if ($res->getStatusCode() === 200) {
                $listData = json_decode((string) $res->getBody(), true);
                $apps = $listData['applications'] ?? [];
                if (!empty($apps)) {
                    $firstApp = $apps[0];
                    return [
                        'success' => true,
                        'message' => 'Found existing TwiML App: ' . ($firstApp['friendly_name'] ?? ''),
                        'app_sid' => $firstApp['sid'],
                        'friendly_name' => $firstApp['friendly_name'] ?? '',
                    ];
                }
            }

            // Create new TwiML App if none found
            $voiceUrl = $baseUrl ? rtrim($baseUrl, '/') . '/api/twilio/voice' : url('/api/twilio/voice');
            $callbackUrl = $baseUrl ? rtrim($baseUrl, '/') . '/api/twilio/status-callback' : url('/api/twilio/status-callback');

            $createRes = $client->post($listUrl, [
                'auth' => [$accountSid, $authToken],
                'form_params' => [
                    'FriendlyName' => 'CRM WebRTC Softphone',
                    'VoiceUrl' => $voiceUrl,
                    'VoiceMethod' => 'POST',
                    'StatusCallback' => $callbackUrl,
                    'StatusCallbackMethod' => 'POST',
                ],
            ]);

            if (in_array($createRes->getStatusCode(), [200, 201])) {
                $data = json_decode((string) $createRes->getBody(), true);
                return [
                    'success' => true,
                    'message' => 'Created new TwiML App: ' . ($data['friendly_name'] ?? ''),
                    'app_sid' => $data['sid'] ?? '',
                    'friendly_name' => $data['friendly_name'] ?? '',
                ];
            }

            return ['success' => false, 'message' => 'Twilio REST error: ' . $createRes->getBody()];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => 'Exception: ' . $e->getMessage()];
        }
    }
}

