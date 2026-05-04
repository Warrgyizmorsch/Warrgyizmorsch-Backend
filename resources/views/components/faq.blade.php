@php
    $visibleFAQs = 10;
    
    // Split into two columns
    $mid = ceil(min(count($faqs), $visibleFAQs) / 2);
    $leftFAQs = array_slice($faqs, 0, $mid);
    $rightFAQs = array_slice($faqs, $mid, $visibleFAQs);
@endphp

<section class="faq-section">
    <div class="container">
        <h2 class="faq-heading">Frequently Asked Questions</h2>

        <div class="faq-grid">
            <!-- Left Column -->
            <div class="faq-column">
                @foreach ($leftFAQs as $index => $faq)
                    <div class="faq-item">
                        <button onclick="toggleFAQ({{ $index }})" class="faq-question">
                            <span>{{ $faq['question'] }}</span>
                            <span id="icon-{{ $index }}" class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div id="answer-{{ $index }}" class="faq-answer">
                            {!! $faq['answer'] !!}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Column -->
            <div class="faq-column">
                @foreach ($rightFAQs as $index => $faq)
                    @php $adjustedIndex = $index + $mid; @endphp
                    <div class="faq-item">
                        <button onclick="toggleFAQ({{ $adjustedIndex }})" class="faq-question">
                            <span>{{ $faq['question'] }}</span>
                            <span id="icon-{{ $adjustedIndex }}" class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                        </button>
                        <div id="answer-{{ $adjustedIndex }}" class="faq-answer">
                            {!! $faq['answer'] !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    /* FAQ Section */
    .faq-section {
        background-color: #f7f7f7;
        padding: 40px 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .faq-heading {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .faq-grid {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .faq-column {
        width: 48%;
    }

    @media (max-width: 768px) {
        .faq-column {
            width: 100%;
        }
    }

    .faq-item {
        border-bottom: 1px solid #ccc;
    }

    .faq-question {
        width: 100%;
        text-align: left;
        font-size: 18px;
        font-weight: bold;
        background: none;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 15px 10px;
        color: #444;
    }

    .faq-icon {
        transition: transform 0.3s ease;
    }

    .faq-icon.rotate {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        padding: 0 10px;
        color: #666;
        font-size: 16px;
        transition: all 0.4s ease;
        opacity: 0;
    }

    .faq-answer.active {
        max-height: 300px;
        opacity: 1;
        padding: 10px;
    }
</style>

<script>
    let openIndex = null;

    function toggleFAQ(index) {
        const answer = document.getElementById(`answer-${index}`);
        const iconWrapper = document.getElementById(`icon-${index}`);

        // Close if already open
        if (openIndex === index) {
            answer.classList.remove("active");
            iconWrapper.classList.remove("rotate");
            openIndex = null;
        } else {
            // Close previously open
            if (openIndex !== null) {
                document.getElementById(`answer-${openIndex}`).classList.remove("active");
                document.getElementById(`icon-${openIndex}`).classList.remove("rotate");
            }

            // Open current
            answer.classList.add("active");
            iconWrapper.classList.add("rotate");
            openIndex = index;
        }
    }
</script>