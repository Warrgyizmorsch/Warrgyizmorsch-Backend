@extends('layouts.app')

@section('title', 'Follow-ups Tracker - CRM')

@push('styles')
<style>
    @include('crm.lead.partials.lead-interaction-styles')

    .lead-tab-strip {
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        background: #ffffff;
        border-radius: 12px;
        padding: 8px 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 12px;
        overflow-x: auto;
    }

    .lead-status-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .lead-status-tab.tab-lead { background-color: #e0f2fe; color: #0369a1; border-color: #bae6fd; }
    .lead-status-tab.tab-lead:hover, .lead-status-tab.tab-lead.is-active { background-color: #0284c7; color: #ffffff; }

    .lead-status-tab.tab-deal { background-color: #f3e8ff; color: #7e22ce; border-color: #e9d5ff; }
    .lead-status-tab.tab-deal:hover, .lead-status-tab.tab-deal.is-active { background-color: #9333ea; color: #ffffff; }

    .lead-status-tab.tab-missed { background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; }
    .lead-status-tab.tab-missed:hover, .lead-status-tab.tab-missed.is-active { background-color: #dc2626; color: #ffffff; }

    .table-action-btn {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        transition: all 0.15s ease;
        font-size: 12px;
    }
    .table-action-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #cbd5e1;
    }

    .lead-table-card {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 5px 16px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .lead-table-head {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .lead-table-head th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        padding: 13px 16px;
        border-right: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .lead-table-head th:last-child { border-right: 0; }
    .lead-table-body td {
        padding: 14px 16px;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
        border-bottom: 1px solid #e2e8f0;
        border-right: 1px solid #f1f5f9;
    }
    .lead-table-body td:last-child { border-right: 0; }
    .lead-table-body tr:last-child td {
        border-bottom: none;
    }
    .lead-table-body tr:hover td {
        background-color: #f8fbff;
    }

    .followup-filter-card { border: 1px solid #e2e8f0 !important; overflow: hidden; }
    .followup-filter-toggle { width: 100%; border: 0; background: #fff; padding: 13px 16px; }
    .followup-filter-toggle:not(.collapsed) { border-bottom: 1px solid #e2e8f0; background: #f8fbff; }
    .followup-filter-toggle .feather-chevron-down { transition: transform .2s ease; }
    .followup-filter-toggle:not(.collapsed) .feather-chevron-down { transform: rotate(180deg); }
    .followup-filter-body { padding: 14px 16px; background: #fff; }
    .followup-action-cell { min-width: 180px; }

    .done-checkbox {
        width: 19px;
        height: 19px;
        cursor: pointer;
        border-color: #94a3b8;
        accent-color: #16a34a;
    }
</style>
@endpush

@section('content')
<div class="nxl-content">
    {{-- Clean Header for Follow-ups Tracker --}}
    <div class="page-header py-3 px-3 border-bottom bg-white d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div class="page-header-left d-flex align-items-center gap-3">
            <div class="page-header-title">
                <h5 class="m-b-0 fw-bold fs-16 text-dark d-flex align-items-center gap-2">
                    <i class="feather-calendar text-primary fs-18"></i>
                    Follow-ups Tracker
                    <span class="badge bg-primary-subtle text-primary rounded-pill fs-11 px-2.5 py-1">{{ $allCount }} Total</span>
                </h5>
            </div>
            <ul class="breadcrumb mb-0 d-none d-md-flex align-items-center fs-12 text-muted">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item active text-dark fw-semibold">Follow-ups</li>
            </ul>
        </div>
    </div>

    <div class="main-content px-3 py-1">
        {{-- The 3 Follow-up Tabs: Lead / Deal / Missed --}}
        <div class="lead-tab-strip">
            <a href="{{ request()->fullUrlWithQuery(['tab' => 'lead', 'page' => null]) }}"
               class="lead-status-tab tab-lead {{ $tab === 'lead' ? 'is-active' : '' }}">
                <i class="feather-users me-1"></i> Lead Follow-ups ({{ $leadCount }})
            </a>

            <a href="{{ request()->fullUrlWithQuery(['tab' => 'deal', 'page' => null]) }}"
               class="lead-status-tab tab-deal {{ $tab === 'deal' ? 'is-active' : '' }}">
                <i class="feather-briefcase me-1"></i> Deal Follow-ups ({{ $dealCount }})
            </a>

            <a href="{{ request()->fullUrlWithQuery(['tab' => 'missed', 'page' => null]) }}"
               class="lead-status-tab tab-missed {{ $tab === 'missed' ? 'is-active' : '' }}">
                <i class="feather-alert-triangle me-1"></i> Missed Follow-ups ({{ $missedCount }})
            </a>
        </div>

        {{-- Clean Filter & Search Toolbar (No Pin, No Pipeline view, Date range by next_followup_date) --}}
        <div class="card followup-filter-card shadow-sm rounded-3 mb-3 bg-white">
            <button class="followup-filter-toggle d-flex align-items-center justify-content-between text-start {{ request()->hasAny(['search', 'from', 'to']) && (request('search') || request('from') || request('to')) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#followupFilters" aria-expanded="{{ request()->hasAny(['search', 'from', 'to']) && (request('search') || request('from') || request('to')) ? 'true' : 'false' }}">
                <span class="d-flex align-items-center gap-2 fw-bold text-dark fs-12"><span class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center" style="width:28px;height:28px;"><i class="feather-filter"></i></span> Filters & Search</span>
                <span class="d-flex align-items-center gap-2 text-muted fs-11">{{ request('search') || request('from') || request('to') ? 'Filters applied' : 'Expand filters' }} <i class="feather-chevron-down"></i></span>
            </button>
            <div id="followupFilters" class="collapse {{ request()->hasAny(['search', 'from', 'to']) && (request('search') || request('from') || request('to')) ? 'show' : '' }}">
            <div class="followup-filter-body">
                <form method="GET" action="{{ route('followups.index') }}" id="followupSearchForm" class="row g-2 align-items-center">
                    <input type="hidden" name="tab" value="{{ $tab }}">

                    {{-- Follow-up Date Filter (From Date) --}}
                    <div class="col-12 col-sm-auto d-flex align-items-center gap-1.5">
                        <span class="text-muted fs-12 fw-semibold"><i class="feather-calendar text-primary me-1"></i>From:</span>
                        <input type="date" name="from" class="form-control form-control-sm border-slate" value="{{ request('from') }}" style="font-size: 12px; width: 140px;">
                    </div>

                    {{-- Follow-up Date Filter (To Date) --}}
                    <div class="col-12 col-sm-auto d-flex align-items-center gap-1.5">
                        <span class="text-muted fs-12 fw-semibold">To:</span>
                        <input type="date" name="to" class="form-control form-control-sm border-slate" value="{{ request('to') }}" style="font-size: 12px; width: 140px;">
                    </div>

                    {{-- NEW: Sort Dropdown (Only visible on Missed Tab) --}}
                    @if($tab === 'missed')
                    <div class="col-12 col-sm-auto d-flex align-items-center gap-1.5 ms-sm-1">
                        <span class="text-muted fs-12 fw-semibold"><i class="feather-bar-chart-2 text-primary me-1"></i>Sort:</span>
                        <select name="sort_dir" class="form-select form-select-sm border-slate" style="font-size: 12px; width: 125px; cursor: pointer;" onchange="this.form.submit()">
                            <option value="desc" {{ request('sort_dir', 'desc') == 'desc' ? 'selected' : '' }}>Newest Missed</option>
                            <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Oldest Missed</option>
                        </select>
                    </div>
                    @endif

                    {{-- Live Search Input with Suggestions Dropdown --}}
                    <div class="col-12 col-md position-relative">
                        <div class="input-group input-group-sm w-100">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="feather-search text-muted" id="search-icon"></i>
                                <span class="spinner-border spinner-border-sm text-primary d-none" id="search-spinner" role="status" style="width: 13px; height: 13px;"></span>
                            </span>
                            <input type="text" name="search" id="lead-live-search" class="form-control border-start-0"
                                placeholder="Search Name, Phone, Email, Company, Remark..."
                                value="{{ request('search') }}" autocomplete="off" style="font-size: 12px;">
                        </div>
                        <div id="search-suggestions-box" class="dropdown-menu shadow-lg w-100 mt-1 overflow-auto" style="max-height: 320px; display: none; z-index: 1050; border-radius: 8px;"></div>
                    </div>

                    {{-- Submit & Reset Buttons --}}
                    <div class="col-auto d-flex align-items-center gap-1">
                        <button type="submit" class="btn btn-sm btn-primary px-3 d-flex align-items-center gap-1 fw-semibold" style="font-size: 12px;">
                            <i class="feather-filter fs-11"></i> Filter
                        </button>
                        @if(request()->hasAny(['search', 'from', 'to']) && (request('search') || request('from') || request('to')))
                            <a href="{{ route('followups.index', ['tab' => $tab]) }}" class="btn btn-sm btn-light border text-danger px-2.5 d-flex align-items-center gap-1" title="Clear Filters" style="font-size: 12px;">
                                <i class="feather-x"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div></div>
        </div>

        {{-- Follow-ups Table Container --}}
        <div class="lead-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="lead-table-head">
                        <tr>
                            <th style="min-width: 240px;">Lead / Deal Info</th>
                            <th style="min-width: 170px;">Company</th>
                            <th style="min-width: 260px;">Comment</th>
                            <th style="min-width: 180px;">Follow-up Date</th>
                            <th class="text-center followup-action-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="lead-table-body" id="lead-table-body">
                        @forelse($followups as $item)
                            @php
                                $lead = $item->lead;
                                $user = optional($lead)->user;
                                $nextDate = $item->next_followup_date ? \Carbon\Carbon::parse($item->next_followup_date) : null;
                                $isMissed = $nextDate && $nextDate->isPast();
                                $statusName = optional($lead)->lead_status ?: optional(optional($lead)->bucket)->name ?: 'New';
                            @endphp
                            <tr id="followup-row-{{ $item->id }}">
                                {{-- Lead / Deal Info --}}
                                <td>
                                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                        <span class="fw-bold text-dark fs-13">{{ $user->name ?? 'N/A' }}</span>
                                        
                                        {{-- Lead / Deal Badge with Clear Styling --}}
                                        @if(optional($lead)->is_converted)
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill fs-10 px-2">
                                                <i class="feather-briefcase me-0.5"></i> Deal
                                            </span>
                                        @else
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill fs-10 px-2">
                                                <i class="feather-users me-0.5"></i> Lead
                                            </span>
                                        @endif

                                        {{-- Manage Tags Dropdown Button --}}
                                        @if($lead)
                                            <div class="dropdown d-inline-block">
                                                <button type="button" class="btn btn-xs btn-light border rounded-pill px-1.5 py-0.5 text-primary d-inline-flex align-items-center gap-1 shadow-2xs" data-bs-toggle="dropdown" data-bs-auto-close="outside" title="Manage Tags" style="font-size: 11px; line-height: 1;">
                                                    <i class="fas fa-tag"></i>
                                                    <span class="badge bg-primary text-white rounded-pill px-1 py-0 {{ ($lead->tags && $lead->tags->count() > 0) ? '' : 'd-none' }}" data-lead-tag-btn-badge="{{ $lead->id }}" style="font-size: 9px;">{{ $lead->tags ? $lead->tags->count() : 0 }}</span>
                                                </button>
                                                <div class="dropdown-menu p-2 shadow-lg border-0" style="min-width:220px;max-height:260px;overflow-y:auto;border-radius:10px;z-index:1050;">
                                                    <div class="d-flex align-items-center justify-content-between px-2 py-1 border-bottom mb-1">
                                                        <span class="small fw-bold text-dark fs-11 text-uppercase"><i class="fas fa-tags text-primary me-1"></i>Select Tags</span>
                                                        <a href="{{ route('tags.index') }}" target="_blank" class="text-primary text-decoration-none fs-10 fw-semibold" title="Tag Master">+ Manage</a>
                                                    </div>
                                                    @forelse(($allTags ?? collect()) as $tagOption)
                                                        <button type="button" class="dropdown-item rounded d-flex align-items-center justify-content-between py-1.5 px-2 mb-0.5" onclick="toggleLeadTag(event, {{ $lead->id }}, {{ $tagOption->id }}, this)" data-tag-name="{{ $tagOption->name }}" data-tag-color="{{ $tagOption->color }}">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <input class="form-check-input m-0 pe-none" type="checkbox" {{ $lead->tags && $lead->tags->contains('id', $tagOption->id) ? 'checked' : '' }}>
                                                                <span class="badge rounded-pill text-white fs-11" style="background-color: {{ $tagOption->color }}">{{ $tagOption->name }}</span>
                                                            </div>
                                                        </button>
                                                    @empty
                                                        <span class="dropdown-item-text text-muted small py-2 text-center d-block">No tags in Tag Master.</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-muted fs-11 mb-0.5 d-flex align-items-center">
                                        <i class="feather-phone text-primary me-1.5 flex-shrink-0"></i>
                                        <span>{{ $user->contact_no ?? 'N/A' }}</span>
                                    </div>
                                    @if(optional($user)->email)
                                        <div class="text-muted fs-11 text-truncate d-flex align-items-center" style="max-width:220px;" title="{{ $user->email }}">
                                            <i class="feather-mail text-primary me-1.5 flex-shrink-0"></i>
                                            <span class="text-truncate">{{ $user->email }}</span>
                                        </div>
                                    @endif

                                    {{-- Tag Badges Display --}}
                                    @if($lead)
                                        <div class="d-flex flex-wrap gap-1 mt-1" data-lead-tags-container="{{ $lead->id }}">
                                            @foreach(($lead->tags ?? []) as $tag)
                                                <span class="badge rounded-pill text-white fs-10 d-inline-flex align-items-center gap-1 shadow-2xs" style="background-color:{{ $tag->color }}" data-lead-tag="{{ $lead->id }}-{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                    <button type="button" class="border-0 bg-transparent text-white p-0 d-inline-flex align-items-center" style="font-size:11px;line-height:1;opacity:0.85;" title="Remove tag" onclick="removeLeadTag(event, {{ $lead->id }}, {{ $tag->id }}, this)"><i class="fas fa-times-circle"></i></button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                {{-- Company Name --}}
                                <td>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <i class="feather-briefcase text-secondary fs-12"></i>
                                        <span class="fw-semibold fs-12 text-dark">{{ optional($lead)->business_name ?: 'N/A' }}</span>
                                    </div>
                                    @if(optional($lead)->owner)
                                        <div class="text-muted fs-10 mt-1 d-flex align-items-center gap-1">
                                            <i class="feather-user fs-10"></i> Owner: {{ optional($lead)->owner->name }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Comment --}}
                                <td>
                                    <div class="fs-12 text-dark mb-1" style="line-height:1.4;white-space:normal;overflow-wrap:anywhere;">
                                        {{ $item->message ?: 'No remark added.' }}
                                    </div>
                                </td>

                                {{-- Follow-up Date --}}
                                <td>
                                    @if($nextDate)
                                        <div class="fw-bold fs-12 {{ $isMissed ? 'text-danger' : 'text-primary' }} d-flex align-items-center gap-1">
                                            <i class="feather-calendar"></i>
                                            <span>{{ $nextDate->format('d M Y, h:i A') }}</span>
                                        </div>
                                        <span class="badge {{ $isMissed ? 'bg-danger-subtle text-danger border-danger-subtle' : 'bg-success-subtle text-success border-success-subtle' }} border mt-1 fs-10">
                                            {{ $isMissed ? 'Missed (' . $nextDate->diffForHumans() . ')' : 'Upcoming (' . $nextDate->diffForHumans() . ')' }}
                                        </span>
                                    @else
                                        <span class="text-muted fs-12">N/A</span>
                                    @endif
                                </td>

                                {{-- Action Buttons --}}
                                <td class="text-center followup-action-cell">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1.5 flex-wrap">
                                        <button type="button" class="table-action-btn text-success border-success-subtle" 
                                                onclick="markFollowupDone({{ $item->id }}, this)" title="Mark follow-up complete">
                                            <i class="feather-check"></i>
                                        </button>

                                        @if($lead)
                                            {{-- Edit Lead Modal --}}
                                            <button type="button" class="table-action-btn text-success" title="Edit Details"
                                                    onclick="openLeadEditModal({{ $lead->id }})">
                                                <i class="feather-edit"></i>
                                            </button>

                                            {{-- View Comments --}}
                                            <button type="button" class="table-action-btn text-warning" 
                                                    onclick="openCommentsModal({{ $lead->id }}, '{{ addslashes($user->name ?? 'Lead') }}')"
                                                    title="View Comments & History">
                                                <i class="feather-message-square"></i>
                                            </button>

                                            {{-- Convert to Deal (for Leads) 
                                            @unless($lead->is_converted)
                                                <button type="button" class="table-action-btn text-warning" 
                                                        onclick="convertFollowupToDeal({{ $item->id }}, this)"
                                                        title="Convert to Deal">
                                                    <i class="feather-briefcase"></i>
                                                </button>
                                            @endunless --}}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="feather-calendar fs-1 text-secondary opacity-50 mb-2 d-block"></i>
                                    <p class="fs-13 mb-0 fw-semibold">No {{ $tab }} follow-ups found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="lead-infinite-loader"
             class="lead-infinite-loader"
             data-next-page="{{ $followups->nextPageUrl() }}">
            @if($followups->hasMorePages())
                <span class="spinner-border text-primary d-none" role="status" aria-hidden="true"></span>
                <span class="loader-message">Scroll down to load more follow-ups</span>
            @elseif($followups->count())
                <span class="loader-message">All follow-ups loaded</span>
            @endif
        </div>

        {{-- Pagination (fallback hidden for infinite scroll) --}}
        <div class="d-none align-items-center justify-content-between mt-3 px-1" aria-hidden="true">
            <div class="text-muted fs-12">
                Showing {{ $followups->firstItem() ?? 0 }} to {{ $followups->lastItem() ?? 0 }} of {{ $followups->total() }} entries
            </div>
            <div>
                {{ $followups->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- Schedule Next Follow-up Modal --}}
<div class="modal fade" id="nextFollowupModal" tabindex="-1" aria-labelledby="nextFollowupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white px-4 py-3" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%);">
                <h6 class="modal-title fw-bold text-white mb-0 fs-14" id="nextFollowupModalLabel">
                    <i class="feather-calendar me-1.5"></i> Schedule Next Follow-up
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="nextFollowupForm">
                @csrf
                <input type="hidden" id="next-followup-id">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold fs-12 mb-1">Next Follow-up Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" name="next_followup_date" id="next-followup-date" required style="border-radius: 8px; border-color: #cbd5e1;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold fs-12 mb-1">Follow-up Message / Remark</label>
                        <textarea class="form-control" name="message" id="next-followup-message" rows="3" placeholder="Remark for next follow-up..." style="border-radius: 8px; border-color: #cbd5e1; font-size: 13px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-2.5">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary px-4 fw-semibold">Save & Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Shared Interaction Modals (Edit Lead Modal, Quick Status Offcanvas, Comments, View Details) --}}
@include('crm.lead.partials.lead-interaction-modals')

@push('scripts')
@include('crm.lead.partials.lead-interaction-scripts')

<script>
    function showFollowupToast(icon, title) {
        if (window.Swal) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 1600,
                timerProgressBar: true
            });
        } else {
            alert(title);
        }
    }

    async function markFollowupDone(followupId, button) {
        if (window.Swal) {
            const res = await Swal.fire({
                title: 'Mark this follow-up as done?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Done',
                cancelButtonText: 'Cancel'
            });
            if (!res.isConfirmed) return;
        }

        if (button) button.disabled = true;
        try {
            const response = await fetch("{{ url('/followups') }}/" + followupId + "/mark-done", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Action failed');
            
            showFollowupToast('success', data.message);
            const row = document.getElementById('followup-row-' + followupId);
            if (row) {
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '0.3';
                setTimeout(() => row.remove(), 400);
            }
        } catch (error) {
            if (button) button.disabled = false;
            showFollowupToast('error', error.message);
        }
    }

    function markFollowupDoneCheckbox(followupId, checkbox) {
        if (!checkbox.checked) return;
        markFollowupDone(followupId, checkbox);
    }

    function openNextFollowupModal(followupId, currentMessage) {
        document.getElementById('next-followup-id').value = followupId;
        document.getElementById('next-followup-message').value = currentMessage || '';
        document.getElementById('next-followup-date').value = '';
        bootstrap.Modal.getOrCreateInstance(document.getElementById('nextFollowupModal')).show();
    }

    document.getElementById('nextFollowupForm')?.addEventListener('submit', async function (event) {
        event.preventDefault();
        const followupId = document.getElementById('next-followup-id').value;
        const submitButton = this.querySelector('[type="submit"]');
        submitButton.disabled = true;

        try {
            const response = await fetch("{{ url('/followups') }}/" + followupId + "/reschedule", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(this)
            });
            const data = await response.json();
            if (!response.ok || !data.status) {
                const validationMessage = data.errors ? Object.values(data.errors).flat()[0] : data.message;
                throw new Error(validationMessage || 'Unable to schedule follow-up');
            }
            bootstrap.Modal.getInstance(document.getElementById('nextFollowupModal'))?.hide();
            showFollowupToast('success', data.message);
            setTimeout(() => window.location.reload(), 600);
        } catch (error) {
            showFollowupToast('error', error.message);
        } finally {
            submitButton.disabled = false;
        }
    });

    async function convertFollowupToDeal(followupId, button) {
        if (window.Swal) {
            const result = await Swal.fire({
                title: 'Convert lead to deal?',
                text: 'This follow-up lead will be converted to Deal immediately.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Convert',
                cancelButtonText: 'Cancel'
            });
            if (!result.isConfirmed) return;
        }

        button.disabled = true;
        try {
            const response = await fetch("{{ url('/followups') }}/" + followupId + "/convert-deal", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Lead conversion failed');
            showFollowupToast('success', data.message);
            setTimeout(() => window.location.reload(), 700);
        } catch (error) {
            button.disabled = false;
            showFollowupToast('error', error.message);
        }
    }

    // Live Search Suggestions Script
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('lead-live-search');
        const suggestionsBox = document.getElementById('search-suggestions-box');
        const searchIcon = document.getElementById('search-icon');
        const searchSpinner = document.getElementById('search-spinner');
        const followupForm = document.getElementById('followupSearchForm');

        if (!searchInput || !suggestionsBox) return;

        let debounceTimer;
        let selectedIndex = -1;

        function showSpinner() {
            if (searchIcon) searchIcon.classList.add('d-none');
            if (searchSpinner) searchSpinner.classList.remove('d-none');
        }

        function hideSpinner() {
            if (searchSpinner) searchSpinner.classList.add('d-none');
            if (searchIcon) searchIcon.classList.remove('d-none');
        }

        function getItems() {
            return suggestionsBox.querySelectorAll('.search-suggestion-item');
        }

        function updateActiveItem() {
            const items = getItems();
            items.forEach((item, idx) => {
                if (idx === selectedIndex) {
                    item.classList.add('active');
                    item.style.backgroundColor = '#f1f5f9';
                    item.style.borderLeft = '4px solid #006FC9';
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.classList.remove('active');
                    item.style.backgroundColor = '';
                    item.style.borderLeft = '';
                }
            });
        }

        searchInput.addEventListener('keydown', function(e) {
            if (suggestionsBox.style.display === 'none') return;
            const items = getItems();
            if (!items || items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = (selectedIndex + 1) < items.length ? selectedIndex + 1 : 0;
                updateActiveItem();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = (selectedIndex - 1) >= 0 ? selectedIndex - 1 : items.length - 1;
                updateActiveItem();
            } else if (e.key === 'Enter') {
                if (selectedIndex >= 0 && items[selectedIndex]) {
                    e.preventDefault();
                    items[selectedIndex].click();
                }
            } else if (e.key === 'Escape') {
                suggestionsBox.style.display = 'none';
                selectedIndex = -1;
            }
        });

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            selectedIndex = -1;
            const query = this.value.trim();

            if (query.length < 1) {
                hideSpinner();
                suggestionsBox.innerHTML = '';
                suggestionsBox.style.display = 'none';
                return;
            }

            showSpinner();
            suggestionsBox.innerHTML = `
                <div class="dropdown-item text-muted small p-2.5 text-center">
                    <span class="spinner-border spinner-border-sm me-2 text-primary" role="status" style="width: 13px; height: 13px;"></span> Searching matching leads...
                </div>`;
            suggestionsBox.style.display = 'block';

            debounceTimer = setTimeout(() => {
                fetch(`{{ route('modern.leads.search.suggestions') }}?search=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        hideSpinner();
                        selectedIndex = -1;
                        if (!data || data.length === 0) {
                            suggestionsBox.innerHTML = '<div class="dropdown-item text-muted small p-2.5"><i class="feather-info me-1 text-warning"></i> No matching leads found</div>';
                            suggestionsBox.style.display = 'block';
                            return;
                        }

                        let html = '';
                        data.forEach(item => {
                            const selectVal = (item.contact_no && item.contact_no !== 'N/A' && item.contact_no.trim() !== '') 
                                ? item.contact_no 
                                : ((item.email && item.email.trim() !== '') ? item.email : item.name);

                            html += `
                                <a href="javascript:void(0);" class="dropdown-item py-2 px-3 border-bottom search-suggestion-item text-decoration-none" data-value="${selectVal}">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="text-dark fs-13">${item.name}</strong>
                                        <span class="badge ${item.is_converted ? 'bg-warning-subtle text-warning' : 'bg-primary-subtle text-primary'} border fs-10">${item.is_converted ? 'Deal' : 'Lead'}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 text-muted fs-11">
                                        ${item.contact_no ? `<span><i class="feather-phone me-1 text-primary"></i>${item.contact_no}</span>` : ''}
                                        ${item.email ? `<span><i class="feather-mail me-1 text-primary"></i>${item.email}</span>` : ''}
                                        ${item.business_name ? `<span><i class="feather-briefcase me-1 text-secondary"></i>${item.business_name}</span>` : ''}
                                    </div>
                                </a>`;
                        });
                        suggestionsBox.innerHTML = html;
                        suggestionsBox.style.display = 'block';

                        suggestionsBox.querySelectorAll('.search-suggestion-item').forEach(item => {
                            item.addEventListener('click', function(e) {
                                e.preventDefault();
                                searchInput.value = this.dataset.value || '';
                                suggestionsBox.style.display = 'none';
                                if (followupForm) followupForm.submit();
                            });
                        });
                    })
                    .catch(() => {
                        hideSpinner();
                        suggestionsBox.style.display = 'none';
                    });
            }, 300);
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.style.display = 'none';
                selectedIndex = -1;
            }
        });
    });
</script>
@endpush
@endsection
