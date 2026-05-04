@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Russia - A Gateway to Global Education and
                Career Success</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Russia consultancy in India, offering complete support for choosing the
                    right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Russia.</p>

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
                <p style="margin-top: 30px;">Study in Russia and take the first step toward an internationally recognized and affordable
                    education. Russia has become a popular destination for students seeking quality education, globally accepted degrees,
                    and strong academic foundations. With a wide range of programs taught in English and Russian,
                    students can choose from some of the best options at a Russian university known for academic excellence and research.
                    Russia offers an excellent opportunity for international students to build a strong academic and professional future in a globally
                    competitive environment.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/russianew.webp" loading="lazy" alt="Study in russia">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Russia?';
        $sectionDescription = 'Russia is one of the fastest-growing education destinations for international students due to its affordable tuition fees, globally ranked universities, and strong focus on science, medicine, and engineering. Many students who explore options such as study in Poland for international students or universities in Poland also consider Russia because of its cost-effectiveness and globally recognized degrees. For students planning to study in Russia, the country offers quality education, cultural richness, and strong academic infrastructure.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Russia is home to some of the world’s oldest and most prestigious universities. A Russian university is well known for its strong emphasis on research, innovation, and academic depth, particularly in medicine, engineering, science, and technology. Degrees from Russian institutions are recognized globally.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'Russian universities offer flexible academic programs with a strong focus on practical training and research-based learning. Students can choose from English-taught or Russian-taught programs, making Russia university for international students a flexible and attractive option compared to other European destinations.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Russia welcomes students from more than 150 countries, creating a multicultural and inclusive learning environment. This global exposure helps students develop adaptability, intercultural communication skills, and international networks, similar to experiences offered by universities in Poland and other European study destinations.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Russia has strong industries in healthcare, engineering, IT, energy, and research. Universities collaborate with research institutes and industries, offering internships and practical training. Graduates from a Russia university for international students gain valuable skills applicable worldwide.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Russian universities are globally respected for scientific research, particularly in medicine, space technology, physics, and engineering. Students actively participate in research projects, gaining hands-on experience that strengthens academic and career prospects.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Russia offers various government and university-level scholarships to international students. Affordable tuition fees and low living costs make study in Russia a cost-effective option compared to many European countries, including those considering study in Poland for international students.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Russian universities provide comprehensive support services such as academic guidance, language assistance, accommodation support, and student welfare services, ensuring a smooth transition for international students.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'Lomonosov Moscow State University',
                'logo' => 'images/universities/lomonosov.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Saint Petersburg State University ',
                'logo' => 'images/universities/petersburg.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Novosibirsk State University',
                'logo' => 'images/universities/novosi.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Tomsk State University',
                'logo' => 'images/universities/tomsk.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Peoples’ Friendship University of Russia',
                'logo' => 'images/universities/rudn.jpg',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'Bauman Moscow State Technical University',
                'logo' => 'images/universities/bauman.jpg',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
             [
                'name' => 'Kazan Federal University',
                'logo' => 'images/universities/kazan.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Russia',
            'highlight' => '',
            'sub_heading' => 'Russia is home to several prestigious institutions known for academic excellence and research output.',
            'footer' => 'Each Russian university listed above welcomes thousands of international students every year.'
        ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection" />

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Business and Management', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Computer Science/Information Technology', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Medicine (MBBS)', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Aviation and Aerospace', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Social Sciences and Humanities', 'image' => 'images/courses/hospitality.jpg'],
        ];
        $courseContent = [
            'title' => 'Popular Courses to Study in Russia',
            'desc' => 'Russia offers a wide range of globally recognized academic programs, especially popular among international students seeking affordable and quality education.',
            'footer' => 'These programs attract students who compare options across Europe, including universities in Poland, but prefer Russia for its affordability and strong academic reputation.',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Undergraduate Degree', 'value' => '$2,000 - $5,000'],
            ['label' => 'Master’s Degree', 'value' => '$3,000 - $6,000'],
            ['label' => 'MBA', 'value' => '$3,500 - $6,000'],
            ['label' => 'Doctoral Degree (PhD)', 'value' => '$3,000 - $5,000'],
            ['label' => 'Diploma / Certificate', 'value' => '$1,500 - $4,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Russia',
            'description' => 'The cost of studying in Russia is significantly lower compared to many European destinations, including universities in Poland, making it a preferred choice for budget-conscious students.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '$1,200 - $2,500', 'note' => 'University hostels are affordable'],
            ['label' => 'Food', 'value' => '$1,000 - $1,500', 'note' => 'Student canteens reduce costs'],
            ['label' => 'Transportation', 'value' => '$300 - $500', 'note' => 'Public transport is economical'],
            ['label' => 'Personal Expenses', 'value' => '$500 - $800', 'note' => 'Includes utilities and leisure'],
            ['label' => 'Total', 'value' => '$3,000 - $5,000', 'note' => 'Varies by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Russia for International Students',
            'description' => 'Russia offers a very affordable cost of living compared to many European countries, including study in Poland for international students destinations. On average, students spend between $3,000 – $5,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in Russia: What to Expect?',
            'desc' => 'Student life in Russia is culturally rich and academically engaging. Universities offer student clubs, sports activities, cultural events, and international student communities. With affordable living, quality education, and global exposure, Russia provides a rewarding experience for students who may also be exploring options like universities in Poland but prefer a more cost-effective study destination.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Russia?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs and universities based on academic goals.',
                'Meet Entry Requirements: Academic qualifications and eligibility criteria vary by course.',
                'Prepare Application Documents: Transcripts, passport, and academic certificates.',
                'Receive Admission Letter: Issued by the selected Russian university.',
                'Pay Tuition Fee (if required): As per university guidelines.',
                'Apply for Student Visa: Begin visa process after receiving admission confirmation.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Russia',
            'desc' => 'Students planning to study in Russia must prepare the following documents:',
            'list' => [
                'Academic Transcripts and Certificates',
                'Valid Passport',
                'Admission Letter from a Russian University',
                'Medical Fitness and HIV Test Report',
                'Passport-size Photographs',
                'Financial Proof (if required)',
            ]
        ];

        $guideContent = [
            'title' => 'Russia Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study visa is required to study in Russia. The process involves securing admission, submitting documents, and completing visa formalities. Understanding each step helps international students avoid delays and ensures a smooth transition.',
            'list' => [
                'Receive admission letter from a Russian university',
                'Prepare required documents and medical reports',
                'Apply for student visa at the Russian Embassy or Consulate',
                'Receive visa approval and travel to Russia',
                'Complete local registration after arrival',
            ],
            'footer' => 'This structured process helps students confidently begin their academic journey at a Russia university for international students.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should international students study in Russia?",
                "answer" => "Russia offers globally recognized degrees, affordable tuition fees, and strong programs in medicine, engineering, and technology. Many students choose to study in Russia due to quality education and low living costs."
            ],
            [
                "question" => "2.	Are Russian universities recognized internationally?",
                "answer" => "Yes, degrees from a Russian university are recognized by major international bodies such as WHO, UNESCO, and other global education authorities, depending on the course and institution."
            ],
            [
                "question" => "3.	Is Russia a good option for international students compared to Europe?",
                "answer" => "Yes, Russia is a cost-effective alternative to many European destinations. Students comparing options like study in Poland for international students often choose Russia due to lower tuition fees and living expenses."
            ],
            [
                "question" => "4.	What are the popular courses to study in Russia?",
                "answer" => "Popular courses include MBBS (Medicine), Engineering, Computer Science, Business Management, and Aviation. These programs are widely offered by Russia university for international students."
            ],
            [
                "question" => "5.	Can international students study in English in Russia?",
                "answer" => "Yes, many Russian universities offer English-taught programs, especially in medicine, engineering, and management, making it easier for international students to adapt."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection