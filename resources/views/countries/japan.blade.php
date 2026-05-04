@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Japan – Your Pathway to Advanced Education and Global Careers</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Japan consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Japan.</p>

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
                <p style="margin-top:30px;">Study in Japan and take a step toward world-class education blended with cutting-edge technology, innovation, and rich cultural heritage. Japan offers globally respected degrees, advanced research facilities, and excellent career opportunities for international students. With a strong focus on academic excellence, discipline, and practical learning, study abroad Japan programs provide students with a unique and rewarding educational experience in one of the world’s most developed nations.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/japannew.webp" loading="lazy" alt="Study in Japan">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Japan?';
    $sectionDescription = 'Japan has become an increasingly popular destination for international students due to its high-quality education system, technological leadership, and safe living environment. Home to some of Asia’s top-ranked universities, Japan offers outstanding academic exposure along with global career prospects. For students planning to study in Japan, the country provides a unique blend of tradition, innovation, and international learning opportunities.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Japan is known for its advanced education system and globally ranked universities. Japanese institutions emphasize research, innovation, and technical excellence, preparing students for competitive global industries. Degrees from Japan universities for international students are highly respected worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'Many Japanese universities offer flexible programs taught in English, especially at the postgraduate level. Courses are designed to meet global industry standards, with strong focus on technology, engineering, management, and research-based learning.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Japan welcomes students from all over the world, creating a multicultural academic environment. Studying in Japan helps students gain cross-cultural understanding, global perspectives, and strong interpersonal skills—essential for international careers.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Japan is a global leader in technology, robotics, automotive, electronics, and manufacturing. Universities maintain strong industry collaborations, offering internships, research projects, and employment opportunities that enhance career prospects after study abroad Japan.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Japan is globally recognized for innovation and scientific research. Universities provide advanced laboratories and research funding, allowing students to actively participate in high-impact research, particularly in science, engineering, AI, and healthcare.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Japan offers generous funding options to international students. Government and university-funded Japan scholarship programs significantly reduce the financial burden. Many students also benefit from Japan scholarship for international students, making education more affordable.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Japanese universities offer dedicated support services, including academic guidance, language assistance, career counselling, and cultural integration programs, ensuring international students adapt smoothly to life in Japan.'],
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
                'name' => 'University of Tokyo',
                'logo' => 'images/universities/Tokyo_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Kyoto University',
                'logo' => 'images/universities/Kyoto.jpg',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Osaka University',
                'logo' => 'images/universities/Osaka_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Tohoku University',
                'logo' => 'images/universities/Tohoku_logo.jpg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Nagoya University',
                'logo' => 'images/universities/Nagoya_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Japan',
        'highlight' => '',
        'sub_heading' => 'Japan is home to prestigious universities known for academic excellence, research output, and innovation.',
        'footer' => 'These Japan universities for international students attract learners from across the globe and provide strong academic and career support.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science and IT', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Robotics and Artificial Intelligence', 'image' => 'images/courses/ai.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Japan',
        'desc' => 'Japan offers a wide range of globally recognized academic programs with strong career outcomes. These programs attract students seeking advanced education and innovation-driven careers.',
        'footer' => 'These courses are especially popular among students aiming to study in Japan for long-term global career growth.',
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
            ['label' => 'Bachelor Degree', 'value' => '¥535,800 – ¥1,000,000'],
            ['label' => 'Master’s Degree', 'value' => '¥535,800 – ¥1,200,000'],
            ['label' => 'MBA', 'value' => '¥800,000 – ¥2,000,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '¥535,800 – ¥1,000,000'],
            ['label' => 'Diploma / Certificate', 'value' => '¥400,000 – ¥800,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Japan',
        'description' => 'The cost of studying in Japan is relatively affordable compared to other developed countries. With proper financial planning and access to Japan scholarship for international students, education in Japan becomes highly cost-effective.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '¥300,000 – ¥700,000', 'note' => 'Shared housing reduces cost'],
                ['label' => 'Food', 'value' => '¥250,000 – ¥400,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '¥100,000 – ¥150,000', 'note' => 'Student passes available'],
                ['label' => 'Personal Expenses', 'value' => '¥150,000 – ¥250,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '¥900,000 – ¥1,500,000', 'note' => 'Varies by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Japan for International Students',
            'description' => 'The cost of living in Japan depends on the city and lifestyle. On average, students spend between ¥900,000 – ¥1,500,000 per year.',
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
        'title' => 'Student Life in Japan: What to Expect?',
        'desc' => 'Student life in Japan is safe, disciplined, and culturally enriching. Universities offer clubs, cultural activities, sports, and student organizations. With excellent public transport, advanced facilities, and strong academic support, Japan provides an ideal environment for learning and personal growth.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Japan?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and language proficiency (English or Japanese).',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by university and intake.',
            'Receive Offer Letter: From the selected university.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Japan',
    'desc' => 'Students planning to study abroad Japan must submit the following documents:',
    'list' => [
        'Academic Transcripts',
        'English or Japanese Language Proficiency Test Scores',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Japan scholarship documents',
        'Offer Letter from a Recognized Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Japan Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Japan. The process includes securing admission, arranging finances, submitting an application, and document verification. Understanding these steps helps students pursuing study abroad Japan avoid delays.',
    'list' => [
        'Receive Offer Letter from a Recognized Japanese University',
        'Pay Tuition Fee or Confirm Japan Scholarship for International Students',
        'Arrange Financial Proof or Scholarship Documents',
        'Apply for Certificate of Eligibility (COE)',
        'Submit Visa Application at Japanese Embassy',
        'Visa Approval and Travel to Japan',
        ],
    'footer' => 'This process helps students prepare confidently and focus on their academic goals.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Is Japan a good destination for international students?",
                "answer" => "Yes, Japan is an excellent study destination known for high-quality education, advanced technology, global universities, and a safe living environment. Japanese degrees are internationally recognised and valued by employers worldwide."
            ],
            [
                "question" => "2.	Can international students study in Japan in English?",
                "answer" => "Yes, many Japanese universities offer English-taught programs, especially at the undergraduate and postgraduate levels, making it easier for international students to study in Japan without knowing Japanese initially."
            ],
            [
                "question" => "3.	What are the popular courses to study in Japan?",
                "answer" => "Popular courses include Engineering, Computer Science, Robotics, Artificial Intelligence, Business Management, International Relations, and Medicine."
            ],
            [
                "question" => "4.	What is the cost of studying in Japan?",
                "answer" => "Tuition fees in Japan generally range between ¥500,000 – ¥1,200,000 per year, depending on the university and course. Living expenses may cost around ¥700,000 – ¥1,200,000 annually."
            ],
            [
                "question" => "5.	Are scholarships available for international students in Japan?",
                "answer" => "Yes, Japan offers several scholarships such as MEXT Scholarships, JASSO Scholarships, and university-specific grants that cover tuition fees and living expenses."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection