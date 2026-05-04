@php
    $currentUrl = request()->fullUrl() ?? '';             
@endphp
<div id="registrationModals" class="registration-form ">
    <h2 style="margin: 0px;">Get FREE Counselling Today!</h2>
    <form id="registrationForm" method="POST">
        @csrf
        <input type="hidden" name="page_url" value="{{ $currentUrl }}">
        <div class="form-group">
            <input type="text" id="name" name="name" required placeholder="Your Name">
        </div>
        <div class="form-group">
            <input type="tel" name="phone_number[main]" id="phone_number" inputmode="numeric" autocomplete="tel"
                placeholder="Phone Number" aria-label="Phone Number" maxlength="10" />

            <button type="button" id="sendOtpBtn" style="margin-top:8px;">Send OTP</button>
        </div>
        <div class="form-group" id="otpBox" style="display:none;">
            <input type="text" id="otp" name="otp" placeholder="Enter OTP" maxlength="6">
            <button type="button" id="verifyOtpBtn">Verify OTP</button>
        </div>
        <div class="form-group">
            <input type="email" id="email" name="email" required placeholder="Email">
        </div>

        <div class="form-group">
            <input type="text" id="visa-country" name="visa_country" required placeholder="Visa Required Country">
        </div>
        <div class="form-group">
            <select id="visa-type" name="visa_type" required>
                <option value="" disabled selected>Select Visa Type</option>
                <!-- <option value="Tourist Visa">Tourist Visa</option> -->
                <!-- <option value="Work Visa">Work Visa</option> -->
                <option value="Student Visa">Student Visa</option>
                <!-- <option value="Business Visa">Business Visa</option> -->
            </select>
        </div>

        <div class="radio-group-wrapper">
            <label class="group-title">Select Your Preferred Counselling Mode:</label>
            <div class="custom-radio-group" role="group" aria-label="Counselling Mode">
                <input type="radio" name="counselling_mode" value="Phone" id="radioPhone">
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


        <div class="form-group">
            <label style="display: flex; align-items: center; font-size: 13px; color: #ffcc00;">
                <input type="checkbox" id="termsCheckbox" name="tac_check" style="margin-right: 8px;">
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script>
    // ===== NUMERIC-ONLY ENFORCEMENT FOR PHONE FIELD =====

    // 1) Block space key
    $(document).on('keydown', '#phone_number', function (e) {
        if (e.key === ' ' || e.keyCode === 32) {
            e.preventDefault();
        }
    });

    // 2) Strip all non-digits on input (typing + IME)
    $(document).on('input', '#phone_number', function () {
        const clean = this.value.replace(/\D+/g, '');
        if (this.value !== clean) {
            this.value = clean;
        }
    });

    // 3) Sanitize paste data (remove spaces & non-digits)
    $(document).on('paste', '#phone_number', function (e) {
        e.preventDefault();
        const text = (e.originalEvent || e).clipboardData.getData('text');
        const clean = text.replace(/\D+/g, '');
        document.execCommand('insertText', false, clean);
    });
    // ===== END ENFORCEMENT =====

