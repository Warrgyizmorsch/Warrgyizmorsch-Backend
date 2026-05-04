@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Canada - Advance Your Education with Global Recognition</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Canada consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Canada.</p>

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
                <p style="margin-top: 30px;">Study in Canada and take the first step toward a globally recognized education and strong career prospects. Canada is one of the most preferred destinations for international students due to its high-quality education, affordable tuition, and excellent post-study work opportunities. With world-class universities, industry-focused programs, and a safe multicultural environment, study in Canada offers students an ideal balance of academics and lifestyle. From university selection to understanding the study in Canada visa process, students can confidently plan their future in one of the world’s most student-friendly countries.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/canadanew.webp" loading="lazy" alt="Study in canada">
            </div>
        </div>
    </section>

<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Canada?';
    $sectionDescription = 'Canada is a top choice for international students because of its globally ranked institutions, career-oriented education system, and welcoming immigration policies. Home to students from all over the world, Canada provides a safe, inclusive, and English-speaking environment. For students planning to study in Canada from India, the country offers high academic standards along with excellent long-term career opportunities.';

    $cards = [
        [
            'title' => '1. World-Class Education System',
            'desc' => 'Canada is known for its strong education system and internationally recognized degrees. Canadian universities focus on practical learning, research, and innovation, ensuring students develop critical thinking and job-ready skills required for global careers.'
        ],
        [
            'title' => '2. Flexible and Career-Oriented Programs',
            'desc' => 'One of the major advantages of studying in Canada is flexibility. Students can choose from a wide range of diploma, undergraduate, and postgraduate programs designed to meet current industry demands. Many programs include internships, co-op options, and hands-on training.'
        ],
        [
            'title' => '3. Cultural Diversity and Global Exposure',
            'desc' => 'Canada is one of the most multicultural countries in the world. Studying in such a diverse environment helps students build global perspectives, improve communication skills, and create international networks that support long-term career growth.'
        ],
        [
            'title' => '4. Career Opportunities and Industry Exposure',
            'desc' => 'Canada has a strong job market in sectors such as IT, healthcare, engineering, finance, business, and data analytics. Universities maintain close ties with industries, offering part-time work, internships, and post-study employment opportunities that enhance student employability.'
        ],
        [
            'title' => '5. Research and Innovation',
            'desc' => 'Canadian universities are globally recognized for research and innovation, particularly in technology, healthcare, artificial intelligence, and environmental sciences. Students gain practical exposure through research projects, labs, and industry collaborations.'
        ],
        [
            'title' => '6. Scholarships and Financial Assistance',
            'desc' => 'Canada offers a variety of scholarships, grants, and funding options for international students. With affordable tuition compared to other countries, along with scholarships and education loans, managing study in Canada costs becomes easier for students.'
        ],
        [
            'title' => '7. International Student Support Services',
            'desc' => 'Canadian institutions provide excellent student support services, including academic advising, career guidance, healthcare services, and settlement support. These services help international students adapt smoothly to life in Canada.'
        ],
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
            'name' => 'University of Toronto',
            'logo' => 'images/universities/toronto.webp',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'University of British Columbia',
            'logo' => 'images/universities/ubc.webp',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'McGill University',
            'logo' => 'images/universities/mcgill.webp',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'University of Alberta',
            'logo' => 'images/universities/alberta.webp',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'University of Waterloo',
            'logo' => 'images/universities/waterloo.webp',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'McMaster University',
            'logo' => 'images/universities/mcmaster.png',
            'course' => '',
            'ranking' => ''
        ],
        [
            'name' => 'Western University',
            'logo' => 'images/universities/western.webp',
            'course' => '',
            'ranking' => ''
        ],
    ];

    $universitySection = [
        'heading' => 'Top Universities in Canada',
        'highlight' => '',
        'sub_heading' => 'Canada is home to several globally ranked universities known for academic excellence, research, and career outcomes.',
        'footer' => 'These universities attract thousands of international students each year and offer strong academic and career support.'
    ];
@endphp

