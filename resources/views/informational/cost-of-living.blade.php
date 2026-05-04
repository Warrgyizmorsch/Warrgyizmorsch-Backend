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

                        <h1 class="hero-title">Your Ultimate Study Abroad Cost of Living Guide</h1>
                        <p style="text-align: start;">Understand the real cost of living abroad and plan your finances smartly with clear, accurate,
                            and student-friendly insights.</p>

                        <!-- Features Section -->
                        <div class="features">
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Covers major student expenses</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Country-wise cost breakdown</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Practical budgeting tips</strong>
                            </div>
                            <div class="feature">
                                <i class="fa-solid fa-check-circle"></i>
                                <strong>Real-life student estimates</strong>
                            </div>
                        </div>
                        <span class=tip>
                            Plan confidently and make informed financial decisions for your study-abroad journey.
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
            <h2 class="new-section-title">Smart Financial Planning for a Smooth Visa Journey</h2>
            <p>
                Studying abroad is an investment in your future. At WTS Visa Consultancy, our core culture is based on
                honesty-we ensure you are never charged unjustified amounts and that you have a crystal-clear understanding
                of your financial commitments from day one.
                <br>
                Financial stability is not just a personal concern; it is the single most critical requirement for visa
                approval across all major study destinations. Our experts simplify the complex process of proving funds,
                helping you navigate official requirements with precision and confidence.
            </p>
        </div>

    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">The Non-Negotiable Financial Requirement (The Visa Gatekeeper)</h2>
            <p>
                Every study destination requires you to demonstrate that you possess sufficient funds to cover your tuition
                fees
                and living expenses for a set period. This is the Visa Financial Requirement, and it is the first hurdle we
                help
                you clear effortlessly. Failure to meet these exact figures and documentation standards is a leading cause
                of visa rejection.
            </p>
        </div>

        <h3>The Latest Minimum Living Fund Requirements (Excluding Tuition)</h3>
        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Annual/Monthly Minimum Requirement (Approx.)</th>
                        <th>Key Visa Condition & Documentation Rule</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Canada 🇨🇦</td>
                        <td>C$20,635/year (Single Student)</td>
                        <td>Funds must be available for at least 12 months. The funds must be held in your account for a
                            minimum of 30 consecutive days immediately before the application date.</td>
                    </tr>
                    <tr>
                        <td>Australia 🇦🇺</td>
                        <td>A$29,710/year (Single Student)</td>
                        <td>Must show funds to cover travel, 12 months of living costs, and tuition fees (minus any payments
                            already made). Funds must be genuine and accessible.</td>
                    </tr>
                    <tr>
                        <td>UK 🇬🇧</td>
                        <td>£1,334/month (London) or £1,023/month (Outside London)</td>
                        <td>Funds must cover the remaining balance of your first year’s tuition fee plus up to 9 months of
                            living costs. Funds must be held for 28 consecutive days ending no more than 31 days before the
                            application.</td>
                    </tr>
                    <tr>
                        <td>USA 🇺🇸</td>
                        <td>Varies (as per I-20 Form)</td>
                        <td>The required amount is detailed on the Form I-20 issued by your university and covers tuition
                            and a 9-month estimate of living costs. Documentation must prove the full amount is readily
                            available.</td>
                    </tr>
                    <tr>
                        <td>New Zealand 🇳🇿</td>
                        <td>NZ$20,000/year (Single Student)</td>
                        <td>Must show funds to cover your course duration or for a maximum of 12 months. Evidence must be
                            less than one month old at the time of submission.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="financial-bottom-note">
            <h3>WTS Visa Expertise: Financial Document Assurance</h3>
            <p>
                Our visa preparation services guarantee precise documentation. We provide a comprehensive checklist and
                perform extensive checks to ensure your financial proof (bank statements, education loan sanction letters,
                sponsorship affidavits) adheres to the country-specific duration rules (e.g., 28-day rule, 30-day rule),
                preventing the biggest cause of visa delays or denial.
            </p>
        </div>

    </section>

    <section class="new-journey-wrapper">

        <div class="new-journey-header">
            <h2 class="new-section-title">Beyond the Minimum - A True-Cost Budget Breakdown</h2>
            <p>
                The official minimum is a baseline to satisfy immigration. Your actual cost of living will depend heavily on
                your chosen city, accommodation style, and personal habits. We provide realistic estimates to help you
                create a sustainable budget.
            </p>
        </div>

        <h3>Comparative Monthly Expense Snapshot (All Figures in Local Currency, Estimated Range for a Single Student)</h3>
        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Expense Category</th>
                        <th>Canada (CAD)</th>
                        <th>Australia (AUD)</th>
                        <th>UK (GBP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Accommodation (Shared/Off-Campus)</td>
                        <td>C$600 - C$1,200</td>
                        <td>A$700 - A$1,500</td>
                        <td>£550 - £950</td>
                    </tr>
                    <tr>
                        <td>Utilities & Internet</td>
                        <td>C$100 - C$200</td>
                        <td>A$80 - A$180</td>
                        <td>£70 - £130</td>
                    </tr>
                    <tr>
                        <td>Food & Groceries</td>
                        <td>C$350 - C$550</td>
                        <td>A$400 - A$600</td>
                        <td>£250 - £400</td>
                    </tr>
                    <tr>
                        <td>Local Transport (Pass)</td>
                        <td>C$100 - C$150</td>
                        <td>A$80 - A$180</td>
                        <td>£70 - £150</td>
                    </tr>
                    <tr>
                        <td>Personal/ Miscellaneous</td>
                        <td>C$150 - C$300</td>
                        <td>A$200 - A$400</td>
                        <td>£150 - £300</td>
                    </tr>
                    <tr>
                        <td>Estimated Total Monthly Cost</td>
                        <td>C$1,300 - C$2,400</td>
                        <td>A$1,480 - A$3,060</td>
                        <td>£1,090 - £1,930</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p style="margin-top: 2rem;">Note: These are estimates. Costs in major metropolitan hubs like Toronto, Sydney,
            London, and New York will consistently be at the higher end of the range.</p>

        <h3>Deep Dive: City vs. Regional Costs</h3>
        <p>The cost difference between a capital city and a regional city is often the single most significant factor in
            your budget.</p>
        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Highest Cost City (Example)</th>
                        <th>Regional/Lower Cost City (Example)</th>
                        <th>Potential Monthly Saving (Approx.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Canada</td>
                        <td>Vancouver / Toronto</td>
                        <td>Halifax / Winnipeg</td>
                        <td>C$300 - C$600</td>
                    </tr>
                    <tr>
                        <td>Australia</td>
                        <td>Sydney / Melbourne</td>
                        <td>Adelaide / Perth</td>
                        <td>A$400 - A$800</td>
                    </tr>
                    <tr>
                        <td>UK</td>
                        <td>London</td>
                        <td>Manchester / Glasgow</td>
                        <td>£300 - £500</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <p style="margin-top: 2rem;"><b>Our Customised Profile Evaluation: </b>We assess your academic goals and financial
            capacity simultaneously. By suggesting reputable institutions in Regional Centres, we can significantly relieve
            your financial burden while often increasing your chances for post-study work and permanent residency pathways
            (especially in Australia and Canada).</p>


    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Strategic Funding & Saving - Maximizing Your Resources</h2>
            <p>
                Your foreign journey is made tension-free when you have a robust financial plan. Our services extend beyond
                visa stamping to ensure your financial success abroad.
            </p>
        </div>

        <h3>1. Securing Funding: Education Loan Services</h3>
        <p>Demonstrating secured funds is key to visa approval. Our Education Loan Service gets you in touch with the best
            loan deals at reasonable interest rates. We liaise with financial institutions to expedite the process,
            ensuring:</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>Prompt Sanction Letter: </b>A legally accepted document for embassy submission.</p>
            </div>
            <div class="feature">
                <p><b>Competitive Rates: </b>Access to the most favourable interest rates and repayment structures.</p>
            </div>
        </div>

        <h3>2. Income Generation: The Part-Time Work Advantage</h3>
        <p>Most student visas allow you to work part-time (typically 20 hours per week during academic sessions and
            full-time during breaks). While this income should NOT be used to meet the initial visa financial requirement,
            it is essential for covering living expenses and building local experience.</p>
        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <p><b>Average Hourly Wage: </b>$15-$25$ (Canada), $23-$30$ (Australia), $11-$15$ (UK).</p>
            </div>
            <div class="feature">
                <p><b>WTS Guidance: </b>We provide a pre-departure briefing on local employment laws, tax regulations, and
                    how to effectively balance work and study.</p>
            </div>
        </div>

        <h3>3. Smart Savings & Hidden Costs</h3>
        <p>
            Students often overlook one-time setup costs and local saving strategies.
            <br>
            <b>Hidden Costs to Budget For:</b>
        </p>
        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Cost Item</th>
                        <th>Typical One-Time Cost</th>
                        <th>WTS Solution</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Initial Accommodation Deposit</td>
                        <td>4-8 weeks rent (refundable)</td>
                        <td>We assist in reviewing lease agreements to secure fair terms.</td>
                    </tr>
                    <tr>
                        <td>OSHC/Health Insurance</td>
                        <td>A$600 - A$1,200/year (Mandatory)</td>
                        <td>We ensure you have the correct, visa-compliant health cover before submission.</td>
                    </tr>
                    <tr>
                        <td>Flight Ticket</td>
                        <td>Varies by season/country</td>
                        <td>We assist with air ticketing services to secure the best rates and travel insurance.</td>
                    </tr>
                    <tr>
                        <td>Winter Clothing</td>
                        <td>C$300 – C$700 (For Canada / Northern USA)</td>
                        <td>Advised to buy some items locally for better quality and appropriate protection.</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <p style="margin-top: 2rem;"><b>Saving Strategies We Recommend: </b></p>
        <ul style="padding-left:2rem;">
            <li><b>Cook at Home: </b>A meal out costs 3-5 times more than cooking at home.</li>
            <li><b>Student Discounts: </b>Carry your university ID everywhere. Use student cards for public transport,
                museums, cinema, and retail.</li>
            <li><b>Used Textbooks: </b>Always check university libraries or online forums for used books or e-books instead
                of buying new.</li>
            <li><b>Shared Accommodation: </b>Opting for a shared apartment with other students is the most effective way to
                cut accommodation costs by up to 50%.</li>
        </ul>


    </section>

    <section class="new-journey-wrapper">
        <div class="new-journey-header">
            <h2 class="new-section-title">Your End-to-End Financial Support Process with WTS</h2>
            <p>
                We integrate cost-of-living planning into our systematic and streamlined process, ensuring financial
                preparedness at every step.
            </p>
        </div>

        <div class="financial-table-wrapper">
            <table class="financial-table">
                <thead>
                    <tr>
                        <th>Step</th>
                        <th>Action We Take</th>
                        <th>Value You Receive</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Step 1: Profile & Financial Assessment</strong></td>
                        <td>
                            We conduct a customised profile evaluation to assess your financial capacity and suggest
                            institutions and cities that align with your budget.
                        </td>
                        <td>
                            We help you select a university where the total fees and cost of living fall comfortably within
                            your family’s resources.
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Step 2: Documentation & Compliance</strong></td>
                        <td>
                            We handle all documentation for the visa application. We meticulously prepare your financial
                            documents to meet the embassy's specific format and duration requirements, minimising the risk
                            of a financial refusal.
                        </td>
                        <td>
                            This guarantees the maximum possible chances of approval, solving the defective/incomplete
                            documentation challenge.
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Step 3: Financial Logistics & Pre-Departure</strong></td>
                        <td>
                            We provide pre-departure briefing and assistance with essential financial services,
                            including:<br>
                            • Forex: Guiding you on foreign exchange rates and transfers.<br>
                            • International Bank Accounts: Assisting you in setting up your necessary local accounts.<br>
                            • Travel Insurance: Securing required insurance policies.
                        </td>
                        <td>
                            You arrive in your new country prepared, with access to your funds, allowing you to concentrate
                            on fulfilling your aspirations.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="financial-bottom-note">
            <h3>We are more than just a visa processor-we are your financial partner on your study abroad journey.</h3>
            <p>
                Don't let financial uncertainty hold you back. WTS Visa Consultancy is here to make your process smooth and
                hassle-free.
            </p>
            <p><strong>Ready to build a financially robust plan for your international education? Contact us today for a
                    free consultation!</strong></p>
        </div>
    </section>
    

    <!-- Final CTA Section -->
    <section class="study-guide-section" style="background-color: #f1f1f1;">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600; color: #000;">Start Your Study Abroad Journey Today</h2>
                <p style="color: #000;">Whether you're exploring options or ready to apply, we’re here to guide your next
                    step. Start your global education journey with WTS, where your dreams find the right direction.</p>
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