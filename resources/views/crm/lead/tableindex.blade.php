@php
    $isArchive = $isArchiveView ?? false;
    $isDeal = $isDealView ?? false;
    $pageTitle = $isArchive 
        ? ($isDeal ? 'Archive Deals - CRM' : 'Archive Leads - CRM')
        : ($isDeal ? 'Created Deals - CRM' : 'New Leads - CRM');
    $headerTitle = $isArchive
        ? ($isDeal ? 'Archive Deals' : 'Archive Leads')
        : ($isDeal ? 'Created Deals' : 'New Leads Table');

    $getMondayStatusStyle = function($status) {
        $s = strtolower(trim($status ?? ''));
        if (str_contains($s, 'qualified') || str_contains($s, 'won') || str_contains($s, 'deal created') || str_contains($s, 'converted') || str_contains($s, 'order placed') || str_contains($s, 'delivered')) {
            return ['bg' => '#00c875', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'attempt') || str_contains($s, 'call back') || str_contains($s, 'pending') || str_contains($s, 'retry')) {
            return ['bg' => '#fb275d', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'contact') || str_contains($s, 'interested') || str_contains($s, 'in discuss') || str_contains($s, 'quote')) {
            return ['bg' => '#ff642f', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'new') || str_contains($s, 'yet to call') || str_contains($s, 'fresh')) {
            return ['bg' => '#fdab3d', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'unqual') || str_contains($s, 'lost') || str_contains($s, 'dead') || str_contains($s, 'close') || str_contains($s, 'reject') || str_contains($s, 'wrong')) {
            return ['bg' => '#797e93', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'cold')) {
            return ['bg' => '#579bfc', 'color' => '#ffffff'];
        }
        if (str_contains($s, 'warm')) {
            return ['bg' => '#a25ddc', 'color' => '#ffffff'];
        }
        return ['bg' => '#0086c0', 'color' => '#ffffff'];
    };
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
        background: #181b34;
        color: #ffffff;
        padding: 10px 24px;
        border-radius: 40px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.15);
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
        background: #0073ea;
        color: #ffffff;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        box-shadow: 0 2px 6px rgba(0, 115, 234, 0.4);
    }

    /* Monday CRM Status Tabs Filter Strip */
    .lead-tab-strip {
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        background: #ffffff;
        border-radius: 8px;
        padding: 8px 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        border: 1px solid #e6e9ef;
        margin-bottom: 14px;
    }
    .lead-tab-scroll {
        display: flex;
        align-items: center;
        gap: 6px;
        overflow-x: auto;
        scroll-behavior: smooth;
        white-space: nowrap;
        scrollbar-width: none;
        flex-grow: 1;
    }
    .lead-tab-scroll::-webkit-scrollbar { display: none; }
    .lead-status-scroll-btn {
        width: 28px;
        height: 28px;
        min-width: 28px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #d0d4e4;
        border-radius: 50%;
        background: #ffffff;
        color: #676879;
        cursor: pointer;
        z-index: 2;
        transition: all 0.15s ease;
    }
    .lead-status-scroll-btn:hover:not(:disabled) {
        background: #0073ea;
        border-color: #0073ea;
        color: #ffffff;
    }
    .lead-status-scroll-btn:disabled { opacity: .35; cursor: default; }

    .lead-status-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.15s ease;
        border: 1px solid #d0d4e4;
        background: #f5f6f8;
        color: #676879;
        white-space: nowrap;
    }
    .lead-status-tab:hover {
        background: #e5f4ff;
        color: #0073ea;
        border-color: #0073ea;
    }
    .lead-status-tab.is-active {
        background: #0073ea !important;
        color: #ffffff !important;
        border-color: #0073ea !important;
        box-shadow: 0 1px 4px rgba(0, 115, 234, 0.3);
    }
    .lead-status-tab.status-deleted {
        background: #fff1f2 !important;
        color: #e11d48 !important;
        border: 1px solid #fecdd3 !important;
    }
    .lead-status-tab.status-deleted:hover {
        background: #ffe4e6 !important;
        color: #be123c !important;
        border-color: #fb7185 !important;
    }
    .lead-status-tab.status-deleted.is-active {
        background: #e11d48 !important;
        color: #ffffff !important;
        border-color: #be123c !important;
        box-shadow: 0 2px 6px rgba(225, 29, 72, 0.35) !important;
    }
    .lead-status-tab.status-deleted .badge-deleted {
        background-color: #e11d48;
        color: #ffffff;
        font-size: 8.5px;
        font-weight: 700;
        padding: 1px 5px;
        border-radius: 10px;
        margin-right: 4px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .lead-status-tab.status-deleted.is-active .badge-deleted {
        background-color: #ffffff;
        color: #e11d48;
    }

    /* Monday CRM Table Card & Group Banner */
    .monday-board-card {
        border-radius: 8px;
        border: 1px solid #d0d4e4;
        background: #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
        overflow: hidden;
        border-left: 6px solid #0073ea;
    }
    .monday-group-banner {
        padding: 12px 18px;
        background: #ffffff;
        border-bottom: 1px solid #e6e9ef;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .monday-group-title {
        font-size: 18px;
        font-weight: 700;
        color: #0073ea;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }
    .monday-collapse-btn {
        background: transparent;
        border: none;
        color: #0073ea;
        font-size: 16px;
        cursor: pointer;
        padding: 2px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }
    .monday-collapse-btn[aria-expanded="false"] i {
        transform: rotate(-90deg);
    }
    .monday-group-count {
        font-size: 12px;
        font-weight: 500;
        color: #676879;
        background: #f5f6f8;
        padding: 3px 10px;
        border-radius: 20px;
        border: 1px solid #e6e9ef;
    }

    /* Monday CRM Table Grid */
    .lead-table-card {
        border: none;
        background: transparent;
        box-shadow: none;
    }
    .monday-table {
        width: 100%;
        min-width: 1240px;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }
    .monday-table thead th {
        background: #f5f6f8;
        color: #676879;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.2px;
        padding: 10px 14px;
        border-bottom: 1px solid #d0d4e4;
        border-right: 1px solid #e6e9ef;
        white-space: nowrap;
        vertical-align: middle;
    }
    .monday-table thead th:last-child {
        border-right: none;
    }
    .monday-table tbody td {
        padding: 10px 14px;
        font-size: 13px;
        color: #323338;
        vertical-align: middle;
        border-bottom: 1px solid #e6e9ef;
        border-right: 1px solid #e6e9ef;
        background: #ffffff;
        transition: background-color 0.12s ease;
    }
    .monday-table tbody td:last-child {
        border-right: none;
    }
    .monday-table tbody tr:hover td {
        background-color: #f0f3ff;
    }

    /* Selection Checkbox Column */
    .monday-select-col {
        width: 44px;
        min-width: 44px;
        text-align: center;
        padding-left: 10px !important;
        padding-right: 10px !important;
    }
    .monday-table .form-check-input {
        width: 16px;
        height: 16px;
        border-radius: 3px;
        border-color: #c3c6d4;
        cursor: pointer;
        margin: 0;
        vertical-align: middle;
    }
    .monday-table .form-check-input:checked {
        background-color: #0073ea;
        border-color: #0073ea;
    }

    /* Monday Item Peek Button */
    .monday-peek-btn {
        width: 26px;
        height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid transparent;
        background: transparent;
        color: #676879;
        cursor: pointer;
        font-size: 13px;
        position: relative;
        transition: all 0.15s ease;
        padding: 0;
        flex-shrink: 0;
    }
    .monday-peek-btn:hover {
        background: #e5f4ff;
        color: #0073ea;
        border-color: #cce5ff;
    }
    .monday-peek-dot {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #0073ea;
        border: 2px solid #ffffff;
    }

    /* Monday Signature Solid Color Status Pill */
    .monday-status-pill {
        width: 100%;
        min-height: 32px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 600;
        color: #ffffff !important;
        text-align: center;
        border-radius: 4px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        cursor: pointer;
        transition: transform 0.15s ease, filter 0.15s ease, box-shadow 0.15s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        line-height: 1.2;
    }
    .monday-status-pill:hover {
        filter: brightness(0.93);
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }
    .monday-status-pill::after {
        display: none;
    }

    /* Monday CRM Status Picker Dropdown */
    .monday-status-picker-menu {
        min-width: 210px;
        padding: 8px !important;
        border-radius: 8px !important;
        border: 1px solid #d0d4e4 !important;
        background: #ffffff !important;
        box-shadow: 0 8px 26px rgba(0, 0, 0, 0.16) !important;
        max-height: 360px;
        overflow-y: auto;
    }
    .monday-status-group {
        margin-bottom: 7px;
        list-style: none;
    }
    .monday-status-group:last-child {
        margin-bottom: 2px;
    }
    .monday-picker-parent {
        border-radius: 5px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: none;
        user-select: none;
    }
    .monday-picker-parent:hover {
        filter: brightness(0.92);
        transform: scale(1.01);
    }
    .monday-expand-arrow {
        font-size: 13px;
        transition: transform 0.2s ease;
        margin-left: 6px;
    }
    .monday-expand-arrow.is-expanded {
        transform: rotate(180deg);
    }
    .monday-picker-subgroup {
        margin-left: 10px;
        padding-left: 10px;
        border-left: 2px dashed #cbd5e1;
        margin-top: 4px;
        margin-bottom: 4px;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .monday-picker-child {
        border-radius: 4px;
        padding: 5px 10px;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.15s ease;
        text-decoration: none !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #ffffff !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        border: none;
    }
    .monday-picker-child:hover {
        filter: brightness(0.92);
        transform: translateX(2px);
    }
    .monday-picker-badge-parent {
        font-size: 8.5px;
        background: rgba(0, 0, 0, 0.22);
        color: #ffffff;
        padding: 1px 6px;
        border-radius: 10px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        font-weight: 700;
    }
    .monday-picker-badge-sub {
        font-size: 8px;
        background: rgba(255, 255, 255, 0.3);
        color: #ffffff;
        padding: 1px 5px;
        border-radius: 8px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        font-weight: 700;
    }

    /* Monday Action Button (Dark Green Move to Contacts / Convert to Deal) */
    .monday-action-btn {
        background-color: #00854d;
        color: #ffffff !important;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 4px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
        cursor: pointer;
        transition: background-color 0.15s ease, transform 0.15s ease;
        box-shadow: 0 1px 2px rgba(0, 133, 77, 0.2);
        text-decoration: none !important;
    }
    .monday-action-btn:hover {
        background-color: #007041;
        transform: translateY(-1px);
    }
    .monday-action-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .monday-btn-deal {
        background-color: #0073ea;
    }
    .monday-btn-deal:hover {
        background-color: #0060b9;
    }

    /* Next Activity Styling (HubSpot style) */
    .deal-next-activity-cell {
        min-width: 210px;
        max-width: 260px;
    }
    .deal-activity-wrap {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-align: left;
        max-width: 100%;
        text-decoration: none !important;
        cursor: pointer;
        padding: 4px 6px;
        border-radius: 8px;
        transition: background-color 0.15s ease;
    }
    .deal-activity-wrap:hover {
        background-color: #f1f5f9;
    }
    .deal-activity-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }
    .deal-activity-wrap:hover .deal-activity-icon {
        transform: scale(1.06);
        border-color: #cbd5e1;
    }
    .deal-activity-icon.icon-email {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }
    .deal-activity-icon.icon-call {
        background: #f0fdf4;
        color: #16a34a;
        border-color: #bbf7d0;
    }
    .deal-activity-icon.icon-meeting {
        background: #faf5ff;
        color: #9333ea;
        border-color: #e9d5ff;
    }
    .deal-activity-icon.icon-whatsapp {
        background: #f0fdf4;
        color: #15803d;
        border-color: #bbf7d0;
    }
    .deal-activity-icon.icon-task {
        background: #f8fafc;
        color: #475569;
        border-color: #e2e8f0;
    }
    .deal-activity-icon.icon-empty {
        background: #f8fafc;
        color: #94a3b8;
        border: 1px dashed #cbd5e1;
    }
    .deal-activity-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
        overflow: hidden;
        line-height: 1.25;
    }
    .deal-activity-title {
        font-size: 12.5px;
        font-weight: 600;
        color: #0073ea;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 175px;
    }
    .deal-activity-wrap:hover .deal-activity-title {
        color: #0056b3;
        text-decoration: underline;
    }
    .deal-activity-meta {
        font-size: 11px;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }
    .activity-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    .activity-status-dot.dot-teal {
        background-color: #0ea5e9;
    }
    .activity-status-dot.dot-green {
        background-color: #10b981;
    }
    .activity-status-dot.dot-red {
        background-color: #ef4444;
    }
    .activity-status-dot.dot-muted {
        background-color: #94a3b8;
    }
    .activity-schedule-btn {
        font-size: 11px;
        font-weight: 600;
        color: #0073ea;
        background: transparent;
        border: none;
        padding: 0;
        text-decoration: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    .activity-schedule-btn:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Monday User Avatar */
    .monday-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: #579bfc;
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-transform: uppercase;
        border: 1px solid #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Monday Add Item Row */
    .monday-add-row {
        cursor: pointer;
        background-color: #fafbfc;
        transition: background-color 0.15s ease;
    }
    .monday-add-row:hover td {
        background-color: #f0f3ff !important;
    }
    .monday-add-btn-text {
        font-size: 13px;
        color: #676879;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .monday-add-row:hover .monday-add-btn-text {
        color: #0073ea;
    }

    /* Monday Summary Bar */
    .monday-summary-bar {
        background: #fafbfc;
        border-top: 1px solid #e6e9ef;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .monday-dist-bar {
        height: 12px;
        border-radius: 3px;
        display: flex;
        overflow: hidden;
        background: #e6e9ef;
        flex-grow: 1;
        max-width: 260px;
    }
    .monday-dist-segment {
        height: 100%;
        transition: width 0.3s ease;
    }

    /* Compact Action Buttons */
    .table-action-btn {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid #d0d4e4;
        background: #ffffff;
        color: #676879;
        transition: all 0.15s ease;
        font-size: 12px;
    }
    .table-action-btn:hover {
        background: #f0f3ff;
        color: #0073ea;
        border-color: #0073ea;
    }

    .lead-infinite-loader {
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #676879;
        font-size: 12px;
        font-weight: 500;
    }

    @media (max-width: 767.98px) {
        .monday-table thead th,
        .monday-table tbody td {
            padding: 8px 10px;
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
            {{-- BULK STATUS DROPDOWN --}}
                <div class="dropdown">
                    <button class="btn btn-sm rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1.5 dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #6366f1;">
                        <i class="feather-sliders"></i> Change Status
                    </button>
                    @php
                        $bulkSelectableBuckets = !empty($isDealView)
                            ? ($activeDealBuckets ?? ($childBuckets ?? collect())->filter(fn($b) => empty($b->is_deleted) && $b->type === 'order'))
                            : ($activeLeadBuckets ?? ($childBuckets ?? collect())->filter(fn($b) => empty($b->is_deleted) && ($b->type === 'lead' || empty($b->type))));
                    @endphp
                    <ul class="dropdown-menu shadow-lg fs-12 p-1 mb-2 border-0" style="max-height: 280px; overflow-y: auto; border-radius: 10px;">
                        @foreach($bulkSelectableBuckets as $bucket)
                            @if(empty($bucket->is_deleted))
                                <li><a class="dropdown-item fw-bold text-primary rounded-2 mb-1 py-1.5" href="javascript:void(0)" onclick="executeBulkStatusUpdate({{ $bucket->id }}, '{{ addslashes($bucket->name) }}')">{{ $bucket->name }}</a></li>
                                @if($bucket->children)
                                    @foreach($bucket->children as $child)
                                        @if(empty($child->is_deleted))
                                            <li><a class="dropdown-item ms-2 rounded-2 mb-1 text-dark py-1.5" href="javascript:void(0)" onclick="executeBulkStatusUpdate({{ $child->id }}, '{{ addslashes($child->name) }}')"><i class="feather-corner-down-right text-muted me-1"></i> {{ $child->name }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
                @unless($isDealView ?? false)
                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm d-flex align-items-center gap-1.5" onclick="executeBulkConvertToDeal()">
                    <i class="feather-check-circle"></i> Convert to Deal
                </button>
                @endunless
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
                    $isAllActived = (empty(request('lead_status')) || request('lead_status') === 'all');
                @endphp
                <a href="{{ request()->fullUrlWithQuery(['lead_status' => (!empty($isDealView) ? 'all' : '')]) }}"
                    class="lead-status-tab status-primary {{ $isAllActived ? 'is-active' : '' }}">
                    <i class="feather-layers"></i>
                    ALL ({{ !empty($isDealView) ? ($childtotalLeadsCount ?? $leads->total()) : ($systemTotalLeadsCount ?? $leads->total()) }})
                </a>

                @foreach($childBuckets as $bucket)
                    @php    
                        $childNames = $bucket->children ? $bucket->children->pluck('name')->toArray() : [];
                        $hasActiveChild = in_array(request('lead_status'), $childNames);
                        $isActive = (request('lead_status') == $bucket->name || $hasActiveChild) && request('lead_status') !== 'all';
                        $isDeletedBucket = !empty($bucket->is_deleted);

                        $statusColor = match(true) {
                            $isDeletedBucket => 'status-deleted',
                            str_contains($bucket->bucket_color ?? '', 'success') => 'status-success',
                            str_contains($bucket->bucket_color ?? '', 'warning') => 'status-warning',
                            str_contains($bucket->bucket_color ?? '', 'danger') => 'status-danger',
                            str_contains($bucket->bucket_color ?? '', 'info') => 'status-info',
                            str_contains($bucket->bucket_color ?? '', 'dark') => 'status-dark',
                            default => 'status-primary',
                        };
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['lead_status' => $bucket->name]) }}"
                        class="lead-status-tab {{ $statusColor }} {{ $isActive ? 'is-active' : '' }}"
                        @if($isDeletedBucket) title="Deleted Status (contains {{ $bucket->leads_count }} leads)" @endif>
                        @if($isDeletedBucket)
                            <i class="feather-trash-2 text-danger" style="font-size: 11px;"></i>
                            <span class="badge-deleted">Deleted</span>
                        @else
                            <i class="feather-circle"></i>
                        @endif
                        {{ $bucket->name }} ({{ $bucket->leads_count }})
                    </a>
                @endforeach
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
            if (!empty($currentStatus) && $currentStatus !== 'all') {
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
                <a href="{{ request()->fullUrlWithQuery(['lead_status' => $activeParentBucket->name]) }}"
                    class="lead-status-tab status-dark {{ $isParentAllActive ? 'is-active' : '' }}"
                    style="font-size: 11.5px; padding: 4px 10px;">
                    ALL {{ $activeParentBucket->name }} ({{ $activeParentBucket->leads_count }})
                </a>

                @foreach($activeParentBucket->children as $child)
                    @php
                        $isChildActive = request('lead_status') == $child->name;
                        $isChildDeleted = !empty($child->is_deleted);
                        $childStatusColor = match(true) {
                            $isChildDeleted => 'status-deleted',
                            str_contains($child->bucket_color ?? '', 'success') => 'status-success',
                            str_contains($child->bucket_color ?? '', 'warning') => 'status-warning',
                            str_contains($child->bucket_color ?? '', 'danger') => 'status-danger',
                            str_contains($child->bucket_color ?? '', 'info') => 'status-info',
                            str_contains($child->bucket_color ?? '', 'dark') => 'status-dark',
                            default => 'status-primary',
                        };
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['lead_status' => $child->name]) }}"
                        class="lead-status-tab {{ $childStatusColor }} {{ $isChildActive ? 'is-active' : '' }}"
                        style="font-size: 11.5px; padding: 4px 10px;"
                        @if($isChildDeleted) title="Deleted Sub-Status (contains {{ $child->leads_count ?? 0 }} leads)" @endif>
                        @if($isChildDeleted)
                            <i class="feather-trash-2 text-danger" style="font-size: 9px;"></i>
                            <span class="badge-deleted" style="font-size: 7.5px; padding: 1px 4px;">Deleted</span>
                        @else
                            <i class="feather-circle" style="font-size: 8px;"></i>
                        @endif
                        {{ $child->name }} ({{ $child->leads_count ?? 0 }})
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- {{-- Engagement Filters --}}
        <div class="engagement-filter-bar">
            <div class="engagement-filter-list">
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => '', 'page' => null]) }}" class="engagement-filter filter-all {{ empty(request('lead_engagement_status')) ? 'is-active' : '' }}"><i class="feather-layers"></i> ALL</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'hot', 'page' => null]) }}" class="engagement-filter filter-hot {{ request('lead_engagement_status') == 'hot' ? 'is-active' : '' }}"><i class="fa-solid fa-fire"></i> HOT</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'warm', 'page' => null]) }}" class="engagement-filter filter-warm {{ request('lead_engagement_status') == 'warm' ? 'is-active' : '' }}"><i class="fa-solid fa-bolt"></i> WARM</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'cold', 'page' => null]) }}" class="engagement-filter filter-cold {{ request('lead_engagement_status') == 'cold' ? 'is-active' : '' }}"><i class="fa-regular fa-snowflake"></i> COLD</a>
                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'dead', 'page' => null]) }}" class="engagement-filter filter-dead {{ request('lead_engagement_status') == 'dead' ? 'is-active' : '' }}"><i class="fa-solid fa-ban"></i> DEAD</a>
            </div>
        </div> -->

        {{-- Monday CRM Board Table Container --}}
        @php
            $groupTitle = !empty(request('lead_status')) && request('lead_status') !== 'all'
                ? request('lead_status')
                : ($isDeal ? 'Created Deals' : 'New Leads');
            $totalCount = $leads->total();

            // Calculate status distribution for the summary bar
            $statusDistribution = [];
            foreach ($leads as $l) {
                $stName = $l->lead_status ?: optional($l->bucket)->name ?: 'Yet to Call';
                $stStyle = $getMondayStatusStyle($stName);
                $k = $stStyle['bg'];
                if (!isset($statusDistribution[$k])) {
                    $statusDistribution[$k] = [
                        'name' => $stName,
                        'bg' => $k,
                        'count' => 0
                    ];
                }
                $statusDistribution[$k]['count']++;
            }
            $loadedCount = count($leads);
        @endphp

        <div class="monday-board-card">
            {{-- Monday Group Banner --}}
            <div class="monday-group-banner">
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="monday-collapse-btn" data-bs-toggle="collapse" data-bs-target="#mondayTableCollapse" aria-expanded="true" title="Collapse / Expand Group">
                        <i class="feather-chevron-down"></i>
                    </button>
                    <h3 class="monday-group-title">
                        {{ $groupTitle }}
                    </h3>
                    <span class="monday-group-count">{{ $totalCount }} {{ $isDeal ? 'deals' : 'leads' }}</span>
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-link text-decoration-none text-muted p-0 d-inline-flex align-items-center gap-1" onclick="openCreateModal()" title="Add {{ $isDeal ? 'Deal' : 'Lead' }}">
                        <i class="feather-plus-circle fs-15 text-primary"></i>
                        <span class="fs-12 text-primary fw-semibold d-none d-sm-inline">+ Add {{ $isDeal ? 'deal' : 'lead' }}</span>
                    </button>
                </div>
            </div>

            {{-- Collapsible Table Grid --}}
            <div id="mondayTableCollapse" class="collapse show">
                <div class="table-responsive">
                    <table class="table align-middle monday-table mb-0 lead-data-table">
                        <thead>
                            <tr>
                                <th class="monday-select-col lead-select-column"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                                <th style="min-width: 230px;" class="lead-info-column">Lead</th>
                                <th style="width: 175px; min-width: 175px; text-align: center;" class="lead-status-column">Status</th>
                                <th style="min-width: 210px;" class="lead-activity-column">
                                    <div class="d-inline-flex align-items-center gap-1.5">
                                        <span>Next Activity</span>
                                        <i class="feather-info text-muted fs-11" title="Upcoming task or follow-up activity"></i>
                                    </div>
                                </th>
                                @if(!$isDeal)
                                    <th style="min-width: 140px; text-align: center;">Create a Deal</th>
                                @endif
                                <th style="min-width: 150px;">Company</th>
                                <th style="min-width: 130px;">Title</th>
                                <th style="min-width: 190px;">Email</th>
                                <th style="min-width: 140px;">Phone</th>
                                <th style="min-width: 140px;" class="lead-owner-column">Owner</th>
                                <th style="min-width: 110px;" class="lead-date-column">Created Date</th>
                                <th style="width: 140px; min-width: 140px; text-align: center;" class="lead-actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="lead-table-body" id="lead-table-body">
                            @forelse($leads as $index => $lead)
                                @php
                                    $statusName = $lead->lead_status ?: optional($lead->bucket)->name ?: 'Yet to Call';
                                    $leadParentName = $lead->lead_bucket_name ?: ($lead->bucket && $lead->bucket->parent ? $lead->bucket->parent->name : ($lead->bucket ? $lead->bucket->name : 'Lead'));
                                    $stStyle = $getMondayStatusStyle($statusName);
                                @endphp
                                <tr id="lead-row-{{ $lead->id }}">
                                    {{-- Checkbox --}}
                                    <td class="monday-select-col lead-select-column">
                                        <input type="checkbox" class="form-check-input lead-checkbox" value="{{ $lead->id }}">
                                    </td>

                                    {{-- Lead Contact & Tags --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            {{-- Monday Item Peek Comments Icon --}}
                                            <button type="button" class="monday-peek-btn" onclick="openCommentsModal({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'Lead') }}')" title="Open updates & history">
                                                <i class="feather-message-square"></i>
                                                @if($lead->latestMessage)
                                                    <span class="monday-peek-dot"></span>
                                                @endif
                                            </button>

                                            {{-- Name & Duplicate badge --}}
                                            <div class="d-flex flex-column gap-0.5">
                                                <span class="fw-bold text-dark fs-13">{{ optional($lead->user)->name ?? 'N/A' }}</span>
                                                @if($lead->duplicate_count > 0)
                                                    <span class="badge bg-danger text-white rounded-pill" style="font-size: 9px; width: fit-content;" title="Duplicate Lead">
                                                        Dup ({{ $lead->duplicate_count }})
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Tags Dropdown Button --}}
                                            <div class="dropdown d-inline-block ms-auto">
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
                                        </div>

                                        {{-- Selected Tag Badges --}}
                                        <div class="d-flex flex-wrap gap-1 mt-1" data-lead-tags-container="{{ $lead->id }}">
                                            @foreach($lead->tags as $tag)
                                                <span class="badge rounded-pill text-white fs-10 d-inline-flex align-items-center gap-1 shadow-2xs" style="background-color:{{ $tag->color }}" data-lead-tag="{{ $lead->id }}-{{ $tag->id }}">
                                                    {{ $tag->name }}
                                                    <button type="button" class="border-0 bg-transparent text-white p-0 d-inline-flex align-items-center" style="font-size:11px;line-height:1;opacity:0.85;" title="Remove tag" onclick="removeLeadTag(event, {{ $lead->id }}, {{ $tag->id }}, this)"><i class="fas fa-times-circle"></i></button>
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>

                                    {{-- Monday Solid Color Status Block --}}
                                    <td style="text-align: center;">
                                        <div class="dropdown d-inline-block w-100">
                                            <button class="monday-status-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="window" style="background-color: {{ $stStyle['bg'] }};" id="status-pill-{{ $lead->id }}">
                                                <span id="status-text-{{ $lead->id }}">{{ $statusName }}</span>
                                            </button>
                                            @php
                                                $rowSelectableBuckets = !empty($isDealView)
                                                    ? ($activeDealBuckets ?? ($childBuckets ?? collect())->filter(fn($b) => empty($b->is_deleted) && $b->type === 'order'))
                                                    : ($activeLeadBuckets ?? ($childBuckets ?? collect())->filter(fn($b) => empty($b->is_deleted) && ($b->type === 'lead' || empty($b->type))));
                                            @endphp
                                            <ul class="dropdown-menu monday-status-picker-menu shadow-lg border-0">
                                                @foreach($rowSelectableBuckets as $bucket)
                                                    @if(empty($bucket->is_deleted))
                                                        @php 
                                                            $bStyle = $getMondayStatusStyle($bucket->name); 
                                                            $hasChildren = $bucket->children && $bucket->children->filter(fn($c) => empty($c->is_deleted))->count() > 0;
                                                        @endphp
                                                        <li class="monday-status-group">
                                                            @if($hasChildren)
                                                                <div class="monday-picker-parent" onclick="toggleStatusSubgroup(event, 'subgroup-{{ $lead->id }}-{{ $bucket->id }}', this)" style="background-color: {{ $bStyle['bg'] }};">
                                                                    <span>{{ $bucket->name }}</span>
                                                                    <i class="feather-chevron-down monday-expand-arrow"></i>
                                                                </div>
                                                                <div id="subgroup-{{ $lead->id }}-{{ $bucket->id }}" class="monday-picker-subgroup d-none">
                                                                    <a class="dropdown-item monday-picker-child mb-1" href="javascript:void(0)" onclick="updateInlineLeadStatus({{ $lead->id }}, {{ $bucket->id }}, '{{ addslashes($bucket->name) }}', this, '{{ $bStyle['bg'] }}')" style="background-color: {{ $bStyle['bg'] }}; opacity: 0.95;">
                                                                        <span class="d-inline-flex align-items-center gap-1.5 text-truncate" title="{{ $bucket->name }}">
                                                                            <i class="feather-check-circle" style="font-size: 10px;"></i>
                                                                            <span>{{ $bucket->name }} (Main)</span>
                                                                        </span>
                                                                    </a>
                                                                    @foreach($bucket->children as $child)
                                                                        @if(empty($child->is_deleted))
                                                                            @php $cStyle = $getMondayStatusStyle($child->name); @endphp
                                                                            <a class="dropdown-item monday-picker-child mb-1" href="javascript:void(0)" onclick="updateInlineLeadStatus({{ $lead->id }}, {{ $child->id }}, '{{ addslashes($child->name) }}', this, '{{ $cStyle['bg'] }}')" style="background-color: {{ $cStyle['bg'] }};">
                                                                                <span class="d-inline-flex align-items-center gap-1.5 text-truncate" title="{{ $child->name }}">
                                                                                    <i class="feather-corner-down-right" style="font-size: 10px; opacity: 0.9;"></i>
                                                                                    <span>{{ $child->name }}</span>
                                                                                </span>
                                                                                <span class="monday-picker-badge-sub">Sub</span>
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <a class="dropdown-item monday-picker-parent" href="javascript:void(0)" onclick="updateInlineLeadStatus({{ $lead->id }}, {{ $bucket->id }}, '{{ addslashes($bucket->name) }}', this, '{{ $bStyle['bg'] }}')" style="background-color: {{ $bStyle['bg'] }};">
                                                                    <span>{{ $bucket->name }}</span>
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        @if($leadParentName && strtolower(trim($leadParentName)) !== strtolower(trim($statusName)))
                                            <span class="text-muted d-block mt-1" id="parent-text-{{ $lead->id }}" style="font-size: 10.5px;">
                                                Parent: {{ $leadParentName }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Next Activity (for both Deals and Leads) --}}
                                    <td class="deal-next-activity-cell">
                                            @php
                                                // Determine the next upcoming activity for this deal
                                                $activity = null;
                                                $now = \Carbon\Carbon::now();

                                                // 1. Check upcoming active callback/followup
                                                $pendingCallback = $lead->messages
                                                    ? $lead->messages->filter(function($m) {
                                                        return empty($m->is_done) && !empty($m->next_followup_date);
                                                    })->sortBy('next_followup_date')->first()
                                                    : null;

                                                // Fallback to latestMessage if it has a next_followup_date
                                                if (!$pendingCallback && $lead->latestMessage && !empty($lead->latestMessage->next_followup_date)) {
                                                    $pendingCallback = $lead->latestMessage;
                                                }

                                                /* 2. To-Do Task query commented out as requested */

                                                // 3. Select activity from callback/followup
                                                if ($pendingCallback) {
                                                    try {
                                                        $cbDate = \Carbon\Carbon::parse($pendingCallback->next_followup_date);
                                                    } catch (\Exception $e) {
                                                        $cbDate = null;
                                                    }
                                                    $activity = ['type' => 'callback', 'item' => $pendingCallback, 'date' => $cbDate];
                                                }

                                                // Action to open Edit Status offcanvas (1st screenshot)
                                                $openEditOffcanvas = "openEditStatusOffcanvas({$lead->id}, '" . addslashes($statusName) . "', '" . addslashes($lead->lead_engagement_status ?? '') . "', " . ($lead->lead_bucket_id ?? 'null') . ", '" . addslashes($leadParentName ?? '') . "')";

                                                // Activity tracking offcanvas for existing activity logs
                                                $leadDisplayName = optional($lead->user)->name ?: ($lead->business_name ?: 'Lead');
                                                $openCommentsOffcanvas = "openCommentsModal({$lead->id}, '" . addslashes($leadDisplayName) . "')";

                                                // 4. Format activity details
                                                $title = '';
                                                $subText = '';
                                                $iconClass = 'icon-task';
                                                $iconHtml = '<i class="feather-calendar"></i>';
                                                $dotClass = 'dot-teal';
                                                $clickAction = $activity ? $openCommentsOffcanvas : $openEditOffcanvas;

                                                if ($activity) {
                                                    $userName = optional($lead->user)->name ?? 'Contact';
                                                    $fType = strtolower(trim($activity['item']->followup_type ?? ''));
                                                    $msgText = trim($activity['item']->message ?? '');

                                                    if (str_contains($fType, 'call')) {
                                                        $iconClass = 'icon-call';
                                                        $iconHtml = '<i class="feather-phone"></i>';
                                                        $title = 'Call ' . $userName;
                                                    } elseif (str_contains($fType, 'email')) {
                                                        $iconClass = 'icon-email';
                                                        $iconHtml = '<i class="feather-mail"></i>';
                                                        $title = 'Email ' . $userName;
                                                    } elseif (str_contains($fType, 'meet')) {
                                                        $iconClass = 'icon-meeting';
                                                        $iconHtml = '<i class="feather-calendar"></i>';
                                                        $title = 'Meeting w/ ' . $userName;
                                                    } elseif (str_contains($fType, 'whats')) {
                                                        $iconClass = 'icon-whatsapp';
                                                        $iconHtml = '<i class="fab fa-whatsapp"></i>';
                                                        $title = 'WhatsApp ' . $userName;
                                                    } else {
                                                        $iconClass = 'icon-task';
                                                        $iconHtml = '<i class="feather-calendar"></i>';
                                                        $title = !empty($msgText) ? \Illuminate\Support\Str::limit($msgText, 25) : ('Follow Up w/ ' . $userName);
                                                    }

                                                    if ($activity['date']) {
                                                        $actDate = $activity['date'];
                                                        if ($actDate->lt($now)) {
                                                            $diffDays = $now->diffInDays($actDate);
                                                            $diffHours = $now->diffInHours($actDate);
                                                            $dotClass = 'dot-red';
                                                            if ($diffDays >= 1) {
                                                                $subText = 'Overdue by ' . $diffDays . ' ' . \Illuminate\Support\Str::plural('day', $diffDays);
                                                            } elseif ($diffHours >= 1) {
                                                                $subText = 'Overdue by ' . $diffHours . ' ' . \Illuminate\Support\Str::plural('hour', $diffHours);
                                                            } else {
                                                                $subText = 'Overdue today';
                                                            }
                                                        } else {
                                                            $diffDays = $actDate->diffInDays($now);
                                                            $diffHours = $actDate->diffInHours($now);
                                                            if ($actDate->isToday()) {
                                                                $dotClass = 'dot-teal';
                                                                if ($diffHours <= 1) {
                                                                    $subText = 'Due in an hour';
                                                                } else {
                                                                    $subText = 'Due in ' . $diffHours . ' ' . \Illuminate\Support\Str::plural('hour', $diffHours);
                                                                }
                                                            } elseif ($actDate->isTomorrow() || $diffDays <= 1) {
                                                                $dotClass = 'dot-teal';
                                                                $subText = 'Due tomorrow';
                                                            } elseif ($diffDays >= 2 && $diffDays <= 6) {
                                                                $dotClass = 'dot-teal';
                                                                $subText = 'Due in ' . $diffDays . ' days';
                                                            } else {
                                                                $dotClass = 'dot-muted';
                                                                $subText = 'Due ' . $actDate->format('M d');
                                                            }
                                                        }
                                                    } else {
                                                        $dotClass = 'dot-teal';
                                                        $subText = 'Scheduled';
                                                    }
                                                }
                                            @endphp

                                            @if($activity)
                                                <div class="deal-activity-wrap" onclick="{{ $clickAction }}" title="Next Activity: {{ $title }} - {{ $subText }} (Click to view activity tracking & history)">
                                                    <div class="deal-activity-icon {{ $iconClass }}">
                                                        {!! $iconHtml !!}
                                                    </div>
                                                    <div class="deal-activity-content">
                                                        <span class="deal-activity-title">{{ $title }}</span>
                                                        <span class="deal-activity-meta">
                                                            <span class="activity-status-dot {{ $dotClass }}"></span>
                                                            <span>{{ $subText }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="deal-activity-wrap" onclick="{{ $openEditOffcanvas }}" title="Click to schedule next activity & follow-up">
                                                    <div class="deal-activity-icon icon-empty">
                                                        <i class="feather-calendar"></i>
                                                    </div>
                                                    <div class="deal-activity-content">
                                                        <span class="text-muted fs-12 fw-medium">No activity scheduled</span>
                                                        <span class="deal-activity-meta">
                                                            <span class="activity-schedule-btn">
                                                                <i class="feather-plus" style="font-size: 10px;"></i> Schedule
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>

                                        {{-- Monday Dark Green Action Button (Only for Leads) --}}
                                        @if(!$isDeal)
                                            <td style="text-align: center;">
                                                <button type="button" class="monday-action-btn" onclick="convertLeadToDeal({{ $lead->id }}, this)" title="Convert Lead to Deal">
                                                    Create Deal
                                                </button>
                                            </td>
                                        @endif

                                    {{-- Company --}}
                                    <td>
                                        <span class="text-dark fw-medium">{{ $lead->business_name ?: '—' }}</span>
                                    </td>

                                    {{-- Title / Platform --}}
                                    <td>
                                        <span class="text-muted">{{ $lead->platform ?: (optional($lead->category)->category_name ?: '—') }}</span>
                                    </td>

                                    {{-- Email --}}
                                    <td>
                                        @if(optional($lead->user)->email)
                                            <a href="mailto:{{ optional($lead->user)->email }}" class="text-decoration-none fw-medium" style="color: #0073ea;" title="{{ optional($lead->user)->email }}">
                                                {{ optional($lead->user)->email }}
                                            </a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    {{-- Phone --}}
                                    <td>
                                        @if(optional($lead->user)->contact_no)
                                            <a href="tel:{{ optional($lead->user)->contact_no }}" class="text-decoration-none text-dark d-inline-flex align-items-center gap-1.5 fw-medium">
                                                <i class="feather-phone text-muted fs-11"></i>
                                                <span>{{ optional($lead->user)->contact_no }}</span>
                                            </a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    {{-- Owner --}}
                                    <td data-owner-cell="{{ $lead->id }}">
                                        @if($lead->owner)
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="monday-avatar" title="{{ $lead->owner->name }}">
                                                    {{ strtoupper(substr($lead->owner->name, 0, 1)) }}
                                                </span>
                                                <span class="fs-12 text-dark fw-medium text-truncate" style="max-width: 100px;" title="{{ $lead->owner->name }}">
                                                    {{ $lead->owner->name }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-muted fs-12">Unassigned</span>
                                        @endif
                                    </td>

                                    {{-- Created Date --}}
                                    <td>
                                        <span class="text-muted fs-12">{{ $lead->created_at ? $lead->created_at->format('M d, Y') : '—' }}</span>
                                    </td>

                                    {{-- Actions --}}
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
                                                {{-- Edit Status Offcanvas Button --}}
                                                <button type="button" class="table-action-btn text-primary" 
                                                        onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 'null' }}, '{{ addslashes($leadParentName ?? '') }}')"
                                                        title="Edit Status">
                                                    <i class="feather-settings"></i>
                                                </button>

                                                {{-- Edit Lead Button --}}
                                                <button type="button" class="table-action-btn text-success" title="Edit Lead"
                                                        onclick="openLeadEditModal({{ $lead->id }})">
                                                    <i class="feather-edit"></i>
                                                </button>

                                                {{-- View Comments / History Button --}}
                                                <button type="button" class="table-action-btn text-warning" 
                                                        onclick="openCommentsModal({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'Lead') }}')"
                                                        title="View Comments & History">
                                                    <i class="feather-clock"></i>
                                                </button>

                                                {{-- 3 Dots More Actions Dropdown --}}
                                                <div class="dropdown d-inline">
                                                    <button type="button" class="table-action-btn text-muted" data-bs-toggle="dropdown" aria-expanded="false" title="More Actions">
                                                        <i class="feather-more-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size: 12.5px; min-width: 165px; z-index: 1060;">
                                                        {{-- View Details Modal --}}
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="javascript:void(0);" onclick="openViewDetailsModalLazy({{ $lead->id }})">
                                                                <i class="feather-eye text-info"></i> <span>View Details</span>
                                                            </a>
                                                        </li>

                                                        @unless($isDealView ?? false)
                                                        {{-- Convert Lead to Deal --}}
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="javascript:void(0);" onclick="convertLeadToDeal({{ $lead->id }}, this)">
                                                                <i class="feather-check-circle text-success"></i> <span>Convert to Deal</span>
                                                            </a>
                                                        </li>
                                                        @endunless

                                                        {{-- Move to Archive --}}
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 py-1.5 text-warning" href="javascript:void(0);" onclick="archiveSingleLead({{ $lead->id }}, this)">
                                                                <i class="feather-archive"></i> <span>Move to Archive</span>
                                                            </a>
                                                        </li>

                                                        <li><hr class="dropdown-divider my-1"></li>

                                                        {{-- Delete Lead --}}
                                                        <li>
                                                            <a class="dropdown-item d-flex align-items-center gap-2 py-1.5 text-danger" href="javascript:void(0);" onclick="if(confirm('Are you sure you want to delete this lead?')) { document.getElementById('delete-lead-form-{{ $lead->id }}').submit(); }">
                                                                <i class="feather-trash-2"></i> <span>Delete Lead</span>
                                                            </a>
                                                            <form id="delete-lead-form-{{ $lead->id }}" action="{{ route('lead.destroy', $lead->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5 text-muted">
                                        <i class="feather-inbox fs-2 mb-2 d-block text-secondary"></i>
                                        {{ ($isDealView ?? false) ? 'No created deals found in this view.' : 'No leads found in this view.' }}
                                    </td>
                                </tr>
                            @endforelse

                            {{-- Monday "+ Add lead" quick row --}}
                            <tr class="monday-add-row" onclick="openCreateModal()">
                                <td class="monday-select-col"><i class="feather-plus text-muted fs-13"></i></td>
                                <td colspan="10">
                                    <span class="monday-add-btn-text">
                                        <i class="feather-plus-circle text-primary"></i> + Add {{ $isDeal ? 'deal' : 'lead' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Monday Summary Bar with Status Distribution --}}
                <div class="monday-summary-bar">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fs-12 text-muted fw-semibold">Status Overview:</span>
                        <div class="monday-dist-bar" title="Status Distribution">
                            @foreach($statusDistribution as $dist)
                                @php $pct = $loadedCount > 0 ? round(($dist['count'] / $loadedCount) * 100, 1) : 0; @endphp
                                <div class="monday-dist-segment" style="width: {{ $pct }}%; background-color: {{ $dist['bg'] }};" title="{{ $dist['name'] }}: {{ $dist['count'] }} ({{ $pct }}%)" data-bs-toggle="tooltip"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="ms-auto fs-12 text-muted fw-semibold">
                        Showing {{ count($leads) }} of {{ $totalCount }} {{ $isDeal ? 'deals' : 'leads' }}
                    </div>
                </div>
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

@push('scripts')
<script>
    var leadStatusMap = window.leadStatusMap = @json(
        (isset($childBuckets) ? $childBuckets : collect())->mapWithKeys(function($b) {
            return [$b->name => [
                'id' => $b->id,
                'children' => $b->children ? $b->children->map(function($c) {
                    return ['id' => $c->id, 'name' => $c->name];
                })->values()->toArray() : []
            ]];
        })
    );

    // CSRF Token nikalne ka dynamic function (Taki Cache ka issue na aaye)
    function getSafeCsrfToken() {
        let metaTag = document.querySelector('meta[name="csrf-token"]');
        return metaTag ? metaTag.getAttribute('content') : '{{ csrf_token() }}';
    }

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

    function openEditStatusOffcanvas(leadId, leadStatus, engagementStatus, bucketId, bucketName) {
        let offcanvasEl = document.getElementById('editStatusOffcanvas');
        let form = document.getElementById('sharedQuickUpdateForm');
        if (!offcanvasEl || !form) return;
        form.action = "{{ url('/modern-leads/quick-update') }}/" + leadId;
        
        let engSelect = form.querySelector('[name="lead_engagement_status"]');
        if (engSelect) engSelect.value = (engagementStatus || '').toLowerCase();

        // 1. Display Current Stored Status & Bucket Name
        const statusBadge = document.getElementById('currentLeadStatusBadge');
        const bucketBadge = document.getElementById('currentLeadBucketBadge');
        if (statusBadge) statusBadge.textContent = leadStatus || 'None';
        if (bucketBadge) {
            bucketBadge.textContent = bucketName ? 'Bucket: ' + bucketName : '';
            bucketBadge.style.display = bucketName ? 'inline-block' : 'none';
        }
        
        let mainSelect = document.getElementById('editStatusMainSelect');
        let subSelect = document.getElementById('editStatusSubSelect');
        let matchedMainStatus = '';
        let matchedSubStatus = '';

        // Check if current lead status exists among active master options
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

        // If not matched (i.e. status is deleted from master), do not permanently add it to active dropdown
        if (mainSelect) mainSelect.value = matchedMainStatus;
        onOffcanvasMainStatusChange(matchedMainStatus, matchedSubStatus);
        
        let bucketInput = form.querySelector('[name="lead_bucket_id"]') || document.getElementById('editStatusBucketIdInput');
        if (bucketInput) bucketInput.value = bucketId || '';

        form.onsubmit = function() {
            let subVal = subSelect ? subSelect.value : '';
            let mainVal = mainSelect ? mainSelect.value : '';
            let finalStatus = subVal || mainVal || leadStatus;
            let finalBucketName = mainVal || bucketName || '';
            let finalBucketId = bucketId;

            if (subSelect && subSelect.selectedIndex >= 0) {
                let selectedOpt = subSelect.options[subSelect.selectedIndex];
                if (selectedOpt && selectedOpt.dataset.bucketId) {
                    finalBucketId = selectedOpt.dataset.bucketId;
                }
            } else if (mainVal && leadStatusMap[mainVal]) {
                finalBucketId = leadStatusMap[mainVal].id;
            }

            if (bucketInput && finalBucketId) bucketInput.value = finalBucketId;

            let bucketNameInput = form.querySelector('[name="lead_bucket_name"]') || document.getElementById('editStatusBucketNameInput');
            if (!bucketNameInput) {
                bucketNameInput = document.createElement('input');
                bucketNameInput.type = 'hidden';
                bucketNameInput.name = 'lead_bucket_name';
                form.appendChild(bucketNameInput);
            }
            bucketNameInput.value = finalBucketName;
            
            let hiddenStatusInput = form.querySelector('input[name="lead_status"]') || document.getElementById('editStatusFinalStatusInput');
            if (!hiddenStatusInput) {
                hiddenStatusInput = document.createElement('input');
                hiddenStatusInput.type = 'hidden';
                hiddenStatusInput.name = 'lead_status';
                form.appendChild(hiddenStatusInput);
            }
            hiddenStatusInput.value = finalStatus;
        };

        if (window.bootstrap && window.bootstrap.Offcanvas) {
            bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl).show();
        }
    }

    function openViewDetailsModalLazy(leadId) {
        let modalEl = document.getElementById('viewLeadDetailsModal');
        if (!modalEl) return;
        
        document.getElementById('vd_leadName').textContent = 'Loading Details...';
        document.getElementById('vd_leadSubtitle').textContent = 'Lead #' + leadId;
        document.getElementById('vd_badges').innerHTML = '';
        document.getElementById('vd_personalInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_leadInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        document.getElementById('vd_addressInfo').innerHTML = '<div class="col-12 text-center text-muted py-3"><div class="spinner-border spinner-border-sm me-2 text-primary"></div> Loading details...</div>';
        
        if (window.bootstrap && window.bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        } else if (window.jQuery) {
            window.jQuery(modalEl).modal('show');
        }

        fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let lead = data.lead || {};
                    let user = data.user || {};
                    let owner = data.owner || {};

                    document.getElementById('vd_leadName').textContent = user.name || 'N/A';
                    document.getElementById('vd_leadSubtitle').textContent = (lead.business_name || 'No Business') + ' • Lead ID: #' + lead.id;

                    // Badges - Only Lead's Actual Status (No duplicate/mismatched Bucket)
                    let currentStatus = (lead.lead_status && String(lead.lead_status).trim() !== '') 
                        ? String(lead.lead_status).trim() 
                        : ((lead.bucket && lead.bucket.name) ? lead.bucket.name : 'New');

                    let badgesHtml = `<span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 fs-11 fw-semibold"><i class="feather-flag me-1"></i> Status: ${currentStatus}</span>`;
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

                    // Lead Info & Campaign - Bucket removed, only actual Status shown
                    let lInfo = '';
                    lInfo += fItem('feather-flag', 'Status', currentStatus);
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

    async function convertLeadToDeal(leadId, button) {
        if (!confirm('Convert lead to deal? The lead will be moved to Created Deals.')) return;
        if (button) button.disabled = true;
        try {
            let token = getSafeCsrfToken();
            const response = await fetch("{{ url('/new-leads-table') }}/" + leadId + "/convert-deal", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ _token: token })
            });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Lead conversion failed');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.35s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(30px)';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
            }

            if (window.Swal) Swal.fire({ icon: 'success', title: 'Converted!', text: data.message || 'Lead converted successfully', timer: 1500, showConfirmButton: false });
            else alert(data.message || 'Lead converted successfully');
        } catch (error) {
            if (button) button.disabled = false;
            if (window.Swal) Swal.fire('Error', error.message, 'error');
            else alert(error.message);
        }
    }

    function toggleStatusSubgroup(event, targetId, triggerEl) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        const subgroup = document.getElementById(targetId);
        if (!subgroup) return;
        const isHidden = subgroup.classList.contains('d-none');
        subgroup.classList.toggle('d-none', !isHidden);
        
        const arrow = triggerEl ? triggerEl.querySelector('.monday-expand-arrow') : null;
        if (arrow) {
            arrow.classList.toggle('is-expanded', isHidden);
        }
    }
    window.toggleStatusSubgroup = toggleStatusSubgroup;

    // FUNCTION 1: Single Inline Status Update
    async function updateInlineLeadStatus(leadId, bucketId, statusName, el, newColor) {
        let btnSpan = document.getElementById('status-text-' + leadId);
        let pillBtn = document.getElementById('status-pill-' + leadId) || (btnSpan ? btnSpan.closest('.monday-status-pill') : null);
        let originalText = btnSpan ? btnSpan.innerText : statusName;
        if (btnSpan) btnSpan.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

        try {
            let token = getSafeCsrfToken();
            const params = new URLSearchParams({
                _token: token,
                bucket_id: bucketId,
                status_name: statusName
            });

            const response = await fetch("{{ url('/new-leads-table') }}/" + leadId + "/update-status", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Update failed');

            // Success: Update UI
            if (btnSpan) btnSpan.innerText = statusName;
            if (pillBtn && newColor) pillBtn.style.backgroundColor = newColor;
            if (window.Swal) Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: data.message, showConfirmButton: false, timer: 1500 });
        } catch (error) {
            if (btnSpan) btnSpan.innerText = originalText;
            if (window.Swal) Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: error.message, showConfirmButton: false, timer: 2000 });
        }
    }

    // FUNCTION 2: Bulk Status Update
    async function executeBulkStatusUpdate(bucketId, statusName) {
        const checked = document.querySelectorAll('.lead-checkbox:checked');
        const ids = Array.from(checked).map(cb => cb.value);
        
        if (!ids.length) {
            if (window.Swal) Swal.fire('No Selection', 'Please select at least one lead.', 'warning');
            return;
        }

        if (!confirm(`Update status to "${statusName}" for ${ids.length} selected lead(s)?`)) return;

        try {
            let token = getSafeCsrfToken();
            const params = new URLSearchParams();
            params.append('_token', token);
            params.append('bucket_id', bucketId);
            params.append('status_name', statusName);
            ids.forEach(id => params.append('ids[]', id));

            // Safe URL to avoid route not found exceptions
            const bulkUrl = "{{ url('/new-leads-table/bulk-update-status') }}";

            const response = await fetch(bulkUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Bulk Update failed');

            // Update UI dynamically for all selected leads
            ids.forEach(id => {
                let textEl = document.getElementById('status-text-' + id);
                if (textEl) textEl.innerText = statusName;
            });

            deselectAllRows(); // Reset selection

            if (window.Swal) {
                Swal.fire({ icon: 'success', title: 'Updated!', text: data.message, timer: 1200, showConfirmButton: false });
                setTimeout(() => window.location.reload(), 1300);
            } else {
                window.location.reload();
            }
        } catch (error) {
            if (window.Swal) Swal.fire('Error', error.message, 'error');
            else alert(error.message);
        }
    }

    async function archiveSingleLead(leadId, button) {
        if (!confirm('Are you sure you want to move this lead to Archive?')) return;
        if (button) button.disabled = true;
        try {
            let token = getSafeCsrfToken();
            const response = await fetch("{{ url('/archive-leads') }}/" + leadId + "/archive", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ _token: token })
            });
            const data = await response.json();
            if (!response.ok || !data.success) throw new Error(data.message || 'Archive failed');

            const row = document.getElementById('lead-row-' + leadId) || (button ? button.closest('tr') : null);
            if (row) {
                row.style.transition = 'all 0.35s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(30px)';
                setTimeout(() => { row.remove(); updateBulkActionsState(); }, 350);
            }

            if (window.Swal) Swal.fire({ icon: 'success', title: 'Archived!', text: data.message || 'Lead archived', timer: 1500, showConfirmButton: false });
            else alert(data.message || 'Lead archived');
        } catch (error) {
            if (button) button.disabled = false;
            if (window.Swal) Swal.fire('Error', error.message, 'error');
            else alert(error.message);
        }
    }

    async function executeBulkConvertToDeal() {
        const checked = document.querySelectorAll('.lead-checkbox:checked');
        const ids = Array.from(checked).map(cb => cb.value);
        if (!ids.length) {
            if (window.Swal) Swal.fire('No Selection', 'Please select at least one lead using the checkboxes.', 'warning');
            else alert('Please select at least one lead using the checkboxes.');
            return;
        }

        if (!confirm(`Convert ${ids.length} selected lead(s) to deals?`)) return;

        try {
            let token = getSafeCsrfToken();
            const params = new URLSearchParams();
            params.append('_token', token);
            ids.forEach(id => params.append('ids[]', id));

            const response = await fetch("{{ url('/new-leads-table/bulk-convert-deal') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: params
            });

            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Conversion failed');

            ids.forEach(id => {
                const row = document.getElementById('lead-row-' + id);
                if (row) row.remove();
            });
            deselectAllRows();

            if (window.Swal) Swal.fire({ icon: 'success', title: 'Converted!', text: data.message, timer: 1500, showConfirmButton: false });
            else alert(data.message || 'Leads converted successfully');
        } catch (error) {
            if (window.Swal) Swal.fire('Error', error.message, 'error');
            else alert(error.message);
        }
    }

    async function openLeadEditModal(leadId) {
        const modalElement = document.getElementById('leadModal');
        if (!modalElement) {
            window.location.href = "{{ url('/lead') }}/" + leadId + "/edit";
            return;
        }
        try {
            const res = await fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data");
            const data = await res.json();
            if (data.status !== 'success') throw new Error('Lead data unavailable');
            const lead = data.lead || {};
            const user = data.user || {};
            const form = modalElement.querySelector('#leadForm');
            if (form) form.action = "{{ url('/lead/update') }}/" + leadId;
            const setVal = (sel, val) => { const el = modalElement.querySelector(sel); if (el) el.value = val == null ? '' : val; };
            setVal('#formMethod', 'PUT');
            setVal('#inp_name', user.name);
            setVal('#inp_mobile', user.contact_no);
            setVal('#inp_email', user.email);
            setVal('#inp_city', lead.city || user.city);
            setVal('#inp_state', lead.state || user.state);
            setVal('#inp_pincode', lead.pincode || user.pincode);
            setVal('#inp_address', lead.address || user.address);
            setVal('#inp_platform', lead.platform);
            setVal('#inp_owner', lead.lead_owner);

            if (lead.budget) {
                let rawBudget = String(lead.budget).trim();
                let detectedCurrency = '₹';
                if (rawBudget.startsWith('$')) detectedCurrency = '$';
                else if (rawBudget.startsWith('€')) detectedCurrency = '€';
                else if (rawBudget.startsWith('£')) detectedCurrency = '£';
                else if (rawBudget.startsWith('₹')) detectedCurrency = '₹';
                if (typeof changeBudgetCurrency === 'function') changeBudgetCurrency(detectedCurrency);
                let cleanVal = rawBudget.replace(/^[₹$€£]\s*/, '');
                setVal('#inp_budget', cleanVal);
            } else {
                if (typeof changeBudgetCurrency === 'function') changeBudgetCurrency('₹');
                setVal('#inp_budget', '');
            }

            const title = modalElement.querySelector('#leadModalTitle span');
            if (title) title.textContent = 'Edit Lead: ' + (user.name || 'N/A');
            const btn = modalElement.querySelector('#btnSubmit');
            if (btn) btn.textContent = 'Update Lead';

            if (window.bootstrap && window.bootstrap.Modal) {
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            } else if (window.jQuery) {
                window.jQuery(modalElement).modal('show');
            }
        } catch(e) {
            window.location.href = "{{ url('/lead') }}/" + leadId + "/edit";
        }
    }

    function openCreateModal() {
        const modalElement = document.getElementById('leadModal');
        if (!modalElement) {
            window.location.href = "{{ route('lead.create') }}";
            return;
        }
        const form = document.getElementById('leadForm');
        if (form) {
            form.action = "{{ route('lead.store') }}";
            form.reset();
        }
        if (typeof changeBudgetCurrency === 'function') changeBudgetCurrency('₹');
        const methodInput = document.getElementById('formMethod');
        if (methodInput) methodInput.value = 'POST';

        const title = modalElement.querySelector('#leadModalTitle span');
        if (title) title.textContent = 'Create New Lead';
        const btn = modalElement.querySelector('#btnSubmit');
        if (btn) { btn.textContent = 'Create Lead'; btn.disabled = false; }

        if (window.bootstrap && window.bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        } else if (window.jQuery) {
            window.jQuery(modalElement).modal('show');
        }
    }

    function updateBulkActionsState() {
        const checked = document.querySelectorAll('.lead-checkbox:checked');
        const allBoxes = document.querySelectorAll('.lead-checkbox');
        const checkAll = document.getElementById('checkAll');
        const floatingBar = document.getElementById('floatingBulkBar');
        const countSpan = document.getElementById('bulkSelectedCount');

        const count = checked.length;
        if (countSpan) countSpan.textContent = count;
        if (checkAll && allBoxes.length > 0) {
            checkAll.checked = (checked.length === allBoxes.length);
        }
        if (floatingBar) {
            if (count > 0) floatingBar.classList.add('is-visible');
            else floatingBar.classList.remove('is-visible');
        }
    }

    function deselectAllRows() {
        document.querySelectorAll('.lead-checkbox').forEach(cb => cb.checked = false);
        const checkAll = document.getElementById('checkAll');
        if (checkAll) checkAll.checked = false;
        updateBulkActionsState();
    }

    // Expose all globally on window
    window.archiveSingleLead = archiveSingleLead;
    window.openEditStatusOffcanvas = openEditStatusOffcanvas;
    window.openLeadEditModal = openLeadEditModal;
    window.openViewDetailsModalLazy = openViewDetailsModalLazy;
    window.convertLeadToDeal = convertLeadToDeal;
    window.openCreateModal = openCreateModal;
    window.executeBulkConvertToDeal = executeBulkConvertToDeal;
    window.updateBulkActionsState = updateBulkActionsState;
    window.deselectAllRows = deselectAllRows;
    window.onOffcanvasMainStatusChange = onOffcanvasMainStatusChange;

    document.addEventListener('DOMContentLoaded', function () {
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.addEventListener('change', function () {
                const isChecked = this.checked;
                document.querySelectorAll('.lead-checkbox').forEach(cb => cb.checked = isChecked);
                updateBulkActionsState();
            });
        }

        const tableBody = document.getElementById('lead-table-body');
        if (tableBody) {
            tableBody.addEventListener('change', function (e) {
                if (e.target && e.target.classList.contains('lead-checkbox')) {
                    updateBulkActionsState();
                }
            });
        }
    });
</script>
@include('crm.lead.partials.lead-interaction-scripts')
@include('crm.lead.custom-import-modal')
@endpush
@endsection
