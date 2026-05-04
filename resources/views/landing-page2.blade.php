@extends('layouts.app')
@section('content')

    <!-- Add in your <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    @php
        $videos = [
            (object) ['url' => 'https://www.youtube.com/shorts/Izz1Wrb0lIA', 'title' => 'Ayushi Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/LWtrbwebgvk', 'title' => 'Prakhar Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/Kf-akkSWaeo', 'title' => 'Amit Zala'],
            (object) ['url' => 'https://www.youtube.com/shorts/eI4pM2c9Yxg', 'title' => 'Sumandeep Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/Otkbyy93KeQ', 'title' => 'Deepali Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/BgGml15UssU', 'title' => 'Abhishek Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/sZoeyhrQFc8', 'title' => 'Abid Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/RRVooWNDhCQ', 'title' => 'Sajay'],
            (object) ['url' => 'https://www.youtube.com/shorts/m4CCvGqcDD0', 'title' => 'Shubham Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/P4bsm9o-4ro', 'title' => 'Soundarya Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/5ywBBjfkWwk', 'title' => 'Jasmine Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/RH8nEhgewig', 'title' => 'Kishore Review'],
            (object) ['url' => 'https://www.youtube.com/shorts/FhdcrdpR0iM', 'title' => 'Arooj Review'],
        ];
        $firstVideoId = Str::Last($videos[0]->url, '/');
    @endphp

    <!-- Hero section  -->
 <section id="bookingSection" class="hero-main">
    <div class="swiper-wrapper">
      <!-- Single Slide -->
      <div class="swiper-slide">
        <div class="hero-content-wrapper">
          <div class="home-hero-content">
            <p
              style="font-size: 2.7rem; font-weight: bold; line-height: 2.7rem; margin-bottom: 12px; text-align: left;">
               UK Study <br /> Visa Consultancy & Student Visa Experts
            </p>
            <h1 class="hero-title">
              <span style="color: #FC9118;">Hassle-Free UK Study Visa Consultancy</span> 
            </h1>
            <span
              style="display: block; text-align: left; margin: 0 auto; color: black; font-weight: 400; font-size: 16px; line-height: 23px;">
             WTS Visa Consultancy provides expert UK study visa guidance for students planning to study in the UK for Jan 2026 intake.

            </span>

            <div class="features-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px 20px; margin-top: 20px; margin-bottom: 20px; text-align: left;">
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid faafter-check-circle" style="color: #FC9118;"></i>
                <span>Scholarship Guidance</span>
              </div>
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid fa-check-circle" style="color: #FC9118;"></i>
                <span>Free Eligibility Check</span>
              </div>
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid fa-check-circle" style="color: #FC9118;"></i>
                <span>Airport Pickup Assistance</span>
              </div>
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid fa-check-circle" style="color: #FC9118;"></i>
                <span>24/7 Expert Guidance</span>
              </div>
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid fa-check-circle" style="color: #FC9118;"></i>
                <span>Document Verification</span>
              </div>
              <div class="feature" style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #333;">
                <i class="fa-solid fa-check-circle" style="color: #FC9118;"></i>
                <span>Student Visa Specialists</span>
              </div>
            </div>

            <span class="tip" style="display: block; font-size: 14px; color: #555; padding:0px; text-align: left; margin-bottom:0px;">
              Enjoy free services from A to A – application to accommodation, ensuring a smooth visa process from start to finish.
            </span>

            
            <div style="margin-bottom: 30px; text-align: left;">
              <h3 style="color: #FC9118; font-weight: 600; text-align: left">Contact Us: </h3>
              <a href="https://wa.me/918000915743?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F" target="_blank" class="study-guide-button" style="display: inline-flex; align-items: center; gap: 6px;
                  background-color: #25D366; color: #fff; border: 2px solid #fff; border-radius: 11px;
                  padding: 10px 16px; font-size: 18px; font-weight: 600; text-decoration: none;
                  transition: all 0.3s ease-in-out;">
                <img src="/new-home-images/svg-icons/black-whatsapp.svg" alt="WhatsApp"
                  style="height: 28px; filter: brightness(0) invert(1);">
                +91 8000915743
              </a>
            </div>
          </div>

           <div  class="hero-form">
    @include('./components/landing-registration-form2')
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JS (for single slide animations only) -->
<!-- Minimal CSS for floating cards -->
<style>
   .hero-main {
        background-color: #F7F4EF !important;
        margin-top: 90px !important;
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
          display:flex !important;
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

 

<!-- new my New Boxes section -->
<div class="hero-statss">
    <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-1.png" alt="University Shortlisting">
                    </div>
                    <h3 class="new-box-title">University Shortlisting</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-2.png" alt="Test Preparation">
                    </div>
                    <h3 class="new-box-title">Test Preparation</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-3.png" alt="Application Guidance">
                    </div>
                    <h3 class="new-box-title">Application Guidance</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-4.png" alt="Education Loan">
                    </div>
                    <h3 class="new-box-title">Education Loan</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-5.png" alt="Visa Support">
                    </div>
                    <h3 class="new-box-title">Travel/Visa Assistance</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-6.png" alt="Accommodation service">
                    </div>
                    <h3 class="new-box-title">Accommodation Service</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-7.png" alt="Work Aborad">
                    </div>
                    <h3 class="new-box-title">Work Abroad</h3>
                </div>

                <div class="new-box-item">
                    <div class="new-box-card">
                        <img src="/new-home-images/new-box-2.png" alt="Pre-Departure Briefing">
                    </div>
                    <h3 class="new-box-title">Forex Fund Transfer</h3>
                </div>

</div>

    <style>
     .hero-statss {
    width: 100%;
    margin: auto;
    background-color: #1C2C59;
    color: white;
    font-weight: 600;
    font-size: 18px;
    padding: 20px 140px;
    /* border-radius: 12px; */
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 2fr));
    gap: 25px;
}


        /* Section base */
        .new-box-section {
            padding: 30px;
            margin-top: -30px;
            background-color: #1A1A1A;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .new-box-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Grid */
        .new-box-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
            gap: 10px;
        }

        /* Item wrapper: title + card */
        .new-box-item {
            display: flex;
            flex-direction: column;
            /* align-items: center; */
            align-items:start;
        }

        /* Title outside box */
        .new-box-title {
            font-size: 0.8rem;
            font-weight: 600;
            margin: 10px 0px;
            color: white;
            /* theme color */
        }

        /* Box/card itself */
        .new-box-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform .3s, box-shadow .3s;
        }

        .new-box-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .new-box-card img {
            max-width: 55px;
            height: auto;
        }

         @media (max-width: 992px) {
        .hero-statss {
            padding:100px 6%;
        }

         }
          @media (max-width: 600px) {
         .hero-statss {
            padding:70px 6%;
        }         }
    </style>

    

    <!-- update Table section -->
 <section class="travel-service-section">
  <div class="travel-service-container">
    <h2 class="section-title"> <span class="section-title-span">UK Student Travel & Post-Visa Support Services</span></h2>

    <div class="travel-service-grid">
      <div class="travel-service-card">
        <div class="travel-icon"><i class="fa-solid fa-plane-departure"></i></div>
        <h3>Airport Pick-Up</h3>
        <p>Hassle-free airport pickup for a smooth arrival.</p>
      </div>

      <div class="travel-service-card">
        <div class="travel-icon"><i class="fa-solid fa-school"></i></div>
        <h3>Virtual Tours</h3>
        <p>Explore universities and cities online before travel.</p>
      </div>

      <div class="travel-service-card">
        <div class="travel-icon"><i class="fa-solid fa-file-circle-check"></i></div>
        <h3>Document Assistance</h3>
        <p>Complete support from application to visa approval.</p>
      </div>

      <div class="travel-service-card">
        <div class="travel-icon"><i class="fa-solid fa-headset"></i></div>
        <h3>24/7 Support</h3>
        <p>Expert guidance anytime during travel & settlement.</p>
      </div>
    </div>
  </div>
</section>

 <!-- Table section  -->
    <!-- <section class="travel-service-table">
        <div class="travel-service-container">
            <h2 class="section-title">Travel <span>Support Services</span></h2>
            <table class="travel-service">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: center;">Our Travel Support Services</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>✈️</td>
                        <td>Airport Pick-Up</td>
                        <td>Hassle-free airport pickup for a smooth arrival</td>
                    </tr>
                    <tr>
                        <td>🏫</td>
                        <td>Virtual Tours</td>
                        <td>Explore universities and cities online before travel</td>
                    </tr>
                    <tr>
                        <td>📄</td>
                        <td>Document Assistance</td>
                        <td>Complete support from application to visa approval</td>
                    </tr>
                    <tr>
                        <td>📞</td>
                        <td>24/7 Support</td>
                        <td>Expert guidance anytime during travel & settlement</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section> -->


    <style>
        /* updated Table css */
        /* ===== Section Styling ===== */
.travel-service-section {
  width: 100%;
  background: #f5f7fc61;
  padding: 70px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.travel-service-container {
  max-width: 1100px;
  width: 100%;
  text-align: center;
}

/* ===== Title Styling ===== */
.section-title {
  font-size: 2.2rem;
  font-weight: 700;
  color: #1C2C59;
  margin-bottom: 15px;
}

.section-title-span{
  color:#1C2C59 !important;
}

.section-subtitle {
  font-size: 1rem;
  color: #555;
  margin-bottom: 40px;
}

/* ===== Card Grid ===== */
.travel-service-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 25px;
}

