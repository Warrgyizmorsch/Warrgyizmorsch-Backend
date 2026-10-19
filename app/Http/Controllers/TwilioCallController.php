<?php

namespace App\Http\Controllers;

use App\Models\TwilioCallLog;
use App\Models\User;
use App\Services\TwilioVoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TwilioCallController extends Controller
{
    protected TwilioVoiceService $twilio;

    public function __construct(TwilioVoiceService $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * WebRTC Access Token Endpoint (Called via AJAX from browser softphone)
     * GET /admin/twilio/token
     */
    public function getWebRtcToken(Request $request): JsonResponse
    {
        $userId   = Auth::id() ?? 1;
        $identity = 'agent_' . $userId;

        $tokenData = $this->twilio->generateAccessToken($identity);

        return response()->json($tokenData, ($tokenData['success'] ?? false) ? 200 : 422);
    }

    /**
     * TwiML Voice Webhook (Hit by Twilio servers on outbound dial or inbound call)
     * POST /api/twilio/voice
     */
    public function handleTwilioVoiceWebhook(Request $request): Response
    {
        $twiml = $this->twilio->generateTwiMLResponse($request);

        return response($twiml, 200, ['Content-Type' => 'text/xml']);
    }

    /**
     * Status & Recording Callback Webhook (Hit by Twilio servers)
     * POST /api/twilio/status-callback
     * POST /api/twilio/recording-callback
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

                // Dual-channel MP3 recording URL
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
     * Browser Softphone JS logs immediate events (start, disconnect)
     * POST /admin/twilio/log-call
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
     * Auto-Generate API Keys 1-Click Action
     * POST /admin/twilio/auto-fix-keys
     */
    public function autoFixKeys(): JsonResponse
    {
        $result = $this->twilio->autoGenerateAndSaveApiKey();
        return response()->json($result, $result['success'] ? 200 : 422);
    }
}
