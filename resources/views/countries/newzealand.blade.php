@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in New Zealand - Empower Your Future with International Education</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in New Zealand consultancy in India, offering complete support for choosing the right course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                    in New Zealand.</p>

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
                    <p style="margin-top: 30px;">Study in New Zealand and take the first step toward a globally recognised education system known for quality, innovation, and student safety. New Zealand offers internationally accredited degrees, practical learning, and strong post-study work opportunities. With its world-class universities, research-driven curriculum, and welcoming environment, New Zealand has become a preferred destination for students planning to study abroad. The country provides an ideal balance of academic excellence and lifestyle, helping students build a successful academic and professional future.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/newzealandnew.webp" loading="lazy" alt="Study in new-zealand">
                </div>
            </div>
        </section>


    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in New Zealand?';
        $sectionDescription = 'New Zealand is a top choice for international students due to its high-quality education system, globally ranked universities, and strong focus on practical learning. Degrees from New Zealand are recognised worldwide, and the country is known for its safe environment and excellent quality of life. For students planning to study in New Zealand from India, it offers an English-speaking, student-friendly atmosphere with strong career prospects.';

        $cards = [
            [
                'title' => '1. World-Class Education System',
                'desc' => 'New Zealand universities consistently rank among the best globally and are regulated by strict government quality standards. Institutions focus on research, innovation, and hands-on learning, ensuring students gain industry-relevant skills and global exposure.'
            ],
            [
                'title' => '2. Flexible and Career-Oriented Programs',
                'desc' => 'One of the major benefits of studying in New Zealand is its flexible education system. Programs are designed to align with industry needs and include practical projects, internships, and real-world learning, helping students become job-ready after graduation.'
            ],
            [
                'title' => '3. Cultural Diversity and Global Exposure',
                'desc' => 'New Zealand is home to students from all over the world, creating a multicultural and inclusive campus environment. Studying in such a setting helps students develop global perspectives, communication skills, and international networks.'
            ],
            [
                'title' => '4. Career Opportunities and Industry Exposure',
                'desc' => 'New Zealand offers excellent part-time work options during studies and post-study work visas after graduation. Universities maintain strong links with industries, allowing students to gain practical experience that enhances employability in both local and global markets.'
            ],
            [
                'title' => '5. Research and Innovation',
                'desc' => 'New Zealand is well known for research excellence in areas such as environmental science, agriculture, engineering, healthcare, and information technology. Students actively participate in research projects, gaining valuable academic and professional exposure.'
            ],
            [
                'title' => '6. Scholarships and Financial Assistance',
                'desc' => 'Various scholarships are available for international students planning to study in New Zealand. Along with scholarships, students can plan finances effectively by understanding the cost of study in New Zealand and arranging education loans or funding support if required.'
            ],
            [
                'title' => '7. International Student Support Services',
                'desc' => 'New Zealand institutions provide strong student support services, including academic guidance, career counselling, health services, and cultural integration programs, ensuring international students adapt smoothly to life in the country.'
            ],
        ];
    @endphp

    <x-choose-us 
        :section-title="$sectionTitle" 
        :section-description="$sectionDescription" 
        :cards="$cards" 
    />

    @include('./components/stats')

       <!-- Top-Ranked Universities in New Zealand for Global Students -->
    @php
        $universities = [
            [
                'name' => 'University of Auckland',
                'logo' => 'images/universities/auckland.webp',
                'course' => 'Engineering, Medicine, Business, Arts',
                'ranking' => 1
            ],
            [
                'name' => 'University of Otago',
                'logo' => 'images/universities/otago.webp',
                'course' => 'Health Sciences, Humanities, Science',
                'ranking' => 2
            ],
            [
                'name' => 'Victoria University of Wellington',
                'logo' => 'images/universities/victoria.webp',
                'course' => 'Law, Humanities, Science',
                'ranking' => 3
            ],
            [
                'name' => 'University of Canterbury',
                'logo' => 'images/universities/canterbury.webp',
                'course' => 'Engineering, Forestry, Education',
                'ranking' => 4
            ],
            [
                'name' => 'Massey University',
                'logo' => 'images/universities/massey.webp',
                'course' => 'Aviation, Agriculture, Design',
                'ranking' => 5
            ],
            [
                'name' => 'Auckland University of Technology (AUT)',
                'logo' => 'images/universities/aut.webp',
                'course' => 'IT, Hospitality, Health Science',
                'ranking' => 6
            ],
            [
                'name' => 'University of Waikato',
                'logo' => 'images/universities/waikato.webp',
                'course' => 'Management, Education, Science',
                'ranking' => 8
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in New Zealand',
            'highlight' => '',
            'sub_heading' => 'New Zealand is home to prestigious universities known for academic excellence and research output.',
            'footer' => 'These universities attract international students every year and offer strong academic and career support.'
        ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection" />

      <!-- New Zealand course section -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science / Information Technology', 'image' => 'images/courses/it.png'],
            ['title' => 'Medicine and Health Sciences', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/environment.jpg'],
        ];

        $courseContent = [
            'title' => 'Popular Courses to Study in New Zealand',
            'desc' => 'New Zealand offers a wide range of globally recognised programs with strong career outcomes. Universities focus on practical learning and industry relevance.',
            'footer' => 'These courses are highly popular among students seeking quality education and long-term career growth.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />



        <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => 'NZD 20,000 - NZD 35,000'],
            ['label' => 'Master’s Degree', 'value' => 'NZD 22,000 - NZD 40,000'],
            ['label' => 'MBA', 'value' => 'NZD 30,000 - NZD 45,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'NZD 6,500 - NZD 9,000'],
            ['label' => 'Diploma / Certificate', 'value' => 'NZD 15,000 - NZD 25,000'],
        ];

        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in New Zealand',
            'description' => 'The cost of study in New Zealand depends on the university, course, and level of study. Compared to many other English-speaking countries, New Zealand offers good value for high-quality education.',
        ];
        $livingFees = [
                ['label' => 'Housing', 'value' => 'NZD 7,000 - 12,000', 'note' => 'Shared accommodation reduces cost'],
                ['label' => 'Food', 'value' => 'NZD 3,000 - 4,500', 'note' => 'Cooking at home is economical'],
                ['label' => 'Transportation', 'value' => 'NZD 1,000 - 1,500', 'note' => 'Student travel discounts available'],
                ['label' => 'Personal Expenses', 'value' => 'NZD 2,000 - 3,000', 'note' => 'Includes utilities and leisure'],
                ['label' => 'Total', 'value' => 'NZD 15,000 - 20,000', 'note' => 'Costs vary by city'],
            ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in New Zealand for Indian Students',
            'description' => 'Living expenses in New Zealand vary depending on the city and lifestyle. On average, students spend NZD 15,000 - 20,000 per year on living costs.',
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
            'title' => 'Student Life in New Zealand: What to Expect?',
            'desc' => 'Student life in New Zealand is safe, vibrant, and well-balanced. Universities offer clubs, sports, cultural activities, and student societies that encourage personal growth and social interaction. With friendly locals, excellent academic support, and a high quality of life, New Zealand provides an enriching environment for international students to study, work, and grow.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in New Zealand?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English language proficiency are required.',
                'Prepare Application Documents: Academic transcripts, SOP, and recommendation letters.',
                'Check Application Deadlines: Vary by institution and intake.',
                'Receive Offer Letter: Conditional or unconditional offer from the university.',
                'Confirm Admission and Apply for Visa: Accept the offer and begin the visa application process.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp

    <x-scholarship :scholarship="$scholarship"/>


    @php
    $documentContent = [
        'title' => 'Documents Required to Study in New Zealand',
        'desc' => 'Students planning to study in New Zealand must submit the following documents:',
        'list' => [
            'Academic Transcripts',
            'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
            'Letters of Recommendation',
            'Statement of Purpose',
            'Valid Passport',
            'Financial Proof',
            'Offer Letter from an Approved Institution',
        ]
    ];

    $guideContent = [
        'title' => 'New Zealand Study Visa Process: Step-by-Step Guide',
        'desc' => 'A study visa is mandatory to study in New Zealand. Understanding the study visa New Zealand requirements helps students avoid delays and ensures a smooth application process.',
        'list' => [
            'Receive Offer Letter from an Approved Institution: Secure an offer letter from a New Zealand education provider approved by Immigration New Zealand.',
            'Arrange Financial Proof: Show sufficient funds to cover tuition fees and living expenses as per study visa New Zealand requirements.',
            'Complete Online Visa Application: Apply online through Immigration New Zealand’s official portal.',
            'Submit Documents and Medical Checks: Submit academic documents, financial proof, medical certificates, and police clearance if required.',
            'Visa Approval and Travel: After approval, students can travel to New Zealand and begin their academic journey.'
        ],
        'footer' => 'This structured process helps students planning to study in New Zealand from India prepare confidently.'
    ];
    @endphp

    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    @include('./components/cta-button')

    @php
        $faqs = [
            [
                'question' => '1. Why should international students choose to study in New Zealand?',
                'answer' => 'New Zealand offers globally recognised education, high academic standards, practical learning, and a safe environment. Students who study in New Zealand benefit from quality teaching, research-focused universities, and excellent post-study work opportunities.'
            ],
            [
                'question' => '2. What are the basic study visa New Zealand requirements?',
                'answer' => 'The key study visa New Zealand requirements include an offer letter from an approved institution, proof of funds, a valid passport, English language proficiency, medical and police clearance (if required), and payment of tuition fees.'
            ],
            [
                'question' => '3. How much does it cost to study in New Zealand?',
                'answer' => 'The cost of study in New Zealand varies by course and institution. On average, undergraduate programs cost NZD 20,000 - 35,000 per year, while postgraduate programs range between NZD 22,000 - 40,000 annually.'
            ],
            [
                'question' => '4. Can Indian students work while studying in New Zealand?',
                'answer' => 'Yes, students studying in New Zealand can work up to 20 hours per week during semesters and full-time during scheduled holidays, helping them manage living expenses and gain work experience.'
            ],
            [
                'question' => '5. What are the popular courses to study in New Zealand?',
                'answer' => 'Popular courses include Engineering, Business and Management, Computer Science, Information Technology, Healthcare, Environmental Science, and Social Sciences due to strong career demand.'
            ],
            [
                'question' => '6. Is New Zealand safe for international students?',
                'answer' => 'Yes, New Zealand is considered one of the safest countries in the world. It offers a welcoming and student-friendly environment, making it an excellent choice for students planning to study abroad.'
            ],
        ];
    @endphp

    <x-faq :faqs="$faqs" />

@endsection