@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Free Profile Evaluation for Study Abroad – Know Your Admission Potential with WTS</h1>

             <!-- Features Section -->
            <div class="features">
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Accurate & Updated Visa Guidance
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Fast & Hassle-Free Processing
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>24/7 Expert Support
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Right Country & University Selection</strong>
                </div>
            </div>
            
            <p>Get a free expert profile assessment from WTS to understand your admission chances, course suitability, and best study destinations for a successful study abroad journey.
            </p>
            <!-- <a href="#get-started" class="btn">Select Your Course</a> -->

            {{-- <span class=tip>Enjoy free services from A to A – application to accommodation, ensuring a smooth visa process
                from start to finish</span> --}}
        </div>

        <!-- Hero Image -->
        <div class="hero-form">
            @include('./components/landing-page-registration-study-abroad')
        </div>
    </section>

    {{-- Course Overview Section  --}}

   <style>
        /* IELTS OVERVIEW */

        .ielts-overview {
            padding: 30px 0;
            text-align: center;
        }

        .ielts-overview-title {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .ielts-overview-text {
            max-width: 900px;
            margin: 0 auto 20px;
            color: #444;
            line-height: 1.7;
            font-size: 16px;
        }
    </style>

    <section class="ielts-overview">

        <div class="container">

            <h2 class="ielts-overview-title">Free Profile Evaluation Overview</h2>

            <p class="ielts-overview-text">
                Before applying to universities abroad, understanding your academic strengths and eligibility is essential. Many students search for free profile evaluation for study abroad, study abroad eligibility check, or profile assessment for overseas education but struggle to get clear, reliable insights.
            </p>

            <p class="ielts-overview-text">
                WTS offers a free study abroad profile evaluation where experts assess academic background, test scores, career goals, and preferences. This helps students make informed decisions before investing time and money in applications.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Ideal Students for Free Profile Evaluation
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Are planning to study abroad but unsure about eligibility</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Want to know admission chances in foreign universities</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Need guidance on course and country suitability</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Are confused between multiple study destinations</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Want expert advice before starting applications</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Are seeking clarity on scholarships and budget planning</h3>
                    {{-- <p class="support-text">
                        Our experts help you navigate student loan options, paperwork, and approvals — so you can focus on
                        your education, not
                        the finances.
                    </p> --}}
                </div>
            </div>
        </div>
</section>

@include('./components/stats')


{{-- New section Card  --}}

<section class="info-section">
    <div class="info-container">

        <h2 class="section-title">Key Benefits of Free Profile Evaluation</h2>

        <div class="equal-width-grid three-grid">

            <div class="premium-card">
    <div class="p-icon"><i class="fas fa-user-tie"></i></div>
    <div class="p-text">
        <span>Expert-led profile assessment for study abroad</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-chart-pie"></i></div>
    <div class="p-text">
        <span>Clear understanding of admission chances</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-university"></i></div>
    <div class="p-text">
        <span>Guidance on suitable courses and universities</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-globe"></i></div>
    <div class="p-text">
        <span>Insights into best countries for the profile</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-hand-holding-usd"></i></div>
    <div class="p-text">
        <span>No cost, no obligation consultation</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-route"></i></div>
    <div class="p-text">
        <span>Personalised recommendations based on career goals</span>
    </div>
</div>


</div>
        </div>
    </div>
</section>

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
.section-title{
    font-size: 44px;
    font-weight: 700;
    line-height: 1.2;
    color: #1C2C59;
    text-align: center;
    margin-bottom: 65px; /* professional gap */
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border-left: 5px solid #FC9118;
    min-height: 115px;
    transition: box-shadow 0.25s ease;
}

.premium-card:hover {
    box-shadow: 0 10px 28px rgba(252,145,24,0.25);
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
.info-section h2.section-title{
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

{{-- Admission Section  --}}

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
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.admission-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.12);
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

<section class="admissions-section">
    <div class="container">
        <h2 class="title">Factors Analysed During Profile Evaluation</h2>

        <div class="admissions-grid">

            <div class="admission-card">
    <i class="fas fa-user-graduate"></i>
    <h3>Academic performance and background</h3>
</div>

<div class="admission-card">
    <i class="fas fa-language"></i>
    <h3>English proficiency and entrance test scores</h3>
</div>

<div class="admission-card">
    <i class="fas fa-bullseye"></i>
    <h3>Career goals and study preferences</h3>
</div>

<div class="admission-card">
    <i class="fas fa-wallet"></i>
    <h3>Budget and financial readiness</h3>
</div>

<div class="admission-card">
    <i class="fas fa-clipboard-check"></i>
    <h3>Country-specific eligibility criteria</h3>
</div>

<div class="admission-card">
    <i class="fas fa-briefcase"></i>
    <h3>Work experience, internships, or extracurricular profile strength</h3>
</div>

        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Free Profile Evaluation Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Profile Information Collection
                </h3>
                <p>Academic details, test scores, and career goals are collected.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br />Expert Profile Review
                </h3>
                <p> Experts analyse eligibility, strengths, and improvement areas.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Course & Country Matching
                </h3>
                <p>Best-fit courses and study <br>destinations are identified.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br />Admission & Visa Feasibility Check
                </h3>
                <p>Realistic admission and visa <br>success chances are <br>discussed.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Personalised Roadmap
                </h3>
                <p>Students receive a clear <br>next-step plan for study <br>abroad.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br /> Improvement Strategy Guidance
    </h3>
    <p>
        Suggestions are provided to <br>strengthen profile before <br>application.
    </p>
    <img src="/new-home-images/teaching.webp"
         class="new-home-service-image"
         style="height:130px; width:130px;  bottom:2px; right:3px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"
         alt="">
</div>



        </div>
    </div>
</section>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->

        {{-- Course section  --}}

<section class="course-selection">
    <div class="container">
        <h2 class="title">Why Choose WTS for Free Profile Evaluation?</h2>

        <div class="steps steps-row">

           <div class="step_s">
    <i class="fas fa-user-tie"></i>
    <h3>Experienced study abroad counsellors</h3>
</div>

<div class="step_s">
    <i class="fas fa-scale-balanced"></i>
    <h3>Honest and unbiased profile assessment</h3>
</div>

<div class="step_s">
    <i class="fas fa-chart-line"></i>
    <h3>Data-driven course and country suggestions</h3>
</div>

<div class="step_s">
    <i class="fas fa-handshake"></i>
    <h3>Student-focused guidance, not sales-driven</h3>
</div>

<div class="step_s">
    <i class="fas fa-route"></i>
    <h3>End-to-end support beyond evaluation</h3>
</div>

<div class="step_s">
    <i class="fas fa-award"></i>
    <h3>Proven expertise in building successful study abroad profiles</h3>
</div>


        </div>
    </div>
</section>




{{-- @include('./components/services-components.trusted-partner') --}}

{{-- @include('./components/services-components.trust') --}}

{{-- @include('services.course-selection.scrollable') --}}

@include('./components/cta-button')

@php
    $faqs = [
        ['question' => '1. What is a free profile evaluation for study abroad?', 'answer' => 'A free profile evaluation is an expert assessment of your academic background, test scores, career goals, and preferences to determine your eligibility for studying abroad and identify suitable courses, universities, and countries.'],
         ['question' => '2.	How does WTS conduct a free study abroad profile evaluation?', 'answer' => 'WTS collects your academic details, test scores, and career goals, then experts analyse your profile to provide personalised recommendations on study destinations, course options, and realistic admission chances.'],
        ['question' => '3.	 Is the free profile evaluation really free?', 'answer' => 'Yes, the profile evaluation is completely free with no obligation. The goal is to help students understand their study abroad potential before starting applications.'],
        ['question' => '4.	What information do I need to provide for profile assessment?', 'answer' => 'Students typically provide academic transcripts, current qualifications, English proficiency scores (if available), career interests, preferred countries, and budget considerations.'],
        ['question' => '5. Can I get guidance on which country is best for my profile?', 'answer' => 'Yes, WTS experts evaluate your profile and suggest suitable countries based on academic eligibility, career goals, budget, and visa success factors.'],
    ];
@endphp

<x-faq :faqs="$faqs" />

<style>
    /* Section Styling */
    .course-selection {
        background: #f9f9f9;
        padding: 50px 20px;
        text-align: center;
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
        width: 300px;
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



@endsection