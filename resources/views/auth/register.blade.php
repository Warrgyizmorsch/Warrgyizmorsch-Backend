<x-guest-layout>
    <style>
        {!! file_get_contents(public_path('css/custom-auth.css')) !!}
    </style>

    <div class="container">
        <div class="login-box">
            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf

                <div style="height: 60px; width: 190px"><img src="/images/logo-wts.png" alt=""></div>
                <span class="header">Create Account</span>

                <!-- Name -->
                <input type="text" name="name" class="input" placeholder="Name" value="{{ old('name') }}" required
                    autofocus>
                @error('name')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Email -->
                <input type="email" name="email" class="input" placeholder="Email" value="{{ old('email') }}" required
                    autocomplete="off">
                @error('email')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Password -->
                <input type="password" name="password" class="input" placeholder="Password" required>
                @error('password')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Confirm Password -->
                <input type="password" name="password_confirmation" class="input" placeholder="Confirm Password"
                    required autocomplete="new-password">
                @error('password_confirmation')
                    <p style="color: red; font-size: 12px;">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <button type="submit" class="button sign-in">Register</button>

                <!-- Footer Links -->
                <p class="footer">
                    Already have an account?
                    <a href="{{ route('login') }}" class="link">Log in here</a>
                </p>
            </form>
        </div>
    </div>
    <script>
        // --------- NAME VALIDATION (letters + numbers + spaces) ---------
        const regName = document.querySelector("input[name='name']");
    
        if (regName) {
            regName.setAttribute("maxlength", "30");
    
            ["paste", "copy", "cut"].forEach(evt => {
                regName.addEventListener(evt, e => e.preventDefault());
            });
    
            regName.addEventListener("input", function () {
                this.value = this.value
                    .replace(/[^a-zA-Z0-9 ]/g, '')   // only letters + numbers + spaces
                    .replace(/\s{2,}/g, ' ')         // remove double spaces
                    .trimStart()                     // no leading spaces
                    .slice(0, 30);
            });
        }
    
    
        // --------- EMAIL VALIDATION (safe only) ---------
        const regEmail = document.querySelector("input[name='email']");
    
        if (regEmail) {
            ["paste"].forEach(evt => {
                regEmail.addEventListener(evt, e => e.preventDefault());
            });
    
            regEmail.addEventListener("input", function () {
                this.value = this.value
                    .replace(/[^a-zA-Z0-9@._\-]/g, '')   // only safe email chars
                    .trim();
            });
        }
    
    
        // --------- PASSWORD PREVENTION ---------
        const regPass = document.querySelector("input[name='password']");
        const regPass2 = document.querySelector("input[name='password_confirmation']");
    
        function preventBadPassword(input) {
            input.addEventListener("input", function () {
                this.value = this.value
                    .replace(/\s/g, '')   // no spaces in password
                    .replace(/<|>|script|{|}|\\/gi, '');
            });
    
            input.addEventListener("paste", e => e.preventDefault());
        }
    
        if (regPass) preventBadPassword(regPass);
        if (regPass2) preventBadPassword(regPass2);
    
    
        // --------- CLEAN EMPTY SPACES ON PAGE LOAD ---------
        document.addEventListener("DOMContentLoaded", function () {
            if (regName && regName.value.trim() === "") regName.value = "";
            if (regEmail && regEmail.value.trim() === "") regEmail.value = "";
        });
    </script>
</x-guest-layout>