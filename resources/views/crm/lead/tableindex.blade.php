@php
    $isArchive = $isArchiveView ?? false;
    $isDeal = $isDealView ?? false;
    $pageTitle = $isArchive 
        ? ($isDeal ? 'Archive Deals - CRM' : 'Archive Leads - CRM')
        : ($isDeal ? 'Created Deals - CRM' : 'New Leads - CRM');
    $headerTitle = $isArchive
        ? ($isDeal ? 'Archive Deals' : 'Archive Leads')
        : ($isDeal ? 'Created Deals' : 'New Leads Table');
@endphp

@extends('layouts.app')

@section('title', $pageTitle)

@push('styles')
<style>
    /* Floating Bulk Action Bar */
    .floating-bulk-actions {
        position: fixed;
        bottom: 28px;
        left: 50%;
        transform: translateX(-50%) translateY(140px);
        background: #0f172a;
        color: #ffffff;
        padding: 10px 22px;
        border-radius: 50px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        gap: 16px;
        z-index: 1080;
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
        opacity: 0;
        pointer-events: none;
    }
    .floating-bulk-actions.is-visible {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
        pointer-events: auto;
    }
    .floating-bulk-actions .badge-count {
        background: #006FC9;
        color: #ffffff;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(0, 111, 201, 0.4);
    }

    /* Duralux Table & Status Tab Styling */
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

    .lead-tab-scroll {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        scroll-behavior: smooth;
        white-space: nowrap;
        scrollbar-width: none;
        flex-grow: 1;
    }

    .lead-tab-scroll::-webkit-scrollbar {
        display: none;
    }

    .lead-status-scroll-btn {
        width: 30px;
        height: 30px;
        min-width: 30px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #cbd5e1;
        border-radius: 50%;
        background: #f8fafc;
        color: #334155;
        cursor: pointer;
        z-index: 2;
    }
    .lead-status-scroll-btn:hover:not(:disabled) {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
    }
    .lead-status-scroll-btn:disabled {
        opacity: .35;
        cursor: default;
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

    .lead-status-tab.status-success { background-color: #dcfce7; color: #15803d; border-color: #bbf7d0; }
    .lead-status-tab.status-success:hover, .lead-status-tab.status-success.is-active { background-color: #16a34a; color: #ffffff; }

    .lead-status-tab.status-warning { background-color: #fef3c7; color: #b45309; border-color: #fde68a; }
    .lead-status-tab.status-warning:hover, .lead-status-tab.status-warning.is-active { background-color: #d97706; color: #ffffff; }

    .lead-status-tab.status-danger { background-color: #fee2e2; color: #b91c1c; border-color: #fca5a5; }
    .lead-status-tab.status-danger:hover, .lead-status-tab.status-danger.is-active { background-color: #dc2626; color: #ffffff; }

    .lead-status-tab.status-info { background-color: #e0e7ff; color: #4338ca; border-color: #c7d2fe; }
    .lead-status-tab.status-info:hover, .lead-status-tab.status-info.is-active { background-color: #4f46e5; color: #ffffff; }

    .lead-status-tab.status-dark { background-color: #f1f5f9; color: #334155; border-color: #cbd5e1; }
    .lead-status-tab.status-dark:hover, .lead-status-tab.status-dark.is-active { background-color: #334155; color: #ffffff; }

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

    .engagement-filter-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 10px 14px;
        margin-bottom: 12px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }
    .engagement-filter-list { display: flex; align-items: center; flex-wrap: wrap; gap: 7px; }
    .engagement-filter {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 72px;
        padding: 6px 13px;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        background: #f8fafc;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none !important;
        transition: all .15s ease;
    }
    .engagement-filter:hover { transform: translateY(-1px); }
    .engagement-filter.filter-all.is-active { background: #2563eb; border-color: #2563eb; color: #fff; }
    .engagement-filter.filter-hot.is-active { background: #dc2626; border-color: #dc2626; color: #fff; }
    .engagement-filter.filter-warm.is-active { background: #f59e0b; border-color: #f59e0b; color: #fff; }
    .engagement-filter.filter-cold.is-active { background: #0284c7; border-color: #0284c7; color: #fff; }
    .engagement-filter.filter-dead.is-active { background: #475569; border-color: #475569; color: #fff; }

    .engagement-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        padding: 5px;
        font-size: 12px;
        border-radius: 6px;
    }
    .engagement-dropdown-menu {
        min-width: 132px;
        padding: 5px;
        border: 1px solid #e2e8f0 !important;
        border-radius: 9px;
    }
    .engagement-dropdown-menu .pipeline-pill-badge {
        width: 100%;
        min-height: 28px;
        justify-content: center;
    }
    .lead-engagement-column {
        width: 145px;
        min-width: 145px;
        text-align: center;
    }
    .lead-engagement-column > .dropdown {
        min-width: 105px;
    }
    .lead-engagement-column .dropdown-toggle.pipeline-pill-badge {
        min-width: 105px;
        min-height: 30px;
        justify-content: space-between;
        padding: 5px 10px;
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

    .lead-data-table {
        width: 100%;
        min-width: 1080px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    .lead-table-head {
        background-color: #f8fafc;
    }
    .lead-table-head th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        padding: 12px 16px;
        vertical-align: middle;
        white-space: nowrap;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #cbd5e1;
    }
    .lead-table-body td {
        padding: 12px 16px;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        background-color: #ffffff;
    }
    .lead-table-head th:last-child,
    .lead-table-body td:last-child {
        border-right: 0;
    }
    .lead-table-body tr:last-child td {
        border-bottom: none;
    }
    .lead-table-body tr:hover td {
        background-color: #f8fafc;
    }

    .lead-data-table .lead-select-column {
        width: 52px;
        min-width: 52px;
        padding-right: 10px;
        padding-left: 10px;
        text-align: center;
    }

    .lead-data-table .lead-info-column {
        min-width: 250px;
    }

    .lead-data-table .lead-status-column {
        min-width: 170px;
    }

    .lead-data-table .lead-owner-column,
    .lead-data-table .lead-date-column {
        min-width: 140px;
    }

    .lead-data-table .lead-actions-column {
        width: 275px;
        min-width: 275px;
        text-align: center;
    }

    .lead-data-table .form-check-input {
        float: none;
        margin: 0;
        vertical-align: middle;
        cursor: pointer;
    }

    .lead-infinite-loader {
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .lead-infinite-loader .spinner-border {
        width: 20px;
        height: 20px;
        border-width: 2px;
    }

    .comment-history-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
        margin-bottom: 14px;
        border: 1px solid #dbeafe;
        border-radius: 9px;
        background: #eff6ff;
    }
    .comment-timeline { position: relative; padding-left: 26px; }
    .comment-timeline::before {
        content: '';
        position: absolute;
        top: 7px;
        bottom: 7px;
        left: 8px;
        width: 2px;
        background: #dbe4ef;
    }
    .comment-timeline-item { position: relative; padding-bottom: 14px; }
    .comment-timeline-item:last-child { padding-bottom: 0; }
    .comment-timeline-dot {
        position: absolute;
        top: 16px;
        left: -26px;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #eff6ff;
        border-radius: 50%;
        background: #2563eb;
        box-shadow: 0 0 0 1px #93c5fd;
    }
    .comment-history-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(15, 23, 42, .05);
    }
    .comment-history-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 9px 12px;
        border-bottom: 1px solid #f1f5f9;
        background: #f8fafc;
    }
    .comment-history-content { padding: 11px 12px; }
    .comment-message-box {
        padding: 9px 10px;
        border-left: 3px solid #60a5fa;
        border-radius: 0 6px 6px 0;
        background: #f8fafc;
        color: #334155;
        font-size: 12px;
        line-height: 1.55;
        white-space: pre-wrap;
        word-break: break-word;
    }

    @media (max-width: 767.98px) {
        .lead-table-head th,
        .lead-table-body td {
            padding: 10px 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="nxl-content">
    {{-- Header & Tools Component --}}
    <x-lead.tools
        :title="$headerTitle"
        :buckets="$childBuckets ?? collect()"
        :filterBucket="$childBuckets ?? collect()"
        :totalLeadsCount="$systemTotalLeadsCount ?? $totalLeadsCount"
        :owners="$owners"
        :categories="$categorys ?? $categories ?? collect()"
        :sources="$sources"
        :showViewSwitcher="!$isArchive"
    />

    {{-- Floating Bulk Action Bar --}}
    <div id="floatingBulkBar" class="floating-bulk-actions">
        <div class="d-flex align-items-center gap-2">
            <span class="badge-count" id="bulkSelectedCount">0</span>
            <span class="fs-13 fw-semibold text-white">selected</span>
        </div>
        <div class="vr bg-secondary opacity-50" style="height: 20px;"></div>
        <div class="d-flex align-items-center gap-2">
            @if($isArchive)
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1.5" onclick="executeBulkRestore()">
                    <i class="feather-rotate-ccw"></i> Restore Selected
                </button>
                <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1.5" onclick="executeBulkDelete()">
                    <i class="feather-trash-2"></i> Delete Permanently
                </button>
            @else
                <button type="button" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold text-dark shadow-sm d-flex align-items-center gap-1.5" onclick="executeBulkArchive()">
                    <i class="feather-archive"></i> Archive Selected
                </button>
                <button type="button" class="btn btn-sm btn-danger rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1.5" onclick="executeBulkDelete()">
                    <i class="feather-trash-2"></i> Delete Selected
                </button>
            @endif
            <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-2.5" onclick="deselectAllRows()" title="Deselect All">
                <i class="feather-x"></i>
            </button>
        </div>
    </div>

    <div class="main-content px-3 py-2">
        {{-- Main Status Scroll Bar --}}
        @if(!empty($childBuckets) && $childBuckets->count())
        <div class="lead-tab-strip">
            <button type="button" class="lead-status-scroll-btn" data-status-scroll="prev" aria-label="Previous statuses">
                <i class="feather-chevron-left"></i>
            </button>
            <div class="lead-tab-scroll" id="lead-status-scroll">
                @php
                    $isAllActived = empty(request('lead_status')) && !request('deleted_leads');
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['lead_status' => '', 'deleted_leads' => '']) }}"
                    class="lead-status-tab status-primary {{ $isAllActived ? 'is-active' : '' }}">
                    <i class="feather-layers"></i>
                    ALL ({{ $leads->total() }})
                </a>

                @foreach($childBuckets as $bucket)
                    @php
                        $childNames = $bucket->children ? $bucket->children->pluck('name')->toArray() : [];
                        $hasActiveChild = in_array(request('lead_status'), $childNames);
                        $isActive = (request('lead_status') == $bucket->name || $hasActiveChild) && !request('deleted_leads');
                        $statusColor = match(true) {
                            str_contains($bucket->bucket_color ?? '', 'success') => 'status-success',
                            str_contains($bucket->bucket_color ?? '', 'warning') => 'status-warning',
                            str_contains($bucket->bucket_color ?? '', 'danger') => 'status-danger',
                            str_contains($bucket->bucket_color ?? '', 'info') => 'status-info',
                            str_contains($bucket->bucket_color ?? '', 'dark') => 'status-dark',
                            default => 'status-primary',
                        };
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['lead_status' => $bucket->name, 'deleted_leads' => '']) }}"
                        class="lead-status-tab {{ $statusColor }} {{ $isActive ? 'is-active' : '' }}">
                        <i class="feather-circle"></i>
                        {{ $bucket->name }} ({{ $bucket->leads_count }})
                    </a>
                @endforeach

                @if(isset($otherLeadsCount) && $otherLeadsCount > 0)
                    @php
                        $isOtherActive = request('deleted_leads') == 1;
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['deleted_leads' => 1, 'lead_status' => '']) }}"
                        class="lead-status-tab status-warning {{ $isOtherActive ? 'is-active' : '' }}" title="Leads with unmapped or old buckets">
                        <i class="feather-archive"></i>
                        Other ({{ $otherLeadsCount }})
                    </a>
                @endif
            </div>
            <button type="button" class="lead-status-scroll-btn" data-status-scroll="next" aria-label="Next statuses">
                <i class="feather-chevron-right"></i>
            </button>
        </div>
        @endif

        {{-- Sub-Statuses Strip (Displayed below main status bar when parent/child status is active) --}}
        @php
            $activeParentBucket = null;
            $currentStatus = request('lead_status');
            if (!empty($currentStatus) && !request('deleted_leads')) {
                foreach ($childBuckets as $b) {
                    $childNames = $b->children ? $b->children->pluck('name')->toArray() : [];
                    if ($b->name == $currentStatus || in_array($currentStatus, $childNames)) {
                        $activeParentBucket = $b;
                        break;
                    }
                }
            }
        @endphp

        @if($activeParentBucket && $activeParentBucket->children && $activeParentBucket->children->count() > 0)
        <div class="lead-tab-strip py-2 px-3 border-top border-bottom mb-3" style="background: #f8fafc;">
            <div class="d-flex align-items-center gap-2 overflow-x-auto flex-nowrap" style="scrollbar-width: none;">
                <span class="fw-bold text-muted small me-2 text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 11.5px;">
                    <i class="feather-corner-down-right text-primary"></i> {{ $activeParentBucket->name }} Sub-Statuses:
                </span>

                @php
                    $isParentAllActive = request('lead_status') == $activeParentBucket->name;
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['lead_status' => $activeParentBucket->name, 'deleted_leads' => '']) }}"
                    class="lead-status-tab status-dark {{ $isParentAllActive ? 'is-active' : '' }}"
                    style="font-size: 11.5px; padding: 4px 10px;">
                    ALL {{ $activeParentBucket->name }} ({{ $activeParentBucket->leads_count }})
                </a>

                @foreach($activeParentBucket->children as $child)
                    @php
                        $isChildActive = request('lead_status') == $child->name && !request('deleted_leads');
                        $childStatusColor = match(true) {
                            str_contains($child->bucket_color ?? '', 'success') => 'status-success',
                            str_contains($child->bucket_color ?? '', 'warning') => 'status-warning',
                            str_contains($child->bucket_color ?? '', 'danger') => 'status-danger',
                            str_contains($child->bucket_color ?? '', 'info') => 'status-info',
                            str_contains($child->bucket_color ?? '', 'dark') => 'status-dark',
                            default => 'status-primary',
                        };
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['lead_status' => $child->name, 'deleted_leads' => '']) }}"
                        class="lead-status-tab {{ $childStatusColor }} {{ $isChildActive ? 'is-active' : '' }}"
                        style="font-size: 11.5px; padding: 4px 10px;">
                        <i class="feather-circle" style="font-size: 8px;"></i>
                        {{ $child->name }} ({{ $child->leads_count ?? 0 }})
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Engagement Filters --}}
        <div class="engagement-filter-bar">
            <div class="engagement-filter-list">
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => '', 'page' => null]) }}" class="engagement-filter filter-all {{ empty(request('lead_engagement_status')) ? 'is-active' : '' }}"><i class="feather-layers"></i> ALL</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'hot', 'page' => null]) }}" class="engagement-filter filter-hot {{ request('lead_engagement_status') == 'hot' ? 'is-active' : '' }}"><i class="fa-solid fa-fire"></i> HOT</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'warm', 'page' => null]) }}" class="engagement-filter filter-warm {{ request('lead_engagement_status') == 'warm' ? 'is-active' : '' }}"><i class="fa-solid fa-bolt"></i> WARM</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'cold', 'page' => null]) }}" class="engagement-filter filter-cold {{ request('lead_engagement_status') == 'cold' ? 'is-active' : '' }}"><i class="fa-regular fa-snowflake"></i> COLD</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'dead', 'page' => null]) }}" class="engagement-filter filter-dead {{ request('lead_engagement_status') == 'dead' ? 'is-active' : '' }}"><i class="fa-solid fa-ban"></i> DEAD</a>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="lead-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle lead-data-table">
                    <thead class="lead-table-head">
                        <tr>
                            <th class="lead-select-column"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                            <th class="lead-info-column">Lead Info</th>
                            <th class="lead-status-column">Status / Sub Status</th>
                            <th class="lead-engagement-column">Engagement</th>
                            <th class="lead-owner-column">Owner</th>
                            <th class="lead-date-column">Created Date</th>
                            <th class="lead-actions-column">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="lead-table-body" id="lead-table-body">
                        @forelse($leads as $index => $lead)
                            @php
                                $statusName = $lead->lead_status ?: optional($lead->bucket)->name ?: 'Yet to Call';
                                $eng = strtolower(trim($lead->lead_engagement_status ?? ''));
                                $engPillClass = match($eng) {
                                    'hot' => 'pipeline-pill-hot',
                                    'warm' => 'pipeline-pill-warm',
                                    'cold' => 'pipeline-pill-cold',
                                    'dead' => 'pipeline-pill-dead',
                                    default => 'pipeline-pill-new',
                                };
                            @endphp
                            <tr id="lead-row-{{ $lead->id }}">
                                <td class="lead-select-column">
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
                                        <span class="badge bg-light text-dark border fs-11 fw-semibold w-auto d-inline-block text-start">
                                            {{ $statusName }}
                                        </span>
                                        @if($lead->bucket && $lead->bucket->parent)
                                            <span class="text-muted fs-10">
                                                Parent: {{ $lead->bucket->parent->name }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="lead-engagement-column">
                                    <div class="dropdown d-inline-block">
                                        <a href="javascript:void(0);" 
                                           class="pipeline-pill-badge {{ $engPillClass }} dropdown-toggle text-decoration-none" 
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            <span>{{ ucfirst($eng ?: 'New') }}</span>
                                        </a>
                                        <ul class="dropdown-menu engagement-dropdown-menu shadow-sm">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'new', this)"><span class="pipeline-pill-badge pipeline-pill-new">New</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'hot', this)"><span class="pipeline-pill-badge pipeline-pill-hot">🔥 Hot</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'warm', this)"><span class="pipeline-pill-badge pipeline-pill-warm">⚡ Warm</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'cold', this)"><span class="pipeline-pill-badge pipeline-pill-cold">❄️ Cold</span></a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'dead', this)"><span class="pipeline-pill-badge pipeline-pill-dead">💀 Dead</span></a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td data-owner-cell="{{ $lead->id }}">
                                    @if($lead->owner)
                                    <div class="d-flex align-items-center gap-1.5">
                                        <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold fs-11" style="width: 24px; height: 24px;">
                                            {{ strtoupper(substr($lead->owner->name, 0, 1)) }}
                                        </div>
                                        <span class="fs-12 text-dark">{{ $lead->owner->name }}</span>
                                    </div>
                                    @else
                                    <span class="text-muted fs-12 fw-semibold">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted fs-12">{{ $lead->created_at ? $lead->created_at->format('d M Y') : 'N/A' }}</span>
                                </td>
                                <td class="lead-actions-column">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1">
                                        @if($isArchive)
                                            {{-- Restore from Archive Button --}}
                                            <button type="button" class="table-action-btn text-success" 
                                                    onclick="restoreSingleLead({{ $lead->id }}, this)"
                                                    title="Restore Lead">
                                                <i class="feather-rotate-ccw"></i>
                                            </button>

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

                                            {{-- Delete Permanently --}}
                                            <button type="button" class="table-action-btn text-danger" 
                                                    onclick="deleteSingleLeadPermanently({{ $lead->id }}, this)"
                                                    title="Delete Permanently">
                                                <i class="feather-trash-2"></i>
                                            </button>
                                        @else
                                            {{-- Move to Archive Button --}}
                                            <button type="button" class="table-action-btn text-warning" 
                                                    onclick="archiveSingleLead({{ $lead->id }}, this)"
                                                    title="Move to Archive">
                                                <i class="feather-archive"></i>
                                            </button>

                                            {{-- Edit Status Offcanvas Button --}}
                                            <button type="button" class="table-action-btn text-primary" 
                                                    onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 46 }})"
                                                    title="Edit Status">
                                                <i class="feather-sliders"></i>
                                            </button>

                                            {{-- Edit Lead Button --}}
                                            <button type="button" class="table-action-btn text-success" title="Edit Lead"
                                                    onclick="openLeadEditModal({{ $lead->id }})">
                                                <i class="feather-edit"></i>
                                            </button>

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

                                            @unless($isDealView ?? false)
                                            {{-- Convert Lead to Deal --}}
                                            <button type="button" class="table-action-btn text-warning"
                                                    onclick="convertLeadToDeal({{ $lead->id }}, this)"
                                                    title="Convert to Deal">
                                                <i class="feather-check-circle"></i>
                                            </button>
                                            @endunless

                                            {{-- Delete Lead --}}
                                            <form action="{{ route('lead.destroy', $lead->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="table-action-btn text-danger" title="Delete Lead">
                                                    <i class="feather-trash-2"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="feather-inbox fs-2 mb-2 d-block text-secondary"></i>
                                    {{ ($isDealView ?? false) ? 'No created deals found in this view.' : 'No leads found in this view.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="lead-infinite-loader"
             class="lead-infinite-loader"
             data-next-page="{{ $leads->nextPageUrl() }}">
            @if($leads->hasMorePages())
                <span class="spinner-border text-primary d-none" role="status" aria-hidden="true"></span>
                <span class="loader-message">Scroll down to load more leads</span>
            @elseif($leads->count())
                <span class="loader-message">All leads loaded</span>
            @endif
        </div>

        {{-- Pagination --}}
        <div class="d-none align-items-center justify-content-between mt-3 px-1" aria-hidden="true">
            <div class="text-muted fs-12">
                Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }} entries
            </div>
            <div>
                {{ $leads->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@include('crm.lead.partials.lead-interaction-modals')
@include('crm.lead.custom-import-modal')

@push('scripts')
@include('crm.lead.partials.lead-interaction-scripts')
@endpush
@endsection
