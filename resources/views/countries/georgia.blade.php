@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Georgia – A Gateway to Affordable Global Education and Career Opportunities</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Georgia  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Georgia.</p>

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
                <p style="margin-top:30px;">Study in Georgia and begin your path toward an internationally recognised and affordable education. Georgia has quickly gained popularity among international students due to its quality universities, low tuition fees, and simple admission process. With globally accepted degrees, English-taught programs, and a student-friendly environment, study abroad Georgia has become a smart choice for students seeking quality education with global exposure.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/georgianew.webp" loading="lazy" alt="Study in georgia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Georgia?';
    $sectionDescription = 'Georgia is emerging as a preferred destination for international education due to its affordable cost, European-standard education system, and welcoming atmosphere. The country offers a safe, multicultural environment and internationally recognised degrees. For students exploring study in Georgia for international students, the country provides excellent academic opportunities with minimal entry barriers.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Georgia follows European education standards and is part of the Bologna Process. Universities focus on academic excellence, practical learning, and globally aligned curricula. Degrees from Georgia country universities are recognised across Europe and many other countries worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the key benefits of study in Georgia is flexible admission requirements and career-focused programs. Universities offer industry-relevant courses with a strong emphasis on practical knowledge, making graduates job-ready for global markets.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Georgia welcomes students from Asia, Europe, Africa, and the Middle East, creating a truly multicultural learning environment. This exposure helps international students develop cross-cultural skills, global perspectives, and strong communication abilities.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Georgia provides growing opportunities in healthcare, business, IT, and engineering sectors. While studying, students gain academic knowledge that prepares them for international careers or further education abroad after graduation.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Many Georgia country universities focus on modern teaching methods, innovation, and applied research. Students gain hands-on experience through laboratory work, case studies, and academic projects, especially in medical and technical fields.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Georgia offers affordable tuition fees compared to other European countries. Some universities also provide merit-based scholarships, making study abroad Georgia accessible to students from diverse financial backgrounds.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities in Georgia offer strong support systems, including academic guidance, accommodation assistance, and student orientation programs. These services help students adapt smoothly to academic and social life in Georgia.'],
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
                'name' => 'Tbilisi State Medical University',
                'logo' => 'images/universities/Tbilisi_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Ivane Javakhishvili Tbilisi State University',
                'logo' => 'images/universities/Ivane_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'European University Georgia',
                'logo' => 'images/universities/European_Georgia_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Georgian National University (SEU)',
                'logo' => 'images/universities/SEU_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Caucasus University',
                'logo' => 'images/universities/Caucasus_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'New Vision University',
                'logo' => 'images/universities/New_Vision_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Georgia',
        'highlight' => '',
        'sub_heading' => 'Georgia is home to several well-recognised universities offering English-taught programs and international-standard education.',
        'footer' => 'These Georgia country universities attract thousands of international students every year.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
             ['title' => 'Medicine (MBBS / MD)', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Georgia',
        'desc' => 'Georgia offers a wide range of globally relevant programs, especially popular among international students seeking affordable education.',
        'footer' => 'These programs are especially attractive for students interested in study in Georgia for international students due to quality education and reasonable costs.',
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
            ['label' => 'Undergraduate Degree', 'value' => '$3,000 – $6,000'],
            ['label' => 'Master’s Degree', 'value' => '$3,500 – $7,000'],
            ['label' => 'MBA', 'value' => '$4,000 – $8,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$3,000 – $6,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$2,500 – $5,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Georgia',
        'description' => 'One of the biggest advantages of study in Georgia is its affordability. Tuition fees and living costs are significantly lower compared to many European countries.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '$1,200 – $2,500', 'note' => 'Shared accommodation reduces cost'],
                ['label' => 'Food', 'value' => '$1,000 – $1,500', 'note' => 'Affordable local food'],
                ['label' => 'Transportation', 'value' => '$200 – $400', 'note' => 'Public transport is economical'],
                ['label' => 'Personal Expenses', 'value' => '$600 – $1,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '$3,000 – $5,000', 'note' => 'Varies by lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Georgia for International Students',
            'description' => 'Living costs in Georgia are affordable and student-friendly. On average, international students spend between $3,000 – $5,000 per year.',
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
        'title' => 'Student Life in Georgia: What to Expect?',
        'desc' => 'Student life in Georgia is safe, affordable, and culturally rich. Universities offer a friendly campus environment with access to libraries, sports facilities, and student communities. With welcoming locals, historic cities, and modern infrastructure, study in Georgia for international students provides a balanced academic and personal experience.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Georgia?',
        'guide_steps' => [
            'Choose University and Course: Select a recognised university and suitable program.',
            'Check Eligibility Criteria: Academic qualification and basic English proficiency.',
            'Prepare Documents: Academic transcripts, passport, and application form.',
            'Receive Admission Letter: Universities issue offer letters quickly.',
            'Pay Tuition Fees: Secure admission by paying the required fees.',
            'Apply for Student Visa: Begin visa application after confirmation.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Georgia',
    'desc' => 'Students planning to study in Georgia for international students must prepare the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'Valid Passport',
        'Passport-size Photographs',
        'University Offer Letter',
        'Proof of Funds',
        'Medical Fitness Certificate',
        'Visa Application Form',
        ]
    ];

    $guideContent = [
    'title' => 'Georgia Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Georgia. The process is straightforward and student-friendly.',
    'list' => [
        'Receive Offer Letter from a Recognised University',
        'Pay Tuition Fees',
        'Prepare Financial Proof',
        'Submit Visa Application',
        'Attend Visa Appointment (if required)',
        'Receive Visa and Travel to Georgia',
        ],
    'footer' => 'This simple process makes study abroad Georgia an attractive option for international students.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Georgia?",
                "answer" => "Georgia offers affordable tuition fees, globally recognised degrees, English-taught programs, and a safe environment. This makes study in Georgia for international students a popular choice for quality education at a lower cost."
            ],
            [
                "question" => "2.	Is Georgia a good option for study abroad?",
                "answer" => "Yes, study abroad Georgia is an excellent option due to its European-standard education system, low living expenses, and simplified admission process compared to many other countries."
            ],
            [
                "question" => "3.	Are degrees from Georgia country universities internationally recognised?",
                "answer" => "Yes, degrees awarded by Georgia country universities are recognised in Europe and many other countries, as Georgia follows the Bologna Process and international education standards."
            ],
            [
                "question" => "4.	What are the most popular courses to study in Georgia?",
                "answer" => "Popular courses include Medicine (MBBS/MD), Engineering, Business and Management, Computer Science, and Social Sciences. These programs attract students interested in study in Georgia for long-term career opportunities."
            ],
            [
                "question" => "5.	What is the cost of studying in Georgia?",
                "answer" => "Tuition fees in Georgia typically range from $3,000 to $8,000 per year, depending on the course and university. This affordability is a key advantage of study abroad Georgia."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection