<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleWorkspaceService
{
    protected string $baseUrl;
    protected ?string $apiToken;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.google_workspace.url', env('WORKSPACE_API_URL', 'https://love14-deal-health-scoring.hf.space')), '/');
        $this->apiToken = \Illuminate\Support\Facades\Cache::get('workspace_api_token') 
            ?: (config('services.google_workspace.token') ?: env('WORKSPACE_API_TOKEN'));
    }

    /**
     * Get active Bearer token.
     */
    public function getToken(): ?string
    {
        return $this->apiToken;
    }

    /**
     * Store and persist new Bearer token across cache and .env.
     */
    public function saveToken(string $token): void
    {
        $this->apiToken = trim($token);
        \Illuminate\Support\Facades\Cache::forever('workspace_api_token', $this->apiToken);
        self::updateEnvFile('WORKSPACE_API_TOKEN', $this->apiToken);
    }

    /**
     * Check if Google Workspace account is currently connected and authenticated.
     */
    public function isConnected(): array
    {
        if (empty($this->apiToken)) {
            return [
                'connected' => false,
                'email' => null,
                'detail' => 'WORKSPACE_API_TOKEN is not set.',
            ];
        }

        try {
            $response = $this->client()->get("{$this->baseUrl}/auth/me");
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'connected' => true,
                    'email' => $data['email'] ?? null,
                    'user_id' => $data['id'] ?? null,
                    'detail' => 'Connected to Google Workspace',
                ];
            }

            return [
                'connected' => false,
                'email' => null,
                'detail' => $response->json('detail') ?? 'Session expired or token invalid.',
            ];
        } catch (\Throwable $e) {
            return [
                'connected' => false,
                'email' => null,
                'detail' => $e->getMessage(),
            ];
        }
    }

    /**
     * Build Google OAuth redirect URL.
     */
    public function getLoginUrl(string $callbackUrl): string
    {
        return "{$this->baseUrl}/auth/login?next=" . urlencode($callbackUrl);
    }

    /**
     * Exchange a one-time auth_code from callback for a 14-day session Bearer token.
     */
    public function exchangeAuthCode(string $authCode): array
    {
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->post("{$this->baseUrl}/auth/token", [
                    'auth_code' => trim($authCode),
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $sessionToken = $data['session_token'] ?? null;
                if ($sessionToken) {
                    $this->saveToken($sessionToken);
                    return [
                        'success' => true,
                        'token' => $sessionToken,
                        'email' => $data['email'] ?? null,
                        'user_id' => $data['user_id'] ?? null,
                    ];
                }
            }

            return [
                'success' => false,
                'error' => $response->json('detail') ?? $response->body() ?? 'Failed to exchange auth code',
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update .env file key value safely.
     */
    public static function updateEnvFile(string $key, string $value): void
    {
        try {
            $path = base_path('.env');
            if (!file_exists($path)) return;

            $content = file_get_contents($path);
            if (preg_match("/^{$key}=.*/m", $content)) {
                $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
            } else {
                $content .= "\n{$key}={$value}\n";
            }
            file_put_contents($path, $content);
        } catch (\Throwable $e) {
            Log::warning('Could not write to .env: ' . $e->getMessage());
        }
    }

    /**
     * Build HTTP client with auth headers and timeouts.
     */
    protected function client()
    {
        $client = Http::timeout(15)
            ->acceptJson();

        if (!empty($this->apiToken)) {
            $client->withToken($this->apiToken);
        }

        return $client;
    }

    /**
     * Schedule a Google Calendar meeting with an auto-generated Google Meet room.
     *
     * @param string $summary Meeting Title
     * @param string $description Meeting agenda, notes, client contact
     * @param string $startDateTime ISO 8601 (e.g. 2026-10-06T15:00:00)
     * @param string|null $endDateTime ISO 8601 (e.g. 2026-10-06T15:30:00)
     * @param array $attendees Array of attendee email addresses
     * @param string $timezone Timezone (default Asia/Kolkata)
     * @return array ['success' => bool, 'event_id' => ?string, 'meet_link' => ?string, 'html_link' => ?string, 'error' => ?string]
     */
    public function createCalendarEvent(
        string $summary,
        string $description,
        string $startDateTime,
        ?string $endDateTime = null,
        array $attendees = [],
        string $timezone = 'Asia/Kolkata'
    ): array {
        try {
            // Clean up and filter attendee email addresses
            $cleanAttendees = array_values(array_filter(array_unique(array_map('trim', $attendees)), function ($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            }));

            // Default end time to 30 minutes after start if not provided
            if (empty($endDateTime)) {
                $endDateTime = date('Y-m-d\TH:i:s', strtotime($startDateTime . ' +30 minutes'));
            }

            $payload = [
                'summary' => $summary ?: 'Client Meeting — Warrgyizmorsch',
                'description' => $description ?: '',
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'attendees' => $cleanAttendees,
                'timezone' => $timezone,
                'create_meet_link' => true,
            ];

            $response = $this->client()->post("{$this->baseUrl}/workspace/calendar/create-event", $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                // Extract event id and meet link from response
                $eventId = $data['id'] ?? ($data['event_id'] ?? null);
                $meetLink = $data['meet_link'] ?? ($data['hangoutLink'] ?? null);
                $htmlLink = $data['htmlLink'] ?? null;

                return [
                    'success' => true,
                    'event_id' => $eventId,
                    'meet_link' => $meetLink,
                    'html_link' => $htmlLink,
                    'data' => $data,
                ];
            }

            Log::warning('Google Workspace API failed to create event', [
                'status' => $response->status(),
                'body' => $response->body(),
                'payload' => $payload,
            ]);

            return [
                'success' => false,
                'error' => $response->json('detail') ?? $response->body() ?? 'Failed to schedule on Google Calendar',
            ];
        } catch (\Throwable $e) {
            Log::error('GoogleWorkspaceService createCalendarEvent exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Cancel an event on Google Calendar.
     *
     * @param string $eventId
     * @return bool
     */
    public function cancelCalendarEvent(string $eventId): bool
    {
        if (empty($eventId)) {
            return false;
        }

        try {
            $response = $this->client()->delete("{$this->baseUrl}/workspace/calendar/events/{$eventId}");
            return $response->successful();
        } catch (\Throwable $e) {
            Log::error('GoogleWorkspaceService cancelCalendarEvent exception: ' . $e->getMessage());
            return false;
        }
    }
}
