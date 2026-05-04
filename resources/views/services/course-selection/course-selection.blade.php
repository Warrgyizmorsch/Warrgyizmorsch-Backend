@extends('layouts.app')
@section('content')

    <section class="service-hero"
        style="background-image: url('{{ asset('images/services/bg-image.webp') }}'); background-size: cover; background-position: bottom left; background-repeat: no-repeat;">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-weight: 600;">Find the Best Course for Your Study Abroad Journey</h1>

                <p style="margin-top: 10px;">Get expert guidance to choose the right course based on your career goals, budget, and preferred country.
                </p>
                <!-- Features Section -->
                <div class="features">
                    <div class="feature">
                        <i class="fa-solid fa-check-circle"></i>
                        <strong>Right course guidance
                        </strong>
                    </div>
                    <div class="feature">
                        <i class="fa-solid fa-check-circle"></i>
                        <strong>Expert counsellor support
                        </strong>
                    </div>
                    <div class="feature">
                        <i class="fa-solid fa-check-circle"></i>
                        <strong>Personalized course matching
                        </strong>
                    </div>
                    <div class="feature">
                        <i class="fa-solid fa-check-circle"></i>
                        <strong>Free profile assessment</strong>
                    </div>
                </div>

                <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal"
                    style="text-decoration: none;">
                    Get Free Consultation
                </a>

                {{-- <span class=tip>Enjoy free services from A to A – application to accommodation, ensuring a smooth visa process
                    from start to finish</span> --}}
            </div>

            <!-- Hero Image -->
            <div class="hero-form">
                @include('./components/landing-page-registration-study-abroad')
            </div>
        </section>

        {{-- Course Overview Section --}}

        <style>
            /* IELTS OVERVIEW */

            .ielts-overview {
                padding: 30px 0;
            }

            .ielts-overview-title {
                font-size: 32px;
                margin-bottom: 20px;
                font-weight: 700;
            }

            .ielts-overview-text {
                margin: 0 0 10px;
                color: #444;
                line-height: 1.7;
                font-size: 16px;
            }
        </style>

        <!-- 2nd section  -->
        <section class="new-home-service-section">

            <div class="container">

                <h2 class="new-section-title">Why Students Trust WTS for Course Selection</h2>

                <div class="new-service-grid">
                    <div>
                        <p class="ielts-overview-text">
                            Students trust WTS for selecting courses because we provide expert guidance tailored to each student's academic background and career goals. Our experienced counselors support accurate subject selection and recommend the best university course options based on global demand and future opportunities. Through our personalized counselling course approach, students receive clear direction for choosing the right abroad courses in top destinations like the USA, UK, Canada, and Australia.
                        </p>

                        <div class="features">
                            <div class="feature">
                                ⮞
                                <strong>Personalized course recommendations
                                </strong>
                            </div>
                            <div class="feature">
                                ⮞
                                <strong>University and country-specific guidance
                                </strong>
                            </div>
                            <div class="feature">
                                ⮞
                                <strong>Career-focused subject selection support
                                </strong>
                            </div>
                            <div class="feature">
                                ⮞
                                <strong>Assistance until final course confirmation </strong>
                            </div>
                        </div>

                        <p class="ielts-overview-text">Trusted by 7,500+ students for successful study abroad guidance. </p>

                        <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal"
                            style="text-decoration: none;">
                            Speak with Expert
                        </a>
                    </div>
                    <div>
                        <img src="{{ asset('images/services/course-selection.webp') }}" alt="course-selection">
                    </div>
                </div>

            </div>

        </section>

        <!-- Benefits  -->
        <section class="new-home-service-section">
            <div class="container">

                <h2 class="new-section-title">Benefits of Expert Course Selection</h2>

                <div class="equal-width-grid three-grid">

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-user-cog"></i></div>
                        <div class="p-text">
                            <span>Personalised course recommendations</span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="p-text">
                            <span>Career-oriented and future-ready choices</span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-globe"></i></div>
                        <div class="p-text">
                            <span>Country and university-specific guidance</span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="p-text">
                            <span>Reduced risk of wrong course selection</span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="p-text">
                            <span>Higher admission and visa success chances</span>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="p-icon"><i class="fas fa-suitcase-rolling"></i></div>
                        <div class="p-text">
                            <span>Clear understanding of job prospects and post-study work options</span>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <!-- Static Services Section -->
        <section class="new-home-service-section">
            <div class="container">
                <h2 class="new-section-title">
                    Our Course Selection Process
                </h2>

                <div class="new-home-service-grid">

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;1 <br />Profile Analysis
                        </h3>
                        <p>Academic background, skills, and interests are evaluated.</p>
                        <img src="/new-home-images/discussion.webp"
                             class="new-home-service-image"
                             style="bottom:-15px; right:-10px; height:160px; width:160px;"
                             alt="">
                    </div>

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;2 <br />Career Mapping
                        </h3>
                        <p>Future goals and job opportunities are discussed.</p>
                        <img src="/new-home-images/diary.webp"
                             class="new-home-service-image"
                             style="height:100px; width:100px;"
                             alt="">
                    </div>

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;3 <br />Course Shortlisting
                        </h3>
                        <p>Best-fit international courses are <br>shortlisted.</p>
                        <img src="/new-home-images/smooth-transition.webp"
                             class="new-home-service-image"
                             alt="">
                    </div>

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;4 <br />University Matching
                        </h3>
                        <p>Courses are matched with top <br>universities abroad.</p>
                        <img src="/new-home-images/university.webp"
                             class="new-home-service-image"
                             style="height:140px; width:140px; border-bottom-right-radius:20px;"
                             alt="">
                    </div>

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;5 <br />Final Recommendation
                        </h3>
                        <p>Clear and confident course <br>selection is finalised.</p>
                        <img src="/new-home-images/studying.webp"
                             class="new-home-service-image"
                             style="bottom:-28px; right:-18px; height:180px; width:180px;"
                             alt="">
                    </div>

                    <div class="new-home-service-card">
                        <h3 class="new-home-service-card-title">
                            Step&nbsp;6 <br />Admission Strategy Alignment
                        </h3>
                        <p>
                            Course selection is aligned <br>with admission and visa <br>requirements.
                        </p>
                        <img src="/new-home-images/teaching.webp"
                             class="new-home-service-image"
                             style="height:115px; width:115px;  bottom:2px; right:3px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"
                             alt="">
                    </div>

                </div>
            </div>
        </section>

        <!-- Clients Testimonials -->
        <section class="new-home-service-section">
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

        <!-- Why choose  -->
        <section class="new-home-service-section">
            <div class="container">
                <h2 class="new-section-title">Why Choose WTS for Course Selection?</h2>

                <div class="equal-width-grid three-grid">

                    <div class="step_s">
                        <i class="fas fa-user-tie"></i>
                        <h3>Experienced Study Abroad Counsellors</h3>
                    </div>

                    <div class="step_s">
                        <i class="fas fa-bullseye"></i>
                        <h3>Career-Focused Approach</h3>
                    </div>

                    <div class="step_s">
                        <i class="fas fa-globe-americas"></i>
                        <h3>Country-Specific Expertise (UK, USA, Canada, Australia, Europe)</h3>
                    </div>

                    <div class="step_s">
                        <i class="fas fa-hand-holding-heart"></i>
                        <h3>Honest and Personalised Guidance</h3>
                    </div>

                    <div class="step_s">
                        <i class="fas fa-passport"></i>
                        <h3>Complete Admission & Visa Support</h3>
                    </div>

                    <div class="step_s">
                        <i class="fas fa-chart-line"></i>
                        <h3>Strategic Guidance Aligned with Global Job Market Trends</h3>
                    </div>

                </div>
            </div>
        </section>

        <!-- Read more content  -->
        <section class="new-home-service-section">
            <div class="container">

                <div class="long-box">

                    <!-- Visible Content -->
                    <h2>Course Selection Services in India – Everything You Need to Know Before Choosing the Right Program</h2>

                    <p>
                        Choosing the right academic program is one of the most important decisions in a student's life. Whether you are a 12th-pass student planning to study abroad, a graduate exploring postgraduate courses, or a working professional looking to advance your career through international education, proper course selection can shape your future opportunities, earning potential, and career satisfaction. However, with thousands of universities and programs available worldwide, selecting courses without expert guidance can feel confusing and overwhelming.
                    </p>

                    <div class="read-btn-row">
                        <button class="read-toggle" id="readMore">Read More</button>
                    </div>

                    <!-- Hidden Content -->
                    <div class="more-content" id="moreContent" style="display:none;">

                        <p>
                            At WTS, we specialize in helping students make confident decisions through professional course selection support and personalized academic planning. With over a decade of experience in international education, our expert counselors provide accurate guidance for subject selection, university shortlisting, and long-term career planning. Our goal is to ensure that every student chooses the right university course that aligns with their academic strengths, interests, and global job market demand.
                        </p>

                        <p>
                            Through our advanced course finder tools and one-on-one consultation sessions, we simplify the process of identifying the best abroad courses for students across different fields such as Business, Engineering, Healthcare, IT, and Management. Whether you are searching for career-focused programs, exploring course careers, or comparing study options across countries, our structured counselling course process ensures clarity and confidence at every step.
                        </p>

                        <h2>What is Course Selection and Why Does It Matter for Your Future?</h2>
                        <p>
                            Course selection is the process of choosing the right academic program based on your educational background, career goals, financial capacity, and preferred destination country. While it may seem like a simple step, the decision can significantly impact your job prospects, migration opportunities, and long-term career success.
                        </p>

                        <p>
                            Many students focus only on popular degrees without understanding industry demand or future career growth. Poor subject selection or choosing the wrong university course can lead to limited job opportunities, skill mismatches, and financial losses. This is why professional course selection guidance plays a critical role in helping students make informed decisions.
                        </p>

                        <p>
                            At WTS, our expert advisors analyze your academic profile, career aspirations, and personal interests before recommending suitable abroad courses. We also evaluate factors such as employability, salary potential, and industry demand to ensure your chosen program supports your long-term goals. Our structured strategy course planning approach helps students avoid common mistakes and select programs that deliver real career value.
                        </p>

                        <p>
                            Whether you are exploring free university courses, professional certifications, or advanced postgraduate courses, our team ensures that your decision is practical, achievable, and future-focused.
                        </p>

                        <h2>Who Needs Professional Course Selection Services?</h2>
                        <p>
                            Professional course selection services are valuable for all students planning to study abroad, but they are especially important for individuals who are unsure about their academic direction or career path.
                        </p>

                        <p>
                            Students who have recently completed their 12th grade often struggle with selecting courses because they have limited knowledge about career opportunities. Our counselors help them understand different fields, career pathways, and industry demand before finalizing their subject selection.
                        </p>

                        <p>
                            Graduates planning to pursue postgraduate courses abroad also benefit from professional guidance. Choosing the right specialization can improve employability and career growth. For example, selecting a data analytics program instead of a general business degree may lead to higher job opportunities in emerging industries.
                        </p>

                        <p>
                            Working professionals looking to upgrade their skills or change careers also require structured counselling course support. Whether you are planning to pursue an MBA, a technical certification, or a management program, our advisors help you identify the most suitable university course that matches your experience and career goals.
                        </p>

                        <p>
                            Parents who are supporting their children's education often rely on trusted consultants to ensure the right decisions are made. Our transparent course selection process gives families confidence that every step is carefully planned and professionally guided.
                        </p>

                        <h2>How Our Course Finder Helps You Choose the Right Program</h2>
                        <p>
                            Finding the right academic program from thousands of options can be challenging. This is where our advanced course finder system becomes a powerful tool for students and professionals.
                        </p>

                        <p>
                            Our course finder allows students to search and compare abroad courses based on country, qualification level, tuition fees, career opportunities, and university ranking. Instead of spending hours researching online, students receive a clear list of recommended programs that match their profile and career goals.
                        </p>

                        <p>
                            The process begins with a detailed profile assessment where our counselors evaluate your academic records, English language scores, financial capacity, and long-term career plans. Based on this analysis, we provide a shortlist of suitable university course options that offer strong employment outcomes.
                        </p>

                        <p>
                            We also provide insights into emerging industries and high-demand fields such as Artificial Intelligence, Healthcare, Cybersecurity, Business Analytics, and Digital Marketing. These insights help students align their course careers with global job market trends.
                        </p>

                        <p>
                            Our goal is to make course selection simple, strategic, and stress-free while ensuring students choose programs that lead to successful international careers.
                        </p>

                        <h2>Popular Abroad Courses for Indian Students</h2>
                        <p>
                            Every year, thousands of students explore new academic opportunities through international education. Choosing the right abroad courses depends on personal interests, academic performance, and career aspirations.
                        </p>

                        <p>
                            Some of the most popular university course options among Indian students include Business Management, Computer Science, Engineering, Healthcare, Finance, Hospitality Management, and Data Science. These programs offer strong career prospects and global employment opportunities.
                        </p>

                        <p>
                            Students who want to advance their education often choose specialized postgraduate courses such as MBA, Master's in Information Technology, Master's in Public Health, or Master's in Finance. These programs provide advanced knowledge, leadership skills, and better earning potential.
                        </p>

                        <p>
                            In addition to degree programs, many universities also offer short-term certifications and free university courses that help students gain practical skills and industry exposure. These programs are ideal for students who want to build their resumes or explore new career paths before committing to a full-time degree.
                        </p>

                        <p>
                            Our counselors help students compare different programs and identify the most suitable course selection options based on job demand, salary expectations, and long-term career stability.
                        </p>

                        <h2>Common Mistakes Students Make While Selecting Courses</h2>
                        <p>
                            One of the biggest challenges students face during course selection is making decisions without proper research or professional guidance. Many students choose programs based on peer pressure, social trends, or incomplete information.
                        </p>

                        <p>
                            Another common mistake is poor subject selection without understanding future career opportunities. For example, choosing a general degree without a clear specialization can limit job prospects in competitive industries.
                        </p>

                        <p>
                            Students also make the mistake of ignoring employability and focusing only on university reputation. While ranking is important, selecting the right university course that matches your skills and career goals is even more critical.
                        </p>

                        <p>
                            Financial planning is another area where students often struggle. Choosing expensive programs without understanding return on investment can create long-term financial stress. Our structured strategy course planning ensures that students select programs that provide value for money and strong career outcomes.
                        </p>

                        <p>
                            With professional counselling course support, students can avoid these mistakes and make confident, well-informed decisions.
                        </p>

                        <h2>Why Students Trust WTS for Course Selection Services</h2>
                        <p>
                            Students across India trust WTS because we provide reliable, transparent, and career-focused course selection support. Our experienced counselors work closely with students to understand their goals and recommend the best academic pathways.
                        </p>

                        <p>
                            We combine technology-driven tools such as our intelligent course finder with personalized counseling sessions to deliver accurate and practical recommendations. This approach ensures that students choose the right abroad courses that match their academic profile and future ambitions.
                        </p>

                        <p>
                            Our team stays updated with global education trends, university admission requirements, and job market demand to provide students with the most relevant information. Whether you are exploring course careers, comparing universities, or planning your academic future, our experts provide guidance at every step.
                        </p>

                        <p>
                            From initial consultation to final admission confirmation, our comprehensive course selection services ensure that students make the right decisions with confidence and clarity.
                        </p>

                        <div class="read-btn-row" style="margin-top:20px;">
                            <button class="read-toggle" id="readLess">Read Less</button>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- FAQ Section -->
        <section class="new-home-service-section">
            <div class="new-faq-container">
                <div class="new-faq-left">
                    <h3 class="new-section-title">Have a Question?</h3>
                    <p class="new-faq-text">
                        Have a question or need course selection advice?<br>
                        Our experts are here to guide you - just reach out.
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
                            <button class="new-faq-btn">How do I choose the right course to study abroad?
                                <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">Choosing the right course depends on your academic background, career goals, budget, and preferred country. Study abroad counselors analyze your profile, interests, and future opportunities to recommend the most suitable course and university for long-term success.</div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">What factors should I consider when selecting a course abroad? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">You should consider career prospects, course curriculum, university ranking, tuition fees, job opportunities, and visa requirements. Proper course selection ensures better employability and a smoother study abroad journey.</div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">Do I get personalized course selection guidance? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                            <div class="new-faq-content">Yes, most study abroad consultants provide personalized course selection guidance based on your academic performance, English test scores, budget, and career plans. This helps students choose the most relevant program for their goals.</div>
                        </div>
                        <div class="new-faq-item">
                            <button class="new-faq-btn">Can you help me find the best universities for my chosen course? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">Yes, course selection services include identifying top universities that offer your preferred program. Counselors compare universities based on rankings, tuition fees, location, and job opportunities after graduation.</div>
                        </div>

                        <div class="new-faq-item">
                            <button class="new-faq-btn">Is the course selection service free? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                            <div class="new-faq-content">Many study abroad consultancies offer free initial counseling and course selection support. Students can receive guidance on suitable courses and universities without any upfront cost.</div>
                        </div>

                        <div class="new-faq-item">
                            <button class="new-faq-btn">What is a course finder and how does it work? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">A course finder is a tool that helps students search and compare courses based on country, qualification, budget, and career goals. It simplifies the process of shortlisting the best study abroad options quickly.</div>
                        </div>

                        <div class="new-faq-item">
                            <button class="new-faq-btn">Can I change my course after applying to a university? <p><span><img
                                            src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                            </button>
                            <div class="new-faq-content">Yes, in many cases students can change their course before enrollment, depending on university policies and eligibility requirements. It is important to consult your advisor early to avoid delays in admission or visa processing.</div>
                        </div>
                    </div>
                    <div style="display: flex; width: 100%; margin-left: auto; justify-content: end;">
                        <a href="#" class="new-faq-viewall">View All</a>
                    </div>
                </div>
            </div>
        </section>

        @include('./components/cta-button')

        <style>
            /* Section Styling */
            .course-selection {
                background: #f9f9f9;
                padding: 50px 0;
                text-align: left;
            }

            .steps {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 30px;
            }

            .step_s {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                text-align: center;
                transition: transform 0.3s ease;
            }

            .step_s:hover {
                transform: translateY(-5px);
            }

            .step_s i {
                font-size: 40px;
                color: #f47c20;
                margin-bottom: 10px;
            }

            .step_s h3 {
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            .step_s p {
                font-size: 14px;
                color: #555;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .steps {
                    flex-direction: column;
                    align-items: center;
                }
            }
        </style>
        <style>
            /* ===== Section ===== */
            .info-section {
                padding: 70px 0;
                background: #f8f9fb;
            }

            .info-container {
                width: 90%;
                max-width: 1200px;
                margin: auto;
            }

            /* ===== Heading ===== */
            .section-title {
                font-size: 44px;
                font-weight: 700;
                line-height: 1.2;
                color: #1C2C59;
                text-align: center;
                margin-bottom: 65px;
                /* professional gap */
            }

            /* ===== Grid ===== */
            .three-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 26px;
            }

            /* ===== Cards ===== */
            .premium-card {
                background: #ffffff;
                padding: 24px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                gap: 16px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                border-left: 5px solid #FC9118;
                min-height: 115px;
                transition: box-shadow 0.25s ease;
            }

            .premium-card:hover {
                box-shadow: 0 10px 28px rgba(252, 145, 24, 0.25);
            }

            /* ===== Icon ===== */
            .p-icon {
                min-width: 44px;
                height: 44px;
                background: #1C2C59;
                color: #ffffff;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 17px;
                flex-shrink: 0;
            }

            .info-section h2.section-title {
                font-size: 44px !important;
                font-weight: 500 !important;
            }


            /* ===== Text ===== */
            .p-text span {
                font-size: 14px;
                color: #1C2C59;
                font-weight: 600;
                line-height: 1.5;
            }

            /* ===== Responsive ===== */
            @media (max-width: 992px) {
                .three-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 600px) {
                .section-title {
                    font-size: 32px;
                    margin-bottom: 45px;
                }

                .three-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
        <style>
            /* ===== Admissions Section ===== */
            .admissions-section {
                padding: 30px 0;
                background: #f8f9fc;
            }

            .admissions-section .title {
                text-align: center;
                font-size: 34px;
                font-weight: 700;
                margin-bottom: 50px;
                color: #000;
            }

            .admissions-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }

            .admission-card {
                background: #fff;
                padding: 35px 25px;
                border-radius: 16px;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .admission-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
            }

            .admission-card i {
                font-size: 38px;
                color: var(--primary-color);
                margin-bottom: 16px;
            }

            .admission-card h3 {
                font-size: 16px;
                font-weight: 600;
                line-height: 1.4;
                color: #222;
                margin: 0;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .admissions-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .admissions-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <!-- modal code start -->
        @include('components.course-registration-form-modal')

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

@endsection
