<x-guest-layout>
    <style>
        {!! file_get_contents(public_path('css/custom-auth.css')) !!}
        .otp-inputs {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin: 15px 0;
        }
        .otp-field {
            width: 100%;
            padding: 12px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 4px;
            border-radius: 6px;
            border: 1px solid #374151;
            background-color: #1f2937;
            color: #ffffff;
        }
        .otp-field:focus {
            border-color: #3b82f6;
            outline: none;
        }
    </style>

    <div class="container">
        <div class="login-box">
            <form class="form" method="POST" action="{{ route('login.otp.verify') }}">
                @csrf

                <div style="height: 60px; width: 190px">
                    <img src="{{ asset('images/WARR LOGO.webp') }}" alt="Logo">
                </div>
                <span class="header">OTP Verification</span>

                <p style="color: #9ca3af; font-size: 13px; margin-bottom: 10px; text-align: center;">
                    Enter the 6-digit OTP code sent to email: <br>
                    <strong style="color: #60a5fa;">singhmahipal23@gmail.com</strong>
                </p>

                @if (session('status'))
                    <p style="color: #34d399; font-size: 13px; text-align: center;">{{ session('status') }}</p>
                @endif

                @if (session('error'))
                    <p style="color: #f87171; font-size: 13px; text-align: center;">{{ session('error') }}</p>
                @endif

                <!-- OTP Input -->
                <div class="otp-inputs">
                    <input type="text" name="otp" class="otp-field" placeholder="123456"
                        maxlength="6" required autofocus autocomplete="off">
                </div>

                @error('otp')
                    <p style="color: red; font-size: 12px; text-align: center;">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="button sign-in" style="margin-top: 15px;">Verify OTP</button>

                <!-- Resend & Cancel Links -->
                <div style="margin-top: 15px; display: flex; justify-content: space-between; font-size: 13px;">
                    <a href="{{ route('login') }}" class="link">Back to Login</a>
                </div>
            </form>

            <form method="POST" action="{{ route('login.otp.resend') }}" style="margin-top: 10px; text-align: center;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #60a5fa; cursor: pointer; font-size: 13px; text-decoration: underline;">
                    Resend OTP Code
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const otpInput = document.querySelector("input[name='otp']");
            if (otpInput) {
                otpInput.addEventListener("input", function () {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }
        });
    </script>
</x-guest-layout>
