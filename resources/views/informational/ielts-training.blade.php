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

                        <h1 class="hero-title">IELTS Training - Achieve Your Dream Band Score With Expert Guidance</h1>
                        <p style="text-align: start;">Clearing IELTS is a key step toward studying, working, or migrating
                            abroad—our expert-led training prepares you for success in all four modules with confidence and
                            accuracy.</p>

                        <!-- Features Section -->
                        <div class="features">
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Global recognition by 11,000+ institutions</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Complete LRWS module preparation</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Expert trainers & structured learning</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Confidence-building practice sessions</strong>
                            </div>
                        </div>
                        <span class=tip>
                            Achieve your dream band score with focused training and personalised support.
                        </span>

                    </div>

                    <div class="hero-form">
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- New Journey  -->
    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">What is IELTS?</h2>
            <p>
                IELTS is a globally accepted English proficiency test used for academic admissions, work visas, and
                immigration applications. It measures how well an individual can understand and use English in real-world
                situations.
                <br>
                The test includes:
            </p>
        </div>

        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p><b>Listening</b></p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p><b>Reading</b></p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p><b>Writing</b></p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p><b>Speaking</b></p>
            </div>
        </div>

    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">IELTS Exam Highlights</h2>
        </div>
        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Conducting Body</td>
                        <td>IDP & British Council</td>
                    </tr>
                    <tr>
                        <td>Mode of Exam</td>
                        <td>Paper-based & Computer-delivered</td>
                    </tr>
                    <tr>
                        <td>Band Score Range</td>
                        <td>1-9</td>
                    </tr>
                    <tr>
                        <td>Test Acceptance</td>
                        <td>UK, Canada, Australia, USA, New Zealand & more</td>
                    </tr>
                    <tr>
                        <td>Exam Duration</td>
                        <td>2 hours 45 minutes</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">Types of IELTS Exams</h2>
        </div>

        <h3>1. IELTS Academic</h3>
        <p>For students applying to:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>International universities</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Professional programs</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Higher studies</p>
            </div>
        </div>
        <p>It assesses your ability to handle academic-level English.</p>

        <h3>2. IELTS General Training</h3>
        <p>Ideal for:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Work visas</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Migration</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Every day communication needs</p>
            </div>
        </div>
        <p>This version tests practical English skills for social and workplace environments.</p>

        <h3>3. IELTS for UK VI</h3>
        <p>A UK Government-approved version is required for certain visa categories.</p>

        <h3>4. IELTS Life Skills (A1 & B1)</h3>
        <p>A simple Speaking and Listening test for specific UK visa requirements.</p>

    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">IELTS Exam Pattern</h2>
            <p>The IELTS exam includes four essential modules:</p>
        </div>

        <div class="container">
            <!-- Row 1 -->
            <div class="ielts-row">
                <div class="ielts-col-left">
                    Listening (Approx. 30 minutes + transfer time)
                </div>
                <div class="ielts-col-right">
                    Four recordings<br>
                    Conversations, discussions, lectures<br>
                    Tests comprehension and attention to detail
                </div>
            </div>

            <!-- Row 2 -->
            <div class="ielts-row">
                <div class="ielts-col-left">Reading (60 minutes)</div>
                <div class="ielts-col-right">
                    <strong>Academic:</strong><br>
                    Three detailed passages from research-based sources<br><br>
                    <strong>General Training:</strong><br>
                    Texts based on daily life, workplace, and general interest topics
                </div>
            </div>

            <!-- Row 3 -->
            <div class="ielts-row">
                <div class="ielts-col-left">Writing (60 minutes)</div>
                <div class="ielts-col-right">
                    <strong>Academic:</strong><br>
                    Task 1: Interpret a chart/graph/diagram<br>
                    Task 2: Write a structured essay<br><br>
                    <strong>General Training:</strong><br>
                    Task 1: Write a formal, semi-formal, or informal letter<br>
                    Task 2: Essay writing (same format as Academic)
                </div>
            </div>

            <!-- Row 4 -->
            <div class="ielts-row">
                <div class="ielts-col-left">Speaking (11-14 minutes)</div>
                <div class="ielts-col-right">
                    Face-to-face interview<br>
                    Short introduction<br>
                    Cue card task<br>
                    Follow-up discussion
                </div>
            </div>

        </div>
    </section>

    <style>
        /* Clean 2-column rows */
        .ielts-row {
            display: grid;
            grid-template-columns: 30% 70%;
            gap: 20px;
            padding: 22px 0;
            border-bottom: 1px solid #e6e6e6;
        }

        .ielts-row:first-of-type {
            border-top: 1px solid #e6e6e6;
        }

        .ielts-col-left {
            font-size: 19px;
            font-weight: 600;
            color: #000;
        }

        .ielts-col-right {
            font-size: 16px;
            line-height: 1.6;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .ielts-row {
                grid-template-columns: 1fr;
                gap: 5px;
                padding: 16px 0;
            }

            .ielts-col-left {
                font-size: 18px;
            }

            .ielts-col-right {
                font-size: 15px;
            }
        }
    </style>

    <section class="new-journey-wrapper">
        <h2 class="new-section-title">IELTS Eligibility</h2>

        <ul class="improved-list">
            <li>Minimum age requirement: 16 years</li>
            <li>No academic restrictions</li>
            <li>No specific English level needed</li>
            <li>Universities typically expect a minimum overall band of 6.0–7.0 depending on the course</li>
        </ul>
    </section>
    <section class="new-journey-wrapper">
        <h2 class="new-section-title">IELTS Band Score Scale</h2>

        <div class="band-table">
            <div class="band-row"><span>Band</span><span>Skill Level</span></div>
            <div class="band-row"><span>9</span><span>Expert</span></div>
            <div class="band-row"><span>8</span><span>Very Good</span></div>
            <div class="band-row"><span>7</span><span>Good</span></div>
            <div class="band-row"><span>6</span><span>Competent</span></div>
            <div class="band-row"><span>5</span><span>Modest</span></div>
        </div>

        <p class="note-text">IELTS scores remain valid for two years and are accepted worldwide.</p>
    </section>
    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Our IELTS Training Program</h2>
        <p>We offer a complete, student-focused training experience designed to help you achieve your target band score with
            ease.</p>

        <ul class="improved-list">
            <li>✔ Individual Skill Assessment
                <p>Every student receives a personalised analysis to identify strengths and improvement areas.</p>
            </li>

            <li>✔ Small Batches for Better Learning
                <p>Focused attention and customised support for every learner.</p>
            </li>

            <li>✔ Updated Study Material
                <p>Covers the latest exam format, question types, and practice tasks.</p>
            </li>

            <li>✔ Daily Vocabulary & Grammar Enhancement
                <p>Improves overall communication and accuracy.</p>
            </li>

            <li>✔ Module-wise Practice Sessions
                <p>
                    Listening practice with real exam-style recordings<br>
                    Timed Reading tests<br>
                    Daily Writing tasks with evaluation<br>
                    One-on-one Speaking interviews
                </p>
            </li>

            <li>✔ Full-Length Mock Tests
                <p>Simulated test environment to build speed, confidence, and exam strategy.</p>
            </li>

            <li>✔ Expert Feedback
                <p>Detailed corrections and actionable suggestions to boost performance.</p>
            </li>
        </ul>
    </section>
    <section class="new-journey-wrapper">
        <h2 class="new-section-title">IELTS Preparation Tips</h2>

        <ul class="improved-list">
            <li>Understand the Format
                <p>Knowing the structure of each module helps with efficient planning.</p>
            </li>

            <li>Practice Regularly
                <p>Daily practice improves speed, accuracy, and familiarity with question patterns.</p>
            </li>

            <li>Build Strong Vocabulary
                <p>Reading English content improves comprehension and confidence.</p>
            </li>

            <li>Enhance Writing Skills
                <p>Practice essay structures, coherence, grammar, and task response.</p>
            </li>

            <li>Improve Listening Skills
                <p>Listen to podcasts, interviews, and English discussions to adapt to different accents.</p>
            </li>

            <li>Speak English Daily
                <p>Practice fluency, pronunciation, and confidence-building exercises.</p>
            </li>
        </ul>
    </section>
    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Who Should Join Our IELTS Program?</h2>

        <ul class="improved-list">
            <li>Students applying abroad</li>
            <li>Skilled workers planning for overseas jobs</li>
            <li>Applicants seeking permanent residency</li>
            <li>Individuals preparing for UK VI or Life Skills tests</li>
            <li>Anyone who wants to improve their English proficiency</li>
        </ul>
    </section>
    <section class="new-journey-wrapper">
        <h2 class="new-section-title">Why Choose Us for IELTS Training?</h2>

        <ul class="improved-list">
            <li>High success rate with proven results</li>
            <li>Experienced & certified trainers</li>
            <li>Flexible batch timings</li>
            <li>Personalised coaching approach</li>
            <li>Online & offline class options</li>
            <li>Complete guidance from preparation to exam day</li>
        </ul>
    </section>
    <style>
        .improved-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .improved-list li {
            padding: 18px 15px;
            border-bottom: 1px solid #e5e5e5;
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .improved-list li p {
            margin: 6px 0 0;
            font-size: 15px;
            font-weight: 400;
            color: #444;
            line-height: 1.6;
        }

        .band-table {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .band-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-size: 17px;
        }

        .band-row:last-child {
            border-bottom: none;
        }

        .note-text {
            font-size: 15px;
            color: #444;
            margin-top: 10px;
        }
    </style>

    

    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Start Your IELTS Journey Today</h2>
                <p style="color: #000;">Give your overseas journey the right start with our professional IELTS training—build the skills, confidence, and score you need for education, work, or migration. Contact us today to get started!</p>
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