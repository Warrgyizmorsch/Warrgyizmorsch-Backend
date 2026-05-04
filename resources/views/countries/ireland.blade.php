@extends('layouts.app')
@section('content')

        <section class="service-hero">
            <div class="service-hero-content">
                <h1 class="main-heading" style="font-size: 34px;">Study in Ireland - A Gateway to Global Education and Career Success</h1>
                <div style="margin-bottom: 30px; margin-top:10px; text-align: left;">
                    <p>WTS is a leading Study in Ireland consultancy in India, offering complete support for choosing the right course and
                    university, securing scholarships, visa approval, and ensuring a seamless transition to academic and professional life
                    in Ireland.</p>

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
                    <p style="margin-top: 30px;">Study in Ireland with WTS Study Abroad Consultant and take the first step toward a globally recognized education. We guide students through university selection, visa processing, scholarships, and test preparation. With a strong reputation for academic excellence, innovation, and post-study career opportunities, Ireland has become a preferred destination for students planning to study abroad in Ireland. Our expert team ensures a smooth transition so you can focus on building a successful academic and professional future in one of Europe’s fastest-growing education hubs.</p>
                </div>
                <div class="sub-hero-img">
                    <img src="/images/irelandnew.webp" loading="lazy" alt="Study in ireland">
                </div>
            </div>
        </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study in Ireland?';
        $sectionDescription = 'Ireland has emerged as a top destination for international students due to its high-quality education system, globally ranked universities, and strong industry connections. Known as the European headquarters for many multinational companies, Ireland offers excellent academic exposure along with long-term career prospects. For students planning to study in Ireland from India, the country provides a safe, welcoming, and English-speaking environment.';

        $cards = [
            ['title' => '1. World-Class Education System', 'desc' => 'Ireland is home to globally ranked universities that emphasize research, innovation, and practical learning. Irish institutions focus on industry-relevant education, critical thinking, and skill development, preparing students for competitive global careers.'],
            ['title' => '2. Flexible and Career-Oriented Programs', 'desc' => 'One of the key advantages of studying in Ireland is its flexible academic structure. Students can choose specialized programs aligned with industry needs, helping them gain job-ready skills and practical exposure through internships and project-based learning.'],
            ['title' => '3. Cultural Diversity and Global Exposure', 'desc' => 'Ireland welcomes students from across the world, offering a multicultural and inclusive campus environment. Studying in such a diverse setting helps students develop global perspectives, strong communication skills, and international networks.'],
            ['title' => '4. Career Opportunities and Industry Exposure', 'desc' => 'Ireland is a global hub for IT, pharmaceuticals, finance, and business services. Universities maintain strong ties with leading companies, providing internships, part-time work, and post-study employment opportunities that enhance employability.'],
            ['title' => '5. Research and Innovation', 'desc' => 'Irish universities are known for cutting-edge research and innovation, especially in technology, healthcare, and data science. Students actively participate in research projects, gaining valuable academic and professional experience.'],
            ['title' => '6. Scholarships and Financial Assistance', 'desc' => 'Ireland offers various scholarships and funding options for international students. Many students planning to study abroad in Ireland also use scholarships or apply for a study loan in Ireland to manage tuition and living expenses effectively.'],
            ['title' => '7. International Student Support Services', 'desc' => 'Irish institutions provide comprehensive support services, including academic advising, career guidance, healthcare access, and cultural integration programs, helping students adapt smoothly to life in Ireland.'],
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
                    'name' => 'Trinity College Dublin',
                    'logo' => 'images/universities/trinitydublin.webp',
                    'course' => 'Science & Medicine',
                    'ranking' => 1
                ],
                [
                    'name' => 'University College Dublin ',
                    'logo' => 'images/universities/ucd.webp',
                    'course' => 'Engineering & Technology',
                    'ranking' => 2
                ],
                [
                    'name' => 'University of Galway',
                    'logo' => 'images/universities/galway.webp',
                    'course' => 'Engineering & Physical Sciences',
                    'ranking' => 6
                ],
                [
                    'name' => 'University College Cork',
                    'logo' => 'images/universities/ucc.webp',
                    'course' => 'Economics & Political Science',
                    'ranking' => 45
                ],
                [
                    'name' => 'Dublin City University',
                    'logo' => 'images/universities/dcu.png',
                    'course' => 'Arts & Humanities',
                    'ranking' => 22
                ],
                [
                    'name' => 'Maynooth University',
                    'logo' => 'images/universities/maynooth.png',
                    'course' => 'Health & Life Sciences',
                    'ranking' => 40
                ],
                [
                    'name' => 'University of Limerick',
                    'logo' => 'images/universities/limerick.svg',
                    'course' => 'Business & Law',
                    'ranking' => 32
                ],
            ];
            $universitySection = [
                'heading' => 'Top Universities in Ireland',
                'highlight' => '',
                'sub_heading' => 'Ireland is home to some of the most prestigious universities in Europe, known for academic excellence and research output.',
                'footer' => 'These universities attract thousands of international students every year and offer strong career support.'
            ];
        @endphp

        <x-universities :universities="$universities" :universitySection="$universitySection"/>

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
                'title' => 'Popular Courses to Study in Ireland',
                'desc' => 'Ireland offers a wide range of high-demand academic programs recognized globally. Universities are known for their industry-focused curriculum and strong career outcomes.',
                'footer' => 'These programs are especially popular among students seeking quality education and long-term employment opportunities.',
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
                ['label' => 'Undergraduate Degree', 'value' => '€9,000 - €25,000'],
                ['label' => 'Master’s Degree', 'value' => '€10,000 - €30,000'],
                ['label' => 'MBA', 'value' => '€20,000 - €35,000'],
                ['label' => 'Doctoral Degree (PhD)', 'value' => '€10,000 - €20,000'],
                ['label' => 'Diploma / Certificate', 'value' => '€8,000 - €15,000'],
            ];
            $description = "";

            $ukCostOfLiving = [
                'heading' => 'Cost of Studying in Ireland',
                'description' => 'The cost of studying in Ireland varies depending on the university, course, and level of study. Proper financial planning, scholarships, or a study loan Ireland can make education affordable.'
            ];
            $livingFees = [
                ['label' => 'Housing', 'value' => '€3,000 - €7,000', 'note' => 'Shared accommodation reduces cost'],
                ['label' => 'Food', 'value' => '€2,000 - €3,000', 'note' => 'Home cooking is economical'],
                ['label' => 'Transportation', 'value' => '€600 - €1,000', 'note' => 'Student travel cards available'],
                ['label' => 'Personal Expenses', 'value' => '€1,000 - €2,000', 'note' => 'Utilities and leisure'],
                ['label' => 'Total', 'value' => '€7,000 - €12,000', 'note' => 'Costs vary by city'],
            ];
            $ukCostOfLivingRight = [
                'heading' => 'Living Expenses in Ireland for Indian Students',
                'description' => 'The cost of living in Ireland depends on the city and lifestyle. On average, students spend between €7,000 - €12,000 per year.',
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
                'title' => 'Student Life in the Ireland: What to Expect?',
                'desc' => 'Student life in Ireland is vibrant and engaging. Universities offer clubs, sports, cultural events, and student societies that help international students feel at home. With friendly locals, safe cities, and excellent academic support, Ireland provides a balanced and enriching student experience. International student offices assist with academics, employment guidance, and personal well-being, making Ireland an ideal destination to study and grow.',
                'footer' => '',
                'guide_title' => 'How to Apply for Universities in Ireland?',
                'guide_steps' => [
                    'Research and Select Universities: Choose programs aligned with academic and career goals',
                    'Meet Entry Requirements: Academic qualifications and English proficiency',
                    'Prepare Application Documents: Transcripts, SOP, and recommendation letters.',
                    'Check Application Deadlines: Vary by institution and intake.',
                    'Receive Offer Letter: Conditional or unconditional offer from the university.',
                    'Confirm Admission and Apply for Visa: Accept the offer and begin the visa process.',
                ],
                'image' => 'images/whattoexpect.avif'
            ];
        @endphp
        <x-scholarship :scholarship="$scholarship"/>

        <!-- document section -->
        @php
            $documentContent = [
                'title' => 'Documents Required to Study in Ireland',
                'desc' => 'Students planning to study in Ireland from India must submit the following documents:',
                'list' => [
                    'Academic Transcripts',
                    'English Proficiency Test Scores (IELTS / TOEFL / PTE)',
                    'Letters of Recommendation',
                    'Statement of Purpose',
                    'Valid Passport',
                    'Financial Proof or Study Loan Ireland documents',
                    'Offer Letter from an Approved Institution',
                ]
            ];

            $guideContent = [
                'title' => 'Ireland Study Visa Process: Step-by-Step Guide',
                'desc' => 'A study visa is required to study in Ireland. The process involves getting admission, arranging funds, applying online, and submitting documents. Understanding these steps helps students pursuing study abroad Ireland avoid delays and enjoy a smooth visa process.',
                'list' => [
                    'Receive Offer Letter from an Approved Institution: Students must first obtain an official offer letter from an Irish university or college listed under the Interim List of Eligible Programmes (ILEP).',
                    'Pay Tuition Fee Deposit: After accepting the offer, students are required to pay the minimum tuition fee deposit as mentioned in the admission letter.',
                    'Arrange Financial Proof / Study Loan Ireland: Students must demonstrate sufficient funds to cover tuition fees and living expenses. This can be shown through bank statements or an approved study loan in Ireland.',
                    'Complete Online Visa Application: Apply for the Ireland student visa by completing the online application form through the AVATS system.',
                    'Submit Documents and Biometrics: Submit all required documents, including passport, offer letter, financial proof, academic records, and statement of purpose, at the nearest Irish Visa Application Centre.',
                    'Visa Decision and Travel to Ireland: Once the application is processed and approved, students receive their visa and can travel to Ireland. After arrival, registration with local immigration authorities is mandatory.',
                ],
                'footer' => 'This structured process helps students planning to study in Ireland from India prepare effectively and focus on their academic goals.'
            ]
        @endphp
        <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />


        @include('./components/cta-button')

        <!-- faq section  -->
         @php
            $faqs = [
                [
                    "question" => "1.	Why should I choose to study in Ireland?",
                    "answer" => "Ireland offers high-quality education, globally ranked universities, and strong career opportunities. With an English-speaking environment and a welcoming culture, study in Ireland is an excellent choice for international students."
                ],
                [
                    "question" => "2.	Is Ireland good for international students?",
                    "answer" => "Yes. Ireland is one of the safest and most student-friendly countries in Europe. Study in Ireland for international students offers world-class education, cultural diversity, and strong post-study work options."
                ],
                [
                    "question" => "3.	What are the top Ireland universities for international students?",
                    "answer" => "Some of the best institutions include Trinity College Dublin, University College Dublin, University of Galway, University College Cork, Dublin City University, and University of Limerick."
                ],
                [
                    "question" => "4.	What courses are popular in Ireland?",
                    "answer" => "Popular courses include Engineering, Business & Management, Computer Science, Data Science, Medicine, and Social Sciences. These programs are highly demanded among students planning to study in Ireland from India."
                ],
                [
                    "question" => "5.	How much does it cost to study in Ireland?",
                    "answer" => "Tuition fees range from €9,000 to €30,000 per year depending on the course. Living expenses usually range between €7,000 and €12,000 annually. Many students use scholarships or a study loan Ireland to manage costs."
                ],
            ];
        @endphp
        <x-faq :faqs="$faqs" />

@endsection