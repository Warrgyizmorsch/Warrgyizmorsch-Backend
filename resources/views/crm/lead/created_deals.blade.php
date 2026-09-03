@extends('layouts.app')

@section('title', 'Created Deals - CRM')

@push('styles')
<style>
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
    }

    .lead-status-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .lead-status-tab.status-primary { background-color: #e0f2fe; color: #0369a1; border-color: #bae6fd; }
    .lead-status-tab.status-primary:hover, .lead-status-tab.status-primary.is-active { background-color: #0284c7; color: #ffffff; }

    .pipeline-pill-badge {
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .pipeline-pill-hot { background-color: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; }
    .pipeline-pill-warm { background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .pipeline-pill-cold { background-color: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; }
    .pipeline-pill-dead { background-color: #f1f5f9; color: #64748b; border: 1px solid #cbd5e1; }
    .pipeline-pill-new { background-color: #e0e7ff; color: #4f46e5; border: 1px solid #c7d2fe; }

    .engagement-dropdown-menu .dropdown-item {
        padding: 6px 12px;
        font-size: 12px;
    }

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
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
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
        padding: 12px 16px;
    }
    .lead-table-body td {
        padding: 12px 16px;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .lead-table-body tr:last-child td {
        border-bottom: none;
    }
    .lead-table-body tr:hover td {
        background-color: #f8fafc;
    }
</style>
@endpush

@section('content')
<div class="nxl-content">
    {{-- Header Component --}}
    <x-lead.tools :title="'Created Deals'" :buckets="$childBuckets" :filterBucket="$childBuckets" :totalLeadsCount="$totalDealsCount" />

    <div class="main-content px-3 py-2">
        {{-- Header Status Strip --}}
        <div class="lead-tab-strip">
            <div class="lead-tab-scroll d-flex align-items-center gap-2">
                <a href="{{ route('created.deals.index', request()->except('bucket_id', 'lead_status', 'page')) }}"
                   class="lead-status-tab status-primary {{ !request('bucket_id') && !request('lead_status') ? 'is-active' : '' }}">
                    <i class="feather-grid"></i> ALL ({{ $totalDealsCount }})
                </a>

                @foreach($childBuckets as $b)
                    @php
                        $isActive = (request('bucket_id') == $b->id || strtolower(trim(request('lead_status'))) == strtolower(trim($b->name)));
                    @endphp
                    <a href="{{ route('created.deals.index', array_merge(request()->except('bucket_id', 'lead_status', 'page'), ['bucket_id' => $b->id])) }}"
                       class="lead-status-tab status-primary {{ $isActive ? 'is-active' : '' }}">
                       <span class="status-dot"></span> {{ $b->name }} ({{ $b->leads_count ?? 0 }})
                    </a>
                @endforeach
            </div>
        </div>

        {{-- List Toolbar --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 px-1">
            <div class="d-flex align-items-center gap-3">
                <div class="form-check me-2">
                    <input type="checkbox" id="selectAll" class="form-check-input">
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="mb-0 text-muted fs-13">Show</label>
                    <form method="GET">
                        @foreach(request()->except('per_page', 'page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="per_page" class="form-select form-select-sm border-slate rounded-2" onchange="this.form.submit()" style="width: 75px;">
                            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            <option value="250" {{ request('per_page') == 250 ? 'selected' : '' }}>250</option>
                            <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500</option>
                        </select>
                    </form>
                    <span class="text-muted fs-13">Entries</span>
                </div>

                {{-- Engagement Filters --}}
                <div class="d-flex align-items-center gap-1 ms-2">
                    <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => '']) }}" 
                       class="btn btn-xs {{ empty(request('lead_engagement_status')) ? 'btn-primary' : 'btn-light border' }} rounded-pill px-3">ALL</a>
                    <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'hot']) }}" 
                       class="btn btn-xs {{ request('lead_engagement_status') == 'hot' ? 'btn-danger' : 'btn-light border' }} rounded-pill px-3">🔥 HOT</a>
                    <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'warm']) }}" 
                       class="btn btn-xs {{ request('lead_engagement_status') == 'warm' ? 'btn-warning' : 'btn-light border' }} rounded-pill px-3">⚡ WARM</a>
                    <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'cold']) }}" 
                       class="btn btn-xs {{ request('lead_engagement_status') == 'cold' ? 'btn-info' : 'btn-light border' }} rounded-pill px-3">❄️ COLD</a>
                    <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'dead']) }}" 
                       class="btn btn-xs {{ request('lead_engagement_status') == 'dead' ? 'btn-secondary' : 'btn-light border' }} rounded-pill px-3">💀 DEAD</a>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <form method="GET" class="d-flex align-items-center gap-2">
                    @foreach(request()->except('search', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <div class="input-group input-group-sm" style="width: 260px;">
                        <input type="text" name="search" class="form-control border-slate" placeholder="Search name, phone, email..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="feather-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="lead-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="lead-table-head">
                        <tr>
                            <th style="width: 40px;"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                            <th>Lead Info</th>
                            <th>Status / Sub Status</th>
                            <th>Engagement</th>
                            <th>Owner</th>
                            <th>Created Date</th>
                            <th class="text-end" style="min-width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="lead-table-body">
                        @forelse($leads as $index => $lead)
                            @php
                                $statusName = $lead->lead_status ?: optional($lead->bucket)->name ?: 'Deal Created';
                                $eng = strtolower(trim($lead->lead_engagement_status ?? ''));
                                $engPillClass = match($eng) {
                                    'hot' => 'pipeline-pill-hot',
                                    'warm' => 'pipeline-pill-warm',
                                    'cold' => 'pipeline-pill-cold',
                                    'dead' => 'pipeline-pill-dead',
                                    default => 'pipeline-pill-new',
                                };
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input lead-checkbox" value="{{ $lead->id }}">
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1.5">
                                        <div class="fw-bold text-dark fs-13 d-flex align-items-center gap-1.5 mb-0.5">
                                            <span>{{ optional($lead->user)->name ?? 'N/A' }}</span>
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
                                                                <input class="form-check-input m-0 pe-none" type="checkbox" {{ $lead->tags->contains('id', $tagOption->id) ? 'checked' : '' }}>
                                                                <span class="badge rounded-pill text-white fs-11" style="background-color: {{ $tagOption->color }}">{{ $tagOption->name }}</span>
                                                            </div>
                                                        </button>
                                                    @empty
                                                        <span class="dropdown-item-text text-muted small py-2 text-center d-block">No tags in Tag Master.</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                            @if($lead->duplicate_count > 0)
                                                <span class="badge bg-danger-subtle text-danger rounded-pill fs-10" title="Duplicate Lead">
                                                    Dup ({{ $lead->duplicate_count }})
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-muted fs-11 d-flex align-items-center">
                                            <i class="feather-phone text-primary me-2 flex-shrink-0 d-inline-flex justify-content-center" style="width: 16px;"></i>
                                            <span>{{ optional($lead->user)->contact_no ?? 'N/A' }}</span>
                                        </div>
                                        @if(optional($lead->user)->email)
                                            <div class="text-muted fs-11 d-flex align-items-center">
                                                <i class="feather-mail text-primary me-2 flex-shrink-0 d-inline-flex justify-content-center" style="width: 16px;"></i>
                                                <span class="text-truncate" style="max-width: 220px;" title="{{ optional($lead->user)->email }}">{{ optional($lead->user)->email }}</span>
                                            </div>
                                        @endif
                                        @if($lead->business_name)
                                            <div class="text-muted fs-11 d-flex align-items-center">
                                                <i class="feather-briefcase text-secondary me-2 flex-shrink-0 d-inline-flex justify-content-center" style="width: 16px;"></i>
                                                <span class="text-truncate" style="max-width: 220px;" title="{{ $lead->business_name }}">{{ $lead->business_name }}</span>
                                            </div>
                                        @endif
                                        <div class="d-flex flex-wrap gap-1 mt-1" data-lead-tags-container="{{ $lead->id }}">
                                                @foreach($lead->tags as $tag)
                                                    <span class="badge rounded-pill text-white fs-10 d-inline-flex align-items-center gap-1 shadow-2xs" style="background-color:{{ $tag->color }}" data-lead-tag="{{ $lead->id }}-{{ $tag->id }}">
                                                        {{ $tag->name }}
                                                        <button type="button" class="border-0 bg-transparent text-white p-0 d-inline-flex align-items-center" style="font-size:11px;line-height:1;opacity:0.85;" title="Remove tag" onclick="removeLeadTag(event, {{ $lead->id }}, {{ $tag->id }}, this)"><i class="fas fa-times-circle"></i></button>
                                                    </span>
                                                @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle fs-11 fw-bold w-auto d-inline-block text-start">
                                            <i class="feather-award me-1"></i> {{ $statusName }}
                                        </span>
                                        @if($lead->bucket && $lead->bucket->parent)
                                            <span class="text-muted fs-10">
                                                Parent: {{ $lead->bucket->parent->name }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <a href="javascript:void(0);" 
                                           class="pipeline-pill-badge {{ $engPillClass }} dropdown-toggle text-decoration-none" 
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            <span>{{ ucfirst($eng ?: 'New') }}</span>
                                        </a>
                                        <ul class="dropdown-menu engagement-dropdown-menu shadow-sm border-0">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'new', this)"><span class="pipeline-pill-badge pipeline-pill-new">New</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'hot', this)"><span class="pipeline-pill-badge pipeline-pill-hot">🔥 Hot</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'warm', this)"><span class="pipeline-pill-badge pipeline-pill-warm">⚡ Warm</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'cold', this)"><span class="pipeline-pill-badge pipeline-pill-cold">❄️ Cold</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'dead', this)"><span class="pipeline-pill-badge pipeline-pill-dead">💀 Dead</span></a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1.5">
                                        <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold fs-11" style="width: 24px; height: 24px;">
                                            {{ strtoupper(substr(optional($lead->owner)->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="fs-12 text-dark">{{ optional($lead->owner)->name ?? 'Unassigned' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted fs-12">{{ $lead->created_at ? $lead->created_at->format('d M Y') : 'N/A' }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        {{-- Edit Status Offcanvas Button --}}
                                        <button type="button" class="table-action-btn text-primary" 
                                                onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 46 }})"
                                                title="Edit Status">
                                            <i class="feather-sliders"></i>
                                        </button>

                                        {{-- Edit Lead Button --}}
                                        <a href="{{ route('lead.edit', $lead->id) }}" class="table-action-btn text-success" title="Edit Lead">
                                            <i class="feather-edit"></i>
                                        </a>

                                        {{-- View Details Modal --}}
                                        <button type="button" class="table-action-btn text-info" 
                                                onclick="openViewDetailsModalLazy({{ $lead->id }})"
                                                title="View Details">
                                            <i class="feather-eye"></i>
                                        </button>

                                        {{-- View Comments / Messages --}}
                                        <button type="button" class="table-action-btn text-warning" 
                                                onclick="openCommentsModal({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'Lead') }}')"
                                                title="View Comments & History">
                                            <i class="feather-message-square"></i>
                                        </button>

                                        {{-- To-Do Task --}}
                                        <button type="button" class="table-action-btn text-purple" 
                                                onclick="openTodoOffcanvas({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'Lead') }}')"
                                                title="To-Do Task">
                                            <i class="feather-check-square"></i>
                                        </button>

                                        {{-- Delete Lead --}}
                                        <form action="{{ route('lead.destroy', $lead->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this deal?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="table-action-btn text-danger" title="Delete Lead">
                                                <i class="feather-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="feather-award fs-2 mb-2 d-block text-secondary"></i>
                                    No created deals found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex align-items-center justify-content-between mt-3 px-1">
            <div class="text-muted fs-12">
                Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} entries
            </div>
            <div>
                {{ $leads->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- Shared Edit Status Offcanvas --}}
<div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas" aria-labelledby="editStatusOffcanvasLabel" style="width: 420px; background: #f8fafc;">
    <div class="offcanvas-header border-bottom bg-white py-3 px-4 shadow-2xs">
        <div class="d-flex align-items-center gap-2.5">
            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-13 shadow-2xs" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
                <h6 class="offcanvas-title fw-bold text-dark mb-0 fs-14" id="editStatusOffcanvasLabel">Edit Status</h6>
                <span class="fs-11 text-muted">Lead: <strong class="text-dark text-capitalize" id="sharedEditStatusLeadName">User</strong></span>
            </div>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3.5">
        <form id="sharedQuickUpdateForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lead_bucket_id" value="46">
            
            {{-- Status & Engagement Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-sliders text-primary fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Status & Engagement</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-fire text-danger me-1 fs-10"></i>Engagement Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="lead_engagement_status" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Engagement Status</option>
                            <option value="hot">🔥 Hot</option>
                            <option value="warm">⚡ Warm</option>
                            <option value="cold">❄️ Cold</option>
                            <option value="dead">💀 Dead</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-tag text-primary me-1 fs-10"></i>Lead Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="main_lead_status" id="editStatusMainSelect" onchange="onOffcanvasMainStatusChange(this.value)" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Lead Status</option>
                            @if(isset($childBuckets) && count($childBuckets) > 0)
                                @foreach($childBuckets as $mainBucket)
                                    <option value="{{ $mainBucket->name }}">{{ $mainBucket->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-tags text-info me-1 fs-10"></i>Sub Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="sub_lead_status" id="editStatusSubSelect" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="">Select Sub Status (Optional)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Communication Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-comments text-info fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Communication & Comment</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Communication Type</label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_type" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Communication Type</option>
                            <option value="Call">Call</option>
                            <option value="WhatsApp Call">WhatsApp Call</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Email">Email</option>
                            <option value="Meeting">Meeting</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Communication Status</label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_status" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Communication Status</option>
                            <option value="Answered">Answered</option>
                            <option value="Unanswered">Unanswered</option>
                            <option value="Busy">Busy</option>
                            <option value="Switched Off">Switched Off</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Add Comment / Message</label>
                        <textarea class="form-control border-slate shadow-2xs fs-13" name="message" rows="3" placeholder="Write a comment or message..." style="border-color: #cbd5e1; border-radius: 8px; resize: none;"></textarea>
                    </div>
                </div>
            </div>

            {{-- Next Followup Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check text-warning fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Next Follow-up & Attachments</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Next Follow-up Date & Time</label>
                        <input type="datetime-local" class="form-control border-slate shadow-2xs fs-13" name="next_followup_date" style="border-color: #cbd5e1; border-radius: 8px;">
                    </div>
                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Attachments (Multiple PDF/Doc/Images)</label>
                        <input type="file" class="form-control border-slate shadow-2xs fs-12" name="followup_documents[]" multiple style="border-color: #cbd5e1; border-radius: 8px;">
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top mt-4">
                <button type="button" class="btn btn-light text-secondary fw-semibold border px-3 py-1.5 fs-13" data-bs-dismiss="offcanvas">CLOSE</button>
                <button type="submit" class="btn text-white fw-bold px-4 py-1.5 fs-13 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%); border: none; border-radius: 6px;">
                    <i class="fas fa-check-circle fs-12"></i> UPDATE STATUS
                </button>
            </div>
        </form>
    </div>
</div>

{{-- View Lead Details Modal --}}
<div class="modal fade" id="viewLeadDetailsModal" tabindex="-1" aria-labelledby="viewLeadDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header border-0 px-4 py-3 text-white" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 38px; height: 38px;">
                        <i class="feather-user fs-5 text-white"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0 fs-15" id="vd_leadName">Lead Details</h5>
                        <small class="text-white opacity-75 fs-11" id="vd_leadSubtitle">Complete Information</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background: #f8fafc;">
                <!-- Status Badges -->
                <div class="d-flex flex-wrap gap-2 mb-3" id="vd_badges"></div>

                <!-- Personal Info -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-user me-1"></i> Personal & Contact Information</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_personalInfo"></div>
                    </div>
                </div>

                <!-- Lead Information -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-target me-1"></i> Lead Information & Campaign</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_leadInfo"></div>
                    </div>
                </div>

                <!-- Address Details -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-map-pin me-1"></i> Address Details</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_addressInfo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top bg-white px-4 py-2.5">
                <button type="button" class="btn btn-light text-secondary border px-4 fs-13 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Comments & History Modal --}}
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header border-0 px-4 py-3 text-white" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 38px; height: 38px;">
                        <i class="feather-message-square fs-5 text-white"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0 fs-15" id="cm_leadName">Comments & History</h5>
                        <small class="text-white opacity-75 fs-11">All Activity Logs & Remarks</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3.5" style="background: #f8fafc;" id="cm_body">
                <div class="text-center py-4 text-muted fs-13"><i class="feather-loader spinner-border spinner-border-sm me-2"></i> Loading comments...</div>
            </div>
            <div class="modal-footer border-top bg-white px-4 py-2.5">
                <button type="button" class="btn btn-light text-secondary border px-4 fs-13 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Shared To-Do Offcanvas --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="todoOffcanvas" style="width: 420px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark" style="font-size: 18px;">To-Do Task</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-4" style="background-color: #f8fafc;">
            <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Add New To-Do Task:</h6>
            <form id="sharedTodoForm" action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted mb-1" style="font-size: 13px;">Summary:</label>
                    <textarea class="form-control" name="summary" rows="3" placeholder="Write Your Summary" required style="font-size: 14px; border-color: #cbd5e1;"></textarea>
                </div>
                @if(auth()->check() && auth()->user()->role_id == 1)
                    <div class="mb-3">
                        <label class="form-label text-muted mb-1" style="font-size: 13px;">Assign To</label>
                        <select class="form-select" name="assign_to" required style="font-size: 14px; border-color: #cbd5e1;">
                            <option value="" disabled selected>Select User</option>
                            @if(isset($owners))
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label text-muted mb-1" style="font-size: 13px;">Due Date</label>
                    <input type="datetime-local" class="form-control" name="due_date" required style="font-size: 14px; border-color: #cbd5e1;">
                </div>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-warning fw-bold px-4 py-2" style="font-size: 13px;">SAVE TO-DO</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const leadStatusMap = @json(
        (isset($childBuckets) ? $childBuckets : collect())->mapWithKeys(function($b) {
            return [$b->name => [
                'id' => $b->id,
                'children' => $b->children ? $b->children->map(function($c) {
                    return ['id' => $c->id, 'name' => $c->name];
                })->values()->toArray() : []
            ]];
        })
    );

    function onOffcanvasMainStatusChange(selectedMainStatus, preselectedSubStatus = '') {
        const subSelect = document.getElementById('editStatusSubSelect');
        if (!subSelect) return;
        subSelect.innerHTML = '';
        
        const parentData = leadStatusMap[selectedMainStatus];
        if (parentData && parentData.children && parentData.children.length > 0) {
            let defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.textContent = 'Select Sub Status (Optional)';
            subSelect.appendChild(defaultOpt);
            
            parentData.children.forEach(child => {
                let opt = document.createElement('option');
                opt.value = child.name;
                opt.textContent = child.name;
                opt.dataset.bucketId = child.id;
                if (preselectedSubStatus && preselectedSubStatus.toLowerCase() === child.name.toLowerCase()) {
                    opt.selected = true;
                }
                subSelect.appendChild(opt);
            });
            subSelect.disabled = false;
        } else {
            let defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.textContent = 'No Sub Status Available';
            subSelect.appendChild(defaultOpt);
            subSelect.disabled = true;
        }
    }

    function openEditStatusOffcanvas(leadId, leadStatus, engagementStatus, bucketId) {
        let offcanvasEl = document.getElementById('editStatusOffcanvas');
        let form = document.getElementById('sharedQuickUpdateForm');
        form.action = "{{ url('/modern-leads/quick-update') }}/" + leadId;
        
        let engSelect = form.querySelector('[name="lead_engagement_status"]');
        if (engSelect) engSelect.value = (engagementStatus || '').toLowerCase();
        
        let mainSelect = document.getElementById('editStatusMainSelect');
        let subSelect = document.getElementById('editStatusSubSelect');
        let matchedMainStatus = '';
        let matchedSubStatus = '';

        for (let mainName in leadStatusMap) {
            if (mainName.toLowerCase() === (leadStatus || '').toLowerCase()) {
                matchedMainStatus = mainName;
                break;
            }
            let children = leadStatusMap[mainName].children || [];
            let foundChild = children.find(c => c.name.toLowerCase() === (leadStatus || '').toLowerCase());
            if (foundChild) {
                matchedMainStatus = mainName;
                matchedSubStatus = foundChild.name;
                break;
            }
        }

        if (!matchedMainStatus && mainSelect && mainSelect.options.length > 1) {
            matchedMainStatus = mainSelect.options[1].value;
        }

        if (mainSelect) mainSelect.value = matchedMainStatus;
        onOffcanvasMainStatusChange(matchedMainStatus, matchedSubStatus);
        
        let bucketInput = form.querySelector('[name="lead_bucket_id"]');
        if (bucketInput) bucketInput.value = bucketId || 46;

        form.onsubmit = function() {
            let subVal = subSelect ? subSelect.value : '';
            let mainVal = mainSelect ? mainSelect.value : '';
            let finalStatus = subVal ? subVal : mainVal;
            
            let hiddenStatusInput = form.querySelector('input[name="lead_status"]');
            if (!hiddenStatusInput) {
                hiddenStatusInput = document.createElement('input');
                hiddenStatusInput.type = 'hidden';
                hiddenStatusInput.name = 'lead_status';
                form.appendChild(hiddenStatusInput);
            }
            hiddenStatusInput.value = finalStatus;

            if (subSelect && subSelect.selectedIndex >= 0) {
                let selectedOpt = subSelect.options[subSelect.selectedIndex];
                if (selectedOpt && selectedOpt.dataset.bucketId) {
                    if (bucketInput) bucketInput.value = selectedOpt.dataset.bucketId;
                }
            }
        };

        let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        bsOffcanvas.show();
    }

    function updateLeadEngagement(leadId, newEngagement, element) {
        fetch("{{ url('/modern-leads/quick-update') }}/" + leadId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new URLSearchParams({
                'lead_engagement_status': newEngagement
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            }
        });
    }

    function openTodoOffcanvas(leadId, leadName) {
        let form = document.getElementById('sharedTodoForm');
        form.action = "{{ url('/modern-leads/todo') }}/" + leadId;
        let offcanvasEl = document.getElementById('todoOffcanvas');
        let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
        bsOffcanvas.show();
    }

    function openViewDetailsModalLazy(leadId) {
        let modalEl = document.getElementById('viewLeadDetailsModal');
        let bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        
        document.getElementById('vd_leadName').textContent = 'Loading Details...';
        document.getElementById('vd_leadSubtitle').textContent = 'Lead #' + leadId;
        document.getElementById('vd_badges').innerHTML = '';
        document.getElementById('vd_personalInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_leadInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_addressInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        
        bsModal.show();

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let lead = data.lead || {};
                    let user = data.user || {};
                    let owner = data.owner || {};

                    document.getElementById('vd_leadName').textContent = user.name || 'N/A';
                    document.getElementById('vd_leadSubtitle').textContent = (lead.business_name || 'No Business') + ' • Lead ID: #' + lead.id;

                    // Badges
                    let badgesHtml = '';
                    let bucket = lead.bucket ? lead.bucket.name : 'N/A';
                    badgesHtml += `<span class="badge bg-primary-subtle text-primary border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-layers me-1"></i> Bucket: ${bucket}</span>`;
                    if (lead.lead_status) {
                        badgesHtml += `<span class="badge bg-success-subtle text-success border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-flag me-1"></i> Status: ${lead.lead_status}</span>`;
                    }
                    let eng = (lead.lead_engagement_status || 'New').toUpperCase();
                    badgesHtml += `<span class="badge bg-warning-subtle text-warning border px-2.5 py-1 fs-11 fw-semibold"><i class="feather-zap me-1"></i> Engagement: ${eng}</span>`;
                    document.getElementById('vd_badges').innerHTML = badgesHtml;

                    // Helper field renderer
                    function fItem(icon, label, value) {
                        let val = (value && value !== 'null' && value !== 'undefined') ? value : 'N/A';
                        return `
                            <div class="col-md-4 col-sm-6">
                                <div class="p-2 border rounded bg-light">
                                    <div class="text-muted fs-10 text-uppercase fw-bold mb-0.5"><i class="${icon} me-1 text-primary"></i> ${label}</div>
                                    <div class="fw-semibold text-dark fs-12 text-truncate" title="${val}">${val}</div>
                                </div>
                            </div>`;
                    }

                    // Personal & Contact Info
                    let pInfo = '';
                    pInfo += fItem('feather-user', 'Full Name', user.name);
                    pInfo += fItem('feather-phone', 'Contact No.', user.contact_no);
                    pInfo += fItem('feather-mail', 'Email', user.email);
                    pInfo += fItem('feather-briefcase', 'Business Name', lead.business_name);
                    pInfo += fItem('feather-hash', 'GST Number', lead.gst_number);
                    pInfo += fItem('feather-globe', 'Website', lead.website);
                    document.getElementById('vd_personalInfo').innerHTML = pInfo;

                    // Lead Info & Campaign
                    let lInfo = '';
                    lInfo += fItem('feather-layers', 'Bucket', bucket);
                    lInfo += fItem('feather-flag', 'Status', lead.lead_status);
                    lInfo += fItem('feather-zap', 'Engagement', lead.lead_engagement_status);
                    lInfo += fItem('feather-user-check', 'Owner', owner.name || 'Unassigned');
                    lInfo += fItem('feather-target', 'Campaign Name', lead.campaign_name);
                    lInfo += fItem('feather-grid', 'Adset Name', lead.adset_name);
                    lInfo += fItem('feather-tv', 'Ad Name', lead.ad_name);
                    lInfo += fItem('feather-file-text', 'Form Name', lead.form_name);
                    lInfo += fItem('feather-layout', 'Platform', lead.platform);
                    lInfo += fItem('feather-book', 'Course Study', lead.what_course_are_you_planning_to_study);
                    lInfo += fItem('feather-dollar-sign', 'Budget', lead.budget);
                    lInfo += fItem('feather-globe', 'Country Visa', lead.applying_country_for_a_visa);
                    document.getElementById('vd_leadInfo').innerHTML = lInfo;

                    // Address Info
                    let aInfo = '';
                    aInfo += fItem('feather-map-pin', 'City', lead.city);
                    aInfo += fItem('feather-map', 'State', lead.state);
                    aInfo += fItem('feather-hash', 'Pincode', lead.pincode);
                    aInfo += fItem('feather-home', 'Address', lead.address);
                    document.getElementById('vd_addressInfo').innerHTML = aInfo;
                }
            })
            .catch(err => {
                document.getElementById('vd_personalInfo').innerHTML = '<div class="col-12 text-danger py-2 fs-12">Failed to load lead details.</div>';
            });
    }

    function openCommentsModal(leadId, leadName) {
        let modalEl = document.getElementById('commentsModal');
        let bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        
        document.getElementById('cm_leadName').textContent = leadName + ' - Comments';
        document.getElementById('cm_body').innerHTML = '<div class="text-center py-4 text-muted fs-13"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading comments...</div>';
        
        bsModal.show();

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let messages = data.messages || [];
                    if (messages.length === 0) {
                        document.getElementById('cm_body').innerHTML = `
                            <div class="text-center py-5 bg-white rounded-3 border">
                                <i class="feather-message-square text-muted fs-1 mb-2 opacity-50 d-block"></i>
                                <p class="text-muted fs-13 mb-0">No comments or activity logs found for this lead.</p>
                            </div>`;
                        return;
                    }

                    let html = `<div class="d-flex flex-column gap-2.5">`;
                    messages.forEach(msg => {
                        html += `
                            <div class="card border shadow-2xs rounded-3 bg-white">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-1.5 fs-12 fw-bold text-dark">
                                            <i class="feather-user text-primary fs-11"></i>
                                            <span>${msg.user_name || 'System User'}</span>
                                        </div>
                                        <span class="text-muted fs-10"><i class="feather-clock me-1"></i>${msg.created_at_formatted || ''}</span>
                                    </div>
                                    ${(msg.bucket || msg.status) ? `
                                        <div class="p-1.5 px-2 bg-light rounded border d-flex align-items-center gap-2 mb-2 flex-wrap fs-11">
                                            <span class="fw-bold text-muted fs-10">Stage:</span>
                                            ${msg.bucket ? `<span class="badge bg-white text-dark border fw-medium px-2 py-0.5"><i class="feather-layers text-primary me-1"></i> ${msg.bucket}</span>` : ''}
                                            ${msg.status ? `<span class="badge bg-white text-dark border fw-medium px-2 py-0.5"><i class="feather-flag text-success me-1"></i> ${msg.status}</span>` : ''}
                                        </div>
                                    ` : ''}
                                    ${msg.message ? `<p class="text-dark mb-1.5 fs-13" style="line-height: 1.5;">${msg.message}</p>` : ''}
                                    ${(msg.followup_type || msg.followup_status) ? `
                                        <div class="d-flex align-items-center gap-2 fs-11 text-muted">
                                            ${msg.followup_type ? `<span><i class="feather-phone me-1 text-primary"></i> ${msg.followup_type}</span>` : ''}
                                            ${msg.followup_status ? `<span class="badge bg-info-subtle text-info border px-2 py-0.5">${msg.followup_status}</span>` : ''}
                                        </div>
                                    ` : ''}
                                </div>
                            </div>`;
                    });
                    html += `</div>`;
                    document.getElementById('cm_body').innerHTML = html;
                }
            })
            .catch(err => {
                document.getElementById('cm_body').innerHTML = '<div class="text-center text-danger py-3 fs-13">Failed to load comments.</div>';
            });
    }

    async function toggleLeadTag(event, leadId, tagId, optionButton) {
        event.preventDefault();
        event.stopPropagation();
        const checkbox = optionButton.querySelector('input[type="checkbox"]');
        optionButton.disabled = true;
        try {
            const response = await fetch(`{{ url('/leads') }}/${leadId}/tags/${tagId}/toggle`, {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json'}
            });
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.message || 'Failed to update tag.');
            checkbox.checked = result.attached;
            const container = document.querySelector(`[data-lead-tags-container="${leadId}"]`);
            const existing = document.querySelector(`[data-lead-tag="${leadId}-${tagId}"]`);
            if (result.attached && container && !existing) {
                const badge = document.createElement('span');
                badge.className = 'badge rounded-pill text-white fs-10 d-inline-flex align-items-center gap-1 shadow-2xs';
                badge.style.backgroundColor = result.tag.color;
                badge.dataset.leadTag = `${leadId}-${tagId}`;
                badge.innerHTML = `${result.tag.name} <button type="button" class="border-0 bg-transparent text-white p-0 d-inline-flex align-items-center" style="font-size:11px;line-height:1;opacity:0.85;" title="Remove tag" onclick="removeLeadTag(event, ${leadId}, ${tagId}, this)"><i class="fas fa-times-circle"></i></button>`;
                container.appendChild(badge);
            } else if (!result.attached && existing) existing.remove();
            
            const tagBtnBadge = document.querySelector(`[data-lead-tag-btn-badge="${leadId}"]`);
            if (tagBtnBadge) {
                const currentCount = container ? container.querySelectorAll('[data-lead-tag]').length : 0;
                if (currentCount > 0) {
                    tagBtnBadge.textContent = currentCount;
                    tagBtnBadge.classList.remove('d-none');
                } else {
                    tagBtnBadge.textContent = '0';
                    tagBtnBadge.classList.add('d-none');
                }
            }
        } catch (error) {
            if (window.Swal) Swal.fire({icon:'error', title:'Error', text:error.message}); else alert(error.message);
        } finally {
            optionButton.disabled = false;
        }
    }

    async function removeLeadTag(event, leadId, tagId, button) {
        event.preventDefault();
        event.stopPropagation();
        const badge = button.closest('[data-lead-tag]');
        button.disabled = true;
        try {
            const response = await fetch(`{{ url('/leads') }}/${leadId}/tags/${tagId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const result = await response.json();
            if (!response.ok || !result.success) throw new Error(result.message || 'Failed to remove tag.');
            if (badge) badge.remove();
            const dropdownOption = document.querySelector(`[onclick*="toggleLeadTag(event, ${leadId}, ${tagId},"]`);
            const checkbox = dropdownOption ? dropdownOption.querySelector('input[type="checkbox"]') : null;
            if (checkbox) checkbox.checked = false;
            
            const container = document.querySelector(`[data-lead-tags-container="${leadId}"]`);
            const tagBtnBadge = document.querySelector(`[data-lead-tag-btn-badge="${leadId}"]`);
            if (tagBtnBadge) {
                const currentCount = container ? container.querySelectorAll('[data-lead-tag]').length : 0;
                if (currentCount > 0) {
                    tagBtnBadge.textContent = currentCount;
                    tagBtnBadge.classList.remove('d-none');
                } else {
                    tagBtnBadge.textContent = '0';
                    tagBtnBadge.classList.add('d-none');
                }
            }

            if (window.Swal) Swal.fire({icon:'success', title:'Tag Removed', text:result.message, timer:1200, showConfirmButton:false});
        } catch (error) {
            button.disabled = false;
            if (window.Swal) Swal.fire({icon:'error', title:'Error', text:error.message});
            else alert(error.message);
        }
    }
</script>
@endpush
@endsection
