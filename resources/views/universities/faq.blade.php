<style>
  /* FAQ Container */
  .uni-faq {
    margin-top: 10px;
  }

  .uni-faq-item {
    border-bottom: 1px solid #ddd;
    padding: 12px 0;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .uni-faq-question {
    font-size: 14px;
    font-weight: 500;
    position: relative;
    padding-right: 20px;
    /* Prevents text from overlapping the icon */
    color: #1a2a3a;
    user-select: none;
    /* Prevents text highlighting on double click */
  }

  /* Chevron Icon */
  .uni-faq-question::after {
    content: "⌄";
    position: absolute;
    right: 0;
    font-size: 16px;
    top: 50%;
    transform: translateY(-50%);
    transition: transform 0.3s ease;
  }

  .uni-faq-answer {
    display: none;
    font-size: 13px;
    color: #666;
    margin-top: 8px;
    line-height: 1.5;
    animation: fadeIn 0.3s ease;
  }

  /* Active State */
  .uni-faq-item.active .uni-faq-answer {
    display: block;
  }

  .uni-faq-item.active .uni-faq-question {
    color: #E87722;
    /* Optional: Highlights the question when open */
  }

  .uni-faq-item.active .uni-faq-question::after {
    content: "⌃";
  }

  /* Smooth fade-in animation for the text */
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-5px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* CTA */
  .uni-faq-cta {
    margin-top: 20px;
  }

  .uni-faq-cta button {
    width: 100%;
    padding: 12px;
    background: #E87722;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
  }

  .uni-faq-cta button:hover {
    background: #c96210;
  }
</style>

<div>
  <div class="uni-section-title">
    <h4>FAQs</h4>
  </div>

  <div class="uni-faq">
    @php
      $faqs = [];
      if ($detail && !empty($detail->faq_content)) {
        $decoded = json_decode($detail->faq_content, true);
        $faqs = is_array($decoded) ? $decoded : [];
      }
    @endphp

    @if(count($faqs) > 0)
      @foreach($faqs as $faq)
        <div class="uni-faq-item">
          <div class="uni-faq-question">{{ $faq['question'] ?? '' }}</div>
          <div class="uni-faq-answer">{{ $faq['answer'] ?? '' }}</div>
        </div>
      @endforeach
    @else
      <p style="color: #666; font-size: 14px;">No FAQs available at the moment.</p>
    @endif
  </div>

  <div class="uni-faq-cta">
    <button>Book Free Consultation</button>
  </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // 1. Grab all FAQ items
    const faqItems = document.querySelectorAll('.uni-faq-item');

    faqItems.forEach(item => {
      // 2. We only want the click to trigger on the question part
      const question = item.querySelector('.uni-faq-question');

      question.addEventListener('click', () => {
        // Check if the one we clicked is already open
        const isAlreadyActive = item.classList.contains('active');

        // 3. Optional Accordion Logic: Close all items first
        faqItems.forEach(otherItem => {
          otherItem.classList.remove('active');
        });

        // 4. If the item wasn't already open, open it now
        if (!isAlreadyActive) {
          item.classList.add('active');
        }
      });
    });
  });
</script>