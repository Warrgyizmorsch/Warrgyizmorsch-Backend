<section class="tab-section">
    <div class="tab-container">
        <div class="tabs">
            <!-- First button should match first tab-content that's active -->
            <button class="tab-button active" data-tab="documents">Documents Required</button>
            <button class="tab-button" data-tab="guide">Step by Step Guide for Visa Application</button>
        </div>

        <div class="tab-content-box">
            <!-- Documents Tab -->
            <div class="tab-content active" id="documents">
                <h3>{{ $documentContent['title'] }}</h3>
                <p>{{ $documentContent['desc'] }}</p>
                <ul>
                    @foreach ($documentContent['list'] as $item)
                        <li>{!! $item !!}</li>
                    @endforeach
                </ul>
                @isset($documentContent['footer'])
                    <p>{{ $documentContent['footer'] }}</p>
                @endisset
                <p>At WTS Study Abroad Consultants, we guide students through the process of assembling and organizing all necessary documents for the application without any irritancy. </p>
                <a href="/contact" target="_blank" class="study-guide-button" style="font-weight: 500; text-decoration:none;">Free Expert Consultation</a>
            </div>

            <!-- Guide Tab -->
            <div class="tab-content" id="guide">
                <h3>{{ $guideContent['title'] }}</h3>
                <p>{{ $guideContent['desc'] }}</p>
                <ol>
                    @foreach ($guideContent['list'] as $item)
                        <li>{!! $item !!}</li>
                    @endforeach
                </ol>
                @isset($guideContent['footer'])
                    <p>{{ $guideContent['footer'] }}</p>
                @endisset
                <p>At WTS Visa Consultancy, we help students with all aspects of the visa, making sure they meet all requirements for getting through successfully.</p>
                <a href="https://wa.me/919116076837?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F"
                    target="_blank" class="study-guide-button" style="font-weight: 500; text-decoration:none;">Free Expert
                    Consultation</a>
            </div>
        </div>
    </div>
</section>

<style>
  .tab-section {
    padding: 60px 20px;
    background-color: #f9f9f9;
}

.tab-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.tabs {
    display: flex;
    justify-content: center;
    background-color: #f0f0f0;
    border-bottom: 1px solid #e0e0e0;
    flex-wrap: wrap;
}

.tab-button {
    flex: 1 1 auto;
    padding: 15px 25px;
    background: transparent;
    border: none;
    font-weight: 600;
    color: #555;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
    position: relative;
    margin-top: 1rem;
}

.tab-button.active {
    background: #fff;
    color: #ffa500;
    border-bottom: 3px solid #ffa500;
    z-index: 1;
}

.tab-button:hover {
    background-color: #e0e0e0;
}

.tab-content-box {
    padding: 30px 25px;
}

.tab-content {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}

.tab-content.active {
    display: block;
}

.tab-content h3 {
    font-size: 22px;
    color: #1a1a1a;
    margin-bottom: 10px;
}

.tab-content p {
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
}

.tab-content ul {
    padding-left: 25px;
    margin-bottom: 20px;
    list-style-type: disc;
    color: #333;
    font-size: 16px;
    line-height: 1.7;
}

.tab-content ul li {
    margin-bottom: 15px;
    position: relative;
    padding-left: 10px;
}
.tab-content ul {
    list-style: none;
}

.tab-content ul li::before {
    content: '•';
    color: #ffa500;
    font-weight: bold;
    margin-right: 8px;
}

.tab-content ol {
    counter-reset: item;
    padding-left: 25px;
    margin-bottom: 20px;
    list-style-type: decimal;
    color: #333;
    font-size: 16px;
    line-height: 1.7;
}

.tab-content ol li {
    margin-bottom: 15px;
    position: relative;
    padding-left: 10px;
}
.tab-content ol li::marker {
    font-weight: bold;
    color: #ffa500; /* Orange */
}

.consult-button {
    background-color: #ffa500; /* Base orange */
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: float 2s infinite ease-in-out;
}

.consult-button:hover {
    background-color: #e69500; /* Slightly darker orange */
    transform: scale(1.05);
}

/* Floating animation */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
    100% {
        transform: translateY(0px);
    }
}


@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .tabs {
        flex-direction: column;
    }

    .tab-button {
        text-align: center;
        font-size: 16px;
    }

    .tab-content-box {
        padding: 20px 15px;
    }

    .tab-content h3 {
        font-size: 20px;
    }
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {
                tabButtons.forEach(btn => btn.classList.remove("active"));
                tabContents.forEach(tab => tab.classList.remove("active"));

                button.classList.add("active");
                document.getElementById(button.dataset.tab).classList.add("active");
            });
        });
    });
</script>
