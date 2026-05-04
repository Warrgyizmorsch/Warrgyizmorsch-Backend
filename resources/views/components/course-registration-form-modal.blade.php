<style>
    .custom-study-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    .custom-study-modal.active {
        display: flex;
    }

    .custom-study-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .6);
    }

    .custom-study-modal-box {
        background: #fff;
        max-width: 900px;
        max-height: 90vh;
        width: 100%;
        border-radius: 14px;
        overflow: auto;
        position: relative;
        z-index: 2;
    }

    .custom-study-modal-close {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 22px;
        border: none;
        background: none;
        cursor: pointer;
    }

    .custom-study-modal-body {
        display: flex;
    }

    .custom-study-left {
        width: 40%;
        padding: 30px;
        background: linear-gradient(135deg, #f7e9ff, #ffe8f0);
    }

    .custom-study-left span {
        color: green;
        font-weight: bold;
    }

    .custom-study-left h2 {
        font-size: 1.5rem;
    }

    .custom-study-left p {
        text-align: center;
    }

    .custom-study-left .study-highlight {
        text-align: center;
    }

    .experts-row {
        display: flex;
        /* gap:20px; */
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .expert-col {
        flex: 1 1 33.333%;
        max-width: 33.333%;
        display: flex;
        justify-content: center;
    }

    .expert-img-modal {
        width: 100%;
        max-width: 260px;
        height: auto;
        border-radius: 12px;
        object-fit: cover;
    }

    @media(max-width:768px) {
        .expert-col {
            /* flex:1 1 100%; */
            max-width: 100%;
        }
    }

    .custom-study-right {
        width: 60%;
        padding: 30px;
    }

    .custom-study-right .title {
        text-align: left;
        font-size: 1.2rem;
    }

    .custom-study-right .subtitle {
        text-align: left;
        font-size: 1rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .checkbox {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 10px;
        line-height: 1.4;
    }

    .checkbox input {
        margin: 0;
        flex-shrink: 0;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .login-link {
        font-size: 1rem;
        color: #ff7a00;
        font-weight: bold;
        cursor: pointer;
    }

    .field {
        position: relative;
        width: 100%;
    }

    .field input,
    .field select {
        width: 100%;
        height: 36px;
        padding: 5px 5px 5px 40px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 10px;
        background: #fff;
        outline: none;
    }

    .field label {
        position: absolute;
        top: -7px;
        left: 12px;
        font-size: 8px;
        font-weight: 500;
        color: #111;
        background: #fff;
        padding: 0 6px;
        pointer-events: none;
    }

    .field.has-icon input,
    .field.has-icon select {
        padding-left: 44px;
    }

    .field-icon {
        position: absolute;
        /* top: 50%; */
        top: 19px;
        left: 14px;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .field-icon svg {
        width: 100%;
        height: 100%;
        fill: #6b7280;
    }

    .phone-field .iti {
        width: 100%;
    }

    .phone-field .iti input {
        height: 36px;
        padding-left: 90px !important;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 10px;
    }

    .phone-field label {
        top: -7px;
        left: 12px;
    }

    input[list]::-webkit-calendar-picker-indicator {
        display: none !important;
    }

    input[list] {
        appearance: none;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .checkbox {
        margin-top: 14px;
        font-size: 10px;
        flex-wrap: wrap;
    }

    .form-footer {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .modal-submit-btn {
        /* background: #ff7a00; */
        background: linear-gradient(135deg, #ff8f33, #ff7a00);
        color: #fff;
        border: none;
        padding: 14px 30px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }

    .modal-submit-btn:hover {
        background: linear-gradient(135deg, #ff7a00, #e65f00);
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }


    @media(max-width: 768px) {
        .custom-study-modal-body {
            flex-direction: column;
        }

        .custom-study-left,
        .custom-study-right {
            width: 100%;
        }
    }
</style>
<style>
    /* make iti wrapper behave like input */
    .phone-field .iti {
        width: 100%;
    }

    /* actual input inside intl-tel-input */
    .phone-field .iti input {
        width: 100%;
        padding: 5px 5px 5px 100px !important;
        /* space for flag + code */
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 10px;
    }

    .phone-field .field-icon {
        left: 80px !important;
        z-index: 9999;
    }

    .iti__country-list {
        max-width: 230px !important;
        max-height: 160px !important;
    }

    /* flag container */
    .iti--separate-dial-code .iti__flag-container {
        left: 10px;
    }

    /* dial code text */
    .iti--separate-dial-code .iti__selected-dial-code {
        margin-left: 6px;
        color: #000;
        font-size: 0.7rem;
    }

    /* dropdown1 text color */
    .iti__country-name,
    .iti__dial-code {
        color: #000;
    }

    .field {
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .error-text {
        font-size: 10px;
        color: #dc2626;
        margin-top: 4px;
    }
</style>

@php
$currentUrl = request()->fullUrl() ?? '';             
@endphp
<div id="studyModal" class="custom-study-modal">

    <div class="custom-study-modal-overlay"></div>

    <div class="custom-study-modal-box no-scrollbar">

        <button class="custom-study-modal-close">&times;</button>

        <div class="custom-study-modal-body">

            <!-- LEFT -->
            <div class="custom-study-left">
                <h2>Meet Our Study Abroad Experts</h2>
                <p>Get Exclusive Discounts on Application & VISA Fees</p>
                <div class="experts-row">
                    <div class="expert-col">
                        <img src="{{ asset('images/universities/Dhara.png') }}" class="expert-img-modal" alt="Dhara">
                    </div>

                    <div class="expert-col">
                        <img src="{{ asset('images/universities/Afrin.png') }}" class="expert-img-modal" alt="Afrin">
                    </div>

                    <div class="expert-col">
                        <img src="{{ asset('images/universities/Rishita.png') }}" class="expert-img-modal" alt="Rishita">
                    </div>
                </div>
                <div class="study-highlight">
                    <strong>Apply to 1800+ Study Abroad Universities</strong>
                    <p>Get upto <span>80% discount</span> on Visa Application fees</p>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="custom-study-right">

                <h2 class="title">Register Now</h2>
                <p class="subtitle">Get details and latest updates</p>

                <hr>

                <!-- FORM -->
                <form id="courseFinderForm" method="POST">
                    @csrf
                    <input type="hidden" name="page_url" value="{{ $currentUrl }}">
                    <div class="form-grid">

                        <div class="field">
                            <span class="field-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 4a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4Z">
                                    </path>
                                </svg></span>
                            <input type="text" name="name" placeholder=" " required>
                            <label>Full Name *</label>
                        </div>

                        <div class="field">
                            <span class="field-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m20 8-8 5-8-5V6l8 5 8-5m0-2H4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z">
                                    </path>
                                </svg></span>
                            <input type="email" name="email" placeholder=" " required>
                            <label>Email Address *</label>
                        </div>

                        <div class="field phone-field">
                            <span class="field-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25 1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2Z">
                                    </path>
                                </svg></span>
                            <input type="tel" id="modal_phone_number" name="phone" placeholder=" " required />
                            <label>Mobile Number *</label>
                        </div>

                        <div class="field has-suggest">
                            <span class="field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <path
                                        d="M256 0C161.896 0 85.333 76.563 85.333 170.667c0 28.25 7.063 56.26 20.49 81.104L246.667 506.5c1.875 3.396 5.448 5.5 9.333 5.5s7.458-2.104 9.333-5.5l140.896-254.813c13.375-24.76 20.438-52.771 20.438-81.021C426.667 76.563 350.104 0 256 0zm0 256c-47.052 0-85.333-38.281-85.333-85.333S208.948 85.334 256 85.334s85.333 38.281 85.333 85.333S303.052 256 256 256z">
                                    </path>
                                </svg></span>
                            <input type="text" id="cityInput" name="city" placeholder=" " autocomplete="off" required>
                            <label>City You Live In *</label>
                            <div class="suggest-box" id="citySuggest"></div>
                        </div>

                        <div class="field has-suggest">
                            <span class="field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297"
                                    xml:space="preserve">
                                    <path
                                        d="M148.5 69.022H44.969c-5.775 0-10.458 4.683-10.458 10.458 0 5.774 4.683 10.457 10.458 10.457H148.5c5.775 0 10.458-4.683 10.458-10.457 0-5.776-4.683-10.458-10.458-10.458zM148.5 103.532H44.969c-5.775 0-10.458 4.682-10.458 10.457s4.683 10.458 10.458 10.458H148.5c5.775 0 10.458-4.683 10.458-10.458s-4.683-10.457-10.458-10.457zM148.5 138.041H44.969c-5.775 0-10.458 4.683-10.458 10.458s4.683 10.458 10.458 10.458H148.5c5.775 0 10.458-4.683 10.458-10.458s-4.683-10.458-10.458-10.458z">
                                    </path>
                                    <path
                                        d="M270.855 17.255H26.144C11.728 17.255 0 28.983 0 43.399v175.69c0 14.416 11.728 26.145 26.144 26.145H181.18v24.054a10.459 10.459 0 0 0 16.257 8.702l20.083-13.388 20.082 13.388a10.449 10.449 0 0 0 10.736.519 10.458 10.458 0 0 0 5.522-9.22v-24.054h16.994c14.416 0 26.145-11.729 26.145-26.145V43.399c.001-14.416-11.728-26.144-26.144-26.144zM217.521 193.59c-15.281 0-27.714-12.487-27.714-27.835 0-15.347 12.433-27.834 27.714-27.834 15.281 0 27.713 12.487 27.713 27.834 0 15.348-12.431 27.835-27.713 27.835zm5.801 49.739a10.448 10.448 0 0 0-5.801-1.756c-2.022 0-4.045.585-5.801 1.756l-9.625 6.416v-37.769a48.279 48.279 0 0 0 15.426 2.528c5.391 0 10.575-.896 15.425-2.528v37.769l-9.624-6.416zm52.763-24.241c0 2.834-2.396 5.229-5.23 5.229h-16.994V198.1c7.637-8.612 12.288-19.94 12.288-32.345 0-26.88-21.814-48.75-48.628-48.75s-48.629 21.87-48.629 48.75c0 12.404 4.651 23.732 12.288 32.345v26.217H26.144c-2.834 0-5.229-2.395-5.229-5.229V43.399c0-2.834 2.395-5.229 5.229-5.229h244.711c2.834 0 5.23 2.395 5.23 5.229v175.689z">
                                    </path>
                                </svg></span>
                            <input type="text" id="courseInput" name="course" placeholder=" " autocomplete="off"
                                required>
                            <label>Course Interested In *</label>
                            <div class="suggest-box" id="courseSuggest"></div>
                        </div>

                        <div class="field has-suggest">
                            <span class="field-icon"><svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="a" maskUnits="userSpaceOnUse" x="0" y="0" width="17" height="17"
                                        style="mask-type: alpha;">
                                        <path fill="#D9D9D9" d="M0 0h17v17H0z"></path>
                                    </mask>
                                    <g mask="url(#a)">
                                        <path
                                            d="M3.83 15.23c-.377 0-.697-.132-.958-.394a1.304 1.304 0 0 1-.393-.958V4.61c0-.378.13-.697.393-.959.261-.262.581-.393.958-.393h.84V2.252c0-.151.055-.282.166-.395a.558.558 0 0 1 .414-.168c.155 0 .29.058.406.174a.557.557 0 0 1 .174.406v.99h5.367v-1.02a.53.53 0 0 1 .163-.385.545.545 0 0 1 .404-.165c.15 0 .282.057.396.17.114.114.17.246.17.397v1.002h.84c.377 0 .696.131.958.393s.393.581.393.959v9.268c0 .377-.131.697-.393.958a1.304 1.304 0 0 1-.959.393H3.83Zm0-1.134h9.34c.063 0 .115-.02.156-.061a.212.212 0 0 0 .061-.157V7.337H3.612v6.54a.212.212 0 0 0 .218.218Zm-.218-7.893h9.775V4.61a.212.212 0 0 0-.061-.157.212.212 0 0 0-.157-.061H3.83a.212.212 0 0 0-.156.061.212.212 0 0 0-.062.157v1.593Z"
                                            fill="#666"></path>
                                    </g>
                                </svg></span>
                            <input type="text" id="intakeInput" name="intake" placeholder=" " autocomplete="off"
                                required>
                            <label>When Do You Plan To Start Your Studies? *</label>
                            <div class="suggest-box" id="intakeSuggest"></div>
                        </div>

                        <!-- <div class="field has-suggest">
                                <span class="field-icon"><svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><mask id="a" maskUnits="userSpaceOnUse" x="0" y="0" width="17" height="17" style="mask-type: alpha;"><path fill="#D9D9D9" d="M0 0h17v17H0z"></path></mask><g mask="url(#a)"><path d="M3.83 15.23c-.377 0-.697-.132-.958-.394a1.304 1.304 0 0 1-.393-.958V4.61c0-.378.13-.697.393-.959.261-.262.581-.393.958-.393h.84V2.252c0-.151.055-.282.166-.395a.558.558 0 0 1 .414-.168c.155 0 .29.058.406.174a.557.557 0 0 1 .174.406v.99h5.367v-1.02a.53.53 0 0 1 .163-.385.545.545 0 0 1 .404-.165c.15 0 .282.057.396.17.114.114.17.246.17.397v1.002h.84c.377 0 .696.131.958.393s.393.581.393.959v9.268c0 .377-.131.697-.393.958a1.304 1.304 0 0 1-.959.393H3.83Zm0-1.134h9.34c.063 0 .115-.02.156-.061a.212.212 0 0 0 .061-.157V7.337H3.612v6.54a.212.212 0 0 0 .218.218Zm-.218-7.893h9.775V4.61a.212.212 0 0 0-.061-.157.212.212 0 0 0-.157-.061H3.83a.212.212 0 0 0-.156.061.212.212 0 0 0-.062.157v1.593Z" fill="#666"></path></g></svg></span>
                                <input type="text" id="yearInput" name="graduation_year" placeholder=" " autocomplete="off" required>
                                <label>Year Of Graduation *</label>
                                <div class="suggest-box" id="yearSuggest"></div>
                            </div> -->


                    </div>

                    <label class="checkbox">
                        <input type="checkbox" checked required>
                        By submitting this form, you accept and agree to our
                        <a href="#" target="_blank">Terms of Use</a> and
                        <a href="#" target="_blank">Privacy Policy</a>.
                    </label>

                    <div class="form-footer">
                        <span class="login-link">Already Registered? Click Here To Login.</span>
                        <button type="submit" class="modal-submit-btn">SUBMIT</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- Include jQuery, SweetAlert and intl-tel-input libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script>

    const modal = document.getElementById('studyModal');
    document.querySelectorAll('.js-open-custom-study-modal').forEach(btn => {
        btn.onclick = () => modal.classList.add('active');
    });
    modal.querySelector('.custom-study-modal-close').onclick = () => {
        modal.classList.remove('active');
    };
    modal.querySelector('.custom-study-modal-overlay').onclick = () => {
        modal.classList.remove('active');
    };
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') modal.classList.remove('active');
    });
</script>

<!-- form submission start -->
<script>
    $(document).ready(function () {

        // Block dangerous characters while typing
        $(document).on("keypress", "input[type='text'], input[type='email']", function (e) {
            const blockedChars = /[<>="'`;]/g;
            const char = String.fromCharCode(e.which);

            if (blockedChars.test(char)) {
                e.preventDefault();
            }
        });

        // Clean pasted content
        $(document).on("paste", "input[type='text'], input[type='email']", function (e) {
            e.preventDefault();

            let pastedData = (e.originalEvent || e).clipboardData.getData("text");

            pastedData = pastedData
                .replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '')
                .replace(/<\/?[^>]+(>|$)/g, '')
                .replace(/[<>="'`;]/g, '');

            document.execCommand("insertText", false, pastedData);
        });
        // Phone Input (intl-tel-input)

        const phoneInput = document.querySelector("#modal_phone_number");

        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            preferredCountries: ["in"],
            initialCountry: "in",
            utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
        });

        // Form Submit

        $("#courseFinderForm").on("submit", function (e) {
            e.preventDefault();

            const $form = $(this);
            const $btn = $form.find(".modal-submit-btn");

            // Clear previous errors
            $form.find(".error-text").remove();
            $form.find(".error").removeClass("error");

            // Validate phone
            if (!iti.isValidNumber()) {
                const fieldWrapper = $(phoneInput).closest(".field");

                fieldWrapper.append(
                    "<span class='error-text'>Please enter a valid mobile number</span>"
                );

                return;
            }

            // Set full phone number (E.164)
            const fullPhone = iti.getNumber(
                intlTelInputUtils.numberFormat.E164
            );
            // create hidden inputs dynamically
            $form.find("input[name='phone_number[full]']").remove();
            $form.find("input[name='phone_number[main]']").remove();

            $("<input>", {
                type: "hidden",
                name: "phone_number[full]",
                value: iti.getNumber(intlTelInputUtils.numberFormat.E164)
            }).appendTo($form);

            $("<input>", {
                type: "hidden",
                name: "phone_number[main]",
                value: iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL).replace(/\D/g, '')
            }).appendTo($form);


            // Button loading state
            $btn.prop("disabled", true).text("Submitting...");

            // AJAX Submit

            $.ajax({
                url: "{{ route('submit.lead.course.finder') }}",
                method: "POST",
                data: $form.serialize(),
                dataType: "json",

                success: function (response) {
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    }
                },

                error: function (xhr) {
                    $btn.prop("disabled", false).text("SUBMIT");

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;

                        $.each(errors, function (field, messages) {
                            const input = $form.find(`[name="${field}"]`);

                            if (input.length) {
                                input.addClass("error");
                                $("<span class='error-text'>" + messages[0] + "</span>")
                                    .insertAfter(input);
                            }
                        });
                    } else {
                        alert("Something went wrong. Please try again.");
                    }
                }
            });
        });

        // Modal Close

        $(".custom-study-modal-close, .custom-study-modal-overlay").on("click", function () {
            $("#studyModal").removeClass("active");
        });

    });
</script>

<!-- form submission end -->

<!-- suggest box in the form start -->
<style>
    .has-suggest {
        position: relative
    }

    .suggest-box {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #d1d5db;
        border-top: none;
        border-radius: 0 0 6px 6px;
        max-height: 120px;
        overflow-y: auto;
        display: none;
        z-index: 5
    }

    .suggest-item {
        padding: 10px;
        font-size: 12px;
        cursor: pointer;
        border-bottom: 1px solid #e5e7eb
    }

    .suggest-item:hover {
        background: #f3f4f6
    }
</style>
<script>
    let activeBox = null

    function closeAllSuggest() {
        document.querySelectorAll('.suggest-box').forEach(b => b.style.display = 'none')
        activeBox = null
    }

    function setupSuggest(inputId, boxId, data) {
        const input = document.getElementById(inputId)
        const box = document.getElementById(boxId)

        function render(list) {
            closeAllSuggest()
            box.innerHTML = ''
            if (!list.length) return
            list.forEach(v => {
                const d = document.createElement('div')
                d.className = 'suggest-item'
                d.textContent = v
                d.onclick = () => {
                    input.value = v
                    closeAllSuggest()
                }
                box.appendChild(d)
            })
            box.style.display = 'block'
            activeBox = box
        }

        input.addEventListener('focus', () => render(data))

        input.addEventListener('input', () => {
            const val = input.value.toLowerCase()
            render(data.filter(v => v.toLowerCase().includes(val)))
        })
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.has-suggest')) closeAllSuggest()
    })

    setupSuggest('courseInput', 'courseSuggest', [
        'MBA', 'BBA', 'BTech', 'MTech', 'MS', 'Data Science', 'Computer Science',
        'Artificial Intelligence', 'Business Analytics', 'Finance', 'Marketing'
    ])

    setupSuggest('intakeInput', 'intakeSuggest', [
        'May 2026', 'September 2026',
        'January 2027', 'May 2027', 'September 2027', 'January 2028',
    ])

    setupSuggest('cityInput', 'citySuggest', [
        'Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Pune',
        'Ahmedabad', 'Jaipur', 'Kolkata', 'Indore', 'Bhopal', 'Udaipur'
    ])

    setupSuggest('yearInput', 'yearSuggest', [
        '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'
    ])
</script>
<!-- suggest box in the form end -->