@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">IELTS & English Test Preparation – Crack Your Exam with WTS</h1>

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
            
            <p>WTS offers expert coaching for IELTS and other English proficiency exams with structured training, real exam practice, and personalised feedback to help you achieve your target score for study abroad.
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

            <h2 class="ielts-overview-title">Test Preparation Overview</h2>

            <p class="ielts-overview-text">
                English proficiency exams like IELTS, PTE, TOEFL, and Duolingo are mandatory for studying abroad. Many students search for IELTS coaching, IELTS preparation for study abroad, or English test training, but struggle with exam patterns, time management, and scoring techniques.
            </p>

            <p class="ielts-overview-text">
                WTS provides professional IELTS and English test preparation, focusing on concept clarity, exam strategies, and real practice. The training is designed to help students meet university and visa language requirements confidently.    
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Ideal Students for Test Preparation Support?
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Are planning to take IELTS or similar English exams</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Need a required score for study abroad admissions</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Want expert guidance for IELTS preparation</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Struggle with speaking, writing, listening, or reading</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span>Want faster improvement with structured coaching</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Have limited time and need targeted score improvement strategies</h3>
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

        <h2 class="section-title">Key Benefits of IELTS & Test Preparation</h2>

        <div class="equal-width-grid three-grid">

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="p-text">
                    <span>Expert-led IELTS coaching for study abroad</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-user-cog"></i></div>
                <div class="p-text">
                    <span>Personalised study plans based on current level</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-file-alt"></i></div>
                <div class="p-text">
                    <span>Real exam-style mock tests</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-comments"></i></div>
                <div class="p-text">
                    <span>Speaking and writing evaluation with feedback</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-chart-line"></i></div>
                <div class="p-text">
                    <span>Higher chances of achieving target band score</span>
                </div>
            </div>

             <div class="premium-card">
    <div class="p-icon"><i class="fas fa-bullseye"></i></div>
    <div class="p-text">
        <span>Score-focused strategies to maximise results in fewer attempts</span>
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
        <h2 class="title">Exams Covered Under Test Preparation</h2>

        <div class="admissions-grid">
            <div class="admission-card">
                <i class="fas fa-pen-alt"></i>
                <h3>IELTS Academic & General</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-laptop"></i>
                <h3>PTE Academic</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-headphones"></i>
                <h3>TOEFL</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-mobile-alt"></i>
                <h3>Duolingo English Test</h3>
            </div>

            {{-- <div class="admission-card">
                <i class="fas fa-file-signature"></i>
                <h3>Private and external funding programmes</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-university"></i>
                <h3>Early-bird and country-specific scholarship schemes</h3>
            </div> --}}
        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Test Preparation Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Skill Assessment Test
                </h3>
                <p>Student’s current English level is evaluated.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br /> Personalised Study Plan
                </h3>
                <p> A customised preparation strategy is created.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Section-Wise Training
                </h3>
                <p> Focused training for Listening, <br>Reading, Writing, and <br>Speaking.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br /> Mock Tests & Practice
                </h3>
                <p>Regular IELTS mock tests with <br>exam-like conditions.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Performance Review & Improvement
                </h3>
                <p> Detailed feedback and <br>score improvement <br>strategies.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br />Final Exam Readiness Session
    </h3>
    <p>
       Last-minute tips, exam <br>strategies, and confidence-<br>building guidance.
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
        <h2 class="title">Why Choose WTS for IELTS Preparation?</h2>

        <div class="steps steps-row">

            <div class="step_s">
                <i class="fas fa-user-tie"></i>
                <h3>Experienced IELTS trainers</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-bullseye"></i>
                <h3>Result-oriented teaching approach</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-sync-alt"></i>
                <h3>Updated exam patterns and strategies</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-clock"></i>
                <h3>Flexible learning options</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-university"></i>
                <h3>Support aligned with admissions and visa needs</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-trophy"></i>
                <h3>Proven track record of high band score achievements</h3>
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
        ['question' => '1. What English proficiency exams does WTS help prepare for?', 'answer' => 'WTS provides preparation support for major English language exams required for study abroad, including IELTS Academic and General, PTE Academic, TOEFL, and the Duolingo English Test.'],
         ['question' => '2.	 Why is IELTS or an English proficiency test required for studying abroad?', 'answer' => 'English proficiency exams help universities and visa authorities assess whether students can communicate effectively in an English-speaking academic environment. Achieving the required score is often essential for admission and visa approval.'],
        ['question' => '3.	 How does WTS IELTS preparation work?', 'answer' => 'WTS offers structured coaching that includes skill assessment, personalised study plans, section-wise training (Listening, Reading, Writing, Speaking), mock tests, and detailed feedback to improve performance.'],
        ['question' => '4.	Is IELTS coaching suitable for beginners?', 'answer' => 'Yes, IELTS training is designed for students at different proficiency levels. Trainers assess your current level and create a customised preparation strategy to help you improve step by step.'],
        ['question' => '5. Do you provide speaking and writing evaluation with feedback?', 'answer' => 'Yes, students receive personalised feedback on speaking and writing tasks, helping them understand mistakes, improve fluency, and meet scoring criteria.'],
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