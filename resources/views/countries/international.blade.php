@extends('layouts.app')
@section('content')

    <section class="service-hero">
        <div class="service-hero-content">
            <h1 class="main-heading">Study at Top Global Universities Worldwide</h1>
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
                <p>The study is primarily about international parameters where quality education, cultural diversity, and
                    promising global career prospects play prime roles. WTS Visa Consultancy deals with the provision of
                    expert guidance in university selection, application, visas, and finances to help students realize their
                    dreams of studying abroad. International universities are a good option for students who wish to build
                    their careers since they have world-class education, advanced best universities to study abroad,
                    research facilities, and globally accepted degrees. Besides, students would study abroad in culturally
                    diverse settings, where they expect to learn communication skills and network with people from different
                    backgrounds. This experience not just enhances their academic knowledge but also develops their best
                    scholarships for international undergraduate students personality and independence skills. Global market
                    demand for professions has always been on the rise, making an international degree a leap into an
                    enhanced career. At WTS Visa Consultancy, we assure that students get support at every level to ensure
                    an easy transition to their favourite university. </p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/international-university.jpg" loading="lazy" alt="Study in all University">
            </div>
        </div>
    </section>

    <!-- choose us section -->
    @php
        $sectionTitle = 'Why Study at an International University?';
        $sectionDescription = 'Going to an international university enables a student to get near world-class education and intercultural experiences that would offer an avenue not only for personal but professional development. This would not only be up to academics because with the study of different leading international university cultures, it would also expose them to high-caliber research environments and lucrative career top fully funded scholarships for international students possibilities beyond just classification. In a condensed form, here are the key benefits that studying at an international university has:';

        $cards = [
            ['title' => '1. Education Quality at the Best-Ranked Universities', 'desc' => 'Degree Global Recognition One could fully assure this degree would be internationally recognized if enrolled in a reputable university overseas. These degrees are well respected across all world universities and employers therefore, it can offer graduates far better chances of getting employed or continuing education. Modern Infrastructure and Advanced Research Top international universities built their reputation through progressively enhancing infrastructural facilities, laboratories, libraries, and innovations to foster effective high-level research. Highly Qualified Faculty Students learn from experienced professors, many of whom are globally renowned researchers and industry experts. This allows students to gain knowledge from those actively shaping their fields.'],
            ['title' => '2. Multicultural Exposure and Cross-Cultural Skills', 'desc' => 'Diverse Student Body Just the nature of international universities brings students from different backgrounds, cultures, and nationalities to study, which imparts more cultural awareness and develops an inclusive environment. Improved Cross Cultural Communication Such engagement will usually enable students to develop capabilities for communicating and working together in a multicultural environment, which is a great asset in today\'s globalized labor market. Personal Growth and Flexibility It teaches students to appreciate different perspectives, making them more adaptable in the many situations that arise from being within a diverse student community being the one who meets many top fully funded scholarships for international students\' expectations. '],
            ['title' => '3. Career Opportunities and Hands-On Experience', 'desc' => 'Internships and Work Placements Most international universities conduct properly structured internship programs and industry placements for students to gain practical experience during their studies. Research Opportunities Students are given the opportunity to work on high-grade research projects along with world-renowned scientists and industry experts and, more importantly, make a difference in their career advancements. Edge on the Employment Market Due to their encounter with an array of work cultures and adaptability, most employers would consider them an asset; hence there will be many likes of international graduates in today\'s job market.'],
            ['title' => '4. Facing Study Abroad Challenges', 'desc' => 'Living In A Foreign Country permits students to develop tougher skins to survive somewhere else whilst trying to keep life and finances together on an independent basis, thus building up resilience.  Developing Problem-Solving Skills Experiences outside the home help to broaden a student\'s horizon, thus developing the very ability of problem-solving which is truly one of the foremost contingencies of personal and professional development.  Uplifting Self-esteem The confidence-building aspect of this overseas study experience contributes to the independence of students, thus preparing them for their careers and personal life in the future.'],
            ['title' => '5. Improved Career Prospects and Global Networking', 'desc' => 'Higher Employable Quotient Most employers across the globe seek candidates with international degrees as such graduates leading international universities are presumed to have been exposed to workplace diversity and have honed their skills to the utmost.  Global Professional Network Studying abroad includes creating a wide global professional network with a peer group, professors, and industry leaders.  Global Career Access The general consensus is that a graduate from an international university has better chances than a local university counterpart of being accessed and tracked for multinationals as well as students who want a career touching these areas. '],
            ['title' => '6. WTS Visa Consultancy\'s Guidance', 'desc' => 'Personalized University Selection WTS Visa Consultancy helps students sift through hundreds of universities to find the best match for their academic background, career aspirations, and financial concerns.  Application and Scholarship Support Expert guidance is provided by the consultancy with reference to admission, scholarships, and financial assistance in making the application procedure smooth.  To ensure Support for a Successful: International Education Journey. This consultancy looks after anything and everything A-Z with respect to student requirements, including visa application assistance and settling in a foreign land, ensuring smooth transition.'],
        ];
    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />

    <!-- stats section  -->
    @include('./components/stats')

    <!-- universities section -->
    @php
        $universities = [
            [
                'name' => 'Harvard (USA)',
                'logo' => 'images/universities/Harvard-Logo.webp',
                'course' => 'Science & Medicine',
                'ranking' => 1
            ],
            [
                'name' => 'Stanford (USA)',
                'logo' => 'images/universities/Stanford_University_Logo.webp',
                'course' => 'Engineering & Technology',
                'ranking' => 2
            ],
            [
                'name' => 'Massachusetts Institute of Technology (MIT) (USA)',
                'logo' => 'images/universities/MIT_logo.webp',
                'course' => 'Engineering & Physical Sciences',
                'ranking' => 6
            ],
            [
                'name' => 'University of Oxford (UK)',
                'logo' => 'images/universities/Oxford-University.webp',
                'course' => 'Economics & Political Science',
                'ranking' => 45
            ],
            [
                'name' => 'University of Cambridge (UK)',
                'logo' => 'images/universities/cambridge-logo.webp',
                'course' => 'Arts & Humanities',
                'ranking' => 22
            ],
            [
                'name' => 'University of Toronto (Canada)',
                'logo' => 'images/universities/toronto.webp',
                'course' => 'Health & Life Sciences',
                'ranking' => 40
            ],
            [
                'name' => 'Singapore\'s National University (NUS)',
                'logo' => 'images/universities/NUS.webp',
                'course' => 'Business & Law',
                'ranking' => 32
            ],
            [
                'name' => 'Australian National University (ANU)',
                'logo' => 'images/universities/ANU_Logo.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
            [
                'name' => 'ETH Zurich (Switzerland)',
                'logo' => 'images/universities/zurich.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
            [
                'name' => 'University of Melbourne, Australia',
                'logo' => 'images/universities/Melbourne_Logo.webp',
                'course' => 'Science & Engineering',
                'ranking' => 61
            ],
        ];
        $universitySection = [
            'heading' => 'Top International Universities',
            'highlight' => 'for Global Students',
            'sub_heading' => 'Students should weigh different factors such as ranking, faculty interest, research opportunities, and employment before selecting an international university. An otherwise ranked university with faculty and research programs of high calibre enhances the learning experience in total. The prospects of a top global universities also refer to future jobs and professional development because good career prospects might derive from industry connections. Some of the top universities in the world that keep drawing students from every corner of the globe are: ',
            'footer' => 'These are world-renowned universities with a reputation for academic excellence and contributions to research as well best international scholarships as partnerships with industry, making them ideal for students looking to establish themselves well in their careers.'
        ];
    @endphp

    <x-universities :universities="$universities" :universitySection="$universitySection" />

    <!-- course section  -->
    @php
        $courses = [
            ['title' => 'Business & Management (MBA, Finance, Marketing and Entrepreneurship)', 'image' => 'images/courses/business.jpg'],
            ['title' => 'Engineering & Technology (Mechanical, Civil, Electrical and Computer Engineering)', 'image' => 'images/courses/engineering.jpg'],
            ['title' => 'Medical & Health Sciences (Medicine, Pharmacy, Nursing and Biomedical Sciences)', 'image' => 'images/courses/medicine.jpg'],
            ['title' => 'Computer Science & IT (Artificial Intelligence, Data Science, Cyber security, and Software Development)', 'image' => 'images/courses/computer.jpg'],
            ['title' => 'Law and International Relations (Human Rights, Corporate Law and Global Governance)', 'image' => 'images/courses/law.jpg'],
            ['title' => 'Hospitality & Tourism (Hotel Management, Travel & Tourism and Culinary Arts)', 'image' => 'images/courses/hospitality.jpg'],
            ['title' => 'Media & Communication (Journalism, Digital Marketing, and Film Production)', 'image' => 'images/courses/pharma.jpg'],
        ];
        $courseContent = [
            'title' => 'Subjects Offered by Internationally Relevant Universities',
            'desc' => 'There are many courses, international universities have. But these courses provide world industry-required knowledge for students. Business managers, engineering, computer science, medicine, finance, and hospitality are all the main courses on offer to students. Well, these programs improve the list of top universities worldwide for career opportunities. It allows student’s guidance-through knowledge and skills needed to make their way into competitive jobs worldwide. Some of the more popular ones include:',
            'footer' => '',
        ];
    @endphp

    <x-courses :courses="$courses" :title="$courseContent['title']" :desc="$courseContent['desc']"
        :footer="$courseContent['footer']" />


    <!-- cost of living section  -->
    @php
        $countryWiseCost = [
            ['country' => 'USA', 'tuition_fee' => '$20,000–$50,000', 'living_cost' => '$12,000–$18,000'],
            ['country' => 'UK', 'tuition_fee' => '£10,000–£40,000', 'living_cost' => '£10,000–£15,000'],
            ['country' => 'Canada', 'tuition_fee' => 'CAD 15,000–CAD 40,000', 'living_cost' => 'CAD 10,000–CAD 15,000'],
            ['country' => 'Australia', 'tuition_fee' => 'AUD 20,000–AUD 45,000', 'living_cost' => 'AUD 18,000–AUD 25,000'],
            ['country' => 'Germany', 'tuition_fee' => 'Free (Public Universities)', 'living_cost' => '€10,000–€15,000'],
            ['country' => 'France', 'tuition_fee' => '€3,000–€15,000', 'living_cost' => '€10,000–€15,000'],
        ];
        $description = "The cost of studying abroad will depend on the country, the university, and individual lifestyle choices. Tuition fees for international best scholarship for international students are program-and institution-specific on the other hand, living costs will account for accommodation, food, travel, and personal expenses. Here is a rough estimate of a few popular study destinations:";

        $ukCostOfLiving = [
            'heading' => 'Tuition Fees and Living Cost in Various Countries',
            'description' => '',
            'highlights' => [
                'accommodation' => '$1500 up to $2500 per month',
                'food' => '$1500 up to $2500 per month',
                'transportation' => '$1500 up to $2500 per month',
                'note' => 'assists students in financial planning and scholarship searches.',
                'consultancy' => 'WTS Visa Consultancy'
            ]
        ];
        $livingFees = [
            ['label' => 'Housing', 'value' => '€8,000 - 15,000', 'note' => 'Shared accommodation reduces cost'],
            ['label' => 'Food', 'value' => '€4,000 - 6,000', 'note' => 'Home cooking is economical'],
            ['label' => 'Transportation', 'value' => '€1,200 - 2,000', 'note' => 'Student travel concessions available'],
            ['label' => 'Personal Expenses', 'value' => '€3,000 - 4,000', 'note' => 'Includes utilities and leisure'],
            ['label' => 'Total', 'value' => '€20,000 - 25,000', 'note' => 'Costs vary by city'],
        ];
        $ukCostOfLivingRight = [
            'heading' => 'Living Expenses in Abroad for Indian Students',
            'description' => 'The study in Abroad cost for Indian students also includes living expenses, which vary by city and lifestyle. On average, students spend between €20,000 - 25,000 per year.',
        ];
    @endphp
    <x-cost-of-living :countryWiseCost="$countryWiseCost" :description="$description" :ukCostOfLiving="$ukCostOfLiving"
        :livingFees="$livingFees" :ukCostOfLivingRight="$ukCostOfLivingRight" />

    <!-- scholarship section -->
    @php
        $scholarship = [
            'title' => 'Scholarships & Financial Assistance for International Students',
            'desc' => 'International students face heavy expenses in tuition and living costs. To ease their burden in any way necessary, many universities and organizations also offer scholarships and financial aid. Scholarships are awarded based on academic merit, financial need, or certain abilities. The following are examples of scholarships that are widely known:',
            'footer' => '',
            'guide_title' => '',
            'guide_steps' => [
                'Fulbright Scholarship (USA) – Pertains to international students seeking graduate studies.',
                'Chevening Scholarship (UK) – A fully-funded scholarship allocated to postgraduate students.',
                'Canada Government Scholarships – Any funding opportunities are available to international students.',
                'Australia Awards Scholarships – Government scholarships for students from developing nations.',
                'DAAD Scholarships (Germany) – Open to postgraduate-level studies in German universities.',
                'Eiffel Excellence Scholarship (France) – For Master\'s and Ph.D. students.',
            ],
            'image' => 'images/scholarships.png'
        ];
    @endphp
    <x-scholarship :scholarship="$scholarship" />

    <!-- document section -->
    @php
        $documentContent = [
            'title' => 'Documents Required for Study Abroad',
            'desc' => 'Applying to international universities calls for specific documents to satisfy admission and visa requirements. These documents consist of: ',
            'list' => [
                'Academic transcripts and certificates for either high school or bachelor or master\'s degree.',
                'Proof of English language proficiency for example IELTS/TOEFL/PTE.',
                'Standardized test scores such as SAT, GRE, GMAT depending on the program.',
                'Statement of Purpose (SOP) outlining one\'s academic goals and career aspirations. ',
                'Letters of Recommendation (LoRs) from professors or employers.',
                'Updated resume/CV outlining education and work experience and qualification.',
                'A valid passport with a minimum remaining validity of six months. ',
                'Proof of financial stability (bank statements, scholarship acceptance letters, or sponsorship documents).',
                'Medical certificate and health insurance (if required by the country).',
                'Student visa application form along with requisite supporting documents.',
            ]
        ];

        $guideContent = [
            'title' => 'Student Visa Process for Studying in Globally Established Universities',
            'desc' => 'Receiving a student visa is an important procedure when studying abroad. The visa process usually entails satisfaction of best scholarship websites for international students eligibility requirements, documentation preparation, application submission, interview (if required) attendance, and waiting for approval. Each country has distinct regulations regarding visa application procedures, and therefore students must follow each of these steps closely in order to apply successfully.',
            'list' => [
                'Receive an Offer – The University must accept you for you to apply for the visa.  ',
                'Prepare Required Documents – Gather all the required documents for application, such as a valid passport, an acceptance letter from the university, proof of funds, a medical certificate, and the application form for the visa. ',
                'Settle Visa Fee – The visa fee varies from country to country (for example, it is $160 for the USA, £490 for the UK, and CAD 150 for Canada).',
                'On-Campus Interview – Some countries may require interviews at their embassy or consulate. ',
                'Visa Processing & Approval – The processing period depends on the country and the validity of the application.',
            ]
        ];
    @endphp
    <x-documents :documentContent="$documentContent" :guideContent="$guideContent" />

    <!-- Scrollale Section  -->

    <section class="column-section">
        <div class="column-container">
            <div class="column">
                <div class="content-box">
                    <h2 class="service-heading">World's Best Countries for Higher Education</h2>
                    <p class="content-description">The selection of the nation for pursuing higher education requires a
                        critical evaluation of many aspects; these include rankings of universities available, the cost of
                        living, job opportunities, and quality of education as a whole. A student will research institutions
                        worthy to study at, keeping in mind his or her academic and career goals. Different countries offer
                        different costs of living to top ranked universities worldwide thus, it is important to budget for
                        accommodation, food, and several other expenses. Work opportunities, at the same time with studies,
                        become subjective while practical and emotional financial support is concerned. The quality of
                        education, teaching experiences, and research facilities here present major parts of the evaluation
                        for a satisfying academic life that leads to career success. Some of those countries are:</p>
                    <ul>
                        <li>United States – Home to Ivy League institutions and top research universities.</li>
                        <li>United Kingdom – Offers world-class education with classy academic history.</li>
                        <li>Canada – Tuition fees are not too much, culturally very diverse, and work opportunities after
                            study. </li>
                        <li>Australia – Their education system is of very high quality and the visa policies are
                            student-friendly.</li>
                        <li>Germany – Provides public universities with tuition free education and brilliant research
                            opportunities.</li>
                        <li>France – One of the prestigious institutions with excellent programs in business and
                            engineering. </li>
                        <li>Netherlands - Renders a good quality of education. Many programs are available in English. </li>
                        <li>Singapore – Centre for global education with extensive industrial connections.</li>
                    </ul>
                </div>
                <div class="content-box">
                    <h2 class="service-heading">How to Choose an International University That's Right for You?</h2>
                    <p class="content-description">Choosing the best international university will require careful planning
                        and research. The first step best colleges for MBA abroad is for the students to set up career plans
                        to enable them to find a university with quality programs in the student's areas of interest. The
                        next area of interest should be rankings, specialization of faculty, and accreditation to ensure
                        that the institution meets global standards. Also, students look at the cost of education, which is
                        usually high when studying abroad, as well as tuition and living costs. They should also explore
                        options for funding best European universities for international students scholarships and/or
                        financial aid to cut costs. Furthermore, job placement rates, internships offers, and successful
                        stories of alumni are indicators that can help understand the industry connections of the
                        university. Knowing the visa processes, possibility of working and living style in the desired
                        country are also beneficial for students on how to adapt.</p>
                </div>

            </div>
            <div class="column">

                <div class="content-box">
                    <h2 class="service-heading">Application Process for International Universities</h2>
                    <p class="content-description">Applying to an international university is an exciting yet intricate
                        process requiring enormous planning and preparation. Some key steps must be observed to ensure one's
                        application success. From short listing a university to obtaining a student visa, each step here
                        plays an equally important role in making the study abroad procession. </p>
                    <p class="content-description">Key Steps</p>
                    <ul>
                        <li>Research and Selection - Search for universities according to academic goals, budget, and career
                            opportunities.</li>
                        <li>Admission Requirements - Check for GPA by programs, standardized tests (SAT, GRE, GMAT), and
                            English proficiency tests (IELTS, TOEFL).</li>
                        <li>Application Materials Preparation - A good SOP, LORs, and a resume updated to date. </li>
                        <li>Deadlines - Ensure that all applications are sent in time.</li>
                        <li>Interviews - Some universities may have interview procedures before confirming their final
                            decisions.</li>
                        <li>Acceptance and Formalities - When students are offered a place to study, they shall pay their
                            tuition fees and proceed with the student visa application process. </li>

                    </ul>
                </div>

                <div class="content-box">
                    <h2 class="service-heading">Work Opportunities for International Students Abroad</h2>
                    <p class="content-description">It is permissive for some countries to allow international students to
                        work while studying and meet expenses and gain work experience. The students can find part-time jobs
                        on campus or work in local establishments such as cafes, retail stores, and libraries. Many
                        internships and co-op programs provide best scholarships for international students industry-related
                        work experience, which adds to their profile. After graduation, students can apply for
                        post-graduation work permits in their respective countries for further professional experience in
                        their field.
                        Work hour limits vary from country to country. In the USA, UK, and Canada, students are allowed to
                        work for a maximum of 20 hours a week, while in Australia, the maximum is 40 hours every fortnight.
                        In Germany, the best universities for international students are allowed to work only 120 full days
                        or 240 half days a year. Later, graduates can assess the possibility of a work permit or pathway to
                        permanent residency according to the country’s immigration laws. This opportunity allows students to
                        build a firm base for their careers later on. </p>
                </div>

            </div>
        </div>
    </section>

    @include('./components/cta-button')

    <!-- faq section  -->
    @php
        $faqs = [
            [
                "question" => "1.	How Can I Apply for Permanent Residency (PR) after Studies Abroad?",
                "answer" => "Most countries offer the opportunity to obtain PR for international graduates. Students are often able to apply for post-study best universities for international students work permits (Canada PGWP, Australia Temporary Graduate Visa, etc.) to work in the respective country; subsequently, they may be able to apply for PR by fulfilling residency and employment requirements under programs such as Canada Express Entry, Australia Skilled Migration, and UK Graduate Route."
            ],
            [
                "question" => "2.	What Are Some Common Challenges Faced by International Students?",
                "answer" => "International students are often faced with culture shock and language barriers, while feeling isolated from their homes and experiencing financial strain. Other difficulties include adjusting to a new education system and work culture. However, universities offer support services, such as student groups and counselling, to facilitate this transition. At WTS Visa Consultancy, we prepare students for these difficulties in advance of their departure. "
            ],
            [
                "question" => "3.	Can International Students Work While Studying Abroad?",
                "answer" => "Absolutely! Most countries allow international students to work part-time during semesters and full-time during holidays. International students should check the working regulations of the host country. Eligible jobs include retail, hospitality, tutoring, or university campus jobs. Some programs offer paid internships that give students industry experience. "
            ],
            [
                "question" => "4.	How Much Does it Cost to Study at an International University?",
                "answer" => "The costs vary depending on the country, university, and the program of study. Tuition can range anywhere from $10,000 to $50,000 per academic year, with living expenses adding another $10,000 to $20,000 every year. Scholarships and part-time jobs and education loans help lighten the financial burden. Here at WTS Visa Consultancy, we help students find cheaper education alternatives."
            ],
        ];
    @endphp
    <x-faq :faqs="$faqs" />

@endsection