@extends('layouts.app')

@section('content')
<section class="about-hero-section">
  <style>
    .about-hero-section {
      position: relative;
      width: 100%;
      height: 820px;
      background: url('/images/wts-about-us.png') no-repeat center center;
      background-size: cover;
      display: flex;
      align-items: center;
    }

    .about-hero-content {
      max-width: 650px;
      color: #fff;
      z-index: 1;
      text-align: left;
    }

    .about-hero-content h1 {
      font-size: clamp(30px, 5vw, 42px);
      font-weight: 700;
      line-height: 1.2;
      margin: 0 0 14px 0;
      padding: 0;
      color: #1C2C59;
      text-align: left;
    }

    .about-hero-content p {
      font-size: clamp(14px, 2vw, 16px);
      margin: 0 0 26px 0;
      max-width: 520px;
      color: black;
      opacity: 1;
    }

    .custom-btn-new {
        background-color: #FC9118;
    padding: 2px 14px;
    border-radius: 11px;
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    font-weight: 500;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 3px 10px rgba(252, 145, 24, 0.4);
    width: fit-content;
    }
    .custom-btn-new::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.25);
    transform: skewX(-20deg);
    transition: 0.6s;
   }

   .custom-btn-new:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 6px 15px rgba(252, 145, 24, 0.6);
    background-position: right center;
   }

   .custom-btn-new:hover::before {
    left: 200%;
    }

    /* Mobile fix */
    @media (max-width: 768px) {
      .about-hero-section {
        height: auto;
        padding: 80px 20px;
      }

      .about-hero-content h1 {
        font-size: clamp(28px, 6vw, 30px);
      }

      .about-hero-content p {
        font-size: clamp(12px, 3vw, 16px);
      }
    }

    /* MOBILE IMAGE */
@media (max-width: 768px) {

  .about-hero-section {
    height: auto;
    padding: 90px 20px;
    background: url('/images/About-Phone.jfif') no-repeat center center;
    background-size: cover;
  }

}
  </style>

  <div class="container about-hero-content">
    <h1>
      About WTS – Building Global <br>  Careers with Trusted Guidance
    </h1>

    <p>
      At WTS, we provide end-to-end study abroad services designed to help
      students confidently achieve their global education and career goals.
    </p>

    <div>
         <a href="/contact" class="custom-btn-new">Book Free Counselling <img src="" style="height: 38px; margin-left: -6px;" alt=""></a>
     </div>
  </div>
</section>


<!-- new Section  -->

<section class="who-we-are">
    <style>
        .who-we-are {
            background: #ffffff;
        }

        .who-we-are-wrap {
            display: flex;
            align-items: stretch;
            gap: 40px;
            background: #f9fafb;
            padding: 30px;
            border-radius: 8px;
        }

        .who-we-are-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* HEADING */
        .who-we-are-left h2 {
            font-weight: 700;
            color: black;
            margin-bottom: 14px;
        }

        .who-we-are-left p {
            font-size: 15px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 18px;
            max-width: 520px;
        }

        .who-we-are-quote {
            background: #fff3cd;
            border: 1px solid #ffe69c;
            padding: 14px 18px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            border-radius: 4px;
            display: inline-block;
            max-width: fit-content;
        }

        .who-we-are-right {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .who-we-are-right img {
            width: 100%;
            height: 100%;
            max-height: 360px;
            object-fit: cover; 
            border-radius: 6px;
            display: block;
        }

       /* RESPONSIVE */
     @media (max-width: 768px) {
    .who-we-are-wrap {
        flex-direction: column;
        padding: 20px;
        align-items: center;     
        text-align: center;     
    }

    .who-we-are-left p,
    .who-we-are-left h2,
    .who-we-are-quote {
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;     
    }

    .who-we-are-right img {
        max-height: 260px;
        margin-left: auto;
        margin-right: auto;
    }
   }
    </style>

    <div class="container">
        <div class="who-we-are-wrap">
            <!-- LEFT -->
            <div class="who-we-are-left">
                <h2>Who We Are</h2>

                <p>
                    WTS Study Abroad consultant is a trusted international education consultancy dedicated to helping students achieve their global academic and career goals. We provide complete study abroad solutions from course selection and university admissions to visa approval and post-landing support. Our expert team ensures personalised guidance and transparent assistance throughout the journey. WTS is a sister concern company of Warrgyizmorsch Pvt. Ltd.    
                </p>

                <div class="who-we-are-quote">
                    “We don’t just process visas We build global careers.”
                </div>
            </div>

            <!-- RIGHT -->
            <div class="who-we-are-right">
                <img src="/images/newabout.webp" alt="Who We Are">
            </div>
        </div>
    </div>
</section>


   <!--  New Section -->

<section class="mission-vision-section">
    <style>
        .mission-vision-section {
            background: #f3f7fb;
        }

        .mission-vision-wrap {
            display: flex;
            align-items: stretch;
            justify-content: center;
            background: #eef4fb;
            border-radius: 6px;
            padding: 30px 20px;
            gap: 20px;
        }

        .mv-box {
            flex: 1;
            padding: 10px 30px;
        }

        /* FIX: heading always center */
        .mv-head {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 10px;
            text-align: center;
        }

        .mv-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: 700;
        }

        .mv-box h3 {
            font-size: 25px;
            font-weight: 700;
            color: black;
            margin: 0;
            text-align: center;
        }

        .mv-box p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            max-width: 380px;
            margin: 0 auto;
            text-align: center;
        }

        /* vertical divider */
        .mv-divider {
            width: 1px;
            background: #d6e0ee;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .mission-vision-wrap {
                flex-direction: column;
                gap: 30px;
            }

            .mv-divider {
                width: 80%;
                height: 1px;
                margin: 0 auto;
            }

            .mv-box h3,
            .mv-box p {
                text-align: center;
                max-width: 100%;
            }
        }
    </style>

    <div class="container">
        <div class="mission-vision-wrap">

            <!-- Mission -->
            <div class="mv-box">
                <div class="mv-head">
                    <div class="mv-icon">🎯</div>
                    <h3>Our Mission</h3>
                </div>
                <p>
                    To provide personalised, transparent, and career-focused study abroad guidance that empowers students to choose the right course, the right country, and the right future. We aim to simplify the international admission and visa process while maintaining the highest standards of integrity and professionalism.
                </p>
            </div>

            <div class="mv-divider"></div>

            <!-- Vision -->
            <div class="mv-box">
                <div class="mv-head">
                    <div class="mv-icon">👁️</div>
                    <h3>Our Vision</h3>
                </div>
                <p>
                    To become one of the most trusted and respected study abroad consultancy brands globally, helping students transform their aspirations into international success stories through honest guidance, strategic planning, and long-term career growth support.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- end section  -->


<!-- New Section  -->

<section class="core-values">
  <style>
    .core-values {
      background: #ffffff;
    }

    .core-values h2 {
      text-align: center;
      font-weight: 700;
      color: black;
      margin-bottom: 40px;
    }

    .core-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 22px;
    }

    .core-card {
      background: linear-gradient(135deg, #f4f7fc, #eef3fa);
      border-radius: 12px;
      padding: 28px 20px;
      text-align: center;
      min-height: 180px;         
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: all 0.35s ease;   
      box-shadow: 0 6px 16px rgba(0,0,0,0.05);
      cursor: pointer;
    }

    .core-card.alt {
      background: linear-gradient(135deg, #fff4de, #ffe8bf);
    }

    /* HOVER EFFECT */
    .core-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 14px 30px rgba(31,74,168,0.18);
    }

    .core-card h4 {
      font-size: 20px;
      font-weight: 700;
      color: black;
      margin-bottom: 8px;
    }

    .core-card p {
      font-size: 14px;
      color: #555;
      margin: 0;
      line-height: 1.5;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
      .core-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .core-grid {
        grid-template-columns: 1fr;
      }

      .core-card {
        min-height: auto;
      }
    }
  </style>

  <div class="container">
    <h2>Our Core Values</h2>

    <div class="core-grid">
      <div class="core-card">
        <h4>Transparency</h4>
        <p>Clear process, no hidden charges, and honest guidance at every stage.</p>
      </div>

      <div class="core-card alt">
        <h4>Integrity</h4>
        <p>Ethical practices and genuine documentation handling.</p>
      </div>

      <div class="core-card">
        <h4>Student-Centric Approach</h4>
        <p>Every student’s goals, profile, and future plans are our priority.</p>
      </div>

      <div class="core-card alt">
        <h4>Commitment</h4>
        <p>We stand with students from consultation to successful settlement.</p>
      </div>
    </div>
  </div>
</section>

<!-- End Section  -->


<!-- New Section  -->
<section class="achievements-section">
  <style>
    .achievements-section {
      background: linear-gradient(rgba(8,32,66,.85), rgba(8,32,66,.85)),
        url('/images/achievements-bg.jpg') center/cover no-repeat;
      color: #fff;
    }

    /* FORCE ALL TEXT WHITE */
    .achievements-section * {
      color: #fff;
    }

    .achievements-title {
      text-align: center;
      font-weight: 700;
      margin-bottom: 35px;
    }

    .achievements-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      text-align: center;
    }

    .achievement-item {
      border-right: 1px solid rgba(255,255,255,.3);
      padding: 10px;
    }

    .achievement-item:last-child {
      border-right: none;
    }

    .achievement-item h3 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .achievement-item p {
      font-size: 18px;
      margin: 0;
      opacity: .85;
    }

    @media(max-width:768px){
      .achievements-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .achievement-item {
        border: none;
      }
    }
  </style>

  <div class="container">
    <h2 class="achievements-title">Our Achievements</h2>

    <div class="achievements-grid">
      <div class="achievement-item">
        <h3 class="counter" data-target="1000" data-suffix="+">0</h3>
        <p>Successful Students</p>
      </div>

      <div class="achievement-item">
        <h3 class="counter" data-target="95" data-suffix="%">0</h3>
        <p>Visa Success Rate</p>
      </div>

      <div class="achievement-item">
        <h3 class="counter" data-target="4" data-suffix="+">0</h3>
        <p>Global Offices</p>
      </div>

      <div class="achievement-item">
        <h3 class="counter" data-target="10" data-suffix="+">0</h3>
        <p>Years of Experience</p>
      </div>
    </div>
  </div>

 <script>
  function runCounters() {
    const counters = document.querySelectorAll('.counter');
    const duration = 1200; 

    counters.forEach(counter => {
      const target = Number(counter.dataset.target);
      const suffix = counter.dataset.suffix || "";
      let startTime = null;

      counter.textContent = "0"; 

      function animate(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const value = Math.floor(progress * target);

        counter.textContent = value + suffix;

        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          counter.textContent = target + suffix;
        }
      }

      requestAnimationFrame(animate);
    });
  }

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          runCounters(); 
        }
      });
    },
    { threshold: 0.6 }
  );

  observer.observe(document.querySelector('.achievements-section'));
</script>
</section>

<!-- End Section -->

<!-- New Section -->

<section class="founder-section">
  <style>
    .founder-section {
      background: #ffffff;
    }

    /* ONE unified card */
    .founder-card {
      background: #f9fafb;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.06);
      padding: 20px;
    }

    .founder-wrap {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 30px;
      align-items: center;
    }

    .founder-img img {
      width: 100%;
      border-radius: 8px;
      object-fit: cover;
      display: block;
    }

    .founder-content h2 {
      font-size: 25px;
      font-weight: 700;
      color: black;
      margin-bottom: 12px;
      position: relative;
      display: inline-block;
    }

    .founder-content h2::after {
      content: "";
      display: block;
      width: 60px;
      height: 2px;
      background: black;
      margin-top: 6px;
    }

    .founder-name {
      font-size: 15px;
      font-weight: 700;
      color: #111827;
      margin-bottom: 6px;
    }

    .founder-desc {
      font-size: 14px;
      color: #4b5563;
      line-height: 1.7;
      margin-bottom: 16px;
      max-width: 620px;
      text-align: justify;
    }

    .founder-quote {
      background: #fff4dd;
      padding: 12px 16px;
      font-size: 14px;
      color: #8a5a00;
      font-style: italic;
      border-radius: 6px;
      max-width: 620px;
    }

    @media (max-width: 768px) {
  .founder-wrap {
    grid-template-columns: 1fr;
  }

  .founder-img {
    order: 2;
  }

  .founder-content {
    order: 1;
  }

  .founder-content h2 {
    text-align: left;
  }

  .founder-content h2::after {
    margin-left: 0;
    margin-right: 0;
  }
 }
  </style>

  <div class="container">
    <div class="founder-card">
      <div class="founder-wrap">
        <div class="founder-img">
          <img src="/images/Owner.webp" alt="Founder">
        </div>

        <div class="founder-content">

        <h2>Meet Our Founder</h2>
          <div class="founder-name">
            Mahipal Singh Rathore,
            <span style="font-weight:500">Owner & Founder – WTS</span>
          </div>

          <p class="founder-desc">
            With years of experience in study abroad consulting and Student Visa Assistance,
            <b>Mr. Mahipal Singh Rathore</b> has successfully guided hundreds of students
            toward international education opportunities.<br>
            His leadership focuses on transparency, professionalism, and student success.
            Under his guidance, WTS has grown into a trusted name in study abroad consultancy.
          </p>

          <div class="founder-quote">
            “Right guidance at the right time can change a student’s entire future.”
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Want Study Abroad Guide ? -->
<section class="study-guide-section">
    <div class="study-guide-container">
        <div class="study-guide-content">
            <h2 style="font-weight: 600;">Want Study Abroad Guide?</h2>
            <p>Please drop us a message by filling out a form. We will connect you with an advisor as soon as possible!</p>
            <button class="study-guide-button" onclick="window.location.href='/contact';">
                Book an Appointment
                <span>➜</span>
            </button>
        </div>
        <div class="study-guide-image">
            <img src="/new-home-images/plane-2.png" alt="Plane Image">
        </div>
    </div>
