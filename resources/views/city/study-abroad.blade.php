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

    <!-- Hero section  -->
    <section id="bookingSection" class="hero-main">
        <div class="swiper-wrapper">
            <!-- Single Slide -->
            <div class="swiper-slide">
                <div class="hero-content-wrapper">
                    <div class="home-hero-content">

                        <h1 class="hero-title">{{ $data['hero']['title'] ?? '' }}</h1>
                        <p>WTS is leading Study Abroad Consultants in {{ $cityName }}, offering complete guidance for course and university selection, applications, scholarships, visa success and the smoothest transition to studying abroad.</p>

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

    <!-- Top Countries Section  -->
    <script>
        window.countryData = @json($countries);
    </script>
    <section class="new-countries-section">
        <div class="container">
            <h2 class="new-section-title">Top Countries for Higher Education</h2>

            <div class="new-countries-container">
                {{-- Left: main display (first country by default) --}}
                @php $firstKey = array_key_first($countries); @endphp
                <div class="new-country-main">
                    <img id="countryImage" src="{{ asset($countries[$firstKey]['image']) }}"
                        alt="{{ $countries[$firstKey]['name'] }}" class="new-main-img">

                    <div class="new-country-features">
                        <ul id="countryFeatures">
                            @foreach($countries[$firstKey]['features'] as $f)
                                <li style="display: flex; align-items: center; gap: 8px;"><img
                                        src="/new-home-images/svg-icons/check-circle.svg" alt="check-circle"
                                        style="height: 20px;"> {{ $f }}</li>
                            @endforeach
                        </ul>
                        <a id="exploreBtn" href="{{ $countries[$firstKey]['route'] }}" style="text-decoration: none;">
                            <button class="explore-btn">Explore More <img
                                    src="/new-home-images/svg-icons/majesticons_arrow-up.svg"
                                    style="height: 32px; margin-left: -6px;" alt=""></button>
                        </a>
                    </div>
                </div>

                {{-- Right: clickable country list --}}
                <div class="new-country-list-wrapper">
                    <div class="new-country-list" id="countryList">
                        @foreach($countries as $key => $c)
                            <div class="new-country-card {{ $loop->first ? 'active' : '' }}" data-country="{{ $key }}">
                                <img src="{{ asset($c['thumb']) }}" alt="{{ $c['name'] }}">
                                <div>
                                    <h3>{{ $c['name'] }}</h3>
                                    <p>{{ $c['features'][0] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="scroll-dots" id="scrollDots"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services  -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">What We Offer as Your Overseas Education Consultant in {{$cityName}}</h2>
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

    <!-- Popular Study Abroad Courses -->
    <section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Popular Study Abroad Courses for a Successful Global Career
            </h2>

            <p style="padding-bottom: 1rem;">Choosing the right course is the first step toward building a successful global
                career. Here are the top
                fields students from {{ $cityName }} choose, along with trending specialisations.</p>

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


    <!-- Why Students in city Choose WTS   -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">What Sets WTS Apart as Abroad Education Consultants in {{ $cityName }}</h2>
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

    <!-- Our Affiliates -->
    <section class="affiliates-section">
        <div class="container">
            <h2 class="new-section-title">Top Universities Our Students Get Admission To</h2>

            <div class="affiliate-marquee">
                <!-- 1st row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2nd row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3rd row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4th row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- FAQ Section -->
    <section class="new-faq-section">
        <div class="new-faq-container">
            <div class="new-faq-left">
                <h3 class="new-section-title">FAQ About Study Abroad Consultants in {{$cityName}}</h3>
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
                            Why should I choose WTS as my study abroad consultants in {{ $cityName }}?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            We provide personalised counselling, university selection, loan guidance, SOP support and visa
                            assistance with a 99% success rate, making us one of the most trusted Study Abroad Consultants
                            in {{ $cityName }}.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            How do overseas education consultants in {{ $cityName }} help with admissions?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            We guide you with university applications, documentation, course selection, scholarship support
                            and visa procedures to ensure a smooth admission journey.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Do you assist with scholarships?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Yes, our team helps you identify suitable scholarships, prepare documents and increase your
                            chances of securing financial support.
                        </div>
                    </div>
                    
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            How long does the application process take?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            It depends on the country and university, but our consultants ensure faster processing with
                            timely updates at every stage.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Do foreign education consultants in {{ $cityName }} help with student visas?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Absolutely. We guide you with complete visa documentation, mock interviews, financial
                            requirements and timely submissions.
                        </div>
                    </div>
                    
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Do you help with education loans?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            We work closely with banks and financial institutions to support students with loan approvals
                            and required documentation.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            What are the charges for study abroad consulting in {{ $cityName }}?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Our counselling is free, and we maintain a transparent process with no hidden fees.
                        </div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">
                            Is WTS a reliable abroad education consultants in {{ $cityName }}?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">
                            Yes, with 12+ years of experience and 10,000+ students guided abroad, we are one of the leading
                            Abroad Education Consultants in {{ $cityName }}.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

   <section class="city-section">
    <h2 class="city-title">Find Expert Study Abroad Consultants in Your City</h2>

    <div class="city-list-wrapper">
        <div class="city-list" id="cityList">
            @foreach (collect($otherCities)->sort() as $item)
                <a href="{{ url('/study-abroad-consultants-in-' . $item) }}" class="city-item">
                    {{ ucwords(str_replace('-', ' ', $item)) }}
                </a>
            @endforeach
        </div>

        <button class="city-toggle-btn" id="cityToggleBtn" onclick="toggleCities()">
            Read More
        </button>
    </div>

    <style>
        .city-section {
            padding: 20px;
        }

        .city-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .city-list-wrapper {
            position: relative;
        }

        .city-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .city-item {
            padding: 5px 8px;
            background: #fff;
            border-radius: 2rem;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            border: 1px solid #ddd;
            white-space: nowrap;
        }

        .city-item:hover {
            background: #1c2c59;
            color: #fff;
        }

        /* Button right aligned */
       .city-toggle-btn {
    margin: 14px auto 0;
    display: block;
    background: none;
    border: none;
    color: #1c2c59;
    font-weight: 700;
    cursor: pointer;
    font-size: 15px;
    text-align: center;
}

    </style>

    <script>
        const cityList = document.getElementById('cityList');
        const btn = document.getElementById('cityToggleBtn');

        let collapsedHeight = 0;
        let expanded = false;

        window.addEventListener('load', () => {
            const items = Array.from(cityList.children);

            let rows = [];
            items.forEach(item => {
                const top = item.offsetTop;
                if (!rows.includes(top)) rows.push(top);
            });

            // Height till 3rd row end
            if (rows.length >= 3) {
                const thirdRowTop = rows[2];
                const thirdRowItems = items.filter(i => i.offsetTop === thirdRowTop);
                const lastItem = thirdRowItems[thirdRowItems.length - 1];
                collapsedHeight = lastItem.offsetTop + lastItem.offsetHeight;
            } else {
                collapsedHeight = cityList.scrollHeight;
                btn.style.display = 'none';
            }

            cityList.style.maxHeight = collapsedHeight + 'px';
        });

        function toggleCities() {
            expanded = !expanded;

            if (expanded) {
                cityList.style.maxHeight = cityList.scrollHeight + 'px';
                btn.innerText = 'Read Less';
            } else {
                cityList.style.maxHeight = collapsedHeight + 'px';
                btn.innerText = 'Read More';
            }
        }
    </script>
</section>



    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Ready to Begin Your Study Abroad Journey?</h2>
                <p style="color: #000;">Your dream university is just one decision away. Get expert guidance, faster admissions and step-by-step
                    visa support with WTS.</p>
                <p style="color: #000;"><b>Start Your Application Now</b></p>
                <a href="#" class="herov1-btn smooth-scroll-btn" style="margin: 0px; color: #000;">
                    Talk to {{$cityName}}’s Experts
                </a>
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
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