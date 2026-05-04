@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Educational Loan for Study Abroad – Smart Financial Support with WTS</h1>

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
            
            <p>WTS helps you secure the right education loan with expert financial guidance, bank support, and end-to-end documentation assistance to make your study abroad journey stress-free.
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

            <h2 class="ielts-overview-title">Educational Loan Overview</h2>

            <p class="ielts-overview-text">
                Financing international education can be challenging without proper guidance. Students often search for education loan for study abroad, student loan for overseas education, or how to get an education loan, but face confusion around eligibility, interest rates, and bank procedures.
            </p>

            <p class="ielts-overview-text">
                WTS provides complete educational loan assistance for study abroad, helping students choose the right loan options, understand financial requirements, and complete bank documentation smoothly. The aim is to make education funding simple, transparent, and reliable.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Ideal Students for Education Loan Assistance
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Need education loan support for study abroad</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Want guidance on bank loan options for students</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Are unsure about loan eligibility or collateral requirements</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Need help with financial documents for visa and admission</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Want a stress-free loan application process</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Are looking for both secured and unsecured loan options</h3>
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

        <h2 class="section-title">Key Benefits of Educational Loan Assistance</h2>

        <div class="equal-width-grid three-grid">

           <div class="premium-card">
    <div class="p-icon"><i class="fas fa-user-tie"></i></div>
    <div class="p-text">
        <span>Expert guidance on study abroad education loans</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-building-columns"></i></div>
    <div class="p-text">
        <span>Support with bank and financial institution coordination</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-percent"></i></div>
    <div class="p-text">
        <span>Clear understanding of interest rates and repayment terms</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-file-alt"></i></div>
    <div class="p-text">
        <span>Complete documentation and application assistance</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-bolt"></i></div>
    <div class="p-text">
        <span>Faster and smoother loan approval process</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-scale-balanced"></i></div>
    <div class="p-text">
        <span>Comparison of multiple loan options to choose the best plan</span>
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
        <h2 class="title">Factors Considered for Education Loan Approval</h2>

        <div class="admissions-grid">

            <div class="admission-card">
    <i class="fas fa-university"></i>
    <h3>Course and university recognition</h3>
</div>

<div class="admission-card">
    <i class="fas fa-user-graduate"></i>
    <h3>Academic background and eligibility</h3>
</div>

<div class="admission-card">
    <i class="fas fa-wallet"></i>
    <h3>Loan amount and repayment capacity</h3>
</div>

<div class="admission-card">
    <i class="fas fa-lock"></i>
    <h3>Collateral and co-applicant requirements</h3>
</div>

<div class="admission-card">
    <i class="fas fa-file-invoice-dollar"></i>
    <h3>Country-specific financial norms</h3>
</div>

<div class="admission-card">
    <i class="fas fa-chart-pie"></i>
    <h3>Credit history and financial stability of co-applicant</h3>
</div>

        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Educational Loan Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Loan Eligibility Assessment
                </h3>
                <p>Student profile, course, and university are evaluated.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br />Bank & Loan Option Selection
                </h3>
                <p> Suitable banks and loan schemes are shortlisted.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Documentation Preparation
                </h3>
                <p> Academic, financial, and sponsor documents are organised.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br /> Loan Application & Follow-Up
                </h3>
                <p>Loan applications are submitted <br>and tracked with banks.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Loan Sanction Support
                </h3>
                <p> Assistance continues until loan <br>sanction and disbursement.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br /> Post-Sanction Guidance
    </h3>
    <p>
         Support with disbursement <br>process and financial <br>compliance for visa.
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
        <h2 class="title">Why Choose WTS for Educational Loan Assistance?</h2>

        <div class="steps steps-row">

           <div class="step_s">
    <i class="fas fa-user-tie"></i>
    <h3>Experienced education loan consultants</h3>
</div>

<div class="step_s">
    <i class="fas fa-building-columns"></i>
    <h3>Strong network with leading banks and NBFCs</h3>
</div>

<div class="step_s">
    <i class="fas fa-scale-balanced"></i>
    <h3>Transparent guidance with no hidden surprises</h3>
</div>

<div class="step_s">
    <i class="fas fa-hand-holding-usd"></i>
    <h3>Student-friendly financial counselling</h3>
</div>

<div class="step_s">
    <i class="fas fa-passport"></i>
    <h3>Support aligned with visa and admission needs</h3>
</div>

<div class="step_s">
    <i class="fas fa-award"></i>
    <h3>High success rate in education loan approvals</h3>
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
        ['question' => '1. What is an education loan for study abroad?', 'answer' => 'An education loan for study abroad is financial support provided by banks or financial institutions to cover tuition fees, living expenses, travel costs, and other study-related expenses for international education.'],
         ['question' => '2.	How does WTS help with education loan applications?', 'answer' => 'WTS provides expert guidance throughout the loan process, including eligibility assessment, selecting suitable banks, preparing documents, coordinating with lenders, and tracking the loan application until approval.'],
        ['question' => '3.	 Who is eligible for an education loan for overseas studies?', 'answer' => 'Eligibility depends on factors such as academic background, admission to a recognised university, course selection, repayment capacity, co-applicant profile, and sometimes collateral requirements. WTS helps evaluate your eligibility before applying.'],
        ['question' => '4.	Can I get an education loan without collateral?', 'answer' => 'Some banks and NBFCs offer unsecured education loans depending on the university ranking, course type, and student profile. WTS guides you on available options based on your eligibility.'],
        ['question' => '5. What expenses are covered under a study abroad education loan?', 'answer' => 'Education loans may cover tuition fees, accommodation, travel expenses, study materials, health insurance, and other related costs depending on the lender and loan scheme.'],
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