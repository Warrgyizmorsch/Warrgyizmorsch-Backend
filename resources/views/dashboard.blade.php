@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">{{ $title ?? 'Dashboard' }}</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">{{ $breadcrumb ?? 'Analytics' }}</li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">

                {{-- Mobile Back Button --}}
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>

                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">

                    {{-- Date Range Picker --}}
                    <!-- <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                        <span class="reportrange-picker-field">{{ $dateRange ?? '' }}</span>
                    </div> -->
                    {{-- Chart Toggle --}}
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <i class="feather-bar-chart"></i>
                    </a>
                </div>
            </div>

            {{-- Mobile Filter Toggle --}}
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Collapsible filter Stats --}}
    <div id="collapseOne" class="accordion-collapse collapse page-header-collapse {{ request('start') || request('end') ? 'show' : '' }}">
        <div class="accordion-body pb-2">

            <form method="GET" action="{{ route('dashboard') }}" class="row g-3 mb-4" id="date-filter-form">

                <!-- Quick Presets -->
                <div class="col-12 mb-3">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="today">Today</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="yesterday">Yesterday</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="7days">Last 7 Days</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="30days">Last 30 Days</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="this-month">This Month</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn" data-preset="last-month">Last Month</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm preset-btn active" data-preset="custom">Custom</button>
                    </div>
                </div>

                <!-- Date From -->
                <div class="col-md-3">
                    <label class="form-label">Start</label>
                    <input type="date" name="start" id="start-date" class="form-control" value="{{ request('start') }}">
                </div>

                <!-- Date To -->
                <div class="col-md-3">
                    <label class="form-label">End</label>
                    <input type="date" name="end" id="end-date" class="form-control" value="{{ request('end') }}">
                </div>

                <!-- Buttons -->
                <div class="col-12 d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary px-4">Filter</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger px-4">Reset</a>
                </div>

            </form>

        </div>
    </div>

    <!-- JavaScript for quick presets -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const startInput = document.getElementById('start-date');
            const endInput = document.getElementById('end-date');
            const form = document.getElementById('date-filter-form');

            document.querySelectorAll('.preset-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    // Remove active class from all buttons
                    document.querySelectorAll('.preset-btn').forEach(b => b.classList.remove('active'));
                    // Add active to clicked button
                    this.classList.add('active');

                    const preset = this.dataset.preset;
                    const today = new Date();
                    let start = new Date();
                    let end = new Date();

                    switch (preset) {
                        case 'today':
                            start = today;
                            end = today;
                            break;

                        case 'yesterday':
                            start.setDate(today.getDate() - 1);
                            end = new Date(start);
                            break;

                        case '7days':
                            start.setDate(today.getDate() - 7);
                            break;

                        case '30days':
                            start.setDate(today.getDate() - 30);
                            break;

                        case 'this-month':
                            start = new Date(today.getFullYear(), today.getMonth(), 2);
                            break;

                        case 'last-month':
                            start = new Date(today.getFullYear(), today.getMonth() - 1, 2);
                            end = new Date(today.getFullYear(), today.getMonth(), 1);
                            break;

                        case 'custom':
                            // do nothing - let user pick manually
                            return;
                    }

                    // Format dates for input type="date"
                    startInput.value = start.toISOString().split('T')[0];
                    endInput.value = end.toISOString().split('T')[0];

                    // Optional: auto-submit on preset click
                    // form.submit();
                });
            });

        });
    </script>

    <style>
        /* Optional: make active preset more visible */
        .preset-btn.active {
            background-color: #006FC9;
            color: white;
            border-color: #006FC9;
        }

        .preset-btn:hover {
            background-color: #e9ecef;
        }
    </style>
    <div class="main-content">
        <div class="row">

            <div class="col-12">
                <div class="card stretch stretch-full shadow-sm">
                    <div class="card-body">

                        <div class="hstack justify-content-between mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">Pipeline Overview</h5>
                                <span class="fs-12 text-muted">
                                    Main Buckets Summary • Total: {{ $totalLeads }}
                                </span>
                            </div>
                        </div>

                        <div class="row g-3">

                            @foreach($buckets as $bucket)

                            @php
    $bucketName = strtolower(trim($bucket->name)); // Normalize for reliable matching

    // Default fallback
    $icon = 'bi-folder2-open';
    $color = 'text-primary';

    // Specific matches based on your exact bucket names
    if (str_contains($bucketName, 'new') || str_contains($bucketName, 'lead') || str_contains($bucketName, 'new lead')) {
        $icon = 'bi-person-plus-fill'; // adding new person / fresh lead
        $color = 'text-success'; // green = new & positive
    } elseif (str_contains($bucketName, 'not connected') || str_contains($bucketName, 'no connect')) {
        $icon = 'bi-telephone-x'; // call failed / no connection
        $color = 'text-danger'; // red = problem / needs attention
    } elseif (str_contains($bucketName, 'follow up') || str_contains($bucketName, 'follow-up')) {
        $icon = 'bi-arrow-repeat'; // repeat / follow-up action
        $color = 'text-warning'; // yellow = pending action
    } elseif (str_contains($bucketName, 'options shortlisting') || str_contains($bucketName, 'shortlist')) {
        $icon = 'bi-list-check'; // checklist / shortlisting
        $color = 'text-info'; // info blue = in progress / selection
    } elseif (str_contains($bucketName, 'application') || str_contains($bucketName, 'apply')) {
        $icon = 'bi-file-earmark-person'; // application form with person
        $color = 'text-info'; // info blue = core process step (changed to avoid clash with brand blue)
    } elseif (str_contains($bucketName, 'offer letter') || str_contains($bucketName, 'offer')) {
        $icon = 'bi-envelope-check'; // envelope with check = offer sent/approved
        $color = 'text-success'; // green = positive milestone
    } elseif (str_contains($bucketName, 'payment')) {
        $icon = 'bi-currency-rupee'; // rupee / money (Bootstrap has bi-currency-rupee)
        $color = 'text-success'; // green = money received or due
    } elseif (str_contains($bucketName, 'cas')) {
        $icon = 'bi-shield-check'; // shield = compliance / CAS process
        $color = 'text-info'; // info = verification step
    } elseif (str_contains($bucketName, 'visa')) {
        $icon = 'bi-globe'; // globe = international / visa
        $color = 'text-info'; // info = important international step (changed to avoid clash with brand blue)
    } elseif (str_contains($bucketName, 'enrollment') || str_contains($bucketName, 'enrol')) {
        $icon = 'bi-mortarboard-fill'; // graduation cap = enrollment / admission
        $color = 'text-success'; // green = final academic step
    } elseif (str_contains($bucketName, 'closed') || str_contains($bucketName, 'close')) {
        $icon = 'bi-check2-circle'; // double check = completed & closed
        $color = 'text-success'; // green = done
    } elseif (str_contains($bucketName, 'cold lead') || str_contains($bucketName, 'cold')) {
        $icon = 'bi-snow'; // snowflake = cold / inactive
        $color = 'text-muted'; // gray = low priority / dormant
    } elseif (str_contains($bucketName, 'next intake')) {
        $icon = 'bi-calendar-event'; // calendar = future intake date
        $color = 'text-warning'; // yellow = upcoming / pending
    }

    // Optional fallback if nothing matches
    if ($icon === 'bi-folder2-open' && str_contains($bucketName, 'lead')) {
        $icon = 'bi-person-lines-fill';
        $color = 'text-info';
    }
                            @endphp

                            <div class="col-xxl-2 col-lg-3 col-md-6">
                                <div class="card border border-dashed border-gray-5 h-100 hover-shadow transition-all">
                                    <div class="card-body text-center">

                                        <div class="mb-2">
                                            <i class="bi {{ $icon }} fs-2 {{ $color }}"></i>
                                        </div>

                                        <div class="fs-3 fw-bold text-dark">
                                            {{ $bucket->total_leads }}
                                        </div>

                                        <p class="fs-12 text-muted mb-0">
                                            {{ $bucket->name }}
                                        </p>

                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
            @if($firstBucket)
            <div class="col-12 mt-2">
                <div class="card stretch stretch-full shadow-sm">
                    <div class="card-body">

                        <div class="hstack justify-content-between mb-4">
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $firstBucket->name }} Status Overview</h5>
                                <span class="fs-12 text-muted">
                                    {{ auth()->user()->role_id == 1 ? 'All Leads View' : 'My Leads View' }}
                                </span>
                            </div>
                        </div>

                        <div class="row g-3">

                            @foreach($firstBucket->children as $child)
                            @php
        $statusName = strtolower(trim($child->name)); // Normalize for matching

        // Default fallback
        $icon = 'bi-circle-fill';
        $color = 'text-secondary';

        // Specific matches based on your exact status names
        if (str_contains($statusName, 'sop under preparation') || str_contains($statusName, 'sop preparation')) {
            $icon = 'bi-file-earmark-plus'; // alternative: creating/preparing doc
            $color = 'text-primary';
        } elseif (str_contains($statusName, 'submitted')) {
            $icon = 'bi-check-circle';
            $color = 'text-success';
        } elseif (str_contains($statusName, 'processed') || str_contains($statusName, 'offer awaited')) {
            $icon = 'bi-clock-history';
            $color = 'text-warning';
        } elseif (str_contains($statusName, 'other') || str_contains($statusName, 'uncategorized')) {
            $icon = 'bi-question-circle';
            $color = 'text-secondary';
        }
                            @endphp

                            <div class="col-xxl-2 col-lg-3 col-md-6">
                                <div class="card border border-dashed border-gray-5 h-100 hover-shadow transition-all">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="bi {{ $icon }} fs-2 {{ $color }}"></i>
                                        </div>
                                        <div class="fs-3 fw-bold text-dark">
                                            {{ $statusCounts[$child->id] ?? 0 }}
                                        </div>
                                        <p class="fs-12 text-muted mb-0">
                                            {{ $child->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            {{-- Other (if handled separately in controller) --}}
                            @if(isset($statusCounts['other']) && $statusCounts['other'] > 0)
                            <div class="col-xxl-2 col-lg-3 col-md-6">
                                <div
                                    class="card border border-dashed border-gray-5 h-100 hover-shadow transition-all bg-light">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="bi bi-question-circle fs-2 text-secondary"></i>
                                        </div>
                                        <div class="fs-3 fw-bold text-dark">
                                            {{ $statusCounts['other'] }}
                                        </div>
                                        <p class="fs-12 text-muted mb-0">Other</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            @endif

            {{-- ============================================================ --}}
            {{-- KANBAN BOARD - Lead Status Columns with Drag & Drop          --}}
            {{-- ============================================================ --}}
            <div class="col-12 mt-2">
                <div class="card stretch stretch-full shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1">Lead </h5>
                            <span class="fs-12 text-muted">Drag & drop leads to change their status</span>
                        </div>
                        <a href="{{ route('modern.leads.index') }}" class="btn btn-sm btn-light-brand">
                            <i class="feather-external-link me-1"></i> Open Leads
                        </a>
                    </div>
                    <div class="card-body pt-2">

                        {{-- Kanban Styles --}}
                        <style>
                            /* ---- Wrapper ---- */
                            .db-kanban-wrapper {
                                overflow-x: auto;
                                padding-bottom: 10px;
                                width: 100%;
                            }
                            .db-kanban-board {
                                display: grid;
                                grid-template-columns: repeat(6, minmax(200px, 1fr));
                                gap: 12px;
                                width: 100%;
                                min-width: 1200px; /* Ensures minimum 200px per column before horizontal scroll */
                                align-items: stretch; /* Columns match height evenly */
                            }

                            /* ---- Column ---- */
                            .db-kanban-col {
                                width: 100%;
                                border-radius: 12px;
                                display: flex;
                                flex-direction: column;
                                border: 1.5px solid #e3e8f0;
                                transition: border-color 0.2s, box-shadow 0.2s;
                                background: #fff;
                            }
                            .db-kanban-col.drag-over {
                                border-color: #006FC9 !important;
                                box-shadow: 0 0 0 3px rgba(0,111,201,0.15);
                            }

                            /* ---- Header ---- */
                            .db-kanban-col-header {
                                padding: 10px 13px 9px;
                                border-radius: 10px 10px 0 0;
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                gap: 6px;
                                border-bottom: 1.5px solid rgba(0,0,0,0.06);
                                flex-shrink: 0;
                            }
                            .db-kanban-col-title {
                                font-size: 12px;
                                font-weight: 700;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                            }
                            .db-kanban-col-count {
                                font-size: 11px;
                                font-weight: 700;
                                padding: 2px 8px;
                                border-radius: 20px;
                                white-space: nowrap;
                                flex-shrink: 0;
                            }

                            /* ---- Body ---- */
                            .db-kanban-col-body {
                                padding: 8px;
                                flex: 1;
                                display: flex;
                                flex-direction: column;
                                overflow-y: auto;
                                max-height: 500px;
                            }
                            .db-kanban-col-body.no-leads {
                                min-height: 80px;
                            }

                            /* ---- Empty state — compact & dashed ---- */
                            .db-kanban-empty {
                                border: 1.5px dashed rgba(0,0,0,0.12);
                                border-radius: 8px;
                                padding: 16px 10px;
                                text-align: center;
                                color: #b0bec5;
                                font-size: 11px;
                                letter-spacing: 0.02em;
                                flex: 1;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                            }
                            .db-kanban-empty i {
                                font-size: 18px;
                                display: block;
                                margin-bottom: 4px;
                                opacity: 0.4;
                            }
                            /* Highlight empty drop zone on drag-over */
                            .db-kanban-col.drag-over .db-kanban-empty {
                                border-color: #006FC9;
                                background: rgba(0,111,201,0.04);
                                color: #006FC9;
                            }

                            /* ---- Cards ---- */
                            .db-kcard {
                                background: #fff;
                                border-radius: 9px;
                                padding: 9px 10px;
                                margin-bottom: 7px;
                                border: 1.5px solid #eaecf0;
                                cursor: grab;
                                user-select: none;
                                transition: box-shadow 0.18s, border-color 0.18s, transform 0.13s;
                            }
                            .db-kcard:active   { cursor: grabbing; }
                            .db-kcard:last-child { margin-bottom: 0; }
                            .db-kcard.dragging {
                                opacity: 0.45;
                                transform: scale(1.04) rotate(1.5deg);
                                box-shadow: 0 10px 28px rgba(0,0,0,0.15);
                            }
                            .db-kcard:hover {
                                box-shadow: 0 3px 12px rgba(0,111,201,0.12);
                                border-color: #b8d9f5;
                            }

                            /* Card text */
                            .db-kc-name  { font-size: 12px; font-weight: 700; color: #1a202c; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; }
                            .db-kc-id    { font-size: 10.5px; color: #8899aa; background: #f0f4f8; border-radius: 5px; padding: 1px 5px; font-weight: 600; white-space: nowrap; }
                            .db-kc-phone { font-size: 11px; color: #6c757d; margin-top: 3px; }
                            .db-kc-badges{ display: flex; gap: 4px; flex-wrap: wrap; margin-top: 4px; }
                            .db-kc-badge { font-size: 10px; font-weight: 600; padding: 1px 7px; border-radius: 20px; text-transform: capitalize; }
                            .db-kc-badge-cold { background:#e0f5ff; color:#0077aa; }
                            .db-kc-badge-hot  { background:#ffe5e5; color:#cc2200; }
                            .db-kc-badge-warm { background:#fff3e0; color:#b85c00; }
                            .db-kc-badge-dead { background:#e9e9e9; color:#555; }
                            .db-kc-badge-na   { background:#f0f4f8; color:#8899aa; }
                            .db-kc-badge-prod { background:rgba(0,111,201,0.09); color:#006FC9; border:1px solid rgba(0,111,201,0.16); }
                            .db-kc-date  { font-size: 9.5px; color: #a0aec0; margin-top: 4px; }

                            /* ---- Column themes ---- */
                            .db-theme-lead       { background:#f0f7ff; border-color:#bde0ff; }
                            .db-theme-lead       .db-kanban-col-header { background:#e3f0ff; }
                            .db-theme-lead       .db-kanban-col-title  { color:#006FC9; }
                            .db-theme-lead       .db-kanban-col-count  { background:#006FC9; color:#fff; }

                            .db-theme-active     { background:#f0fdf4; border-color:#bbf7d0; }
                            .db-theme-active     .db-kanban-col-header { background:#dcfce7; }
                            .db-theme-active     .db-kanban-col-title  { color:#15803d; }
                            .db-theme-active     .db-kanban-col-count  { background:#16a34a; color:#fff; }

                            .db-theme-completion { background:#fdf4ff; border-color:#e9d5ff; }
                            .db-theme-completion .db-kanban-col-header { background:#f3e8ff; }
                            .db-theme-completion .db-kanban-col-title  { color:#7e22ce; }
                            .db-theme-completion .db-kanban-col-count  { background:#9333ea; color:#fff; }

                            .db-theme-postlaunch { background:#fffbeb; border-color:#fde68a; }
                            .db-theme-postlaunch .db-kanban-col-header { background:#fef3c7; }
                            .db-theme-postlaunch .db-kanban-col-title  { color:#b45309; }
                            .db-theme-postlaunch .db-kanban-col-count  { background:#d97706; color:#fff; }

                            .db-theme-blocked    { background:#fff5f5; border-color:#fecaca; }
                            .db-theme-blocked    .db-kanban-col-header { background:#fee2e2; }
                            .db-theme-blocked    .db-kanban-col-title  { color:#b91c1c; }
                            .db-theme-blocked    .db-kanban-col-count  { background:#dc2626; color:#fff; }

                            .db-theme-closed     { background:#f8fafc; border-color:#cbd5e1; }
                            .db-theme-closed     .db-kanban-col-header { background:#f1f5f9; }
                            .db-theme-closed     .db-kanban-col-title  { color:#475569; }
                            .db-theme-closed     .db-kanban-col-count  { background:#64748b; color:#fff; }

                            .db-theme-default    { background:#f5f7fa; border-color:#e3e8f0; }
                            .db-theme-default    .db-kanban-col-header { background:#eef1f6; }
                            .db-theme-default    .db-kanban-col-title  { color:#4a5568; }
                            .db-theme-default    .db-kanban-col-count  { background:#718096; color:#fff; }
                        </style>



                        @php
                            function dbKanbanTheme($name) {
                                $n = strtolower($name);
                                if (str_contains($n,'lead'))        return 'lead';
                                if (str_contains($n,'active'))      return 'active';
                                if (str_contains($n,'completion') || str_contains($n,'launch')) return 'completion';
                                if (str_contains($n,'post') || str_contains($n,'maintenance'))  return 'postlaunch';
                                if (str_contains($n,'blocked') || str_contains($n,'cancelled')) return 'blocked';
                                if (str_contains($n,'closed'))      return 'closed';
                                return 'default';
                            }
                        @endphp

                        <div class="db-kanban-wrapper">
                            <div class="db-kanban-board" id="dbKanbanBoard">

                                @foreach($buckets as $bucket)
                                    @php
                                        $dbTheme   = dbKanbanTheme($bucket->name);
                                        $dbLeads   = $kanbanBucketLeads[$bucket->id] ?? collect();
                                    @endphp

                                    <div class="db-kanban-col db-theme-{{ $dbTheme }}"
                                         id="dbKanbanCol-{{ $bucket->id }}"
                                         data-bucket-id="{{ $bucket->id }}"
                                         data-bucket-name="{{ $bucket->name }}">

                                        {{-- Header --}}
                                        <div class="db-kanban-col-header">
                                            <span class="db-kanban-col-title" title="{{ $bucket->name }}">{{ $bucket->name }}</span>
                                            <span class="db-kanban-col-count" id="dbKColCount-{{ $bucket->id }}">{{ $bucket->total_leads }}</span>
                                        </div>

                                        {{-- Body --}}
                                        <div class="db-kanban-col-body {{ $dbLeads->isEmpty() ? 'no-leads' : 'has-leads' }}" id="dbKanbanBody-{{ $bucket->id }}">
                                            @if($dbLeads->isEmpty())
                                                <div class="db-kanban-empty">
                                                    <i class="fas fa-layer-group"></i>
                                                    Drop leads here
                                                </div>
                                            @else
                                                @foreach($dbLeads as $kl)
                                                    @php
                                                        $kEng  = strtolower($kl->lead_engagement_status ?? 'n/a');
                                                        $kBadge = match($kEng) {
                                                            'hot'  => 'db-kc-badge-hot',
                                                            'warm' => 'db-kc-badge-warm',
                                                            'cold' => 'db-kc-badge-cold',
                                                            'dead' => 'db-kc-badge-dead',
                                                            default => 'db-kc-badge-na',
                                                        };
                                                    @endphp
                                                    <div class="db-kcard"
                                                         draggable="true"
                                                         data-lead-id="{{ $kl->id }}"
                                                         data-bucket-id="{{ $bucket->id }}"
                                                         id="dbKCard-{{ $kl->id }}">

                                                        {{-- Name + ID --}}
                                                        <div class="d-flex align-items-center justify-content-between gap-1">
                                                            <span class="db-kc-name">{{ optional($kl->user)->name ?? 'Unknown' }}</span>
                                                            <span class="db-kc-id">#{{ $kl->id }}</span>
                                                        </div>

                                                        {{-- Phone --}}
                                                        <div class="db-kc-phone">
                                                            <i class="fas fa-phone-alt" style="font-size:9px;color:#90a4ae;margin-right:3px;"></i>
                                                            {{ optional($kl->user)->contact_no ?? 'N/A' }}
                                                        </div>

                                                        {{-- Badges --}}
                                                        <div class="db-kc-badges">
                                                            <span class="db-kc-badge {{ $kBadge }}">{{ strtoupper($kEng) }}</span>
                                                            @if($kl->product)
                                                                <span class="db-kc-badge db-kc-badge-prod">{{ $kl->product }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- Created date --}}
                                                        <div class="db-kc-date">
                                                            <i class="fas fa-calendar-alt" style="font-size:9px;"></i>
                                                            Create On {{ \Carbon\Carbon::parse($kl->created_at)->format('d M Y h:i A') }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- Drag & Drop JS --}}
                        <script>
                        (function () {
                            const dragBase  = "{{ url('/modern-leads/drag-update') }}";
                            const csrf      = "{{ csrf_token() }}";
                            let dragged     = null;
                            let srcBucket   = null;

                            function attachCard(card) {
                                card.addEventListener('dragstart', function(e) {
                                    dragged   = this;
                                    srcBucket = this.dataset.bucketId;
                                    setTimeout(() => this.classList.add('dragging'), 0);
                                    e.dataTransfer.effectAllowed = 'move';
                                    e.dataTransfer.setData('text/plain', this.dataset.leadId);
                                });
                                card.addEventListener('dragend', function() {
                                    this.classList.remove('dragging');
                                    document.querySelectorAll('.db-kanban-col').forEach(c => c.classList.remove('drag-over'));
                                    dragged = null; srcBucket = null;
                                });
                            }

                            function attachCol(col) {
                                col.addEventListener('dragover', function(e) {
                                    e.preventDefault(); this.classList.add('drag-over');
                                });
                                col.addEventListener('dragleave', function() {
                                    this.classList.remove('drag-over');
                                });
                                col.addEventListener('drop', function(e) {
                                    e.preventDefault();
                                    this.classList.remove('drag-over');
                                    const tBucketId   = this.dataset.bucketId;
                                    const tBucketName = this.dataset.bucketName;
                                    const leadId      = e.dataTransfer.getData('text/plain');
                                    if (!dragged || tBucketId === srcBucket) return;

                                    const body = this.querySelector('.db-kanban-col-body');
                                    const emptyEl = body.querySelector('.db-kanban-empty');
                                    if (emptyEl) emptyEl.remove();

                                    // Switch body class
                                    body.classList.remove('no-leads');
                                    body.classList.add('has-leads');

                                    body.appendChild(dragged);
                                    dragged.dataset.bucketId = tBucketId;

                                    // Src column empty?
                                    const srcBody = document.querySelector(`#dbKanbanBody-${srcBucket}`);
                                    if (srcBody && srcBody.querySelectorAll('.db-kcard').length === 0) {
                                        srcBody.classList.remove('has-leads');
                                        srcBody.classList.add('no-leads');
                                        srcBody.innerHTML = `<div class="db-kanban-empty"><i class="fas fa-layer-group"></i>Drop leads here</div>`;
                                    }

                                    // Update counts
                                    const srcCount = document.querySelector(`#dbKColCount-${srcBucket}`);
                                    const tgtCount = document.querySelector(`#dbKColCount-${tBucketId}`);
                                    if (srcCount) srcCount.textContent = Math.max(0, parseInt(srcCount.textContent) - 1);
                                    if (tgtCount) tgtCount.textContent = parseInt(tgtCount.textContent) + 1;

                                    // AJAX
                                    fetch(`${dragBase}/${leadId}`, {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                        body: JSON.stringify({ lead_bucket_id: parseInt(tBucketId), lead_status: tBucketName }),
                                    })
                                    .then(r => r.json())
                                    .then(d => dbShowToast(d.success ? `✅ Moved to <strong>${tBucketName}</strong>` : '❌ Failed', d.success ? 'success' : 'danger'))
                                    .catch(() => dbShowToast('❌ Network error.', 'danger'));
                                });
                            }

                            document.querySelectorAll('.db-kcard').forEach(attachCard);
                            document.querySelectorAll('.db-kanban-col').forEach(attachCol);

                            function dbShowToast(msg, type='success') {
                                let t = document.getElementById('dbKanbanToast');
                                if (!t) {
                                    t = document.createElement('div');
                                    t.id = 'dbKanbanToast';
                                    t.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:99999;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:600;box-shadow:0 6px 24px rgba(0,0,0,0.15);transition:opacity 0.3s;min-width:220px;max-width:340px;line-height:1.5;';
                                    document.body.appendChild(t);
                                }
                                t.style.background = type==='success'?'#e8f5e9':'#ffebee';
                                t.style.color      = type==='success'?'#2e7d32':'#c62828';
                                t.style.opacity    = '1'; t.innerHTML = msg;
                                clearTimeout(t._timer);
                                t._timer = setTimeout(() => t.style.opacity = '0', 3000);
                            }
                        })();
                        </script>

                    </div>{{-- /card-body --}}
                </div>
            </div>

            <!-- [Goal Progress] start -->


            <div class="col-xxl-4">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Lead Engagement Progress</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <div data-bs-toggle="tooltip" title="Delete">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                        data-bs-toggle="remove"></a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Refresh">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-brand"
                                        data-bs-toggle="refresh"></a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                        data-bs-toggle="expand"></a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                                    data-bs-offset="25, 25">
                                    <div data-bs-toggle="tooltip" title="Options">
                                        <i class="feather-more-vertical"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-at-sign"></i>New</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-calendar"></i>Event</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-bell"></i>Snoozed</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-trash-2"></i>Deleted</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-settings"></i>Settings</a>
                                    <a href="javascript:void(0);" class="dropdown-item"><i
                                            class="feather-life-buoy"></i>Tips & Tricks</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body custom-card-action">
                        <div class="row g-4">
                            @php
$engagementItems = [
    [
        'key' => 'hot',
        'label' => 'Hot Leads',
        'color' => '#dc3545',
        'icon' => 'bi-fire',
        'iconClass' => 'text-danger',
    ],
    [
        'key' => 'warm',
        'label' => 'Warm Leads',
        'color' => '#006FC9',
        'icon' => 'bi-thermometer-half',
        'iconClass' => 'text-brand',
    ],
    [
        'key' => 'cold',
        'label' => 'Cold Leads',
        'color' => '#02a0e4', // Info Blue/Cyan to differentiate from brand blue
        'icon' => 'bi-snow',
        'iconClass' => 'text-info',
    ],
    [
        'key' => 'dead',
        'label' => 'Dead Leads',
        'color' => '#6c757d',
        'icon' => 'bi-x-circle',
        'iconClass' => 'text-secondary',
    ],
];
                            @endphp

                            @foreach($engagementItems as $item)
                            @php
    $percent = $engagementPercentages[$item['key']] ?? 0;
    $count = $engagementCounts[$item['key']] ?? 0;

    $knownEngagementTotal =
        ($engagementCounts['hot'] ?? 0) +
        ($engagementCounts['warm'] ?? 0) +
        ($engagementCounts['cold'] ?? 0) +
        ($engagementCounts['dead'] ?? 0);

    $remainingEngagement = $totalEngagement - $knownEngagementTotal;
                            @endphp

                            <div class="col-sm-6">
                                <div class="px-4 py-3 text-center border border-dashed rounded-3">
                                    <div class="mx-auto mb-1 position-relative" style="width: 100px; height: 100px;">
                                        <!-- SVG Circular Progress -->
                                        <svg width="100" height="100" viewBox="0 0 100 100">
                                            <!-- Background track -->
                                            <circle cx="50" cy="50" r="42" fill="none" stroke="#e9ecef"
                                                stroke-width="5" />
                                            <!-- Colored progress arc -->
                                            <circle cx="50" cy="50" r="42" fill="none" stroke="{{ $item['color'] }}"
                                                stroke-width="5" stroke-linecap="round" stroke-dasharray="263.89"
                                                stroke-dashoffset="{{ 263.89 * (1 - $percent / 100) }}"
                                                transform="rotate(-90 50 50)" />
                                        </svg>

                                        <!-- Center percentage + count -->
                                        <div class="position-absolute top-50 start-50 translate-middle text-center">
                                            <div class="fs-6 fw-bold">{{ $percent }}%</div>
                                        </div>

                                    </div>

                                    <!-- Icon on top of circle -->
                                    <div class="">
                                        <i class="bi {{ $item['icon'] }} fs-6 {{ $item['iconClass'] }}"></i>
                                    </div>
                                    <h2 class="fs-13 tx-spacing-1 mb-1">{{ $item['label'] }}</h2>
                                    <div class="fs-11 text-muted">
                                        {{ $count }} / {{ $totalEngagement }} leads
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @if($remainingEngagement > 0)
                            <div class="mb-2 text-muted small">
                                Engagement status not available in
                                <strong>{{ $remainingEngagement }}</strong> leads
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <a href="javascript:void(0);" class="btn btn-primary w-100">GENERATE REPORT</a>
                    </div>
                </div>
            </div>
            <!-- [Goal Progress] end -->
            <!-- [Marketing Campaign] start -->

            <!-- [New Leads by Month - Duralux Style] -->
            <div class="col-xxl-8">
                <div class="card stretch stretch-full">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">New Leads by Month</h5>

                       @if(auth()->user()->role_id === 1 && collect($monthlyChartData)->count() > 1)
                        <select id="monthlyUserSelect" class="form-select form-select-sm w-auto">
                            @foreach($monthlyChartData as $index => $item)
                            <option value="{{ $index }}" {{ $index === 0 ? 'selected' : '' }}>
                                {{ $item['user_name'] }}
                            </option>
                            @endforeach
                        </select>
                        @endif
                    </div>

                    <div class="card-body custom-card-action p-0">
                        <div id="monthly-new-leads-chart" style="min-height: 340px; padding: 15px;"></div>
                    </div>

                    <div class="card-footer d-md-flex flex-wrap p-4 pt-5 border-top border-gray-5">
                        <div class="flex-fill mb-4 mb-md-0 pb-2 pb-md-0 text-center text-md-start">
                            <p class="fs-11 fw-semibold text-uppercase text-primary mb-1">Total in Period</p>
                            <h2 id="chartTotal" class="fs-22 fw-bold mb-0">0</h2>
                        </div>

                        <div class="vr mx-4 text-gray-600 d-none d-md-flex"></div>

                        <div class="flex-fill mb-4 mb-md-0 pb-2 pb-md-0 text-center text-md-start">
                            <p class="fs-11 fw-semibold text-uppercase text-primary mb-1">Current Month</p>
                            <h2 id="currentMonthTotal" class="fs-22 fw-bold mb-0">0</h2>
                            <span id="growthBadge" class="fs-12"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- new source wise chart -->
            <div class="col-xxl-8">
    <div class="card stretch stretch-full">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">New Leads by Source</h5>

            <!-- SOURCE DROPDOWN -->
            @if(count($sourceChartData) > 1)
                <select id="sourceSelect" class="form-select form-select-sm w-auto">
                    @foreach($sourceChartData as $index => $item)
                        <option value="{{ $index }}" {{ $index === 0 ? 'selected' : '' }}>
                            {{ $item['source_name'] }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="card-body p-0">
            <div id="source-chart" style="min-height: 340px; padding: 15px;"></div>
        </div>

        <!-- Footer Stats -->
        <div class="card-footer d-md-flex flex-wrap p-4 pt-5 border-top border-gray-5">
            <div class="flex-fill text-center text-md-start">
                <p class="fs-11 text-uppercase text-primary mb-1">Total in Period</p>
                <h2 id="sourceTotal" class="fs-22 fw-bold mb-0">0</h2>
            </div>

            <div class="vr mx-4 d-none d-md-flex"></div>

            <div class="flex-fill text-center text-md-start">
                <p class="fs-11 text-uppercase text-primary mb-1">Current Month</p>
                <h2 id="sourceCurrent" class="fs-22 fw-bold mb-0">0</h2>
                <span id="sourceGrowth" class="fs-12"></span>
            </div>
        </div>
    </div>
</div>

     <!-- source wise js -->
      <script>
document.addEventListener('DOMContentLoaded', function () {

    const sourceData = @json($sourceChartData ?? []);
    const categories = @json($chartCategories ?? []);

    if (!sourceData.length) return;

    let chart;
    let currentIndex = 0;

    function renderChart(index) {

        const data = sourceData[index];
        const seriesData = data.series;
        const total = data.total;

        // Growth Calculation
        const last = seriesData[seriesData.length - 1] || 0;
        const prev = seriesData.length >= 2 ? seriesData[seriesData.length - 2] : 0;

        const growth = prev > 0
            ? Math.round(((last - prev) / prev) * 100)
            : (last > 0 ? 100 : 0);

        // Update Footer
        document.getElementById('sourceTotal').textContent = total.toLocaleString();
        document.getElementById('sourceCurrent').textContent = last.toLocaleString();

        const badge = document.getElementById('sourceGrowth');
        badge.textContent = growth !== 0 ? `${growth >= 0 ? '+' : ''}${growth}% vs previous` : '';
        badge.className = `fs-12 ${growth >= 0 ? 'text-success' : 'text-danger'}`;

        // Chart Update / Create
        if (chart) {
            chart.updateOptions({
                xaxis: { categories: categories }
            }, false, true);

            chart.updateSeries([{
                name: data.source_name,
                data: seriesData
            }]);

        } else {
            chart = new ApexCharts(document.querySelector("#source-chart"), {
                chart: {
                    type: 'bar',
                    height: 340,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '48%',
                        borderRadius: 6
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val > 0 ? val : '',
                    offsetY: -20
                },
                series: [{
                    name: data.source_name,
                    data: seriesData
                }],
                xaxis: {
                    categories: categories,
                    labels: {
                        rotate: -45
                    }
                },
                colors: ['#3454d1'],
                yaxis: {
                    min: 0
                },
                grid: {
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: val => val + " leads"
                    }
                }
            });

            chart.render();
        }
    }

    // Initial Load
    renderChart(currentIndex);

    // Dropdown Change
    document.getElementById("sourceSelect")?.addEventListener("change", function () {
        currentIndex = parseInt(this.value);
        renderChart(currentIndex);
    });

});
</script>

            <!-- JavaScript -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const usersData = @json($monthlyChartData ?? []);
                    const categories = @json($chartCategories ?? []);

                    if (!usersData.length) return;

                    let chart;
                    let currentIndex = 0; // starts with "All Users" (index 0)

                    function renderChart(index) {
                        const data = usersData[index];
                        const seriesData = data.series;
                        const total = data.total;

                        // Calculate growth
                        const last = seriesData[seriesData.length - 1] || 0;
                        const prev = seriesData.length >= 2 ? seriesData[seriesData.length - 2] : 0;
                        const growth = prev > 0 ? Math.round(((last - prev) / prev) * 100) : (last > 0 ? 100 : 0);

                        // Update footer
                        document.getElementById('chartTotal').textContent = total.toLocaleString();
                        document.getElementById('currentMonthTotal').textContent = last.toLocaleString();

                        const badge = document.getElementById('growthBadge');
                        badge.textContent = growth !== 0 ? `${growth >= 0 ? '+' : ''}${growth}% vs previous` : '';
                        badge.className = `fs-12 ${growth >= 0 ? 'text-success' : 'text-danger'}`;

                        // Chart update / create
                        if (chart) {
                            chart.updateOptions({
                                xaxis: {
                                    categories: categories
                                },
                            }, false, true);

                            chart.updateSeries([{
                                name: 'New Leads',
                                data: seriesData
                            }]);
                        } else {
                            chart = new ApexCharts(document.querySelector("#monthly-new-leads-chart"), {
                                chart: {
                                    type: 'bar',
                                    height: 340,
                                    toolbar: {
                                        show: false
                                    },
                                    fontFamily: 'inherit'
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: '48%',
                                        borderRadius: 6,
                                        endingShape: 'rounded'
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: val => val > 0 ? val : '',
                                    offsetY: -22,
                                    style: {
                                        fontSize: '13px',
                                        fontWeight: 600,
                                        colors: ['#fff']
                                    }
                                },
                                series: [{
                                    name: 'New Leads',
                                    data: seriesData
                                }],
                                xaxis: {
                                    categories: categories,
                                    labels: {
                                        rotate: -45,
                                        rotateAlways: false,
                                        hideOverlappingLabels: true,
                                        style: {
                                            colors: '#64748b',
                                            fontSize: '12px'
                                        }
                                    },
                                    axisBorder: {
                                        show: false
                                    },
                                    axisTicks: {
                                        show: false
                                    }
                                },
                                colors: ['#3454d1'],
                                yaxis: {
                                    min: 0,
                                    labels: {
                                        style: {
                                            colors: '#64748b',
                                            fontSize: '12px'
                                        }
                                    }
                                },
                                grid: {
                                    borderColor: '#e2e8f0',
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: true
                                        }
                                    },
                                    xaxis: {
                                        lines: {
                                            show: false
                                        }
                                    }
                                },
                                tooltip: {
                                    y: {
                                        formatter: val => val + " new leads"
                                    }
                                },
                                legend: {
                                    show: false
                                }
                            });

                            chart.render();
                        }
                    }

                    // Initial render (All Users for admin, self for others)
                    renderChart(currentIndex);

                    // Dropdown change handler
                    document.getElementById("monthlyUserSelect")?.addEventListener("change", function() {
                        currentIndex = parseInt(this.value);
                        renderChart(currentIndex);
                    });
                });
            </script>
            <!-- [Marketing Campaign] end -->

            <!-- [Projects Stats] start -->
            <style>
                .stage-1 {
                    background-color: #ea4d4d !important;
                }

                /* very light blue */
                .stage-2 {
                    background-color: #3454d1 !important;
                }

                .stage-3 {
                    background-color: #17c666 !important;
                }

                .stage-4 {
                    background-color: #3dc7be !important;
                }

                .stage-5 {
                    background-color: #ffa21d !important;
                }

                .stage-6 {
                    background-color: #ea4d4d !important;
                }

                .stage-7 {
                    background-color: #3454d1 !important;
                }

                .stage-8 {
                    background-color: #17c666 !important;
                }

                /* dark blue */

                .stage-empty {
                    background-color: #e9ecef !important;
                }
            </style>
            <div class="col-xxl-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Recent Leads Progress</h5>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive project-report-table">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Lead</th>
                                        <th style="width:45%">Stage</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($recentLeadsProgress as $lead)
                                    @php
    $stageColorClasses = [
        1 => 'stage-1',
        2 => 'stage-2',
        3 => 'stage-3',
        4 => 'stage-4',
        5 => 'stage-5',
        6 => 'stage-6',
        7 => 'stage-7',
        8 => 'stage-8',
    ];

    $currentStageClass = $stageColorClasses[$lead['stage_position']] ?? 'stage-1';
                                    @endphp
                                    <tr>
                                        {{-- Lead Info --}}
                                        <td>
                                            <div>
                                                <div class="fw-bold text-dark">
                                                    Lead #{{ $lead['lead_name'] }}
                                                </div>
                                                @if($lead['user'])
                                                <div class="fs-12 text-muted">
                                                    {{ $lead['user']->name }}
                                                </div>
                                                <div class="fs-12 text-muted">
                                                    {{ $lead['user']->contact_no }}
                                                </div>
                                                <div class="fs-12 text-muted">
                                                    {{ $lead['user']->email }}
                                                </div>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- Segmented Stage Progress --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-2 justify-content-center">

                                                @for($i = 1; $i <= $lead['total_stages']; $i++)

                                                    @php
        $colorClass = ($i <= $lead['stage_position'])
            ? ($stageColorClasses[$i] ?? 'stage-1')
            : 'stage-empty';
                                                    @endphp

                                                    <div class="wd-20 ht-4 {{ $colorClass }} rounded-pill">
                                            </div>

                                            @endfor

                        </div>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="badge {{ $currentStageClass }} text-white px-3 py-2">
                                {{ $lead['bucket_name'] }}
                            </span>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                No recent leads found
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('lead.index') }}"
                    class="card-footer fs-11 fw-bold text-uppercase text-center">
                    View All Leads
                </a>
            </div>
        </div>
        <!-- [Projects Stats] end -->
        <!-- [Leads Overview] start -->
        <div class="col-xxl-4">
            <div class="card stretch stretch-full">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sales Performance</h5>

                    @if(count($salesUserPerformance) > 0 && Auth()->user()->role_id === 1)
                    <select id="userSelect" class="form-select form-select-sm w-auto">
                        @foreach($salesUserPerformance as $index => $perf)
                        <option value="{{ $index }}">
                            {{ $perf['user']->name }}
                        </option>
                        @endforeach
                    </select>
                    @endif
                </div>

                <div class="card-body pt-1">

                    @if(count($salesUserPerformance) > 0)

                    <!-- Header -->
                    <div class="mb-3">
                        <strong id="userName" class="fs-6"></strong>
                        <div class="text-muted small" id="convertedText"></div>
                    </div>

                    <!-- Donut -->
                    <div class="d-flex justify-content-center">
                        <div id="salesDonutChart" style="height:240px;width:240px;"></div>
                    </div>

                    <!-- Status List -->
                    <div class="mt-3" id="statusList"></div>

                    @else
                    <div class="text-center py-5 text-muted">
                        No sales representatives found
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                let users = @json($salesUserPerformance);

                if (!users.length) return;

                let chart;
                let currentIndex = 0;

                function renderUser(index) {

                    let perf = users[index];

                    // Header
                    document.getElementById("userName").innerText = perf.user.name;
                    document.getElementById("convertedText").innerText =
                        `Converted: ${perf.converted} / ${perf.total_leads}`;

                    // Status list
                    let statusHtml = '';
                    perf.labels.forEach((label, i) => {
                        statusHtml += `
                            <div class="d-flex justify-content-between align-items-center mb-1 small">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 rounded-circle"
                                        style="width:10px;height:10px;background:${perf.colors[i]};">
                                    </span>
                                    ${label}
                                </div>
                                <strong>${perf.series[i]}</strong>
                            </div>
                        `;
                    });

                    document.getElementById("statusList").innerHTML = statusHtml;

                    // If chart already exists → update
                    if (chart) {

                        chart.updateSeries(perf.series);

                        chart.updateOptions({
                            labels: perf.labels,
                            colors: perf.colors,
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                label: "Conversion",
                                                formatter: function() {
                                                    return perf.conversion_rate + "%";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }, true, true);

                    } else {

                        // First time render
                        chart = new ApexCharts(document.querySelector("#salesDonutChart"), {
                            chart: {
                                type: "donut",
                                height: 240
                            },
                            series: perf.series,
                            labels: perf.labels,
                            colors: perf.colors,
                            legend: {
                                show: false
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 4,
                                colors: ['#ffffff']
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val) {
                                        return val + " leads";
                                    }
                                }
                            },
                            plotOptions: {
                                pie: {
                                    expandOnClick: false, // IMPORTANT (no center change on hover)
                                    donut: {
                                        size: "75%",
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                label: "Conversion",
                                                formatter: function() {
                                                    return perf.conversion_rate + "%";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        chart.render();
                    }
                }

                // Initial render
                renderUser(currentIndex);

                // On dropdown change
                document.getElementById("userSelect")?.addEventListener("change", function() {
                    currentIndex = this.value;
                    renderUser(currentIndex);
                });

            });
        </script>
        <!-- [Leads Overview] end -->

        <!-- [Project Remainders] start -->
        <div class="col-xxl-12">
            <div class="card stretch stretch-full">
                <div class="card-header">
                    <div>
                        <h5 class="mb-0 fw-semibold">Recent Lead Activity</h5>
                        <small class="text-muted">Sorted by latest comment update</small>
                    </div>
                    <div class="card-header-action">
                        <div class="card-header-btn">
                            <div data-bs-toggle="tooltip" title="Delete">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                    data-bs-toggle="remove"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Refresh">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-brand"
                                    data-bs-toggle="refresh"> </a>
                            </div>
                            <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                    data-bs-toggle="expand"> </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body custom-card-action p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Lead Info</th>
                                    <th>Status</th>
                                    <th>Last Comment</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLeads as $lead)
                                <tr>

                                    <!-- Lead Info -->
                                    <td>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                Lead #{{ $lead->id }}
                                            </h6>

                                            <small class="text-muted d-block">
                                                {{ $lead->user->name ?? 'N/A' }}
                                            </small>

                                            <small class="text-muted d-block">
                                                {{ $lead->user->contact_no ?? 'N/A' }}
                                            </small>

                                            <small class="text-muted">
                                                {{ $lead->user->email ?? '' }}
                                            </small>
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            {{ $lead->lead_status ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <!-- Last Comment -->
                                    <td class="last-comment-col">
                                        @php
    $message = $lead->latestMessage->message ?? '';
    $isLong = strlen($message) > 120;
                                        @endphp

                                        <div>
                                            <p class="mb-1 fw-medium text-dark comment-text"
                                                id="comment-{{ $lead->id }}">
                                                {{ $message }}
                                            </p>

                                            @if($isLong)
                                            <span class="text-brand read-more-btn"
                                                onclick="toggleComment({{ $lead->id }})" id="btn-{{ $lead->id }}">
                                                Read More
                                            </span>
                                            @endif

                                            <div>
                                                <small class="text-muted">
                                                    {{ optional($lead->latestMessage->created_at)->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Updated By -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <div class="avatar-sm bg-light rounded-circle text-center">
                                                <span class="fw-semibold">
                                                    {{ strtoupper(substr($lead->latestMessage->user->name ?? 'S', 0, 1)) }}
                                                </span>
                                            </div>

                                            <div>
                                                <div class="fw-semibold">
                                                    {{ $lead->latestMessage->user->name ?? 'System' }}
                                                </div>

                                                <small class="text-muted">
                                                    Owner: {{ $lead->owner->name ?? 'Unassigned' }}
                                                </small>
                                            </div>

                                        </div>
                                    </td>

                                    <!-- Action -->
                                    <td class="text-end">
                                        <a href="{{ route('lead.index') }}" class="btn btn-sm btn-brand">
                                            View
                                        </a>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No recent activity found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="p-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [Project Remainders] end -->
        <style>
            /* Fix comment column width */
            .last-comment-col {
                width: 350px;
            }

            /* 3 line clamp */
            .comment-text {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                white-space: normal;
            }

            /* Expanded */
            .comment-text.expanded {
                display: block;
                -webkit-line-clamp: unset;
                overflow: visible;
                white-space: normal;
            }

            .read-more-btn {
                cursor: pointer;
                font-size: 13px;
                font-weight: 500;
            }
        </style>
        <script>
            function toggleComment(id) {
                const text = document.getElementById('comment-' + id);
                const btn = document.getElementById('btn-' + id);

                text.classList.toggle('expanded');

                if (text.classList.contains('expanded')) {
                    btn.innerText = "Show Less";
                } else {
                    btn.innerText = "Read More";
                }
            }
        </script>


    </div>
    </div>
@endsection