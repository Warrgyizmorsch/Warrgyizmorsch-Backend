@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Lithuania – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Lithuania  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Lithuania.</p>

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
                <p style="margin-top:30px;">Study in Lithuania and take the first step toward a globally recognized education. Lithuania has become a popular destination for international students seeking quality education, affordable tuition, and vibrant student life. With a strong reputation for academic excellence, research, and career opportunities, studying in Lithuania offers a unique European experience. Students can focus on building a successful academic and professional future at a Lithuania university for international students, benefiting from high-quality education and supportive campus environments.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/lithuanianew.webp" loading="lazy" alt="Study in lithuania">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Lithuania?';
    $sectionDescription = 'Lithuania is emerging as a preferred destination for international students due to its affordable tuition, globally recognized degrees, and growing economy. Known for its welcoming culture, safe cities, and English-taught programs, Lithuania offers an ideal environment for students to study in Lithuania. Its universities have strong academic programs and partnerships with industries, ensuring both educational and professional development.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Universities in Lithuania are known for research-led teaching, modern infrastructure, and innovative programs. Institutions emphasize practical learning, critical thinking, and skill development to prepare students for global careers. Degrees from a Lithuania university are recognized across Europe and worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key advantages of studying in Lithuania is the flexibility to choose programs aligned with your career goals. Students can gain practical experience through internships, projects, and research opportunities offered by Lithuania university for international students. This ensures graduates are job-ready and industry-prepared.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Lithuania welcomes students from across the globe, creating a multicultural and inclusive campus environment. Studying in such a setting helps students develop global perspectives, intercultural communication skills, and valuable international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Lithuania’s growing economy and emerging industries, especially in IT, biotechnology, and engineering, provide excellent career exposure. Universities in Lithuania maintain partnerships with companies, offering internships, part-time work, and post-graduate employment options to enhance employability.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Lithuania universities are known for their research contributions, particularly in technology, engineering, and life sciences. Students can participate in research projects, gain hands-on experience, and contribute to innovation-driven initiatives.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Lithuania offers a range of scholarships, grants, and funding options for international students. Many students also secure financial support or loans to cover tuition and living costs while they study in Lithuania.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Lithuania university for international students provides comprehensive support services, including academic guidance, career counselling, healthcare, and cultural integration programs. These resources ensure a smooth transition and a fulfilling student life.'],
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
                'name' => 'Vilnius University',
                'logo' => 'images/universities/Vilnius_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Kaunas University of Technology',
                'logo' => 'images/universities/Kaunas_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Vytautas Magnus University',
                'logo' => 'images/universities/Vytautas_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Klaipėda University',
                'logo' => 'images/universities/Klaipėda_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'ISM University of Management and Economics',
                'logo' => 'images/universities/ISM_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Mykolas Romeris University',
                'logo' => 'images/universities/Mykolas_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Lithuanian University of Health Sciences',
                'logo' => 'images/universities/Lithuanian_Sciences_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'SMK University Lithuania',
                'logo' => 'images/universities/SMK_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Lithuania',
        'highlight' => '',
        'sub_heading' => 'Lithuania is home to several prestigious universities recognized for their academic excellence, research output, and global partnerships. These Lithuania universities attract thousands of international students annually.',
        'footer' => ''
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Lithuania',
        'desc' => 'Lithuania offers a variety of internationally recognized programs designed to meet global industry demands. Universities in Lithuania are particularly strong in technology, business, and health sciences.',
        'footer' => 'These programs are popular among students seeking quality education and strong career prospects.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€3,000 – €10,000'],
            ['label' => 'Master’s Degree', 'value' => '€4,000 – €12,000'],
            ['label' => 'MBA', 'value' => '€5,000 – €14,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€3,000 – €8,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€2,500 – €6,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Lithuania',
        'description' => 'Studying in Lithuania is relatively affordable compared to other European countries. Tuition fees vary depending on the program and university. Scholarships or financial support can help manage costs while you study in Lithuania.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,000 – €4,000', 'note' => 'Shared accommodation reduces costs'],
                ['label' => 'Food', 'value' => '€1,500 – €2,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '€400 – €800', 'note' => 'Student travel cards available'],
                ['label' => 'Personal Expenses', 'value' => '€1,000 – €1,500', 'note' => 'Includes leisure and utilities'],
                ['label' => 'Total', 'value' => '€5,000 – €8,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Lithuania for Indian Students',
            'description' => 'Living costs in Lithuania are affordable and depend on the city and lifestyle. Students typically spend between €5,000 – €8,000 per year.',
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
        'title' => 'Student Life in Lithuania: What to Expect?',
        'desc' => 'Student life in Lithuania is vibrant and culturally rich. Universities in Lithuania offer clubs, societies, sports, and cultural events, helping international students feel at home. Friendly locals, safe cities, and excellent academic support ensure a balanced and rewarding experience. International student offices provide guidance on academics, employment, and personal well-being, making Lithuania an ideal destination to study, live, and grow.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Lithuania?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are necessary.',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the student visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Lithuania',
    'desc' => 'Students from India must submit the following documents to apply for a Lithuania university:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Loan Documents',
        'Offer Letter from an Approved Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Lithuania Study Visa Process: Step-by-Step Guide',
    'desc' => 'A student visa is required to study in Lithuania. The process involves securing admission, arranging funds, applying online, and submitting documents.',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Secure admission from a recognized Lithuania university.',
        'Pay Tuition Fee Deposit: Pay the required deposit as per the offer letter.',
        'Arrange Financial Proof: Show sufficient funds to cover tuition and living costs.',
        'Complete Online Visa Application: Submit the application through the official Lithuanian visa portal.',
        'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, and academic records.',
        'Visa Approval and Travel to Lithuania: After approval, travel to Lithuania and register with local authorities.',
        ],
    'footer' => ''
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Lithuania?",
                "answer" => "Lithuania offers affordable tuition, globally recognized degrees, and a safe, English-speaking environment. With strong academic programs and opportunities for research and internships, it’s a great destination for international students planning to study in Lithuania."
            ],
            [
                "question" => "2.	Which are the top universities in Lithuania for international students?",
                "answer" => "<p>Some of the leading Lithuania universities for international students include:</p>
                <ol>
                    <li>Vilnius University</li>
                    <li>Kaunas University of Technology</li>
                    <li>Vytautas Magnus University</li>
                    <li>Klaipėda University</li>
                    <li>ISM University of Management and Economics</li>
                </ol>"
            ],
            [
                "question" => "3.	What courses can I study in Lithuania?",
                "answer" => "<p>Universities in Lithuania offer programs in:</p>
                <ol>
                    <li>Engineering</li>
                    <li>Business and Management</li>
                    <li>Computer Science / IT</li>
                    <li>Medicine and Health Sciences</li>
                    <li>Social Sciences and Humanities</li>
                </ol>"
            ],
            [
                "question" => "4.	What is the cost of studying in Lithuania?",
                "answer" => "<p>Tuition fees vary by course and university. On average:</p>
                <ol>
                    <li>Undergraduate: €3,000 – €10,000/year</li>
                    <li>Master’s: €4,000 – €12,000/year</li>
                    <li>MBA: €5,000 – €14,000/year</li>
                    <li>PhD: €3,000 – €8,000/year</li>
                </ol>"
            ],
            [
                "question" => "5.	How much is the living cost in Lithuania?",
                "answer" => "Living expenses for international students range from €5,000 – €8,000 per year, including housing, food, transportation, and personal costs."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection