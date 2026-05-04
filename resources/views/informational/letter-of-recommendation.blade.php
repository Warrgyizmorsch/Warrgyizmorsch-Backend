@extends('layouts.app')

@section('content')

    <style>
        .hero-main {
            background-color: #F7F4EF !important;
            padding: 20px 0 !important;
        }

        .hero-form {
            position: relative;
            margin-left: 0;
            margin-right: auto;
            top: 0;
        }

        .map-container {
            position: relative;
        }


        @media (max-width: 768px) {
            .hero-content-wrapper {
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 30px !important;
            }

            .hero-title {
                font-size: 26px;
            }

            .hero-tip {
                font-size: 15px;
            }

            .hero-cta {
                font-size: 15px;
                padding: 12px 24px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .home-hero-content {
                width: 95%;
            }

        }

        .features {
            flex-direction: column
        }
        .feature {
            text-align: start;
        }
        @media (max-width: 768px) {
            .feature {
                justify-content: start;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 22px;
            }

            .hero-tip {
                font-size: 14px;
            }

            .hero-cta {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
    <style>
        .heading-wrapper {
            max-width: 1200px !important;
            margin: 0 auto
        }

        .sop-samples {
            background: #f5f7fc61;
            color: #fff;
            text-align: center;
            padding: 40px 20px;
        }



        /* Fixed 2 rows × 3 columns */
        .sample-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .sample-card {
            background: #fff;
            color: #222;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .sample-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 204, 0, 0.15), transparent);
            transition: 0.5s;
        }

        .sample-card:hover::before {
            left: 100%;
        }

        .sample-card:hover {
            transform: translateY(-10px);
        }

        .sample-card-icon {
            font-size: 40px;
            color: #fff;
            background: var(--primary-color);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .sample-card:hover .sample-card-icon {
            background: #222;
            color: #ffcc00;
            transform: rotate(15deg);
        }

        .sample-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .sample-card p {
            font-size: 0.95rem;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sample-container {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }
        }

        @media (max-width: 600px) {
            .sample-container {
                grid-template-columns: 1fr;
            }



            .sample-card-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
        }
    </style>
    <style>
        /* Wrapper for new sections */
        .abroad-section-wrapper {
            padding: 40px 0;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header style same as previous sections */
        .abroad-section-header {
            margin-bottom: 20px;
        }

        /* Bullets styling */
        .abroad-feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .abroad-feature-list li {
            display: flex;
            align-items: flex-start;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .abroad-feature-list li i {
            font-size: 20px;
            margin-right: 10px;
            margin-top: 2px;
        }

        /* Distinguish icons */
        .problem-icon {
            color: #e63946;
            /* red - problem */
        }

        .solution-icon {
            color: #0abf53;
            /* green - solution */
        }

        /* Tip / bottom text */
        .abroad-tip {
            display: block;
            margin-top: 20px;
            font-style: italic;
            color: #555;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .abroad-problem-item h3 {
                font-size: 18px;
            }
        }

        /* Wrapper */
        .abroad-table-wrapper {
            margin-top: 20px;
            overflow-x: auto;
        }

        /* Table styling */
        .abroad-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .abroad-table thead {
            background: var(--primary-color);
            color: #fff;
        }

        .abroad-table th,
        .abroad-table td {
            padding: 14px 18px;
            text-align: left;
            font-size: 16px;
            vertical-align: top;
        }

        .abroad-table tbody tr:nth-child(even) {
            background: #f7f7f7;
        }

        .abroad-table tbody tr:hover {
            background: #f0f4ff;
        }

        /* Icons */
        .problem-icon {
            color: #e63946;
            margin-right: 8px;
            font-size: 18px;
        }

        .solution-icon {
            color: #0abf53;
            margin-right: 8px;
            font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 600px) {

            .abroad-table th,
            .abroad-table td {
                font-size: 14px;
                padding: 10px 12px;
            }
        }
    </style>

    <style>
        .financial-table-wrapper {
            margin-top: 25px;
            overflow-x: auto;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e6e6e6;
        }

        .financial-table thead {
            background: #f7f8ff;
        }

        .financial-table th,
        .financial-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ececec;
            text-align: left;
        }

        .financial-table th {
            font-weight: 600;
            color: #222;
            font-size: 15.5px;
        }

        .financial-table td {
            line-height: 1.55;
            color: #444;
        }

        .financial-table tbody tr:last-child td {
            border-bottom: none;
        }

        .financial-table tbody tr:hover {
            background: #fafbff;
        }

        .financial-bottom-note {
            margin-top: 25px;
            padding: 18px;
            background: #f9faff;
            border-left: 4px solid #fc9118;
            border-radius: 10px;
        }

        .financial-bottom-note h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        @media (max-width: 600px) {

            .financial-table th,
            .financial-table td {
                padding: 12px 14px;
                font-size: 14px;
            }

            .new-journey-header p {
                font-size: 15px;
            }

            .financial-bottom-note {
                padding: 15px;
            }
        }
    </style>
    <style>
        .herov1-btn {
            background-color: rgb(252, 145, 24);
            color: white;
            display: block;
            margin: 1rem auto 2.5rem;
            width: fit-content;
            font-weight: 500;
            box-shadow: rgba(252, 145, 24, 0.4) 0px 3px 10px;
            padding: 8px 16px;
            border-radius: 11px;
            text-decoration: none;
            overflow: hidden;
            transition: 0.4s;
        }

        .herov1-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: rgba(252, 145, 24, 0.6) 0px 6px 15px;
            background-position: right center;
        }
    </style>

    <style>
        .financial-table-wrapper {
            margin-top: 20px;
            overflow-x: auto;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e6e6e6;
        }

        .financial-table thead {
            background: #f7f8ff;
        }

        .financial-table th,
        .financial-table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ececec;
            text-align: left;
            font-size: 15.5px;
        }

        .financial-table td {
            color: #444;
            line-height: 1.55;
        }

        .financial-table tbody tr:hover {
            background: #fafbff;
        }

        .financial-bottom-note {
            margin-top: 25px;
            padding: 20px;
            background: #f9faff;
            border-left: 4px solid #fc9118;
            border-radius: 10px;
        }

        .financial-bottom-note h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        @media (max-width: 600px) {

            .financial-table th,
            .financial-table td {
                padding: 12px 14px;
                font-size: 14px;
            }
        }
    </style>
    <!-- Hero section  -->
    <section id="bookingSection" class="hero-main">
        <div class="swiper-wrapper">
            <!-- Single Slide -->
            <div class="swiper-slide">
                <div class="hero-content-wrapper">
                    <div class="home-hero-content">

                        <h1 class="hero-title">Maximise Your Success: Expert Letter of Recommendation (LOR) Guidance</h1>
                        <p style="text-align: start;">A strong LOR can elevate your study abroad application by showcasing your true potential beyond
                            scores and documents. Our expert support ensures every LOR is authentic, impactful, and aligned
                            with global admission standards.</p>

                        <!-- Features Section -->
                        <div class="features">
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Strategic LOR guidance from experts</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Tailored for top global universities</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Ensures authenticity and professionalism</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Increases admission & visa success</strong>
                            </div>
                        </div>
                        <span class=tip>
                            Stand out with compelling recommendations that speak for you.
                        </span>

                    </div>

                    <div class="hero-form">
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- New Journey  -->
    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Understanding the LOR’s Critical Role in Study Abroad</h2>
        </div>
        <h3>The Indispensable Value of Third-Party Endorsement</h3>
        <p>
            A Letter of Recommendation, often interchangeably referred to as a Reference Letter, is a formal document
            written by a qualified individual-typically a professor, academic advisor, supervisor, or employer-who has
            observed your academic or professional performance firsthand.
            <br>While your Statement of Purpose (SOP) conveys your personal motivation and future goals, and your resume/CV
            lists your objective achievements, the LOR fulfils a unique function. It provides credible, external validation
            of the claims you make about yourself.
        </p>

        <h4 style="margin-top: 1rem;">Why a Strong LOR is Non-Negotiable:</h4>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>1. Validation and Authenticity: </b>It confirms the veracity of your talents and achievements through
                    the trusted voice of an academic or industry professional.</p>
            </div>
            <div class="feature">
                <p><b>2. Qualitative Insight: </b>It moves beyond quantitative metrics (GPA, test scores) to discuss your
                    subjective qualities, such as critical thinking, leadership, resilience, and curiosity.</p>
            </div>
            <div class="feature">
                <p><b>3. Demonstrating Fit and Potential: </b>It helps the Admissions Committee assess not just what you
                    have achieved, but what kind of student and future professional you will become-and how well you will
                    contribute to their campus community.</p>
            </div>
            <div class="feature">
                <p><b>4. Competitive Differentiation: </b>In highly sought-after programs (like MS in Computer Science, MBA,
                    or Health Sciences) where thousands of applicants possess similar high academic scores, a detailed,
                    specific, and enthusiastic LOR is often the deciding factor that tips the scales in your favor.</p>
            </div>
        </div>

        <p><b>WTS Experience:</b> A vague, rushed, or generic LOR-one that simply states the student is “hardworking”
            without concrete evidence-is a missed opportunity that can seriously undermine an otherwise stellar application.
            Our service is designed to transform these weak documents into high-impact testimonials.</p>


    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">The WTS Visa Consultancy LOR Advantage: Strategy, Specificity, and Compliance</h2>
            <p>The challenge for most applicants lies not in finding someone to write the letter, but in ensuring that the
                recommender writes a strategic, impactful, and compliant letter that aligns with the requirements of top
                global universities. Our expertise, honed through years of successful placements in competitive institutions
                worldwide, addresses these challenges directly.</p>
        </div>
        <h3>Strategic Content Alignment: Going Beyond the Generic</h3>
        <p>
            At WTS Visa Consultancy, we believe every LOR must be a strategic document that complements the holistic
            application narrative:
        </p>

        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>Complementary Narratives: </b>The LOR should avoid simply restating the resume. We guide the student
                    to identify new, specific examples of their skills or achievements that have not been discussed at
                    length in the SOP or CV, adding layers of insight to the profile.</p>
            </div>
            <div class="feature">
                <p><b>Program Specificity: </b>LORs must be tailored to the program. An LOR for an MBA applicant must
                    highlight leadership, team management, and strategic thinking, while an LOR for a PhD applicant must
                    emphasise research methodology, analytical rigour, and independent thought. We provide the essential
                    guidance to ensure the recommender focuses on the most relevant traits.</p>
            </div>
            <div class="feature">
                <p><b>The Power of Anecdote: </b>Generic praise is ineffective. We help the student brief their recommender
                    with specific, measurable, and memorable anecdotes that illustrate a quality. For example, instead of
                    "She is a good leader," the LOR should state, "She demonstrated exceptional leadership when she
                    restructured the senior design project workflow, leading to a 25% reduction in project completion time."
                </p>
            </div>
        </div>

        <h3>Recommender Selection and Briefing Mastery</h3>
        <p>The strength of the LOR is inseparable from the person who writes it. Our service begins with strategic planning:
        </p>

        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>Optimal Recommender Identification: </b>We advise on the best-suited individuals (e.g., a thesis
                    advisor over a generic lecturer, or a direct supervisor over an HR manager) who can speak most
                    accurately and persuasively to your academic or professional strengths relative to the target course.
                </p>
            </div>
            <div class="feature">
                <p><b>Customised Briefing Package: </b>We equip you with a tailored brief for your recommender. This package
                    includes your SOP draft, your current CV, the university's LOR guidelines, and a list of 3-5 key
                    achievements/personality traits you need them to emphasise. This ensures their letter is perfectly
                    targeted and not a generalised template.</p>
            </div>
        </div>

        <h3>Compliance and Format Guarantee</h3>
        <p>Global institutions and visa authorities have strict requirements regarding the format and submission of LORs.
            Leveraging our deep knowledge of immigration and university processes across the countries we serve (Canada,
            USA, UK, Australia, etc.), we guarantee compliance:</p>

        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>Format Verification: </b>We confirm the LOR adheres to the required structure: official letterhead,
                    formal tone, clear designation and contact information of the recommender, and correct addressing to the
                    Admissions Committee or specific faculty member.</p>
            </div>
            <div class="feature">
                <p><b>Submission Protocol: </b>Many universities require LORs to be submitted directly by the recommender
                    via an online portal or sealed, signed envelope. We clearly outline these protocols, guiding the student
                    and the recommender through the correct process to prevent technical rejection.</p>
            </div>
            <div class="feature">
                <p><b>Authenticity Checks: </b>Given the sensitivity of LORs, we verify that the document includes all
                    necessary authentication elements, such as the recommender’s seal, signature, and institutional contact
                    details, crucial for any subsequent verification calls.</p>
            </div>
        </div>
    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">Our Systematic LOR Success Process</h2>
            <p>
                We have a systematic and streamlined process, part of the comprehensive support structure WTS provides, to
                ensure your LORs are managed efficiently and expertly.
            </p>
        </div>

        <h3>Step 1: Profile & Program Analysis</h3>
        <p>A dedicated WTS expert conducts an in-depth review of your academic history, professional experience, and the
            specific requirements of your chosen programs (e.g., whether they prefer two academic LORs or one academic and
            one professional). This step defines the core narrative for each letter.</p>

        <h3>Step 2: Recommender Strategy Session</h3>
        <p>We hold a strategic session to finalise your list of recommenders and assign specific focus areas to each one
            (e.g., Professor A focuses on research; Supervisor B focuses on leadership). This avoids overlap and ensures a
            holistic endorsement.</p>

        <h3>Step 3: Content Drafting and Review Support</h3>
        <p>We assist the student in organising the high-impact content points and reviewing the draft provided by the
            recommender. Our review focuses on:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Clarity and formal tone.</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>The inclusion of specific evidence over generic praise.</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Alignment of the letter's claims with your SOP and overall profile.</p>
            </div>
        </div>

        <h3>Step 4: Final Compliance and Readiness Check</h3>
        <p>Before submission, we conduct a meticulous final check:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Verification of official letterhead, correct word count (typically 200-400 words), and appropriate
                    closing statements.</p>
            </div>
            <div class="feature">
                <i class="fa-solid fa-check-circle"></i>
                <p>Confirmation of the recommender's willingness and ability to submit the letter directly according to the
                    university’s online procedure.</p>
            </div>

        </div>


    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">LOR Types and Key Elements We Perfect</h2>
            <p>
                Not all recommendation letters are created equal. Our service provides specialised support for the varying
                types required for different applications:
            </p>
        </div>

        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>LOR Type</th>
                        <th>Ideal Recommender</th>
                        <th>Essential Content Focus</th>
                        <th>WTS Strategy</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Academic LOR</td>
                        <td>Professor, HOD, Thesis Advisor</td>
                        <td>Critical thinking, academic rigour, research potential, class rank, and project leadership.</td>
                        <td>Focus on comparative ranking (e.g., "top 5% of class") and specific project results.</td>
                    </tr>
                    <tr>
                        <td>Professional LOR</td>
                        <td>Manager, Supervisor</td>
                        <td>Work ethic, leadership, team management, conflict resolution, strategic contribution, and
                            initiative.</td>
                        <td>Emphasise business impact and project ownership using industry metrics.</td>
                    </tr>
                    <tr>
                        <td>Research LOR</td>
                        <td>Project Guide, Research Mentor</td>
                        <td>Lab or fieldwork experience, innovation, analytical skills, and ability to design and execute
                            research.</td>
                        <td>Highlight methodology proficiency and the novelty of the research contribution.</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <h3>Key Elements of a Strong WTS-Guided LOR:</h3>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>1. Clear Relationship Statement: </b>The letter must start by clearly defining the recommender's role
                    and the nature and duration of their interaction with the applicant.</p>
            </div>
            <div class="feature">
                <p><b>2. Specific Observations & Achievements: </b>The body paragraphs must contain evidence. We push for
                    tangible proof, not abstract claims.</p>
            </div>
            <div class="feature">
                <p><b>3. Course Relevance and Fit: </b>The LOR must explicitly state why the student is a perfect candidate
                    for this specific program at this specific university.</p>
            </div>
            <div class="feature">
                <p><b>4. Enthusiastic Endorsement: </b>The conclusion should contain a clear, powerful endorsement,
                    expressing strong confidence in the applicant’s potential for success abroad.</p>
            </div>
        </div>

    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Common LOR Mistakes We Guarantee to Avoid</h2>
            <p>
                Many applications fail due to easily avoidable LOR errors. Our robust checking process eliminates these
                risks:
            </p>
        </div>

        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Common Mistake</th>
                        <th>How WTS Prevents It</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Being Too Generic</td>
                        <td>Insisting on evidence-based anecdotes and quantifiable achievements in the briefing stage.</td>
                    </tr>
                    <tr>
                        <td>Repeating Resume/SOP Content</td>
                        <td>Review the draft against your SOP to ensure the LOR introduces new, complementary insights.</td>
                    </tr>
                    <tr>
                        <td>Inaccurate Format/Protocol</td>
                        <td>Thorough check for official letterhead, proper addressing, signature, and adherence to the
                            university's specific online submission system.</td>
                    </tr>
                    <tr>
                        <td>Overly Promotional Language</td>
                        <td>Ensuring a professional, balanced, and realistic tone that admissions officers trust more than
                            over-exaggeration.</td>
                    </tr>
                    <tr>
                        <td>Lack of Program Focus</td>
                        <td>Verifying that the skills highlighted (e.g., communication) are relevant to the specific field
                            (e.g., business communication for an MBA).</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Our Commitment to End-to-End Success</h2>
            <p>
                The LOR service is an integral part of WTS Visa Consultancy’s holistic approach. We are the company that
                started with a devotion to student visa excellence and evolved into a comprehensive study abroad partner.
                Our expertise covers every facet of your journey:
            </p>
        </div>

        <ul style="padding-left:2rem;">
            <li>Customised profile evaluation and university selection.</li>
            <li>Expert SOP and LOR content guidance.</li>
            <li>Precise visa documentation and interview preparation.</li>
            <li>Post-landing services, including accommodation and acclimatisation support.</li>
        </ul>

        <p style="margin-top: 1rem;"><b>We are abreast with the latest immigration requirements and regulations across all
                the countries we serve, ensuring that your meticulously prepared LORs and your entire application package
                are compliant and positioned for the highest possible success rate.</b></p>
    </section>


    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Get Started with Your Winning Application Today!</h2>
                <p style="color: #000;">Make your LOR a strong asset, not just a formality. WTS Visa Consultancy helps you
                    craft impactful recommendations and guides you through every step of your admission and visa journey.
                    Contact us today.</p>
                <a href="#registrationModals" class="herov1-btn smooth-scroll-btn" style="margin: 0px; color: #000;">
                    Get Free Consultation
                </a>
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scrollBtns = document.querySelectorAll('.smooth-scroll-btn');

            scrollBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const target = document.querySelector('#registrationModals');
                    const offsetTop = target.offsetTop;

                    window.scrollTo({
                        top: offsetTop - 20,   // adjust -20 if needed
                        behavior: "smooth"
                    });
                });
            });
        });
    </script>


@endsection