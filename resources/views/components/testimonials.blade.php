<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        /* Testimonial Section */
        .testimonial-section {
            text-align: center;
            padding: 50px 20px;
            background: #fff;
        }

        /* Heading */
        .testimonial-heading h2 {
            font-size: 28px;
            color: #1d263b;
            font-weight: 700;
            margin-bottom: 30px;
        }

        /* Swiper Slider */
        .testimonial-slider {
            position: relative;
            max-width: 100%;
            width: 90%;
            margin: auto;
        }

        /* Testimonial Card */
        .testimonial-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }

        /* Small Orange Line Under Card */
        .testimonial-card::before {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 5px;
            background: #f47c20;
            border-radius: 10px;
            z-index: -1;
        }

        /* Image */
        .testimonial-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        /* Name */
        .testimonial-card h3 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Testimonial Text */
        .testimonial-card p {
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        /* Pagination */
        .swiper-pagination {
            margin-top: 15px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .testimonial-card {
                max-width: 350px;
            }
        }

        @media (max-width: 768px) {
            .testimonial-slider {
                width: 100%;
            }

            .testimonial-card {
                max-width: 320px;
            }
        }

        @media (max-width: 480px) {
            .testimonial-card {
                max-width: 90%;
                padding: 15px;
            }

            .testimonial-image img {
                width: 70px;
                height: 70px;
            }

            .testimonial-card h3 {
                font-size: 16px;
            }

            .testimonial-card p {
                font-size: 12px;
            }
        }
    </style>


    <section class="testimonial-section">
        <div class="testimonial-heading">
            <h2>What Our Students Say About Us</h2>
        </div>

        <div class="swiper testimonial-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="{{ asset('images/testimonial1.jpg') }}" loading="lazy"  alt="Yatish Shrimali">
                        </div>
                        <h3>Yatish Shrimali</h3>
                        <p>I'm glad to get the chance to thank Gateway International. They make a good team ensure quality.</p>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="{{ asset('images/testimonial2.jpg') }}" loading="lazy"  alt="Sahiba Burman">
                        </div>
                        <h3>Sahiba Burman</h3>
                        <p>Gateway International was grateful to me for helping me convince my parents to let me study abroad.</p>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="{{ asset('images/testimonial3.jpg') }}" loading="lazy"  alt="Harshvardhan Soni">
                        </div>
                        <h3>Harshvardhan Soni</h3>
                        <p>Through my journey, Gateway International’s advice, guidance, and support have been an enormous help.</p>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="{{ asset('images/testimonial4.jpg') }}" loading="lazy"  alt="Aman Verma">
                        </div>
                        <h3>Aman Verma</h3>
                        <p>Through my journey, Gateway International’s advice, guidance, and support have been an enormous help.</p>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".testimonial-slider", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                480: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 25 },
                1024: { slidesPerView: 3, spaceBetween: 30 }
            }
        });
    </script>