@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Norway – A Gateway to World-Class Education and Global Careers</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Norway  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Norway .</p>

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
                <p style="margin-top:30px;">Study in Norway and take the first step toward a globally respected education system known for innovation, sustainability, and academic excellence. Norway offers high-quality education, modern teaching methods, and strong research opportunities. With many English-taught programs and a student-friendly environment, study in Norway for international students has become an attractive option for those seeking quality education in Europe.For those planning study in Norway for Indian students, the country provides a safe society, high living standards, and internationally recognised degrees, making Norway an ideal Norway study abroad destination.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/norwaynew.webp" loading="lazy" alt="Study in norway">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Norway?';
    $sectionDescription = 'Norway is gaining popularity among international students due to its world-class universities, strong research culture, and focus on innovation and sustainability. Known for its high quality of life and progressive education system, Norway offers excellent academic exposure and career-oriented learning.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Norway has a strong public education system with globally recognised degrees. Universities in Norway focus on research-based learning, critical thinking, and real-world problem solving. The academic standards followed by Norway universities for international students are highly respected across Europe and beyond.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major benefits of study in Norway is its flexible and student-centric education system. Programs are designed to promote independent thinking, group work, and practical exposure, helping students build skills relevant to global industries.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Norway welcomes students from all over the world, creating a multicultural and inclusive learning environment. Studying in Norway helps international students develop global perspectives, intercultural communication skills, and lifelong international connections.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Norway has strong industries in energy, technology, maritime studies, renewable resources, and business. Universities collaborate closely with industry partners, providing internships, research projects, and career-focused learning opportunities for students pursuing study in Norway for international students.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Norwegian universities are well known for research and innovation, particularly in environmental sciences, engineering, renewable energy, and technology. Students actively participate in research projects, gaining hands-on experience and academic credibility.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Although public education in Norway is highly subsidised, students may still need to manage living expenses. Scholarships, part-time work opportunities, and financial planning options help students manage costs while pursuing Norway study abroad programs.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities provide strong support systems including academic guidance, career counselling, housing assistance, and student welfare services. These facilities make study in Norway for Indian students smooth and stress-free.'],
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
                'name' => 'University of Oslo',
                'logo' => 'images/universities/Oslo_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Norwegian University of Science and Technology',
                'logo' => 'images/universities/Norwegian_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'University of Bergen',
                'logo' => 'images/universities/Bergen_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'UiT The Arctic University of Norway',
                'logo' => 'images/universities/Arctic_logo.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'BI Norwegian Business School',
                'logo' => 'images/universities/BI_Norwegian_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Norway',
        'highlight' => '',
        'sub_heading' => 'Norway is home to well-recognised institutions known for academic quality and research excellence. Some leading Norway universities for international students include:',
        'footer' => 'These universities in Norway attract thousands of international students every year due to their academic reputation and strong research output.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Environmental Science and Sustainability', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Renewable Energy', 'image' => 'images/courses/it.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Norway',
        'desc' => 'Norway offers a wide range of globally relevant academic programs taught in English, especially at the master’s level.',
        'footer' => 'These programs are highly popular among students aiming to build strong international careers through study in Norway.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€0 – €10,000'],
            ['label' => 'Master’s Degree', 'value' => '€0 – €15,000'],
            ['label' => 'MBA', 'value' => '€12,000 – €20,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€0 – €8,000'],
            ['label' => 'Private University Programs', 'value' => '€7,000 – €18,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Norway',
        'description' => 'The cost of studying in Norway is relatively affordable in terms of tuition, especially at public universities. However, students must plan for living expenses.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€4,000 – €8,000', 'note' => 'Shared accommodation lowers costs'],
                ['label' => 'Food', 'value' => '€2,500 – €4,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '€700 – €1,200', 'note' => 'Student discounts available'],
                ['label' => 'Personal Expenses', 'value' => '€1,500 – €2,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€10,000 – €15,000', 'note' => 'Depends on city and lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Norway for Indian Students',
            'description' => 'Living costs in Norway are higher compared to many countries, but the quality of life is exceptional. On average, students spend between €10,000 – €15,000 per year.',
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
        'title' => 'Student Life in Norway: What to Expect?',
        'desc' => 'Student life in Norway is peaceful, enriching, and academically focused. Universities offer student organisations, outdoor activities, cultural events, and strong academic support systems. With safe cities, high living standards, and a welcoming society, study in Norway for international students provides an excellent balance between education and quality of life.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Norway?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English language proficiency are mandatory.',
            'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Deadlines vary by university and intake.',
            'Receive Offer Letter: Admission confirmation from the university.',
            'Confirm Admission: Accept the offer and prepare for relocation.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Norway',
    'desc' => 'Students planning study in Norway for Indian students must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English Proficiency Test Scores (IELTS / TOEFL)',
        'Statement of Purpose',
        'Letters of Recommendation',
        'Valid Passport',
        'Proof of Funds for Living Expenses',
        'Offer Letter from a Norwegian University',
        ]
    ];

    $guideContent = [
    'title' => 'Norway Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required for non-EU students planning to study in Norway. The process includes securing admission, arranging financial proof, applying online, and submitting documents. Understanding these steps helps students pursuing Norway study abroad avoid delays and ensure a smooth visa experience.',
    'list' => [
        'Receive an offer letter from a recognised Norwegian institution',
        'Arrange proof of sufficient funds for living expenses',
        'Complete the online residence permit application',
        'Submit documents at the visa centre',
        'Receive approval and travel to Norway',
        'Register with local authorities after arrival',
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
                "question" => "1.	Why should international students choose to study in Norway?",
                "answer" => "Norway offers high-quality education, globally recognised degrees, strong research facilities, and a safe living environment. Many Norway universities for international students provide English-taught programs, making it an excellent Norway study abroad destination."
            ],
            [
                "question" => "2.	Is Norway good for Indian students?",
                "answer" => "Yes, study in Norway for Indian students is a great option due to its high academic standards, safe society, equal opportunities, and international learning environment. Indian students benefit from globally valued degrees and strong career exposure."
            ],
            [
                "question" => "3.	Are there English-taught programs available in Norway?",
                "answer" => "Yes, most master’s programs and several undergraduate courses are taught in English. This makes study in Norway for international students convenient without needing to learn Norwegian initially."
            ],
            [
                "question" => "4.	What are the top universities in Norway for international students?",
                "answer" => "Some leading universities in Norway include the University of Oslo, Norwegian University of Science and Technology (NTNU), University of Bergen, UiT The Arctic University of Norway, and BI Norwegian Business School."
            ],
            [
                "question" => "5.	Is studying in Norway free for international students?",
                "answer" => "Many public universities in Norway charge low or no tuition fees, even for international students. However, students must manage living expenses while planning to study in Norway."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection