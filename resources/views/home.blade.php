@extends('layouts.app')
@section('content')

    @include('hero')

        <!-- Add in your <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


        @php
    $videos = [
        (object) ['url' => 'https://www.youtube.com/embed/oIs1m_LZlws', 'title' => 'Abid Review'],
        (object) ['url' => 'https://www.youtube.com/embed/2kDdTVhVGpk', 'title' => 'Deepali Review'],
        (object) ['url' => 'https://www.youtube.com/embed/v5guUOX7ANM', 'title' => 'Abhishek Review'],
        (object) ['url' => 'https://www.youtube.com/embed/z6S02ntwcQI', 'title' => 'Sumandeep Review'],
        (object) ['url' => 'https://www.youtube.com/embed/h7x-BRbPco4', 'title' => 'Ayushi Review'],
        (object) ['url' => 'https://www.youtube.com/embed/mWNsU_SSenY', 'title' => 'Prakhar Review'],
        (object) ['url' => 'https://www.youtube.com/shorts/iLsffDOBQHw', 'title' => 'Amit Zala'],
        (object) ['url' => 'https://www.youtube.com/shorts/kjFZQJXYujI', 'title' => 'Student Review'],
        (object) ['url' => 'https://www.youtube.com/shorts/-8m6MXZG0sQ', 'title' => 'Sajay'],
    ];
    $firstVideoId = Str::afterLast($videos[0]->url, '/');
        @endphp
        

{{-- @include('components.course-details') --}}

    <section class="countries-section">
        <div class="container">
            <h2>Top Countries for Higher Education</h2>
            <div class="country-card-container">
                <div class="country-card">
                    <img src="images/uk.webp" loading="lazy"  alt="UK">
                    <div class="country-info">
                        <h3>United Kingdom</h3>
                        <ul class="country-features">
                            <li>World-class universities</li>
                            <li>Rich academic heritage</li>
                            <li>Global exposure</li>
                            <li>Fast-track student visas</li>
                            <li>Strong alumni network</li>
                            <li>High employability</li>
                            <li>English-speaking environment</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/us.webp" loading="lazy"  alt="USA">
                    <div class="country-info">
                        <h3>USA</h3>
                        <ul class="country-features">
                            <li>Top-ranked institutions</li>
                            <li>Research-driven education</li>
                            <li>Innovation & entrepreneurship</li>
                            <li>Diverse campus life</li>
                            <li>STEM OPT extension</li>
                            <li>Flexible course structure</li>
                            <li>Global career opportunities</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/france.webp" loading="lazy"  alt="France">
                    <div class="country-info">
                        <h3>France</h3>
                        <ul class="country-features">
                            <li>Affordable tuition fees</li>
                            <li>Scholarships for international students</li>
                            <li>English-taught programs</li>
                            <li>Rich cultural experience</li>
                            <li>Fashion & art capital</li>
                            <li>Business school excellence</li>
                            <li>Access to Schengen countries</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/australia.webp" loading="lazy"  alt="Australia">
                    <div class="country-info">
                        <h3>Australia</h3>
                        <ul class="country-features">
                            <li>High-quality education system</li>
                            <!-- <li>Post-study work visa</li> -->
                            <li>Safe and welcoming environment</li>
                            <li>Paid part-time work options</li>
                            <li>Beautiful landscapes & lifestyle</li>
                            <li>Strong Indian student community</li>
                            <li>Skilled migration pathway</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/germany.webp" loading="lazy"  alt="Germany">
                    <div class="country-info">
                        <h3>Germany</h3>
                        <ul class="country-features">
                            <li>No or low tuition fees</li>
                            <li>Engineering & tech excellence</li>
                            <li>Globally recognized degrees</li>
                            <li>Strong job market</li>
                            <li>English-taught courses</li>
                            <li>Paid internships</li>
                            <li>Research opportunities</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/canada.webp" loading="lazy"  alt="Canada">
                    <div class="country-info">
                        <h3>Canada</h3>
                        <ul class="country-features">
                            <li>Friendly immigration policies</li>
                            <li>Affordable education</li>
                            <li>Multicultural society</li>
                            <li>Pathway to PR</li>
                            <li>Safe and inclusive</li>
                            <li>Co-op & internship programs</li>
                            <li>Top global universities</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/dubai.webp" loading="lazy"  alt="Dubai">
                    <div class="country-info">
                        <h3>Dubai</h3>
                        <ul class="country-features">
                            <li>Global business hub</li>
                            <li>Tax-free income potential</li>
                            <li>Modern infrastructure</li>
                            <li>Safe & student-friendly</li>
                            <li>Indian community presence</li>
                            <li>Internship opportunities</li>
                            <li>Emerging education destination</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
                <div class="country-card">
                    <img src="images/Ireland.webp" loading="lazy"  alt="Ireland">
                    <div class="country-info">
                        <h3>Ireland</h3>
                        <ul class="country-features">
                            <li>Tech industry growth</li>
                            <li>One-year master's programs</li>
                            <!-- <li>Post-study work visa</li> -->
                            <li>English-speaking country</li>
                            <li>Home to top global firms</li>
                            <li>Welcoming culture</li>
                            <li>Career-focused education</li>
                        </ul>
                        <button class="consult-btn" onclick="openRegistrationForm()">Consult Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Client Testimonials  -->
        <section class="video-gallery-section">
            <div class="container">
                <h2>Client Testimonials</h2>

                <div class="video-slider-wrapper">
                    <button class="slide-btn left" onclick="scrollSlider(-1)">‹</button>
                    <div class="video-slider" id="videoSlider">
                        @foreach($videos as $index => $video)
                            @php
        $videoId = Str::afterLast($video->url, '/');
        // Only the first image gets fetchpriority="high"
        $loadingAttr = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
                            @endphp
                            <div class="video-slide">
                                <div class="video-card">
                                    <div class="video-wrapper">
                                        <div class="youtube-facade" data-video-id="{{ $videoId }}" onclick="loadYoutube(this)">
                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" loading="lazy" 
                                                 alt="{{ $video->title }}"
                                                 {!! $loadingAttr !!}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <button class="slide-btn right" onclick="scrollSlider(1)">›</button>
                </div>
            </div>
        </section>

        <style>
            .video-gallery-section {
                padding: 60px 20px;
                background: #f7f7f7;
                text-align: center;
                font-family: Arial, sans-serif;
            }

            .section-title {
                font-size: 2rem;
                margin-bottom: 30px;
                color: #333;
            }

            .video-slider-wrapper {
                position: relative;
                overflow: hidden;
            }

            .video-slider {
                display: flex;
                gap: 10px;
                overflow-x: auto;
                scroll-behavior: smooth;
                padding: 10px 0;
                scrollbar-width: none;
            }

            .video-slider::-webkit-scrollbar {
                display: none;
            }

            .video-slide {
                flex: 0 0 auto;
                width: 160px;
            }

            @media (min-width: 576px) { .video-slide { width: 180px; } }
            @media (min-width: 768px) { .video-slide { width: 200px; } }
            @media (min-width: 992px) { .video-slide { width: 220px; } }
            @media (min-width: 1200px) { .video-slide { width: 240px; } }

            .video-card {
                background: #fff;
                border-radius: 6px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                transition: transform 0.3s;
                text-align: center;
                padding: 5px;
            }

            .video-card:hover {
                transform: translateY(-5px);
            }

            .video-wrapper {
                position: relative;
                width: 100%;
                padding-top: 177.77%; /* 9:16 */
                background: #000;
                border-radius: 6px;
                overflow: hidden;
            }

            .youtube-facade {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: #000;
                cursor: pointer;
            }

            .youtube-facade img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .youtube-facade::after {
                content: '';
                font-size: 3rem;
                color: white;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
                text-shadow: 0 0 10px rgba(0,0,0,0.5);
            }

            .video-title {
                font-size: 0.95rem;
                margin-top: 10px;
                color: #444;
            }

            .slide-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(0,0,0,0.5);
                color: #fff;
                border: none;
                font-size: 2rem;
                padding: 0 10px 5px;
                cursor: pointer;
                z-index: 1;
                border-radius: 6px;
                user-select: none;
            }

            .slide-btn.left { left: 10px; }
            .slide-btn.right { right: 10px; }


            .normal-content{
                text-align: justify;
                font-size: 1rem;
            }
        </style>

        <script>
            function scrollSlider(direction) {
                const slider = document.getElementById('videoSlider');
                const slideWidth = slider.querySelector('.video-slide').offsetWidth + 20;
                slider.scrollLeft += direction * slideWidth;
            }

            function loadYoutube(el) {
                const videoId = el.getAttribute('data-video-id');
                const iframe = document.createElement('iframe');
                iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allowfullscreen', '');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                el.innerHTML = '';
                el.appendChild(iframe);
            }
        </script>

        <!-- Find Your Destination  -->
        <!-- <section class="section-hero">
            <div class="destination">
                <h2>Find Your Study Destination</h2>
                <p>WTS Visa Consultancy assists you in selecting the optimum study destination as per your preferences, budget
                    and aspirations. We assist you on academics, lifestyle, and work scope in destinations like the US, UK,
                    Europe, and Asia, making your study abroad journey rich and fruitful.</p>
                <div class="path">
                    <div class="step">
                        <div class="step-content">
                            <h3 class="step-title">Top Countries for Higher Education</h3>
                            <p>We guide you to study in top locations like the US for Ivy League schools, the UK for academic
                                excellence, Canada for affordability and job opportunities, Australia for lifestyle, and Germany
                                for tuition-free education. We align your aspirations with the ideal study destination, ensuring
                                your long-term success.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-content">
                            <h3 class="step-title">Compare Universities & Programs</h3>
                            <p>Choosing the right university and program shapes your future. At WTS Visa Consultancy, we help
                                you compare options based on international reputation, career prospects, and personal
                                preferences.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-content">
                            <h3 class="step-title">Scholarship & Financial Aid Support</h3>
                            <p>We assist in locating scholarships, grants, work-study jobs, and low-interest loans. Our support
                                ensures you meet all requirements and study stress-free with financial aid.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-content">
                            <h3 class="step-title">Pre-Departure Training & Orientation</h3>
                            <p>Our training covers culture, lifestyle, and academic expectations, along with practical guidance
                                on finances, healthcare, and communication. We ensure you're prepared for your new environment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Process Flow  -->
        @include('./components/services-components.trust')

        <!-- Smooth Transition  -->
        <section class="visa-services dark-theme" id="visa-services">
            <div class="container">
                <h2>Smooth transition to your New Country</h2>
                <p>At WTS Visa Consultancy, we assist you to settle in abroad. From housing and transportation to medical care
                    and local way of life, we have it all covered. Our assistance enables you to settle down, get connected with
                    other students and settle down fast so you can study with confidence.</p>
                <div class="visa-service-cards">
                    <!-- Tourist Visa -->
                    <div class="visa-service-card">
                        <img src="icons/icons8-tourist-pulsar-color/icons8-tourist-96.png" loading="lazy"  alt="Tourist Visa">
                        <div class="service-content">
                            <h3>Application & Offer Letter</h3>
                            <p class="normal-content" data-id="1">Ensure your application is complete with all required documents. Once accepted, you’ll receive an offer letter, a crucial step in confirming your admission to your chosen program. Keep this document handy as it's needed for visa processing and financial planning.</p>

                        </div>
                    </div>

                    <!-- Travel Visa -->
                    <div class="visa-service-card">
                        <img src="icons/icons8-health-pulsar-color/icons8-health-96.png" loading="lazy"  alt="Travel Visa">
                        <div class="service-content">
                            <h3>Fees & Finances</h3>
                            <p class="normal-content" data-id="2">Plan for tuition and cost of living. Be aware of the fees and research financial aid programs. Having an account in a local bank could also help deal with day-to-day finances, so you're set financially for your new life abroad.</p>

                        </div>
                    </div>
                    <div class="visa-service-card">
                        <img src="icons/icons8-working-with-a-laptop-pulsar-color/icons8-working-96.png" loading="lazy"  alt="Travel Visa">
                        <div class="service-content">
                            <h3>Visa and Fly Tickets</h3>
                            <p class="normal-content" data-id="3">Once you receive your offer letter, apply for your student visa through the relevant embassy or consulate. Ensure you have all documents required, such as proof of funds. Pre-book your flight early to secure the best price, arriving before your program commences for an easy transition to your new home.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function learnmoreSection(section) {
                // Hide all normal and all-content sections
                document.querySelectorAll('.normal-content, .all-content').forEach(content => {
                    content.style.display = content.classList.contains('normal-content') ? 'block' : 'none';
                });

                // Show the selected all-content and hide normal-content
                document.querySelector(`.normal-content[data-id="${section}"]`).style.display = 'none';
                document.querySelector(`.all-content[data-id="${section}"]`).style.display = 'block';
            }
        </script>



        <!-- Choose us  -->
        <section id="services" class="services">
            <div class="container">
            <h2>Why <span>Choose Us?</span></h2>
            <p>With over a decade of experience, WTS Visa Consultancy knows what international students face. Our consultants remain aware of university admissions, visa regulations, and scholarship opportunities to provide you with the latest information. We have established good relationships with leading universities to assist students in identifying the most appropriate program for their aspirations. We have experience in guiding and assisting with complicated applications and the visa process to make it go as smoothly as possible. Thousands of successful placements are a reflection of our success in placing students in the appropriate opportunities. With us, you can go through the study abroad process with confidence and attain your academic objectives.</p>
            <div class="card">
                <img src="icons/quality.png" loading="lazy"  alt="Global Edge">
                <div>
                    <h3>10+ Years of Study Abroad Experience</h3>
                    <p>With over a decade of experience, WTS Visa Consultancy knows what international students face. Our
                        consultants remain aware of university admissions, visa regulations and scholarship opportunities to
                        provide you with the latest information. We have established good relationships with leading
                        universities in order to assist students in identifying the most appropriate program for their
                        aspirations. We have experience in dealing with complicated applications and visa process to make it go
                        as smoothly as possible. Thousands of successful placements are a reflection of our success in placing
                        students in the appropriate opportunities. With us, you can go through the study abroad process with
                        confidence and attain your academic objectives.</p>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/graduation.png" loading="lazy"  alt="Choice">
                <div>
                    <h3>Thousands of Students Placed in Top Universities</h3>
                    <p>We have placed thousands of students in top universities in the US, UK, Canada, Australia, and other countries. It is through understanding each of our students' academic past and professional future that we become successful. We support you in making strong application submissions, assist with exams, and guide you through the visa application process to help secure admissions. By giving close attention and strategic assistance, we produce strong success ratios. Successful student testimonials indicate the extent to which our services added value to their student life and careers. With us, you can get into a top university and make the most of your study abroad experience.</p>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/trust.png" loading="lazy"  alt="Top Universities">
                <div>
                    <h3>Parents & Students Worldwide Trust Us</h3>
                    <p>Parents from around the world trust WTS Visa Consultancy due to our guaranteed results and transparent process. We know parents worry about safety, money and future careers. We address these concerns by guiding students through the visa application process with straightforward advice and constant support. We inform parents at every step so they can trust in their child's progress. Our high success rate in scholarships and placements is evidence of our dependability and professionalism. Parents' and students' testimonials indicate the positive effect of our services. Trust us and enjoy peace of mind and a seamless transition for students and their families and ensure the study abroad experience is successful and rewarding.</p>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/mentoring.png" loading="lazy"  alt="Top Universities">
                <div>
                    <h3>Counseling Sessions</h3>
                    <p>Personalized sessions for students and their parents covering:</p>
                    <ul style="padding-left: 16px;">
                        <li><p style="margin: 0px; padding: 0px">University guidance and recommendations.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Key points to consider before and after admission.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Systematic explanation of our services.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Virtual or in-person university tours.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Nearby locations and facilities overview.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Community connections: alumni and native groups.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Building trust and rapport for smoother transitions.</p></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/accommodation.png" loading="lazy"  alt="Top Universities">
                <div>
                    <h3>Accommodation Support</h3>
                    <p>Assistance with finding suitable housing based on:</p>
                    <ul style="padding-left: 16px;">
                        <li><p style="margin: 0px; padding: 0px">On-campus or off-campus options.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Preferred locations.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Budget considerations.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Room type preferences (private/shared, en-suite/studio, etc.)</p></li>                    
                    </ul>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/reliable.png" loading="lazy"  alt="Top Universities">
                <div>
                    <h3>Part-Time Job Assistance</h3>
                    <p>Helping students’ secure suitable part-time employment:</p>
                    <ul style="padding-left: 16px;">
                        <li><p style="margin: 0px; padding: 0px">CV and cover letter support.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Interview preparation.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Job search strategies.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Employer connections (if applicable)</p></li>                    
                    </ul>
                </div>
            </div>
            <hr>
            <div class="card">
                <img src="icons/airport.png" loading="lazy"  alt="Top Universities">
                <div>
                    <h3>Airport Pickup Service</h3>
                    <ul style="padding-left: 16px;">
                        <li><p style="margin: 0px; padding: 0px">Reliable pickup from UK airports.</p></li>
                        <li><p style="margin: 0px; padding: 0px">Comfort and safety ensured upon arrival.</p></li>             
                    </ul>
                </div>
            </div>
            </div>
        </section>

        <!-- Global Partners  -->
        <x-global-partner/>

        <!-- Start Your Journey  -->
        <section id="services" class="services">
            <div class="container">
                <h2>Start Your Journey Today!</h2>
                <p>Start with WTS Visa Consultancy today. Plan ahead to research options, enhance
                    your application and find funding. Our consultants will assist you to hit deadlines, study for exams and
                    coordinate documents effortlessly. With a plan you can confidently realize your academic aspirations.</p>
                <div class="services-grid">
                    <!-- Service 1 -->
                    <div class="service-card">
                        <img src="icons/icons8-program-pulsar-color/icons8-program-96.png" loading="lazy"  alt="Programs" class="mb-2">
                        <h3>Schedule a Free Consultation</h3>
                        <p>The initial step to begin your study abroad process is booking a complimentary consultation with WTS
                            Visa Consultancy. Our experts will evaluate your academic record, career aspirations and budget to
                            suggest the most appropriate universities and programs. We will advise you on application
                            procedures, visa process and scholarships. Our consultants will assist you in designing a study plan
                            so you meet deadlines and submit a strong application. You may ask questions and clarify any
                            ambiguity regarding the process. This step will provide you with a proper direction and more chances
                            of success. Book your free consultation now!</p>
                    </div>
                    <!-- Service 2 -->
                    <div class="service-card">
                        <img src="icons/icons8-consultation-pulsar-color/icons8-consultation-96.png" loading="lazy"  alt="Consultation">
                        <h3>Virtual Tours to Your Dream University</h3>
                        <p>Take advantage of virtual tours to tour your desired university from home. Virtual tours give you an interactive preview of the campus, student facilities, and academic buildings, and you can imagine yourself there. If you want to see the campus layout, classrooms, or recreational facilities, virtual tours offer you a comprehensive overview. This is the best time to learn about student life, campus life, and facilities and take an informed decision about your future studies.</p>
                    </div>
                    <!-- Service 3 -->
                    <div class="service-card">
                        <img src="icons/icons8-application-pulsar-color/icons8-application-96.png" loading="lazy"  alt="Application">
                        <h3>One-on-One Session with Alumni Students</h3>
                        <p>Get more information about your chosen university by engaging with alumni students in individual settings. Personalized interactions offer firsthand information on campus life, academic demands, and career opportunities after graduation. Alumni students can give you information, both the disadvantages and the advantages, so you have a realistic picture of what to expect. They can also guide you as to how you can make the most of your university time, from internships to networking, to prepare you with the confidence to attain your academic achievement.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Services  -->
        <section class="our-services">
                <x-our-services />
        </section>

        <!-- FAQ section  -->
        @php
    $faqs = [
        [
            "question" => "1.	How Do I Select the Best Country to Study Abroad?",
            "answer" => "Your academic objective, career aspirations and personal interest depend on selecting the best destination. Investigate the standard of education, cost of living and overall culture of every nation. Approach an expert and get your choices aligned with your long-term professional objectives."
        ],
        [
            "question" => "2.	What Are the Preconditions for Studying Abroad?",
            "answer" => "Admission criteria differ by country and institution. Typical requirements are academic transcripts, language proficiency tests (such as IELTS or TOEFL), and statement of purpose and recommendation letters. Some programs will also require entrance exams."
        ],
        [
            "question" => "3.	How Can I Apply for Scholarships?",
            "answer" => "Begin by investigating scholarship opportunities provided by universities, governments and private agencies. Read and fully understand the eligibility requirements and timelines. Develop a good application with a good personal statement and supporting materials."
        ],
        [
            "question" => "4.	Which Country Is Best for My Studies Abroad?",
            "answer" => "Cost differs according study visa apply to country, university and lifestyle. Fees cost between a few thousand to tens of thousands of dollars per year. Living accommodation, eating, travelling and insurance are other costs. Scholarships and student financial aid may minimize the cost."
        ],
        [
            "question" => "5.	How Much Does it Cost?",
            "answer" => "Cost differs according study visa apply to country, university and lifestyle. Fees cost between a few thousand to tens of thousands of dollars per year. Living accommodation, eating, travelling and insurance are other costs. Scholarships and student financial aid may minimize the cost."
        ],
        [
            "question" => "6. Which Scholarships for International Students?",
            "answer" => "Fulbright Program (USA), Chevening Scholarships (United Kingdom), DAAD Scholarships (Germany) and Australia Awards are some of the best available scholarships. Universities also provide need-based and merit-based scholarships. Research in advance to fulfil deadlines for applications."
        ],
    ];
        @endphp

        <x-faq :faqs="$faqs" />

@endsection




<script>
function openRegistrationForm() {
    document.getElementById('registrationModal').style.display = 'block';
}

function closeRegistrationForm() {
    document.getElementById('registrationModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    var modal = document.getElementById('registrationModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
