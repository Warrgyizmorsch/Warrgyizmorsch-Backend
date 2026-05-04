@extends('layouts.app')

@section('content')
    @php
        $currentUrl = request()->fullUrl() ?? '';             
    @endphp
    <section class="contact-section">
    <div class="container">
        <h1 style="color: var(--primary-color);">Contact Us</h1>
        <p>We would love to hear from you! Fill out the form below and we'll get back to you soon.</p>

        <div class="contact-content">

            <!-- LEFT : CONTACT INFO -->
            <!-- LEFT : CONTACT INFO -->
<div class="contact-info">
    <h3 style="margin-bottom: 25px; color: var(--primary-color); font-weight: 800;">Contact Info</h3>
    <div class="equal-width-grid">
        
        <a href="mailto:info@wtsvisa.com" class="premium-card">
            <div class="p-icon"><i class="fas fa-envelope"></i></div>
            <div class="p-text">
                <small>Email Address</small>
                <span>info@wtsvisa.com</span>
            </div>
        </a>

        <a href="tel:+919116076837" class="premium-card">
            <div class="p-icon"><i class="fas fa-phone"></i></div>
            <div class="p-text">
                <small>Phone Number</small>
                <span>+91 9116076837</span>
            </div>
        </a>

        <a href="javascript:void(0)" onclick="scrollToOffice(0)" class="premium-card">
            <div class="p-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="p-text">
                <small>Rajasthan Office</small>
                <span>402, 4th floor, Kanakshree apartment, 80ft road, Shobhagpura, Udaipur, Rajasthan 313001</span>
            </div>
        </a>

        <a href="javascript:void(0)" onclick="scrollToOffice(1)" class="premium-card">
            <div class="p-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="p-text">
                <small>Gujarat Office</small>
                <span>4th Floor, D 401 Lotus Aura 2, Sama Sawali Road, Vadodara, Gujarat 390008</span>
            </div>
        </a>

        <a href="javascript:void(0)" onclick="scrollToOffice(2)" class="premium-card">
            <div class="p-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="p-text">
                <small>Jammu Office</small>
                <span>Jai Sukrala Wood Craft Industry, R/o Bachyal, Marh, Jammu, Pin 181206</span>
            </div>
        </a>

        <a href="javascript:void(0)" onclick="scrollToOffice(3)" class="premium-card">
            <div class="p-icon"><i class="fas fa-map-marker-alt""></i></div>
            <div class="p-text">
                <small>UK Office</small>
                <span>312, Pentax House, South Hill Avenue, South Harrow, HA2 0DU, UK</span>
            </div>
        </a>

    </div>
</div>


            <!-- RIGHT : CONTACT FORM -->
            <form class="contact-form" method="POST" id="contact_us_form">
                @csrf
                <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">

                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone_number[main]" id="phone_number">
                </div>

                <div class="form-group">
                    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label style="display:flex;align-items:center;font-size:13px;color:#ffcc00;">
                        <input type="checkbox" id="termsCheckbox" name="tac_check" style="margin-right:8px;">
                        I agree to the&nbsp;
                        <a href="/terms-and-conditions" target="_blank"
                           style="color:#fff;text-decoration:underline;">
                            Terms & Conditions
                        </a>
                    </label>
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>

        </div>
    </div>
</section>

    <!-- Include jQuery, SweetAlert and intl-tel-input libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

    <script>
        // Initialize the intl-tel-input library for phone number input
        var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
        $("form").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

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
                url: "{{ route('contact.submit') }}", // Your form submission URL
                method: "POST",
                data: formData,
                success: function (response) {
                    if (response.success && response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        // Success: Show a success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Thank you for contacting us!',
                            text: 'We will get back to you soon.',
                            showConfirmButton: true,
                        }).then(function () {
                            // Optionally, reset the form after success
                            $('#contact_us_form')[0].reset();
                            // Re-enable the submit button after success
                            $('button[type="submit"]').prop('disabled', false).text('Send Message');
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
                        $('button[type="submit"]').prop('disabled', false).text('Send Message');
                    });
                }
            });
        });
    </script>
    <script>
        // --------- NAME VALIDATION (letters + numbers + spaces) ---------
        const nameInput = document.querySelector("input[name='name']");

        nameInput.setAttribute("maxlength", "30");

        // Block copy, paste, cut
        ["paste", "copy", "cut"].forEach(evt => {
            nameInput.addEventListener(evt, e => e.preventDefault());
        });

        // Allow only letters, numbers, spaces — max 30 chars
        nameInput.addEventListener("input", function () {
            this.value = this.value
                .replace(/[^a-zA-Z0-9 ]/g, '')  // allow letters + numbers + space
                .slice(0, 30);
        });


        // --------- PHONE NUMBER VALIDATION ---------
        const phoneField = document.querySelector("#phone_number");

        // Block copy, paste, cut
        ["paste", "copy", "cut"].forEach(evt => {
            phoneField.addEventListener(evt, e => e.preventDefault());
        });

        phoneField.addEventListener("input", function () {
            this.value = this.value
                .replace(/[^0-9]/g, '')
                .slice(0, 15); 
        });


        // --------- EMAIL VALIDATION ---------
        const emailInput = document.querySelector("input[name='email']");

        emailInput.addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-Z0-9@._\-]/g, '');
        });


        // --------- MESSAGE VALIDATION ---------
        const messageInput = document.querySelector("textarea[name='message']");
        // Remove blank spaces on page load so placeholder appears
        document.addEventListener("DOMContentLoaded", function () {
            if (messageInput && messageInput.value.trim() === "") {
                messageInput.value = "";
            }
        });

        // Remove harmful input
        messageInput.addEventListener("input", function () {
            this.value = this.value.replace(/<|>|script|{|}|\\/gi, '');
        });

        // BLOCK paste harmful text
        messageInput.addEventListener("paste", function (e) {
            setTimeout(() => {
                messageInput.dispatchEvent(new Event("input"));
            }, 10);
        });

    </script>
<style>
.equal-width-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
    width: 100%;
    align-items: stretch; 
}

.premium-card {
    background: #ffffff;
    padding: 19px;
    border-radius: 12px;
    display: flex;
    align-items: center; 
    gap: 15px;
    text-decoration: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border-left: 5px solid #FC9118;
    

    min-height: 105px;   
    transition: background 0.2s ease, box-shadow 0.2s ease;
    
    min-width: 0; 
    overflow: hidden;
    box-sizing: border-box;
    backface-visibility: hidden; 
    transform: translateZ(0); 
}

.premium-card:hover {
    background: #ffffff; 
    box-shadow: 0 8px 25px rgba(252, 145, 24, 0.2); 
}

/* Isse content move nahi hoga */
.premium-card * {
    transition: none !important; 
}

.p-icon {
    min-width: 42px;
    height: 42px;
    background: #1C2C59;
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.p-icon .fa-phone {
    transform: rotate(0deg) !important;
}

.p-text {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.p-text small {
    display: block;
    color: #FC9118;
    font-weight: 800;
    font-size: 9px;
    text-transform: uppercase;
    margin-bottom: 2px;
}

.p-text span {
    font-size: 11px;
    color: #1C2C59;
    font-weight: 600;
    line-height: 1.3;
    word-break: break-word; 
    overflow-wrap: break-word;
}

@media (max-width: 900px) {
    .equal-width-grid { grid-template-columns: 1fr; }
    .premium-card { min-height: auto; } 
}
</style>
    <style>
        .iti {
            width: -webkit-fill-available !important;
        }

        .iti--separate-dial-code .iti__selected-dial-code {
            color: black !important;
        }

        .iti__country-name,
        .iti__flag-box {
            color: black;
        }
    </style>
    <style>
        /* checkbox */
        .form-group input[type="checkbox"] {
            accent-color: #ffcc00;
            width: 16px;
            height: 16px;
        }

        .contact-form textarea {
            background-color: white !important;
        }

        .contact-form {
            background-color: #1C2C59;
            width: 370px;
        }

        .contact-info {
            line-height: 2;
        }

        .contact-info strong {
            color: #FC9118;
        }
        .contact-icon {
            color: #FC9118;
            margin-right: 8px;
            font-size: 15px;
            vertical-align: middle;
        }
        .contact-section {
            background-color: #f2f2f2;  
            padding: 110px 0;
        }
        .contact-section h1 {
            color: var(--primary-color);
        }
        
        .contact-section p {
            color: black;
        }

        .contact-info a:hover {
            text-decoration: underline;
            color: #FC9118;
        }
        /* ===== CONTACT INFO HOVER EFFECT ===== */

        .contact-info a {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        /* Hover effect */
        .contact-info a:hover {
            color: #FC9118;           
            text-decoration: underline; 
            padding-left: 5px;    
        }

        .contact-info p {
            transition: 0.3s ease;
        }
        
        .contact-info p:hover {
            color: #1C2C59;
            cursor: pointer;
        }
        
        .contact-info p:hover a {
            color: #1C2C59;
        }



       /* ================= ONLY RESPONSIVE FIX ================= */

@media (max-width: 1200px) {
    .contact-form {
        width: 100%;
    }
}

/* Tablet */
@media (max-width: 992px) {
    .contact-content {
        flex-wrap: wrap;
    }

    .contact-info,
    .contact-form {
        width: 100%;
    }
}

/* Mobile */
@media (max-width: 576px) {
    .contact-section {
        padding: 90px 15px;
    }

    .contact-form {
        width: 100%;
    }

    .contact-info p {
        font-size: 14px;
    }

    .contact-info h3 {
        font-size: 18px;
    }

    .contact-section h1 {
        font-size: 26px;
    }
}
/* ===== CONTACT HEADING RESPONSIVE FIX ===== */

.contact-section h1 {
    position: relative;
    z-index: 2;
    word-break: break-word;
}

/* Mobile fix */
@media (max-width: 576px) {
    .contact-section {
        padding-top: 80px;  
    }

    .contact-section h1 {
        font-size: 24px;
        line-height: 1.5;
        margin-bottom: 5px;
        text-align: center;
    }

    .contact-section p {
        text-align: center;
    }
}
/* ===== CONTACT INFO LEFT ALIGN FIX (ALL SCREENS) ===== */

.contact-info,
.contact-info p,
.contact-info h3 {
    text-align: left !important;
}

@media (max-width: 576px) {
    .contact-info {
        text-align: left !important;
    }

    .contact-info p {
        text-align: left !important;
    }
}

/* ===== MOBILE ME FORM UPAR, INFO NICHE ===== */
@media (max-width: 576px) {
    .contact-content {
        display: flex;
        flex-direction: column;
    }

    .contact-form {
        order: 1;  
        margin-bottom: 25px;
    }

    .contact-info {
        order: 2;   
    }
}

 </style>

{{-- ================= OFFICE MAP SECTION START ================= --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="office-map-section">
    <div class="container-fluid">

        <h2 class="text-center mb-4" style="color:var(--primary-color)">
            Your Destination for Trusted Study Abroad Guidance – Find Us Here
        </h2>

        <div class="map-wrapper">

            <div id="officeMap"></div>

            <!-- Overlay Cards -->
            <div class="map-cards">
                <div class="office-card" data-id="0">
    <i class="fa-solid fa-location-dot me-2"></i>
    <strong>Rajasthan Office</strong>
</div>

<div class="office-card" data-id="1">
    <i class="fa-solid fa-location-dot me-2"></i>
    <strong>Gujarat Office</strong>
</div>

<div class="office-card" data-id="2">
    <i class="fa-solid fa-location-dot me-2"></i>
    <strong>Jammu Office</strong>
</div>

<div class="office-card" data-id="3">
    <i class="fa-solid fa-location-dot me-2"></i>
    <strong>UK Office</strong>
</div>

            </div>

        </div>

    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>
.office-map-section { margin: 60px 0; }
.map-wrapper { position: relative; }

#officeMap {
    width: 100%;
    height: 520px;
    border-radius: 14px;
}

.map-cards {
    position: absolute;
    top: 250px;
    left: 15px;
    width: 260px;
    z-index: 400;
}
.office-card i {
    color: var(--primary-color);
    margin-right: 6px;
}

.office-card:hover i,
.office-card.active i {
    color: #fff;
}


.office-card {
    background: #fff;
    padding: 12px 14px;
    margin-bottom: 10px;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    transition: 0.3s;
    font-size: 14px;
}

.office-card:hover,
.office-card.active {
    background: var(--primary-color);
    color: #fff;
}

/* Header overlap fix */
.leaflet-top,
.leaflet-bottom,
.leaflet-control {
    z-index: 400 !important;
}

@media (max-width: 768px) {
    #officeMap { height: 420px; }
    .map-cards { width: 180px; top: 240px; left: 10px; }
    .office-card { font-size: 12px; padding: 8px 10px; }
}

.custom-marker { position: relative; }

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(28,44,89,0.6); }
    70% { box-shadow: 0 0 0 14px rgba(28,44,89,0); }
    100% { box-shadow: 0 0 0 0 rgba(28,44,89,0); }
}
</style>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const primaryColor = getComputedStyle(document.documentElement)
        .getPropertyValue('--primary-color').trim() || "#1C2C59";

    const map = L.map('officeMap', {
        zoomControl: true,
        scrollWheelZoom: false,
        dragging: true,
        tap: true
    });

    L.tileLayer(
        'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
        {
            attribution: '&copy; OpenStreetMap & CartoDB',
            maxZoom: 19
        }
    ).addTo(map);

    const offices = [
        {
            title: "Rajasthan Office",
            address: "402, 4th floor, Kanakshree apartment, 80ft road, Shobhagpura, Udaipur, Rajasthan 313001",
            lat: 24.5787,
            lng: 73.6863
        },
        {
            title: "Gujarat Office",
            address: "4th Floor, D 401 Lotus Aura 2, Near Indian Oil Petrol Pump, Sama Sawali Road, Vadodara, Gujarat 390008",
            lat: 22.3072,
            lng: 73.1812
        },
        {
            title: "Jammu Office",
            address: "Jai Sukrala Wood Craft Industry, R/o Bachyal, Teh. Marh, District Jammu, P/O Paryal, Pin 181206",
            lat: 32.7357,
            lng: 74.8691
        },
        {
            title: "UK Office",
            address: "312, Pentax House, South Hill Avenue, South Harrow, Middlesex, HA2 0DU, United Kingdom",
            lat: 51.5830,
            lng: -0.3378
        }
    ];

    const markers = [];

    const customIcon = L.divIcon({
        className: "custom-marker",
        html: `
            <div style="
                background:${primaryColor};
                width:22px;
                height:22px;
                border-radius:50% 50% 50% 0;
                transform: rotate(-45deg);
                position: relative;
                animation: pulse 1.5s infinite;
            ">
                <div style="
                    width:10px;
                    height:10px;
                    background:white;
                    border-radius:50%;
                    position:absolute;
                    top:6px;
                    left:6px;
                "></div>
            </div>
        `,
        iconSize: [22, 22],
        iconAnchor: [11, 22]
    });

    offices.forEach(function (office, index) {

        const directionURL =
            `https://www.google.com/maps/dir/?api=1&destination=${office.lat},${office.lng}`;

        const marker = L.marker([office.lat, office.lng], { icon: customIcon })
    .addTo(map)
    .bindPopup(`
        <div style="min-width:250px;">
            <strong style="color:${primaryColor}; font-size:14px;">
                ${office.title}
            </strong><br>
            <span style="font-size:13px;">
                ${office.address}
            </span>
            <br><br>
        </div>
    `, {
        offset: [0, -25] 
    });


        markers.push(marker);

        // Marker click → Card active
        marker.on("click", function () {

            document.querySelectorAll(".office-card")
                .forEach(c => c.classList.remove("active"));

            const targetCard = document.querySelector(`.office-card[data-id="${index}"]`);
            if (targetCard) {
                targetCard.classList.add("active");
            }

        });

    });

    const group = L.featureGroup(markers);
    map.fitBounds(group.getBounds(), { padding: [120, 100] });

    // CARD CLICK (Already Working)
    document.querySelectorAll(".office-card").forEach(function(card, index) {

        card.addEventListener("click", function() {

            document.querySelectorAll(".office-card")
                .forEach(c => c.classList.remove("active"));

            this.classList.add("active");

            const office = offices[index];
            const marker = markers[index];

            map.flyTo([office.lat, office.lng], 7, {
                animate: true,
                duration: 1.5
            });

            marker.openPopup();

        });

    });

});

