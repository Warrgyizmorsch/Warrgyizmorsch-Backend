<?php

namespace App\Http\Middleware;

use App\Models\LoginHistory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSingleSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        if (!$user) {
            return $next($request);
        }

        $currentSessionId = $request->session()->getId();

        // If the user's active session is set and does not match the current session ID
        if (!empty($user->active_session_id) && $user->active_session_id !== $currentSessionId) {
            // Update logout time for this session in history
            LoginHistory::where('user_id', $user->id)
                ->whereNull('logout_at')
                ->latest('id')
                ->first()
                ?->update([
                    'logout_at' => now(),
                    'user_agent' => $request->userAgent()
                ]);

            // Revoke current session
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'Your account has been logged in from another device. You have been logged out from this session.';

            // Handle AJAX/JSON/Fetch requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'message' => $message,
                    'force_logout' => true,
                    'session_expired' => true,
                ], 401);
            }

            // Normal browser navigation / form submit
            return redirect()->route('login')
                ->withErrors(['email' => $message])
                ->with('error', $message);
        }

        return $next($request);
    }
}
