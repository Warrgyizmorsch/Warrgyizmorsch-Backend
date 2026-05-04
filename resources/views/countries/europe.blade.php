@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Study in Europe: Unlock Global Opportunities with WTS Visa Consultancy
            </h1>
            <!-- <p>Boost your confidence and ace your student visa interview with expert mock sessions.
                                    </p> -->
            <!-- <a href="#get-started" class="btn">Select Your Course</a> -->

            <!-- Features Section -->
            <div class="features">
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Accurate and Up-to-Date Visa Information
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Fast and Hassle-Free Application Process
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>24/7 Expert Guidance and Support
                    </strong>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Updates on visa policies and requirements</strong>
                </div>
            </div>
            <span class=tip>Enjoy free services from A to A – application to accommodation, ensuring a smooth visa process
                from start to finish</span>
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
                <h2>Start Your Journey</h2>
                <p>WTS Visa Consultancy helps students fulfill their dream of studying in Europe, home to top universities
                    and diverse cultures. Europe offers world-class education, research opportunities, and affordable,
                    English-taught programs. With a rich history and advanced infrastructure, it’s an ideal study
                    destination. We assist with university selection, visa applications, and every step of the journey.
                    Studying in Europe enhances careers and personal growth. Let WTS Visa Consultancy be your trusted
                    partner in making this life-changing opportunity a reality!</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/europe-bg.png" loading="lazy" alt="Study in europe">
            </div>
        </div>
    </section>


    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Choose Europe for Your Higher Education?';
        $sectionDescription = 'It has now become very common for foreign students to flock to Europe for world-class education, rich cultural diversity, and excellent career hiring prospects. The best institutes in Europe are at the same time Study in Europe for international students, affordable and research-oriented, making Europe the best place to learn. Academia, networking, and cultural exposure are all possible in study abroad, and that is perhaps the most memorable experience in one\'s life.';

        $cards = [
            ['title' => '1. High-Quality Education & Affordable Tuition ', 'desc' => 'Recognized by the world, European universities go beyond their standards. Many countries use these as attractive bait for new international students through low-cost or even free education. So, WTS Visa Consultancy helps you in searching the right university and courses that will best fit you based on your ambitions and financial status. '],
            ['title' => '2. Explosive & Global Experience ', 'desc' => 'Studying in Europe would mean immersing myself in an environment with a heterogeneous culture. Universities are tied to one another even in worldwide educational collaborations, with such offerings as exchanges and internships outside the nation, enhancing career opportunities. '],
            ['title' => '3. Career Progression & Professional Exposure ', 'desc' => 'Excellent career services such as job placement and internships are available in the institutions in Europe. Not to mention, easy trips to the cheapest universities in Europe for international students because Europe is located centrally in the world. Thus, you enrich your academic life as much as your personal experiences. WTS Visa Consultancy ensures you travel smoothly all through his life.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />

    @include('./components/stats')

    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'University of Oxford',
                'logo' => 'images/universities/oxford.webp', // Add logo URL if available
                'course' => 'Various Undergraduate & Postgraduate Courses',
                'ranking' => 1
            ],
            [
                'name' => 'University of Cambridge',
                'logo' => 'images/universities/cambridge-logo.webp',
                'course' => 'Engineering, Medicine, Humanities, Business',
                'ranking' => 2
            ],
            [
                'name' => 'ETH Zurich',
                'logo' => 'images/universities/zurich.webp',
                'course' => 'Engineering, Technology, Sciences',
                'ranking' => 3
            ],
            [
                'name' => 'University of Amsterdam',
                'logo' => 'images/universities/amsterdam.webp',
                'course' => 'Social Sciences, Economics, Psychology',
                'ranking' => 4
            ],
            [
                'name' => 'University of Munich',
                'logo' => 'images/universities/munich.webp',
                'course' => 'Natural Sciences, Law, Economics, Medicine',
                'ranking' => 5
            ],
            [
                'name' => 'Heidelberg University',
                'logo' => 'images/universities/heidelberg.webp',
                'course' => 'Life Sciences, Humanities, Social Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'Sorbonne University',
                'logo' => 'images/universities/sorbonne.webp',
                'course' => 'Arts, Humanities, Sciences, Engineering',
                'ranking' => 7
            ],
            [
                'name' => 'University of Bologna',
                'logo' => 'images/universities/bologna.webp',
                'course' => 'Law, Arts, Science, Engineering',
                'ranking' => 8
            ],
            [
                'name' => 'University of Copenhagen',
                'logo' => 'images/universities/copenhagen.webp',
                'course' => 'Health Sciences, Law, Humanities, Social Sciences',
                'ranking' => 9
            ],
            [
                'name' => 'Stockholm University',
                'logo' => 'images/universities/stockholm.webp',
                'course' => 'Environmental Sciences, IT, Arts, Business',
                'ranking' => 10
            ]
        ];
        $universitySection = [
            'heading' => 'Top Universities ',
            'highlight' => 'in Europe for Global Learners',
            'sub_heading' => 'Indeed, some of the best universities in Europe are typically among the world\'s most elite institutions with high academic standards, nonpareil research, and global prestige. Below are some of the most preferred European institutions for distance learners: 
                                ',
            'footer' => ''
        ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection" />

    <!-- course section -->
    @php
        $courses = [
            ['title' => 'Business Administration', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Engineering', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Medicine', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Information Technology', 'image' => 'images/courses/it.png'],
            ['title' => 'Data Science', 'image' => 'images/courses/data-science.png'],
            ['title' => 'International Relations', 'image' => 'images/courses/international-relations.png'],
            ['title' => 'Psychology', 'image' => 'images/courses/psychology.png'],
            ['title' => 'Environmental Science', 'image' => 'images/courses/environment.jpg'],
            ['title' => 'Artificial Intelligence', 'image' => 'images/courses/ai.jpg'],
            ['title' => 'Fine Arts', 'image' => 'images/courses/fine-arts.png'],
        ];

        $courseContent = [
            'title' => 'Popular Courses to Study in Europe',
            'desc' => 'Be it Medical Sciences, Administration or Technology, European universities offer diversified academic programs intended to fulfil the global job market. The following are some of the favours of international students:',
            'footer' => '',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $tuitionFees = [
            ['label' => 'Business Administration', 'value' => '€3,000 - €30,000'],
            ['label' => 'Engineering', 'value' => '€4,000 - €20,000'],
            ['label' => 'Medicine', 'value' => '€5,000 - €30,000'],
            ['label' => 'Information Technology', 'value' => '€3,000 - €15,000'],
            ['label' => 'Humanities', 'value' => '€2,000 - €10,000'],
        ];

        $description = "Cost for study and living varies with university, courses, and city in the UK. Below is an approximate breakdown of tuition fees for international students:";

        $ukCostOfLiving = [
            'heading' => 'Cost of Studying in Europe: Tuition Fees & Living Expenses',
            'description' => 'The cost of studying in Europe is always country-specific, university-specific and program-specific. Quite a number of European countries give free or inexpensive tuition even to overseas students, especially at public universities. Here is an estimated breakdown of tuition fees required for some of the popular courses in Europe:',
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€8,000 - 15,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => '€4,000 - 6,000', 'note' => 'Home cooking is economical'],
            ['label' => 'Transportation', 'value' => '€1,200 - 2,000', 'note' => 'Student travel concessions available'],
            ['label' => 'Personal Expenses', 'value' => '€3,000 - 4,000', 'note' => 'Includes utilities and leisure'],
            ['label' => 'Total', 'value' => '€20,000 - 25,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Europe for Indian Students',
            'description' => 'The study in Europe cost for Indian students also includes living expenses, which vary by city and lifestyle. On average, students spend between €20,000 - 25,000 per year.',
        ];
    @endphp

    <x-cost-of-living :tuitionFees="$tuitionFees" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />


    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Scholarships & Financial Aid for International Students in Europe',
            'desc' => 'International students can find several scholarships and financial aid programs offered by European universities and governments. At WTS Visa Consultancy, we identify and help you make applications for these funding opportunities to relieve some of the burden of study costs abroad. Merit-based scholarships are awarded based on academic merit and usually cover tuition and living costs. Need-based scholarships are for students from low-income backgrounds, which may include additional consideration for travel and study materials. Some universities also offer country-based scholarships to attract students from a specific region. There are also research-based scholarships for postgraduate students and doctoral students working on innovative projects.',
            'footer' => 'The <strong>Erasmus+ program</strong> is one of the most sought-after funding opportunities wherein students can study in several countries across Europe while being funded. Many countries offer interest-free or low-interest student loans with flexible repayment options. <strong>WTS Visa Consultancy</strong> ensures your scholarship application stands out, meets eligibility criteria, and is submitted on time. We also help you combine various funding sources to effectively cover your study and living costs.',
            'guide_title' => 'How to Apply for European Scholarships?',
            'guide_steps' => [
                'Explore Funding Opportunities – Research scholarships offered by governments, universities, and programs like Erasmus+.',
                'Understand Scholarship Categories – Identify whether you qualify for merit-based, need-based, country-based, or research-based scholarships.',
                'Prepare Required Documents – Compile academic transcripts, motivation letters, recommendation letters, and proof of financial need or excellence.',
                'Track Deadlines and Apply – Keep a calendar of application deadlines and submit early to boost your chances.',
                'Follow Up and Prepare for Interviews – Some programs may include interviews or additional assessments.',
            ],
            'image' => 'images/scholarships.png'
        ];
    @endphp

    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents You Need to Study in Europe',
            'desc' => 'Therefore, it is quite imperative in the sense of properly preparing documentation for applying to study in Europe: documentation required for university entry purposes and further needed for visa consideration. WTS Visa Consultancy assures that all the relevant documentation is ready, avoiding any delays and assuring acceptance. Below are some of the vital documents you would need:',
            'list' => [
                'Valid Passport: A six-month or longer validity period beyond the intended date of departure is a must.',
                'Academic Transcripts and Certificates: Proof of completion of prior degrees or qualifications.',
                'Statement of Purpose (SOP): A complete explanation of your academic goals, stating why you chose the course and the university.',
                'Letters of Recommendation: From your professors or ex-employers to enhance the strength of your application.',
                'Proof of Language Proficiency: IELTS or TOEFL scores that meet uni-language requirements.',
                'Proof of Financing: Your bank statements or sponsorship letters should show you can pay for tuition and money for living.',
                'Health Insurance: Health insurance is mandatory in almost every European country for international students.',
                'Whatever Additional Documents: Research proposals (if applicable for PhD applicants) or portfolios (if applicable for creative programs).',
            ]
        ];

        $guideContent = [
            'title' => 'Understanding the Europe Student Visa Process',
            'desc' => 'Getting a student visa is a fundamental step in your journey toward study in Europe. WTS Visa Consultancy simplifies the entire process by carefully guiding you through each step to ensure smooth and successful realization. Here are the fundamental steps in the European student visa process:',
            'list' => [
                'Secured Admission Letter: The student must obtain an admission letter from a recognized European university.',
                'Applied Visa: The student fills the visa application form for the respective country in which he/she will study.',
                'Proof of Financial Stability: The student has to provide bank statements or any other support letter that reflects the ability to support tuition and living expenses.',
                'Health Insurance: Necessary for most countries in Europe, proof of health insurance coverage must be provided.',
                'Required Documents: A valid passport, passport photographs, and academic transcripts have to be submitted.',
                'Language Proficiency: Certain countries demand submission of language test scores such as IELTS or TOEFL.',
                'Visa Interview: There may be an interview set at the consulate or embassy.',
                'Processing Period: Processing will require four to twelve weeks on average.',
            ]
        ];

    @endphp

    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    <section class="column-section">
        <div class="column-container">
            <div class="column">
                <div class="content-box">
                    <h2 class="service-heading">Can You Work While Studying in Europe? Rules & Opportunities</h2>
                    <p class="content-description">
                        Most European countries allow international students to work part-time—up to 20 hours per week
                        during sessions and full-time during holidays. Jobs in hospitality, retail, tutoring, and on-campus
                        roles are common. WTS Visa Consultancy helps you find part-time work, understand tax regulations,
                        and explore internships that enhance your credentials, ensuring a balanced academic and professional
                        experience.
                    </p>
                </div>

                <div class="content-box">
                    <h2 class="service-heading">How to Apply for Permanent Residency (PR) in Europe after Graduation?</h2>
                    <p class="content-description">
                        A number of nations across Europe allow students to remain in the country for a limited period after
                        their studies in order to look for jobs. Some
                        affordable universities in Europe for international students may also ask for certain language
                        proficiency and cultural knowledge. The use of such fast-tracked methods is normally available to
                        highly skilled workers. The major documents needed would include a current passport, proof of
                        residence, tax records, and contracts of employment. WTS Visa Consultancy will help advise on
                        documentation, eligibility checks, and applications for this smooth transition to a permanent
                        residency.
                    </p>
                </div>
                <div class="content-box">
                    <h2 class="service-heading">Step-by-Step Guide to Applying to European Universities</h2>
                    <p class="content-description">Applying in Europe may seem to be an uphill task, but it becomes easier
                        with the proper guidance. <strong>WTS Visa Consultancy</strong> helps you through every step, from
                        carefully selecting the university up to your study in Europe without IELTS and comfortable
                        settlement into your academic life. Here is a simple overview of some important steps:</p>
                    <ol class="faq-list">
                        <li><strong>Research and Shortlist Universities:</strong> Identify universities according to your
                            academic background, career prospect, and financial standing.</li>
                        <li><strong>Preparation of Application Materials:</strong> Prepare pertinent documents, such as
                            personal statement drafts, academic transcripts, recommendation letters, and others.</li>
                        <li><strong>Meeting Language Requirements:</strong> Proof of language, for instance, IELTS or TOEFL
                            scores, if required.</li>
                        <li><strong>Application Submission:</strong> Try and submit your duly filled application before the
                            deadline set by the university.</li>
                        <li><strong>Receive and Accept Offer:</strong> In case of acceptance, accept the offer and complete
                            further paperwork if necessary.</li>
                        <li><strong>Apply for Student Visa:</strong> Further, the following applications must be made for
                            student visa and arranging accommodation.</li>
                        <li><strong>Pre-Departure Settlement:</strong> Orientation at the pre-departure level gets you
                            guidance on adjusting through this academic ambience.</li>
                    </ol>
                </div>
                <div class="content-box">
                    <h2 class="service-heading">Study in Europe – Unlock Your Future with World-Class Education</h2>
                    <p class="content-description">
                        The European study pattern offers superlative education, global career access, and diverse academic
                        programs. European universities rank among the best in the world and, thus, their degrees are held
                        in high esteem by employers. At WTS Visa Consultancy, we help you with university and program
                        selection. The flexible education system in Europe allows personalized study plans. Apart from
                        academics, there is exposure to rich culture and new languages along with easy travel. Europe
                        facilitates innovation through advanced research facilities and collaborative projects. WTS Visa
                        Consultancy streamlines the application and visa guidance process, so you can find your way smoothly
                        toward academic success and personal growth. Let us help you with your study abroad endeavours.
                    </p>
                </div>
            </div>

            <div class="column">
                <div class="content-box">
                    <h2 class="service-heading">Challenges Faced by International Students in Europe & How to Overcome Them
                    </h2>
                    <p class="content-description">Europe holds a very attractive lure to all international students as it
                        conducts rewarding experiences. Nevertheless, these visiting students might experience certain
                        challenges pertaining to adjustment in the best countries to study in Europe for international
                        students new environment. At WTS Visa Consultancy, we prepare students to be able to go past the
                        hassles and have a smooth transition and muster an enjoyable academic experience. </p>
                    <ol class="faq-list">
                        <li><strong>Language Barriers:</strong>
                            <p></p>Language differences present one of the top problems among most international students,
                            and in fact, that's true even in an English-speaking country. Most resolve this through
                            enrolling into language courses or joining exchange programs.
                        </li>
                        <li><strong>Cultural Adjustment:</strong> Social norms and academic systems seem so much different
                            and it is almost everything above one's expectation for adapting it to daily life. Joining into
                            student communities, being a part of cultural events, and networking within the local
                            townspeople help to ease out cultural shock.</li>
                        <li><strong>Financial Constraints:</strong> Financial pressure arises from an expensive city because
                            even living becomes pricey. Budgeting wisely, working part-time, and applying scholarships are
                            strategies that can minimize spending and reduce the financial burden.
                        </li>
                        <li><strong>Academic Pressure:</strong> The different teachings may present Europe student visa
                            process difficulties as well as grading. Academic support from professors and study group
                            formation will advance in both learning and performance.</li>
                        <li><strong>Homesickness:</strong> It is usually lonely. Contacts with family and student groups
                            will help in the creation of new friendships with persons from different backgrounds.</li>
                    </ol>
                </div>
                <div class="content-box">
                    <h2 class="service-heading">Student Life in Europe: Culture, Accommodation & Travel</h2>
                    <p class="content-description">
                        The student life in Europe is a spectrum of vibrancy, reflected in the multifarious cultures,
                        charming historic towns, and intense student life. We at WTS Visa Consultancy support you in
                        adjusting scholarships for studying in Europe easily so that you can enjoy your academic and
                        personal experiences.
                    </p>
                    <ul class="student-list">
                        <li>Culture</li>
                        <p class="content-description">The European cities are chock-full of history, cultural festivals,
                            and student organizations. These clubs invite students to immerse themselves in the local
                            culture through extracurricular activities and language exchanges. Transport, museums, and
                            entertainment are subsidized, making cultural exploration financially feasible.</p>
                        <li>Accommodation </li>
                        <p class="content-description">Universities provide on-campus housing provisions, but most students
                            rent apartments or share accommodations with roommates. WTS Visa Consultancy is here to assist
                            in locating the best housing options that guarantee comfort and affordability.</p>
                        <li>Travel</li>
                        <p class="content-description">Traveling is made comfortable with a great European transport system.
                            Students can thus explore their city and travel to neighboring countries by bus or train or
                            tram. These pieces of work appear more readily attainable for students due to hefty scholarships
                            and discounts, thus allowing enriching cultural experiences.</p>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    @include('./components/cta-button')

    <!-- faqs   -->
    @php
        $faqs = [
            [
                'question' => '1. Does it Mean Europe Is Safe for International Students?',
                'answer' => 'Indeed, Europe is one of the safest venues for international students. Low crime rates, coupled with exceptionally developed public safety systems in most European countries, prove the point. Campuses also offer security and support concerning student safety. The WTS Visa Consultancy advises you on safety guidelines and local resources during emergencies.'
            ],
            [
                'question' => '2. What Are the Career Opportunities after Studying in Europe?',
                'answer' => 'European universities graduate students, who, by and large, are known to have the best career options because their degrees are highly regarded by employers the world over. WTS Visa Consultancy helps you discover job opportunities, prepares you for interviews, and is likely to set you up with applicants.'
            ],
            [
                'question' => '3. Are There Scholarships Available for International Students in Europe?',
                'answer' => 'Yes, available scholarships exist for international students, such as merit-based, need-based, and government-funded scholarships. Probably one of the most popular sources for funding is the Erasmus+ program. WTS Visa Consultancy assists you in finding and applying for scholarships to reduce your study expenses.'
            ],
            [
                'question' => '4. How Long Does it Take to Get a Student Visa for Europe?',
                'answer' => 'European student visa processing times could vary from country to country, but generally take four to twelve weeks. It is advisable to apply early in order to avoid any last-minute rush. The entire visa work and study in Europe process is managed by WTS Visa Consultancy to ensure approval is obtained within the stipulated time. '
            ],
            [
                'question' => '5. When Is the Right Time to Apply to European Universities?',
                'answer' => 'Different universities in various countries have different application deadlines. Generally, the deadline for fall semester applications is between January and April, while that for spring semester applications is between August and November. One can have a customized timeline specific to him or her to ensure he or she meets all deadlines for admittance into their program of choosing through WTS Visa Consultancy.'
            ],
        ];

    @endphp

    <x-faq :faqs="$faqs" />


@endsection