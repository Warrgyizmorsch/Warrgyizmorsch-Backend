@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Saudi Arabia – A Gateway to Quality Education and Career Growth</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Saudi Arabia consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Saudi Arabia.</p>

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
                <p style="margin-top:30px;">Study in Saudi Arabia and take a step toward a rapidly growing global education destination. Saudi Arabia is emerging as a strong hub for higher education, research, and innovation under Vision 2030. With modern campuses, government-funded universities, and increasing international collaborations, students planning to study in Saudi can access quality education along with strong career opportunities. The country offers a unique blend of academic excellence, cultural heritage, and future-focused development.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/saudiarabianew.webp" loading="lazy" alt="Study in Saudi Arabia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Saudi Arabia?';
    $sectionDescription = 'Saudi Arabia is gaining recognition as an international education destination due to its investment in higher education, world-class infrastructure, and globally aligned academic programs. Many students choose to study in Saudi Arabia for affordable education, scholarships, and strong career prospects, especially in engineering, healthcare, and business sectors.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Saudi Arabia is home to several well-ranked institutions that focus on research, innovation, and practical learning. Many Saudi Arabia universities follow international education standards and collaborate with global institutions, ensuring students receive high-quality and globally recognized degrees.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'Universities in Saudi Arabia offer industry-aligned programs designed to meet global workforce demands. Students who study in Saudi benefit from specialized courses, practical training, and research-based learning that prepare them for competitive careers.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Saudi universities host students from various countries, creating a diverse academic environment. International students gain exposure to Middle Eastern culture while developing global perspectives and cross-cultural communication skills.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Saudi Arabia is a major hub for oil & gas, engineering, construction, healthcare, finance, and technology. Universities maintain strong industry partnerships, offering internships, training programs, and career opportunities aligned with Vision 2030 initiatives.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Saudi Arabia is heavily investing in research and development. Leading Saudi Arabia universities provide advanced laboratories and funding opportunities, particularly in science, technology, medicine, and renewable energy fields.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'The Saudi government and universities offer generous scholarships for international students. Many programs cover tuition fees, accommodation, and living expenses, making study in Saudi Arabia highly affordable for eligible students.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities provide student support services such as academic advising, accommodation assistance, healthcare facilities, and cultural orientation programs to help international students adapt smoothly.'],
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
                'name' => 'King Saud University',
                'logo' => 'images/universities/Saud_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'King Abdulaziz University',
                'logo' => 'images/universities/Abdulaziz_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'King Fahd University of Petroleum & Minerals',
                'logo' => 'images/universities/Fahd_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Princess Nourah bint Abdulrahman University',
                'logo' => 'images/universities/Princess_logo.jpg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'King Khalid University',
                'logo' => 'images/universities/Khalid_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Saudi Arabia',
        'highlight' => '',
        'sub_heading' => 'Saudi Arabia is home to prestigious universities known for academic excellence and advanced research facilities.',
        'footer' => 'Each Saudi Arabia university offers modern infrastructure, research opportunities, and globally aligned curricula.'
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
            ['title' => 'Islamic Studies and Social Sciences', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Saudi Arabia',
        'desc' => 'Saudi Arabia offers a wide range of in-demand academic programs with strong career outcomes.',
        'footer' => 'These programs attract international students seeking quality education and regional as well as global career opportunities.',
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
            ['label' => 'Bachelor Degree', 'value' => '$3,000 – $8,000'],
            ['label' => 'Master’s Degree', 'value' => '$4,000 – $12,000'],
            ['label' => 'MBA', 'value' => '$10,000 – $20,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$3,000 – $10,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$2,000 – $6,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Saudi Arabia',
        'description' => 'The cost of studying in Saudi Arabia is relatively affordable compared to many Western countries. In many cases, scholarships significantly reduce or fully cover expenses.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '$1,500 – $3,500', 'note' => 'University housing is affordable'],
                ['label' => 'Food', 'value' => '$1,200 – $2,000', 'note' => 'Campus dining available'],
                ['label' => 'Transportation', 'value' => '$400 – $800', 'note' => 'Public transport and buses'],
                ['label' => 'Personal Expenses', 'value' => '$900 – $1,700', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '$4,000 – $8,000', 'note' => 'Varies by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Saudi Arabia for International Students',
            'description' => 'Living costs in Saudi Arabia are moderate and depend on the city and lifestyle. On average, students spend between $4,000 – $8,000 per year.',
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
        'title' => 'Student Life in Saudi Arabia: What to Expect?',
        'desc' => 'Student life in Saudi Arabia is safe, structured, and academically focused. Universities offer modern campuses, research facilities, sports complexes, and cultural activities. International students receive strong academic support and enjoy a unique cultural experience while studying in one of the Middle East’s fastest-developing education systems.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Saudi Arabia?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic goals.',
            'Meet Entry Requirements: Academic qualifications and language proficiency may be required.',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by university and intake.',
            'Receive Offer Letter: Admission confirmation from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and proceed with visa formalities.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Saudi Arabia',
    'desc' => 'Students planning to study in Saudi Arabia must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'Language Proficiency Proof (if required)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Scholarship Letter',
        'Offer Letter from a Saudi Arabia University',
        ]
    ];

    $guideContent = [
    'title' => 'Saudi Arabia Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Saudi Arabia. The process includes receiving admission, arranging documents, submitting an application, and completing verification. Understanding these steps helps students avoid delays and ensures a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from a Saudi University',
        'Submit Required Documents and Medical Reports',
        'Apply for Student Visa through the Saudi Embassy',
        'Visa Approval and Travel to Saudi Arabia',
        'Complete University and Immigration Registration After Arrival',
        ],
    'footer' => 'This structured process helps students planning to study in Saudi prepare effectively and focus on their academic journey.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Is Saudi Arabia a good destination for international students?",
                "answer" => "Yes, Saudi Arabia is emerging as a popular study destination due to modern universities, advanced research facilities, and strong government investment in education under Vision 2030."
            ],
            [
                "question" => "2.	Can international students study in Saudi Arabia in English?",
                "answer" => "Yes, many universities in Saudi Arabia offer English-taught programs, especially in Engineering, Medicine, Business, and Technology."
            ],
            [
                "question" => "3.	What are the popular courses to study in Saudi Arabia?",
                "answer" => "Popular courses include Engineering, Medicine, Petroleum Engineering, Business Administration, Information Technology, Islamic Studies, and Health Sciences."
            ],
            [
                "question" => "4.	What is the cost of studying in Saudi Arabia?",
                "answer" => "Tuition fees vary by university and program, but many public universities offer low-cost or fully funded education. Living expenses are generally affordable compared to Western countries."
            ],
            [
                "question" => "5.	Are scholarships available for international students in Saudi Arabia?",
                "answer" => "Yes, Saudi Arabia offers fully funded and partially funded scholarships that may cover tuition fees, accommodation, monthly stipends, and health insurance."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection