@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Luxembourg – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Luxembourg consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Luxembourg.</p>

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
                <p style="margin-top:30px;">Studying in Luxembourg offers international students access to high-quality European education, strong research exposure, and excellent career prospects. Known for its multilingual environment, international outlook, and strategic location in Europe, Luxembourg has become an emerging destination for students planning to study in Luxembourg for international students. With globally recognised degrees and close industry links, the country provides an ideal academic setting for students aiming to build successful global careers.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/luxembourgnew.webp" loading="lazy" alt="Study in luxembourg">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Luxembourg?';
    $sectionDescription = 'Luxembourg is gaining popularity among international students due to its strong education system, innovative research environment, and international workforce. As one of Europe’s leading financial and business hubs, Luxembourg offers excellent academic exposure combined with real-world career opportunities. For students planning to study in Luxembourg for Indian students, the country provides a safe, multicultural, and English-friendly environment.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Luxembourg offers a modern and research-driven education system focused on academic excellence and innovation. Universities emphasise practical learning, interdisciplinary studies, and research-based teaching, ensuring students gain globally relevant skills.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'One of the major advantages of choosing to study in Luxembourg is its career-oriented academic structure. Programs are designed in collaboration with industry, allowing students to gain hands-on experience through internships, research projects, and professional training.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Luxembourg is one of the most multicultural countries in Europe. Universities host students from across the world, providing an inclusive and international learning environment. This diversity helps students develop global perspectives, intercultural skills, and strong international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Luxembourg is a global hub for finance, banking, law, logistics, and European institutions. Universities maintain close ties with multinational companies and organisations, offering internships, part-time work opportunities, and strong career support for graduates.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Research and innovation play a key role in Luxembourg’s education system. Universities focus on cutting-edge research in areas such as data science, finance, sustainability, and space technology, allowing students to actively participate in high-impact research projects.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Luxembourg offers various funding options for international students, including government grants and Luxembourg scholarship opportunities. These scholarships help reduce the financial burden and make education more accessible for students planning to study abroad.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Universities in Luxembourg provide strong student support services, including academic advising, career guidance, healthcare access, and integration programs. These services help international students adjust smoothly to academic and social life in the country.'],
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
                'name' => 'University of Luxembourg',
                'logo' => 'images/universities/Luxembourg_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Luxembourg Institute of Science and Technology (LIST)',
                'logo' => 'images/universities/LIST_logo.jpg',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Luxembourg Institute of Socio-Economic Research (LISER)',
                'logo' => 'images/universities/LISER_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Luxembourg Institute of Health (LIH)',
                'logo' => 'images/universities/LIH_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Luxembourg',
        'highlight' => '',
        'sub_heading' => 'Luxembourg may have a smaller number of institutions, but its universities are known for academic excellence, research output, and global partnerships. Each Luxembourg university for international students offers strong academic and professional support.',
        'footer' => 'These institutions attract students from across the globe and offer a highly international academic environment.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Finance and Banking', 'image' => 'images/courses/it.png'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Law and European Studies', 'image' => 'images/courses/fine-arts.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Luxembourg',
        'desc' => 'Luxembourg offers a range of specialised and industry-focused academic programs with strong global recognition. These courses are especially popular among students looking to study in a dynamic European economy.',
        'footer' => 'These programs are widely chosen by students seeking quality education and international career opportunities.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€400 – €2,500'],
            ['label' => 'Master’s Degree', 'value' => '€500 – €4,000'],
            ['label' => 'MBA', 'value' => '€8,000 – €25,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€0 – €3,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€2,000 – €6,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Luxembourg',
        'description' => 'The cost of studying in Luxembourg is relatively affordable compared to other European countries, especially at public universities. Proper financial planning and scholarships can further reduce expenses.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€4,000 – €7,000', 'note' => 'Shared accommodation lowers cost'],
                ['label' => 'Food', 'value' => '€2,500 – €3,500', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => '€300 – €600', 'note' => 'Free public transport nationwide'],
                ['label' => 'Personal Expenses', 'value' => '€1,500 – €3,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€10,000 – €15,000', 'note' => 'Depends on lifestyle and city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Luxembourg for Indian Students',
            'description' => 'Living costs in Luxembourg are higher than in many European countries, but students benefit from excellent public services and quality of life. Average annual living expenses range between €10,000 – €15,000.',
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
        'title' => 'Student Life in Luxembourg: What to Expect?',
        'desc' => 'Student life in Luxembourg is safe, multicultural, and enriching. Universities offer student clubs, cultural activities, academic events, and sports facilities. With a strong international community, excellent public transport, and high living standards, Luxembourg provides an ideal environment for academic growth and personal development.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Luxembourg?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and language proficiency (English/French/German).',
            'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
            'Check Application Deadlines: Vary by institution and intake.',
            'Receive Offer Letter: Admission confirmation from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and start the visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Luxembourg',
    'desc' => 'Students planning to study in Luxembourg for Indian students must submit the following documents:',
    'list' => [
        'Academic Transcripts',
        'Language Proficiency Test Scores (IELTS / TOEFL or equivalent)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Proof of Funds or Scholarship Documents',
        'Offer Letter from a Recognised Institution',
        ]
    ];

    $guideContent = [
    'title' => 'Luxembourg Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Luxembourg for international students. The process includes securing admission, arranging finances, applying for a visa, and submitting documents. Understanding these steps helps students avoid delays and ensures a smooth visa experience.',
    'list' => [
        'Receive Offer Letter from a Recognised Institution',
        'Arrange Financial Proof or Scholarship',
        'Submit Visa Application and Documents',
        'Attend Visa Appointment if Required',
        'Receive Visa Approval and Travel to Luxembourg',
        'Register with Local Authorities After Arrival',
        ],
    'footer' => 'This structured process helps students prepare confidently for their academic journey.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Luxembourg?",
                "answer" => "Luxembourg offers high-quality education, globally recognised degrees, and strong career opportunities in finance, business, and technology. Its multicultural environment makes it ideal to study in Luxembourg for international students."
            ],
            [
                "question" => "2.	Is Luxembourg a good choice for Indian students?",
                "answer" => "Yes, study in Luxembourg for Indian students is a great option due to its safe environment, English-taught programs, affordable public university fees, and strong job prospects across Europe."
            ],
            [
                "question" => "3.	Which is the best Luxembourg university for international students?",
                "answer" => "The University of Luxembourg is the top and most popular Luxembourg university for international students, known for research-driven education and strong industry connections."
            ],
            [
                "question" => "4.	What are the popular courses to study in Luxembourg?",
                "answer" => "Popular courses include Business and Management, Finance and Banking, Computer Science, Engineering, Law, and European Studies."
            ],
            [
                "question" => "5.	What is the cost of studying in Luxembourg?",
                "answer" => "Public universities in Luxembourg are affordable, with tuition fees ranging from €400 to €4,000 per year. Living expenses usually range between €10,000 and €15,000 annually."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection