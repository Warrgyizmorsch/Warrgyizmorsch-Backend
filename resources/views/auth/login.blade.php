<x-guest-layout>
  @php
$savedEmail = request()->cookie('remember_email');
$savedPassword = null;

if (request()->cookie('remember_password')) {
    try {
        $savedPassword = \Illuminate\Support\Facades\Crypt::decryptString(request()->cookie('remember_password'));
    } catch (\Exception $e) {
        $savedPassword = null;
    }
}
@endphp
    <style>
        {!! file_get_contents(public_path('css/custom-auth.css')) !!}
    </style>

    <div class="container">
        <div class="login-box">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf

                <div style="height: 60px; width: 190px"><img src="/images/logo-wts.png" alt=""></div>
                <span class="header">Login</span>

                <!-- Email -->
                <input type="email" name="email" class="input" placeholder="Email" value="{{ $savedEmail ?? old('email') }}" required
                    autofocus autocomplete="new-email">
                @error('email')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Password -->
                <input type="password" name="password" class="input" placeholder="Password" value="{{ $savedPassword ?? '' }}" required
                    autocomplete="new-password">
                @error('password')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Remember Me -->
                <label class="footer mt-2">
                    <input type="checkbox" name="remember" {{ $savedEmail ? 'checked' : '' }}>
                    Remember Me
                </label>

                <!-- Submit Button -->
                <button type="submit" class="button sign-in">Log In</button>

                <!-- Footer Links -->
                <p class="footer mt-3">
                    <a href="{{ route('password.request') }}" class="link">Forgot password?</a><br />
                    <!-- <span class="flex justify-between">
                        Don't have an account?
                        <a  class="link flex justify-end ml-auto">Sign up, it's free!</a>
                    </span>  route('register') --> 
                </p>
            </form>
        </div>
    </div>
    <script>
        // --------- EMAIL VALIDATION (safe characters only) ---------
        const loginEmail = document.querySelector("input[name='email']");

        if (loginEmail) {
            // ["paste", "copy", "cut"].forEach(evt => {
            //     loginEmail.addEventListener(evt, e => e.preventDefault());
            // });

            loginEmail.addEventListener("input", function() {
                this.value = this.value
                    .replace(/[^a-zA-Z0-9@._\-]/g, '') // allow safe email characters
                    .replace(/@{2,}/g, '@')
                    .trim();
            });
        }


        // --------- PASSWORD FIELD PROTECTION ---------
        const loginPass = document.querySelector("input[name='password']");

        if (loginPass) {
            loginPass.addEventListener("input", function() {
                this.value = this.value
                    .replace(/\s/g, '') // no spaces
                    .replace(/<|>|script|{|}|\\/gi, '');
            });

            // loginPass.addEventListener("paste", e => e.preventDefault());
            // loginPass.addEventListener("copy", e => e.preventDefault());
            // loginPass.addEventListener("cut", e => e.preventDefault());
        }


        // --------- CLEAN EMPTY SPACES ON PAGE LOAD so placeholder appears ---------
        document.addEventListener("DOMContentLoaded", function() {
            if (loginEmail && loginEmail.value.trim() === "") loginEmail.value = "";
            if (loginPass && loginPass.value.trim() === "") loginPass.value = "";
        });
    </script>

</x-guest-layout>