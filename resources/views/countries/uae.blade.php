@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in UAE - Build a Successful Global Career Through Education</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in UAE consultancy in India, offering complete support for choosing the right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in UAE.</p>

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
                <p style="margin-top: 30px;">Study in the UAE and take the first step toward a globally recognized education. The UAE offers a mix of world-class universities, advanced infrastructure, and industry-oriented programs that make it an attractive destination for students seeking international exposure. With diverse academic options and strong career prospects, students planning to study abroad UAE can benefit from innovative teaching methods, multicultural environments, and professional opportunities. A well-planned approach ensures a smooth transition so students can focus on achieving academic and professional success in one of the fastest-growing education hubs in the Middle East.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/uaenew.webp" loading="lazy" alt="Study in uae">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in UAE?';
        $sectionDescription = 'The UAE has emerged as a popular destination for international students due to its high-quality education system, globally recognized universities, and close connections with industry leaders. Known for its thriving business, technology, and tourism sectors, the UAE offers excellent academic exposure along with long-term career prospects. For students planning to study in UAE from India, the country provides a safe, modern, and English-speaking environment, making it ideal for international education.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'The UAE is home to universities with global accreditation and a focus on practical learning, research, and innovation. Institutions emphasize industry-aligned education, skill development, and critical thinking, preparing students for competitive global careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the biggest advantages of study abroad UAE programs is their flexibility. Students can select specialized programs aligned with industry requirements, gain practical skills through internships and project-based learning, and acquire experiences that make them job-ready.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'The UAE welcomes students from around the world, offering a multicultural and inclusive learning environment. Studying in this diverse setting develops global perspectives, enhances communication skills, and creates valuable international networks.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'With global companies in sectors like IT, finance, logistics, tourism, and healthcare, the UAE provides excellent career opportunities. Universities collaborate with industries to offer internships, part-time work, and post-study employment options, boosting employability for students planning to study in the UAE from India.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Universities in the UAE focus on research and innovation, particularly in technology, healthcare, engineering, and business management. Students actively participate in projects, gaining both academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Various universities in the UAE offer scholarships, grants, and financial assistance to international students. These options make study in UAE more affordable for students coming from India or other countries.'],
            ['title' => '7. International Student Support Services', 'desc' => 'UAE universities provide comprehensive support, including academic advising, career guidance, health services, and cultural integration programs, ensuring students adapt smoothly to life in the UAE.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'Khalifa University',
                'logo' => 'images/universities/khalifauni.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'United Arab Emirates University (UAEU)',
                'logo' => 'images/universities/uaeu.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'American University of Sharjah (AUS)',
                'logo' => 'images/universities/aus.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'American University in Dubai (AUD)',
                'logo' => 'images/universities/auduni.jpg',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'University of Sharjah',
                'logo' => 'images/universities/sharjah.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Zayed University',
                'logo' => 'images/universities/zayeduni.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Higher Colleges of Technology (HCT)',
                'logo' => 'images/universities/hctuni.jpg',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in UAE',
            'highlight' => '',
            'sub_heading' => 'The UAE hosts several prestigious universities that are known for academic excellence and strong industry ties:',
            'footer' => 'These universities draw thousands of international students each year and provide robust career support.'
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
        ];
        $courseContent = [
            'title' => 'Popular Courses to Study in UAE',
            'desc' => 'The UAE offers a wide range of high-demand programs recognized globally. Universities are known for their industry-focused curriculum and strong employability outcomes.',
            'footer' => 'These programs attract students aiming for quality education and strong career prospects.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '$8,000 - $20,000'],
            ['label' => 'Master’s Degree', 'value' => '$12,000 - $25,000'],
            ['label' => 'MBA', 'value' => '$20,000 - $35,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$10,000 - $22,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$6,000 - $15,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in UAE',
            'description' => 'The cost of education in the UAE varies based on university, program, and level of study. Scholarships and careful financial planning can make study abroad UAE programs more affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '$4,000 – $8,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => '$2,000 – $3,500', 'note' => 'Home cooked meals save money'],
            ['label' => 'Transportation', 'value' => '$500 – $1,200', 'note' => 'Public transport and student discounts available'],
            ['label' => 'Personal Expenses', 'value' => '$1,000 – $2,000', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => '$8,000 - $15,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in UAE for Indian Students',
            'description' => 'The cost of living in the UAE depends on the city and lifestyle. On average, students spend $8,000 - $15,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the UAE: What to Expect?',
            'desc' => 'Student life in the UAE is vibrant and multicultural. Universities offer clubs, sports, cultural events, and student societies. Safe cities, modern facilities, and comprehensive support services make the UAE an ideal destination to study abroad and gain global exposure.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in UAE?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with your academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English proficiency (IELTS / TOEFL) are essential.',
                'Prepare Application Documents: Transcripts, SOP and recommendation letters.',
                'Check Application Deadlines: Vary by institution and intake.',
                'Receive Offer Letter: Conditional or unconditional offer from the University.',
                'Confirm Admission and Apply for Visa: Accept the offer and start the visa application process.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in UAE',
            'desc' => 'Students planning to study in UAE from India must submit:',
            'list' => [
                'Academic Transcripts',
                'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof (Bank Statements or Scholarships)',
                'Offer Letter from an Approved Instituition',
            ]
        ];

        $guideContent = [
            'title' => 'UAE Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study visa is essential for students planning to study in the UAE. The process includes admission, financial proof, application submission, and document verification.',
            'list' => [
                'Receive Offer Letter from an Approved Institution: Obtain an official offer letter from a recognized UAE university.',
                'Pay Tuition Fee Deposit: Secure admission by paying the required deposit.',
                'Arrange Financial Proof: Demonstrate funds to cover tuition and living costs.',
                'Complete Online Visa Application: Apply through the official UAE student visa portal.',
                'Submit Documents and Biometrics: Provide all required documents at the visa centre.',
                'Visa Decision and Travel to UAE: After approval, travel to UAE and register with local authorities.',
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
                "question" => "1.	Why should I choose to study in the UAE?",
                "answer" => "The UAE offers world-class universities, industry-oriented programs, multicultural campuses, and excellent career opportunities. Students planning to study in the UAE from India benefit from English-taught courses and a safe, modern environment."
            ],
            [
                "question" => "2.	Which courses are popular for international students in the UAE?",
                "answer" => "Popular programs include Engineering, Business and Management, Computer Science / IT, Medicine, Health Sciences, and Social Sciences. These programs provide global recognition and strong career prospects for students planning to study abroad in the UAE."
            ],
            [
                "question" => "3.	What are the top universities in UAE for international students?",
                "answer" => "Some of the top universities include Khalifa University, UAE University (UAEU), American University of Sharjah (AUS), American University in Dubai (AUD), University of Sharjah, Zayed University, Higher Colleges of Technology (HCT), and University of Dubai."
            ],
            [
                "question" => "4.	How much does it cost to study in the UAE?",
                "answer" => "Tuition fees vary by program and university. On average:
                <ol>
                    <li>Undergraduate: $8,000 - $20,000/year</li>
                    <li>Master’s: $12,000 - $25,000/year</li>
                    <li>MBA: $20,000 - $35,000/year</li>
                    <li>PhD: $10,000 - $22,000/year</li>
                </ol>
                <p>Scholarships and financial planning can help manage costs.</p>"
            ],
            [
                "question" => "5.	What is the living cost for international students in UAE?",
                "answer" => "Living expenses range from $8,000 - $15,000 per year, covering housing, food, transportation, and personal expenses. Costs are higher in cities like Dubai and Abu Dhabi."
            ],
            [
                "question" => "6.	What documents are required to apply for universities in the UAE?",
                "answer" => "<p> Students planning to study in UAE from India need:</p>
                <ol>
                    <li>Academic transcripts</li>
                    <li>English proficiency scores (IELTS / TOEFL / PTE)</li>
                    <li>Letters of recommendation</li>
                    <li>Statement of Purpose</li>
                    <li>Valid passport</li>
                    <li>Financial proof or scholarships</li>
                    <li>Offer letter from an approved institution</li>
                </ol>"
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection