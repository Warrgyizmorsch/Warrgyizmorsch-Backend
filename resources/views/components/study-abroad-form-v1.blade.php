@php
    $currentUrl = request()->fullUrl() ?? '';             
@endphp
<section class="fv1-form-section" id="fv1-form-section">
    <div class="fv1-container">
        {{-- LEFT PANEL – Progress --}}
        <aside class="fv1-progress-panel">
            <!-- Animated Heading -->
            <h1 class="fv1-title">
                <span class="fv1-title-gradient">Check Eligibility</span>
                <span class="fv1-title-underline"></span>
            </h1>

            <!-- Animated Steps -->
            <ol class="fv1-steps">
                <li class="fv1-step fv1-step--active" data-step="0">
                    <span class="fv1-step-number">
                        <span class="fv1-number-text">1</span>
                        <span class="fv1-check-icon">
                            <svg viewBox="0 0 16 16" width="10" height="10">
                                <path d="M2 8l4 4 8-8" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </span>
                    <span class="fv1-step-label">Preferences</span>
                </li>
                <li class="fv1-step" data-step="1">
                    <span class="fv1-step-number">
                        <span class="fv1-number-text">2</span>
                        <span class="fv1-check-icon">
                            <svg viewBox="0 0 16 16" width="10" height="10">
                                <path d="M2 8l4 4 8-8" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </span>
                    <span class="fv1-step-label">Education Details</span>
                </li>
                <li class="fv1-step" data-step="2">
                    <span class="fv1-step-number">
                        <span class="fv1-number-text">3</span>
                        <span class="fv1-check-icon">
                            <svg viewBox="0 0 16 16" width="10" height="10">
                                <path d="M2 8l4 4 8-8" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </span>
                    <span class="fv1-step-label">Contact Information</span>
                </li>
            </ol>
        </aside>

        {{-- RIGHT PANEL – Form --}}
        <div class="fv1-form-wrapper">
            <form id="fv1-form" method="POST" action="" class="fv1-form">
                @csrf
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="page_url" value="{{ $currentUrl }}">
                <input type="hidden" name="utm_source">
                <input type="hidden" name="utm_medium">
                <input type="hidden" name="utm_campaign">
                <input type="hidden" name="utm_term">

                {{-- STEP 1 --}}
                <div class="fv1-step-content fv1-step-0 fv1-step-active">
                    <h2 class="fv1-question">Your preferred study destination?</h2>
                    <div class="fv1-radio-group">
                        @php
                            $countryFlags = [
                                'Canada' => 'ca',
                                'UK' => 'gb',      // Fixed: Use 'gb' for UK
                                'USA' => 'us',
                                'Ireland' => 'ie',
                                'Australia' => 'au',
                                'NewZealand' => 'nz',
                                'Germany' => 'de',
                                'UAE' => 'ae',     // Fixed: Use 'ae' for UAE (United Arab Emirates)
                            ];
                        @endphp
                        @foreach([
                            'Canada' => 'Canada',
                            'UK' => 'UK',
                            'USA' => 'USA',
                            'Ireland' => 'Ireland',
                            'Australia' => 'Australia',
                            'NewZealand' => 'New Zealand',
                            'Germany' => 'Germany',
                            'UAE' => 'UAE',
                            'Other' => 'Other',
                        ] as $value => $label)
                            <label class="fv1-pill">
                                <input type="radio" name="preferredCountry" value="{{ $value }}" required>
                                <span class="fv1-pill-label">
                                    @if(isset($countryFlags[$value]))
                                        <img src="https://flagcdn.com/16x12/{{ $countryFlags[$value] }}.png" alt="{{ $label }} flag" class="fvs-flag" loading="lazy">
                                    @endif
                                    {{ $label }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <p class="fv1-warning" id="warn-country">Select one</p>

                    <h2 class="fv1-question">Which intake are you planning for?</h2>
                    <div class="fv1-radio-group fv1-intake-group">
                        @foreach([
                            'MAY_2026' => ['May 2026', false],
                            'SEP_2026' => ['Sep 2026', true],
                            'JAN_2027' => ['2027 Intake', false],
                        ] as $value => [$label, $rec])
                            <label class="fv1-pill">
                                <input type="radio" name="preferredIntake" value="{{ $value }}" required>
                                <span class="fv1-pill-label">
                                    {{ $label }}
                                    @if($rec)<span class="fv1-rec-badge">◉ Recommended</span>@endif
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <p class="fv1-warning" id="warn-intake">Select one</p>

                    <button type="button" class="fv1-btn fv1-btn-next">Continue</button>
                </div>

                {{-- STEP 2 --}}
                <div class="fv1-step-content fv1-step-1">
                    <button type="button" class="fv1-back-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                    </button>

                    <h2 class="fv1-question">What’s the highest education you’ve completed?</h2>
                    <div class="fv1-radio-group">
                        @foreach([
                            'TENTH'   => '10th',
                            'TWELFTH' => '12th',
                            'BACHELORS'=> 'Bachelor\'s',
                            'MASTERS' => 'Master\'s',
                            'DIPLOMA' => 'Diploma',
                        ] as $value => $label)
                            <label class="fv1-pill">
                                <input type="radio" name="highestLevelEducation" value="{{ $value }}" required>
                                <span class="fv1-pill-label">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="fv1-warning" id="warn-edu">Select one</p>

                    <h2 class="fv1-question">What is your current city?</h2>
                    <div class="fv1-city-wrapper">
                        <input 
                            type="text" 
                            name="city" 
                            id="city-input" 
                            class="fv1-input" 
                            placeholder="Type or select city" 
                            autocomplete="off"
                            required
                        >

                        <!-- Dropdown (shown while typing) -->
                        <div class="fv1-city-dropdown" id="city-dropdown"></div>
                    </div>
                    <p class="fv1-warning" id="warn-city">Enter or select a city</p>

                    <button type="button" class="fv1-btn fv1-btn-next">Continue</button>
                </div>

                {{-- STEP 3 --}}
                <div class="fv1-step-content fv1-step-2">
                    <button type="button" class="fv1-back-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                    </button>

                    <h2 class="fv1-question">Submit your details and take the first step toward studying abroad.</h2>

                    <input type="text" name="name" class="fv1-input" placeholder="Name" required>
                    <p class="fv1-warning" id="warn-name">Enter name</p>

                    <input type="tel" name="phone" class="fv1-input" placeholder="Phone" required>
                    <p class="fv1-warning" id="warn-phone">Valid phone</p>

                    <input type="email" name="email" class="fv1-input" placeholder="Email" required>
                    <p class="fv1-warning" id="warn-email">Valid email</p>

                    <p class="fv1-subtitle">P.S.: Your privacy matters to us. We don’t spam and misuse your data.</p>

                    <p class="fv1-warning" id="warn-submit" style="display:none;"></p>

                    <button type="submit" id="fv1-submit" class="fv1-btn">Start Journey</button>
                </div>

                {{-- STEP 4 – OTP Verification --}}
                <div class="fv1-step-content fv1-step-3" style="display:none;">
                    <button type="button" class="fv1-back-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                            <path fill="currentColor" d="M20 11H7.83l5.59-5.59L12 4l-8 8l8 8l1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                    </button>

                    <h2 class="fv1-question">Verify your number</h2>
                    <p class="fv1-subtitle">We sent a 6-digit OTP to your WhatsApp</p>

                    <div class="fv1-otp-wrapper">
                        <input 
                            type="text" 
                            id="fv1-otp-input" 
                            class="fv1-input" 
                            placeholder="Enter OTP" 
                            maxlength="6" 
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            required
                        >
                        <button type="button" id="fv1-verify-otp-btn" class="fv1-btn fv1-btn-verify">Verify OTP</button>
                    </div>

                    <!-- Warning message -->
                    <p class="fv1-warning" id="warn-otp">Invalid OTP. Please try again.</p>

                    <!-- Resend -->
                    <div id="fv1-otp-resend" style="margin-top:1rem; text-align:center; display:none;">
                        <button type="button" id="fv1-resend-otp" class="fv1-link-btn">
                            Resend OTP <span id="resend-timer"></span>
                        </button>
                    </div>
                </div>

                <div class="fv1-success" id="fv1-success">Thank you!</div>
                <div class="fv1-error" id="fv1-error">Error. Try again.</div>
            </form>
        </div>
    </div>

    {{-- ====================== CSS ====================== --}}
    <style>
        :root {
            --fv1-primary: #fc9118;
            --fv1-primary-light: #fc9218b3;
            --fv1-gray-100: #f8f9fa;
            --fv1-gray-200: #e2e8f0;
            --fv1-gray-600: #64748b;
            --fv1-gray-800: #1e293b;
            --fv1-gray-900: #0f172a;
            --fv1-danger: #e74c3c;
            --fv1-success: #059669;
            --fv1-radius: 12px;
            --fv1-shadow: 0 6px 16px rgba(0,0,0,.1);
            --fv1-text-light: #e2e8f0;
            --fv1-text-muted: #94a3b8;
        }

        * { box-sizing: border-box; margin:0; padding:0; }
        .fv1-form-section {
            display: flex;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            padding: 40px;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, sans-serif;
        }

        .fv1-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            gap: 2rem;
            background: #fff;
            border-radius: var(--fv1-radius);
            overflow: hidden;
            box-shadow: var(--fv1-shadow);
            max-height: calc(100vh - 80px);
        }

        
        .fv1-form-wrapper{flex:1;padding:1.5rem;overflow-y:auto;background:#fff;}
        .fv1-step-content{display:none;}
        .fv1-step-active{display:block!important;}

        .fv1-question{font-size:1.1rem;font-weight:600;margin:1.5rem 0 1.5rem;color:var(--fv1-gray-800);}
        .fv1-subtitle{font-size:.8rem;color:var(--fv1-gray-600);margin-bottom:1rem;}

        .fv1-radio-group{display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem;margin-bottom:.75rem;}
        .fv1-pill{position:relative;cursor:pointer;}
        .fv1-pill input{position:absolute;opacity:0;width:0;height:0;}
        .fv1-pill-label{display:flex;align-items:center;justify-content:center;gap:.35rem;padding:.5rem .75rem;background:var(--fv1-gray-100);border:1.5px solid var(--fv1-gray-200);border-radius:50px;font-size:.8rem;font-weight:500;transition:all .2s;}
        .fv1-pill input:checked + .fv1-pill-label{background:#fff;border-color:var(--fv1-primary);color:var(--fv1-primary);font-weight:600;}
        .fv1-rec-badge{background:#d1fae5;color:#065f46;font-size:.5rem;padding:.1rem .4rem;border-radius:1rem;margin-left:.3rem;}
        .fv1-flag{width:14px;height:10px;border-radius:1px;}

        .fv1-input{width:100%;padding:.6rem .8rem;border:1.5px solid var(--fv1-gray-200);border-radius:1.2rem;font-size:.9rem;margin-bottom:.4rem;transition:border .2s;}
        .fv1-input:focus{outline:none;border-color:var(--fv1-primary);box-shadow:0 0 0 2px rgba(94,59,255,.15);}

        .fv1-city-wrapper{position:relative;margin-bottom:.75rem;}
        .fv1-city-dropdown{
            position:absolute;top:100%;left:0;right:0;
            background:#fff;border:1.5px solid var(--fv1-gray-200);
            border-radius:8px;box-shadow:var(--fv1-shadow);
            max-height:180px;overflow-y:auto;z-index:20;
            display:none;margin-top:.25rem;
        }
        .fv1-city-item{
            padding:.6rem .75rem;font-size:.85rem;cursor:pointer;
            border-bottom:1px solid #f1f5f9;
        }
        .fv1-city-item:hover{background:#f1f5f9;}
        .fv1-city-item.no-result{font-style:italic;color:#888;cursor:default;}

        .fv1-warning{color:var(--fv1-danger);font-size:.75rem;margin-top:.2rem;display:none;}
        .fv1-warning.show{display:block;}

        .fv1-btn{
            background:linear-gradient(135deg,var(--fv1-primary),var(--fv1-primary-light));
            color:#fff;border:none;padding:.75rem 1.5rem;font-size:.95rem;
            font-weight:600;border-radius:50px;cursor:pointer;width:100%;
            margin-top:1.25rem;transition:all .2s;
        }
        .fv1-btn:hover{transform:translateY(-2px);}
        .fv1-back-btn{background:none;border:none;cursor:pointer;padding:.35rem;color:var(--fv1-gray-600);}

        .fv1-success,.fv1-error{margin-top:1.5rem;padding:.75rem;border-radius:8px;text-align:center;font-size:.9rem;font-weight:600;display:none;}
        .fv1-success{background:#d1fae5;color:var(--fv1-success);}
        .fv1-error{background:#fecaca;color:#991b1b;}

        @media (max-width:768px){
            .fv1-container{flex-direction:column;max-height:none;}
            .fv1-title{margin-bottom:1rem;font-size:1.1rem;}
            .fv1-steps{flex-direction:row;justify-content:center;gap:1rem;}
            .fv1-step{flex-direction:column;font-size:.8rem;}
            .fv1-step-number{margin-bottom:.2rem;width:24px;height:24px;font-size:.7rem;}
            .fv1-form-wrapper{padding:1.25rem;}
            .fv1-radio-group{grid-template-columns:1fr 1fr;}
        }

        /* Only on mobile screens below 500px */
        @media (max-width: 500px) {

            .fv1-intake-group {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .fv1-intake-group .fv1-pill {
                width: 100%;
            }

            .fv1-intake-group .fv1-pill-label {
                width: 100%;
                justify-content: space-between;
            }
        }


        /* === PROGRESS PANEL === */
        .fv1-progress-panel {
            flex: 0 0 260px;
            background: linear-gradient(180deg, #252525 0%, #252525 100%);
            padding: 2rem 1.5rem;
            color: white;
            position: relative;
        }

        /* === HEADING === */
        .fv1-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            text-align: center;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .fv1-title-gradient {
            background: linear-gradient(135deg, #f97316, #fb923c, #f97316);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fv1-gradient-shift 3s ease infinite;
        }

        @keyframes fv1-gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .fv1-title-underline {
            position: absolute;
            bottom: -8px;
            left: 50%;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #f97316, transparent);
            border-radius: 2px;
            transform: translateX(-50%);
            opacity: 0;
            animation: fv1-underline-reveal 1.2s ease-out forwards;
        }

        @keyframes fv1-underline-reveal {
            0% { width: 0; opacity: 0; }
            60% { width: 80px; opacity: 1; }
            100% { width: 60px; opacity: 1; }
        }

        /* === STEPS === */
        .fv1-steps {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .fv1-step {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.75rem;
            font-weight: 500;
            color: #94a3b8;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .fv1-step:hover {
            color: #e2e8f0;
            transform: translateX(4px);
        }

        .fv1-step--active {
            color: white;
            font-weight: 600;
        }

        .fv1-step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #334155;
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 0 0 rgba(249, 115, 22, 0);
        }

        .fv1-number-text {
            transition: all 0.3s ease;
            z-index: 2;
        }

        .fv1-check-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .fv1-check-icon svg {
            stroke: white;
        }

        /* Active State */
        .fv1-step--active .fv1-step-number {
            background: linear-gradient(135deg, #f97316, #fb923c);
            color: white;
            box-shadow: 0 0 0 6px rgba(249, 115, 22, 0.3);
            animation: fv1-step-glow 0.6s ease-out;
        }

        @keyframes fv1-step-glow {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7); }
            70% { box-shadow: 0 0 0 12px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 6px rgba(249, 115, 22, 0.3); }
        }

        /* Completed State */
        .fv1-step--completed .fv1-step-number {
            background: #10b981;
            color: white;
        }

        .fv1-step--completed .fv1-number-text {
            opacity: 0;
            transform: scale(0);
        }

        .fv1-step--completed .fv1-check-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            animation: fv1-check-pop 0.4s ease-out 0.1s forwards;
        }

        @keyframes fv1-check-pop {
            0% { transform: translate(-50%, -50%) scale(0); }
            60% { transform: translate(-50%, -50%) scale(1.15); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        .fv1-step-label {
            transition: color 0.3s ease;
        }

        /* OTP Step Styles */
        .fv1-otp-wrapper {
            display: flex;
            gap: .5rem;
            align-items: center;
            margin-bottom: .5rem;
        }
        #fv1-otp-input {
            flex: 1;
            margin-bottom: 0 !important;
        }
        .fv1-btn-verify {
            width: auto;
            padding: .6rem 1.2rem;
            font-size: .9rem;
            margin-top: 0 !important;
        }
        .fv1-link-btn {
            background: none;
            border: none;
            color: var(--fv1-primary);
            font-size: .85rem;
            cursor: pointer;
            text-decoration: underline;
        }
        .iti {
            width: 100% !important;
            margin-bottom:.4rem !important;
        }
        .iti--separate-dial-code .iti__selected-flag {
            background-color: transparent !important;
        }
    </style>

    {{-- ====================== JS ====================== --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('fv1-form');
            const steps = document.querySelectorAll('.fv1-step-content');
            const progressItems = document.querySelectorAll('.fv1-step');
            const nextBtns = document.querySelectorAll('.fv1-btn-next');
            const backBtns = document.querySelectorAll('.fv1-back-btn');
            const submitBtn = document.getElementById('fv1-submit');
            const verifyBtn = document.getElementById('fv1-verify-otp-btn');
            const resendBtn = document.getElementById('fv1-resend-otp');
            const otpInput = document.getElementById('fv1-otp-input');
            const warnOtp = document.getElementById('warn-otp');
            const otpResend = document.getElementById('fv1-otp-resend');
            const resendTimer = document.getElementById('resend-timer');
            const successMsg = document.getElementById('fv1-success');
            const errorMsg = document.getElementById('fv1-error');

            let currentStep = 0;
            let phoneInstance;
            let leadId = null;
            let resendCountdown = 0;

            // Initialize intl-tel-input
            const phoneInput = document.querySelector('input[name="phone"]');
            phoneInstance = window.intlTelInput(phoneInput, {
                separateDialCode: true,
                preferredCountries: ["in"],
                hiddenInput: "full",
                utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
            });

            const showStep = idx => {
                steps.forEach((s,i) => s.classList.toggle('fv1-step-active', i===idx));
                progressItems.forEach((p,i) => {
                    p.classList.remove('fv1-step--active','fv1-step--completed');
                    if (i < idx) p.classList.add('fv1-step--completed');
                    if (i === idx) p.classList.add('fv1-step--active');
                });
                form.querySelector('input[name="current_step"]').value = idx+1;
                currentStep = idx;

                // === CRITICAL: RESET STATE WHEN BACK TO CONTACT ===
                if (idx === 2) {
                    leadId = null;
                    document.getElementById('warn-submit').style.display = 'none';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Start Journey';
                }
            };

            const getRadio = n => form.querySelector(`input[name="${n}"]:checked`)?.value || null;

            const validateStep = step => {
                let ok = true;
                document.querySelectorAll('.fv1-warning').forEach(w => w.classList.remove('show'));

                if (step === 0) {
                    const c = getRadio('preferredCountry'), i = getRadio('preferredIntake');
                    if (!c) document.getElementById('warn-country').classList.add('show');
                    if (!i) document.getElementById('warn-intake').classList.add('show');
                    ok = c && i;
                }
                if (step === 1) {
                    const e = getRadio('highestLevelEducation'), city = form.city.value.trim();
                    if (!e) document.getElementById('warn-edu').classList.add('show');
                    if (!city) document.getElementById('warn-city').classList.add('show');
                    ok = e && city;
                }
                if (step === 2) {
                    const n = form.name.value.trim(),
                        p = phoneInstance.getNumber(intlTelInputUtils.numberFormat.E164),
                        e = form.email.value.toLowerCase();

                    const pOk = /^\+91[6-9]\d{9}$/.test(p);
                    const eOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e);

                    if (!n) document.getElementById('warn-name').classList.add('show');
                    if (!pOk) document.getElementById('warn-phone').classList.add('show');
                    if (!eOk) document.getElementById('warn-email').classList.add('show');

                    ok = n && pOk && eOk;
                }
                return ok;
            };

            // Navigation
            nextBtns.forEach(b => b.addEventListener('click', () => {
                if (validateStep(currentStep) && currentStep < 2) showStep(currentStep + 1);
            }));
            backBtns.forEach(b => b.addEventListener('click', () => {
                if (currentStep > 0) showStep(currentStep - 1);
            }));

            // City Autocomplete
            const cityInput = document.getElementById('city-input');
            const cityDropdown = document.getElementById('city-dropdown');
            const topCities = ["Bengaluru, Karnataka", "Chennai, Tamil Nadu", "Hyderabad, Telangana", "Kolkata, West Bengal", "Ludhiana, Punjab", "Mumbai, Maharashtra", "New Delhi, Delhi", "Pune, Maharashtra"].sort();

            const renderDropdown = list => {
                if (!list.length) {
                    cityDropdown.innerHTML = '<div class="fv1-city-item no-result">No cities found – type manually</div>';
                } else {
                    cityDropdown.innerHTML = list.map(c => `<div class="fv1-city-item">${c}</div>`).join('');
                }
                cityDropdown.querySelectorAll('.fv1-city-item:not(.no-result)').forEach(el => {
                    el.addEventListener('click', () => {
                        cityInput.value = el.textContent.trim();
                        cityDropdown.style.display = 'none';
                    });
                });
            };

            let timer;
            const filterCities = () => {
                const q = cityInput.value.trim().toLowerCase();
                const filtered = topCities.filter(c => c.toLowerCase().includes(q));
                renderDropdown(filtered);
                cityDropdown.style.display = filtered.length ? 'block' : 'none';
            };

            cityInput.addEventListener('input', () => {
                clearTimeout(timer);
                timer = setTimeout(filterCities, 200);
            });
            cityInput.addEventListener('focus', filterCities);
            document.addEventListener('click', e => {
                if (!cityInput.contains(e.target) && !cityDropdown.contains(e.target)) {
                    cityDropdown.style.display = 'none';
                }
            });

            // === SUBMIT → CREATE LEAD + SHOW OTP ===
            submitBtn.addEventListener('click', async e => {
                e.preventDefault();
                if (!validateStep(2)) return;

                // Hide any previous submit error
                document.getElementById('warn-submit').style.display = 'none';

                submitBtn.disabled = true;
                submitBtn.textContent = 'Please wait...';

                const payload = {
                    name: form.name.value,
                    email: form.email.value.toLowerCase(),
                    phone: phoneInstance.getNumber(intlTelInputUtils.numberFormat.E164),
                    preferredCountry: getRadio('preferredCountry'),
                    preferredIntake: getRadio('preferredIntake'),
                    highestLevelEducation: getRadio('highestLevelEducation'),
                    city: form.city.value,
                    page_url: form.querySelector('input[name="page_url"]').value, 
                    // ONLY REQUIRED UTMs
                    utm_source: form.querySelector('input[name="utm_source"]').value,
                    utm_medium: form.querySelector('input[name="utm_medium"]').value,
                    utm_campaign: form.querySelector('input[name="utm_campaign"]').value,
                    utm_term: form.querySelector('input[name="utm_term"]').value,
                };

                try {
                    const res = await fetch('{{ route('landing.page.submit') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json();

                    if (data.success && data.show_otp_step) {
                        leadId = data.lead_id;
                        showStep(3);
                        otpInput.focus();
                        startResendTimer();
                        sendOtp();
                    } else {
                        // SHOW EXACT BACKEND ERROR
                        const warnSubmit = document.getElementById('warn-submit');
                        warnSubmit.textContent = data.message || 'Something went wrong. Please try again.';
                        warnSubmit.style.display = 'block';
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Start Journey';
                    }
                } catch (err) {
                    const warnSubmit = document.getElementById('warn-submit');
                    warnSubmit.textContent = 'Network error. Please check your connection.';
                    warnSubmit.style.display = 'block';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Start Journey';
                }
            });

            // === SEND OTP ===
            const sendOtp = async () => {
                const full = phoneInstance.getNumber(intlTelInputUtils.numberFormat.E164);
                try {
                    const res = await fetch('{{ route('landing.page.send.otp') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ phone: full, lead_id: leadId })
                    });
                    const data = await res.json();
                    if (data.success) {
                        otpResend.style.display = 'block';
                        startResendTimer();
                    }
                } catch (e) { console.error(e); }
            };

            // === RESEND TIMER ===
            const startResendTimer = () => {
                resendCountdown = 30;
                resendBtn.disabled = true;
                resendTimer.textContent = ` in ${resendCountdown}s`;

                const interval = setInterval(() => {
                    resendCountdown--;
                    if (resendCountdown <= 0) {
                        clearInterval(interval);
                        resendBtn.disabled = false;
                        resendTimer.textContent = '';
                    } else {
                        resendTimer.textContent = ` in ${resendCountdown}s`;
                    }
                }, 1000);
            };

            // === VERIFY OTP (FIXED) ===
            verifyBtn.addEventListener('click', async () => {
                const otp = otpInput.value.trim();

                // === 1. Reset warning ===
                warnOtp.classList.remove('show');
                warnOtp.textContent = 'Invalid OTP. Please try again.';

                // === 2. Validate format ===
                if (!/^\d{6}$/.test(otp)) {
                    warnOtp.classList.add('show');
                    otpInput.focus();
                    return;
                }

                // === 3. Disable button ===
                verifyBtn.disabled = true;
                verifyBtn.textContent = 'Verifying...';

                try {
                    const res = await fetch('{{ route('landing.page.verify.otp') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            phone: phoneInstance.getNumber(intlTelInputUtils.numberFormat.E164),
                            otp,
                            lead_id: leadId
                        })
                    });
                    const data = await res.json();

                    // === 4. SUCCESS ===
                    if (data.success) {
                        successMsg.style.display = 'block';
                        otpInput.addEventListener('input', () => {
                            warnOtp.classList.remove('show');
                        });
                        setTimeout(() => {
                            window.location.href = '{{ route('thank-you') }}';
                        }, 1500);
                        return;
                    }

                    // === 5. FAILURE: SHOW REAL MESSAGE ===
                    warnOtp.textContent = data.message || 'Invalid OTP. Please try again.';
                    warnOtp.classList.add('show');

                    // === 6. CLEAR & REFOCUS ===
                    otpInput.value = '';
                    otpInput.focus();

                } catch (e) {
                    warnOtp.textContent = 'Network error. Try again.';
                    warnOtp.classList.add('show');
                    otpInput.value = '';
                    otpInput.focus();
                } finally {
                    verifyBtn.disabled = false;
                    verifyBtn.textContent = 'Verify OTP';
                }
            });
            // === RESEND OTP ===
            resendBtn.addEventListener('click', () => {
                otpInput.value = '';
                warnOtp.classList.remove('show');
                sendOtp();
            });

            // Auto-focus OTP input on step change
            const observer = new MutationObserver(() => {
                if (currentStep === 3 && document.activeElement !== otpInput) {
                    otpInput.focus();
                }
            });
            observer.observe(document.querySelector('.fv1-step-3'), { attributes: true });

            showStep(0);
        });

        // BLOCK SPECIAL CHARACTERS IN ALL INPUTS, Except @ allowed only in email field
        document.querySelectorAll('.fv1-input').forEach(input => {
            input.addEventListener('input', function (e) {

                let value = this.value;

                // For email field → allow letters, numbers, @, ., _, -, numbers
                if (this.name === 'email') {
                    this.value = value.replace(/[^a-zA-Z0-9@._-]/g, ''); 
                    return;
                }

                // For phone → allow only numbers
                if (this.name === 'phone') {
                    this.value = value.replace(/[^0-9]/g, '').slice(0, 15);
                    return;
                }

                // For OTP → only numbers
                if (this.id === 'fv1-otp-input') {
                    this.value = value.replace(/[^0-9]/g, '');
                    return;
                }

                // For all other fields → letters, numbers, and space only
                this.value = value.replace(/[^a-zA-Z0-9 ]/g, '').slice(0, 30);
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);

            const utms = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term'];

            utms.forEach(key => {
                const input = document.querySelector(`input[name="${key}"]`);
                if (input) {
                    input.value = params.get(key) || null;
                }
            });
        });
    </script>

</section>