/* ===== Individual Card ===== */
.travel-service-card {
  background: #ffffff;
  padding: 30px 20px;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.travel-service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

/* ===== Icon & Text ===== */
.travel-icon i{
  font-size: 2.5rem;
  color:  var(--primary-color);;
  margin-bottom: 15px;
}

.travel-service-card h3 {
  font-size: 1.2rem;
  font-weight: 600;
  color: #1C2C59;
  margin-bottom: 10px;
}

.travel-service-card p {
  font-size: 0.95rem;
  color: #666;
  line-height: 1.5;
}

/* ===== Responsive Design ===== */
@media (max-width: 600px) {
  .section-title {
    font-size: 1.7rem;
  }

  .travel-service-card {
    padding: 25px 15px;
  }

  .travel-icon {
    font-size: 2rem;
  }
}

    </style>

    <!-- sub hero section -->
    <section class="sub-hero">
        <div class="sub-hero-content">
            <div class="sub-hero-text">
                <h2>Start Your Journey</h2>
                <p>Studying in the UK is a dream for many students worldwide, thanks to its prestigious universities, high-quality education, and global career opportunities. At WTS Visa Consultancy, we specialize in helping students navigate the complex process of studying abroad, from choosing the right university to securing a student visa. The UK is home to some of the oldest and most respected institutions, ensuring that students receive a world- class education that is recognized internationally. Moreover, the country’s diverse culture, student-friendly cities, and vast academic resources make it an excellent place for personal and professional growth. Whether you want to pursue undergraduate, postgraduate, or research programs, the UK provides a supportive environment that fosters innovation and excellence. With our expert guidance, you can embark on your academic journey in the UK with confidence and ease</p>
            </div>
            <div class="sub-hero-img">
                <img src="/images/uk-bg.png" loading="lazy" alt="Study in uk">
            </div>
        </div>
    </section>

    


    <!-- Client Testimonials  -->
    <section class="video-gallery-section">
        <div class="container">
            <h2 class="new-section-title">Testimonials</h2>

            <!-- Swiper -->
            <div class="swiper video-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $index => $video)
                        @php
    $videoId = Str::afterLast($video->url, '/');
    $loadingAttr = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
                        @endphp
                        <div class="swiper-slide">
                            <div class="video-card">
                                <div class="video-wrapper">
                                    <div class="youtube-facade" data-video-id="{{ $videoId }}"
                                        data-image="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                        onclick="loadYoutube(this)">
                                        <img src="{{ $video->image ?? 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg' }}"
                                            {!! $loadingAttr !!} alt="{{ $video->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Custom Navigation -->
                <button class="custom-swiper-prev"><img src="/new-home-images/svg-icons/right-arrow.svg" style="transform: rotate(180deg); height: 20px;" alt="left-arrow"></button>
                <button class="custom-swiper-next"><img src="/new-home-images/svg-icons/right-arrow.svg" style="height: 20px;" alt="right-arrow"></button>
            </div>
        </div>
    </section>
    
    <style>
        
       /* Testimonial Section CSS Started  */
    .video-gallery-section {
        padding: 35px;
        background: #ffffff;
        max-width: 1300px;
        margin: 0 auto;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .video-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .video-card:hover .youtube-facade img {
        transform: scale(1.05);
        transition: transform 0.3s ease-in-out;
    }

    .video-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%;
        /* square */
        background: #000;
        border-radius: 6px;
        overflow: hidden;
    }

    .youtube-facade {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: #000;
        cursor: pointer;
    }

    .youtube-facade img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .youtube-facade::after {
        content: '';
        font-size: 3rem;
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 768px) {
        .video-gallery-section {
            padding: 35px 15px;
        }
    }

    /* Testimonial Section CSS Ended  */
    </style>
    <script>
        function scrollSlider(direction) {
            const slider = document.getElementById('videoSlider');
            const slideWidth = slider.querySelector('.video-slide').offsetWidth + 20;
            slider.scrollLeft += direction * slideWidth;
        }

        function loadYoutube(el) {
            const videoId = el.getAttribute('data-video-id');
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            el.innerHTML = '';
            el.appendChild(iframe);
        }
    </script>


        <!-- 5 Steps  -->
    <section class="process-section" id="how-it-works">
  <div class="process-container">
    <h2 class="process-title">How It Works – <span>5 Simple Steps to Study in the UK</span></h2>
    <p class="process-subtitle">Our experts make the process smooth from start to finish.</p>

    <div class="process-timeline">
      <div class="process-step step1">
        <div class="step-circle">1</div>
        <h3>Free Consultation & Profile Check</h3>
        <p>We analyze your goals, background, and eligibility for the best options.</p>
      </div>

      <div class="process-step step2">
        <div class="step-circle">2</div>
        <h3>Course & Country Selection</h3>
        <p>Get expert help choosing the right program and study destination.</p>
      </div>

      <div class="process-step step3">
        <div class="step-circle">3</div>
        <h3>Documentation & Admission Filing</h3>
        <p>We handle your paperwork to ensure a seamless application process.</p>
      </div>

      <div class="process-step step4">
        <div class="step-circle">4</div>
        <h3>Visa Preparation & Interview Training</h3>
        <p>Mock sessions and visa guidance to boost your confidence.</p>
      </div>

      <div class="process-step step5">
        <div class="step-circle">5</div>
        <h3>Approval & Post-Landing Support</h3>
        <p>We stay with you even after visa approval for your smooth transition.</p>
      </div>
    </div>
  </div>
</section>


<style>
  /* === Section Wrapper === */
  .process-section {
    background: #f5f7fc61;
    padding: 80px 20px;
    text-align: center;
  }

  /* === Container === */
  .process-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* === Title === */
  .process-title {
    font-size: 32px;
    font-weight: 700;
    color: #1d263b;
    margin-bottom: 10px;
  }

  .process-title span {
    color: var(--primary-color);
  }

  .process-subtitle {
    color: #555;
    font-size: 16px;
    margin-bottom: 60px;
  }

  /* === Timeline Grid === */
  .process-timeline {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 30px;
    position: relative;
  }

  /* Connector Line */
  .process-timeline::before {
    content: "";
    position: absolute;
    top: 35px;
    left: 5%;
    right: 5%;
    height: 3px;
    background: var(--primary-color);
    z-index: 0;
  }

  /* === Step Card === */
  .process-step {
    background: #fff;
    border-radius: 12px;
    padding: 30px 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }

  /* Default hover (fallback) */
  .process-step:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 25px rgba(255, 204, 0, 0.4);
  }

  /* === Step Circle === */
  .step-circle {
    background: var(--primary-color);
    color: #1d263b;
    font-weight: bold;
    font-size: 18px;
    width: 45px;
    height: 45px;
    line-height: 45px;
    border-radius: 50%;
    margin: 0 auto 15px;
    position: relative;
    z-index: 2;
text-align: center;
  }

  /* === Text === */
  .process-step h3 {
    font-size: 18px;
    color: #1d263b;
    margin-bottom: 10px;
    font-weight: 600;
  }

  .process-step p {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
  }

  /* === Unique Hover Animations === */

  /* Step 1 – Scale Up */
  .step1:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 204, 0, 0.4);
  }

  /* Step 2 – Rotate Slightly */
  .step2:hover {
    transform: rotate(2deg);
    box-shadow: 0 8px 25px rgba(255, 204, 0, 0.35);
  }

  /* Step 3 – Glow Effect */
  .step3:hover {
    box-shadow: 0 0 20px rgba(255, 204, 0, 0.6);
  }

  /* Step 4 – Swing Animation */
  .step4:hover {
    animation: swing 0.6s ease;
  }

  @keyframes swing {
    20% { transform: rotate(3deg); }
    40% { transform: rotate(-3deg); }
    60% { transform: rotate(2deg); }
    80% { transform: rotate(-2deg); }
    100% { transform: rotate(0deg); }
  }

  /* Step 5 – Bounce Animation */
  .step5:hover {
    animation: bounce 0.6s ease;
  }

  @keyframes bounce {
    0% { transform: translateY(0); }
    30% { transform: translateY(-8px); }
    60% { transform: translateY(4px); }
    100% { transform: translateY(0); }
  }

  /* === Responsive Design === */
  @media (max-width: 992px) {
    .process-timeline {
      grid-template-columns: repeat(2, 1fr);
      gap: 25px;
    }

    .process-timeline::before {
      display: none;
    }
  }

  @media (max-width: 600px) {
    .process-timeline {
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .process-step {
      text-align: left;
      padding: 25px 18px;
    }

    .step-circle {
      margin: 0 0 10px 0;
    }

    .process-title {
      font-size: 26px;
    }

    .process-subtitle {
      font-size: 15px;
      margin-bottom: 40px;
    }
  }
</style>


         <!-- Services Section -->
<section class="new-home-service-section">
        <div class="container">
            <h2 class="new-section-title">
               Our UK Study Services – Complete End-to-End Consultanc
            </h2>

            <div class="new-home-service-grid">
            
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;1 <br />Course & University Selection
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/smooth-transition.webp" class="new-home-service-image" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;2 <br />Getting Admissions
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/university.webp" class="new-home-service-image" style="height: 140px; width: 140px; border-bottom-right-radius: 20px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;3<br />SOP / Scholarship Essays
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/studying.webp" class="new-home-service-image" style="bottom: -28px; right: -18px; height: 180px; width: 180px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;4<br />Visa Assistance
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/pass-visa.webp" class="new-home-service-image" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;5 <br />Mock Interviews
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/teaching.webp" class="new-home-service-image" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;6 <br />Travel & Accommodation
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/plane-go.webp" class="new-home-service-image" style="bottom: -24px; height: 160px; width: 160px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;7 <br />Free Profile Evaluation
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/diary.webp" class="new-home-service-image" style="height: 100px; width: 100px;" alt="Decorative">
                </div>
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;8 <br />Education Loan Assistance
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/pass-visa.webp" class="new-home-service-image" alt="Decorative">
                </div>
                
                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;9<br />Post Landing Services
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/scholar-blue.webp" class="new-home-service-image" style="bottom: -10px;" alt="Decorative">
                </div>

                <div class="new-home-service-card">
                    <h3 class="new-home-service-card-title">
                        Step&nbsp;10 <br />Expert Counseling
                    </h3>
                    <img src="/new-home-images/svg-icons/plus.svg" class="new-home-service-icon" alt="Plus Icon">
                    <img src="/new-home-images/discussion.webp" class="new-home-service-image" style="bottom: -15px; right: -10px; height: 160px; width: 160px;" alt="Decorative">
                </div>
            </div>
        </div>

        <!-- Modal Overlay -->
        <div class="new-service-modal-overlay"></div>

        <!-- Modal -->
        <div class="new-service-modal">
            <button class="new-service-close">&times;</button>
            <div class="new-service-content">
                <h3 class="new-service-title" style="margin: 0;"></h3>
                <p class="new-service-text">
                    Detailed information about the selected service will appear here.
                </p>
            </div>
        </div>
    </section>

    <style>
         .new-service-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        opacity: 0;
        visibility: hidden;
        width: 80%;
        max-width: 700px;
        max-height: 40%;
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        overflow-y: auto;
        z-index: 1600;
        transition: all 0.4s ease;
    }
 @media (max-width: 768px) {
  .new-service-modal {
 width: 80%;
        max-width: 700px;
        max-height: 80%;
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

<script>
    // For Section title

document.addEventListener("DOMContentLoaded", function () {
    const titles = document.querySelectorAll(".new-section-title");
    const items = document.querySelectorAll(".support-item");
    const journeycards = document.querySelectorAll(".new-journey-card");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                } else {
                    entry.target.classList.remove("visible"); // animate every time
                }
            });
        },
        { threshold: 0.1 }
    );

    titles.forEach((title) => observer.observe(title));
    items.forEach((item) => observer.observe(item));
    journeycards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 0.2}s`;
        observer.observe(card);
    });
});

// Top Countries Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const list = document.getElementById("countryList");
    const cards = list.querySelectorAll(".new-country-card");
    const dotsWrap = document.getElementById("scrollDots");
    const countryData = window.countryData; // data from Blade
    const mainImg = document.getElementById("countryImage");
    const listEl = document.getElementById("countryFeatures");
    const exploreBtn = document.getElementById("exploreBtn");

    // build dots
    const pageSize = 5;
    const pages = Math.ceil(cards.length / pageSize);
    for (let i = 0; i < pages; i++) {
        const dot = document.createElement("span");
        if (i === 0) dot.classList.add("active");
        dotsWrap.appendChild(dot);
    }
    const dots = dotsWrap.querySelectorAll("span");

    // highlight dot based on scroll
    list.addEventListener("scroll", () => {
        const cardHeight = cards[0].offsetHeight + 15;
        const page = Math.round(list.scrollTop / (cardHeight * pageSize));
        dots.forEach((d, i) => d.classList.toggle("active", i === page));
    });

    // Smooth fade function
    function fadeElement(el, newContent) {
        el.style.transition = "opacity 0.5s";
        el.style.opacity = 0; // fade out

        setTimeout(() => {
            if (el.tagName === "IMG") {
                el.src = newContent.src;
                el.alt = newContent.alt;
            } else {
                el.innerHTML = newContent;
            }
            el.style.opacity = 1; // fade in
        }, 500); // match transition
    }

    // country-switch logic
    cards.forEach((card) => {
        card.addEventListener("click", () => {
            document
                .querySelector(".new-country-card.active")
                ?.classList.remove("active");
            card.classList.add("active");

            const key = card.dataset.country;
            const data = countryData[key];

            // fade main image
            fadeElement(mainImg, { src: data.image, alt: data.name });

            // fade features list
            const newFeaturesHTML = data.features
                .map(
                    (f) =>
                        `<li style="display:flex;align-items:center;gap:8px;">
                            <img src="/new-home-images/svg-icons/check-circle.svg" style="height:20px;"> ${f}
                         </li>`
                )
                .join("");
            fadeElement(listEl, newFeaturesHTML);

            if (exploreBtn) {
                exploreBtn.href = data.route;
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const list = document.querySelector("#countryList");
    const section = document.querySelector(".new-countries-section");
    if (!list || !section) return; // stop if elements not found

    let autoScrollTimer = null;
    let directionDown = true;

    function autoScroll() {
        const step = list.clientHeight * 0.9; // about one viewport of the list

        if (directionDown) {
            list.scrollBy({ top: step, behavior: "smooth" });
            // reached bottom? reverse next time
            if (list.scrollTop + list.clientHeight >= list.scrollHeight - 2) {
                directionDown = false;
            }
        } else {
            list.scrollBy({ top: -step, behavior: "smooth" });
            if (list.scrollTop <= 0) {
                directionDown = true;
            }
        }
    }

    function startLoop() {
        if (!autoScrollTimer) {
            // run first step immediately, then every 3 s
            autoScroll();
            autoScrollTimer = setInterval(autoScroll, 6000);
        }
    }

    function stopLoop() {
        if (autoScrollTimer) {
            clearInterval(autoScrollTimer);
            autoScrollTimer = null;
        }
    }

    // Observe when the whole section enters/leaves viewport
    const observer = new IntersectionObserver(
        (entries) => {
            const entry = entries[0];
            if (entry.isIntersecting) {
                startLoop();
            } else {
                stopLoop();
            }
        },
        { threshold: 0.3 } // start when ~30 % visible
    );

    observer.observe(section);
});
// Top Countries Section JS Ended
// Testimonial Section JS Started
let currentVideo = null;

function loadYoutube(el) {
    // Stop previous video if exists
    if (currentVideo && currentVideo !== el) {
        const vid = currentVideo.dataset.videoId;
        const customImg = currentVideo.dataset.image; // ✅ our custom image
        currentVideo.innerHTML = `<img src="${customImg}" 
                                        alt="" style="width:100%; height:100%; object-fit:cover;">`;
    }

    const videoId = el.getAttribute("data-video-id");
    const iframe = document.createElement("iframe");
    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    iframe.setAttribute("frameborder", "0");
    iframe.setAttribute("allowfullscreen", "");
    iframe.setAttribute(
        "allow",
        "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    );
    iframe.style.width = "100%";
    iframe.style.height = "100%";

    el.innerHTML = "";
    el.appendChild(iframe);

    currentVideo = el;

    // ⏸ Stop swiper autoplay when video starts
    if (window.videoSwiper) {
        window.videoSwiper.autoplay.stop();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    window.videoSwiper = new Swiper(".video-swiper", {
        slidesPerView: 3,
        spaceBetween: 15,
        loop: true,
        navigation: {
            nextEl: ".custom-swiper-next",
            prevEl: ".custom-swiper-prev",
        },
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        speed: 800,
        breakpoints: {
            0: { slidesPerView: 1 },
            576: { slidesPerView: 2 },
            768: { slidesPerView: 2.5 },
            992: { slidesPerView: 3.5 },
        },
    });
});
// Testimonial Section JS Ended

// 8 Step Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".new-accordion .new-item");
    const imgBox = document.getElementById("new-stepImage");

    // helper for smooth image change
    function animateImage(el, newSrc, effect = "zoom") {
        let className = "";

        if (effect === "zoom") className = "img-zoom";
        if (effect === "slide") className = "img-slide";
        if (effect === "flip") className = "img-flip";

        el.classList.add(className);

        setTimeout(() => {
            el.src = newSrc;
            el.classList.remove(className);
        }, 400); // time should match transition
    }

    items.forEach((item) => {
        const header = item.querySelector(".new-header");
        const content = item.querySelector(".new-content");

        header.addEventListener("click", () => {
            const isOpen = header.classList.contains("active");

            // Close all
            items.forEach((i) => {
                i.querySelector(".new-header").classList.remove("active");
                i.querySelector(".new-content").style.maxHeight = null;
            });

            // Toggle current
            if (!isOpen) {
                header.classList.add("active");
                content.style.maxHeight = content.scrollHeight + "px";
                animateImage(imgBox, item.dataset.img, "zoom"); // smooth image change
            }
        });
    });
});

// 8 Step Section JS Ended
// FAQ Section JS Started
document.querySelectorAll(".new-faq-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        const content = btn.nextElementSibling;
        const open = content.classList.contains("open");
        document.querySelectorAll(".new-faq-content").forEach((c) => {
            c.style.maxHeight = null;
            c.classList.remove("open");
        });
        document
            .querySelectorAll(".new-faq-btn")
            .forEach((b) => b.classList.remove("active"));
        if (!open) {
            content.classList.add("open");
            content.style.maxHeight = content.scrollHeight + "px";
            btn.classList.add("active");
        }
    });
});
// FAQ Section JS Ended|

// Services Section JS Started
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".new-home-service-card");
    const modal = document.querySelector(".new-service-modal");
    const overlay = document.querySelector(".new-service-modal-overlay");
    const closeBtn = document.querySelector(".new-service-close");
    const titleBox = document.querySelector(".new-service-title");
    const textBox = document.querySelector(".new-service-text");

    const details = {
        1: `
        <div class="service-details-container">
        <p>Find the right fit for your profile with expert guidance in selecting suitable courses and universities tailored to your career goals.</p>
        </div>
    `,
        2: `
        <div class="service-details-container">
        <p>Quick and accurate application support to maximize your chances of securing admission in your dream university.</p>
        </div>
       
    `,
        3: `
        <div class="service-details-container">
        <p>Professionally drafted Statements of Purpose and Scholarship Essays to ensure maximum acceptance and funding opportunities.</p>
                </div>
        
    `,
        4: `
        <div class="service-details-container">
        <p>Hassle-free visa application and documentation support to make your process smooth and stress-free.</p>
             </div>
       
    `,
        5: `
        <div class="service-details-container">
        <p>Prepare with confidence through embassy interview practice sessions designed to boost your success rate.</p>
          </div>
       
    `,
        6: `
        <div class="service-details-container">
        <p>Complete arrangements for flights, stay, and accommodations for a seamless journey abroad.</p>
             </div>
        
    `,
        7: `
        <div class="service-details-container">
        <p>Personalized guidance for your academic and career goals through free expert profile evaluations.</p>
               </div>
       
    `,
        8: `
        <div class="service-details-container">
        <p>Get the best deals at low interest rates with complete support for securing education loans.</p>
       </div>
       
    `,
        9: `
        <div class="service-details-container">
        <p>SIM, Forex, Bank Account, and settling-in assistance to help you adjust quickly after arriving.</p>
         </div>
       
    `,
        10: `
        <div class="service-details-container">
        <p>Get trusted guidance from certified visa specialists and counselors throughout your journey.</p>
         </div>
       
    `,
    };

    let activeCard = null;
    let closeTimeout = null; // store timeout ID

    cards.forEach((card, i) => {
        card.addEventListener("click", () => {
            // If modal is closing, cancel that closing action
            if (closeTimeout) {
                clearTimeout(closeTimeout);
                closeTimeout = null;
            }

            activeCard = card;

            // Fill content
            titleBox.textContent = card.innerText;
            textBox.innerHTML =
                details[i + 1] || "More details about this service.";

            // Get card position & size
            const rect = card.getBoundingClientRect();
            const modalStyle = modal.style;

            // Reset instantly
            modalStyle.transition = "none";
            modalStyle.transform = "translate(-50%, -50%) scale(1)";
            modalStyle.opacity = "1";
            modalStyle.visibility = "visible";

            // Start position = card
            modalStyle.top = `${rect.top + rect.height / 2}px`;
            modalStyle.left = `${rect.left + rect.width / 2}px`;
            modalStyle.width = `${rect.width}px`;
            modalStyle.height = `${rect.height}px`;
            modalStyle.borderRadius = "20px";

            overlay.classList.add("active");
            modal.classList.add("active");
            document.body.style.overflow = "hidden";

            // Animate to center
            requestAnimationFrame(() => {
                modalStyle.transition =
                    "all 0.7s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
                modalStyle.top = `50%`;
                modalStyle.left = `50%`;
                modalStyle.width = `80%`;
                modalStyle.height = `80%`;
                modalStyle.borderRadius = "20px";
            });
        });
    });

    function closeModal() {
        if (!activeCard) return;

        const rect = activeCard.getBoundingClientRect();
        const modalStyle = modal.style;

        // Animate back to card
        modalStyle.transition = "all 0.7s ease-in-out";
        modalStyle.top = `${rect.top + rect.height / 2}px`;
        modalStyle.left = `${rect.left + rect.width / 2}px`;
        modalStyle.width = `${rect.width}px`;
        modalStyle.height = `${rect.height}px`;
        modalStyle.borderRadius = "20px";

        overlay.classList.remove("active");

        // Use timeout to finish animation -store it to cancel if reopening quickly
        closeTimeout = setTimeout(() => {
            modal.classList.remove("active");
            modalStyle.opacity = "0";
            modalStyle.visibility = "hidden";
            modalStyle.transition = "none";
            document.body.style.overflow = "";
            activeCard = null;
            closeTimeout = null; // clear reference
        }, 700);
    }

    closeBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
});

// Servcies SEction JS Ended

// CTA Section JS Started
document.addEventListener("DOMContentLoaded", function () {
    const ctaSections = document.querySelectorAll(".new-cta-section");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const content =
                        entry.target.querySelector(".new-cta-content");
                    const image = entry.target.querySelector(
                        ".new-cta-image-wrapper"
                    );

                    if (content) content.classList.add("visible");
                    if (image) image.classList.add("visible");

                    // Optional: animate children with delay
                    if (content) {
                        const children = content.children;
                        for (let i = 0; i < children.length; i++) {
                            children[i].style.transitionDelay = `${i * 0.2}s`;
                        }
                    }
                } else {
                    const content =
                        entry.target.querySelector(".new-cta-content");
                    const image = entry.target.querySelector(
                        ".new-cta-image-wrapper"
                    );
                    if (content) content.classList.remove("visible");
                    if (image) image.classList.remove("visible");
                }
            });
        },
        { threshold: 0.2 }
    );

    ctaSections.forEach((section) => observer.observe(section));
});
// CTA Section JS Ended

    </script>



    <section class="arrival-services">
  <div class="container">
    <h2 class="section-title">
      Seamless <span>UK Arrival</span> & <span>Virtual Campus Tours</span>
    </h2>

    <div class="services-grid">
      <!-- Airport Pick-Up -->
      <div class="service-card">
        <h3>Airport Pick-Up – A Welcome That Starts Before You Land</h3>
        <p>
          WTS Visa goes beyond visa approval -we make sure your journey begins smoothly and stress-free.
        </p>
        <ul class="service-points">
          <li>
            <span class="services-icon"> <i class="fa-solid fa-taxi"></i></span>
            <div class="point-text">
              <strong>Pre-Booked Drivers:</strong> A verified driver meets you right at the gate -no taxi worries.
            </div>
          </li>
          <li>
            <span class="services-icon"><i class="fa-solid fa-location-dot"></i></span>
            <div class="point-text">
              <strong>Real-Time Tracking:</strong> Live driver updates for you and your family.
            </div>
          </li>
          <li>
            <span class="services-icon"><i class="fa-solid fa-suitcase-rolling"></i></span>
            <div class="point-text">
              <strong>Safe & Secure:</strong> Full luggage assistance and a direct ride to your accommodation.
            </div>
          </li>
        </ul>
      </div>

      <!-- Virtual Tours -->
      <div class="service-card">
        <h3>Virtual City & Campus Tours – See Your Future Before You Fly</h3>
        <p>
          Experience your destination before you even arrive, through our immersive virtual tours.
        </p>
        <ul class="service-points">
          <li>
            <span class="services-icon"><i class="fa-solid fa-video"></i></span>
            <div class="point-text">
              <strong>360° Live Walkthroughs:</strong> Explore universities, workplaces, and neighborhoods online.
            </div>
          </li>
          <li>
            <span class="services-icon"><i class="fa-solid fa-comments"></i></span>
            <div class="point-text">
              <strong>Real Adviser Interaction:</strong> Get live answers from expert counselors during the tour.
            </div>
          </li>
          <li>
            <span class="services-icon"><i class="fa-solid fa-compass"></i></span>
            <div class="point-text">
              <strong>Smart Planning:</strong> Choose the right city or campus with total confidence.
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="why-matter">
      <h4>Why It Matters</h4>
      <p>
        These services are part of WTS Visa’s complete journey support -ensuring your path from visa to arrival is safe, simple, and stress-free.
      </p>
    </div>
  </div>
</section>

<style>
.arrival-services {
  background: #f9f9f9;
  padding: 50px 20px;
  font-family: "Poppins", sans-serif;
  color: #1a1a1a;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  font-size: 2.4rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 60px;
}

.section-title span {
  color:  var(--primary-color);
}

/* Service Grid */
.services-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 40px;
}

.service-card {
  background: #fff;
  border-radius: 15px;
  padding: 35px;
  box-shadow: 0 6px 20px rgba(0, 120, 255, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 120, 255, 0.15);
}

.service-card h3 {
  font-size: 1.5rem;
  color: #1C2C59 ;
  margin-bottom: 15px;
}

.service-card p {
  color: #444;
  line-height: 1.7;
  margin-bottom: 25px;
}

/* UL LI Styling */
.service-points {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.service-points li {
  display: flex;
  align-items: flex-start;
  background: #f1f7ff;
  border-radius: 12px;
  padding: 15px 18px;
  box-shadow: 0 3px 8px rgba(0, 120, 255, 0.08);
  transition: background 0.3s ease, transform 0.3s ease;
}

.service-points li:hover {
  background: #e8f2ff;
  transform: translateY(-3px);
}

.services-icon {
  font-size: 1.4rem;
  color: #0078ff;
  flex-shrink: 0;
  margin-top: 2px;
  margin-right:12px;
}

.point-text {
  color: #333;
  line-height: 1.6;
  font-size: 0.95rem;
}

.point-text strong {
  color:#1C2C59 ;
}

/* Why Matter */
.why-matter {
  text-align: center;
  max-width: 750px;
  margin: 60px auto 0;
}

.why-matter h4 {
  color: var(--primary-color);
  font-size: 1.6rem;
  margin-bottom: 10px;
}

.why-matter p {
  color: #444;
  line-height: 1.8;
}

/* Responsive */
@media (max-width: 992px) {
  .services-grid {
    grid-template-columns: 1fr;
  }

  .section-title {
    font-size: 2rem;
  }

  .service-card {
    padding: 25px;
  }
}

@media (max-width: 576px) {
  .arrival-services {
    padding: 70px 15px;
  }

  .section-title {
    font-size: 1.8rem;
  }

  .service-card h3 {
    font-size: 1.3rem;
  }
}
</style>



    <!-- Stats section  -->
    <!-- @include('./components/stats') -->

   <section id="stats" class="stats-section">
  <div class="stats-container">
    <div class="stat-box" data-target="7500">
      <div class="icon-box">
        <i class="fa-solid fa-user-graduate"></i>
      </div>
      <div class="stat-number-box">
        <span class="stat-number">0</span><span class="plus">+</span>
      </div>
      <p>Happy & Satisfied Students</p>
    </div>

    <div class="stat-box" data-target="850">
      <div class="icon-box">
        <i class="fa-solid fa-university"></i>
      </div>
      <div class="stat-number-box">
        <span class="stat-number">0</span><span class="plus">+</span>
      </div>
      <p>Top-Ranked Universities</p>
    </div>

    <div class="stat-box" data-target="400">
      <div class="icon-box">
        <i class="fa-solid fa-chalkboard-teacher"></i>
      </div>
      <div class="stat-number-box">
        <span class="stat-number">0</span><span class="plus">+</span>
      </div>
      <p>Experienced Education Consultants</p>
    </div>

    <div class="stat-box" data-target="12">
      <div class="icon-box">
        <i class="fa-solid fa-calendar-check"></i>
      </div>
      <div class="stat-number-box">
        <span class="stat-number">0</span><span class="plus">+</span>
      </div>
      <p>Years of Proven Expertise</p>
    </div>
  </div>
</section>

<!-- ✅ Same Styling -->
<style>
.stats-section {
  background: #f5f7fc61;
  padding: 50px 20px;
  text-align: center;
}

.stats-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
  max-width: 1100px;
  margin: 0 auto;
}

.stat-box {
  background: #fff;
  border-radius: 16px;
  padding: 20px 15px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.stat-box:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.stat-box::before {
  content: "";
  position: absolute;
  width: 120%;
  height: 0%;
  background: var(--primary-color);
  top: 0;
  left: -10%;
  transition: height 0.4s ease;
  z-index: 0;
  border-radius: 0 0 50% 50%;
  opacity: 0.1;
}

.stat-box:hover::before {
  height: 100%;
}

.icon-box {
  background: #18336c;
  color: #fff;
  width: 65px;
  height: 65px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto 20px;
  font-size: 28px;
  transition: background 0.4s, transform 0.4s;
  position: relative;
  z-index: 1;
}

.stat-box:hover .icon-box {
  background: var(--primary-color);
  transform: scale(1.1);
}

.stat-number-box {
  display: flex;
  justify-content: center;
  align-items: baseline;
  gap: 5px;
  position: relative;
  z-index: 1;
}

.stat-number {
  font-size: 2.8rem;
  font-weight: 700;
  color: #1c2c59;
}

.plus {
  font-size: 2rem;
  font-weight: 700;
  color: #1c2c59;
}

.stat-box p {
  color: #333;
  font-size: 1rem;
  margin-top: 10px;
  font-weight: 500;
  position: relative;
  z-index: 1;
}

@media (max-width: 600px) {
  .stat-number {
    font-size: 2.2rem;
  }
  .plus {
    font-size: 1.5rem;
  }
  .icon-box {
    width: 55px;
    height: 55px;
    font-size: 24px;
  }
}
</style>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- ✅ Updated JS -->
<script>
  const statBoxes = document.querySelectorAll(".stat-box");
  const speed = 120;

  const animateCounter = (counter, target) => {
    let count = 0;
    const increment = target / speed;

    const update = () => {
      count += increment;
      if (count < target) {
        counter.textContent = Math.ceil(count);
        requestAnimationFrame(update);
      } else {
        counter.textContent = target;
      }
    };

    update();
  };

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const box = entry.target;
        const target = +box.dataset.target;
        const counter = box.querySelector(".stat-number");

        animateCounter(counter, target);
        observer.unobserve(box);
      }
    });
  }, { threshold: 0.4 });

  statBoxes.forEach(box => observer.observe(box));
</script>

    <!-- choose us section -->
    <section id="services" class="services">
        <div class="container">
            <h2>Why Choose <span>WTS for UK Study Visa Consultancy?</span></h2>
            <p>We focus on quality service, not quick profits. Our goal is your success</p>

            <div class="services-grid">
                <div class="card">
                    <div class="icon">
                        <img src="icons/quality.png" loading="lazy" alt="Global Edge">
                    </div>
                    <h3>10+ Years of Visa Expertise</h3>
                </div>

                <div class="card">
                    <div class="icon">
                        <img src="icons/graduation.png" loading="lazy" alt="Choice">
                    </div>
                    <h3>95% Visa Approval Success Rate</h3>
                </div>

                <div class="card">
                    <div class="icon">
                        <img src="icons/trust.png" loading="lazy" alt="Trust">
                    </div>
                    <h3>Transparent & Affordable Services</h3>
                </div>

                <div class="card">
                    <div class="icon">
                        <img src="icons/accommodation.png" loading="lazy" alt="University Network">
                    </div>
                    <h3>Strong Global University Network</h3>
                </div>

                <div class="card">
                    <div class="icon">
                        <img src="icons/mentoring.png" loading="lazy" alt="Guidance">
                    </div>
                    <h3>Personalized Guidance for Every Student</h3>
                </div>
            </div>
        </div>
    </section>
    <style>
        #services {
            padding: 60px 20px;
            text-align: center;
            background: #f9f9f9;
        }

        #services h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        #services h2 span {
            color: var(--primary-color);
        }

        #services p {
            margin-bottom: 40px;
            font-size: 1rem;
            color: #555;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0px;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .card .icon {
            background: var(--primary-color);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .card .icon img {
            width: 30px;
            height: 30px;
            filter: brightness(0) invert(1);
        }

        .card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            #services {
                padding: 40px 15px;
            }

            #services h2 {
                font-size: 1.6rem;
            }

            .card {
                padding: 15px;
            }
        }
    </style>

    <!-- Our services  -->
    <!-- @php
        $sectionTitle = 'Our Services';
        $sectionDescription = 'We provide complete end-to-end support:';

        $cards = [
            ['title' => '1. Course & University Selection', 'desc' => 'Find the right fit for your profile with expert guidance in selecting suitable courses and universities tailored to your career goals.'],
            ['title' => '2. Getting Admissions', 'desc' => 'Quick and accurate application support to maximize your chances of securing admission in your dream university.'],
            ['title' => '3. SOP / Scholarship Essays', 'desc' => 'Professionally drafted Statements of Purpose and Scholarship Essays to ensure maximum acceptance and funding opportunities.'],
            ['title' => '4. Visa Assistance', 'desc' => 'Hassle-free visa application and documentation support to make your process smooth and stress-free.'],
            ['title' => '5. Mock Interviews', 'desc' => 'Prepare with confidence through embassy interview practice sessions designed to boost your success rate.'],
            ['title' => '6. Travel & Accommodation', 'desc' => 'Complete arrangements for flights, stay, and accommodations for a seamless journey abroad.'],
            ['title' => '7. Free Profile Evaluation', 'desc' => 'Personalized guidance for your academic and career goals through free expert profile evaluations.'],
            ['title' => '8. Education Loan Assistance', 'desc' => 'Get the best deals at low interest rates with complete support for securing education loans.'],
            ['title' => '9. Post-Landing Services', 'desc' => 'SIM, Forex, Bank Account, and settling-in assistance to help you adjust quickly after arriving.'],
            ['title' => '10. Expert Counseling', 'desc' => 'Get trusted guidance from certified visa specialists and counselors throughout your journey.'],
        ];

    @endphp
    <x-choose-us :section-title="$sectionTitle" :section-description="$sectionDescription" :cards="$cards" />
    <style>
        .why-swiper {
            height: 230px;
        }

        .why-card {
            height: 200px;
            min-height: 200px;
        }
    </style> -->

  
  <!-- visa consultation call  -->

<section class="study-guide-section">
        <div class="study-guide-container">
            <div class="study-guide-content">
                <h2 style="font-weight: 600;">Want a Step-by-Step Study in UK Guide?</h2>
                <p>Please drop us a message by filling out a form. We will connect you with an advisor as soon as possible!
                </p>
                <button class="study-guide-button" onclick="scrollToTop()">
                    Book an Appointment
                    <span>➜</span>
                </button>
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
            </div>
        </div>
    </section>
    <script>
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
</script>

    <!-- Common Challenges? We Solve Them All!  -->
    <section class="visa-help-section" id="visa-services">
  <div class="visa-help-container">
    <h2 class="visa-help-title">We Solve Every UK Study Visa <span>Challenge for You!</span></h2>

    <div class="visa-help-grid">
      <div class="visa-help-card">
        <div class="icon"><i class="fa-solid fa-file-circle-check"></i></div>
        <h3>Incomplete Documents?</h3>
        <p>We give you a full checklist & review.</p>
      </div>

      <div class="visa-help-card">
        <div class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
        <h3>Financial Proof Issues?</h3>
        <p>We help prepare strong financial docs.</p>
      </div>

      <div class="visa-help-card">
        <div class="icon"><i class="fa-solid fa-microphone"></i></div>
        <h3>Visa Interview Fear?</h3>
        <p>We train you with mock sessions.</p>
      </div>

      <div class="visa-help-card">
        <div class="icon"><i class="fa-solid fa-ban"></i></div>
        <h3>Previous Visa Rejection?</h3>
        <p>We build a stronger re-application case.</p>
      </div>
    </div>
  </div>
</section>

<style>
  /* Section Background */
  .visa-help-section {
    background: #f9f9f9;
    padding: 80px 20px;
    color: #fff;
    text-align: center;
  }

  /* Container */
  .visa-help-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Title */
  .visa-help-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 50px;
  }

  .visa-help-title span {
    color: var(--primary-color);
  }

  /* Grid Layout */
  .visa-help-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
  }

  /* Card */
  .visa-help-card {
    background: #fff;
    color: #1d263b;
    border-radius: 15px;
    padding: 30px 20px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
  }

  .visa-help-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(255, 204, 0, 0.4);
  }

  /* Icon */
  .visa-help-card .icon {
    font-size: 40px;
    margin-bottom: 15px;
    color: var(--primary-color);
  }

  /* Card Title */
  .visa-help-card h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .visa-help-card p {
    font-size: 15px;
    color: #555;
  }

  /* Responsive Design */
  @media (max-width: 992px) {
    .visa-help-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .visa-help-title {
      font-size: 28px;
    }
  }

  @media (max-width: 600px) {
    .visa-help-grid {
      grid-template-columns: 1fr;
    }

    .visa-help-card {
      padding: 25px 15px;
    }

    .visa-help-card .icon {
      font-size: 35px;
    }

    .visa-help-title {
      font-size: 24px;
    }
  }
</style>
    <script>
        function learnmoreSection(section) {
            // Hide all normal and all-content sections
            document.querySelectorAll('.normal-content, .all-content').forEach(content => {
                content.style.display = content.classList.contains('normal-content') ? 'block' : 'none';
            });

            // Show the selected all-content and hide normal-content
            document.querySelector(`.normal-content[data-id="${section}"]`).style.display = 'none';
            document.querySelector(`.all-content[data-id="${section}"]`).style.display = 'block';
        }
    </script>

  


   

    <!-- Why we are different from others  -->
    <section class="sop-samples">
  <h2 class="title-light">Why We Are Different from Others</h2>

  <div class="sample-container">
    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-user-check"></i></div>
      <h3>Personalized Attention</h3>
      <p>We treat you as an individual, understanding your goals to build the right pathway for your success abroad.</p>
    </div>

    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
      <h3>End-to-End Guidance</h3>
      <p>From course selection to post-arrival services, we’re with you at every stage of your journey.</p>
    </div>

    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-scale-balanced"></i></div>
      <h3>Transparent & Ethical</h3>
      <p>No hidden fees, no false promises -just honest and reliable guidance.</p>
    </div>

    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-thumbs-up"></i></div>
      <h3>Rejection to Approval</h3>
      <p>Our team specializes in turning weak or rejected applications into success stories.</p>
    </div>

    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-globe"></i></div>
      <h3>Global Network</h3>
      <p>We connect you to top institutions worldwide while providing personalized local support in India.</p>
    </div>

    <div class="sample-card">
      <div class="sample-card-icon"><i class="fa-solid fa-trophy"></i></div>
      <h3>Success-Oriented Approach</h3>
      <p>Our goal isn’t just visa approval -it’s helping you achieve long-term global success.</p>
    </div>
  </div>
</section>

<style>
  .sop-samples {
    background: #f5f7fc61;
    color: #fff;
    text-align: center;
    padding: 80px 20px;
  }

  .title-light {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 50px;
    color: #1C2C59;
    position: relative;
  }

  .title-light::after {
    content: "";
    width: 80px;
    height: 4px;
    background: var(--primary-color);
    display: block;
    margin: 15px auto 0;
    border-radius: 2px;
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
    box-shadow: 0 10px 25px rgba(255, 204, 0, 0.4);
  }

  .sample-card-icon {
    font-size: 40px;
    color: #222;
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

  .sample-card:hover .icon {
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

    .title-light {
      font-size: 1.8rem;
    }

    .sample-card-icon {
      width: 60px;
      height: 60px;
      font-size: 30px;
    }
  }
</style>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


    <!-- FAQ section  -->

   <!-- FAQ Section -->
    <section class="new-faq-section">
        <div class="new-faq-container">
            <div class="new-faq-left">
                <h3 class="new-section-title">Have a Question?</h3>
                <p class="new-faq-text">
                    Have a question or need visa advice?<br>
                    Our experts are here to guide you - just reach out.
                </p>
                <div class="new-faq-graphic">
                    <img src="/new-home-images/faq-image2.jpeg" style="border-top-right-radius: 20px; border-top-left-radius: 20px; border-bottom-left-radius: 50%; border-bottom-right-radius: 50%;" alt="FAQ Graphic" />
                </div>
            </div>

            <div class="new-faq-right">
                <div class="new-faq-accordion">
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How Do I Select the Best Country to Study Abroad?
                            <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Your academic objective, career aspirations and personal interest
                            depend on selecting the best destination. Investigate
                            the standard of education, cost of living and overall culture of every nation. Approach an
                            expert and get your choices
                            aligned with your long-term professional objectives.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">What are the Preconditions for Studying Abroad? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Admission criteria differ by country and institution. Typical
                            requirements are academic transcripts, language
                            proficiency tests (such as IELTS or TOEFL), and statement of purpose and recommendation letters.
                            Some programs will also
                            require entrance exams.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How can I apply for Scholarships? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                        <div class="new-faq-content">Begin by investigating scholarship opportunities provided by
                            universities, governments and private agencies. Read and
                            fully understand the eligibility requirements and timelines. Develop a good application with a
                            good personal statement
                            and supporting materials.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">Which Country is Best for My Studies Abroad? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Cost differs according study visa apply to country, university and
                            lifestyle. Fees cost between a few thousand to tens
                            of thousands of dollars per year. Living accommodation, eating, travelling and insurance are
                            other costs. Scholarships
                            and student financial aid may minimize the cost.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">How Much Does it Cost? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p></button>
                        <div class="new-faq-content">Cost differs according study visa apply to country, university and
                            lifestyle. Fees cost between a few thousand to tens
                            of thousands of dollars per year. Living accommodation, eating, travelling and insurance are
                            other costs. Scholarships
                            and student financial aid may minimize the cost.</div>
                    </div>
                    <div class="new-faq-item">
                        <button class="new-faq-btn">Which Scholarships for International Students? <p><span><img src="/new-home-images/svg-icons/faq-plus.svg" alt="Plus icon"></span></p>
                        </button>
                        <div class="new-faq-content">Fulbright Program (USA), Chevening Scholarships (United Kingdom), DAAD
                            Scholarships (Germany) and Australia Awards are
                            some of the best available scholarships. Universities also provide need-based and merit-based
                            scholarships. Research in
                            advance to fulfil deadlines for applications.</div>
                    </div>
                </div>
                <div style="display: flex; width: 100%; margin-left: auto; justify-content: end;">
                    <a href="#" class="new-faq-viewall">View All</a>
                </div>
            </div>
        </div>
    </section>
    <script>
  // Select all FAQ buttons
  const faqButtons = document.querySelectorAll(".new-faq-btn");

  faqButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const content = btn.nextElementSibling;

      // Close all other open FAQs
      document.querySelectorAll(".new-faq-content").forEach((item) => {
        if (item !== content) {
          item.style.maxHeight = null;
          item.parentElement.classList.remove("active");
        }
      });

      // Toggle current one
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
        btn.parentElement.classList.remove("active");
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
        btn.parentElement.classList.add("active");
      }
    });
  });
</script>

@endsection