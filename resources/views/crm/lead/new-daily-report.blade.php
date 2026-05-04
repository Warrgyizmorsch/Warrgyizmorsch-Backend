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
        <div id="collapseDailyReportFilter" class="accordion-collapse collapse page-header-collapse {{ request('search') || request('from') || request('to') || request('source') || request('status') || request('lead_owner') || request('country') || request('course') || request('campaign_name') || request('adset_name') || request('ad_name') ? 'show' : '' }}">
            <div class="accordion-body pb-2">
                <form method="GET" action="{{ route('lead.newdailyReport') }}" class="row g-3 mb-4">

                    <div class="col-md-3">
                        <label class="form-label">From Date</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">To Date</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="feather-filter me-1"></i> Filter
                        </button>

                        <a href="{{ route('lead.newdailyReport') }}" class="btn btn-danger">
                            Reset
                        </a>
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
                            data-bs-toggle="collapse" data-bs-target="#user-{{ $userId }}"
                            style="cursor:pointer;">

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
                                            <div id="bucket-{{ $userId }}-{{ Str::slug($bucket) }}"
                                                class="collapse mt-2">

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
                                           <div class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                <div class="card-body d-flex align-items-center justify-content-between">
                                                    <div class="avatar-text avatar-lg bg-soft-danger text-danger border-soft-danger rounded">
                                                        <i class="bi bi-telephone-x fs-2 text-danger"></i>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Call</p>
                                                        <h3 class="tx-20 tx-semibold tx-left">{{ $row['followups']['Call'] ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            {{-- WhatsApp Call--}}
                                            <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                           <div class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                <div class="card-body d-flex align-items-center justify-content-between ">
                                                    <div class="avatar-text avatar-lg bg-soft-success text-success border-soft-danger rounded">
                                                         <i class="bi bi-telephone-fill fs-6 text-success"></i>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="fs-9 fw-medium text-uppercase text-muted mb-1">WhatsApp Call</p>
                                                        <h3 class="tx-20 tx-semibold tx-left">{{ $row['followups']['WhatsApp Call'] ?? 0 }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            {{-- Whatsapp --}}
                                             <div class="col-12 col-sm-6 col-xl-4 mb-2">
                                           <div class="card border border-dashed border-gray-5 hover-shadow transition-all">
                                                <div class="card-body d-flex align-items-center justify-content-between">
                                                    <div class="avatar-text avatar-lg bg-soft-success text-success border-soft-success rounded">
                                                        <i class="bi bi-whatsapp fs-2 text-success"></i>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="fs-9 fw-medium text-uppercase text-muted mb-1">Whatsapp</p>
                                                        <h3 class="tx-20 tx-semibold tx-left">{{ $row['followups']['Whatsapp'] ?? 0 }}</h3>
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
                </div>
            </div>
        </div>

@endsection