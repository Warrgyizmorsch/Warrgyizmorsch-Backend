@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Czech Republic – A Gateway to Global Education and Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Czech Republic  consultancy in India, offering complete support for choosing the right course and
                university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                in Czech Republic.</p>

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
                <p style="margin-top:30px;">Study in Czech Republic and take the first step toward a globally recognized education. We guide students through university selection, visa procedures, scholarships, and test preparation. With a strong reputation for academic excellence, affordable tuition, and post-study career opportunities, Czechia has become a preferred destination for students planning to study in Czechia. International students benefit from a multicultural environment, world-class teaching, and strong industry connections across Europe.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/czechrepublicnew.webp" loading="lazy" alt="Study in australia">
            </div>
        </div>
    </section>


<!-- choose us section -->
@php
    $sectionTitle = 'Why Study in Czech Republic?';
    $sectionDescription = 'Czechia has emerged as a top destination for international students due to its high-quality education system, globally ranked universities, and vibrant cultural environment. Known for its historic cities, thriving industries, and welcoming people, the universities in Czech Republic for international students offer excellent academic exposure along with long-term career prospects. Students coming from India can expect a safe, English-friendly environment with strong opportunities to explore Europe during their studies.';

    $cards = [
        ['title' => '1. World-Class Education System ', 'desc' => 'Czech universities for international students are recognized worldwide for academic excellence. Institutions emphasize practical learning, critical thinking, and research, preparing students for competitive global careers. With affordable tuition and internationally recognized degrees, Czechia provides a solid foundation for professional growth.'],
        ['title' => '2. Flexible and Career-Oriented Programs ', 'desc' => 'A major advantage of study in Czech Republic programs is their flexibility. Students can choose specialized courses and interdisciplinary programs that align with industry needs, gaining practical experience through internships and research projects. This ensures students graduate with strong employable skills.'],
        ['title' => '3. Cultural Diversity and Global Exposure ', 'desc' => 'Czech Republic universities welcome students from across the world, offering a diverse and inclusive campus environment. Studying in such a multicultural setting helps students build international networks, enhance communication skills, and develop a global perspective.'],
        ['title' => '4. Career Opportunities and Industry Exposure ', 'desc' => 'Czechia is home to a growing economy with opportunities in IT, engineering, business, and healthcare. Czech universities for international students maintain strong links with companies, providing internships, part-time work, and post-study employment options that enhance career readiness.'],
        ['title' => '5. Research and Innovation ', 'desc' => 'Czech universities have a strong research culture, particularly in engineering, technology, medicine, and applied sciences. Students actively participate in research and development projects, gaining hands-on experience and building expertise for future careers.'],
        ['title' => '6. Scholarships and Financial Assistance ', 'desc' => 'Various universities in Czech Republic offer scholarships and financial aid for international students. Many students planning to study in Czechia also opt for financial planning tools to manage tuition and living expenses efficiently.'],
        ['title' => '7. International Student Support Services  ', 'desc' => 'Czech universities provide comprehensive support for international students, including academic advising, career guidance, healthcare access, and cultural integration programs. These services help students adapt easily and thrive both academically and socially.'],
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
                'name' => 'Charles University, Prague',
                'logo' => 'images/universities/Charles_logo.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Czech Technical University, Prague',
                'logo' => 'images/universities/Czech_logo.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Masaryk University, Brno',
                'logo' => 'images/universities/Masaryk_logo.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'University of Economics, Prague',
                'logo' => 'images/universities/Economics_logo.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Palacký University, Olomouc',
                'logo' => 'images/universities/Palacký_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'University of Chemistry and Technology, Prague',
                'logo' => 'images/universities/Chemistry_logo.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Brno University of Technology',
                'logo' => 'images/universities/Brno_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'University of West Bohemia, Plzeň',
                'logo' => 'images/universities/Bohemia_logo.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
        'heading' => 'Top Universities in Czech Republic',
        'highlight' => '',
        'sub_heading' => 'Czech Republic is home to prestigious universities known for academic excellence, research, and student support. The Czech Republic university list offers options for a variety of disciplines.',
        'footer' => 'These Czech universities for international students attract thousands of students from across the globe each year, providing strong career guidance and opportunities for international exposure.'
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
        'title' => 'Popular Courses to Study in Czech Republic',
        'desc' => 'Czechia offers a broad range of globally recognized programs across multiple disciplines. Programs are designed to prepare students for industry needs and career success.',
        'footer' => 'These courses attract students looking for quality education, research opportunities, and long-term career prospects.',
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
            ['label' => 'Undergraduate Degree', 'value' => '€3,000 – €12,000'],
            ['label' => 'Master’s Degree', 'value' => '€4,000 – €15,000'],
            ['label' => 'MBA', 'value' => '€8,000 – €20,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€4,000 – €12,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€2,500 – €8,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
        'heading' => 'Cost of Studying in Czech Republic',
        'description' => 'Education in Czechia is highly affordable compared to other European destinations. Tuition fees vary based on the university and program. Proper financial planning, scholarships, or student loans make studying abroad in Czechia manageable.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => '€2,500 – €6,000', 'note' => 'Shared accommodation reduces costs'],
                ['label' => 'Food', 'value' => '€1,500 – €2,500', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => '€400 – €800', 'note' => 'Student discounts available'],
                ['label' => 'Personal Expenses', 'value' => '€1,000 – €1,500', 'note' => 'Utilities, leisure, and clothing'],
                ['label' => 'Total', 'value' => '€6,000 – €10,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Czech Republic for International Students',
            'description' => 'Living costs depend on the city and lifestyle. On average, international students spend between €6,000 – €10,000 annually.',
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
        'title' => 'Student Life in Czech Republic: What to Expect?',
        'desc' => 'Student life in Czechia is rich, vibrant, and culturally immersive. Universities host clubs, sports, cultural events, and student organizations. With friendly locals, safe cities, and strong academic support, Czechia offers a balanced and rewarding student experience. International student offices provide assistance with academics, employment, and personal well-being, making it an ideal destination to study in Czech Republic and grow professionally.',
        'footer' => '',
        'guide_title' => 'How to Apply for Universities in Czech Republic?',
        'guide_steps' => [
            'Research and Select Universities: Choose courses aligned with your academic and career goals from the Czech Republic university list.',
            'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
            'Prepare Application Documents: Transcripts, Statement of Purpose, and letters of recommendation.',
            'Check Application Deadlines: Deadlines vary by university and intake.',
            'Receive Offer Letter: Obtain a conditional or unconditional admission offer.',
            'Confirm Admission and Apply for Visa: Accept the offer and start the student visa process.',
        ],
        'image' => 'images/whattoexpect.avif'
    ];
    @endphp
    <x-scholarship :scholarship="$scholarship"/>
 
    <!-- document section -->
    @php
    $documentContent = [
    'title' => 'Documents Required to Study in Czech Republic',
    'desc' => 'Students planning to study in Czech Republic must submit:',
    'list' => [
        'Academic Transcripts',
        'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
        'Letters of Recommendation',
        'Statement of Purpose',
        'Valid Passport',
        'Financial Proof / Student Loan Documents',
        'Offer Letter from an Approved Czech University',
        ]
    ];

    $guideContent = [
    'title' => 'Czech Republic Study Visa Process: Step-by-Step Guide',
    'desc' => 'A study visa is required to study in Czech Republic. The process includes securing admission, arranging funds, applying online, and submitting documents. Following these steps ensures a smooth visa process for students aiming to study in Czechia.',
    'list' => [
        'Receive Offer Letter from an Approved Institution: Obtain an official admission letter from a Czech university listed in the official Czech Republic university list.',
        'Pay Tuition Fee Deposit: Pay the required deposit to secure your admission.',
        'Arrange Financial Proof / Study Loan: Show sufficient funds or a student loan to cover tuition and living costs.',
        'Complete Online Visa Application: Apply for the Czech student visa through the official Czech visa portal.',
        'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, and academic documents at the nearest Czech Visa Application Centre.',
        'Visa Decision and Travel to Czechia: Once approved, travel to Czechia and register with local authorities after arrival.',
        ],
    'footer' => ''
    ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    <!-- faq section  -->
     @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Czech Republic?",
                "answer" => "Czechia offers high-quality education, affordable tuition, globally recognized degrees, and strong career opportunities. Its Czech universities for international students provide research-focused, industry-aligned programs in a multicultural environment."
            ],
            [
                "question" => "2.	What are the top universities in Czech Republic for international students?",
                "answer" => "<p>Some of the most popular universities in Czech Republic for international students include:</p>
                <ol>
                    <li>Charles University, Prague</li>
                    <li>Czech Technical University, Prague</li>
                    <li>Masaryk University, Brno</li>
                    <li>University of Economics, Prague</li>
                    <li>Palacký University, Olomouc</li>
                </ol>"
            ],
            [
                "question" => "3.	Can I study in Czech Republic from India?",
                "answer" => "Yes! Many Indian students choose to study in Czech Republic from India due to its affordable tuition, English-taught programs, and safe environment. You will need admission from a recognized university and a student visa to begin your studies."
            ],
            [
                "question" => "4.	What courses can I study in Czech Republic?",
                "answer" => "<p>Czech universities offer a wide range of programs, including:</p>
                <ol>
                    <li>Engineering</li>
                    <li>Business and Management</li>
                    <li>Computer Science / IT</li>
                    <li>Medicine and Health Sciences</li>
                    <li>Social Sciences and Humanities</li>
                </ol>"
            ],
            [
                "question" => "5.	How much does it cost to study in Czech Republic?",
                "answer" => "<p>Tuition fees vary depending on the university and program. On average:</p>
                <ol>
                    <li>Undergraduate: €3,000 – €12,000/year</li>
                    <li>Master’s: €4,000 – €15,000/year</li>
                    <li>MBA: €8,000 – €20,000/year</li>
                    <li>PhD: €4,000 – €12,000/year</li>
                </ol>"
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection