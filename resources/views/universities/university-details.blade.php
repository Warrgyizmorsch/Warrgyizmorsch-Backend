<!-- starting of the university details page  -->
@extends('layouts.app')
@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* ============================================================
               RESET & CSS VARIABLES
               ============================================================ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --font-primary: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --orange: #E87722;
            --orange-dark: #c96210;
            --navy: #1a2a3a;
            --navy-light: #243447;
            --text: #222;
            --muted: #666;
            --border: #e0e0e0;
            --bg: #f7f8fa;
            --white: #fff;
            --main-header-h: 100px;
        }

        @media (max-width: 768px) {
            :root {
                --main-header-h: 80px;
            }
        }

        /* ============================================================
               HERO & TITLE BAR
               ============================================================ */
        .uni-hero-overlay {
            position: absolute;
            inset: 0;
            background: transparent;
            opacity: 0;
        }

        .uni-hero-text {
            position: relative;
            padding: 0 60px 28px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 13px;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .uni-hero-text span {
            color: rgba(255, 255, 255, 0.9);
        }

        .uni-title-bar {
            background:
                linear-gradient(135deg,
                    rgba(13, 31, 45, 0.75) 0%,
                    rgba(26, 58, 82, 0.75) 60%,
                    rgba(42, 80, 112, 0.75) 100%),
                url({{ $university->banner_image_url }}) center / cover no-repeat;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0 200px;
            min-height: 350px;
            margin-top: var(--main-header-h);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        /* ============================================================
               BREADCRUMB
               ============================================================ */
        .uni-breadcrumb {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.7);
            padding: 10px 0 6px;
            flex-wrap: wrap;
        }

        .uni-breadcrumb a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
        }

        .uni-breadcrumb a:hover {
            color: var(--orange);
        }

        .uni-breadcrumb span {
            margin: 0 5px;
        }

        /* ============================================================
               UNI HEADER
               ============================================================ */
        .uni-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0 20px;
            gap: 16px;
            margin-top: auto;
            flex-wrap: wrap;
        }

        .uni-header-left {
            display: flex;
            align-items: center;
            gap: 18px;
            flex: 1;
            min-width: 0;
        }

        .uni-logo {
            width: 70px;
            height: 40px;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 6px;
            background: #060606;
            flex-shrink: 0;
        }

        .uni-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .uni-badge {
            display: inline-block;
            background: #1dbd72;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .uni-name {
            font-size: 34px;
            color: #fff;
            line-height: 1.2;
        }

        .uni-location {
            font-size: 13px;
            color: #cecece;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .uni-btn-apply {
            background: var(--orange);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
            text-decoration: none;
            display: inline-block;
            flex-shrink: 0;
        }

        .uni-btn-apply:hover {
            background: var(--orange-dark);
        }

        /* ============================================================
               STATS BAR
               ============================================================ */
        .uni-stats-bar {
            background: #f8f1eb;
            padding: 18px 130px;
            display: flex;
            flex-wrap: wrap;
            gap: 0;
        }

        .uni-stat-item {
            flex: 1 1 16.66%;
            text-align: center;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 6px 12px;
        }

        .uni-stat-item:last-child {
            border-right: none;
        }

        .uni-stat-icon {
            font-size: 18px;
            margin-bottom: 4px;
            color: #18336c;
        }

        .uni-stat-value {
            color: #18336c;
            font-size: 18px;
            font-weight: 700;
        }

        .uni-stat-label {
            color: #18336c;
            font-size: 13px;
            margin-top: 2px;
        }

        /* ============================================================
               NAV TABS
               ============================================================ */
        .uni-nav-tabs {
            background: #f8f1eb;
            border-bottom: 2px solid var(--border);
            padding: 0 180px;
            display: flex;
            gap: 0;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            position: sticky;
            top: var(--main-header-h);
            z-index: 20;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .uni-nav-tabs::-webkit-scrollbar {
            display: none;
        }

        .uni-nav-tab {
            padding: 14px 18px;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all .2s;
            text-decoration: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .uni-nav-tab.uni-active {
            color: var(--orange);
            border-bottom-color: var(--orange);
            font-weight: 700;
        }

        .uni-nav-tab:hover:not(.uni-active) {
            color: var(--navy);
        }

        /* ============================================================
               SECTIONS
               ============================================================ */
        .uni-section {
            display: block;
            scroll-margin-top: 140px;
            padding-bottom: 40px;
        }

        /* ============================================================
               MAIN LAYOUT
               ============================================================ */
        .uni-main-content {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 30px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            align-items: start;
            gap: 32px;
        }

        .uni-left {
            min-width: 0;
        }

        /* ============================================================
               LEFT COLUMN STYLES
               ============================================================ */
        .uni-section-title {
            position: relative;
            padding-left: 20px;
            font-size: 20px;
            color: var(--navy);
            margin-bottom: 14px;
        }

        .uni-section-title h4 {
            display: inline-block;
            margin-left: 8px;
        }

        .uni-about-text {
            font-size: 14px;
            color: #444;
            line-height: 1.75;
            margin-bottom: 12px;
        }

        .uni-quote-block {
            background: linear-gradient(135deg, #fff8f2, #fff3e8);
            border-left: 4px solid var(--orange);
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
            font-style: italic;
            font-size: 14px;
            color: #555;
            line-height: 1.7;
        }

        /* ============================================================
               STATS GRID
               ============================================================ */
        .uni-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin: 24px 0;
        }

        .uni-stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 18px 14px;
            text-align: center;
        }

        .uni-stat-card .uni-num {
            font-size: 26px;
            font-weight: 700;
            color: var(--orange);
        }

        .uni-stat-card .uni-lbl {
            font-size: 12px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ============================================================
               THINGS TO KNOW
               ============================================================ */
        .uni-things-section {
            margin: 28px 0;
        }

        .uni-things-section h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 14px;
        }

        .uni-things-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .uni-things-list li {
            font-size: 14px;
            color: #444;
            line-height: 1.6;
            padding-left: 20px;
            position: relative;
        }

        .uni-things-list li::before {
            content: '●';
            color: var(--orange);
            position: absolute;
            left: 0;
            font-size: 10px;
            top: 4px;
        }

        .uni-things-list li strong {
            color: var(--navy);
        }

        /* ============================================================
               EMPLOYERS TABLE
               ============================================================ */
        .uni-employers-section {
            margin: 28px 0;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .uni-employers-section h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .uni-employers-section p {
            font-size: 13px;
            color: #555;
            margin-bottom: 14px;
        }

        .uni-employers-section table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .uni-employers-section thead tr {
            background: var(--navy);
            color: #fff;
        }

        .uni-employers-section thead th {
            padding: 12px 14px;
            text-align: left;
            font-weight: 600;
        }

        .uni-employers-section tbody tr {
            border-bottom: 1px solid var(--border);
            background: var(--white);
        }

        .uni-employers-section tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .uni-employers-section tbody td {
            padding: 11px 14px;
            color: #444;
        }

        /* ============================================================
               CAMPUS LIFE
               ============================================================ */
        .uni-campus-section {
            margin: 28px 0;
        }

        .uni-campus-section h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 16px;
        }

        .uni-campus-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .uni-campus-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px;
            display: flex;
            gap: 12px;
        }

        .uni-campus-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            background: #f0f4ff;
        }

        .uni-campus-card h4 {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 5px;
        }

        .uni-campus-card p {
            font-size: 12px;
            color: #666;
            line-height: 1.55;
        }

        /* ============================================================
               ALUMNI
               ============================================================ */
        .uni-alumni-section {
            margin: 28px 0;
        }

        .uni-alumni-section h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 16px;
        }

        .uni-alumni-row {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }

        .uni-alumni-card {
            text-align: center;
        }

        .uni-alumni-avatar {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin: 0 auto 10px;
        }

        .uni-alumni-card .uni-alumni-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
        }

        .uni-alumni-card .uni-alumni-role {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
            line-height: 1.4;
        }

        /* ============================================================
               RIGHT SIDEBAR (NO STICKY)
               ============================================================ */
        .uni-sidebar {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .uni-sidebar-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
        }

        .uni-sidebar-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* ============================================================
               SIDEBAR BUTTONS
               ============================================================ */
        .uni-btn-consult {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            margin-bottom: 10px;
            transition: all .2s;
        }

        .uni-btn-consult.uni-primary {
            background: var(--orange);
            color: #fff;
        }

        .uni-btn-consult.uni-primary:hover {
            background: var(--orange-dark);
        }

        .uni-btn-consult.uni-outline {
            background: transparent;
            border: 2px solid var(--orange);
            color: var(--orange);
        }

        .uni-btn-consult.uni-outline:hover {
            background: #fff8f2;
        }

        .uni-phone-note {
            text-align: center;
            font-size: 12px;
            color: var(--muted);
            margin-top: 6px;
        }

        /* ============================================================
               SIDEBAR INFO ROWS
               ============================================================ */
        .uni-info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
            gap: 8px;
        }

        .uni-info-row:last-child {
            border-bottom: none;
        }

        .uni-info-label {
            color: var(--muted);
            flex-shrink: 0;
        }

        .uni-info-value {
            font-weight: 600;
            color: var(--navy);
            text-align: right;
            word-break: break-word;
        }

        /* ============================================================
               VISA LIST
               ============================================================ */
        .uni-visa-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .uni-visa-list li {
            font-size: 13px;
            color: #444;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .uni-visa-list li::before {
            content: '';
            display: none;
        }

        .uni-visa-list li i {
            color: #1dbd72;
            font-size: 14px;
        }

        /* ============================================================
               DEADLINES
               ============================================================ */
        .uni-deadline-row {
            display: flex;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
            gap: 8px;
        }

        .uni-deadline-row:last-child {
            border-bottom: none;
        }

        .uni-deadline-label {
            color: var(--muted);
        }

        .uni-deadline-value {
            font-weight: 700;
            color: var(--navy);
        }

        /* ============================================================
               CONTENT WRAPPER - Handle Rich Text Editor Content
               ============================================================ */
        .crm-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .crm-wrapper img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .crm-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }

        .crm-wrapper table tbody tr {
            border-bottom: 1px solid var(--border);
        }

        .crm-wrapper table td,
        .crm-wrapper table th {
            padding: 8px;
            overflow-x: auto;
        }

        /* ============================================================
               RESPONSIVE - Tablet (1024px and below)
               ============================================================ */
        @media (max-width: 1024px) {
            .uni-title-bar {
                padding: 0 30px;
            }

            .uni-stats-bar {
                padding: 16px 20px;
            }

            .uni-nav-tabs {
                padding: 0 30px;
            }

            .uni-main-content {
                grid-template-columns: 1fr 280px;
                padding: 0 20px;
                gap: 24px;
            }

            .uni-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ============================================================
               RESPONSIVE - Tablet Portrait (768px and below)
               ============================================================ */
        @media (max-width: 768px) {
            .uni-title-bar {
                padding: 0 16px;
                min-height: 200px;
            }

            .uni-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 12px 0 16px;
                gap: 12px;
            }

            .uni-header-left {
                width: 100%;
            }

            .uni-name {
                font-size: 20px;
            }

            .uni-btn-apply {
                width: 100%;
                text-align: center;
                padding: 12px 16px;
            }

            .uni-stats-bar {
                padding: 14px 16px;
            }

            .uni-stat-item {
                flex: 1 1 33.33%;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 10px 8px;
            }

            .uni-stat-item:nth-child(3n) {
                border-right: none;
            }

            .uni-nav-tabs {
                padding: 0 16px;
            }

            .uni-main-content {
                grid-template-columns: 1fr;
                padding: 0 16px;
                margin: 20px auto;
                gap: 20px;
            }

            .uni-campus-grid {
                grid-template-columns: 1fr;
            }

            .uni-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .uni-alumni-row {
                gap: 20px;
                justify-content: center;
            }

            .uni-section-title {
                font-size: 18px;
            }
        }

        /* ============================================================
               RESPONSIVE - Small Mobile (480px and below)
               ============================================================ */
        @media (max-width: 480px) {
            .uni-title-bar {
                min-height: 280px;
                padding-bottom: 16px;
            }

            .uni-header-left {
                gap: 12px;
            }

            .uni-logo {
                width: 45px;
                height: 45px;
            }

            .uni-name {
                font-size: 18px;
                line-height: 1.1;
            }

            .uni-badge {
                font-size: 9px;
                padding: 2px 6px;
            }

            .uni-stat-item {
                flex: 1 1 50%;
            }

            .uni-stat-value {
                font-size: 15px;
            }

            .uni-stat-label {
                font-size: 10px;
            }

            .uni-stats-grid {
                grid-template-columns: 1fr;
            }

            .uni-section-title {
                font-size: 16px;
                padding-left: 16px;
            }

            .uni-campus-card {
                flex-direction: column;
            }

            .crm-wrapper {
                font-size: 14px;
            }

            .crm-wrapper img {
                width: 100%;
            }
        }
    </style>

    <!-- TITLE BAR -->
    <div class="uni-title-bar">

        <div class="uni-header">
            <div class="uni-header-left">
                <div class="uni-logo">
                    <img src="{{ $university->logo_image_url }}" alt="{{ $university->name }}">
                </div>
                <div>
                    <div class="uni-breadcrumb">
                        <a href="{{ url('/universities') }}">Universities</a><span>›</span>
                        <a href="#">{{ $university->country }}</a><span>›</span>
                        {{ $university->name }}
                    </div>
                    <div class="uni-name">{{ $university->name }}</div>
                    <div class="uni-location">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $university->city }}, {{ $university->country }}
                    </div>
                </div>
            </div>
            <a href="#" class="uni-btn-apply">Apply Now → </a>
        </div>
    </div>

    <!-- STATS BAR -->
    <div class="uni-stats-bar">
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-house"></i></div>
            <div class="uni-stat-value">
                {{ $detail->currency_code }}
                {{ number_format($detail->cost_of_living) }}
            </div>
            <div class="uni-stat-label">Cost of Living / Yr</div>
        </div>
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div class="uni-stat-value">
                {{ $detail->currency_code }}
                {{ number_format($detail->tuition_fee_from) }}
            </div>
            <div class="uni-stat-label">Tuition Fee From</div>
        </div>
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-people-group"></i></div>
            <div class="uni-stat-value">
                {{ number_format($detail->batch_strength) }}
            </div>
            <div class="uni-stat-label">Batch Strength</div>
        </div>
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-globe"></i></div>
            <div class="uni-stat-value">
                {{ $detail->global_diversity ?? 'N/A' }}
            </div>
            <div class="uni-stat-label">Global Diversity</div>
        </div>
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-trophy"></i></div>
            <div class="uni-stat-value">{{$detail->global_ranking}}</div>
            <div class="uni-stat-label">Global Ranking</div>
        </div>
        <div class="uni-stat-item">
            <div class="uni-stat-icon"><i class="fa-solid fa-flag"></i></div>
            <div class="uni-stat-value">{{$detail->country_ranking}}</div>
            <div class="uni-stat-label">Country Ranking</div>
        </div>
    </div>

    <!-- NAV TABS -->
    <nav class="uni-nav-tabs">
        <a href="#" class="uni-nav-tab uni-active" data-target="overview">Overview</a>
        <a href="#" class="uni-nav-tab" data-target="ranking">Ranking</a>
        <a href="#" class="uni-nav-tab" data-target="course">Courses</a>
        <a href="#" class="uni-nav-tab" data-target="admission">Admission</a>
        <a href="#" class="uni-nav-tab" data-target="scholarship">Scholarship</a>
        <a href="#" class="uni-nav-tab" data-target="finances">Finances</a>
        <a href="#" class="uni-nav-tab" data-target="accommodation">Accommodation</a>
        <a href="#" class="uni-nav-tab" data-target="faqs">FAQs</a>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="uni-main-content">

        <!-- LEFT COLUMN -->
        <div class="uni-left">
            <div class="crm-wrapper">
                <div id="overview" class="uni-section uni-active">
                    {!! $detail->overview ?? '' !!}
                </div>

                <div id="ranking" class="uni-section">
                    {!! $detail->ranking_info ?? '' !!}
                </div>
                <div id="course" class="uni-section">
                    @include('universities.course')
                </div>
                <div id="admission" class="uni-section">
                    {!! $detail->admission_requirements ?? '' !!}
                </div>

                <div id="scholarship" class="uni-section">
                    {!! $detail->scholarship_info ?? '' !!}
                </div>

                <div id="finances" class="uni-section">
                    {!! $detail->finances_info ?? '' !!}
                </div>

                <div id="accommodation" class="uni-section">
                    {!! $detail->accommodation_info ?? '' !!}
                </div>
                <div>
                    <div id="faqs" class="uni-section">
                        @include('universities.faq')
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="uni-sidebar">
            @include('./components/landing-page-registration-study-abroad')
            <x-uni-application-form />
        </div>

    </div><!-- /uni-main-content -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.uni-nav-tab');
            const sections = document.querySelectorAll('.uni-section');
            const nav = document.querySelector('.uni-nav-tabs');

            function setActiveTab(targetId) {
                tabs.forEach(tab => {
                    tab.classList.remove('uni-active');
                    if (tab.getAttribute('data-target') === targetId) {
                        tab.classList.add('uni-active');
                        tab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                });
            }

            // Smooth scroll on click
            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target');
                    const targetSection = document.getElementById(targetId);
                    const mainHeaderH = nav.offsetTop > 0 ? parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--main-header-h')) || 70 : 70;
                    const uniNavH = nav.offsetHeight;
                    const extraPadding = 10;
                    const targetPos = targetSection.offsetTop - mainHeaderH - uniNavH - extraPadding;

                    setActiveTab(targetId);
                    window.scrollTo({ top: targetPos, behavior: 'smooth' });
                });
            });

            // Scrollspy
            window.addEventListener('scroll', () => {
                let current = '';
                const navH = nav.offsetHeight + 120;

                sections.forEach(section => {
                    if (window.pageYOffset >= section.offsetTop - navH) {
                        current = section.getAttribute('id');
                    }
                });

                if (current) setActiveTab(current);
            });
        });
    </script>

@endsection