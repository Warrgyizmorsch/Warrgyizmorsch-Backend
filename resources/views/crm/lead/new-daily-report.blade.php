@extends('layouts.app')

@section('content')

    <style>
        .table-responsive {
            overflow-x: auto;
            max-height: 70vh;
        }

        .table thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            z-index: 10;
            font-weight: 600;
            color: #333;
        }

        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .report-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .report-section h5 {
            color: #2c3e50;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .stat-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background: #f0f2f5;
            color: #333;
        }

        .stat-value {
            color: #007bff;
            font-weight: 700;
            font-size: 18px;
        }

        .table-sm th,
        .table-sm td {
            padding: 10px;
            vertical-align: middle;
        }

        .user-filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #999;
        }

        .transition-badge {
            font-size: 12px;
            padding: 4px 8px;
        }

        .record-row {
            border-left: 3px solid #007bff;
            background: #f8f9ff;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 4px;
        }

        .optional-cell {
            background: #fff3cd;
            font-style: italic;
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
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseDailyReportFilter">
                            <i class="feather-filter"></i>Filter
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters Section --}}
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

                    <!-- User Filter -->
                    <div class="col-md-3">
                        <label class="form-label">User</label>
                        <select name="user_id" id="user-filter" class="form-control">
                            <option value="">All Users</option>
                            @php
                                $allUserIds = array_keys($final);
                            @endphp
                            @foreach($allUserIds as $userId)
                                <option value="{{ $userId }}" {{ request('user_id') == $userId ? 'selected' : '' }}>
                                    @if($userImages[$userId] ?? null)
                                        📷 {{ $final[$userId]['name'] }}
                                    @else
                                        {{ $final[$userId]['name'] }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

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
        <div class="main-content mt-4">

            @php
                $selectedUserId = request('user_id');
                $displayData = [];

                if ($selectedUserId && isset($final[$selectedUserId])) {
                    $displayData[$selectedUserId] = $final[$selectedUserId];
                } else {
                    $displayData = $final;
                }
            @endphp

            @forelse($displayData as $userId => $row)

                {{-- ===== DAILY REPORT SECTION ===== --}}
                <div class="report-section">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        @if($userImages[$userId] ?? null)
                            <img src="{{ asset('storage/' . $userImages[$userId]) }}" alt="{{ $row['name'] }}"
                                class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #007bff;">
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; font-weight: bold; font-size: 18px;">
                                {{ substr($row['name'], 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-0">{{ $row['name'] }}'s Daily Report</h5>
                            <small class="text-muted">Lead Performance Summary</small>
                        </div>
                    </div>

                    {{-- Summary Stats --}}
                    <div class="table-responsive mb-4">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 25%;">
                                        <i class="bi bi-graph-up me-1 text-success"></i>Total
                                    </th>
                                    <th class="text-center" style="width: 25%;">
                                        <i class="bi bi-fire me-1 text-danger"></i>Hot
                                    </th>
                                    <th class="text-center" style="width: 25%;">
                                        <i class="bi bi-thermometer-half me-1 text-warning"></i>Warm
                                    </th>
                                    <th class="text-center" style="width: 25%;">
                                        <i class="bi bi-snow me-1 text-info"></i>Cold
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <div class="stat-value" style="color: #28a745; font-size: 24px;">
                                            {{ $row['total'] }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value" style="color: #dc3545; font-size: 24px;">
                                            {{ $row['engagement']['hot'] ?? 0 }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value" style="color: #ffc107; font-size: 24px;">
                                            {{ $row['engagement']['warm'] ?? 0 }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value" style="color: #17a2b8; font-size: 24px;">
                                            {{ $row['engagement']['cold'] ?? 0 }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Lead Status Table --}}
                    <h6 class="mb-3">Lead Status Breakdown</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Status Category</th>
                                    <th class="text-center">Count</th>
                                    <th>Sub-Status Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($row['statuses'] as $bucket => $bucketData)
                                    @if($bucketData['count'] > 0)
                                        <tr>
                                            <td>
                                                <strong>{{ $bucket }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge
                                                                                    @if($bucket == 'Converted') bg-success
                                                                                    @elseif($bucket == 'Lost') bg-danger
                                                                                    @elseif($bucket == 'Counselling in Progress') bg-primary
                                                                                    @else bg-secondary
                                                                                    @endif
                                                                                ">{{ $bucketData['count'] }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($bucketData['sub_status'] as $status => $count)
                                                        @if($count > 0)
                                                            <span class="badge bg-light text-dark">
                                                                {{ $status }}: <strong>{{ $count }}</strong>
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">No lead data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Follow-up Activities --}}
                    <h6 class="mt-4 mb-3">Follow-up Activities</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Activity Type</th>
                                    <th class="text-center">Total</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Call</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">{{ $row['followups']['Call'] ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            Connected: {{ $row['call_stats']['Call']['Connected'] ?? 0 }} |
                                            Not Connected: {{ $row['call_stats']['Call']['Not Connected'] ?? 0 }}
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>WhatsApp Call</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{ $row['followups']['WhatsApp Call'] ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            Connected: {{ $row['call_stats']['WhatsApp Call']['Connected'] ?? 0 }} |
                                            Not Connected: {{ $row['call_stats']['WhatsApp Call']['Not Connected'] ?? 0 }}
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>WhatsApp Message</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{ $row['followups']['Whatsapp'] ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            Discussion Start: {{ $row['whatsapp_stats']['Discussion Start'] ?? 0 }} |
                                            No Response: {{ $row['whatsapp_stats']['No Response'] ?? 0 }}
                                        </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ===== HOT LEADS SECTION ===== --}}
                @if(count($row['hot_leads']) > 0)
                    <div class="report-section">
                        <h5><i class="bi bi-fire me-2" style="color: #dc3545;"></i>Hot Leads ({{ count($row['hot_leads']) }})</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Lead Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Country</th>
                                        <th>Course</th>
                                        <th>Campaign</th>
                                        <th>Date</th>
                                        <th>Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($row['hot_leads'] as $index => $lead)
                                        <tr>
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center flex-shrink-0"
                                                        style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">
                                                        {{ substr($lead['lead_name'], 0, 1) }}
                                                    </div>
                                                    <span>{{ $lead['lead_name'] }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $lead['email'] }}</td>
                                            <td>{{ $lead['contact_no'] }}</td>
                                            <td>{{ $lead['country'] }}</td>
                                            <td>{{ $lead['course'] }}</td>
                                            <td>{{ $lead['campaign_name'] }}</td>
                                            <td>{{ $lead['date'] !== 'N/A' ? \Carbon\Carbon::parse($lead['date'])->format('M d, Y') : 'N/A' }}
                                            </td>
                                            <td>
                                                @if($lead['verified_lead'])
                                                    <span class="badge bg-success">✓ Yes</span>
                                                @else
                                                    <span class="badge bg-secondary">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- ===== PREVIOUS LEADS - STATUS TRANSITIONS ===== --}}
                <div class="report-section">
                    <h5><i class="bi bi-arrow-left-right me-2" style="color: #6c757d;"></i>Lead Status Transitions</h5>

                    @if(count($row['warm_to_hot']) > 0 || count($row['hot_to_warm']) > 0)
                        {{-- Warm to Hot --}}
                        @if(count($row['warm_to_hot']) > 0)
                            <div class="mb-4">
                                <h6 class="mb-3">
                                    <i class="bi bi-arrow-up-circle me-2" style="color: #28a745;"></i>
                                    Warm → Hot Transitions ({{ count($row['warm_to_hot']) }})
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lead Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Country</th>
                                                <th>Course</th>
                                                <th>Campaign</th>
                                                <th>Date</th>
                                                <th>Verified</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($row['warm_to_hot'] as $index => $lead)
                                                <tr style="background: #f0fff4; border-left: 4px solid #28a745;">
                                                    <td><strong>{{ $index + 1 }}</strong></td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0"
                                                                style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">
                                                                {{ substr($lead['lead_name'], 0, 1) }}
                                                            </div>
                                                            <span>{{ $lead['lead_name'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $lead['email'] }}</td>
                                                    <td>{{ $lead['contact_no'] }}</td>
                                                    <td>{{ $lead['country'] }}</td>
                                                    <td>{{ $lead['course'] }}</td>
                                                    <td>{{ $lead['campaign_name'] }}</td>
                                                    <td>{{ $lead['date'] !== 'N/A' ? \Carbon\Carbon::parse($lead['date'])->format('M d, Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if($lead['verified_lead'])
                                                            <span class="badge bg-success">✓ Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        {{-- Hot to Warm --}}
                        @if(count($row['hot_to_warm']) > 0)
                            <div class="mb-4">
                                <h6 class="mb-3">
                                    <i class="bi bi-arrow-down-circle me-2" style="color: #ffc107;"></i>
                                    Hot → Warm Transitions ({{ count($row['hot_to_warm']) }})
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lead Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Country</th>
                                                <th>Course</th>
                                                <th>Campaign</th>
                                                <th>Date</th>
                                                <th>Verified</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($row['hot_to_warm'] as $index => $lead)
                                                <tr style="background: #fffbf0; border-left: 4px solid #ffc107;">
                                                    <td><strong>{{ $index + 1 }}</strong></td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center flex-shrink-0"
                                                                style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">
                                                                {{ substr($lead['lead_name'], 0, 1) }}
                                                            </div>
                                                            <span>{{ $lead['lead_name'] }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $lead['email'] }}</td>
                                                    <td>{{ $lead['contact_no'] }}</td>
                                                    <td>{{ $lead['country'] }}</td>
                                                    <td>{{ $lead['course'] }}</td>
                                                    <td>{{ $lead['campaign_name'] }}</td>
                                                    <td>{{ $lead['date'] !== 'N/A' ? \Carbon\Carbon::parse($lead['date'])->format('M d, Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if($lead['verified_lead'])
                                                            <span class="badge bg-success">✓ Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>No status transitions found for this period.
                        </div>
                    @endif
                </div>

            @empty
                <div class="empty-state">
                    <i class="bi bi-inbox" style="font-size: 48px; color: #ccc;"></i>
                    <p class="mt-3">No data available for the selected criteria.</p>
                </div>
            @endforelse

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