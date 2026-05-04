<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <title>{{ $meta['title'] ?? '' }}</title>
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet" />


    <link rel="preload" href="{{ asset('css/custom.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet';">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </noscript>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('new-style.css') }}">
    <script src="{{ asset('new-script.js') }}" defer></script>

    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        onload="this.onload=null;this.rel='stylesheet';">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </noscript>

    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="{{ asset('script.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1D22JRK9WQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-1D22JRK9WQ');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K75D7TFP');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Meta Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1211248630570170');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1211248630570170&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <link rel="preload" as="image" href="/images/fbf0efd993d06415633881cd7b0c43de.jpg">
    {{-- Preload the first thumbnail for faster LCP --}}
    <!-- <link rel="preload" as="image" href="https://img.youtube.com/vi/{{ $firstVideoId ?? 'default_video_id' }}/hqdefault.jpg"> -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        /* Preloader container */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #1D1F20;
            /* match your theme */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        /* Optional fade-out class */
        #preloader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Loader SVG animation */
        .svg-calLoader {
            width: 230px;
            height: 230px;
            transform-origin: 115px 115px;
            animation: 2.4s linear infinite loader-spin;
        }

        .cal-loader__path {
            stroke: #FFFFFF;
            animation: 2.4s ease-in-out infinite loader-path;
        }

        .cal-loader__plane {
            fill: #FFA500;
        }

        @keyframes loader-spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-path {
            0% {
                stroke-dasharray: 0, 580, 0, 0, 0, 0, 0, 0, 0;
            }

            50% {
                stroke-dasharray: 0, 450, 10, 30, 10, 30, 10, 30, 10;
            }

            100% {
                stroke-dasharray: 0, 580, 0, 0, 0, 0, 0, 0, 0;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('preloader');

            // Select elements that must be ready
            const header = document.querySelector('header');
            const heroImg = document.querySelector('.hero-main img');

            const finish = () => {
                if (!preloader) return;
                preloader.classList.add('hidden');
                setTimeout(() => preloader.remove(), 200);
            };

            if (header) {
                if (heroImg && !heroImg.complete) {
                    heroImg.addEventListener('load', finish);
                    heroImg.addEventListener('error', finish);
                } else {
                    finish();
                }
            } else {
                finish();
            }
        });
    </script>


</head>

<body>


    <div class="whatsapp-container">
        <a href="https://wa.me/919116076837?text=Hi%2C%20I%E2%80%99m%20looking%20for%20visa%20consultation%20services.%20Can%20you%20please%20assist%20me%20with%20the%20next%20steps%3F" target="_blank" class="whatsapp-icon">
            <img src="{{ asset('icons/WhatsApp_icon.webp') }}" alt="WhatsApp" />
            <div class="tooltip">Chat with us on WhatsApp!</div>
        </a>
    </div>
    @include('layouts.new-header') <!-- Navigation Bar -->

    <div id="preloader">
        <svg class="svg-calLoader" xmlns="http://www.w3.org/2000/svg" width="230" height="230">
            <path class="cal-loader__path"
                d="M86.429 40c63.616-20.04 101.511 25.08 107.265 61.93 6.487 41.54-18.593 76.99-50.6 87.643-59.46 19.791-101.262-23.577-107.142-62.616C29.398 83.441 59.945 48.343 86.43 40z"
                fill="none" stroke="#0099cc" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"
                stroke-dasharray="10 10 10 10 10 10 10 432" stroke-dashoffset="77" />
            <path class="cal-loader__plane"
                d="M141.493 37.93c-1.087-.927-2.942-2.002-4.32-2.501-2.259-.824-3.252-.955-9.293-1.172-4.017-.146-5.197-.23-5.47-.37-.766-.407-1.526-1.448-7.114-9.773-4.8-7.145-5.344-7.914-6.327-8.976-1.214-1.306-1.396-1.378-3.79-1.473-1.036-.04-2-.043-2.153-.002-.353.1-.87.586-1 .952-.139.399-.076.71.431 2.22.241.72 1.029 3.386 1.742 5.918 1.644 5.844 2.378 8.343 2.863 9.705.206.601.33 1.1.275 1.125-.24.097-10.56 1.066-11.014 1.032a3.532 3.532 0 0 1-1.002-.276l-.487-.246-2.044-2.613c-2.234-2.87-2.228-2.864-3.35-3.309-.717-.287-2.82-.386-3.276-.163-.457.237-.727.644-.737 1.152-.018.39.167.805 1.916 4.373 1.06 2.166 1.964 4.083 1.998 4.27.04.179.004.521-.076.75-.093.228-1.109 2.064-2.269 4.088-1.921 3.34-2.11 3.711-2.123 4.107-.008.25.061.557.168.725.328.512.72.644 1.966.676 1.32.029 2.352-.236 3.05-.762.222-.171 1.275-1.313 2.412-2.611 1.918-2.185 2.048-2.32 2.45-2.505.241-.111.601-.232.82-.271.267-.058 2.213.201 5.912.8 3.036.48 5.525.894 5.518.914 0 .026-.121.306-.27.638-.54 1.198-1.515 3.842-3.35 9.021-1.029 2.913-2.107 5.897-2.4 6.62-.703 1.748-.725 1.833-.594 2.286.137.46.45.833.872 1.012.41.177 3.823.24 4.37.085.852-.25 1.44-.688 2.312-1.724 1.166-1.39 3.169-3.948 6.771-8.661 5.8-7.583 6.561-8.49 7.387-8.702.233-.065 2.828-.056 5.784.011 5.827.138 6.64.09 8.62-.5 2.24-.67 4.035-1.65 5.517-3.016 1.136-1.054 1.135-1.014.207-1.962-.357-.38-.767-.777-.902-.893z"
                class="cal-loader__plane" fill="#000033" />
        </svg>
    </div>

    <main>
        <!-- <div class="cursor-follower"></div> -->
        @yield('content') <!-- Page Content -->
    </main>
    @include('layouts.new-footer') <!-- Footer -->
    <button id="backToTop" class="back-to-top">↑</button>
    @include('layouts.bottomMenu')

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K75D7TFP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
<footer class="footer"></footer>