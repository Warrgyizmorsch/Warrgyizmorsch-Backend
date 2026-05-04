@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Malaysia – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Malaysia consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Malaysia.</p>

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
                <p style="margin-top:30px;">Study in Malaysia and take the first step toward an internationally recognised and affordable education. Malaysia has become a popular destination for students seeking quality education, modern infrastructure, and global exposure at a reasonable cost. With world-ranked universities, diverse culture, and strong academic partnerships, Malaysia offers an excellent environment for international students. From admission guidance to scholarships and visa support, students can confidently plan their journey to build a successful academic and professional future in Southeast Asia.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/malaysianew.webp" loading="lazy" alt="Study in Malaysia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Malaysia?';
    $sectionDescription = 'Malaysia has rapidly emerged as a preferred study destination due to its high-quality education system, globally recognised degrees, and affordable living costs. Home to branch campuses of top international universities and strong industry links, Malaysia offers excellent academic exposure and career opportunities. For students planning to study in Malaysia, the country provides a safe, multicultural, and English-friendly learning environment.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Malaysia is home to reputed public and private institutions known for academic excellence, research, and industry-focused education. Many universities in Malaysia for international students follow global standards and collaborate with universities from the UK, Australia, and the USA, ensuring internationally recognised degrees.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major benefits of studying in Malaysia is its flexible education system. Students can choose from specialised, career-oriented programs designed to meet global industry demands. Many courses include internships, practical training, and project-based learning to enhance employability.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Malaysia is a multicultural country welcoming students from across the world. Studying in such a diverse environment helps students gain global perspectives, improve communication skills, and build strong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Malaysia offers growing opportunities in sectors such as technology, engineering, business, healthcare, and hospitality. Universities maintain close ties with industries, offering internships, industrial training, and exposure to real-world work environments.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Malaysian universities actively promote research and innovation, particularly in engineering, technology, medicine, and applied sciences. Students are encouraged to participate in research projects, gaining valuable academic and practical experience.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Malaysia provides various funding opportunities for international students. Popular options include the Malaysia International Scholarship and multiple government- and university-funded programs. Many students also benefit from a scholarship in Malaysia for international students, making education highly affordable.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities offer dedicated international student support, including academic guidance, accommodation assistance, healthcare services, and cultural integration programs, ensuring a smooth transition to life in Malaysia.'],
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
                'name' => 'University of Malaya (University of Malaysia)',
                'logo' => 'images/universities/Malaya_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Universiti Putra Malaysia',
                'logo' => 'images/universities/Putra_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Universiti Kebangsaan Malaysia',
                'logo' => 'images/universities/Kebangsaan_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Universiti Sains Malaysia',
                'logo' => 'images/universities/Sains_logo.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Taylor’s University',
                'logo' => 'images/universities/Taylor’s_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Malaysia',
        'highlight' => '',
        'sub_heading' => 'Malaysia is home to reputed institutions offering globally recognised degrees and excellent academic facilities. Many universities in Malaysia for international students consistently rank well worldwide.',
        'footer' => 'These universities attract thousands of international students each year and provide strong academic and career support.'
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
            ['title' => 'Hospitality and Tourism', 'image' => 'images/courses/it.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Malaysia',
        'desc' => 'Malaysia offers a wide range of globally recognised academic programs with strong career outcomes. These programs are especially attractive due to their affordability and quality.',
        'footer' => 'These courses are widely chosen by students planning to study in Malaysia for quality education and international exposure.',
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
            ['label' => 'Bachelor Degree', 'value' => 'MYR 15,000 – 35,000'],
            ['label' => 'Master’s Degree', 'value' => 'MYR 20,000 – 45,000'],
            ['label' => 'MBA', 'value' => 'MYR 30,000 – 60,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'MYR 20,000 – 40,000'],
            ['label' => 'Diploma / Certificate', 'value' => 'MYR 10,000 – 20,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Malaysia',
        'description' => 'One of the biggest advantages of studying in Malaysia is affordability. Tuition fees and living costs are significantly lower compared to many Western countries. Scholarships or a scholarship in Malaysia for international students further reduce financial burden.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => 'MYR 6,000 – 10,000', 'note' => 'Shared accommodation reduces cost'],
                ['label' => 'Food', 'value' => 'MYR 3,000 – 4,500', 'note' => 'Local food is affordable'],
                ['label' => 'Transportation', 'value' => 'MYR 600 – 1,200', 'note' => 'Public transport is economical'],
                ['label' => 'Personal Expenses', 'value' => 'MYR 1,500 – 2,500', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => 'MYR 12,000 – 18,000', 'note' => 'Varies by city and lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Malaysia for International Students',
            'description' => 'Malaysia offers a very affordable cost of living for students. On average, international students spend between MYR 12,000 – 18,000 per year, depending on lifestyle and city.',
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
        'title' => 'Student Life in Malaysia: What to Expect?',
        'desc' => 'Student life in Malaysia is vibrant, affordable, and culturally enriching. Universities offer clubs, sports, cultural events, and student societies that help international students feel welcomed. With modern campuses, friendly locals, safe cities, and excellent academic support, Malaysia provides a balanced and rewarding student experience.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Malaysia?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs that match academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Submit Application: Apply directly to the university or through authorised channels.',
            'Receive Offer Letter: Conditional or unconditional offer from the institution.',
            'Accept Offer and Begin Visa Process: Confirm admission and proceed with visa application.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Malaysia',
    'desc' => 'Students planning to study in Malaysia must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English Proficiency Test Scores (IELTS / TOEFL or equivalent)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Scholarship Documents',
        'Offer Letter from a Recognised Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Malaysia Study Visa Process: Step-by-Step Guide',
    'desc' => 'A student visa is required to study in Malaysia. The process includes securing admission, arranging finances, applying online, and submitting documents. Understanding these steps helps students avoid delays and ensures a smooth visa process.',
    'list' => [
        'Receive Offer Letter from a Recognised Institution',
        'Accept the Offer and Pay Required Fees',
        'Apply for Student Pass Approval (VAL)',
        'Submit Documents and Medical Reports',
        'Visa Approval and Travel to Malaysia',
        'Complete Immigration Registration After Arrival',
        ],
    'footer' => 'This structured process helps international students prepare effectively and focus on their academic goals.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Malaysia?",
                "answer" => "Malaysia offers high-quality education, affordable tuition fees, and globally recognised degrees. Many universities in Malaysia for international students follow international academic standards, making Malaysia a popular and cost-effective study destination."
            ],
            [
                "question" => "2.	What are the top universities in Malaysia for international students?",
                "answer" => "Some of the leading universities in Malaysia for international students include the University of Malaya (University of Malaysia), Universiti Putra Malaysia, Universiti Sains Malaysia, Taylor’s University, and Monash University Malaysia."
            ],
            [
                "question" => "3.	What courses are popular to study in Malaysia?",
                "answer" => "Popular courses to study in Malaysia include Engineering, Business and Management, Computer Science, Information Technology, Medicine, Hospitality, and Social Sciences."
            ],
            [
                "question" => "4.	What is the cost of studying in Malaysia?",
                "answer" => "The cost of studying in Malaysia is affordable compared to many Western countries. Tuition fees range from MYR 15,000 to MYR 60,000 per year, depending on the course and university."
            ],
            [
                "question" => "5.	What scholarships are available in Malaysia for international students?",
                "answer" => "Malaysia offers several funding options, including the Malaysia International Scholarship and university-specific programs. Many students also apply for a scholarship in Malaysia for international students to reduce tuition and living expenses."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection