@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary: #1a73e8;
        --secondary: #6b7280;
        --bg-page: #f5f7fb;
        --bg-card: #ffffff;
        --border: #e5e7eb;
        --radius: 12px;
        --gap: 20px;
        --text-dark: #111827;
    }

    body, html {
        overflow-x: hidden;
    }

    /* PAGE */
    .course-finder-page {
        margin-top: 130px;
        font-family: Inter, system-ui, -apple-system, sans-serif;
        background: var(--bg-page);
        color: var(--text-dark);
    }

    /* HEADER */
    .page-header {
        text-align: left;
        /* margin-bottom: 30px; */
        margin: 0 30px;
        padding: 20px 0;
        display: flex;
        justify-content: space-between;
    }

    .page-header h1 {
        text-align: left;

        font-size: 1.5rem;
        font-weight: 500;
    }

    .page-header p {
        /* color: var(--secondary); */
        font-size: 0.8rem;
    }

    /* LAYOUT */
    .course-layout {
        display: flex;
        gap: var(--gap);
        align-items: flex-start;
        margin: 0 30px;
    }

    /* SIDEBAR */
    .course-filters {
        width: 300px;
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        position: sticky;
        top: 120px;
        /* max-height: calc(100vh - 140px); */
        /* overflow-y: auto; */
    }

    /* SIDEBAR HEADER */
    .filter-header {
        padding: 16px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        font-size: 13px;
    }

    .filter-header a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }

    /* FILTER SECTION */
    .filter-section {
        border-bottom: 1px solid var(--border);
    }

    .filter-title {
        padding: 14px 16px;
        font-weight: 600;
        font-size: 14px;
        background: #fafafa;
        display: flex;
        justify-content: space-between;
    }

    /* FILTER BODY */
    .filter-body {
        padding: 12px 16px;
    }

    /* SEARCH */
    .filter-search {
        position: relative;
        margin-bottom: 10px;
    }

    .filter-search input {
        width: 100%;
        padding: 8px 10px 8px 32px;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-size: 13px;
    }

    .filter-search::before {
        content: "🔍";
        position: absolute;
        left: 10px;
        top: 7px;
        opacity: .6;
    }

    /* FILTER LIST */
    .filter-list {
        max-height: 180px;
        overflow-y: auto;
    }

    .filter-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        padding: 6px 0;
    }

    .filter-item span {
        color: var(--secondary);
    }

    .filter-item input {
        accent-color: var(--primary);
    }

    /* CONTENT */
    .course-results {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: var(--gap);
    }

    /* RESULTS HEADER */
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* CARDS GRID */
    .course-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--gap);
    }

    /* CARD */
    .course-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        padding: 16px;
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: box-shadow .2s ease;
    }

    .course-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
    }

    .course-card h4 {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .course-card p {
        font-size: 14px;
        color: var(--secondary);
    }

    .college-name {
        font-weight: 600;
    }

    .course-meta {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: var(--secondary);
    }

    .view-details {
        margin-top: auto;
        text-align: center;
        padding: 8px;
        background: var(--primary);
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .view-details:hover {
        background: #1557b0;
    }

    /* RESPONSIVE */
    @media (max-width: 992px) {
        .course-layout {
            flex-direction: column;
        }
        .page-header {
            flex-direction: column;
        }

        .course-filters {
            width: 100%;
            position: static;
            max-height: none;
        }
    }
</style>

<div class="container course-finder-page">
<form method="GET" action="{{ route('course.finder') }}">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>Find Courses & Colleges</h1>
            <p>Compare courses, colleges, fees & eligibility</p>
        </div>
        <div class="currency-wrapper">                        
            {{-- Hidden select (backend friendly) --}}
            <select name="currency" id="currencySelect" style="display:none;" onchange="this.form.submit()">
                @php
                    $currencies = [
                        'INR' => ['Indian Rupee', 'in'],
                        'USD' => ['US Dollar', 'us'],
                        'CAD' => ['Canadian Dollar', 'ca'],
                        'AUD' => ['Australian Dollar', 'au'],
                        'NZD' => ['New Zealand Dollar', 'nz'],
                        'GBP' => ['British Pound', 'gb'],
                        'EUR' => ['Euro', 'eu'],
                        'AED' => ['UAE Dirham', 'ae'],
                        'SGD' => ['Singapore Dollar', 'sg'],
                        'CHF' => ['Swiss Franc', 'ch'],
                        'PLN' => ['Polish Zloty', 'pl'],
                        'RUB' => ['Russian Ruble', 'ru'],
                        'SEK' => ['Swedish Krona', 'se'],
                        'DKK' => ['Danish Krone', 'dk'],
                        'NOK' => ['Norwegian Krone', 'no'],
                    ];

                    $selectedCurrency = request('currency', 'INR');
                @endphp

                @foreach($currencies as $code => $data)
                    <option value="{{ $code }}" {{ $selectedCurrency === $code ? 'selected' : '' }}>
                        {{ $code }}
                    </option>
                @endforeach
            </select>

            {{-- Custom UI --}}
            <div class="currency-select-ui" id="currencyUI">
                <div class="selected">
                    <img src="https://flagcdn.com/w20/{{ $currencies[$selectedCurrency][1] }}.png">
                    <span>
                        {{ $selectedCurrency }} 
                        <small>{{ $currencies[$selectedCurrency][0] }}</small>
                    </span>
                    <i class="fa fa-chevron-down"></i>
                </div>

                <ul class="currency-dropdown1">
                    @foreach($currencies as $code => $data)
                        <li data-value="{{ $code }}">
                            <img src="https://flagcdn.com/w20/{{ $data[1] }}.png">
                            <span>
                                <strong>{{ $code }}</strong>
                                <small>{{ $data[0] }}</small>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
            
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const currencyUI = document.getElementById('currencyUI');
                if (!currencyUI) return;

                const currencyDropdown = currencyUI.querySelector('.currency-dropdown1');
                const currencySelect = document.getElementById('currencySelect');

                currencyUI.querySelector('.selected').addEventListener('click', () => {
                    currencyDropdown.style.display =
                        currencyDropdown.style.display === 'block' ? 'none' : 'block';
                });

                currencyDropdown.querySelectorAll('li').forEach(item => {
                    item.addEventListener('click', () => {
                        currencySelect.value = item.dataset.value;
                        currencySelect.form.submit();
                    });
                });

                document.addEventListener('click', e => {
                    if (!e.target.closest('.currency-select-ui')) {
                        currencyDropdown.style.display = 'none';
                    }
                });

            });

        </script>
        <style>
            .currency-wrapper {
                position: relative;
                width: fit-content;
                /* width: 100%; */
            }

            .currency-select-ui {
                position: relative;
                cursor: pointer;
            }

            .currency-select-ui .selected {
                display: flex;
                align-items: center;
                gap: 12px;
                height: 40px;
                padding: 0 14px;
                border: 1px solid var(--border);
                border-radius: 6px;
                font-size: 14px;
                background: #fff;
                transition: all .2s ease;
            }

            .currency-select-ui .selected:hover {
                border-color: var(--primary);
            }

            .currency-select-ui img {
                width: 22px;
                height: 15px;
                border-radius: 2px;
            }

            .currency-select-ui span {
                display: flex;
                flex-direction: column;
                line-height: 1.1;
            }

            .currency-select-ui small {
                font-size: 11px;
                color: #6b7280;
            }

            .currency-select-ui i {
                margin-left: auto;
                font-size: 10px;
            }

            .currency-dropdown1 {
                display: none;
                position: absolute;
                top: 110%;
                left: 0;
                width: 100%;
                max-height: 420px;
                overflow-y: auto;
                background: #fff;
                border-radius: 6px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.12);
                padding: 8px;
                z-index: 5;
            }

            .currency-dropdown1 li {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 10px 12px;
                border-radius: 6px;
                cursor: pointer;
                font-size: 14px;
            }

            .currency-dropdown1 li:hover {
                background: #f3f4f6;
            }

        </style>

    </div>

    <div class="course-layout">

        {{-- SIDEBAR --}}
        <aside>
            
            <div class="course-filters">
                <div class="filter-header">
                    <span>FOUND <strong>{{ $totalCourses }}</strong> COURSES</span>
                    <a href="{{ route('course.finder') }}">Reset</a>
                </div>

                {{-- UNIVERSITY --}}
                <div class="filter-section">
                    <div class="filter-title">University <span class="toggle-icon">▼</span></div>
                    <div class="filter-body">

                        <div class="filter-search">
                            <input type="text" placeholder="Search university" onkeyup="filterUniversity(this)">
                        </div>

                        <div class="filter-list" id="universityFilter">
                            @foreach($universitiesList as $u)
                            <label class="filter-item">
                                <input type="checkbox" name="university[]" value="{{ $u->university_id }}"
                                    {{ in_array($u->university_id, request('university', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                {{ $u->university_name }}
                                <span>[{{ $u->total }}]</span>
                            </label>
                            @endforeach
                        </div>

                    </div>
                </div>
                <script>
                    function filterUniversity(input) {
                        const filter = input.value.toLowerCase();
                        document.querySelectorAll('#universityFilter label').forEach(label => {
                            label.style.display = label.textContent.toLowerCase().includes(filter) ?
                                'flex' :
                                'none';
                        });
                    }
                </script>

                {{-- STREAM --}}
                <div class="filter-section">
                    <div class="filter-title">Stream <span class="toggle-icon">▼</span></div>
                    <div class="filter-body">
                        <div class="filter-list">
                            @foreach($streams as $s)
                            <label class="filter-item">
                                <input type="checkbox" name="stream[]" value="{{ $s->name }}"
                                    {{ in_array($s->name, request('stream', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">

                                {{ $s->name }}
                                <span>[{{ $s->total }}]</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Fee --}}
                <div class="filter-section">
                    <div class="filter-title">Avg Fee Per Year <span class="toggle-icon">▼</span></div>
                    <div class="filter-body">
                        <div class="filter-list">
                            @foreach($fees as $fee)
                            <label class="filter-item">
                                <input type="checkbox" name="fee[]" value="{{ $fee->key }}"
                                    {{ in_array($fee->key, request('fee', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                {{ $fee->label }}
                                <span>[{{ $fee->total }}]</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- COURSE TYPE --}}
                <div class="filter-section">
                    <div class="filter-title">Course Type <span class="toggle-icon">▼</span></div>
                    <div class="filter-body">
                        <div class="filter-list">
                            @foreach($courseTypes as $type)
                            <label class="filter-item">
                                <input type="checkbox" name="course_type[]" value="{{ $type->type }}"
                                    {{ in_array($type->type, request('course_type', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">

                                {{ ucfirst($type->type) }}
                                <span>[{{ $type->total }}]</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- DURATION --}}
                <div class="filter-section">
                    <div class="filter-title">Course Duration <span class="toggle-icon">▼</span></div>
                    <div class="filter-body">
                        <div class="filter-list">
                            @foreach($durations as $d)
                            <label class="filter-item">
                                <input type="checkbox" name="duration[]" value="{{ $d->label }}"
                                    {{ in_array($d->label, request('duration', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                {{ ucfirst($d->label) }}
                                <span>[{{ $d->total }}]</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- GLASS EXPERT CARD --}}
            <div class="expert-glass-card">

                <div class="expert-avatar">
                    <img src="{{ asset('images/universities/Afrin.png') }}" alt="Expert">
                </div>

                <h3>FREE Expert<br>Consultation</h3>

                <p>
                    Get personalized results as per<br>
                    your requirements
                </p>

                <button type="button" class="expert-glass-btn js-open-custom-study-modal">
                    Talk to Expert for FREE
                </button>

            </div>
            <style>

                /* Glass Expert Card */
                .expert-glass-card {
                    position: relative;
                    padding: 40px 25px 35px;
                    border-radius: var(--radius);
                    text-align: center;
                    overflow: hidden;
                    margin-top: 25px;
                    max-width: 300px;

                    /* Gradient Background */
                    background: linear-gradient(160deg, #1e5ea8 0%, #6ea0cf 100%);

                    /* Glass Shadow */
                    box-shadow: 
                        0 15px 40px rgba(0,0,0,0.18),
                        inset 0 1px 0 rgba(255,255,255,0.25);

                    transition: all 0.4s ease;
                }

                /* Soft Wave Overlay */
                .expert-glass-card::before {
                    content: "";
                    position: absolute;
                    inset: 0;
                    background: 
                        radial-gradient(circle at 20% 30%, rgba(255,255,255,0.15), transparent 60%),
                        radial-gradient(circle at 80% 70%, rgba(255,255,255,0.12), transparent 60%);
                    pointer-events: none;
                }

                /* Hover Floating Effect */
                .expert-glass-card:hover {
                    /* transform: translateY(-8px); */
                    box-shadow: 
                        0 25px 55px rgba(0,0,0,0.25),
                        inset 0 1px 0 rgba(255,255,255,0.25);
                }

                /* Avatar */
                .expert-avatar {
                    width: 90px;
                    height: 90px;
                    margin: 0 auto 20px;
                    border-radius: 50%;
                    padding: 5px;

                    /* Glass Circle */
                    background: rgba(255,255,255,0.25);
                    backdrop-filter: blur(10px);
                    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                }

                .expert-avatar img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 50%;
                }

                /* Heading */
                .expert-glass-card h3 {
                    font-size: 22px;
                    font-weight: 700;
                    color: #ffffff;
                    margin-bottom: 15px;
                    line-height: 1.4;
                }

                /* Description */
                .expert-glass-card p {
                    font-size: 15px;
                    color: rgba(255,255,255,0.9);
                    margin-bottom: 28px;
                }

                /* Glass Button */
                .expert-glass-btn {
                    background: rgba(255,255,255,0.95);
                    color: #1e5ea8;
                    border: none;
                    padding: 14px 24px;
                    font-weight: 600;
                    border-radius: 40px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .expert-glass-btn:hover {
                    background: #ffffff;
                    transform: scale(1.05);
                    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                }

                /* Hide card below 993px */
                @media (max-width: 992px) {
                    .expert-glass-card {
                        display: none !important;
                    }
                    aside {
                        width: 100% !important;
                    }
                }

            </style>


        </aside>

        <style>
            .filter-body {
                display: none;
            }

            .filter-title {
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .filter-title .toggle-icon {
                transition: transform 0.25s ease;
                display: inline-block;
            }

            .filter-body[style*="display: block"] ~ .filter-title .toggle-icon {
                transform: rotate(180deg);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const filterSections = document.querySelectorAll('.filter-section');

                filterSections.forEach((section, index) => {
                    const title = section.querySelector('.filter-title');
                    const body = section.querySelector('.filter-body');
                    const icon = title.querySelector('.toggle-icon');

                    const hasChecked = body.querySelector('input[type="checkbox"]:checked') !== null;

                    const shouldBeOpen = (index === 0) || hasChecked;

                    body.style.display = shouldBeOpen ? 'block' : 'none';

                    if (shouldBeOpen && icon) {
                        icon.style.transform = 'rotate(180deg)';
                    }

                    title.addEventListener('click', () => {
                        const isVisible = body.style.display === 'block';
                        body.style.display = isVisible ? 'none' : 'block';

                        if (icon) {
                            icon.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
                        }
                    });
                });
            });
        </script>

        {{-- RESULTS --}}
        <section class="course-results">

                <div class="top-search-row">
                    <div class="top-search-input">
                        <!-- <input type="text" name="course" value="{{ request('course') }}" placeholder="Search Courses"
                            onblur="this.form.submit()"> -->
                            <input type="text" name="course" id="courseSearch" value="{{ request('course') }}" 
                                placeholder="Search Courses">
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {

                            const courseInput = document.getElementById("courseSearch");
                            const form = courseInput.closest("form");

                            courseInput.addEventListener("keydown", function (e) {

                                if (e.key === "Enter") {
                                    e.preventDefault(); // prevent default submit

                                    // Clear all checkboxes
                                    form.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                                        cb.checked = false;
                                    });

                                    // Reset dropdowns except currency
                                    form.querySelectorAll('select').forEach(select => {
                                        if (select.name !== "currency") {
                                            select.selectedIndex = 0;
                                        }
                                    });

                                    form.submit();
                                }
                            });

                        });
                    </script>

                </div>
                {{-- ================= SORT ROW ================= --}}
                <div class="sort-row">

                    @php
                        $countries = [
                            'United States','Canada','Australia','Ireland',
                            'Malaysia','New Zealand','Singapore',
                            'United Kingdom','United Arab Emirates'
                        ];

                        $months = [
                            'january','february','march','april','may','june',
                            'july','august','september','october','november','december'
                        ];

                        $currentYear = now()->year;
                        $years = [
                            $currentYear,
                            $currentYear + 1,
                            $currentYear + 2,
                            $currentYear + 3
                        ];
                    @endphp


                    {{-- COUNTRY --}}
                    <div class="filter-box">
                        <select name="country" id="countrySelect" hidden onchange="this.form.submit()">
                            <option value="">All Countries</option>
                            @foreach($countries as $c)
                                <option value="{{ strtolower($c) }}"
                                    {{ request('country') === strtolower($c) ? 'selected' : '' }}>
                                    {{ $c }}
                                </option>
                            @endforeach
                        </select>

                        <div class="custom-select" data-target="countrySelect">
                            <div class="selected">
                                {{ request('country') ? ucfirst(request('country')) : 'Select Country' }}
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown1">
                                <li data-value="">All Countries</li>
                                @foreach($countries as $c)
                                    <li data-value="{{ strtolower($c) }}">{{ $c }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    {{-- CITY --}}
                    <div class="filter-box">
                        <select name="city" id="citySelect" hidden onchange="this.form.submit()">
                            <option value="">All Cities</option>
                            @foreach($cities as $city)
                                <option value="{{ strtolower($city) }}"
                                    {{ request('city') === strtolower($city) ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>

                        <div class="custom-select" data-target="citySelect">
                            <div class="selected">
                                {{ request('city') ? ucfirst(request('city')) : 'Select City' }}
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown1">
                                <li data-value="">All Cities</li>
                                @foreach($cities as $city)
                                    <li data-value="{{ strtolower($city) }}">{{ $city }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    {{-- INTAKE YEAR --}}
                    <div class="filter-box">
                        <select name="intake_year" id="yearSelect" hidden onchange="this.form.submit()">
                            <option value="">All Years</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}"
                                    {{ request('intake_year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>

                        <div class="custom-select" data-target="yearSelect">
                            <div class="selected">
                                {{ request('intake_year') ? request('intake_year') : 'Select Year' }}
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown1">
                                <li data-value="">All Years</li>
                                @foreach($years as $year)
                                    <li data-value="{{ $year }}">{{ $year }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- INTAKE MONTH --}}
                    <div class="filter-box">
                        <select name="intake_month" id="monthSelect" hidden onchange="this.form.submit()">
                            <option value="">All Months</option>
                            @foreach($months as $month)
                                <option value="{{ $month }}"
                                    {{ request('intake_month') === $month ? 'selected' : '' }}>
                                    {{ ucfirst($month) }}
                                </option>
                            @endforeach
                        </select>

                        <div class="custom-select" data-target="monthSelect">
                            <div class="selected">
                                {{ request('intake_month') ? ucfirst(request('intake_month')) : 'Select Intake' }}
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown1">
                                <li data-value="">All Months</li>
                                @foreach($months as $month)
                                    <li data-value="{{ $month }}">{{ ucfirst($month) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>                    

                    {{-- SORT --}}
                    <div class="sort-box">
                        <span>Sort By:</span>

                        <button type="submit" name="sort" value="fee_low"
                            class="{{ request('sort') == 'fee_low' ? 'active' : '' }}">
                            Lowest
                        </button>
                        <span>|</span>
                        <button type="submit" name="sort" value="fee_high"
                            class="{{ request('sort') == 'fee_high' ? 'active' : '' }}">
                            Highest
                        </button>
                    </div>

                </div>
                <style>
                    /* ===== GRID LAYOUT ===== */
                    .sort-row {
                        display: grid;
                        /* grid-template-columns: repeat(4, minmax(160px, 1fr)) auto; */
                        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                        gap: 10px;
                        align-items: center;
                        padding-bottom: 18px;
                        border-bottom: 1px solid #e5e7eb;
                    }

                    /* ===== FILTER BOX ===== */
                    .filter-box {
                        position: relative;
                    }

                    /* ===== CUSTOM SELECT ===== */
                    .custom-select .selected {
                        height: 30px;
                        padding: 0 12px;
                        border: 1px solid #e5e7eb;
                        border-radius: 6px;
                        background: #ffffff;
                        font-size: 13px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        cursor: pointer;
                        transition: all .2s ease;
                    }

                    .custom-select .selected:hover {
                        border-color: var(--primary);
                        box-shadow: 0 0 0 2px rgba(26,115,232,0.05);
                    }

                    .custom-select i {
                        font-size: 10px;
                        opacity: .7;
                    }

                    /* ===== dropdown1 ===== */
                    .dropdown1 {
                        display: none;
                        position: absolute;
                        top: 110%;
                        left: 0;
                        width: 100%;
                        max-height: 250px;
                        overflow-y: auto;
                        background: #fff;
                        border-radius: 6px;
                        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
                        padding: 6px;
                        z-index: 5;
                    }

                    .dropdown1 li {
                        padding: 8px 10px;
                        font-size: 13px;
                        border-radius: 6px;
                        cursor: pointer;
                    }

                    .dropdown1 li:hover {
                        background: #f3f4f6;
                    }

                    /* ===== SORT ===== */
                    .sort-box {
                        display: flex;
                        align-items: center;
                        /* gap: 8px; */
                        gap: 5px;
                        font-size: 13px;
                    }

                    .sort-box span {
                        font-weight: 600;
                    }

                    .sort-box button {
                        border: none;
                        background: none;
                        cursor: pointer;
                        color: #444;
                        font-size: 13px;
                    }

                    .sort-box button.active {
                        color: #f97316;
                        font-weight: 600;
                    }

                    /* ===== RESPONSIVE ===== */
                    @media (max-width: 992px) {
                        .sort-row {
                            grid-template-columns: repeat(2, 1fr);
                        }
                    }

                    @media (max-width: 500px) {
                        .sort-row {
                            grid-template-columns: 1fr;
                        }
                    }

                </style>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {

                        document.querySelectorAll('.custom-select').forEach(select => {

                            const selected = select.querySelector('.selected');
                            const dropdown1 = select.querySelector('.dropdown1');
                            const targetId = select.dataset.target;
                            const realSelect = document.getElementById(targetId);

                            selected.addEventListener('click', () => {

                                document.querySelectorAll('.dropdown1').forEach(d => {
                                    if (d !== dropdown1) d.style.display = 'none';
                                });

                                dropdown1.style.display =
                                    dropdown1.style.display === 'block' ? 'none' : 'block';
                            });

                            dropdown1.querySelectorAll('li').forEach(item => {
                                item.addEventListener('click', () => {
                                    realSelect.value = item.dataset.value;
                                    realSelect.form.submit();
                                });
                            });

                            document.addEventListener('click', e => {
                                if (!e.target.closest('.custom-select')) {
                                    dropdown1.style.display = 'none';
                                }
                            });

                        });

                    });

                </script>
            <div class="grid">
                @forelse ($universities as $index => $uni)
                @php
                    $displayCurrency = request('currency', 'INR');
                @endphp

                @php
                $s3Base = 'https://crizac-assets.s3.ap-south-1.amazonaws.com/system';
                @endphp

                <div class="card-uni" style="animation-delay: {{ min($index * 0.1, 1) }}s;">

                    {{-- Banner --}}
                    <!-- <img class="uni-img" src="{{ $uni->banner_image
                        ? $s3Base . '/' . $uni->banner_image
                        : asset('images/university-images/harvard-university.webp') }}" alt="{{ $uni->course_title }}"
                                        onerror="this.src='{{ asset('images/university-images/harvard-university.webp') }}'"> -->

                    <div class="card-content">

                        {{-- University Header --}}
                        @if($uni->university)
                            @php
                                $countrySlug = optional($uni->university)->country_slug;
                                $slug = optional($uni->university)->slug;

                                // Check if university_id exists
                                $isValidRoute = $uni->university && $uni->university->details;
                            @endphp

                            @if($isValidRoute && $countrySlug && $slug)
                                <a href="{{ route('university.show', [
                                    'country' => $countrySlug,
                                    'slug' => $slug
                                ]) }}" style="text-decoration: none; color: inherit; display: block;">
                                    <div class="university-header">
                            @else
                            <div style="text-decoration: none; color: inherit; display: block;">
                                <div class="university-header">
                            @endif
                                    <!-- @php
                                    $logo = $uni->university->logo_image ?? null;
                                    @endphp

                                    @if($logo && $logo !== '0')
                                    <img class="university-logo" src="{{ $s3Base . '' . $uni->university->logo_image }}"
                                        onerror="this.remove();">
                                    @endif -->
                                    @php
                                        $logoPath = $uni->university->logo_image ?? null;
                                        $logoFile = $logoPath ? basename($logoPath) : null;
                                    @endphp

                                @if($uni->university->logo_image_url !== asset('images/default-logo.png'))
                                        <img
                                            class="university-logo"
                                            src="{{ $uni->university->logo_image_url }}"
                                            alt="{{ $uni->university->name }}"
                                            loading="lazy"
                                        />
                                    @endif

                                    <!-- <h4 style="margin-bottom: 10px;">{{ $uni->university->name }}</h4> -->
                                    <div class="uni-meta-wrap">
                                        <h4 class="uni-name">
                                            {{ $uni->university->name }}
                                        </h4>

                                        <div class="uni-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ Str::title(Str::lower($uni->university->city)) }}
                                            <!-- {{ Str::title(Str::lower($uni->university->country ?? '')) }} -->
                                        </div>

                                        <div class="uni-stats">
                                            <span>
                                                <i class="fas fa-trophy"></i>
                                                {{ $uni->university->ranking ?? 'N/A' }}
                                            </span>

                                            <span>
                                                <i class="fas fa-university"></i>
                                                Est. {{ $uni->university->established_year ?? '—' }}
                                            </span>

                                            <span>
                                                <i class="fas fa-users"></i>
                                                {{ $uni->university->enroll_students ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                    <style>
                                        .uni-meta-wrap {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 4px;
                                        width: 100%
                                    }

                                    .uni-name {
                                        font-size: 18px;
                                        font-weight: 600;
                                        margin: 0;
                                        color: #111827;
                                    }

                                    .uni-location {
                                        font-size: 14px;
                                        color: #6b7280;
                                        display: flex;
                                        align-items: center;
                                        gap: 6px;
                                    }

                                    .uni-location i {
                                        color: #f59e0b;
                                    }

                                    .uni-stats {
                                        display: flex;
                                        flex-wrap: wrap;
                                        gap: 14px;
                                        margin-top: 6px;
                                        font-size: 13px;
                                        color: #4b5563;
                                    }

                                    .uni-stats span {
                                        display: flex;
                                        align-items: center;
                                        gap: 5px;
                                        white-space: nowrap;
                                    }

                                    .uni-stats i {
                                        color: #f59e0b;
                                        font-size: 13px;
                                    }

                                    </style>
                                </div>
                            @if($isValidRoute && $countrySlug && $slug)
                            </a>
                            @else
                            </div>
                            @endif
                        @endif
                        <hr>
                        
                        <h5>{{ $uni->course_name }}</h5>

                        
                        @php
                            $targetCurrency = request('currency', 'INR');

                            $appConverted = $uni->getConvertedFee(
                                (float) $uni->application_fee,
                                $targetCurrency
                            );

                            $tuitionConverted = $uni->getConvertedFee(
                                (float) $uni->tuition_fee,
                                $targetCurrency
                            );
                        @endphp
                        <br>
                        @if($uni->university && !empty($uni->university->intake))

    @php
        $selectedYear  = request('intake_year');
        $selectedMonth = request('intake_month');

        $nowYear  = now()->year;
        $nowMonth = now()->month;

        $displayYear = $selectedYear ? (int)$selectedYear : $nowYear;

        $monthMap = [
            'january' => 1, 'february' => 2, 'march' => 3,
            'april' => 4, 'may' => 5, 'june' => 6,
            'july' => 7, 'august' => 8, 'september' => 9,
            'october' => 10, 'november' => 11, 'december' => 12,
        ];

        if ($selectedMonth && isset($monthMap[strtolower($selectedMonth)])) {
            $compareMonth = $monthMap[strtolower($selectedMonth)];
        } else {
            if (!$selectedYear || $displayYear == $nowYear) {
                $compareMonth = $nowMonth;
            } elseif ($displayYear > $nowYear) {
                $compareMonth = 1;
            } else {
                $compareMonth = 13;
            }
        }

        $intakeMonths = collect(explode(',', $uni->university->intake))
            ->map(fn($m) => strtolower(trim($m)))
            ->filter()
            ->unique()
            ->values();

        $upcoming = [];

        foreach ($intakeMonths as $month) {
            if (isset($monthMap[$month])) {
                if ($monthMap[$month] >= $compareMonth) {
                    $upcoming[] = ucfirst($month) . ' ' . $displayYear;
                }
            }
        }

        usort($upcoming, fn($a, $b) =>
            $monthMap[strtolower(explode(' ', $a)[0])]
            <=>
            $monthMap[strtolower(explode(' ', $b)[0])]
        );

        // Show first 3 or 4 by default — feels more generous
        $visibleCount   = 3;
        $visibleUpcoming = array_slice($upcoming, 0, $visibleCount);
        $hiddenUpcoming  = array_slice($upcoming, $visibleCount);

        $hasHidden = count($hiddenUpcoming) > 0;
        $hiddenCount = count($hiddenUpcoming);
    @endphp

    <div class="intake-wrapper">
        
        <div class="intake-content">
            
            <div class="intake-label">
                <i class="fas fa-calendar-alt"></i>Intake:
            </div>

            @foreach($visibleUpcoming as $month)
                <span class="intake-chip">{{ $month }}</span>
            @endforeach

            @if($hasHidden)
                <button type="button" 
                        class="intake-toggle"
                        onclick="this.classList.toggle('active'); 
                                 let panel = this.nextElementSibling; 
                                 panel.style.display = panel.style.display === 'flex' ? 'none' : 'flex';">
                    +{{ $hiddenCount }} more
                    <span class="arrow">▼</span>
                </button>

                <div class="intake-hidden-panel" style="display: none;">
                    @foreach($hiddenUpcoming as $month)
                        <span class="intake-chip">{{ $month }}</span>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

@endif
<style>
    .intake-wrapper {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-top: 12px;
    font-size: 0.95rem;
}

.intake-wrapper i {
    margin-right: 0.5rem;
    color: #f39c12;
    min-width: 20px;
    text-align: center;
}

.intake-content {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    width: 100%;
}

.intake-label {
    font-size: 16px;
    font-weight: 600;
    color: #334155;
    margin: 0px;
    white-space: nowrap;
}

.intake-chip {
    padding: 6px 14px;
    border: 1px solid #3b82f6;       /* softer blue */
    border-radius: 9999px;
    font-size: 13px;
    font-weight: 500;
    color: #1d4ed8;
    background: #eff6ff;              /* very light blue bg — modern & clean */
    transition: all 0.2s ease;
    white-space: nowrap;
}

.intake-chip:hover {
    background: #1d4ed8;
    color: white;
    border-color: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* Toggle button */
.intake-toggle {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
    color: #1d4ed8;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 9999px;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.intake-toggle:hover {
    background: #dbeafe;
    border-color: #93c5fd;
}

.intake-toggle.active {
    background: #1d4ed8;
    color: white;
    border-color: #1d4ed8;
}

.intake-toggle .arrow {
    font-size: 11px;
    transition: transform 0.25s ease;
}

.intake-toggle.active .arrow {
    transform: rotate(180deg);
}

/* Hidden panel — now flex row instead of inline */
.intake-hidden-panel {
    display: none;                    /* controlled by JS */
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 8px;
    width: 100%;
    padding-left: 4px;                /* slight indent for visual grouping */
}

/* Mobile — make sure it wraps nicely */
@media (max-width: 480px) {
    .intake-content {
        gap: 6px;
    }
    .intake-chip, .intake-toggle {
        padding: 5px 10px;
        font-size: 12.5px;
    }
}
</style>



                        <div class="fees-box">
                            <div class="course-info-wrap">                                                                

                                <div class="fee-item">
                                    <i class="fas fa-user-graduate"></i> {{ $uni->course_type }}
                                </div>

                                <div class="info">
                                    <i class="fas fa-clock"></i> {{ $uni->duration }}
                                </div>
                            </div>
                            {{-- Application Fee --}}
                            <div class="fee-item">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <div class="fee-card">
                                    <div class="label">Application Fees</div>

                                    <div class="amount primary">
                                        <!-- {{ $uni->currency_symbol }}{{ number_format($uni->application_fee) }} {{ $uni->currency_code }} -->
                                        {{ $uni->formatCurrency((float)$uni->application_fee, $uni->currency_code) }}
                                    </div>

                                    @if($appConverted && $uni->currency_code !== $targetCurrency)
                                        <div class="amount secondary">
                                            <!-- {{ $appConverted['symbol'] }}{{ number_format($appConverted['amount']) }}
                                            {{ $appConverted['currency'] }} -->
                                            {{ $appConverted['formatted'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Tuition Fee --}}
                            <div class="fee-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <div class="fee-card">
                                    <div class="label">Tuition Fees</div>

                                    <div class="amount primary">
                                        <!-- {{ $uni->currency_symbol }}{{ number_format($uni->tuition_fee) }} {{ $uni->currency_code }} -->
                                        {{ $uni->formatCurrency((float)$uni->tuition_fee, $uni->currency_code) }}
                                    </div>

                                    @if($tuitionConverted && $uni->currency_code !== $targetCurrency)
                                        <div class="amount secondary">
                                            <!-- {{ $tuitionConverted['symbol'] }}{{ number_format($tuitionConverted['amount']) }}
                                            {{ $tuitionConverted['currency'] }} -->
                                            {{ $tuitionConverted['formatted'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>                            
                        </div>
                        <style>
                            .fees-box {
                                display: flex;
                                gap: 16px;
                                margin: 0.4rem 0;
                            }

                            .fee-item {
                                display: flex;
                                gap: 0 !important;
                                align-items: flex-start;
                            }

                            .fee-item .fee-card {
                                display: flex;
                                gap: 0.2rem;
                                align-items: flex-start;
                                flex-direction: column;
                            }

                            .fee-item i {
                                margin-right: 0.5rem;
                                color: #f39c12;
                                min-width: 20px;
                                text-align: center;
                            }

                            .label {
                                font-size: 0.95rem;
                                color: #555;
                            }

                            .amount.primary {
                                font-size: 16px;
                                font-weight: 600;
                                color: #111827;
                            }

                            .amount.secondary {
                                font-size: 13px;
                                color: #6b7280;
                            }

                            @media (max-width: 600px) {
                                .fees-box {
                                    flex-direction: column;
                                }
                            }

                        </style>
                        <br>
                        @if($uni->university)
                        <div>
                            {{ $uni->university->description ?? "" }}
                        </div>
                        @endif
                        <hr>
                        <div class="card-actions">
                            <button type="button" class="compare-btn">
                                Compare <i class="fas fa-exchange-alt"></i>
                            </button>

                            <button type="button" class="brochure-btn">
                                Download brochure <i class="fas fa-download"></i>
                            </button>

                            <button type="button" class="apply-btn-course js-open-custom-study-modal">
                                Apply Now <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                    </div>
                </div>
                @empty
                <div class="no-data">No university courses found.</div>
                @endforelse

            </div>

            <div class="pagination">
                {{ $universities->links() }}
            </div>

        </section>

    </div>
</form>
</div>
<!-- modal code start -->
@include('components.course-registration-form-modal')

@endsection

<!-- Card Styling  -->
<style>
    /* Top search layout */
    .top-search-row {
        display: grid;
        /* grid-template-columns: 1fr 3fr; */
        grid-template-columns: 1fr;
        /* grid-template-columns: 1.5fr 4fr 1.5fr; */
        gap: 16px;
        /* margin-bottom: 20px; */
        align-items: center;
    }

    /* Shared input style (select + input look identical) */
    .country-select select,
    .currency-select select,
    .top-search-input input {
        width: 100%;
        min-width: 150px;
        height: 40px;
        /* SAME HEIGHT */
        padding: 0 12px;
        /* SAME PADDING */
        border: 1px solid var(--border);
        border-radius: 6px;
        font-size: 13px;
        background: #fff;
        color: var(--text-dark);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    /* Focus effect (same for both) */
    .country-select select:hover,
    .country-select select:focus,
    .top-search-input input:hover,
    .top-search-input input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(26,115,232,0.05);
    }

    /* Mobile */
    @media (max-width: 768px) {
        .top-search-row {
            grid-template-columns: 1fr;
        }
    }



    .grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
        /* padding: 2rem; */
        /* background: #f9f9f9; */
    }

    .card-uni {
        /* display: flex; */
        /* flex-direction: row; */
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        animation: fadeInUp 0.5s ease forwards;
        transform: translateY(20px);
        opacity: 0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-uni:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card-uni .uni-img {
        /* width: 40%; */
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .university-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Hide image under 1000px */
    @media (max-width: 1000px) {
        .card-uni .uni-img {
            display: none;
        }

        /* Let content take full width */
        .card-content {
            width: 100% !important;
        }
    }
    /* Hide image under 500px */
    @media (max-width: 500px) {
        .university-header {
            flex-direction: column;
        }
    }

    .university-logo {
        width: 55px;
        height: 55px;
        object-fit: contain;
        border-radius: 6px;
        background: #fff;
    }

    .card-content {
        /* width: 60%; */
        width: 100%;
        padding: 1.2rem 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .card-content h4 {
        margin-bottom: 0.5rem;
        font-size: 1.25rem;
        color: #333;
        font-weight: bold;
        overflow: hidden;
        text-align: left;
        /* text-overflow: ellipsis; */
        /* white-space: nowrap; */
    }

    .info {
        font-size: 0.95rem;
        color: #555;
        margin: 0.4rem 0;
        display: flex;
        align-items: center;
        text-align: left;
    }

    .info i {
        margin-right: 0.5rem;
        color: #f39c12;
        min-width: 20px;
        text-align: center;
    }

    .fee {
        color: #27ae60;
        font-weight: 600;
    }

    .no-data {
        font-size: 1.1rem;
        color: #777;
        padding: 2rem;
        grid-column: 1 / -1;
    }

    .course-info-wrap{
        display:flex;
        /* gap:16px; */
        /* align-items:center; */
        flex-wrap:wrap;
        align-items: flex-start;
        flex-direction: column;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 600px) {
        .grid {
            grid-template-columns: 1fr;
            /* padding: 1rem; */
        }

        .university-section {
            padding: 40px 10px 40px 10px;
        }

        .card-content h4 {
            font-size: 1.1rem;
        }

        .info {
            font-size: 0.85rem;
        }

        .course-info-wrap {
            display:block;
        }
    }
</style>

<!-- Pagination styling  -->
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination svg {
        width: 20px;
        height: 20px;
        color: orange;
    }

    .pagination nav>div:first-child {
        display: none;
    }

    .pagination nav {
        display: flex;
        justify-content: center;
    }

    .pagination nav a,
    .pagination nav span {
        margin: 0 5px;
        padding: 6px;
        color: orange;
        text-decoration: none;
    }

    .pagination nav a {
        transition: transform 0.3s ease-in-out, text-decoration 0.3s;
        transform: scale(1);
    }

    .pagination nav a:hover {
        text-decoration: underline;
        transform: scale(1.25);
    }

    .pagination nav span {
        /* background-color: #18336c; */
        color: black;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .pagination nav p {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding: 0;
        color: black;
    }

    .pagination nav span[aria-current='page'] {
        background-color: orange;
        padding: 1px;
        border-radius: 50%;
        color: white;
        font-weight: bold;
    }
</style>

<!-- btn style -->
<style>
    .card-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 24px;
    }

    /* Common reset */
    .card-actions button {
        background: transparent;
        border: 0;
        padding: 0;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        line-height: 1;
        box-shadow: none;
    }

    /* Compare */
    .compare-btn {
        color: #1a73e8;
    }

    .compare-btn:hover {
        text-decoration: underline;
    }

    /* Download */
    .brochure-btn {
        color: #16a34a;
    }

    .brochure-btn:hover {
        text-decoration: underline;
    }

    /* Apply */
    .apply-btn-course {
        color: #f97316 !important;
    }

    .apply-btn-course:hover {
        text-decoration: underline;
    }

    /* Mobile */
    @media (max-width: 480px) {
        .card-actions {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
    }
</style>