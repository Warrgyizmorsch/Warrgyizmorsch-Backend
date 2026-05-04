@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Post Landing Services for Study Abroad – Settle Confidently with WTS</h1>

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
            
            <p>WTS provides seamless post-landing assistance with expert guidance, visa updates, accommodation support, and 24/7 help to ensure your study abroad journey is smooth and successful.
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

            <h2 class="ielts-overview-title">Post Landing Services Overview</h2>

            <p class="ielts-overview-text">
                Reaching a new country is just the beginning of the study abroad journey. Students often search for post landing services for international students, after arrival support for study abroad, or student settlement services abroad but feel lost once they arrive.
            </p>

            <p class="ielts-overview-text">
                WTS offers complete post landing assistance for study abroad, helping students settle comfortably with accommodation guidance, local registrations, visa compliance, and everyday support. The focus is to reduce stress and help students adapt quickly to a new environment.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                 Ideal Students for Post-Landing Support Services
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Have recently arrived in a foreign country</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Need after arrival support for international students</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Want help with accommodation and local setup</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Need guidance on visa rules and registrations</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Want reliable support during the initial settling period</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Are travelling abroad for the first time and need extra guidance</h3>
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

        <h2 class="section-title">Key Benefits of Post Landing Assistance</h2>

        <div class="equal-width-grid three-grid">

            <div class="premium-card">
    <div class="p-icon"><i class="fas fa-plane-arrival"></i></div>
    <div class="p-text">
        <span>Smooth transition after arriving abroad</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-user-shield"></i></div>
    <div class="p-text">
        <span>Expert post arrival support for students</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-home"></i></div>
    <div class="p-text">
        <span>Help with accommodation and local processes</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-passport"></i></div>
    <div class="p-text">
        <span>Visa compliance and document guidance</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-headset"></i></div>
    <div class="p-text">
        <span>Ongoing support for peace of mind</span>
    </div>
</div>

<div class="premium-card">
    <div class="p-icon"><i class="fas fa-file-circle-check"></i></div>
    <div class="p-text">
        <span>Reduced risk of errors in local registrations and formalities</span>
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
        <h2 class="title">Services Covered Under Post Landing Support</h2>

        <div class="admissions-grid">

            <div class="admission-card">
    <i class="fas fa-plane-arrival"></i>
    <h3>Airport pickup guidance</h3>
</div>

<div class="admission-card">
    <i class="fas fa-bed"></i>
    <h3>Student accommodation assistance</h3>
</div>

<div class="admission-card">
    <i class="fas fa-sim-card"></i>
    <h3>Bank account and SIM setup</h3>
</div>

<div class="admission-card">
    <i class="fas fa-id-card"></i>
    <h3>Local registration and ID processes</h3>
</div>

<div class="admission-card">
    <i class="fas fa-file-contract"></i>
    <h3>Visa updates and compliance support</h3>
</div>

<div class="admission-card">
    <i class="fas fa-heartbeat"></i>
    <h3>Health insurance guidance and emergency support contacts</h3>
</div>

        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Post Landing Support Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Arrival Assistance & Guidance
                </h3>
                <p>Support starts immediately after <br>the student lands.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br /> Accommodation Support
                </h3>
                <p> Help with temporary or long-term <br>student accommodation.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Local Registration & Setup
                </h3>
                <p>Guidance on bank accounts, <br>SIM cards, and registrations.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br />Visa & Compliance Updates
                </h3>
                <p>Support with visa rules, extensions, <br>and local compliance.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Ongoing Student Support
                </h3>
                <p> 24/7 assistance during the <br>initial settlement phase.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br />Integration & Community Guidance
    </h3>
    <p>
        Support with understanding <br>local culture, transport, and<br> student communities.
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
        <h2 class="title">Why Choose WTS for Post Landing Services?</h2>

        <div class="steps steps-row">

            <div class="step_s">
    <i class="fas fa-users-cog"></i>
    <h3>Dedicated post landing support team</h3>
</div>

<div class="step_s">
    <i class="fas fa-hands-helping"></i>
    <h3>Student-focused and reliable assistance</h3>
</div>

<div class="step_s">
    <i class="fas fa-lightbulb"></i>
    <h3>Practical guidance for real-life challenges</h3>
</div>

<div class="step_s">
    <i class="fas fa-globe"></i>
    <h3>Strong understanding of international student needs</h3>
</div>

<div class="step_s">
    <i class="fas fa-route"></i>
    <h3>Continued support beyond admissions and visas</h3>
</div>

<div class="step_s">
    <i class="fas fa-layer-group"></i>
    <h3>End-to-end study abroad assistance under one roof</h3>
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
        ['question' => '1. What are post landing services for study abroad?', 'answer' => 'Post landing services are support services provided to students after they arrive in their study destination. These include accommodation guidance, local registrations, visa compliance support, and help with settling into a new country.'],
         ['question' => '2.	 How does WTS support students after arrival abroad?', 'answer' => 'WTS provides guidance on accommodation, airport arrival procedures, local registrations, bank account setup, SIM card activation, and ongoing support to help students adjust comfortably to their new environment.'],
        ['question' => '3.	 Is post landing support necessary for international students?', 'answer' => 'While not mandatory, post landing support helps reduce stress and confusion, especially for first-time international travellers who need assistance navigating local systems and requirements.'],
        ['question' => '4.	Can WTS help with student accommodation after arrival?', 'answer' => 'Yes, WTS assists students with finding suitable accommodation options, understanding rental processes, and ensuring a smooth transition into temporary or long-term housing.'],
        ['question' => '5. What local registrations might be required after arriving abroad?', 'answer' => 'Depending on the country, students may need to complete processes such as local address registration, biometric registration, student ID activation, or immigration reporting. WTS provides guidance based on destination-specific rules.'],
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