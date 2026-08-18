<x-guest-layout>
    <style>
        {!! file_get_contents(public_path('css/custom-auth.css')) !!}
        .warning-card {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
        }
    </style>

    <div class="container">
        <div class="login-box">
            <div class="form">
                <div style="height: 60px; width: 190px">
                    <img src="{{ asset('images/WARR LOGO.webp') }}" alt="Logo">
                </div>
                <span class="header" style="color: #ef4444;">Active Session Warning</span>

                <div class="warning-card">
                    <i class="fas fa-exclamation-triangle" style="font-size: 28px; color: #f87171; margin-bottom: 10px;"></i>
                    <p style="color: #f3f4f6; font-size: 14px; margin-bottom: 5px; font-weight: 600;">
                        This user account is currently logged in on another device or browser.
                    </p>
                    <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                        To proceed, you must force logout the existing session.
                    </p>
                </div>

                <!-- Force Logout Form -->
                <form method="POST" action="{{ route('login.force_logout') }}">
                    @csrf
                    <button type="submit" class="button sign-in" style="background: linear-gradient(135deg, #dc2626, #b91c1c); margin-top: 10px;">
                        <i class="fas fa-sign-out-alt"></i> Force Logout Other Device & Login
                    </button>
                </form>

                <!-- Cancel Form -->
                <div style="margin-top: 15px; text-align: center;">
                    <a href="{{ route('login') }}" class="link" style="font-size: 13px; color: #9ca3af;">
                        Cancel & Return to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
