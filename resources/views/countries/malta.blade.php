@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Malta – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Malta consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Malta.</p>

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
                <p style="margin-top:30px;">Study in Malta and take the first step toward a globally recognised European education. Malta has become an emerging study destination due to its English-taught programs, affordable tuition fees, and strong academic standards. With internationally recognised institutions and a student-friendly environment, study in Malta for international students offers the perfect balance of quality education and lifestyle. Students choosing study in Malta for Indian students benefit from a safe country, Mediterranean culture, and access to European career opportunities.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/maltanew.webp" loading="lazy" alt="Study in malta">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Malta?';
    $sectionDescription = 'Malta is gaining popularity among international students for its high-quality education, English-speaking environment, and strategic location in Europe. The country offers globally recognised degrees, modern teaching methods, and strong links with European industries. For students planning to study in Malta, it provides a welcoming atmosphere, affordable living costs, and excellent academic exposure.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Malta follows a European-standard education system aligned with the Bologna Process. Institutions focus on practical learning, academic excellence, and skill-based education. Degrees awarded by a university in Malta for international students are recognised across Europe and other parts of the world.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'Academic programs in Malta are designed to meet global industry demands. Students can choose specialised programs with a strong focus on employability. Courses such as business, IT, hospitality, and healthcare offer practical exposure, making masters in Malta for international students a valuable career investment.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Malta attracts students from Europe, Asia, and Africa, creating a multicultural academic environment. Studying in such diversity enhances communication skills, cultural awareness, and global networking, which are essential for international careers.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Malta has growing industries in tourism, finance, gaming, IT, and healthcare. Universities maintain industry connections that offer internships, part-time work, and professional exposure. This makes study in Malta for international students ideal for gaining European work experience.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Malta is developing its research ecosystem in areas such as technology, sustainability, and digital innovation. Students participate in applied research projects that enhance academic knowledge and practical skills.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Several institutions offer scholarships and fee reductions for international students. Affordable tuition and living costs make study in Malta an attractive option compared to other European destinations.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities in Malta provide strong support services, including academic advising, career guidance, accommodation assistance, and cultural integration programs to help international students settle comfortably.'],
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
                'name' => 'University of Malta',
                'logo' => 'images/universities/Malta_logo.jpg',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Malta College of Arts, Science & Technology (MCAST)',
                'logo' => 'images/universities/MCAST_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'American University of Malta',
                'logo' => 'images/universities/American_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Global College Malta',
                'logo' => 'images/universities/Global_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'London School of Commerce Malta',
                'logo' => 'images/universities/London_logo.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Malta',
        'highlight' => '',
        'sub_heading' => 'Malta has well-established institutions offering globally recognised degrees and high academic standards.',
        'footer' => 'Each Malta university for international students offers English-taught programs and strong academic support.'
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
        'title' => 'Popular Courses to Study in Malta',
        'desc' => 'Malta offers industry-relevant programs designed for global employability. These courses are popular among students choosing study in Malta for international students.',
        'footer' => 'These programs are especially suitable for students pursuing masters in Malta for international students and long-term European careers.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€6,000 – €12,000'],
            ['label' => 'Master’s Degree', 'value' => '€8,000 – €16,000'],
            ['label' => 'MBA', 'value' => '€10,000 – €18,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€10,000 – €20,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€5,000 – €10,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Malta',
        'description' => 'The cost of studying in Malta is comparatively affordable, making it a preferred destination for international students seeking quality education within budget.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€3,000 – €6,000', 'note' => 'Shared accommodation reduces costs'],
                ['label' => 'Food', 'value' => '€2,000 – €3,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '€300 – €600', 'note' => 'Public transport is affordable'],
                ['label' => 'Personal Expenses', 'value' => '€700 – €1,500', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => '€6,000 – €10,000', 'note' => 'Varies by lifestyle'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Malta for Indian Students',
            'description' => 'Living costs in Malta are moderate compared to other European countries. On average, students spend €6,000 – €10,000 per year, depending on lifestyle and location.',
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
        'title' => 'Student Life in Malta: What to Expect?',
        'desc' => 'Student life in Malta is relaxed, safe, and culturally rich. Universities offer student clubs, sports activities, cultural festivals, and networking events. With a Mediterranean lifestyle, English-speaking environment, and supportive campuses, Malta provides a balanced academic and personal experience for international students.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Malta?',
        'guide_steps' => [
            'Research and Select Universities: Choose courses aligned with career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Submit Application: Apply directly to the chosen institution.',
            'Receive Offer Letter: Conditional or unconditional offer is issued.',
            'Confirm Admission and Apply for Visa: Accept the offer and proceed with visa application.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Malta',
    'desc' => 'Students planning to study in Malta must submit the following documents:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof',
        'Offer Letter from a Recognised Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Malta Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Malta. The process includes securing admission, arranging finances, applying online, and submitting documents. Understanding each step helps students applying for study in Malta for international students avoid delays.',
    'list' => [
        'Receive Offer Letter from a Recognised Institution',
        'Pay Tuition Fee Deposit',
        'Arrange Financial Proof',
        'Submit Visa Application',
        'Provide Documents and Biometrics',
        'Receive Visa Approval and Travel to Malta',
        ],
    'footer' => 'This structured process supports students planning to study in Malta for Indian students.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I study in Malta?",
                "answer" => "Malta offers English-taught programs, affordable tuition fees, and European-recognised degrees. It is a safe and student-friendly country, making study in Malta a great option for international students."
            ],
            [
                "question" => "2.	Is Malta good for international students?",
                "answer" => "Yes, study in Malta for international students is highly popular due to its welcoming culture, moderate living costs, and globally recognised education system."
            ],
            [
                "question" => "3.	Which is the best Malta university for international students?",
                "answer" => "The University of Malta is the most well-known institution. Other popular options include MCAST, American University of Malta, and Global College Malta. Each Malta university for international students offers English-taught programs."
            ],
            [
                "question" => "4.	Can Indian students study in Malta?",
                "answer" => "Yes, study in Malta for Indian students is a growing trend. Malta offers affordable education, a safe environment, and simple visa procedures for Indian students."
            ],
            [
                "question" => "5.	What courses are popular to study in Malta?",
                "answer" => "Popular courses include Business and Management, Computer Science, Engineering, Hospitality, Healthcare, and masters in Malta for international students in IT, business, and tourism."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection