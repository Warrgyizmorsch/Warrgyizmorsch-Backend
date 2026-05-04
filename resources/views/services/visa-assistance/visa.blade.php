@extends('layouts.app')
@section('content')

            <section class="service-hero" style="background-image: url('{{ asset('images/services/bg-image.webp') }}'); background-size: cover; background-position: bottom left; background-repeat: no-repeat;">
                <div class="service-hero-content">
                    <h1 class="main-heading" style="font-weight: 600;">Trusted Study Visa Consultants in India for Fast Visa Processing</h1>

                    <p style="margin-top: 10px;">Our experts help students prepare accurate visa files, avoid costly mistakes and
                        improve approval chances for
                        top countries.
                    </p>
                    <!-- Features Section -->
                    <div class="features">
                        <div class="feature">
                            <i class="fa-solid fa-check-circle"></i>
                            <strong>Reduce visa rejection risk
                            </strong>
                        </div>
                        <div class="feature">
                            <i class="fa-solid fa-check-circle"></i>
                            <strong>Country-specific visa experts
                            </strong>
                        </div>
                        <div class="feature">
                            <i class="fa-solid fa-check-circle"></i>
                            <strong>Complete document support
                            </strong>
                        </div>
                        <div class="feature">
                            <i class="fa-solid fa-check-circle"></i>
                            <strong>Free profile assessment</strong>
                        </div>
                    </div>

                    <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal"
                        style="text-decoration: none;">
                        Get Free Consultation
                    </a>

                    {{-- <span class=tip>Enjoy free services from A to A – application to accommodation, ensuring a smooth visa
                        process
                        from start to finish</span> --}}
                </div>

                <!-- Hero Image -->
                <div class="hero-form">
                    @include('./components/landing-page-registration-study-abroad')
                </div>
            </section>

            {{-- Course Overview Section --}}

            <style>
                /* IELTS OVERVIEW */

                .ielts-overview {
                    padding: 30px 0;
                }

                .ielts-overview-title {
                    font-size: 32px;
                    margin-bottom: 20px;
                    font-weight: 700;
                }

                .ielts-overview-text {
                    margin: 0 0 10px;
                    color: #444;
                    line-height: 1.7;
                    font-size: 16px;
                }
            </style>

            <!-- 2nd section  -->
            <section class="new-home-service-section">

                <div class="container">

                    <h2 class="new-section-title">Why Students Trust WTS for Visa Assistance</h2>

                    <div class="new-service-grid">
                        <div>
                            <p class="ielts-overview-text">
                                Applying for a study visa can feel overwhelming, especially when embassy rules, document
                                requirements, and country
                                policies keep changing. Even a small mistake in your application can lead to delays or visa
                                rejection.
                            </p>

                            <div class="features">
                                <div class="feature">
                                    ⮞
                                    <strong>Reduce the risk of visa rejection
                                    </strong>
                                </div>
                                <div class="feature">
                                    ⮞
                                    <strong>Country-specific visa guidance
                                    </strong>
                                </div>
                                <div class="feature">
                                    ⮞
                                    <strong>Complete document support
                                    </strong>
                                </div>
                                <div class="feature">
                                    ⮞
                                    <strong>Assistance until final visa decision </strong>
                                </div>
                            </div>

                            <p class="ielts-overview-text">Trusted by 7,500+ students for successful study abroad guidance. </p>

                            <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal"
                                style="text-decoration: none;">
                                Speak with Expert
                            </a>
                        </div>
                        <div>
                            <img src="{{ asset('images/services/visa-assist.webp') }}" alt="visa-assistance">
                        </div>
                    </div>

                </div>

            </section>

            <!-- Documents required  -->
            <section class="new-home-service-section">
                <div class="container">
                    <h2 class="new-section-title">Documents Required for Study Visa</h2>
                    <p style="margin: 0 0 20px 0;">Prepare these documents in advance to avoid delays. Our counselors will review
                        and verify every document
                        before
                        submission.</p>

                    <div class="admissions-grid">
                        <div class="admission-card">
                            <i class="fas fa-envelope-open-text"></i>
                            <h3>University offer letter</h3>
                        </div>

                        <div class="admission-card">
                            <i class="fas fa-file-alt"></i>
                            <h3>Academic and test score documents</h3>
                        </div>

                        <div class="admission-card">
                            <i class="fas fa-wallet"></i>
                            <h3>Financial proof and sponsorship details</h3>
                        </div>

                        <div class="admission-card">
                            <i class="fas fa-passport"></i>
                            <h3>Passport and identification documents</h3>
                        </div>

                        <div class="admission-card">
                            <i class="fas fa-file-signature"></i>
                            <h3>Visa application forms and photographs</h3>
                        </div>

                        <div class="admission-card">
                            <i class="fas fa-notes-medical"></i>
                            <h3>Medical test, insurance, or police clearance (if required)</h3>
                        </div>
                    </div>

                    <div class="new-service-note">
                        <span class="note-icon">i</span>
                        <div class="new-service-note-cta">
                            <p>
                            Please note that if you face any difficulty understanding the documents, you may contact our experts for assistance.
                        </p>
                        <a href="javascript:void(0)" class="study-guide-button js-open-custom-study-modal" style="text-decoration: none;">
                            Talk to Expert
                        </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Visa Process  -->
            <section class="new-home-service-section">
                <div class="container">
                    <h2 class="new-section-title">
                        Our Step-by-Step Study Visa Process
                    </h2>

                    <div class="new-home-service-grid">

                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;1 <br />Visa Eligibility Check
                            </h3>
                            <p>Student profile and admission offer are reviewed.</p>
                            <img src="/new-home-images/discussion.webp" class="new-home-service-image"
                                style="bottom:-15px; right:-10px; height:160px; width:160px;" alt="">
                        </div>

                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;2 <br />Document Preparation
                            </h3>
                            <p> All visa-related documents are organised and verified.</p>
                            <img src="/new-home-images/diary.webp" class="new-home-service-image" style="height:100px; width:100px;"
                                alt="">
                        </div>

                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;3 <br />Application Filing
                            </h3>
                            <p>Visa application is submitted <br>accurately and on time.</p>
                            <img src="/new-home-images/smooth-transition.webp" class="new-home-service-image" alt="">
                        </div>

                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;4 <br />Interview & Biometrics Support
                            </h3>
                            <p>Guidance for biometrics and <br>visa interview preparation.</p>
                            <img src="/new-home-images/university.webp" class="new-home-service-image"
                                style="height:140px; width:140px; border-bottom-right-radius:20px;" alt="">
                        </div>

                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;5 <br />Visa Tracking & Updates
                            </h3>
                            <p>Regular updates until visa <br>decision is received.</p>
                            <img src="/new-home-images/studying.webp" class="new-home-service-image"
                                style="bottom:-28px; right:-18px; height:180px; width:180px;" alt="">
                        </div>
                        <div class="new-home-service-card">
                            <h3 class="new-home-service-card-title">
                                Step&nbsp;6 <br />Pre-Departure Guidance
                            </h3>
                            <p>
                                Support with travel preparation<br> and final compliance before <br>departure.
                            </p>
                            <img src="/new-home-images/teaching.webp" class="new-home-service-image"
                                style="height:115px; width:115px;  bottom:2px; right:3px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"
                                alt="">
                        </div>



                    </div>
                </div>
            </section>

            <!-- Key Benefits  -->
            <section class="new-home-service-section">
                <div class="container">

                    <h2 class="new-section-title"> Key Benefits of Professional Visa Assistance</h2>

                    <div class="equal-width-grid three-grid">

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-user-tie"></i></div>
                            <div class="p-text">
                                <span>Expert study visa guidance</span>
                            </div>
                        </div>

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-file-alt"></i></div>
                            <div class="p-text">
                                <span>Accurate and complete documentation support</span>
                            </div>
                        </div>

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-flag"></i></div>
                            <div class="p-text">
                                <span>Country-specific visa application strategies</span>
                            </div>
                        </div>

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-bell"></i></div>
                            <div class="p-text">
                                <span>Regular updates on visa rules and requirements</span>
                            </div>
                        </div>

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-thumbs-up"></i></div>
                            <div class="p-text">
                                <span>Higher chances of student visa approval</span>
                            </div>
                        </div>

                        <div class="premium-card">
                            <div class="p-icon"><i class="fas fa-search"></i></div>
                            <div class="p-text">
                                <span>Professional review to minimise errors and delays</span>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </section>

            <!-- Clients Testimonials -->
             <section class="new-home-service-section">
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

            <!-- Why choose  -->
            <section class="new-home-service-section">
                <div class="container">
                    <h2 class="new-section-title">Why Choose WTS for Visa Assistance?</h2>

                    <div class="equal-width-grid three-grid">

                        <div class="step_s">
                            <i class="fas fa-user-tie"></i>
                            <h3>Experienced student visa consultants</h3>
                        </div>

                        <div class="step_s">
                            <i class="fas fa-globe"></i>
                            <h3>Up-to-date knowledge of immigration policies</h3>
                        </div>

                        <div class="step_s">
                            <i class="fas fa-list-ol"></i>
                            <h3>Transparent and step-by-step visa guidance</h3>
                        </div>

                        <div class="step_s">
                            <i class="fas fa-user-cog"></i>
                            <h3>Personalised approach based on student profile</h3>
                        </div>

                        <div class="step_s">
                            <i class="fas fa-hands-helping"></i>
                            <h3>End-to-end support until visa approval</h3>
                        </div>

                        <div class="step_s">
                            <i class="fas fa-chart-line"></i>
                            <h3>Strong track record of successful visa approvals</h3>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Read more content  -->
            <section class="new-home-service-section">
        <div class="container">
            <div class="long-box">

                <h2>Study Visa Assistance in India – Everything You Need to Know Before You Apply</h2>

                <p>
                    Studying abroad can be one of the most rewarding decisions in a student’s life. It opens the door to better education, global exposure, and stronger career opportunities. Whether you are a recent graduate planning a master’s degree in the UK, a 12th-pass student aiming for an undergraduate course in Canada, or a working professional considering an MBA in Australia or the USA, the study visa process can often feel confusing and stressful without proper guidance.
                </p>

                <p>
                    From preparing documents to meeting embassy requirements, even a small mistake can lead to delays or visa rejection. That is why many students choose professional study visa assistance to make the process smoother, faster, and more reliable.
                </p>

                <div class="read-btn-row">
                    <button class="read-toggle" id="readMore">Read More</button>
                </div>

                <div class="more-content" id="moreContent" style="display:none;">

                    <p>
                        At WTS, we have supported more than 7,500 students across India in securing their study visas and starting their academic journey at leading universities worldwide. With 12+ years of experience, multiple offices across India and the UK, and a team of experienced education consultants, we provide personalized support at every stage of the visa process.
                    </p>

                    <p>
                        In this guide, you will learn everything you need to know about study visa assistance, including what a student visa is, the common reasons visas get rejected, country-specific requirements, and how the right guidance can improve your chances of approval.
                    </p>

                    <h2>What Is Study Visa Assistance and Why Does It Matter?</h2>
                    <p>
                        A study visa, also called a student visa, is an official document issued by a country’s immigration authority that allows international students to enter, stay, and study for the duration of their academic program.
                    </p>
                    <p>
                        The study visa application process can often be complex. Students usually need to provide admission letters, academic records, financial proof, English language test scores, medical reports, and biometric details. Some countries may also require a visa interview. Even a small error in the application can lead to delays or rejection.
                    </p>
                    <p>
                        This is where study visa assistance in India becomes valuable. Study visa assistance helps students understand visa requirements, prepare the right documents, complete applications correctly, and improve their chances of approval. Working with an experienced study abroad consultant can save time and reduce unnecessary stress.
                    </p>
                    <p>
                        At WTS, our student visa consultancy services include profile evaluation, document support, SOP guidance, interview preparation, and pre-departure assistance, helping students move forward with confidence.
                    </p>

                    <h2>Who Needs Study Visa Assistance?</h2>
                    <p>Study visa assistance can benefit any student planning to study abroad, but it becomes especially important for:</p>
                    <ul>
                        <li>First-time applicants who are unfamiliar with the student visa process, embassy rules, and required documents</li>
                        <li>Working professionals applying for an MBA or master’s degree who need help with employment records and financial paperwork</li>
                        <li>Students with a previous visa refusal who need stronger documentation and a better reapplication strategy</li>
                        <li>Applicants choosing multiple countries who need country-specific visa guidance</li>
                        <li>Parents supporting their child’s application and looking for a reliable study abroad partner</li>
                    </ul>
                    <p>
                        No matter your situation, WTS offers personalized study visa support based on your academic profile, career goals, and chosen destination.
                    </p>

                    <h2>Study Visa Requirements: Country-Wise Overview</h2>
                    <p>Every country has its own study visa requirements, processing time, and financial rules. Understanding these differences can help students prepare the right documents and avoid delays.</p>

                    <h3>Study Visa for the UK</h3>
                    <p>The UK Student Visa requires a CAS (Confirmation of Acceptance for Studies) from your university, English language test scores, and proof that you can cover tuition and living expenses. Indian students also need a TB test certificate before applying. The average processing time is around 3 weeks.</p>
                    <p><strong>Key documents:</strong> CAS letter, passport, bank statements, IELTS/PTE scores, academic records, SOP, TB test report.</p>

                    <h3>Study Visa for Canada</h3>
                    <p>To apply for a Canada Study Permit, students need a Letter of Acceptance from a recognized institution, proof of funds, and biometrics. Canada remains popular because of its Post-Graduation Work Permit (PGWP) options for international students.</p>
                    <p><strong>Key documents:</strong> Admission letter, passport, financial proof, IELTS scores, biometrics, study plan.</p>

                    <h3>Study Visa for Australia</h3>
                    <p>The Australia Student Visa (Subclass 500) requires a Confirmation of Enrolment (CoE), health insurance, and a Genuine Temporary Entrant (GTE) statement. A strong GTE plays a major role in visa approval.</p>
                    <p><strong>Key documents:</strong> CoE, OSHC, GTE statement, passport, financial proof, English test scores.</p>

                    <h3>Study Visa for the USA</h3>
                    <p>The US F-1 Student Visa includes a DS-160 form, SEVIS fee payment, and a visa interview. The interview is often the most important step because officers review your academic goals and financial background.</p>
                    <p><strong>Key documents:</strong> I-20 form, DS-160, SEVIS receipt, passport, financial documents, TOEFL/IELTS scores.</p>

                    <h3>Study Visa for Germany</h3>
                    <p>Germany is known for affordable education. Students need a university admission letter, health insurance, and proof of funds through a blocked account to cover living expenses.</p>
                    <p><strong>Key documents:</strong> Admission letter, blocked account proof, health insurance, passport, academic records.</p>

                    <h3>Other Popular Destinations</h3>
                    <p>Countries like New Zealand, Ireland, and Singapore also attract Indian students. Each has different visa rules, financial requirements, and document standards, so expert guidance can make the process easier.</p>

                    <h2>Common Reasons for Study Visa Rejection</h2>
                    <p>A study visa can be rejected for several reasons, and in many cases, the problem is not the student’s profile but mistakes in the application. Understanding these common issues can help you avoid delays and improve your chances of approval.</p>
                    <p>Some of the most common reasons for student visa rejection include:</p>
                    <ul>
                        <li>Incomplete or incorrect documents</li>
                        <li>Insufficient financial proof</li>
                        <li>Weak or unclear Statement of Purpose (SOP)</li>
                        <li>Poor performance during the visa interview</li>
                        <li>Inconsistent academic or career history</li>
                        <li>Unclear intention to return after studies</li>
                        <li>False or misleading information in the application</li>
                    </ul>
                    <p>Even a minor error can affect the final decision. Professional study visa assistance helps identify these issues early and ensures your application meets the latest embassy requirements.</p>

                    <h2>Step-by-Step Study Visa Application Process</h2>
                    <p>Understanding the study visa application process can make your journey easier and more organized. While requirements vary by country, the overall process usually follows these steps:</p>
                    <ol>
                        <li><strong>Choose Your Course and Country:</strong> Select the right country, university, and course based on your academic goals and career plans.</li>
                        <li><strong>Secure University Admission:</strong> Apply to your preferred institution and receive an official admission or offer letter.</li>
                        <li><strong>Prepare Required Documents:</strong> Collect important documents such as passport, academic records, financial proof, test scores, and SOP.</li>
                        <li><strong>Submit Your Visa Application:</strong> Complete the visa application form carefully and submit it with the required supporting documents.</li>
                        <li><strong>Complete Biometrics or Medicals:</strong> Some countries require biometric verification or a medical examination before approval.</li>
                        <li><strong>Attend the Visa Interview:</strong> Countries like the USA may require a visa interview to assess your study plans and financial background.</li>
                        <li><strong>Receive Visa Decision:</strong> After review, the embassy will approve, request additional documents, or refuse the application.</li>
                        <li><strong>Plan Your Departure:</strong> Once approved, you can arrange accommodation, travel, and pre-departure preparations.</li>
                    </ol>
                    <p>With expert student visa guidance, each step becomes smoother and less stressful for students and parents.</p>

                    <h2>Common Reasons for Study Visa Rejection and How WTS Prevents Them</h2>
                    <p>Visa rejection is one of the biggest fears for students and their families. Understanding why visas get rejected is the first step to ensuring yours does not.</p>
                    <p>Insufficient financial proof is the most common reason for rejection across all countries. Many students submit bank
                    statements that show a sudden large deposit just before applying; immigration officers are trained to identify this and
                    reject such applications. WTS Study Abroad Consultant advises students on financial preparation 3 to 6 months in
                    advance, ensuring statements show genuine, organic funds.</p>
                    <p>A weak or generic Statement of Purpose (SOP) fails to convince the visa officer of your genuine intent to study. A
                    copy-pasted or template SOP is immediately identified. WTS Study Abroad Consultant’s SOP writing team crafts
                    personalised, compelling SOPs based on your academic background, career goals, and chosen programme.</p>
                    <p>Gaps in academic records that are unexplained or poorly addressed raise red flags. WTS Study Abroad Consultant
                    counsellors help you prepare honest, well-reasoned gap explanations that satisfy visa officer queries.</p>
                    <p>Missing or incorrect documents cause straightforward rejections that could easily have been avoided. WTS Study Abroad
                    Consultant conducts a thorough document checklist review before every submission.</p>
                    <p>Inconsistencies between documents—for example, a financial sponsor mentioned in the SOP but not reflected in the bank
                    statements—lead to immediate rejection. WTS Study Abroad Consultant cross-verifies all documents before submission to
                    ensure 100% consistency.</p>
                    <p>Poor visa interview performance (relevant for USA), where students appear nervous, unprepared, or give inconsistent answers, can also lead to rejection. WTS Study Abroad Consultant’s mock interview sessions prepare students to handle even the toughest consular officer questions.</p>
                    <p>If your visa has already been rejected, WTS Study Abroad Consultant offers a dedicated Rejection Recovery Programme
                    where your previous application is analysed, the exact reason for rejection is identified, and your case is rebuilt from
                    the ground up at no additional charge for the second submission.</p>

                    <div class="read-btn-row" style="margin-top:20px;">
                        <button class="read-toggle" id="readLess">Read Less</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

            <!-- FAQ Section -->
            <section class="new-home-service-section">
                <div class="new-faq-container">
                    <div class="new-faq-left">
                        <h3 class="new-section-title">Have a Question?</h3>
                        <p class="new-faq-text">
                            Have a question or need visa advice?<br>
                            Our experts are here to guide you - just reach out.
                        </p>
                        <div class="new-faq-graphic">
                            <img src="/new-home-images/faq-image2.jpeg"
                                style="border-top-right-radius: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%;"
                                alt="FAQ Graphic" />
                        </div>
                    </div>

                    <div class="new-faq-right">
                        <div class="new-faq-accordion">
                            <div class="new-faq-item">
                                <button class="new-faq-btn">What is Study Visa Assistance and Why is it Important?
                                    <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                                </button>
                                <div class="new-faq-content">Study visa assistance is expert guidance that helps students complete the entire visa process smoothly.It covers
                                everything from choosing the right visa type to preparing documents and handling applications.With proper support,
                                students avoid mistakes, save time, and improve their chances of visa approval.</div>
                            </div>
                            <div class="new-faq-item">
                                <button class="new-faq-btn">What Documents are Required for a Study Visa? <p><span><img
                                                src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                                </button>
                                <div class="new-faq-content">To apply for a study visa, you generally need a valid passport, an admission letter, proof of funds, and academic
                                records. You may also need an English test score like IELTS, along with a statement of purpose and photos, while exact
                                requirements can vary by country.</div>
                            </div>
                            <div class="new-faq-item">
                                <button class="new-faq-btn">Can WTS Help if My Visa Application Was Previously Rejected? <p><span><img
                                                src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                                <div class="new-faq-content">Yes, WTS can definitely help even if your visa was previously rejected. They’ll review the reasons for rejection, guide
                                you on what went wrong, and help you reapply with stronger documents and better preparation especially for interviews.
                                It improves your chances significantly the second time around.</div>
                            </div>
                            <div class="new-faq-item">
                                <button class="new-faq-btn">How Long Does the Study Visa Process Take? <p><span><img
                                                src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                                </button>
                                <div class="new-faq-content">The study visa process usually takes a few weeks, but it can vary depending on the country and your  application. On average, it may take around 3 to 8 weeks, so it’s always best to apply as early as  possible to avoid any last-minute stress. </div>
                            </div>

                            <div class="new-faq-item">
                                <button class="new-faq-btn">What Are the Fees for Visa Assistance at WTS? <p><span><img
                                                src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                                <div class="new-faq-content">The visa assistance fees at WTS Study Abroad can vary depending on the services you choose and the country you’re
                                applying to. It’s best to contact them directly to get the exact and most up-to-date pricing based on your needs.</div>
                            </div>

                            <div class="new-faq-item">
                                <button class="new-faq-btn">Can WTS help students from small cities and towns in India? <p><span><img
                                                src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                                </button>
                                <div class="new-faq-content">Yes, WTS supports students from small cities and towns across India. They provide personalised guidance, step-by-step
                                support, and online assistance, making it easier for students to access global education opportunities no matter where
                                they are from.</div>
                            </div>
                        </div>
                        <div style="display: flex; width: 100%; margin-left: auto; justify-content: end;">
                            <a href="#" class="new-faq-viewall">View All</a>
                        </div>
                    </div>
                </div>
            </section>

            @include('./components/cta-button')

            <style>
                /* Section Styling */
                .course-selection {
                    background: #f9f9f9;
                    padding: 50px 0;
                    text-align: left;
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
                    width: 100%;
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
                .section-title {
                    font-size: 44px;
                    font-weight: 700;
                    line-height: 1.2;
                    color: #1C2C59;
                    text-align: center;
                    margin-bottom: 65px;
                    /* professional gap */
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
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                    border-left: 5px solid #FC9118;
                    min-height: 115px;
                    transition: box-shadow 0.25s ease;
                }

                .premium-card:hover {
                    box-shadow: 0 10px 28px rgba(252, 145, 24, 0.25);
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

                .info-section h2.section-title {
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
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .admission-card:hover {
                    transform: translateY(-6px);
                    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
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

            <!-- modal code start -->
            @include('components.course-registration-form-modal')

            <script>
                const more = document.getElementById("moreContent");
                const rm = document.getElementById("readMore");
                const rl = document.getElementById("readLess");

                rm.onclick = function () {
                    more.style.display = "block";
                    rm.style.display = "none";
                }

                rl.onclick = function () {
                    more.style.display = "none";
                    rm.style.display = "inline-block";
                    document.querySelector(".long-box").scrollIntoView({ behavior: "smooth" });
                }
            </script>


@endsection