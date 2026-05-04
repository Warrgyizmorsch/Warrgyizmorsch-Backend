

<section class="scholarship-section">
    <div class="scholarship-container">
        <div class="scholarship-text">
        <h2>{{ $scholarship['title'] }}</h2>
            <p>{{ $scholarship['desc'] }}</p>
            <p>{!! $scholarship['footer'] !!}</p>
        </div>
        <div class="scholarship-img">
            <img src="{{ asset($scholarship['image']) }}" loading="lazy" alt="Scholarships UK">
        </div>
    </div>

    <div class="scholarship-guide">
        <h3>{{ $scholarship['guide_title'] }}</h3>
        <ul>
            @foreach ($scholarship['guide_steps'] as $step)
                <li>{{ $step }}</li>
            @endforeach
        </ul>
    </div>
</section>

<style>.scholarship-section {
    padding: 30px 15px;
    background: #f9f9f9;
    font-family: 'Segoe UI', sans-serif;
    animation: fadeIn 1s ease-in;
}

.scholarship-container {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.scholarship-text {
    flex: 1 1 55%;
}

.scholarship-text h2 {
    font-size: 32px;
    margin-bottom: 15px;
    text-align: left;
}

.scholarship-text h2 span {
    color: #000;
    font-weight: 700;
    text-decoration: underline #ff891a 3px;
    text-underline-offset: 6px;
}

.scholarship-text p {
    font-size: 16px;
    line-height: 1.7;
    color: #333;
    margin-bottom: 15px;
}

.scholarship-img {
    flex: 1 1 40%;
    text-align: center;
}

.scholarship-img img {
    width: 100%;
    max-width: 400px;
    border-radius: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: floatImage 4s ease-in-out infinite;
}

/* Guide section */
.scholarship-guide {
    margin: 20px auto 0;
    max-width: 900px;
    background: #fff;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    animation: fadeInUp 1s ease-in-out;
}

.scholarship-guide h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #111;
}

.scholarship-guide ul {
    padding-left: 10px;
}

.scholarship-guide li {
    margin-bottom: 12px;
    font-size: 15px;
    color: #333;
    line-height: 1.6;
    position: relative;
    list-style: none;
}

.scholarship-guide li::before {
    content: '✔';
    color: #ff891a;
    font-weight: bold;
    margin-right: 8px;
}

/* Animations */
@keyframes floatImage {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeInUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Responsive */
@media (max-width: 768px) {
    .scholarship-container {
        flex-direction: column;
    }

    .scholarship-text, .scholarship-img {
        flex: 1 1 100%;
    }
}
</style>