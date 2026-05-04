@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Latvia – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Latvia  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Latvia.</p>

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
                <p style="margin-top:30px;">Study in Latvia and take the first step toward an affordable, globally recognized European education. Latvia has emerged as an attractive destination for international students due to its quality education system, modern universities, and low cost of living. With English-taught programs and EU-recognized degrees, Latvia study abroad options are ideal for students looking to build strong academic and professional foundations in Europe.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/latvianew.webp" loading="lazy" alt="Study in latvia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Latvia?';
    $sectionDescription = 'Latvia is gaining popularity among international students for its high academic standards, safe environment, and affordable education. Located in Northern Europe, Latvia offers globally recognized degrees, modern infrastructure, and strong academic support. For students planning to study in Latvia for Indian students, the country provides a welcoming atmosphere and excellent value for money.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Latvian universities follow European education standards and offer internationally accredited degrees. Institutions focus on practical learning, research, and skill development, ensuring students are prepared for global careers. Many Latvia university for international students programs are taught fully in English.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key benefits of study in Latvia for international students is the availability of flexible and industry-oriented programs. Students can choose from bachelor’s, master’s, and doctoral programs aligned with global job market needs, including technology, healthcare, and business.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Latvia welcomes students from different countries, creating a multicultural academic environment. Studying in Latvia helps students gain international exposure, develop cross-cultural skills, and build strong global networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Latvia offers growing opportunities in IT, engineering, logistics, and business sectors. Universities collaborate with industries to provide internships, practical training, and career guidance, helping students gain real-world experience while studying.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Latvian universities are increasingly focused on research and innovation, particularly in engineering, information technology, life sciences, and environmental studies. Students pursuing masters in Latvia for international students can actively participate in research projects and academic development.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Latvia offers government and university-level scholarships for international students. Due to affordable tuition fees and living costs, study in Latvia is considered one of the most cost-effective study abroad options in Europe.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities in Latvia provide strong support services, including academic advising, career counselling, healthcare assistance, and orientation programs, ensuring international students settle smoothly into academic life.'],
    ];
@endphp
<x-choose-us 
    :section-title="$sectionTitle" 
    :section-description="$sectionDescription" 
    :cards="$cards" 
/>

@include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'University of Latvia',
                'logo' => 'images/universities/Latvia_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Riga Technical University',
                'logo' => 'images/universities/Riga_logo.jpg',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Riga Stradiņš University',
                'logo' => 'images/universities/Riga_Stradiņš_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Latvia University of Life Sciences and Technologies',
                'logo' => 'images/universities/Latvia_University_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Transport and Telecommunication Institute',
                'logo' => 'images/universities/Transport_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Vidzeme University of Applied Sciences',
                'logo' => 'images/universities/Vidzeme_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Latvia',
        'highlight' => '',
        'sub_heading' => 'Latvia is home to several well-established universities recognized across Europe and beyond.',
        'footer' => 'Each university in Latvia for international students offers English-taught programs and strong academic support.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Hospitality and Tourism Management', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/fine-arts.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Latvia',
        'desc' => 'Latvia offers a wide range of English-taught programs designed to meet international standards. Many universities in Latvia for international students are known for career-focused education.',
        'footer' => 'These programs are highly popular among students choosing Latvia study abroad for quality education at an affordable cost.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€2,000 – €5,000'],
            ['label' => 'Master’s Degree', 'value' => '€3,000 – €6,000'],
            ['label' => 'MBA', 'value' => '€4,000 – €8,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€3,000 – €5,000'],
            ['label' => 'Medicine Programs', 'value' => '€10,000 – €15,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Latvia',
        'description' => 'One of the biggest advantages of study in Latvia for Indian students is affordability. Tuition fees are significantly lower compared to other European countries.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,000 – €3,500', 'note' => 'Shared apartments reduce costs'],
                ['label' => 'Food', 'value' => '€1,500 – €2,000', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => '€300 – €600', 'note' => 'Student discounts available'],
                ['label' => 'Personal Expenses', 'value' => '€700 – €1,200', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€4,500 – €7,000', 'note' => 'Depends on lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Latvia for Indian Students',
            'description' => 'Latvia offers a low cost of living compared to most European countries. On average, students spend €4,500 – €7,000 per year.',
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
        'title' => 'Student Life in Latvia: What to Expect?',
        'desc' => 'Student life in Latvia is safe, affordable, and culturally rich. Universities offer student clubs, cultural activities, sports facilities, and academic support services. With friendly locals, peaceful cities, and European exposure, study in Latvia for international students offers a balanced and rewarding experience.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Latvia?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs offered by a recognized Latvia university for international students.',
            'Meet Entry Requirements: Academic qualifications and English language proficiency.',
            'Prepare Application Documents: Transcripts, SOP, CV, and recommendation letters.',
            'Apply Online: Submit applications through the university portal.',
            'Receive Offer Letter: Obtain admission confirmation.',
            'Confirm Admission and Apply for Visa: Accept the offer and start the visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Latvia',
    'desc' => 'Students planning to study in Latvia for international students must submit:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English Proficiency Test Scores (IELTS / TOEFL or equivalent)',
        'Statement of Purpose',
        'Letters of Recommendation',
        'Valid Passport',
        'Financial Proof',
        'Offer Letter from a Latvian University',
        ]
    ];

    $guideContent = [
    'title' => 'Latvia Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Latvia. The process includes securing admission, arranging finances, applying for a visa, and submitting documents. Understanding these steps helps students pursuing Latvia study abroad avoid delays.',
    'list' => [
        'Receive an offer letter from a recognized Latvian university',
        'Pay Tuition Fee Deposit',
        'Arrange Financial Proof',
        'Submit student visa application',
        'Attend biometrics and document verification',
        'Receive visa approval and travel to Latvia',
        ],
    'footer' => 'This structured process helps students prepare confidently and focus on academic success.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students choose to study in Latvia?",
                "answer" => "Latvia offers affordable tuition fees, EU-recognized degrees, English-taught programs, and a low cost of living. This makes study in Latvia an excellent option for quality education in Europe."
            ],
            [
                "question" => "2.	Is Latvia good for international students?",
                "answer" => "Yes, Latvia is safe, student-friendly, and welcoming. Many Latvia university for international students offer strong academic support and multicultural campus environments."
            ],
            [
                "question" => "3.	Can Indian students study in Latvia?",
                "answer" => "Absolutely. Study in Latvia for Indian students is becoming popular due to affordable education, simple admission processes, and English-medium courses."
            ],
            [
                "question" => "4.	What are the top universities in Latvia for international students?",
                "answer" => "Some well-known universities in Latvia for international students include the University of Latvia, Riga Technical University, Riga Stradiņš University, and Transport and Telecommunication Institute."
            ],
            [
                "question" => "5.	Are courses taught in English in Latvia?",
                "answer" => "Yes, many programs—especially bachelor’s and masters in Latvia for international students are fully taught in English."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection