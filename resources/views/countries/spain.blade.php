@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading" style="font-size: 34px;">Study in Spain - Achieve Academic Excellence and Career Advancement</h1>
            <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                <p>WTS is a leading Study in Spain consultancy in India, offering complete support for choosing the
                    right
                    course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and
                    professional life
                    in Spain.</p>

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
                <p style="margin-top: 30px;">Study in Spain and take the first step toward a globally recognized education. Spain is known for its rich cultural heritage, high-quality universities, and excellent career opportunities. With diverse programs, world-class academic exposure, and a vibrant student life, Spain has become a preferred destination for students planning to study abroad in Spain. Proper preparation helps students study in Spain from India and focus on building a successful academic and professional future in one of Europe’s most welcoming countries.</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/spainnew.webp" loading="lazy" alt="Study in spain">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Spain?';
        $sectionDescription = 'Spain is an increasingly popular destination for international students due to its top-ranked universities, industry-focused programs, and rich cultural diversity. Known for its innovation, research opportunities, and global business connections, Spain offers a safe and English-friendly environment for students aiming to study in Spain from India.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Spanish universities are recognized globally for academic excellence, research, and skill development. Institutions focus on practical learning, critical thinking, and industry-ready education, preparing students for competitive international careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One key advantage of choosing to study in Spain is the flexible academic structure. Students can select programs aligned with career goals, gain practical exposure through internships, and participate in project-based learning to become job-ready.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Spain welcomes students from all over the world, offering a multicultural and inclusive campus environment. Studying in such a diverse setting enhances global perspectives, communication skills, and international networking opportunities.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Spain is home to thriving industries such as tourism, IT, finance, and renewable energy. Universities collaborate closely with companies, providing internships, part-time work, and post-study employment options that enhance employability for students planning to study in Spain from India.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Spanish universities are known for strong research programs, especially in technology, healthcare, business, and the arts. Students can actively participate in research projects, gaining valuable academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Spain offers a variety of scholarships and funding options for international students. To manage tuition and living expenses, students often consider a combination of scholarships and financial planning for study in Spain.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Universities in Spain provide academic advising, career guidance, healthcare access, and cultural integration programs, helping students adapt smoothly and succeed academically while studying abroad in Spain.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    @include('./components/stats')


    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'University of Barcelona',
                'logo' => 'images/universities/barcelona.png',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Autonomous University of Madrid',
                'logo' => 'images/universities/unimadrid.png',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Complutense University of Madrid',
                'logo' => 'images/universities/complutenseuni.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'University of Valencia',
                'logo' => 'images/universities/valenciauni.png',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'Pompeu Fabra University',
                'logo' => 'images/universities/fabrauni.png',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Granada',
                'logo' => 'images/universities/granada.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Polytechnic University of Catalonia',
                'logo' => 'images/universities/upc.png',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'University of Salamanca',
                'logo' => 'images/universities/salmancauni.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
        ];
        $universitySection = [
            'heading' => 'Top Universities in Spain',
            'highlight' => '',
            'sub_heading' => 'Spain hosts some of Europe’s most prestigious universities known for academic excellence, research output, and strong employability support:',
            'footer' => ''
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
            'title' => 'Popular Courses to Study in Spain',
            'desc' => 'Spain offers a broad range of globally recognized programs with strong industry relevance:',
            'footer' => 'These programs are highly sought after by students looking to combine quality education with career opportunities.',
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
            ['label' => 'Diploma / Certificate', 'value' => '€6,000 - €15,000'],
        ];
        $description = "";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Spain',
            'description' => 'The cost of studying in Spain varies depending on the university, course, and level of study. Careful financial planning, scholarships, or personal funding can make education in Spain affordable.'
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€3,000 - €6,500', 'note' => 'Shared apartments are more affordable'],
            ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Cooking at home saves costs'],
            ['label' => 'Transportation', 'value' => '€500 - €1,000', 'note' => 'Student passes reduce travel expenses'],
            ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Includes leisure and utilities'],
            ['label' => 'Total', 'value' => '€7,000 - €12,000', 'note' => 'Major cities are more expensive'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Spain  for Indian Students',
            'description' => 'The cost of living depends on the city and lifestyle. On average, students spend €7,000 - €12,000 per year.',
        ];
    @endphp
    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />
    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Student Life in the Spain: What to Expect?',
            'desc' => 'Student life in Spain is dynamic and culturally rich. Universities offer clubs, sports, cultural events, and student societies that help international students feel welcome. Friendly locals, safe cities, and excellent academic support make Spain an ideal destination to study in Spain from India while gaining global exposure and life skills.',
            'footer' => '',
            'guide_title' => 'How to Apply for Universities in Spain?',
            'guide_steps' => [
                'Research and Select Universities: Choose programs aligned with academic and career goals.',
                'Meet Entry Requirements: Academic qualifications and English/Spanish proficiency are required.',
                'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
                'Check Application Deadlines: Varies by university and intake.',
                'Receive Offer Letter: Accept the admission offer.',
                'Confirm Admission and Apply for Visa: Complete the study visa process as per requirements.',
            ],
            'image' => 'images/whattoexpect.avif'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required to Study in Spain',
            'desc' => 'Students planning to study in Spain from India must submit:',
            'list' => [
                'Academic Transcripts',
                'English/Spanish Proficiency Test Scores (IELTS / TOEFL / DELE / SIELE)',
                'Letters of Recommendation',
                'Statement of Purpose',
                'Valid Passport',
                'Financial Proof for Tuition and Living Expenses',
                'Offer Letter from an Approved Spanish Institution',
            ]
        ];

        $guideContent = [
            'title' => 'Spain Study Visa Process: Step-by-Step Guide',
            'desc' => 'A study visa is mandatory to study in Spain. Understanding the process ensures a smooth experience:',
            'list' => [
                'Receive Offer Letter from an Approved Institution: First, secure an official admission letter.',
                'Pay Tuition Fee Deposit: Confirm enrollment by paying the required fee.',
                'Arrange Financial Proof: Show funds or sponsorship to cover study in Spain cost.',
                'Complete Online Visa Application: Submit application through the Spanish consulate or AVATS system.',
                'Submit Documents and Biometrics: Include passport, offer letter, academic records, and proof of funds.',
                'Visa Decision and Travel to Spain: Once approved, travel to Spain and register with local immigration authorities.',
            ],
            'footer' => 'This process helps students preparing to study abroad in Spain plan effectively and focus on academics.'
        ]
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	Why should I choose to study in Spain?",
                "answer" => "Spain offers world-class universities, industry-focused programs, cultural diversity, and excellent post-study career opportunities, making it an ideal destination for international students."
            ],
            [
                "question" => "2.	How can Indian students apply to study in Spain?",
                "answer" => "Students can study in Spain from India by researching universities, meeting entry requirements, preparing documents like transcripts and SOP, receiving an offer letter, and completing the study visa process."
            ],
            [
                "question" => "3.	What are the popular courses to study in Spain?",
                "answer" => "Popular programs include Engineering, Business & Management, Computer Science/IT, Medicine & Health Sciences, and Social Sciences & Humanities."
            ],
            [
                "question" => "4.	What is the cost to study in Spain?",
                "answer" => "The cost of studying in Spain depends on the course and university. Tuition ranges from €8,000 – €35,000 per year, while living expenses average €7,000 - €12,000 annually."
            ],
            [
                "question" => "5.	Do I need a student visa to study in Spain?",
                "answer" => "Yes, a study visa is mandatory. Students must provide an offer letter, financial proof, academic documents, and complete the visa application process as per study visa Spain requirements."
            ],
            [
                "question" => "6.	Can I get scholarships or financial aid to study in Spain?",
                "answer" => "Yes, many Spanish universities offer scholarships to international students. Students can also use personal funding or a study loan in Spain to manage tuition and living expenses."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection