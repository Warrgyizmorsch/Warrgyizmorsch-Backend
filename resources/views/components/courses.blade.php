<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

@props(['courses', 'title', 'desc', 'footer'])

<section class="course-slider-section">
    <div style="max-width: 1250px; margin: 0 auto;">
        <h2>{{ $title ?? ' ' }}</h2>
        <p>{{ $desc ?? ' ' }}</p>

        <div class="swiper courseSwiper">
            <div class="swiper-wrapper">
                @foreach($courses as $course)
                    <div class="swiper-slide">
                        <div class="course-card">
                            <img src="{{ asset($course['image'] ?? ' ') }}" loading="lazy"
                                alt="{{ $course['title'] ?? ' '}}">
                            <div class="course-card-content">
                                <h3>{{ $course['title'] ?? ' ' }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>

        <p class="course-footer-text">{{ $footer ?? ' ' }}</p>
    </div>
</section>


<!-- Swiper JS -->


<!-- Initialize Swiper -->
<script>
    const swiper = new Swiper('.courseSwiper', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        spaceBetween: 24,
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        breakpoints: {
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
</script>

<!-- Internal Modern CSS -->
<style>
    .course-slider-section {
        padding: 30px 15px;
        background: #f9f9f9;
        text-align: center;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .courseSwiper {
        padding: 2rem;
    }

    .swiper-pagination.bullets {
        top: 372px;
    }

    .course-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        max-width: 320px;
        width: 100%;
    }

    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }

    .course-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .course-card:hover img {
        transform: scale(1.05);
    }

    .course-card-content {
        padding: 15px 20px;
    }

    .course-card-content h3 {
        font-size: 1.1rem;
        color: #333;
        font-weight: 600;
        margin: 0;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #dc9123;
        transition: transform 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        transform: scale(1.2);
    }

    .swiper-pagination-bullet {
        background: #ccc;
        opacity: 1;
        transition: background 0.3s;
    }

    .swiper-pagination-bullet-active {
        background: #dc9123;
    }
</style>