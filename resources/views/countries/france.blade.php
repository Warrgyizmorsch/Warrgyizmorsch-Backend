@extends('layouts.app')
@section('content')

            <section class="service-hero">
                <div class="service-hero-content">
                    <h1 class="main-heading" style="font-size: 34px;">Study in France - Unlock World-Class Education and Global Careers</h1>
                    <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                        <p>WTS is a leading Study in France consultancy in India, offering complete support for choosing the right course and
                        university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                        in France.</p>

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
                        <p style="margin-top: 30px;">Study in France and take a step toward internationally recognized education and excellent career opportunities. France
                        is known for its academic excellence, affordable tuition fees, and strong focus on research and innovation. From top
                        public universities to elite business and engineering schools, study abroad France programs offer diverse options for
                        indian students. With proper guidance from experienced study in France consultants, students can smoothly plan
                        admissions, visas, scholarships, and financial support while focusing on building a successful global future.</p>
                    </div>
                    <div class="sub-hero-img">
                        <img src="/images/francenew.webp" loading="lazy" alt="Study in france">
                    </div>
                </div>
            </section>

        <!-- choose us section -->
        @php
    $sectionTitle = 'Why Study in France?';
    $sectionDescription = 'France is one of the most popular destinations for international education due to its high-quality academic system, globally respected degrees, and strong industry exposure. Home to leading multinational companies and research institutions, France provides excellent opportunities for students planning to study in France from India. The country offers a safe, culturally rich, and student-friendly environment, making it ideal for study in France for Indian students.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'France has a globally recognized education system with top-ranked universities and Grandes Écoles. Institutions emphasize academic excellence, innovation, and practical learning. Degrees awarded in France are internationally valued and open doors to global career opportunities.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the major advantages of studying abroad in France is its wide range of flexible and career-focused programs. Students can choose specialized courses aligned with industry needs, with options for internships, research projects, and professional training integrated into the curriculum.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'France welcomes students from all over the world, offering a multicultural and inclusive academic environment. Studying in France helps students gain global exposure, cultural awareness, and international networking opportunities, which are essential for long-term career success.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'France is a global hub for industries such as fashion, luxury, engineering, business, hospitality, technology, and aerospace. Universities maintain strong industry connections, providing internships, part-time work opportunities, and post-study employment options for international students.'],
        ['title' => '5. Research and Innovation', 'desc' => 'French universities and institutions are known for advanced research and innovation, particularly in science, engineering, artificial intelligence, and healthcare. Students actively participate in research initiatives, gaining hands-on experience and academic credibility.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'France offers various government and university-funded scholarships for international students. Additionally, students planning to study in France from India often apply for scholarships or opt for a study loan in France to manage tuition fees and living expenses effectively.'],
        ['title' => '7. International Student Support Services', 'desc' => 'French institutions provide comprehensive support services, including academic advising, career guidance, language support, healthcare access, and cultural integration programs, helping international students adapt smoothly to life in France.'],
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
                        'name' => 'Sorbonne University',
                        'logo' => 'images/universities/sarbonne.jpg',
                        'course' => 'Science & Medicine',
                        'ranking' => 1
                    ],
                    [
                        'name' => 'Université Paris-Saclay ',
                        'logo' => 'images/universities/parissaclay.webp',
                        'course' => 'Engineering & Technology',
                        'ranking' => 2
                    ],
                    [
                        'name' => 'École Polytechnique',
                        'logo' => 'images/universities/ecole.png',
                        'course' => 'Engineering & Physical Sciences',
                        'ranking' => 6
                    ],
                    [
                        'name' => 'HEC Paris',
                        'logo' => 'images/universities/hec.png',
                        'course' => 'Economics & Political Science',
                        'ranking' => 45
                    ],
                    [
                        'name' => 'Sciences Po',
                        'logo' => 'images/universities/sciencespo.png',
                        'course' => 'Arts & Humanities',
                        'ranking' => 22
                    ],
                    [
                        'name' => 'ESSEC Business School',
                        'logo' => 'images/universities/essec.png',
                        'course' => 'Health & Life Sciences',
                        'ranking' => 40
                    ],
                    [
                        'name' => 'Grenoble Alpes University',
                        'logo' => 'images/universities/grenoblealpes.webp',
                        'course' => 'Business & Law',
                        'ranking' => 32
                    ],
                ];
                $universitySection = [
                    'heading' => 'Top Universities in France',
                    'highlight' => '',
                    'sub_heading' => 'France is home to some of Europe’s most prestigious universities and institutions, known for academic excellence and research impact.',
                    'footer' => 'These institutions attract thousands of international students every year and offer strong academic and career support.'
                ];
            @endphp

            <x-universities :universities="$universities" :universitySection="$universitySection"/>

            <!-- course section  -->
            @php
    $courses = [
        ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
        ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
        ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
        ['title' => 'Fashion and Luxury Management', 'image' => 'images/courses/fine-arts.png'],
        ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ['title' => 'Hospitality and Tourism', 'image' => 'images/courses/hospitality.jpg'],
    ];
    $courseContent = [
        'title' => 'Popular Courses to Study in France',
        'desc' => 'France offers a wide range of high-demand programs that attract students from across the globe. Universities are known for academic rigor and strong employment outcomes.',
        'footer' => 'These programs are especially popular among study in France Indian students seeking quality education and global career growth.',
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
        ['label' => 'Undergraduate Degree', 'value' => '€2,500 - €5,000'],
        ['label' => 'Master’s Degree', 'value' => '€3,000 - €10,000'],
        ['label' => 'MBA', 'value' => '€15,000 - €40,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => '€3,000 - €6,000'],
        ['label' => 'Diploma / Certificate', 'value' => '€2,000 - €8,000'],
    ];
    $description = "";

    $ukCostOfLiving = [
        'heading' => 'Cost of Studying in France',
        'description' => 'The cost of studying in France is relatively affordable, especially at public universities. With scholarships or a study loan in France, international students can manage expenses effectively.'
    ];
    $livingFees = [
        ['label' => 'Housing', 'value' => '€3,000 - €7,000', 'note' => 'Shared accommodation reduces cost'],
        ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Home cooking is economical'],
        ['label' => 'Transportation', 'value' => '€600 - €1,000', 'note' => 'Student travel passes available'],
        ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Utilities and leisure'],
        ['label' => 'Total', 'value' => '€7,000 - €12,000', 'note' => 'Costs vary by city'],
    ];
    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in France for Indian Students',
        'description' => 'Living expenses in France depend on the city and lifestyle. On average, international students spend between €7,000 - €12,000 per year.',
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
        'title' => 'Student Life in the France: What to Expect?',
        'desc' => 'Student life in France is vibrant, culturally rich, and academically stimulating. Universities offer student clubs, cultural events, sports, and social activities. With historic cities, modern infrastructure, and strong student support systems, France provides an enriching experience for international students. Dedicated international offices assist students with academics, employment guidance, and personal well-being, making France an excellent destination to study and grow globally.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in France?',
        'guide_steps' => [
            'Research and Select Universities: Choose courses aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and language proficiency (English or French).',
            'Prepare Application Documents: Transcripts, SOP, CV, and recommendation letters.',
            'Check Application Deadlines: Vary by institution and intake.',
            'Receive Offer Letter: Conditional or unconditional admission offer.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin visa formalities.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
            @endphp
            <x-scholarship :scholarship="$scholarship"/>

            <!-- document section -->
            @php
    $documentContent = [
        'title' => 'Documents Required to Study in France',
        'desc' => 'Students planning to study in France from India must prepare the following documents:',
        'list' => [
            'Academic Transcripts and Certificates',
            'Language Proficiency Scores (IELTS / TOEFL / French language proof if required)',
            'Letters of Recommendation',
            'Statement of Purpose',
            'Valid Passport',
            'Financial Proof or Study Loan France documents',
            'Offer Letter from a Recognized French Instituition',
        ]
    ];

    $guideContent = [
        'title' => 'France Study Visa Process: Step-by-Step Guide',
        'desc' => 'A study visa is required to study in France. The process includes securing admission, arranging finances, submitting an online application, and completing document verification. Understanding each step helps students pursuing study abroad in France avoid delays and ensure a smooth visa process.',
        'list' => [
            'Receive Offer Letter from an Approved Institution: Obtain an admission letter from a recognized French university or institution.',
            'Pay Tuition Fee Deposit: Pay the required tuition deposit as mentioned in the offer letter.',
            'Arrange Financial Proof / Study Loan France: Show sufficient funds through bank statements or an approved study loan in France.',
            'Complete Online Visa Application: Apply through the France-Visas portal and register with Campus France if required.',
            'Submit Documents and Biometrics: Submit documents, passport, and biometrics at the nearest visa application centre.',
            'Visa Decision and Travel to France: After approval, students can travel to France and complete local residence registration.',
        ],
        'footer' => 'This structured process helps study in France Indian students prepare confidently for their academic journey.'
    ]
            @endphp
            <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


            @include('./components/cta-button')

            <!-- faq section  -->
             @php
    $faqs = [
        [
            "question" => "1.	Why should I study in France?",
            "answer" => "France offers high-quality education, globally recognised degrees, affordable tuition fees, and excellent career opportunities. With its rich culture and strong academic reputation, study in France is a popular choice for international students."
        ],
        [
            "question" => "2.	What are the best universities in France for international students?",
            "answer" => "Some top France universities for international students include Sorbonne University, Université Paris-Saclay, HEC Paris, ESSEC Business School, INSEAD, Sciences Po, and École Polytechnique."
        ],
        [
            "question" => "3.	Can I study in France in English?",
            "answer" => "Yes. Many French universities and business schools offer English-taught programs, especially at the Master’s level, making it easy for international students to study in France without knowing French."
        ],
        [
            "question" => "4.	What are the most popular courses in France?",
            "answer" => "Popular courses include Business & Management, Engineering, Fashion & Design, Hospitality, Data Science, Artificial Intelligence, and International Relations."
        ],
        [
            "question" => "5.	Are there scholarships for international students in France?",
            "answer" => "Yes. France offers several funding options including the Eiffel Excellence Scholarship, government scholarships, and university-specific France scholarship programs to support international students."
        ],
    ];
            @endphp
            <x-faq :faqs="$faqs" />

@endsection