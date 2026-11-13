<?php

namespace App\Http\Controllers;

use App\Models\PluginSetting;
use App\Models\TwilioCallLog;
use App\Models\User;
use App\Services\TwilioVoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PluginController extends Controller
{
    protected TwilioVoiceService $twilio;

    public function __construct(TwilioVoiceService $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * SCREEN 3: Call Plugins Management Page (/admin/plugins)
     */
    public function index(): View
    {
        $twilioPlugin = PluginSetting::firstOrCreate(
            ['plugin_key' => 'twilio_call'],
            [
                'name' => 'Twilio Voice Call',
                'category' => 'communication',
                'description' => 'Direct WebRTC browser calling & click-to-dial powered by Twilio Voice API.',
                'is_active' => true,
                'settings' => [
                    'account_sid'   => env('TWILIO_ACCOUNT_SID', ''),
                    'auth_token'    => env('TWILIO_AUTH_TOKEN', ''),
                    'twilio_number' => env('TWILIO_NUMBER', ''),
                    'api_key_sid'   => env('TWILIO_API_KEY_SID', ''),
                    'api_secret'    => env('TWILIO_API_SECRET', ''),
                    'twiml_app_sid' => env('TWILIO_TWIML_APP_SID', ''),
                    'call_mode'     => 'webrtc',
                    'record_calls'  => true,
                ],
            ]
        );

        $currentUserPhone = Auth::user()?->contact_no ?? Auth::user()?->mobile_no ?? '';

        return view('back-end.plugins.index', compact('twilioPlugin', 'currentUserPhone'));
    }

    /**
     * SCREEN 4: Save Twilio Settings from Modal
     */
    public function saveTwilio(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'account_sid'          => ['nullable', 'string', 'max:255'],
            'auth_token'           => ['nullable', 'string', 'max:255'],
            'twilio_number'        => ['nullable', 'string', 'max:50'],
            'api_key_sid'          => ['nullable', 'string', 'max:255'],
            'api_secret'           => ['nullable', 'string', 'max:255'],
            'twiml_app_sid'        => ['nullable', 'string', 'max:255'],
            'default_agent_number' => ['nullable', 'string', 'max:50'],
            'call_mode'            => ['nullable', 'string', 'in:webrtc,bridge,direct'],
            'record_calls'         => ['nullable', 'boolean'],
        ]);

        $plugin = PluginSetting::firstOrNew(['plugin_key' => 'twilio_call']);
        $plugin->name = 'Twilio Voice Call';
        $plugin->category = 'communication';
        $plugin->description = 'Bridge voice calls between agents and customers directly from Orders and Leads page using Twilio Voice API & WebRTC Dialer.';
        $plugin->settings = [
            'account_sid'          => trim($validated['account_sid'] ?? ''),
            'auth_token'           => trim($validated['auth_token'] ?? ''),
            'twilio_number'        => trim($validated['twilio_number'] ?? ''),
            'api_key_sid'          => trim($validated['api_key_sid'] ?? ''),
            'api_secret'           => trim($validated['api_secret'] ?? ''),
            'twiml_app_sid'        => trim($validated['twiml_app_sid'] ?? ''),
            'default_agent_number' => trim($validated['default_agent_number'] ?? ''),
            'call_mode'            => $validated['call_mode'] ?? 'webrtc',
            'record_calls'         => (bool) ($validated['record_calls'] ?? true),
        ];
        $plugin->updated_by = Auth::id();
        $plugin->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Settings saved successfully.']);
        }

        return back()->with('success', 'Twilio Voice Calling plugin settings saved successfully.');
    }

    /**
     * Toggle Plugin Active / Inactive switch
     */
    public function toggleStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'plugin_key' => ['required', 'string'],
            'is_active'  => ['required', 'boolean'],
        ]);

        $plugin = PluginSetting::where('plugin_key', $validated['plugin_key'])->first();
        if (!$plugin) {
            return response()->json(['success' => false, 'message' => 'Plugin not found.'], 404);
        }

        $plugin->is_active = $validated['is_active'];
        $plugin->updated_by = Auth::id();
        $plugin->save();

        return response()->json([
            'success'   => true,
            'message'   => 'Plugin status updated to ' . ($plugin->is_active ? 'Active' : 'Inactive'),
            'is_active' => $plugin->is_active,
        ]);
    }

    /**
     * Auto-Generate Twilio API Key & Secret with 1-Click
     */
    public function autoFixKeys(): JsonResponse
    {
        $result = $this->twilio->autoGenerateAndSaveApiKey();
        return response()->json($result, $result['success'] ? 200 : 422);
    }

    /**
     * SCREEN 1: Call History Page (/call-history?provider=twilio)
     */
    public function callHistory(Request $request): View
    {
        $provider = $request->input('provider', 'twilio');
        $tab      = $request->input('tab', 'all');

        $baseQuery = TwilioCallLog::query();

        // Summary counts for tabs and statistics
        $totalCalls     = (clone $baseQuery)->count();
        $completedCalls = (clone $baseQuery)->where('status', 'completed')->count();
        $missedCalls    = (clone $baseQuery)->whereIn('status', ['missed', 'no-answer'])->count();
        $inboundCalls   = (clone $baseQuery)->where('direction', 'inbound')->count();
        $outboundCalls  = (clone $baseQuery)->where('direction', 'outbound')->count();

        $query = (clone $baseQuery)->with('agent')->orderByDesc('created_at');

        // Quick Tab Filter
        if ($tab === 'missed') {
            $query->whereIn('status', ['missed', 'no-answer']);
        } elseif ($tab === 'inbound') {
            $query->where('direction', 'inbound');
        } elseif ($tab === 'outbound') {
            $query->where('direction', 'outbound');
        } elseif ($tab === 'completed') {
            $query->where('status', 'completed');
        }

        // Granular filters
        if ($request->filled('status') && $tab === 'all') {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('direction') && $tab === 'all') {
            $query->where('direction', $request->input('direction'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        // Search by Contact / Number / ID
        if ($request->filled('search')) {
            $search = trim((string) $request->input('search'));
            $digits = preg_replace('/\D+/', '', $search);
            $query->where(function ($q) use ($search, $digits) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('from_number', 'like', "%{$search}%")
                  ->orWhere('to_number', 'like', "%{$search}%")
                  ->orWhere('call_sid', 'like', "%{$search}%");
                if (strlen($digits) >= 4) {
                    $q->orWhere('from_number', 'like', "%{$digits}%")
                      ->orWhere('to_number', 'like', "%{$digits}%");
                }
            });
        }

        $logs = $query->paginate(25)->withQueryString();

        return view('back-end.plugins.call-history', compact(
            'provider',
            'tab',
            'logs',
            'totalCalls',
            'completedCalls',
            'missedCalls',
            'inboundCalls',
            'outboundCalls'
        ));
    }

    /**
     * WebRTC JWT Token for Browser Dialer
     */
    public function getWebRtcToken(Request $request): JsonResponse
    {
        $userId   = Auth::id() ?? 1;
        $identity = 'agent_' . $userId;

        $tokenData = $this->twilio->generateAccessToken($identity);

        return response()->json($tokenData, ($tokenData['success'] ?? false) ? 200 : 422);
    }

    /**
     * TwiML Voice Webhook
     */
    public function handleTwilioVoiceWebhook(Request $request): Response
    {
        $twiml = $this->twilio->generateTwiMLResponse($request);
        return response($twiml, 200, ['Content-Type' => 'text/xml']);
    }

    /**
     * Status & Recording Webhook Callbacks
     */
    public function statusCallback(Request $request): Response
    {
        try {
            $callSid   = $request->input('CallSid') ?: $request->input('DialCallSid');
            $rawStatus = strtolower((string) ($request->input('CallStatus') ?: $request->input('DialCallStatus') ?: 'completed'));
            $duration  = (int) ($request->input('CallDuration') ?: $request->input('DialCallDuration') ?: 0);
            $from      = $request->input('From', '');
            $to        = $request->input('To', '');
            $dirInput  = strtolower((string) $request->input('Direction', ''));
            $direction = str_contains($dirInput, 'inbound') ? 'inbound' : 'outbound';

            $status = match($rawStatus) {
                'in-progress', 'in_progress' => 'in-progress',
                'completed'                  => 'completed',
                'busy'                       => ($direction === 'inbound') ? 'missed' : 'no-answer',
                'no-answer', 'no_answer'     => ($direction === 'inbound') ? 'missed' : 'no-answer',
                'canceled', 'cancelled'      => ($direction === 'inbound') ? 'missed' : 'cancelled',
                'failed'                     => 'failed',
                'ringing'                    => 'ringing',
                default                      => $rawStatus,
            };

            if ($direction === 'inbound') {
                if ($rawStatus === 'completed' && $duration > 0) {
                    $status = 'completed';
                } elseif ($duration === 0 || in_array($rawStatus, ['busy', 'no-answer', 'canceled', 'failed'])) {
                    $status = 'missed';
                }
            }

            if ($callSid) {
                $log = TwilioCallLog::firstOrNew(['call_sid' => $callSid]);
                $log->status    = $status;
                $log->duration  = max((int) ($log->duration ?? 0), $duration);
                if (empty($log->from_number) && !empty($from)) $log->from_number = $from;
                if (empty($log->to_number) && !empty($to))     $log->to_number   = $to;
                if (empty($log->direction))                     $log->direction   = $direction;

                // Auto-resolve customer name by matching phone number with Users table
                if (empty($log->customer_name)) {
                    $callerPhone = $log->from_number ?: $from;
                    $digits = preg_replace('/\D/', '', $callerPhone);
                    if (strlen($digits) >= 7) {
                        try {
                            $customer = User::whereRaw("REPLACE(REPLACE(contact_no, ' ', ''), '-', '') LIKE ?", ['%' . substr($digits, -10)])
                                ->first();
                            if ($customer) {
                                $log->customer_name = $customer->name;
                            }
                        } catch (\Throwable $ex) {}
                    }
                }

                if ($request->filled('RecordingUrl')) {
                    $recordingUrl = $request->input('RecordingUrl');
                    if (!str_ends_with($recordingUrl, '.mp3')) {
                        $recordingUrl .= '.mp3';
                    }
                    $log->recording_url = $recordingUrl;
                }
                if ($request->filled('RecordingSid')) {
                    $log->recording_sid = $request->input('RecordingSid');
                }

                if (in_array($status, ['completed', 'failed', 'no-answer', 'missed', 'cancelled'])) {
                    $log->ended_at = now();
                }
                $log->save();
            }

            return response('', 204);
        } catch (\Throwable $e) {
            Log::error('Twilio status-callback error: ' . $e->getMessage());
            return response('', 200);
        }
    }

    /**
     * Browser Softphone Live Event Logging
     */
    public function logCall(Request $request): JsonResponse
    {
        $data = $request->validate([
            'call_sid'      => ['nullable', 'string', 'max:64'],
            'direction'     => ['nullable', 'string', 'in:outbound,inbound'],
            'status'        => ['nullable', 'string', 'max:30'],
            'from_number'   => ['nullable', 'string', 'max:50'],
            'to_number'     => ['nullable', 'string', 'max:50'],
            'customer_name' => ['nullable', 'string', 'max:200'],
            'duration'      => ['nullable', 'integer', 'min:0'],
            'started_at'    => ['nullable', 'string'],
            'ended_at'      => ['nullable', 'string'],
        ]);

        $user = Auth::user();

        $log = !empty($data['call_sid'])
            ? TwilioCallLog::firstOrNew(['call_sid' => $data['call_sid']])
            : new TwilioCallLog();

        $log->fill([
            'call_sid'       => $data['call_sid'] ?? $log->call_sid,
            'direction'      => $data['direction'] ?? $log->direction ?? 'outbound',
            'status'         => $data['status'] ?? $log->status ?? 'initiated',
            'from_number'    => $data['from_number'] ?? $log->from_number,
            'to_number'      => $data['to_number'] ?? $log->to_number,
            'customer_name'  => $data['customer_name'] ?? $log->customer_name,
            'duration'       => max((int) ($data['duration'] ?? 0), (int) ($log->duration ?? 0)),
            'agent_user_id'  => $log->agent_user_id ?: $user?->id,
            'agent_identity' => $log->agent_identity ?: ($user ? 'agent_' . $user->id : null),
            'started_at'     => !empty($data['started_at']) ? \Carbon\Carbon::parse($data['started_at']) : ($log->started_at ?: now()),
            'ended_at'       => !empty($data['ended_at'])   ? \Carbon\Carbon::parse($data['ended_at'])   : $log->ended_at,
        ]);
        $log->save();

        return response()->json(['success' => true, 'id' => $log->id]);
    }

    /**
     * Standalone Popout Dialer Window
     */
    public function dialerWindow(): View
    {
        return view('back-end.plugins.dialer-window');
    }

    /**
     * Stream or download Twilio Call Recording audio without requiring Twilio login
     */
    public function streamRecording(int|string $id)
    {
        $log = TwilioCallLog::findOrFail($id);
        if (empty($log->recording_url)) {
            abort(404, 'No recording available for this call.');
        }

        $plugin = PluginSetting::where('plugin_key', 'twilio_call')->first();
        $settings = $plugin?->settings ?? [];
        $sid = $settings['account_sid'] ?? env('TWILIO_ACCOUNT_SID', '');
        $token = $settings['auth_token'] ?? env('TWILIO_AUTH_TOKEN', '');

        $url = $log->recording_url;
        if (!str_ends_with(strtolower($url), '.mp3') && !str_ends_with(strtolower($url), '.wav')) {
            $url .= '.mp3';
        }

        try {
            $client = \Illuminate\Support\Facades\Http::timeout(30);
            if (!empty($sid) && !empty($token)) {
                $client = $client->withBasicAuth($sid, $token);
            }
            $response = $client->get($url);

            if (!$response->successful()) {
                // Retry without extension if .mp3 appended
                $rawUrl = preg_replace('/\.mp3$/i', '', $url);
                $fallback = \Illuminate\Support\Facades\Http::timeout(30);
                if (!empty($sid) && !empty($token)) {
                    $fallback = $fallback->withBasicAuth($sid, $token);
                }
                $response = $fallback->get($rawUrl);
                
                if (!$response->successful()) {
                    Log::warning("Twilio recording fetch failed for log #{$id} [HTTP {$response->status()}]: {$url}");
                    abort(404, 'Audio recording could not be retrieved from Twilio.');
                }
            }

            $contentType = $response->header('Content-Type') ?: 'audio/mpeg';
            $body = $response->body();

            return response($body, 200, [
                'Content-Type'        => $contentType,
                'Content-Length'      => strlen($body),
                'Content-Disposition' => 'inline; filename="call-recording-' . $log->id . '.mp3"',
                'Accept-Ranges'       => 'bytes',
                'Cache-Control'       => 'public, max-age=86400',
            ]);
        } catch (\Throwable $e) {
            Log::error("Twilio recording stream exception for log #{$id}: " . $e->getMessage());
            abort(500, 'Error streaming audio recording.');
        }
    }
}

