<div id="univ-modal-overlay" class="univ-modal-overlay">
    <div class="univ-modal-container">

        <button type="button" id="univ-btn-back" class="univ-btn-back" style="display: none;">
            <img src="{{ asset('.\images\icons\left.png') }}" alt="Back">
        </button>

        <button id="univ-modal-close" class="univ-modal-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </button>

        <div class="univ-modal-left">
            <img src="{{ asset('images/form-images/leftimage.png') }}" alt="Study Abroad Expert"
                class="univ-left-image">
        </div>

        <div class="univ-modal-right">

            <div class="univ-modal-skyline"
                style="background-image: url('{{ asset('images/form-images/rightimage.png') }}');"></div>

            <div class="univ-modal-logo">
                <img src="{{ asset('new-home-images/wts-logo.png') }}" alt="WTS Logo">
            </div>

            <form id="univ-multi-step-form" method="POST" action="#">
                @csrf

                <div class="univ-step active" id="univ-step-1">
                    <h2>Choose your start date</h2>
                    <div class="univ-radio-group">
                        <label class="univ-radio-card">
                            <input type="radio" name="start_date" value="May 26">
                            <span class="univ-radio-content"><span class="univ-circle"></span> May 26</span>
                        </label>
                        <label class="univ-radio-card">
                            <input type="radio" name="start_date" value="Sep 26">
                            <span class="univ-radio-content"><span class="univ-circle"></span> Sep 26</span>
                        </label>
                        <label class="univ-radio-card">
                            <input type="radio" name="start_date" value="Jan 27">
                            <span class="univ-radio-content"><span class="univ-circle"></span> Jan 27</span>
                        </label>
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-2">
                    <h2>What Level of study you are <br> planning to pursue?</h2>
                    <div class="univ-radio-group">
                        <label class="univ-radio-card">
                            <input type="radio" name="level_of_study" value="Bachelors">
                            <span class="univ-radio-content"><span class="univ-circle"></span> Bachelors</span>
                        </label>
                        <label class="univ-radio-card">
                            <input type="radio" name="level_of_study" value="Masters">
                            <span class="univ-radio-content"><span class="univ-circle"></span> Masters</span>
                        </label>
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-3">
                    <h2>Choose your academic <br> specialisation</h2>
                    <div class="univ-input-group">
                        <label>Select your specialisation</label>
                        <input type="text" name="specialisation" class="univ-input">
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-4">
                    <h2>Your journey, your story <br> —start with your name</h2>
                    <div class="univ-input-group">
                        <label>First name</label>
                        <input type="text" name="first_name" class="univ-input">
                    </div>
                    <div class="univ-input-group">
                        <label>Last name</label>
                        <input type="text" name="last_name" class="univ-input">
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-5">
                    <h2>Let our experts help you take the<br>next step toward studying abroad.<br>How can we reach you?
                    </h2>
                    <div class="univ-input-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="univ-input">
                    </div>
                    <div class="univ-input-group">
                        <label>Mobile Number</label>
                        <div class="univ-phone-wrapper">
                            <select name="country_code" class="univ-country-select">
                                <option value="+91">🇮🇳 +91</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+98">🇮🇷 +98</option>
                                <option value="+81">🇯🇵 +81</option>
                            </select>
                            <input type="tel" name="mobile" class="univ-input univ-phone-input">
                        </div>
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-6">
                    <h2>We have sent you an OTP</h2>
                    <div class="univ-otp-container">
                        <input type="text" class="univ-otp-input" maxlength="1">
                        <input type="text" class="univ-otp-input" maxlength="1">
                        <input type="text" class="univ-otp-input" maxlength="1">
                        <input type="text" class="univ-otp-input" maxlength="1">
                        <input type="text" class="univ-otp-input" maxlength="1">
                        <input type="text" class="univ-otp-input" maxlength="1">
                    </div>
                    <p class="univ-resend-text">didn't receive code ? <a href="#">Resend Code</a></p>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-7">
                    <div class="univ-input-group" style="margin-bottom: 25px;">
                        <h2 style="font-size: 18px; margin-bottom: 10px;">How do you plan to fund your education?</h2>
                        <input type="text" name="fund_plan" class="univ-input">
                    </div>
                    <div class="univ-input-group">
                        <h2 style="font-size: 18px; margin-bottom: 10px;">Almost there. What is the
                            approximate<br>budget you have in mind?</h2>
                        <input type="text" name="budget" class="univ-input">
                    </div>
                    <button type="button" class="univ-btn-next" style="margin-top: 20px;">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-8">
                    <h2>Great! Let's move to education. What's<br>your academic history?</h2>

                    <div class="univ-grid-2">
                        <div class="univ-input-group">
                            <label>10th percentile</label>
                            <input type="text" name="10th_percentile" class="univ-input">
                        </div>
                        <div class="univ-input-group">
                            <label>Year Of Passing</label>
                            <input type="text" name="10th_year" class="univ-input">
                        </div>
                    </div>

                    <div class="univ-grid-2">
                        <div class="univ-input-group">
                            <label>12th percentile</label>
                            <input type="text" name="12th_percentile" class="univ-input">
                        </div>
                        <div class="univ-input-group">
                            <label>Year Of Passing</label>
                            <input type="text" name="12th_year" class="univ-input">
                        </div>
                    </div>
                    <button type="button" class="univ-btn-next">NEXT</button>
                </div>

                <div class="univ-step" id="univ-step-9">
                    <div class="final-content-wrapper">
                        <div class="univ-modal-logo">
                            <img src="{{ asset('new-home-images/wts-logo.png') }}" alt="WTS Logo">
                        </div>

                        <h2>Yay! Thanks for<br>sharing your details</h2>

                        <button type="submit" class="univ-btn-submit">Talk to our expert now</button>

                        <p class="univ-thank-you-sub">Our in-house experts will evaluate<br>your profile and reach out
                            to you</p>

                        <div class="univ-footer-contact">
                            <p>Need Counselling Faster? Call us at:</p>
                            <h4> <i class="fa-solid fa-phone"></i> 18001028670</h4>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --univ-orange: #f37021;
        --univ-dark: #2a2a2a;
        --univ-gray: #777;
        --univ-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        --univ-input-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .univ-modal-overlay * {
        box-sizing: border-box;
    }

    .univ-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        font-family: 'Poppins', sans-serif;
        padding: 15px;
        backdrop-filter: blur(3px);
    }

    .univ-modal-overlay.active {
        display: flex;
    }

    .univ-modal-container {
        display: flex;
        width: 100%;
        max-width: 850px;
        height: 550px;
        background: #fff;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        box-shadow: var(--univ-shadow);
        animation: univSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes univSlideUp {
        0% {
            transform: translateY(30px) scale(0.95);
            opacity: 0;
        }

        100% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    /* Close & Back Buttons */
    .univ-modal-close,
    .univ-btn-back {
        position: absolute;
        top: 20px;
        background: none;
        border: none;
        cursor: pointer;
        z-index: 20;
        padding: 5px;
        display: flex;
        transition: transform 0.2s;
    }

    .univ-modal-close {
        right: 20px;
    }

    .univ-btn-back {
        left: 20px;
    }

    .univ-btn-back img {
        width: 24px;
        height: 24px;
        opacity: 0.7;
    }

    .univ-modal-close:hover,
    .univ-btn-back:hover {
        transform: scale(1.1);
    }

    /* Layout Left/Right */
    .univ-modal-left {
        flex: 0 0 40%;
        background: #e7a177;
        position: relative;
    }

    .univ-left-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .univ-modal-right {
        flex: 1;
        background: #fff;
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 30px 40px;
        overflow-y: auto;
    }

    .univ-modal-skyline {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 250px;
        background-repeat: no-repeat;
        background-position: bottom center;
        background-size: cover;
        opacity: 0.6;
        pointer-events: none;
        z-index: 1;
    }

    /* Form Area */
    .univ-modal-logo {
        text-align: center;
        margin-bottom: 15px;
        z-index: 2;
    }

    .univ-modal-logo img {
        height: 35px;
    }

    #univ-multi-step-form {
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
    }

    .univ-step {
        display: none;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
        justify-content: center;
        animation: univFadeIn 0.3s ease-in-out;
    }

    .univ-step.active {
        display: flex;
    }

    @keyframes univFadeIn {
        from {
            opacity: 0;
            transform: translateX(10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .univ-step h2 {
        font-size: 20px;
        font-weight: 600;
        color: var(--univ-dark);
        margin-bottom: 25px;
        line-height: 1.4;
    }

    /* Inputs & Layouts */
    .univ-input-group {
        width: 100%;
        max-width: 400px;
        text-align: left;
        margin-bottom: 15px;
    }

    .univ-input-group label {
        display: block;
        font-size: 13px;
        color: var(--univ-dark);
        font-weight: 600;
        margin-bottom: 6px;
    }

    .univ-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        box-shadow: var(--univ-input-shadow);
        outline: none;
        font-family: inherit;
        transition: all 0.2s;
    }

    .univ-input:focus {
        border-color: var(--univ-orange);
        box-shadow: 0 0 0 3px rgba(243, 112, 33, 0.1);
    }

    /* Phone Dropdown Styles */
    .univ-phone-wrapper {
        display: flex;
        width: 100%;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--univ-input-shadow);
        transition: all 0.2s;
        background: #fff;
    }

    .univ-phone-wrapper:focus-within {
        border-color: var(--univ-orange);
        box-shadow: 0 0 0 3px rgba(243, 112, 33, 0.1);
    }

    .univ-country-select {
        background: #f4f6f8;
        border: none;
        border-right: 1px solid #e0e0e0;
        padding: 12px 10px;
        font-family: inherit;
        font-size: 14px;
        color: var(--univ-dark);
        outline: none;
        cursor: pointer;
    }

    .univ-phone-input {
        border: none;
        box-shadow: none;
        border-radius: 0;
        flex: 1;
    }

    .univ-phone-input:focus {
        box-shadow: none;
    }

    .univ-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        width: 100%;
        max-width: 400px;
    }

    /* Radio Buttons */
    .univ-radio-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
        margin-bottom: 25px;
    }

    .univ-radio-card input {
        display: none;
    }

    .univ-radio-content {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: var(--univ-input-shadow);
        cursor: pointer;
        font-weight: 500;
        font-size: 14px;
        color: var(--univ-dark);
        transition: 0.2s;
    }

    .univ-circle {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid var(--univ-orange);
        display: inline-block;
        position: relative;
    }

    .univ-radio-card input:checked+.univ-radio-content {
        border-color: var(--univ-orange);
    }

    .univ-radio-card input:checked+.univ-radio-content .univ-circle::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: var(--univ-orange);
        border-radius: 50%;
    }

    /* OTP Boxes */
    .univ-otp-container {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 10px;
    }

    .univ-otp-input {
        width: 45px;
        height: 50px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        border: 1px solid var(--univ-orange);
        border-radius: 8px;
        box-shadow: var(--univ-input-shadow);
        outline: none;
        color: var(--univ-dark);
        transition: 0.2s;
    }

    .univ-otp-input:focus {
        box-shadow: 0 0 0 3px rgba(243, 112, 33, 0.2);
    }

    .univ-resend-text {
        font-size: 13px;
        color: var(--univ-dark);
        margin-bottom: 25px;
    }

    .univ-resend-text a {
        font-weight: 600;
        text-decoration: underline;
        color: var(--univ-dark);
    }

    /* Buttons */
    .univ-btn-next,
    .univ-btn-submit {
        background: var(--univ-orange);
        color: #fff;
        border: none;
        padding: 12px 70px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 30px;
        min-width: 180px;
        transition: 0.2s;
        box-shadow: 0 4px 10px rgba(243, 112, 33, 0.3);
    }

    .univ-btn-next:hover,
    .univ-btn-submit:hover {
        background: #e06015;
        transform: translateY(-2px);
    }

    /* Validation Errors */
    .univ-error-msg {
        color: red;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 15px;
    }

    /* Thank You Page */
    .univ-thank-you-sub {
        font-size: 14px;
        color: var(--univ-gray);
        margin-top: 15px;
        line-height: 1.5;
        font-weight: 500;
    }

    .univ-footer-contact {
        margin-top: auto;
        font-size: 13px;
        color: var(--univ-gray);
    }

    .univ-footer-contact h4 {
        color: var(--univ-dark);
        font-size: 18px;
        font-weight: 700;
        margin-top: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive */
    /* Responsive - Tightened up for Mobile */
    @media (max-width: 768px) {
        .univ-modal-left {
            display: none;
        }

        .univ-modal-container {
            max-width: 450px;
            height: auto;
            min-height: auto;
            /* Removes the forced tall height */
            border-radius: 20px;
        }

        .univ-modal-right {
            padding: 25px 20px 20px 20px;
            /* Reduced top/bottom padding */
        }

        .univ-step h2 {
            font-size: 18px;
            margin-bottom: 15px;
            /* Tighter heading margin */
        }

        .univ-btn-next,
        .univ-btn-submit {
            margin-top: 20px;
            /* Brings the button closer */
            padding: 10px 60px;
        }

        .univ-modal-skyline {
            height: 150px;
            /* Smaller skyline on mobile */
        }
    }

    @media (max-width: 480px) {
        .univ-radio-group {
            flex-direction: column;
            gap: 8px;
            /* Tighter gap between options */
            width: 100%;
            max-width: 300px;
            margin-bottom: 15px;
        }

        .univ-radio-content {
            width: 100%;
            justify-content: flex-start;
            padding: 10px 15px;
            /* Thinner buttons */
        }

        .univ-input-group {
            margin-bottom: 12px;
            /* Less space between inputs */
        }

        .univ-input {
            padding: 10px 14px;
            /* Thinner text boxes */
        }

        .univ-grid-2 {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .univ-otp-input {
            width: 35px;
            height: 42px;
            font-size: 16px;
        }

        .univ-modal-logo {
            margin-bottom: 10px;
        }

        .univ-modal-logo img {
            height: 30px;
            /* Slightly smaller logo */
        }
    }

    /* ===== FINAL STEP - COMPLETE REDESIGN ===== */

    /* When final step is active, transform the entire modal */
    /* ===== FINAL STEP - PIXEL PERFECT ===== */

    .is-final-step {
        max-width: 850px !important;
        height: 550px !important;
        overflow: hidden !important;
        background: none !important;
        position: relative !important;
    }

    /* Full BG image covers entire modal */
    .is-final-step::before {
        content: '' !important;
        position: absolute !important;
        inset: 0 !important;
        /* This layers a 40% opaque orange over your image */
        background-image:
            linear-gradient(rgba(255, 140, 0, 0.4), rgba(255, 140, 0, 0.4)),
            url('{{ asset("images/form-images/bgblur.png") }}') !important;
        background-size: cover !important;
        background-position: center !important;
        z-index: 0 !important;
        /* Changed to 0 to remove the corner radius as you requested */
        border-radius: 0 !important;
    }

    /* LEFT panel - transparent, holds girl image */
    .is-final-step .univ-modal-left {
        display: flex !important;
        flex: 0 0 42% !important;
        background: transparent !important;
        position: relative !important;
        z-index: 3 !important;
        align-items: flex-end !important;
        overflow: visible !important;
        height: auto;
    }

    /* Girl image - full height, bottom-anchored */
    .is-final-step .univ-left-image {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 110% !important;
        /* Slightly wider to overlap card */
        height: 100% !important;
        object-fit: contain !important;
        object-position: bottom center !important;
        transform: none !important;
        z-index: 3 !important;
    }

    /* RIGHT panel - transparent, centers the white card */
    .is-final-step .univ-modal-right {
        flex: 1 !important;
        background: transparent !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 20px 25px 20px 10px !important;
        position: relative !important;
        z-index: 2 !important;
        overflow: visible !important;
    }

    /* Hide skyline and top logo */
    .is-final-step .univ-modal-skyline {
        display: none !important;
    }

    .is-final-step>.univ-modal-right>.univ-modal-logo {
        display: none !important;
    }

    /* Form fills right panel */
    .is-final-step #univ-multi-step-form {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Step 9 */
    .is-final-step #univ-step-9 {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
        animation: none !important;
        padding: 0 !important;
    }

    /* WHITE CARD */
    .is-final-step .final-content-wrapper {
        background: #ffffff !important;
        border-radius: 24px !important;
        width: 100% !important;
        max-width: 380px !important;
        padding: 35px 30px 30px 30px !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18) !important;
        position: relative !important;
        z-index: 4 !important;
        gap: 0 !important;
    }

    /* Logo inside white card */
    .is-final-step .final-content-wrapper .univ-modal-logo {
        display: block !important;
        margin-bottom: 16px !important;
        text-align: center !important;
    }

    .is-final-step .final-content-wrapper .univ-modal-logo img {
        height: 42px !important;
    }

    /* Heading */
    .is-final-step .final-content-wrapper h2 {
        font-size: 24px !important;
        font-weight: 700 !important;
        color: #1a1a1a !important;
        margin-bottom: 22px !important;
        line-height: 1.35 !important;
    }

    /* Orange button - full width */
    .is-final-step .univ-btn-submit {
        background: var(--univ-orange) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 14px 0 !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        width: 100% !important;
        max-width: 320px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 14px rgba(243, 112, 33, 0.35) !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        transition: background 0.2s, transform 0.2s !important;
    }

    .is-final-step .univ-btn-submit:hover {
        background: #e06015 !important;
        transform: translateY(-2px) !important;
    }

    /* Subtext */
    .is-final-step .univ-thank-you-sub {
        font-size: 13.5px !important;
        color: #555 !important;
        margin-top: 16px !important;
        margin-bottom: 0 !important;
        line-height: 1.6 !important;
        font-weight: 400 !important;
    }

    /* Footer contact */
    .is-final-step .univ-footer-contact {
        margin-top: 18px !important;
        text-align: center !important;
    }

    .is-final-step .univ-footer-contact p {
        font-size: 13px !important;
        color: #777 !important;
        margin-bottom: 4px !important;
    }

    .is-final-step .univ-footer-contact h4 {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: #1a1a1a !important;
        margin: 0 !important;
        justify-content: center !important;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 768px) {
        .is-final-step {
            height: auto !important;
            min-height: 480px !important;
        }

        .is-final-step .univ-modal-left {
            display: none !important;
        }

        .is-final-step .univ-modal-right {
            padding: 30px 20px !important;
            justify-content: center !important;
        }

        .is-final-step .final-content-wrapper {
            max-width: 100% !important;
            padding: 28px 20px !important;
        }
    }
