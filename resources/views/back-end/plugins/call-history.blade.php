@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Top Level: Page Header & Actions -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body py-3 px-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="fa fa-phone-volume fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Twilio Call History</h5>
                    <div class="text-muted fs-8">View, listen to recordings, redial, and filter all inbound & outbound Twilio calls</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.plugins.index') }}" class="btn btn-sm btn-light fw-bold">
                    <i class="fa fa-cog me-1"></i> Twilio Settings
                </a>
                <button type="button" class="btn btn-sm btn-primary fw-bold" onclick="window.twilioSoftphone && window.twilioSoftphone.toggleWidget()">
                    <i class="fa fa-phone me-1"></i> Open Dialer
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Tabs & Granular Filters Card -->
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-header border-0 pt-3 pb-2 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <!-- Counter Tabs -->
            <ul class="nav nav-pills gap-2 mb-0">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm {{ ($tab ?? 'all') === 'all' ? 'active bg-primary text-white' : 'btn-light-primary text-primary' }} fw-bold" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'all'])) }}" style="border-radius: 8px;">
                        All Calls ({{ $totalCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm {{ ($tab ?? '') === 'missed' ? 'active bg-danger text-white' : 'btn-light-danger text-danger' }} fw-bold" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'missed'])) }}" style="border-radius: 8px;">
                        <i class="fa fa-phone-slash me-1"></i> Missed Calls ({{ $missedCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm {{ ($tab ?? '') === 'inbound' ? 'active bg-info text-white' : 'btn-light-info text-info' }} fw-bold" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'inbound'])) }}" style="border-radius: 8px;">
                        <i class="fa fa-arrow-down me-1"></i> Inbound ({{ $inboundCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm {{ ($tab ?? '') === 'outbound' ? 'active bg-primary text-white' : 'btn-light-primary text-primary' }} fw-bold" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'outbound'])) }}" style="border-radius: 8px;">
                        <i class="fa fa-arrow-up me-1"></i> Outbound ({{ $outboundCalls ?? 0 }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm {{ ($tab ?? '') === 'completed' ? 'active bg-success text-white' : 'btn-light-success text-success' }} fw-bold" 
                       href="{{ route('call.history', array_merge(request()->except('tab', 'page'), ['tab' => 'completed'])) }}" style="border-radius: 8px;">
                        <i class="fa fa-check me-1"></i> Completed ({{ $completedCalls ?? 0 }})
                    </a>
                </li>
            </ul>
        </div>

        <!-- Filter Form -->
        <div class="card-body pt-1 pb-4 px-4 border-top">
            <form id="callFilterForm" method="GET" action="{{ route('call.history') }}" class="row g-2 align-items-end">
                <input type="hidden" name="provider" value="twilio">
                <input type="hidden" name="tab" value="{{ $tab ?? 'all' }}">

                <div class="col-md-3">
                    <label class="form-label fw-bold fs-8 text-uppercase mb-1">Search Contact / Number / ID</label>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="User, Number, SID, ID..." value="{{ request('search') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-bold fs-8 text-uppercase mb-1">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="missed" {{ request('status') === 'missed' ? 'selected' : '' }}>Missed</option>
                        <option value="no-answer" {{ request('status') === 'no-answer' ? 'selected' : '' }}>No Answer</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-bold fs-8 text-uppercase mb-1">Direction</label>
                    <select name="direction" class="form-select form-select-sm">
                        <option value="">All Directions</option>
                        <option value="inbound" {{ request('direction') === 'inbound' ? 'selected' : '' }}>Inbound</option>
                        <option value="outbound" {{ request('direction') === 'outbound' ? 'selected' : '' }}>Outbound</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-bold fs-8 text-uppercase mb-1">From Date</label>
                    <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-bold fs-8 text-uppercase mb-1">To Date</label>
                    <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                </div>

                <div class="col-md-1 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary w-100" title="Apply Filter">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="{{ route('call.history', ['provider' => 'twilio']) }}" class="btn btn-sm btn-light" title="Reset">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Call Log Table -->
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-gray-200 align-middle gs-4 gy-3 mb-0">
                    <thead class="bg-light fw-bold fs-8 text-uppercase text-gray-600">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Date & Time</th>
                            <th>Direction</th>
                            <th>Status</th>
                            <th>Customer / Contact</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Duration</th>
                            <th>Audio Recording</th>
                            <th>Agent</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        @forelse($logs as $index => $log)
                        <tr>
                            <td>{{ $logs->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-muted fs-8">{{ $log->created_at->format('h:i:s A') }}</div>
                            </td>
                            <td>
                                @if($log->direction === 'inbound')
                                    <span class="badge badge-light-info text-info fw-bold">
                                        <i class="fa fa-arrow-down me-1 text-info fs-9"></i>Inbound
                                    </span>
                                @else
                                    <span class="badge badge-light-primary text-primary fw-bold">
                                        <i class="fa fa-arrow-up me-1 text-primary fs-9"></i>Outbound
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $log->status_badge }} fw-bold">
                                    {{ $log->status_label }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $log->customer_name ?: 'Unknown Contact' }}</div>
                                <div class="text-muted font-monospace fs-8">{{ $log->direction === 'inbound' ? $log->from_number : $log->to_number }}</div>
                            </td>
                            <td class="font-monospace fs-8 text-dark">{{ $log->from_number ?: '—' }}</td>
                            <td class="font-monospace fs-8 text-dark">{{ $log->to_number ?: '—' }}</td>
                            <td>
                                @if($log->duration > 0)
                                    <span class="badge badge-light-success fw-semibold">
                                        <i class="fa fa-clock me-1 fs-9"></i>{{ $log->formatted_duration }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($log->recording_url)
                                    <div class="d-inline-flex align-items-center gap-1 bg-light rounded p-1">
                                        <audio controls preload="none" style="height: 28px; width: 145px;">
                                            <source src="{{ $log->recording_url }}" type="audio/mpeg">
                                            Your browser does not support audio.
                                        </audio>
                                        <a href="{{ $log->recording_url }}" target="_blank" download class="btn btn-icon btn-xs btn-light-primary" title="Download Audio (MP3)">
                                            <i class="fa fa-download fs-9"></i>
                                        </a>
                                    </div>
                                @else
                                    <span class="badge badge-light-secondary text-muted fs-9">No recording</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-dark fs-8">{{ $log->agent?->name ?? '—' }}</span>
                            </td>
                            <td class="text-center">
                                @php $callTarget = $log->direction === 'inbound' ? $log->from_number : $log->to_number; @endphp
                                @if(!empty($callTarget))
                                    <button type="button" class="btn btn-icon btn-sm btn-light-primary rounded-circle" 
                                            onclick="initiateTwilioCall('{{ $callTarget }}', '{{ addslashes($log->customer_name ?: 'Customer') }}')" 
                                            title="Call: {{ $callTarget }}">
                                        <i class="fa fa-phone fs-8"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="fa fa-phone fs-1 text-primary mb-2 d-block"></i>
                                <h6 class="fw-bold text-dark">No call records found</h6>
                                <p class="text-muted fs-8 mb-0">No calls match your filter criteria.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($logs->hasPages())
                <div class="card-footer py-3 d-flex justify-content-end">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
