@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in Finland - A Gateway to Global Education and Career Success</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in Finland consultancy in India, offering complete support for choosing the
                        right
                        course and
                        university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                        professional life
                        in Finland.</p>

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
                    <p style="margin-top: 30px;">Study in Finland and take the first step toward a globally respected education system known for innovation, sustainability, and academic excellence. Finland offers world-class universities, modern teaching methods, and strong industry collaboration. With a growing number of English-taught programs, especially masters in Finland, the country has become a top choice for international students seeking quality education and career-focused learning in Europe.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/finlandnew.webp" loading="lazy" alt="Study in finland">
                </div>
            </div>
        </section>

        <!-- choose us section -->
        @php
    $sectionTitle = 'Why Study in Finland?';
    $sectionDescription = 'Finland has gained global recognition for its student-friendly education system, high academic standards, and strong emphasis on research and innovation. Home to some of the best Finland universities for international students, the country provides excellent learning opportunities in a safe, progressive, and English-speaking academic environment.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'Finland’s education system is consistently ranked among the best in the world. Universities focus on research-based learning, critical thinking, and practical application of knowledge. Degrees from Finnish institutions are internationally recognised and highly valued by employers.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the key benefits of choosing to study in Finland is its flexible and student-centric academic structure. Programs are designed in collaboration with industries, helping students gain job-ready skills through projects, internships, and real-world problem-solving.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Finland welcomes students from across the globe, creating a multicultural and inclusive campus environment. Studying in such a diverse setting helps students build global perspectives, adaptability, and international professional networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Finland is a leader in technology, clean energy, gaming, education, and innovation. Universities maintain strong links with industries, offering internship opportunities, research collaborations, and post-study career pathways for international students.'],
        ['title' => '5. Research and Innovation', 'desc' => 'Finnish universities are known for advanced research in technology, artificial intelligence, sustainability, healthcare, and engineering. Students actively participate in research projects, gaining valuable academic and professional experience during their studies.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'To support international students, Finland offers various funding options, including government and university-level Finland scholarship programs. These scholarships help reduce tuition costs, making education more affordable for students pursuing masters in Finland.'],
        ['title' => '7. International Student Support Services', 'desc' => 'Universities in Finland provide strong student support services, including academic guidance, career counselling, health services, and integration programs. These services ensure a smooth transition and a comfortable student life.'],
    ];
        @endphp
        <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
        @include('./components/stats')


        <!-- universities section -->
        @php
    $universities = [
        [
            'name' => 'University of Helsinki',
            'logo' => 'images/universities/unihelsinki.webp',
            'course' => 'Science & Medicine',
            'ranking' => 1
        ],
        [
            'name' => 'Aalto University',
            'logo' => 'images/universities/aaltouni.png',
            'course' => 'Engineering & Technology',
            'ranking' => 2
        ],
        [
            'name' => 'Tampere University',
            'logo' => 'images/universities/tampereuni.png',
            'course' => 'Engineering & Physical Sciences',
            'ranking' => 6
        ],
        [
            'name' => 'University of Turku',
            'logo' => 'images/universities/uniturku.webp',
            'course' => 'Economics & Political Science',
            'ranking' => 45
        ],
        [
            'name' => 'University of Oulu',
            'logo' => 'images/universities/unioulu.png',
            'course' => 'Arts & Humanities',
            'ranking' => 22
        ],
        [
            'name' => 'LUT University',
            'logo' => 'images/universities/lut.png',
            'course' => 'Health & Life Sciences',
            'ranking' => 40
        ],
        [
            'name' => 'University of Eastern Finland',
            'logo' => 'images/universities/unieastfin.png',
            'course' => 'Health & Life Sciences',
            'ranking' => 40
        ],
    ];
    $universitySection = [
        'heading' => 'Top Universities in Finland',
        'highlight' => '',
        'sub_heading' => 'Finland is home to several prestigious institutions known for research excellence and modern education systems. These Finland universities for international students attract learners from all over the world.',
        'footer' => 'These universities offer English-taught programs, strong research facilities, and excellent student support services.'
    ];
        @endphp

        <x-universities :universities="$universities" :universitySection="$universitySection" />

        <!-- course section  -->
        @php
    $courses = [
        ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
        ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
        ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
        ['title' => 'Environmental Sciences and Sustainability', 'image' => 'images/courses/environment.jpg'],
        ['title' => 'Data Science and Artificial Intelligence', 'image' => 'images/courses/ai.jpg'],
        ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
    ];
    $courseContent = [
        'title' => 'Popular Courses to Study in Finland',
        'desc' => 'Finland offers a wide range of high-demand programs taught in English, especially at the postgraduate level. Many students choose masters in Finland due to the country’s strong academic reputation and career prospects.',
        'footer' => 'These programs are especially popular among students seeking innovation-driven education and global career opportunities.',
    ];
        @endphp

        <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
            :footer="$courseContent['footer']" />


        <!-- cost of living section  -->
        @php
    $tuitionFees = [
        ['label' => 'Bachelor’s  Degree', 'value' => '€6,000 - €12,000'],
        ['label' => 'Master’s Degree', 'value' => '€8,000 - €18,000'],
        ['label' => 'MBA', 'value' => '€10,000 - €25,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => 'Mostly funded'],
        ['label' => 'Diploma / Certificate', 'value' => '€5,000 - €10,000'],
    ];
    $description = "";

    $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Finland',
        'description' => 'The cost of studying in Finland depends on the university and program. While EU students often study tuition-free, non-EU students may need to pay tuition fees, which can be reduced through a Finland scholarship.'
    ];
    $livingFees = [
        ['label' => 'Housing', 'value' => '€3,000 - €6,000', 'note' => 'Student housing is affordable'],
        ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Cooking at home saves money'],
        ['label' => 'Transportation', 'value' => '€500 - €900', 'note' => 'Student travel discounts available'],
        ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Utilities and leisure'],
        ['label' => 'Total', 'value' => '€7,000 - €11,000', 'note' => 'vary by city'],
    ];
    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in Finland for Indian Students',
        'description' => 'The cost of living in Finland depends on the city and lifestyle. On average, students spend between €7,000 - €11,000 per year.',
    ];
        @endphp
        <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
            :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
        <!-- scholarship section -->
        @php
    $scholarship = [
        'title' => 'Student Life in the Finland: What to Expect?',
        'desc' => 'Student life in Finland is balanced, peaceful, and enriching. Universities offer clubs, sports, cultural events, and student organisations that help international students integrate easily. With safe cities, modern infrastructure, and strong academic support, Finland provides an ideal environment for learning, innovation, and personal growth.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Finland?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs aligned with academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
            'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters.',
            'Apply via Joint Application System: Many programs accept applications through Studyinfo.fi.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Residence Permit: Accept the offer and begin the visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
        @endphp
        <x-scholarship :scholarship="$scholarship" />

        <!-- document section -->
        @php
    $documentContent = [
        'title' => 'Documents Required to Study in Finland',
        'desc' => 'Students planning to study in Finland must submit the following documents:',
        'list' => [
            'Academic Transcripts and Certificates',
            'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
            'Statement of Purpose',
            'Letters of Recommendation (if required)',
            'Valid Passport',
            'Proof of Funds or Scholarship Documents',
            'Offer Letter from a Finnish University',
        ]
    ];

    $guideContent = [
        'title' => 'Finland  Study Visa Process: Step-by-Step Guide',
        'desc' => 'A residence permit is required for international students planning to study in Finland. The process involves securing admission, arranging finances, applying online, and submitting biometric details. Understanding each step helps students avoid delays and ensures a smooth transition.',
        'list' => [
            'Receive offer letter from a Finnish university',
            'Pay tuition fee (if applicable)',
            'Arrange financial proof or scholarship',
            'Apply online for a student residence permit',
            'Submit documents and biometrics',
            'Receive decision and travel to Finland',
        ],
        'footer' => 'This structured process helps students prepare confidently for their academic journey.'
    ]
        @endphp
        <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


        @include('./components/cta-button')

        <!-- faq section  -->
        @php
    $faqs = [
        [
            "question" => "1.	Why should international students study in Finland?",
            "answer" => "Finland offers a world-class education system, innovative teaching methods, and globally recognised degrees. Students who study in Finland benefit from research-oriented learning, safe living conditions, and strong career opportunities."
        ],
        [
            "question" => "2.	Are there English-taught programs available in Finland?",
            "answer" => "Yes, many Finland universities for international students offer a wide range of programs taught entirely in English, especially at the postgraduate level, including masters in Finland."
        ],
        [
            "question" => "3.	What are the popular courses to study in Finland?",
            "answer" => "Popular courses include Engineering, Computer Science, Data Science, Business Management, Environmental Studies, and Artificial Intelligence. Masters in Finland are especially popular due to their industry-focused curriculum."
        ],
        [
            "question" => "4.	What is the cost of studying in Finland for international students?",
            "answer" => "Tuition fees for non-EU students usually range from €6,000 to €18,000 per year, depending on the course and university. Living expenses are approximately €7,000-€11,000 per year."
        ],
        [
            "question" => "5.	Is there any Finland scholarship available for international students?",
            "answer" => "Yes, many universities offer Finland scholarship programs that cover partial or full tuition fees. Some scholarships also include living cost support, especially for master’s degree students."
        ],
        [
            "question" => "6.	How do I apply to study in Singapore?",
            "answer" => "Select a university, prepare documents, submit applications, receive the offer, and apply for a student visa."
        ],
    ];
        @endphp
        <x-faq :faqs="$faqs" />

@endsection