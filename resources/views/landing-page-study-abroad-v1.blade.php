@extends('layouts.app')

@section('content')

    {{-- New Consultation Form Landing Page V1 --}}
    <!-- Our Affiliates -->
    <section class="affiliates-section" style="margin-top: 100px">
        <div class="container" style="margin: 0 0 1.5rem;">
            <h2 style="margin-top: 1rem;">Move One Step Closer to Studying Abroad</h2>
            <p class="herov1-subtitle">Students from 35+ Indian cities secured admissions abroad with expert guidance from
                WTS, and you can too.</p>

            <a href="#fv1-form-section" class="herov1-btn smooth-scroll-btn">
                Check Your Eligibility
            </a>

            <div class="affiliate-marquee">
                <!-- 1st row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/pennsylvania.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/princeton.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/stanford.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/toronto.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/oxford.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/nus.jpg" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2nd row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/wisconsin.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/michigan.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/glasgow.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/warwick.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/queensland.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/bristol.jpeg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/yale.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/Sydney.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3rd row – left ➜ right -->
                <div class="marquee-row left-right">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/british_columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cornell.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/edinburg.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mcgill.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/melbourne.jpg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/monash.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/northwestern.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/austrakian.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4th row – right ➜ left -->
                <div class="marquee-row right-left">
                    <div class="marquee-track">
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <!-- Repeated -->
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/caltech.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/cambridge.png" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/chicago.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/columbia.png" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/mit.jpeg" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/imperial.jpg" alt="Logo"> </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/john_hopkins.webp" alt="Logo">
                            </div>
                        </div>
                        <div class="affiliate-card">
                            <div class="affiliate-inner"> <img src="/new-home-images/berkeley.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .herov1-subtitle {
                font-size: 18px;
                text-align: center;
            }

            .herov1-btn {
                background-color: rgb(252, 145, 24);
                color: white;
                display: block;
                margin: 1rem auto 2.5rem;
                width: fit-content;
                font-weight: 500;
                box-shadow: rgba(252, 145, 24, 0.4) 0px 3px 10px;
                padding: 8px 16px;
                border-radius: 11px;
                text-decoration: none;
                overflow: hidden;
                transition: 0.4s;
            }

            .herov1-btn:hover {
                transform: translateY(-2px) scale(1.03);
                box-shadow: rgba(252, 145, 24, 0.6) 0px 6px 15px;
                background-position: right center;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const buttons = document.querySelectorAll('.smooth-scroll-btn');

                buttons.forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();

                        const target = document.querySelector("#fv1-form-section");

                        if (target) {
                            const headerOffset = 60; // height of fixed header
                            const elementPosition = target.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: "smooth"
                            });
                        }
                    });
                });

            });
        </script>


    </section>
    {{-- New V1 form --}}
    @include('components.study-abroad-form-v1')

    <!-- Stats section  -->


    <section id="stats" class="stats-section">
        <div class="why-matter">
            <h4>Why Choose WTS?</h4>
            <p>
                These services are part of WTS Visa’s complete journey support -ensuring your path from visa to arrival is
                safe, simple, and stress-free.
            </p>
        </div>
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
                <p>University Partners</p>
            </div>

            <div class="stat-box" data-target="200">
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
        /* Why Matter */
        .why-matter {
            text-align: center;
            max-width: 750px;
            margin: 0 auto 2rem;
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

    <!-- ✅ WTS TESTIMONIALS SECTION - UPDATED -->
    <section class="wts-testimonials">
        <div class="wts-container">

            <h2 class="wts-title">Testimonials</h2>
            <p class="wts-subtitle">Hear from those who got there!</p>

            <div class="wts-grid" id="testimonialContainer">
                <!-- Dynamic cards injected by JS -->
            </div>

        </div>
    </section>

    <style>
        /* === CONTAINER === */
        .wts-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
        }

        /* Section */
        .wts-testimonials {
            padding: 60px 0;
            background: #fff;
        }

        .wts-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .wts-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 40px;
        }

        /* === GRID === */
        .wts-grid {
            max-width: 90%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        /* Card */
        .wts-card {
            background: #f9fbfd;
            border-radius: 16px;
            padding: 18px;
            border: 1px solid #eef2f6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition:
                transform 0.45s cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 0.45s cubic-bezier(0.22, 1, 0.36, 1);
            background 0.4s ease;
            will-change: transform, box-shadow;

        }

        /* Keep equal heights */
        .wts-grid>.wts-card {
            min-height: 280px;
        }

        /* Header */
        .wts-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .wts-header img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fc9118;
        }

        /* Name (in header row) */
        .wts-name {
            font-weight: 700;
            font-size: 15px;
            color: #111;
        }

        /* Divider after header - small line */
        .wts-divider {
            height: 1px;
            background: #e6edf3;
            margin: 10px 0;
            border-radius: 1px;
            width: 100%;
        }

        /* University shown under the divider */
        .wts-university {
            font-size: 13px;
            color: #0b67a3;
            /* blue-ish to stand out like logos in screenshot */
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* Body */
        .wts-body {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            flex-grow: 1;
            /* fill remaining height */
        }

        /* Tablet: 2 columns */
        @media (max-width: 992px) {
            .wts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Mobile: 1 column and show only first 3 cards */
        @media (max-width: 768px) {
            .wts-grid {
                grid-template-columns: 1fr;
                max-width: 100%;
            }

            /* hide cards after the first three on small screens */
            .wts-grid .wts-card:nth-child(n+4) {
                display: none;
            }

            .wts-card {
                min-height: auto;
            }

            .wts-title {
                font-size: 24px;
            }
        }

        /* small visual polish */
        .wts-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.09),
                0 0 0 1px rgba(252, 145, 24, 0.12);
            background: #ffffff;
        }
    </style>

    <script>
        /* === TESTIMONIAL DATA ARRAY ===
           Edit this array to change content/images/university names.
        */
        const testimonials = [
            {
                name: "Abhishek",
                university: "Anglia Ruskin University, Cambridge, UK",
                image: "/testimonial/Abhishek.webp",
                comment: "I was totally confused in the beginning, but things started becoming clearer day by day with their guidance. My counsellor has been extremely supportive, even late evening calls and discussions were handled with patience. It honestly felt like someone was holding my hand throughout the entire process."
            },
            {
                name: "Ayushi",
                university: "University Of Illinois, USA",
                image: "/testimonial/Ayushi.webp",
                comment: "I applied to five universities and received two offer letters. WTS supported me throughout the entire journey of pursuing my master’s. They have separate teams for every stage, so I never felt stuck anywhere. Their process is super organized."
            },
            {
                name: "Amit",
                university: "Humber University, Canada",
                image: "/testimonial/Amit.webp",
                comment: "I’m genuinely grateful to WTS for their outstanding support. From the very first call to the final application submission, their expertise really made the difference. The counsellors gave strategic suggestions and helped refine my documents so perfectly."
            },
            {
                name: "Deepali",
                university: "University of Canada West, Canada",
                image: "/testimonial/Deepali.webp",
                comment: "My WTS mentor made the whole study abroad process feel so smooth. From selecting universities to preparing the visa application, they guided me at every single step."
            },
            {
                name: "Prakhar",
                university: "University of Dayton, USA",
                image: "/testimonial/Prakhar.webp",
                comment: "They helped me with everything, right from shortlisting universities to every small detail during the application journey. The counsellors really know the process well and communicate amazingly, so my doubts were solved quickly."
            },

            {
                name: "Sumandeep",
                university: "Sheffield Hallam University, UK",
                image: "/testimonial/Sumandeep.webp",
                comment: "I was almost about to drop my US plans, but after attending the university meeting arranged by WTS, everything changed. I got my admit for Jan 26, something I had nearly given up on. So grateful for the push and guidance."
            }
        ];

        /* === RENDER CARDS === */
        const container = document.getElementById('testimonialContainer');
        container.innerHTML = ''; // clear if needed

        testimonials.forEach(t => {
            const card = document.createElement('div');
            card.className = 'wts-card';

            card.innerHTML = `
                <div class="wts-header">
                    <img src="${t.image}" alt="${t.name}">
                    <div class="wts-name">${t.name}</div>
                </div>

                <div class="wts-divider" aria-hidden="true"></div>

                <div class="wts-university">${t.university}</div>

                <div class="wts-body">${t.comment}</div>
            `;

            container.appendChild(card);
        });
    </script>

    <!-- Want Study Abroad Guide ? -->
    <section class="study-guide-section">
        <div class="study-guide-container" style="margin-bottom: 0px;">
            <div class="study-guide-content">
                <h2 style="font-weight: 600;">Ready to start your global education journey?</h2>
                <p>Tell us a few details and we’ll check your eligibility for you.</p>
                <a href="#fv1-form-section" class="herov1-btn smooth-scroll-btn" style="margin: 0px;">
                    Check Your Eligibility Now
                </a>
            </div>
            <div class="study-guide-image">
                <img src="/new-home-images/plane-2.png" alt="Plane Image">
            </div>
        </div>
    </section>
@endsection