// Function to Scroll and Trigger Map
function scrollToOffice(index) {

    const mapSection = document.querySelector('.office-map-section');
    mapSection.scrollIntoView({ behavior: 'smooth', block: 'start' });


    setTimeout(() => {
    
        const officeCards = document.querySelectorAll(".office-card");
        if (officeCards[index]) {
        
            officeCards[index].click();
        }
    }, 800);
}
</script>



{{-- ================= OFFICE MAP SECTION END ================= --}}

{{-- New Section For Social Media  --}}

    <section class="follow-us-section">
    <div class="container">
        <h2 style="color:var(--primary-color)">Stay Connected With Us</h2>

        <div class="follow-visual">

            <!-- GIRL IMAGE -->
            <img src="/images/Socialicon.png" alt="Social Girl" class="girl-image">

            <!-- LEFT ICONS -->
            <a href="https://www.instagram.com/wts_consultancy" target="_blank"
               class="floating-icon icon-instagram">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="https://www.facebook.com/wtsstudyconsultancy" target="_blank"
               class="floating-icon icon-facebook">
                <i class="fab fa-facebook-f"></i>
            </a>

            <!-- RIGHT ICONS -->
            <a href="https://www.youtube.com/@wtsstudyabroadconsultant" target="_blank"
               class="floating-icon icon-youtube">
                <i class="fab fa-youtube"></i>
            </a>

            <a href="https://www.linkedin.com/company/wts-consultancy" target="_blank"
               class="floating-icon icon-linkedin">
                <i class="fab fa-linkedin-in"></i>
            </a>

        </div>

    </div>