</script>
<script>
    // Track if phone is verified
    let isPhoneVerified = false;

    $("#sendOtpBtn").click(function () {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        var countryData = phone_number.getSelectedCountryData();
        var nationalNumber = full_number.replace('+' + countryData.dialCode, '').replace(/\D/g, '');
        var rawInput = $("#phone_number").val().trim();

        // Validation checks
        if (!phone_number.isValidNumber()) {
            Swal.fire({ icon: 'error', title: 'Invalid Number', text: 'Please enter a valid 10 digits phone number with country code.' });
            return;
        }

        if (/^0\d+/.test(rawInput)) {
            Swal.fire({ icon: 'error', title: 'Invalid Number', text: 'Phone number should not start with 0.' });
            return;
        }

        if (countryData.iso2 === 'in' && nationalNumber.length !== 10) {
            Swal.fire({ icon: 'error', title: 'Invalid Number Length', text: 'Indian phone number must be exactly 10 digits (without 0).' });
            return;
        }

        // Disable input & button while sending OTP
        $("#phone_number").prop("readonly", true);
        $("#sendOtpBtn").prop("disabled", true).text("Sending...");

        // Send OTP request
        $.post("{{ route('send.otp') }}", {
            _token: "{{ csrf_token() }}",
            phone: full_number
        }, function (res) {
            if (res.success) {
                Swal.fire("Success", "OTP sent to WhatsApp!", "success");
                $("#otpBox").show();
                $("#verifyOtpBtn").show();
                $("#otp").val(''); // Ensure input is empty
                $("#sendOtpBtn").prop("disabled", true).text("OTP Sent! Please check WhatsApp.");
            } else {
                // Unlock number input if sending fails
                $("#phone_number").prop("readonly", false);
                $("#sendOtpBtn").prop("disabled", false).text("Send OTP");
                Swal.fire("Error", res.message, "error");
            }
        }).fail(function () {
            // Unlock number input if AJAX fails
            $("#phone_number").prop("readonly", false);
            $("#sendOtpBtn").prop("disabled", false).text("Send OTP");
            Swal.fire("Error", "Something went wrong while sending OTP.", "error");
        });
    });

    $("#verifyOtpBtn").click(function () {
        var otp = $("#otp").val();
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);

        if (otp.length != 6) {
            Swal.fire("Error", "Enter a valid 6-digit OTP", "error");
            return;
        }

        $("#verifyOtpBtn").prop("disabled", true).text("Verifying...");

        $.post("{{ route('verify.otp') }}", {
            _token: "{{ csrf_token() }}",
            phone: full_number,
            otp: otp
        }, function (res) {
            if (res.success) {
                Swal.fire("Verified", "OTP Verified Successfully!", "success");
                $("#otpBox").hide();
                $("#sendOtpBtn").prop("disabled", true).text("Verified");
                $("#phone_number").prop("readonly", true); // Keep locked
                isPhoneVerified = true;
            } else {
                // OTP failed → hide OTP input & verify button
                $("#otpBox").hide();
                $("#verifyOtpBtn").hide();

                // Clear previous OTP
                $("#otp").val('');

                // Unlock so user can correct number or resend
                $("#phone_number").prop("readonly", false);
                $("#sendOtpBtn").prop("disabled", false).text("Resend OTP");
                Swal.fire("Error", res.message, "error");
            }
        }).fail(function () {
            $("#verifyOtpBtn").prop("disabled", false).text("Verify OTP");
            Swal.fire("Error", "Something went wrong while verifying OTP.", "error");
        }).always(function () {
            $("#verifyOtpBtn").prop("disabled", false).text("Verify OTP");
        });
    });


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

    $("#registrationForm").on("submit", function (e) {
        e.preventDefault(); // Prevent the default form submission

        // ✅ Ensure phone is verified
        if (!isPhoneVerified) {
            Swal.fire({
                icon: 'warning',
                title: 'Phone Verification Required',
                text: 'Please verify your phone number before submitting the form.',
                confirmButtonText: 'Okay'
            });
            return;
        }

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
            url: "{{ route('submit.lead') }}", // Your form submission URL
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('universitiesUnlocked', '1');
                    if (response.user_id) {
                        localStorage.setItem('user_id', response.user_id);
                    }
                    unlockUniversities();
                    Swal.fire({
                        icon: 'success',
                        title: 'Form Submitted!',
                        text: 'Your form has been successfully submitted.',
                        showConfirmButton: true,
                    }).then(function () {
                        $('#registrationForm')[0].reset();
                        $('button[type="submit"]').prop('disabled', false).text('Apply Filters');

                        $('#universityGridContainer').removeClass('uni-locked');
                        $('#universityGridContainer .unlock-overlay').remove();
                    });

                    closeRegistrationModal();
                    applyUniversityFilters()
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
    document.addEventListener("DOMContentLoaded", function () {

        // NAME → letters, numbers, spaces
        document.querySelector("#name").addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '').slice(0, 30);
        });

        // EMAIL → allow a-z, 0-9, @ . _ -
        document.querySelector("#email").addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '');
        });

        // VISA COUNTRY → letters, numbers, spaces
        document.querySelector("#visa-country").addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
        });

        // PHONE NUMBER (extra safety — intl-tel-input already blocks many chars)
        document.querySelector("#phone_number").addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
        });

        // OTP → only digits
        document.querySelector("#otp").addEventListener("input", function () {
            this.value = this.value.replace(/\D+/g, '');
        });

        // GLOBAL TEXT INPUT PROTECTION (except email + otp)
        document.querySelectorAll("input[type='text']").forEach((input) => {
            if (input.id !== "email" && input.id !== "otp") {
                input.addEventListener("input", function () {
                    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
                });
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

    #sendOtpBtn:hover:not(:disabled),
    #verifyOtpBtn:hover:not(:disabled) {
        background-color: var(--primary-color);
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
        color: var(--primary-color);
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
        color: var(--primary-color);
    }

    .iti {
        width: -webkit-fill-available !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .registration-form {
            width: 90%;
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