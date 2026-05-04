@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Austria - A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Austria  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Austria .</p>

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
                <p style="margin-top:30px;">Study in Austria and take a step toward internationally recognised education in the heart of Europe. Known for its strong academic tradition, innovative research, and affordable education, Austria has become an attractive destination for global learners. With a wide range of public and private institutions, Austria universities for international students offer high-quality education combined with cultural richness and excellent career prospects. Choosing to study in Austria for international students means gaining global exposure while studying in a safe and student-friendly country.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/austrianew.webp" loading="lazy" alt="Study in austria">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Austria?';
    $sectionDescription = 'Austria is gaining popularity among international students due to its affordable tuition fees, globally respected degrees, and strong focus on research and innovation. Located in Central Europe, Austria offers easy access to other European countries, making it an ideal destination for academic and cultural growth. For students planning to study in Austria for international students, the country provides a high standard of living, safety, and quality education.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Austria is home to prestigious public universities known for academic excellence and research-driven education. Degrees awarded by Austria universities for international students are internationally recognised, especially in engineering, arts, sciences, and humanities. Institutions focus on analytical thinking, innovation, and real-world learning.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'Austria offers flexible academic programs designed to meet global industry standards. Students can choose specialised courses and research-oriented pathways, including a bachelor degree in Austria for international students, which provides strong foundational knowledge and career readiness.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Austria welcomes students from all over the world, creating a multicultural academic environment. Studying in Austria allows students to experience European culture, learn new languages, and develop a global perspective while building international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Austria has a strong economy with opportunities in engineering, manufacturing, tourism, finance, and technology. Universities collaborate with industries, offering internships, research projects, and work-based learning that improve employability after graduation.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Austria is known for excellence in research and innovation, especially in science, technology, sustainability, and engineering. Students actively participate in funded research projects, gaining hands-on academic and professional experience.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'To make education affordable, Austria offers multiple funding options, including government and university-based Austria scholarship programs. These scholarships support international students by reducing tuition costs and living expenses.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Austrian universities provide extensive support services such as academic counselling, career guidance, accommodation assistance, and integration programs, ensuring international students adapt smoothly to academic and social life.'],
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
                'name' => 'University of Vienna',
                'logo' => 'images/universities/Vienna_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Vienna University of Technology (TU Wien)',
                'logo' => 'images/universities/Vienna_Technology_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Graz University of Technology',
                'logo' => 'images/universities/Graz_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'University of Innsbruck',
                'logo' => 'images/universities/Innsbruck_logo.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Johannes Kepler University Linz',
                'logo' => 'images/universities/Johannes_Kepler_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Vienna University of Economics and Business',
                'logo' => 'images/universities/Vienna_Business_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Austria',
        'highlight' => '',
        'sub_heading' => 'Austria is home to well-established institutions with strong academic reputations and research excellence.',
        'footer' => 'These Austria universities for international students attract learners from across the globe and offer diverse academic pathways.'
    ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection"/>

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science and IT', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Natural Sciences', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Arts, Music, and Design', 'image' => 'images/courses/fine-arts.png'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
        'title' => 'Popular Courses to Study in Austria',
        'desc' => 'Austria offers a wide range of globally recognised academic programs with strong career outcomes.',
        'footer' => 'Many students prefer study in Austria for international students programs due to their affordability and academic depth.',
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
            ['label' => 'Bachelor Degree', 'value' => '€1,500 – €7,500'],
            ['label' => 'Master’s Degree', 'value' => '€2,000 – €10,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€2,000 – €6,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€3,000 – €10,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Austria',
        'description' => 'Austria is one of the most affordable study destinations in Europe, especially at public universities. Proper planning and an Austria scholarship can further reduce expenses.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€3,500 – €6,500', 'note' => 'Shared housing lowers costs'],
                ['label' => 'Food', 'value' => '€2,000 – €3,000', 'note' => 'Student cafeterias are affordable'],
                ['label' => 'Transportation', 'value' => '€400 – €800', 'note' => 'Student travel discounts available'],
                ['label' => 'Personal Expenses', 'value' => '€1,000 – €1,700', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€8,000 – €12,000', 'note' => 'Depends on city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Austria for International Students',
            'description' => 'The cost of living in Austria depends on the city and lifestyle. On average, students spend €8,000 – €12,000 per year.',
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
        'title' => 'Student Life in Austria: What to Expect?',
        'desc' => 'Student life in Austria is safe, vibrant, and culturally rich. Universities offer student organisations, sports, cultural festivals, and academic clubs. With a high quality of life, excellent public transport, and strong student support services, Austria provides a balanced and enriching environment for global learners.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Austria?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic goals',
            'Meet Entry Requirements: Academic qualifications and language proficiency',
            'Prepare Application Documents: Transcripts, SOP, and certificates',
            'Check Application Deadlines: Vary by university and intake',
            'Receive Admission Letter: Confirmation from the institution',
            'Apply for Student Visa: Begin visa and residence permit process',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Austria',
    'desc' => 'International students must prepare the following documents:',
    'list' => [
        'Academic Transcripts and Certificates',
        'Proof of Language Proficiency (English or German)',
        'Statement of Purpose',
        'Valid Passport',
        'Proof of Financial Means',
        'Health Insuranc',
        'Admission Letter from an Austrian University',
        ]
    ];

    $guideContent = [
    'title' => 'Austria Study Visa Process: Step-by-Step Guide ',
    'desc' => 'A study visa is required to study in Austria for international students. The process includes admission confirmation, financial proof, application submission, and document verification.',
    'list' => [
        'Receive Admission Letter: From a recognised Austrian university',
        'Arrange Financial Proof: Show sufficient funds for living and study ',
        'Apply for Visa / Residence Permit: Submit application at the embassy',
        'Submit Documents and Biometrics: Passport, admission letter, and insurance',
        'Visa Approval and Travel: Enter Austria and complete local registration',
        ],
    'footer' => 'This process helps students prepare smoothly for academic life in Austria.'
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Austria?",
                "answer" => "Austria offers high-quality education, globally recognised degrees, affordable tuition fees, and a strong research environment. Its central European location and safe lifestyle make it an attractive choice for international students."
            ],
            [
                "question" => "2.	Is Austria good for Indian students?",
                "answer" => "Yes, study in Austria for Indian students is a great option due to low tuition costs at public universities, English-taught programs, and excellent quality of life. Austria also provides a safe and welcoming environment for international students."
            ],
            [
                "question" => "3.	Are there English-taught programs in Austria?",
                "answer" => "Yes, many universities in Austria offer English-taught programs, especially at the master’s and doctoral levels, in fields like engineering, business, data science, and management."
            ],
            [
                "question" => "4.	What are the top universities in Austria for international students?",
                "answer" => "<p> Some popular Austria universities for international students include:</p>
                <ol>
                    <li>University of Vienna</li>
                    <li>Vienna University of Technology (TU Wien)</li>
                    <li>Graz University of Technology</li>
                    <li>University of Innsbruck</li>
                    <li>Johannes Kepler University Linz</li>
                </ol>"
            ],
            [
                "question" => "5.	What is the cost of studying in Austria?",
                "answer" => "Public universities in Austria charge low tuition fees, typically between €726 – €1,500 per year. Private universities may charge higher fees depending on the course and institution."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection