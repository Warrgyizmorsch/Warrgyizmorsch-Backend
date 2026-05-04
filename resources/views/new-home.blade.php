@extends('layouts.app')
@section('content')
    <script>
        window.countryData = @json($countries);
    </script>
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <script src="https://assets.calendly.com/assets/external/widget.js" async></script>
    
    <script>
        function openCalendly(e) {
            e.preventDefault();

            Calendly.initPopupWidget({
                url: 'https://calendly.com/wts-consultancy/30min'
            });
        }
    </script>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        let ytReady = false;
        function onYouTubeIframeAPIReady() {
            ytReady = true;
        }
    </script>

    @include('new-home-components.new-hero')

    <!-- Top Countries Section  -->
    <section class="new-countries-section">
        <div class="container">
            <h2 class="new-section-title">Top Countries for Higher Education</h2>

            <div class="new-countries-container">
                {{-- Left: main display (first country by default) --}}
                @php $firstKey = array_key_first($countries); @endphp
                <div class="new-country-main">
                    <img id="countryImage" src="{{ asset($countries[$firstKey]['image']) }}"
                        alt="{{ $countries[$firstKey]['name'] }}" class="new-main-img">

                    <div class="new-country-features">
                        <ul id="countryFeatures">
                            @foreach($countries[$firstKey]['features'] as $f)
                                <li style="display: flex; align-items: center; gap: 8px;"><img
                                        src="/new-home-images/svg-icons/check-circle.svg" alt="check-circle"
                                        style="height: 20px;"> {{ $f }}</li>
                            @endforeach
                        </ul>
                        <a id="exploreBtn" href="/course-finder" style="text-decoration: none;">
                            <button class="explore-btn" >Explore Courses Now<img
                                src="/new-home-images/svg-icons/majesticons_arrow-up.svg"
                                style="height: 32px; margin-left: -6px;" alt=""></button>
                        </a>
                    </div>
                </div>

                {{-- Right: clickable country list --}}
                <div class="new-country-list-wrapper">
                    <div class="new-country-list" id="countryList">
                        @foreach($countries as $key => $c)
                            <div class="new-country-card {{ $loop->first ? 'active' : '' }}" data-country="{{ $key }}">
                                <img src="{{ asset($c['thumb']) }}" alt="{{ $c['name'] }}">
                                <div>
                                    <h3>{{ $c['name'] }}</h3>
                                    <p>{{ $c['subtittle'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="scroll-dots" id="scrollDots"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Video Section  -->
    <section class="hero-video-section">
        <h2 class="new-section-title">Shaping a Brighter Future with WTS</h2>
        <div class="hero-video-wrapper">
            <video class="hero-video" controls muted {{-- allow autoplay without user gesture --}} playsinline
                preload="metadata" poster="{{ asset('new-home-images/wts-video-thumbnail.png') }}">
                <source src="{{ asset('new-home-images/WTS_Video.mp4') }}" type="video/mp4">
            </video>
            <!-- <img src="/new-home-images/wts-logo.png" class="absolute-logo" style="" alt="">
            <img src="/new-home-images/strip.webp" class="absolute-strip-img" alt=""> -->
        </div>
    </section>

    <style>
        .hero-video-section {
            width: 100%;
            margin: 0 auto;
            padding: 20px 35px;
            background: #fff;
            max-width: 1300px;
        }

        .hero-video-wrapper {
            position: relative;
        }

        .hero-video {
            width: 100%;
            height: 500px;
            object-fit: fill;
            border-radius: 20px; !important
            box-shadow: 0 2px 25px 0 rgba(0, 0, 0, 0.29);
            display: block;
            background: black;
            padding: 25px 130px;
            transition: all 0.2s ease-in-out;
        }

        .hero-video:hover {
            border-radius: 20px;
        }

        .absolute-logo {
            position: absolute;
            top: 7%;
            left: 5%;
            height: 50px;
            transform: rotate(-10deg);
        }

        .absolute-strip-img {
            position: absolute;
            bottom: 23%;
            right: 3%;
        }

        @media (max-width: 900px) {
            .hero-video {
                padding: 25px 80px;
            }
        }

        @media (max-width: 550px) {
            .hero-video {
                height: 250px !important;
                padding: 10px 30px;
            }

            .absolute-logo {
                position: absolute;
                top: -7%;
                left: -5%;
                height: 50px;
                transform: rotate(-10deg);
            }

            .absolute-strip-img {
                position: absolute;
                bottom: 5% !important;
                right: 0 !important;
            }
        }

        @media (max-width: 768px) {
            .hero-video {
                height: 300px;
            }

            .absolute-strip-img {
                position: absolute;
                bottom: 8%;
                right: 5%;
            }

            .hero-video-section {
                padding: 20px 15px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.querySelector('.hero-video');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Load if not already, then play
                        if (video.paused) video.play().catch(() => { });
                    } else {
                        // Pause when out of view
                        if (!video.paused) video.pause();
                    }
                });
            }, { threshold: 0.5 }); // play only when at least 50% visible

            observer.observe(video);
        });
    </script>

    <!-- Stand Out with Our Exclusive Student Support Services -->
    <section class="student-support">
        <div class="container">
            <h2 class="new-section-title" style="color: black;">
                Stand Out with Our Exclusive Student Support Services
            </h2>

            <div class="support-grid">
                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">01.</span> University Virtual Tour</h3>
                    <p class="support-text">
                        Experience immersive virtual tours of top universities from the comfort of your home.
                        Explore campus life, facilities, and classrooms as if you were really there.
                    </p>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">02.</span> Airport Pickup Service</h3>
                    <p class="support-text">
                        Forget the stress of navigating transport. Our reliable airport pickup service ensures
                        you reach your new home safely, hassle-free, and on time.
                    </p>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">03.</span> Alumni Student Discussions</h3>
                    <p class="support-text">
                        Gain firsthand insights and valuable advice from alumni students who’ve experienced studying abroad.
                        Make informed decisions from real stories.
                    </p>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">04.</span>Part-Time Job Assistance</h3>
                    <p class="support-text">
                        We help you find part-time job opportunities that fit your study schedule, so you can support your
                        stay and gain work experience while pursuing your dreams.
                    </p>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">05.</span> Accommodation Support</h3>
                    <p class="support-text">
                        Finding the right place is easy with our expert support. We help you secure safe, affordable, and
                        comfortable accommodation near your university.
                    </p>
                </div>

                <div class="support-item">
                    <h3 class="support-heading"><span class="number-badge">06.</span> Student Loan Assistance</h3>
                    <p class="support-text">
                        Our experts help you navigate student loan options, paperwork, and approvals — so you can focus on
                        your education, not
                        the finances.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Testimonials  -->
    <section class="video-gallery-section">
        <div class="container">
            <h2 class="new-section-title">Testimonials</h2>

            <!-- Swiper -->
            <div class="swiper video-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $index => $video)
                        @php
                            $videoId = Str::afterLast($video->url, '/');
                            $loadingAttr = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
                        @endphp
                        <div class="swiper-slide">
                            <div class="video-card">
                                <div class="video-wrapper">
                                    <div class="youtube-facade" data-video-id="{{ $videoId }}"
                                        data-image="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                        onclick="loadYoutube(this)">
                                        <img src="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                            {!! $loadingAttr !!} alt="{{ $video->title }}">

                                        <!-- Play Button -->
                                        <button class="video-play-btn" aria-label="Play testimonial video"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Custom Navigation -->
                <button class="custom-swiper-prev"><img src="/new-home-images/svg-icons/right-arrow.svg" style="transform: rotate(180deg); height: 20px;" alt="left-arrow"></button>
                <button class="custom-swiper-next"><img src="/new-home-images/svg-icons/right-arrow.svg" style="height: 20px;" alt="right-arrow"></button>
            </div>
        </div>
    </section>

    <!-- Want Study Abroad Guide ? -->
    <section class="study-guide-section" style="overflow-x: hidden">
        <div class="study-guide-container">
            <div class="study-guide-content">
                <h2 style="font-weight: 600;">Find the Best Foreign Education Consultants for Your Study Abroad Journey</h2>
                <p>Connect with experienced foreign education consultants to explore top universities, check eligibility, compare courses, and get expert guidance for your international education - all in one place.
                </p>
                <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal" style="text-decoration: none;">
                    Book a Free consultation
                    <span>➜</span>
                </a>
                <!-- <button class="study-guide-button" onclick="openRegistrationModal(event)">
                    Book an Appointment
                    <span>➜</span>
                </button> -->
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
            </div>
        </div>
    </section>

    <!-- Top Universities -->



<!-- Meet Our Counsellors Section -->

<section class="counsellor-section">

<style>

.counsellor-section{
text-align:center;
}

.counsellor-section .sub{
color:#555;
max-width:720px;
margin:0 auto 45px;
font-size:16px;
line-height:1.6;
}

/* GRID */

.counsellor-wrap{
display:flex;
flex-wrap:wrap;
gap:30px;
justify-content:center;
}

/* CARD */

.counsellor-card{
width:380px;
min-height:400px;
background:#fff;
border-radius:18px;
padding:30px 25px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
position:relative;
transition:all .35s ease;
}

.counsellor-card:hover{
transform:scale(1.05);
box-shadow:
0 0 0 2px rgba(0,123,255,.2),
0 15px 40px rgba(0,0,0,.18);
}

/* BADGE */

.badge{
position:absolute;
top:18px;
right:18px;
background:#cfd8ee;
color:#18336c;
padding:5px 12px;
border-radius:14px;
font-size:13px;
}

/* IMAGE */

.counsellor-img{
width:90px;
height:90px;
border-radius:50%;
margin:0 auto 12px;
object-fit:cover;
display:block;
}

/* TEXT */

.counsellor-name{
font-weight:600;
font-size:18px;
}

.counsellor-role{
color:#777;
font-size:14px;
margin-bottom:6px;
}

.counsellor-desc{
font-size:14px;
margin:12px 0;
color:#555;
line-height:1.5;
}

/* META */

.counsellor-meta{
display:flex;
justify-content:space-around;
margin:18px 0;
font-size:14px;
}

/* BUTTON */

.counsellor-section .study-guide-button{
background:#F7941F;
border:none;
color:#fff;
padding:10px;
font-size:1rem;
font-weight:700;
border-radius:8px;
cursor:pointer;

display:block;
width:100%;
text-align:center;

position:relative;
overflow:hidden;
transition:all 0.4s ease;
box-shadow:0 4px 12px rgba(247,148,31,0.4);

text-decoration:none;
}

/* Shine Effect */

.counsellor-section .study-guide-button::before{
content:"";
position:absolute;
top:0;
left:-100%;
width:100%;
height:100%;
background:rgba(255,255,255,0.25);
transform:skewX(-20deg);
transition:0.6s;
}

.counsellor-section .study-guide-button:hover{
transform:translateY(-3px) scale(1.03);
box-shadow:0 8px 20px rgba(247,148,31,0.6);
}

.counsellor-section .study-guide-button:hover::before{
left:200%;
}

.container{
max-width:1280px;
margin:0 auto;
padding:0 16px;
}

/* LARGE SCREEN */

@media(max-width:1200px){
.counsellor-card{
width:340px;
}
}

/* TABLET */

@media(max-width:992px){
.counsellor-card{
width:46%;
}
}

/* MOBILE FIX */

@media(max-width:600px){

.counsellor-section .sub{
font-size:14px;
margin-bottom:30px;
}

.counsellor-card{
width:100%;
min-height:auto;
padding:25px 20px;
}

/* IMAGE */

.counsellor-img{
width:80px;
height:80px;
}

/* BADGE FIX (FACE COVER NA HO) */

.badge{
position:static;
display:inline-block;
margin-bottom:10px;
}

}

</style>

<div class="container">

<div class="section-head">
<h2 class="new-section-title visible">Meet Our Counsellors</h2>
</div>

<div class="counsellor-wrap">

<!-- CARD 1 -->

<div class="counsellor-card">
<span class="badge">Senior Counsellor</span>

<img src="/images/universities/Dhara.png" class="counsellor-img">

<div class="counsellor-name">Dhara</div>
<div class="counsellor-role">Study Abroad Counsellor</div>

<p class="counsellor-desc">
Helping students choose the right universities and guiding them through the complete admission process.
</p>

<div class="counsellor-meta">
<span>⭐ 5<br>52 Reviews</span>
<span>3000+<br>Students Guided</span>
</div>

<a href="javascript:void(0)" class="study-guide-button" onclick="openRegistrationModal(event)">
Book FREE Counselling
</a>

</div>

<!-- CARD 2 -->

<div class="counsellor-card">
<span class="badge">Senior Counsellor</span>

<img src="/images/universities/Afrin.png" class="counsellor-img">

<div class="counsellor-name">Afrin</div>
<div class="counsellor-role">Study Abroad Counsellor</div>

<p class="counsellor-desc">
Expert in student counselling with years of experience helping students achieve their global education dreams.
</p>

<div class="counsellor-meta">
<span>⭐ 5<br>65 Reviews</span>
<span>4500+<br>Students Guided</span>
</div>

<a href="javascript:void(0)" class="study-guide-button" onclick="openRegistrationModal(event)">
Book FREE Counselling
</a>

</div>

<!-- CARD 3 -->

<div class="counsellor-card">
<span class="badge">Senior Counsellor</span>

<img src="/images/universities/Rishita.png" class="counsellor-img">

<div class="counsellor-name">Rishita</div>
<div class="counsellor-role">Study Abroad Counsellor</div>

<p class="counsellor-desc">
Guiding students with university selection, application support and visa process for studying abroad.
</p>

<div class="counsellor-meta">
<span>⭐ 4.9<br>57 Reviews</span>
<span>5000+<br>Students Guided</span>
</div>

<a href="javascript:void(0)" class="study-guide-button" onclick="openRegistrationModal(event)">
Book FREE Counselling
</a>

</div>

</div>
</div>

</section>

    <!-- Our Affiliates -->
    <section class="affiliates-section">
        <div class="container">
            <h2 class="new-section-title">Our Affiliates</h2>

            <div class="affiliate-marquee">
                <!-- 1st row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2nd row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3rd row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4th row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8 Steps  -->
    <section class="new-steps-wrapper">
        <h2 class="new-section-title">8 Steps to Your Dream Destination</h2>

        <div class="new-steps-container">
            <div class="new-accordion">
                <div class="new-item" data-img="/images/trusted-comp-img/profileEval.webp">
                    <button class="new-header">Profile Evaluation</button>
                    <div class="new-content">Send us your academic documents & resume</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/University_shortlisting.webp">
                    <button class="new-header">University Shortlisting</button>
                    <div class="new-content">Get tailored options based on your profile</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/application_process.webp">
                    <button class="new-header">Application Process</button>
                    <div class="new-content">We help gather your personal documents & apply</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/offer_letter.webp">
                    <button class="new-header">Offer Letters</button>
                    <div class="new-content">Track conditional & unconditional offers</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/financial_deposit.webp">
                    <button class="new-header">Initial Deposit & Financial Docs</button>
                    <div class="new-content">Guided fund prep for CAS</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/cas_issue.webp">
                    <button class="new-header">CAS Issuance</button>
                    <div class="new-content">UWe ensure you meet every requirement</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/medical-test.webp">
                    <button class="new-header">Medical Test & VISA Filing</button>
                    <div class="new-content">Done with expert support</div>
                </div>
                <div class="new-item" data-img="/images/trusted-comp-img/flight_booking.webp">
                    <button class="new-header">Flight Bookings & Beyond</button>
                    <div class="new-content">You're all set to fly!</div>
                </div>
                <div style="margin-top: 40px;">
                    <button class="study-guide-button" onclick="openRegistrationModal(event)">Apply Now</button>
                </div>
            </div>

            <div class="new-image-box">
                <div class="new-image-box-outer">
                    <img id="new-stepImage" src="/new-home-images/8step.webp" alt="Step Image">
                </div>
            </div>
        </div>

    </section>

    <!-- Smooth Transition -->
    <section class="new-smooth-section">
        <div class="container">
            <h2 class="new-section-title">Smooth transition to your New Country</h2>

            <div class="new-smooth-wrapper">
                <div class="new-smooth-cards">
                    <div class="new-smooth-card">
                        <img src="/new-home-images/smooth1.webp" alt="Application & Offer Letter" class="new-smooth-icon">
                        <p class="new-smooth-text">Application & <br> Offer Letter</p>
                    </div>
                    <div class="new-smooth-card">
                        <img src="/new-home-images/smooth2.webp" alt="Fees & Finances" class="new-smooth-icon">
                        <p class="new-smooth-text">Fees & <br> Finances</p>
                    </div>
                    <div class="new-smooth-card">
                        <img src="/new-home-images/smooth3.webp" alt="Visa and Fly Ticket" class="new-smooth-icon">
                        <p class="new-smooth-text">Visa and Fly <br> Ticket</p>
                    </div>
                </div>

                <div class="new-smooth-image">
                    <img src="/new-home-images/smooth-transition.webp" alt="Scholar Cap Image" class="new-smooth-mainimg">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Slider -->
    <section class="choose-section-wrapper">
        <div class="choose-left-content">
            <h2 class="new-section-title" style="margin-bottom: 30px !important;">Why Choose US?</h2>
            <div class="choose-point-wrapper" id="point-wrapper">
                <h3 id="point-title" class="choose-point-title">12+ Years of Study Abroad Experience</h3>
                <p id="point-desc" class="choose-point-desc">
                    WTS guides international students in admissions,
                    visas, and scholarships, ensuring smooth processes and successful
                    placements.
                </p>
            </div>
            <button class="study-guide-button js-open-custom-study-modal" style="margin-top: 20px; font-weight: 500;">Get a Free Consultation!</button>
        </div>

        <div class="choose-right-slider">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-title="12+ Years of Study Abroad Experience"
                        data-desc="With over a decade of experience, WTS Visa Consultancy knows what international students face. Our consultants remain aware of university admissions, visa regulations and scholarship opportunities to provide you with the latest information.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">12+ Years of Study Abroad Experience</p>
                            <img src="/new-home-images/choose1.webp" class="choose-slide-img" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide" data-title="Thousands of Students Placed in Top Universities"
                        data-desc="We have placed thousands of students in top universities in the US, UK, Canada, Australia, and other countries. It is through understanding each of our students' academic past and professional future that we become successful.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Thousands of Students Placed in Top Universities</p>
                            <img src="/new-home-images/choose2.webp" class="choose-slide-img" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide" data-title="Parents & Students Worldwide Trust Us"
                        data-desc="Families across the globe trust WTS Visa Consultancy for our transparent process, ethical guidance, and proven results. We treat each student’s future as if it were our own.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Parents & Students Worldwide Trust Us</p>
                            <img src="/new-home-images/choose3.webp" class="choose-slide-img" style="height: 250px;" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide" data-title="Counseling Sessions"
                        data-desc="We provide personalized counseling sessions to help students identify the best course, university, and country based on their academic background, budget, and career goals.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Counseling Sessions</p>
                            <img src="/new-home-images/choose4.webp" class="choose-slide-img" style="height: 250px;" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide" data-title="Accommodation Support"
                        data-desc="Finding a safe and affordable place to live abroad can be challenging. We assist students in securing suitable accommodation options near their universities.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Accommodation Support</p>
                            <img src="/new-home-images/choose5.webp" class="choose-slide-img" style="height: 250px;" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide" data-title="Part-Time Job Assistance"
                        data-desc="Many students prefer part-time work while studying. We guide you in finding legal part-time job opportunities to help cover living expenses and gain international work experience.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Part-Time Job Assistance</p>
                            <img src="/new-home-images/choose6.webp" class="choose-slide-img" style="height: 250px;" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide" data-title="Airport Pickup Service"
                        data-desc="Arriving in a new country can be overwhelming. Our airport pickup service ensures that students are welcomed and safely transported to their accommodation.">
                        <div class="choose-slide-box">
                            <p class="choose-slide-title">Airport Pickup Service</p>
                            <img src="/new-home-images/choose7.webp" class="choose-slide-img" style="height: 250px;" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered navigation buttons -->
            <div class="choose-nav-buttons">
                <div class="swiper-button-prev">
                    <img src="/new-home-images/svg-icons/arrow-left-circle.svg" alt="Previous" />
                </div>
                <div class="swiper-button-next">
                    <img src="/new-home-images/svg-icons/arrow-right-circle.svg" alt="Next" />
                </div>
            </div>
        </div>
    </section>

    <style>
        .choose-section-wrapper {
            display: flex;
            /* align-items: center; */
            justify-content: space-between;
            max-width: 1300px;
            margin: 0 auto;
            padding: 50px 35px;
            gap: 40px;
            flex-wrap: nowrap;
        }

        .choose-left-content {
            flex: 1 1 50%;
            min-width: 280px;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .choose-right-slider {
            flex: 1 1 40%;
            min-width: 300px;
        }

        .choose-point-wrapper {
            transition: height 0.5s ease;
            overflow: hidden;
        }

        .choose-point-title {
            font-weight: 600;
            font-size: 1.7rem;
            color: #1C2C59;
            line-height: 1.2;
            margin-bottom: 6px;
        }
        /* Slide box */
        .choose-slide-box {
            border: 1px solid black;
            border-radius: 25px;
            padding: 20px;
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .choose-slide-title {
            font-weight: 600;
            text-align: center;
            font-size: 22px;
            margin: 0;
        }

        .choose-slide-img {
            height: 210px;
            width: 100%;
            position: absolute;
            object-fit: cover;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        /* Swiper core */
        .swiper {
            overflow: hidden;
        }

        /* Centered nav buttons */
        .choose-nav-buttons {
            text-align: center;
            margin-top: -20px;
            gap: 10px;
        }

        .choose-nav-buttons .swiper-button-prev,
        .choose-nav-buttons .swiper-button-next {
            position: static;
            display: inline-block;
            margin: 0 10px;
            color: #18336c;
            cursor: pointer;
        }

        .choose-nav-buttons .swiper-button-prev::after,
        .choose-nav-buttons .swiper-button-next::after {
            display: none;
        }

        .choose-nav-buttons img {
            width: 50px;
            height: 50px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .choose-section-wrapper {
                flex-direction: column;
                gap: 30px;
                padding: 10px 15px;
            }

            .choose-left-content,
            .choose-right-slider {
                flex: 1 1 100%;
            }

            .choose-nav-buttons {
                justify-content: center;
            }

            .choose-slide-img {
                height: 240px;
                object-fit: contain;
            }
        }

        @media (max-width: 420px) {
            .choose-slide-img {
                object-fit: cover;
            }
        }

        .choose-right-slider,
        .mySwiper {
            width: 100%;
        }

        .swiper-wrapper {
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .swiper-slide {
                width: 100% !important;
            }
        }
    </style>

    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1.5,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 16 },
                768: { slidesPerView: 1.5, spaceBetween: 20 },
                960: { slidesPerView: 1.7, spaceBetween: 24 }
            },
            on: {
                activeIndexChange: function () {
                    updateContent(this);
                }
            }
        });

        function updateContent(sw) {
                const activeSlide = sw.slides[sw.activeIndex];
                if (!activeSlide) return;

                const wrapper = document.getElementById('point-wrapper');
                const titleEl = document.getElementById('point-title');
                const descEl = document.getElementById('point-desc');

                // Measure current height before change
                const startHeight = wrapper.offsetHeight;

                // Apply burst-out
                titleEl.style.transform = "scale(0.8)";
                titleEl.style.opacity = 0;
                descEl.style.transform = "scale(0.8)";
                descEl.style.opacity = 0;

                setTimeout(() => {
                    // Update new text
                    titleEl.textContent = activeSlide.dataset.title;
                    descEl.textContent = activeSlide.dataset.desc;

                    // Measure new height
                    wrapper.style.height = "auto";
                    const endHeight = wrapper.offsetHeight;

                    // Reset to old height then animate to new
                    wrapper.style.height = startHeight + "px";
                    requestAnimationFrame(() => {
                        wrapper.style.height = endHeight + "px";
                    });

                    // Burst-in effect
                    titleEl.style.transform = "scale(1)";
                    titleEl.style.opacity = 1;
                    descEl.style.transform = "scale(1)";
                    descEl.style.opacity = 1;

                    // Reset wrapper height after transition
                    setTimeout(() => {
                        wrapper.style.height = "auto";
                    }, 500);
                }, 300); // delay matches burst-out
            }



    </script>



    <!-- New Journey  -->
    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Start Your Journey Today!</h2>
            <p>Start with WTS Study Abroad Consultants today. Plan ahead to research options, enhance
                your application and find funding. Our consultants will assist you to hit deadlines, study for exams and
                coordinate documents effortlessly. With a plan you can confidently realize your academic aspirations.</p>
        </div>

        <div class="new-journey-grid">
            <a href="/services/free-profile-evaluation" class="new-journey-card">
                <div class="new-journey-card-image">
                    <img src="/new-home-images/free-consultation.webp" alt="Free Consultation">
                    <span class="new-journey-card-icon"><img src="/new-home-images/svg-icons/majesticons_arrow-up.svg"
                            style="height: 32px" alt=""></span>
                    <h3 class="new-journey-card-title">Free Consultation</h3>
                </div>
            </a>

            <a href="/services/getting-admission" class="new-journey-card">
                <div class="new-journey-card-image">
                    <img src="/new-home-images/virtual-tour.webp" alt="Virtual Tour">
                    <span class="new-journey-card-icon"><img src="/new-home-images/svg-icons/majesticons_arrow-up.svg"
                            style="height: 32px" alt=""></span>
                    <h3 class="new-journey-card-title">Virtual Tours to Your Dream University</h3>
                </div>
            </a>

            <a href="/services/counseling-with-an-expert" class="new-journey-card">
                <div class="new-journey-card-image">
                    <img src="/new-home-images/alumni-session.webp" alt="Alumni Session">
                    <span class="new-journey-card-icon"><img src="/new-home-images/svg-icons/majesticons_arrow-up.svg"
                            style="height: 32px" alt=""></span>
                    <h3 class="new-journey-card-title">One-on-One Session with Alumni Students</h3>
                </div>
            </a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="new-home-service-section">
        <div class="container">
            <h2 class="new-section-title">
                Our Services: From Course Selection to Post-Arrival Support
            </h2>

            <div class="new-home-service-grid">
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;1 <br />Counselling with an Expert
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/discussion.webp" class="new-home-service-image" style="bottom: -15px; right: -10px; height: 160px; width: 160px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;2 <br />Free Profile Evaluation
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/diary.webp" class="new-home-service-image" style="height: 100px; width: 100px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;3 <br />Course Selection
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/smooth-transition.webp" class="new-home-service-image" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;4 <br />Admission
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/university.webp" class="new-home-service-image" style="height: 140px; width: 140px; border-bottom-right-radius: 20px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;5 <br />SOP
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/studying.webp" class="new-home-service-image" style="bottom: -28px; right: -18px; height: 180px; width: 180px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;6 <br />Mock Interviews
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/teaching.webp" class="new-home-service-image" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;7 <br />Travel Arrangements
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/plane-go.webp" class="new-home-service-image" style="bottom: -24px; height: 160px; width: 160px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;8 <br />Visa Assistance
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/pass-visa.webp" class="new-home-service-image" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;9 <br />Post Landing Services
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/scholar-blue.webp" class="new-home-service-image" style="bottom: -10px;" alt="Decorative">
                </div>
            </div>
        </div>

        <!-- Modal Overlay -->
        <div class="new-service-modal-overlay"></div>

        <!-- Modal -->
        <div class="new-service-modal">
            <button class="new-service-close">&times;</button>
            <div class="new-service-content">
                <h3 class="new-service-title" style="margin: 0;"></h3>
                <p class="new-service-text">
                    Detailed information about the selected service will appear here.
                </p>
            </div>
        </div>

    </section>


    <!-- FAQ Section -->
    <section class="new-faq-section">
        <div class="new-faq-container">
            <div class="new-faq-left">
                <h3 class="new-section-title">Have a Question?</h3>
                <p class="new-faq-text">
                    Have a question or need visa advice?<br>
                    Our experts are here to guide you - just reach out.
                </p>
                <div class="new-faq-graphic">
                    <img src="/new-home-images/faq-image2.jpeg" style="border-top-right-radius: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%;" alt="FAQ Graphic" />
                </div>
            </div>

            <div class="new-faq-right">
                <div class="new-faq-accordion">
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How Do I Select the Best Country to Study Abroad?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Your academic objective, career aspirations and personal interest
                            depend on selecting the best destination. Investigate
                            the standard of education, cost of living and overall culture of every nation. Approach an
                            expert and get your choices
                            aligned with your long-term professional objectives.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">What are the Preconditions for Studying Abroad? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Admission criteria differ by country and institution. Typical
                            requirements are academic transcripts, language
                            proficiency tests (such as IELTS or TOEFL), and statement of purpose and recommendation letters.
                            Some programs will also
                            require entrance exams.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How can I apply for Scholarships? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                        <div class="new-faq-content">Begin by investigating scholarship opportunities provided by
                            universities, governments and private agencies. Read and
                            fully understand the eligibility requirements and timelines. Develop a good application with a
                            good personal statement
                            and supporting materials.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">Which Country is Best for My Studies Abroad? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Cost differs according study visa apply to country, university and
                            lifestyle. Fees cost between a few thousand to tens
                            of thousands of dollars per year. Living accommodation, eating, travelling and insurance are
                            other costs. Scholarships
                            and student financial aid may minimize the cost.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How Much Does it Cost? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                        <div class="new-faq-content">Cost differs according study visa apply to country, university and
                            lifestyle. Fees cost between a few thousand to tens
                            of thousands of dollars per year. Living accommodation, eating, travelling and insurance are
                            other costs. Scholarships
                            and student financial aid may minimize the cost.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">Which Scholarships for International Students? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Fulbright Program (USA), Chevening Scholarships (United Kingdom), DAAD
                            Scholarships (Germany) and Australia Awards are
                            some of the best available scholarships. Universities also provide need-based and merit-based
                            scholarships. Research in
                            advance to fulfil deadlines for applications.</div>
                    </div>
                </div>
                <div style="display: flex; width: 100%; margin-left: auto; justify-content: end;">
                    <a href="#" class="new-faq-viewall">View All</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="new-cta-section">
        <div class="new-cta-container">
            <div class="new-cta-content">
                <h3 class="new-cta-title">
                    Get Ready to <br />Begin Your Journey
                </h3>
                <p class="new-cta-text">
                    Start your educational adventure with expert guidance and personalized support.
                </p>
                <button class="study-guide-button" style="font-weight: 500;" onclick="openRegistrationModal(event)">Get a Free Consultation!</button>
            </div>

            <div class="new-cta-image-wrapper">
                <img src="/new-home-images/cta-image.png" class="new-cta-image" alt="Get Ready Image">
            </div>
        </div>
    </section>

    @if(isset($blogs) && $blogs->count() > 0)
        @include('new-home-components.new-blog')
    @endif


    <!-- Registration Modal -->
    <div id="registrationModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeRegistrationModal()">&times;</span>
            @include('components.registration-form')
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            overflow: auto;
        }

        .modal-content {
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .close-modal {
            color: #ffcc00;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 10px;
        }

        .close-modal:hover {
            color: #ffa500;
        }

        @media (max-width: 768px) {
            .modal-content {
                margin: 25% auto;
                width: 95%;
            }
        }
    </style>
    <script>
        function openRegistrationModal(event) {
            event.preventDefault();
            document.getElementById('registrationModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            var modal = document.getElementById('registrationModal');
            if (event.target == modal) {
                closeRegistrationModal();
            }
        }
    </script>
@endsection