</section>


    @php
        $faqs = [
            [
                "question" => "1.	What Documents Do I Need for a Visa Application?",
                "answer" => "Passport, university admission letter, proof of funding, academic transcripts, visa application form. Other documents may be applicable."
            ],
            [
                "question" => "2.	How Long Does the Visa Process Take?",
                "answer" => "Processing time depends on the country and visa type. Several weeks to several months. Apply early."
            ],
            [
                "question" => "3.	How Long Is a Student Visa Valid?",
                "answer" => "Student visa is for the length of your course, some nations include extra time to pursue post-study opportunities. Extensions are allowed in a few instances."
            ],
            [
                "question" => "4.	What Happens if My Visa Gets Rejected?",
                "answer" => "If your visa is refused we will discuss the reasons why and advise you on how to reapply with a better application. In a few instances an appeal or further documentation are necessary."
            ],
        
        ];
    @endphp

    <x-faq :faqs="$faqs" />


    <style>
        .about-us-black {
            background-color: #0a0a0a;
            color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }
    
        .about-us-white {
            background-color: white;
            color: black;
            font-family: 'Poppins', sans-serif;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }
    
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 0;
        }
        .white-bg{
            background-color: white;
        }
    
        /* Header styling */
        .about-us-black h1 {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 3rem;
            color: #fff;
            position: relative;
            padding-bottom: 1rem;
        }
    
        .about-us-black h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #e6d51e, #ff6b00);
            border-radius: 2px;
        }
    
        /* White Section Styling  */
        .about-us-white section {
            margin-bottom: 4rem;
            position: relative;
            padding: 2rem;
            border-radius: 10px;
            background-color: beige;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
    
        .about-us-white section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
    
        /*Black Section styling */
        .about-us-black section {
            margin-bottom: 4rem;
            position: relative;
            padding: 2rem;
            border-radius: 10px;
            background-color: rgba(20, 20, 20, 0.7);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
    
        /* .about-us-black section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, #e6d51e, #ff6b00);
            border-radius: 5px 0 0 5px;
        } */
    
        .about-us-black section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
    
        /* Section headings */
        .about-us-black h2 {
            font-size: 1.5rem;
            color: #e6d51e;
            margin-top: 0;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }
    
        .about-us-white h2 {
            font-size: 1.5rem;
            color: blue;
            margin-top: 0;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }
    
        .about-us-black h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ff6b00;
            border-radius: 1.5px;
        }
    
        /* Paragraph styling */
        .about-us-black p {
            color: #d0d0d0;
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }
    
        .about-us-white p {
            color: black;
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }
    
        /* Grid layout for who-we-are section */
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
    
        /* Feature cards for countries section */
        .countries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
    
        .about-country-card {
            background: linear-gradient(145deg, #151515, #1a1a1a);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid white;
        }
    
        .about-country-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-color: #e6d51e;
        }
    
        .about-country-card h3 {
            color: #ff6b00;
            margin-bottom: 0.5rem;
        }
    
        .about-country-card p {
            color: #bbb;
            font-size: 0.9rem;
        }
    
        /* Process steps
        .process-steps {
            counter-reset: step-counter;
            margin-top: 2rem;
        }
    
        .process-step {
            position: relative;
            padding-left: 3.5rem;
            margin-bottom: 1.5rem;
        }
    
        .process-step::before {
            counter-increment: step-counter;
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            width: 2.5rem;
            height: 2.5rem;
            background-color: #e6d51e;
            color: #0a0a0a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
    
        .process-step h3 {
            color: #ff6b00;
            margin-bottom: 0.5rem;
        } */
    
        /* Challenge solutions */
        /* .challenge-solutions {
            margin-top: 1.5rem;
        }
    
        .challenge {
            margin-bottom: 1.5rem;
            padding-left: 1rem;
            border-left: 3px solid #ff6b00;
        }
    
        .challenge h3 {
            color: #e6d51e;
            margin-bottom: 0.5rem;
        } */
    
        /* process section styling  */
        .process{
            padding: 3rem 2rem;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }
    
        .process::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 5px;
            background: linear-gradient(180deg, #e6d51e, #ff6b00);
        }
    
        /* Contact section styling */
        .contact {
            background: linear-gradient(145deg, #111, #1c1c1c);
            padding: 3rem 2rem;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }
    
        .contact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 5px;
            background: linear-gradient(180deg, #e6d51e, #ff6b00);
        }
    
        .contact-info {
            margin-top: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
    
        .contact-method {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
    
        .contact-method i {
            color: #e6d51e;
            margin-right: 1rem;
            font-size: 1.5rem;
        }
    
        .contact-method h3 {
            color: #ff6b00;
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }
    
        /* Animated background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: #0a0a0a;
            overflow: hidden;
        }
    
        .animated-bg::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle, transparent 20%, #0a0a0a 80%);
            top: -25%;
            left: -25%;
            animation: rotate 60s linear infinite;
        }
    
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    
        /* Accent elements */
        .accent-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e6d51e;
            opacity: 0.3;
        }
    
        /* Highlight text */
        .highlight {
            color: #ff6b00;
            font-weight: 600;
        }
    
        /* Scroll animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
    
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    
        /* Responsive design */
        @media (min-width: 768px) {
            .process-steps {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
            
            .about-us-black h1,
            .about-us-white h1 {
                font-size: 2rem;
            }
            
            .about-us-black h2,
            .about-us-white h2 {
                font-size: 1.5rem;
            }
            
            .about-us-black p,
            .about-us-white p {
                font-size: 1.1rem;
            }
        }
    
        @media (max-width: 767px) {
            .container {
                width: 95%;
                padding: 2rem 0;
            }
            
            .about-us-black h1,
            .about-us-white h1 {
                font-size: 2rem;
            }
            
            .about-us-black h2,
            .about-us-white h2 {
                font-size: 1.5rem;
            }
            
            .about-us-black section,
            .about-us-white section {
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .countries-grid {
                grid-template-columns: 1fr;
            }
        }
    
        /* Additional visual elements */
        .about-us-black section:nth-child(odd)::before {
            background: linear-gradient(180deg, #ff6b00, #e6d51e);
        }
    
        .about-us-black section:nth-child(even) {
            border-left: 5px solid #e6d51e;
        }
    
        .about-us-black section:nth-child(odd) {
            border-right: 5px solid #ff6b00;
        }
    
        .about-us-white section:nth-child(odd)::before {
            background: linear-gradient(180deg, #ff6b00, #e6d51e);
        }
    
        .about-us-white section:nth-child(even) {
            border-right: 5px solid #e6d51e;
        }
    
        .about-us-white section:nth-child(odd) {
            border-left: 5px solid #ff6b00;
        }
    
    </style>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for fade-in animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            // Observe all elements with fade-in class
            document.querySelectorAll('.fade-in').forEach(element => {
                observer.observe(element);
            });
            
            // Add random accent dots for visual interest
            const sections = document.querySelectorAll('section');
            sections.forEach(section => {
                for (let i = 0; i < 5; i++) {
                    const dot = document.createElement('div');
                    dot.classList.add('accent-dot');
                    dot.style.top = `${Math.random() * 100}%`;
                    dot.style.left = `${Math.random() * 100}%`;
                    dot.style.opacity = Math.random() * 0.5 + 0.1;
                    section.appendChild(dot);
                }
            });
        });
    </script>
@endsection

