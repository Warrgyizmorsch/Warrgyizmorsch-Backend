@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Travel Arrangements for Study Abroad – Fly Stress-Free with WTS</h1>

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
            
            <p>WTS manages your travel plans, visa updates, and end-to-end support to ensure a smooth, stress-free journey from application to accommodation abroad.
            </p>

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

            <h2 class="ielts-overview-title">Travel Arrangements Overview</h2>

            <p class="ielts-overview-text">
                Travelling abroad for studies involves multiple steps, from booking flights to understanding visa timelines and arrival procedures. Students often search for travel arrangements for study abroad, student travel support, or study abroad travel assistance, but find the process overwhelming.
            </p>

            <p class="ielts-overview-text">
                WTS provides complete study abroad travel arrangement services, ensuring students travel safely and confidently with proper planning, timely updates, and expert support throughout the journey.
            </p>

        </div>

    </section>

{{-- End Course Section --}}

{{-- Course Selection Section --}}

<section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                 Designed for Students Preparing to Travel Abroad
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> Are preparing to travel abroad for studies</h3>
                    {{-- <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Need help with flight booking and travel planning</h3>
                    {{-- <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Want guidance on pre-departure travel requirements</h3>
                    {{-- <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Need coordinated support from visa approval to arrival</h3>
                    {{-- <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Prefer a smooth, well-planned travel experience</h3>
                    {{-- <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p> --}}
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Are travelling internationally for the first time</h3>
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

        <h2 class="section-title">  Key Benefits of Travel Arrangement Support</h2>

        <div class="equal-width-grid three-grid">

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-route"></i></div>
                <div class="p-text">
                    <span>End-to-end travel assistance for study abroad</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-plane-departure"></i></div>
                <div class="p-text">
                    <span>Guidance on best flight options and travel timing</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-passport"></i></div>
                <div class="p-text">
                    <span>Visa status updates and travel compliance checks</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="p-text">
                    <span>Reduced travel stress and last-minute confusion</span>
                </div>
            </div>

            <div class="premium-card">
                <div class="p-icon"><i class="fas fa-exchange-alt"></i></div>
                <div class="p-text">
                    <span>Smooth transition from departure to arrival</span>
                </div>
            </div>

             <div class="premium-card">
    <div class="p-icon"><i class="fas fa-user-shield"></i></div>
    <div class="p-text">
        <span>Expert advice on travel insurance and safety requirements</span>
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
        <h2 class="title">Services Covered Under Travel Arrangements</h2>

        <div class="admissions-grid">
            <div class="admission-card">
                <i class="fas fa-plane"></i> 
                <h3>Flight booking guidance</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-calendar-alt"></i> 
                <h3>Travel timeline planning</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-bell"></i> 
                <h3>Visa-related travel updates</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-list-check"></i>
                <h3>Pre-departure travel checklist</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-home"></i>
                <h3>Arrival and accommodation coordination</h3>
            </div>

            <div class="admission-card">
                <i class="fas fa-umbrella"></i>
                <h3>Travel insurance and airport pickup guidance</h3>
            </div>
        </div>
    </div>
</section>


 <!-- Static Services Section -->
<section class="new-home-service-section">
    <div class="container">
        <h2 class="new-section-title">
            Our Travel Arrangement Process
        </h2>

        <div class="new-home-service-grid">

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;1 <br />Travel Planning & Timeline Review
                </h3>
                <p>Visa status, intake dates, and <br>travel windows are reviewed.</p>
                <img src="/new-home-images/discussion.webp"
                     class="new-home-service-image"
                     style="bottom:-15px; right:-10px; height:160px; width:160px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;2 <br />Flight Guidance & Booking Support
                </h3>
                <p> Assistance with selecting <br>suitable flight options.</p>
                <img src="/new-home-images/diary.webp"
                     class="new-home-service-image"
                     style="height:100px; width:100px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;3 <br />Pre-Departure Checklist
                </h3>
                <p>Guidance on documents, baggage, <br>and travel essentials.</p>
                <img src="/new-home-images/smooth-transition.webp"
                     class="new-home-service-image"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;4 <br />Arrival & Accommodation Coordination
                </h3>
                <p>Support to ensure smooth <br>arrival and accommodation <br>setup.</p>
                <img src="/new-home-images/university.webp"
                     class="new-home-service-image"
                     style="height:140px; width:140px; border-bottom-right-radius:20px;"
                     alt="">
            </div>

            <div class="new-home-service-card">
                <h3 class="new-home-service-card-title">
                    Step&nbsp;5 <br />Ongoing Travel Support
                </h3>
                <p>Assistance continues until <br>students settle comfortably.</p>
                <img src="/new-home-images/studying.webp"
                     class="new-home-service-image"
                     style="bottom:-28px; right:-18px; height:180px; width:180px;"
                     alt="">
            </div>
            <div class="new-home-service-card">
    <h3 class="new-home-service-card-title">
        Step&nbsp;6 <br />Emergency & On-Arrival Assistance
    </h3>
    <p>
        Immediate support in case of <br>travel delays or initial <br>settlement issues.
    </p>
    <img src="/new-home-images/teaching.webp"
         class="new-home-service-image"
         style="height:115px; width:115px;  bottom:2px; right:3px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"
         alt="">
    </div>



        </div>
    </div>
</section>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->

        {{-- Course section  --}}

<section class="course-selection">
    <div class="container">
        <h2 class="title">Why Choose WTS for Travel Arrangements?</h2>

        <div class="steps steps-row">

            <div class="step_s">
                <i class="fas fa-user-tie"></i>
                <h3>Experienced study abroad travel consultants</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-users"></i>
                <h3>Student-focused travel planning approach</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-link"></i>
                <h3>Accurate coordination with visa and admissions</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-hands-helping"></i>
                <h3>Reliable support from departure to settlement</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-map-marked-alt"></i>
                <h3>Seamless integration with post-landing services</h3>
            </div>

            <div class="step_s">
                <i class="fas fa-map"></i>
                <h3>Personalised travel planning based on destination country</h3>
            </div>

        </div>
    </div>
</section>


@include('./components/cta-button')

@php
    $faqs = [
        ['question' => '1. What does travel arrangement support for study abroad include?', 'answer' => 'Travel arrangement support includes flight planning guidance, travel timeline coordination, pre-departure preparation, visa-related travel updates, and assistance to ensure a smooth journey from departure to arrival at your study destination.'],
         ['question' => '2.	 How does WTS help with student flight bookings?', 'answer' => 'WTS provides guidance on selecting suitable flight routes, travel dates, baggage rules, and cost-effective options based on your intake dates and visa status. We help students make informed travel decisions.'],
        ['question' => '3.	 When should I book my flight after receiving a study visa?', 'answer' => 'Flights are typically booked after visa approval to avoid complications. However, planning can begin earlier to identify the best travel options and timelines.'],
        ['question' => '4.	Does WTS provide a pre-departure checklist?', 'answer' => 'Yes, WTS offers a detailed pre-departure checklist covering travel documents, baggage essentials, accommodation confirmation, airport procedures, and arrival guidelines to ensure students are fully prepared.'],
        ['question' => '5. Can WTS help coordinate accommodation before arrival?', 'answer' => 'Yes, our team assists with coordinating accommodation arrangements and provides guidance to ensure students have confirmed housing before travelling.'],
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