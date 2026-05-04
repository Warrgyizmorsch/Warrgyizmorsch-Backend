<section class="top-universities-section">
    <div class="container">
        <div class="section-head">
            <div>
                <h2 class="new-section-title">Top Universities / Colleges</h2>
            </div>
        </div>

        <div class="universities-carousel">
            <button id="prevBtn" class="custom-swiper-prev">
                <img src="/new-home-images/svg-icons/right-arrow.svg" style="transform: rotate(180deg); height: 20px;"
                    alt="left-arrow">
            </button>

            <div class="carousel-track-wrapper">
                <div class="carousel-track" id="carouselTrack">

                    <!-- Card 1 -->
                    @foreach($universities as $university)
                    <div class="university-card">
                        <div class="card-inner">
                            <div class="card-header">
                                <img src="{{ asset($university->banner_image) }}" alt="University Cover" class="cover-img">
                                <div class="header-overlay"></div>

                                <div class="top-badge-row">
                                    {{-- <span class="badge-rating">⭐ 9.5 / 10</span> --}}
                                    <span class="badge-type">Top Ranked</span>
                                </div>

                                <div class="header-bottom-content">
                                    <div class="logo-box">
                                    @php
    $logo = $university->logo_image ?? null;
    $file = $logo ? basename($logo) : null;
                                        
                                    @endphp

                                    @if($file)
                                        <img 
                                            src="{{ asset('university-logos/' . $file) }}" 
                                            alt="{{ $university->name }}"
                                        >
                                    @endif
                                    </div>
                                    <div class="text-info">
                                        <h3>{{$university->name}}</h3>
                                        {{-- <p>{{$university->city}}</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Location</span>
                                        <span class="meta-value">{{$university->city}}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Establish Year</span>
                                        <span class="meta-value price">since : {{$university->established_year}}</span>
                                    </div>
                                </div>

                                <div class="info-strip">AICTE, NBA Approved</div>

                                <button type="button" class="study-guide-button js-open-custom-study-modal"
                                    data-university="Lexicon MILE" data-location="Pune, Maharashtra"
                                    data-fees="₹ 4.50 Lacs">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
            <button id="nextBtn" class="custom-swiper-next">
                <img src="/new-home-images/svg-icons/right-arrow.svg" style="height: 20px;" alt="right-arrow">
            </button>
        </div>

        <div class="slider-dots" id="sliderDots"></div>

        <div style="text-align:center; margin-top:20px;">
            <a href="/course-finder" class="study-guide-button"
                style="max-width:260px; margin:auto; text-decoration:none;">
                View All Universities
            </a>
        </div>
    </div>
</section>

@include('components.course-registration-form-modal')

<style>
    .top-universities-section {
        background: #ffffff;
        padding: 30px 0;
        overflow: hidden;
        width: 100%;
        font-family: 'Segoe UI', Tahoma, sans-serif;
    }

    .top-universities-section * {
        box-sizing: border-box;
    }

    .top-universities-section .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 16px;
    }

    .section-head {
        margin-bottom: 30px;
    }

    .section-tag {
        display: inline-block;
        padding: 7px 14px;
        background: #fff4ea;
        color: #ff7900;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    /* .new-section-title {
        font-size: 36px;
        line-height: 1.15;
        font-weight: 800;
        color: #1e3056;
        margin: 0 0 8px;
    } */

    .section-subtitle {
        margin: 0;
        font-size: 15px;
        color: #667085;
        max-width: 700px;
        line-height: 1.6;
    }

    .universities-carousel {
        position: relative;
    }

    .carousel-track-wrapper {
        overflow: hidden;
        width: 100%;
        padding: 12px 0 20px;
        touch-action: pan-y;
    }

    .carousel-track {
        display: flex;
        margin: 0;
        padding: 0;
        will-change: transform;
    }

    .university-card {
        flex: 0 0 100%;
        padding: 0 10px;
    }

    /* MOBILE FIX ONLY */

    @media (max-width:768px) {

        .university-card {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 8px;
        }

        .carousel-track {
            gap: 0;
        }

    }

    @media (min-width: 1100px) {
        .university-card {
            flex: 0 0 33.3333%;
        }
    }

    .card-body .study-guide-button {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .card-body .study-guide-button {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .card-inner {
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid #eef1f5;
        box-shadow: 0 12px 35px rgba(16, 24, 40, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .card-inner:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 45px rgba(16, 24, 40, 0.14);
    }

    .card-header {
        position: relative;
        height: 250px;
    }

    .cover-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .header-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.08) 0%, rgba(0, 0, 0, 0.78) 100%);
        z-index: 1;
    }

    .top-badge-row {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .badge-rating,
    .badge-type {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.95);
        color: #1e3056;
        font-size: 12px;
        font-weight: 800;
        backdrop-filter: blur(8px);
    }

    .header-bottom-content {
        position: absolute;
        left: 16px;
        right: 16px;
        bottom: 16px;
        z-index: 2;
        display: flex;
        align-items: end;
        gap: 12px;
    }

    .logo-box {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: #fff;
        padding: 8px;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .text-info h3 {
        margin: 0 0 6px;
        color: #fff;
        font-size: 19px;
        line-height: 1.25;
        font-weight: 800;
    }

    .text-info p {
        margin: 0;
        color: rgba(255, 255, 255, 0.92);
        font-size: 13px;
        line-height: 1.4;
        font-weight: 500;
    }

    .card-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        flex-grow: 1;
    }

    .card-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .meta-item {
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 14px;
        padding: 14px;
    }

    .meta-label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #98a2b3;
        margin-bottom: 7px;
        font-weight: 700;
    }

    .meta-value {
        display: block;
        font-size: 15px;
        color: #1e3056;
        font-weight: 800;
        line-height: 1.4;
    }

    .meta-value.price {
        color: #ff7900;
        font-size: 20px;
    }

    .info-strip {
        background: linear-gradient(135deg, #fff7ef 0%, #fff1e4 100%);
        color: #b45d00;
        border-left: 4px solid #ff7900;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 13px;
        font-weight: 700;
    }

    .custom-nav {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 10px 24px rgba(16, 24, 40, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
        cursor: pointer;
    }

    .custom-swiper-prev {
        left: -12px;
    }

    .custom-swiper-prev img {
        transform: rotate(180deg);
        height: 20px;
    }

    .custom-swiper-next {
        right: -12px;
    }

    .custom-swiper-next img {
        height: 20px;
    }

    .slider-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
    }

    .slider-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #d0d5dd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slider-dot.active {
        width: 28px;
        border-radius: 30px;
        background: #ff7900;
    }

    /* ================= MODAL ================= */
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
        width: 100%;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        z-index: 2;
    }

    .custom-study-modal-close {
        position: absolute;
        right: 15px;
        top: 10px;
        font-size: 28px;
        border: none;
        background: none;
        cursor: pointer;
        z-index: 3;
    }

    .custom-study-modal-body {
        display: flex;
        align-items: stretch;
    }

    .custom-study-left {
        width: 40%;
        padding: 30px;
        background: linear-gradient(135deg, #f7e9ff, #ffe8f0);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .custom-study-left span {
        color: green;
        font-weight: bold;
    }

    .custom-study-left h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .custom-study-left p {
        text-align: center;
    }

    .custom-study-left .study-highlight {
        text-align: center;
    }

    .experts-row {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        margin: 20px 0 24px;
    }

    .expert-col {
        flex: 1 1 33.333%;
        max-width: 33.333%;
        display: flex;
        justify-content: center;
    }

    .expert-img {
        width: 100%;
        max-width: 220px;
        height: auto;
        border-radius: 12px;
        object-fit: cover;
    }

    .custom-study-right {
        width: 60%;
        padding: 30px;
    }

    .custom-study-right .title {
        text-align: left;
        font-size: 1.4rem;
        margin: 0 0 6px;
    }

    .custom-study-right .subtitle {
        text-align: left;
        font-size: 1rem;
        margin: 0 0 14px;
    }

    .selected-university-box {
        background: linear-gradient(135deg, #f8fbff 0%, #eef4ff 100%);
        border: 1px solid #e1eaf8;
        border-radius: 18px;
        padding: 16px 18px;
        margin-bottom: 18px;
    }

    .selected-university-box h4 {
        margin: 0 0 6px;
        color: #1e3056;
        font-size: 20px;
        font-weight: 800;
    }

    .selected-university-box p {
        margin: 0 0 8px;
        color: #667085;
        font-size: 14px;
    }

    .selected-university-box span {
        display: inline-block;
        background: #fff;
        color: #ff7900;
        font-size: 14px;
        font-weight: 800;
        border-radius: 999px;
        padding: 8px 14px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .field {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .field input {
        width: 100%;
        height: 42px;
        padding: 5px 10px 5px 40px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 12px;
        background: #fff;
        outline: none;
    }

    .field label {
        position: absolute;
        top: -7px;
        left: 12px;
        font-size: 9px;
        font-weight: 600;
        color: #111;
        background: #fff;
        padding: 0 6px;
        pointer-events: none;
    }

    .field-icon {
        position: absolute;
        top: 21px;
        left: 14px;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
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

    .checkbox {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        font-size: 11px;
        margin-top: 16px;
        line-height: 1.4;
        flex-wrap: wrap;
        white-space: normal;
    }

    .checkbox input {
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* .checkbox a{
margin:0 3px;
word-break:break-word;
} */

    @media (max-width:768px) {

        .form-footer .study-guide-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

    }

    /* .checkbox a{
margin:0 3px;
} */

    .checkbox input {
        margin-top: 2px;
        flex-shrink: 0;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        gap: 15px;
    }

    .login-link {
        font-size: 14px;
        color: #ff7a00;
        font-weight: bold;
        cursor: pointer;
    }

    .modal-submit-btn {
        background: linear-gradient(135deg, #ff8f33, #ff7a00);
        color: #fff;
        border: none;
        padding: 14px 30px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
    }

    .modal-submit-btn:hover {
        background: linear-gradient(135deg, #ff7a00, #e65f00);
    }

    /* ================= MOBILE RESPONSIVE MODAL ================= */

    @media (max-width: 768px) {

        .custom-study-modal {
            padding: 10px;
            align-items: flex-start;
            overflow-y: auto;
        }

        .custom-study-modal-box {
            max-width: 100%;
            border-radius: 10px;
        }

        .custom-study-modal-body {
            flex-direction: column;
        }

        /* LEFT PART */
        .custom-study-left {
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        .custom-study-left h2 {
            font-size: 24px;
        }

        .custom-study-left p {
            font-size: 13px;
        }

        /* EXPERT IMAGES */
        .experts-row {
            gap: 8px;
        }

        .expert-col {
            max-width: 33.33%;
            flex: 0 0 33.33%;
        }

        .expert-img {
            max-width: 100%;
        }

        /* RIGHT PART FORM */
        .custom-study-right {
            width: 100%;
            padding: 20px;
        }

        .custom-study-right .title {
            font-size: 18px;
        }

        .custom-study-right .subtitle {
            font-size: 13px;
        }

        /* FORM GRID MOBILE */
        .form-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        /* FOOTER STACK */
        .form-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .login-link {
            text-align: center;
        }

        /* BUTTON FULL */
        .form-footer .study-guide-button {
            width: 100%;
        }

    }

    .new-section-title {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        font-size: 2rem;
        font-weight: 600;
        color: #1C2C59;
        margin-top: 15px;
        margin-bottom: 45px;
        position: relative;
        text-align: left;
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .new-section-title::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: 0;
        width: 0;
        height: 30px;
        background: url("/new-home-images/svg-icons/heading-underline.svg") no-repeat center/contain;
        transition: width 0.8s ease, transform 0.8s ease;
        transform-origin: left center;
    }

    /* Trigger animation */
    .new-section-title.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .new-section-title.visible::after {
        width: 250px;
        animation: underlineBounce 0.8s ease forwards;
    }

    @keyframes underlineBounce {
        0% {
            transform: scaleX(0);
        }

        60% {
            transform: scaleX(1.1);
        }

        80% {
            transform: scaleX(0.95);
        }

        100% {
            transform: scaleX(1);
        }
    }

    @media (max-width: 768px) {
        .hide-on-mobile {
            display: none !important;
        }
    }

    .has-suggest {
        position: relative;
    }

    .suggest-box {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #d1d5db;
        border-top: none;
        max-height: 120px;
        overflow-y: auto;
        display: none;
        z-index: 50;
    }

    .suggest-item {
        padding: 8px 10px;
        cursor: pointer;
        font-size: 12px;
    }

    .suggest-item:hover {
        background: #f3f4f6;
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

    /* .phone-field .field-icon {        
            left: 90px !important;
            z-index: 9999;
        } */
</style>
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

    .field {
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .custom-swiper-prev,
    .custom-swiper-next {
        position: absolute;
        top: 45%;
        transform: translateY(-50%);
        background: white;
        /* your theme color */
        color: #18336c;
        border: 1px solid #18336c;
        font-size: 2rem;
        height: 45px;
        width: 45px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
    }

    .custom-swiper-prev {
        left: 4px;
    }

    .custom-swiper-next {
        right: 4px;
    }

    .custom-swiper-next:hover,
    .custom-swiper-prev:hover {
        transform: translateY(-50%) scale(1.1) rotate(-20deg);
    }

    .custom-swiper-next:active,
    .custom-swiper-prev:active {
        transform: translateY(-50%) scale(0.9) rotate(0deg);
        transition: transform 0.1s ease;
    }
</style>