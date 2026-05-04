<section class="why-slider-section">
    <div class="why-slider-container">
        <!-- use your theme title class -->
        <h2 class="new-section-title">{{ $sectionTitle }}</h2>
        <p class="why-subtitle">{{ $sectionDescription }}</p>

        <div class="swiper why-swiper">
            <div class="swiper-wrapper">
                @foreach ($cards as $card)
                    <div class="swiper-slide">
                        <div class="why-card">
                            <div class="card-inner">
                                <h3 class="card-title">{{ $card['title'] }}</h3>
                                <p class="card-desc">{{ $card['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="why-controls">
                <div class="swiper-button-prev why-prev"></div>
                <div class="swiper-button-next why-next"></div>
            </div>
        </div>
    </div>
</section>
<style>
  :root{
    --brand:#FC9118;
    --navy:#1C2C59;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --bg:#ffffff;
    --soft:#f8fafc;
    --ring: rgba(252,145,24,.18);
    --shadow: 0 14px 30px rgba(15,23,42,.08);
    --shadowHover: 0 22px 44px rgba(15,23,42,.14);
  }

  .why-slider-section{
    padding:30px 35px;
    max-width:1300px;
    margin:0 auto;
  }

  .why-slider-container{ text-align:center; }

  .why-subtitle{
    margin:10px 0 18px;
    color:var(--muted);
    line-height:1.7;
    text-align:left;
  }

  /* swiper space for bottom controls */
  .why-swiper{
    padding: 10px 0 70px !important; /* bottom controls space */
    position:relative;
  }

  /* Ensure slides stretch, cards equal height */
  .why-swiper .swiper-slide{
    height:auto;
    display:flex;
  }

  .why-card{
    width:100%;
    height:100%;
    min-height:260px;
    display:flex;
    flex-direction:column;
    background:linear-gradient(180deg, #fff 0%, #fff 55%, rgba(248,250,252,.9) 100%);
    border:1px solid rgba(229,231,235,.95);
    border-radius:20px;
    padding:22px;
    text-align:left;
    box-shadow: var(--shadow);
    position:relative;
    overflow:hidden;

    /* smooth animation */
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    will-change: transform;
  }

  /* soft glow accent blob */
  .why-card::before{
    content:"";
    position:absolute;
    top:-60px; right:-60px;
    width:160px; height:160px;
    background: radial-gradient(circle, rgba(252,145,24,.22), transparent 60%);
    filter: blur(0px);
    opacity:.9;
    pointer-events:none;
  }

  /* tiny underline progress bar */
  .why-card::after{
    content:"";
    position:absolute;
    left:18px;
    right:18px;
    bottom:14px;
    height:3px;
    background: rgba(252,145,24,.18);
    border-radius:999px;
    transform: scaleX(.15);
    transform-origin:left;
    transition: transform .35s ease;
  }

  /* top badge */
  .why-badge{
    width:42px;
    height:42px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: rgba(252,145,24,.12);
    border:1px solid rgba(252,145,24,.22);
    color: var(--brand);
    font-weight:800;
    flex: 0 0 auto;
    margin-bottom:14px;
  }

  .card-inner{
    display:flex;
    flex-direction:column;
    height:100%;
  }

  .card-title{
    margin:0 0 10px;
    font-size:1.08rem;
    font-weight:800;
    color:var(--text);
    line-height:1.35;
    letter-spacing:.1px;
  }

  .card-desc{
    margin:0;
    color:var(--muted);
    font-size:.96rem;
    line-height:1.75;
  }

  /* hover animation */
  .why-card:hover{
    transform: translateY(-8px);
    border-color: rgba(252,145,24,.35);
    box-shadow: var(--shadowHover);
  }

  .why-card:hover::after{
    transform: scaleX(1);
  }

  /* focus accessible */
  .why-card:focus-within{
    outline: none;
    box-shadow: 0 0 0 5px var(--ring), var(--shadowHover);
    border-color: rgba(252,145,24,.35);
  }

  /* ---------- Bottom controls: Prev/Next BELOW cards ---------- */
  .why-controls{
    position:absolute;
    left:0;
    right:0;
    bottom:5px;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:12px;
    z-index:10;
  }

  .why-prev,
  .why-next{
    position:static !important;
    transform:none !important;
    width:44px !important;
    height:44px !important;
    border-radius:20px !important;
    background:#fff !important;
    padding: 10px;
    border:1px solid var(--border) !important;
    box-shadow: 0 10px 22px rgba(15,23,42,.10) !important;
    transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    margin:0 !important;
  }

  .why-prev:hover,
  .why-next:hover{
    transform: translateY(-2px) !important;
    border-color: rgba(252,145,24,.45) !important;
    box-shadow: 0 14px 28px rgba(15,23,42,.14) !important;
  }

  .why-prev::after,
  .why-next::after{
    font-size:16px !important;
    font-weight:900 !important;
    color: var(--brand) !important;
  }

  @media (max-width:768px){
    .why-slider-section{ padding:30px 15px; }
    .why-card{ min-height: 250px; padding:18px; border-radius:18px; }
    .why-prev,.why-next{ width:42px !important; height:42px !important; border-radius:14px !important; }
    .why-controls{ bottom: 5px; }
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let swiperInstance;

    function getSlidesPerView() {
      const width = window.innerWidth;
      if (width >= 992) return 3;
      if (width >= 600) return 2;
      return 1;
    }

    function updateSwiper() {
      const swiperSlides = document.querySelectorAll(".why-swiper .swiper-slide");
      const totalSlides = swiperSlides.length;
      const slidesPerView = getSlidesPerView();
      const loopMode = totalSlides > slidesPerView;

      // show/hide controls when not needed
      document.querySelectorAll(".why-controls").forEach(el => {
        el.style.display = loopMode ? "flex" : "none";
      });

      if (swiperInstance) swiperInstance.destroy(true, true);

      swiperInstance = new Swiper(".why-swiper", {
        slidesPerView,
        spaceBetween: 24,
        loop: loopMode,
        watchSlidesProgress: true,
        observer: true,
        observeParents: true,

        autoplay: loopMode ? {
          delay: 3200,
          disableOnInteraction: false,
        } : false,

        navigation: {
          nextEl: ".why-next",
          prevEl: ".why-prev",
        },

        breakpoints: {
          0: { slidesPerView: 1, spaceBetween: 16 },
          600: { slidesPerView: 2, spaceBetween: 18 },
          992: { slidesPerView: 3, spaceBetween: 24 },
        },
      });

      // refresh after init to ensure equal height rendering
      setTimeout(() => swiperInstance.update(), 60);
    }

    updateSwiper();

    window.addEventListener("resize", function () {
      clearTimeout(window._swiperResizeTimer);
      window._swiperResizeTimer = setTimeout(updateSwiper, 200);
    });
  });
</script>
