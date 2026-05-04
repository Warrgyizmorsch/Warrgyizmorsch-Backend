@extends('layouts.app')

@section('content')

    <style>
        .heading-wrapper {
            max-width: 1200px !important;
            margin: 0 auto
        }

        .sop-samples {
            background: #f5f7fc61;
            color: #fff;
            text-align: center;
            padding: 40px 20px;
        }



        /* Fixed 2 rows × 3 columns */
        .sample-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .sample-card {
            background: #fff;
            color: #222;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .sample-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 204, 0, 0.15), transparent);
            transition: 0.5s;
        }

        .sample-card:hover::before {
            left: 100%;
        }

        .sample-card:hover {
            transform: translateY(-10px);
        }

        .sample-card-icon {
            font-size: 40px;
            color: #fff;
            background: var(--primary-color);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .sample-card:hover .sample-card-icon {
            background: #222;
            color: #ffcc00;
            transform: rotate(15deg);
        }

        .sample-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .sample-card p {
            font-size: 0.95rem;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sample-container {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }
        }

        @media (max-width: 600px) {
            .sample-container {
                grid-template-columns: 1fr;
            }



            .sample-card-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
        }
    </style>
    <style>
        .hero-main {
            background-color: #F7F4EF !important;
            padding: 20px 0 !important;
        }

        .hero-form {
            position: relative;
            margin-left: 0;
            margin-right: auto;
            top: 0;
        }

        .map-container {
            position: relative;
        }


        @media (max-width: 768px) {
            .hero-content-wrapper {
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 30px !important;
            }

            .hero-title {
                font-size: 26px;
            }

            .hero-tip {
                font-size: 15px;
            }

            .hero-cta {
                font-size: 15px;
                padding: 12px 24px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .home-hero-content {
                width: 95%;
            }

        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 22px;
            }

            .hero-tip {
                font-size: 14px;
            }

            .hero-cta {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>

    <style>
        .stats-section {
            background: #f5f7fc61;
            padding: 50px 20px;
            text-align: center;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .stat-box {
            background: #fff;
            border-radius: 16px;
            padding: 20px 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-box::before {
            content: "";
            position: absolute;
            width: 120%;
            height: 0%;
            background: var(--primary-color);
            top: 0;
            left: -10%;
            transition: height 0.4s ease;
            z-index: 0;
            border-radius: 0 0 50% 50%;
            opacity: 0.1;
        }

        .stat-box:hover::before {
            height: 100%;
        }

        .icon-box {
            background: #18336c;
            color: #fff;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            font-size: 28px;
            transition: background 0.4s, transform 0.4s;
            position: relative;
            z-index: 1;
        }

        .stat-box:hover .icon-box {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        .stat-number-box {
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 5px;
            position: relative;
            z-index: 1;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 700;
            color: #1c2c59;
        }

        .plus {
            font-size: 2rem;
            font-weight: 700;
            color: #1c2c59;
        }

        .stat-box p {
            color: #333;
            font-size: 1rem;
            margin-top: 10px;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 600px) {
            .stat-number {
                font-size: 2.2rem;
            }

            .plus {
                font-size: 1.5rem;
            }

            .icon-box {
                width: 55px;
                height: 55px;
                font-size: 24px;
            }
        }
    </style>

    <style>
        .support-grid-1 {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr;
            /* Mobile default */
        }

        /* Tablet: 2 columns */
        @media (min-width: 768px) {
            .support-grid-1 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Laptop & above: 3 columns */
        @media (min-width: 992px) {
            .support-grid-1 {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>

    <style>
        .herov1-btn {
            background-color: rgb(252, 145, 24);
            color: white;
            display: block;
            margin: 1rem auto 2.5rem;
            width: fit-content;
            font-weight: 500;
            box-shadow: rgba(252, 145, 24, 0.4) 0px 3px 10px;
            padding: 8px 16px;
            border-radius: 11px;
            text-decoration: none;
            overflow: hidden;
            transition: 0.4s;
        }

        .herov1-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: rgba(252, 145, 24, 0.6) 0px 6px 15px;
            background-position: right center;
        }
    </style>

    <style>
        /* Section Wrapper */
        .process-flow-section {
            padding: 40px 20px;
            text-align: center;
        }

        /* Container */
        .process-flow-container {
            max-width: 1200px;
            margin: auto;
        }

        /* Images */
        .process-img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Default: show desktop image */
        .desktop-process-img {
            display: block;
        }

        .mobile-process-img {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .process-flow-section {
                padding: 20px;
            }

            /* Show mobile image */
            .desktop-process-img {
                display: none;
            }

            .mobile-process-img {
                display: block;
            }
        }
    </style>

    <!-- Long content section  -->
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
            font-size: 1.65rem;
            margin-top: 25px;
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
                max-height: none;
                overflow: visible;
            }
        }

        .read-btn-row {
            display: block !important;
        }
    </style>

    <!-- Hero section  -->
    <section id="bookingSection" class="hero-main">
        <div class="swiper-wrapper">
            <!-- Single Slide -->
            <div class="swiper-slide">
                <div class="hero-content-wrapper">
                    <div class="home-hero-content">

                        <h1 class="hero-title">{{ $data['hero']['title'] ?? '' }}</h1>
                        <p>{{ $data['hero']['subtitle'] ?? '' }}</p>

                        <div style="margin-bottom: 30px; text-align: left;">
                            <h3 style="color: #FC9118; font-weight: 600; margin-bottom: 14px;">
                                Google Reviews
                            </h3>

                            <div>

                                <div style="display: flex; align-items: center; gap: 18px; margin: 12px 0;">

                                    <!-- Google Logo -->
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <img src="https://www.google.com/favicon.ico" alt="Google" style="height: 26px;">
                                        <span style="font-size: 20px; font-weight: 700; color:#111;">4.9</span>
                                        <span style="color: #555; font-size: 15px;">/ 5</span>
                                    </div>

                                    <!-- Pipe Divider -->
                                    <span style="color:#ccc;">|</span>

                                    <!-- Stars -->
                                    <div style="display: flex; gap: 4px;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                        </svg>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                        </svg>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                        </svg>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                        </svg>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                        </svg>
                                    </div>

                                </div>


                                <p style="font-size: 14px; color: #444; line-height: 1.5; margin-bottom: 14px;">
                                    Trusted by 150+ students on Google for expert guidance and smooth study-abroad processing.
                                </p>


                            </div>
                        </div>

                    </div>

                    <div class="hero-form">
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="stats" class="stats-section">
        <div class="stats-container">
            <div class="stat-box" data-target="7500">
                <div class="icon-box">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="stat-number-box">
                    <span class="stat-number">0</span><span class="plus">+</span>
                </div>
                <p>Happy & Satisfied Students</p>
            </div>

            <div class="stat-box" data-target="850">
                <div class="icon-box">
                    <i class="fa-solid fa-university"></i>
                </div>
                <div class="stat-number-box">
                    <span class="stat-number">0</span><span class="plus">+</span>
                </div>
                <p>Top-Ranked Universities</p>
            </div>

            <div class="stat-box" data-target="400">
                <div class="icon-box">
                    <i class="fa-solid fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-number-box">
                    <span class="stat-number">0</span><span class="plus">+</span>
                </div>
                <p>Experienced Education Consultants</p>
            </div>

            <div class="stat-box" data-target="12">
                <div class="icon-box">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="stat-number-box">
                    <span class="stat-number">0</span><span class="plus">+</span>
                </div>
                <p>Years of Proven Expertise</p>
            </div>
        </div>
    </section>





    <!-- New Journey  -->
    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">{{ $data['introduction']['title'] ?? '' }}</h2>
            <!-- <p>{{ $data['introduction']['subtitle'] ?? '' }}</p> -->
             <p>{!! $data['introduction']['subtitle'] ?? '' !!}</p>
        </div>


    </section>

    

    <!-- Our Services  -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">What We Offer as Your UK Education Consultants in {{$cityName}}</h2>
        </div>

        <div class="sample-container">
            <div class="sample-card">
                <h3>1. Career Counselling</h3>
                <p>We help students identify the right course and destination based on academic background, interests,
                    long-term goals and global job opportunities.</p>
            </div>

            <div class="sample-card">
                <h3>2. Loan & Visa Assistance</h3>
                <p>Our experts guide students through complete visa documentation, financial planning and education loan
                    support for a smooth approval process.</p>
            </div>

            <div class="sample-card">
                <h3>3. Statement of Purpose & Scholarships</h3>
                <p>We assist in drafting personalised SOPs, LORs and scholarship applications that strengthen your
                    university profile and funding chances.</p>
            </div>

            <div class="sample-card">
                <h3>4. Accommodation & Pre-Departure Assistance</h3>
                <p>From securing safe housing to providing travel guidance, packing lists and arrival tips, we prepare you
                    for a smooth relocation.</p>
            </div>

            <div class="sample-card">
                <h3>5. Test Preparation</h3>
                <p>Training support for IELTS, PTE, TOEFL, GRE, GMAT and SAT to help students achieve required scores for
                    top universities.</p>
            </div>

            <div class="sample-card">
                <h3>6. Course & University Selection</h3>
                <p>We shortlist courses and universities based on your academic scores, career goals, budget and visa
                    success probability.</p>
            </div>
        </div>

    </section>

    <!-- Top UK Universities Section -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">
                Top UK Universities for Indian Students Guided by Expert Consultants
            </h2>

            <p class="section-subtext">
                Choosing the right university is key to a successful UK education journey. At WTS, our expert UK study abroad consultants in {{ $cityName }} guide students toward top-ranked and globally recognised UK institutions. Below are some of the most preferred universities chosen by students from {{ $cityName }}.
            </p>
        </div>

        <div class="universities-grid">
            @php
                $universities = [
                    'University of Oxford',
                    'University of Cambridge',
                    'Imperial College London',
                    'London School of Economics (LSE)',
                    'University College London (UCL)',
                    'University of Manchester',
                    'University of Edinburgh',
                    'King’s College London',
                    'University of Warwick',
                    'University of Bristol',
                    'University of Glasgow',
                    'University of Birmingham'
                ];
            @endphp

            @foreach($universities as $university)
                <div class="university-card">
                    <i class="fa-solid fa-building-columns"></i>
                    <span>{{ $university }}</span>
                </div>
            @endforeach
        </div>

        <style>            

            .section-subtext {
                margin-bottom: 2rem;
                text-align: start;
            }

            .universities-grid {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .university-card {
                background: #fff;
                border-radius: 14px;
                padding: 18px 16px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.08);
                display: flex;
                align-items: center;
                gap: 12px;
                justify-content: center;
                font-weight: 500;
                color: #1c2c59;
                transition: all 0.35s ease;
            }

            .university-card i {
                color: var(--primary-color);
                font-size: 20px;
            }

            .university-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            }
        </style>
    </section>


    <!-- Why Students in city Choose WTS   -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">Why WTS is a Leading UK Education Consultant in {{ $cityName }}</h2>
        </div>

        <div class="sample-container">
            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-user-check"></i></div>
                <h3>Personalized Attention</h3>
                <p>We treat you as an individual, understanding your goals to build the right pathway for your success
                    abroad.</p>
            </div>

            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <h3>End-to-End Guidance</h3>
                <p>From course selection to post-arrival services, we’re with you at every stage of your journey.</p>
            </div>

            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                <h3>Transparent & Ethical</h3>
                <p>No hidden fees, no false promises -just honest and reliable guidance.</p>
            </div>

            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-thumbs-up"></i></div>
                <h3>Rejection to Approval</h3>
                <p>Our team specializes in turning weak or rejected applications into success stories.</p>
            </div>

            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-globe"></i></div>
                <h3>Global Network</h3>
                <p>We connect you to top institutions worldwide while providing personalized local support in India.</p>
            </div>

            <div class="sample-card">
                <div class="sample-card-icon"><i class="fa-solid fa-trophy"></i></div>
                <h3>Success-Oriented Approach</h3>
                <p>Our goal isn’t just visa approval -it’s helping you achieve long-term global success.</p>
            </div>
        </div>
    </section>

    <!-- Popular Study Abroad Courses -->
    <section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Popular UK Courses Chosen by Indian Students
            </h2>

            <p style="padding-bottom: 1rem;">Selecting the right course is the initial step in developing a successful international career. Here are the top fields students from India choose, along with popular specializations.</p>

            <div class="support-grid-1">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> MBA</h3>
                    <ul class="support-text">
                        <li>Finance</li>
                        <li>Marketing</li>
                        <li>International Trade</li>
                        <li>HR</li>
                        <li>Business Analytics</li>
                    </ul>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span>Engineering</h3>
                    <ul class="support-text">
                        <li>Mechanical</li>
                        <li>Electrical</li>
                        <li>Civil</li>
                        <li>Aerospace</li>
                        <li>Biomedical</li>
                    </ul>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span>Computer Science & IT</h3>
                    <ul class="support-text">
                        <li>Artificial Intelligence</li>
                        <li>Cloud Computing</li>
                        <li>Data Science</li>
                        <li>Cyber Security</li>
                        <li>Software Engineering</li>
                    </ul>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Health & Life Sciences</h3>
                    <ul class="support-text">
                        <li>Nursing</li>
                        <li>Pharmacy</li>
                        <li>Biotechnology</li>
                        <li>Public Health</li>
                    </ul>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span>Hospitality & Tourism</h3>
                    <ul class="support-text">
                        <li>Hotel Management</li>
                        <li>Travel Operations</li>
                        <li>Event Management</li>
                    </ul>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span>Arts & Humanities</h3>
                    <ul class="support-text">
                        <li>Psychology</li>
                        <li>Sociology</li>
                        <li>Media & Communication</li>
                    </ul>
                </div>
            </div>
        </div>

    </section>

    <!-- Step-by-Step Process Section -->
    <section class="process-flow-section">
        <div class="heading-wrapper">
            <h2 class="new-section-title">Simple Step-by-Step Process to Study Abroad</h2>
        </div>
        <div class="process-flow-container">

            <!-- Desktop Image -->
            <img src="/images/city/process-desktop.png" alt="Study Abroad Step-by-Step Process"
                class="process-img desktop-process-img">

            <!-- Mobile Image -->
            <img src="/images/city/process-mobile.png" alt="Study Abroad Step-by-Step Process Mobile"
                class="process-img mobile-process-img">

        </div>
    </section>

    <!-- Client Testimonials  -->
    <section class="video-gallery-section">
        <div class="container">
            <h2 class="new-section-title">What Students Say About Us</h2>

            <!-- Swiper -->
            <div class="swiper video-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $index => $video)
                        @php
                            $videoId = Str::afterLast($video->url, '/');
                            $loadingAttr = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
                        @endphp
                        <div class="swiper-slide">
                            <div class="video-card">
                                <div class="video-wrapper">
                                    <div class="youtube-facade" data-video-id="{{ $videoId }}"
                                        data-image="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                        onclick="loadYoutube(this)">
                                        <img src="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                            {!! $loadingAttr !!} alt="{{ $video->title }}">

                                        <!-- Play Button -->
                                        <button class="video-play-btn" aria-label="Play testimonial video"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Custom Navigation -->
                <button class="custom-swiper-prev"><img src="/new-home-images/svg-icons/right-arrow.svg"
                        style="transform: rotate(180deg); height: 20px;" alt="left-arrow"></button>
                <button class="custom-swiper-next"><img src="/new-home-images/svg-icons/right-arrow.svg"
                        style="height: 20px;" alt="right-arrow"></button>
            </div>
        </div>
    </section>

    <!-- Read more section  -->
    <section class="ielts-long">
    <div class="container">

        <div class="long-box">

            <h2>UK Education Consultants in {{ $cityName }}</h2>

            <p>Looking for trusted UK education consultants in {{$cityName}} to help you start your study abroad journey? WTS Study Abroad Consultant is a leading name among UK education consultants in {{$cityName}}, providing expert guidance for university admissions, visa processing, and career planning in the United Kingdom.</p>

            <p>At WTS, we understand that studying abroad is a life-changing decision. Our experienced counselors offer personalised support to help students select the right university, course, and career path. As reliable study abroad consultants for UK in {{$cityName}}, we guide you at every step  from course selection to visa approval.</p>

            <p>Whether you need admission assistance or visa support, our team of professional UK education consultants in {{$cityName}} ensures a smooth and successful application process.</p>

            <div class="read-btn-row">
                <button class="read-toggle" id="readMore">Read More</button>
            </div>

            <div class="more-content" id="moreContent">

                <h2>Why Choose WTS UK Education Consultant in {{ $cityName }}?</h2>

                <p>
                    Choosing the right UK education consultants in {{ $cityName }} can make a significant difference in your study abroad success. WTS Study Abroad Consultant has helped hundreds of students secure admissions in top universities across the UK.
                </p>

                <p>Here’s why students trust WTS as their preferred study in UK consultants in {{ $cityName }}:</p>

                <ul>
                    <li>Experienced and certified counselors</li>
                    <li>High UK student visa success rate</li>
                    <li>Personalised university and course guidance</li>
                    <li>End-to-end admission and visa assistance</li>
                    <li>Strong partnerships with UK universities</li>
                    <li>Transparent and ethical consultancy services</li>
                    <li>Fast response and dedicated support</li>
                </ul>

                <p>As professional study abroad consultants for UK in {{ $cityName }}, our mission is to simplify the entire study abroad process and help students achieve their academic and career goals.</p>

                <h2>Services Offered by Our UK Education Consultants in {{ $cityName }}</h2>

                <p>At WTS Study Abroad Consultant, we provide complete support to students planning to study in the United Kingdom. Our experienced UK education consultants in {{ $cityName }} ensure that every stage of your application is handled professionally.</p>

                <h3>University & Course Selection</h3>
                <p>
                    Choosing the right course is the most important step. Our expert study in UK consultants in {{ $cityName }} analyse your academic background, interests, and career goals 
                    to recommend suitable universities and programs.
                </p>

                <p>We help students select:</p>
                <ul>
                    <li>Undergraduate courses</li>
                    <li>Postgraduate programs</li>
                    <li>MBA and management courses</li>
                    <li>Engineering and technology programs</li>
                    <li>Healthcare and nursing courses</li>
                    <li>Business and finance programs</li>
                </ul>

                <h3>Application & Admission Assistance</h3>
                <p>
                    Our team of UK education consultants in {{ $cityName }} helps students prepare strong applications that increase their chances of admission.
                </p>

                <p>We assist with:</p>
                <ul>
                    <li>University applications</li>
                    <li><a href="https://www.wtsvisa.com/services/sop-assistance">Statement of Purpose (SOP)</a></li>
                    <li><a href="https://www.wtsvisa.com/letter-of-recommendation">Letter of Recommendation (LOR)</a></li>
                    <li>Resume preparation</li>
                    <li>Document verification</li>
                    <li>Admission tracking</li>
                </ul>
                <p>As experienced study abroad consultants for UK in {{ $cityName }}, we ensure your application is submitted accurately and on time.</p>

                <h3>UK Student Visa Assistance</h3>
                <p>
                    Getting a student visa is one of the most critical steps in studying abroad. Our professional UK students visa consultant in {{ $cityName }} provides expert guidance to help students successfully obtain their UK student visa.
                </p>

                <p>We provide:</p>
                <ul>
                    <li>Visa documentation guidance</li>
                    <li>Financial documentation support</li>
                    <li>Visa application form assistance</li>
                    <li>Mock interview preparation</li>
                    <li>Visa submission support</li>
                </ul>
                <p>With our experienced UK students visa consultant in {{ $cityName }}, students receive reliable support throughout the visa process.</p>

                <h2>Top Universities in the UK We Help Students Apply To</h2>
                <p>As trusted UK education consultants in {{ $cityName }}, WTS Study Abroad Consultant works with leading universities across the United Kingdom. We help students secure admissions in institutions known for academic excellence and global recognition.</p>

                <p>Some popular universities include:</p>
                <ul>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-birmingham">University of Birmingham</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-manchester">University of Manchester</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-leeds">University of Leeds</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-glasgow">University of Glasgow</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-nottingham">University of Nottingham</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-liverpool">University of Liverpool</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/coventry-university">Coventry University</a></li>
                    <li><a href="https://www.wtsvisa.com/universities/uk/university-of-greenwich">University of Greenwich</a></li>
                </ul>
                <p>Our experienced study in UK consultants in {{ $cityName }} help students choose universities that match their academic profile and career aspirations.</p>

                <h2>Popular Courses to Study in the UK</h2>
                <p>The United Kingdom offers a wide range of career-oriented programs for international students. Our knowledgeable UK education consultants in {{ $cityName }} guide students in selecting high-demand courses with excellent career prospects.</p>

                <p>Popular courses include:</p>
                <ul>
                    <li><a href="https://www.wtsvisa.com/study/mba-in-uk">MBA in the UK</a></li>
                    <li>MSc Data Science</li>
                    <li>MSc Business Analytics</li>
                    <li>Computer Science</li>
                    <li>Nursing and Healthcare</li>
                    <li><a href="https://www.wtsvisa.com/study/btech-in-uk">Engineering</a></li>
                    <li><a href="https://www.wtsvisa.com/study/accounting-in-uk">Finance and Accounting</a></li>
                    <li>Artificial Intelligence</li>
                    <li><a href="https://www.wtsvisa.com/study/cyber-security-in-uk">Cybersecurity</a></li>
                    <li>Project Management</li>
                </ul>
                <p>As reliable study abroad consultants for UK in {{ $cityName }}, we help students choose programs aligned with industry demand and future job opportunities.</p>

                <h2>UK Student Visa Process with Our UK Students Visa Consultant in {{ $cityName }}</h2>
                <p>Applying for a student visa can be complicated, but our experienced UK students visa consultant in {{ $cityName }} simplifies the process and increases your chances of approval.</p>

                <p>Here are the steps involved:</p>
                <ol>
                    <li>Step 1: Receive admission offer from a UK university</li>
                    <li>Step 2: Prepare financial documents</li>
                    <li>Step 3: Complete visa application form</li>
                    <li>Step 4: Pay visa fees and healthcare surcharge</li>
                    <li>Step 5: Submit biometric information</li>
                    <li>Step 6: Attend visa interview (if required)</li>
                    <li>Step 7: Receive visa decision</li>
                </ol>
                <p>Our dedicated UK students visa consultant in {{ $cityName }} ensures that every document is accurate and submitted on time.</p>

                <h2>Eligibility Requirements to Study in the UK</h2>
                <p>Students planning to study in the UK must meet certain academic and language requirements. Our professional UK education consultants in {{ $cityName }} help students understand eligibility criteria and prepare accordingly.</p>

                <p>Basic requirements include:</p>
                <ul>
                    <li>Valid passport</li>
                    <li>Academic transcripts</li>
                    <li>English language test score (<a href="https://www.wtsvisa.com/ielts-coaching">IELTS</a> / <a href="https://www.wtsvisa.com/pte-coaching">PTE</a>)</li>
                    <li>Financial proof</li>
                    <li>Statement of Purpose</li>
                    <li>Offer letter from a UK university</li>
                </ul>
                <p>As experienced study in UK consultants in {{ $cityName }}, we provide clear guidance to help students meet all eligibility requirements.</p>

                <h2>Intake Periods for UK Universities</h2>
                <p>Understanding university intake timelines is essential for successful admission. Our expert UK education consultants in {{ $cityName }} help students apply at the right time.</p>

                <p>Major intakes in the UK:</p>
                <ul>
                    <li>September Intake</li>
                    <li>January Intake</li>
                    <li>May Intake</li>
                </ul>
                <p>Our team of study abroad consultants for UK in {{ $cityName }} ensures students meet deadlines and avoid delays.</p>

                <h2>Cost of Studying in the UK</h2>
                <p>The cost of studying in the UK varies depending on the university and course. Our experienced UK education consultants in {{ $cityName }} provide transparent information about tuition fees and living expenses.</p>

                <p>Estimated annual costs:</p>
                <ul>
                    <li><strong>Tuition Fees:</strong> ₹12,00,000 - ₹28,00,000</li>
                    <li><strong>Living Expenses:</strong> ₹8,00,000 - ₹12,00,000</li>
                </ul>
                <p>Our trusted study in UK consultants in {{ $cityName }} also help students explore scholarships and financial aid options.</p>

                <h2>Scholarships for Indian Students in the UK</h2>
                <p>Many universities offer <a href="https://www.wtsvisa.com/blog/study-abroad-scholarship-guide-eligibility-types-how-to-apply">scholarships to international students</a>. As professional study abroad consultants for UK in {{ $cityName }}, we help students identify and apply for suitable scholarships.</p>

                <p>Popular scholarships include:</p>
                <ul>
                    <li>Chevening Scholarship</li>
                    <li>Commonwealth Scholarship</li>
                    <li>GREAT Scholarship</li>
                    <li>University Merit Scholarships</li>
                </ul>
                <p>Our experienced UK education consultants in {{ $cityName }} guide students throughout the scholarship application process.</p>

                <h2>Start Your Study Abroad Journey with WTS Study Abroad Consultant</h2>

                <p>
                    If you are planning to study in the United Kingdom, choosing the right UK education consultants in {{ $cityName }} 
                    is the first step toward success. WTS Study Abroad Consultant offers expert guidance, reliable visa support, 
                    and personalised counselling to help students achieve their academic goals.
                </p>

                <p>Our experienced team of study in UK consultants in {{ $cityName }} is committed to providing high-quality services and ensuring a smooth admission and visa process. 
                </p>
                <p>Contact WTS today and take the first step toward studying in the UK with confidence.</p>

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

    <!-- FAQ Section -->
    <section class="new-faq-section">
        <div class="new-faq-container">
            <div class="new-faq-left">
                <h3 class="new-section-title">FAQ About UK Education Consultants in {{$cityName}}</h3>
                <p class="new-faq-text">
                    Have a question? Our experts are here to guide you - just reach out.
                </p>
                <div class="new-faq-graphic">
                    <img src="/new-home-images/faq-image2.jpeg"
                        style="border-top-right-radius: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%;"
                        alt="FAQ Graphic" />
                </div>
            </div>

            <div class="new-faq-right">
                <div class="new-faq-accordion">
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Why Choose WTS as Your UK Education Consultants in {{ $cityName }}?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            With years of experience, WTS provides personalised counselling, top university guidance, and expert visa support. As leading UK Education Consultants in {{ $cityName }}, we help students achieve their dream of studying in the UK with confidence.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Do I need to show financial proof for the UK study visa?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Yes, you must show proof of funds to cover tuition fees and living expenses for the duration of your course as per UKVI requirements.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Can your consultancy help with the CAS (Confirmation of Acceptance for Studies)?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Yes, we guide students through every step of the CAS process, including document verification, compliance checks, and timely submission.
                        </div>
                    </div>
                    
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            What are the chances of getting a UK study visa with your consultancy support?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            With proper documentation and eligibility, students have high success rates. Our consultants help ensure accuracy, compliance, and strong application preparation.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Do you also provide support after the visa approval?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Yes, our team offers pre-departure guidance, travel support, accommodation assistance, and essential information for settling in the UK.
                        </div>
                    </div>
                                    
                </div>
            </div>
        </div>
    </section>

    


    <script>
        // Select all FAQ buttons
        const faqButtons = document.querySelectorAll(".new-faq-btn");

        faqButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                const content = btn.nextElementSibling;

                // Close all other open FAQs
                document.querySelectorAll(".new-faq-content").forEach((item) => {
                    if (item !== content) {
                        item.style.maxHeight = null;
                        item.parentElement.classList.remove("active");
                    }
                });

                // Toggle current one
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    btn.parentElement.classList.remove("active");
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    btn.parentElement.classList.add("active");
                }
            });
        });
    </script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    
    <script>
        const statBoxes = document.querySelectorAll(".stat-box");
        const speed = 120;

        const animateCounter = (counter, target) => {
            let count = 0;
            const increment = target / speed;

            const update = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = Math.ceil(count);
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target;
                }
            };

            update();
        };

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const box = entry.target;
                    const target = +box.dataset.target;
                    const counter = box.querySelector(".stat-number");

                    animateCounter(counter, target);
                    observer.unobserve(box);
                }
            });
        }, { threshold: 0.4 });

        statBoxes.forEach(box => observer.observe(box));
    </script>

@endsection