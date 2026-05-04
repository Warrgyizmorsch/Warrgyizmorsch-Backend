@extends('layouts.app')
@section('content')
    <style>
        .terms-container {
            background: linear-gradient(to bottom, #2a2a2a, #1c1c1c);
            padding: 120px 20px 60px 20px;
            color: #f9f9f9;
            line-height: 1.9;
        }

        .wrapper {
            max-width: 960px;
            margin: auto;
        }

        /* Glass Card Style */
        .card.glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .card.glass:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.5);
        }


        .main-heading {
            font-size: 34px;
            font-weight: bold;
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            animation: slideDown 0.6s ease-in-out;
        }

        .main-heading span {
            color: #ffa500;
        }

        .list-style {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: justify;
            ;
        }

        .list-style li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 14px;
            color: #ccc;
            font-size: 1rem;
        }

        .list-style li::before {
            content: '✔';
            position: absolute;
            left: 0;
            top: 0;
            color: #ffa500;
            font-size: 16px;
        }

        .section-heading {
            font-size: 1.5rem;
            margin: 40px 0 20px;
            border-left: 5px solid #ffa500;
            padding-left: 15px;
            color: #fff;
            text-align: left;
        }

        .terms-container li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 14px;
            color: #ccc;
            font-size: 1rem;
            text-align: justify;
        }

        .terms-container p {
            font-size: 1rem;
            color: #d3d3d3;
            line-height: 1.8;
        }

        .terms-container strong {
            color: #fff;
        }

        a {
            color: #ffaa00;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #ffaa00;
        }

        .contact-list {
            list-style-type: none;
            padding-left: 0;
        }

        .contact-list li {
            margin-bottom: 10px;
        }

        @media screen and (max-width: 768px) {
            h1 {
                font-size: 26px;
            }

            h2 {
                font-size: 20px;
            }

            .card {
                padding: 20px;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <section class="terms-container">
        <div class="wrapper">
            <h1 class="main-heading">WTS Visa - <span>Terms and Conditions</span> of Use</h1>
            <p>Welcome to <strong>wtsvisa.com</strong> by accessing and using our Website, you agree to be bound by these
                Terms and Conditions of Use (the "Terms"), along with our Privacy Policy, which is incorporated herein by
                reference. These Terms govern your use of our Website and the services we offer related to visa information
                and assistance. </p>
            <p>This document constitutes a legally binding electronic record under the Information Technology Act, 2000, and
                does not require any physical or digital signatures.</p>


            <h2 class="section-heading">I. USER OBLIGATIONS AND CONDUCT</h2>
            <div class="card glass">
                <ol class="number-list">
                    <li><strong>Informational Purpose:</strong> The information on this Website is intended for general
                        knowledge and your private, non-business use only. While we strive for accuracy, visa regulations
                        are subject to change, and we do not guarantee the timeliness, completeness, or accuracy of all
                        information. It is your responsibility to verify the latest requirements with the relevant official
                        authorities.</li>
                    <li><strong>No Professional Advice:</strong> The information on this Website should not be considered
                        professional legal or immigration advice. For specific guidance regarding your individual situation,
                        you should consult with a qualified immigration lawyer or consultant.</li>
                    <li><strong>Intellectual Property:</strong> All content, including text, graphics, logos, designs, and
                        software, is the property of WTS Visa or its licensors and is protected by copyright and other
                        intellectual property laws. You may not reproduce, modify, distribute, or commercially exploit any
                        content from this Website without our prior written consent.</li>
                    <li><strong>Acceptable Use:</strong> You agree to use this Website only for lawful purposes and in a
                        manner that does not infringe upon the rights of others or restrict their use and enjoyment of the
                        Website. You shall not:
                        <ul>
                            <li>Transmit of any unlawful, defamatory, abusive, threatening, harmful, vulgar, obscene, or
                                otherwise objectionable material. </li>
                            <li>Attempt to gain unauthorized access to any part of the Website, other accounts, or computer
                                systems or networks connected to the Website. </li>
                        </ul>
                    </li>
                    <li><strong>Your Responsibility:</strong> Your use of any information or materials on this Website is
                        entirely at your own risk, and we shall not be liable for any consequences arising from your
                        reliance on such information. It is your responsibility to ensure that any services or information
                        obtained through this Website meet your specific needs. </li>
                    <li><strong>Third-Party Links:</strong> This Website may contain links to third-party websites for your
                        convenience. These links do not imply our endorsement of the content, products, or services offered
                        on those websites. </li>
                    <li><strong>No Linking Without Permission:</strong> You may not create any hyperlink or other form of
                        link to this Website from any other website or source without obtaining our prior written consent.
                    </li>
                    <li><strong>Indemnification:</strong> You agree to indemnify, defend, and hold harmless WTS Visa, its
                        affiliates, officers, directors, employees, agents, and licensors from and against any and all
                        claims, liabilities, damages, losses, costs, and expenses (including attorneys' fees) arising out of
                        or in any way connected with your use of this Website, your violation of these Terms, or your
                        violation of any rights of another party. </li>
                </ol>
            </div>

            <h2 class="section-heading">II. DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h2>
            <div class="card glass">
                <ul class="list-style">
                    <li><strong>"As Is" Basis:</strong> This Site and all content, products, and services available on it
                        are offered on an "as is" and "as available" basis with no warranties of any kind, express or
                        implied, including but not limited to merchantability, fitness for a particular purpose,
                        non-infringement, or accuracy. </li>
                    <li><strong>No Guarantee of Visa Approval:</strong> WTS Visa provides assistance and information related
                        to visa applications, but we do not guarantee the approval of any visa. The decision to grant or
                        deny a visa rests solely with the relevant government authorities.</li>
                    <li><strong>Limitation of Liability:</strong> To the greatest extent permitted by applicable law, WTS
                        Visa shall not be liable to you for direct, indirect, incidental, special, consequential or punitive
                        damages (including without limitation loss of profits, data, use, goodwill, or other economic
                        benefits) that are in connection with, arise out of or relate to your access to, inability to access
                        or use this Website or services provided, even where we have been warned of the potential of such
                        damages. Our aggregate liability to you for any claim based upon, arising out of, or in connection
                        with these Terms or your use of the Website will be limited to the amount, if any, you have paid to
                        WTS Visa for the particular service involved.
                    </li>
                    <li><strong>Device Compatibility:</strong> We do not warrant that our Website or services will be
                        compatible with all devices and operating systems. It is your responsibility to ensure that your
                        device meets the necessary technical specifications.</li>
                </ul>
            </div>

            <h2 class="section-heading">III. TERM AND TERMINATION</h2>

            <p>These Terms will continue in full force and effect so long as you continue to access or use the Website. We
                may suspend, restrict, or terminate your access to the whole or any portion of the Website at any time, with
                or without reason and without notice, including if we determine that you have breached these Terms or our
                Privacy Policy. Upon termination, your right to use the Website will end outright.</p>


            <h2 class="section-heading">IV. GOVERNING LAW AND JURISDICTION</h2>

            <p> These Terms and your use of this Website shall be governed by and construed in accordance with the laws of
                India, without regard to its conflict of law principles. Any legal action or proceeding arising out of or
                relating to these Terms or the Website shall be exclusively subject to the jurisdiction of the courts
                located in Udaipur, Rajasthan, India. </p>


            <h2 class="section-heading">V. PRIVACY POLICY</h2>
            <p>Your privacy is important to us. Please review our <a href="{{ route('privacy_policy') }}">Privacy Policy</a>
                to understand how we collect, use, and protect your personal information. Our Privacy Policy is an integral
                part of these Terms. </p>


            <h2 class="section-heading">VI. FORCE MAJEURE</h2>

            <p> WTS Visa shall not be liable for any failure to perform its obligations under these Terms due to any cause
                beyond its reasonable control, including but not limited to acts of God, war, terrorism, riots, embargoes,
                strikes, natural disasters, power outages, internet disruptions, or governmental actions. </p>


            <h2 class="section-heading">VII. ENTIRE AGREEMENT</h2>
            <p>These Terms, together with our Privacy Policy, constitute the entire agreement between you and WTS Visa
                regarding your use of the Website and supersede all prior or contemporaneous communications and proposals,
                whether oral or written. </p>

            <h2 class="section-heading">VIII. SEVERABILITY</h2>

            <p>If any provision of these Terms is held to be invalid or unenforceable, such provision shall be struck and
                the remaining provisions shall remain in full force and effect. </p>


            <h2 class="section-heading">IX. WAIVER</h2>
            <p> Our failure to enforce any right or provision of these Terms shall not be deemed a waiver of such right or
                provision. </p>

            <h2 class="section-heading">X. CONTACT US</h2>
            <p>If you have any questions or concerns about these Terms and Conditions, please contact us at:</p>
            <ul class="contact-list">
                <li><strong>Email:</strong> info@wtsvisa.com</li>
                <li><strong>Phone:</strong> +91 9116076837</li>
                <li><strong>Address:</strong> 402, 4th floor, Kanakshree apartment, 80ft road, Shobhagpura, Udaipur, Rajasthan 313001</li>
            </ul>


            <p style="text-align: left; color: #777; font-size: 15px;">By using wtsvisa.com, you acknowledge that you have
                read, understood, and agree to be bound by these Terms and Conditions of Use.</p>
            </>
    </section>
@endsection