@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Poland for Global Education and Long-Term Career Opportunities</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Poland consultancy in India, offering complete support for choosing the
                    right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Poland.</p>

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
                <p style="margin-top: 30px;">Study in Poland and take the first step toward an affordable, globally recognized education in Europe. Poland has become an increasingly popular destination for international students due to its high-quality education, modern universities, and low cost of living. With internationally accepted degrees, innovative teaching methods, and strong academic standards, Poland offers excellent opportunities for students planning to study in Europe. Choosing to study in Poland for international students means gaining valuable academic exposure while enjoying a rich cultural experience in the heart of Europe.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/polandnew.webp" loading="lazy" alt="Study in poland">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Poland?';
        $sectionDescription = 'Poland is emerging as a preferred destination for global education, offering high academic standards, affordable tuition fees, and globally recognized degrees. With a growing number of English-taught programs and a welcoming environment, Poland universities for international students provide excellent learning and career opportunities.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Poland is home to many reputed and globally ranked institutions known for academic excellence, research, and innovation. Universities emphasize theoretical knowledge combined with practical skills, ensuring students are well-prepared for international careers. Degrees from universities in Poland are recognized across Europe and worldwide.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the key benefits of choosing to study in Poland is the availability of flexible and industry-focused programs. Students can select from a wide range of bachelor’s, master’s, and doctoral courses designed to meet global market demands.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Poland welcomes students from all over the world, offering a multicultural learning environment. Studying in such a diverse setting enhances cross-cultural understanding, communication skills, and global networking opportunities, making study in Poland for international students a rewarding experience.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Poland has a growing economy with strong sectors such as IT, engineering, manufacturing, business, and healthcare. Universities maintain close ties with industries, offering internships, part-time jobs, and practical training that improve employability after graduation.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Polish universities actively promote research and innovation, particularly in science, engineering, technology, and medical fields. Students have access to modern research facilities and are encouraged to participate in academic and industry-based research projects.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Poland offers various government-funded and university-level financial aid options. Many students benefit from Poland scholarship programs and Poland scholarships for international students, which help reduce tuition fees and living expenses.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Universities provide comprehensive support services, including academic advising, career counselling, accommodation assistance, and cultural integration programs, ensuring international students adapt smoothly to life in Poland.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'University of Warsaw',
                'logo' => 'images/universities/warsaw.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Jagiellonian University',
                'logo' => 'images/universities/jagiuni.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Adam Mickiewicz University',
                'logo' => 'images/universities/uam.png',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'AGH University of Science and Technology',
                'logo' => 'images/universities/agh.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Wroclaw University of Science and Technology',
                'logo' => 'images/universities/wroclaw.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Poznan University of Technology',
                'logo' => 'images/universities/poznan.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Poland',
            'highlight' => '',
            'sub_heading' => 'Poland is home to several prestigious institutions known for academic quality and research excellence. These universities in Poland attract thousands of international students every year.',
            'footer' => 'These institutions are among the most preferred Poland universities for international students.'
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
            ['title' => 'Economics and Finance', 'image' => 'images/courses/international-relations.png'],
        ];
        $courseContent = [
            'title' => 'Popular Courses to Study in Poland',
            'desc' => 'Poland offers a wide range of high-demand programs taught in English and Polish. Poland universities for international students are especially known for career-focused education and strong academic outcomes.',
            'footer' => 'These programs attract students seeking affordable education with strong career prospects in Europe.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '€2,000 - €6,000'],
            ['label' => 'Master’s Degree', 'value' => '€2,500 - €7,000'],
            ['label' => 'MBA', 'value' => '€6,000 - €12,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '€3,000 - €8,000'],
            ['label' => 'Diploma / Certificate', 'value' => '€1,500 - €5,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Poland',
            'description' => 'The cost of studying in Poland is significantly lower compared to many other European countries. With proper planning and access to Poland scholarships for international students, education in Poland becomes highly affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€1,800 - €3,500', 'note' => 'Shared accommodation reduces costs'],
            ['label' => 'Food', 'value' => '€1,200 - €2,000', 'note' => 'Affordable student meals'],
            ['label' => 'Transportation', 'value' => '€300 - €600', 'note' => 'Student discounts available'],
            ['label' => 'Personal Expenses', 'value' => '€700 - €1,200', 'note' => 'Utilities and leisure'],
            ['label' => 'Total', 'value' => '€4,000 - €7,000', 'note' => 'varies by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Poland for Indian Students',
            'description' => 'Poland offers one of the lowest living costs in Europe. On average, international students spend between €4,000 - €7,000 per year, depending on the city and lifestyle.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the Poland: What to Expect?',
            'desc' => 'Student life in Poland is vibrant, affordable, and culturally rich. Universities offer clubs, sports, cultural festivals, and student organizations that help international students integrate easily. With safe cities, friendly locals, and strong academic support, Poland provides an excellent environment for learning and personal growth, making it an ideal choice to study in Poland.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Poland?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English proficiency are required.',
                'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
                'Check Application Deadlines: Deadlines vary by university and intake.',
                'Receive Offer Letter: Obtain an admission letter from the university.',
                'Confirm Admission and Apply for Visa: Accept the offer and proceed with the visa application.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Poland',
            'desc' => 'Students planning to study in Poland for international students must prepare the following documents:',
            'list' => [
                'Academic Transcripts and Certificates',
                'English Proficiency Test Scores (IELTS / TOEFL or equivalent)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof or Poland scholarship documents',
                'Offer Letter from a Recognized Polish University',
            ]
        ];

        $guideContent = [
            'title' => 'Poland Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study visa is required to study in Poland. The process includes securing admission, arranging financial proof, submitting an online application, and completing document verification. Understanding these steps helps students applying to Poland universities for international students avoid delays.',
            'list' => [
                'Receive Offer Letter from a Polish University',
                'Pay Tuition Fee (if applicable)',
                'Arrange Financial Proof or Poland Scholarship Documents',
                'Submit Student Visa Application',
                'Attend Visa Appointment and Submit Documents',
                'Receive Visa and Travel to Poland',
            ],
            'footer' => 'This structured process helps students prepare confidently and focus on their academic goals.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should international students choose to study in Poland?",
                "answer" => "Poland offers high-quality education, affordable tuition fees, and globally recognized degrees. Many Polish universities for international students provide English-taught programs, modern facilities, and strong academic support, making Poland a popular European study destination."
            ],
            [
                "question" => "2.	Is Poland a good option for international students?",
                "answer" => "Yes, studying in Poland for international students is an excellent choice due to low living costs, safe cities, cultural diversity, and strong academic standards. Degrees from universities in Poland are accepted across Europe and worldwide."
            ],
            [
                "question" => "3.	What are the best universities in Poland for international students?",
                "answer" => "Some of the top universities in Poland include the University of Warsaw, Jagiellonian University, Warsaw University of Technology, and AGH University of Science and Technology. These are well-known Polish universities for international students."
            ],
            [
                "question" => "4.	What courses are popular to study in Poland?",
                "answer" => "Popular courses include Engineering, Computer Science, Business and Management, Medicine, Economics, and Social Sciences. These programs offer strong career prospects and practical learning opportunities."
            ],
            [
                "question" => "5.	What is the cost to study in Poland?",
                "answer" => "The cost of study in Poland is affordable compared to other European countries. Tuition fees range from €2,000 to €7,000 per year, while living expenses average €4,000-€7,000 annually."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection