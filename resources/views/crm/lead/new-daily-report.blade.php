@extends('layouts.app')

@section('content')

    <style>
        .table-responsive {
            overflow-x: auto;
            max-height: 70vh;
            /* adjust height if needed */
        }

        #leadList thead th {
            position: sticky;
            top: 0;
            background: #ffffff;
            /* important so it doesn't turn transparent */
            z-index: 10;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05);
        }

        .highlight-column {
            background-color: #fafafaf5 !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Make content take full height so footer stays at bottom */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .card[data-bs-toggle="modal"] {
            transition: all 0.3s ease;
        }

        .card[data-bs-toggle="modal"]:not([style*="opacity"]):hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .card[data-bs-toggle="modal"][style*="opacity"] {
            pointer-events: none;
        }

        .card-body {
            padding: 5px !important;
        }
    </style>

    <div class="main-wrapper">

        {{-- ===================== HEADER AREA ===================== --}}
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Daily Lead Report</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Daily Report</li>
                </ul>


            </div>

            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i> <span>Back</span>
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">

                        {{-- Chart Toggle --}}
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseDailyReportFilter">
                            <i class="feather-bar-chart"></i>Filter
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Filters --}}
        {{-- Collapsible Lead Stats --}}
        <div id="collapseDailyReportFilter" class="accordion-collapse show page-header-collapse">
            <div class="accordion-body pb-2">
                <form method="GET" action="{{ route('lead.newdailyReport') }}" class="row g-3 mb-4" id="date-filter-form">

                    <!-- Quick Presets -->
                    <div class="col-12 mb-3">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="today">Today</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="yesterday">Yesterday</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="7days">Last 7 Days</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="30days">Last 30 Days</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="this-month">This Month</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn"
                                data-preset="last-month">Last Month</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm preset-btn active"
                                data-preset="custom">Custom</button>
                        </div>
                    </div>

                    <!-- Date From -->
                    <div class="col-md-3">
                        <label class="form-label">Start</label>
                        <input type="date" name="from" id="start-date" class="form-control" value="{{ request('from') }}">
                    </div>

                    <!-- Date To -->
                    <div class="col-md-3">
                        <label class="form-label">End</label>
                        <input type="date" name="to" id="end-date" class="form-control" value="{{ request('to') }}">
                    </div>

                    <!-- Lead Engagement Status Filter -->
                    <!-- <div class="col-md-3">
                                    <label class="form-label">Lead Engagement Status</label>
                                    <select name="engagement_filter" class="form-control">
                                        <option value="">All</option>
                                        <option value="hot" {{ request('engagement_filter') == 'hot' ? 'selected' : '' }}>Hot</option>
                                        <option value="warm" {{ request('engagement_filter') == 'warm' ? 'selected' : '' }}>Warm</option>
                                        <option value="cold" {{ request('engagement_filter') == 'cold' ? 'selected' : '' }}>Cold</option>
                                    </select>
                                </div> -->

                    <!-- Buttons -->
                    <div class="col-12 d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('lead.newdailyReport') }}" class="btn btn-outline-danger px-4">Reset</a>
                    </div>

                </form>
            </div>
        </div>


        {{-- ===================== MAIN CONTENT ===================== --}}
        <div class="main-content mt-3">
            <div class="row">
                @foreach($final as $userId => $row)

                    {{-- USER CARD --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm border-0">

                            {{-- User Header --}}
                            <div class="card-header fw-bold d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" data-bs-target="#user-{{ $userId }}" style="cursor:pointer;">

                                <strong class="fw-bold text-dark">{{ $row['name'] }}</strong>
                                <span class="badge bg-light text-dark">
                                    Total: {{ $row['total'] }}
                                </span>
                            </div>

                            {{-- USER DETAILS --}}
                            <div id="user-{{ $userId }}" class="collapse">
                                <div class="card-body">

                                    <div class="row">
                                        @foreach($statusColumns as $bucket)

                                            {{-- BUCKET CARD --}}
                                            <div class="col-md-6 mb-3">
                                                <div class="border rounded p-2">

                                                    {{-- Bucket Header --}}
                                                    <div class="d-flex justify-content-between align-items-center"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#bucket-{{ $userId }}-{{ Str::slug($bucket) }}"
                                                        style="cursor:pointer;">

                                                        <span class="fw-semibold">{{ $bucket }}</span>

                                                        <span class="badge 
                                                                    @if($bucket == 'Converted') bg-success
                                                                    @elseif($bucket == 'Lost') bg-danger
                                                                    @else bg-primary
                                                                    @endif
                                                                ">
                                                            {{ $row['statuses'][$bucket]['count'] }}
                                                        </span>
                                                    </div>

                                                    {{-- SUB STATUS --}}
                                                    <div id="bucket-{{ $userId }}-{{ Str::slug($bucket) }}" class="collapse mt-2">

                                                        <div class="row">
                                                            @foreach($row['statuses'][$bucket]['sub_status'] as $status => $count)

                                                                <div class="col-md-6 mb-2">
                                                                    <div class="p-2 text-center bg-white rounded shadow-sm border">

                                                                        <div class="text-muted small mb-1">
                                                                            {{ $status }}
                                                                        </div>

                                                                        <div class="fw-bold text-dark">
                                                                            {{ $count }}
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                    {{-- FOLLOWUP BOXES --}}
                                    <div class="mt-3">
                                        <div class="row">

                                            {{-- Call --}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div
                                                    class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                    <div style="padding-bottom: 10px;"
                                                        class="card-body d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-danger text-danger border-soft-danger rounded">
                                                            <i class="bi bi-telephone-x fs-2 text-danger"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Call</p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ $row['followups']['Call'] ?? 0 }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding: 0 5px;">
                                                        <small class="text-muted">
                                                            Connected: {{ $row['call_stats']['Call']['Connected'] ?? 0 }}
                                                        </small>
                                                        <small class="text-muted">
                                                            Lost: {{ $row['call_stats']['Call']['Not Connected'] ?? 0 }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- WhatsApp Call--}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div
                                                    class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                    <div style="padding-bottom: 10px;"
                                                        class="card-body d-flex align-items-center justify-content-between ">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-success text-success border-soft-danger rounded">
                                                            <i class="bi bi-telephone-fill fs-6 text-success"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">WhatsApp
                                                                Call</p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ $row['followups']['WhatsApp Call'] ?? 0 }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding: 0 5px;">

                                                        <small class="text-muted">
                                                            Connected:
                                                            {{ $row['call_stats']['WhatsApp Call']['Connected'] ?? 0 }}
                                                        </small>
                                                        <small class="text-muted">
                                                            Lost:
                                                            {{ $row['call_stats']['WhatsApp Call']['Not Connected'] ?? 0 }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Whatsapp --}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div
                                                    class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                    <div style="padding-bottom: 10px;"
                                                        class="card-body d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-success text-success border-soft-success rounded">
                                                            <i class="bi bi-whatsapp fs-2 text-success"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Whatsapp
                                                            </p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ $row['followups']['Whatsapp'] ?? 0 }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding: 0 5px;">
                                                        <small class="text-muted">
                                                            Discussion Start:
                                                            {{ $row['whatsapp_stats']['Discussion Start'] ?? 0 }}
                                                        </small>
                                                        <small class="text-muted">
                                                            No Response: {{ $row['whatsapp_stats']['No Response'] ?? 0 }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- LEAD ENGAGEMENT STATUS --}}
                                    <div class="mt-2">
                                        <h6 class="mb-3 fw-semibold text-dark">Status Transitions & Hot Leads</h6>
                                        <div class="row">
                                            {{-- Hot Leads --}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div class="card border border-dashed border-danger hover-shadow transition-all"
                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#hotLeadsModal-{{ $userId }}" @if(!(count($row['hot_leads'] ?? []) ?? 0)) style="opacity: 0.5; cursor: default;" @endif>
                                                    <div class="card-body d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-danger text-danger border-soft-danger rounded">
                                                            <i class="bi bi-fire fs-2 text-danger"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Hot Leads
                                                            </p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ count($row['hot_leads'] ?? []) }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Warm to Hot Leads --}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div class="card border border-dashed border-success hover-shadow transition-all"
                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#warmToHotModal-{{ $userId }}"
                                                    @if(!(count($row['warm_to_hot']) ?? 0))
                                                    style="opacity: 0.5; cursor: default;" @endif>
                                                    <div class="card-body d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-success text-success border-soft-success rounded">
                                                            <i class="bi bi-arrow-up-circle fs-2 text-success"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Warm → Hot
                                                            </p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ count($row['warm_to_hot']) ?? 0 }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Hot to Warm Leads --}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                <div class="card border border-dashed border-warning hover-shadow transition-all"
                                                    style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#hotToWarmModal-{{ $userId }}"
                                                    @if(!(count($row['hot_to_warm']) ?? 0))
                                                    style="opacity: 0.5; cursor: default;" @endif>
                                                    <div class="card-body d-flex align-items-center justify-content-between">
                                                        <div
                                                            class="avatar-text avatar-lg bg-soft-warning text-warning border-soft-warning rounded">
                                                            <i class="bi bi-arrow-down-circle fs-2 text-warning"></i>
                                                        </div>
                                                        <div class="text-end">
                                                            <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Hot → Warm
                                                            </p>
                                                            <h3 class="tx-20 tx-semibold tx-left">
                                                                {{ count($row['hot_to_warm']) ?? 0 }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Engagement Status Summary --}}
                                            <div class="col-12 mt-3">
                                                <h6 class="mb-2 fw-semibold text-dark">Lead Engagement Status Summary</h6>
                                                <div class="row">
                                                    {{-- Warm Leads --}}
                                                    <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                        <div
                                                            class="card border border-dashed border-warning hover-shadow transition-all">
                                                            <div
                                                                class="card-body d-flex align-items-center justify-content-between">
                                                                <div
                                                                    class="avatar-text avatar-lg bg-soft-warning text-warning border-soft-warning rounded">
                                                                    <i class="bi bi-thermometer-half fs-2 text-warning"></i>
                                                                </div>
                                                                <div class="text-end">
                                                                    <p class="fs-9 fw-medium text-uppercase text-muted mb-1">
                                                                        Warm Leads</p>
                                                                    <h3 class="tx-20 tx-semibold tx-left">
                                                                        {{ $row['engagement']['warm'] ?? 0 }}
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Cold Leads --}}
                                                    <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                                        <div
                                                            class="card border border-dashed border-info hover-shadow transition-all">
                                                            <div
                                                                class="card-body d-flex align-items-center justify-content-between">
                                                                <div
                                                                    class="avatar-text avatar-lg bg-soft-info text-info border-soft-info rounded">
                                                                    <i class="bi bi-snow fs-2 text-info"></i>
                                                                </div>
                                                                <div class="text-end">
                                                                    <p class="fs-9 fw-medium text-uppercase text-muted mb-1">
                                                                        Cold Leads</p>
                                                                    <h3 class="tx-20 tx-semibold tx-left">
                                                                        {{ $row['engagement']['cold'] ?? 0 }}
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach

                {{-- HOT LEADS MODAL --}}
                @foreach($final as $userId => $row)
                    <div class="modal fade" id="hotLeadsModal-{{ $userId }}" tabindex="-1"
                        aria-labelledby="hotLeadsModalLabel-{{ $userId }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="hotLeadsModalLabel-{{ $userId }}">
                                        <i class="bi bi-fire me-2"></i>Hot Leads - {{ $row['name'] }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    @if(count($row['hot_leads']) > 0)
                                        <div class="lead-list">
                                            @foreach($row['hot_leads'] as $index => $hotLead)
                                                <div class="card mb-3 border shadow-sm">
                                                    {{-- Lead Header Card --}}
                                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-danger fs-6">{{ $index + 1 }}</span>
                                                            <h6 class="mb-0 fw-bold">Lead #{{ $hotLead['id'] }}</h6>
                                                        </div>
                                                        @if($hotLead['verified_lead'])
                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>Verified
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Lead Details --}}
                                                    <div class="card-body">
                                                        {{-- Name Section --}}
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Lead Name</label>
                                                            <p class="form-control-plaintext fw-bold text-primary">
                                                                {{ $hotLead['lead_name'] }}
                                                            </p>
                                                        </div>

                                                        {{-- Contact Information --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Email</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-envelope text-primary me-2"></i>
                                                                    {{ $hotLead['email'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Contact</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-telephone text-success me-2"></i>
                                                                    {{ $hotLead['contact_no'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Education Details --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Applying Country</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-geo-alt text-danger me-2"></i>
                                                                    {{ $hotLead['country'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Course</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-book text-info me-2"></i>
                                                                    {{ $hotLead['course'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Campaign & Platform Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Campaign</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-megaphone text-warning me-2"></i>
                                                                    {{ $hotLead['campaign_name'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Location & Date Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Lead Date</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-calendar-event text-muted me-2"></i>
                                                                    @if($hotLead['date'] != 'N/A')
                                                                        {{ \Carbon\Carbon::parse($hotLead['date'])->format('M d, Y') }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            <i class="bi bi-info-circle me-2"></i>No hot leads found for this period.
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- WARM TO HOT & HOT TO WARM MODALS --}}
                @foreach($final as $userId => $row)
                    {{-- WARM TO HOT MODAL --}}
                    <div class="modal fade" id="warmToHotModal-{{ $userId }}" tabindex="-1"
                        aria-labelledby="warmToHotModalLabel-{{ $userId }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="warmToHotModalLabel-{{ $userId }}">
                                        <i class="bi bi-arrow-up-circle me-2"></i>Warm → Hot Leads - {{ $row['name'] }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    @if(count($row['warm_to_hot']) > 0)
                                        <div class="lead-list">
                                            @foreach($row['warm_to_hot'] as $index => $lead)
                                                <div class="card mb-3 border shadow-sm">
                                                    {{-- Lead Header Card --}}
                                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-success fs-6">{{ $index + 1 }}</span>
                                                            <h6 class="mb-0 fw-bold">Lead #{{ $lead['id'] }}</h6>
                                                        </div>
                                                        @if($lead['verified_lead'])
                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>Verified
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Lead Details --}}
                                                    <div class="card-body">
                                                        {{-- Name Section --}}
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Lead Name</label>
                                                            <p class="form-control-plaintext fw-bold text-primary">
                                                                {{ $lead['lead_name'] }}
                                                            </p>
                                                        </div>

                                                        {{-- Contact Information --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Email</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-envelope text-primary me-2"></i>
                                                                    {{ $lead['email'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Contact</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-telephone text-success me-2"></i>
                                                                    {{ $lead['contact_no'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Education Details --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Applying Country</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-geo-alt text-danger me-2"></i>
                                                                    {{ $lead['country'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Course</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-book text-info me-2"></i>
                                                                    {{ $lead['course'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Campaign & Platform Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Campaign</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-megaphone text-warning me-2"></i>
                                                                    {{ $lead['campaign_name'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Status Transition Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Lead Date</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-calendar-event text-muted me-2"></i>
                                                                    @if($lead['date'] != 'N/A')
                                                                        {{ \Carbon\Carbon::parse($lead['date'])->format('M d, Y') }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="alert alert-success" role="alert">
                                                            <i class="bi bi-arrow-up-circle me-2"></i>
                                                            <strong>Status:</strong> Warm → Hot
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            <i class="bi bi-info-circle me-2"></i>No warm to hot transitions found for this period.
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HOT TO WARM MODAL --}}
                    <div class="modal fade" id="hotToWarmModal-{{ $userId }}" tabindex="-1"
                        aria-labelledby="hotToWarmModalLabel-{{ $userId }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title" id="hotToWarmModalLabel-{{ $userId }}">
                                        <i class="bi bi-arrow-down-circle me-2"></i>Hot → Warm Leads - {{ $row['name'] }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    @if(count($row['hot_to_warm']) > 0)
                                        <div class="lead-list">
                                            @foreach($row['hot_to_warm'] as $index => $lead)
                                                <div class="card mb-3 border shadow-sm">
                                                    {{-- Lead Header Card --}}
                                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-warning fs-6">{{ $index + 1 }}</span>
                                                            <h6 class="mb-0 fw-bold">Lead #{{ $lead['id'] }}</h6>
                                                        </div>
                                                        @if($lead['verified_lead'])
                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>Verified
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Lead Details --}}
                                                    <div class="card-body">
                                                        {{-- Name Section --}}
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-dark">Lead Name</label>
                                                            <p class="form-control-plaintext fw-bold text-primary">
                                                                {{ $lead['lead_name'] }}
                                                            </p>
                                                        </div>

                                                        {{-- Contact Information --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Email</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-envelope text-primary me-2"></i>
                                                                    {{ $lead['email'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Contact</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-telephone text-success me-2"></i>
                                                                    {{ $lead['contact_no'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Education Details --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Applying Country</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-geo-alt text-danger me-2"></i>
                                                                    {{ $lead['country'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label fw-semibold text-dark">Course</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-book text-info me-2"></i>
                                                                    {{ $lead['course'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Campaign & Platform Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Campaign</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-megaphone text-warning me-2"></i>
                                                                    {{ $lead['campaign_name'] }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Status Transition Info --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label fw-semibold text-dark">Lead Date</label>
                                                                <p class="form-control-plaintext">
                                                                    <i class="bi bi-calendar-event text-muted me-2"></i>
                                                                    @if($lead['date'] != 'N/A')
                                                                        {{ \Carbon\Carbon::parse($lead['date'])->format('M d, Y') }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="alert alert-warning" role="alert">
                                                            <i class="bi bi-arrow-down-circle me-2"></i>
                                                            <strong>Status:</strong> Hot → Warm
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            <i class="bi bi-info-circle me-2"></i>No hot to warm transitions found for this period.
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const presetButtons = document.querySelectorAll('.preset-btn');
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');
            const form = document.getElementById('date-filter-form');

            function getDateRange(preset) {
                const today = new Date();
                let start, end;

                switch (preset) {
                    case 'today':
                        start = new Date(today);
                        end = new Date(today);
                        break;
                    case 'yesterday':
                        start = new Date(today);
                        start.setDate(start.getDate() - 1);
                        end = new Date(start);
                        break;
                    case '7days':
                        start = new Date(today);
                        start.setDate(start.getDate() - 7);
                        end = new Date(today);
                        break;
                    case '30days':
                        start = new Date(today);
                        start.setDate(start.getDate() - 30);
                        end = new Date(today);
                        break;
                    case 'this-month':
                        start = new Date(today.getFullYear(), today.getMonth(), 1);
                        end = new Date(today);
                        break;
                    case 'last-month':
                        start = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                        end = new Date(today.getFullYear(), today.getMonth(), 0);
                        break;
                    default:
                        return null;
                }

                return {
                    start: start.toISOString().split('T')[0],
                    end: end.toISOString().split('T')[0]
                };
            }

            presetButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const preset = this.dataset.preset;

                    // Update active button
                    presetButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    if (preset === 'custom') {
                        startDateInput.focus();
                    } else {
                        const range = getDateRange(preset);
                        if (range) {
                            startDateInput.value = range.start;
                            endDateInput.value = range.end;
                            form.submit();
                        }
                    }
                });
            });

            // Set active button based on current filter
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;

            if (startDate || endDate) {
                // Check if it matches any preset, otherwise mark custom as active
                let isPreset = false;
                presetButtons.forEach(btn => {
                    if (btn.dataset.preset !== 'custom') {
                        const range = getDateRange(btn.dataset.preset);
                        if (range && range.start === startDate && range.end === endDate) {
                            btn.classList.add('active');
                            isPreset = true;
                        } else {
                            btn.classList.remove('active');
                        }
                    }
                });

                if (!isPreset) {
                    document.querySelector('[data-preset="custom"]').classList.add('active');
                }
            }
        });
    </script>

@endsection