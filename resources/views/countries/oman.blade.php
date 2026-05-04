@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Oman – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Oman consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Oman.</p>

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
                <p style="margin-top:30px;">Study in Oman and take the first step toward a globally recognized education. Oman is known for its high-quality universities, innovative research, and multicultural environment. Students planning to study abroad in Oman can choose from a wide range of programs and benefit from affordable tuition, modern campuses, and strong post-study career prospects. With its safe cities and welcoming culture, Oman is emerging as a top destination for international students seeking quality education and global opportunities.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/omannew.webp" loading="lazy" alt="Study in Oman">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Oman?';
    $sectionDescription = 'Oman has become a popular destination for international students due to its quality education system, internationally ranked universities, and strong connections with industries in Asia. Known as a hub for technology, engineering, and healthcare, Oman provides students with excellent academic exposure and career opportunities. Students looking to study in Oman from India will find an English-friendly, safe, and multicultural environment that fosters personal and professional growth.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Oman is home to several internationally recognized universities for international students. Institutions emphasize research, innovation, and hands-on learning. Academic programs are designed to equip students with critical thinking, practical skills, and global perspectives, preparing them for careers worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key advantages of study abroad in Oman is the flexibility in course selection. Students can choose programs aligned with industry needs, participate in internships, and gain practical exposure to complement classroom learning, ensuring they graduate with job-ready skills.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Omanese universities welcome students from all over the world, offering a multicultural campus environment. Studying in Oman helps students build cross-cultural communication skills, develop international networks, and gain a global perspective.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Oman is a leading hub for technology, electronics, manufacturing, and healthcare. Universities collaborate with local and multinational companies, providing internships, research projects, and career support services that enhance employability for students planning to study in Oman.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Oman is known for its cutting-edge research, especially in technology, biotechnology, and engineering. Oman universities for international students offer access to modern labs, research centers, and funding opportunities, allowing students to gain hands-on experience and contribute to innovation.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Various universities and organizations provide scholarships in Oman for international students. These financial aids help cover tuition fees and living expenses, making Oman an affordable and attractive option for higher education abroad.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Omanese institutions provide robust support systems, including academic advising, career counselling, health services, and cultural integration programs, ensuring that international students feel supported and comfortable while studying in Oman.'],
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
                'name' => 'Sultan Qaboos University',
                'logo' => 'images/universities/Sultan_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'University of Nizwa',
                'logo' => 'images/universities/Nizwa_logo.avif',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Dhofar University',
                'logo' => 'images/universities/Dhofar_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'German University of Technology in Oman (GUtech)',
                'logo' => 'images/universities/GUtech_logo.jpg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Middle East College',
                'logo' => 'images/universities/Middle_East_logo.webp',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Oman',
        'highlight' => '',
        'sub_heading' => 'Oman is home to several prestigious universities for international students, known for academic excellence and global rankings:',
        'footer' => 'These universities attract international students each year and provide strong support for academics and careers.'
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
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Oman',
        'desc' => 'Oman offers a broad range of programs recognized worldwide. Universities focus on practical, industry-oriented education, making study abroad in Oman rewarding for career-oriented students. Popular courses include:',
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
            ['label' => 'Bachelor Degree', 'value' => '$3,000 – $8,000 (approx.)'],
            ['label' => 'Master’s Degree', 'value' => '$4,000 – $10,000 (approx.)'],
            ['label' => 'MBA', 'value' => '$6,000 – $15,000 (approx.)'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$5,000 – $12,000 (approx.)'],
            ['label' => 'Diploma / Certificate', 'value' => '$2,000 – $6,000 (approx.)'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Oman',
        'description' => 'The cost of studying in Oman varies by university and program. Scholarships and financial planning help students manage expenses effectively.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '$1,500 – $3,800', 'note' => 'Shared & private options'],
                ['label' => 'Food', 'value' => '$1,500 – $2,800', 'note' => 'Local groceries & meals'],
                ['label' => 'Transportation', 'value' => '$400 – $900', 'note' => 'Buses & taxis'],
                ['label' => 'Personal Expenses', 'value' => '$800 – $1,500', 'note' => 'Utilities & leisure'],
                ['label' => 'Total', 'value' => '$4,200 – $9,000', 'note' => 'Depends on lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Oman for International Students',
            'description' => 'The cost of living varies by city and lifestyle. On average, students spend between $3,000 – $6,000 per year.',
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
        'title' => 'Student Life in Oman: What to Expect?',
        'desc' => 'Student life in Oman is vibrant and culturally rich. Universities offer clubs, sports, cultural events, and student societies. With safe cities, friendly locals, and robust academic support, Oman provides a balanced environment for learning, networking, and personal growth. Oman universities for international students also offer support for academic guidance, career counselling, and cultural integration.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Oman?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic transcripts and English proficiency tests may be required.',
            'Prepare Application Documents: Transcripts, recommendation letters, and statement of purpose.',
            'Check Application Deadlines: Deadlines vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and complete the student visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Oman',
    'desc' => 'Students must submit the following to pursue study in Oman:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (TOEFL / IELTS / other)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or scholarship documents',
        'Offer Letter from an Approved Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Oman Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is mandatory to study in Oman. The process includes getting admission, arranging finances, submitting the online application, and completing document verification:',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Official offer from a recognized Omanese university.',
        'Pay Tuition Fee Deposit: Secure your seat by paying the required deposit.',
        'Arrange Financial Proof / Scholarship Documents: Show sufficient funds or proof of scholarships in Oman for international students.',
        'Complete Online Visa Application: Submit your Oman student visa application online.',
        'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, academic transcripts, and SOP.',
        'Visa Decision and Travel to Oman: Once approved, travel to Oman and register with immigration authorities.',
        ],
    'footer' => 'Following these steps helps students study abroad in Oman smoothly and focus on their academic goals.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Oman?",
                "answer" => "Oman offers high-quality education, globally recognized degrees, affordable tuition, and strong career opportunities. Students benefit from a safe, multicultural environment and can access Oman universities for international students with industry-focused programs."
            ],
            [
                "question" => "2.	What courses are popular for international students in Oman?",
                "answer" => "Popular programs include Engineering, Business, Computer Science, Medicine, Social Sciences, and Humanities. Many courses are designed to prepare students for global careers, making study abroad in Oman a great option."
            ],
            [
                "question" => "3.	How can I apply to Oman universities for international students?",
                "answer" => "The process involves researching universities, meeting entry requirements, preparing documents (transcripts, SOP, recommendation letters), checking deadlines, receiving an offer letter, and applying for a student visa."
            ],
            [
                "question" => "4.	Are there scholarships available for international students in Oman?",
                "answer" => "Yes! Many universities and organizations provide scholarships in Oman for international students to cover tuition and living costs. Students can also combine scholarships with personal funds for financial support."
            ],
            [
                "question" => "5.	How much does it cost to study in Oman?",
                "answer" => "Tuition varies by program and university, ranging from $4,000 to $18,000 per year. Living expenses are around $6,000 – $10,000 annually, depending on city and lifestyle. Scholarships can help reduce costs."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection