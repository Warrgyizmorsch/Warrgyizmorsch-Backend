@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">SOP Writing Services for Study Abroad – Craft a Winning Statement with WTS</h1>

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
            
            <p>WTS helps you create a strong, personalised, and visa-ready Statement of Purpose that improves your chances of university admission and visa approval with expert guidance.
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

            <h2 class="ielts-overview-title">SOP Writing Services Overview</h2>

            <p class="ielts-overview-text">
                A Statement of Purpose (SOP) plays a crucial role in both university admission and study visa approval. Many students search for SOP writing services, how to write SOP for study abroad, or best SOP for visa, but struggle to present their profile clearly and convincingly.
            </p>

            <p class="ielts-overview-text">
                WTS offers professional SOP writing services for study abroad, helping students highlight their academic background, career goals, and motivation in a structured, impactful, and authentic manner that meets university and embassy expectations.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Students Who Need Professional SOP Support?
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Are applying to international universities</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Need a strong SOP for admission</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Want a visa-ready SOP</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Are unsure how to structure or frame their story</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Have gaps, low scores, or profile challenges</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Are applying for scholarships or competitive programmes</h3>
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

        <h2 class="section-title"> Benefits of Professional SOP Writing</h2>

        <div class="equal-width-grid three-grid">

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-user-cog"></i></div>
                <div class="p-text">
                    <span>100% personalised SOP (no templates)</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-university"></i></div>
                <div class="p-text">
                    <span>University & country-specific SOP format</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-passport"></i></div>
                <div class="p-text">
                    <span>Visa-compliant and goal-oriented content</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-bullseye"></i></div>
                <div class="p-text">
                    <span>Clear explanation of academic and career goals</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-chart-line"></i></div>
                <div class="p-text">
                    <span>Improved admission and visa success rate</span>
                </div>
            </div>

             <div class="premium-card">
    <div class="p-icon"><i class="fas fa-pen-alt"></i></div>
    <div class="p-text">
        <span>Professional storytelling that highlights strengths effectively</span>
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
        <h2 class="title">What Makes a Strong SOP?</h2>

        <div class="admissions-grid">
            <div class="admission-card">
               <i class="fas fa-user-graduate"></i>
                <h3>Clear academic journey</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-graduation-cap"></i>
                <h3>Logical career goals</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Reason for course & country selection</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-road"></i>
                <h3>Future plans after studies</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-file-alt"></i>
                <h3>Honest, confident, and professional tone</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-university"></i>
                <h3>Alignment with university expectations and visa guidelines</h3>
            </div>
        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our SOP Writing Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Profile Evaluation
                </h3>
                <p>Academic background, work experience, and goals are analysed.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br />SOP Strategy Planning
                </h3>
                <p>Tone, structure, and focus are decided based on university and country.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />SOP Drafting
                </h3>
                <p>A compelling, original, and <br>well-structured SOP is written.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br />Review & Refinement
                </h3>
                <p>Multiple revisions with student <br>feedback.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Final Visa-Ready SOP Delivery
                </h3>
                <p>Polished SOP aligned with <br>admission and visa <br>requirements.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br />Final Quality & Plagiarism Check
    </h3>
    <p>
        Final proofreading, formatting, <br>and originality verification <br>before submission.
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
        <h2 class="title">Why Choose WTS for SOP Writing Services?</h2>

        <div class="steps steps-row">

            <div class="step_s">
                <i class="fas fa-user-tie"></i>
                <h3>Experienced SOP & visa experts</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-globe"></i>
                <h3>Country-specific SOP expertise (UK, USA, Canada, Australia, Europe)</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-bullseye"></i>
                <h3>100% original & plagiarism-free content</h3>
            </div>

            <div class="step_s">
               <i class="fas fa-handshake"></i>
                <h3>Admission-focused and visa-oriented approach</h3>
            </div>

            <div class="step_s">
               <i class="fas fa-passport"></i>
                <h3>End-to-end guidance until final approval</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-chart-line"></i>
                <h3>High success rate in admissions and visa approvals</h3>
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
        ['question' => '1. What is a Statement of Purpose (SOP) for study abroad?', 'answer' => 'A Statement of Purpose (SOP) is a personal document required by universities and visa authorities that explains your academic background, career goals, motivation for choosing a course, and future plans. It helps decision-makers understand your profile beyond academic scores.'],
         ['question' => '2.	Why is an SOP important for university admission and visa approval?', 'answer' => 'An SOP demonstrates your clarity of purpose, academic intent, and career direction. A well-written SOP can significantly improve your chances of receiving an admission offer and strengthening your study visa application.'],
        ['question' => '3.	 How does WTS help in SOP writing?', 'answer' => 'WTS provides personalised SOP writing support based on your academic profile, experience, and goals. Our experts create structured, authentic, and university-specific SOPs that align with admission and visa requirements'],
        ['question' => '4.	Is the SOP written by WTS 100% original?', 'answer' => 'Yes, every SOP is written from scratch based on your individual profile. We do not use templates, ensuring originality, authenticity, and plagiarism-free content.'],
        ['question' => '5. Can you help with SOPs for different countries?', 'answer' => 'Yes, WTS offers country-specific SOP writing services for destinations such as the UK, USA, Canada, Australia, and European countries, ensuring that each SOP meets the expectations of universities and immigration authorities.'],
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