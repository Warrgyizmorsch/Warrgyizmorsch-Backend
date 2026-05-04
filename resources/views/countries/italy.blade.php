@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in Italy - Shape Your Future with Global Education</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in Italy consultancy in India, offering complete support for choosing the
                        right
                        course and
                        university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                        professional life
                        in Italy.</p>

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
                    <p style="margin-top: 30px;">Study in Italy with expert guidance and take the first step toward a globally recognized education. We guide students through university selection, visa processing, scholarships, and test preparation. With a strong reputation for academic excellence, innovation, and post-study career opportunities, Italy has become a preferred destination for students planning to study in Italy. This guidance ensures a smooth transition so students can focus on building a successful academic and professional future in one of Europe’s most culturally rich countries.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/italynew.webp" loading="lazy" alt="Study in Italy">
                </div>
            </div>
        </section>

        <!-- choose us section -->
        @php
    $sectionTitle = 'Why Study in Italy?';
    $sectionDescription = 'Italy has emerged as a top destination for international students due to its world-class education system, prestigious universities, and vibrant culture. Known for its art, design, technology, and scientific research, Italy provides excellent academic exposure along with promising career prospects. For students planning to study in Italy from India, the country offers a safe, English-friendly environment, rich cultural heritage, and strong global networks.';

    $cards = [
        ['title' => '1. World-Class Education System', 'desc' => 'Italy is home to globally recognized universities that focus on research, practical learning, and skill development. Italian institutions emphasize critical thinking, innovation, and industry-relevant education, preparing students for competitive international careers.'],
        ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'A major advantage of study in Italy programs is the flexibility of curriculum and specialization. Students can select programs aligned with career goals, gaining hands-on experience through internships, workshops, and project-based learning.'],
        ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Italian universities welcome students from around the world, providing a multicultural campus experience. Studying in such a diverse environment helps students develop global perspectives, cross-cultural communication skills, and international networks.'],
        ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Italy is a hub for design, fashion, automotive, engineering, and technology industries. Universities collaborate with leading companies, providing internships, part-time jobs, and post-study employment opportunities, enhancing students’ career prospects.'],
        ['title' => '5. Research and Innovation', 'desc' => 'Italian universities are recognized for research in engineering, technology, healthcare, and design. Students actively participate in research projects, gaining valuable academic and professional experience that prepares them for global challenges.'],
        ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Italy offers various scholarships and financial aid options for international students. Many students planning to study in Italy on scholarship also combine financial assistance with savings to manage tuition and living expenses efficiently.'],
        ['title' => '7. International Student Support Services', 'desc' => 'Italian institutions provide extensive support services, including academic advising, career counseling, health services, and cultural integration programs. This helps students settle smoothly and enjoy a fulfilling student life.'],
    ];
        @endphp
        <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
        @include('./components/stats')


        <!-- universities section -->
        @php
            $universities = [
                [
                    'name' => 'University of Bologna',
                    'logo' => 'images/universities/bologna.jpg',
                    'course' => 'Science & Medicine',
                    'ranking' => 1
                ],
                [
                    'name' => 'Sapienza University of Rome',
                    'logo' => 'images/universities/unirome.webp',
                    'course' => 'Engineering & Technology',
                    'ranking' => 2
                ],
                [
                    'name' => 'Politecnico di Milano',
                    'logo' => 'images/universities/milano.png',
                    'course' => 'Engineering & Physical Sciences',
                    'ranking' => 6
                ],
                [
                    'name' => 'University of Padua',
                    'logo' => 'images/universities/padua.png',
                    'course' => 'Economics & Political Science',
                    'ranking' => 45
                ],
                [
                    'name' => 'University of Milan',
                    'logo' => 'images/universities/unimilan.webp',
                    'course' => 'Arts & Humanities',
                    'ranking' => 22
                ],
                [
                    'name' => 'University of Florence',
                    'logo' => 'images/universities/florence.webp',
                    'course' => 'Health & Life Sciences',
                    'ranking' => 40
                ],
                [
                    'name' => 'University of Turin',
                    'logo' => 'images/universities/turinuni.png',
                    'course' => 'Health & Life Sciences',
                    'ranking' => 40
                ],
            ];
            $universitySection = [
                'heading' => 'Top Universities in Italy',
                'highlight' => '',
                'sub_heading' => 'Italy hosts some of the most prestigious universities in Europe, known for academic excellence and research opportunities:',
                'footer' => 'These universities attract thousands of international students every year and provide strong career guidance and industry connections.'
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
                ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
                ['title' => 'Design and Arts', 'image' => 'images/courses/fine-arts.png'],
            ];
            $courseContent = [
                'title' => 'Popular Courses to Study in Italy',
                'desc' => 'Italy offers a wide variety of academic programs recognized worldwide. Universities are known for their industry-focused curriculum and global employability outcomes.',
                'footer' => 'These programs are particularly popular among students seeking quality education combined with cultural and professional exposure.',
            ];
        @endphp

        <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
            :footer="$courseContent['footer']" />


        <!-- cost of living section  -->
        @php
    $tuitionFees = [
        ['label' => 'Undergraduate Degree', 'value' => '€8,000 - €20,000'],
        ['label' => 'Master’s Degree', 'value' => '€10,000 - €25,000'],
        ['label' => 'MBA', 'value' => '€18,000 - €35,000'],
        ['label' => 'Doctoral Degree (PhD)', 'value' => '€10,000 - €20,000'],
        ['label' => 'Diploma / Certificate', 'value' => '€6,000 - €15,000'],
    ];
    $description = "";

    $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Italy',
        'description' => 'The cost of studying in Italy varies depending on the university, program, and level of study. Proper financial planning, scholarships, or guidance from study in Italy consultants in India can make education affordable.'
    ];
    $livingFees = [
        ['label' => 'Housing', 'value' => '€3,000 - €7,000', 'note' => 'Shared apartments reduces costs'],
        ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Home cooking is economical'],
        ['label' => 'Transportation', 'value' => '€500 - €900', 'note' => 'Student travel cards available'],
        ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'utilities, entertainment'],
        ['label' => 'Total', 'value' => '€7,000 - €12,000', 'note' => 'Costs vary by city'],
    ];
    $ukCostOfLivingRight = [
        'heading' => 'Living Expenses in Italy for Indian Students',
        'description' => 'Living costs vary depending on the city and lifestyle. On average, students spend between €7,000 - €12,000 per year.',
    ];
        @endphp
        <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
            :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
        <!-- scholarship section -->
        @php
    $scholarship = [
        'title' => 'Student Life in the Italy: What to Expect?',
        'desc' => 'Student life in Italy is vibrant and culturally rich. Universities offer clubs, sports, cultural events, and student societies that help international students adapt. With safe cities, friendly locals, and strong academic support, Italy provides an engaging and rewarding student experience.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Italy?',
        'guide_steps' => [
            'Research and Select Universities: Choose programs matching academic and career goals.',
            'Meet Entry Requirements: Academic qualifications and English/Italian language proficiency.',
            'Prepare Application Documents: Transcripts, statement of purpose, recommendation letters.',
            'Check Application Deadlines: Deadlines vary by university and intake.',
            'Receive Offer Letter: Conditional or unconditional offer from the university.',
            'Confirm Admission and Apply for Visa: Accept the offer and begin the study in Italy visa requirements process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
        @endphp
        <x-scholarship :scholarship="$scholarship" />

        <!-- document section -->
        @php
            $documentContent = [
                'title' => 'Documents Required to Study in Italy',
                'desc' => 'Students planning to study in Italy from India must submit the following:',
                'list' => [
                    'Academic Transcripts',
                    'English Proficiency Test Scores (IELTS / TOEFL / CILS)',
                    'Letters of Recommendation',
                    'Statement of Purpose',
                    'Valid Passport',
                    'Financial Proof or Scholarship Documents',
                    'Offer Letter from an Approved Institution',
                ]
            ];

            $guideContent = [
                'title' => 'Italy Study Visa Process: Step-by-Step Guide',
                'desc' => 'A study visa is required to study in Italy. The process involves admission, financial proof, online application, and document submission. Understanding these steps helps students applying for study in Italy on scholarship or regular programs complete the process efficiently.',
                'list' => [
                    'Receive Offer Letter from an Approved Institution: From an Italian university listed under the Ministry of Education.',
                    'Pay Tuition Fee Deposit: As mentioned in the admission letter.',
                    'Arrange Financial Proof / Scholarship Documents: Show funds or scholarship confirmation.',
                    'Complete Online Visa Application: Apply through the official Italy student visa portal.',
                    'Submit Documents and Biometrics: At the nearest Italian Visa Application Centre.',
                    'Visa Decision and Travel to Italy: Once approved, students can travel and register with local authorities.',
                ],
                'footer' => ''
            ]
        @endphp
        <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


        @include('./components/cta-button')

        <!-- faq section  -->
        @php
            $faqs = [
                [
                    "question" => "1.	Why should I choose to study in Italy?",
                    "answer" => "Italy offers globally recognized universities, a high-quality education system, and rich cultural experiences. With strong industry connections, scholarships, and post-study career opportunities, it is an ideal destination for students planning to study in Italy from India."
                ],
                [
                    "question" => "2.	What are the eligibility criteria to study in Italy?",
                    "answer" => "Eligibility depends on the program and university. Generally, students need a valid high school or undergraduate degree, proof of English or Italian proficiency, and meeting the specific academic requirements of the chosen course."
                ],
                [
                    "question" => "3.	How can I apply for universities in Italy?",
                    "answer" => "To apply, research universities and programs, meet entry requirements, prepare documents like transcripts and SOP, check deadlines, receive the offer letter, and then apply for the study in Italy visa requirements."
                ],
                [
                    "question" => "4.	What scholarships are available for international students in Italy?",
                    "answer" => "Italian universities and government programs offer scholarships and financial aid. Students can also combine funding with a study in Italy on scholarship to cover tuition and living costs."
                ],
                [
                    "question" => "5.	How much does it cost to study in Italy?",
                    "answer" => "<p>Tuition fees vary by course and university:</p>
                    <ol>
                        <li>Undergraduate: €8,000 – €20,000 per year</li>
                        <li>Master’s: €10,000 – €25,000 per year</li>
                        <li>MBA: €18,000 – €35,000 per year</li>
                    </ol>
                    <p>Living expenses typically range from €7,000 – €12,000 annually.</p>
                    "
                ],
                [
                    "question" => "6.	What documents are required for studying in Italy?",
                    "answer" => "Students must provide academic transcripts, English/Italian proficiency test scores, letters of recommendation, statement of purpose, passport, financial proof or scholarship documents, and the university offer letter."
                ],
            ];
        @endphp
        <x-faq :faqs="$faqs" />

@endsection