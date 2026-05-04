@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Singapore - Experience World-Recognised Education and Opportunities</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Singapore consultancy in India, offering complete support for choosing the right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Singapore.</p>

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
                <p style="margin-top: 30px;">Study in Singapore and take the first step toward a globally recognized education. Singapore offers world-class universities, cutting-edge research facilities, and strong career opportunities for international students. With a focus on innovation, technology, and business, Singapore has become a preferred destination for students planning to study abroad Singapore. Its safe, English-speaking environment and multicultural society make it ideal for students looking to study in Singapore from India.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/singaporenew.webp" loading="lazy" alt="Study in singapore">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Singapore?';
        $sectionDescription = 'Singapore is a top destination for international students due to its high-quality education system, globally recognized universities, and strong industry connections. As a hub for finance, technology, and research in Asia, Singapore offers academic exposure along with excellent career prospects. For students planning to study in Singapore, the country provides a secure and supportive environment for learning and growth.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Singapore is home to globally recognized universities and institutes that emphasize research, innovation, and practical learning. Institutions focus on industry-relevant skills, critical thinking, and employability, preparing students for competitive global careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the main advantages of study abroad Singapore programs is their flexible academic structure. Students can choose specialized courses aligned with industry demands, gain practical experience through internships, and develop job-ready skills.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Singapore welcomes students from all over the world, offering a multicultural and inclusive campus experience. Studying in such a diverse environment helps students develop strong communication skills, global perspectives, and international networks.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Singapore is a global hub for finance, IT, biotechnology, and logistics. Universities maintain close ties with leading companies, offering internships, part-time work, and post-study employment opportunities, enhancing employability for students who study in Singapore from India.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Singaporean universities are renowned for their research and innovation, particularly in technology, healthcare, and business analytics. Students actively participate in research projects, gaining valuable academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Singapore offers numerous scholarships, grants, and financial aid for international students. Many students also use a study loan to manage tuition and living expenses effectively, helping reduce the overall study in Singapore cost.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Universities in Singapore provide comprehensive support services, including academic advising, career guidance, healthcare, and cultural integration programs, helping international students settle in and thrive academically and socially.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'National University of Singapore (NUS)',
                'logo' => 'images/universities/NUS.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Nanyang Technological University (NTU) ',
                'logo' => 'images/universities/ntu.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Singapore Management University (SMU)',
                'logo' => 'images/universities/smu.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Singapore University of Technology and Design (SUTD)',
                'logo' => 'images/universities/sutd.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Singapore Institute of Technology (SIT)',
                'logo' => 'images/universities/situni.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Singapore University of Social Sciences (SUSS)',
                'logo' => 'images/universities/suss.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Singapore',
            'highlight' => '',
            'sub_heading' => 'Singapore is home to some of the most prestigious universities in Asia, known for their academic excellence and research output.',
            'footer' => 'These universities attract thousands of international students each year and offer strong career support for study in Germany Indian students.'
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
            'title' => 'Popular Courses to Study in Singapore',
            'desc' => 'Singapore offers a wide range of high-demand academic programs recognized globally. Universities are especially strong in industry-focused and professional courses, making study abroad Singapore highly valuable for future careers.',
            'footer' => '',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => 'SGD 15,000 - 35,000'],
            ['label' => 'Master’s Degree', 'value' => 'SGD 20,000 - 40,000'],
            ['label' => 'MBA', 'value' => 'SGD 30,000 - 50,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'SGD 20,000 - 40,000'],
            ['label' => 'Diploma / Certificate', 'value' => 'SGD 10,000 - 20,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Singapore',
            'description' => 'The cost of studying in Singapore varies by university, program, and level of study. Scholarships or study loans can help manage expenses effectively.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => 'SGD 5,000 - 10,000', 'note' => 'Shared or campus housing reduces costs'],
            ['label' => 'Food', 'value' => 'SGD 2,500 - 4,000', 'note' => 'Home cooking is economical'],
            ['label' => 'Transportation', 'value' => 'SGD 600 - 1,200', 'note' => 'Student travel passes  available'],
            ['label' => 'Personal Expenses', 'value' => 'SGD 1,000 - 3,000', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => 'SGD 10,000 - 18,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Singapore for Indian Students',
            'description' => 'The cost of living in Singapore varies depending on the city and lifestyle. On average, students spend SGD 10,000 - 18,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the Singapore: What to Expect?',
            'desc' => 'Student life in Singapore is dynamic and multicultural. Universities offer clubs, societies, sports, and cultural activities. With safe cities, excellent academic support, and active international student offices, Singapore provides a balanced and enriching experience for students who study in Singapore.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Singapore?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
                'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
                'Check Application Deadlines: Varies by university and intake.',
                'Receive Offer Letter: Conditional or unconditional offer from the university.',
                'Confirm Admission and Apply for Visa: Accept the offer and complete the student visa process.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Singapore',
            'desc' => 'Students planning to study in Singapore from India must submit:',
            'list' => [
                'Academic Transcripts',
                'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof / Study Loan',
                'Offer Letter from an approved Instituition',
            ]
        ];

        $guideContent = [
            'title' => 'Singapore Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study visa is mandatory to study in Singapore. The process involves admission, arranging finances, applying online, and submitting documents:',
            'list' => [
                'Receive Offer Letter from Approved Institution: Must obtain an official offer from a recognized Singaporean university.',
                'Pay Tuition Fee Deposit: Confirm admission by paying the required tuition deposit.',
                'Arrange Financial Proof / Study Loan: Show sufficient funds to cover tuition and living costs.',
                'Complete Online Visa Application: Apply through the Singapore Student Pass (STP) system.',
                'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, transcripts, and SOP.',
                'Visa Decision and Travel to Singapore: After approval, travel to Singapore and register with immigration authorities.',
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
                "question" => "1.	Why should I choose to study in Singapore?",
                "answer" => "Singapore offers world-class education, top universities, and excellent career opportunities in a safe, English-speaking environment."
            ],
            [
                "question" => "2.	What are the popular courses to study in Singapore?",
                "answer" => "Engineering, Business, IT, Medicine, and Social Sciences are highly sought-after programs in Singapore."
            ],
            [
                "question" => "3.	How much does it cost to study in Singapore?",
                "answer" => "Tuition ranges from SGD 15,000-50,000 per year, with living expenses around SGD 10,000-18,000 annually."
            ],
            [
                "question" => "4.	Can I get a scholarship or financial assistance?",
                "answer" => "Yes, universities offer scholarships, grants, and students can use a study loan to manage costs."
            ],
            [
                "question" => "5.	What are the eligibility requirements to study in Singapore from India?",
                "answer" => "You need academic transcripts, English test scores, SOP, recommendation letters, passport, and financial proof."
            ],
            [
                "question" => "6.	How do I apply to study in Singapore?",
                "answer" => "Select a university, prepare documents, submit applications, receive the offer, and apply for a student visa."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection