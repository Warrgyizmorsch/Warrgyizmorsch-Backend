<x-guest-layout>
    <style>
        {!! file_get_contents(public_path('css/custom-auth.css')) !!}
    </style>

    <div class="container">
        <div class="login-box">
            <form method="POST" action="{{ route('password.store') }}" class="form">
                @csrf

                <div style="height: 60px; width: 190px"><img src="/images/logo-wts.png" alt="Logo"></div>
                <span class="header">Reset Password</span>

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <input type="email" name="email" class="input" placeholder="Email"
                    value="{{ old('email', $request->email) }}" required autofocus>
                @error('email')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- New Password -->
                <input type="password" name="password" class="input mt-3" placeholder="New Password" required
                    autocomplete="new-password">
                @error('password')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Confirm New Password -->
                <input type="password" name="password_confirmation" class="input mt-3"
                    placeholder="Confirm New Password" required autocomplete="new-password">
                @error('password_confirmation')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="button sign-in mt-4">Reset Password</button>

                <!-- Back to login -->
                <p class="footer mt-3">
                    <a href="{{ route('login') }}" class="link">Back to Login</a>
                </p>
            </form>
        </div>
    </div>
    <script>
        // ================== EMAIL FIELD ===================
        const resetEmail = document.querySelector("input[name='email']");

        if (resetEmail) {

            // Block copy, paste, cut for email
            ["paste", "copy", "cut"].forEach(evt => {
                resetEmail.addEventListener(evt, e => e.preventDefault());
            });

            resetEmail.addEventListener("input", function () {
                let val = this.value;

                // Remove SQL keywords
                val = val.replace(/SELECT|INSERT|DELETE|UPDATE|DROP|UNION|WHERE|JOIN|AND|OR|--/gi, '');

                // Remove HTML & script tags
                val = val.replace(/<|>|script|{|}|\\/gi, '');

                // Allow only valid email chars
                val = val.replace(/[^a-zA-Z0-9@._\-]/g, '');

                this.value = val.trim();
            });
        }


        // ================== PASSWORD FIELDS ===================
        const newPass = document.querySelector("input[name='password']");
        const confirmPass = document.querySelector("input[name='password_confirmation']");

        function securePasswordField(field) {
            if (!field) return;

            // Block copy, paste, cut
            ["paste", "copy", "cut"].forEach(evt => {
                field.addEventListener(evt, e => e.preventDefault());
            });

            field.addEventListener("input", function () {
                let val = this.value;

                // Remove spaces
                val = val.replace(/\s/g, '');

                // Remove HTML & script tags
                val = val.replace(/<|>|script|{|}|\\/gi, '');

                this.value = val;
            });
        }

        securePasswordField(newPass);
        securePasswordField(confirmPass);


        // ================== CLEAN ON PAGE LOAD ===================
        document.addEventListener("DOMContentLoaded", function () {
            if (resetEmail && resetEmail.value.trim() === "") resetEmail.value = "";
        });
    </script>

</x-guest-layout>