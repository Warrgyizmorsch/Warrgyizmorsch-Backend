@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Germany - Your Pathway to International Education Excellence</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Germany consultancy in India, offering complete support for choosing the right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Germany.</p>

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
                <p style="margin-top: 30px;">Study in Germany and take the first step toward a globally recognized education. Germany is known for its world-class universities, cutting-edge research, and strong industry connections. We guide students through university selection, visa processing, scholarships, and test preparation. With high-quality education, innovation, and excellent post-study career opportunities, Germany has become a preferred destination for students planning to study abroad in Germany. International students can focus on building a successful academic and professional future in one of Europe’s most dynamic educational hubs.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/germanynew.webp" loading="lazy" alt="Study in germany">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Germany?';
        $sectionDescription = 'Germany is a top destination for international students due to its high-quality education system, globally ranked universities, and strong ties to industry. Known for engineering, technology, and business excellence, Germany provides long-term career prospects for students. For those planning to study in Germany from India, the country offers a safe, welcoming, and English-friendly environment along with affordable education.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Germany is home to some of the world’s leading universities, emphasizing research, innovation, and practical learning. German institutions focus on industry-relevant education, critical thinking, and skill development, preparing students for competitive global careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the key benefits of study in Germany is its flexible academic structure. Students can choose specialized programs aligned with industry needs, gaining practical exposure through internships, research projects, and work placements.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Germany welcomes students from across the world, offering a multicultural and inclusive campus environment. Studying in such a diverse setting helps students develop global perspectives, strong communication skills, and international networks.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Germany is a hub for engineering, IT, automotive, pharmaceuticals, and finance. Universities maintain strong industry connections, providing internships, part-time work, and post-study employment opportunities, enhancing employability for study in Germany for Indian students.'],
            ['title' => '5. Research and Innovation', 'desc' => 'German universities are known for cutting-edge research and innovation in technology, engineering, healthcare, and environmental sciences. Students actively participate in research projects, gaining valuable academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Germany offers numerous scholarships and funding options for international students. Many students use scholarships or apply for a study loan in Germany to manage tuition and living expenses effectively.'],
            ['title' => '7. International Student Support Services', 'desc' => 'German institutions provide comprehensive support services, including academic advising, career guidance, healthcare access, and cultural integration programs, helping students adapt smoothly to life in Germany.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'Technical University of Munich (TUM)',
                'logo' => 'images/universities/tum.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Ludwig Maximilian University of Munich (LMU) ',
                'logo' => 'images/universities/lmu.jpg',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Heidelberg University',
                'logo' => 'images/universities/heidelberg.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'RWTH Aachen University',
                'logo' => 'images/universities/rwth.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'University of Freiburg',
                'logo' => 'images/universities/freiburg.svg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Humboldt University of Berlin',
                'logo' => 'images/universities/humboldt.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Free University of Berlin',
                'logo' => 'images/universities/freeuniberlin.png',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
            [
                'name' => 'University of Stuttgart',
                'logo' => 'images/universities/stuttgart.png',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Germany',
            'highlight' => '',
            'sub_heading' => 'Germany is home to some of the most prestigious universities in Europe, known for academic excellence and research output.',
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
            'title' => 'Popular Courses to Study in Germany',
            'desc' => 'Germany offers a wide range of high-demand academic programs recognized globally. Universities are known for their practical, industry-focused curriculum and strong career outcomes.',
            'footer' => 'These programs are especially popular among students seeking quality education and long-term employment opportunities.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '€0 - €3,500 (mostly public universities)'],
            ['label' => 'Master’s Degree', 'value' => '€0 - €4,000'],
            ['label' => 'MBA', 'value' => '€15,000 - €35,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€0 - €3,500'],
            ['label' => 'Diploma / Certificate', 'value' => '€5,000 - €10,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Germany',
            'description' => 'The cost of studying in Germany varies depending on the university, course, and level of study. Proper financial planning, scholarships, or a study loan Germany can make education affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€3,000 - €7,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Home cooking is economical'],
            ['label' => 'Transportation', 'value' => '€600 - €1,000', 'note' => 'Student travel cards available'],
            ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => '€8,000 - €12,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Germany for Indian Students',
            'description' => 'Living expenses depend on the city and lifestyle. On average, students spend between €8,000 - €12,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the Germany: What to Expect?',
            'desc' => 'Student life in Germany is lively and culturally rich. Universities offer clubs, sports, cultural events, and societies for international students. With safe cities, friendly locals, and strong academic support, Germany provides a balanced and enriching student experience. International student offices assist with academics, career guidance, and personal well-being, making it a top choice to study abroad in Germany.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Germany?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English or German language proficiency are required.',
                'Prepare Application Documents: Transcripts, SOP, recommendation letters.',
                'Check Application Deadlines: Vary by institution and intake.',
                'Receive Offer Letter: Conditional or unconditional offer from the University.',
                'Confirm Admission and Apply for Visa: Accept the offer and start your study in Germany visa process.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Germany',
            'desc' => 'Students planning to study in Germany from India must submit the following documents:',
            'list' => [
                'Academic Transcripts',
                'English / German Proficiency Test Scores (IELTS / TOEFL / TestDaF)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof or Study Loan Germany documents',
                'Offer Letter from an approved Instituition',
            ]
        ];

        $guideContent = [
            'title' => 'Germany Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study in Germany visa is required for international students. The process involves admission, financial preparation, online application, and document submission.',
            'list' => [
                'Receive Offer Letter from an Approved Institution: Students must obtain an official offer letter from a recognized German university.',
                'Pay Tuition Fee Deposit: Pay the minimum deposit mentioned in the admission letter.',
                'Arrange Financial Proof / Study Loan Germany: Show sufficient funds to cover tuition and living expenses.',
                'Complete Online Visa Application: Apply through the German embassy or consulate portal.',
                'Submit Documents and Biometrics: Submit passport, offer letter, financial proof, academic records, and SOP.',
                'Visa Decision and Travel to Germany: After approval, travel to Germany and register with local authorities.',
            ],
            'footer' => 'This process helps students study in Germany from India efficiently and focus on their academic goals.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should Indian students study in Germany?",
                "answer" => "Germany offers high-quality education, globally recognised degrees, affordable tuition fees, and strong career opportunities. This makes study in Germany for Indian students an excellent choice for long-term academic and professional growth."
            ],
            [
                "question" => "2.	Is Germany affordable for international students?",
                "answer" => "Yes, studying in Germany cost is comparatively low. Most public universities charge little or no tuition fees, and students mainly need to cover living expenses."
            ],
            [
                "question" => "3.	Can I study in Germany from India without knowing German?",
                "answer" => "Yes, many universities offer English-taught programs, especially at the master’s level. However, learning basic German can help with daily life and part-time work."
            ],
            [
                "question" => "4.	What is the cost of living for students in Germany?",
                "answer" => "The average living cost ranges between €8,000 - €12,000 per year, depending on the city and lifestyle. This includes accommodation, food, transport, and personal expenses."
            ],
            [
                "question" => "5.	Do I need a study loan to study in Germany?",
                "answer" => "A study loan Germany is not mandatory but can be helpful to cover living expenses and blocked account requirements if personal savings are insufficient."
            ],
            [
                "question" => "6.	What are the top courses to study in Germany?",
                "answer" => "Popular courses include Engineering, Computer Science, Business and Management, Data Science, and Health Sciences. These programs offer strong job prospects after graduation."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection