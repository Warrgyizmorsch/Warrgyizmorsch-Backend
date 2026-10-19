@extends('layouts.app')

@section('content')
<style>
    /* Premium Call History UI Styling */
    .call-history-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .call-history-card {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        background: #ffffff;
    }
    .call-tab-btn {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        padding: 8px 16px !important;
        border-radius: 8px !important;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        color: #334155 !important;
    }
    .call-tab-btn:hover {
        background-color: #f1f5f9;
        color: #0f172a !important;
    }
    .call-tab-btn.active {
        background-color: #0073ea !important;
        color: #ffffff !important;
        border-color: #0073ea !important;
        box-shadow: 0 2px 6px rgba(0, 115, 234, 0.25);
    }
    .filter-label {
        font-size: 12.5px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        letter-spacing: 0.3px;
        margin-bottom: 5px;
    }
    .filter-input {
        font-size: 13.5px !important;
        height: 40px !important;
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        color: #1e293b !important;
    }
    .filter-input:focus {
        border-color: #0073ea !important;
        box-shadow: 0 0 0 3px rgba(0, 115, 234, 0.15) !important;
    }
    .filter-btn {
        height: 40px !important;
        border-radius: 8px !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .call-history-table {
        margin-bottom: 0;
    }
    .call-history-table thead th {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px !important;
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        white-space: nowrap;
    }
    .call-history-table tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        font-size: 13.5px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .call-history-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Fixed High-Contrast Badges */
    .call-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 5px 12px !important;
        border-radius: 6px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
        white-space: nowrap !important;
    }
    .call-badge-outbound {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
        border: 1px solid #bfdbfe !important;
    }
    .call-badge-inbound {
        background-color: #f0fdfa !important;
        color: #0f766e !important;
        border: 1px solid #99f6e4 !important;
    }
    .call-badge-completed {
        background-color: #ecfdf5 !important;
        color: #047857 !important;
        border: 1px solid #a7f3d0 !important;
    }
    .call-badge-missed, .call-badge-failed {
        background-color: #fef2f2 !important;
        color: #b91c1c !important;
        border: 1px solid #fecaca !important;
    }
    .call-badge-warning {
        background-color: #fffbeb !important;
        color: #b45309 !important;
        border: 1px solid #fde68a !important;
    }
    .call-badge-neutral {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0 !important;
    }
    .call-badge-duration {
        background-color: #f0fdf4 !important;
        color: #166534 !important;
        border: 1px solid #bbf7d0 !important;
    }

    .action-call-round-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        transition: all 0.2s ease;
        font-size: 14px;
        text-decoration: none;
    }
    .action-call-round-btn:hover {
        background-color: #059669;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(5, 150, 105, 0.3);
        transform: scale(1.05);
    }
</style>

<div class="container-fluid py-4 call-history-container">

    <!-- Top Level: Page Header & Quick Navigation -->
    <div class="card mb-4 call-history-card">
        <div class="card-body py-3 px-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center shadow-xs" style="width: 48px; height: 48px; background-color: #eff6ff;">
                    <i class="fa fa-phone-volume fs-4" style="color: #0073ea;"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">Twilio Call History & Logs</h4>
                    <div class="text-secondary" style="font-size: 13.5px;">View call recordings, check durations, filter contacts, and redial directly with Softphone</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ \Illuminate\Support\Facades\Route::has('plugins.index') ? route('plugins.index') : url('/admin/plugins') }}" class="btn btn-outline-secondary fw-semibold filter-btn px-3">
                    <i class="fa fa-cog me-1.5 text-secondary"></i> Twilio Settings
                </a>
                <button type="button" class="btn btn-primary fw-semibold filter-btn px-3.5 shadow-sm" onclick="window.twilioSoftphone && window.twilioSoftphone.toggleWidget()">
                    <i class="fa fa-phone me-1.5"></i> Open Dialer
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Tabs & Granular Filters Card -->
    <div class="card mb-4 call-history-card">
        <!-- Filter Tabs -->
        <div class="card-header border-0 pt-3 pb-3 px-4 bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
            <ul class="nav nav-pills gap-2 mb-0">
                <li class="nav-item">
                    <a class="nav-link call-tab-btn {{ ($tab ?? 'all') === 'all' ? 'active' : '' }}" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'all'])) }}">
                        <i class="fa fa-layer-group"></i> All Calls ({{ $totalCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link call-tab-btn {{ ($tab ?? '') === 'missed' ? 'active' : '' }}" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'missed'])) }}">
                        <i class="fa fa-phone-slash text-danger"></i> Missed Calls ({{ $missedCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link call-tab-btn {{ ($tab ?? '') === 'inbound' ? 'active' : '' }}" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'inbound'])) }}">
                        <i class="fa fa-arrow-down text-info"></i> Inbound ({{ $inboundCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link call-tab-btn {{ ($tab ?? '') === 'outbound' ? 'active' : '' }}" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'outbound'])) }}">
                        <i class="fa fa-arrow-up text-primary"></i> Outbound ({{ $outboundCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link call-tab-btn {{ ($tab ?? '') === 'completed' ? 'active' : '' }}" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'completed'])) }}">
                        <i class="fa fa-check-circle text-success"></i> Completed ({{ $completedCalls ?? 0 }})
                    </a>
                </li>
            </ul>
        </div>

        <!-- Filter Form -->
        <div class="card-body pt-3 pb-4 px-4 border-top">
            <form id="callFilterForm" method="GET" action="{{ route('call.history') }}" class="row g-3 align-items-end">
                <input type="hidden" name="provider" value="twilio">
                <input type="hidden" name="tab" value="{{ $tab ?? 'all' }}">

                <div class="col-md-3">
                    <label class="filter-label">SEARCH CONTACT / NUMBER / SID</label>
                    <div class="position-relative">
                        <input type="text" name="search" class="form-control filter-input" placeholder="Name, phone number, SID..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="filter-label">STATUS</label>
                    <select name="status" class="form-select filter-input">
                        <option value="">All Statuses</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="missed" {{ request('status') === 'missed' ? 'selected' : '' }}>Missed</option>
                        <option value="no-answer" {{ request('status') === 'no-answer' ? 'selected' : '' }}>No Answer</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="filter-label">DIRECTION</label>
                    <select name="direction" class="form-select filter-input">
                        <option value="">All Directions</option>
                        <option value="inbound" {{ request('direction') === 'inbound' ? 'selected' : '' }}>Inbound</option>
                        <option value="outbound" {{ request('direction') === 'outbound' ? 'selected' : '' }}>Outbound</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="filter-label">FROM DATE</label>
                    <input type="date" name="date_from" class="form-control filter-input" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-2">
                    <label class="filter-label">TO DATE</label>
                    <input type="date" name="date_to" class="form-control filter-input" value="{{ request('date_to') }}">
                </div>

                <div class="col-md-1 d-flex gap-2">
                    <button type="submit" class="btn btn-primary filter-btn w-100" title="Apply Filter">
                        <i class="fa fa-search fs-6"></i>
                    </button>
                    <a href="{{ route('call.history', ['provider' => 'twilio']) }}" class="btn btn-outline-secondary filter-btn px-3" title="Reset Filters">
                        <i class="fa fa-sync fs-6"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Call Log Table -->
    <div class="card call-history-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table call-history-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">#</th>
                            <th style="min-width: 140px;">Date & Time</th>
                            <th style="min-width: 125px;">Direction</th>
                            <th style="min-width: 130px;">Status</th>
                            <th style="min-width: 190px;">Customer / Contact</th>
                            <th style="min-width: 140px;">From</th>
                            <th style="min-width: 140px;">To</th>
                            <th style="min-width: 115px;">Duration</th>
                            <th style="min-width: 220px;">Audio Recording</th>
                            <th style="min-width: 120px;">Agent</th>
                            <th style="width: 80px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                        <tr>
                            <td class="text-center fw-bold text-muted" style="font-size: 13.5px;">
                                {{ $logs->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 14px;">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-muted" style="font-size: 12.5px;">{{ $log->created_at->format('h:i:s A') }}</div>
                            </td>
                            <td>
                                @if($log->direction === 'inbound')
                                    <span class="call-badge call-badge-inbound">
                                        <i class="fa fa-arrow-down" style="font-size: 11px;"></i> Inbound
                                    </span>
                                @else
                                    <span class="call-badge call-badge-outbound">
                                        <i class="fa fa-arrow-up" style="font-size: 11px;"></i> Outbound
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $st = strtolower($log->status ?? '');
                                    $badgeClass = 'call-badge-neutral';
                                    if ($st === 'completed') {
                                        $badgeClass = 'call-badge-completed';
                                    } elseif (in_array($st, ['no-answer', 'busy', 'canceled'])) {
                                        $badgeClass = 'call-badge-warning';
                                    } elseif (in_array($st, ['missed', 'failed'])) {
                                        $badgeClass = 'call-badge-missed';
                                    } elseif (in_array($st, ['ringing', 'in-progress', 'queued'])) {
                                        $badgeClass = 'call-badge-outbound';
                                    }
                                @endphp
                                <span class="call-badge {{ $badgeClass }}">
                                    {{ $log->status_label }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 14.5px;">{{ $log->customer_name ?: 'Unknown Contact' }}</div>
                                <div class="text-muted font-monospace" style="font-size: 13px;">{{ $log->direction === 'inbound' ? $log->from_number : $log->to_number }}</div>
                            </td>
                            <td class="font-monospace fw-medium text-dark" style="font-size: 13.5px;">
                                {{ $log->from_number ?: '—' }}
                            </td>
                            <td class="font-monospace fw-medium text-dark" style="font-size: 13.5px;">
                                {{ $log->to_number ?: '—' }}
                            </td>
                            <td>
                                @if($log->duration > 0)
                                    <span class="call-badge call-badge-duration">
                                        <i class="fa fa-clock" style="font-size: 11px;"></i> {{ $log->formatted_duration }}
                                    </span>
                                @else
                                    <span class="text-muted fw-medium" style="font-size: 13.5px;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($log->recording_url)
                                    @php
                                        $audioUrl = route('call.history.recording', $log->id);
                                    @endphp
                                    <div class="d-inline-flex align-items-center gap-2 bg-light rounded-3 p-1.5 border">
                                        <audio controls preload="none" style="height: 32px; width: 175px;">
                                            <source src="{{ $audioUrl }}" type="audio/mpeg">
                                            Your browser does not support audio.
                                        </audio>
                                        <a href="{{ $audioUrl }}" target="_blank" download="recording-{{ $log->id }}.mp3" class="btn btn-sm btn-icon btn-light-primary rounded-circle" style="width: 30px; height: 30px;" title="Download Recording (MP3)">
                                            <i class="fa fa-download" style="font-size: 12px;"></i>
                                        </a>
                                    </div>
                                @else
                                    <span class="call-badge call-badge-neutral" style="font-size: 12px;">No recording</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-dark" style="font-size: 14px;">{{ $log->agent?->name ?? '—' }}</span>
                            </td>
                            <td class="text-center">
                                @php $callTarget = $log->direction === 'inbound' ? $log->from_number : $log->to_number; @endphp
                                @if(!empty($callTarget))
                                    <button type="button" class="action-call-round-btn" 
                                            onclick="initiateTwilioCall('{{ $callTarget }}', '{{ addslashes($log->customer_name ?: 'Customer') }}')" 
                                            title="Call: {{ $callTarget }}">
                                        <i class="fa fa-phone"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <div class="py-4">
                                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fa fa-phone-slash fs-2 text-muted"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 16px;">No call records found</h5>
                                    <p class="text-muted mb-0" style="font-size: 13.5px;">No calls match your filter criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="card-footer py-3 px-4 d-flex justify-content-between align-items-center bg-white border-top">
                    <div class="text-muted" style="font-size: 13.5px;">
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} calls
                    </div>
                    <div>
                        {{ $logs->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
