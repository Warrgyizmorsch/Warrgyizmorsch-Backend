@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in Switzerland - A Smart Choice for Global Education and Career Growth</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in Switzerland consultancy in India, offering complete support for choosing the
                        right
                        course and
                        university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                        professional life
                        in Switzerland.</p>

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
                    <p style="margin-top: 30px;">Study in Switzerland and take the first step toward a globally recognized education. Switzerland is renowned for its high-quality education system, innovation, and career opportunities. We guide students planning to study abroad in Switzerland through university selection, visa requirements, scholarships, and test preparation. With its world-class universities, strong research ecosystem, and multicultural environment, Switzerland has become a top choice for students aiming to study in Switzerland from India and build a successful academic and professional future in one of Europe’s leading education hubs.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/switzerlandnew.webp" loading="lazy" alt="Study in switzerland">
                </div>
            </div>
        </section>

        <!-- choose us section -->
        @php
    $sectionTitle = 'Why Study in Switzerland?';
    $sectionDescription = 'Switzerland is a prime destination for international students because of its globally ranked universities, high-quality education, and strong industry connections. As a hub for finance, hospitality, technology, and research, Switzerland provides excellent academic exposure along with long-term career prospects. Students planning to study in Switzerland will find a safe, English-friendly environment and strong global networking opportunities.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'Switzerland is home to top-ranked universities that emphasize research, innovation, and practical learning. Swiss institutions focus on industry-relevant education, critical thinking, and skill development, preparing students for competitive global careers.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the major advantages of studying in Switzerland is its flexible academic system. Students can choose specialized programs aligned with industry needs, allowing them to gain practical exposure, internships, and project-based learning.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Switzerland attracts students from across the world, creating a multicultural campus environment. Studying in such a diverse setting helps students develop global perspectives, strong communication skills, and international networks, making study abroad Switzerland a valuable experience.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Switzerland is a global hub for finance, hospitality, pharmaceuticals, engineering, and IT. Universities maintain strong links with leading companies, offering internships, part-time work, and post-study employment opportunities that enhance employability.'],
        ['title' => '5. Research and Innovation', 'desc' => 'Swiss universities are known for cutting-edge research and innovation, particularly in technology, engineering, and life sciences. Students actively participate in research projects, gaining valuable academic and professional experience.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Switzerland provides scholarships and funding options for international students. Additionally, students planning to study in Switzerland from India may explore financial support or loans to manage tuition and living costs effectively.'],
        ['title' => '7. International Student Support Services', 'desc' => 'Swiss universities offer comprehensive support, including academic advising, career guidance, health services, and cultural integration programs. These services help students adapt smoothly to life in Switzerland.'],
    ];
        @endphp
        <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
        @include('./components/stats')


        <!-- universities section -->
        @php
    $universities = [
        [
            'name' => 'ETH Zurich (Swiss Federal Institute of Technology)',
            'logo' => 'images/universities/ethzurich.png',
            'course' => 'Science & Medicine',
            'ranking' => 1
        ],
        [
            'name' => 'University of Zurich',
            'logo' => 'images/universities/unizurich.png',
            'course' => 'Engineering & Technology',
            'ranking' => 2
        ],
        [
            'name' => 'University of Geneva',
            'logo' => 'images/universities/unigeneva.png',
            'course' => 'Engineering & Physical Sciences',
            'ranking' => 6
        ],
        [
            'name' => 'University of Lausanne',
            'logo' => 'images/universities/unilausanne.webp',
            'course' => 'Economics & Political Science',
            'ranking' => 45
        ],
        [
            'name' => 'University of St. Gallen (HSG)',
            'logo' => 'images/universities/hsg.jpg',
            'course' => 'Arts & Humanities',
            'ranking' => 22
        ],
        [
            'name' => 'EPFL (École Polytechnique Fédérale de Lausanne)',
            'logo' => 'images/universities/epfl.png',
            'course' => 'Health & Life Sciences',
            'ranking' => 40
        ],
        [
            'name' => 'University of Basel',
            'logo' => 'images/universities/unibasel.webp',
            'course' => 'Health & Life Sciences',
            'ranking' => 40
        ],
    ];
    $universitySection = [
        'heading' => 'Top Universities in Switzerland',
        'highlight' => '',
        'sub_heading' => 'Switzerland is home to some of Europe’s most prestigious universities, known for academic excellence and research output.',
        'footer' => 'These institutions attract thousands of international students every year and provide strong career support.'
    ];
        @endphp

        <x-universities :universities="$universities" :universitySection="$universitySection" />

        <!-- course section  -->
        @php
            $courses = [
                ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
                ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
                ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
                ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/medicine.jpg'],
                ['title' => 'Life Sciences and Social Sciences', 'image' => 'images/courses/environment.jpg'],
                ['title' => 'Finance and Economics', 'image' => 'images/courses/international-relations.png'],
                ['title' => 'Hospitality and Tourism', 'image' => 'images/courses/hospitality.jpg'],
            ];
            $courseContent = [
                'title' => 'Popular Courses to Study in Switzerland',
                'desc' => 'Switzerland offers a wide range of globally recognized programs with strong career outcomes. Some popular courses include:',
                'footer' => '',
            ];
        @endphp

        <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
            :footer="$courseContent['footer']" />


        <!-- cost of living section  -->
        @php
            $tuitionFees = [
                ['label' => 'Undergraduate Degree', 'value' => 'CHF 12,000 - 25,000'],
                ['label' => 'Master’s Degree', 'value' => 'CHF 15,000 - 30,000'],
                ['label' => 'MBA', 'value' => 'CHF 25,000 - 40,000'],
                ['label' => 'Doctoral Degree (PhD)', 'value' => 'CHF 15,000 - 25,000'],
                ['label' => 'Diploma / Certificate', 'value' => 'CHF 10,000 - 20,000'],
            ];
            $description = "";

            $ukCostOfLiving = [
                'heading' => 'Cost of Studying in Switzerland',
                'description' => 'The cost of studying in Switzerland varies depending on the university and program. Tuition fees are generally moderate compared to other European countries, but proper financial planning is essential.'
            ];
            $livingFees = [
                ['label' => 'Housing', 'value' => 'CHF 6,000 - 10,000', 'note' => 'Shared accommodation reduces costs'],
                ['label' => 'Food', 'value' => 'CHF 3,000 - 4,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => 'CHF 1,000 - 1,500', 'note' => 'Student travel passes available'],
                ['label' => 'Personal Expenses', 'value' => 'CHF 2,000 - 3,000', 'note' => 'Leisure, clothing, and utilities'],
                ['label' => 'Total', 'value' => 'CHF 12,000 - 18,000', 'note' => 'Costs vary by city'],
            ];
            $ukCostOfLivingRight = [
                'heading' => 'Living Expenses in Switzerland for Indian Students',
                'description' => 'The cost of living in Switzerland varies depending on the city and lifestyle. On average, students spend between CHF 12,000 - 18,000 per year.',
            ];
        @endphp
        <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
            :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
        <!-- scholarship section -->
        @php
            $scholarship = [
                'title' => 'Student Life in the Switzerland: What to Expect?',
                'desc' => 'Student life in Switzerland is vibrant, multicultural, and engaging. Universities provide clubs, sports, cultural events, and student societies that help international students feel at home. Safe cities, excellent academics, and strong career support make Switzerland an ideal destination for students looking to study in Switzerland from India and gain global exposure.',
                'footer' => '',
                'guide_title' => 'How to Apply for Universities in Switzerland?',
                'guide_steps' => [
                    'Research and Select Universities: Choose programs aligned with academic and career goals.',
                    'Meet Entry Requirements: Academic qualifications and English or local language proficiency are required.',
                    'Prepare Application Documents: Academic transcripts, SOP, recommendation letters, and financial proof.',
                    'Check Application Deadlines: Varies by university and intake.',
                    'Receive Offer Letter: Conditional or unconditional offer from the university.',
                    'Confirm Admission and Apply for Visa: Accept the offer and begin the Swiss student visa process.',
                ],
                'image' => 'images/whattoexpect.avif'
            ];
        @endphp
        <x-scholarship :scholarship="$scholarship" />

        <!-- document section -->
        @php
            $documentContent = [
                'title' => 'Documents Required to Study in Switzerland',
                'desc' => 'Students planning to study in Switzerland from India must submit the following:',
                'list' => [
                    'Academic Transcripts',
                    'English/Local Language Proficiency Test Scores (IELTS / TOEFL / DELF)',
                    'Letters of Recommendation',
                    'Statement of Purpose',
                    'Valid Passport',
                    'Proof of Funds or financial support documents',
                    'Offer Letter from a recognized Swiss institution',
                ]
            ];

            $guideContent = [
                'title' => 'Switzerland Study Visa Process: Step-by-Step Guide',
                'desc' => 'A study visa is required to study in Switzerland. The process involves admission, financial proof, visa application, and document submission:',
                'list' => [
                    'Receive Offer Letter from an Approved Institution: Obtain an official letter from a recognized Swiss university.',
                    'Pay Tuition Fee Deposit: Secure your seat by paying the required deposit.',
                    'Arrange Financial Proof: Show sufficient funds or financial support to cover tuition and living costs.',
                    'Complete Online Visa Application: Submit your student visa application through the official Swiss visa portal.',
                    'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, transcripts, and SOP.',
                    'Visa Approval and Travel: Once approved, travel to Switzerland and complete immigration registration.',
                ],
                'footer' => 'This process ensures that students planning to study abroad in Switzerland can focus on academics without delays.'
            ]
        @endphp
        <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


        @include('./components/cta-button')

        <!-- faq section  -->
        @php
    $faqs = [
        [
            "question" => "1.	Why should I choose to study in Switzerland?",
            "answer" => "Switzerland offers world-class education, high-quality research, and global career opportunities. With multicultural campuses and strong industry connections, students planning to study abroad in Switzerland gain excellent academic and professional exposure."
        ],
        [
            "question" => "2.	Can Indian students study in Switzerland?",
            "answer" => "Yes. Indian students can study in Switzerland from India by securing admission in recognized universities and applying for a Swiss student visa."
        ],
        [
            "question" => "3.	What are the popular courses in Switzerland?",
            "answer" => "Popular courses include Engineering, Business and Management, Computer Science / IT, Hospitality, Finance, Life Sciences, and Social Sciences. These programs combine academic excellence with practical career-focused training."
        ],
        [
            "question" => "4.	What is the cost of studying in Switzerland?",
            "answer" => "The cost of studying in Switzerland varies depending on the program and university. Tuition fees range from CHF 12,000 - 40,000 per year, and living expenses range between CHF 12,000 - 18,000 annually."
        ],
        [
            "question" => "5.	What documents are required to study in Switzerland?",
            "answer" => "Students need academic transcripts, English/Local language test scores, letters of recommendation, statement of purpose, valid passport, financial proof (or funding), and an offer letter from a recognized Swiss university."
        ],
        [
            "question" => "6.	How can I apply to universities in Switzerland?",
            "answer" => "You need to research universities, meet entry requirements, prepare your documents, check deadlines, receive your offer letter, and then apply for a student visa to study in Switzerland."
        ],
    ];
        @endphp
        <x-faq :faqs="$faqs" />

@endsection