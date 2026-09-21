@extends('layouts.app')

@section('title', 'Upcoming Events & Meetings - CRM')

@push('styles')
<style>
    @include('crm.lead.partials.lead-interaction-styles')

    .event-kpi-card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
        background: #ffffff;
        border: 1px solid #e2e8f0;
    }
    .event-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
    }
    .event-kpi-card.active-kpi {
        border-color: #006FC9;
        box-shadow: 0 0 0 2px rgba(0, 111, 201, 0.2);
    }

    .badge-event-meeting {
        background-color: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
    }
    .badge-event-discovery {
        background-color: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }
    .badge-event-projection {
        background-color: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .badge-event-conversion {
        background-color: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-status-scheduled {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .badge-status-completed {
        background-color: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .badge-status-cancelled {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .badge-status-rescheduled {
        background-color: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .table-events th {
        background-color: #f8fafc;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 700;
        padding: 12px 14px;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-events td {
        padding: 12px 14px;
        vertical-align: middle;
        font-size: 13px;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-events tr:hover td {
        background-color: #f8fafc;
    }
</style>
@endpush

@section('content')
<div class="nxl-content px-3 py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary" style="width: 38px; height: 38px;">
                    <i class="feather-calendar fs-5"></i>
                </span>
                <div>
                    <h4 class="fw-bold text-dark mb-0 fs-18">Upcoming Events & Meetings</h4>
                    <p class="text-muted fs-12 mb-0">Track discovery calls, meetings, projections, and conversions across leads</p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('leads.table.index') }}" class="btn btn-sm btn-outline-secondary rounded-2">
                <i class="feather-arrow-left me-1"></i> Back to Leads
            </a>
            <a href="{{ route('events.index') }}" class="btn btn-sm btn-light border rounded-2">
                <i class="feather-rotate-cw me-1"></i> Refresh
            </a>
        </div>
    </div>

    <!-- KPI Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- Today -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ request('quick_filter') == 'today' ? 'active-kpi' : '' }}" onclick="applyQuickFilter('today')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-muted">Today</span>
                    <span class="badge bg-primary-subtle text-primary rounded-circle p-1.5"><i class="feather-clock fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-dark mb-0 fs-20">{{ $kpis['today'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Scheduled for today</small>
            </div>
        </div>
        <!-- Tomorrow -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ request('quick_filter') == 'tomorrow' ? 'active-kpi' : '' }}" onclick="applyQuickFilter('tomorrow')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-muted">Tomorrow</span>
                    <span class="badge bg-info-subtle text-info rounded-circle p-1.5"><i class="feather-calendar fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-dark mb-0 fs-20">{{ $kpis['tomorrow'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Scheduled for tomorrow</small>
            </div>
        </div>
        <!-- This Week -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ request('quick_filter') == 'this_week' ? 'active-kpi' : '' }}" onclick="applyQuickFilter('this_week')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-muted">This Week</span>
                    <span class="badge bg-success-subtle text-success rounded-circle p-1.5"><i class="feather-check-circle fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-dark mb-0 fs-20">{{ $kpis['this_week'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Active this week</small>
            </div>
        </div>
        <!-- Overdue -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ request('quick_filter') == 'overdue' ? 'active-kpi' : '' }}" onclick="applyQuickFilter('overdue')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-danger">Overdue</span>
                    <span class="badge bg-danger-subtle text-danger rounded-circle p-1.5"><i class="feather-alert-triangle fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-danger mb-0 fs-20">{{ $kpis['overdue'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Needs attention</small>
            </div>
        </div>
        <!-- Completed -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ request('quick_filter') == 'completed' ? 'active-kpi' : '' }}" onclick="applyQuickFilter('completed')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-success">Completed</span>
                    <span class="badge bg-success-subtle text-success rounded-circle p-1.5"><i class="feather-check fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-success mb-0 fs-20">{{ $kpis['completed'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Successfully done</small>
            </div>
        </div>
        <!-- All Upcoming -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="event-kpi-card p-3 {{ (!request('quick_filter') || request('quick_filter') == 'all_upcoming') ? 'active-kpi' : '' }}" onclick="applyQuickFilter('all_upcoming')">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fs-11 fw-bold text-uppercase text-primary">All Upcoming</span>
                    <span class="badge bg-primary-subtle text-primary rounded-circle p-1.5"><i class="feather-list fs-11"></i></span>
                </div>
                <h3 class="fw-bold text-primary mb-0 fs-20">{{ $kpis['all_upcoming'] ?? 0 }}</h3>
                <small class="text-muted fs-10">Total scheduled</small>
            </div>
        </div>
    </div>

    <!-- Filter Form Bar -->
    <div class="card border-0 shadow-2xs rounded-3 mb-4 bg-white">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('events.index') }}" id="eventsFilterForm" class="row g-2 align-items-end">
                <input type="hidden" name="quick_filter" id="input_quick_filter" value="{{ request('quick_filter', 'all_upcoming') }}">

                <!-- Search -->
                <div class="col-md-3">
                    <label class="form-label fs-11 fw-semibold text-muted text-uppercase mb-1">Search</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="feather-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Lead name, phone, email, title..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Event Type -->
                <div class="col-md-2">
                    <label class="form-label fs-11 fw-semibold text-muted text-uppercase mb-1">Event Type</label>
                    <select name="event_type" class="form-select form-select-sm">
                        <option value="">All Types</option>
                        <option value="meeting_schedule" {{ request('event_type') == 'meeting_schedule' ? 'selected' : '' }}>Meeting Schedule</option>
                        <option value="discovery_call" {{ request('event_type') == 'discovery_call' ? 'selected' : '' }}>Discovery Call</option>
                        <option value="projection_call" {{ request('event_type') == 'projection_call' ? 'selected' : '' }}>Projection Call</option>
                        <option value="conversion" {{ request('event_type') == 'conversion' ? 'selected' : '' }}>Conversion</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <label class="form-label fs-11 fw-semibold text-muted text-uppercase mb-1">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rescheduled" {{ request('status') == 'rescheduled' ? 'selected' : '' }}>Rescheduled</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Assigned To -->
                <div class="col-md-2">
                    <label class="form-label fs-11 fw-semibold text-muted text-uppercase mb-1">Assigned To</label>
                    <select name="assigned_to" class="form-select form-select-sm">
                        <option value="">All Assignees</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('assigned_to') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary rounded-2 px-3 flex-fill">
                        <i class="feather-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('events.index') }}" class="btn btn-sm btn-light border rounded-2 px-3">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Events List Table -->
    <div class="card border-0 shadow-2xs rounded-3 bg-white">
        <div class="card-header bg-white border-bottom py-3 px-3 d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0 fs-14">
                <i class="feather-list me-1 text-primary"></i> Events & Appointments
                <span class="badge bg-light text-muted border ms-1 fs-11">{{ $events->total() }}</span>
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-events mb-0">
                    <thead>
                        <tr>
                            <th style="width: 170px;">Event Type</th>
                            <th>Lead Details</th>
                            <th style="width: 180px;">Date & Time</th>
                            <th style="width: 150px;">Assigned To</th>
                            <th style="width: 120px;">Status</th>
                            <th style="width: 140px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            @php
                                $lead = $event->lead;
                                $clientName = optional($lead->user)->name ?? 'N/A';
                                $clientPhone = optional($lead->user)->contact_no ?? 'N/A';
                                $clientEmail = optional($lead->user)->email ?? '';
                                $leadBusiness = $lead->business_name ?? '';
                                
                                $typeClass = match($event->event_type) {
                                    'meeting_schedule' => 'badge-event-meeting',
                                    'discovery_call' => 'badge-event-discovery',
                                    'projection_call' => 'badge-event-projection',
                                    'conversion' => 'badge-event-conversion',
                                    default => 'badge-event-meeting',
                                };

                                $statusClass = match($event->status) {
                                    'scheduled' => 'badge-status-scheduled',
                                    'completed' => 'badge-status-completed',
                                    'cancelled' => 'badge-status-cancelled',
                                    'rescheduled' => 'badge-status-rescheduled',
                                    default => 'badge-status-scheduled',
                                };

                                $isOverdue = ($event->status === 'scheduled' && $event->event_date && $event->event_date->isPast() && !$event->event_date->isToday());
                                $isToday = ($event->event_date && $event->event_date->isToday());
                                $isTomorrow = ($event->event_date && $event->event_date->isTomorrow());
                            @endphp
                            <tr id="event-row-{{ $event->id }}">
                                <!-- Event Type & Title -->
                                <td>
                                    <span class="badge {{ $typeClass }} px-2.5 py-1 rounded-pill fs-11 fw-semibold mb-1 d-inline-flex align-items-center gap-1">
                                        <i class="feather-calendar fs-10"></i> {{ $event->type_label }}
                                    </span>
                                    @if($event->title)
                                        <div class="fw-medium text-dark fs-12 text-truncate" style="max-width: 180px;" title="{{ $event->title }}">{{ $event->title }}</div>
                                    @endif
                                    @if($event->description)
                                        <div class="text-muted fs-11 text-truncate" style="max-width: 180px;" title="{{ $event->description }}">{{ $event->description }}</div>
                                    @endif
                                </td>

                                <!-- Lead Details -->
                                <td>
                                    @if($lead)
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0)" onclick="openViewDetailsModalLazy({{ $lead->id }})" class="fw-bold text-primary text-decoration-none hover-underline fs-13">
                                                {{ $clientName }}
                                            </a>
                                            <button type="button" class="btn btn-xs btn-outline-primary py-0 px-1 rounded fs-10" onclick="openViewDetailsModalLazy({{ $lead->id }})" title="View Complete Lead Profile">
                                                View Lead
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 text-muted fs-11 mt-0.5">
                                            @if($leadBusiness)
                                                <span><i class="feather-briefcase fs-10 me-0.5"></i> {{ $leadBusiness }}</span>
                                                <span>•</span>
                                            @endif
                                            <span><i class="feather-phone fs-10 me-0.5"></i> {{ $clientPhone }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted fs-12">Lead details unavailable</span>
                                    @endif
                                </td>

                                <!-- Schedule Date & Time -->
                                <td>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="fw-semibold text-dark fs-12">
                                            {{ $event->event_date ? $event->event_date->format('d M Y') : 'N/A' }}
                                        </span>
                                        @if($isToday)
                                            <span class="badge bg-primary-subtle text-primary fs-10 px-1.5 py-0.5">Today</span>
                                        @elseif($isTomorrow)
                                            <span class="badge bg-info-subtle text-info fs-10 px-1.5 py-0.5">Tomorrow</span>
                                        @elseif($isOverdue)
                                            <span class="badge bg-danger-subtle text-danger fs-10 px-1.5 py-0.5">Overdue</span>
                                        @endif
                                    </div>
                                    <div class="text-muted fs-11 mt-0.5">
                                        <i class="feather-clock fs-10 me-0.5"></i>
                                        {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('h:i A') : '' }}
                                        @if($event->end_time)
                                            - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                        @endif
                                    </div>
                                </td>

                                <!-- Assigned To -->
                                <td>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold fs-10 border" style="width: 24px; height: 24px;">
                                            {{ strtoupper(substr(optional($event->assignedUser)->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="fs-12 text-dark">{{ optional($event->assignedUser)->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td>
                                    <span class="badge {{ $statusClass }} px-2 py-0.5 rounded-pill fs-11 fw-semibold">
                                        {{ $event->status_label }}
                                    </span>
                                    @if($event->completed_at)
                                        <div class="text-muted fs-10 mt-0.5" title="Completed At">{{ $event->completed_at->format('d M, h:i A') }}</div>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        @if($event->status === 'scheduled')
                                            <!-- Mark Complete -->
                                            <button type="button" class="btn btn-xs btn-outline-success py-1 px-1.5 rounded" onclick="markEventCompleted({{ $event->id }})" title="Mark as Completed">
                                                <i class="feather-check"></i>
                                            </button>
                                            <!-- Reschedule -->
                                            <button type="button" class="btn btn-xs btn-outline-warning py-1 px-1.5 rounded" onclick="openRescheduleModal({{ $event->id }}, '{{ $event->event_date ? $event->event_date->format('Y-m-d') : '' }}', '{{ $event->start_time }}')" title="Reschedule Event">
                                                <i class="feather-clock"></i>
                                            </button>
                                            <!-- Cancel -->
                                            <button type="button" class="btn btn-xs btn-outline-danger py-1 px-1.5 rounded" onclick="cancelEvent({{ $event->id }})" title="Cancel Event">
                                                <i class="feather-x"></i>
                                            </button>
                                        @else
                                            <span class="text-muted fs-11">No actions</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 56px; height: 56px;">
                                            <i class="feather-calendar fs-3 text-muted opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark fs-14 mb-1">No Upcoming Events Found</h6>
                                        <p class="text-muted fs-12 mb-0">No events matched your selected filter criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="p-3 border-top d-flex justify-content-end">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal: Reschedule Event -->
<div class="modal fade" id="quickRescheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-0 bg-light py-2 px-3">
                <h6 class="modal-title fw-bold text-dark fs-13 mb-0"><i class="feather-clock me-1 text-warning"></i> Reschedule Event</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="quickRescheduleForm" onsubmit="submitQuickReschedule(event)">
                <input type="hidden" id="qr_event_id">
                <div class="modal-body p-3">
                    <div class="mb-2">
                        <label class="form-label fs-11 fw-semibold text-muted">New Date <span class="text-danger">*</span></label>
                        <input type="date" id="qr_event_date" class="form-control form-control-sm" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label fs-11 fw-semibold text-muted">New Start Time <span class="text-danger">*</span></label>
                        <input type="time" id="qr_start_time" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="modal-footer border-0 p-2 bg-light d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-xs btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-xs btn-primary px-3" id="qr_submit_btn">Update Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('crm.lead.partials.lead-interaction-modals')
@endsection

@push('scripts')
@include('crm.lead.partials.lead-interaction-scripts')
<script>
    function applyQuickFilter(filter) {
        document.getElementById('input_quick_filter').value = filter;
        document.getElementById('eventsFilterForm').submit();
    }

    function markEventCompleted(eventId) {
        if (!confirm('Mark this event as completed?')) return;

        fetch("{{ url('/upcoming-events') }}/" + eventId + "/complete", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message || 'Failed to update event.');
            }
        })
        .catch(() => alert('Network error occurred.'));
    }

    function cancelEvent(eventId) {
        if (!confirm('Are you sure you want to cancel this event?')) return;

        fetch("{{ url('/upcoming-events') }}/" + eventId + "/cancel", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message || 'Failed to cancel event.');
            }
        })
        .catch(() => alert('Network error occurred.'));
    }

    function openRescheduleModal(eventId, currentDate, currentTime) {
        document.getElementById('qr_event_id').value = eventId;
        document.getElementById('qr_event_date').value = currentDate || '';
        document.getElementById('qr_start_time').value = currentTime || '';
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('quickRescheduleModal'));
        modal.show();
    }

    function submitQuickReschedule(e) {
        e.preventDefault();
        const eventId = document.getElementById('qr_event_id').value;
        const newDate = document.getElementById('qr_event_date').value;
        const newTime = document.getElementById('qr_start_time').value;
        const submitBtn = document.getElementById('qr_submit_btn');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

        fetch("{{ url('/upcoming-events') }}/" + eventId + "/reschedule", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                event_date: newDate,
                start_time: newTime,
                status: 'scheduled'
            })
        })
        .then(res => res.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Update Schedule';
            if (data.status === 'success') {
                bootstrap.Modal.getInstance(document.getElementById('quickRescheduleModal')).hide();
                location.reload();
            } else {
                alert(data.message || 'Failed to reschedule.');
            }
        })
        .catch(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Update Schedule';
            alert('Network error.');
        });
    }
</script>
@endpush
