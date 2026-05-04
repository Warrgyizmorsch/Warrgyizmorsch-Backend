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
            /* red – problem */
        }

        .solution-icon {
            color: #0abf53;
            /* green – solution */
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
    <!-- Hero section  -->
    <section id="bookingSection" class="hero-main">
        <div class="swiper-wrapper">
            <!-- Single Slide -->
            <div class="swiper-slide">
                <div class="hero-content-wrapper">
                    <div class="home-hero-content">

                        <h1 class="hero-title">Study Abroad – Your Gateway to a Global Future</h1>
                        <p style="text-align: start;">Unlock endless opportunities by studying abroad, gain international exposure, and build a
                            successful global career with expert guidance.</p>

                        <!-- Features Section -->
                        <div class="features">
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Assistance in choosing the right country & course</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Step-by-step visa and admission support</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Expert guidance for scholarships and funding</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Comprehensive pre-departure and post-landing support</strong>
                            </div>
                        </div>
                        <span class=tip>
                            Turn your global dreams into reality with seamless support.
                        </span>

                    </div>

                    <div class="hero-form">
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                </div>
            </div>
        </div>

    </section>

    
    <style>

        /* GLOBAL FEATURE POINT SIZE FIX – MOBILE ONLY */
@media (max-width: 768px) {

    .features {
        margin-top: 16px;
    }

    .feature {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 20px;        /* 🔥 text size increased */
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .feature i {
        font-size: 20px;        /* 🔥 icon size increased */
        margin-top: 2px;
        color: black;
        flex-shrink: 0;
    }
}
</style>

    <!-- New Journey  -->
    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Why Studying Abroad Matters</h2>
            <p>
                The world is rapidly evolving, and global exposure is no longer optional it’s essential. Studying abroad
                gives you access to advanced learning systems, diverse cultures, and global career opportunities that shape
                your outlook and accelerate your professional growth.
            </p>
        </div>
        <p>When you study overseas, you gain:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>A globally recognised qualification</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Access to world-class technology, faculty & research facilities</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Hands-on learning and industry-relevant training</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Personality growth through independence and adaptability</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Higher employability and international career choices</strong>
            </div>
        </div>
        <span class=tip>
            Your study abroad experience becomes the foundation of a successful and confident global career.
        </span>
    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">Why Choose Us for Your Study Abroad Journey</h2>
            <p>
                At WTS Visa Consultancy, we believe your dreams deserve expert support.
                We do not just guide – we partner with you throughout your entire journey.
            </p>
        </div>

        <div class="journey-timeline">

            <!-- Block 1 -->
            <div class="timeline-card">
                <div class="timeline-icon"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="timeline-content">
                    <h3>Tailored Guidance for Every Student</h3>
                    <p>
                        Your academic background, career goals, financial preferences, and interests are unique.
                        Our team provides fully personalised study plans that match your aspirations
                        instead of suggesting generic options.
                    </p>
                </div>
            </div>

            <!-- Block 2 -->
            <div class="timeline-card">
                <div class="timeline-icon"><i class="fa-solid fa-shield"></i></div>
                <div class="timeline-content">
                    <h3>Transparent & Trustworthy Process</h3>
                    <p>We maintain complete clarity in every step:</p>

                    <div class="feature-list">
                        <div class="feature-list-item">
                            <i class="fa-solid fa-check"></i> Clear guidance
                        </div>
                        <div class="feature-list-item">
                            <i class="fa-solid fa-check"></i> Honest advice
                        </div>
                        <div class="feature-list-item">
                            <i class="fa-solid fa-check"></i> No misleading commitments
                        </div>
                    </div>

                    <span class="timeline-tip">
                        Our focus is your success, not just completing a process.
                    </span>
                </div>
            </div>

            <!-- Block 3 -->
            <div class="timeline-card">
                <div class="timeline-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div class="timeline-content">
                    <h3>Complete Support Under One Roof</h3>
                    <p>
                        From shortlisting universities to post-landing assistance,
                        we handle every stage with precision. You focus on your goals – we take care of the rest.
                    </p>
                </div>
            </div>

            <!-- Block 4 -->
            <div class="timeline-card">
                <div class="timeline-icon"><i class="fa-solid fa-users-gear"></i></div>
                <div class="timeline-content">
                    <h3>Trained & Experienced Consultants</h3>
                    <p>
                        Our team stays updated with changing visa rules, global education trends,
                        and documentation standards to give you the most accurate and reliable guidance.
                    </p>
                </div>
            </div>

        </div>

    </section>
    <style>
        .journey-timeline {
            display: flex;
            flex-direction: column;
            gap: 35px;
            position: relative;
            margin-top: 25px;
        }

        /* Vertical Line */
        .journey-timeline::before {
            content: "";
            position: absolute;
            left: 28px;
            top: 0;
            width: 3px;
            height: 100%;
            background: #e3e7ff;
            border-radius: 10px;
        }

        .timeline-card {
            display: flex;
            gap: 20px;
            position: relative;
            padding-left: 60px;
        }

        .timeline-icon {
            position: absolute;
            left: 0;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #f0f3ff;
            border: 2px solid #d9dfff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fc9118;
            z-index: 2;
        }

        .timeline-content {
            width: 100%;
            background: #ffffff;
            padding: 22px 26px;
            border-radius: 14px;
            border: 1px solid #e8e8e8;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.1);
        }

        .timeline-content p {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        /* Premium feature list */
        .feature-list {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .feature-list-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #f7f8ff;
            border: 1px solid #e1e4ff;
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 500;
        }

        .feature-list-item i {
            color: #fc9118;
        }

        @media (max-width: 768px) {
            .feature {
                justify-content: start;
            }
        }

        /* Tip */
        .timeline-tip {
            display: inline-block;
            margin-top: 12px;
            color: #444;
            font-style: italic;
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

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Study Abroad Services We Provide</h2>
            <p>
                Our services are designed to ensure a smooth journey from the moment you decide to study abroad until the
                day you land in your new country.
            </p>
        </div>

        <h3>Academic & Career Evaluation</h3>
        <p>We help you understand:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Which country suits your goals</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Which course aligns with your future career</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Which universities match your profile</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>What academic or financial improvements do you may need</strong>
            </div>

        </div>
        <span class=tip>
            This ensures you make informed decisions from day one.
        </span>

        <h3>University & Course Shortlisting</h3>
        <p>
            With thousands of universities worldwide, choosing where to study can feel overwhelming.
            <br>
            We simplify it by shortlisting options based on:
        </p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Budget</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Academic profile</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Course preference</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Future job opportunities</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Location & lifestyle</strong>
            </div>

        </div>
        <span class=tip>
            You get a clear comparison to make the right choice.
        </span>

        <h3>Application Assistance</h3>
        <p>
            A strong application increases your chances of getting accepted.
            <br>
            We support you with:
        </p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>SOP writing guidance</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>LOR formatting</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>CV/resume preparation</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Application form completion</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Portfolio structuring (if required)</strong>
            </div>

        </div>
        <span class=tip>
            Each application is prepared professionally to match global standards.
        </span>

        <h3>Scholarship Support</h3>
        <p>
            We help identify scholarship opportunities that reduce your financial burden. Our team also guides you in
            preparing strong scholarship applications.
        </p>

        <h3>Visa Documentation & Filing</h3>
        <p>
            Visa approval depends heavily on proper documentation.
            <br>
            Our experts help with:
        </p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Document preparation</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Financial guidance</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Visa forms</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Country-specific requirements</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Visa interview training</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Statement of Purpose for a visa</strong>
            </div>

        </div>
        <span class=tip>
            We ensure your file is strong, accurate, and complete.
        </span>

        <h3>Pre-Departure Orientation</h3>
        <p>Before you fly, we prepare you for your new life abroad with guidance on:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Part-time work rules</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Living arrangements</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Local transport & banking</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Cultural adjustments</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Safety tips and essentials</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>International student rights</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Packing checklist</strong>
            </div>

        </div>
        <span class=tip>
            This ensures a confident start to your journey.
        </span>

        <h3>Post-Landing Assistance</h3>
        <p>Once you arrive, we support you with basic settlement guidance, such as:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Accommodation suggestions</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>SIM card options</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Bank account setup</strong>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <strong>Local registration (if applicable)</strong>
            </div>

        </div>
        <span class=tip>
            Our goal is to make your transition smooth and stress-free.
        </span>
    </section>

    <!-- Our Services  -->
    <section class="sop-samples">
        <div class="heading-wrapper">
            <h2 class="new-section-title">Top Study Destinations We Assist With</h2>
        </div>

        <div class="sample-container">
            <div class="sample-card">
                <h3>Canada</h3>
                <p>
                    Known for its quality education, work opportunities, and welcoming environment for international
                    students.
                </p>
            </div>

            <div class="sample-card">
                <h3>Australia</h3>
                <p>
                    Offers globally ranked universities, strong job prospects, and a multicultural lifestyle.
                </p>
            </div>

            <div class="sample-card">
                <h3>United Kingdom</h3>
                <p>
                    Popular for shorter course durations, rich academic heritage, and excellent post-study pathways.
                </p>
            </div>

            <div class="sample-card">
                <h3>United States</h3>
                <p>
                    Home to leading universities, flexible courses, research facilities, and high-earning careers.
                </p>
            </div>

            <div class="sample-card">
                <h3>New Zealand</h3>
                <p>
                    A peaceful destination offering safe, innovative, and skill-oriented study environments.
                </p>
            </div>

            <div class="sample-card">
                <h3>Europe</h3>
                <p>
                    Provides affordable education, modern learning systems, and freedom to travel across multiple countries.
                </p>
            </div>
        </div>

    </section>

    <!-- Challenges Students Face Section -->
    <section class="abroad-section-wrapper">
        <div class="abroad-section-header">
            <h2 class="new-section-title">Challenges Students Face – And How We Solve Them</h2>
            <p>
                Many students feel confused or overwhelmed during the study abroad process.
                We simplify and solve every major challenge.
            </p>
        </div>

        <div class="abroad-table-wrapper">
            <table class="abroad-table">
                <thead>
                    <tr>
                        <th>Challenge Students Face</th>
                        <th>Our Solution</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa-solid fa-circle-xmark problem-icon"></i> Lack of clarity in choosing the right
                            country</td>
                        <td><i class="fa-solid fa-check-circle solution-icon"></i> Personalised counselling with clear
                            reasoning</td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-circle-xmark problem-icon"></i> Missing or incorrect documentation</td>
                        <td><i class="fa-solid fa-check-circle solution-icon"></i> Step-by-step documentation support</td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-circle-xmark problem-icon"></i> Budget concerns & no financial planning
                        </td>
                        <td><i class="fa-solid fa-check-circle solution-icon"></i> Scholarship guidance + education loan
                            assistance</td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-circle-xmark problem-icon"></i> Fear of visa rejection</td>
                        <td><i class="fa-solid fa-check-circle solution-icon"></i> Professional visa file preparation &
                            review</td>
                    </tr>

                    <tr>
                        <td><i class="fa-solid fa-circle-xmark problem-icon"></i> Missing university application deadlines
                        </td>
                        <td><i class="fa-solid fa-check-circle solution-icon"></i> Organised planning & constant reminders
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <span class="abroad-tip">
            With WTS Visa Consultancy, you move forward with confidence, clarity, and peace of mind.
        </span>
    </section>




    <!-- Our Commitment Section -->
    <section class="abroad-section-wrapper">
        <div class="abroad-section-header">
            <h2 class="new-section-title">Our Commitment to Students</h2>
            <p>We are committed to offering:</p>
        </div>

        <ul class="abroad-feature-list">
            <li class="abroad-feature-item">
                <i class="fa-solid fa-check-circle"></i>
                <span>A stress-free admission & visa process</span>
            </li>

            <li class="abroad-feature-item">
                <i class="fa-solid fa-check-circle"></i>
                <span>Genuine, transparent, and ethical support</span>
            </li>

            <li class="abroad-feature-item">
                <i class="fa-solid fa-check-circle"></i>
                <span>Accurate information with no false promises</span>
            </li>

            <li class="abroad-feature-item">
                <i class="fa-solid fa-check-circle"></i>
                <span>Continuous guidance from start to finish</span>
            </li>
        </ul>

        <span class="abroad-tip">
            Your dream deserves dedication, and we stand by you at every step.
        </span>
    </section>

    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Start Your Study Abroad Journey Today</h2>
                <p style="color: #000;">Whether you're exploring options or ready to apply, we’re here to guide your next
                    step. Start your global education journey with WTS, where your dreams find the right direction.</p>
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