@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in China – World-Class Education with Global Career Opportunities</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in China consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in China.</p>

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
                <p style="margin-top:30px;">Study in China and take a step toward high-quality, globally recognised education at an affordable cost. China has rapidly become one of the most popular destinations for international students due to its advanced universities, strong research output, and generous China scholarship opportunities. With a wide range of English-taught programs and world-class infrastructure, China offers an ideal environment for students aiming for academic excellence and global career growth.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/chinanew.webp" loading="lazy" alt="Study in China">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in China?';
    $sectionDescription = 'China is emerging as a global education hub, attracting students from across the world. With internationally ranked institutions, cutting-edge research facilities, and strong government support, China offers outstanding academic exposure and career opportunities. For students planning to study in China, the country provides a safe, culturally rich, and affordable study environment.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'China is home to several globally ranked universities known for excellence in engineering, technology, medicine, and business studies. Institutions focus on research, innovation, and practical learning, preparing students for competitive international careers. Many China universities for international students offer programs fully taught in English.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'Chinese universities offer a wide variety of undergraduate, postgraduate, and doctoral programs designed to meet global industry standards. Students can choose specialised courses aligned with emerging fields such as AI, data science, medicine, and international business, enhancing career readiness.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'China hosts students from over 180 countries, creating a truly multicultural learning environment. Studying in China allows students to experience one of the world’s oldest civilizations while gaining international exposure, cross-cultural communication skills, and global networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'As one of the world’s largest economies, China provides excellent exposure to global industries such as manufacturing, technology, finance, and trade. Universities collaborate closely with industries, offering internships, research opportunities, and practical training that boost employability.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'China is a global leader in research and innovation, especially in technology, engineering, healthcare, and renewable energy. Universities provide advanced laboratories, government-funded research projects, and innovation hubs where students actively participate and gain hands-on experience.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'One of the biggest advantages of studying in China is the availability of scholarships. The Chinese government and universities offer multiple China scholarships for international students, covering tuition fees, accommodation, and even living expenses. These China scholarship programs make education highly affordable for students.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Chinese universities provide extensive support services such as academic advising, language assistance, accommodation support, healthcare facilities, and cultural integration programs, ensuring international students settle comfortably.'],
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
                'name' => 'Tsinghua University',
                'logo' => 'images/universities/Tsinghua_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Peking University',
                'logo' => 'images/universities/Peking_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Fudan University',
                'logo' => 'images/universities/Fudan_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Zhejiang University',
                'logo' => 'images/universities/Zhejiang_logo.svg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Shanghai Jiao Tong University',
                'logo' => 'images/universities/Shanghai_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in China',
        'highlight' => '',
        'sub_heading' => 'China is home to some of Asia’s most prestigious and globally ranked universities, attracting thousands of international students every year.',
        'footer' => 'These institutions are among the top China universities for international students, offering strong academic support and global career opportunities.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science and IT', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'International Relations and Social Sciences', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in China',
        'desc' => 'China offers a wide range of globally recognised academic programs with strong career outcomes. Many China universities for international students are known for their specialised and research-driven courses.',
        'footer' => 'These programs are especially popular among students seeking affordable education with global recognition.',
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
            ['label' => 'Bachelor Degree', 'value' => '¥20,000 – ¥40,000'],
            ['label' => 'Master’s Degree', 'value' => '¥25,000 – ¥50,000'],
            ['label' => 'MBA', 'value' => '¥40,000 – ¥80,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '¥20,000 – ¥45,000'],
            ['label' => 'Diploma / Certificate', 'value' => '¥15,000 – ¥30,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in China',
        'description' => 'The cost of studying in China is relatively affordable compared to other major study destinations. With scholarships and funding options, international education becomes accessible for students planning to study in China.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '¥8,000 – ¥15,000', 'note' => 'On-campus housing is economical'],
                ['label' => 'Food', 'value' => '¥6,000 – ¥9,000', 'note' => 'Campus dining is affordable'],
                ['label' => 'Transportation', 'value' => '¥1,000 – ¥2,000', 'note' => 'Student discounts available'],
                ['label' => 'Personal Expenses', 'value' => '¥3,000 – ¥4,000', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => '¥18,000 – ¥30,000', 'note' => 'Depends on city and lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in China for International Students',
            'description' => 'The cost of living in China is affordable and varies by city. On average, students spend between ¥18,000 – ¥30,000 per year.',
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
        'title' => 'Student Life in China: What to Expect?',
        'desc' => 'Student life in China is vibrant, affordable, and culturally enriching. Universities offer clubs, sports, cultural activities, and international student communities. With modern campuses, safe cities, and strong academic support, China provides a balanced and rewarding student experience, making it an excellent destination for global education and personal growth.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in China?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs offered by recognised Chinese institutions.',
            'Check Eligibility Criteria: Academic qualifications and language requirements (English or Chinese).',
            'Prepare Application Documents: Transcripts, SOP, recommendation letters, and passport.',
            'Apply for Scholarships: Apply simultaneously for China scholarships for international students.',
            'Receive Admission Letter: Get offer letter and JW202/JW201 form.',
            'Apply for Student Visa: Begin the China student visa process after confirmation.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in China',
    'desc' => 'Students planning to study in China must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'Academic Transcripts and Certificates',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Medical Examination Report',
        'Financial Proof or China scholarship documents',
        'Admission Letter and JW Form',
        ]
    ];

    $guideContent = [
    'title' => 'China Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is mandatory to study in China. The process involves securing admission, arranging finances or scholarships, applying online, and submitting documents. Understanding each step helps students avoid delays and ensures a smooth visa experience.',
    'list' => [
        'Receive admission letter and JW form from a Chinese university',
        'Arrange financial proof or China scholarship documents',
        'Complete online visa application',
        'Submit documents and medical report',
        'Receive visa approval and travel to China',
        'Register with local authorities after arrival',
        ],
    'footer' => 'This structured process helps international students prepare confidently for their academic journey.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in China?",
                "answer" => "China offers high-quality education, globally ranked universities, affordable tuition fees, and excellent research opportunities. Many students choose to study in China because of strong career prospects and generous scholarship options."
            ],
            [
                "question" => "2.	Are there China scholarships for international students?",
                "answer" => "Yes, there are many China scholarships for international students, including Chinese Government Scholarships and university-specific funding. These scholarships often cover tuition fees, accommodation, and sometimes living expenses."
            ],
            [
                "question" => "3.	Can I study in China in English?",
                "answer" => "Yes, many China universities for international students offer English-taught programs, especially in engineering, medicine, business, and computer science. Language requirements vary by course and university."
            ],
            [
                "question" => "4.	Is the Chinese University of Hong Kong good for international students?",
                "answer" => "Yes, the Chinese University of Hong Kong is one of the top-ranked universities in Asia and is highly popular among international students for its academic excellence, research output, and global recognition."
            ],
            [
                "question" => "5.	What are the popular courses to study in China?",
                "answer" => "Popular courses include engineering, medicine, computer science, business and management, international relations, and data science. These programs offer strong academic and career outcomes."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection