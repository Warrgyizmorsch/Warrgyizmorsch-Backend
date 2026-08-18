<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\SendLoginOtp;
use App\Models\LoginHistory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => 'Your account is inactive. Please contact admin.',
            ]);
        }

        // Validate password first
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Generate OTP for all users (including Admin and other roles)
        $otp = sprintf("%06d", mt_rand(100000, 999999));

        session([
            'otp_user_id' => $user->id,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10)->timestamp,
            'otp_remember' => $request->boolean('remember'),
            'remember_email' => $request->email,
            'remember_password' => $request->password,
        ]);

        // Send OTP to singhmahipal23@gmail.com
        try {
            Mail::to('singhmahipal23@gmail.com')->send(new SendLoginOtp($otp, $user->name, $user->email));
        } catch (\Exception $e) {
            \Log::error('OTP Mail Exception: ' . $e->getMessage());
        }

        return redirect()->route('login.otp');
    }

    /**
     * Show the OTP input form.
     */
    public function showOtpForm(): View|RedirectResponse
    {
        if (!session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.otp');
    }

    /**
     * Verify the entered OTP code.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $userId = session('otp_user_id');
        $otpCode = session('otp_code');
        $expiresAt = session('otp_expires_at');
        $remember = session('otp_remember', false);

        if (!$userId || !$otpCode || !$expiresAt) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        if (now()->timestamp > $expiresAt) {
            return back()->with('error', 'OTP has expired. Please click Resend OTP.');
        }

        if ($request->otp != $otpCode) {
            return back()->with('error', 'Invalid OTP code. Please try again.');
        }

        // OTP Validated! Check if user is logged in elsewhere
        $hasActiveSession = DB::table('sessions')->where('user_id', $userId)->exists();

        if ($hasActiveSession) {
            session(['otp_verified_user_id' => $userId]);
            return redirect()->route('login.force_logout_prompt');
        }

        // Complete Login
        Auth::loginUsingId($userId, $remember);
        $request->session()->regenerate();

        $cookieResponse = redirect()->intended(route('dashboard', absolute: false));

        if ($remember) {
            $email = session('remember_email');
            $password = session('remember_password');
            $cookieResponse->withCookies([
                cookie()->make('remember_email', $email, 60 * 24 * 30),
                cookie()->make('remember_password', Crypt::encryptString($password), 60 * 24 * 30),
            ]);
        } else {
            $cookieResponse->withCookies([
                Cookie::forget('remember_email'),
                Cookie::forget('remember_password'),
            ]);
        }

        session()->forget(['otp_user_id', 'otp_code', 'otp_expires_at', 'otp_remember', 'remember_email', 'remember_password']);

        return $cookieResponse;
    }

    /**
     * Resend a fresh OTP code.
     */
    public function resendOtp(): RedirectResponse
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        $otp = sprintf("%06d", mt_rand(100000, 999999));
        session([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        try {
            Mail::to('singhmahipal23@gmail.com')->send(new SendLoginOtp($otp, $user->name, $user->email));
        } catch (\Exception $e) {
            \Log::error('Resend OTP Mail Exception: ' . $e->getMessage());
        }

        return back()->with('status', 'A new OTP code has been sent to singhmahipal23@gmail.com');
    }

    /**
     * Display Force Logout confirmation prompt.
     */
    public function showForceLogoutPrompt(): View|RedirectResponse
    {
        if (!session()->has('otp_verified_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.force-logout');
    }

    /**
     * Force logout existing session and complete login.
     */
    public function forceLogoutAndLogin(Request $request): RedirectResponse
    {
        $userId = session('otp_verified_user_id');
        $remember = session('otp_remember', false);

        if (!$userId) {
            return redirect()->route('login');
        }

        // Invalidate prior login history
        LoginHistory::where('user_id', $userId)
            ->whereNull('logout_at')
            ->latest('id')
            ->first()
            ?->update(['logout_at' => now()]);

        // Delete active sessions for user
        DB::table('sessions')->where('user_id', $userId)->delete();

        // Perform login
        Auth::loginUsingId($userId, $remember);
        $request->session()->regenerate();

        $cookieResponse = redirect()->intended(route('dashboard', absolute: false));

        if ($remember) {
            $email = session('remember_email');
            $password = session('remember_password');
            $cookieResponse->withCookies([
                cookie()->make('remember_email', $email, 60 * 24 * 30),
                cookie()->make('remember_password', Crypt::encryptString($password), 60 * 24 * 30),
            ]);
        } else {
            $cookieResponse->withCookies([
                Cookie::forget('remember_email'),
                Cookie::forget('remember_password'),
            ]);
        }

        session()->forget(['otp_user_id', 'otp_code', 'otp_expires_at', 'otp_remember', 'otp_verified_user_id', 'remember_email', 'remember_password']);

        return $cookieResponse;
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Update the latest login record
        LoginHistory::where('user_id', Auth::id())
            ->whereNull('logout_at')
            ->latest('id')
            ->first()
            ?->update(['logout_at' => now(), 'user_agent' => request()->userAgent()]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

