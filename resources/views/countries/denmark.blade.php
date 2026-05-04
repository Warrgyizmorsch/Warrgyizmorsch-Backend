@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Denmark – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Denmark  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Denmark .</p>

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
                <p style="margin-top:30px;">Study in Denmark and take the first step toward a globally respected education system known for innovation, sustainability, and academic excellence. Denmark has become a popular destination for students seeking high-quality learning, modern teaching methods, and strong career prospects in Europe. With internationally recognised degrees and a student-friendly environment, Denmark study abroad programs offer the perfect balance of education and lifestyle for global learners.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/denmarknew.webp" loading="lazy" alt="Study in denmark">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Denmark?';
    $sectionDescription = 'Denmark is one of Europe’s leading education destinations, offering a progressive learning environment, globally ranked institutions, and strong industry collaboration. Known for innovation, research, and work-life balance, the country is ideal for students planning to study in Denmark for international students opportunities. English-taught programs and a welcoming society make Denmark an excellent choice for global education.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Denmark’s education system is globally respected for its focus on innovation, research, and real-world problem solving. Denmark universities for international students emphasise practical learning, teamwork, and critical thinking, ensuring graduates are well prepared for international careers.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'A major advantage of study in Denmark is its flexible and application-based academic structure. Courses are designed with strong industry relevance, and students benefit from project-based learning, case studies, and internships that build job-ready skills.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Denmark offers a multicultural and inclusive environment with students from all over the world. Studying in such a diverse academic setting helps students develop global perspectives, cross-cultural communication skills, and strong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Denmark has a strong economy driven by sectors such as renewable energy, engineering, IT, biotechnology, and design. Universities maintain close ties with industries, providing internships, research collaboration, and employment opportunities that enhance career prospects for students pursuing denmark study abroad programs.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Denmark is a global leader in research and innovation, especially in sustainability, healthcare, engineering, and technology. Universities encourage students to participate in research projects, helping them gain valuable academic experience and practical exposure.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Denmark offers several scholarships and funding opportunities for international students, especially for master’s programs. Many students planning masters in Denmark for international students also explore financial support options to manage tuition and living expenses effectively.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Danish universities provide strong support services, including academic guidance, career counselling, health services, and integration programs. These services help international students adjust smoothly to academic and social life in Denmark.'],
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
                'name' => 'University of Copenhagen',
                'logo' => 'images/universities/Copenhagen_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Technical University of Denmark (DTU)',
                'logo' => 'images/universities/Technical_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Aarhus University',
                'logo' => 'images/universities/Aarhus_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Aalborg University',
                'logo' => 'images/universities/Aalborg_logo.jpg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Copenhagen Business School',
                'logo' => 'images/universities/Copenhagen_Business_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Southern Denmark',
                'logo' => 'images/universities/Southern_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Denmark',
        'highlight' => '',
        'sub_heading' => 'Denmark is home to some of Europe’s most respected institutions, known for academic excellence and research output. These Denmark universities for international students attract learners from across the globe.',
        'footer' => 'These universities offer English-taught programs and strong career support for international students.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Renewable Energy and Sustainability', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Life Sciences and Biotechnology', 'image' => 'images/courses/it.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Denmark',
        'desc' => 'Denmark offers a wide range of globally recognised programs focused on innovation and employability. University Denmark programs are designed to meet modern industry demands and future workforce needs.',
        'footer' => 'These courses are especially popular among students looking for quality education and international career opportunities.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€6,000 – €16,000'],
            ['label' => 'Master’s Degree', 'value' => '€8,000 – €20,000'],
            ['label' => 'MBA', 'value' => '€15,000 – €25,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'Usually funded'],
            ['label' => 'Diploma / Certificate', 'value' => '€5,000 – €12,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Denmark',
        'description' => 'The cost of studying in Denmark depends on the course, university, and level of study. While education quality is high, proper financial planning is important for students planning to study in Denmark.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€4,000 – €8,000', 'note' => 'Shared accommodation reduces costs'],
                ['label' => 'Food', 'value' => '€2,500 – €3,500', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => '€500 – €1,000', 'note' => 'Student travel discounts available'],
                ['label' => 'Personal Expenses', 'value' => '€1,000 – €1,500', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => '€8,000 – €14,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Denmark for International Students',
            'description' => 'The cost of living in Denmark varies by city and lifestyle. On average, international students spend between €8,000 – €14,000 per year.',
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
        'title' => 'Student Life in Denmark: What to Expect?',
        'desc' => 'Student life in Denmark is modern, balanced, and student-friendly. Universities offer clubs, sports, cultural events, and social activities that promote interaction and personal growth. With safe cities, high living standards, and strong academic support, Denmark provides an enriching experience for students choosing to study in Denmark and build a global future.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Denmark?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
            'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Deadlines vary by intake and institution.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Begin Visa Process: Accept the offer and proceed with formalities.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Denmark',
    'desc' => 'Students planning to study in Denmark for international students programs must prepare the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English Proficiency Test Scores (IELTS / TOEFL)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof',
        'Offer Letter from a Danish University',
        ]
    ];

    $guideContent = [
    'title' => 'Denmark Study Visa Process: Step-by-Step Guide ',
    'desc' => 'A study visa is required to study in Denmark. The process includes securing admission, arranging funds, applying online, and submitting documents. Understanding each step helps students applying for denmark study abroad programs avoid delays and ensure a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Students must obtain an official admission letter from a recognised Danish university.',
        'Arrange Financial Proof: Students must show sufficient funds to cover tuition fees and living expenses.',
        'Submit Online Visa Application: Apply for a Denmark student residence permit through the official immigration portal.',
        'Submit Documents and Biometrics: Provide passport, admission letter, financial proof, academic documents, and biometrics.',
        'Visa Approval and Travel to Denmark: After approval, students can travel to Denmark and complete residence registration.',
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
                "question" => "1.	Why should international students choose to study in Denmark?",
                "answer" => "Denmark offers a high-quality education system, innovative teaching methods, and globally recognised degrees. It is known for student-focused learning, strong industry connections, and excellent career opportunities after graduation."
            ],
            [
                "question" => "2.	Is Denmark a good option for international students?",
                "answer" => "Yes, Denmark is one of the best destinations for international students due to its safe environment, English-taught programs, modern universities, and strong work-life balance."
            ],
            [
                "question" => "3.	What are the top universities in Denmark for international students?",
                "answer" => "Some leading universities in Denmark include the University of Copenhagen, Aarhus University, Technical University of Denmark (DTU), Aalborg University, and Copenhagen Business School."
            ],
            [
                "question" => "4.	Can Indian students study in Denmark?",
                "answer" => "Yes, study in Denmark for Indian students is very popular. Indian students can apply for English-taught bachelor’s and master’s programs and benefit from strong academic support and post-study work opportunities."
            ],
            [
                "question" => "5.	What courses are popular to study in Denmark?",
                "answer" => "Popular courses include Engineering, Computer Science, Business and Management, Data Science, Renewable Energy, Design, and Life Sciences."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection