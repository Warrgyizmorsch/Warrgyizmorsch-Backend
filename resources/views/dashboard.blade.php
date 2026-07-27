@extends('layouts.app')

@section('content')

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
        .db-subkanban-board {
            display: flex;
            gap: 12px;
            width: 100%;
            overflow-x: auto;
            padding-bottom: 10px;
            align-items: stretch;
        }
        .db-subkanban-board .db-kanban-col {
            min-width: 210px;
            flex: 1 0 210px;
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
            cursor: pointer;
            transition: opacity 0.15s;
        }
        .db-kanban-col-header:hover {
            opacity: 0.85;
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
                                <a href="{{ route('modern.leads.index', ['bucket_id' => $bucket->id, 'lead_status' => '']) }}" class="text-decoration-none">
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
                                </a>
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
                                <a href="{{ route('modern.leads.index', ['bucket_id' => $firstBucket->id, 'lead_status' => $child->name]) }}" class="text-decoration-none">
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
                                </a>
                            </div>
                            @endforeach

                            {{-- Other (if handled separately in controller) --}}
                            @if(isset($statusCounts['other']) && $statusCounts['other'] > 0)
                            <div class="col-xxl-2 col-lg-3 col-md-6">
                                <div class="card border border-dashed border-gray-5 h-100 hover-shadow transition-all bg-light">
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
            <!-- <div class="col-12 mt-2">
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
                                        <a href="{{ route('modern.leads.index', ['bucket_id' => $bucket->id, 'lead_status' => '']) }}" class="db-kanban-col-header text-decoration-none" title="Open {{ $bucket->name }} in Modern Leads">
                                            <span class="db-kanban-col-title" title="{{ $bucket->name }}">{{ $bucket->name }}</span>
                                            <span class="db-kanban-col-count" id="dbKColCount-{{ $bucket->id }}">{{ $bucket->total_leads }}</span>
                                        </a>

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

                                                        {{-- Name + Edit Button --}}
                                                        <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                            <span class="db-kc-name fw-bold text-dark" style="font-size: 13px;">{{ optional($kl->user)->name ?? 'Unknown' }}</span>
                                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center justify-content-center rounded p-1" style="background: #eff6ff; border: 1px solid #dbeafe; color: #006FC9; text-decoration: none;" title="Edit Lead Form" data-lead="{{ json_encode($kl ?? []) }}" data-user="{{ json_encode($kl->user ?? []) }}" onclick="event.stopPropagation(); openEditModal(this);">
                                                                <i class="fa-solid fa-pen-to-square" style="font-size: 13px;"></i>
                                                            </a>
                                                        </div>

                                                        {{-- Phone --}}
                                                        <div class="db-kc-phone mb-1">
                                                            <i class="fas fa-phone-alt" style="font-size:9px;color:#90a4ae;margin-right:3px;"></i>
                                                            {{ optional($kl->user)->contact_no ?? 'N/A' }}
                                                        </div>

                                                        {{-- Badges --}}
                                                        <div class="db-kc-badges mb-1">
                                                            <span class="db-kc-badge {{ $kBadge }}">{{ strtoupper($kEng) }}</span>
                                                            @if($kl->product)
                                                                <span class="db-kc-badge db-kc-badge-prod">{{ $kl->product }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- Owner --}}
                                                        <div class="db-kc-owner text-muted mb-1" style="font-size:10.5px;">
                                                            <i class="fas fa-user-tie text-secondary me-1" style="font-size:9.5px;"></i>
                                                            Owner: <span class="fw-semibold text-dark">{{ optional($kl->owner)->name ?? 'Unassigned' }}</span>
                                                        </div>

                                                        {{-- Created date --}}
                                                        <div class="db-kc-date" style="font-size: 10px;">
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
                    </div>{{-- /card-body --}}
                </div>
            </div> -->

            {{-- ============================================================ --}}
            {{-- KANBAN BOARD - Lead Sub-Status Columns with Drag & Drop     --}}
            {{-- ============================================================ --}}
            <div class="col-12 mt-4" id="dbKanbanSubContainer">
                <div class="card stretch stretch-full shadow-sm">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div>
                            <h5 class="card-title mb-1">Pipeline Lead</h5>
                            <span class="fs-12 text-muted">Drag & drop leads to change their sub-status</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="fs-12 fw-semibold text-muted">Filter:</span>
                            <select id="dbSubKanbanFilter" class="form-select form-select-sm" style="width:auto;min-width:160px;" onchange="dbFilterSubKanban(this.value)">
                                @foreach($buckets as $index => $b)
                                    <option value="{{ $b->id }}" {{ $index === 0 ? 'selected' : '' }}>{{ $b->name }}</option>
                                @endforeach
                                <option value="all">All Lead Buckets</option>
                            </select>
                            <a href="{{ route('modern.leads.index') }}" class="btn btn-sm btn-light-brand">
                                <i class="feather-external-link me-1"></i> Open Leads
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        {{-- Sub-Status Board Grid --}}
                        <div class="db-kanban-wrapper">
                            <div class="db-subkanban-board" id="dbSubKanbanBoard">

                                @foreach($buckets as $bucket)
                                    @php
                                        $dbTheme   = dbKanbanTheme($bucket->name);
                                        $children  = $bucket->children ?? collect();
                                    @endphp

                                    @if($children->isNotEmpty())
                                        @foreach($children as $child)
                                            @php
                                                $cLeads = $kanbanSubStatusLeads[$bucket->id][$child->id] ?? collect();
                                            @endphp
                                            <div class="db-kanban-col db-theme-{{ $dbTheme }} db-subkanban-col"
                                                 id="dbSubKCol-{{ $bucket->id }}-{{ $child->id }}"
                                                 data-bucket-id="{{ $bucket->id }}"
                                                 data-bucket-name="{{ $bucket->name }}"
                                                 data-sub-status="{{ $child->name }}"
                                                 data-child-id="{{ $child->id }}">

                                                {{-- Header --}}
                                                <a href="{{ route('modern.leads.index', ['bucket_id' => $bucket->id, 'lead_status' => $child->name]) }}" class="db-kanban-col-header text-decoration-none" title="{{ $child->name }} ({{ $bucket->name }})">
                                                    <div class="d-flex flex-column overflow-hidden">
                                                        <span class="db-kanban-col-title" title="{{ $child->name }}">{{ $child->name }}</span>
                                                        <span style="font-size:9.5px;opacity:0.75;font-weight:600;" class="text-truncate">{{ $bucket->name }}</span>
                                                    </div>
                                                    <span class="db-kanban-col-count" id="dbKSubColCount-{{ $bucket->id }}-{{ $child->id }}">{{ $cLeads->count() }}</span>
                                                </a>

                                                {{-- Body --}}
                                                <div class="db-kanban-col-body db-sub-dropzone {{ $cLeads->isEmpty() ? 'no-leads' : 'has-leads' }}"
                                                     id="dbSubKanbanBody-{{ $bucket->id }}-{{ $child->id }}"
                                                     data-bucket-id="{{ $bucket->id }}"
                                                     data-bucket-name="{{ $bucket->name }}"
                                                     data-sub-status="{{ $child->name }}"
                                                     data-child-id="{{ $child->id }}">
                                                    @if($cLeads->isEmpty())
                                                        <div class="db-kanban-empty">
                                                            <i class="fas fa-layer-group"></i>
                                                            Drop leads here
                                                        </div>
                                                    @else
                                                        @foreach($cLeads as $kl)
                                                            @php
                                                                $kEng = strtolower(trim($kl->lead_engagement_status ?? 'n/a'));
                                                                $kStarHtml = match($kEng) {
                                                                    'hot'  => '<span class="db-star-wrap text-warning" title="Hot (3 Stars)"><i class="fas fa-star" style="font-size:9px;"></i><i class="fas fa-star" style="font-size:9px;"></i><i class="fas fa-star" style="font-size:9px;"></i></span>',
                                                                    'warm' => '<span class="db-star-wrap text-warning" title="Warm (2 Stars)"><i class="fas fa-star" style="font-size:9px;"></i><i class="fas fa-star" style="font-size:9px;"></i></span>',
                                                                    'cold' => '<span class="db-star-wrap text-warning" title="Cold (1 Star)"><i class="fas fa-star" style="font-size:9px;"></i></span>',
                                                                    'dead' => '<span class="db-star-wrap text-danger" title="Dead (Red Star)"><i class="fas fa-star" style="font-size:9px;"></i></span>',
                                                                    default => '<span class="text-muted" style="font-size:9.5px;font-weight:600;">N/A</span>',
                                                                };
                                                                $kBadgeBg = match($kEng) {
                                                                    'hot', 'warm', 'cold' => 'background:#fff8e1; border:1px solid #ffe082;',
                                                                    'dead'  => 'background:#ffebee; border:1px solid #ffcdd2;',
                                                                    default => 'background:#f0f4f8; border:1px solid #e2e8f0;',
                                                                };
                                                            @endphp
                                                            <div class="db-kcard"
                                                                 draggable="true"
                                                                 data-lead-id="{{ $kl->id }}"
                                                                 data-bucket-id="{{ $bucket->id }}"
                                                                 data-sub-status="{{ $child->name }}"
                                                                 id="dbSubKCard-{{ $kl->id }}">

                                                                {{-- Name + Edit Button --}}
                                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                                    <span class="db-kc-name fw-bold text-dark" style="font-size: 13px;">{{ optional($kl->user)->name ?? 'Unknown' }}</span>
                                                                    <a href="javascript:void(0);" class="d-inline-flex align-items-center justify-content-center rounded p-1" style="background: #eff6ff; border: 1px solid #dbeafe; color: #006FC9; text-decoration: none;" title="Edit Lead Form" data-lead="{{ json_encode($kl ?? []) }}" data-user="{{ json_encode($kl->user ?? []) }}" onclick="event.stopPropagation(); openEditModal(this);">
                                                                        <i class="fa-solid fa-pen-to-square" style="font-size: 13px;"></i>
                                                                    </a>
                                                                </div>

                                                                {{-- Phone --}}
                                                                <div class="db-kc-phone mb-1">
                                                                    <i class="fas fa-phone-alt" style="font-size:9px;color:#90a4ae;margin-right:3px;"></i>
                                                                    {{ optional($kl->user)->contact_no ?? 'N/A' }}
                                                                </div>

                                                                {{-- Direct 3-Star Rating Widget (No Dropdown) --}}
                                                                <div class="db-kc-badges position-relative mb-1">
                                                                    <div class="db-star-rating-bar d-inline-flex align-items-center gap-1" onclick="event.stopPropagation();" style="padding: 2px 6px; border-radius: 12px; {{ $kEng === 'dead' ? 'background: #ffebee; border: 1px solid #ffcdd2;' : 'background: #fff8e1; border: 1px solid #ffe082;' }}">
                                                                        @if($kEng === 'dead')
                                                                            {{-- 3 Red Stars for DEAD + Cross --}}
                                                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement({{ $kl->id }}, 'cold', this)" title="Set Cold (1 Star)"></i>
                                                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement({{ $kl->id }}, 'warm', this)" title="Set Warm (2 Stars)"></i>
                                                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement({{ $kl->id }}, 'hot', this)" title="Set Hot (3 Stars)"></i>
                                                                            <i class="fas fa-times-circle db-star-btn text-danger ms-1" style="font-size:11px; cursor:pointer; opacity:0.9;" onclick="dbChangeEngagement({{ $kl->id }}, 'dead', this)" title="Dead"></i>
                                                                        @else
                                                                            {{-- 3 Stars (1 Cold, 2 Warm, 3 Hot) + Cross --}}
                                                                            <i class="{{ $kEng === 'hot' || $kEng === 'warm' || $kEng === 'cold' ? 'fas fa-star text-warning' : 'far fa-star text-muted' }} db-star-btn" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement({{ $kl->id }}, 'cold', this)" title="Set Cold (1 Star)"></i>
                                                                            <i class="{{ $kEng === 'hot' || $kEng === 'warm' ? 'fas fa-star text-warning' : 'far fa-star text-muted' }} db-star-btn" style="font-size:10px; cursor:pointer; opacity: {{ $kEng === 'cold' ? '0.4' : '1' }};" onclick="dbChangeEngagement({{ $kl->id }}, 'warm', this)" title="Set Warm (2 Stars)"></i>
                                                                            <i class="{{ $kEng === 'hot' ? 'fas fa-star text-warning' : 'far fa-star text-muted' }} db-star-btn" style="font-size:10px; cursor:pointer; opacity: {{ $kEng === 'hot' ? '1' : '0.4' }};" onclick="dbChangeEngagement({{ $kl->id }}, 'hot', this)" title="Set Hot (3 Stars)"></i>
                                                                            <i class="fas fa-times-circle db-star-btn text-muted ms-1" style="font-size:11px; cursor:pointer; opacity:0.4;" onclick="dbChangeEngagement({{ $kl->id }}, 'dead', this)" title="Set Dead"></i>
                                                                        @endif
                                                                    </div>
                                                                    @if($kl->product)
                                                                        <span class="db-kc-badge db-kc-badge-prod ms-1">{{ $kl->product }}</span>
                                                                    @endif
                                                                </div>

                                                                {{-- Owner --}}
                                                                <div class="db-kc-owner text-muted mb-1" style="font-size:10.5px;">
                                                                    <i class="fas fa-user-tie text-secondary me-1" style="font-size:9.5px;"></i>
                                                                    Owner: <span class="fw-semibold text-dark">{{ optional($kl->owner)->name ?? 'Unassigned' }}</span>
                                                                </div>

                                                                {{-- Created date --}}
                                                                <div class="db-kc-date" style="font-size: 10px;">
                                                                    <i class="fas fa-calendar-alt" style="font-size:9px;"></i>
                                                                    Create On {{ \Carbon\Carbon::parse($kl->created_at)->format('d M Y h:i A') }}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    {{-- Converted Lead Column (Read Only) --}}
                                    @php
                                        $cConvLeads = $kanbanConvertedLeads[$bucket->id] ?? collect();
                                    @endphp
                                    <div class="db-kanban-col db-subkanban-col db-converted-col"
                                         id="dbSubKCol-{{ $bucket->id }}-converted"
                                         data-bucket-id="{{ $bucket->id }}"
                                         data-bucket-name="{{ $bucket->name }}"
                                         data-sub-status="Converted Lead"
                                         data-child-id="converted"
                                         style="border: 1.5px solid #86efac; background: #f0fdf4;">

                                        {{-- Header --}}
                                        <a href="{{ route('modern.leads.index', ['bucket_id' => $bucket->id, 'converted' => 1]) }}" class="db-kanban-col-header text-decoration-none" style="background: #dcfce7;" title="Converted Leads ({{ $bucket->name }})">
                                            <div class="d-flex flex-column overflow-hidden">
                                                <span class="db-kanban-col-title text-success" title="Converted Lead">
                                                    <i class="fas fa-check-circle me-1"></i> Converted Lead
                                                </span>
                                                <span style="font-size:9.5px;opacity:0.75;font-weight:600;" class="text-truncate text-success">{{ $bucket->name }} (Read Only)</span>
                                            </div>
                                            <span class="db-kanban-col-count bg-success text-white" id="dbKSubColCount-{{ $bucket->id }}-converted">{{ $cConvLeads->count() }}</span>
                                        </a>

                                        {{-- Body (Read-Only: No db-sub-dropzone class) --}}
                                        <div class="db-kanban-col-body {{ $cConvLeads->isEmpty() ? 'no-leads' : 'has-leads' }}"
                                             id="dbSubKanbanBody-{{ $bucket->id }}-converted"
                                             data-bucket-id="{{ $bucket->id }}"
                                             data-bucket-name="{{ $bucket->name }}"
                                             data-sub-status="Converted Lead"
                                             data-child-id="converted">
                                            @if($cConvLeads->isEmpty())
                                                <div class="db-kanban-empty text-success opacity-75">
                                                    <i class="fas fa-check-double mb-1 d-block"></i>
                                                    No converted leads
                                                </div>
                                            @else
                                                @foreach($cConvLeads as $kl)
                                                    @php
                                                        $kEng = strtolower(trim($kl->lead_engagement_status ?? 'n/a'));
                                                    @endphp
                                                    <div class="db-kcard border-success-subtle bg-white"
                                                         draggable="false"
                                                         data-lead-id="{{ $kl->id }}"
                                                         data-bucket-id="{{ $bucket->id }}"
                                                         data-sub-status="Converted Lead"
                                                         id="dbSubKCard-{{ $kl->id }}">

                                                        {{-- Name + Edit Button --}}
                                                        <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                            <span class="db-kc-name fw-bold text-dark" style="font-size: 13px;">{{ optional($kl->user)->name ?? 'Unknown' }}</span>
                                                            <a href="javascript:void(0);" class="d-inline-flex align-items-center justify-content-center rounded p-1" style="background: #eff6ff; border: 1px solid #dbeafe; color: #006FC9; text-decoration: none;" title="Edit Lead Form" data-lead="{{ json_encode($kl ?? []) }}" data-user="{{ json_encode($kl->user ?? []) }}" onclick="event.stopPropagation(); openEditModal(this);">
                                                                <i class="fa-solid fa-pen-to-square" style="font-size: 13px;"></i>
                                                            </a>
                                                        </div>

                                                        {{-- Phone --}}
                                                        <div class="db-kc-phone mb-1">
                                                            <i class="fas fa-phone-alt" style="font-size:9px;color:#90a4ae;margin-right:3px;"></i>
                                                            {{ optional($kl->user)->contact_no ?? 'N/A' }}
                                                        </div>

                                                        {{-- Badges --}}
                                                        <div class="db-kc-badges position-relative mb-1 d-flex align-items-center gap-1 flex-wrap">
                                                            <span class="badge bg-success text-white" style="font-size:10px;">
                                                                <i class="fas fa-check-circle me-1"></i>Converted
                                                            </span>
                                                            @if($kl->product)
                                                                <span class="db-kc-badge db-kc-badge-prod">{{ $kl->product }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- Owner --}}
                                                        <div class="db-kc-owner text-muted mb-1" style="font-size:10.5px;">
                                                            <i class="fas fa-user-tie text-secondary me-1" style="font-size:9.5px;"></i>
                                                            Owner: <span class="fw-semibold text-dark">{{ optional($kl->owner)->name ?? 'Unassigned' }}</span>
                                                        </div>

                                                        {{-- Created date --}}
                                                        <div class="db-kc-date" style="font-size: 10px;">
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

                        {{-- Sub-Status Drag & Drop JS --}}
                        <script>
                        function dbFilterSubKanban(bucketId) {
                            document.querySelectorAll('.db-subkanban-col').forEach(col => {
                                if (bucketId === 'all' || col.dataset.bucketId === String(bucketId)) {
                                    col.style.display = 'flex';
                                } else {
                                    col.style.display = 'none';
                                }
                            });
                        }

                        (function () {
                            const initialFilter = document.getElementById('dbSubKanbanFilter')?.value;
                            if (initialFilter) {
                                dbFilterSubKanban(initialFilter);
                            }

                            const dragBase  = "{{ url('/modern-leads/drag-update') }}";
                            const csrf      = "{{ csrf_token() }}";
                            let subDragged  = null;
                            let srcSubCol   = null;

                            function attachSubCard(card) {
                                card.addEventListener('dragstart', function(e) {
                                    subDragged = this;
                                    srcSubCol  = this.closest('.db-subkanban-col');
                                    setTimeout(() => this.classList.add('dragging'), 0);
                                    e.dataTransfer.effectAllowed = 'move';
                                    e.dataTransfer.setData('text/plain', this.dataset.leadId);
                                });
                                card.addEventListener('dragend', function() {
                                    this.classList.remove('dragging');
                                    document.querySelectorAll('.db-subkanban-col').forEach(c => c.classList.remove('drag-over'));
                                    subDragged = null; srcSubCol = null;
                                });
                            }

                            function attachSubCol(col) {
                                col.addEventListener('dragover', function(e) {
                                    e.preventDefault(); this.classList.add('drag-over');
                                });
                                col.addEventListener('dragleave', function() {
                                    this.classList.remove('drag-over');
                                });
                                col.addEventListener('drop', function(e) {
                                    e.preventDefault();
                                    this.classList.remove('drag-over');

                                    if (!subDragged || !srcSubCol || col === srcSubCol) return;

                                    const tBucketId   = this.dataset.bucketId;
                                    const tBucketName = this.dataset.bucketName;
                                    const tSubStatus  = this.dataset.subStatus;
                                    const tChildId    = this.dataset.childId;
                                    const leadId      = e.dataTransfer.getData('text/plain');

                                    const sBucketId = srcSubCol.dataset.bucketId;
                                    const sChildId  = srcSubCol.dataset.childId;

                                    const body = this.querySelector('.db-kanban-col-body');
                                    const emptyEl = body.querySelector('.db-kanban-empty');
                                    if (emptyEl) emptyEl.remove();

                                    body.classList.remove('no-leads');
                                    body.classList.add('has-leads');

                                    body.appendChild(subDragged);
                                    subDragged.dataset.bucketId  = tBucketId;
                                    subDragged.dataset.subStatus = tSubStatus;

                                    // Source column empty?
                                    const srcBody = srcSubCol.querySelector('.db-kanban-col-body');
                                    if (srcBody && srcBody.querySelectorAll('.db-kcard').length === 0) {
                                        srcBody.classList.remove('has-leads');
                                        srcBody.classList.add('no-leads');
                                        srcBody.innerHTML = `<div class="db-kanban-empty"><i class="fas fa-layer-group"></i>Drop leads here</div>`;
                                    }

                                    // Update Sub-Status Counts
                                    const srcSubCount = document.querySelector(`#dbKSubColCount-${sBucketId}-${sChildId}`);
                                    const tgtSubCount = document.querySelector(`#dbKSubColCount-${tBucketId}-${tChildId}`);
                                    if (srcSubCount) srcSubCount.textContent = Math.max(0, parseInt(srcSubCount.textContent) - 1);
                                    if (tgtSubCount) tgtSubCount.textContent = parseInt(tgtSubCount.textContent) + 1;

                                    // Also update Top Main Status Counts if Bucket changed
                                    if (sBucketId !== tBucketId) {
                                        const srcMainCount = document.querySelector(`#dbKColCount-${sBucketId}`);
                                        const tgtMainCount = document.querySelector(`#dbKColCount-${tBucketId}`);
                                        if (srcMainCount) srcMainCount.textContent = Math.max(0, parseInt(srcMainCount.textContent) - 1);
                                        if (tgtMainCount) tgtMainCount.textContent = parseInt(tgtMainCount.textContent) + 1;
                                    }

                                    // AJAX Update
                                    fetch(`${dragBase}/${leadId}`, {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                                        body: JSON.stringify({ lead_bucket_id: parseInt(tBucketId), lead_status: tSubStatus }),
                                    })
                                    .then(r => r.json())
                                    .then(d => dbShowToast(d.success ? `✅ Sub-status updated to <strong>${tSubStatus}</strong>` : '❌ Failed', d.success ? 'success' : 'danger'))
                                    .catch(() => dbShowToast('❌ Network error.', 'danger'));
                                });
                            }

                            document.querySelectorAll('#dbSubKanbanBoard .db-kcard').forEach(attachSubCard);
                            document.querySelectorAll('#dbSubKanbanBoard .db-subkanban-col').forEach(attachSubCol);

                            window.dbChangeEngagement = function(leadId, newStatus, element) {
                                const dragBase  = "{{ url('/modern-leads/drag-update') }}";
                                const csrf      = "{{ csrf_token() }}";
                                const container = element.closest('.db-star-rating-bar');
                                const st        = newStatus.toLowerCase();

                                if (container) {
                                    if (st === 'dead') {
                                        container.style.cssText = "padding: 2px 6px; border-radius: 12px; background: #ffebee; border: 1px solid #ffcdd2;";
                                        container.innerHTML = `
                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement(${leadId}, 'cold', this)" title="Set Cold (1 Star)"></i>
                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement(${leadId}, 'warm', this)" title="Set Warm (2 Stars)"></i>
                                            <i class="fas fa-star db-star-btn text-danger" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement(${leadId}, 'hot', this)" title="Set Hot (3 Stars)"></i>
                                            <i class="fas fa-times-circle db-star-btn text-danger ms-1" style="font-size:11px; cursor:pointer; opacity:0.9;" onclick="dbChangeEngagement(${leadId}, 'dead', this)" title="Dead"></i>
                                        `;
                                    } else {
                                        container.style.cssText = "padding: 2px 6px; border-radius: 12px; background: #fff8e1; border: 1px solid #ffe082;";
                                        const s1Class = 'fas fa-star text-warning';
                                        const s2Class = (st === 'hot' || st === 'warm') ? 'fas fa-star text-warning' : 'far fa-star text-muted';
                                        const s3Class = (st === 'hot') ? 'fas fa-star text-warning' : 'far fa-star text-muted';
                                        const s2Op = (st === 'cold') ? '0.4' : '1';
                                        const s3Op = (st === 'hot') ? '1' : '0.4';

                                        container.innerHTML = `
                                            <i class="${s1Class} db-star-btn" style="font-size:10px; cursor:pointer;" onclick="dbChangeEngagement(${leadId}, 'cold', this)" title="Set Cold (1 Star)"></i>
                                            <i class="${s2Class} db-star-btn" style="font-size:10px; cursor:pointer; opacity:${s2Op};" onclick="dbChangeEngagement(${leadId}, 'warm', this)" title="Set Warm (2 Stars)"></i>
                                            <i class="${s3Class} db-star-btn" style="font-size:10px; cursor:pointer; opacity:${s3Op};" onclick="dbChangeEngagement(${leadId}, 'hot', this)" title="Set Hot (3 Stars)"></i>
                                            <i class="fas fa-times-circle db-star-btn text-muted ms-1" style="font-size:11px; cursor:pointer; opacity:0.4;" onclick="dbChangeEngagement(${leadId}, 'dead', this)" title="Set Dead"></i>
                                        `;
                                    }
                                }

                                fetch(`${dragBase}/${leadId}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({ lead_engagement_status: newStatus })
                                })
                                .then(r => r.json())
                                .then(d => {
                                    if (typeof dbShowToast === 'function') {
                                        dbShowToast(d.success ? `✅ Engagement updated to <strong>${newStatus.toUpperCase()}</strong>` : '❌ Failed', d.success ? 'success' : 'danger');
                                    }
                                })
                                .catch(() => {
                                    if (typeof dbShowToast === 'function') {
                                        dbShowToast('❌ Network error.', 'danger');
                                    }
                                });
                            };

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
            <div class="col-xxl-12">
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

            document.querySelectorAll('#dbKanbanBoard .db-kcard').forEach(attachCard);
            document.querySelectorAll('#dbKanbanBoard .db-kanban-col').forEach(attachCol);

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

    {{-- ADD/EDIT LEAD FORM MODAL --}}
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
    <style>
        #pain_points_editor {
            height: 220px !important;
            background-color: #fff;
            border: 1px solid #cbd5e1;
            border-top: none;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        #pain_points_editor .ql-editor {
            font-size: 13px;
            color: #334155;
        }
        .ql-toolbar.ql-snow {
            border: 1px solid #cbd5e1 !important;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            background-color: #f8fafc;
        }
        #inp_services + .select2-container .select2-selection--multiple {
            max-height: 75px;
            overflow-y: auto !important;
        }
        .contact-card {
            background: #fdfdfd;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 12px;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        .contact-card:hover {
            border-color: #006FC9;
            box-shadow: 0 4px 12px rgba(0, 111, 201, 0.08);
            transform: translateY(-1px);
        }
        .contact-card .btn-remove-contact {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(220, 53, 69, 0.05);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.1);
            transition: all 0.2s ease;
            cursor: pointer;
        }
    </style>

    <div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold text-dark" id="leadModalTitle">
                        <i class="feather-user text-primary me-2"></i> <span>Edit Lead</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="leadForm" method="POST" enctype="multipart/form-data" action="{{ route('lead.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="modal-body p-3 bg-white" style="max-height: 65vh; overflow-y: auto;">
                        <!-- Upper Section: Side-by-Side Left and Right Columns -->
                        <div class="row">
                            <!-- Left Column: Client Details -->
                            <div class="col-lg-6 border-end pe-3">
                                <h6 class="fw-bold mb-2 text-primary border-bottom pb-1">Client Details</h6>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Client Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="inp_name" class="form-control form-control-sm auto-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Mobile <span class="text-danger">*</span></label>
                                        <input type="tel" name="mobile" id="inp_mobile" class="form-control form-control-sm phone-input" required>
                                        <input type="hidden" name="country_code" id="inp_country_code" class="country-code-input">
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Email</label>
                                        <input type="email" name="email" id="inp_email" class="form-control form-control-sm auto-email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Company Name</label>
                                        <input type="text" name="business_name" id="inp_business" class="form-control form-control-sm" placeholder="Company Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">City</label>
                                        <input type="text" name="city" id="inp_city" class="form-control form-control-sm auto-city" placeholder="City">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">State</label>
                                        <input type="text" name="state" id="inp_state" class="form-control form-control-sm" placeholder="State">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">Pincode</label>
                                        <input type="text" name="pincode" id="inp_pincode" class="form-control form-control-sm" placeholder="Pincode / Zip">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label-sm">Address</label>
                                        <textarea name="address" id="inp_address" class="form-control form-control-sm" rows="2" placeholder="Full Street Address..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Employee Strength</label>
                                        <select name="employee_strength" id="inp_employee_strength" class="form-select form-select-sm">
                                            <option value="">Select Strength</option>
                                            <option value="1-10 employees">1-10 employees</option>
                                            <option value="11-50 employees">11-50 employees</option>
                                            <option value="51-200 employees">51-200 employees</option>
                                            <option value="201-500 employees">201-500 employees</option>
                                            <option value="500+ employees">500+ employees</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Industry</label>
                                        <select name="industry" id="inp_industry" class="form-select form-select-sm">
                                            <option value="">Select Industry</option>
                                            <option value="IT & Technology">IT & Technology</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Finance & Banking">Finance & Banking</option>
                                            <option value="Education">Education</option>
                                            <option value="Real Estate">Real Estate</option>
                                            <option value="Retail & E-commerce">Retail & E-commerce</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Professional Services">Professional Services</option>
                                            <option value="Marketing & Advertising">Marketing & Advertising</option>
                                            <option value="Logistics & Transportation">Logistics & Transportation</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Website</label>
                                        <input type="text" name="website" id="inp_website" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">GST NO.</label>
                                        <input type="text" name="gst_number" id="inp_gst" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <!-- Additional Contacts (Cloned) under Client Details -->
                                <div class="mt-4 border-top pt-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.9rem;">Additional Contacts</h6>
                                            <span id="contactCountBadge" class="badge bg-soft-primary text-primary rounded-pill px-2 py-0.5" style="font-size: 0.75rem; line-height: 1;">0</span>
                                        </div>
                                        <button type="button" id="btnAddContact" class="btn btn-xs text-white d-flex align-items-center gap-1 fw-medium" style="background-color: #006FC9; font-size: 0.75rem; padding: 0.25rem 0.5rem; border: none; transition: background-color 0.2s ease;">
                                            <i class="feather-plus"></i> Clone Contact
                                        </button>
                                    </div>
                                    <div id="clonedContactsContainer" class="mt-2"></div>
                                </div>
                            </div>

                            <!-- Right Column: Lead Details -->
                            <div class="col-lg-6 ps-3">
                                <h6 class="fw-bold mb-2 text-primary border-bottom pb-1">Lead Details</h6>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Lead Source</label>
                                        <select name="platform" id="inp_platform" class="form-select form-select-sm">
                                            <option value="">Select Source</option>
                                            @foreach($sources ?? [] as $source)
                                                <option value="{{ $source }}">{{ $source }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Lead Owner</label>
                                        <select name="lead_owner" id="inp_owner" class="form-select form-select-sm">
                                            <option value="">Select Owner</option>
                                            @foreach($owners ?? [] as $owner)
                                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Budget</label>
                                        <input type="text" name="budget" id="inp_budget" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Choose Product</label>
                                        <select name="product" id="inp_product" class="form-select form-select-sm">
                                            <option value="">Select Product</option>
                                            <option value="SAAS">SAAS</option>
                                            <option value="SAAP">SAAP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-12">
                                        <label class="form-label-sm">Service</label>
                                        <select name="services[]" id="inp_services" class="form-select" data-select2-selector="label" multiple>
                                            @foreach($categorys ?? [] as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <label class="form-label-sm">Pain Points & Current System</label>
                                        <div id="pain_points_editor" style="height: 150px;"></div>
                                        <input type="hidden" name="pain_points" id="inp_pain_points">
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label-sm fw-bold text-dark">Upload Documents</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light"><i class="feather-paperclip"></i></span>
                                            <input type="file" name="documents[]" id="inp_documents" class="form-control form-control-sm" multiple>
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Select multiple files if needed (PDF, DOC, DOCX, JPG, PNG).</small>
                                        <div id="existing_documents_container" class="mt-2 d-flex flex-wrap gap-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light mx-n4 mb-n4 px-4 py-3 mt-4 border-top">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnSubmit" class="btn text-white px-4 fw-medium"
                            style="background-color: #006FC9;">Update Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        let contactIndex = 0;

        function updateContactCount() {
            const container = document.getElementById('clonedContactsContainer');
            const badge = document.getElementById('contactCountBadge');
            if (container && badge) {
                const count = container.querySelectorAll('.contact-card').length;
                badge.innerText = count;
            }
        }

        function addContactRow(data = {}) {
            const container = document.getElementById('clonedContactsContainer');
            if (!container) return;

            const wrapper = document.createElement('div');
            wrapper.className = 'contact-card';
            
            wrapper.innerHTML = `
                <button type="button" class="btn-remove-contact" title="Remove Contact">
                    <i class="feather-trash-2 fs-12"></i>
                </button>
                <div class="row g-2 pe-4">
                    <div class="col-6">
                        <label class="form-label-sm">Name</label>
                        <input type="text" name="cloned_contacts[${contactIndex}][name]" class="form-control form-control-sm" placeholder="Contact Name" value="${data.name || ''}">
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Designation</label>
                        <input type="text" name="cloned_contacts[${contactIndex}][designation]" class="form-control form-control-sm" placeholder="Designation" value="${data.designation || ''}">
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Email</label>
                        <input type="email" name="cloned_contacts[${contactIndex}][email]" class="form-control form-control-sm" placeholder="Email" value="${data.email || ''}">
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Phone Number</label>
                        <input type="tel" name="cloned_contacts[${contactIndex}][phone]" class="form-control form-control-sm cloned-phone-input" placeholder="Phone Number" value="${data.phone || ''}">
                    </div>
                </div>
            `;

            const phoneInput = wrapper.querySelector('.cloned-phone-input');
            phoneInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            const removeBtn = wrapper.querySelector('.btn-remove-contact');
            removeBtn.addEventListener('click', function() {
                wrapper.remove();
                updateContactCount();
            });

            container.appendChild(wrapper);
            contactIndex++;
            updateContactCount();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btnAddContact = document.getElementById('btnAddContact');
            if (btnAddContact) {
                btnAddContact.addEventListener('click', function() {
                    addContactRow();
                });
            }

            if (document.getElementById('pain_points_editor')) {
                window.painPointsQuill = new Quill('#pain_points_editor', {
                    theme: 'snow',
                    placeholder: 'Enter Pain Points & Current System...'
                });
            }

            const leadForm = document.getElementById('leadForm');
            if (leadForm) {
                leadForm.addEventListener('submit', function(e) {
                    if (window.painPointsQuill) {
                        const html = window.painPointsQuill.root.innerHTML;
                        if (html === '<p><br></p>' || html.trim() === '') {
                            document.getElementById('inp_pain_points').value = '';
                        } else {
                            document.getElementById('inp_pain_points').value = html;
                        }
                    }
                });
            }
        });

        function openEditModal(button) {
            let lead = JSON.parse(button.getAttribute('data-lead') || '{}');
            let user = JSON.parse(button.getAttribute('data-user') || '{}');

            let updateUrl = "{{ url('/lead/update') }}/" + lead.id;
            document.getElementById('leadForm').action = updateUrl;
            document.getElementById('formMethod').value = "PUT";

            document.querySelector('#leadModalTitle span').innerText = "Edit Lead: " + (user.name || 'Unknown');
            document.getElementById('btnSubmit').innerText = "Update Lead";

            document.getElementById('inp_mobile').value = user.contact_no || '';
            document.getElementById('inp_country_code').value = user.country_code || '';
            document.getElementById('inp_name').value = user.name || '';
            document.getElementById('inp_email').value = user.email || '';
            document.getElementById('inp_city').value = lead.city || user.city || '';
            document.getElementById('inp_state').value = lead.state || '';
            document.getElementById('inp_pincode').value = lead.pincode || '';
            document.getElementById('inp_address').value = lead.address || '';

            document.getElementById('inp_platform').value = lead.platform || '';
            document.getElementById('inp_owner').value = lead.lead_owner || '';
            document.getElementById('inp_budget').value = lead.budget || '';

            document.getElementById('inp_employee_strength').value = lead.employee_strength || '';
            document.getElementById('inp_industry').value = lead.industry || '';
            document.getElementById('inp_website').value = lead.website || '';
            document.getElementById('inp_business').value = lead.business_name || '';
            document.getElementById('inp_gst').value = lead.gst_number || '';
            
            document.getElementById('inp_product').value = lead.product || lead.applying_country_for_a_visa || '';
            
            let painPointsVal = lead.pain_points || lead.description || '';
            document.getElementById('inp_pain_points').value = painPointsVal;
            if (window.painPointsQuill) {
                window.painPointsQuill.root.innerHTML = painPointsVal;
            }

            let editDocsInput = document.getElementById('inp_documents');
            if (editDocsInput) editDocsInput.value = '';
            let editDocsContainer = document.getElementById('existing_documents_container');
            if (editDocsContainer) {
                editDocsContainer.innerHTML = '';
                let docs = [];
                if (lead.documents) {
                    try {
                        docs = typeof lead.documents === 'string' ? JSON.parse(lead.documents) : lead.documents;
                    } catch (e) {
                        docs = [];
                    }
                }
                if (Array.isArray(docs) && docs.length > 0) {
                    let html = '';
                    docs.forEach(doc => {
                        let docPath = typeof doc === 'object' ? (doc.path || '') : doc;
                        let docName = typeof doc === 'object' ? (doc.name || docPath.split('/').pop()) : docPath.split('/').pop();
                        let assetUrl = "{{ asset('storage') }}/" + docPath;
                        html += `<a href="${assetUrl}" target="_blank" class="badge bg-light text-dark p-1 border d-inline-flex align-items-center gap-1 text-decoration-none" style="font-size:0.75rem;">
                            <i class="feather-file-text text-primary"></i>
                            <span>${docName}</span>
                            <i class="feather-download text-muted"></i>
                        </a>`;
                    });
                    editDocsContainer.innerHTML = html;
                }
            }

            let servicesSelect = document.getElementById('inp_services');
            if (servicesSelect) {
                Array.from(servicesSelect.options).forEach(opt => opt.selected = false);
                let selectedServices = [];
                if (lead.services) {
                    try {
                        selectedServices = typeof lead.services === 'string' ? JSON.parse(lead.services) : lead.services;
                    } catch (e) {
                        selectedServices = lead.services.split(',');
                    }
                }
                if (Array.isArray(selectedServices)) {
                    selectedServices.forEach(srv => {
                        let opt = Array.from(servicesSelect.options).find(o => o.value === srv.trim());
                        if (opt) opt.selected = true;
                    });
                }
                if (typeof $ !== 'undefined' && $.fn.select2) {
                    $(servicesSelect).trigger('change');
                }
            }

            const container = document.getElementById('clonedContactsContainer');
            if (container) container.innerHTML = '';
            contactIndex = 0;
            
            let clonedContacts = [];
            if (lead.client_details) {
                try {
                    clonedContacts = typeof lead.client_details === 'string'
                        ? JSON.parse(lead.client_details)
                        : lead.client_details;
                } catch (e) {
                    clonedContacts = [];
                }
            }
            if (Array.isArray(clonedContacts)) {
                clonedContacts.forEach(contact => {
                    addContactRow(contact);
                });
            }
            updateContactCount();

            var myModal = new bootstrap.Modal(document.getElementById('leadModal'));
            myModal.show();
        }
    </script>
@endsection