</section>
<style>
    /* ================= FOLLOW US SECTION ================= */

.follow-us-section {
    background: #fff;
}

/* CENTER VISUAL WRAPPER */
.follow-visual {
    position: relative;
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
    overflow: visible;
}

/* GIRL IMAGE */
.girl-image {
    width: 100%;
    height: auto;
    display: block;
}

/* COMMON ICON STYLE */
.floating-icon {
    position: absolute;
    background: #18336c;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 22px rgba(0,0,0,0.22);
    z-index: 5;
}

.floating-icon:hover {
    background: var(--primary-color);
    transform: scale(1.12);
}

/* ================= DESKTOP ================= */
@media (min-width: 1025px) {
    .floating-icon {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }

    .icon-instagram { left: -70px; top: 28%; }
    .icon-facebook  { left: -90px; top: 55%; }
    .icon-youtube   { right: -70px; top: 30%; }
    .icon-linkedin  { right: -90px; top: 58%; }
}

/* ================= LAPTOP / TABLET ================= */
@media (max-width: 1024px) {
    .floating-icon {
        width: 65px;
        height: 65px;
        font-size: 26px;
    }

    .icon-instagram { left: -45px; top: 30%; }
    .icon-facebook  { left: -60px; top: 56%; }
    .icon-youtube   { right: -45px; top: 32%; }
    .icon-linkedin  { right: -60px; top: 58%; }
}

/* ================= MOBILE SAFE ================= */
@media (max-width: 576px) {
    .follow-visual {
        max-width: 280px;
    }

    .floating-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    .icon-instagram { left: -16px; top: 30%; }
    .icon-facebook  { left: -20px; top: 56%; }
    .icon-youtube   { right: -16px; top: 32%; }
    .icon-linkedin  { right: -20px; top: 58%; }
}

/* ================= 320px ULTRA SAFE ================= */
@media (max-width: 360px) {
    .follow-visual {
        max-width: 240px;
    }

    .floating-icon {
        width: 46px;
        height: 46px;
        font-size: 18px;
    }

    .icon-instagram { left: -10px; top: 30%; }
    .icon-facebook  { left: -14px; top: 56%; }
    .icon-youtube   { right: -10px; top: 32%; }
    .icon-linkedin  { right: -14px; top: 58%; }
}

/* ================= FLOATING ICON ANIMATION ================= */

@keyframes floatIcon {
    0% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-10px) scale(1.03);
    }
    100% {
        transform: translateY(0) scale(1);
    }
}

@keyframes swayIcon {
    0% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(6px);
    }
    100% {
        transform: translateX(0);
    }
}

/* apply animation */
.floating-icon {
    animation: floatIcon 3.5s ease-in-out infinite;
}

/* DIFFERENT TIMING */
.icon-instagram {
    animation-delay: 0s;
}

.icon-facebook {
    animation-delay: 0.6s;
}

.icon-youtube {
    animation-delay: 1.2s;
}

.icon-linkedin {
    animation-delay: 1.8s;
}

</style>

@endsection