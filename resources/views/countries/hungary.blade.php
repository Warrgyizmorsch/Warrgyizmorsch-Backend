@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Hungary – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Hungary consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Hungary.</p>

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
                <p style="margin-top:30px;">Study in Hungary and take the first step toward a globally recognized education. We guide students through university selection, visa guidance, scholarships, and test preparation. With a strong reputation for academic excellence, affordable tuition, and post-study career opportunities, Hungary has become a preferred destination for students planning to study in Hungary for international students. Universities in Hungary offer high-quality education, cultural diversity, and vibrant campus life, ensuring a smooth transition so you can focus on building a successful academic and professional future.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/hungarynew.webp" loading="lazy" alt="Study in hungary">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Hungary?';
    $sectionDescription = 'Hungary is emerging as a top destination for international students due to its affordable tuition fees, globally recognized degrees, and strong industry links. Known for its safe environment and English-taught programs, the country provides excellent academic exposure along with career prospects. For students planning to study in Hungary, the country offers a welcoming, English-speaking environment with world-class universities for international students.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Hungary is home to prestigious universities that emphasize research, practical learning, and skill development. Hungarian institutions focus on industry-relevant education, critical thinking, and professional training, preparing students for competitive global careers.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key benefits of studying in Hungary for international students is the flexibility of programs. Students can choose specialized courses aligned with industry requirements, gaining practical experience through internships, projects, and applied learning.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Hungary welcomes students from all over the world, offering a multicultural and inclusive campus experience. Studying in such a setting helps students develop international perspectives, communication skills, and a global professional network.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Hungary is a hub for IT, engineering, healthcare, and business services. Universities maintain strong links with companies, providing internships, part-time work, and post-study employment opportunities, enhancing students’ employability.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Hungary universities for international students are known for cutting-edge research in medicine, technology, engineering, and life sciences. Students actively participate in research projects, gaining hands-on experience and professional expertise.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Hungary offers numerous scholarships and financial aid options to international students. Many students planning to study in Hungary also opt for financial planning to manage tuition and living costs effectively.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities in Hungary provide comprehensive student support, including academic guidance, career counseling, healthcare services, and cultural integration programs, ensuring international students feel comfortable and supported.'],
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
                'name' => 'Eötvös Loránd University, Budapest',
                'logo' => 'images/universities/Eötvös_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'University of Szeged',
                'logo' => 'images/universities/Szeged_logo.avif',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Semmelweis University, Budapest',
                'logo' => 'images/universities/Semmelweis_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Budapest University of Technology and Economics',
                'logo' => 'images/universities/Budapest_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Debrecen',
                'logo' => 'images/universities/Debrecen_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Central European University',
                'logo' => 'images/universities/Central_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'University of Pécs',
                'logo' => 'images/universities/Pécs_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Hungary',
        'highlight' => '',
        'sub_heading' => 'Hungary is home to some of Europe’s most reputable universities for international students. These institutions are recognized for their academic excellence, research output, and career-focused programs:',
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
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/fine-arts.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Hungary',
        'desc' => 'Hungary provides a wide range of internationally recognized programs with practical and industry-focused curricula. Hungary universities for international students are especially popular for:',
        'footer' => 'These programs offer excellent career opportunities and skill development for international students.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€6,000 – €15,000'],
            ['label' => 'Master’s Degree', 'value' => '€7,000 – €18,000'],
            ['label' => 'MBA', 'value' => '€10,000 – €25,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€8,000 – €15,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€5,000 – €10,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Hungary',
        'description' => 'Studying in Hungary is relatively affordable compared to other European countries. Tuition fees vary depending on the university, program, and level of study. Scholarships or personal funding can make education more accessible.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,000 – €5,000', 'note' => 'Shared apartments reduce costs'],
                ['label' => 'Food', 'value' => '€1,500 – €2,500', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => '€400 – €800', 'note' => 'Student travel passes available'],
                ['label' => 'Personal Expenses', 'value' => '€800 – €1,500', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€5,000 – €10,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Hungary for International Students',
            'description' => 'The cost of living in Hungary is moderate and depends on city and lifestyle. On average, students spend between €5,000 – €10,000 per year:',
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
        'title' => 'Student Life in Hungary: What to Expect?',
        'desc' => 'Student life in Hungary is vibrant, affordable, and culturally rich. Universities offer clubs, societies, sports, and cultural events, helping international students adapt quickly. Friendly locals, safe cities, and strong academic support make Hungary an ideal place to study in Hungary and gain global exposure.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Hungary?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs that match your academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency (or Hungarian, if required).',
            'Prepare Application Documents: Transcripts, Statement of Purpose, and recommendation letters.',
            'Check Application Deadlines: Vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the Hungarian university.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the visa application process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Hungary',
    'desc' => 'Students planning to study in Hungary for international students must submit:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Proof of Funds / Financial Documents',
        'Offer Letter from a recognized university in Hungary',
        ]
    ];

    $guideContent = [
    'title' => 'Hungary Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is mandatory to study in Hungary. The process includes securing admission, arranging finances, applying online, and submitting documents:',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Students must obtain an offer from a recognized university in Hungary.',
        'Pay Tuition Fee Deposit: Confirm admission by paying the required deposit.',
        'Arrange Financial Proof: Show sufficient funds to cover tuition and living expenses.',
        'Complete Online Visa Application: Apply via the Hungarian consulate or embassy system.',
        'Submit Documents and Biometrics: Include passport, offer letter, financial proof, and academic records.',
        'Visa Decision and Travel to Hungary: Upon approval, travel to Hungary and register with local authorities.',
        ],
    'footer' => 'Following these steps ensures students planning to study in Hungary for international students have a smooth and hassle-free process.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Hungary?",
                "answer" => "Hungary offers high-quality education, affordable tuition fees, and internationally recognized degrees. Students benefit from modern universities, research opportunities, and strong career prospects."
            ],
            [
                "question" => "2.	Which are the top universities in Hungary for international students?",
                "answer" => "Some of the most popular universities in Hungary include Eötvös Loránd University, University of Szeged, Semmelweis University, Budapest University of Technology and Economics, University of Debrecen, and the University of Pécs."
            ],
            [
                "question" => "3.	Can international students study in Hungary in English?",
                "answer" => "Yes, most Hungary universities for international students offer programs in English, especially at the undergraduate and postgraduate levels."
            ],
            [
                "question" => "4.	What courses can I study in Hungary?",
                "answer" => "Students can choose from a wide range of programs including Engineering, Medicine, Business, Computer Science, Social Sciences, and Humanities."
            ],
            [
                "question" => "5.	How much does it cost to study in Hungary?",
                "answer" => "Tuition fees range from €6,000 – €25,000 per year depending on the university and course. Living expenses are typically between €5,000 – €10,000 per year."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection