@php
    $currentUrl = request()->fullUrl() ?? '';             
@endphp
<div id="registrationModals" class="registration-form">
  <h2 style="margin:0">Get FREE Counselling Today!</h2>

  <form id="registrationForm" method="POST" autocomplete="on">
    @csrf
    <input type="hidden" name="page_url" value="{{ $currentUrl }}">
    <div class="form-group">
      <input type="text" id="name" name="name" required placeholder="Your Name" autocomplete="name">
    </div>

    <!-- Phone: only digits; no spaces allowed -->
    <div class="form-group">
      <input
        type="tel"
        name="phone_number[main]"
        id="phone_number"
        inputmode="numeric"
        autocomplete="tel"
        maxlength="10"
        placeholder="Phone Number"
        aria-label="Phone Number"
      />
      <button type="button" id="sendOtpBtn" style="margin-top:8px;">Send OTP</button>

      <!-- Full E.164 phone captured here on submit -->
      <input type="hidden" name="phone_number[full]" id="phone_number_full">
    </div>

    <div class="form-group" id="otpBox" style="display:none;">
      <input type="text" id="otp" name="otp" placeholder="Enter OTP" maxlength="6" inputmode="numeric" aria-label="OTP">
      <button type="button" id="verifyOtpBtn">Verify OTP</button>
    </div>

    <div class="form-group">
      <input type="email" id="email" name="email" required placeholder="Email" autocomplete="email">
    </div>

    <div class="form-group">
      <input type="text" id="visa-country" name="visa_country" required placeholder="Visa Required Country">
    </div>

    <div class="form-group">
      <select id="visa-type" name="visa_type" required>
        <option value="" disabled>Select Visa Type</option>
        <option value="Student Visa" selected>Student Visa</option>
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
      <label style="display:flex;align-items:center;font-size:13px;color:#ffcc00;">
        <input type="checkbox" id="termsCheckbox" name="tac_check" style="margin-right:8px;">
        I agree to the&nbsp;<a href="/terms-and-conditions" target="_blank" style="color:#fff;text-decoration:underline;">Terms & Conditions</a>
      </label>
    </div>

    <button type="submit" class="submit-btn">Submit</button>
  </form>
</div>

<!-- Libs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"></script>

<script>
  // Track if phone is verified
  let isPhoneVerified = false;
  let iti;

  // ===== NUMERIC-ONLY ENFORCEMENT FOR PHONE FIELD =====
  // 1) Block space key
  $(document).on('keydown', '#phone_number', function (e) {
    if (e.key === ' ' || e.keyCode === 32) e.preventDefault();
  });

  // 2) Strip all non-digits on input (typing + IME)
  $(document).on('input', '#phone_number', function () {
    const clean = this.value.replace(/\D+/g, '');
    if (this.value !== clean) this.value = clean;
  });

  // 3) Sanitize paste data (remove spaces & non-digits)
  $(document).on('paste', '#phone_number', function (e) {
    e.preventDefault();
    const text = (e.originalEvent || e).clipboardData.getData('text');
    const clean = text.replace(/\D+/g, '');
    document.execCommand('insertText', false, clean);
  });
  // ===== END ENFORCEMENT =====

  // Initialize intl-tel-input (no auto spaces)
  document.addEventListener('DOMContentLoaded', function () {
    iti = window.intlTelInput(document.querySelector('#phone_number'), {
      separateDialCode: true,
      nationalMode: true,
      preferredCountries: ['in'],
      autoPlaceholder: 'polite',
      // Important: keep raw digits only in visible input
      formatOnDisplay: false,
      utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js'
    });

    // Hide counselling mode by default; show for Student Visa
    $('.radio-group-wrapper').hide();
    if ($('#visa-type').val() === 'Student Visa') $('.radio-group-wrapper').show();
    $('#visa-type').on('change', function () {
      if ($(this).val() === 'Student Visa') {
        $('.radio-group-wrapper').slideDown();
      } else {
        $('.radio-group-wrapper').slideUp();
        $('input[name="counselling_mode"]').prop('checked', false);
      }
    });
  });

  // Send OTP
  $('#sendOtpBtn').click(function () {
    const countryData = iti.getSelectedCountryData();
    const full_number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    const rawInput = $('#phone_number').val().trim();
    const nationalNumber = rawInput.replace(/\D/g, '');

    if (!iti.isValidNumber()) {
      Swal.fire({ icon: 'error', title: 'Invalid Number', text: 'Please enter a valid phone number with country code.' });
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

    $('#phone_number').prop('readonly', true);
    $('#sendOtpBtn').prop('disabled', true).text('Sending...');

    $.post("{{ route('send.otp') }}", {
      _token: "{{ csrf_token() }}",
      phone: full_number
    }, function (res) {
      if (res.success) {
        Swal.fire('Success', 'OTP sent to WhatsApp!', 'success');
        $('#otpBox').show();
        $('#verifyOtpBtn').show();
        $('#otp').val('');
        $('#sendOtpBtn').prop('disabled', true).text('OTP Sent! Please check WhatsApp.');
      } else {
        $('#phone_number').prop('readonly', false);
        $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
        Swal.fire('Error', res.message || 'Failed to send OTP.', 'error');
      }
    }).fail(function () {
      $('#phone_number').prop('readonly', false);
      $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
      Swal.fire('Error', 'Something went wrong while sending OTP.', 'error');
    });
  });

  // Verify OTP
  $('#verifyOtpBtn').click(function () {
    const otp = $('#otp').val().replace(/\D+/g, '');
    const full_number = iti.getNumber(intlTelInputUtils.numberFormat.E164);

    if (otp.length !== 6) {
      Swal.fire('Error', 'Enter a valid 6-digit OTP', 'error');
      return;
    }

    $('#verifyOtpBtn').prop('disabled', true).text('Verifying...');

    $.post("{{ route('verify.otp') }}", {
      _token: "{{ csrf_token() }}",
      phone: full_number,
      otp: otp
    }, function (res) {
      if (res.success) {
        Swal.fire('Verified', 'OTP Verified Successfully!', 'success');
        $('#otpBox').hide();
        $('#sendOtpBtn').prop('disabled', true).text('Verified');
        $('#phone_number').prop('readonly', true);
        isPhoneVerified = true;
      } else {
        // Reset for correction
        $('#otpBox').hide();
        $('#verifyOtpBtn').hide();
        $('#otp').val('');
        $('#phone_number').prop('readonly', false);
        $('#sendOtpBtn').prop('disabled', false).text('Resend OTP');
        Swal.fire('Error', res.message || 'OTP verification failed.', 'error');
      }
    }).fail(function () {
      $('#verifyOtpBtn').prop('disabled', false).text('Verify OTP');
      Swal.fire('Error', 'Something went wrong while verifying OTP.', 'error');
    }).always(function () {
      $('#verifyOtpBtn').prop('disabled', false).text('Verify OTP');
    });
  });

  // Submit
  $('#registrationForm').on('submit', function (e) {
    e.preventDefault();

    if (!isPhoneVerified) {
      Swal.fire({
        icon: 'warning',
        title: 'Phone Verification Required',
        text: 'Please verify your phone number before submitting the form.',
        confirmButtonText: 'Okay'
      });
      return;
    }

    if ($('#visa-type').val() === 'Student Visa' && !$("input[name='counselling_mode']:checked").val()) {
      Swal.fire({
        icon: 'warning',
        title: 'Counselling Mode Required',
        text: 'Please select your preferred counselling mode before submitting the form.',
        confirmButtonText: 'Okay'
      });
      return;
    }

    if (!$('#termsCheckbox').is(':checked')) {
      Swal.fire({
        icon: 'warning',
        title: 'Terms & Conditions',
        text: 'Please agree to the Terms & Conditions before submitting.',
        confirmButtonText: 'Okay'
      });
      return;
    }

    // Put full E.164 into hidden input
    const full_number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    $('#phone_number_full').val(full_number);

    // Disable button to avoid duplicates
    $('button[type="submit"]').prop('disabled', true).text('Please wait...');

    const formData = $(this).serialize();

    $.ajax({
      url: "{{ route('submit.lead.landing.page') }}",
      method: "POST",
      data: formData,
      success: function (response) {
        if (response.success && response.redirect_url) {
          window.location.href = response.redirect_url;
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Form Submitted!',
            text: 'Your form has been successfully submitted.',
            showConfirmButton: true
          }).then(function () {
            $('#registrationForm')[0].reset();
            // Keep phone readonly if verified? Reset state for new lead:
            isPhoneVerified = false;
            $('#phone_number').prop('readonly', false);
            $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
            $('button[type="submit"]').prop('disabled', false).text('Submit');
            $('.radio-group-wrapper').toggle($('#visa-type').val() === 'Student Visa');
          });
        }
      },
      error: function (xhr) {
        let errorMessage = 'Something went wrong.';
        if (xhr.responseJSON && xhr.responseJSON.errors) {
          errorMessage = Object.values(xhr.responseJSON.errors).map(arr => arr[0]).join('<br>');
        }
        Swal.fire({ icon: 'error', title: 'Oops...', html: errorMessage, showConfirmButton: true })
          .then(function () {
            $('button[type="submit"]').prop('disabled', false).text('Submit');
          });
      }
    });
  });
</script>
<!-- === INPUT PREVENTION FOR THIS FORM === -->
<script>
document.addEventListener("DOMContentLoaded", function () {

  // NAME → allow letters, numbers, space
  document.querySelector("#name").addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '').slice(0, 30);
  });

  // EMAIL → allow a-z, 0-9, @ . _ -
  document.querySelector("#email").addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '');
  });

  // VISA COUNTRY → allow letters, numbers, space
  document.querySelector("#visa-country").addEventListener("input", function () {
    this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
  });

  // OTP → only digits
  document.querySelector("#otp").addEventListener("input", function () {
    this.value = this.value.replace(/\D+/g, '');
  });

  // EXTRA SAFETY — prevent special characters in ALL text inputs (except email)
  document.querySelectorAll("input[type='text']").forEach((input) => {
    if (input.name !== "email" && input.name !== "otp") {
      input.addEventListener("input", function () {
        this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
      });
    }
  });

});
</script>


<style>
  /* Buttons */
  #sendOtpBtn, #verifyOtpBtn {
    background-color: var(--primary-color);
    color: #000;
    border: none; border-radius: 6px;
    padding: 8px 14px; font-size: 14px;
    cursor: pointer; transition: .3s ease; margin-top: 8px;
  }
  #sendOtpBtn:hover:not(:disabled), #verifyOtpBtn:hover:not(:disabled){ background:#e6b800; }
  #sendOtpBtn:disabled, #verifyOtpBtn:disabled{ background:#000; color:#fff; cursor:not-allowed; opacity:.7; }

  /* intl-tel-input width fix */
  .iti, .iti--separate-dial-code { width:100% !important; }
  .iti--separate-dial-code .iti__selected-flag { padding:10px; }
  .iti--separate-dial-code .iti__selected-dial-code { font-size:14px; }

  /* Radio group */
  .radio-group-wrapper { margin:12px 0; color:#fff; }
  .group-title { display:block; margin-bottom:8px; font-size:12px; font-weight:600; color:#f8f9fa; }
  .custom-radio-group { display:flex; gap:5px; flex-wrap:wrap; }
  .custom-radio-group input[type="radio"]{ display:none; }
  .custom-radio-group label{
    background:#1e1e2f; color:#ccc; border:2px solid #333; border-radius:8px;
    padding:5px 5px; cursor:pointer; display:flex; align-items:center; gap:5px;
    font-size:12px; transition:.3s ease; min-width:100px; justify-content:center; text-align:center;
  }
  .custom-radio-group label:hover{ background:#2a2a3d; border-color:#444; color:#eee; }
  .custom-radio-group input[type="radio"]:checked + label{ background:#003366; color:#fff; border-color:var(--primary-dark); }
  .custom-radio-group .icon{ margin-right:2px; font-size:18px; color:#4a4a4a; transition:color .3s; }
  .custom-radio-group label:hover .icon,
  .custom-radio-group input[type="radio"]:checked + label .icon{ color:#ffa500; }

  /* Checkbox accent */
  .form-group input[type="checkbox"]{ accent-color:#ffcc00; width:16px; height:16px; }

  /* Responsive */
  @media (max-width:768px){
    .registration-form{ width:90%; padding:18px; margin:auto; }
    .form-group input, .form-group select, .submit-btn{ font-size:14px; padding:10px; }
  }
  @media (max-width:480px){
    .registration-form h2{ font-size:18px; }
    .form-group input, .form-group select, .submit-btn{ font-size:13px; padding:8px; }
    .iti--separate-dial-code .iti__selected-flag{ padding:8px; }
    .iti input[type="tel"]{ padding-left:70px !important; }
    .form-group input{ padding:10px !important; font-size:14px !important; }
    .custom-radio-group{ flex-direction:column; }
    .custom-radio-group label{ width:100%; justify-content:flex-start; }
  }
</style>
