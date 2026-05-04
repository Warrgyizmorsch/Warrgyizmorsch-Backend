@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Netherlands - Open Doors to International Learning and Careers</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Netherlands consultancy in India, offering complete support for choosing the
                    right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Netherlands.</p>

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
                <p style="margin-top: 30px;">Study in the Netherlands and take the first step toward a globally recognized education. We guide students through university selection, visa processing, scholarships, and test preparation. With a strong reputation for academic excellence, innovation, and post-study career opportunities, the Netherlands has become a preferred destination for students planning to study abroad in the Netherlands. A smooth transition allows students to focus on building a successful academic and professional future in one of Europe’s most innovative education hubs.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/netherlandnew.webp" loading="lazy" alt="Study in Netherlands">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Netherlands?';
        $sectionDescription = 'The Netherlands is a top destination for international students due to its high-quality education system, globally ranked universities, and strong industry connections. Known for its international business environment and progressive education policies, the country offers excellent academic exposure along with long-term career prospects. Students looking to study in the Netherlands from India find a safe, welcoming, and English-friendly environment.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'The Netherlands is home to world-renowned universities that emphasize research, innovation, and practical learning. Dutch institutions focus on industry-relevant education, critical thinking, and skill development, preparing students for competitive global careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the biggest advantages of study in Netherlands programs is the flexible academic structure. Students can choose specialized programs aligned with industry needs, gaining job-ready skills and practical experience through internships and project-based learning.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'The Netherlands welcomes students from around the world, offering a multicultural and inclusive campus environment. Studying in such a diverse setting helps students develop global perspectives, strong communication skills, and international networks.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'The Netherlands is a global hub for technology, finance, logistics, and international trade. Universities maintain strong connections with leading companies, providing internships, part-time work, and post-study employment opportunities that enhance employability.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Dutch universities are known for cutting-edge research and innovation, particularly in technology, engineering, life sciences, and sustainable development. Students actively participate in research projects, gaining valuable academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'The Netherlands offers various scholarships and funding options for international students. Many students pursuing study abroad in the Netherlands also apply for financial aid to manage tuition and living expenses efficiently.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Universities provide comprehensive support, including academic advising, career guidance, healthcare access, and cultural integration programs. These services help students adapt smoothly to life in the Netherlands.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'University of Amsterdam',
                'logo' => 'images/universities/amsterdam.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Delft University of Technology',
                'logo' => 'images/universities/delftuni.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Erasmus University Rotterdam',
                'logo' => 'images/universities/erasmus.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Leiden University',
                'logo' => 'images/universities/leidenuni.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Utrecht University',
                'logo' => 'images/universities/utrecht.svg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Vrije Universiteit Amsterdam',
                'logo' => 'images/universities/univu.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Maastricht University',
                'logo' => 'images/universities/maastricht.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'University of Groningen',
                'logo' => 'images/universities/groningen.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Netherlands',
            'highlight' => '',
            'sub_heading' => 'The Netherlands hosts some of Europe’s most prestigious universities, known for academic excellence and research output:',
            'footer' => 'These institutions attract thousands of international students every year and offer strong career support.'
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
            'title' => 'Popular Courses to Study in Netherlands',
            'desc' => 'The Netherlands offers a wide range of high-demand programs recognized globally. Universities are known for their industry-focused curriculum and strong career outcomes.',
            'footer' => 'These programs are especially popular among students seeking quality education and long-term employment opportunities.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '€8,000 - €20,000'],
            ['label' => 'Master’s Degree', 'value' => '€10,000 - €25,000'],
            ['label' => 'MBA', 'value' => '€20,000 - €35,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€10,000 - €20,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€8,000 - €15,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Netherlands',
            'description' => 'The cost of studying in the Netherlands varies depending on the university, program, and level of study. Proper financial planning or scholarships can make education affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€4,000 - €8,000', 'note' => 'Shared accommodation reduces costs'],
            ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Home cooking is economical'],
            ['label' => 'Transportation', 'value' => '€600 - €1,000', 'note' => 'Student travel cards available'],
            ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Includes utilities and leisure'],
            ['label' => 'Total', 'value' => '€8,000 - €13,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Netherlands for Indian Students',
            'description' => 'Living costs vary depending on the city and lifestyle. On average, students spend between €8,000 - €13,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the Netherlands: What to Expect?',
            'desc' => 'Student life in the Netherlands is vibrant and multicultural. Universities offer clubs, societies, sports, and cultural events. Friendly cities, excellent academic support, and active international student offices create a balanced and enriching experience for students pursuing study in Netherlands programs.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Netherlands?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English proficiency are essential.',
                'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
                'Check Application Deadlines: Varies by university and intake.',
                'Receive Offer Letter: Conditional or unconditional offer from the university.',
                'Confirm Admission and Apply for Visa: Accept the offer and begin the student visa process.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Netherlands',
            'desc' => 'Students planning to study in the Netherlands from India must submit the following documents:',
            'list' => [
                'Academic Transcripts',
                'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof or Bank Statements',
                'Offer Letter from an Approved Institution',
            ]
        ];

        $guideContent = [
            'title' => 'Netherlands Study Visa Process: Step-by-Step Guide',
            'desc' => 'A student visa is required to study in the Netherlands. The process includes securing admission, arranging finances, applying online, and submitting documents:',
            'list' => [
                'Receive Offer Letter from an Approved Institution: Official acceptance from a recognized Dutch university.',
                'Pay Tuition Fee Deposit: Secure your place by paying the minimum tuition fee.',
                'Arrange Financial Proof: Demonstrate sufficient funds to cover tuition and living expenses.',
                'Complete Online Visa Application: Apply through the Netherlands Immigration and Naturalisation Service (IND).',
                'Submit Documents and Biometrics: Provide passport, offer letter, financial proof, academic records, and SOP.',
                'Visa Decision and Travel to the Netherlands: Upon approval, travel and register with local authorities.',
            ],
            'footer' => 'Following these steps helps students study abroad in the Netherlands smoothly and focus on their academic journey.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should I study in the Netherlands?",
                "answer" => "The Netherlands offers world-class education, innovative teaching methods, and excellent career opportunities. With globally ranked universities and a strong international environment, study in the Netherlands is a popular choice for international students."
            ],
            [
                "question" => "2.	What are the top universities in the Netherlands for international students?",
                "answer" => "Some of the best Netherlands universities for international students include the University of Amsterdam, Delft University of Technology, Leiden University, Utrecht University, Erasmus University Rotterdam, and Wageningen University."
            ],
            [
                "question" => "3.	Can I study in the Netherlands in English?",
                "answer" => "Yes. The Netherlands is one of the largest providers of English-taught programs in Europe. Most Bachelor’s and Master’s courses are available in English, making it easy for international students to study comfortably."
            ],
            [
                "question" => "4.	What are the most popular courses in the Netherlands?",
                "answer" => "Popular programs include Engineering, Business & Management, Data Science, Artificial Intelligence, Logistics, Finance, Environmental Science, and Social Sciences."
            ],
            [
                "question" => "5.	Are there scholarships available in the Netherlands?",
                "answer" => "Yes. International students can apply for several scholarships such as the Holland Scholarship, Orange Knowledge Programme, and university-specific funding options."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection