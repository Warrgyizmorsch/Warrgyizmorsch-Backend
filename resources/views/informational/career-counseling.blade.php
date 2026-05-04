@extends('layouts.app')

@section('content')

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

        .features {
            flex-direction: column
        }

        .feature {
            text-align: start;
        }

        @media (max-width: 768px) {
            .feature {
                justify-content: start;
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
        /* Wrapper for new sections */
        .abroad-section-wrapper {
            padding: 40px 0;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header style same as previous sections */
        .abroad-section-header {
            margin-bottom: 20px;
        }

        /* Bullets styling */
        .abroad-feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .abroad-feature-list li {
            display: flex;
            align-items: flex-start;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .abroad-feature-list li i {
            font-size: 20px;
            margin-right: 10px;
            margin-top: 2px;
        }

        /* Distinguish icons */
        .problem-icon {
            color: #e63946;
            /* red - problem */
        }

        .solution-icon {
            color: #0abf53;
            /* green - solution */
        }

        /* Tip / bottom text */
        .abroad-tip {
            display: block;
            margin-top: 20px;
            font-style: italic;
            color: #555;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .abroad-problem-item h3 {
                font-size: 18px;
            }
        }

        /* Wrapper */
        .abroad-table-wrapper {
            margin-top: 20px;
            overflow-x: auto;
        }

        /* Table styling */
        .abroad-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .abroad-table thead {
            background: var(--primary-color);
            color: #fff;
        }

        .abroad-table th,
        .abroad-table td {
            padding: 14px 18px;
            text-align: left;
            font-size: 16px;
            vertical-align: top;
        }

        .abroad-table tbody tr:nth-child(even) {
            background: #f7f7f7;
        }

        .abroad-table tbody tr:hover {
            background: #f0f4ff;
        }

        /* Icons */
        .problem-icon {
            color: #e63946;
            margin-right: 8px;
            font-size: 18px;
        }

        .solution-icon {
            color: #0abf53;
            margin-right: 8px;
            font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 600px) {

            .abroad-table th,
            .abroad-table td {
                font-size: 14px;
                padding: 10px 12px;
            }
        }
    </style>

    <style>
        .financial-table-wrapper {
            margin-top: 25px;
            overflow-x: auto;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e6e6e6;
        }

        .financial-table thead {
            background: #f7f8ff;
        }

        .financial-table th,
        .financial-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ececec;
            text-align: left;
        }

        .financial-table th {
            font-weight: 600;
            color: #222;
            font-size: 15.5px;
        }

        .financial-table td {
            line-height: 1.55;
            color: #444;
        }

        .financial-table tbody tr:last-child td {
            border-bottom: none;
        }

        .financial-table tbody tr:hover {
            background: #fafbff;
        }

        .financial-bottom-note {
            margin-top: 25px;
            padding: 18px;
            background: #f9faff;
            border-left: 4px solid #fc9118;
            border-radius: 10px;
        }

        .financial-bottom-note h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        @media (max-width: 600px) {

            .financial-table th,
            .financial-table td {
                padding: 12px 14px;
                font-size: 14px;
            }

            .new-journey-header p {
                font-size: 15px;
            }

            .financial-bottom-note {
                padding: 15px;
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
        .financial-table-wrapper {
            margin-top: 20px;
            overflow-x: auto;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e6e6e6;
        }

        .financial-table thead {
            background: #f7f8ff;
        }

        .financial-table th,
        .financial-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ececec;
            text-align: left;
            font-size: 15.5px;
        }

        .financial-table td {
            color: #444;
            line-height: 1.55;
        }

        .financial-table tbody tr:hover {
            background: #fafbff;
        }

        .financial-bottom-note {
            margin-top: 25px;
            padding: 20px;
            background: #f9faff;
            border-left: 4px solid #fc9118;
            border-radius: 10px;
        }

        .financial-bottom-note h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        @media (max-width: 600px) {

            .financial-table th,
            .financial-table td {
                padding: 12px 14px;
                font-size: 14px;
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

                        <h1 class="hero-title">Career Counselling – Discover Your Ideal Career Path with Expert Guidance
                        </h1>
                        <p style="text-align: start;">Choosing the right career is crucial, and with personalised guidance
                            from experts, you can align your strengths, interests, and goals with global opportunities to
                            make confident and well-informed decisions.</p>

                        <!-- Features Section -->
                        <div class="features">
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Expert assessments to identify your strengths</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>One-on-one guidance for informed decisions</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Explore study & career opportunities worldwide</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Tailored advice for top destinations like Canada, Australia, USA, UK, and
                                    Europe</strong>
                            </div>
                        </div>
                        <span class=tip>
                            Make confident decisions and shape a successful future.
                        </span>

                    </div>

                    <div class="hero-form">
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Why Career Counselling Matters</h2>

        <div class="improved-list">
            <p class="improve-subtitle"><strong>Many students struggle with:</strong></p>

            <ul class="simple-ul">
                <li>Confusion about which course or country to choose</li>
                <li>Pressure from family or society</li>
                <li>Limited knowledge of emerging global careers</li>
                <li>Difficulty connecting their skills with the right profession</li>
                <li>Overwhelming university options</li>
            </ul>

            <p class="improve-subtitle"><strong>A structured, expert-led counselling session helps students:</strong></p>

            <ul class="simple-ul">
                <li>Discover suitable career options</li>
                <li>Choose the right academic course</li>
                <li>Pick the best country for future growth</li>
                <li>Create a clear roadmap for studies and career success</li>
                <li>Avoid costly mistakes and time loss</li>
            </ul>
        </div>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Our Career Counselling Approach – Your Future, Our Expertise</h2>

        <ul class="improved-list">

            <li class="without-dot improve-subtitle"><strong>✔ Step 1: Detailed Profile Evaluation</strong>
                <p>We analyse:</p>
                <ul class="simple-ul">
                    <li>Academic performance</li>
                    <li>Skills & interests</li>
                    <li>Personality traits</li>
                    <li>Career aspirations</li>
                    <li>Financial preferences</li>
                    <li>Preferred countries & academic environments</li>
                </ul>
            </li>

            <li class="without-dot improve-subtitle"><strong>✔ Step 2: Psychometric & Career Assessment (Optional)</strong>
                <p>Scientific tests help identify your strengths, thinking style, personality, and career compatibility.</p>
            </li>

            <li class="without-dot improve-subtitle"><strong>✔ Step 3: Course & Country Mapping</strong>
                <p>Based on the evaluation, we suggest the best-suited:</p>
                <ul class="simple-ul">
                    <li>Study courses</li>
                    <li>Countries</li>
                    <li>Universities</li>
                    <li>Scholarship opportunities</li>
                    <li>Future career prospects</li>
                </ul>
            </li>

            <li class="without-dot improve-subtitle"><strong>✔ Step 4: One-on-One Expert Counselling Session</strong>
                <p>A personalised session where our experts guide you on:</p>
                <ul class="simple-ul">
                    <li>Choosing the right program</li>
                    <li>Understanding job market trends</li>
                    <li>Matching your profile with global career opportunities</li>
                    <li>Clarifying doubts and planning next steps</li>
                </ul>
            </li>

            <li class="without-dot improve-subtitle"><strong>✔ Step 5: Career Roadmap & Action Plan</strong>
                <p>A customised plan that defines:</p>
                <ul class="simple-ul">
                    <li>Course pathway</li>
                    <li>Duration & costs</li>
                    <li>University shortlist</li>
                    <li>Visa process timeline</li>
                    <li>Career growth projection</li>
                </ul>
            </li>

            <li class="without-dot improve-subtitle"><strong>✔ Step 6: Continuous Mentorship</strong>
                <p>Even after selecting your path, we support you through:</p>
                <ul class="simple-ul">
                    <li>Application preparation</li>
                    <li>Visa processing</li>
                    <li>Pre-departure guidance</li>
                    <li>Post-arrival advisory</li>
                </ul>
            </li>
        </ul>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Why Choose Us for Career Counselling?</h2>

        <ul class="simple-ul">
            <li class="without-dot">1. Global Counselling Expertise
                We specialise in top study destinations-Canada, Australia, USA, UK, Europe, and more.</li>

            <li class="without-dot">2. Personalised & Transparent Guidance
                No generalised advice. Every suggestion is purely based on your profile and goals.</li>

            <li class="without-dot">3. End-to-End Support
                From course selection to visa processing and pre-departure support, everything under one roof.</li>

            <li class="without-dot">4. Strong Network of Global Institutions
                Our connections with leading universities help students access high-quality programs.</li>

            <li class="without-dot">5. Honest & Ethical Counselling
                We never misguide or overcharge. Our foundation is based on trust and student success.</li>

            <li class="without-dot">6. Expert Counsellors with Years of Experience
                Our team understands international academic systems and global job markets deeply.</li>
        </ul>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">What We Help You Decide</h2>

        <ul class="simple-ul">
            <li>Which course is right for you?</li>
            <li>Which country matches your future goals?</li>
            <li>Which universities fit your profile?</li>
            <li>What are the post-study job opportunities abroad?</li>
            <li>What is the right budget and financial plan?</li>
            <li>How to build a long-term career roadmap?</li>
        </ul>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Courses We Guide You For</h2>

        <ul class="simple-ul">
            <li>Business & Management</li>
            <li>Engineering & Technology</li>
            <li>Health & Medicine</li>
            <li>Hospitality & Tourism</li>
            <li>Computer Science & IT</li>
            <li>Media & Communication</li>
            <li>Law & Criminology</li>
            <li>Arts, Humanities & Social Sciences</li>
            <li>Architecture & Design</li>
            <li>Finance & Commerce</li>
            <li>Emerging fields (AI, Data Science, Cybersecurity, BioTech)</li>
        </ul>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Worldwide Education Guidance – Countries We Specialise In</h2>

        <ul class="simple-ul">
            <li>Canada</li>
            <li>Australia</li>
            <li>USA</li>
            <li>United Kingdom</li>
            <li>New Zealand</li>
            <li>Europe/Schengen Countries</li>
        </ul>

        <p class="improve-subtitle"><strong>We guide you on:</strong></p>
        <ul class="simple-ul">
            <li>Top universities</li>
            <li>Admission requirements</li>
            <li>Cost of living</li>
            <li>PR options</li>
            <li>Part-time and post-study work rules</li>
        </ul>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Success Stories & Student Experiences</h2>

        <p>“WTS Visa Consultancy helped me find the perfect course and country. Their counselling gave me clarity and
            confidence. Highly recommended!”<br>
            - Student Name, Currently Studying in Canada</p>
    </section>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Our Commitment to Your Career Success</h2>

        <p>Career counselling at WTS Visa Consultancy is not just a session-it is a long-term partnership.<br>
            We ensure that you:</p>

        <ul class="simple-ul">
            <li>Select the right academic program</li>
            <li>Understand future job markets</li>
            <li>Make informed decisions</li>
            <li>Build a strong international career</li>
        </ul>

        <p>We guide you until your dream of studying abroad becomes a reality.</p>
    </section>

    <style>
        .improve-subtitle {
            font-size: 1.5rem !important;
            margin-left: 0 !important;
        }

        .without-dot {
            list-style-type: none !important;
        }

        .improved-list ul,
        .simple-ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .improved-list li,
        .simple-ul li {
            padding: 10px;
            margin-left: 2rem;
            border-bottom: 1px solid #e5e5e5;
            font-size: 17px;
            line-height: 1.6;
            list-style-type: disc;
        }

        .improved-list li:last-child,
        .simple-ul li:last-child {
            border-bottom: none;
        }

        .improved-list p {
            margin: 10px 0 5px;
            font-size: 16px;
            color: #444;
        }

        .simple-ul li {
            padding-left: 0;
        }
    </style>




    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Book Your Career Counselling Session</h2>
                <p style="color: #000;">Ready to discover your perfect career path? Our experts guide you with clarity,
                    confidence, and global insight. Get personalised and honest career counselling today.</p>
                <a href="#registrationModals" class="herov1-btn smooth-scroll-btn" style="margin: 0px; color: #000;">
                    Get Free Consultation
                </a>
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scrollBtns = document.querySelectorAll('.smooth-scroll-btn');

            scrollBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const target = document.querySelector('#registrationModals');
                    const offsetTop = target.offsetTop;

                    window.scrollTo({
                        top: offsetTop - 20,   // adjust -20 if needed
                        behavior: "smooth"
                    });
                });
            });
        });
    </script>


@endsection