</style>

<script>document.addEventListener('DOMContentLoaded', function () {
        const triggerBtns = document.querySelectorAll('.uni-btn-apply');
        const modal = document.getElementById('univ-modal-overlay');
        const closeBtn = document.getElementById('univ-modal-close');
        const backBtn = document.getElementById('univ-btn-back');
        const form = document.getElementById('univ-multi-step-form');
        const steps = document.querySelectorAll('.univ-step');
        const nextBtns = document.querySelectorAll('.univ-btn-next');
        let currentStep = 0;

        // --- Modal Open/Close Logic ---
        triggerBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.add('active');
            });
        });

        function resetForm() {
            currentStep = 0;
            form.reset();
            steps.forEach(s => s.classList.remove('active'));
            steps[0].classList.add('active');
            backBtn.style.display = 'none';
            document.querySelectorAll('.univ-error-msg').forEach(e => e.remove());
            document.querySelectorAll('.univ-otp-input').forEach(i => i.style.borderColor = 'var(--univ-orange)');
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.classList.remove('active');
                setTimeout(resetForm, 300);
            });
        }

        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    setTimeout(resetForm, 300);
                }
            });
        }

        // --- Validation Logic ---
        function validateStep(index) {
            const step = steps[index];
            let isValid = true;
            const existingError = step.querySelector('.univ-error-msg');
            if (existingError) existingError.remove();

            function showError(msg) {
                const errorP = document.createElement('p');
                errorP.className = 'univ-error-msg';
                errorP.innerText = msg;
                step.insertBefore(errorP, step.querySelector('.univ-btn-next'));
            }

            if (index === 0) {
                if (!step.querySelector('input[name="start_date"]:checked')) {
                    isValid = false;
                    showError("Please select a start date to continue.");
                }
            } else if (index === 1) {
                if (!step.querySelector('input[name="level_of_study"]:checked')) {
                    isValid = false;
                    showError("Please select your level of study.");
                }
            } else if (index === 5) {
                const otpInputs = step.querySelectorAll('.univ-otp-input');
                otpInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        isValid = false;
                        input.style.borderColor = 'red';
                    } else {
                        input.style.borderColor = 'var(--univ-orange)';
                    }
                });
                if (!isValid) showError("Please enter the complete 6-digit OTP.");
            }

            return isValid;
        }

        // --- Navigation Logic ---
        function updateNavigation() {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === currentStep);
            });

            const container = document.querySelector('.univ-modal-container');
            const leftImg = document.querySelector('.univ-left-image');

            if (currentStep === 8) {
                container.classList.add('is-final-step');
                leftImg.src = "{{ asset('images/form-images/image 32.png') }}";
            } else {
                container.classList.remove('is-final-step');
                leftImg.src = "{{ asset('images/form-images/leftimage.png') }}";
            }

            if (currentStep > 0 && currentStep < steps.length - 1) {
                backBtn.style.display = 'block';
            } else {
                backBtn.style.display = 'none';
            }
        }

        // Initial state
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === currentStep);
        });

        // --- Next Button Click ---
        nextBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    if (currentStep < steps.length - 1) {
                        currentStep++;
                        updateNavigation();
                    }
                }
            });
        });

        // --- Back Button Click ---
        if (backBtn) {
            backBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateNavigation();
                }
            });
        }

        // --- OTP Input Auto-Advance Logic ---
        const otpInputs = document.querySelectorAll('.univ-otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
                e.target.style.borderColor = 'var(--univ-orange)';
                if (e.target.value !== '' && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

    }); // ← Single closing brace for DOMContentLoaded
</script>