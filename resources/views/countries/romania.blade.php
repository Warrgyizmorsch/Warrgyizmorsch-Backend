@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Romania – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Romania consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Romania.</p>

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
                <p style="margin-top:30px;">Study in Romania and take the first step toward a globally recognized education. Romania offers high-quality academic programs, innovative research opportunities, and strong post-study career prospects. We guide students on Romania university admission, scholarships, and course selection. With its reputable universities and welcoming environment, Romania has become a preferred destination for international students seeking quality education. Students can focus on building a successful academic and professional future in one of Europe’s fastest-growing education hubs.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/romanianew.webp" loading="lazy" alt="Study in australia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Romania?';
    $sectionDescription = 'Romania has emerged as a top choice for international students due to its affordable, world-class education system, globally recognized degrees, and strong industry exposure. With a safe, English-speaking environment and a growing international student community, study in Romania offers excellent academic opportunities and long-term career growth. For students looking for Romania university for international students, the country provides top-notch programs and cultural diversity.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Romanian universities are recognized globally for academic excellence, research, and practical learning. Institutions in Romania focus on industry-relevant education, innovation, and skill development, preparing students for successful careers worldwide.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the advantages of studying in Romania is its flexible academic structure. Students can choose programs aligned with industry needs, gaining practical experience through internships, research projects, and hands-on learning opportunities offered by Romania university programs.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Romania welcomes students from all over the world, offering a multicultural campus environment. Studying in such a diverse setting develops global perspectives, strong communication skills, and international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Romania is rapidly growing in sectors like IT, engineering, business, and healthcare. Universities maintain strong ties with industries, offering internships, research projects, and employment guidance that enhance students’ employability.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Universities in Romania encourage research and innovation, especially in technology, medicine, and engineering. Students actively participate in projects, gaining valuable academic and professional experience through Romania university for international students programs.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Romania offers various scholarships and funding opportunities to support international students. Students planning to study in Romania can also explore scholarships or financial aid options available for tuition and living expenses.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Romanian universities provide excellent support services, including academic advising, career counseling, health services, and cultural integration programs. These help international students adjust smoothly to life in Romania.'],
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
                'name' => 'University of Bucharest',
                'logo' => 'images/universities/Bucharest_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Babeș-Bolyai University, Cluj-Napoca',
                'logo' => 'images/universities/Babeș_Bolyai_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Alexandru Ioan Cuza University, Iași',
                'logo' => 'images/universities/Alexandru_logo.jpg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Politehnica University of Bucharest',
                'logo' => 'images/universities/Politehnica_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Timișoara',
                'logo' => 'images/universities/Timișoara_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Carol Davila University of Medicine and Pharmacy, Bucharest',
                'logo' => 'images/universities/Carol_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Technical University of Cluj-Napoca',
                'logo' => 'images/universities/Cluj_Napoca_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Romania',
        'highlight' => '',
        'sub_heading' => 'Romania is home to prestigious universities known for academic excellence and research. Romania university admission is open for international students across these top institutions:',
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
        'title' => 'Popular Courses to Study in Romania',
        'desc' => 'Romanian universities offer a wide range of globally recognized programs across multiple fields. These programs are designed to meet industry requirements and ensure strong career outcomes.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€3,500 – €9,000'],
            ['label' => 'Master’s Degree', 'value' => '€4,000 – €12,000'],
            ['label' => 'MBA', 'value' => '€6,000 – €12,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€3,000 – €6,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€2,500 – €6,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Romania',
        'description' => 'Studying in Romania is affordable compared to other European countries. Proper financial planning, scholarships, or personal funding ensures smooth academic progress.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,500 – €5,000', 'note' => 'Shared apartments reduce costs'],
                ['label' => 'Food', 'value' => '€1,500 – €2,500', 'note' => 'Cooking at home is cheaper'],
                ['label' => 'Transportation', 'value' => '€400 – €700', 'note' => 'Public transport with student cards'],
                ['label' => 'Personal Expenses', 'value' => '€600 – €1,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€5,000 – €9,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Romania for Indian Students',
            'description' => 'The cost of living in Romania is moderate and depends on the city and lifestyle. On average, international students spend between €5,000 – €9,000 per year.',
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
        'title' => 'Student Life in Romania: What to Expect?',
        'desc' => 'Student life in Romania is vibrant and engaging. Universities offer cultural events, clubs, sports, and student societies to help international students feel at home. Friendly locals, safe cities, and strong academic support make Romania an ideal destination for those who want to study in Romania and build a global career. Romania university for international students programs provide guidance and opportunities to balance academics and personal growth.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Romania?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs that match your academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency (or Romanian, depending on program) are required.',
            'Prepare Application Documents: Academic transcripts, statement of purpose, and recommendation letters.',
            'Check Application Deadlines: Deadlines vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional admission from the Romania university.',
            'Confirm Admission and Apply for Visa: Accept the offer and apply for a student visa to study in Romania.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Romania',
    'desc' => 'Students planning to study in Romania from India should prepare the following:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof or Bank Statement',
        'Offer Letter from an Approved Romania university for international students',
        ]
    ];

    $guideContent = [
    'title' => 'Romania Study Visa Process: Step-by-Step Guide',
    'desc' => 'To study in Romania, international students need a study visa. The process is simple and involves the following steps:',
    'list' => [
        'Receive Offer Letter from an Approved University: Admission from a recognized Romania university is mandatory.',
        'Pay Tuition Fee Deposit: Confirm your seat by paying the required deposit.',
        'Arrange Financial Proof: Show sufficient funds to cover tuition and living expenses.',
        'Complete Online Visa Application: Apply for a Romania student visa through the official portal.',
        'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, and other required documents at the nearest Romanian Embassy.',
        'Visa Approval and Travel: Once approved, travel to Romania and register with local authorities.',
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
                "question" => "1.	Is Romania a good country for international students?",
                "answer" => "Yes, Romania is a popular study destination due to its affordable tuition fees, recognised degrees, and safe student-friendly environment. Many Romania universities welcome international students every year."
            ],
            [
                "question" => "2.	What are the top universities in Romania for international students?",
                "answer" => "Some well-known Romania universities include the University of Bucharest, Babeș-Bolyai University, Carol Davila University of Medicine, and Politehnica University of Bucharest."
            ],
            [
                "question" => "3.	What is the cost of studying in Romania?",
                "answer" => "Tuition fees in Romania range from €3,500 to €12,000 per year, depending on the course and university. Medical programs usually cost more than other fields."
            ],
            [
                "question" => "4.	What are the living expenses for students in Romania?",
                "answer" => "The average living cost in Romania is €5,000 – €9,000 per year, covering accommodation, food, transport, and personal expenses."
            ],
            [
                "question" => "5.	Is IELTS required for Romania university admission?",
                "answer" => "IELTS is required for English-taught programs in most Romania universities. Some universities may offer alternatives or accept previous education in English."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection