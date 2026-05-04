@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in USA - Transform Your Education into Global Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in USA consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in USA.</p>

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
                <p style="margin-top: 30px;">Study in the USA and take the first step toward a globally recognised education system. The United States of America is home to some of the world’s top-ranked universities, cutting-edge research facilities, and unmatched career opportunities. Known for academic flexibility, innovation, and global exposure, study in the United States of America offers students an excellent platform to build strong academic foundations and successful international careers. For those planning study in USA for Indian students, the country provides world-class education, cultural diversity, and strong post-study career pathways.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/usanew.webp" loading="lazy" alt="Study in usa">
            </div>
        </div>
    </section>

<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in USA?';
    $sectionDescription = 'The USA is one of the most preferred destinations for international students due to its high academic standards, diverse course options, and strong industry connections. With thousands of globally recognised institutions, study in the USA offers unmatched learning experiences and career prospects across multiple disciplines.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'The USA hosts many of the world’s top universities, known for academic excellence, research output, and innovation. Institutions focus on critical thinking, practical learning, and real-world applications, preparing students for global competitiveness.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the biggest advantages of study in the USA is academic flexibility. Students can choose majors, minors, and electives, allowing them to customize their education based on interests and career goals. This flexibility enhances employability and skill development.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'The USA attracts students from all over the world, creating a multicultural learning environment. Studying in such diversity helps students develop global perspectives, cross-cultural communication skills, and lifelong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'The USA is a global leader in technology, finance, healthcare, engineering, and business. Universities maintain strong ties with industries, offering internships, research projects, and practical training that boost career readiness, especially for those planning study in USA for Indian students.'],
        ['title' => '5. Research and Innovation', 'desc' => 'American universities are pioneers in research and innovation. Students gain access to advanced laboratories, funded research projects, and opportunities to work with leading experts across fields like AI, biotechnology, data science, and engineering.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'There are numerous options for study in USA scholarship, including merit-based, need-based, and university-funded awards. These scholarships help international students manage tuition fees and reduce the overall study cost in the USA.'],
        ['title' => '7. International Student Support Services', 'desc' => 'Universities in the USA offer strong support systems, including academic advising, career counselling, health services, and international student offices that help students settle smoothly into academic and social life.'],
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
                'name' => 'Harvard University',
                'logo' => 'images/universities/Harvard-Logo.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Stanford University ',
                'logo' => 'images/universities/Stanford_University_Logo.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Massachusetts Institute of Technology (MIT)',
                'logo' => 'images/universities/MIT_logo.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'California Institute of Technology (Caltech)',
                'logo' => 'images/universities/CalTech_Logo.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'University of Chicago',
                'logo' => 'images/universities/Chicago_Logo.webp',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Columbia University',
                'logo' => 'images/universities/Columbia.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Yale University',
                'logo' => 'images/universities/Yale_logo.webp',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
            [
                'name' => 'Princeton University',
                'logo' => 'images/universities/Princeton_Logo.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
            [
                'name' => 'University of Pennsylvania ',
                'logo' => 'images/universities/Pennsylvania_Logo.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
            [
                'name' => 'University of California, Berkeley',
                'logo' => 'images/universities/Berkeley-Logo.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in USA',
        'highlight' => '',
        'sub_heading' => 'The United States is home to some of the world’s most prestigious universities, known for academic excellence, innovation, and employability.',
        'footer' => 'These institutions attract thousands of international students each year and offer strong global career opportunities.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in USA',
        'desc' => 'The USA offers a wide range of globally recognised programs with strong career outcomes. Universities are known for industry-aligned curricula and research-driven education.',
        'footer' => 'These programs are highly popular among students planning to study in the USA and build international careers.',
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
            ['label' => 'Undergraduate Degree', 'value' => '$20,000 - $50,000'],
            ['label' => 'Master’s Degree', 'value' => '$25,000 - $60,000'],
            ['label' => 'MBA', 'value' => '$40,000 - $80,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$30,000 - $70,000'],
            ['label' => 'Community College', 'value' => '$5,000 - $15,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in USA',
        'description' => 'The cost of studying in the USA depends on the university, program, and level of study. While education in the USA can be expensive, scholarships and financial planning can make it affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '$6,000 - $14,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => '$3,000 - $5,000', 'note' => 'Cooking at home is economical'],
            ['label' => 'Transportation', 'value' => '$600 - $1,200', 'note' => 'Public transport and student passes'],
            ['label' => 'Personal Expenses', 'value' => '$1,000 - $3,000', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => '$10,000 - $18,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in USA for Indian Students',
            'description' => 'Living costs in the USA vary by city and lifestyle. On average, students spend between $10,000 - $18,000 per year.',
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
        'title' => 'Student Life in the USA: What to Expect?',
        'desc' => 'Student life in the USA is dynamic and enriching. Universities offer clubs, sports, cultural events, research opportunities, and student organisations. With world-class campuses, modern facilities, and strong academic support, the USA provides a balanced and rewarding student experience, making it an ideal destination for study in the USA for Indian students.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in the USA?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals',
            'Meet Entry Requirements: Academic qualifications and English proficiency',
            'Take Standardised Tests: SAT, ACT, GRE, or GMAT (as required)',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters',
            'Apply and Track Deadlines: Deadlines vary by university and intake',
            'Receive Offer Letter: Accept admission and proceed with visa application',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in USA',
    'desc' => 'Students planning to study in USA for Indian students must prepare the following documents:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Standardised Test Scores (SAT / GRE / GMAT)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Scholarship Documents',
        'Offer Letter from a SEVP-approved institution',
        ]
    ];

    $guideContent = [
    'title' => 'USA Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is mandatory to study in the USA. The process includes securing admission, completing forms, paying fees, and attending a visa interview. Understanding each step helps students applying to study in the United States of America avoid delays.',
    'list' => [
        'Receive Acceptance from a SEVP-Approved Institution',
        'Pay the SEVIS (Student and Exchange Visitor Information System) Fee',
        'Complete the DS-160 Online Visa Application Form',
        'Schedule Visa Interview at the US Embassy or Consulate',
        'Attend Visa Interview with Required Documents',
        'Receive F-1 Visa and Travel to the USA',
        ],
    'footer' => 'This process helps students planning study in the USA prepare confidently for their academic journey.'
    ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')
    
    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should Indian students choose to study in the USA?",
                "answer" => "The USA offers world-class universities, flexible academic programs, cutting-edge research opportunities, and strong career prospects. For Indian students, studying in the USA for Indian students provides global exposure, international work experience, and degrees that are highly valued worldwide."
            ],
            [
                "question" => "2.	What are the basic requirements to study in the USA?",
                "answer" => "To study in the USA, students need academic transcripts, English proficiency test scores (IELTS/TOEFL/PTE), standardised test scores (SAT/GRE/GMAT if required), a valid passport, financial proof, and an offer letter from a SEVP-approved institution."
            ],
            [
                "question" => "3.	What is the cost of studying in the USA?",
                "answer" => "The cost of studying in the USA depends on the course and university. On average, tuition fees range from $20,000 to $60,000 per year, while living expenses are around $10,000 to $18,000 annually. Scholarships can significantly reduce overall costs."
            ],
            [
                "question" => "4.	Are scholarships available for studying in the USA?",
                "answer" => "Yes, there are many study in USA scholarship options available for international students, including merit-based, need-based, and university-specific scholarships. Some programs also offer assistantships and research funding."
            ],
            [
                "question" => "5.	Can Indian students work while studying in the USA?",
                "answer" => "Yes, students on an F-1 visa can work up to 20 hours per week on campus during academic sessions and full-time during breaks. Off-campus work is allowed under CPT and OPT regulations after meeting eligibility criteria."
            ],
            [
                "question" => "6.	What is the USA student visa type for international students?",
                "answer" => "International students planning to study in the United States of America usually apply for an F-1 student visa. This visa allows students to study full-time and work under permitted conditions."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection