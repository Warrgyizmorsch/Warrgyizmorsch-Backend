<style>
    #service-menu {
        height: 600px;
        overflow-y: scroll;
        scrollbar-width: thin;
        scrollbar-color: #d97706 #f3f4f6;
    }

    #service-menu::-webkit-scrollbar {
        width: 2px;
    }

    #service-menu::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 8px;
    }

    #service-menu::-webkit-scrollbar-thumb {
        background-color: #d97706;
        border-radius: 8px;
        border: 2px solid #f3f4f6;
    }

    #service-menu li {
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.3s;
        border: 1px dotted;
    }

    .content-service {
        max-width: 1200px;
        margin: 40px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.1);
    }

    .header-content {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 2px solid #ddd;
    }

    .header-content h2 {
        font-size: 25px;
        font-weight: bold;
    }

    .header-content p {
        font-size: 18px;
        color: #555;
    }

    .flex {
        display: flex;
        gap: 20px;
    }

    .sidebar {
        width: 30%;
        padding: 20px;
        border-right: 2px solid #ddd;
    }

    .sidebar h2 {
        font-size: 22px;
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li:hover,
    .sidebar li.active {
        background: #d97706;
        color: #fff;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    .tab-content {
        display: none;
        text-align: justify;
    }

    .tab-content.active {
        display: block;
    }

    .content h2 {
        font-size: 28px;
        color: #d97706;
        margin-bottom: 15px;
    }

    .content p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
    }

    .icon {
        font-size: 20px;
    }

    .swipe-up {
        text-align: center;
        margin-top: 20px;
        font-size: 16px;
        color: #d97706;
        cursor: pointer;
    }

    @media screen and (max-width: 768px) {
        .flex {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 2px solid #ddd;
        }
    }
.content ul {
    list-style: none; /* Removes default bullets */
    padding: 0;
    margin-top: 1em;
}

.content ul li {
    position: relative;
    padding-left: 1.8em;
    margin-bottom: 0.8em;
    font-size: 1rem;
    line-height: 1.5;
    color: #333;
}

.content ul li::before {
    content: '✔'; /* Custom bullet */
    position: absolute;
    left: 0;
    color: #d97706; /* Change color to match your theme */
    font-weight: bold;
}

</style>

<div class="content-service">
    <div class="header-content">
        <h2><span>Our Services:</span> From Course Selection to Post-Arrival Support</h2>
        <p>We at WTS Visa Consultancy will take care of each and every step of your study abroad process...</p>
    </div>
    <div class="flex">
        <div class="sidebar">
            <h2>Our Services</h2>
            <ul id="service-menu">
                <li data-target="counseling"><i class="fa-solid fa-medal icon"></i> Counseling with an Expert</li>
                <li data-target="evaluation"><i class="fa-solid fa-address-card icon"></i> Free Profile Evaluation</li>
                <li data-target="course"><i class="fa-solid fa-book icon"></i> Course Selection</li>
                <li data-target="admission"><i class="fa-solid fa-university icon"></i> Admission</li>
                <li data-target="sop"><i class="fa-solid fa-file-signature icon"></i> SOP</li>
                <li data-target="interviews"><i class="fa-solid fa-comments icon"></i> Mock Interviews</li>
                <li data-target="travel"><i class="fa-solid fa-plane icon"></i> Travel Arrangements</li>
                <li data-target="visa"><i class="fa-solid fa-book icon"></i> Visa Assistance</li>
                <li data-target="post-landing"><i class="fa-solid fa-house-user icon"></i> Post-Landing Services</li>
                <li data-target="loan"><i class="fa-solid fa-user-graduate icon"></i> Education Loan</li>
            </ul>
            <p class="swipe-up">Swipe Up to See More</p>
        </div>
        <div class="content">
            <div id="course" class="tab-content active">
                <h2>Course Selection</h2>
                <p>Choosing a course is a highly significant aspect of designing your future career and academic life. Choosing the right course equips you with the skills and knowledge to excel in your desired profession. WTS Visa Consultancy understands the intimidating nature of this choice, especially in choosing to study abroad. Hence, we offer expert advice to guide you through a long list of courses to choose the right one.</p>
                <p>Our counselors take your career aspiration, study interest, and interest to guide you to the most appropriate courses that meet your aspirations. We assist you in selecting courses from top-ranked universities and institutions across the globe, thereby giving you a career edge.
                </p>
                <p><strong>What are the key factors we take into account while selecting courses:</strong></p>
                <ul>
                    <li><strong>Career Aspirations: </strong>Choosing a course that matches your long-term career goal.
                    </li>
                    <li><strong>Interest and Passion: </strong>Aligning the course with your mental ability and passion.
                    </li>
                    <li><strong>University Reputation: </strong>Helping you select courses offered by popular universities for best prospects.
                    </li>
                    <li><strong>Location and Opportunities: </strong>Including study destinations that offer good employment opportunities after graduation.
                    </li>
                </ul>
                <p>Expert consultation and personalized assistance make your course choice the best stepping stone for academic and career success.
                </p>
            </div>
            <div id="admission" class="tab-content">
                <h2>Admission</h2>
                <p>Joining a reputable academic institution is a landmark in your academic career. If you are entering into undergraduate, postgraduate, or PhD study, it is wise to have information about the admission process so that you can secure your seat. We at WTS Visa Consultancy provide professional consultancy at each step of your admission so that you can take rational decisions and complete all the requirements.</p>
                <p><strong>
                        Major Steps of the Admission Procedure
                    </strong></p>
                <ul>
                    <li><strong>Choosing the Best Program: </strong>Our counselors will help you pick a program most appropriate based on your career and educational objectives.</li>
                    <li><strong>Guidance on Applications: </strong>We help you fill application forms, write personal statements, and prepare the documents to be submitted in such a manner that they are submitted correctly and within time.
                    </li>
                    <li><strong>Document Assembly: </strong>From letters of recommendation to transcripts, we assist you in obtaining and securing all necessary documents.</li>
                    <li><strong>College Selection: </strong>We support you in limiting colleges that fit you best as per your scholarly background, finance, and passions.</li>
                    <li><strong>Interview Prep: </strong>In the event that your desired college imposes an interview, we coach and conduct mock interviews to prepare in confidence.
                    </li>
                    <li><strong>Offer Letter Counseling: </strong>Once we get your offer letter, we counsel you to review the letter and what should be adhered to next.
                    </li>
                </ul>

                <p>Our professional guidance makes the process of admission less tense, with a higher chance of securing an admission to your preferred university.</p>


            </div>
            <div id="sop" class="tab-content">
                <h2>SOP</h2>
                <p>A Statement of Purpose (SOP) is a critical document in international university admission for applicants. It gives the chance to represent yourself apart from your test scores and grades by declaring your professional goals, areas of academic interest, and desire to study for a particular course. An efficient SOP can help strengthen your application to a core level, informing the admissions committee about your motive clearly.</p>
                <p>Begin your SOP with an introduction of your education and what steered you towards the course study. It would be succeeded by your most important academic accomplishments, projects, or internships which steered you towards the program.
                </p>
                <p>Explain why you've chosen this specific program and school. Be exact about what it is that you're drawn to the course of study and what it is about the instructors and research work. This paragraph must demonstrate that you've done much research on the program.</p>
                <p>Discuss your long-term goals for your career and how the program will be included among these goals. Demonstrate how learning and experience that you will acquire will contribute to career growth.</p>
                <p>End your SOP by indicating your interest in the program and desire to pursue studies at the university. Keep your SOP brief, interesting, and error-free to get maximum output.</p>
            </div>
            <div id="interviews" class="tab-content">
                <h2>Mock Interviews</h2>
                <p>Mock visa interview for visa application is a mock interview session that is done to simulate the real visa interview process so that applicants are well prepared to deal with the questions and situations that might occur. It is particularly helpful for students who apply for study visas or other types of visas where an interview is mandatory. Below are the ways in which mock visa interviews can be helpful to you:</p>
                <ul>
                    <li><strong>Understand Visa-Specific Questions:</strong>Mock interviews allow you to rehearse questions commonly asked by visa officers such as your intention to visit, your connections in your home country, and your financials. 
                    </li>
                    <li><strong>Improve Communication Skills: </strong>These sessions provide you with knowledge of how you should explain eloquently your plans, past, and aims so that you deliver your responses concisely and effectively.</li>
                    <li><strong>Gain Confidence: </strong>By simulating the real interview scenario, mock interviews can drain tension and leave you better prepared and confident on your actual interview day.</li>
                    <li><strong>Gain Constructive Criticism: </strong>Get constructive feedback on your response, body language, and presence, and address these in time for your actual interview.
                    </li>
                    <li><strong>Prepare for Unexpected Questions: </strong>Practice interviews familiarize you with answering unexpected questions so that you're never in the dark whenever any challenge comes your way in your actual visa interview.</li>
                </ul>
                <p>Practice visa interviews offer you an opportunity to rehearse responses and delivery, which opens your doors towards the possibility of succeeding in your real visa interview.</p>
            </div>
            <div id="travel" class="tab-content">
                <h2>Travel Arrangements</h2>
                <p>We, at WTS Visa Consultancy, understand that your travel booking is part of your foreign study or foreign experience. Our doorstep-to-doorstep travel booking makes it easier for you in such a way that whatever is important in connection with your travel, which is precious, gets taken care of to a large extent, and you are free to enjoy your study or new experience with a clear mind. This is how we treat your travel bookings:</p>
                <ul>
                    <li><strong>Flight Booking: </strong>We help you choose the best flight in terms of budget and timing so that you may fly on favorable dates and experience hassle-free layover.
                    </li>
                    <li><strong>Hotel Booking: </strong>Airport Pick-up and Drop: </li>
                    <li><strong>Airport Pick-up and Drop: </strong>Airport pick-up to transfer, we provide you with hassle-free and smooth airport-to-destination travel.
                    </li>
                    <li><strong>Travel Insurance: </strong></li>
                    <li><strong>Visa and Documentation Service: </strong></li>
                </ul>
                <p>Now that your case has been handed over to WTS Visa Consultancy, you should not worry whatsoever but rather go forward with furthering your career or study progress with confidence that it is in capable hands.</p>
            </div>
            <div id="visa" class="tab-content">
                <h2>Visa Assistance</h2>
                <p>Visa consultancy is a crucial facility for any aspirant who is going to pursue studies or move abroad. Applying for a visa can be stressful, but if you consult us, visa application becomes simpler and quicker. We provide full-fledged visa consultancy at WTS Visa Consultancy so that you get all documentation and deadlines to fulfill, along with your international journey as seamless as possible.</p>
                <p>Our expert counselors give you customized counseling based on your requirement, either for an immigration visa or a student visa. We take you through step by step, from choosing the right type of visa, getting documents ready, and submitting them in the right way.</p>

                <p><strong>Our Visa Services include:</strong></p>
                <ul>
                    <li><strong>Professional Visa Guidance: </strong>Customized advice on the proper visa for your purpose.
                    </li>
                    <li><strong>Document Assistance: </strong>Assistance in compilation and preparation of required documents.
                    </li>
                    <li><strong>Application Submission: </strong>Filling and submission of your application in time.
                    </li>
                    <li><strong>Interview Preparation: </strong>Preparation for your visa interview so that you receive approval.
                    </li>
                    <li><strong>Follow-up Support: </strong>Follow-ups and counseling at regular intervals.
                    </li>
                </ul>
                <p>Follow your dreams with our visa assistance as we take care of the paperwork and logistics. Let us be answerable for making your visa application procedure easy and convenient so that you have the optimum chance for success.</p>
            </div>
            <div id="post-landing" class="tab-content">
                <h2>Post-Landing Services</h2>
                <p>Foreign students need post-landing services as they bring convenience in settling down in a foreign country. We at WTS Visa Consultancy know that it can be difficult to settle in a new place and hence we provide full-cycle post-landing services so your foreign country settlement is hassle-free and successful.</p>
                <p><strong>Our post-landing services include:</strong></p>
                <ul>
                    <li><strong>Airport Pick-up: </strong>We offer you secure and comfortable airport transfers to your residence so that you can unwind from the beginning.
                    </li>
                    <li><strong>Accommodation Support: </strong>If you desire assistance in arranging short-term stays or reserving a long-term accommodation, we assist you in the process so that you get the best within your budget.</li>
                    <li><strong>Bank and Financial Services: </strong>We assist you in opening your local bank account and putting your finances in the host country, ready to settle your expenses.
                    </li>
                    <li><strong>Orientation Assistance: </strong>We provide you with orientation orientation to familiarize you with your new environment, from transport to shopping and local norms.
                    </li>
                    <li><strong>Emergency Support: </strong>We have our experts available to assist you with any concern you may have, rendering you safe and secure.
                    </li>
                </ul>
                <p>With the professional post-arrival support of WTS Visa Consultancy, you can concentrate on learning and development, while we take care of the paperwork, and your foreign country transfer is smooth and trouble-free.</p>
            </div>
            <div id="evaluation" class="tab-content">
                <h2>Free Profile Evaluation</h2>
                <p>Visa consultancy is a crucial facility for any aspirant who is going to pursue studies or move abroad. Applying for a visa can be stressful, but if you consult us, visa application becomes simpler and quicker. We provide full-fledged visa consultancy at WTS Visa Consultancy so that you get all documentation and deadlines to fulfill, along with your international journey as seamless as possible.</p>
                <p>Our expert counselors give you customized counseling based on your requirement, either for an immigration visa or a student visa. We take you through step by step, from choosing the right type of visa, getting documents ready, and submitting them in the right way.</p>
                <p><strong>Our Visa Services include:</strong></p>
                <ul>
                    <li><strong>Professional Visa Guidance: </strong>Customized advice on the proper visa for your purpose.
                    </li>
                    <li><strong>Document Assistance: </strong>Assistance in compilation and preparation of required documents.
                    </li>
                    <li><strong>Application Submission: </strong>Filling and submission of your application in time.
                    </li>
                    <li><strong>Interview Preparation: </strong>Preparation for your visa interview so that you receive approval.
                    </li>
                    <li><strong>Follow-up Support: </strong>Follow-ups and counseling at regular intervals.
                    </li>
                </ul>
                <p>Follow your dreams with our visa assistance as we take care of the paperwork and logistics. Let us be answerable for making your visa application procedure easy and convenient so that you have the optimum chance for success.</p>
            </div>
            <div id="loan" class="tab-content">
                <h2>Education Loan</h2>
                <p>An education loan is a means of finance taken to fund a student's studies, mainly foreign studies. With increasing fees, living costs, and other expenses, an education loan is a feasible option to make foreign studies affordable. An education loan covers fee charges, living expenses, air fare, textbooks, etc., so that the student is not hassled with financial issues and can focus on studies.
                </p>
                <p>Education loans are offered by banks or financial institutions, and repayment is free. Moratorium period is also provided to students depending on the institution, and repayment is done after completing the course or securing a job.</p>
                <p><strong>Major advantages of education loans:</strong></p>
                <ul>
                    <li>Pays for complete or partial education
</li>
<li>Flexible repayment period after graduation</li>
<li>Creates financial discipline and credit history</li>
<li>Can be availed for undergraduate, postgraduate, and professional courses</li>
                </ul>
                <p>To obtain an education loan, students typically have to submit documents such as admission letters, identification documents, proof of income (of the guarantor or co-applicant), educational documents, and a breakdown of the cost of the course.</p>
                <p>Selecting the most appropriate loan scheme with minimal interest rates and appropriate terms is a must. We at WTS Visa Consultancy assist students at all levels—from selection of the most appropriate loan scheme to documentation and sanction—so that loan processing remains hassle-free and stress-free.</p>
            </div>
            <div id="counseling" class="tab-content">
                <h2>Counseling with an Expert</h2>
                <p>Looking for a professional counselor is a whole different world when you are lost, confused, or stranded. Here at WTS Visa Consultancy, we make our counselors listen to you, hear you out, and accompany you through your problems—education, career, migration, or personal challenges. We try to establish a safe, comfortable space where you can spread out your options and discover viable, empowering solutions.
                </p>
                <p><strong>Here’s what you can expect from a session with our expert counselors:
                </strong></p>
                <ul>
                    <li><strong>Personalized Care: </strong>Each student or person has different worries and goals. We provide individualized counseling up to the extent your case is concerned.
                    </li>
                    <li><strong>Objective-Oriented Dialogue: </strong>Choosing a career or making plans for higher education, we assist you in framing specific, achievable objectives.
                    </li>
                    <li><strong>Recent News: </strong>Receive current, accurate news regarding visas, schools, employment trends, etc.</li>
                    <li><strong>Emotional Support: </strong>Overseas travel or having those life-changing decisions made may be daunting—here to be here for your mind each step of the way.
                    </li>
                    <li><strong>Confidential & Professional: </strong>Your confidentiality is top priority, and all communication is done on the highest level of professionalism.
                    </li>
                </ul>
                <p>Wherever you are in your journey, an appointment with a licensed counselor can enlighten, banish fear, and assist you in making educated choices with confidence. Make your appointment today and proceed with direction. Proper direction is everything—let us begin taking that initial step today.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tabs = document.querySelectorAll("#service-menu li");
        const contents = document.querySelectorAll(".tab-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                // Remove active classes
                tabs.forEach(t => t.classList.remove("active"));
                contents.forEach(c => c.classList.remove("active"));

                // Activate selected tab
                tab.classList.add("active");
                const targetId = tab.getAttribute("data-target");
                const targetContent = document.getElementById(targetId);
                if (targetContent) targetContent.classList.add("active");
            });
        });
    });
</script>