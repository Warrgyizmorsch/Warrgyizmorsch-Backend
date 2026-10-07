@extends('layouts.app')

@section('title', 'Warrgyizmorsch Leads - CRM')

@section('content')

@php
    $filtersApplied = request('search') || request('from') || request('to') || request('source') || request('status');
@endphp

<style>
    /* Pure White Page Theme */
    body,
    .nxl-container,
    .nxl-content,
    .crm-page-container,
    main.nxl-container {
        background-color: #ffffff !important;
        background: #ffffff !important;
    }

    /* Metric Cards */
    .warr-metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        position: relative;
        overflow: hidden;
    }
    .warr-metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08);
        border-color: #cbd5e1;
    }
    .warr-metric-card .metric-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .warr-metric-card.active-filter {
        border-color: #006FC9;
        box-shadow: 0 0 0 2px rgba(0, 111, 201, 0.15);
    }

    /* Filter Panel */
    .warr-filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    /* Main Table Container */
    .warr-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }
    .warr-table-card .card-header-bar {
        padding: 16px 20px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    /* Table & Headers */
    .warr-table-wrapper {
        position: relative;
        overflow-x: auto;
        max-height: calc(100vh - 320px);
    }
    #warrLeadList {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    #warrLeadList thead th {
        position: sticky !important;
        top: 0 !important;
        z-index: 10 !important;
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px !important;
        padding: 13px 16px !important;
        border-top: none !important;
        border-bottom: 1px solid #e2e8f0 !important;
        white-space: nowrap !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }
    #warrLeadList tbody td {
        padding: 12px 16px !important;
        vertical-align: middle !important;
        font-size: 13px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        background: #ffffff;
        transition: background 0.15s ease;
    }
    #warrLeadList tbody tr:hover td {
        background-color: #f8fafc !important;
    }
    #warrLeadList tbody tr:last-child td {
        border-bottom: none;
    }

    /* Column Specific Styles */
    .warr-avatar-badge {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #006FC9 0%, #0284c7 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 111, 201, 0.2);
    }
    .warr-lead-title {
        font-weight: 600;
        color: #0f172a;
        line-height: 1.25;
    }
    .warr-lead-sub {
        font-size: 11.5px;
        color: #64748b;
        margin-top: 2px;
    }
    .warr-contact-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: #334155;
    }
    .warr-contact-link {
        color: #334155;
        text-decoration: none;
        transition: color 0.15s;
    }
    .warr-contact-link:hover {
        color: #006FC9;
        text-decoration: underline;
    }
    .warr-copy-btn {
        opacity: 0.4;
        cursor: pointer;
        font-size: 11px;
        transition: opacity 0.15s;
        border: none;
        background: none;
        padding: 0 2px;
        color: #64748b;
    }
    .warr-copy-btn:hover {
        opacity: 1;
        color: #006FC9;
    }

    /* Message snippet & expand */
    .warr-message-cell {
        min-width: 260px;
        max-width: 320px;
    }
    .warr-message-snippet {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 12px;
        line-height: 1.45;
        color: #475569;
        background: #f8fafc;
        border: 1px dashed #e2e8f0;
        padding: 6px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .warr-message-snippet:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    /* Status Select Pills */
    .warr-status-select-wrap select {
        font-size: 12px;
        font-weight: 600;
        border-radius: 20px;
        padding: 4px 10px;
        cursor: pointer;
        outline: none;
        box-shadow: none;
        text-transform: capitalize;
        border-width: 1.5px;
        transition: all 0.2s ease;
    }
    .status-new {
        background-color: #eff6ff !important;
        color: #2563eb !important;
        border-color: #bfdbfe !important;
    }
    .status-hold {
        background-color: #fffbeb !important;
        color: #d97706 !important;
        border-color: #fde68a !important;
    }
    .status-executed {
        background-color: #f0fdf4 !important;
        color: #16a34a !important;
        border-color: #bbf7d0 !important;
    }
    .status-dead {
        background-color: #f8fafc !important;
        color: #64748b !important;
        border-color: #cbd5e1 !important;
    }

    /* Comment Box */
    .warr-comment-box {
        min-width: 170px;
        max-width: 220px;
        font-size: 12px;
        color: #475569;
        padding: 6px 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .warr-comment-box:hover {
        border-color: #006FC9;
        background: #f8fafc;
    }
    .warr-comment-input {
        width: 100%;
        min-height: 48px;
        padding: 6px 10px;
        font-size: 12px;
        border: 1px solid #006FC9;
        border-radius: 6px;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 111, 201, 0.15);
    }

    /* Category Pill */
    .warr-category-pill {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        color: #006FC9;
        background: #e0f2fe;
        border: 1px solid #bae6fd;
        padding: 2px 8px;
        border-radius: 12px;
        margin: 1px;
        white-space: nowrap;
    }

    /* URL Pill */
    .warr-url-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11.5px;
        color: #0369a1;
        background: #f0f9ff;
        border: 1px solid #e0f2fe;
        padding: 3px 8px;
        border-radius: 6px;
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .warr-url-pill:hover {
        background: #e0f2fe;
        color: #0284c7;
    }

    /* Action button */
    .warr-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        cursor: pointer;
    }
    .warr-action-btn:hover {
        background: #006FC9;
        color: #ffffff;
        border-color: #006FC9;
        transform: translateY(-1px);
    }
</style>

<div class="crm-page-container pt-3">

    {{-- Top Breadcrumb & Page Title Bar --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <div class="d-flex align-items-center gap-2">
                <h4 class="fw-bold text-dark mb-0 fs-20">Warrgyizmorsch Leads</h4>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill fs-12 fw-semibold">
                    {{ number_format($filteredLeadCount) }} {{ $filteredLeadCount == 1 ? 'Lead' : 'Leads' }}
                </span>
                @if($filtersApplied)
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-0.5 rounded-pill fs-11">
                        Filtered from {{ number_format($totalLeadsCount) }}
                    </span>
                @endif
            </div>
            <nav aria-label="breadcrumb" class="mt-1">
                <ol class="breadcrumb mb-0 fs-12 text-muted">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-muted text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item text-muted">SEO</li>
                    <li class="breadcrumb-item active fw-semibold text-primary" aria-current="page">Warrgyizmorsch Leads</li>
                </ol>
            </nav>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 rounded-3 px-3 shadow-2xs" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#warrLeadFilters" aria-expanded="{{ $filtersApplied ? 'true' : 'false' }}">
                <i class="feather-filter fs-14"></i>
                <span class="fw-semibold fs-13">Filters</span>
                @if($filtersApplied)
                    <span class="badge bg-danger rounded-circle p-1" style="width: 7px; height: 7px;"></span>
                @endif
            </button>
            <a href="{{ route('warr-leads.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1.5 rounded-3 px-3 shadow-2xs text-secondary" title="Refresh list">
                <i class="feather-rotate-cw fs-14"></i>
                <span class="fw-semibold fs-13 d-none d-sm-inline">Refresh</span>
            </a>
        </div>
    </div>

    {{-- 4 Metric Stat Cards --}}
    <div class="row g-3 mb-4">
        {{-- Total Leads --}}
        <div class="col-xl-3 col-sm-6">
            <a href="{{ route('warr-leads.index') }}" class="text-decoration-none">
                <div class="warr-metric-card d-flex align-items-center justify-content-between {{ empty(request('status')) ? 'active-filter' : '' }}">
                    <div>
                        <div class="fs-12 fw-bold text-uppercase tracking-wider text-muted mb-1">Total Inquiries</div>
                        <h3 class="fw-bold text-dark mb-0 fs-24">{{ number_format($totalLeadsCount) }}</h3>
                        <div class="fs-11 text-muted mt-1">All captured leads</div>
                    </div>
                    <div class="metric-icon bg-primary-subtle text-primary border border-primary-subtle">
                        <i class="feather-users"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- New Leads --}}
        <div class="col-xl-3 col-sm-6">
            <a href="{{ request()->fullUrlWithQuery(['status' => 'new']) }}" class="text-decoration-none">
                <div class="warr-metric-card d-flex align-items-center justify-content-between {{ request('status') === 'new' ? 'active-filter' : '' }}">
                    <div>
                        <div class="fs-12 fw-bold text-uppercase tracking-wider text-primary mb-1">New Leads</div>
                        <h3 class="fw-bold text-dark mb-0 fs-24">{{ number_format($newCount ?? 0) }}</h3>
                        <div class="fs-11 text-muted mt-1">Needs immediate follow-up</div>
                    </div>
                    <div class="metric-icon bg-info-subtle text-info border border-info-subtle">
                        <i class="feather-sparkles"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- Executed / Converted --}}
        <div class="col-xl-3 col-sm-6">
            <a href="{{ request()->fullUrlWithQuery(['status' => 'executed']) }}" class="text-decoration-none">
                <div class="warr-metric-card d-flex align-items-center justify-content-between {{ request('status') === 'executed' ? 'active-filter' : '' }}">
                    <div>
                        <div class="fs-12 fw-bold text-uppercase tracking-wider text-success mb-1">Executed / Done</div>
                        <h3 class="fw-bold text-dark mb-0 fs-24">{{ number_format($executedCount ?? 0) }}</h3>
                        <div class="fs-11 text-muted mt-1">Converted & completed</div>
                    </div>
                    <div class="metric-icon bg-success-subtle text-success border border-success-subtle">
                        <i class="feather-check-circle"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- Hold & Dead --}}
        <div class="col-xl-3 col-sm-6">
            <a href="{{ request()->fullUrlWithQuery(['status' => 'hold']) }}" class="text-decoration-none">
                <div class="warr-metric-card d-flex align-items-center justify-content-between {{ request('status') === 'hold' ? 'active-filter' : '' }}">
                    <div>
                        <div class="fs-12 fw-bold text-uppercase tracking-wider text-warning mb-1">On Hold / Follow-up</div>
                        <h3 class="fw-bold text-dark mb-0 fs-24">{{ number_format($holdTotalCount ?? (($holdCount ?? 0) + ($deadCount ?? 0))) }}</h3>
                        <div class="fs-11 text-muted mt-1">Dead: {{ number_format($deadCount ?? 0) }} • Hold: {{ number_format($holdCount ?? 0) }}</div>
                    </div>
                    <div class="metric-icon bg-warning-subtle text-warning border border-warning-subtle">
                        <i class="feather-clock"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Collapsible Filter Panel --}}
    <div id="warrLeadFilters" class="collapse {{ $filtersApplied ? 'show' : '' }} mb-4">
        <div class="warr-filter-card">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <h6 class="fs-13 fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="feather-sliders text-primary"></i> Filter & Search Inquiries
                </h6>
                @if($filtersApplied)
                    <a href="{{ route('warr-leads.index') }}" class="fs-12 text-danger text-decoration-none fw-semibold">
                        <i class="feather-x-circle me-1"></i>Clear all filters
                    </a>
                @endif
            </div>

            <form method="GET" action="{{ route('warr-leads.index') }}" class="row g-3">
                {{-- Search --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-1">Search Keywords</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="feather-search fs-12"></i></span>
                        <input type="text" name="search" class="form-control form-control-sm border-start-0" 
                               placeholder="Name, email, phone, company..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Status --}}
                <div class="col-lg-2 col-md-6">
                    <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-1">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        @foreach(($statuses ?? []) as $st)
                            <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Page URL --}}
                <div class="col-lg-3 col-md-6">
                    <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-1">Landing Page URL</label>
                    <select name="page_url" class="form-select form-select-sm">
                        <option value="">All Landing Pages</option>
                        @foreach(($page_url ?? []) as $pUrl)
                            @php
                                $shortUrl = str_replace(['https://', 'http://', 'www.'], '', $pUrl);
                            @endphp
                            <option value="{{ $pUrl }}" {{ request('page_url') == $pUrl ? 'selected' : '' }} title="{{ $pUrl }}">
                                {{ \Illuminate\Support\Str::limit($shortUrl, 38) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date Range From --}}
                <div class="col-lg-2 col-md-3 col-6">
                    <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-1">From Date</label>
                    <input type="date" name="from" class="form-control form-control-sm" value="{{ request('from') }}">
                </div>

                {{-- Date Range To --}}
                <div class="col-lg-2 col-md-3 col-6">
                    <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-1">To Date</label>
                    <input type="date" name="to" class="form-control form-control-sm" value="{{ request('to') }}">
                </div>

                {{-- Action Buttons --}}
                <div class="col-12 d-flex align-items-center justify-content-end gap-2 pt-2 border-top">
                    <a href="{{ route('warr-leads.index') }}" class="btn btn-sm btn-light border px-3 fw-semibold">
                        Reset
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary px-4 fw-semibold shadow-2xs">
                        <i class="feather-filter me-1"></i> Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Main Leads Table Card --}}
    <div class="warr-table-card">
        <div class="card-header-bar">
            <div class="d-flex align-items-center gap-2">
                <i class="feather-list text-primary fs-16"></i>
                <h5 class="fw-bold text-dark mb-0 fs-15">All Captured Website Leads</h5>
                <span class="badge bg-light text-secondary border px-2 py-0.5 rounded-pill fs-11">
                    Showing {{ $leads->firstItem() ?? 0 }}-{{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }}
                </span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="fs-12 text-muted d-none d-md-inline">Double click any comment to edit inline</span>
            </div>
        </div>

        <div class="warr-table-wrapper">
            <table class="table" id="warrLeadList">
                <thead>
                    <tr>
                        <th style="width: 45px; text-align: center;">#</th>
                        <th style="min-width: 200px;">Contact / Lead</th>
                        <th style="min-width: 220px;">Contact Info</th>
                        <th style="min-width: 140px;">Services</th>
                        <th style="min-width: 280px;">Message Preview</th>
                        <th style="min-width: 130px; text-align: center;">Status</th>
                        <th style="min-width: 180px;">Notes / Remarks</th>
                        <th style="min-width: 130px;">Source / URL</th>
                        <th style="min-width: 110px; text-align: center;">Date</th>
                        <th style="width: 60px; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        @php
                            $rowNum = $loop->iteration + ($leads->currentPage() - 1) * $leads->perPage();
                            $name = trim($lead->name ?? '');
                            $initials = '';
                            if (!empty($name)) {
                                $words = explode(' ', $name);
                                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                            }
                            if (empty($initials)) $initials = '#';
                            $curStatus = strtolower(trim($lead->status ?? 'new'));
                            if (!in_array($curStatus, ['new', 'hold', 'executed', 'dead'])) $curStatus = 'new';
                        @endphp
                        <tr id="warr-lead-row-{{ $lead->id }}">
                            {{-- Row # --}}
                            <td class="text-center text-muted fw-bold fs-12">
                                {{ $rowNum }}
                            </td>

                            {{-- Contact / Name & Company --}}
                            <td>
                                <div class="d-flex align-items-center gap-2.5">
                                    <div class="warr-avatar-badge flex-shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="warr-lead-title text-truncate" title="{{ $lead->name ?? 'N/A' }}">
                                            {{ !empty($lead->name) ? $lead->name : 'N/A' }}
                                        </div>
                                        <div class="warr-lead-sub text-truncate" title="{{ $lead->company_name ?? 'Individual' }}">
                                            <i class="feather-briefcase fs-11 me-0.5 text-muted"></i>
                                            {{ !empty($lead->company_name) ? $lead->company_name : 'No Company' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Contact Details (Email & Phone) --}}
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    {{-- Email --}}
                                    @if(!empty($lead->email))
                                        <div class="warr-contact-item">
                                            <i class="feather-mail fs-12 text-muted flex-shrink-0"></i>
                                            <a href="mailto:{{ $lead->email }}" class="warr-contact-link text-truncate" title="{{ $lead->email }}">
                                                {{ $lead->email }}
                                            </a>
                                            <button type="button" class="warr-copy-btn" onclick="copyText('{{ $lead->email }}')" title="Copy email">
                                                <i class="feather-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted fs-12">-</span>
                                    @endif

                                    {{-- Mobile --}}
                                    @if(!empty($lead->mobile_no))
                                        <div class="warr-contact-item">
                                            <i class="feather-phone fs-12 text-muted flex-shrink-0"></i>
                                            <a href="tel:{{ $lead->mobile_no }}" class="warr-contact-link text-truncate" title="{{ $lead->mobile_no }}">
                                                {{ $lead->mobile_no }}
                                            </a>
                                            <button type="button" class="warr-copy-btn" onclick="copyText('{{ $lead->mobile_no }}')" title="Copy phone">
                                                <i class="feather-copy"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- Services --}}
                            <td>
                                @if(!empty($lead->service_categories))
                                    @php
                                        $cats = preg_split('/[,;|]+/', $lead->service_categories);
                                    @endphp
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($cats as $cat)
                                            @if(trim($cat) !== '')
                                                <span class="warr-category-pill">{{ trim($cat) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted fs-12">-</span>
                                @endif
                            </td>

                            {{-- User Message --}}
                            <td class="warr-message-cell">
                                @if(!empty($lead->message))
                                    <div class="warr-message-snippet" 
                                         onclick="openMessageModal('{{ addslashes($lead->name ?? 'Lead') }}', '{{ addslashes(str_replace(["\r", "\n"], ' ', $lead->message)) }}')"
                                         title="Click to view full message">
                                        <i class="feather-message-square me-1 text-primary opacity-75"></i>
                                        {{ $lead->message }}
                                    </div>
                                @else
                                    <span class="text-muted fs-12">-</span>
                                @endif
                            </td>

                            {{-- Status Dropdown --}}
                            <td class="text-center">
                                <div class="warr-status-select-wrap d-inline-block">
                                    <form action="{{ route('warr-leads.updateWarrLead', $lead->id) }}" method="POST" class="warr-status-form m-0">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm warr-status-select status-{{ $curStatus }}">
                                            <option value="new" {{ $curStatus === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="hold" {{ $curStatus === 'hold' ? 'selected' : '' }}>Hold</option>
                                            <option value="executed" {{ $curStatus === 'executed' ? 'selected' : '' }}>Executed</option>
                                            <option value="dead" {{ $curStatus === 'dead' ? 'selected' : '' }}>Dead</option>
                                        </select>
                                    </form>
                                </div>
                            </td>

                            {{-- Comment / Notes --}}
                            <td>
                                <div class="warr-comment-box warr-comment-cell" 
                                     data-id="{{ $lead->id }}" 
                                     data-url="{{ route('warr-leads.updateWarrLead', $lead->id) }}" 
                                     title="Double click or click pencil to edit">
                                    <span class="warr-comment-text text-truncate">
                                        {{ !empty($lead->comment) ? $lead->comment : 'Add note...' }}
                                    </span>
                                    <i class="feather-edit-2 fs-11 text-muted opacity-75 flex-shrink-0"></i>
                                </div>
                            </td>

                            {{-- Source & Page URL --}}
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    @if(!empty($lead->source))
                                        <div>
                                            <span class="badge bg-light text-dark border px-2 py-0.5 rounded-pill fs-11">
                                                <i class="feather-tag me-1 text-primary"></i>{{ $lead->source }}
                                            </span>
                                        </div>
                                    @endif

                                    @if(!empty($lead->page_url))
                                        @php
                                            $cleanUrl = strtok(trim($lead->page_url), '?');
                                            $displaySlug = parse_url($cleanUrl, PHP_URL_PATH) ?? $cleanUrl;
                                        @endphp
                                        <div>
                                            <a href="{{ $cleanUrl }}" target="_blank" class="warr-url-pill" title="{{ $cleanUrl }}">
                                                <i class="feather-link-2 flex-shrink-0"></i>
                                                <span class="text-truncate">{{ $displaySlug ?: 'Landing Page' }}</span>
                                                <i class="feather-external-link fs-10 flex-shrink-0"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            {{-- Date --}}
                            <td class="text-center text-nowrap">
                                <div class="fs-12 fw-semibold text-dark">
                                    {{ $lead->created_at ? $lead->created_at->format('d M Y') : 'N/A' }}
                                </div>
                                <div class="fs-11 text-muted">
                                    {{ $lead->created_at ? $lead->created_at->format('h:i A') : '' }}
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <button type="button" class="warr-action-btn" 
                                        onclick="openDetailModal({{ json_encode($lead) }})" 
                                        title="View Full Lead Details">
                                    <i class="feather-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center text-muted">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="feather-inbox fs-24 text-muted"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">No Leads Found</h6>
                                    <p class="fs-13 text-muted mb-3">Try adjusting your filters or search keywords.</p>
                                    @if($filtersApplied)
                                        <a href="{{ route('warr-leads.index') }}" class="btn btn-sm btn-primary px-3 rounded-pill">
                                            Clear Filters
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if($leads->hasPages())
            <div class="p-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2 bg-light bg-opacity-25">
                <div class="fs-12 text-muted">
                    Showing {{ $leads->firstItem() }} to {{ $leads->lastItem() }} of {{ $leads->total() }} entries
                </div>
                <div>
                    {{ $leads->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Message Peek Modal --}}
<div class="modal fade" id="warrMessageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom py-3 px-4 bg-light bg-opacity-50">
                <div class="d-flex align-items-center gap-2">
                    <i class="feather-message-square text-primary fs-18"></i>
                    <h6 class="modal-title fw-bold text-dark mb-0 fs-15" id="warrMsgLeadName">Inquiry Message</h6>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <label class="form-label fs-11 fw-bold text-muted text-uppercase mb-2">Full Message from Website Visitor:</label>
                <div class="p-3 rounded-3 bg-light border fs-13 text-dark lh-base" id="warrMsgContent" style="white-space: pre-wrap; word-break: break-word;">
                </div>
            </div>
            <div class="modal-footer border-top py-2.5 px-4 bg-light bg-opacity-25">
                <button type="button" class="btn btn-sm btn-secondary px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Full Lead Detail Modal --}}
<div class="modal fade" id="warrDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-bottom py-3 px-4 bg-light bg-opacity-50">
                <div class="d-flex align-items-center gap-2.5">
                    <div class="warr-avatar-badge" id="dm_avatar">WL</div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0 fs-15" id="dm_name">Lead Details</h6>
                        <span class="fs-11 text-muted" id="dm_sub">Company & Contact Info</span>
                    </div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block"><i class="feather-mail me-1 text-primary"></i>Email Address</span>
                            <span class="fw-semibold text-dark fs-13" id="dm_email">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block"><i class="feather-phone me-1 text-primary"></i>Mobile Phone</span>
                            <span class="fw-semibold text-dark fs-13" id="dm_phone">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block"><i class="feather-briefcase me-1 text-primary"></i>Company Name</span>
                            <span class="fw-semibold text-dark fs-13" id="dm_company">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block"><i class="feather-tag me-1 text-primary"></i>Service Categories</span>
                            <span class="fw-semibold text-dark fs-13" id="dm_categories">-</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-1"><i class="feather-message-circle me-1 text-primary"></i>Submitted Inquiry Message</span>
                            <div class="fw-medium text-dark fs-13 lh-base p-2 bg-white rounded border" id="dm_message" style="white-space: pre-wrap;">-</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-2.5 rounded-3 border bg-light">
                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-1"><i class="feather-link me-1 text-primary"></i>Landing Page URL</span>
                            <a href="#" target="_blank" class="fw-semibold text-primary fs-12 text-break text-decoration-none" id="dm_url">-</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top py-2.5 px-4 bg-light bg-opacity-25">
                <button type="button" class="btn btn-sm btn-secondary px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 2500
    };

    function copyText(val) {
        if (!val) return;
        navigator.clipboard.writeText(val).then(() => {
            toastr.info("Copied: " + val);
        }).catch(() => {
            toastr.error("Could not copy text.");
        });
    }

    function openMessageModal(name, msg) {
        document.getElementById('warrMsgLeadName').textContent = name + " - Inquiry Message";
        document.getElementById('warrMsgContent').textContent = msg || 'No message provided.';
        const modal = new bootstrap.Modal(document.getElementById('warrMessageModal'));
        modal.show();
    }

    function openDetailModal(lead) {
        if (!lead) return;
        const name = lead.name || 'N/A';
        document.getElementById('dm_name').textContent = name;
        document.getElementById('dm_sub').textContent = (lead.company_name || 'Individual') + " • " + (lead.created_at ? new Date(lead.created_at).toLocaleDateString() : '');
        document.getElementById('dm_avatar').textContent = name !== 'N/A' ? name.substring(0, 2).toUpperCase() : '#';
        document.getElementById('dm_email').textContent = lead.email || '-';
        document.getElementById('dm_phone').textContent = lead.mobile_no || '-';
        document.getElementById('dm_company').textContent = lead.company_name || '-';
        document.getElementById('dm_categories').textContent = lead.service_categories || '-';
        document.getElementById('dm_message').textContent = lead.message || 'No message entered.';
        
        const urlEl = document.getElementById('dm_url');
        if (lead.page_url) {
            urlEl.href = lead.page_url;
            urlEl.textContent = lead.page_url;
        } else {
            urlEl.href = '#';
            urlEl.textContent = 'None';
        }

        const modal = new bootstrap.Modal(document.getElementById('warrDetailModal'));
        modal.show();
    }

    $(document).ready(function () {
        // Dynamic status select styling and AJAX update
        $(document).on("change", ".warr-status-select", function () {
            const select = $(this);
            const val = select.val();
            
            // Remove previous status classes and add new one
            select.removeClass('status-new status-hold status-executed status-dead')
                  .addClass('status-' + val);

            const form = select.closest("form");
            const url = form.attr("action");
            const data = form.serialize();

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: function (res) {
                    toastr.success(res.message || "Lead status updated!");
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON?.message || "Failed to update status.");
                }
            });
        });

        // Double click or click to edit note/comment inline
        $(document).on("click", ".warr-comment-cell", function (e) {
            const box = $(this);
            if (box.find("textarea").length) return;

            const textSpan = box.find(".warr-comment-text");
            const currentText = textSpan.text().trim();
            const url = box.data("url");

            const input = $(`<textarea class="warr-comment-input" rows="2" placeholder="Write comment..."></textarea>`);
            input.val(currentText === "Add note..." || currentText === "-" ? "" : currentText);

            box.data("old", input.val());
            box.html(input);
            input.trigger("focus");

            input.on("keydown", function (e) {
                if (e.key === "Enter" && !e.shiftKey) {
                    e.preventDefault();
                    saveComment(box, url, input.val());
                }
                if (e.key === "Escape") {
                    const old = (box.data("old") || "").trim();
                    renderCommentBox(box, old);
                }
            });

            input.on("blur", function () {
                saveComment(box, url, input.val());
            });
        });

        function renderCommentBox(box, text) {
            const display = text ? text : "Add note...";
            box.html(`
                <span class="warr-comment-text text-truncate">${display}</span>
                <i class="feather-edit-2 fs-11 text-muted opacity-75 flex-shrink-0"></i>
            `);
        }

        function saveComment(box, url, newValue) {
            const oldValue = (box.data("old") || "").trim();
            const nextValue = (newValue || "").trim();

            if (nextValue === oldValue) {
                renderCommentBox(box, nextValue);
                return;
            }

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    comment: nextValue
                },
                success: function (res) {
                    toastr.success("Note saved successfully!");
                    renderCommentBox(box, nextValue);
                },
                error: function (xhr) {
                    toastr.error("Failed to save note.");
                    renderCommentBox(box, oldValue);
                }
            });
        }
    });
</script>

@endsection
