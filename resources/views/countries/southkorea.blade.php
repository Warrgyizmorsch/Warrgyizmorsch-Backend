@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in South Korea – Achieve Academic Excellence and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in South Korea consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in South Korea.</p>

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
                <p style="margin-top:30px;">Study in South Korea and take the first step toward a globally competitive education system known for innovation, technology, and academic excellence. South Korea has become a top choice for students planning to study abroad South Korea due to its world-class universities, affordable education, and strong post-study career prospects. With cutting-edge research, advanced infrastructure, and a safe student-friendly environment, study Korea programs offer an ideal balance of education and global exposure.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/southkoreanew.webp" loading="lazy" alt="Study in South Korea">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in South Korea?';
    $sectionDescription = 'South Korea is rapidly emerging as a leading destination for international education, especially in technology, engineering, and business studies. Home to global brands like Samsung, Hyundai, LG, and Kia, the country offers excellent academic exposure and industry integration. For students planning to study in Korea, the country provides high-quality education, modern campuses, and strong employment opportunities.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'South Korea is home to globally ranked universities known for academic rigor, innovation, and research excellence. Universities focus on practical learning, advanced technology, and industry-aligned curricula, preparing students for competitive global careers. Degrees from universities in Korea for international students are internationally recognized and respected.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major benefits of study in South Korea is its career-focused education system. Universities offer specialized programs, interdisciplinary courses, and hands-on training designed to meet global industry demands. Many programs include internships, lab work, and real-world projects.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'South Korea welcomes students from all over the world, offering a rich blend of traditional culture and modern lifestyle. Studying in a multicultural environment helps students build global perspectives, adaptability, and cross-cultural communication skills—essential for international careers.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'South Korea is a global hub for technology, electronics, automotive, AI, and entertainment industries. Universities maintain close ties with major corporations, providing internships, part-time work opportunities, and career support. This makes study abroad South Korea highly attractive for students seeking global work exposure.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'South Korea is a leader in research and innovation, especially in engineering, robotics, biotechnology, and data science. Students actively participate in research projects, gaining valuable academic and professional experience through state-of-the-art facilities.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'The Korean government and universities offer generous funding options such as the Global Korea Scholarship (GKS). Many international students benefit from South Korea scholarship programs that cover tuition fees, living expenses, and even airfare, making study Korea affordable.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'South Korean universities provide strong support systems, including academic advising, language assistance, career guidance, healthcare services, and cultural integration programs, ensuring a smooth transition for international students.'],
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
                'name' => 'Seoul National University',
                'logo' => 'images/universities/Seoul_logo.svg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Korea University',
                'logo' => 'images/universities/Korea_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Yonsei University',
                'logo' => 'images/universities/Yonsei_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'KAIST (Korea Advanced Institute of Science & Technology)',
                'logo' => 'images/universities/KAIST_logo.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'POSTECH',
                'logo' => 'images/universities/POSTECH_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in South Korea',
        'highlight' => '',
        'sub_heading' => 'South Korea is home to prestigious institutions known for academic excellence and research leadership. These are some of the top South Korea university for international students:',
        'footer' => 'These universities in Korea for international students attract thousands of global learners every year and offer strong academic and career support.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science and IT', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Artificial Intelligence and Data Science', 'image' => 'images/courses/ai.jpg'],
            ['title' => 'Media, Film, and Entertainment Studies', 'image' => 'images/courses/it.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in South Korea',
        'desc' => 'South Korea offers a wide range of globally recognized academic programs with strong career outcomes. These programs are especially popular among international students.',
        'footer' => '',
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
            ['label' => 'Bachelor Degree', 'value' => '$3,000 – $7,000'],
            ['label' => 'Master’s Degree', 'value' => '$4,000 – $9,000'],
            ['label' => 'MBA', 'value' => '$6,000 – $12,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$4,000 – $8,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$2,000 – $5,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in South Korea',
        'description' => 'The cost of education in South Korea is relatively affordable compared to other developed countries. Scholarships and financial aid further reduce expenses for students planning to study in Korea.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '$2,000 – $4,000', 'note' => 'Dormitories are affordable'],
                ['label' => 'Food', 'value' => '$1,500 – $2,500', 'note' => 'Campus meals are economical'],
                ['label' => 'Transportation', 'value' => '$500 – $800', 'note' => 'Student discounts available'],
                ['label' => 'Personal Expenses', 'value' => '$1,000 – $2,000', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => '$6,000 – $10,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in South Korea for International Students',
            'description' => 'The cost of living in South Korea depends on the city and lifestyle. On average, students spend between $6,000 – $10,000 per year.',
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
        'title' => 'Student Life in South Korea: What to Expect?',
        'desc' => 'Student life in South Korea is dynamic and exciting, combining modern city life with rich cultural traditions. Universities offer clubs, festivals, sports, and cultural exchange programs. With safe cities, advanced public transport, and friendly campuses, study in South Korea provides a rewarding academic and personal experience. International student offices support academics, career planning, and well-being, helping students thrive.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in South Korea?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and language proficiency (English or Korean).',
            'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in South Korea',
    'desc' => 'Students planning to study abroad South Korea must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English or Korean Language Proficiency Scores',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or South Korea scholarship documents',
        'Offer Letter from a Recognized University',
        ]
    ];

    $guideContent = [
    'title' => 'South Korea Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in South Korea. The process includes securing admission, arranging finances, applying online, and submitting documents. Understanding these steps helps students pursuing study abroad South Korea avoid delays and ensure a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from an Approved Institution',
        'Pay Tuition Fee Deposit',
        'Arrange Financial Proof or South Korea scholarship',
        'Apply for D-2 Student Visa',
        'Submit Documents and Biometrics',
        'Receive Visa Approval and Travel to South Korea',
        ],
    'footer' => 'This structured process helps students planning to study Korea prepare confidently and focus on their academic journey.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in South Korea?",
                "answer" => "South Korea offers world-class universities, innovative programs, and strong career opportunities. Students can gain global exposure, practical skills, and experience in a safe and modern environment. Many opt for study abroad South Korea programs to enhance their international career prospects."
            ],
            [
                "question" => "2.	What are the top universities in South Korea for international students?",
                "answer" => "Some of the best universities in Korea for international students include Seoul National University, Korea University, Yonsei University, KAIST, POSTECH, and Sungkyunkwan University. These institutions provide excellent academic programs and research opportunities."
            ],
            [
                "question" => "3.	How can I apply to study in South Korea?",
                "answer" => "To study in South Korea, research universities and programs, meet entry requirements, prepare documents (transcripts, SOP, recommendation letters), check application deadlines, receive an offer letter, and apply for a student visa."
            ],
            [
                "question" => "4.	What courses are popular among international students in South Korea?",
                "answer" => "Popular programs include Engineering, Business and Management, Computer Science, Data Science, Media & Film, and Social Sciences. Many students choose these fields to benefit from Korea’s strong industry links."
            ],
            [
                "question" => "5.	Are scholarships available for international students in South Korea?",
                "answer" => "Yes, the Korean government and universities offer various funding options, including the Global Korea Scholarship (South Korea scholarship), which can cover tuition, living expenses, and airfare."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection