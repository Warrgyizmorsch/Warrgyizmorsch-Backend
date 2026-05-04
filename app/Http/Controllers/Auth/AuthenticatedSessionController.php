<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->has('remember')) {

            return redirect()->intended(route('dashboard', absolute: false))
                ->withCookies([
                    cookie()->make('remember_email', $request->email, 60 * 24 * 30),
                    cookie()->make('remember_password', Crypt::encryptString($request->password), 60 * 24 * 30),
                ]);
        }

        return redirect()->intended(route('dashboard', absolute: false))
            ->withCookies([
                Cookie::forget('remember_email'),
                Cookie::forget('remember_password'),
            ]);
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
