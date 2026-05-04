<section class="hero-main">
    <img src="/images/fbf0efd993d06415633881cd7b0c43de.jpg" alt="Hero Background" class="hero-bg" loading="lazy" />

    <div class="hero-content-wrapper">

        <div class="home-hero-content">
            <h1 class="hero-title">
                <span class="text-gradient">Expert Guidance</span> for All Types of Visas & University Admissions for
                Students
            </h1>
            <span class="hero-tip" style="display: block; text-align: left; margin: 0 auto;">Visa counseling is
                completely
                free for study visas.
                <br>
                We offer end-to-end support—from application to accommodation—and proudly serve students
                pan India.</span>

            <a href="#" class="hero-cta" onclick="openRegistrationModal(event)">
                Register Now
            </a>
        </div>

        <div class="map-container">
            <img src="images/white-world-map.png" alt="World Map" class="map-image" fetchpriority="high" width="800"
                height="500">

            <div class="UK-marker marker" data-city="UK"></div>
            <div class="usa-marker marker" data-city="USA"></div>
            <div class="canada-marker marker" data-city="Canada"></div>
            <div class="australia-marker marker" data-city="Australia"></div>
            <div class="france-marker marker" data-city="france"></div>

            <div class="card-country UK-card">
                <div class="flag-circle">
                    <img src="images/icons/uk.webp" alt="UK Flag">
                </div>
                <span>UK</span>
                <div class="popup popup-uk">
                    <strong>Accepted Tests:</strong> IELTS, TOEFL, PTE, Cambridge English, Duolingo<br>
                    <strong>Work Rights:</strong> 20 hrs/week during term time, Full-time during vacations<br>
                    <strong>Scholarships:</strong> £1,000 - £5,000<br>
                    <strong>Popular Courses:</strong>
                    <ul>
                        <li>Computer Science</li>
                        <li>Business and Management</li>
                        <li>Engineering (Civil, Mechanical)</li>
                        <li>Medicine</li>
                        <li>Law</li>
                    </ul>
                    <strong>Post-Study Work:</strong> 2 years (for Master's and PhD)
                </div>
            </div>

            <div class="card-country usa-card">
                <div class="flag-circle">
                    <img src="images/icons/united-states.webp" alt="USA Flag">
                </div>
                <span>USA</span>
                <div class="popup popup-usa">
                    <strong>Accepted Tests:</strong> IELTS, TOEFL, PTE, Duolingo, Cambridge English<br>
                    <strong>Work Rights:</strong> 20 hrs/week during academic sessions, Full-time during holidays<br>
                    <strong>Scholarships:</strong> $1,000 - $10,000<br>
                    <strong>Popular Courses:</strong>
                    <ul>
                        <li>Computer Science</li>
                        <li>Engineering (Electrical, Mechanical)</li>
                        <li>Business (MBA)</li>
                        <li>Medicine</li>
                        <li>Psychology</li>
                    </ul>
                    <strong>Post-Study Work:</strong> 12 months OPT (up to 36 months for STEM)
                </div>
            </div>

            <div class="card-country canada-card">
                <div class="flag-circle">
                    <img src="images/icons/canada.webp" alt="Canada Flag">
                </div>
                <span>Canada</span>
                <div class="popup popup-canada">
                    <strong>Accepted Tests:</strong> IELTS, TOEFL, PTE, CAEL, CELPIP, Duolingo<br>
                    <strong>Work Rights:</strong> 20 hrs/week during academic sessions, Full-time during breaks<br>
                    <strong>Scholarships:</strong> $1,000 - $5,000<br>
                    <strong>Popular Courses:</strong>
                    <ul>
                        <li>Engineering (Software, Electrical, Civil)</li>
                        <li>Business</li>
                        <li>Environmental Science</li>
                        <li>Health Sciences</li>
                        <li>Artificial Intelligence</li>
                    </ul>
                    <strong>Post-Study Work:</strong> 3 years PhD, 1–3 years Master’s
                </div>
            </div>

            <div class="card-country france-card">
                <div class="flag-circle">
                    <img src="images/icons/france.webp" alt="France Flag">
                </div>
                <span>France</span>
                <div class="popup popup-france">
                    <strong>Accepted Tests:</strong> IELTS, TOEFL, TCF, DELF, Cambridge English<br>
                    <strong>Work Rights:</strong> 964 hrs/year (about 20 hrs/week)<br>
                    <strong>Scholarships:</strong> €1,000 - €3,000<br>
                    <strong>Popular Courses:</strong>
                    <ul>
                        <li>Business (Management, Finance)</li>
                        <li>Fashion and Design</li>
                        <li>Engineering</li>
                        <li>Arts and Humanities</li>
                        <li>Social Sciences</li>
                    </ul>
                    <strong>Post-Study Work:</strong> 1–2 years (Master's and PhD)
                </div>
            </div>

            <div class="card-country australia-card">
                <div class="flag-circle">
                    <img src="images/icons/australia.webp" alt="Australia Flag">
                </div>
                <span>Australia</span>
                <div class="popup popup-au">
                    <strong>Accepted Tests:</strong> IELTS, TOEFL, PTE, Cambridge English, Duolingo<br>
                    <strong>Work Rights:</strong> 40 hrs/fortnight during academic sessions, Full-time during
                    holidays<br>
                    <strong>Scholarships:</strong> AUD 1,000 - AUD 5,000<br>
                    <strong>Popular Courses:</strong>
                    <ul>
                        <li>Information Technology</li>
                        <li>Engineering (Mechanical, Civil)</li>
                        <li>Medicine</li>
                        <li>Education</li>
                        <li>Environmental Science</li>
                    </ul>
                    <strong>Post-Study Work:</strong> 2–4 years (Master's and PhD)
                </div>
            </div>

        </div>

    </div>

</section>

<!-- Registration Modal -->
<div id="registrationModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeRegistrationModal()">&times;</span>
        @include('components.registration-form')
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        overflow: auto;
    }

    .modal-content {
        margin: 5% auto;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    .close-modal {
        color: #ffcc00;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 10px;
    }

    .close-modal:hover {
        color: #ffa500;
    }

    @media (max-width: 768px) {
        .modal-content {
            margin: 25% auto;
            width: 95%;
        }
    }
</style>

<script>
    function openRegistrationModal(event) {
        event.preventDefault();
        document.getElementById('registrationModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeRegistrationModal() {
        document.getElementById('registrationModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close modal when clicking outside
    window.onclick = function (event) {
        var modal = document.getElementById('registrationModal');
        if (event.target == modal) {
            closeRegistrationModal();
        }
    }
</script>

<style>
    .hero-main {
        /* background: url('/images/fbf0efd993d06415633881cd7b0c43de.jpg') no-repeat center center/cover; */
        position: relative;
        padding: 100px 0 80px 0;
        min-height: 600px;
    }

    .hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    object-fit: cover;
    z-index: -1;
}


    .hero-content-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        max-width: 1200px;
        gap: 20px;
        margin: auto;
        flex-wrap: nowrap;
        /* Ensures responsiveness */
    }

    .home-hero-content {
        width: 80%;
        max-width: 600px;
        margin: 0 auto;
        /* Center the content */
        font-family: 'Poppins', sans-serif;
    }

    .home-hero-content .hero-title {
        font-size: 2rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ffcc00, #ff4500);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }



    .hero-cta {
        background-color: #ffa500;
        color: #fff;
        padding: 14px 32px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 114, 229, 0.2);
    }

    .hero-cta:hover {
        background-color: #ff4500;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
    .hero-content-wrapper {
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
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
    


    .map-container {
        position: relative;
        margin-left: 0;
        margin-right: auto;
        top: 0;
        /* Remove top margin to align properly */
    }

    .map-image {
        width: 100%;
        opacity: 1;
        transform: scale(1);
        transition: transform 0.6s ease, opacity 0.6s ease;
    }

    .marker {
        position: absolute;
        width: 8px;
        height: 8px;
        background-color: red;
        border-radius: 50%;
        box-shadow: 0px 0px 10px 5px rgba(255, 0, 0, 0.5);
        opacity: 0;
        animation: markerFadeIn 1s 1s forwards, markerEffects 2s 3s infinite;
        cursor: pointer;
    }

    .card-country {
        position: absolute;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.1);
        opacity: 0;
        animation: markerFadeIn 1s 1s forwards;
        padding: 3px 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #e0e0e0;
    }

    .flag-circle {

        padding: 3px;

    }

    .flag-circle img {
        height: 32px;
        width: 32px;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .flag-circle:hover img {
        transform: rotate(360deg);
    }

    .card-country span {
        font-size: 16px;
        font-weight: 500;
        color: #4a4a4a;
    }

    .UK-marker {
        top: 45%;
        left: 46%;
    }

    .UK-card {
        top: 33%;
        left: 41%;
    }

    .usa-marker {
        top: 48%;
        left: 23%;
    }

    .usa-card {
        top: 44%;
        left: 2%;
    }

    .canada-marker {
        top: 40%;
        left: 16%;
    }

    .canada-card {
        top: 30%;
        left: -6%;
    }

    .australia-marker {
        top: 68%;
        left: 83%;
    }

    .australia-card {
        top: 72%;
        left: 69%;
    }

    .france-marker {
        top: 48%;
        left: 48%;
    }

    .france-card {
        top: 44%;
        left: 52%;
    }


    .popup {
        position: absolute;
        bottom: 110%;
        left: 50%;
        width: 280px;
        background-color: #ffffff;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        font-size: 14px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        display: none;
        opacity: 0;
        transition: all 0.4s ease;
    }


    .card-country:hover {
        z-index: 1;
        /* raise z-index on hover */
    }

    .card-country:hover .popup-canada {
        display: block;
        opacity: 1;
        transform: translateX(23%) translateY(225px);
    }

    .card-country:hover .popup-usa {
        display: block;
        opacity: 1;
        transform: translateX(22%) translateY(210px);
    }

    .card-country:hover .popup-uk {
        display: block;
        opacity: 1;
        transform: translateX(-42%) translateY(300px);
    }

    @media screen and (min-width: 1045px) {
        .card-country:hover .popup-france {
            display: block;
            opacity: 1;
            transform: translateX(-60%) translateY(301px);
        }

    }

    /* ✅ For screens below 1045px */
    @media screen and (max-width: 1044px) {
        .card-country:hover .popup-france {
            display: block;
            opacity: 1;
            transform: translateX(-60%) translateY(301px);
        }

    }

    .card-country:hover .popup-au {
        display: block;
        opacity: 1;
        transform: translateX(-121%) translateY(7px);
    }



    .popup ul {
        margin: 5px 0;
        padding-left: 20px;
    }

    .popup ul li {
        list-style-type: disc;
    }

    @keyframes overlayFadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes imageFadeIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes markerFadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes markerEffects {

        0%,
        100% {
            filter: brightness(1.5);
            transform: scale(1);
        }

        50% {
            filter: brightness(0.5) contrast(1.2);
            transform: scale(1.2);
        }
    }

    @media (max-width: 768px) {
        .map-container {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        

        /* .card-country {
            display: none;
        } */
         .usa-card {
        top: 51%;
        left: 2%;
    }
    .australia-card {
        top: 71%;
        left: 59%;
    }

    .card-country:hover .popup-canada {
        display: block;
        opacity: 1;
        transform: translateX(-10%) translateY(333px);
    }

    .card-country:hover .popup-usa {
        display: block;
        opacity: 1;
        transform: translateX(-14%) translateY(315px);
    }

    .card-country:hover .popup-uk {
        display: block;
        opacity: 1;
        transform: translateX(-55%) translateY(296px);
    }

    .card-country:hover .popup-france {
        display: block;
        opacity: 1;
        transform: translateX(-72%) translateY(296px);
    }

    .card-country:hover .popup-au {
        display: block;
        opacity: 1;
        transform: translateX(-82%) translateY(7px);
    }
}

    

</style>