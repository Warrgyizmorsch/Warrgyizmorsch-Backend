@extends('layouts.app')

@section('content')
    <style>
        /* ============ Search Bar Styles ============ */
        .blog-search-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .blog-search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: white;
            border: 2px solid #e9e9ef;
            border-radius: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(252, 145, 24, 0.08);
        }

        .blog-search-wrapper:hover {
            border-color: #FC9118;
            box-shadow: 0 4px 16px rgba(252, 145, 24, 0.12);
        }

        .blog-search-wrapper:focus-within {
            border-color: #FC9118;
            box-shadow: 0 6px 20px rgba(252, 145, 24, 0.15);
        }

        .blog-search-icon {
            width: 20px;
            height: 20px;
            margin: 0 14px;
            color: #FC9118;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .blog-search-wrapper:focus-within .blog-search-icon {
            color: #FC9118;
            transform: scale(1.1);
        }

        .blog-search-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 14px 14px 14px 0;
            font-size: 15px;
            color: #1e1e25;
            outline: none;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .blog-search-input::placeholder {
            color: #a0a0a8;
            font-weight: 400;
        }

        .blog-search-input:focus::placeholder {
            color: #ccc;
        }

        .blog-search-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #FC9118;
            border-top: none;
            border-radius: 0 0 14px 14px;
            box-shadow: 0 8px 24px rgba(252, 145, 24, 0.15);
            z-index: 1000;
            max-height: 500px;
            overflow-y: auto;
            animation: slideDown 0.2s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blog-search-results {
            display: flex;
            flex-direction: column;
        }

        .blog-search-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f5;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .blog-search-item:last-child {
            border-bottom: none;
        }

        .blog-search-item:hover {
            background: #fef9f3;
            padding-left: 20px;
        }

        .blog-search-item-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .blog-search-item-content {
            flex: 1;
            min-width: 0;
        }

        .blog-search-item-title {
            font-weight: 600;
            color: #1e1e25;
            font-size: 14px;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .blog-search-item-date {
            font-size: 12px;
            color: #a0a0a8;
        }

        .blog-search-empty {
            padding: 32px 16px;
            text-align: center;
            color: #7a7a85;
            font-size: 14px;
        }

        .blog-search-loading {
            padding: 16px;
            text-align: center;
            color: #FC9118;
            font-size: 14px;
        }

        .blog-search-loader {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 2px solid #f0f0f5;
            border-top-color: #FC9118;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Scrollbar styling for dropdown */
        .blog-search-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .blog-search-dropdown::-webkit-scrollbar-track {
            background: transparent;
        }

        .blog-search-dropdown::-webkit-scrollbar-thumb {
            background: #e9e9ef;
            border-radius: 3px;
        }

        .blog-search-dropdown::-webkit-scrollbar-thumb:hover {
            background: #FC9118;
        }

        @media (max-width: 600px) {
            .blog-search-container {
                max-width: 100%;
                padding: 0 16px;
            }

            .blog-search-input {
                padding: 12px 14px 12px 0;
                font-size: 14px;
            }

            .blog-search-dropdown {
                max-height: 400px;
            }

            .blog-search-item {
                padding: 10px 14px;
            }

            .blog-search-item:hover {
                padding-left: 16px;
            }

            .blog-search-item-img {
                width: 45px;
                height: 45px;
            }
        }

        /* ============ Base resets ============ */
        .new-blog-page-wrap {
            padding: 24px 16px;
            background: #f7f7fb;
            margin-top: 120px;
        }

        .new-blog-page-title {
            text-align: left;
            margin: 0 auto 16px;
            font-size: 20px;
            font-weight: 700;
            color: #1e1e25;
        }

        /* ============ Grid ============ */
        .new-blog-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 3fr 1fr;
            /* wide left, narrow right */
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .new-blog-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        @media (max-width: 860px) {
            .new-blog-grid {
                grid-template-columns: 1fr;
            }

            .new-blog-page-wrap {
                margin-top: 100px;
            }
        }

        .new-blog-left-col {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .new-blog-right-col {
            position: relative;
        }

        /* Sticky sidebar on large screens */
        .new-blog-sidebar-sticky {
            position: sticky;
            top: 90px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* ============ Cards ============ */
        .new-blog-card {
            background: #ffffff;
            border: 1px solid #e9e9ef;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .new-blog-card-img {
            display: block;
            width: 100%;
            height: 430px;
            object-fit: fill;
        }

        @media (max-width: 576px) {
            .new-blog-card-img {
                height: 220px;
            }
        }

        .new-blog-card-body {
            padding: 16px;
        }

        .new-blog-meta {
            font-size: 12px;
            color: #7a7a85;
            margin-bottom: 6px;
        }

        .new-blog-card-title {
            margin: 0 0 8px;
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
            color: #1e1e25;
            text-align: left;
        }

        .new-blog-card-title a {
            color: inherit;
            text-decoration: none;
        }

        .new-blog-card-title a:hover {
            text-decoration: underline;
        }

        .new-blog-card-text {
            margin: 0 0 12px;
            color: #61616b;
            font-size: 14px;
        }

        /* ============ Grid of remaining cards (two per row) ============ */
        .new-blog-card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (max-width: 620px) {
            .new-blog-card-grid {
                grid-template-columns: 1fr;
            }
        }

        .new-blog-card-sm .new-blog-card-img {
            height: 220px;
        }

        .new-blog-card-sm .new-blog-card-title {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .new-blog-card-sm .new-blog-card-text {
            font-size: 13px;
        }

        /* ============ Banner image ============ */
        .new-blog-banner {
            border: 1px solid #e9e9ef;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        .new-blog-banner img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* ============ Buttons (theme #FC9118) ============ */
        .new-blog-custom-btn {
            background-color: #FC9118;
            padding: 6px 14px;
            border-radius: 11px;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 3px 10px rgba(252, 145, 24, 0.4);
            border: none;
            cursor: pointer;
        }

        .new-blog-custom-btn::before {
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

        .new-blog-custom-btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 15px rgba(252, 145, 24, 0.6);
            background-position: right center;
        }

        .new-blog-custom-btn:hover::before {
            left: 200%;
        }

        /* ============ Load more button wrapper ============ */
        .new-blog-load-more {
            display: flex;
            justify-content: center;
            padding-top: 8px;
        }
    </style>

    <section class="new-blog-page-wrap">

        <h1 style="margin-bottom: 30px;">WTS - Blogs</h1>

        <!-- Premium Search Bar -->
        <div style="max-width: 1200px; margin: 0 auto 40px;">
            <div class="blog-search-container">
                <div class="blog-search-wrapper">
                    <svg class="blog-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" id="blog-search-input"
                        placeholder="Search blogs... (e.g., IELTS, visa, UK universities)" class="blog-search-input"
                        autocomplete="off">
                </div>
                <div id="blog-search-dropdown" class="blog-search-dropdown" style="display: none;">
                    <div class="blog-search-results" id="blog-search-results"></div>
                </div>
            </div>
        </div>

        <div class="new-blog-grid">
            <!-- LEFT: wide column -->
            <div class="new-blog-left-col">
                @if($blogs->first())
                    @php $featured = $blogs->first(); @endphp
                    <div class="new-blog-card">
                        <a href="{{ url('/blog', $featured->slug) }}">
                            <img src="{{ asset($featured->images) }}" alt="{{ $featured->title }}" class="new-blog-card-img">
                        </a>
                        <div class="new-blog-card-body">
                            <div class="new-blog-meta">{{ $featured->created_at->format('F j, Y') }}</div>
                            <h2 class="new-blog-card-title">
                                <a href="{{ url('/blog', $featured->slug) }}">{{ $featured->title }}</a>
                            </h2>
                            <p class="new-blog-card-text">
                                {{ Str::limit(strip_tags($featured->content), 140, '…') }}
                            </p>
                            <a href="{{ url('/blog', $featured->slug) }}" class="new-blog-custom-btn">Read more</a>
                        </div>
                    </div>
                @endif

                <!-- Remaining posts: two per row -->
                <div id="blog-container" class="new-blog-card-grid">
                    @foreach ($blogs->skip(1) as $blog)
                        <div class="new-blog-card new-blog-card-sm">
                            <a href="{{ url('/blog', $blog->slug) }}">
                                <img src="{{ asset($blog->images) }}" alt="{{ $blog->title }}" class="new-blog-card-img">
                            </a>
                            <div class="new-blog-card-body">
                                <div class="new-blog-meta">{{ $blog->created_at->format('F j, Y') }}</div>
                                <h3 class="new-blog-card-title" style="font-size:16px;">
                                    <a href="{{ url('/blog', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="new-blog-card-text">
                                    {{ Str::limit(strip_tags($blog->content), 100, '…') }}
                                </p>
                                <a href="{{ url('/blog', $blog->slug) }}" class="new-blog-custom-btn"
                                    style="background:#fff;color:#FC9118;border:1px solid #FC9118;box-shadow:none;">Read</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($blogs->hasMorePages())
                    <div class="new-blog-load-more">
                        <button id="load-more-btn" class="new-blog-custom-btn">Show More</button>
                    </div>
                @endif

            </div>

            <!-- RIGHT: narrow column -->
            <aside class="new-blog-right-col">
                <div class="new-blog-sidebar-sticky">
                    <div>
                        @include('./components/landing-page-registration-study-abroad')
                    </div>
                    <div class="new-blog-banner">
                        <img src="{{ asset('/new-home-images/WTS-Blog-Image.webp') }}" alt="WTS Banner">
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <script>
        // ============ Blog Search Functionality ============
        const searchInput = document.getElementById('blog-search-input');
        const searchDropdown = document.getElementById('blog-search-dropdown');
        const searchResults = document.getElementById('blog-search-results');
        let searchTimeout;

        // Open dropdown when input is focused
        searchInput.addEventListener('focus', function () {
            if (this.value.length >= 2) {
                searchDropdown.style.display = 'block';
            }
        });

        // Search functionality with debounce
        let controller;

            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    searchDropdown.style.display = 'none';
                    return;
                }

                searchResults.innerHTML = `
                    <div class="blog-search-loading">
                        <span class="blog-search-loader"></span> Searching...
                    </div>
                `;
                searchDropdown.style.display = 'block';

                searchTimeout = setTimeout(() => {

                    if (controller) controller.abort();
                    controller = new AbortController();

                    fetch("{{ url('/search-blogs') }}?q=" + encodeURIComponent(query), {
                        signal: controller.signal
                    })
                        .then(res => res.json())
                        .then(data => {

                            if (!data.results.length) {
                                searchResults.innerHTML = `
                                    <div class="blog-search-empty">
                                        No blogs found for "<strong>${escapeHtml(query)}</strong>"
                                    </div>
                                `;
                                return;
                            }

                            searchResults.innerHTML = data.results.map(blog => `
                                <a href="${blog.url}" class="blog-search-item">
                                    <img src="${blog.image}" 
                                        alt="${escapeHtml(blog.title)}"
                                        class="blog-search-item-img">

                                    <div class="blog-search-item-content">
                                        <div class="blog-search-item-title">
                                            ${highlightQuery(escapeHtml(blog.title), query)}
                                        </div>
                                        <div class="blog-search-item-date">${blog.date}</div>
                                    </div>
                                </a>
                            `).join('');
                        })
                        .catch(err => {
                            if (err.name !== 'AbortError') {
                                console.error(err);
                            }
                        });

                }, 300);
            });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.blog-search-container')) {
                searchDropdown.style.display = 'none';
            }
        });

        // Close dropdown on Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                searchDropdown.style.display = 'none';
            }
        });

        // Helper function to escape HTML
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Helper function to highlight search query in results
        function highlightQuery(text, query) {
            const escapedQuery = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp(`(${escapedQuery})`, 'gi');
            return text.replace(regex, '<strong style="color:#FC9118;">$1</strong>');
        }

        // ============ Load More Blogs ============
        let offset = {{ $blogs->count() }};
        let limit = 4;

        const btn = document.getElementById('load-more-btn');
        const container = document.getElementById('blog-container');

        if (btn) {
            btn.addEventListener('click', function () {
                fetch("{{ url('/load-more-blogs') }}?offset=" + offset)
                    .then(r => r.json())
                    .then(data => {
                        if (data.html) {
                            container.insertAdjacentHTML('beforeend', data.html);
                            offset += limit;
                            if (!data.hasMore) btn.style.display = 'none';
                        }
                    })
                    .catch(err => console.error('Error loading blogs:', err));
            });
        }
    </script>

@endsection