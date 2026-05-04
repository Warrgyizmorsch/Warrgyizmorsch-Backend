@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Sweden - Your Pathway to Global Education and
                Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Sweden  consultancy in India, offering complete support for choosing the
                    right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Sweden .</p>

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
                <p style="margin-top: 30px;">Study in Sweden for international students and take a step toward globally 
                    respected education and innovation-driven careers.
                    Sweden is known for its progressive teaching methods, sustainability-focused education, 
                    and strong links between universities and industries. With world-ranked institutions, English-taught programs,
                    and excellent post-study opportunities, Sweden has become a top choice for students planning to study in Sweden.
                    The country offers a supportive academic environment where students can grow academically and professionally in one of Europe’s most advanced education systems.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/swedennew.webp" loading="lazy" alt="Study in sweden">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Sweden?';
        $sectionDescription = 'Sweden is one of the most innovative and student-friendly countries in the world. It offers high academic standards, modern learning methods, and strong global recognition. Home to some of the best Sweden universities for international students, the country provides an inclusive, safe, and English-speaking environment ideal for global learners.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Sweden universities are globally respected for academic excellence, research quality, and innovation. Swedish education emphasizes critical thinking, teamwork, and real-world problem-solving, preparing students for glo	bal careers across industries.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'Swedish universities offer flexible, student-centered learning with a strong focus on independent study, group projects, and industry collaboration. Programs are designed to match global job market needs, making study in Sweden for international students highly career-oriented.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Sweden welcomes students from all over the world, creating a multicultural campus environment. This diversity helps students build global perspectives, cultural understanding, and international networks valuable for future careers.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Sweden is home to global companies such as IKEA, Volvo, Ericsson, Spotify, and H&M. Universities maintain close ties with industries, offering internships, research projects, and career opportunities that enhance employability after graduation.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Sweden is one of the world’s leading countries in research and innovation. Universities focus on sustainability, technology, healthcare, and environmental sciences. Students actively participate in research-based learning, gaining hands-on academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'International students can benefit from various funding options, including the prestigious Swedish Institute Scholarship. Many universities also offer Sweden scholarship programs to support tuition fees and living costs, making education more accessible.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Swedish institutions provide strong student support services, including academic guidance, career counselling, healthcare access, and integration programs. These services help international students settle smoothly into Swedish academic and social life.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'Lund University',
                'logo' => 'images/universities/lund.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Uppsala University',
                'logo' => 'images/universities/uppsala.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'KTH Royal Institute of Technology',
                'logo' => 'images/universities/kth.svg',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Stockholm University',
                'logo' => 'images/universities/stockholm.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Chalmers University of Technology',
                'logo' => 'images/universities/chalmers.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Gothenburg',
                'logo' => 'images/universities/gothenburg.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
             [
                'name' => 'Linköping University',
                'logo' => 'images/universities/linkoping.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Sweden',
            'highlight' => '',
            'sub_heading' => 'Sweden is home to several globally ranked institutions known for academic excellence, research, and innovation.',
            'footer' => 'These Sweden universities for international students attract thousands of global learners every year.
'
        ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection" />

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Data Science and Artificial Intelligence', 'image' => 'images/courses/ai.jpg'],
            ['title' => 'Environmental Science and Sustainability', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
            'title' => 'Popular Courses to Study in Sweden',
            'desc' => 'Sweden offers globally recognized programs with strong academic and career outcomes. Courses are designed with innovation and sustainability at their core.',
            'footer' => 'These programs are highly popular among students planning to study in Sweden for international students due to strong employment prospects.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '€8,000 - €15,000'],
            ['label' => 'Master’s Degree', 'value' => '€9,000 - €18,000'],
            ['label' => 'MBA', 'value' => '€15,000 - €30,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => 'Mostly funded'],
            ['label' => 'Diploma / Certificate', 'value' => '€5,000 - €10,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Sweden',
            'description' => 'The cost of studying in Sweden depends on the university and program. While tuition fees apply to non-EU students, scholarships such as the Swedish Institute Scholarship help reduce financial burden.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€3,500 - €6,000', 'note' => 'Student housing and shared flats'],
            ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Cooking at home reduces costs'],
            ['label' => 'Transportation', 'value' => '€600 - €1,000', 'note' => 'Student discounts available'],
            ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => '€8,000 - €12,000', 'note' => 'Depends on city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Sweden for International Students',
            'description' => 'Living costs in Sweden vary by city and lifestyle. On average, students spend between €8,000 – €12,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in Sweden: What to Expect?',
            'desc' => 'Student life in Sweden is modern, balanced, and enriching. Universities offer student unions, clubs, cultural activities, and innovation hubs. With a strong focus on work-life balance, sustainability, and equality, Sweden provides a safe and welcoming environment for international students to study, grow, and succeed.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Sweden?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
                'Apply via University Admissions Portal: Sweden uses a centralized application system.',
                'Submit Required Documents: Transcripts, SOP, and certificates.',
                'Receive Admission Offer: Conditional or unconditional offer from the university.',
                'Apply for Residence Permit: After accepting the offer, apply for a student residence permit.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Sweden',
            'desc' => 'Students planning to study in Sweden must submit the following documents:',
            'list' => [
                'Academic Transcripts and Certificates',
                'English Proficiency Test Scores (IELTS / TOEFL)',
                'Statement of Purpose',
                'Letters of Recommendation (if required)',
                'Valid Passport',
                'Proof of Funds',
                'Admission Offer Letter',
            ]
        ];

        $guideContent = [
            'title' => 'Sweden Study Visa Process: Step-by-Step Guide',
            'desc' => 'A residence permit is required to study in Sweden for international students. The process includes admission confirmation, financial proof, and online application.',
            'list' => [
                'Receive Admission Offer from a Swedish University',
                'Pay Tuition Fee (if applicable)',
                'Arrange Financial Proof or Scholarship',
                'Apply Online for Residence Permit',
                'Submit Biometrics and Documents',
                'Receive Decision and Travel to Sweden',
            ],
            'footer' => 'Understanding these steps helps students avoid delays and ensures a smooth transition to Sweden.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Sweden?",
                "answer" => "Sweden offers world-class education, innovative teaching methods, and strong career opportunities. With multicultural campuses and globally recognized degrees, study in Sweden provides excellent academic and professional growth."
            ],
            [
                "question" => "2.	What are the top universities in Sweden for international students?",
                "answer" => "Some of the best Sweden universities for international students include Lund University, Uppsala University, KTH Royal Institute of Technology, Stockholm University, and Chalmers University of Technology."
            ],
            [
                "question" => "3.	What courses are popular in Sweden?",
                "answer" => "Popular programs include Engineering, Business and Management, Computer Science/IT, Environmental Science, Data Science, Medicine, and Social Sciences. These courses are highly suited for students planning to study in Sweden for international students."
            ],
            [
                "question" => "4.	Is there a scholarship available for international students in Sweden?",
                "answer" => "Yes! Sweden offers several funding options, including the Swedish Institute Scholarship and university-specific Sweden scholarship programs to support tuition fees and living expenses."
            ],
            [
                "question" => "5.	How much does it cost to study in Sweden?",
                "answer" => "Tuition fees range from €8,000 – €18,000 per year depending on the course. Living expenses are around €8,000 – €12,000 per year. Scholarships and financial planning, including loans, can help manage costs."
            ],
            [
                "question" => "6.	What is the Sweden student visa process?",
                "answer" => "To study in Sweden, students must secure admission, pay tuition (if applicable), show financial proof, submit documents online, and apply for a residence permit. After approval, students can travel to Sweden and register locally."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection