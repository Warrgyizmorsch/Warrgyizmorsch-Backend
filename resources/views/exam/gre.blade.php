@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* FORCE SAME SIDE SPACING AS OTHER PAGES */

        .registration-form {
            max-width: 350px !important;
            margin: 0;
            margin-left: auto;
            width: auto !important;
        }

        /* .newcontainer {
                                        max-width: 1200px !important;
                                        margin: 0 auto !important;
                                        padding-left: 20px !important;
                                        padding-right: 20px !important;
                                    } */

        /* HERO FIX */
        .ielts-hero-fix {
            padding-top: 5px !important;
        }

        .hero-form {
            max-width: 520px !important;
            width: 100% !important;
        }

        .hero-main {
            position: relative;
            background: url('images/WTS TOEFL.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 60px 0;
        }

        .home-hero-content p {
            color: black !important;
        }

        .hero-main>.hero-content-wrapper {
            z-index: 1;
        }


        .ielts-image-wrap {
            position: relative;
        }

        .ielts-image-wrap img {
            width: 100%;
            border-radius: 20px;
            display: block;
        }

        .green-check {
            color: #22c55e;
            margin-right: 6px;
        }


        .herov1-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        /* FORCE CTA BUTTON STYLE */

        .herov1-btn {
            background: var(--primary-color) !important;
            color: #fff !important;
            padding: 12px 28px !important;
            border-radius: 30px !important;
            font-weight: 800 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            text-decoration: none !important;
            box-shadow: 0 6px 15px rgba(0, 0, 0, .2) !important;
        }

        .herov1-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .25);
        }


        /* MOBILE */
        @media(max-width:768px) {

            .hero-content-wrapper {
                flex-direction: column !important;
            }

            .ielts-hero-fix {
                padding-top: 60px !important;
            }

        }

        /* GLOBAL RESPONSIVE FIX FOR GRE PAGE */

        @media(max-width:1200px) {
            .container {
                max-width: 100% !important;
                padding: 0 20px !important;
            }
        }

        @media(max-width:992px) {

            .hero-content-wrapper {
                flex-direction: column !important;
                gap: 40px;
            }

            .home-hero-content,
            .hero-form {
                width: 100% !important;
                position: static !important;
                margin-top: 25px;
            }


        }

        @media(max-width:768px) {

            .hero-title {
                font-size: 35px !important;
            }

            .ielts-overview-title,
            .ielts-metrics h2 {
                font-size: 26px !important;
            }

            .metric-number {
                font-size: 28px !important;
            }

            .metrics-grid {
                grid-template-columns: 1fr 1fr !important;
            }

        }

        @media(max-width:480px) {

            .metrics-grid {
                grid-template-columns: 1fr !important;
            }

            .hero-title {
                font-size: 28px !important;
            }

            .herov1-btn {
                width: 100% !important;
                justify-content: center;
            }

        }

        .open-popup {
            position: relative;
        }

        .popup-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .popup-box button {
            width: 100%;
            background: var(--primary-color);
            border: none;
            color: #fff;
            padding: 12px;
            border-radius: 8px;
        }

        .popup-box {
            text-align: left;
        }

        .phone-wrap {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px 0;
            height: 44px;
        }

        .phone-wrap select {
            border: none;
            background: #fff;
            padding: 0 10px;
            outline: none;
            height: 100%;
        }

        .phone-wrap input {
            border: none;
            flex: 1;
            padding: 0 12px;
            outline: none;
            height: 100%;
        }

        .home-hero-content {
            max-width: 520px;
        }

        .hero-title {
            line-height: 1.2;
        }

        .home-hero-content p {
            line-height: 1.6;
            margin: 15px 0 22px;
        }


        @media(max-width:768px) {

            .hero-content-wrapper {
                display: flex !important;
                flex-direction: column !important;
            }

            .home-hero-content {
                order: 1;
            }

            .hero-form {
                order: 2;
            }

            .ielts-image-wrap {
                display: flex;
                flex-direction: column;
            }


            .ielts-image-wrap img {
                order: 1;
            }

            .herov1-btn {
                order: 4;
            }

            .home-hero-content p {
                order: 3;
            }

        }

        .form-group {
            width: 100%;
            margin: 8px 0 12px;
        }

        .terms-label {
            display: inline-flex;
            justify-content: left;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #333;
            white-space: nowrap;
        }

        .terms-label input {
            margin: 0;
        }

        .terms-label a {
            color: var(--primary-color);
            text-decoration: underline;
        }
    </style>

    <!-- HERO SECTION -->

    <section id="bookingSection" class="hero-main ielts-hero-fix">

        <div class="hero-content-wrapper container">

            <!-- LEFT -->

            <div class="home-hero-content container">

                <h1 class="hero-title" style="color:var(--primary-color)">
                    Best GRE Coaching in {{ $cityName }}<br>
                    <span style="color:black">Structured Prep & Proven Results</span>
                </h1>

                <ul style="margin:18px 0;padding-left:0;">
                    <p style="color:black">Searching for reliable GRE preparation in {{ $cityName }}? At WTS Study Abroad
                        Consultant, we provide result-driven GRE Classes in {{ $cityName }} with updated study material,
                        real exam-level mock tests, and one-on-one mentoring. Enrol in the Best GRE Coaching in
                        {{ $cityName }} with flexible classroom and online training options to reach your desired score
                        confidently.
                    </p>
                </ul>

                <a href="javascript:void(0)" class="herov1-btn js-open-custom-study-modal">Book Free Demo Class</a>

            </div>

            <!-- RIGHT -->

            <div class="hero-form">

                <div class="ielts-image-wrap">

                    <div class="band-box">

                        <!-- @php
                                                            $cityName = $cityName ?? '';
                                                            $currentUrl = request()->fullUrl() ?? '';             
                                                        @endphp -->
                        <div id="registrationModals" class="registration-form ">
                            <h2 style="margin: 0px;">Book Your Free GRE Demo Class</h2>
                            <form id="registrationForm" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="name" name="name" required placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="tel" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        maxlength="10" name="phone_number[main]" id="phone_number" />

                                </div>

                                <div class="form-group">
                                    <input type="email" id="email" name="email" required placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="text" id="visa-country" name="visa_country" required
                                        placeholder="Purpose of GRE">
                                </div>
                                <div class="form-group visaHideInput">
                                    <select id="visa-type" name="visa_type" required>
                                        <option value="" disabled>Select Visa Type</option>
                                        <option value="Student Visa" selected>Student Visa</option>
                                    </select>
                                </div>

                                <div class="radio-group-wrapper visaHideInput">
                                    <label class="group-title">Select Your Preferred Counselling Mode:</label>
                                    <div class="custom-radio-group" role="group" aria-label="Counselling Mode">
                                        <input type="radio" name="counselling_mode" value="Phone" id="radioPhone" checked>
                                        <label for="radioPhone">
                                            <span class="icon"><i class="fas fa-phone"></i></span>
                                            <span class="text">Phone Call</span>
                                        </label>

                                        <input type="radio" name="counselling_mode" value="Video" id="radioVideo">
                                        <label for="radioVideo">
                                            <span class="icon"><i class="fas fa-laptop-code"></i></span>
                                            <span class="text">Video Session</span>
                                        </label>

                                        <input type="radio" name="counselling_mode" value="Home" id="radioHome">
                                        <label for="radioHome">
                                            <span class="icon"><i class="fas fa-home"></i></span>
                                            <span class="text">In-Home Visit</span>
                                        </label>
                                    </div>
                                </div>

                                <input type="hidden" name="city" value="{{ $cityName }}">
                                <input type="hidden" name="page_url" value="{{ $currentUrl }}">

                                <div class="form-group">
                                    <label style="display: flex; align-items: center; font-size: 13px; color: #ffcc00;">
                                        <input type="checkbox" id="termsCheckbox" name="tac_check"
                                            style="margin-right: 8px;">
                                        I agree to the&nbsp;<a href="/terms-and-conditions" target="_blank"
                                            style="color: #fff; text-decoration: underline;">Terms & Conditions</a>
                                    </label>
                                </div>

                                <button type="submit" class="submit-btn">Submit</button>
                            </form>
                        </div>

                        <!-- Include jQuery, SweetAlert and intl-tel-input libraries -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"
                            rel="stylesheet" />
                        <script
                            src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

                        <script>


                            // Initialize the intl-tel-input library for phone number input
                            var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
                                separateDialCode: true,
                                preferredCountries: ["in"],
                                hiddenInput: "full",
                                utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
                            });

                            $(document).ready(function () {
                                // Hide counselling mode by default
                                $('.radio-group-wrapper').hide();

                                // Show it only if "Student Visa" is already selected
                                if ($('#visa-type').val() === 'Student Visa') {
                                    $('.radio-group-wrapper').show();
                                }

                                // Watch for changes in visa type
                                $('#visa-type').on('change', function () {
                                    if ($(this).val() === 'Student Visa') {
                                        $('.radio-group-wrapper').slideDown();
                                    } else {
                                        $('.radio-group-wrapper').slideUp();
                                        $('input[name="counselling_mode"]').prop('checked', false); // Optional reset
                                    }
                                });
                            });

                            $("form").submit(function (e) {
                                e.preventDefault(); // Prevent the default form submission



                                // Check if "Student Visa" is selected
                                if ($('#visa-type').val() === 'Student Visa') {
                                    // Then ensure counselling mode is selected
                                    if (!$("input[name='counselling_mode']:checked").val()) {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Counselling Mode Required',
                                            text: 'Please select your preferred counselling mode before submitting the form.',
                                            confirmButtonText: 'Okay'
                                        });
                                        return; // Stop form submission
                                    }
                                }

                                // Check if Terms & Conditions is checked
                                if (!$('#termsCheckbox').is(':checked')) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Terms & Conditions',
                                        text: 'Please agree to the Terms & Conditions before submitting.',
                                        confirmButtonText: 'Okay'
                                    });
                                    return;
                                }

                                // Disable the submit button to prevent multiple submissions
                                $('button[type="submit"]').prop('disabled', true).text('Please wait...');

                                // Get the full phone number in E164 format
                                var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
                                $("input[name='phone_number[full]']").val(full_number); // Store the full phone number in a hidden input

                                var formData = $(this).serialize(); // Get all form data

                                // Use AJAX to submit the form
                                $.ajax({
                                    url: "{{ route('submit.lead.landing.page') }}", // Your form submission URL
                                    method: "POST",
                                    data: formData,
                                    success: function (response) {
                                        if (response.success && response.redirect_url) {
                                            window.location.href = response.redirect_url; // ✅ Redirect here
                                        } else {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Form Submitted!',
                                                text: 'Your form has been successfully submitted.',
                                                showConfirmButton: true,
                                            }).then(function () {
                                                $('#registrationForm')[0].reset();
                                                $('button[type="submit"]').prop('disabled', false).text('Submit');
                                            });
                                        }
                                    },
                                    error: function (xhr) {
                                        // Handle errors from the backend
                                        var errors = xhr.responseJSON.errors;
                                        var errorMessage = '';

                                        if (errors) {
                                            // Construct error message to show in SweetAlert
                                            $.each(errors, function (key, value) {
                                                errorMessage += value[0] + '<br>';
                                            });
                                        }

                                        // Show SweetAlert with the error messages
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            html: errorMessage,
                                            showConfirmButton: true
                                        }).then(function () {
                                            // Re-enable the submit button after error
                                            $('button[type="submit"]').prop('disabled', false).text('Submit');
                                        });
                                    }
                                });
                            });
                        </script>
                        <script>
                            // === INPUT VALIDATION (Same as your previous form) ===
                            document.querySelectorAll('#registrationForm input').forEach(input => {
                                input.addEventListener('input', function () {

                                    let value = this.value;

                                    // EMAIL → allow letters, numbers, @ . _ -
                                    if (this.name === 'email') {
                                        this.value = value.replace(/[^a-zA-Z0-9@._-]/g, '');
                                        return;
                                    }

                                    // PHONE → only digits (already added maxlength=10)
                                    if (this.name === 'phone_number[main]') {
                                        this.value = value.replace(/[^0-9]/g, '').slice(0, 15);
                                        return;
                                    }

                                    // COUNTRY, NAME, CITY, VISA COUNTRY → allow letters, numbers, space
                                    if (
                                        this.name === 'name' ||
                                        this.name === 'visa_country'
                                    ) {
                                        this.value = value.replace(/[^a-zA-Z0-9 ]/g, '').slice(0, 30);
                                        return;
                                    }
                                });
                            });
                        </script>


                        <style>
                            /* OTP & Verify Buttons */
                            #sendOtpBtn,
                            #verifyOtpBtn {
                                background-color: var(--primary-color);
                                /* Primary color */
                                color: #000;
                                /* Black text for contrast */
                                border: none;
                                border-radius: 6px;
                                padding: 8px 14px;
                                font-size: 14px;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                margin-top: 8px;
                            }

                            .visaHideInput {
                                display: none !important;
                            }

                            #sendOtpBtn:hover:not(:disabled),
                            #verifyOtpBtn:hover:not(:disabled) {
                                background-color: #e6b800;
                                /* Slightly darker shade on hover */
                            }

                            /* Disabled state */
                            #sendOtpBtn:disabled,
                            #verifyOtpBtn:disabled {
                                background-color: #000;
                                /* Greyed out */
                                color: #ffffff;
                                cursor: not-allowed;
                                opacity: 0.7;
                            }

                            /* Custom styled checkbox with tick icon */
                            .terms-checkbox {
                                margin-top: 10px;
                                font-size: 12px;
                                color: #fff;
                            }

                            /* .custom-checkbox {
                                            display: flex;
                                            align-items: center;
                                            gap: 10px;
                                            position: relative;
                                            cursor: pointer;
                                            user-select: none;
                                        } */

                            .custom-checkbox input[type="checkbox"] {
                                opacity: 0;
                                width: 0;
                                height: 0;
                                position: absolute;
                            }

                            .custom-checkbox .checkmark {
                                height: 16px;
                                width: 16px;
                                background-color: transparent;
                                border: 2px solid #ccc;
                                border-radius: 4px;
                                display: inline-block;
                                position: relative;
                                transition: background-color 0.3s, border-color 0.3s;
                            }

                            .custom-checkbox input:checked~.checkmark {
                                background-color: #ffa500;
                                border-color: #ffa500;
                            }

                            .custom-checkbox .checkmark::after {
                                content: "✔";
                                position: absolute;
                                display: none;
                                left: 0px;
                                top: -3px;
                                font-size: 13px;

                            }

                            .custom-checkbox input:checked~.checkmark::after {
                                display: block;
                            }

                            /* Link styling */
                            .custom-checkbox a {
                                color: #ffcc00;
                                text-decoration: none;
                                transition: .2s all;
                            }

                            .custom-checkbox a:hover {
                                color: #ffa500;
                            }


                            /* Custom styled checkbox with tick icon */
                            .terms-checkbox {
                                margin-top: 10px;
                                font-size: 12px;
                                color: #fff;
                            }

                            .custom-checkbox {
                                display: flex;
                                align-items: center;
                                gap: 10px;
                                position: relative;
                                cursor: pointer;
                                user-select: none;
                            }

                            .custom-checkbox input[type="checkbox"] {
                                opacity: 0;
                                width: 0;
                                height: 0;
                                position: absolute;
                            }

                            .custom-checkbox .checkmark {
                                height: 16px;
                                width: 16px;
                                background-color: transparent;
                                border: 2px solid #ccc;
                                border-radius: 4px;
                                display: inline-block;
                                position: relative;
                                transition: background-color 0.3s, border-color 0.3s;
                            }

                            .custom-checkbox input:checked~.checkmark {
                                background-color: #ffa500;
                                border-color: #ffa500;
                            }

                            .custom-checkbox .checkmark::after {
                                content: "✔";
                                position: absolute;
                                display: none;
                                left: 0px;
                                top: -3px;
                                font-size: 13px;

                            }

                            .custom-checkbox input:checked~.checkmark::after {
                                display: block;
                            }

                            /* Link styling */
                            .custom-checkbox a {
                                color: #ffcc00;
                                text-decoration: none;
                                transition: .2s all;
                            }

                            .custom-checkbox a:hover {
                                color: #ffa500;
                            }

                            .iti {
                                width: -webkit-fill-available !important;
                            }

                            /* Responsive Design */
                            @media (max-width: 768px) {
                                .registration-form {
                                    width: 70%;
                                    padding: 18px;
                                    margin: auto;
                                }

                                .form-group input,
                                .form-group select {
                                    font-size: 14px;
                                    padding: 10px;
                                }

                                .submit-btn {
                                    font-size: 14px;
                                    padding: 10px;
                                }
                            }

                            @media (max-width: 480px) {
                                .registration-form h2 {
                                    font-size: 18px;
                                }

                                .form-group input,
                                .form-group select {
                                    font-size: 13px;
                                    padding: 8px;
                                }

                                .submit-btn {
                                    font-size: 14px;
                                    padding: 10px;
                                }
                            }

                            /* Fix Phone Input UI */
                            .iti {
                                width: 100% !important;
                                /* Ensures full width on all devices */
                            }

                            /* Adjust input styles for smaller screens */
                            .iti--separate-dial-code {
                                width: 100%;
                            }

                            .iti--separate-dial-code .iti__selected-flag {
                                padding: 10px;
                            }

                            .iti--separate-dial-code .iti__selected-dial-code {
                                font-size: 14px;
                            }

                            /* Ensure proper spacing for mobile */
                            @media (max-width: 480px) {
                                .iti--separate-dial-code .iti__selected-flag {
                                    padding: 8px;
                                }

                                .iti input[type="tel"] {
                                    padding-left: 70px !important;

                                }

                                .iti--separate-dial-code .iti__selected-dial-code {
                                    font-size: 13px;
                                }

                                .form-group input {
                                    padding: 10px !important;
                                    font-size: 14px !important;
                                }
                            }
                        </style>
                        <style>
                            .radio-group-wrapper {
                                margin: 12px 0;
                                color: #fff;
                            }

                            .group-title {
                                display: block;
                                margin-bottom: 8px;
                                font-size: 12px;
                                font-weight: 600;
                                color: #f8f9fa;
                            }

                            .custom-radio-group {
                                display: flex;
                                gap: 5px;
                                flex-wrap: wrap;
                            }

                            .custom-radio-group input[type="radio"] {
                                display: none;
                            }

                            .custom-radio-group label {
                                background-color: #1e1e2f;
                                color: #ccc;
                                border: 2px solid #333;
                                border-radius: 8px;
                                padding: 5px 5px;
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                                gap: 5px;
                                font-size: 12px;
                                transition: all 0.3s ease;
                                min-width: 100px;
                                justify-content: center;
                                text-align: center;
                            }

                            .custom-radio-group label:hover {
                                background-color: #2a2a3d;
                                border-color: #444;
                                color: #eee;
                            }

                            .custom-radio-group input[type="radio"]:checked+label {
                                background-color: #003366;
                                color: #fff;
                                border-color: var(--primary-dark);
                            }

                            .custom-radio-group .icon {
                                display: inline-block;

                                margin-right: 2px;
                                font-size: 18px;
                                color: #4a4a4a;
                                transition: color 0.3s;
                            }

                            .custom-radio-group label:hover .icon,
                            .custom-radio-group input[type="radio"]:checked+label .icon {
                                color: #ffa500;
                            }

                            @media (max-width: 480px) {
                                .custom-radio-group {
                                    flex-direction: column;
                                }

                                .custom-radio-group label {
                                    width: 100%;
                                    justify-content: flex-start;
                                }
                            }

                            .form-group input[type="checkbox"] {
                                accent-color: #ffcc00;
                                width: 16px;
                                height: 16px;
                            }
                        </style>

                    </div>

                </div>

            </div>

        </div>


        </div>

    </section>




    <!-- About Us  -->
    <style>
        /* GRE OVERVIEW */

        .ielts-overview {
            padding: 60px 0;
            text-align: center;
        }

        .ielts-overview-title {
            font-size: 32px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .ielts-overview-text {
            max-width: 900px;
            margin: 0 auto 20px;
            color: #444;
            line-height: 1.7;
            font-size: 16px;
        }
    </style>

    <section class="ielts-overview">

        <div class="container">

            <h2 class="ielts-overview-title"> GRE Overview</h2>

            <p class="ielts-overview-text">
                The Graduate Record Examination (GRE) is a globally recognised entrance exam for master’s and business
                programs worldwide. It evaluates your skills in Quantitative Reasoning, Verbal Reasoning, and Analytical
                Writing, helping universities assess your academic readiness for graduate-level studies.
            </p>
            <p class="ielts-overview-text">At our GRE Coaching in {{ $cityName }}, we provide complete preparation covering
                all GRE sections with expert strategies, concept-based learning, real exam-level mock tests, and continuous
                performance analysis. Our focused training approach emphasises accuracy, time management, vocabulary
                building, and score improvement.</p>

            <p class="ielts-overview-text">Our GRE Classes in {{ $cityName }} are designed for beginners as well as advanced
                aspirants, offering structured, result-oriented preparation. With personalised mentoring and proven
                strategies, we are recognised as the Best GRE Coaching in {{ $cityName }} to help you achieve your target
                score with confidence.</p>

            <!-- <p class="ielts-overview-text">
                                    As a leading GRE institute in {{ $cityName }}, WTS Study Abroad Consultants prepares students for all four
                                    modules: Listening, Reading, Writing, and Speaking, ensuring complete exam readiness.
                                </p> -->

        </div>

    </section>

    <!-- New Section  -->
    <style>
        /* METRICS */

        .ielts-metrics {
            padding: 20px 0;
            text-align: center;
            background: #fafcff;
        }

        .ielts-metrics h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .ielts-metrics p {
            color: #555;
            margin-bottom: 40px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .metric-card {
            background: #fff;
            padding: 30px 20px;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
        }

        .metric-number {
            font-size: 36px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .metric-label {
            margin-top: 8px;
            color: #333;
            font-weight: 500;
        }

        .percent {
            font-size: 22px;
            margin-left: 2px;
        }

        /* mobile */
        @media(max-width:768px) {
            .metric-number {
                font-size: 30px;
            }
        }
    </style>

    <section class="ielts-metrics">

        <div class="container">

            <h2>Our GRE Success in Numbers</h2>
            <!-- <p>A track record that highlights our commitment to GRE success.</p> -->

            <div class="metrics-grid">

                <div class="metric-card" data-target="2500" data-suffix="+">
                    <div class="metric-number">0</div>
                    <div class="metric-label">Students Coached</div>
                </div>

                <div class="metric-card" data-target="93" data-suffix="%">
                    <div class="metric-number">0</div>
                    <div class="metric-label">Success Ratio</div>
                </div>

                <div class="metric-card" data-target="30" data-suffix="+">
                    <div class="metric-number">0</div>
                    <div class="metric-label">Global Destinations</div>
                </div>

                <div class="metric-card" data-target="8" data-suffix="+">
                    <div class="metric-number">0</div>
                    <div class="metric-label">Average Band Target</div>
                </div>

            </div>
        </div>

    </section>

    <script>
        const metricCards = document.querySelectorAll(".metric-card");

        const runCounter = (el, target, suffix) => {
            let count = 0;
            const step = target / 60;

            const update = () => {
                count += step;

                if (count < target) {
                    let value = Number.isInteger(target) ? Math.floor(count) : count.toFixed(1);
                    el.innerText = value + suffix;
                    requestAnimationFrame(update);
                } else {
                    el.innerText = target + suffix;
                }
            };

            update();
        };

        const metricObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                const card = entry.target;
                const target = parseFloat(card.dataset.target);
                const suffix = card.dataset.suffix || "";
                const number = card.querySelector(".metric-number");

                if (entry.isIntersecting) {
                    number.innerText = "0";
                    runCounter(number, target, suffix);
                }
            });
        }, { threshold: .4 });

        metricCards.forEach(card => metricObserver.observe(card));
    </script>

    <!-- New Section Where GRE Take -->
    <style>
        .ielts-section {
            padding: 30px 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 15px;
        }

        .ielts-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            padding-left: 15px;
            text-align: left;
        }

        .ielts-title:before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            width: 5px;
            height: 30px;
            background: #ff7a00;
        }

        .ielts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .ielts-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }

        .ielts-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .ielts-card span {
            position: absolute;
            bottom: 15px;
            left: 15px;
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            z-index: 2;
        }

        .ielts-card:after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .6), transparent);
        }

        /* Responsive */

        @media(max-width:992px) {
            .ielts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:576px) {
            .ielts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="ielts-section">
        <div class="container">
            <h2 class="ielts-title">Where GRE can take you?</h2>

            <div class="ielts-grid">
                <div class="ielts-card">
                    <img src="images/australia.jpg">
                    <span>Australia</span>
                </div>

                <div class="ielts-card">
                    <img src="images/canada.jpg">
                    <span>Canada</span>
                </div>

                <div class="ielts-card">
                    <img src="images/country/ukhome.webp">
                    <span>UK</span>
                </div>

                <div class="ielts-card">
                    <img src="images/usa.jpg">
                    <span>USA</span>
                </div>

                <div class="ielts-card">
                    <img src="images/germany.jpg">
                    <span>Germany</span>
                </div>

                <div class="ielts-card">
                    <img src="images/country/newzealandhome.webp">
                    <span>New Zealand</span>
                </div>
            </div>
        </div>
    </section>

    <!-- New Section -->
    <style>
        .why-choose {
            padding: 30px 20px;
            text-align: center;
            background: #fafafa;
        }

        .why-choose h2 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .why-choose p {
            color: #555;
            margin-bottom: 45px;
        }

        .choose-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 40px 20px;
            max-width: 1100px;
            margin: auto;
        }

        .choose-item i {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .choose-item span {
            display: block;
            font-size: 14px;
            margin-top: 6px;
        }

        /* colors */

        .c1 {
            color: #18336c;
        }

        .c2 {
            color: #18336c;
        }

        .c3 {
            color: #18336c;
        }

        .c4 {
            color: #18336c;
        }

        .c5 {
            color: #18336c;
        }

        .c6 {
            color: #18336c;
        }

        .c7 {
            color: #18336c;
        }

        .c8 {
            color: #18336c;
        }

        .c9 {
            color: #18336c;
        }

        .c10 {
            color: #18336c;
        }

        /* responsive */

        @media(max-width:992px) {
            .choose-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width:600px) {
            .choose-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <section class="why-choose">

        <h2>Why Choose WTS</h2>
        <p>Why Students Prefer Our GRE Coaching in {{ $cityName }}</p>

        <div class="choose-grid">

            <div class="choose-item">
                <i class="fa-solid fa-user-graduate c1"></i>
                <span>Certified GRE Mentors</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-clock c2"></i>
                <span>Flexible Study Timings</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-clipboard-check c3"></i>
                <span>Weekly Mock Practice</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-users c4"></i>
                <span>Personal Guidance Sessions</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-house-laptop c5"></i>
                <span>Online & Offline Coaching</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-book-open c6"></i>
                <span>Easy Learning Resources</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-award c7"></i>
                <span>Budget-Friendly Fees</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-pen-ruler c8"></i>
                <span>Full Exam Assistance</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-people-group c9"></i>
                <span>Small Group Batches</span>
            </div>

            <div class="choose-item">
                <i class="fa-solid fa-video c10"></i>
                <span>Practice Video Access</span>
            </div>

        </div>
    </section>


    <!-- New Section Course Structure -->

    <style>
        /* COURSE STRUCTURE */

        .ielts-course {
            padding: 30px 0;
            text-align: center;
        }

        .ielts-course h2 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .ielts-course .subtitle {
            color: #555;
            margin-bottom: 25px;
        }

        .course-cta {
            background: var(--primary-color);
            color: #fff;
            padding: 12px 28px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 45px;
            text-decoration: none;
        }

        /* GRID */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        /* CARD */
        .course-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .08);
        }

        /* TOP COLOR BAR */
        .course-head {
            padding: 20px;
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* COLORS */
        .listening .course-head {
            background: #6d4db3;
        }

        .reading .course-head {
            background: #7c6ce6;
        }

        .writing .course-head {
            background: #ef6c4d;
        }

        .speaking .course-head {
            background: #6b7280;
        }

        /* BODY */
        .course-body {
            padding: 20px;
            text-align: left;
        }

        .course-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .course-body li {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        /* RED VIDEO ICON */
        .course-body li:before {
            content: "▶";
            color: #ef4444;
            font-size: 12px;
            margin-top: 2px;
        }

        /* RESPONSIVE */
        @media(max-width:992px) {
            .course-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:576px) {
            .course-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="ielts-course">

        <div class="container">

            <h2>GRE Course Structure</h2>

            <p class="subtitle">
                At WTS, our GRE coaching program is carefully designed to cover all four core modules of the exam:
                Listening, Reading, Writing, and Speaking.
                Our structured approach helps students build confidence, accuracy, and test readiness.
            </p>

            <a href="javascript:void(0)" class="course-cta js-open-custom-study-modal">Enroll in our GRE Online Coaching
                Program</a>

            <div class="course-grid">

                <!-- LISTENING -->
                <div class="course-card listening">
                    <div class="course-head">🎧 LISTENING</div>
                    <div class="course-body">
                        <ul>
                            <li>Learn effective techniques to understand different accents</li>
                            <li>Improve your ability to identify key information quickly</li>
                            <li>Practice with real exam-style audio materials</li>
                            <li>Develop focus and accuracy during listening tasks</li>
                            <li>Avoid common mistakes through guided practice</li>
                        </ul>
                    </div>
                </div>

                <!-- READING -->
                <div class="course-card reading">
                    <div class="course-head">📖 READING</div>
                    <div class="course-body">
                        <ul>
                            <li>Master skimming and scanning strategies for faster reading</li>
                            <li>Learn how to understand long and complex passages</li>
                            <li>Build strong vocabulary for better comprehension</li>
                            <li>Improve time management for the reading section</li>
                            <li>Practice question-solving techniques used in the actual test</li>
                        </ul>
                    </div>
                </div>

                <!-- WRITING -->
                <div class="course-card writing">
                    <div class="course-head">✍ WRITING</div>
                    <div class="course-body">
                        <ul>
                            <li>Understand the structure of Task 1 and Task 2 clearly</li>
                            <li>Learn how to describe charts, graphs, and reports effectively</li>
                            <li>Develop strong ideas and organize essays logically</li>
                            <li>Improve grammar and vocabulary usage for higher scores</li>
                            <li>Practice writing with detailed feedback from experts</li>
                        </ul>
                    </div>
                </div>

                <!-- SPEAKING -->
                <div class="course-card speaking">
                    <div class="course-head">🎤 SPEAKING</div>
                    <div class="course-body">
                        <ul>
                            <li>Build confidence to speak fluently and naturally in English</li>
                            <li>Learn how to answer examiner questions clearly</li>
                            <li>Improve pronunciation and sentence clarity</li>
                            <li>Practice common speaking topics through mock sessions</li>
                            <li>Learn techniques to reduce hesitation and nervousness</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- New Section GRE Test -->

    <style>
        /* GRE TEST TABS */

        .ielts-test {
            padding: 20px 0;
            text-align: center;
        }

        .ielts-test h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        /* tabs */

        .test-tabs {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .test-tab {
            padding: 10px 0;
            cursor: pointer;
            font-weight: 600;
            color: #555;
            position: relative;
        }

        .test-tab.active {
            color: #003366;
        }

        .test-tab.active:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 2px;
            background: #2563eb;
        }

        /* content box */

        .test-content {
            max-width: 900px;
            margin: 0 auto;
            background: #f5fbff;
            padding: 30px;
            border-radius: 10px;
            text-align: left;
        }

        /* points */

        .test-content ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .test-content li {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 15px;
            color: #333;
        }

        .test-content li:before {
            content: "✓";
            color: #2563eb;
            font-weight: 700;
        }

        /* responsive */

        @media(max-width:768px) {
            .test-tabs {
                gap: 20px;
            }

            .test-content {
                padding: 20px;
            }
        }
    </style>

    <section class="ielts-test">

        <div class="container">

            <h2>Which GRE Test Should You Take?</h2>

            <!-- <p>Choosing the correct GRE test is an important step in your study abroad journey. At WTS Study Abroad
                                    Consultant, we help you understand which option aligns best with your goals.</p> -->

            <div class="test-tabs">
                <div class="test-tab active" data-tab="academic">GRE iBT Test</div>
                <div class="test-tab" data-tab="general">GRE Essentials</div>
            </div>

            <div class="test-content" id="academic">

                <p>This is the most widely acceGREd GRE test by colleges and universities worldwide. It measures your
                    ability to use
                    English in academic settings such as classrooms, lectures, and discussions. If you are planning to study
                    abroad, GRE
                    iBT is the best choice for university admissions.</p>
                <!-- <ul>
                                        <li>Ideal for students planning to study at overseas universities, colleges, or higher education
                                            institutes.</li>
                                        <li>Measures your ability to understand and use academic-level English.</li>
                                        <li>Suitable for programs where learning, research, and assignments are taught in English.</li>
                                        <li>AcceGREd by universities in countries like the UK, Australia, Canada, New Zealand, and Europe.</li>
                                        <li>Focuses on skills such as analyzing academic texts, writing structured responses, and understanding
                                            lectures.</li>
                                    </ul> -->

                <!-- <p><strong>Best for:</strong>Undergraduate, postgraduate, and professional degree aspirants.</p> -->

            </div>

            <div class="test-content" id="general" style="display:none;">

                <p>This is a shorter and more affordable test that evaluates your everyday English skills along with
                    academic English. It
                    is acceGREd by selected institutions and is suitable for students looking for flexible and accessible
                    testing options.</p>
                <!-- <ul>
                                        <li>Designed for individuals planning to move abroad for work, training, or migration.</li>
                                        <li>Tests practical English used in everyday situations.</li>
                                        <li>Emphasizes communication skills for workplace and social environments.</li>
                                        <li>AcceGREd for employment purposes and certain immigration pathways.</li>
                                        <li>Includes real-life tasks like writing letters and understanding general conversations.</li>
                                    </ul>

                                    <p><strong>Best for:</strong>Work, migration, or non-academic training purposes.</p> -->

            </div>

        </div>

    </section>

    <script>
        const tabs = document.querySelectorAll(".test-tab");
        const contents = document.querySelectorAll(".test-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                tab.classList.add("active");

                contents.forEach(c => c.style.display = "none");
                document.getElementById(tab.dataset.tab).style.display = "block";
            });
        });
    </script>

    <!-- New Experts Section -->

    <style>
        .ielts-experts {
            text-align: center;
        }

        .ielts-experts h2 {
            font-size: 30px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .ielts-experts .sub {
            color: #555;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        /* WRAP GRID (NO SLIDER) */

        .experts-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }

        /* CARD */

        .expert-card {
            width: 320px;
            background: #fff;
            border-radius: 16px;
            padding: 25px 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
            position: relative;
            transition: all 0.35s ease;
        }

        /* Glow + zoom hover */
        .expert-card:hover {
            transform: scale(1.06);
            box-shadow:
                0 0 0 2px rgba(0, 123, 255, .2),
                0 12px 35px rgba(0, 0, 0, .18);
        }

        .badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #cfd8ee;
            color: #18336c;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 13px;
        }

        .expert-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin: 0 auto 10px;
            object-fit: cover;
        }

        .expert-name {
            font-weight: 600;
        }

        .expert-role {
            color: #777;
            font-size: 13px;
        }

        .expert-desc {
            font-size: 13px;
            margin: 10px 0;
            color: #555;
        }

        .expert-meta {
            display: flex;
            justify-content: space-around;
            margin: 12px 0;
            font-size: 13px;
        }

        .expert-btn {
            background: var(--primary-color);
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            display: block;
            text-decoration: none;
        }

        /* TABLET = 2 CARDS */

        @media(max-width:992px) {
            .expert-card {
                width: 45%;
            }
        }

        /* MOBILE = 1 CARD */

        @media(max-width:600px) {
            .expert-card {
                width: 100%;
            }
        }
    </style>

    <section class="ielts-experts">

        <div class="container">

            <h2>Get Trained by the <span style="color:var(--primary-color)">Expert in {{ $cityName }}</span></h2>

            <h3>Learn from Certified GRE Trainers in {{ $cityName }}</h3>

            <p class="sub">
                Our trainers at WTS bring years of experience in delivering high-quality GRE coaching in {{ $cityName }}.
                You
                receive:
            </p>

            <div class="experts-wrap">

                <div class="expert-card">
                    <span class="badge">Top Educator</span>
                    <img src="/images/universities/Dhara.png" class="expert-img">
                    <div class="expert-name">Dhara</div>
                    <div class="expert-role">GRE Trainer</div>
                    <p class="expert-desc">Experienced GRE Trainer – Certified Instructor with 5+ Years Expertise.</p>
                    <div class="expert-meta">
                        <span>⭐ 5<br>52 Reviews</span>
                        <span>3657<br>Learners Guided</span>
                    </div>
                    <a href="javascript:void(0)" class="expert-btn js-open-custom-study-modal">Book FREE Session</a>
                </div>

                <div class="expert-card">
                    <span class="badge">Top Educator</span>
                    <img src="/images/universities/Afrin.png" class="expert-img">
                    <div class="expert-name">Afrin</div>
                    <div class="expert-role">GRE Trainer</div>
                    <p class="expert-desc">Successfully trained multiple batches <br>with an 80%+ success rate.</p>
                    <div class="expert-meta">
                        <span>⭐ 5<br>65 Reviews</span>
                        <span>4677<br>Learners Guided</span>
                    </div>
                    <a href="javascript:void(0)" class="expert-btn js-open-custom-study-modal">Book FREE Session</a>
                </div>

                <div class="expert-card">
                    <span class="badge">Top Educator</span>
                    <img src="/images/universities/Rishita.png" class="expert-img">
                    <div class="expert-name">Rishita</div>
                    <div class="expert-role">GRE Trainer</div>
                    <p class="expert-desc">Experienced British Council Certified <br>GRE Trainer – 6+ Years Expertise.</p>
                    <div class="expert-meta">
                        <span>⭐ 4<br>57 Reviews</span>
                        <span>5668<br>Learners Guided</span>
                    </div>
                    <a href="javascript:void(0)" class="expert-btn js-open-custom-study-modal">Book FREE Session</a>
                </div>

            </div>

        </div>
    </section>


    <script>
        const wrap = document.getElementById("expertsWrap");

        if (wrap.children.length > 3) {
            setInterval(() => {
                wrap.scrollBy({ left: 350, behavior: "smooth" });
                if (wrap.scrollLeft + wrap.clientWidth >= wrap.scrollWidth) {
                    wrap.scrollTo({ left: 0, behavior: "smooth" });
                }
            }, 3000);
        }
    </script>

    <!-- New Section Training -->

    <style>
        /* PLAN SECTION */

        .ielts-plan {
            padding: 40px 0;
            text-align: center;
        }

        .ielts-plan h2 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .plan-grid {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .plan-box {
            width: 300px;
            /* 👈 YAHI NUMBER CHANGE KARO (260–320) */
            background: #f1f4fd;
            border-radius: 14px;
            border: 3px solid #eee;
            overflow: hidden;
            cursor: pointer;
            transition: .25s;
        }


        .plan-box.active {
            border: 2px solid #facc15 !important;
            background: #fff7dd !important;
            transform: translateY(-6px);
        }

        .plan-head {
            padding: 20px;
            font-weight: 600;
        }

        .plan-btn {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 8px 14px;
            border-radius: 6px;
            display: inline-block;
            margin-top: 10px;
        }

        .plan-btn {
            text-decoration: none;
        }

        .plan-btn:hover {
            background: #facc15;
            color: #000;
            border: none;
        }

        .plan-box.active .plan-btn {
            background: #facc15;
            color: #000;
            border: none;
        }

        .plan-features li {
            padding: 12px 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 14px;
        }

        .plan-features li:before {
            content: "✓";
            color: #22c55e;
        }

        .plan-values li {
            padding: 12px 15px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }

        .popular-tag {
            background: #facc15;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 8px;
            margin-bottom: 5px;
            display: inline-block;
        }

        /* FORCE SAME HEIGHT FOR ALL PLAN BOXES */

        .plan-grid {
            align-items: stretch;
        }

        .plan-box {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .plan-head {
            min-height: 85px;
        }

        .plan-features,
        .plan-values {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .plan-values strong {
            color: #18336c;
            font-weight: 700;
        }


        /* responsive */

        @media(max-width:992px) {
            .plan-grid {
                grid-template-columns: repeat(2, minmax(260px, 1fr));
            }
        }

        @media(max-width:576px) {
            .plan-grid {
                grid-template-columns: 1fr;
            }

            .plan-box {
                max-width: 100%;
            }
        }

        @media(max-width:768px) {
            .plan-box {
                width: 100%;
                max-width: 360px;
            }
        }
    </style>

    <section class="ielts-plan">

        <div class="container">

            <h2><span style="color:var(--primary-color)">Choose Your GRE </span> Preparation Plan</h2>


            <div class="plan-grid">


                <!-- 15 DAYS -->
                <div class="plan-box">
                    <div class="plan-head">
                        15-Day Quick Start<br>
                    </div>
                    <ul class="plan-values">
                        <li>Course Duration <strong>15 Days</strong></li>
                        <li>Mock Tests <strong>Unlimited</strong></li>
                        <li>Personality Sessions <strong>1</strong></li>
                        <li>Live Classes <strong>18+ Hours</strong></li>
                        <li>Section Masterclasses <strong>4</strong></li>
                        <li>Speaking Practice <strong>3 Tests</strong></li>
                    </ul>
                    <div style="padding:0 15px 15px;">
                        <a href="javascript:void(0)" class="plan-btn js-open-custom-study-modal">Explore Plan</a>
                    </div>
                </div>

                <!-- ADVANCED DEFAULT ACTIVE -->
                <div class="plan-box active">
                    <div class="plan-head">
                        <span class="popular-tag">Most Popular</span><br>
                        30-Day Intensive (Popular)<br>
                    </div>
                    <ul class="plan-values">
                        <li>Course Duration <strong>4 Weeks</strong></li>
                        <li>Mock Tests <strong>Unlimited</strong></li>
                        <li>Personality Sessions <strong>2</strong></li>
                        <li>Live Classes <strong>32 Hours</strong></li>
                        <li>Section Masterclasses <strong>5</strong></li>
                        <li>Speaking Practice <strong>8 Tests</strong></li>
                    </ul>
                    <div style="padding:0 15px 15px;">
                        <a href="javascript:void(0)" class="plan-btn js-open-custom-study-modal">Explore Plan</a>
                    </div>
                </div>

                <!-- 60 DAYS -->
                <div class="plan-box">
                    <div class="plan-head">
                        60-Day Pro Mastery<br>
                    </div>
                    <ul class="plan-values">
                        <li>Course Duration <strong>8 Weeks</strong></li>
                        <li>Mock Tests <strong>Unlimited</strong></li>
                        <li>Personality Sessions <strong>4</strong></li>
                        <li>Live Classes <strong>50+ Hours</strong></li>
                        <li>Section Masterclasses <strong>10</strong></li>
                        <li>Speaking Practice <strong>12 Tests</strong></li>
                    </ul>
                    <div style="padding:0 15px 15px;">
                        <a href="javascript:void(0)" class="plan-btn js-open-custom-study-modal">Explore Plan</a>
                    </div>
                </div>


            </div>
    </section>

    <script>
        const plans = document.querySelectorAll(".plan-box");

        plans.forEach(plan => {
            plan.addEventListener("click", () => {
                plans.forEach(p => p.classList.remove("active"));
                plan.classList.add("active");
            });
        });
    </script>

    <!-- Learners Section  -->

    <style>
        .ielts-stack {
            padding: 30px 15px;
        }

        .stack-container {
            max-width: 1200px;
            margin: auto;
            text-align: left;
        }

        .stack-track {
            display: flex;
            gap: 20px;
            transition: transform .6s ease;
            align-items: stretch;
        }

        .stack-card {
            flex: 0 0 calc(33.333% - 14px);
            background: #fff;
            border-radius: 16px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            box-sizing: border-box;

            /* MAGIC */
            min-height: 260px;
            display: flex;
            flex-direction: column;
        }

        .stack-user {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .stack-user div {
            text-align: left;
        }

        .stack-user img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
        }

        .stack-card p {
            flex: 1;
            line-height: 1.5;
            color: #444;
        }

        @media(max-width:900px) {
            .stack-card {
                flex: 0 0 calc(50% - 10px);
                min-height: 260px;
            }
        }

        @media(max-width:600px) {
            .stack-card {
                flex: 0 0 100%;
                min-height: 240px;
            }
        }
    </style>


    <section class="ielts-stack">
        <div class="container">

            <h2>Student Testimonials</h2>

            <div style="overflow:hidden">
                <div class="stack-track" id="track">

                    <div class="stack-card">
                        <div class="stack-user">
                            <div><b> Ananya Gupta</b><br><small>Jaipur</small></div>
                        </div>
                        <p> I joined GRE coaching at WTS Study Abroad Consultant after finding Quant quite challenging
                            during self-study. The faculty explained concepts like Probability and Algebra in a very simple
                            and structured way. Regular mock tests and detailed feedback helped me improve my score from 298
                            to 322. Highly recommended for serious GRE aspirants
                        </p>
                    </div>

                    <div class="stack-card">
                        <div class="stack-user">
                            <!-- <img src="/images/Riya.jpg"> -->
                            <div><b>Rahul Verma</b><br><small>Delhi</small></div>
                        </div>
                        <p> Enrolling at WTS for GRE preparation was the right decision. The trainers focus strongly on both
                            Quant and Verbal, especially Text Completion and Reading Comprehension. Their test strategies
                            and time-management techniques helped me perform confidently on the actual exam.</p>
                    </div>

                    <div class="stack-card">
                        <div class="stack-user">
                            <!-- <img src="/images/User.jpg"> -->
                            <div><b>Ishita Sharma</b><br><small>Mumbai</small></div>
                        </div>
                        <p>I was looking for a professional GRE institute with real exam-level practice, and WTS truly met
                            my expectations. The computer-based mock tests felt very similar to the actual GRE environment.
                            I achieved my target score of 315 in my first attempt.</p>
                    </div>

                    <div class="stack-card">
                        <div class="stack-user">
                            <!-- <img src="/images/Neha.jpg"> -->
                            <div><b>Devansh Patel</b><br><small>Ahemdabad</small></div>
                        </div>
                        <p>Due to my college schedule, I opted for GRE online coaching at WTS Study Abroad Consultant. The
                            live classes, recorded lectures, and one-on-one doubt sessions were extremely helpful. Even in
                            online mode, I received personal attention and regular performance analysis.</p>
                    </div>

                    <div class="stack-card">
                        <div class="stack-user">
                            <!-- <img src="/images/Ayesha.jpg"> -->
                            <div><b>Mehak Jain</b><br><small>Ajmer</small></div>
                        </div>
                        <p>What makes WTS different is their small batch size and individual mentoring. The vocabulary
                            training and structured writing practice for AWA made a big difference in my preparation. Within
                            a few months, I saw significant improvement in both speed and accuracy.</p>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <script>
        const track = document.getElementById("track");
        let cards = [...document.querySelectorAll(".stack-card")];

        // clone cards for infinite loop
        cards.forEach(card => {
            track.appendChild(card.cloneNode(true));
        });

        cards = [...document.querySelectorAll(".stack-card")];

        let index = 0;
        const gap = 20;

        function slide() {
            const cardWidth = cards[0].offsetWidth + gap;
            index++;

            track.style.transition = "transform .6s ease";
            track.style.transform = `translateX(-${index * cardWidth}px)`;

            // silent reset when half reached
            if (index >= cards.length / 2) {
                setTimeout(() => {
                    track.style.transition = "none";
                    index = 0;
                    track.style.transform = "translateX(0)";
                }, 650);
            }
        }

        setInterval(slide, 3000);
    </script>


    <!-- Blog Section -->

    <section class="blog-section">
        <style>
            .blog-section {
                padding: 20px 35px;
                max-width: 1300px;
                margin: 20px auto 10px;
            }

            .blog-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 18px
            }

            .blog-title {
                font-size: 24px;
                font-weight: 600;
                letter-spacing: .2px
            }

            /* Card */
            .blog-card {
                background: #fff;
                border-radius: 25px;
                overflow: hidden
            }

            .blog-card .media {
                position: relative
            }

            .blog-card .media img {
                display: block;
                width: 100%;
                height: 220px;
                object-fit: cover;
                border-radius: 25px;
            }

            .blog-card .date {
                position: absolute;
                right: 14px;
                bottom: -26px;
                background: #fff;
                font-size: 12px;
                color: #555
            }

            .blog-card .content {
                padding: 30px 18px 20px;
            }

            .blog-card h3 {
                font-size: 24px;
                line-height: 1.2;
                font-weight: 600;
                margin: 10px 0 12px
            }

            .blog-card p {
                color: #444;
                line-height: 1.55;
                margin: 0 0 16px
            }

            .new-blog-btn {
                display: inline-block;
                margin-top: 20px;
                background: #1C2C59;
                color: #fff;
                padding: 10px 18px;
                border-radius: 12px;
                text-decoration: none;
                font-size: 15px;
                font-weight: 400;
                position: relative;
                overflow: hidden;
                transition: all 0.4s ease;
                box-shadow: none;
            }

            .new-blog-btn::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.25);
                transform: skewX(-20deg);
                transition: 0.6s;
            }

            .new-blog-btn:hover {
                transform: translateY(-3px) scale(1.03);
                box-shadow: 0 8px 18px rgba(28, 44, 89, 0.6);
                background-position: right center;
            }

            .new-blog-btn:hover::before {
                left: 200%;
            }

            /* Swiper basics */
            .swiper {
                padding: 6px 6px 30px
            }

            .swiper-slide {
                height: auto
            }

            /* Nav */
            .blog-nav {
                display: flex;
                gap: 10px
            }

            .blog-nav button {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 1px solid #e5e7eb;
                background: #fff;
                cursor: pointer
            }

            .blog-nav svg {
                width: 18px;
                height: 18px
            }

            .swiper-pagination-bullet {
                background: #cfd5ff;
                opacity: 1
            }

            .swiper-pagination-bullet-active {
                background: #0d3bff
            }

            /* Responsive */
            @media (max-width:480px) {
                .blog-card h3 {
                    font-size: 22px
                }

                .blog-card .media img {
                    height: 190px
                }

                .blog-section {
                    padding: 20px 17px
                }
            }

            .blog-card h3,
            .blog-card p {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                /* limit to 2 lines */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>

        <div class="blog-wrap container">
            <div class="blog-header">
                <div class="blog-nav">
                    <button id="prevBtn" aria-label="Previous">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M15 6l-6 6 6 6" stroke="#111" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button id="nextBtn" aria-label="Next">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M9 6l6 6-6 6" stroke="#111" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Swiper -->
            <div class="swiper" id="blogSwiper">
                <div class="swiper-wrapper">
                    @foreach ($blogs as $blog)
                        <div class="swiper-slide">
                            <article class="blog-card">
                                <div class="media">
                                    <img src="{{ asset($blog->images) }}" alt="{{ $blog->title }}">
                                    <div class="date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</div>
                                </div>
                                <div class="content">
                                    <h3 title="{{ $blog->title }}">{{ $blog->title }}</h3>
                                    <p title="{{ strip_tags($blog->content) }}">
                                        {{ Str::limit(strip_tags($blog->content), 150, '...') }}
                                    </p>

                                    <a href="{{ url('/blog/' . $blog->slug) }}" class="new-blog-btn">Read More</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const swiper = new Swiper('#blogSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: false,
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '#nextBtn', prevEl: '#prevBtn' },
                    breakpoints: {
                        640: { slidesPerView: 2, spaceBetween: 22 },
                        1024: { slidesPerView: 3, spaceBetween: 24 }
                    }
                });
            });
        </script>
    </section>


    <!-- CTA Section -->

    <style>
        .ielts-cta {
            padding: 15px;
        }

        .ielts-cta .container {
            max-width: 1200px;
            margin: auto;
        }

        .cta-box {
            background: var(--primary-color);
            border-radius: 14px;
            position: relative;
            display: flex;
            align-items: center;
            min-height: 240px;
            padding: 30px;
            gap: 30px;
        }

        /* IMAGE */

        .cta-image {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            overflow: hidden;
            background: #fff;
            flex-shrink: 0;
        }

        .cta-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* CONTENT */

        .cta-content {
            color: #fff;
            max-width: 650px;
        }

        .cta-content h2 {
            font-size: 28px;
            margin-bottom: 10px;
            line-height: 1.3;
            color: white;
        }

        .cta-content p {
            opacity: .9;
            margin-bottom: 18px;
            color: white;
        }

        .cta-btn {
            background: #fff;
            color: var(--primary-color);
            padding: 10px 26px;
            border-radius: 25px;
            display: inline-block;
            text-decoration: none;
            font-weight: 600;
        }

        /* LAPTOP */

        @media(max-width:1100px) {
            .cta-content h2 {
                font-size: 24px;
            }

            .cta-image {
                width: 200px;
                height: 200px;
            }
        }

        /* TABLET */

        @media(max-width:900px) {
            .cta-box {
                flex-direction: column;
                text-align: center;
            }

            .cta-image {
                width: 180px;
                height: 180px;
            }
        }

        /* MOBILE */

        @media(max-width:600px) {
            .ielts-cta {
                padding: 10px;
            }

            .cta-image {
                width: 150px;
                height: 150px;
            }

            .cta-content h2 {
                font-size: 22px;
            }
        }
    </style>

    <section class="ielts-cta">
        <div class="container">

            <div class="cta-box">

                <div class="cta-image">
                    <img src="/images/GRE.webp" alt="">
                </div>

                <div class="cta-content">
                    <h2>Join the Best GRE Coaching in {{ $cityName }} Today</h2>
                    <p>Start your GRE preparation with WTS Study Abroad Consultants, a trusted GRE coaching centre in
                        {{ $cityName }} known for proven results and personalised guidance.
                    </p>
                    <a href="javascript:void(0)" class="cta-btn js-open-custom-study-modal">Book A Free Session Now</a>
                </div>

            </div>

        </div>
    </section>

    <!-- Long Content Section  -->

    <style>
        .ielts-long {
            padding: 40px 15px;
        }

        .ielts-long .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* MAIN BOX */
        .long-box {
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            padding: 0;
            text-align: left;
        }

        /* Light scrollbar */
        .long-box::-webkit-scrollbar {
            width: 6px;
        }

        .long-box::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }

        .long-box::-webkit-scrollbar-track {
            background: transparent;
        }

        /* TEXT */
        .long-box h2 {
            font-size: 30px;
            margin-bottom: 10px;
            text-align: left;
        }

        .long-box h3 {
            margin-top: 22px;
            text-align: left;
        }

        .long-box p {
            line-height: 1.6;
            margin-bottom: 12px;
            text-align: left;
        }

        .long-box ul {
            padding-left: 18px;
            margin-left: 0;
        }

        .long-box li {
            margin-bottom: 6px;
        }

        .long-box {
            max-height: none;
            overflow: hidden;
        }

        .more-content {
            display: none;
        }

        .read-btn-row {
            text-align: right;
            margin-top: 10px;
        }

        .read-toggle {
            cursor: pointer;
            font-weight: 600;
            color: white;
            border: 1px solid #ff8c00;
            padding: 6px 18px;
            border-radius: 30px;
            background: var(--primary-color);
        }

        .ielts-long a {
            text-decoration: none;
        }

        .ielts-long a:hover {
            text-decoration: none;
        }


        @media(max-width:600px) {
            .read-btn-row {
                text-align: center;
            }
        }

        /* MOBILE */
        @media(max-width:600px) {
            .long-box {
                padding: 22px;
                max-height: none;
                overflow: visible;
            }
        }

        .long-box h2 {
            font-size: 30px;
        }

        .read-btn-row {
            display: block !important;
        }
    </style>

    <section class="ielts-long">
        <div class="container">

            <div class="long-box">

                <h2>GRE Coaching in {{ $cityName }} – Structured Preparation for Top University Admissions</h2>

                <p>
                    At WTS Study Abroad Consultants, we provide result-oriented GRE Coaching in {{ $cityName }} designed for
                    students aiming to secure admission into top international universities for MS, MBA, and other graduate
                    programs. Our training focuses on conceptual clarity, analytical thinking, vocabulary enhancement, and
                    time management to help you achieve a competitive GRE score.
                </p>

                <p>
                    Recognized for delivering structured and effective preparation, we are known for offering the Best GRE
                    Coaching in {{ $cityName }} with expert faculty and personalized mentoring support.
                </p>

                <p>Our GRE Coaching {{ $cityName }} programs are suitable for beginners as well as advanced learners who
                    want systematic and strategic preparation.</p>

                <div class="read-btn-row">
                    <button class="read-toggle" id="readMore">Read More</button>
                </div>

                <div class="more-content" id="moreContent">


                    <h2>Why Choose WTS – Best GRE Institute in {{ $cityName }}</h2>

                    <p>
                        Selecting the right GRE Institute in {{ $cityName }} is a critical step in your study abroad
                        journey. At WTS, we follow a structured training methodology that ensures measurable improvement
                        across all GRE sections.
                    </p>

                    <p>As the Best GRE Institute in {{ $cityName }}, we provide:</p>

                    <ul>
                        <li>Experienced GRE trainers</li>
                        <li>Updated study material</li>
                        <li>Personalized study plans</li>
                        <li>Section-wise practice sessions</li>
                        <li>Adaptive mock tests</li>
                        <li>Performance tracking reports</li>
                    </ul>

                    <p>Students joining our GRE Coaching Centre in {{ $cityName }} benefit from focused academic guidance
                        and individual attention throughout their preparation.</p>

                    <h2>Comprehensive GRE Classes in {{ $cityName }}</h2>

                    <p>
                        Our GRE Classes in {{ $cityName }} are designed to cover every section of the exam in a structured
                        and strategic manner. Each student begins with a diagnostic assessment to determine their current
                        performance level.
                    </p>

                    <p>As part of the Best GRE Classes in {{ $cityName }}, we create customized study plans that include:
                    </p>

                    <ul>
                        <li>Quantitative concept strengthening</li>
                        <li>Verbal reasoning development</li>
                        <li>Vocabulary building techniques</li>
                        <li>Analytical writing practice</li>
                        <li>Time management strategies</li>
                        <li>Full-length mock test simulations</li>
                    </ul>

                    <p>
                        This structured approach makes our GRE Coaching in {{ $cityName }} highly effective and
                        result-driven.
                    </p>

                    <h2>Section-Wise GRE Preparation</h2>

                    <p>At our GRE Coaching Centre in {{ $cityName }}, we provide in-depth training for all GRE sections:</p>

                    <h3>Quantitative Reasoning.</h3>

                    <p>We focus on arithmetic, algebra, geometry, data interpretation, and quantitative comparison. Students
                        practice exam-level problems to improve accuracy and speed.</p>

                    <h3>Verbal Reasoning</h3>

                    <p>Our GRE Classes in {{ $cityName }} emphasize reading comprehension, text completion, and sentence
                        equivalence. Special vocabulary sessions help students master advanced word usage.</p>

                    <h3>Analytical Writing</h3>

                    <p>Students are trained to structure analytical essays with logical clarity, strong arguments, and
                        proper grammar..</p>

                    <p>This comprehensive section-wise approach positions WTS among providers of the Best GRE Coaching in
                        {{ $cityName }}.</p>


                    <h2>Personalized GRE Coaching {{ $cityName }}</h2>

                    <p>Every student has unique strengths and weaknesses. Our GRE Coaching {{ $cityName }} program focuses
                        on personalized mentoring and continuous evaluation.</p>

                    <p>At the Best GRE Institute in {{ $cityName }}, students receive:</p>

                    <ul>
                        <li>One-on-one mentoring</li>
                        <li>Weekly performance review</li>
                        <li>Target score planning</li>
                        <li>Customized improvement strategies</li>
                    </ul>

                    <p>This ensures that students enrolled in our GRE Coaching in {{ $cityName }} consistently improve and
                        stay motivated.</p>
                    <p>

                    <h2>GRE Online Coaching in {{ $cityName }} – Flexible Learning Options</h2>

                    <p>
                        For students who prefer flexibility, we offer GRE Online Coaching in {{ $cityName }} with live
                        interactive classes and structured digital learning resources.
                    </p>

                    <p>Our GRE Online Coaching in {{ $cityName }} includes:</p>

                    <ul>
                        <li>Live instructor-led sessions</li>
                        <li>Digital study material</li>
                        <li>Online mock tests</li>
                        <li>Recorded revision lectures</li>
                        <li>Personalized doubt-solving support</li>
                        <!-- <li>Doubt-solving support</li> -->
                    </ul>

                    <p>
                        Students enrolled in GRE Online Coaching in {{ $cityName }} receive the same high-quality training
                        as classroom learners.
                    </p>


                    <h2>Mock Tests & Real Exam Simulation</h2>

                    <p>As part of our structured GRE Coaching Centre in {{ $cityName }}, we conduct:</p>

                    <ul>
                        <li>Weekly sectional tests</li>
                        <li>Full-length adaptive mock exams</li>
                        <li>Detailed score analysis</li>
                        <li>Time management assessments</li>
                        <li>Strategy correction sessions</li>
                    </ul>

                    <p>This exam-oriented approach ensures students gain confidence before their actual test.</p>

                    <p>Our mock testing system strengthens our reputation for providing the Best GRE Classes in
                        {{ $cityName }}.</p>

                    <h2>Flexible Batch Options</h2>

                    <p>
                        Our GRE Classes in {{ $cityName }} are available in multiple formats:
                    </p>

                    <ul>
                        <li>Weekday batches</li>
                        <li>Weekend batches</li>
                        <li>Fast-track crash courses</li>
                        <li>One-on-one personalized sessions</li>
                        <li>Live online batches</li>
                    </ul>

                    <p>
                        This flexibility makes WTS a preferred choice for GRE Coaching {{ $cityName }} among students and
                        working professionals.
                    </p>

                    <h2>Updated Study Material & Resources</h2>

                    <p>
                        At our GRE Institute in {{ $cityName }}, students receive comprehensive and updated study resources
                        aligned with the latest GRE exam pattern.
                    </p>

                    <p>Resources include:</p>

                    <ul>
                        <li>Quantitative practice modules</li>
                        <li>Verbal reasoning guides</li>
                        <li>Vocabulary enhancement material</li>
                        <li>Essay writing templates</li>
                        <li>Adaptive mock test software</li>
                    </ul>

                    <p>These structured resources contribute to our recognition for offering the Best GRE Coaching in
                        {{ $cityName }}.</p>

                    <h2>Who Should Join Our GRE Coaching in {{ $cityName }}</h2>

                    <p>
                        Our program is ideal for:
                    </p>

                    <ul>
                        <li>Students planning MS or MBA abroad</li>
                        <li>Graduate program applicants</li>
                        <li>Scholarship seekers</li>
                        <li>Professionals aiming for global academic opportunities</li>
                    </ul>

                    <p>If you are targeting competitive universities, joining the Best GRE Coaching Centre in
                        {{ $cityName }} can significantly enhance your preparation quality.
                    </p>


                    <h2>Admission Process</h2>

                    <p>Joining our GRE Coaching {{ $cityName }} program is simple:</p>

                    <ul>
                        <li>Book a consultation</li>
                        <li>Take a diagnostic test</li>
                        <li>Receive a personalized study roadmap</li>
                        <li>Choose your preferred batch</li>
                        <li>Begin structured training</li>
                    </ul>

                    <p>
                        At WTS Study Abroad Consultants, we ensure smooth enrollment and systematic preparation at our GRE
                        Institute in {{ $cityName }}.
                    </p>

                    <h2>Expert Faculty & Mentorship</h2>

                    <p>
                        Our experienced trainers bring years of expertise in GRE training. Their guidance, structured
                        teaching methods, and strategic exam insights make WTS the Best GRE Institute in {{ $cityName }} for
                        serious aspirants.
                    </p>

                    <p>Through consistent mentoring and rigorous practice, our GRE Coaching in {{ $cityName }} prepares
                        students not only for the exam but also for academic excellence in business schools.</p>

                    <div class="read-btn-row" style="margin-top:20px;">
                        <button class="read-toggle" id="readLess">Read Less</button>
                    </div>

                </div>


            </div>

        </div>
    </section>
    <script>
        const more = document.getElementById("moreContent");
        const rm = document.getElementById("readMore");
        const rl = document.getElementById("readLess");

        rm.onclick = function () {
            more.style.display = "block";
            rm.style.display = "none";
        }

        rl.onclick = function () {
            more.style.display = "none";
            rm.style.display = "inline-block";
            document.querySelector(".long-box").scrollIntoView({ behavior: "smooth" });
        }
    </script>
    <script>
        document.querySelectorAll('.scroll-to-form').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const target = document.getElementById('registrationModals');

                const headerOffset = 100;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            });
        });
    </script>

    <!-- modal code start -->
    @include('components.course-registration-form-modal')

@endsection