<x-universities :universities="$universities" :universitySection="$universitySection"/>


    <!-- course section  -->
    @php
    $courses = [
        ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
        ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
        ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
        ['title' => 'Healthcare and Life Sciences', 'image' => 'images/courses/medicine.jpg'],
        ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
    ];

    $courseContent = [
        'title' => 'Popular Courses to Study in Canada',
        'desc' => 'Canada offers a wide range of high-demand programs aligned with global job markets. Study in Canada courses are designed to provide both academic knowledge and practical skills.',
        'footer' => 'These programs are especially popular among students seeking quality education and strong employment outcomes.',
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
        ['label' => 'Undergraduate Degree', 'value' => 'CAD 15,000 - 35,000'],
        ['label' => 'Master’s Degree', 'value' => 'CAD 18,000 - 40,000'],
        ['label' => 'MBA', 'value' => 'CAD 30,000 - CAD 55,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => 'CAD 10,000 - CAD 25,000'],
        ['label' => 'Diploma / Certificate', 'value' => 'CAD 10,000 - CAD 20,000'],
    ];

    $description = "";

    $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Canada',
        'description' => 'The cost of studying in Canada depends on the course, institution, and level of study. Compared to other English-speaking countries, Canada offers affordable education with high returns on investment.',
    ];
    $livingFees = [
            ['label' => 'Housing', 'value' => 'CAD 4,000 - 8,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => 'CAD 2,500 - 3,500', 'note' => 'Cooking at home is economical'],
            ['label' => 'Transportation', 'value' => 'CAD 800 - 1,200', 'note' => 'Student passes available'],
            ['label' => 'Personal Expenses', 'value' => 'CAD 1,500 - 2,500', 'note' => 'Includes utilities and leisure'],
            ['label' => 'Total', 'value' => 'CAD 10,000 - 15,000', 'note' => 'Costs vary by city'],
        ];
    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in Canada for Indian Students',
        'description' => 'Living expenses depend on the city and lifestyle. On average, students spend between CAD 10,000 - 15,000 per year.',
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
        'title' => 'Student Life in Canada: What to Expect?',
        'desc' => 'Student life in Canada is safe, vibrant, and enriching. Universities offer clubs, sports, cultural activities, and student societies that help international students integrate easily. With friendly communities, excellent public services, and strong academic support, Canada provides an ideal environment to learn, live, and grow.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Canada?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are essential.',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by institution and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the institution.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
@endphp

<x-scholarship :scholarship="$scholarship"/>

<!-- document section -->
@php
$documentContent = [
    'title' => 'Documents Required to Study in Canada',
    'desc' => 'Students planning to study in Canada must submit the following documents:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof',
        'Offer Letter from a Designated Learning Institution (DLI)',
    ]
];

$guideContent = [
    'title' => 'Canada Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study in Canada visa is mandatory for international students. The process includes securing admission, arranging funds, applying online, and submitting documents. Understanding the study in Canada visa requirements helps students avoid delays and ensures a smooth application experience.',
    'list' => [
        'Receive Offer Letter from a DLI: Obtain an offer letter from a Designated Learning Institution in Canada.',
        'Pay Tuition Fee Deposit: Pay the required tuition fee deposit as mentioned in the offer letter.',
        'Arrange Financial Proof: Show sufficient funds to cover tuition and living expenses as part of study in Canada visa requirements.',
        'Apply for Study Permit Online: Submit the online study permit application through the IRCC portal.',
        'Biometrics and Medical Examination: Provide biometrics and medical reports if required.',
        'Visa Approval and Travel: Once approved, students receive their study permit and can travel to Canada.',
    ],
    'footer' => 'This structured process helps students planning to study in Canada from India prepare effectively and focus on their academic goals.'
];
@endphp

<x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

@include('./components/cta-button')

@php
    $faqs = [
        [
            'question' => '1. Why should international students study in Canada?',
            'answer' => 'Canada offers globally recognized education, affordable tuition, high living standards, and excellent post-study work opportunities. Students who study in Canada benefit from quality education, cultural diversity, and strong career prospects.'
        ],
        [
            'question' => '2. What are the popular study in Canada courses?',
            'answer' => 'Some of the most popular courses in Canada include Engineering, Business and Management, Computer Science, Information Technology, Healthcare, Data Science, and Social Sciences. These programs are aligned with global job market needs.'
        ],
        [
            'question' => '3. What is the cost of studying in Canada for international students?',
            'answer' => 'The cost of studying in Canada varies by course and institution. On average, tuition fees range from CAD 15,000 to CAD 40,000 per year, while living expenses are approximately CAD 10,000 to 15,000 annually.'
        ],
        [
            'question' => '4. What are the study requirements for a Canada visa?',
            'answer' => 'The main study in Canada visa requirements include an offer letter from a Designated Learning Institution (DLI), proof of funds, a valid passport, English proficiency test scores, and a completed study permit application.'
        ],
        [
            'question' => '5. How long does the study in Canada visa process take?',
            'answer' => 'The study in Canada visa processing time usually ranges from 4 to 8 weeks, depending on the country of application, completeness of documents, and intake period.'
        ],
        [
            'question' => '6. Can Indian students work while studying in Canada?',
            'answer' => 'Yes, students who study in Canada can work up to 20 hours per week during academic sessions and full-time during scheduled breaks, helping them manage living expenses.'
        ],
    ];
@endphp

<x-faq :faqs="$faqs" />



@endsection