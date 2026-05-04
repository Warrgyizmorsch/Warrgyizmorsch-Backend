@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in UK - Learn, Grow, and Succeed Globally</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in United Kingdom consultancy in India, offering complete support for choosing the right course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                    in United Kingdom.</p>

                    <h3 style="color: #FC9118; font-weight: 600; margin-bottom: 14px;">
                        Google Reviews
                    </h3>

                    <div>
                        <div style="display: flex; align-items: center; gap: 18px; margin: 12px 0;">

                            <!-- Google Logo -->
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <img src="https://www.google.com/favicon.ico" alt="Google" style="height: 26px;">
                                <span style="font-size: 20px; font-weight: 700; color:#111;">4.9</span>
                                <span style="color: #555; font-size: 15px;">/ 5</span>
                            </div>

                            <!-- Pipe Divider -->
                            <span style="color:#ccc;">|</span>

                            <!-- Stars -->
                            <div style="display: flex; gap: 4px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                    <path
                                        d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                    <path
                                        d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                    <path
                                        d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                    <path
                                        d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#fbbc04">
                                    <path
                                        d="M12 .587l3.668 7.568L24 9.748l-6 5.848L19.335 24 12 19.897 4.665 24 6 15.596 0 9.748l8.332-1.593z" />
                                </svg>
                            </div>

                        </div>
                        <p style="font-size: 14px; color: #444; line-height: 1.5; margin-bottom: 14px;">
                            Trusted by 150+ students on Google for expert guidance and smooth study-abroad processing.
                        </p>
                    </div>
                </div>                
            </div>

            <!-- Hero Image -->
            <div class="hero-form">
                @include('./components/landing-page-registration-study-abroad')
            </div>
        </section>

        
        <!-- sub hero section -->
        <section class="sub-hero">
            <div class="sub-hero-content">
                <div class="sub-hero-text">
                    <h2 class="new-section-title">Start Your Journey</h2>
                    <p style="margin-top: 30px;">Study in UK and take the first step toward a globally respected education system. The UK is home to some of the world’s oldest and most prestigious universities, offering high academic standards, innovative teaching methods, and excellent post-study career opportunities. With internationally recognised degrees and a multicultural environment, the UK has become a top choice for students planning to study in UK for Indian students seeking global exposure and career growth.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/uknew.webp" loading="lazy" alt="Study in uk">
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        @include('new-home-components.top-universities', ['universities' => $universities])
        
        @include('./components/stats')


    <!-- choose us section -->
    @php
    $sectionTitle = 'Why Study in UK?';
    $sectionDescription = 'The UK is one of the most preferred study destinations for international students due to its academic excellence, shorter course duration, and strong global reputation. Known for quality education and research-led teaching, the UK offers excellent value for money and long-term career benefits. For students planning to study in UK Indian students, the country provides a safe, diverse, and English-speaking environment.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'The UK education system is globally respected for its academic quality, research output, and teaching standards. Universities focus on critical thinking, practical learning, and subject specialisation, helping students gain in-depth knowledge and global recognition.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the major study in UK benefits is the flexibility and shorter duration of courses. Undergraduate programs typically last three years, while most master’s degrees are completed in one year, allowing students to save both time and cost while entering the job market earlier.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'The UK attracts students from all over the world, offering a multicultural and inclusive learning environment. Studying in such a diverse setting helps students develop global perspectives, improve communication skills, and build strong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'The UK has a strong job market across sectors such as finance, healthcare, engineering, IT, business, and creative industries. Universities maintain close links with employers, providing internships, placements, and career support. The Graduate Route allows students to stay and work in the UK after completing their studies.'],
        ['title' => '5. Research and Innovation', 'desc' => 'UK universities are known for their excellence in research and innovation. Students gain access to advanced laboratories, research funding, and industry projects, especially in science, technology, healthcare, and engineering fields.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'There are various scholarships available for international students, including government-funded and university-specific awards. These options help reduce the overall study in UK cost and make education more affordable for Indian students.'],
        ['title' => '7. International Student Support Services', 'desc' => 'UK universities offer strong support services such as academic guidance, career counselling, mental health support, and international student offices. These services help students adapt smoothly to life in the UK.'],
    ];
    @endphp
    <x-choose-us 
        :section-title="$sectionTitle" 
        :section-description="$sectionDescription" 
        :cards="$cards" 
    />


        <!-- universities section -->
        
       <!-- course section -->
    @php
    $courses = [
        ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
        ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
        ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
        ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/medicine.jpg'],
        ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
    ];

    $courseContent = [
        'title' => 'Popular Courses to Study in UK',
        'desc' => 'The UK offers a wide range of globally recognised programs with strong career outcomes. Universities are known for their specialised curriculum and industry relevance.',
        'footer' => 'These courses are highly popular among students planning to study in UK Indian students due to excellent employability prospects.',
    ];
    @endphp

    <x-courses 
        :courses="$courses" 
        :title="$courseContent['title']"
        :desc="$courseContent['desc']"
        :footer="$courseContent['footer']"
    />


        <!-- cost of living section  -->
        @php
    $tuitionFees = [
        ['label' => 'Undergraduate Degree', 'value' => '£10,000 - £25,000'],
        ['label' => 'Master’s Degree', 'value' => '£12,000 - £30,000'],
        ['label' => 'MBA', 'value' => '£20,000 - £40,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => '£15,000 - £25,000'],
        ['label' => 'Diploma / Certificate', 'value' => '£8,000 - £18,000'],
    ];
    $livingFees = [
        ['label' => 'Housing', 'value' => '£4,000 - £8,000', 'note' => 'Shared accommodation reduces cost'],
        ['label' => 'Food', 'value' => '£2,000 - £3,000', 'note' => 'Cooking at home saves money'],
        ['label' => 'Transportation', 'value' => '£800 - £1,200', 'note' => 'Student discounts available'],
        ['label' => 'Personal Expenses', 'value' => '£1,200 - £2,500', 'note' => 'Utilities and leisure'],
        ['label' => 'Total', 'value' => '£9,000 - £15,000', 'note' => 'Varies by city'],
    ];
    $description = "";
    $ukCostOfLiving = [
        'heading' => 'Cost of Studying in UK',
        'description' => 'The study in UK cost depends on the university, course, and level of study. Compared to many countries, shorter course duration helps reduce overall expenses.',
    ];
    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in UK for Indian Students',
        'description' => 'Living costs in the UK depend on the city and lifestyle. On average, students spend between £9,000 - £15,000 per year.',
    ];
    @endphp

    <x-cost-of-living 
        :tuitionFees="$tuitionFees" 
        :description="$description" 
        :ukCostOfLiving="$ukCostOfLiving" 
        :livingFees="$livingFees"
        :ukCostOfLivingRight="$ukCostOfLivingRight"
    />

    <!-- scholarship section -->
    @php
    $scholarship = [
        'title' => 'Student Life in UK: What to Expect?',
        'desc' => 'Student life in the UK is dynamic and enriching. Universities offer clubs, sports, cultural events, and student societies that encourage social interaction and personal growth. With world-class education, diverse cultures, and strong career opportunities, the UK provides an ideal environment to study, live, and build a successful future.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in UK?',
        'guide_steps' => [
            'Research and Select Universities - Choose courses aligned with academic and career goals.',
            'Meet Entry Requirements - Academic qualifications and English language proficiency are required.',
            'Prepare Application Documents - Transcripts, SOP, and letters of recommendation.',
            'Apply via UCAS or University Portal - Depending on course level.',
            'Receive Offer Letter - Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Visa - Accept the offer and proceed with visa application.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>

    <!-- document section -->
    @php
    $documentContent = [
        'title' => 'Documents Required to Study in UK',
        'desc' => 'Students planning to study in UK Indian students must prepare the following documents:',
        'list' => [
            'Academic Transcripts and Certificates',
            'English Proficiency Test Scores (IELTS / PTE)',
            'Statement of Purpose',
            'Letters of Recommendation',
            'Valid Passport',
            'Financial Proof',
            'CAS (Confirmation of Acceptance for Studies)',
            'UK Student Visa (Tier 4 Visa)',
        ],
        'footer' => ''
    ];

    $guideContent = [
        'title' => 'UK Study Visa Process: Step-by-Step Guide',
        'desc' => 'A student visa is mandatory to study in UK. Understanding the study visa in UK requirements helps avoid delays and ensures a smooth application process.',
        'list' => [
            'Receive Offer Letter and CAS: Obtain an offer from a licensed UK university and receive the CAS.',
            'Meet Study Visa in UK Requirements: Show financial proof, English proficiency, and academic documents.',
            'Apply Online for UK Student Visa: Complete the visa application through the official UKVI portal.',
            'Pay Visa Fees and Immigration Health Surcharge: Mandatory for all international students.',
            'Attend Biometrics Appointment: Submit fingerprints and photographs at the visa centre.',
            'Visa Decision and Travel to UK: Once approved, students can travel and begin their studies.',
        ],
        'footer' => 'This structured process helps students planning to study in UK Indian students prepare confidently.'
    ];
    @endphp

    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

  <section class="ielts-long">
        <div class="container">

            <div class="long-box">

                <h2>Why WTS is the Right Partner for Your UK Study Abroad Journey</h2>

                <p>
                    Choosing the right guidance can make a major difference when planning overseas education. While selecting a university and course is important, students also need expert help with profile evaluation, application timelines, scholarship planning, and visa preparation. This is where WTS supports students with end-to-end assistance designed specifically for Indian applicants.
                </p>

                <p>
                   With years of experience in overseas education counselling, WTS helps students identify the most suitable academic path based on their background, goals, and budget. Whether a student is planning undergraduate education or exploring masters in UK, expert guidance can reduce confusion and improve the overall admission process. Instead of applying randomly, students can make smarter choices with the help of WTS, especially when shortlisting the best uk universities for international students.
                </p>

                <div class="read-btn-row">
                    <button class="read-toggle" id="readMore">Read More</button>
                </div>

                <div class="more-content" id="moreContent">
                    <h3>Best Intakes in UK for Indian Students</h3>

                    <p>
                       Understanding the right admission cycle is one of the most important steps in planning your <a href="https://www.wtsvisa.com/study-abroad">study abroad</a> journey. Many students delay their applications simply because they are unaware of the available intakes in UK. The UK generally offers multiple admission cycles, giving students flexibility and enough time to prepare their academic documents, test scores, and finances.
                    </p>

                    <p><strong>The main intakes in UK are:</strong> </p>
                    <ul>
                        <li>
                            <strong>September Intake –</strong> The most preferred intake with the maximum number of courses and universities available
                        </li>
                        <li>
                            <strong>January Intake –</strong> A strong alternative for students who miss the September deadline
                        </li>
                        <li>
                            <strong>May Intake –</strong> Available in selected universities and for limited programs
                        </li>
                    </ul>
                    <p>Among the different intakes in UK, September is usually considered the best because it offers broader course availability and more scholarship opportunities. However, students should choose the right intakes in UK based on their profile readiness, university deadlines, and visa timeline. WTS helps students build a personalised application roadmap so they can target the most suitable intakes in UK without unnecessary delays.</p>

                    <h2>How WTS Helps You Choose the Right Masters in UK</h2>

                    <p>
                        For students aiming to build global careers, masters in UK remains one of the most valuable options. Since most postgraduate programs in the UK are completed in one year, students often prefer them for faster academic progression and quicker return on investment. However, choosing the right course and university is essential because every program has different entry requirements, tuition fees, and career outcomes.
                    </p>

                    <p>This is where WTS provides real value. Our team helps students compare program structures, understand eligibility, shortlist the right specialisations, and select universities based on future job opportunities. Whether you are interested in business, data science, engineering, finance, healthcare, or management, choosing the right masters in UK should always depend on both academic interest and employability.</p>

                    <h2> <a href="https://www.wtsvisa.com/blog/study-abroad-scholarship-guide-eligibility-types-how-to-apply">UK Scholarships:</a> How Students Can Reduce Their Overall Budget</h2>

                    <p>For many families, affordability is a key concern while planning overseas education. This is why understanding available uk scholarships is extremely important. Scholarships can significantly reduce tuition fees and make studying in the UK more accessible for deserving students.</p>
                    <p>There are several types of uk scholarships available for Indian students, such as:</p>
                    <ul>
                        <li>Merit-based scholarships</li>
                        <li>Need-based financial support</li>
                        <li>University-specific grants</li>
                        <li>Government-funded scholarships</li>
                        <li>Course-specific awards for selected departments</li>
                    </ul>

                    <p>
                        Students who apply early and maintain a strong profile generally have better chances of receiving uk scholarships. Academic performance, English proficiency, a strong statement of purpose, and timely applications all play an important role. At WTS, we help students identify relevant uk scholarships, understand eligibility, and submit stronger applications that improve funding opportunities.
                    </p>

                    <h2>Cost Planning: Tuition + Budgeting Strategy for Indian Students</h2>

                    <p>While many students ask about the <a href="https://www.wtsvisa.com/cost-of-living">cost of study in UK for indian students</a>, the real key is smart planning rather than just fee comparison. A successful study abroad plan should include tuition fee analysis, scholarship options, city comparison, accommodation planning, and monthly expense management.</p>

                    <p>The cost of study in UK for indian students can vary depending on course level, university reputation, and city of residence. Students who choose high-demand programs in major cities may have a different budget compared to those selecting more affordable institutions in student-friendly cities. This is why the cost of study in UK for indian students should always be evaluated as a full package rather than only tuition fees.</p>

                    <p>At WTS, we help students understand the practical side of overseas education by comparing university fees, available scholarships, and future ROI. With proper counselling, the cost of study in UK for indian students can be planned more effectively and aligned with family budgets.</p>

                    <h2>Managing Living Expenses in UK for Indian Students</h2>

                    <p>Many students focus only on tuition fees, but managing day-to-day expenses is equally important. Understanding living expenses in UK for indian students helps students prepare financially before departure and avoid unnecessary stress after reaching the UK.</p>

                    <p>The total living expenses in UK for indian students usually depend on factors such as city, accommodation type, food habits, travel needs, and personal lifestyle. Students staying in London generally spend more than those living in cities like Leicester, Sheffield, Sunderland, or Coventry. Shared accommodation, student travel cards, and monthly budgeting can make a big difference in reducing living expenses in UK for indian students.</p>

                    <p>At WTS, we guide students with realistic pre-departure planning so they understand what to expect after arriving in the UK. With proper awareness and financial discipline, living expenses in UK for indian students can be controlled in a smart and practical way.</p>

                    <h2>UK Student Visa for Indian Students: Why Proper Guidance Matters</h2>

                    <p>A university offer alone is not enough students must also successfully complete the uk student visa for indian students process. This is one of the most critical stages of the journey, and proper documentation plays a major role in approval.</p>

                    <p>The uk student visa for indian students process requires careful preparation of financial proof, CAS details, academic records, English proficiency documents, and other supporting paperwork. Even a small error or delay can impact timelines. This is why many students prefer expert support instead of handling everything alone.</p>

                    <p>At WTS, we help students prepare and review their documents carefully before submission. Our team ensures that the uk student visa for indian students process is handled in an organised and timely manner. With structured guidance, the uk student visa for indian students journey becomes much smoother and less stressful for both students and parents.</p>

                    <h2>How to Shortlist the Best UK Universities for Your Profile</h2>

                    <p>Not every student should apply to the same set of institutions. The best university is not always the highest-ranked one it is the one that matches your academic background, career goals, budget, and preferred location. This is especially important when selecting among the many uk universities for international students.</p>

                    <p>There are several factors to consider while shortlisting uk universities for international students:</p>

                    <ul>
                        <li>Academic entry requirements</li>
                        <li>Tuition fee structure</li>
                        <li>Scholarship availability</li>
                        <li>Graduate employability</li>
                        <li>Location and student lifestyle</li>
                        <li>Internship and placement opportunities</li>
                        <li>Post-study work relevance</li>
                    </ul>

                    <h2>Start Your UK Journey with Confidence</h2>

                    <p>
                        Studying in the UK can open the door to quality education, international exposure, and better career opportunities. With the right planning, students can explore the best uk universities for international students, target suitable intakes in UK, manage living expenses in UK for indian students, understand the cost of study in UK for indian students, and apply confidently for the uk student visa for indian students process.
                    </p>
                    <p>If you are serious about studying in the UK, the right time to start is now. With expert support from WTS, you can move ahead with confidence, clarity, and a strong plan for your academic future.</p>

                    <div class="read-btn-row" style="margin-top:20px;">
                        <button class="read-toggle" id="readLess">Read Less</button>
                    </div>

                </div>


            </div>

        </div>
    </section>
        @include('./components/cta-button')
        

        <!-- faqs   -->
        @php
    $faqs = [
        [
            'question' => '1. Why should Indian students study in the UK?',
            'answer' => 'The UK offers globally recognised degrees, high academic standards, and shorter course durations. For study in UK Indian students, benefits include quality education, strong career opportunities, and exposure to international culture.'
        ],
        [
            'question' => '2. What are the main benefits of studying in the UK?',
            'answer' => 'Some key study in UK benefits include world-class universities, one-year master’s programs, post-study work opportunities, and degrees that are highly valued by employers worldwide.'
        ],
        [
            'question' => '3. What is the cost of studying in the UK for Indian students?',
            'answer' => 'The study in UK cost depends on the course and university. On average, tuition fees range from £10,000 to £30,000 per year, while living expenses are around £9,000-£15,000 annually.'
        ],
        [
            'question' => '4. What are the study visa in UK requirements?',
            'answer' => 'The main study visa in UK requirements include an offer letter and CAS from a licensed university, proof of funds, English language proficiency (IELTS/PTE), a valid passport, and payment of visa fees and the Immigration Health Surcharge.'
        ],
        [
            'question' => '5. Can Indian students work while studying in the UK?',
            'answer' => 'Yes, study in UK Indian students can work up to 20 hours per week during term time and full-time during holidays, helping them manage living expenses and gain work experience.'
        ],
        [
            'question' => '6. Is IELTS mandatory to study in the UK?',
            'answer' => 'IELTS is commonly required, but some universities accept alternatives like PTE or offer IELTS waivers based on previous education. Requirements vary by institution.'
        ],
    ];
    @endphp

    <x-faq :faqs="$faqs" />

    <style>
        .ielts-long {
            padding: 40px 15px;
        }

        .ielts-long .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* MAIN BOX */
        .long-box {
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            padding: 0;
            text-align: left;
        }

        /* Light scrollbar */
        .long-box::-webkit-scrollbar {
            width: 6px;
        }

        .long-box::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }

        .long-box::-webkit-scrollbar-track {
            background: transparent;
        }

        /* TEXT */
        .long-box h2 {
            font-size: 22px;
            margin-bottom: 10px;
            text-align: left;
        }

        .long-box h3 {
            margin-top: 25px;
            text-align: left;
        }

        .long-box p {
            line-height: 1.6;
            margin-bottom: 12px;
            text-align: left;
        }

        .long-box ul {
            padding-left: 18px;
            margin-left: 0;
        }

        .long-box li {
            margin-bottom: 6px;
        }

        .long-box {
            max-height: none;
            overflow: hidden;
        }

        .more-content {
            display: none;
        }

        .read-btn-row {
            text-align: right;
            margin-top: 10px;
        }

        .read-toggle {
            cursor: pointer;
            font-weight: 600;
            color: white;
            border: 1px solid #ff8c00;
            padding: 6px 18px;
            border-radius: 30px;
            background: var(--primary-color);
        }

        .ielts-long a {
            text-decoration: none;
        }

        .ielts-long a:hover {
            text-decoration: none;
        }


        @media(max-width:600px) {
            .read-btn-row {
                text-align: center;
            }
        }

        /* MOBILE */
        @media(max-width:600px) {
            .long-box {
                padding: 22px;
                max-height: none;
                overflow: visible;
            }
        }

        .long-box h2 {
            font-size: 20px;
        }

        .read-btn-row {
            display: block !important;
        }
    </style>

  
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