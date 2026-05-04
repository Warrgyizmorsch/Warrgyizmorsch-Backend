@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Israel – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Israel consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Israel.</p>

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
                <p style="margin-top:30px;">Study in Israel and take the first step toward a globally recognized education. Israel is known for its high-quality universities, innovative research, and multicultural environment. Students planning to study abroad in Israel can choose from a wide range of programs and benefit from affordable tuition, modern campuses, and strong post-study career prospects. With its safe cities and welcoming culture, Israel is emerging as a top destination for international students seeking quality education and global opportunities.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/israelnew.webp" loading="lazy" alt="Study in Israel">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Israel?';
    $sectionDescription = 'Israel has become a popular destination for international students due to its quality education system, internationally ranked universities, and strong connections with industries in Asia. Known as a hub for technology, engineering, and healthcare, Israel provides students with excellent academic exposure and career opportunities. Students looking to study in Israel from India will find an English-friendly, safe, and multicultural environment that fosters personal and professional growth.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Israel is home to several internationally recognized universities for international students. Institutions emphasize research, innovation, and hands-on learning. Academic programs are designed to equip students with critical thinking, practical skills, and global perspectives, preparing them for careers worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key advantages of study abroad in Israel is the flexibility in course selection. Students can choose programs aligned with industry needs, participate in internships, and gain practical exposure to complement classroom learning, ensuring they graduate with job-ready skills.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Israelese universities welcome students from all over the world, offering a multicultural campus environment. Studying in Israel helps students build cross-cultural communication skills, develop international networks, and gain a global perspective.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Israel is a leading hub for technology, electronics, manufacturing, and healthcare. Universities collaborate with local and multinational companies, providing internships, research projects, and career support services that enhance employability for students planning to study in Israel.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Israel is known for its cutting-edge research, especially in technology, biotechnology, and engineering. Israel universities for international students offer access to modern labs, research centers, and funding opportunities, allowing students to gain hands-on experience and contribute to innovation.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Various universities and organizations provide scholarships in Israel for international students. These financial aids help cover tuition fees and living expenses, making Israel an affordable and attractive option for higher education abroad.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Israelese institutions provide robust support systems, including academic advising, career counselling, health services, and cultural integration programs, ensuring that international students feel supported and comfortable while studying in Israel.'],
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
                'name' => 'Hebrew University of Jerusalem',
                'logo' => 'images/universities/Hebrew_logo.svg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Tel Aviv University',
                'logo' => 'images/universities/Tel_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Weizmann Institute of Science',
                'logo' => 'images/universities/Weizmann_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Technion – Israel Institute of Technology',
                'logo' => 'images/universities/Technion_logo.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Bar-Ilan University',
                'logo' => 'images/universities/Bar_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Israel',
        'highlight' => '',
        'sub_heading' => 'Israel is home to several prestigious universities for international students, known for academic excellence and global rankings:',
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
        'title' => 'Popular Courses to Study in Israel',
        'desc' => 'Israel offers a broad range of programs recognized worldwide. Universities focus on practical, industry-oriented education, making study abroad in Israel rewarding for career-oriented students. Popular courses include:',
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
            ['label' => 'Bachelor Degree', 'value' => '$5,000 – $12,000'],
            ['label' => 'Master’s Degree', 'value' => '$6,000 – $15,000'],
            ['label' => 'MBA', 'value' => '$12,000 – $25,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$4,000 – $10,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$3,000 – $7,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Israel',
        'description' => 'The cost of studying in Israel varies by university and program. Scholarships and financial planning help students manage expenses effectively.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '$3,000 – $6,000', 'note' => 'Higher in major cities'],
                ['label' => 'Food', 'value' => '$2,000 – $3,000', 'note' => 'Groceries & dining'],
                ['label' => 'Transportation', 'value' => '$800 – $1,200', 'note' => 'Buses & trains'],
                ['label' => 'Personal Expenses', 'value' => '$1,500 – $2,500', 'note' => 'Utilities & lifestyle'],
                ['label' => 'Total', 'value' => '$7,500 – $12,000', 'note' => 'Costly but high quality'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Israel for International Students',
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
        'title' => 'Student Life in Israel: What to Expect?',
        'desc' => 'Student life in Israel is vibrant and culturally rich. Universities offer clubs, sports, cultural events, and student societies. With safe cities, friendly locals, and robust academic support, Israel provides a balanced environment for learning, networking, and personal growth. Israel universities for international students also offer support for academic guidance, career counselling, and cultural integration.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Israel?',
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
    'title' => 'Documents Required to Study in Israel',
    'desc' => 'Students must submit the following to pursue study in Israel:',
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
    'title' => 'Israel Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is mandatory to study in Israel. The process includes getting admission, arranging finances, submitting the online application, and completing document verification:',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Official offer from a recognized Israelese university.',
        'Pay Tuition Fee Deposit: Secure your seat by paying the required deposit.',
        'Arrange Financial Proof / Scholarship Documents: Show sufficient funds or proof of scholarships in Israel for international students.',
        'Complete Online Visa Application: Submit your Israel student visa application online.',
        'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, academic transcripts, and SOP.',
        'Visa Decision and Travel to Israel: Once approved, travel to Israel and register with immigration authorities.',
        ],
    'footer' => 'Following these steps helps students study abroad in Israel smoothly and focus on their academic goals.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Israel?",
                "answer" => "Israel offers high-quality education, globally recognized degrees, affordable tuition, and strong career opportunities. Students benefit from a safe, multicultural environment and can access Israel universities for international students with industry-focused programs."
            ],
            [
                "question" => "2.	What courses are popular for international students in Israel?",
                "answer" => "Popular programs include Engineering, Business, Computer Science, Medicine, Social Sciences, and Humanities. Many courses are designed to prepare students for global careers, making study abroad in Israel a great option."
            ],
            [
                "question" => "3.	How can I apply to Israel universities for international students?",
                "answer" => "The process involves researching universities, meeting entry requirements, preparing documents (transcripts, SOP, recommendation letters), checking deadlines, receiving an offer letter, and applying for a student visa."
            ],
            [
                "question" => "4.	Are there scholarships available for international students in Israel?",
                "answer" => "Yes! Many universities and organizations provide scholarships in Israel for international students to cover tuition and living costs. Students can also combine scholarships with personal funds for financial support."
            ],
            [
                "question" => "5.	How much does it cost to study in Israel?",
                "answer" => "Tuition varies by program and university, ranging from $4,000 to $18,000 per year. Living expenses are around $6,000 – $10,000 annually, depending on city and lifestyle. Scholarships can help reduce costs."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection