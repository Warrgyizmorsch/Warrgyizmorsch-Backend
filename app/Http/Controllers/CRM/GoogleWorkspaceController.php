<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Services\GoogleWorkspaceService;
use Illuminate\Http\Request;

class GoogleWorkspaceController extends Controller
{
    protected GoogleWorkspaceService $workspaceService;

    public function __construct(GoogleWorkspaceService $workspaceService)
    {
        $this->workspaceService = $workspaceService;
    }

    /**
     * Redirect to Google OAuth consent screen on microservice.
     */
    public function connect(Request $request)
    {
        $callbackUrl = $request->getSchemeAndHttpHost() . '/google-workspace/callback';
        $loginUrl = $this->workspaceService->getLoginUrl($callbackUrl);

        return redirect()->away($loginUrl);
    }

    /**
     * Handle OAuth callback from microservice with auth_code.
     */
    public function callback(Request $request)
    {
        $authCode = $request->query('auth_code');

        if (empty($authCode)) {
            $errorMsg = $request->query('error_description') ?? $request->query('error') ?? 'Authentication cancelled or failed.';
            return redirect()->route('events.index')->with('error', 'Google Calendar connection failed: ' . $errorMsg);
        }

        $result = $this->workspaceService->exchangeAuthCode($authCode);

        if (!empty($result['success'])) {
            $email = $result['email'] ?? 'Google Account';
            return redirect()->route('events.index')->with('success', "Google Calendar connected successfully! ({$email})");
        }

        return redirect()->route('events.index')->with('error', 'Failed to connect Google Calendar: ' . ($result['error'] ?? 'Unknown error'));
    }

    /**
     * Get connection status via JSON for UI indicators.
     */
    public function status()
    {
        $status = $this->workspaceService->isConnected();
        return response()->json($status);
    }
}
