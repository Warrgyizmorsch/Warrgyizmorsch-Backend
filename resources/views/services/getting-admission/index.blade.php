@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Getting Admission Abroad Made Easy – Secure Your University Offer with WTS</h1>

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
            
            <p>WTS makes your study abroad admission simple with expert guidance, smart university shortlisting, and complete end-to-end support.
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

            <h2 class="ielts-overview-title">Getting Admission Overview</h2>

            <p class="ielts-overview-text">
                Getting admission to an international university can feel confusing due to multiple requirements, deadlines, and eligibility criteria. Many students search for how to get admission abroad, study abroad admission process, or university admission consultants, but struggle to manage everything on their own.
            </p>

            <p class="ielts-overview-text">
                WTS provides professional study abroad admission support, helping students choose the right universities, prepare strong applications, and secure admission offers from top institutions worldwide.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Students Who Can Benefit from This Service
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Want admission in foreign universities</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Are unsure about eligibility and intake requirements</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Need help with course and university shortlisting</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Want expert support for application submission</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Are applying for undergraduate or postgraduate programmes</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Need guidance for scholarships and financial planning</h3>
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

        <h2 class="section-title">Benefits of Admission Assistance</h2>

        <div class="equal-width-grid three-grid">

           <div class="premium-card">
    <div class="p-icon"><i class="fas fa-user-tie"></i></div>
    <div class="p-text">
        <span>Expert guidance for university admissions abroad</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-list-check"></i></div>
    <div class="p-text">
        <span>Course and country-specific shortlisting</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-file-alt"></i></div>
    <div class="p-text">
        <span>Accurate application documentation</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-check-circle"></i></div>
    <div class="p-text">
        <span>Higher chances of offer letter success</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-clock"></i></div>
    <div class="p-text">
        <span>Time-saving and stress-free admission process</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-hands-helping"></i></div>
    <div class="p-text">
        <span>Personalised support at every stage of admission</span>
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
        <h2 class="title">Types of Admissions We Handle</h2>

        <div class="admissions-grid">
            <div class="admission-card">
                <i class="fas fa-user-graduate"></i>
                <h3>Undergraduate Admissions</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-graduation-cap"></i>
                <h3>Postgraduate Admissions</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-route"></i>
                <h3>Diploma &amp; Pathway Programmes</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-layer-group"></i>
                <h3>Foundation Courses</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-file-signature"></i>
                <h3>Direct &amp; Conditional Admissions</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-university"></i>
                <h3>Top-Ranked Public &amp; Private University Admissions</h3>
            </div>
        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Admission Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Profile Evaluation
                </h3>
                <p>Academic background, test scores, and career goals are assessed.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br />University Shortlisting
                </h3>
                <p>Best-fit universities and courses are shortlisted.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Application Preparation
                </h3>
                <p>All required documents are <br>reviewed and prepared.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br />Application Submission
                </h3>
                <p>Applications are submitted <br>accurately before deadlines.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Offer Letter Support
                </h3>
                <p>Guidance until admission <br>confirmation is received.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br />Pre-Visa & Next Steps Guidance
    </h3>
    <p>
        Support for further procedures<br> after receiving the offer <br>letter.
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
        <h2 class="title">Why Choose WTS for Getting Admission Abroad?</h2>

        <div class="steps steps-row">

            <div class="step_s">
                <i class="fas fa-user-tie"></i>
                <h3>Experienced admission consultants</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-globe-americas"></i>
                <h3>Country-specific expertise (UK, USA, Canada, Australia, Europe)</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-bullseye"></i>
                <h3>Transparent and student-focused guidance</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-handshake"></i>
                <h3>High admission success rate</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-passport"></i>
                <h3>Strong university network partnerships</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-chart-line"></i>
                <h3>End-to-end support from admission to visa stage</h3>
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
        ['question' => '1. How can I get admission to a foreign university?', 'answer' => 'Getting admission abroad involves selecting the right course and university, checking eligibility criteria, preparing required documents, submitting applications, and meeting deadlines. With expert guidance from WTS, students receive step-by-step support to simplify the entire process and improve their chances of acceptance.'],
         ['question' => '2.	When should I start applying for admission abroad?', 'answer' => 'It is recommended to start your study abroad application process at least 8–12 months before your preferred intake. Early planning allows sufficient time for university shortlisting, document preparation, English language tests, and visa processing.'],
        ['question' => '3.	 What documents are required for study abroad admission?', 'answer' => 'Common documents include academic transcripts, passport copy, Statement of Purpose (SOP), Letters of Recommendation (if required), English proficiency test scores (IELTS/PTE/TOEFL), CV, and portfolio (for specific courses). Requirements may vary depending on the university and programme.'],
        ['question' => '4.	Can I apply for undergraduate and postgraduate programmes through WTS?', 'answer' => 'Yes, WTS supports both undergraduate and postgraduate admissions, including diploma programmes, foundation courses, and pathway options based on student eligibility and career goals.'],
        ['question' => '5. Do I need IELTS or other English language tests for admission abroad?', 'answer' => 'Many universities require proof of English proficiency such as IELTS, TOEFL, or PTE. However, some universities offer admission without IELTS depending on academic background or alternative criteria. WTS helps identify suitable options based on your profile.'],
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