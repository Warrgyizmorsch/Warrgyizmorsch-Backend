@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Cyprus – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Cyprus  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Cyprus .</p>

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
                <p style="margin-top:30px;">Study in Cyprus and take the first step toward an internationally recognized education in Europe. Cyprus offers high-quality academics, affordable tuition fees, and a safe, English-speaking environment for global learners. With modern campuses, globally accepted degrees, and growing career opportunities, study in Cyprus for international students has become an attractive choice for those seeking quality education abroad. Students benefit from a smooth admission process and a supportive academic ecosystem, allowing them to focus on long-term academic and professional success.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/cyprusnew.webp" loading="lazy" alt="Study in cyprus">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Cyprus?';
    $sectionDescription = 'Cyprus is emerging as a popular destination for international education due to its affordable cost of study, globally recognized universities, and strategic European location. The country combines academic excellence with a relaxed Mediterranean lifestyle, making it ideal for students planning to study abroad. For those considering study in Cyprus for international students, the country offers safety, cultural diversity, and career-focused education.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Cyprus is home to well-established and internationally accredited universities that focus on academic quality, research, and practical learning. Many programs are taught in English, making it easier for international students to adapt and succeed. Degrees awarded by universities in Cyprus for international students are recognized across Europe and beyond.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major advantages of studying in Cyprus is the flexibility in academic programs. Universities offer career-focused curricula, practical training, and industry-aligned courses. Students pursuing a master degree in Cyprus gain specialized knowledge that improves employability in global job markets.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Cyprus welcomes students from Europe, Asia, Africa, and the Middle East, creating a multicultural learning environment. Studying in Cyprus helps students build international networks, enhance communication skills, and gain a global outlook that supports future career growth.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Cyprus provides growing opportunities in business, tourism, IT, finance, and hospitality. Universities maintain links with local and international industries, offering internships, part-time work, and hands-on training that support professional development during and after studies.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Universities in Cyprus are increasingly focused on research and innovation, especially in technology, business studies, health sciences, and engineering. Students are encouraged to participate in academic research projects, strengthening both theoretical and practical expertise.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Cyprus offers scholarships and tuition fee discounts for international students based on academic merit. Combined with affordable tuition and living costs, studying in Cyprus is budget-friendly compared to other European destinations.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Cyprus universities provide strong support systems, including academic advising, career guidance, accommodation assistance, and student welfare services. These services help international students settle easily and enjoy a smooth academic journey.'],
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
                'name' => 'International University of Cyprus',
                'logo' => 'images/universities/Cyprus_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'University of Cyprus',
                'logo' => 'images/universities/University_Cyprus_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'European University Cyprus',
                'logo' => 'images/universities/European_Cyprus_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Neapolis University Pafos',
                'logo' => 'images/universities/Pafos_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Frederick University',
                'logo' => 'images/universities/Frederick_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Cyprus',
        'highlight' => '',
        'sub_heading' => 'Cyprus hosts several reputable universities known for academic excellence, modern infrastructure, and international recognition.',
        'footer' => 'The International University of Cyprus is particularly popular among international students due to its English-taught programs and strong academic reputation.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Hospitality and Tourism Management', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/fine-arts.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Cyprus',
        'desc' => 'Cyprus offers a wide range of globally relevant and career-oriented programs. Universities focus on practical skills and industry needs, making graduates job-ready.',
        'footer' => 'These programs are especially popular among students seeking affordable European education and strong career outcomes.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€5,000 – €9,000'],
            ['label' => 'Master’s Degree', 'value' => '€6,000 – €12,000'],
            ['label' => 'MBA', 'value' => '€7,000 – €15,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€6,000 – €10,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€4,000 – €7,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Cyprus',
        'description' => 'The cost of studying in Cyprus is relatively affordable compared to other European countries. Tuition fees vary by university and program, making financial planning easier for international students.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,500 – €5,000', 'note' => 'Shared accommodation lowers costs'],
                ['label' => 'Food', 'value' => '€1,800 – €2,500', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '€500 – €800', 'note' => 'Public transport is affordable'],
                ['label' => 'Personal Expenses', 'value' => '€800 – €1,700', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => '€6,000 – €10,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Cyprus for International Students',
            'description' => 'The cost of living in Cyprus is affordable and student-friendly. On average, international students spend between €6,000 – €10,000 per year, depending on city and lifestyle.',
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
        'title' => 'Student Life in Cyprus: What to Expect?',
        'desc' => 'Student life in Cyprus is relaxed, safe, and culturally rich. Universities offer clubs, sports activities, student societies, and social events that help international students integrate easily. With a Mediterranean lifestyle, friendly locals, and modern campuses, Cyprus provides a balanced and enjoyable student experience, making it an ideal destination for higher education in Europe.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Cyprus?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency may be required.',
            'Prepare Application Documents: Academic transcripts, SOP, and passport.',
            'Submit Application: Apply directly to the chosen university.',
            'Receive Offer Letter: Conditional or unconditional admission offer.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the student visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Cyprus',
    'desc' => 'Students planning to study in Cyprus for international students programs must submit the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'English Proficiency Test Scores (if required)',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof',
        'Offer Letter from a Cyprus University',
        ]
    ];

    $guideContent = [
    'title' => 'Cyprus Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Cyprus. The process includes securing admission, arranging finances, submitting documents, and completing visa formalities. Understanding these steps helps international students avoid delays and ensures a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from an Approved Institution',
        'Pay Tuition Fee Deposit',
        'Arrange Financial Proof',
        'Submit Visa Application and Documents',
        'Receive Visa Approval and Travel to Cyprus',
        ],
    'footer' => 'This structured process helps students prepare confidently and focus on academic success.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Cyprus?",
                "answer" => "Cyprus offers affordable tuition fees, globally recognized degrees, English-taught programs, and a safe European environment. This makes study in Cyprus for international students a popular choice for quality education and career growth."
            ],
            [
                "question" => "2.	Are universities in Cyprus recognized internationally?",
                "answer" => "Yes, most universities in Cyprus for international students are internationally accredited and their degrees are recognized across Europe and many other countries."
            ],
            [
                "question" => "3.	Is Cyprus good for master’s degree programs?",
                "answer" => "Absolutely. A master degree in Cyprus is highly valued due to industry-focused curricula, experienced faculty, and affordable costs compared to other European destinations."
            ],
            [
                "question" => "4.	Which is the best university in Cyprus for international students?",
                "answer" => "The International University of Cyprus is one of the top choices for international students, known for English-taught programs, modern facilities, and strong academic standards."
            ],
            [
                "question" => "5.	What is the cost of studying in Cyprus?",
                "answer" => "The average tuition fee ranges from €5,000 to €12,000 per year, depending on the course and level of study. Overall, study in Cyprus is more affordable than many other European countries."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection