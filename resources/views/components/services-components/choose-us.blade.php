<section class="choose-us">
        <h2 class="title">Why Choose Us?</h2>
        <p class="subtitle">We ensure top-quality SOPs tailored to your visa requirements.</p>

        <div class="choose-container">
            <div class="choose-card">
                <i class="fas fa-file-alt"></i>
                <h3>100% Unique & Plagiarism-Free</h3>
                <p>Every SOP is crafted from scratch to reflect your personal journey.</p>
            </div>
            
            <div class="choose-card">
                <i class="fas fa-thumbs-up"></i>
                <h3>Higher Visa Approval Rates</h3>
                <p>Our SOPs are structured to meet visa officer expectations.</p>
            </div>

            <div class="choose-card">
                <i class="fas fa-clock"></i>
                <h3>Fast Delivery</h3>
                <p>Get your SOP within 24-48 hours with express services.</p>
            </div>

            <div class="choose-card">
                <i class="fas fa-user-check"></i>
                <h3>Expert Writers</h3>
                <p>Our team consists of professionals with experience in visa SOP writing.</p>
            </div>
        </div>
    </section>
    <style>

/* Section Styling */
.choose-us {
    text-align: center;
    padding: 60px 20px;
    background-color: #fff;
}

.title {
    font-size: 32px;
    color: #333;
    font-weight: 600;
    opacity: 0;
    animation: fadeInUp 1s ease forwards;
}

.subtitle {
    font-size: 1.2rem;
    color: #999;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeInUp 1s ease forwards 0.3s;
}

/* Container */
.choose-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    max-width: 1000px;
    margin: 0 auto;
}

/* Cards */
.choose-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    opacity: 0;
    animation: fadeInUp 1s ease forwards 0.5s;
}

.choose-card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
}

/* Icons */
.choose-card i {
    font-size: 2.5rem;
    color: #ffcc00;
    margin-bottom: 15px;
}

/* Title */
.choose-card h3 {
    font-size: 1.5rem;
    color: #222;
    margin-bottom: 10px;
}

/* Description */
.choose-card p {
    font-size: 1rem;
    color: #555;
}

/* Fade-In Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>