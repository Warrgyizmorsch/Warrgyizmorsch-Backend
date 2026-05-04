@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Australia - Where Quality Education Meets Career Opportunity</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Australia consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Australia.</p>

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
                <p style="margin-top:30px;">Study in Australia and take the first step toward a globally respected education system. Australia is known for its high academic standards, innovative teaching methods, and excellent post-study career opportunities. With world-ranked universities and a strong focus on practical learning, Australia has become a top choice for students planning to study abroad. The country offers a safe, multicultural, and English-speaking environment where students can build strong academic foundations and successful global careers.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/australianew.webp" loading="lazy" alt="Study in australia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Australia?';
    $sectionDescription = 'Australia is one of the most popular destinations for international education due to its globally recognised degrees, modern campuses, and strong industry connections. The country offers outstanding academic exposure along with long-term career opportunities, making it an ideal choice for students looking to study in Australia.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Australia is home to globally ranked universities that focus on research, innovation, and practical learning. Australian institutions emphasise critical thinking, problem-solving, and real-world skills, ensuring graduates are well-prepared for the global job market.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major benefits of studying in Australia is its flexible education system. Students can choose specialised programs aligned with industry demand, gain hands-on experience through internships, and benefit from work-integrated learning models that enhance employability.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Australia welcomes students from all over the world, creating a diverse and inclusive learning environment. Studying in such a multicultural society helps students develop global perspectives, strong communication skills, and valuable international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Australia has strong industries in IT, engineering, healthcare, business, education, and hospitality. Universities maintain close ties with employers, offering part-time work, internships, and post-study work opportunities that support career growth after graduation.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Australian universities are globally recognised for research excellence, especially in science, technology, healthcare, engineering, and environmental studies. Students actively participate in research projects, gaining academic depth and practical experience.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Australia offers various scholarships for international students to help reduce tuition costs. Students also manage expenses through financial planning options while understanding the study in Australia cost structure before applying.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Australian institutions provide strong student support services, including academic counselling, career guidance, health services, and cultural integration programs, ensuring international students settle smoothly.'],
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
                'name' => 'The University of Melbourne',
                'logo' => 'images/universities/Melbourne_Logo.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'The Australian National University (ANU)',
                'logo' => 'images/universities/ANU_Logo.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'The University of Sydney',
                'logo' => 'images/universities/Sydney_Logo.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'The University of Queensland',
                'logo' => 'images/universities/Queensland_Logo.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Monash University',
                'logo' => 'images/universities/Monash_Logo.jpeg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'The University of New South Wales (UNSW)',
                'logo' => 'images/universities/UNSW_Logo.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'The University of Western Australia (UWA)',
                'logo' => 'images/universities/UWA_Logo.webp',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Australia',
        'highlight' => '',
        'sub_heading' => 'Australia is home to prestigious universities known for academic excellence, innovation, and research output.',
        'footer' => 'These universities attract thousands of international students every year and offer excellent career support services.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Australia',
        'desc' => 'Australia offers a wide range of globally recognised programs designed to meet industry needs and career goals.',
        'footer' => 'These courses are highly preferred by students planning to study in Australia due to strong employment outcomes.',
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
            ['label' => 'Undergraduate Degree', 'value' => 'AUD 20,000 - 45,000'],
            ['label' => 'Master’s Degree', 'value' => 'AUD 22,000 - 50,000'],
            ['label' => 'MBA', 'value' => 'AUD 35,000 - 65,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'AUD 18,000 - 42,000'],
            ['label' => 'Diploma / Certificate', 'value' => 'AUD 10,000 - 25,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Australia',
        'description' => 'The cost of studying in Australia depends on the course, university, and level of education. With proper planning, education in Australia can be made affordable.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => 'AUD 8,000 - 15,000', 'note' => 'Shared accommodation reduces cost'],
                ['label' => 'Food', 'value' => 'AUD 4,000 - 6,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => 'AUD 1,200 - 2,000', 'note' => 'Student travel concessions available'],
                ['label' => 'Personal Expenses', 'value' => 'AUD 3,000 - 4,000', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => 'AUD 20,000 - 25,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Australia for Indian Students',
            'description' => 'The study in Australia cost for Indian students also includes living expenses, which vary by city and lifestyle. On average, students spend between AUD 20,000 - 25,000 per year.',
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
        'title' => 'Student Life in Australia: What to Expect?',
        'desc' => 'Student life in Australia is vibrant, safe, and enriching. Universities offer clubs, sports, cultural events, and student societies that help international students integrate easily. With modern cities, friendly locals, and strong academic support, Australia provides a balanced lifestyle that supports both education and personal growth.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Australia?',
        'guide_steps' => [
            'Research and Select Universities: Choose courses aligned with academic and career goals',
            'Meet Entry Requirements: Academic qualifications and English proficiency are essential',
            'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters',
            'Check Application Deadlines: Intake periods vary by institution',
            'Receive Offer Letter: Conditional or unconditional offer from the university',
            'Confirm Admission and Apply for Visa: Accept the offer and proceed with the visa application',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Australia',
    'desc' => 'Students planning to study in Australia must prepare the following documents:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE) ',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport ',
        'Financial Proof',
        'Offer Letter from an Australian Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Australia Study Visa Process: Step-by-Step Guide ',
    'desc' => 'A study in Australia visa is mandatory for international students. The process includes securing admission, arranging finances, applying online, and submitting documents. Understanding each step helps students avoid delays and ensures a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from an Approved Institution',
        'Pay Tuition Fee Deposit',
        'Arrange Financial Proof',
        'Apply for Student Visa (Subclass 500)',
        'Submit Documents and Biometrics',
        'Visa Approval and Travel to Australia',
        ],
    'footer' => 'After arrival, students must comply with visa conditions and enrolment requirements.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I study in Australia?",
                "answer" => "Australia offers globally recognised degrees, top-ranked universities, strong industry exposure, and excellent post-study work opportunities. Its high quality of life and multicultural environment make it a preferred destination for international students."
            ],
            [
                "question" => "2.	What are the popular courses to study in Australia?",
                "answer" => "Some of the most popular courses include Engineering, Business and Management, Computer Science, Information Technology, Health Sciences, and Social Sciences due to strong career demand and employability."
            ],
            [
                "question" => "3.	What does studying in Australia cost for Indian students?",
                "answer" => "The study in Australia cost for Indian students typically ranges from AUD 20,000 to 50,000 per year for tuition fees, depending on the course and university. Living expenses usually range between AUD 21,000 and 29,000 per year."
            ],
            [
                "question" => "4.	What is the total study cost in Australia?",
                "answer" => "The total study cost in Australia includes tuition fees, accommodation, food, transport, and personal expenses. On average, international students should budget AUD 40,000–75,000 per year, depending on location and lifestyle."
            ],
            [
                "question" => "5.	What is the study in Australia visa process?",
                "answer" => "To obtain a study in Australia visa, students must secure admission, receive a Confirmation of Enrolment (CoE), show financial proof, complete health checks, and apply for the Student Visa (Subclass 500) online."
            ],
            [
                "question" => "6.	Is IELTS mandatory to study in Australia?",
                "answer" => "Most universities require English proficiency tests like IELTS, PTE, or TOEFL. However, some institutions may waive IELTS if students meet alternative English requirements."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection