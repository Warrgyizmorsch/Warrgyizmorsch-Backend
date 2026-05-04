@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in Ukraine - Learn, Grow, and Succeed Globally</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in Ukraine consultancy in India, offering complete support for choosing the right course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                    in Ukraine.</p>

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
                    <p style="margin-top: 30px;">Study in Ukraine and take the first step toward a globally respected education system. The Ukraine is home to some of the world’s oldest and most prestigious universities, offering high academic standards, innovative teaching methods, and excellent post-study career opportunities. With internationally recognised degrees and a multicultural environment, the Ukraine has become a top choice for students planning to study in Ukraine for Indian students seeking global exposure and career growth.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/ukrainenew.webp" loading="lazy" alt="Study in Ukraine">
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        @include('./components/stats')


    <!-- choose us section -->
    @php
    $sectionTitle = 'Why Study in Ukraine?';
    $sectionDescription = 'The Ukraine is one of the most preferred study destinations for international students due to its academic excellence, shorter course duration, and strong global reputation. Known for quality education and research-led teaching, the Ukraine offers excellent value for money and long-term career benefits. For students planning to study in Ukraine Indian students, the country provides a safe, diverse, and English-speaking environment.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'The Ukraine education system is globally respected for its academic quality, research output, and teaching standards. Universities focus on critical thinking, practical learning, and subject specialisation, helping students gain in-depth knowledge and global recognition.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the major study in Ukraine benefits is the flexibility and shorter duration of courses. Undergraduate programs typically last three years, while most master’s degrees are completed in one year, allowing students to save both time and cost while entering the job market earlier.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'The Ukraine attracts students from all over the world, offering a multicultural and inclusive learning environment. Studying in such a diverse setting helps students develop global perspectives, improve communication skills, and build strong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'The Ukraine has a strong job market across sectors such as finance, healthcare, engineering, IT, business, and creative industries. Universities maintain close links with employers, providing internships, placements, and career support. The Graduate Route allows students to stay and work in the Ukraine after completing their studies.'],
        ['title' => '5. Research and Innovation', 'desc' => 'Ukraine universities are known for their excellence in research and innovation. Students gain access to advanced laboratories, research funding, and industry projects, especially in science, technology, healthcare, and engineering fields.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'There are various scholarships available for international students, including government-funded and university-specific awards. These options help reduce the overall study in Ukraine cost and make education more affordable for Indian students.'],
        ['title' => '7. International Student Support Services', 'desc' => 'Ukraine universities offer strong support services such as academic guidance, career counselling, mental health support, and international student offices. These services help students adapt smoothly to life in the Ukraine.'],
    ];
    @endphp
    <x-choose-us 
        :section-title="$sectionTitle" 
        :section-description="$sectionDescription" 
        :cards="$cards" 
    />


        <!-- universities section -->
        @php
    $universities = [
        [
            'name' => 'Taras Shevchenko National University of Kyiv',
            'logo' => 'images/universities/Taras_logo.png',
            'course' => 'Science & Medicine',
            'ranking' => 1
        ],
        [
            'name' => 'V. N. Karazin Kharkiv National University',
            'logo' => 'images/universities/Karazin_logo.png',
            'course' => 'Engineering & Technology',
            'ranking' => 2
        ],
        [
            'name' => 'National Technical University of Ukraine',
            'logo' => 'images/universities/National_Ukraine_logo.png',
            'course' => 'Engineering & Physical Sciences',
            'ranking' => 6
        ],
        [
            'name' => 'Lviv National University named after Ivan Franko Sumy State University',
            'logo' => 'images/universities/Lviv_logo.png',
            'course' => 'Engineering & Physical Sciences',
            'ranking' => 6
        ],
        [
            'name' => 'National University of Kyiv-Mohyla Academy',
            'logo' => 'images/universities/Kyiv_Mohyla_logo.jpg',
            'course' => 'Health & Life Sciences',
            'ranking' => 3
        ],
    ];
    $universitySection = [
        'heading' => 'Top Universities in Ukraine',
        'highlight' => '',
        'sub_heading' => 'The Ukraine is home to some of the world’s most prestigious universities, known for academic excellence and global rankings.',
        'footer' => 'These universities attract international students every year and offer strong academic and career support.'
    ];
        @endphp

        <x-universities :universities="$universities" :universitySection="$universitySection"/>

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
        'title' => 'Popular Courses to Study in Ukraine',
        'desc' => 'The Ukraine offers a wide range of globally recognised programs with strong career outcomes. Universities are known for their specialised curriculum and industry relevance.',
        'footer' => 'These courses are highly popular among students planning to study in Ukraine Indian students due to excellent employability prospects.',
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
        ['label' => 'Undergraduate Degree', 'value' => '€1,800 – €4,000'],
        ['label' => 'Master’s Degree', 'value' => '€2,000 – €5,000'],
        ['label' => 'Medicine / Health Sciences', 'value' => '€3,500 – €6,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => '€1,800 – €4,000'],
        ['label' => 'Diploma / Certificate', 'value' => '€1,500 – €3,000'],
    ];

     $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Ukraine',
        'description' => 'Ukraine has long been a popular destination for affordable medical and technical education for international students.',
    ];

    $livingFees = [
        ['label' => 'Housing', 'value' => '€1,200 – €2,500', 'note' => 'Dorms reduce cost'],
        ['label' => 'Food', 'value' => '€1,200 – €1,800', 'note' => 'Very affordable'],
        ['label' => 'Transportation', 'value' => '€200 – €400', 'note' => 'Low public transport cost'],
        ['label' => 'Personal Expenses', 'value' => '€800 – €1,300', 'note' => 'Utilities and leisure'],
        ['label' => 'Total', 'value' => '€3,500 – €6,000', 'note' => 'Budget-friendly'],
    ];
    $description = "";

    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in Ukraine for Indian Students',
        'description' => 'Living costs are low, averaging €3,500 – €6,000 per year.',
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
        'title' => 'Student Life in Ukraine: What to Expect?',
        'desc' => 'Student life in the Ukraine is dynamic and enriching. Universities offer clubs, sports, cultural events, and student societies that encourage social interaction and personal growth. With world-class education, diverse cultures, and strong career opportunities, the Ukraine provides an ideal environment to study, live, and build a successful future.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Ukraine?',
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
        'title' => 'Documents Required to Study in Ukraine',
        'desc' => 'Students planning to study in Ukraine Indian students must prepare the following documents:',
        'list' => [
            'Academic Transcripts and Certificates',
            'English Proficiency Test Scores (IELTS / PTE)',
            'Statement of Purpose',
            'Letters of Recommendation',
            'Valid Passport',
            'Financial Proof',
            'CAS (Confirmation of Acceptance for Studies)',
            'Ukraine Student Visa (Tier 4 Visa)',
        ],
        'footer' => ''
    ];

    $guideContent = [
        'title' => 'Ukraine Study Visa Process: Step-by-Step Guide',
        'desc' => 'A student visa is mandatory to study in Ukraine. Understanding the study visa in Ukraine requirements helps avoid delays and ensures a smooth application process.',
        'list' => [
            'Receive Offer Letter and CAS: Obtain an offer from a licensed Ukraine university and receive the CAS.',
            'Meet Study Visa in Ukraine Requirements: Show financial proof, English proficiency, and academic documents.',
            'Apply Online for Ukraine Student Visa: Complete the visa application through the official Ukraine VI portal.',
            'Pay Visa Fees and Immigration Health Surcharge: Mandatory for all international students.',
            'Attend Biometrics Appointment: Submit fingerprints and photographs at the visa centre.',
            'Visa Decision and Travel to Ukraine: Once approved, students can travel and begin their studies.',
        ],
        'footer' => 'This structured process helps students planning to study in Ukraine Indian students prepare confidently.'
    ];
    @endphp

    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


        @include('./components/cta-button')

        <!-- faqs   -->
        @php
    $faqs = [
        [
            'question' => '1. Why should Indian students study in the Ukraine?',
            'answer' => 'The Ukraine offers globally recognised degrees, high academic standards, and shorter course durations. For study in Ukraine Indian students, benefits include quality education, strong career opportunities, and exposure to international culture.'
        ],
        [
            'question' => '2. What are the main benefits of studying in the Ukraine?',
            'answer' => 'Some key study in Ukraine benefits include world-class universities, one-year master’s programs, post-study work opportunities, and degrees that are highly valued by employers worldwide.'
        ],
        [
            'question' => '3. What is the cost of studying in the Ukraine for Indian students?',
            'answer' => 'The study in Ukraine cost depends on the course and university. On average, tuition fees range from £10,000 to £30,000 per year, while living expenses are around £9,000-£15,000 annually.'
        ],
        [
            'question' => '4. What are the study visa in Ukraine requirements?',
            'answer' => 'The main study visa in Ukraine requirements include an offer letter and CAS from a licensed university, proof of funds, English language proficiency (IELTS/PTE), a valid passport, and payment of visa fees and the Immigration Health Surcharge.'
        ],
        [
            'question' => '5. Can Indian students work while studying in the Ukraine?',
            'answer' => 'Yes, study in Ukraine Indian students can work up to 20 hours per week during term time and full-time during holidays, helping them manage living expenses and gain work experience.'
        ],
        [
            'question' => '6. Is IELTS mandatory to study in the Ukraine?',
            'answer' => 'IELTS is commonly required, but some universities accept alternatives like PTE or offer IELTS waivers based on previous education. Requirements vary by institution.'
        ],
    ];
    @endphp

    <x-faq :faqs="$faqs" />


@endsection