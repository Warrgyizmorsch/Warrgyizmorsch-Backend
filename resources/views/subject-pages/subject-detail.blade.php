@extends('layouts.app')

@section('content')

    <style>
        * {
        	/* text-align: justify; */
        }
        
        ul {
        	padding-left: 1rem;
        }
        
        h1, h2, h3, h4, h5, h6, p {
            text-align: start;
            
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500;
            margin: 0.5rem 0;
        }
        
        .stat-box p {
            text-align: center;
        }
        
        .home-hero-content .hero-title {
            font-size: 3rem;
        }

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
        /* .hero-main {
            background-color: #F7F4EF !important;
            padding: 20px 0 !important;
        } */
        .hero-main {
            position: relative;
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
                gap: 20px !important;
            }

            .hero-title {
                font-size: 2.5rem;
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
                font-size: 2rem;
            }

            .hero-tip {
                font-size: 14px;
            }

            .hero-cta {
                font-size: 14px;
                padding: 10px 20px;
            }
        }

        /* Blur overlay */
        .hero-bg-blur {
            position: absolute;
            inset: 0;
            backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px);
            background: rgba(0, 0, 0, 0.25); /* improves text contrast */
            z-index: 1;
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
    <style>
        p {
            margin-bottom: 0px !important;
        }
        /* Default styling for all dynamic tables */
        table {
            display: block;
            width: auto;
            border: none !important;
            border-collapse: collapse;
            margin: 1em 0;
            text-align: left;
            border: 1px solid #444;
            font-family: inherit;
        }

        /* Table header and cells */
        table th,
        table td {
            border: 1px solid #444;
            padding: 8px 12px;
        }

        /* Optional: bold table headers if not already bold */
        table th {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
        }

        .new-journey-wrapper {
            line-height: 1.5rem;
            margin: 0 auto;
            padding: 60px 35px;
            background-color: aliceblue;
        }
        @media (max-width: 768px) {
            .new-journey-header table {
                width: 100% !important;
                overflow-x: auto;
            }
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.6rem;
            }
        }
    </style>
    <!-- Hero section  -->
    @php
        $image = $data['SubjectPage']['images'] ?? null;
        $isValidImage = !empty($image) && !str_contains($image, 'blank.jpeg');
    @endphp
    <section id="bookingSection" class="hero-main"
        style="
            padding: 20px 0;

            @if($isValidImage)
                background-image: url('{{ asset($image) }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            @else
                background-color: #F7F4EF !important;;
            @endif
        "
        >
        @if($isValidImage)
            <div class="hero-bg-blur"></div>
        @endif
        <div class="swiper-wrapper">
            <!-- Single Slide -->
            <div class="swiper-slide">
                <div class="hero-content-wrapper">
                    <div class="home-hero-content">

                        <h1 class="hero-title"
                            style="
                                @if($isValidImage)
                                    color: #fff !important;;
                                @endif
                            "
                        >
                            {{ $data['SubjectPage']['title'] ?? '' }}
                        </h1>

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
            {!! $data['SubjectPage']['content'] ?? '' !!}
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
            <h2 class="new-section-title">Testimonials</h2>

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
                <button class="custom-swiper-prev"><img src="/new-home-images/svg-icons/right-arrow.svg" style="transform: rotate(180deg); height: 20px;" alt="left-arrow"></button>
                <button class="custom-swiper-next"><img src="/new-home-images/svg-icons/right-arrow.svg" style="height: 20px;" alt="right-arrow"></button>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @php
        $faqs = [];

        if (!empty($data['SubjectPage']->faq)) {
            $faqs = is_string($data['SubjectPage']->faq)
                ? json_decode($data['SubjectPage']->faq, true)
                : $data['SubjectPage']->faq;
        }
    @endphp

    @if(!empty($faqs))
    <section class="new-faq-section">
        <div class="new-faq-container">
            <div class="new-faq-left">
                <h3 class="new-section-title">FAQ</h3>
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

                    @foreach($faqs as $faq)
                        <div class="new-faq-item">
                            <button class="new-faq-btn">
                                {{ $faq['question'] ?? '' }}
                                <p>
                                    <span>
                                        <img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon">
                                    </span>
                                </p>
                            </button>

                            <div class="new-faq-content">
                                {!! $faq['answer'] ?? '' !!}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    @endif


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