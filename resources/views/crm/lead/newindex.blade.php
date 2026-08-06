@extends('layouts.app')

@section('content')

    <style>
        /* Inactive (Normal) Tab ka Design */
        .lead-custom-tab {
            color: #6c757d !important;
            /* Muted Text */
            background: transparent !important;
            border: none !important;
            border-bottom: 3px solid transparent !important;
            padding: 0 0 0.5rem 0 !important;
            /* Niche se thodi jagah */
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* Hover karne par color change */
        .lead-custom-tab:hover {
            color: #006FC9 !important;
        }

        /* Active (Clicked) Tab ka Design */
        .lead-custom-tab.active {
            color: #212529 !important;
            /* Dark Text */
            font-weight: bold !important;
            /* Bold Text */
            border-bottom: 3px solid #006FC9 !important;
            /* Blue Border */
        }

        @media (min-width: 768px) {
            .card-width {
                width: 24%;
            }
        }

        @media (max-width: 767px) {
            .card-width {
                width: 100%;
            }
        }
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

        .lead-pipeline-wrapper { overflow-x: auto; padding-bottom: 10px; }
        .lead-pipeline-board { display: flex; gap: 12px; min-width: max-content; align-items: stretch; }
        .pipeline-column { width: 230px; border: 1.5px solid #e3e8f0; border-radius: 12px; background: #fff; display: flex; flex-direction: column; }
        .pipeline-column.drag-over { border-color: #006FC9; box-shadow: 0 0 0 3px rgba(0,111,201,.15); }
        .pipeline-column-header { padding: 10px 13px 9px; border-radius: 10px 10px 0 0; border-bottom: 1.5px solid rgba(0,0,0,.06); display: flex; align-items: center; justify-content: space-between; gap: 6px; }
        .pipeline-column-title { font-size: 12px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .column-count-badge { font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px; flex-shrink: 0; }
        .pipeline-cards-list { padding: 8px; min-height: 90px; max-height: 500px; overflow-y: auto; display: flex; flex-direction: column; gap: 7px; }
        .pipeline-card { background: #fff; border: 1.5px solid #eaecf0; border-radius: 9px; padding: 9px 10px; cursor: grab; user-select: none; transition: box-shadow .18s, border-color .18s, transform .13s; }
        .pipeline-card:active { cursor: grabbing; }
        .pipeline-card:hover { border-color: #b8d9f5; box-shadow: 0 3px 12px rgba(0,111,201,.12); }
        .pipeline-card-name { font-size: 12px; font-weight: 700; color: #1a202c; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pipeline-card-phone { font-size: 11px; color: #6c757d; margin-top: 3px; }
        .pipeline-card-badges { display: flex; gap: 4px; flex-wrap: wrap; margin-top: 5px; }
        .pipeline-card-badge { font-size: 10px; font-weight: 600; padding: 1px 7px; border-radius: 20px; text-transform: capitalize; }
        .pipeline-badge-hot { background: #ffe5e5; color: #cc2200; }
        .pipeline-badge-warm { background: #fff3e0; color: #b85c00; }
        .pipeline-badge-cold { background: #e0f5ff; color: #0077aa; }
        .pipeline-badge-dead { background: #e9e9e9; color: #555; }
        .pipeline-badge-na { background: #f0f4f8; color: #8899aa; }
        .pipeline-badge-product { background: rgba(0,111,201,.09); color: #006FC9; border: 1px solid rgba(0,111,201,.16); }
        .pipeline-card-meta { font-size: 10.5px; color: #6c757d; margin-top: 5px; }
        .pipeline-empty { min-height: 72px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 1.5px dashed rgba(0,0,0,.12); border-radius: 8px; color: #b0bec5; font-size: 11px; }
        .pipeline-theme { background: #f0f7ff; border-color: #bde0ff; }
        .pipeline-theme .pipeline-column-header { background: #e3f0ff; }
        .pipeline-theme .pipeline-column-title { color: #006FC9; }
        .pipeline-theme .column-count-badge { background: #006FC9; color: #fff; }
        .lead-tab-strip { position: relative; background: #fff; border-bottom: 1px solid #e9ecef; padding: 10px 16px; }
        .lead-tab-strip.has-overflow { padding-left: 44px; padding-right: 44px; }
        .lead-tab-scroll { display: flex; align-items: center; gap: 8px; overflow-x: auto; scrollbar-width: none; scroll-behavior: smooth; }
        .lead-tab-scroll::-webkit-scrollbar { display: none; }
        .lead-status-tab { display: inline-flex; align-items: center; gap: 6px; flex: 0 0 auto; border: 1px solid currentColor; border-radius: 999px; padding: 6px 11px; font-size: 12px; font-weight: 700; line-height: 1; text-decoration: none; transition: transform .18s ease, box-shadow .18s ease; }
        .lead-status-tab:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(15, 23, 42, .12); }
        .lead-status-tab.is-active { color: #fff !important; box-shadow: 0 3px 8px rgba(15, 23, 42, .16); }
        .lead-status-tab.status-primary { color: #006FC9; background: #e8f3ff; }
        .lead-status-tab.status-primary.is-active { background: #006FC9; border-color: #006FC9; }
        .lead-status-tab.status-success { color: #16803c; background: #eaf8ef; }
        .lead-status-tab.status-success.is-active { background: #16803c; border-color: #16803c; }
        .lead-status-tab.status-warning { color: #a65c00; background: #fff5df; }
        .lead-status-tab.status-warning.is-active { background: #d98600; border-color: #d98600; }
        .lead-status-tab.status-danger { color: #c33b32; background: #fff0ef; }
        .lead-status-tab.status-danger.is-active { background: #d94841; border-color: #d94841; }
        .lead-status-tab.status-info { color: #087d94; background: #e7f8fb; }
        .lead-status-tab.status-info.is-active { background: #0891b2; border-color: #0891b2; }
        .lead-status-tab.status-dark { color: #475569; background: #f1f5f9; }
        .lead-status-tab.status-dark.is-active { background: #475569; border-color: #475569; }
        .lead-tab-arrow { display: none; position: absolute; top: 50%; z-index: 1; transform: translateY(-50%); width: 30px; height: 30px; padding: 0; border: 1px solid #dbe3ec; border-radius: 50%; background: #fff; color: #006FC9; box-shadow: 0 2px 6px rgba(15, 23, 42, .12); }
        .lead-tab-strip.has-overflow .lead-tab-arrow { display: inline-flex; align-items: center; justify-content: center; }
        .lead-tab-arrow:disabled { opacity: .35; cursor: default; }
        .lead-tab-arrow.prev { left: 10px; }
        .lead-tab-arrow.next { right: 10px; }
        .lead-list-toolbar { background: #fff; border-bottom: 1px solid #e9ecef; padding-top: 10px; padding-bottom: 10px; }
        .engagement-hot-icon { color: #dc2626; }
        .engagement-warm-icon { color: #d97706; }
        .engagement-cold-icon { color: #0284c7; }
        .engagement-dead-icon { color: #475569; }
        .lead-details-pane .nav-tabs { flex-wrap: nowrap; overflow-x: auto; scrollbar-width: none; }
        .lead-details-pane .nav-tabs::-webkit-scrollbar { display: none; }
        .lead-details-pane .nav-item { flex: 0 0 auto; }
        .lead-details-pane .fs-15 { display: block; max-width: 100%; overflow-wrap: anywhere; word-break: break-word; }
        @media (max-width: 575.98px) {
            .lead-details-pane { padding: 16px !important; }
            .lead-details-pane .nav-tabs { gap: 18px !important; margin-bottom: 24px !important; }
            .lead-details-pane .lead-custom-tab { padding-bottom: .45rem !important; }
        }
    </style>
    <style>
        /* View Details Modal Premium Styles */
        #viewLeadDetailsModal .modal-content {
            animation: viewDetailSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes viewDetailSlideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        #viewLeadDetailsModal .card {
            transition: all 0.2s ease;
        }
        #viewLeadDetailsModal .card:hover {
            box-shadow: 0 4px 16px rgba(0,111,201,0.08) !important;
        }
        .vd-field-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .vd-field-label {
            font-size: 11px;
            font-weight: 600;
            color: #8392ab;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .vd-field-label i {
            font-size: 12px;
            color: #a0aec0;
            width: 14px;
            text-align: center;
        }
        .vd-field-value {
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            word-break: break-word;
        }
        .vd-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .vd-badge-bucket { background: #e3f2fd; color: #0d47a1; }
        .vd-badge-status { background: #f3e5f5; color: #7b1fa2; }
        .vd-badge-hot { background: #ffebee; color: #c62828; }
        .vd-badge-warm { background: #fff3e0; color: #e65100; }
        .vd-badge-cold { background: #e0f7fa; color: #00838f; }
        .vd-badge-dead { background: #eceff1; color: #37474f; }
        .vd-badge-default { background: #f5f5f5; color: #616161; }
        .vd-badge-product { background: rgba(0,111,201,0.1); color: #006FC9; }
        .view-lead-details-btn {
            transition: all 0.2s ease;
        }
        .view-lead-details-btn:hover {
            transform: scale(1.15);
            color: #0056a3 !important;
        }
        @media (max-width: 576px) {
            #viewLeadDetailsModal .modal-dialog {
                margin: 0.5rem;
            }
            #viewLeadDetailsModal .modal-body {
                padding: 12px !important;
            }
        }
    </style>
    <style>
        .duplicate-info-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        /* hidden by default */
        .duplicate-popup {
            position: absolute;
            top: 28px;
            left: 0;
            min-width: 170px;
            background: #fff;
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            z-index: 99999;
            display: none;
        }

        /* hover on full wrapper */
        .duplicate-info-wrapper:hover .duplicate-popup {
            display: block;
        }

        /* Additional Contacts Premium Styling */
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
            padding: 0;
            z-index: 10;
        }
        .contact-card .btn-remove-contact:hover {
            background: #dc3545;
            color: #ffffff;
            border-color: #dc3545;
            box-shadow: 0 2px 6px rgba(220, 53, 69, 0.3);
        }
        .contact-card .form-control-sm {
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            padding: 0.35rem 0.5rem;
            font-size: 0.8rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
        }
        .contact-card .form-control-sm:focus {
            border-color: #006FC9;
            box-shadow: 0 0 0 3px rgba(0, 111, 201, 0.15);
            background-color: #ffffff;
        }
        .contact-card .form-label-sm {
            font-size: 0.75rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 3px;
        }
        .btn-soft-primary {
            background-color: rgba(0, 111, 201, 0.06);
            color: #006FC9;
            border: 1px solid rgba(0, 111, 201, 0.12);
        }
        .btn-soft-primary:hover {
            background-color: #006FC9;
            color: #ffffff;
            border-color: #006FC9;
        }
        .bg-soft-primary {
            background-color: rgba(0, 111, 201, 0.1) !important;
            color: #006FC9 !important;
        }
        #btnAddContact:hover {
            background-color: #00569d !important;
            color: #ffffff !important;
        }
    </style>
    <div class="container-fluid px-0">

        <x-lead.tools :title="'Modern Leads'" :buckets="$mainbuckets" :filterBucket="$filterBucket" :totalLeadsCount="$systemTotalLeadsCount ?? $totalLeadsCount"
            :filteredLeadCount="$filteredOrdersCount ?? $filteredLeadCount" :owners="$owners" :sources="$sources" :categories="$categorys" />

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <strong>Whoops!</strong> There were some problems with your input:
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- <div class="d-flex overflow-auto border-bottom mb-2 mt-3 pb-2 gap-3 align-items-center"> -->

            <!-- @php
                // All tab tabhi active hoga jab URL me koi bucket_id ya has_followups na ho
                $isAllActive = !request()->has('bucket_id') && !request()->has('has_followups');
            @endphp
            <a href="{{ route('modern.leads.index') }}"
                class="{{ $isAllActive ? 'btn btn-brand text-white fw-bold px-4 py-2' : 'text-muted fw-semibold px-2 text-decoration-none text-hover-primary' }} text-nowrap">
                All ({{ $totalLeadsCount }})
            </a>

            @php
                $isFollowupActive = request('has_followups') == 1;
            @endphp
            <a href="?has_followups=1"
                class="{{ $isFollowupActive ? 'btn btn-danger text-white fw-bold px-4 py-2' : 'btn btn-soft-danger text-danger fw-semibold px-3 py-1' }} text-nowrap d-flex align-items-center gap-2 text-decoration-none">
                <i class="fa-solid fa-clock"></i> Scheduled Activity ({{ $followupsCount}})
            </a>
            @if($buckets->count())
                @foreach($buckets as $bucket)

                    @php
                        $isActive = request('bucket_id') == $bucket->id;
                    @endphp

                    <a href="?bucket_id={{ $bucket->id }}&lead_status="
                        class="{{ $isActive ? 'btn btn-brand text-white fw-bold px-4 py-2' : 'text-muted fw-semibold px-2 text-decoration-none text-hover-primary' }} text-nowrap">

                        {{ $bucket->name }} ({{ $bucket->leads_count }})

                    </a>

                @endforeach
            @endif -->

            <!-- @if($childBuckets->count())
                                        @foreach($childBuckets as $bucket) {{-- ✅ FIXED HERE --}}

                                        @php
                                        $isActive = request('lead_status') == $bucket->name;
                                        @endphp

                                        <a href="?bucket_id={{ request('bucket_id') }}&lead_status={{ urlencode($bucket->name) }}"
                                            class="{{ $isActive ? 'btn text-white fw-bold px-4 py-2' : 'text-muted fw-semibold px-2 text-decoration-none text-hover-primary' }} text-nowrap" style="background-color: #006FC9;">

                                            {{ $bucket->name }} ({{ $bucket->leads_count }})

                                        </a>

                                        @endforeach
                                        @endif -->
            <!-- @php
                $isDeletedActive = request('deleted_leads') == 1;
            @endphp

            <a href="?deleted_leads=1"
                class="d-none {{ $isDeletedActive ? 'btn btn-dark text-white fw-bold px-4 py-2' : 'btn btn-soft-dark text-dark fw-semibold px-3 py-1' }} text-nowrap align-items-center gap-2 text-decoration-none">

                Old Leads ({{ $deletedLeadsCount }})
            </a>

        </div> -->

        @if(request('view') !== 'pipeline')
        {{-- Status Sub-Tabs --}}
        <div class="lead-tab-strip">
            <button type="button" class="lead-tab-arrow prev" aria-label="Previous statuses" data-status-scroll="prev">
                <i class="feather-chevron-left"></i>
            </button>
            <div class="lead-tab-scroll" id="lead-status-scroll">
                @if($childBuckets->count())
                    @php
                        $isAllActived = empty(request('lead_status')) && !request('deleted_leads');
                    @endphp
                    <a href="{{ request()->fullUrlWithQuery(['lead_status' => '', 'deleted_leads' => '']) }}"
                        class="lead-status-tab status-primary {{ $isAllActived ? 'is-active' : '' }}">
                        <i class="feather-layers"></i>
                        ALL ({{ $childtotalLeadsCount }})
                    </a>

                    @foreach($childBuckets as $bucket)
                        @php
                            $isActive = request('lead_status') == $bucket->name && !request('deleted_leads');
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
                @endif
            </div>
            <button type="button" class="lead-tab-arrow next" aria-label="Next statuses" data-status-scroll="next">
                <i class="feather-chevron-right"></i>
            </button>
        </div>
        @endif


        @if(request('view') !== 'pipeline')
        <div class="lead-list-toolbar d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 px-3">
            <div class="d-flex align-items-center">
                <div class="form-check">
                    <input type="checkbox" id="selectAll" class="form-check-input">
                </div>

                <div class="d-flex align-items-center gap-2">

                    <label class="mb-0">Show</label>

                    <form method="GET">
                        @foreach(request()->except('per_page', 'page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">

                            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            <option value="150" {{ request('per_page') == 150 ? 'selected' : '' }}>150</option>
                            <option value="250" {{ request('per_page') == 250 ? 'selected' : '' }}>250</option>
                            <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500</option>

                        </select>
                    </form>

                    <span>Entries</span>

                </div>
            </div>
            @if(request('has_followups'))
                <form method="GET" id="followupTypeForm">
                    <input type="hidden" name="has_followups" value="1">
                    <input type="hidden" name="followup_type_filter" id="followupTypeInput"
                        value="{{ request('followup_type_filter', 'upcoming') }}">

                    <div class="d-flex gap-2">

                        <!-- Upcoming Tab -->
                        <button type="button"
                            class="btn btn-sm {{ request('followup_type_filter', 'upcoming') == 'upcoming' ? 'btn-primary' : 'btn-light' }}"
                            onclick="setFollowupType('upcoming')">
                            <i class="fas fa-clock me-1 fs-6"></i> Upcoming
                        </button>

                        <!-- Missed Tab -->
                        <button type="button"
                            class="btn btn-sm {{ request('followup_type_filter') == 'missed' ? 'btn-primary' : 'btn-light' }}"
                            onclick="setFollowupType('missed')">
                            <i class="fas fa-times-circle me-1 fs-6"></i>Missed
                        </button>

                    </div>
                </form>
            @endif

            <div class="d-flex flex-wrap gap-2">

                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => '']) }}"
                    class="btn btn-sm {{ request('lead_engagement_status') == '' ? 'btn-primary' : 'btn-light' }}">
                    <i class="fas fa-list me-1"></i> All
                </a>

                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'hot']) }}"
                    class="btn btn-sm {{ request('lead_engagement_status') == 'hot' ? 'btn-danger' : 'btn-light' }}">
                    <i class="fas fa-fire me-1 engagement-hot-icon"></i> Hot
                </a>

                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'warm']) }}"
                    class="btn btn-sm {{ request('lead_engagement_status') == 'warm' ? 'btn-warning' : 'btn-light' }}">
                    <i class="fas fa-sun me-1 engagement-warm-icon"></i> Warm
                </a>

                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'cold']) }}"
                    class="btn btn-sm {{ request('lead_engagement_status') == 'cold' ? 'btn-info' : 'btn-light' }}">
                    <i class="fas fa-snowflake me-1 engagement-cold-icon"></i> Cold
                </a>

                <a href="{{ request()->fullUrlWithQuery(['lead_engagement_status' => 'dead']) }}"
                    class="btn btn-sm {{ request('lead_engagement_status') == 'dead' ? 'btn-dark' : 'btn-light' }}">
                    <i class="fas fa-ban me-1 engagement-dead-icon"></i> Dead
                </a>

            </div>

            <div class="d-flex flex-wrap gap-3">
                <a href="javascript:void(0);" class="bulk-whatsapp" style="color: #006FC9;">
                    <i class="fab fa-whatsapp fs-5"></i>
                </a>

                <a href="javascript:void(0);" class="bulk-sms" style="color: #006FC9;">
                    <i class="fas fa-sms fs-5"></i>
                </a>

                <a href="javascript:void(0);" class="bulk-email" style="color: #006FC9;">
                    <i class="fas fa-envelope fs-5"></i>
                </a>
                <a href="javascript:void(0);" class="bulk-owner" style="color: #006FC9;">

                    <i class="fas fa-user-plus fs-5"></i>

                </a>
                <!-- <form id="bulkDeleteForm" method="POST" action="{{ route('leads.bulkDelete') }}">
                                                    @csrf

                                                    <input type="hidden" name="ids" id="deleteIds">

                                                    <button type="submit" class="text-brand border-0 bg-transparent p-0" id="bulkDeleteBtn">
                                                        <i class="fas fa-trash fs-5"></i>
                                                    </button>
                                                </form> -->

            </div>
        </div>
        @endif

        @if(request('view') !== 'pipeline')
        <div id="lead-list-view">
            <div class="row">
                <div class="col-12">
                @forelse($leads as $lead)
                    @php
                        $engStatus = strtolower($lead->lead_engagement_status ?? 'n/a');
                        $badgeClass = 'bg-soft-secondary text-secondary';
                        if ($engStatus == 'hot') {
                            $badgeClass = 'bg-soft-danger text-danger';
                        } elseif ($engStatus == 'warm') {
                            $badgeClass = 'bg-soft-brand text-brand';
                        } elseif ($engStatus == 'cold') {
                            $badgeClass = 'bg-soft-info text-info';
                        } elseif ($engStatus == 'dead') {
                            $badgeClass = 'bg-soft-dark text-dark';
                        }

                        $rawName = optional($lead->user)->name ?? 'Lead';
                        $userName = ucwords(strtolower(trim($rawName)));
                        $nameParts = explode(' ', $userName);
                        $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                        if (!$initials) $initials = 'LD';

                        $ownerName = optional($lead->owner)->name ?? 'Unassigned';
                        $ownerNameParts = explode(' ', trim($ownerName));
                        $ownerInitials = strtoupper(substr($ownerNameParts[0], 0, 1) . (isset($ownerNameParts[1]) ? substr($ownerNameParts[1], 0, 1) : ''));
                        if (!$ownerInitials) $ownerInitials = 'UA';

                        $lastCommentMsg = $lead->messages
                            ->filter(function($m) { return !empty(trim($m->message ?? '')); })
                            ->sortByDesc('created_at')
                            ->first();

                        $message = $lastCommentMsg->message ?? ($lead->latestMessage->message ?? '');
                        $created_at = $lastCommentMsg->created_at ?? ($lead->latestMessage->created_at ?? null);
                        $commentUser = $lastCommentMsg->user->name ?? ($lead->lastMessage->user->name ?? ($lead->latestMessage->user->name ?? 'Unknown'));
                        $followup = $lead->latestMessage->next_followup_date ?? null;
                        $updatesAfterCount = 0;
                        if ($lastCommentMsg) {
                            $updatesAfterCount = $lead->messages
                                ->filter(function($m) use ($lastCommentMsg) {
                                    return $m->created_at > $lastCommentMsg->created_at;
                                })->count();
                        }

                        $statusName = $lead->lead_status ?? 'Yet to Call';
                        $statusBucket = $childBuckets->firstWhere('name', $statusName) ?? $lead->bucket;
                        $rawColor = $statusBucket->bucket_color ?? 'bg-primary';

                        $cardBg = '#f0f7ff';
                        $iconBg = '#dbeafe';
                        $iconColor = '#1d4ed8';
                        $btnBg = '#e0f2fe';
                        $btnColor = '#0284c7';
                        $borderColor = '#dbeafe';

                        if (str_contains($rawColor, 'warning')) {
                            $cardBg = '#fffbeb';
                            $iconBg = '#fef3c7';
                            $iconColor = '#d97706';
                            $btnBg = '#fef3c7';
                            $btnColor = '#b45309';
                            $borderColor = '#fde68a';
                        } elseif (str_contains($rawColor, 'danger')) {
                            $cardBg = '#fef2f2';
                            $iconBg = '#fee2e2';
                            $iconColor = '#dc2626';
                            $btnBg = '#fee2e2';
                            $btnColor = '#b91c1c';
                            $borderColor = '#fca5a5';
                        } elseif (str_contains($rawColor, 'success')) {
                            $cardBg = '#f0fdf4';
                            $iconBg = '#dcfce7';
                            $iconColor = '#16a34a';
                            $btnBg = '#dcfce7';
                            $btnColor = '#15803d';
                            $borderColor = '#86efac';
                        } elseif (str_contains($rawColor, 'info')) {
                            $cardBg = '#f0f9ff';
                            $iconBg = '#e0f2fe';
                            $iconColor = '#0284c7';
                            $btnBg = '#e0f2fe';
                            $btnColor = '#0369a1';
                            $borderColor = '#7dd3fc';
                        } elseif (str_contains($rawColor, 'dark')) {
                            $cardBg = '#f8fafc';
                            $iconBg = '#e2e8f0';
                            $iconColor = '#334155';
                            $btnBg = '#e2e8f0';
                            $btnColor = '#1e293b';
                            $borderColor = '#cbd5e1';
                        }

                        $statusProgress = 0;
                        $lowerStatus = strtolower(trim($lead->lead_status ?? ''));
                        if (str_contains($lowerStatus, 'yet to call') || str_contains($lowerStatus, 'no response')) {
                            $statusProgress = 15;
                        } elseif (str_contains($lowerStatus, 'qualifying')) {
                            $statusProgress = 35;
                        } elseif (str_contains($lowerStatus, 'proposal sent')) {
                            $statusProgress = 55;
                        } elseif (str_contains($lowerStatus, 'negotiation')) {
                            $statusProgress = 75;
                        } elseif (str_contains($lowerStatus, 'awaiting confirmation')) {
                            $statusProgress = 90;
                        } elseif (str_contains($lowerStatus, 'start') || str_contains($lowerStatus, 'in progress') || str_contains($lowerStatus, 'closed') || str_contains($lowerStatus, 'active production')) {
                            $statusProgress = 100;
                        } else {
                            $statusProgress = 20;
                        }
                    @endphp
                    <div class="card shadow-sm mb-3 border rounded-3 transition-all hover-shadow-md" style="border-color: #e2e8f0 !important; background: #ffffff;">
                        <div class="card-body overflow-x-auto" style="padding: 12px 16px;">
                            <div class="d-flex flex-nowrap align-items-center justify-content-between gap-2" style="min-width: max-content;">

                                {{-- 1. Checkbox --}}
                                <div class="form-check me-1 flex-shrink-0 align-self-center">
                                    <input type="checkbox" class="form-check-input lead-checkbox" value="{{ $lead->id }}" data-email="{{ optional($lead->user)->email }}">
                                </div>

                                {{-- 2. Conic Percentage Progress Circle --}}
                                <div class="position-relative flex-shrink-0">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-2xs" style="width: 44px; height: 44px; font-size: 10px; background: conic-gradient({{ $iconColor }} 0% {{ $statusProgress }}%, #e2e8f0 {{ $statusProgress }}% 100%); padding: 3px;">
                                        <div class="rounded-circle bg-white w-100 h-100 d-flex align-items-center justify-content-center fw-bold fs-11" style="color: {{ $iconColor }};">
                                            {{ $statusProgress }}%
                                        </div>
                                    </div>
                                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="width: 10px; height: 10px;" title="Status: {{ $lead->lead_status }}"></span>
                                </div>

                                {{-- 3. Details (NAME, MOBILE NO., EMAIL, CREATED) --}}
                                <div class="d-flex flex-column gap-0.5 flex-shrink-0 text-truncate" style="width: 175px; min-width: 0;">
                                    {{-- Name --}}
                                    <a data-bs-toggle="collapse" href="#details-{{ $lead->id }}" class="fw-bold text-dark text-decoration-none hover-blue fs-13 text-truncate" style="--hover-color: #006FC9; color: #0f172a !important;" title="{{ $userName }}">
                                        {{ $userName }}
                                    </a>
                                    {{-- Mobile No --}}
                                    <div class="fs-11 text-secondary fw-medium text-truncate">
                                        <i class="fas fa-phone-alt fs-10 text-primary me-1"></i>
                                        {{ optional($lead->user)->contact_no ?? 'N/A' }}
                                    </div>
                                    {{-- Email --}}
                                    <div class="fs-11 text-muted text-truncate">
                                        <i class="fas fa-envelope fs-10 text-primary me-1"></i>
                                        {{ optional($lead->user)->email ?? 'N/A' }}
                                    </div>
                                    {{-- Created Date --}}
                                    <div class="fs-10 text-muted text-truncate mt-0.5">
                                        <i class="far fa-calendar-alt text-primary fs-10 me-1"></i>
                                        <span>Created <strong>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</strong></span>
                                    </div>
                                </div>

                                {{-- 4. EDIT, (i), HOT / SAAP --}}
                                <div class="d-flex flex-column justify-content-center gap-1 flex-shrink-0" style="width: 72px;">
                                    {{-- Row 1: Edit & Info buttons --}}
                                    <div class="d-flex align-items-center gap-1">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-primary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="Edit Lead Form" data-lead="{{ json_encode($lead ?? []) }}" data-user="{{ json_encode($lead->user ?? []) }}" onclick="openEditModal(this)">
                                            <i class="fas fa-pen-to-square fs-10"></i>
                                        </a>
                                        @if($lead->duplicate_count > 0)
                                            <span class="duplicate-info-wrapper">
                                                <a href="{{ request()->fullUrlWithQuery(['duplicate_of' => $lead->id]) }}" class="btn btn-xs btn-light text-secondary rounded-circle p-0 duplicate-btn d-flex align-items-center justify-content-center border shadow-2xs" style="width:20px;height:20px;font-size:10px;" title="View Duplicates">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                                <div class="duplicate-popup shadow">
                                                    <strong>{{ $lead->duplicate_count }}</strong> Duplicate Leads <br> IDs: {{ $lead->duplicate_ids->implode(', ') }}
                                                </div>
                                            </span>
                                        @else
                                            <a href="javascript:void(0);" class="btn btn-xs btn-light text-secondary rounded-circle p-0 d-flex align-items-center justify-content-center border shadow-2xs" style="width:20px;height:20px;font-size:10px;" title="Lead Details Info" data-lead="{{ json_encode($lead ?? []) }}" onclick="openViewDetailsModal(this)">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                        @endif
                                    </div>

                                    {{-- Row 2: HOT Badge --}}
                                    <div class="d-flex align-items-center">
                                        <span class="badge {{ $badgeClass }} fw-semibold px-1.5 py-0.5 rounded-pill text-uppercase" style="font-size: 8.5px;">{{ $engStatus }}</span>
                                    </div>

                                    {{-- Row 3: SAAP Product Badge (Stacked Below $engStatus) --}}
                                    @if($lead->product)
                                        <div class="d-flex align-items-center">
                                            <span class="badge fw-semibold px-1.5 py-0.5 rounded-pill text-uppercase" style="background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; font-size: 8.5px;">{{ $lead->product }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- 5. STATUS --}}
                                <div class="d-flex flex-column justify-content-center flex-shrink-0" style="width: 140px;">
                                    {{-- Lead Status Box --}}
                                    <div class="d-flex align-items-center justify-content-between p-1.5 rounded-3 border shadow-2xs" style="background-color: {{ $cardBg }}; border-color: {{ $borderColor }} !important;" title="Click to edit Lead Status">
                                        <div class="d-flex align-items-center gap-1.5 flex-grow-1 text-truncate" style="cursor:pointer; min-width: 0;" data-bs-toggle="offcanvas" data-bs-target="#editStatusOffcanvas-{{ $lead->id }}">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-2xs" style="width: 28px; height: 28px; background-color: {{ $iconBg }};">
                                                <i class="fas fa-tag fs-11" style="color: {{ $iconColor }};"></i>
                                            </div>
                                            <div class="d-flex flex-column text-truncate" style="min-width: 0;">
                                                <span class="fw-bold fs-11 text-dark text-truncate" style="color: #0f172a !important;">{{ $statusName }}</span>
                                                <span class="fs-9 text-muted" style="font-size: 9px;">Lead Status</span>
                                            </div>
                                        </div>
                                        <div class="ps-0.5 flex-shrink-0">
                                            <button type="button" class="btn btn-xs btn-icon rounded-2 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; background-color: {{ $btnBg }}; color: {{ $btnColor }}; border: 1px solid {{ $borderColor }};" data-bs-toggle="offcanvas" data-bs-target="#editStatusOffcanvas-{{ $lead->id }}" title="Edit Status">
                                                <i class="fas fa-pen fs-9"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- 6. Comment Box (Enlarged Width) --}}
                                <div class="p-2 rounded-3 border d-flex flex-column justify-content-between position-relative shadow-2xs flex-shrink-0" style="{{ ($message || $followup) ? 'background:#f8fafc;' : 'background:#ffffff;' }} width: 160px; min-height: 64px;">
                                    @if($message || $followup)
                                        <div class="d-flex justify-content-between align-items-center mb-0.5">
                                            <strong class="fs-10 text-dark text-truncate" style="max-width: 90px;">{{ $commentUser }}</strong>
                                            @if($updatesAfterCount > 0)
                                                <span class="badge rounded-pill bg-primary text-white" style="font-size: 8px; padding: 1px 4px;" title="{{ $updatesAfterCount }} follow-ups since comment">+{{ $updatesAfterCount }}</span>
                                            @endif
                                        </div>
                                        @if($message)
                                            <p class="fs-10 text-dark mb-1 pe-3 text-truncate" style="line-height: 1.25;" title="{{ $message }}">{{ Str::limit($message, 32) }}</p>
                                        @endif
                                        @if($created_at)
                                            <div class="fs-9 text-muted mt-auto" style="font-size: 9px;">{{ $created_at->diffForHumans() }}</div>
                                        @endif
                                        <a class="open-callback position-absolute" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#proposalSent{{ $lead->id }}" style="bottom: 4px; right: 5px; font-size: 12px; color: #006FC9;" title="Add/View Comments">
                                            <i class="fas fa-comment-dots"></i>
                                        </a>
                                    @else
                                        <div class="d-flex align-items-center justify-content-between text-muted fs-10 h-100 py-1">
                                            <span>No comments</span>
                                            <a class="open-callback" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#proposalSent{{ $lead->id }}" style="font-size: 12px; color: #006FC9;" title="Add Comment">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{-- 7. Client / Business Info Box --}}
                                <div class="p-2 rounded-3 border d-flex flex-column justify-content-between shadow-2xs flex-grow-1" style="background:#f8fafc; border-color:#e2e8f0 !important; min-width: 145px; max-width: 195px; min-height: 64px;">
                                    <div class="fw-bold fs-11 text-dark text-truncate" title="Company Name: {{ $lead->business_name ?? 'N/A' }}">
                                        <i class="fas fa-building text-primary me-1 fs-10" style="width: 11px;"></i>
                                        <span>{{ $lead->business_name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="fs-10 text-secondary text-truncate" title="Industry: {{ $lead->industry ?? 'N/A' }}">
                                        <i class="fas fa-industry text-muted me-1 fs-9" style="width: 11px;"></i>
                                        <span>{{ $lead->industry ?? 'N/A' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-1 fs-10 text-muted mt-0.5">
                                        <span class="text-truncate" title="Employee Strength: {{ $lead->employee_strength ?? 'N/A' }}">
                                            <i class="fas fa-users text-muted me-1 fs-9"></i>{{ $lead->employee_strength ?? 'N/A' }}
                                        </span>
                                        <span class="text-truncate fw-medium text-dark" title="City: {{ $lead->city ?? (optional($lead->user)->city ?? 'N/A') }}">
                                            <i class="fas fa-map-marker-alt text-danger me-1 fs-9"></i>{{ $lead->city ?? (optional($lead->user)->city ?? 'N/A') }}
                                        </span>
                                    </div>
                                </div>

                                {{-- 8. Lead Owner Details --}}
                                <div class="d-flex align-items-center gap-1.5 flex-shrink-0" style="width: 110px;">
                                    @if($lead->owner && $lead->owner->image && file_exists(public_path('storage/' . $lead->owner->image)))
                                        <img src="{{ asset('storage/' . $lead->owner->image) }}" alt="{{ $ownerName }}" class="rounded-circle shadow-sm" style="width:30px; height:30px; object-fit:cover;">
                                    @else
                                        <div class="rounded-circle bg-light text-primary border border-primary-subtle d-flex align-items-center justify-content-center fw-bold fs-10 shadow-sm" style="width:30px; height:30px;" title="{{ $ownerName }}">
                                            {{ $ownerInitials }}
                                        </div>
                                    @endif
                                    <div class="text-truncate">
                                        <div class="fw-semibold fs-11 text-dark text-truncate" title="{{ $ownerName }}">{{ $ownerName }}</div>
                                        <div class="fs-10 text-muted text-truncate">{{ optional($lead->owner)->role->name ?? 'Executive' }}</div>
                                    </div>
                                </div>

                                {{-- 9. Action Tools (Fit inside 84px without overflow) --}}
                                <div class="d-flex flex-column flex-shrink-0 gap-1" style="width: 84px;">
                                    {{-- Row 1: View Details, Quick Edit, Expand --}}
                                    <div class="d-flex align-items-center gap-1">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-primary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="View Details"
                                            data-lead="{{ json_encode($lead ?? []) }}"
                                            data-user="{{ json_encode($lead->user ?? []) }}"
                                            data-owner="{{ json_encode($lead->owner ?? []) }}"
                                            data-bucket="{{ $lead->bucket->name ?? 'N/A' }}"
                                            data-status="{{ $lead->lead_status ?? 'N/A' }}"
                                            data-engagement="{{ $lead->lead_engagement_status ?? 'N/A' }}"
                                            onclick="openViewDetailsModal(this)">
                                            <i class="fas fa-eye fs-10"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-secondary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" data-lead="{{ json_encode($lead ?? []) }}" data-user="{{ json_encode($lead->user ?? []) }}" onclick="openEditModal(this)" title="Edit Lead">
                                            <i class="fas fa-edit fs-10"></i>
                                        </a>
                                        <a data-bs-toggle="collapse" href="#details-{{ $lead->id }}" class="btn btn-xs btn-icon btn-light text-muted border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="Expand Details">
                                            <i class="fas fa-chevron-down fs-10"></i>
                                        </a>
                                    </div>
                                    {{-- Row 2: Convert Button & Dropdown --}}
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button" class="btn btn-xs btn-icon rounded-2 border shadow-2xs d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; background-color: #dcfce7; color: #16a34a; border-color: #86efac !important;" onclick="convertLeads([{{ $lead->id }}]); return false;" title="Convert Lead to Order">
                                            <i class="fas fa-arrows-rotate fs-10"></i>
                                        </button>
                                        <div class="dropdown">
                                            <a class="btn btn-xs btn-icon btn-light text-dark border shadow-2xs rounded-2 d-flex align-items-center justify-content-center dropdown-toggle" style="width: 25px; height: 25px;" href="#" role="button" id="moreOptions{{ $lead->id }}" data-bs-toggle="dropdown" aria-expanded="false" title="More Options">
                                                <i class="fas fa-ellipsis-v fs-10"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="moreOptions{{ $lead->id }}">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-success fw-bold" href="javascript:void(0);" onclick="convertLeads([{{ $lead->id }}]); return false;">
                                                        <i class="fas fa-arrows-rotate me-2 text-success" style="width: 20px;"></i>
                                                        Convert Lead to Order
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-muted" href="javascript:void(0);" title="Missed Calls">
                                                        <i class="fas fa-phone-slash me-2" style="color: #006FC9; width: 20px;"></i>
                                                        {{$lead->call_followup_count ?? 0}} Missed Calls
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-muted" href="javascript:void(0);" title="Messages">
                                                        <i class="far fa-comment-alt me-2" style="color: #006FC9; width: 20px;"></i>
                                                        {{ $lead->messages ? $lead->messages->count() : 0 }} Messages
                                                    </a>
                                                </li>
                                                @if($lead->duplicate_count > 0)
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-warning" href="{{ request()->fullUrlWithQuery(['duplicate_of' => $lead->id]) }}">
                                                            <i class="fa-solid fa-clone me-2" style="width: 20px;"></i>
                                                            {{ $lead->duplicate_count }} Duplicates
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-muted" href="tel:{{ optional($lead->user)->contact_no }}">
                                                        <i class="fas fa-phone-alt me-2" style="color: #006FC9; width: 20px;"></i> Phone
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-muted" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#composeMail" onclick="openSingleEmail('{{ optional($lead->user)->email }}')">
                                                        <i class="fas fa-envelope me-2" style="color: #006FC9; width: 20px;"></i> Email
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center text-muted" style="color: #006FC9;"
                                                        data-bs-toggle="offcanvas" data-bs-target="#whatsappSent{{ $lead->id }}">
                                                        <i class="fab fa-whatsapp me-2" style="color: #006FC9; width: 20px;"></i>WhatsApp
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center text-muted" style="color: #006FC9;"
                                                        data-bs-toggle="offcanvas" data-bs-target="#SMSSent{{ $lead->id }}">
                                                        <i class="fa-solid fa-message me-2" style="color: #006FC9; width: 20px;"></i>SMS
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @include('crm.lead.call-back')
                        </div>
                    </div>
                        {{-- whatsapp offcanvace --}}

                        <div class="content-area offcanvas offcanvas-end" data-scrollbar-target="#psScrollbarInit"
                            style="width:400px" tabindex="-1" id="whatsappSent{{ $lead->id }}"
                            aria-labelledby="whatsappOffcanvasLabel{{ $lead->id }}">
                            <div class="content-area-header sticky-top" style="background-color:#ffffff;">
                                <div class="offcanvas-header  gap-4">

                                    <a href="javascript:void(0);" class="d-flex align-items-center justify-content-center gap-3"
                                        data-bs-toggle="offcanvas" data-bs-target="#userProfileDetails">
                                        <div class="avatar-image">
                                            <img
                                                src="{{ $lead->user?->image ? asset('storage/' . $lead->user->image) : asset('images/blank.jpeg') }}">
                                        </div>
                                        <div class="d-none d-sm-block">
                                            <div class="fw-bold d-flex align-items-center">
                                                {{ optional($lead->user)->name ?? 'User' }}
                                            </div>
                                            <div class="d-flex align-items-center mt-1">
                                                <span class="wd-7 ht-7 rounded-circle opacity-75 me-2 bg-success"></span>
                                                <span
                                                    class="fs-9 text-uppercase fw-bold text-success">{{ optional($lead->user)->contact_no ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </a>
                                    <button type="button" class="btn-close text-reset cancel-offcanvas"
                                        data-id="{{ $lead->id }}" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>

                            </div>
                            <div class="content-area-body h-100 p-4" style="background-color:#efeae2;">
                                <!--! BEGIN: Single Message [start] !-->
                                <div class="d-flex mb-3">
                                    <div class="p-2 px-3 bg-white rounded-3 shadow-sm" style="max-width: 60%;">
                                        Hi,
                                        <div class="text-muted fs-10 text-end mt-1">10:30 AM</div>
                                    </div>
                                </div>

                                <!-- RIGHT (Your Message) -->
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="p-2 px-3 rounded-3 shadow-sm" style="background-color:#d9fdd3; max-width: 60%;">
                                        hy
                                        <div class="text-muted fs-10 text-end mt-1">10:31 AM</div>
                                    </div>
                                </div>

                                <!-- LEFT -->
                                <div class="d-flex mb-3">
                                    <div class="p-2 px-3 bg-white rounded-3 shadow-sm" style="max-width: 60%;">
                                        Hello
                                        <div class="text-muted fs-10 text-end mt-1">10:32 AM</div>
                                    </div>
                                </div>

                                <!-- RIGHT -->
                                <div class="d-flex justify-content-end mb-3">
                                    <div class="p-2 px-3 rounded-3 shadow-sm" style="background-color:#d9fdd3; max-width: 60%;">
                                        hello
                                        <div class="text-muted fs-10 text-end mt-1">10:33 AM</div>
                                    </div>
                                </div>

                            </div>
                            <!--! BEGIN: Message Editor !-->
                            <div
                                class="d-flex align-items-center justify-content-between border-top border-gray-5 bg-white  sticky-bottom">
                                <div class="d-flex align-center">
                                    <div class="dropdown border-end border-gray-5">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown">
                                            <div class="wd-60 d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Pick Template"
                                                style="height: 59px"><i class="feather-hash"></i></div>
                                        </a>
                                        <ul class="dropdown-menu wd-300">
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Welcome you message</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Your issues solved</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Thank you message</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Make a offer message</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Add the Unsubscribe option</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file-text me-3"></i>Thank your customer for joining</a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-save me-3"></i>Save as Template</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-sun me-3"></i>Manage Template</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown border-end border-gray-5">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown">
                                            <div class="wd-60 d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Upload Attachments"
                                                style="height: 59px"><i class="feather-link"></i></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-image me-3"></i>Upload Images</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-mic me-3"></i>Upload Audios</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-video me-3"></i>Upload Videos</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="feather-file me-3"></i>Upload Documents</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown border-end border-gray-5 d-none d-sm-block">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown">
                                            <div class="wd-60 d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Calling Options"
                                                style="height: 59px"><i class="feather-phone-call"></i></div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#voiceCallingModalScreen"><i
                                                        class="feather-phone-call me-3"></i>Audio Call</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#videoCallingModalScreen"><i
                                                        class="feather-video me-3"></i>Video Call</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <input class="form-control border-0 emoji-picker" placeholder="Type your message here...">
                                <div class="border-start border-gray-5 send-message">
                                    <a href="javascript:void(0)" class="wd-60 d-flex align-items-center justify-content-center"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Send Message"
                                        style="height: 59px"><i class="feather-send"></i></a>
                                </div>
                            </div>
                            <!--! END: Message Editor !-->
                        </div>

                        {{-- SMS Offcanvas --}}
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="SMSSent{{ $lead->id }}"
                            aria-labelledby="SMSSentOffcanvasLabel{{ $lead->id }}" style="width: 400px;">

                            <div class="offcanvas-header border-bottom bg-light py-3">
                                <h6 class="offcanvas-title d-flex align-items-center gap-2 fw-bold text-dark"
                                    id="SMSSentOffcanvasLabel{{ $lead->id }}">
                                    <i class="fa-regular fa-comment-dots text-secondary"></i>
                                    Send SMS to <span class="text-capitalize">{{ optional($lead->user)->name ?? 'User' }}</span>
                                </h6>
                                <button type="button" class="btn-close text-reset cancel-offcanvas" data-id="{{ $lead->id }}"
                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body p-3" style="background-color: #f4f6f8;">

                                <hr class="my-2">

                                <!-- Options -->
                                <div class="mb-3">

                                    <div class="form-check">
                                        <input class="form-check-input number-checkbox" type="checkbox" value="+916265455843">
                                        <label class="form-check-label" for="mobileNo">Mobile No</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="fatherNo">
                                        <label class="form-check-label" for="fatherNo">Father's Number</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="motherNo">
                                        <label class="form-check-label" for="motherNo">Mother's Number</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="whatsappNo">
                                        <label class="form-check-label" for="whatsappNo">Whatsapp No</label>
                                    </div>
                                </div>

                                <!-- Template Select -->
                                <select class="form-control template-dropdown">
                                    <option selected disabled>Select Template</option>
                                </select>

                                <!-- Message Box -->
                                <div class="mb-3 flex-grow-1 d-flex flex-column">
                                    <label class="form-label fw-semibold">Message</label>
                                    <textarea class="form-control flex-grow-1" rows="12" placeholder="Type your message...">

                                                                                                </textarea>
                                    <small class="text-muted mt-1 text-end">0/160</small>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <button class=" btn btn-light border text-reset cancel-offcanvas" data-id="{{ $lead->id }}"
                                        data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                                    <button class="btn text-white send-sms-btn" style="background-color: #006FC9;">Send
                                        SMS</button>
                                </div>


                            </div>
                        </div>

                        {{-- CHANGE STATUS AND FOLLOW UP --}}
                        <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas-{{ $lead->id }}"
                            aria-labelledby="editStatusOffcanvasLabel-{{ $lead->id }}" style="width: 420px; background: #f8fafc;">
                            
                            {{-- Offcanvas Header --}}
                            <div class="offcanvas-header border-bottom bg-white py-3 px-4 shadow-2xs">
                                <div class="d-flex align-items-center gap-2.5">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-13 shadow-2xs" style="width: 36px; height: 36px;">
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </div>
                                    <div>
                                        <h6 class="offcanvas-title fw-bold text-dark mb-0 fs-14" id="editStatusOffcanvasLabel-{{ $lead->id }}">
                                            Edit Followup
                                        </h6>
                                        <span class="fs-11 text-muted">
                                            Lead: <strong class="text-dark">{{ optional($lead->user)->name ?? 'User' }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body p-3.5">
                                <form id="quickUpdateForm-{{ $lead->id }}" action="{{ route('lead.updateQuick', $lead->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="lead_bucket_id" class="bucket-select" value="{{ $lead->lead_bucket_id ?? 46 }}">

                                    {{-- Card Box 1: Status & Engagement --}}
                                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                                            <i class="fas fa-sliders text-primary fs-12"></i>
                                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Status & Engagement</h6>
                                        </div>
                                        <div class="card-body p-3">
                                            {{-- Engagement Status --}}
                                            <div class="mb-3">
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-fire text-danger me-1 fs-10"></i>Engagement Status
                                                </label>
                                                <select class="form-select border-slate shadow-2xs fs-13" name="lead_engagement_status" style="border-color: #cbd5e1; border-radius: 8px;">
                                                    <option value="">Select Engagement</option>
                                                    <option value="hot" {{ strtolower($lead->lead_engagement_status) == 'hot' ? 'selected' : '' }}>🔥 Hot</option>
                                                    <option value="warm" {{ strtolower($lead->lead_engagement_status) == 'warm' ? 'selected' : '' }}>⚡ Warm</option>
                                                    <option value="cold" {{ strtolower($lead->lead_engagement_status) == 'cold' ? 'selected' : '' }}>❄️ Cold</option>
                                                    <option value="dead" {{ strtolower($lead->lead_engagement_status) == 'dead' ? 'selected' : '' }}>💀 Dead</option>
                                                </select>
                                            </div>

                                            {{-- Lead Status --}}
                                            <div>
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-tag text-primary me-1 fs-10"></i>Lead Status <span class="text-danger">*</span>
                                                </label>
                                                <select name="lead_status"
                                                    class="form-select border-slate shadow-2xs status-select required-field fs-13"
                                                    style="border-color: #cbd5e1; border-radius: 8px;">
                                                    <option value="">Select Status</option>
                                                    @php
                                                        $statusBucket = $lead->bucket;
                                                        if ($statusBucket && $statusBucket->parent_id) {
                                                            $statusBucket = \App\Models\Bucket::with('children')->find($statusBucket->parent_id);
                                                        }
                                                        if (!$statusBucket || $statusBucket->children->isEmpty()) {
                                                            $statusBucket = \App\Models\Bucket::with('children')->find(46);
                                                        }
                                                        $statusChildren = $statusBucket ? $statusBucket->children : collect();
                                                    @endphp
                                                    @foreach($statusChildren as $child)
                                                        <option data-bg="{{ $child->bucket_color }}" value="{{ $child->name }}" {{ $lead->lead_status == $child->name ? 'selected' : '' }}>
                                                            {{ $child->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('lead_status')
                                                    <small class="text-danger fs-11 mt-1 d-block">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Card Box 2: Communication Details --}}
                                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                                            <i class="fas fa-comments text-info fs-12"></i>
                                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Communication Details</h6>
                                        </div>
                                        <div class="card-body p-3">
                                            {{-- Communication Type --}}
                                            <div class="mb-3">
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-phone text-info me-1 fs-10"></i>Communication Type
                                                </label>
                                                <select class="form-select border-slate shadow-2xs fs-13" name="followup_type" style="border-color: #cbd5e1; border-radius: 8px;" onchange="checkFollowupCommentToggle(this)">
                                                    <option value="">-- Select Communication Type --</option>
                                                    <option value="WhatsApp Call">WhatsApp Call</option>
                                                    <option value="Call">Call</option>
                                                    <option value="Whatsapp">Whatsapp</option>
                                                </select>
                                            </div>

                                            {{-- Communication Status --}}
                                            <div>
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-signal text-info me-1 fs-10"></i>Communication Status
                                                </label>
                                                <select class="form-select border-slate shadow-2xs fs-13" name="followup_status" style="border-color: #cbd5e1; border-radius: 8px;" onchange="checkFollowupCommentToggle(this)">
                                                    <option value="">-- Select Communication Status --</option>
                                                    <option value="Connected">Connected</option>
                                                    <option value="Not Connected">Not Connected</option>
                                                    <option value="Discussion Start">Discussion Start</option>
                                                    <option value="No Response">No Response</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Card Box 3: Remarks & Comments --}}
                                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                                            <i class="fas fa-comment-dots text-warning fs-12"></i>
                                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Remarks & Comments</h6>
                                        </div>
                                        <div class="card-body p-3">
                                            {{-- Next Follow Up Date --}}
                                            <div class="comment-message-box mb-3">
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-calendar-alt text-primary me-1 fs-10"></i>Next Follow Up Date
                                                </label>
                                                <input type="datetime-local" class="form-control border-slate shadow-2xs fs-13"
                                                    name="next_followup_date" value="" style="border-color: #cbd5e1; border-radius: 8px;">
                                            </div>

                                            <div>
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    Add Message / Remark
                                                </label>
                                                <textarea class="form-control border-slate shadow-2xs fs-13" name="message" rows="3"
                                                    placeholder="Write followup notes or conversation details..." style="border-color: #cbd5e1; border-radius: 8px; resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Card Box 4: Audio Recordings & Document Uploads --}}
                                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                                            <i class="fas fa-paperclip text-success fs-12"></i>
                                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Recordings & Document Uploads</h6>
                                        </div>
                                        <div class="card-body p-3">
                                            {{-- Upload Call Recording --}}
                                            <div class="mb-3">
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-microphone text-success me-1 fs-10"></i>Upload Call Recording
                                                </label>
                                                <input type="file" name="call_recording" class="form-control border-slate shadow-2xs fs-12" accept="audio/*" style="border-color: #cbd5e1; border-radius: 8px;">
                                            </div>

                                            {{-- Upload Documents --}}
                                            <div>
                                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                                    <i class="fas fa-file-arrow-up text-primary me-1 fs-10"></i>Upload Documents
                                                </label>
                                                <input type="file" name="followup_documents[]" class="form-control border-slate shadow-2xs fs-12" multiple style="border-color: #cbd5e1; border-radius: 8px;">
                                                <small class="text-muted d-block mt-1 fs-10">Formats supported: PDF, DOC, DOCX, JPG, PNG.</small>
                                                
                                                @if(!empty($lead->latestMessage->followup_documents))
                                                    <div class="mt-2.5 d-flex flex-column gap-1.5">
                                                        <span class="fs-10 text-muted fw-semibold uppercase">Existing Attachments:</span>
                                                        @foreach($lead->latestMessage->followup_documents as $doc)
                                                            @php
                                                                $docPath = is_array($doc) ? ($doc['path'] ?? '') : $doc;
                                                                $docName = is_array($doc) ? ($doc['name'] ?? basename($docPath)) : basename($docPath);
                                                            @endphp
                                                            <div class="p-2 border rounded-2 bg-light d-flex align-items-center justify-content-between shadow-2xs" style="font-size: 11px;">
                                                                <span class="text-truncate me-2 fw-medium text-dark"><i class="far fa-file-alt text-primary me-1"></i>{{ $docName }}</span>
                                                                <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                                    <a href="{{ route('document.view', ['path' => $docPath]) }}" target="_blank" class="btn btn-xs btn-light text-info p-1 px-2 rounded border text-decoration-none">
                                                                        <i class="fas fa-eye me-0.5"></i> View
                                                                    </a>
                                                                    <a href="{{ route('document.download', ['path' => $docPath, 'name' => $docName]) }}" class="btn btn-xs btn-light text-primary p-1 px-2 rounded border text-decoration-none">
                                                                        <i class="fas fa-download me-0.5"></i> Download
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Offcanvas Footer --}}
                                    <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top mt-4">
                                        <button type="button" class="btn btn-light text-secondary fw-semibold border px-3 py-1.5 fs-13" data-bs-dismiss="offcanvas">Cancel</button>
                                        <button type="submit" class="btn text-white fw-bold px-4 py-1.5 fs-13 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%); border: none; border-radius: 6px;">
                                            <i class="fas fa-check-circle fs-12"></i> Update Details
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- ADD TO-DO TASK --}}
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="todoOffcanvas-{{ $lead->id }}"
                            style="width: 420px;">

                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title fw-bold text-dark" style="font-size: 18px;">To-Do Task</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>

                            <div class="offcanvas-body p-0">

                                <div class="p-4" style="background-color: #f8fafc;">
                                    <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Add New To-Do Task:</h6>

                                    <form action="{{ route('lead.storeTodo', $lead->id) }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label text-muted mb-1" style="font-size: 13px;">Summary:</label>
                                            <textarea class="form-control" name="summary" rows="3"
                                                placeholder="Write Your Summary" required
                                                style="font-size: 14px; border-color: #cbd5e1;"></textarea>
                                        </div>

                                        @if(auth()->check() && auth()->user()->role_id == 1)
                                            <div class="mb-3">
                                                <label class="form-label text-muted mb-1" style="font-size: 13px;">Assign To</label>
                                                <select class="form-select" name="assign_to" required
                                                    style="font-size: 14px; border-color: #cbd5e1;">
                                                    <option value="" disabled selected>Select User</option>
                                                    @foreach($owners as $owner)
                                                        <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label text-muted mb-1" style="font-size: 13px;">Due Date</label>
                                            <input type="datetime-local" class="form-control" name="due_date" required
                                                style="font-size: 14px; border-color: #cbd5e1;">
                                        </div>

                                        <div class="text-end mt-2">
                                            <button type="submit" class="btn btn-warning fw-bold px-4 py-2"
                                                style="font-size: 13px;">SAVE TO-DO</button>
                                        </div>
                                    </form>
                                </div>

                                <hr class="m-0" style="border-color: #e2e8f0;">

                                <div class="p-4 bg-white">
                                    @forelse($lead->todoTasks->sortByDesc('created_at') as $task)
                                        <div class="card mb-3 shadow-none" style="border: 1px dashed #cbd5e1; border-radius: 8px;">
                                            <div class="card-body p-3 d-flex align-items-center">

                                                <div class="rounded text-center p-2 me-3 d-flex flex-column justify-content-center"
                                                    style="background-color: #e6f0ff; color: #006FC9; min-width: 55px; height: 55px;">
                                                    <span class="fw-bold"
                                                        style="font-size: 18px; line-height: 1;">{{ \Carbon\Carbon::parse($task->due_date)->format('d') }}</span>
                                                    <span class="fw-bold text-uppercase"
                                                        style="font-size: 10px; letter-spacing: 0.5px;">{{ \Carbon\Carbon::parse($task->due_date)->format('M') }}</span>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-1 gap-2">
                                                        <span class="fw-bold text-dark" style="font-size: 14px;">To-Do Task</span>
                                                        <span class="badge"
                                                            style="background-color: #e6f0ff; color: #006FC9; font-size: 10px;">{{ $task->status }}</span>
                                                    </div>
                                                    <div class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">
                                                        {{ optional($task->assignee)->name ?? 'Unassigned' }}
                                                    </div>
                                                    <div class="text-muted" style="font-size: 11px;">
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('h:i A') }}
                                                    </div>
                                                </div>

                                                <div>
                                                    <button
                                                        class="btn btn-light rounded-circle border d-flex align-items-center justify-content-center"
                                                        style="width: 32px; height: 32px; background-color: #f8fafc;">
                                                        <i class="fa-solid fa-arrow-right text-muted" style="font-size: 12px;"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-4">
                                            <p class="text-muted small">No To-Do tasks found for this lead.</p>
                                        </div>
                                    @endforelse
                                </div>

                            </div>
                        </div>

                        {{-- LEAD DETAILS --}}
                        <div class="collapse w-100" id="details-{{ $lead->id }}">
                            <div class="lead-details-pane border-top p-4 bg-white"
                                style="border-left: 4px solid #006FC9; border-bottom-left-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">

                                <ul class="nav nav-tabs border-bottom-0 mb-4 gap-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link lead-custom-tab active" id="personal-tab-{{ $lead->id }}"
                                            data-bs-toggle="tab" data-bs-target="#personal-{{ $lead->id }}" type="button"
                                            role="tab">Personal Details</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link lead-custom-tab" id="source-tab-{{ $lead->id }}"
                                            data-bs-toggle="tab" data-bs-target="#source-{{ $lead->id }}" type="button"
                                            role="tab">Source Details</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link lead-custom-tab" id="followup-tab-{{ $lead->id }}"
                                            data-bs-toggle="tab" data-bs-target="#followup-{{ $lead->id }}" type="button"
                                            role="tab">Followup Details</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link lead-custom-tab" id="documents-tab-{{ $lead->id }}"
                                            data-bs-toggle="tab" data-bs-target="#documents-{{ $lead->id }}" type="button"
                                            role="tab">Documents</button>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="personal-{{ $lead->id }}" role="tabpanel">
                                        <div class="row g-4">

                                            @if(!empty($lead->category))
                                                <div class="col-md-3 col-sm-6">
                                                    <small class="text-muted text-uppercase d-block mb-1"
                                                        style="font-size: 11px; letter-spacing: 0.5px;">
                                                        Category Name
                                                    </small>

                                                    <span class="fs-15 text-dark">
                                                        {{ $lead->category->category_name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Name</small>
                                                <span class="fs-15 text-dark">{{ optional($lead->user)->name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Email</small>
                                                <span class="fs-15 text-dark">{{ optional($lead->user)->email ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Mobile No.</small>
                                                <span
                                                    class="fs-15 text-dark">{{ optional($lead->user)->contact_no ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Country</small>
                                                <span
                                                    class="fs-15 text-dark">{{ $lead->applying_country_for_a_visa ?? 'N/A' }}</span>
                                            </div>
                                             <div class="col-md-3 col-sm-6">
                                                 <small class="text-muted text-uppercase d-block mb-1"
                                                     style="font-size: 11px; letter-spacing: 0.5px;">City</small>
                                                 <span class="fs-15 text-dark">{{ $lead->city ?? optional($lead->user)->city ?? 'N/A' }}</span>
                                             </div>
                                             <div class="col-md-3 col-sm-6">
                                                 <small class="text-muted text-uppercase d-block mb-1"
                                                     style="font-size: 11px; letter-spacing: 0.5px;">State</small>
                                                 <span class="fs-15 text-dark">{{ $lead->state ?? 'N/A' }}</span>
                                             </div>
                                             <div class="col-md-3 col-sm-6">
                                                 <small class="text-muted text-uppercase d-block mb-1"
                                                     style="font-size: 11px; letter-spacing: 0.5px;">Pincode</small>
                                                 <span class="fs-15 text-dark">{{ $lead->pincode ?? 'N/A' }}</span>
                                             </div>
                                             <div class="col-md-3 col-sm-6">
                                                 <small class="text-muted text-uppercase d-block mb-1"
                                                     style="font-size: 11px; letter-spacing: 0.5px;">Address</small>
                                                 <span class="fs-15 text-dark">{{ $lead->address ?? 'N/A' }}</span>
                                             </div>
                                            <!-- <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Course</small>
                                                <span
                                                    class="fs-15 text-dark">{{ $lead->what_course_are_you_planning_to_study ?? 'N/A' }}</span>
                                            </div> -->
                                             <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Employee Strength</small>
                                                <span
                                                    class="fs-15 text-dark">{{ $lead->employee_strength ?? 'N/A' }}</span>
                                            </div>
                                             <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Industry</small>
                                                <span
                                                    class="fs-15 text-dark">{{ $lead->industry ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px; letter-spacing: 0.5px;">Lead Added On</small>
                                                <span
                                                    class="fs-15 text-dark">{{ $lead->created_at ? $lead->created_at->format('M d, Y h:i A') : 'N/A' }}</span>
                                            </div>

                                            @php
                                                $clientDetails = [];
                                                if (!empty($lead->client_details)) {
                                                    if (is_array($lead->client_details)) {
                                                        $clientDetails = $lead->client_details;
                                                    } elseif (is_string($lead->client_details)) {
                                                        $clientDetails = json_decode($lead->client_details, true) ?? [];
                                                    }
                                                }
                                            @endphp

                                            @if(!empty($clientDetails))
                                                <div class="col-12 mt-4">
                                                    <hr class="my-3">
                                                    <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2">
                                                        <i class="fa-solid fa-users"></i> Additional Contacts / Details
                                                    </h6>
                                                    <div class="row g-3">
                                                        @foreach($clientDetails as $contact)
                                                            @if(!empty($contact['name']) || !empty($contact['designation']) || !empty($contact['email']) || !empty($contact['phone']))
                                                                <div class="col-xl-4 col-md-6 col-12">
                                                                    <div class="card h-100 border shadow-none" style="background-color: #f8fafc; border-radius: 8px; margin-bottom: 0;">
                                                                        <div class="card-body p-3">
                                                                            <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                                                                                <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                                                    <i class="fa-solid fa-user text-primary" style="font-size: 14px;"></i>
                                                                                </div>
                                                                                <div>
                                                                                    <h6 class="fw-bold text-dark mb-0 fs-14">{{ $contact['name'] ?? 'N/A' }}</h6>
                                                                                    <small class="text-muted fs-11 text-uppercase">{{ $contact['designation'] ?? 'No Designation' }}</small>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            @if(!empty($contact['email']))
                                                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                                                    <i class="fa-solid fa-envelope text-muted" style="font-size: 13px; width: 16px;"></i>
                                                                                    <span class="fs-13 text-dark text-break">{{ $contact['email'] }}</span>
                                                                                </div>
                                                                            @endif

                                                                            @if(!empty($contact['phone']))
                                                                                <div class="d-flex align-items-center gap-2">
                                                                                    <i class="fa-solid fa-phone text-muted" style="font-size: 13px; width: 16px;"></i>
                                                                                    <span class="fs-13 text-dark">{{ $contact['phone'] }}</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="source-{{ $lead->id }}" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Source</small>
                                                <span class="fs-15 text-dark">{{ $lead->platform ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Website</small>
                                                @if(!empty($lead->website))
                                                    <a href="{{ str_starts_with($lead->website, 'http') ? $lead->website : 'https://' . $lead->website }}" target="_blank" class="fs-15 text-primary text-decoration-none text-truncate d-block">
                                                        {{ $lead->website }}
                                                    </a>
                                                @else
                                                    <span class="fs-15 text-dark">N/A</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Company Name</small>
                                                <span class="fs-15 text-dark">{{ $lead->business_name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">GST NO.</small>
                                                <span class="fs-15 text-dark">{{ $lead->gst_number ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Page URL</small>
                                                @if(!empty($lead->page_url))
                                                    <a href="{{ $lead->page_url }}" target="_blank"
                                                        class="fs-15 text-primary text-decoration-none d-inline-flex align-items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                                            </path>
                                                            <polyline points="15 3 21 3 21 9"></polyline>
                                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                                        </svg>
                                                        Click Me
                                                    </a>
                                                @else
                                                    <span class="fs-15 text-dark">N/A</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Product</small>
                                                <span class="fs-15 text-dark">{{ $lead->product ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Service</small>
                                                @php
                                                    $selectedServiceIds = [];
                                                    if (!empty($lead->services)) {
                                                        if (is_array($lead->services)) {
                                                            $selectedServiceIds = $lead->services;
                                                        } elseif (is_string($lead->services)) {
                                                            $decoded = json_decode($lead->services, true);
                                                            $selectedServiceIds = is_array($decoded) ? $decoded : explode(',', $lead->services);
                                                        }
                                                    }
                                                    $selectedServiceIds = array_map('trim', $selectedServiceIds);
                                                    $selectedServiceNames = [];
                                                    foreach ($selectedServiceIds as $id) {
                                                        $cat = $categorys->firstWhere('id', $id);
                                                        if ($cat) {
                                                            $selectedServiceNames[] = $cat->category_name;
                                                        } else {
                                                            $selectedServiceNames[] = $id;
                                                        }
                                                    }
                                                @endphp
                                                @if(!empty($selectedServiceNames))
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($selectedServiceNames as $name)
                                                            <span class="badge bg-soft-primary text-primary px-2 py-1" style="font-size: 12px; border-radius: 4px;">{{ $name }}</span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="fs-15 text-dark">N/A</span>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <small class="text-muted text-uppercase d-block mb-1"
                                                    style="font-size: 11px;">Pain Points & Current System</small>
                                                @if(!empty($lead->pain_points))
                                                    @php
                                                        $plainText = strip_tags($lead->pain_points);
                                                        $hasLongText = strlen($plainText) > 150;
                                                    @endphp
                                                    <div class="p-3 bg-light rounded text-dark fs-14" style="min-height: 50px;">
                                                        @if($hasLongText)
                                                            @php
                                                                $truncatedText = mb_substr($plainText, 0, 150);
                                                            @endphp
                                                            <span id="pain-points-short-{{ $lead->id }}">
                                                                {{ $truncatedText }}...
                                                                <a href="javascript:void(0);" 
                                                                   class="fw-semibold ms-1" 
                                                                   style="color: #006FC9; text-decoration: none;"
                                                                   onclick="toggleInlinePP({{ $lead->id }}, true)">Read More</a>
                                                            </span>
                                                            <span id="pain-points-full-{{ $lead->id }}" style="display: none;">
                                                                {!! $lead->pain_points !!}
                                                                <a href="javascript:void(0);" 
                                                                   class="fw-semibold ms-1" 
                                                                   style="color: #006FC9; text-decoration: none;"
                                                                   onclick="toggleInlinePP({{ $lead->id }}, false)">Read Less</a>
                                                            </span>
                                                        @else
                                                            {!! $lead->pain_points !!}
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="p-3 bg-light rounded text-muted fs-14">N/A</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="followup-{{ $lead->id }}" role="tabpanel">
                                        @php
                                            $today = \Carbon\Carbon::today();

                                            $Followups = $lead->messages->filter(function ($item) use ($today) {
                                                return $item->next_followup_date &&
                                                    \Carbon\Carbon::parse($item->next_followup_date)->startOfDay()->gte($today) &&
                                                    $item->is_done == 0;
                                            });

                                            $todayActivities = $lead->messages->filter(function ($item) {
                                                return (
                                                    ($item->created_at && \Carbon\Carbon::parse($item->created_at)->isToday())
                                                    ||
                                                    ($item->updated_at && \Carbon\Carbon::parse($item->updated_at)->isToday())
                                                );
                                            });

                                            $previousActivities = $lead->messages->filter(function ($item) {
                                                return $item->created_at &&
                                                    \Carbon\Carbon::parse($item->created_at)->lt(\Carbon\Carbon::today());
                                            })->sortByDesc('created_at');

                                            $overdueFollowups = $lead->messages->filter(
                                                fn($item) =>
                                                $item->next_followup_date &&
                                                (
                                                    \Carbon\Carbon::parse($item->next_followup_date)->startOfDay()->lt($today)
                                                    || (
                                                        \Carbon\Carbon::parse($item->next_followup_date)->startOfDay()->gte($today)
                                                        && $item->is_done == 1
                                                    )
                                                )
                                            );

                                            $doneFollowups = $lead->messages->filter(function ($item) {
                                                return $item->is_done == 1;
                                            });
                                        @endphp


                                        <div class="container-fluid mt-3">
                                            <div class="followup-main-scroll">
                                                <div class="row g-3">

                                                    <!-- TODAY -->
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="p-2 border-end h-100">
                                                            <h6 class="text-brand fw-semibold mb-3">Planned Activities</h6>
                                                            @forelse($Followups as $followup)
                                                                @php
                                                                    $date = \Carbon\Carbon::parse($followup->next_followup_date)->startOfDay();
                                                                    $today = \Carbon\Carbon::today();
                                                                    if ($date->eq($today)) {
                                                                        $label = 'Today';
                                                                        $class = 'text-brand';
                                                                    } else {
                                                                        $days = $today->diffInDays($date);
                                                                        $label = 'Due in ' . $days . ' day' . ($days > 1 ? 's' : '');
                                                                        $class = 'text-success';
                                                                    }
                                                                @endphp

                                                                <div class="activity-item mb-3">
                                                                    <div class="fw-semibold d-flex gap-1 position-relative">

                                                                        <span class="{{ $class }}"> {{ $label }} : </span> for <span
                                                                            class="text_muted fw-bold">{{ $followup?->user->name ?? 'N/A' }}</span>
                                                                        <button class="btn p-0 border-0 bg-transparent"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#info{{ $followup->id }}">
                                                                            <i class="feather feather-info text-muted"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="collapse mt-2" id="info{{ $followup->id }}">
                                                                        <div class="border rounded p-2 bg-light"
                                                                            style="font-size: 12px; max-width: 350px;">

                                                                            <div><strong>Message:</strong> <span
                                                                                    class="text-muted">{{ $followup->message ?? '-' }}</span>
                                                                            </div>
                                                                            <div><strong>Date:</strong> <span
                                                                                    class="text-muted">{{ \Carbon\Carbon::parse($followup->next_followup_date)->format('d M Y h:i A') }}</span>
                                                                            </div>
                                                                            <div><strong>Status:</strong> <span
                                                                                    class="text-muted">{{ $followup->bucket ?? '-' }}</span>
                                                                            </div>
                                                                            <div><strong>Sub Status:</strong> <span
                                                                                    class="text-muted">{{ $followup->status ?? '-' }}</span>
                                                                            </div>
                                                                            <div><strong>Created By:</strong> <span
                                                                                    class="text-muted">{{ $followup?->user->name ?? '-' }}</span>
                                                                            </div>
                                                                            <div><strong>Followup Type:</strong> <span
                                                                                    class="text-muted">{{ $followup->followup_type ?? '-' }}</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-3 mt-1">

                                                                        @if($followup->is_done == 0)
                                                                            <button type="button" onclick="openDoneModal(this)"
                                                                                data-id="{{ $followup->id }}"
                                                                                class="d-flex align-items-center gap-1 p-0 border-0 bg-transparent">

                                                                                <i
                                                                                    class="feather feather-check-circle text-success"></i>
                                                                                <span class="text-muted"
                                                                                    style="font-size: 12px;">Done</span>
                                                                            </button>
                                                                        @endif

                                                                        <button type="button"
                                                                            class="d-flex align-items-center gap-1 p-0 border-0 bg-transparent"
                                                                            data-bs-toggle="offcanvas"
                                                                            data-bs-target="#snoozeOffcanvas-{{ $followup->id }}">

                                                                            <i class="feather feather-clock text-brand"></i>
                                                                            <span class="text-muted"
                                                                                style="font-size: 12px;">Reschedule</span>
                                                                        </button>

                                                                    </div>

                                                                </div>
                                                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                    id="snoozeOffcanvas-{{ $followup->id }}"
                                                                    aria-labelledby="snoozeOffcanvasLabel-{{ $followup->id }}"
                                                                    style="width: 400px;">
                                                                    <div class="offcanvas-header border-bottom bg-light py-3">
                                                                        <h6 class="offcanvas-title d-flex align-items-center gap-2 fw-bold text-dark"
                                                                            id="editStatusOffcanvasLabel-{{ $followup->id }}">
                                                                            <i
                                                                                class="fa-solid fa-clipboard-list text-secondary"></i>
                                                                            Edit Followup for <span
                                                                                class="text-capitalize">{{ optional($followup->lead->user)->name ?? 'User' }}</span>
                                                                        </h6>
                                                                        <button type="button" class="btn-close text-reset"
                                                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="offcanvas-body p-4 bg-white">
                                                                        <form
                                                                            action="{{ route('lead.callbackUpdate', $followup->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="mb-4">
                                                                                <label class="form-label text-muted small mb-1"
                                                                                    style="font-size: 12px;">Follow Up Type</label>
                                                                                <select
                                                                                    class="form-select bg-light border-0 shadow-sm"
                                                                                    name="followup_type" style="font-size: 14px;">
                                                                                    <option value="" disabled selected>WhatsApp
                                                                                        Follow Up</option>
                                                                                    <option value="WhatsApp Call" {{ $followup->followup_type == 'WhatsApp Call' ? 'selected' : '' }}>WhatsApp Call</option>
                                                                                    <option value="Call" {{ $followup->followup_type == 'Call' ? 'selected' : '' }}>Call</option>
                                                                                    <option value="Whatsapp" {{ $followup->followup_type == 'Whatsapp' ? 'selected' : '' }}>Whatsapp</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="mb-4">
                                                                                <label class="form-label text-muted small mb-1"
                                                                                    style="font-size: 12px;">Next Follow-up
                                                                                    Date</label>
                                                                                <input type="datetime-local"
                                                                                    class="form-control bg-light border-0 shadow-sm"
                                                                                    name="next_followup_date" value=""
                                                                                    style="font-size: 14px;">
                                                                            </div>

                                                                            <div class="mb-4">
                                                                                <label class="form-label text-muted small mb-1"
                                                                                    style="font-size: 12px;">Add Comment /
                                                                                    Message</label>
                                                                                <textarea
                                                                                    class="form-control bg-light border-0 shadow-sm"
                                                                                    name="message" rows="3"
                                                                                    placeholder="Write a comment..."
                                                                                    style="font-size: 14px; resize: none;"></textarea>
                                                                            </div>

                                                                            <div
                                                                                class="d-flex justify-content-end gap-3 pt-3 mt-4 border-top">
                                                                                <button type="button"
                                                                                    class="btn btn-white text-secondary fw-bold border px-4"
                                                                                    data-bs-dismiss="offcanvas"
                                                                                    style="font-size: 13px;">CLOSE</button>
                                                                                <button type="submit"
                                                                                    class="btn text-white fw-bold px-4"
                                                                                    style="background-color: #006FC9; font-size: 13px; border-radius: 4px;">UPDATE
                                                                                    DETAILS</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            @empty
                                                                <small class="text-muted">No followups</small>
                                                            @endforelse
                                                        </div>
                                                    </div>

                                                    <!-- Today Activity -->
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="p-1 border-end h-100">
                                                            <h6 class="text-success fw-semibold mb-3">Today Activity</h6>

                                                            @forelse($todayActivities as $followup)

                                                                <div class="activity-item mb-3">

                                                                    <!-- HEADER -->
                                                                    <div
                                                                        class="fw-semibold d-flex align-items-center gap-1 position-relative">
                                                                        <span
                                                                            class="text_muted fw-bold">{{ $followup?->user->name ?? 'N/A' }}
                                                                        </span>
                                                                        <span class="text-muted" style="font-size: 11px;">
                                                                            {{ \Carbon\Carbon::parse($followup->created_at)->format('g:i A') }}
                                                                        </span>

                                                                    </div>

                                                                    <!-- CONTENT (NEW) -->
                                                                    <div class="mt-1">
                                                                        <div class="fw-semibold" style="font-size: 13px;">
                                                                            <strong>Followup Type :
                                                                            </strong>{{ $followup->followup_type ?? 'N/A' }}
                                                                        </div>
                                                                        <div class="text-muted" style="font-size: 12px;">
                                                                            {{ $followup->message ?? '-' }}
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            @empty
                                                                <small class="text-muted">No activity today</small>
                                                            @endforelse

                                                        </div>
                                                    </div>


                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="p-1 border-end h-100">
                                                            <h6 class="text-primary fw-semibold mb-3">Past Activity</h6>

                                                            @forelse($previousActivities as $followup)

                                                                <div class="activity-item mb-3">

                                                                    <div class="fw-semibold d-flex align-items-center gap-1">
                                                                        <span
                                                                            class="fw-bold text_muted">{{ $followup?->user->name ?? 'N/A' }}</span>

                                                                        <span class="text-muted" style="font-size:11px;">
                                                                            {{ \Carbon\Carbon::parse($followup->created_at)->format('d M Y g:i A') }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="mt-1">
                                                                        <div style="font-size:13px;">
                                                                            <strong>Followup Type :</strong>
                                                                            {{ $followup->followup_type ?? 'N/A' }}
                                                                        </div>

                                                                        <div class="text-muted" style="font-size:12px;">
                                                                            {{ $followup->message ?? '-' }}
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            @empty
                                                                <small class="text-muted">No previous activity</small>
                                                            @endforelse
                                                        </div>
                                                    </div>

                                                    <!-- DONE -->
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="p-1 h-100">
                                                            <h6 class="text-danger fw-semibold mb-3">Overdue / Done</h6>

                                                            @forelse($overdueFollowups as $followup)

                                                                <div class="activity-item mb-3">

                                                                    @if($followup->is_done == 0)

                                                                        @php
                                                                            $date = \Carbon\Carbon::parse($followup->next_followup_date)->startOfDay();
                                                                            $days = $date->diffInDays(\Carbon\Carbon::today());
                                                                        @endphp

                                                                        <div class="fw-semibold d-flex gap-1">
                                                                            <span class="text-danger">
                                                                                Overdue by {{ $days }} day{{ $days > 1 ? 's' : '' }} :
                                                                            </span>
                                                                            for <span
                                                                                class="fw-bold text_muted">{{ $followup?->user->name ?? 'N/A' }}</span>

                                                                            <button class="btn p-0 border-0 bg-transparent"
                                                                                type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#info{{ $followup->id }}">
                                                                                <i class="feather feather-info text-muted"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="collapse mt-2" id="info{{ $followup->id }}">
                                                                            <div class="border rounded p-2 bg-light"
                                                                                style="font-size: 12px; max-width: 350px;">

                                                                                <div><strong>Message:</strong> <span
                                                                                        class="text-muted">{{ $followup->message ?? '-' }}</span>
                                                                                </div>
                                                                                <div><strong>Date:</strong> <span
                                                                                        class="text-muted">{{ \Carbon\Carbon::parse($followup->next_followup_date)->format('d M Y h:i A') }}</span>
                                                                                </div>
                                                                                <div><strong>Status:</strong> <span
                                                                                        class="text-muted">{{ $followup->bucket ?? '-' }}</span>
                                                                                </div>
                                                                                <div><strong>Sub Status:</strong> <span
                                                                                        class="text-muted">{{ $followup->status ?? '-' }}</span>
                                                                                </div>
                                                                                <div><strong>Created By:</strong> <span
                                                                                        class="text-muted">{{ $followup?->user->name ?? '-' }}</span>
                                                                                </div>
                                                                                <div><strong>Followup Type:</strong> <span
                                                                                        class="text-muted">{{ $followup->followup_type ?? '-' }}</span>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex gap-3 mt-1">

                                                                            @if($followup->is_done == 0)
                                                                                <button type="button" onclick="openDoneModal(this)"
                                                                                    data-id="{{ $followup->id }}"
                                                                                    class="d-flex align-items-center gap-1 p-0 border-0 bg-transparent">

                                                                                    <i
                                                                                        class="feather feather-check-circle text-success"></i>
                                                                                    <span class="text-muted"
                                                                                        style="font-size: 12px;">Done</span>
                                                                                </button>
                                                                            @endif

                                                                            <button type="button"
                                                                                class="d-flex align-items-center gap-1 p-0 border-0 bg-transparent"
                                                                                data-bs-toggle="offcanvas"
                                                                                data-bs-target="#snoozeOffcanvas-{{ $followup->id }}">

                                                                                <i class="feather feather-clock text-brand"></i>
                                                                                <span class="text-muted"
                                                                                    style="font-size: 12px;">Reschedule</span>
                                                                            </button>

                                                                        </div>
                                                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                            id="snoozeOffcanvas-{{ $followup->id }}"
                                                                            aria-labelledby="snoozeOffcanvasLabel-{{ $followup->id }}"
                                                                            style="width: 400px;">
                                                                            <div class="offcanvas-header border-bottom bg-light py-3">
                                                                                <h6 class="offcanvas-title d-flex align-items-center gap-2 fw-bold text-dark"
                                                                                    id="editStatusOffcanvasLabel-{{ $followup->id }}">
                                                                                    <i
                                                                                        class="fa-solid fa-clipboard-list text-secondary"></i>
                                                                                    Edit Followup for <span
                                                                                        class="text-capitalize">{{ optional($followup->lead->user)->name ?? 'User' }}</span>
                                                                                </h6>
                                                                                <button type="button" class="btn-close text-reset"
                                                                                    data-bs-dismiss="offcanvas"
                                                                                    aria-label="Close"></button>
                                                                            </div>

                                                                            <div class="offcanvas-body p-4 bg-white">
                                                                                <form
                                                                                    action="{{ route('lead.callbackUpdate', $followup->id) }}"
                                                                                    method="POST" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="mb-4">
                                                                                        <label class="form-label text-muted small mb-1"
                                                                                            style="font-size: 12px;">Follow Up
                                                                                            Type</label>
                                                                                        <select
                                                                                            class="form-select bg-light border-0 shadow-sm"
                                                                                            name="followup_type"
                                                                                            style="font-size: 14px;">
                                                                                            <option value="" disabled selected>WhatsApp
                                                                                                Follow Up</option>
                                                                                            <option value="WhatsApp Call" {{ $followup->followup_type == 'WhatsApp Call' ? 'selected' : '' }}>WhatsApp Call
                                                                                            </option>
                                                                                            <option value="Call" {{ $followup->followup_type == 'Call' ? 'selected' : '' }}>Call</option>
                                                                                            <option value="Whatsapp" {{ $followup->followup_type == 'Whatsapp' ? 'selected' : '' }}>Whatsapp</option>
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="mb-4">
                                                                                        <label class="form-label text-muted small mb-1"
                                                                                            style="font-size: 12px;">Next Follow-up
                                                                                            Date</label>
                                                                                        <input type="datetime-local"
                                                                                            class="form-control bg-light border-0 shadow-sm"
                                                                                            name="next_followup_date" value=""
                                                                                            style="font-size: 14px;">
                                                                                    </div>

                                                                                    <div class="mb-4">
                                                                                        <label class="form-label text-muted small mb-1"
                                                                                            style="font-size: 12px;">Add Comment /
                                                                                            Message</label>
                                                                                        <textarea
                                                                                            class="form-control bg-light border-0 shadow-sm"
                                                                                            name="message" rows="3"
                                                                                            placeholder="Write a comment..."
                                                                                            style="font-size: 14px; resize: none;"></textarea>
                                                                                    </div>

                                                                                    <div
                                                                                        class="d-flex justify-content-end gap-3 pt-3 mt-4 border-top">
                                                                                        <button type="button"
                                                                                            class="btn btn-white text-secondary fw-bold border px-4"
                                                                                            data-bs-dismiss="offcanvas"
                                                                                            style="font-size: 13px;">CLOSE</button>
                                                                                        <button type="submit"
                                                                                            class="btn text-white fw-bold px-4"
                                                                                            style="background-color: #006FC9; font-size: 13px; border-radius: 4px;">UPDATE
                                                                                            DETAILS</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>


                                                                    @else

                                                                        <!-- ✅ DONE STYLE -->
                                                                        <div class="fw-semibold d-flex gap-1">
                                                                            <span class="text-success">
                                                                                Done :
                                                                            </span>
                                                                            by <span
                                                                                class="fw-bold text_muted">{{ $followup?->user->name ?? 'N/A' }}</span>
                                                                            <span class="text-muted" style="font-size: 11px;">
                                                                                {{\Carbon\Carbon::parse($followup->created_at)->format('d M Y')}}
                                                                                {{ \Carbon\Carbon::parse($followup->created_at)->format('g:i A') }}
                                                                            </span>
                                                                        </div>
                                                                        <small class="text-muted">
                                                                            {{ $followup->message ?? '-' }}
                                                                        </small>

                                                                    @endif

                                                                </div>

                                                            @empty
                                                                <small class="text-muted">No overdue</small>
                                                            @endforelse

                                                        </div>
                                                    </div>

                                                </div>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="tab-pane fade" id="documents-{{ $lead->id }}" role="tabpanel">
                                         <div class="row g-4">
                                             <!-- Lead Form Documents -->
                                             <div class="col-md-6">
                                                 <div class="card h-100 border shadow-none" style="background-color: #f8fafc; border-radius: 8px;">
                                                     <div class="card-body p-3">
                                                         <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2">
                                                             <i class="feather feather-folder text-primary"></i> Lead Form Documents
                                                         </h6>
                                                         @if(!empty($lead->documents) && count($lead->documents) > 0)
                                                             <div class="d-flex flex-column gap-2">
                                                                 @foreach($lead->documents as $doc)
                                                                     @php
                                                                         $docPath = is_array($doc) ? ($doc['path'] ?? '') : $doc;
                                                                         $docName = is_array($doc) ? ($doc['name'] ?? basename($docPath)) : basename($docPath);
                                                                     @endphp
                                                                     <div class="d-flex align-items-center justify-content-between p-2 bg-white border rounded">
                                                                         <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                                                             <i class="feather feather-file-text text-primary fs-16"></i>
                                                                             <span class="fs-13 text-dark text-truncate fw-medium">{{ $docName }}</span>
                                                                         </div>
                                                                         <div class="d-flex align-items-center gap-1 ms-2 flex-shrink-0">
                                                                             <a href="{{ route('document.view', ['path' => $docPath]) }}" target="_blank" class="btn btn-xs btn-outline-info d-flex align-items-center gap-1 px-2 py-1" style="font-size: 11px;">
                                                                                 <i class="feather feather-eye"></i> View
                                                                             </a>
                                                                             <a href="{{ route('document.download', ['path' => $docPath, 'name' => $docName]) }}" class="btn btn-xs btn-primary d-flex align-items-center gap-1 text-white px-2 py-1" style="font-size: 11px;">
                                                                                 <i class="feather feather-download"></i> Download
                                                                             </a>
                                                                         </div>
                                                                     </div>
                                                                 @endforeach
                                                             </div>
                                                         @else
                                                             <div class="text-muted fs-13 italic p-2 bg-white border rounded text-center">No lead form documents uploaded.</div>
                                                         @endif
                                                     </div>
                                                 </div>
                                             </div>

                                             <!-- Followup Documents -->
                                             <div class="col-md-6">
                                                 <div class="card h-100 border shadow-none" style="background-color: #f8fafc; border-radius: 8px;">
                                                     <div class="card-body p-3">
                                                         <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2">
                                                             <i class="feather feather-paperclip text-primary"></i> Followup Documents
                                                         </h6>
                                                         @php
                                                             $allFollowupDocs = [];
                                                             if(isset($lead->messages)) {
                                                                 foreach($lead->messages as $msg) {
                                                                     if(!empty($msg->followup_documents) && is_array($msg->followup_documents)) {
                                                                         foreach($msg->followup_documents as $fdoc) {
                                                                             $allFollowupDocs[] = [
                                                                                 'doc' => $fdoc,
                                                                                 'date' => $msg->created_at,
                                                                                 'user' => optional($msg->user)->name ?? 'User'
                                                                             ];
                                                                         }
                                                                     }
                                                                 }
                                                             }
                                                         @endphp

                                                         @if(count($allFollowupDocs) > 0)
                                                             <div class="d-flex flex-column gap-2">
                                                                 @foreach($allFollowupDocs as $item)
                                                                     @php
                                                                         $fdoc = $item['doc'];
                                                                         $docPath = is_array($fdoc) ? ($fdoc['path'] ?? '') : $fdoc;
                                                                         $docName = is_array($fdoc) ? ($fdoc['name'] ?? basename($docPath)) : basename($docPath);
                                                                     @endphp
                                                                     <div class="d-flex align-items-center justify-content-between p-2 bg-white border rounded">
                                                                         <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                                                             <i class="feather feather-file-text text-success fs-16"></i>
                                                                             <div class="text-truncate">
                                                                                 <span class="fs-13 text-dark d-block text-truncate fw-medium">{{ $docName }}</span>
                                                                                 <small class="text-muted fs-11" style="font-size: 10px;">By {{ $item['user'] }} on {{ \Carbon\Carbon::parse($item['date'])->format('d M Y h:i A') }}</small>
                                                                             </div>
                                                                         </div>
                                                                         <div class="d-flex align-items-center gap-1 ms-2 flex-shrink-0">
                                                                             <a href="{{ route('document.view', ['path' => $docPath]) }}" target="_blank" class="btn btn-xs btn-outline-info d-flex align-items-center gap-1 px-2 py-1" style="font-size: 11px;">
                                                                                 <i class="feather feather-eye"></i> View
                                                                             </a>
                                                                             <a href="{{ route('document.download', ['path' => $docPath, 'name' => $docName]) }}" class="btn btn-xs btn-primary d-flex align-items-center gap-1 text-white px-2 py-1" style="font-size: 11px;">
                                                                                 <i class="feather feather-download"></i> Download
                                                                             </a>
                                                                         </div>
                                                                     </div>
                                                                 @endforeach
                                                             </div>
                                                         @else
                                                             <div class="text-muted fs-13 italic p-2 bg-white border rounded text-center">No followup documents uploaded.</div>
                                                         @endif
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>
                        <div class="modal fade" id="DoneModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">

                                    <!-- Header -->
                                    <div class="modal-header bg-light border-bottom">
                                        <h5 class="modal-title fw-bold text-dark">
                                            <i class="feather-check-circle text-success me-2"></i>
                                            <span>Mark as Done</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Body -->
                                    <form method="POST" action="{{ route('lead.callbackDone', $lead->id) }}">
                                        @csrf
                                        <input type="hidden" name="lead_id" id="done_lead_id">
                                        <div class="modal-body">
                                            <div class="mb-4">
                                                <label class="form-label text-muted small mb-1" style="font-size: 12px;">Follow
                                                    Up Status</label>
                                                <select class="form-select bg-light border-0 shadow-sm" name="followup_status"
                                                    style="font-size: 14px;">
                                                    <option value="">--select Follow Up status --</option>
                                                    <option value="Connected">Connected</option>
                                                    <option value="Not Connected">Not Connected</option>
                                                    <option value="Discussion Start">Discussion Start</option>
                                                    <option value="No Response">No Response</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Feedback</label>
                                                <textarea class="form-control" name="feedback" rows="4"
                                                    placeholder="Enter your feedback here..."></textarea>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                Cancel
                                            </button>

                                            <button type="submit" class="btn btn-success">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-5 bg-white rounded border shadow-sm mt-3">
                        <h5 class="text-muted fw-bold">No Lead Found</h5>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4 mb-5">
            {{ $leads->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>{{-- End #lead-list-view --}}
    @endif

    {{-- PIPELINE / KANBAN VIEW CONTAINER --}}
    <div id="lead-pipeline-view" class="{{ request('view') === 'pipeline' ? '' : 'd-none' }} mt-3">
        <div class="card stretch stretch-full shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title mb-1">Pipeline Lead</h5>
                    <span class="fs-12 text-muted">Drag and drop leads to change their status</span>
                </div>
                <span class="badge bg-light text-muted border">{{ $pipelineLeads->count() }} leads</span>
            </div>
            <div class="card-body pt-2">
        <div class="lead-pipeline-wrapper">
            <div class="lead-pipeline-board">
            @php
                $pipelineStatuses = $childBuckets->pluck('name')->toArray();
                if (empty($pipelineStatuses)) {
                    $pipelineStatuses = ['Yet to Call', 'Qualifying', 'Proposal Sent', 'Negotiation', 'Converted', 'Lost'];
                }
                $leadsByStatus = $pipelineLeads->groupBy(function($l) {
                    return $l->lead_status ?: 'Yet to Call';
                });
            @endphp

            @foreach($pipelineStatuses as $statusName)
                @php
                    $statusLeads = $leadsByStatus->get($statusName, collect());
                @endphp
                <div class="pipeline-column pipeline-theme">
                    <div class="pipeline-column-header">
                        <span class="pipeline-column-title" title="{{ $statusName }}">{{ $statusName }}</span>
                        <span class="column-count-badge">
                            {{ $statusLeads->count() }}
                        </span>
                    </div>

                    <div class="pipeline-cards-list" data-status-name="{{ $statusName }}">
                        @forelse($statusLeads as $lead)
                            @php
                                $engagement = strtolower($lead->lead_engagement_status ?? 'n/a');
                                $engagementClass = match($engagement) {
                                    'hot' => 'pipeline-badge-hot', 'warm' => 'pipeline-badge-warm',
                                    'cold' => 'pipeline-badge-cold', 'dead' => 'pipeline-badge-dead',
                                    default => 'pipeline-badge-na',
                                };
                            @endphp
                            <div class="pipeline-card"
                                id="pipeline-card-{{ $lead->id }}"
                                data-lead-id="{{ $lead->id }}"
                                draggable="true">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <span class="pipeline-card-name">{{ optional($lead->user)->name ?? 'Unknown' }}</span>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                        <a href="javascript:void(0);" class="view-lead-details-btn text-decoration-none" title="View Details"
                                            data-lead="{{ json_encode($lead) }}" data-user="{{ json_encode($lead->user) }}"
                                            data-owner="{{ json_encode($lead->owner) }}" data-bucket="{{ $lead->bucket->name ?? 'N/A' }}"
                                            data-status="{{ $lead->lead_status ?? 'N/A' }}" data-engagement="{{ $lead->lead_engagement_status ?? 'N/A' }}"
                                            onclick="openViewDetailsModal(this)"><i class="fas fa-eye"></i></a>
                                        <a href="javascript:void(0);" class="text-decoration-none text-primary" title="Edit Lead"
                                            data-lead="{{ json_encode($lead) }}" data-user="{{ json_encode($lead->user) }}"
                                            onclick="openEditModal(this)"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                                <div class="pipeline-card-phone"><i class="fas fa-phone-alt me-1"></i>{{ optional($lead->user)->contact_no ?? 'N/A' }}</div>
                                <div class="pipeline-card-badges">
                                    <span class="pipeline-card-badge {{ $engagementClass }}">{{ strtoupper($engagement) }}</span>
                                    @if($lead->product)<span class="pipeline-card-badge pipeline-badge-product">{{ $lead->product }}</span>@endif
                                </div>
                                <div class="pipeline-card-meta"><i class="fas fa-user-tie me-1"></i>Owner: <strong>{{ optional($lead->owner)->name ?? 'Unassigned' }}</strong></div>
                                <div class="pipeline-card-meta"><i class="fas fa-calendar-alt me-1"></i>{{ optional($lead->created_at)->format('d M Y h:i A') }}</div>
                            </div>
                        @empty
                            <div class="pipeline-empty empty-column-msg"><i class="fas fa-layer-group mb-1"></i>No leads in this status</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
            </div>
        </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <script>
        function updatePipelineColumnCounts() {
            document.querySelectorAll('.pipeline-column').forEach(col => {
                const cardCount = col.querySelectorAll('.pipeline-card').length;
                const badge = col.querySelector('.column-count-badge');
                if (badge) badge.innerText = cardCount;
            });
        }

        function initPipelineSortable() {
            if (typeof Sortable === 'undefined') return;

            document.querySelectorAll('.pipeline-cards-list').forEach(col => {
                new Sortable(col, {
                    group: 'lead-pipeline',
                    animation: 150,
                    ghostClass: 'bg-soft-primary',
                    chosenClass: 'shadow-lg',
                    filter: '.empty-column-msg',
                    onEnd: function(evt) {
                        const itemEl = evt.item;
                        const sourceCol = evt.from;
                        const targetCol = evt.to;
                        const leadId = itemEl.getAttribute('data-lead-id');
                        const newStatus = targetCol.getAttribute('data-status-name');

                        if (!leadId || !newStatus) return;

                        if (sourceCol === targetCol) return;

                        // Hide empty message in target column if any
                        const emptyMsg = targetCol.querySelector('.empty-column-msg');
                        if (emptyMsg) emptyMsg.style.display = 'none';

                        // Update column badge counts
                        updatePipelineColumnCounts();
                        updatePipelineEmptyStates();

                        // AJAX update
                        fetch(`/modern-leads/drag-update/${leadId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                lead_status: newStatus
                            })
                        })
                        .then(async res => {
                            const data = await res.json();
                            if (!res.ok) throw new Error(data.message || 'Status update failed');
                            return data;
                        })
                        .then(data => {
                            if (data.status === 'success' || data.success === true) {
                                if (window.Swal) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                    Toast.fire({
                                        icon: 'success',
                                        title: `Status changed to "${newStatus}"`
                                    });
                                }
                            } else {
                                throw new Error(data.message || 'Status update failed');
                            }
                        })
                        .catch(err => {
                            console.error('Drag update error:', err);
                            sourceCol.appendChild(itemEl);
                            updatePipelineEmptyStates();
                            updatePipelineColumnCounts();
                            if (window.Swal) {
                                Swal.fire('Error', err.message || 'Status update failed', 'error');
                            }
                        });
                    }
                });
            });
        }

        function updatePipelineEmptyStates() {
            document.querySelectorAll('.pipeline-cards-list').forEach(col => {
                const cards = col.querySelectorAll('.pipeline-card');
                let emptyMsg = col.querySelector('.empty-column-msg');

                if (cards.length === 0 && !emptyMsg) {
                    emptyMsg = document.createElement('div');
                    emptyMsg.className = 'pipeline-empty empty-column-msg';
                    emptyMsg.textContent = 'No leads in this status';
                    col.appendChild(emptyMsg);
                } else if (cards.length > 0 && emptyMsg) {
                    emptyMsg.remove();
                }
            });
        }

        function switchLeadView(view) {
            const listView = document.getElementById('lead-list-view');
            const pipelineView = document.getElementById('lead-pipeline-view');
            const btnList = document.getElementById('btn-list-view');
            const btnPipeline = document.getElementById('btn-pipeline-view');

            if (view === 'pipeline') {
                if (listView) listView.classList.add('d-none');
                if (pipelineView) pipelineView.classList.remove('d-none');
                if (btnList) btnList.classList.remove('active-view');
                if (btnPipeline) btnPipeline.classList.add('active-view');
                localStorage.setItem('lead_active_view', 'pipeline');
            } else {
                if (pipelineView) pipelineView.classList.add('d-none');
                if (listView) listView.classList.remove('d-none');
                if (btnPipeline) btnPipeline.classList.remove('active-view');
                if (btnList) btnList.classList.add('active-view');
                localStorage.setItem('lead_active_view', 'list');
            }
        }

        function initStatusStripScroll() {
            const statusScroll = document.getElementById('lead-status-scroll');
            const statusStrip = statusScroll?.closest('.lead-tab-strip');
            const previousButton = document.querySelector('[data-status-scroll="prev"]');
            const nextButton = document.querySelector('[data-status-scroll="next"]');

            if (!statusScroll || !statusStrip || !previousButton || !nextButton) return;

            const updateArrowState = () => {
                const hasOverflow = statusScroll.scrollWidth > statusScroll.clientWidth + 1;
                statusStrip.classList.toggle('has-overflow', hasOverflow);
                const maxScrollLeft = statusScroll.scrollWidth - statusScroll.clientWidth;
                previousButton.disabled = !hasOverflow || statusScroll.scrollLeft <= 1;
                nextButton.disabled = !hasOverflow || statusScroll.scrollLeft >= maxScrollLeft - 1;
            };

            previousButton.addEventListener('click', () => {
                statusScroll.scrollBy({ left: -Math.max(statusScroll.clientWidth * .75, 180), behavior: 'smooth' });
            });
            nextButton.addEventListener('click', () => {
                statusScroll.scrollBy({ left: Math.max(statusScroll.clientWidth * .75, 180), behavior: 'smooth' });
            });
            statusScroll.addEventListener('scroll', updateArrowState, { passive: true });
            window.addEventListener('resize', updateArrowState);
            updateArrowState();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const initialView = @json(request('view') === 'pipeline' ? 'pipeline' : 'list');
            switchLeadView(initialView);
            initStatusStripScroll();
            updatePipelineEmptyStates();
            initPipelineSortable();
        });
    </script>

    {{-- VIEW DETAILS MODAL --}}
    <div class="modal fade" id="viewLeadDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">

                <!-- Sticky Header -->
                <div class="modal-header border-0 px-4 py-3" style="background: linear-gradient(135deg, #006FC9, #0056a3); position: sticky; top: 0; z-index: 10;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 42px; height: 42px;">
                            <i class="fas fa-user text-white" style="font-size: 18px;"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="viewLeadName">Lead Details</h5>
                            <small class="text-white opacity-75" id="viewLeadSubtitle">Complete Information</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4" style="background: #f4f6f9; max-height: 72vh; overflow-y: auto;">

                    <!-- Status Badges Row -->
                    <div class="d-flex flex-wrap gap-2 mb-4" id="viewLeadBadges"></div>

                    <!-- Section: Personal Information -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: #006FC9; font-size: 14px;">
                                <i class="fas fa-id-card"></i> Personal Information
                            </h6>
                            <div class="row g-3" id="viewPersonalInfo"></div>
                        </div>
                    </div>

                    <!-- Section: Contact Information -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: #006FC9; font-size: 14px;">
                                <i class="fas fa-address-book"></i> Contact Information
                            </h6>
                            <div class="row g-3" id="viewContactInfo"></div>
                        </div>
                    </div>

                    <!-- Section: Lead Information -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: #006FC9; font-size: 14px;">
                                <i class="fas fa-bullseye"></i> Lead Information
                            </h6>
                            <div class="row g-3" id="viewLeadInfo"></div>
                        </div>
                    </div>

                    <!-- Section: Address Details -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: #006FC9; font-size: 14px;">
                                <i class="fas fa-map-marker-alt"></i> Address Details
                            </h6>
                            <div class="row g-3" id="viewAddressInfo"></div>
                        </div>
                    </div>

                    <!-- Section: Additional Information -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="color: #006FC9; font-size: 14px;">
                                <i class="fas fa-info-circle"></i> Additional Information
                            </h6>
                            <div class="row g-3" id="viewAdditionalInfo"></div>
                            <div class="mt-3" id="viewPainPointsSection" style="display: none;">
                                <label class="fw-semibold text-muted mb-1" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Pain Points & Current System</label>
                                <div id="viewPainPoints" class="p-3 bg-light rounded border" style="font-size: 13px; line-height: 1.6; min-height: 50px;"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 bg-white px-4 py-3">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD/EDIT LEAD FORM --}}
    <div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold text-dark" id="leadModalTitle">
                        <i class="feather-user text-primary me-2"></i> <span>Create New Lead</span>
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
                                        <input type="text" name="website" id="inp_website"  class="form-control form-control-sm">
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
                                            @foreach($categorys as $category)
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
                            style="background-color: #006FC9;">Create Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Email model --}}
    <div class="modal fade-scale" id="composeMail" tabindex="-1" aria-labelledby="composeMail" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content position-relative">
                <div class="mail-loader" id="mailLoader"></div>
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Compose Mail</span>
                        <small class="d-block fs-11 fw-normal text-muted">Compose Your Message</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <div class="position-relative border-bottom">
                        <div class="px-2 d-flex align-items-center">
                            <div class="p-0 w-100">

                                <select class="form-control border-0 email-template-dropdown">
                                    <option selected disabled>Select Template</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative border-bottom">
                        <div class="px-2 d-flex align-items-center">
                            <div class="p-0 w-100">
                                <input class="form-control border-0 text-dark" name="tomailmodal" placeholder="TO">
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                            class="position-absolute top-50 end-0 translate-middle badge bg-gray-100 border border-gray-3 fs-10 fw-semibold text-uppercase text-dark rounded-pill c-pointer z-index-100"
                            id="ccbccToggleModal"><span data-bs-toggle="tooltip" data-bs-trigger="hover" title="CC / BCC"
                                style="font-size: 9px !important">CC / BCC</span></a>
                    </div>
                    <div class="border-bottom mail-cc-bcc-fields" id="ccbccToggleModalFileds" style="display: none">
                        <div class="px-2 w-100 d-flex align-items-center border-bottom">
                            <input class="form-control border-0 text-dark" id="cc" name="ccmailmodal" placeholder="CC">
                        </div>
                        <div class="px-2 w-100 d-flex align-items-center">
                            <input class="form-control border-0 text-dark" id="bcc" name="bccmailmodal" placeholder="BCC">
                        </div>
                    </div>
                    <div class="px-3 w-100 d-flex align-items-center">
                        <input class="form-control border-0 my-1 w-100 shadow-none" name="subject" type="email"
                            placeholder="Subject">
                    </div>
                    <div class="editor w-100 m-0">
                        <div class="ht-300 border-bottom-0" id="mailEditorModal"></div>
                    </div>
                </div>
                <!--! BEGIN: [modal-footer] !-->
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <!--! BEGIN: [mail-editor-action-left] !-->
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-primary dropdown-toggle" data-bs-toggle="tooltip"
                                    data-bs-trigger="hover" title="Send Message"> Send </span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0)" class="dropdown-item" data-action-target="#mailActionMessage">
                                    <i class="feather-send me-3"></i>
                                    <span>Instant Send</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item successAlertMessage">
                                    <i class="feather-clock me-3"></i>
                                    <span>Schedule Send</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item successAlertMessage">
                                    <i class="feather-x me-3"></i>
                                    <span>Discard Now</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item successAlertMessage">
                                    <i class="feather-edit-3 me-3"></i>
                                    <span>Save as Draft</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown me-2 d-none d-sm-block">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Pick Template">
                                    <i class="feather-hash"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu wd-300">
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Welcome you message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Your issues solved</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Thank you message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Make a offer message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Add the Unsubscribe option</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Thank your customer for joining</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-save me-3"></i>
                                    <span>Save as Template</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-sun me-3"></i>
                                    <span>Manage Template</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Upload Attachments">
                                    <i class="feather-upload"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-image me-3"></i>
                                    <span>Upload Images</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-video me-3"></i>
                                    <span>Upload Videos</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-mic me-3"></i>
                                    <span>Upload Musics</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Upload Documents</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--! BEGIN: [mail-editor-action-right] !-->
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Editing Actions">
                                    <i class="feather-more-horizontal"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-type me-3"></i>
                                        <span>Plain Text Mode</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-check me-3"></i>
                                        <span>Check Spelling</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-compass me-3"></i>
                                        <span>Smart Compose</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-feather me-3"></i>
                                        <span>Manage Signature</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" data-bs-dismiss="modal">
                            <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                title="Delete Message">
                                <i class="feather-x"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD LEAD OWNER MODAL -->
    <div class="modal fade" id="leadOwnerModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-light">

                    <h5 class="modal-title fw-bold">

                        <i class="feather-user-plus text-primary me-2"></i>

                        Add Lead Owner

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <form action="{{ route('lead.bulkOwnerUpdate') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <input type="hidden" name="lead_ids">


                        <div class="mb-3">

                            <label class="form-label small text-muted">Lead Owner</label>

                            <select name="lead_owner" id="" class="form-select">
                                <option value="">Select Owner</option>
                                @foreach($owners ?? [] as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit" class="btn btn-primary">

                            Save Owner

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script src="{{ asset('crm-assets/assets/vendors/js/quill.min.js') }}"></script>
    @push('scripts')
        <style>
            .iti {
                width: 100%;
                display: block;
            }

            .iti__country-list {
                z-index: 9999 !important;
                width: 250px !important;
                max-height: 200px;
                overflow-y: auto;
            }

            .followup-main-scroll {
                max-height: 500px;
                overflow-y: auto;
                overflow-x: hidden;
                padding-right: 6px;
            }

            textarea.form-control {
                resize: none;
                border-radius: 8px;
            }

            .form-check-input:checked {
                background-color: #ff9800;
                border-color: #ff9800;
            }

            .mail-loader {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255, 255, 255, 0.7);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            }

            /* spinner */
            .mail-loader::after {
                content: "";
                width: 40px;
                height: 40px;
                border: 4px solid #ccc;
                border-top-color: #007bff;
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* blur effect */
            .mail-blur {
                filter: blur(3px);
                pointer-events: none;
            }
        </style>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                document.querySelectorAll("form[id^='quickUpdateForm-']").forEach(form => {

                    const fileInput = form.querySelector('input[name="call_recording"]');
                    const followupType = form.querySelector('select[name="followup_type"]');
                    const followupStatus = form.querySelector('select[name="followup_status"]');

                    // ✅ REAL-TIME FILE VALIDATION
                    if (fileInput) {
                        fileInput.addEventListener("change", function () {

                            let oldError = form.querySelector(".file-error");
                            if (oldError) oldError.remove();

                            const file = this.files[0];

                            if (file) {
                                const maxSize = 50 * 1024 * 1024; // 50MB

                                if (file.size > maxSize) {
                                    this.value = "";
                                    this.classList.add("border-danger");

                                    let error = document.createElement("small");
                                    error.classList.add("text-danger", "file-error");
                                    error.innerText = "File size must be less than 50MB";

                                    this.closest(".mb-4").appendChild(error);
                                } else {
                                    this.classList.remove("border-danger");
                                }
                            }

                        });
                    }

                    // ✅ FORM SUBMIT VALIDATION
                    form.addEventListener("submit", function (e) {

                        let isValid = true;

                        // remove old errors
                        form.querySelectorAll(".error-text, .file-error").forEach(el => el.remove());

                        // required fields check
                        form.querySelectorAll(".required-field").forEach(field => {

                            if (!field.value) {
                                isValid = false;

                                field.classList.add("border-danger");

                                let error = document.createElement("small");
                                error.classList.add("text-danger", "error-text");
                                error.innerText = "This field is required";

                                field.closest(".mb-4").appendChild(error);
                            } else {
                                field.classList.remove("border-danger");
                            }

                        });

                        if (followupType && followupType.value.trim() !== "") {

                            if (!followupStatus.value.trim()) {

                                isValid = false;

                                followupStatus.classList.add("border-danger");

                                let error = document.createElement("small");
                                error.classList.add("text-danger", "error-text");
                                error.innerText = "Follow Up Status is required";

                                followupStatus.closest(".mb-4").appendChild(error);

                            } else {
                                followupStatus.classList.remove("border-danger");
                            }
                        }

                        // ✅ FILE CHECK ON SUBMIT
                        if (fileInput && fileInput.files[0]) {
                            const maxSize = 50 * 1024 * 1024;

                            if (fileInput.files[0].size > maxSize) {
                                isValid = false;

                                fileInput.classList.add("border-danger");

                                let error = document.createElement("small");
                                error.classList.add("text-danger", "file-error");
                                error.innerText = "File size must be less than 50MB";

                                fileInput.closest(".mb-4").appendChild(error);
                            }
                        }

                        if (!isValid) {
                            e.preventDefault();
                        }

                    });

                    // Real-time Comment Box toggle
                    const commentBox = form.querySelector('.comment-message-box') || form.querySelector('textarea[name="message"]')?.closest('.mb-4');

                    function toggleCommentField() {
                        if (!followupType || !followupStatus || !commentBox) return;
                        const typeVal = (followupType.value || '').trim().toLowerCase();
                        const statusVal = (followupStatus.value || '').trim().toLowerCase();

                        const isCallType = typeVal.includes('call');
                        const isHideStatus = (statusVal === 'not connected' || statusVal === 'no response');

                        if (isCallType && isHideStatus) {
                            commentBox.style.setProperty('display', 'none', 'important');
                        } else {
                            commentBox.style.setProperty('display', 'block', 'important');
                        }
                    }

                    if (followupType) followupType.addEventListener('change', toggleCommentField);
                    if (followupStatus) followupStatus.addEventListener('change', toggleCommentField);
                    toggleCommentField();

                });

            });
        </script>
        <script>
            $('#composeMail').on('shown.bs.modal', function () {

                if (!window.quillInitialized) {
                    window.quill = new Quill('#mailEditorModal', {
                        theme: 'snow',
                        placeholder: 'Write your email...'
                    });

                    window.quillInitialized = true;
                }

            });

            $(document).ready(function () {
                $("#ccbccToggleModal").click(function () {
                    $("#ccbccToggleModalFileds").slideToggle(200);
                });

                $(document).on('shown.bs.offcanvas show.bs.offcanvas', '.offcanvas', function () {
                    const followupType = this.querySelector('select[name="followup_type"]');
                    const followupStatus = this.querySelector('select[name="followup_status"]');
                    const commentBox = this.querySelector('.comment-message-box') || this.querySelector('textarea[name="message"]')?.closest('.mb-4');

                    if (followupType && followupStatus && commentBox) {
                        const typeVal = (followupType.value || '').trim().toLowerCase();
                        const statusVal = (followupStatus.value || '').trim().toLowerCase();

                        const isCallType = typeVal.includes('call');
                        const isHideStatus = (statusVal === 'not connected' || statusVal === 'no response');

                        if (isCallType && isHideStatus) {
                            commentBox.style.setProperty('display', 'none', 'important');
                        } else {
                            commentBox.style.setProperty('display', 'block', 'important');
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {

                // Bucket change -> AJAX update + Status dropdown update
                $(document).on("change", ".bucket-select", function () {

                    let bucketId = $(this).val();
                    let form = $(this).closest("form"); // current form
                    let statusSelect = form.find(".status-select"); // same form ka dropdown
                    let pendingSubStatus = statusSelect.attr('data-pending-value') || statusSelect.data('pending-value') || '';

                    if (!bucketId) return;

                    $.ajax({
                        url: "{{ route('lead.getSubStatus') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            lead_bucket_id: bucketId,
                            bucket_id: bucketId
                        },
                        success: function (res) {

                            statusSelect.empty();
                            statusSelect.append('<option value="">Select Status</option>');

                            let children = Array.isArray(res) ? res : (res.children || res.data || []);
                            children.forEach(function (child) {
                                let isSelected = (pendingSubStatus && (child.name === pendingSubStatus || child.id == pendingSubStatus)) ? 'selected' : '';
                                statusSelect.append(
                                    `<option value="${child.name}" data-bg="${child.color || ''}" ${isSelected}>
                                        ${child.name}
                                    </option>`
                                );
                            });

                            if (pendingSubStatus) {
                                statusSelect.val(pendingSubStatus);
                                statusSelect.removeAttr('data-pending-value');
                                statusSelect.removeData('pending-value');
                            }

                            // ✅ If using select2
                            statusSelect.trigger('change');

                        },
                        error: function (xhr) {
                            console.error("Sub-status load failed!", xhr);
                        }
                    });

                });
            });
        </script>
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

                // Add phone validation to the input
                const phoneInput = wrapper.querySelector('.cloned-phone-input');
                phoneInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                // Add click handler to remove button
                const removeBtn = wrapper.querySelector('.btn-remove-contact');
                removeBtn.addEventListener('click', function() {
                    wrapper.remove();
                    updateContactCount();
                });

                container.appendChild(wrapper);
                contactIndex++;
                updateContactCount();

                // Smooth scroll modal body to the bottom so the new card is visible
                const modalBody = container.closest('.modal-body');
                if (modalBody) {
                    setTimeout(() => {
                        modalBody.scrollTo({
                            top: modalBody.scrollHeight,
                            behavior: 'smooth'
                        });
                    }, 50);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const btnAddContact = document.getElementById('btnAddContact');
                if (btnAddContact) {
                    btnAddContact.addEventListener('click', function() {
                        addContactRow();
                    });
                }

                // Initialize Quill Editor for Pain Points & Current System
                if (document.getElementById('pain_points_editor')) {
                    window.painPointsQuill = new Quill('#pain_points_editor', {
                        theme: 'snow',
                        placeholder: 'Enter Pain Points & Current System...'
                    });
                }

                // Sync Quill editor with hidden input on form submit
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

            // Create Mode
            function openCreateModal() {
                console.log('store method clicked');

                // Form ko reset karein
                document.getElementById('leadForm').reset();
                
                // Clear cloned contacts
                const container = document.getElementById('clonedContactsContainer');
                if (container) container.innerHTML = '';
                contactIndex = 0;
                updateContactCount();

                // Reset select2 services dropdown
                let servicesSelect = document.getElementById('inp_services');
                if (servicesSelect) {
                    Array.from(servicesSelect.options).forEach(opt => opt.selected = false);
                    $(servicesSelect).trigger('change');
                }

                // Clear Quill editor
                if (window.painPointsQuill) {
                    window.painPointsQuill.root.innerHTML = '';
                }

                // Reset documents
                let docsInput = document.getElementById('inp_documents');
                if (docsInput) docsInput.value = '';
                let docsContainer = document.getElementById('existing_documents_container');
                if (docsContainer) docsContainer.innerHTML = '';

                // Action aur Method
                document.getElementById('leadForm').action = "{{ route('lead.store') }}";
                document.getElementById('formMethod').value = "POST";

                // UI Text
                document.querySelector('#leadModalTitle span').innerText = "Create New Lead";
                document.getElementById('btnSubmit').innerText = "Create Lead";

                // Set default Bucket (Lead) & Sub-Status (Yet to Call)
                let bucketSelect = document.querySelector('#leadModal .bucket-select');
                let statusSelect = document.querySelector('#leadModal .status-select');
                if (bucketSelect) {
                    let defaultOption = Array.from(bucketSelect.options).find(opt => opt.text.trim().toLowerCase().includes('lead')) || bucketSelect.options[1] || bucketSelect.options[0];
                    if (defaultOption) {
                        bucketSelect.value = defaultOption.value;
                        if (statusSelect) {
                            $(statusSelect).attr('data-pending-value', 'Yet to Call');
                        }
                        $(bucketSelect).trigger('change');
                    }
                }

                var myModal = new bootstrap.Modal(document.getElementById('leadModal'));
                myModal.show();
            }

            // Edit Mode
            function openEditModal(button) {
                console.log('Edit method clicked');
                let lead = JSON.parse(button.getAttribute('data-lead') || '{}');
                let user = JSON.parse(button.getAttribute('data-user') || '{}');

                let updateUrl = "{{ url('/lead/update') }}/" + lead.id;
                document.getElementById('leadForm').action = updateUrl;
                document.getElementById('formMethod').value = "PUT";

                document.querySelector('#leadModalTitle span').innerText = "Edit Lead: " + (user.name || 'Unknown');
                document.getElementById('btnSubmit').innerText = "Update Lead";

                // Set saved Bucket & Sub-Status
                let bucketSelect = document.querySelector('#leadModal .bucket-select');
                let statusSelect = document.querySelector('#leadModal .status-select');
                if (bucketSelect) {
                    let targetBucket = lead.lead_bucket_id || (bucketSelect.options[1] ? bucketSelect.options[1].value : '');
                    bucketSelect.value = targetBucket;
                    if (statusSelect && lead.lead_status) {
                        $(statusSelect).attr('data-pending-value', lead.lead_status);
                    }
                    $(bucketSelect).trigger('change');
                }

                // Form values
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

                // Populate Employee Strength & Industry, Website, Business Name (Company Name), GST Number
                document.getElementById('inp_employee_strength').value = lead.employee_strength || '';
                document.getElementById('inp_industry').value = lead.industry || '';
                document.getElementById('inp_website').value = lead.website || '';
                document.getElementById('inp_business').value = lead.business_name || '';
                document.getElementById('inp_gst').value = lead.gst_number || '';
                
                // Choose Product (maps to product or applying_country_for_a_visa if fallback needed)
                document.getElementById('inp_product').value = lead.product || lead.applying_country_for_a_visa || '';
                
                // Pain Points (maps to pain_points or description if fallback needed) & Load into Quill
                let painPointsVal = lead.pain_points || lead.description || '';
                document.getElementById('inp_pain_points').value = painPointsVal;
                if (window.painPointsQuill) {
                    window.painPointsQuill.root.innerHTML = painPointsVal;
                }

                // Populate Documents
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

                // Populate Services Multiselect
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
                    $(servicesSelect).trigger('change');
                }

                // Populate Cloned Contacts
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

            function openDoneModal(button) {
                let leadId = button.getAttribute('data-id');
                document.getElementById('done_lead_id').value = leadId;
                var myModal = new bootstrap.Modal(document.getElementById('DoneModal'));
                myModal.show();
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                // 1. Initialize IntlTelInput for ALL inputs with class '.phone-input'
                document.querySelectorAll('.phone-input').forEach(function (input) {

                    var iti = window.intlTelInput(input, {
                        initialCountry: "in",
                        separateDialCode: true,
                        preferredCountries: ["in", "us", "gb", "au", "ca"],
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
                    });

                    // Function to update hidden country code input
                    function updateCountryCode() {
                        var countryData = iti.getSelectedCountryData();
                        // Find the hidden input within the same form
                        var hiddenInput = input.closest('form').querySelector('.country-code-input');
                        if (hiddenInput) {
                            hiddenInput.value = "+" + countryData.dialCode;
                        }
                    }

                    // Set initial code and listen for changes
                    updateCountryCode();
                    input.addEventListener("countrychange", updateCountryCode);

                    // 2. Auto-fetch User Details on Mobile Blur
                    input.addEventListener("blur", function () {
                        let mobile = input.value.trim();
                        if (!mobile) return;

                        let modal = input.closest('.modal'); // Find the current modal

                        fetch("{{ route('user.search.byMobile') }}?mobile=" + encodeURIComponent(mobile))
                            .then(res => res.json())
                            .then(data => {
                                let nameInput = modal.querySelector(".auto-name");
                                let emailInput = modal.querySelector(".auto-email");
                                let cityInput = modal.querySelector(".auto-city");

                                if (data.exists) {
                                    nameInput.value = data.user.name;
                                    emailInput.value = data.user.email;
                                    cityInput.value = data.user.city;

                                    nameInput.readOnly = true;
                                    emailInput.readOnly = true;
                                    cityInput.readOnly = true;
                                } else {
                                    nameInput.value = "";
                                    emailInput.value = "";
                                    cityInput.value = "";

                                    nameInput.readOnly = false;
                                    emailInput.readOnly = false;
                                    cityInput.readOnly = false;
                                }
                            });
                    });
                });

            });
        </script>
        <script>
            let allTemplates = {};

            document.querySelectorAll('.offcanvas').forEach(function (offcanvas) {

                offcanvas.addEventListener('show.bs.offcanvas', function () {

                    let leadId = this.id.replace('SMSSent', '');

                    if (allTemplates[leadId]) return;

                    fetch(`/fetch-templates`)
                        .then(res => res.json())
                        .then(data => {
                            allTemplates[leadId] = data.templates;

                            let dropdown = this.querySelector('.template-dropdown');

                            dropdown.innerHTML = `<option selected disabled>Select Template</option>`;

                            data.templates.forEach(template => {
                                let option = document.createElement("option");
                                option.value = template.id;
                                option.textContent = template.name;

                                dropdown.appendChild(option);
                            });

                        });

                });

            });
        </script>
        <script>
            document.addEventListener("change", function (e) {

                if (e.target.classList.contains("template-dropdown")) {

                    let offcanvas = e.target.closest('.offcanvas');
                    let leadId = offcanvas.id.replace('SMSSent', '');
                    let templateId = e.target.value;

                    let template = allTemplates[leadId].find(t => t.id == templateId);

                    if (template) {
                        let textarea = offcanvas.querySelector("textarea");
                        textarea.value = template.message;
                    }
                }

            });
        </script>

        <script>
            let emailTemplates = {};

            document.getElementById('composeMail').addEventListener('show.bs.modal', function () {

                let modal = this;

                // prevent multiple API calls
                if (emailTemplates.loaded) return;

                fetch('/fetch-templates')
                    .then(res => res.json())
                    .then(data => {

                        emailTemplates.data = data.templates;
                        emailTemplates.loaded = true;

                        let dropdown = modal.querySelector('.email-template-dropdown');

                        dropdown.innerHTML = `<option selected disabled>Select Template</option>`;

                        data.templates.forEach(template => {
                            let option = document.createElement("option");
                            option.value = template.id;
                            option.textContent = template.name;
                            dropdown.appendChild(option);
                        });

                    })
                    .catch(err => console.log(err));
            });
        </script>
        <script>
            document.addEventListener("change", function (e) {

                if (e.target.classList.contains("email-template-dropdown")) {

                    let modal = e.target.closest('#composeMail');
                    let templateId = e.target.value;

                    let template = emailTemplates.data.find(t => t.id == templateId);

                    if (template) {
                        if (window.quill) {
                            window.quill.setText(template.message);
                        }
                    }
                }

            });
        </script>

        <script>
            document.addEventListener("click", function (e) {

                if (e.target.classList.contains("send-sms-btn")) {

                    let offcanvas = e.target.closest('.offcanvas');

                    // 📱 Selected Numbers
                    let numbers = [];
                    offcanvas.querySelectorAll(".number-checkbox:checked").forEach(cb => {
                        if (cb.value) numbers.push(cb.value);
                    });

                    // 📝 Message
                    let message = offcanvas.querySelector("textarea").value;

                    if (numbers.length === 0) {
                        alert("Please select at least one number");
                        return;
                    }

                    if (!message.trim()) {
                        alert("Message cannot be empty");
                        return;
                    }

                    //  API Call
                    fetch(`/send-sms`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            numbers: numbers,
                            message: message
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            alert("SMS Sent Successfully");
                        })
                        .catch(err => {
                            console.error(err);
                            alert("Failed to send SMS");
                        });

                }

            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const selectAll = document.getElementById("selectAll");
                const checkboxes = document.querySelectorAll(".lead-checkbox");

                // ✅ Select All click
                if (selectAll) {
                    selectAll.addEventListener("change", function () {

                        checkboxes.forEach(cb => {
                            cb.checked = selectAll.checked;
                        });

                    });
                }

                // ✅ Individual checkbox change → SelectAll update
                checkboxes.forEach(cb => {
                    cb.addEventListener("change", function () {

                        let allChecked = document.querySelectorAll(".lead-checkbox:checked").length === checkboxes.length;

                        selectAll.checked = allChecked;

                    });
                });

            });
        </script>
        <script>
            document.querySelector(".bulk-owner").addEventListener("click", function () {

                let leadIds = [];

                document.querySelectorAll(".lead-checkbox:checked").forEach(cb => {

                    let id = cb.value;

                    if (id) {
                        leadIds.push(id);
                    }

                });

                // ✅ check selected or not
                if (leadIds.length === 0) {

                    alert("Please select at least one lead");

                    return;
                }

                // ✅ hidden input me ids bhejo
                document.querySelector('input[name="lead_ids"]').value = leadIds.join(",");

                // ✅ modal open
                let modal = new bootstrap.Modal(
                    document.getElementById('leadOwnerModal')
                );

                modal.show();

            });

            document.querySelector(".bulk-email").addEventListener("click", function () {

                let emails = [];

                document.querySelectorAll(".lead-checkbox:checked").forEach(cb => {
                    let email = cb.getAttribute("data-email");
                    if (email) emails.push(email);
                });

                if (emails.length === 0) {
                    alert("Please select at least one lead");
                    return;
                }

                // 👉 TO field me sab emails daal do (comma separated)
                document.querySelector('input[name="tomailmodal"]').value = emails.join(",");

                // 👉 modal open
                let modal = new bootstrap.Modal(document.getElementById('composeMail'));
                modal.show();
            });

            (function (email) {
                emailjs.init("7C4A3PjvrSEwKHu2n");
            })();

            document.addEventListener("DOMContentLoaded", function () {

                const sendBtn = document.querySelector('[data-action-target="#mailActionMessage"]');
                const loader = document.getElementById('mailLoader');
                const modalContent = document.querySelector('#composeMail .modal-content');

                if (sendBtn) {
                    sendBtn.addEventListener("click", function () {

                        let to = document.querySelector('input[name="tomailmodal"]').value;
                        let subject = document.querySelector('input[name="subject"]').value;
                        let message = document.getElementById('mailEditorModal').innerText;
                        let cc = document.getElementById('cc').value;
                        let bcc = document.getElementById('bcc').value;

                        message = message.replace(/\n+/g, '\n').trim();

                        if (!to || !subject) {
                            alert("To and Subject fields are required.");
                            return;
                        }

                        // ✅ START LOADER
                        loader.style.display = "flex";
                        modalContent.classList.add("mail-blur");
                        sendBtn.style.pointerEvents = "none";

                        let params = {
                            to: to,
                            cc: cc,
                            bcc: bcc,
                            subject: subject,
                            message: message
                        };

                        emailjs.send("service_q245cck", "template_2lq452u", params)
                            .then(function (response) {

                                alert("Email Sent Successfully");

                                // ✅ STOP LOADER
                                loader.style.display = "none";
                                modalContent.classList.remove("mail-blur");

                                // ✅ CLOSE MODAL
                                let modal = document.getElementById('composeMail');
                                let modalInstance = bootstrap.Modal.getInstance(modal);
                                if (modalInstance) modalInstance.hide();

                            })
                            .catch(function (error) {

                                console.log(error);
                                alert("Failed ");

                                // ✅ STOP LOADER ON ERROR
                                loader.style.display = "none";
                                modalContent.classList.remove("mail-blur");
                                sendBtn.style.pointerEvents = "auto";

                            });

                    });
                }

            });
        </script>
        <script>
            document.getElementById('bulkDeleteForm').addEventListener('submit', function (e) {

                let ids = [];

                document.querySelectorAll('.lead-checkbox:checked').forEach(cb => {
                    ids.push(cb.value);
                });

                if (ids.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one lead');
                    return;
                }

                if (!confirm('Are you sure you want to delete selected leads?')) {
                    e.preventDefault();
                    return;
                }

                document.getElementById('deleteIds').value = ids.join(',');
            });
        </script>

        <script id="setFollowupTypeScript">
            function setFollowupType(type) {
                document.getElementById('followupTypeInput').value = type;
                document.getElementById('followupTypeForm').submit();
            }
        </script>
        <script>
            function toggleInlinePP(leadId, showFull) {
                const shortSpan = document.getElementById('pain-points-short-' + leadId);
                const fullSpan = document.getElementById('pain-points-full-' + leadId);
                if (showFull) {
                    shortSpan.style.display = 'none';
                    fullSpan.style.display = 'inline';
                } else {
                    shortSpan.style.display = 'inline';
                    fullSpan.style.display = 'none';
                }
            }
        </script>
        <script>
            window.convertLeads = function(ids) {
                if (!ids || ids.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Selection Required',
                        text: 'Please select at least one lead to convert.'
                    });
                    return;
                }
                Swal.fire({
                    title: 'Convert Lead to Order?',
                    text: 'Are you sure you want to convert this lead to Order? Status will be updated to "Active production" and moved to My Orders.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-exchange-alt me-1"></i> Yes, Convert!'
                }).then(function(result) {
                    if (result && (result.isConfirmed || result.value)) {
                        Swal.fire({
                            title: 'Converting...',
                            text: 'Please wait while we convert the lead.',
                            allowOutsideClick: false,
                            didOpen: function() {
                                Swal.showLoading();
                            }
                        });

                        var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

                        $.ajax({
                            url: "{{ route('modern.leads.convert') }}",
                            type: "POST",
                            data: JSON.stringify({ lead_ids: ids }),
                            contentType: "application/json",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function(response) {
                                if (response && response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Converted!',
                                        text: response.message || 'Lead converted successfully!',
                                        timer: 1500,
                                        showConfirmButton: false
                                    }).then(function() {
                                        window.location.href = "{{ route('orders.index') }}";
                                    });
                                } else {
                                    Swal.fire('Error', (response && response.message) ? response.message : 'Conversion failed', 'error');
                                }
                            },
                            error: function(xhr) {
                                var errMsg = 'Conversion failed';
                                if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
                                    errMsg = xhr.responseJSON.message;
                                }
                                Swal.fire('Error', errMsg, 'error');
                            }
                        });
                    }
                });
            };

            // ========== VIEW LEAD DETAILS MODAL ==========
            function openViewDetailsModal(el) {
                var lead = JSON.parse(el.getAttribute('data-lead') || '{}');
                var user = JSON.parse(el.getAttribute('data-user') || '{}');
                var owner = JSON.parse(el.getAttribute('data-owner') || '{}');
                var bucket = el.getAttribute('data-bucket') || 'N/A';
                var status = el.getAttribute('data-status') || 'N/A';
                var engagement = el.getAttribute('data-engagement') || 'N/A';

                // Helper: create a field item HTML
                function fieldHtml(icon, label, value) {
                    var v = (value && value !== 'null' && value !== 'undefined') ? value : 'N/A';
                    return '<div class="col-md-4 col-sm-6 col-12">' +
                        '<div class="vd-field-item">' +
                        '<span class="vd-field-label"><i class="fas ' + icon + '"></i> ' + label + '</span>' +
                        '<span class="vd-field-value">' + v + '</span>' +
                        '</div></div>';
                }

                // Header
                document.getElementById('viewLeadName').textContent = user.name || 'Unknown User';
                document.getElementById('viewLeadSubtitle').textContent = (lead.product || 'No Product') + ' • ID: #' + (lead.id || '-');

                // Badges
                var badgesHtml = '';
                // Bucket
                badgesHtml += '<span class="vd-badge vd-badge-bucket"><i class="fas fa-layer-group"></i> ' + bucket + '</span>';
                // Status
                if (status && status !== 'N/A') {
                    badgesHtml += '<span class="vd-badge vd-badge-status"><i class="fas fa-flag"></i> ' + status + '</span>';
                }
                // Sub Status
                if (lead.lead_sub_status) {
                    badgesHtml += '<span class="vd-badge vd-badge-default"><i class="fas fa-code-branch"></i> ' + lead.lead_sub_status + '</span>';
                }
                // Engagement
                var engLower = (engagement || '').toLowerCase();
                var engClass = 'vd-badge-default';
                if (engLower === 'hot') engClass = 'vd-badge-hot';
                else if (engLower === 'warm') engClass = 'vd-badge-warm';
                else if (engLower === 'cold') engClass = 'vd-badge-cold';
                else if (engLower === 'dead') engClass = 'vd-badge-dead';
                badgesHtml += '<span class="vd-badge ' + engClass + '"><i class="fas fa-fire"></i> ' + (engagement || 'N/A') + '</span>';
                // Product
                if (lead.product) {
                    badgesHtml += '<span class="vd-badge vd-badge-product"><i class="fas fa-box"></i> ' + lead.product + '</span>';
                }
                // Priority
                if (lead.lead_priority) {
                    var prioClass = 'vd-badge-default';
                    if (lead.lead_priority.toLowerCase() === 'high') prioClass = 'vd-badge-hot';
                    else if (lead.lead_priority.toLowerCase() === 'medium') prioClass = 'vd-badge-warm';
                    else if (lead.lead_priority.toLowerCase() === 'low') prioClass = 'vd-badge-cold';
                    badgesHtml += '<span class="vd-badge ' + prioClass + '"><i class="fas fa-exclamation-triangle"></i> ' + lead.lead_priority + ' Priority</span>';
                }
                // Verified
                if (lead.verified_lead) {
                    badgesHtml += '<span class="vd-badge" style="background: #e8f5e9; color: #2e7d32;"><i class="fas fa-check-circle"></i> Verified</span>';
                }
                document.getElementById('viewLeadBadges').innerHTML = badgesHtml;

                // Personal Information
                var personalHtml = '';
                personalHtml += fieldHtml('fa-user', 'Full Name', user.name);
                personalHtml += fieldHtml('fa-building', 'Company Name', lead.business_name);
                personalHtml += fieldHtml('fa-id-badge', 'GST Number', lead.gst_number);
                personalHtml += fieldHtml('fa-tags', 'Category', lead.category ? (lead.category.category_name || '') : '');
                personalHtml += fieldHtml('fa-users', 'Employee Strength', lead.employee_strength);
                personalHtml += fieldHtml('fa-industry', 'Industry', lead.industry);
                document.getElementById('viewPersonalInfo').innerHTML = personalHtml;

                // Contact Information
                var contactHtml = '';
                contactHtml += fieldHtml('fa-envelope', 'Email', user.email);
                contactHtml += fieldHtml('fa-phone', 'Mobile No.', user.contact_no);
                contactHtml += fieldHtml('fa-globe', 'Website', lead.website);
                document.getElementById('viewContactInfo').innerHTML = contactHtml;

                // Lead Information
                var leadInfoHtml = '';
                leadInfoHtml += fieldHtml('fa-layer-group', 'Bucket', bucket);
                leadInfoHtml += fieldHtml('fa-flag', 'Status', status);
                leadInfoHtml += fieldHtml('fa-code-branch', 'Sub-Status', lead.lead_sub_status);
                leadInfoHtml += fieldHtml('fa-fire', 'Engagement', engagement);
                leadInfoHtml += fieldHtml('fa-box', 'Product', lead.product);
                leadInfoHtml += fieldHtml('fa-dollar-sign', 'Deal Value', lead.deal_value ? ('₹' + lead.deal_value) : '');
                leadInfoHtml += fieldHtml('fa-bullhorn', 'Source', lead.lead_source);
                leadInfoHtml += fieldHtml('fa-link', 'Sub Source', lead.lead_sub_source);
                leadInfoHtml += fieldHtml('fa-exclamation-triangle', 'Priority', lead.lead_priority);
                // Lead Owner
                var ownerName = (owner && owner.name) ? owner.name : 'Not Assigned';
                leadInfoHtml += fieldHtml('fa-user-tie', 'Lead Owner', ownerName);
                // Services
                if (lead.services) {
                    var servArr = lead.services;
                    if (typeof servArr === 'string') {
                        try { servArr = JSON.parse(servArr); } catch(e) { servArr = [servArr]; }
                    }
                    if (Array.isArray(servArr) && servArr.length > 0) {
                        var servBadgesHtml = servArr.map(function(s) {
                            return '<span class="badge bg-light text-dark border me-1 mb-1" style="font-size:12px;">' + s + '</span>';
                        }).join('');
                        leadInfoHtml += '<div class="col-12"><div class="vd-field-item"><span class="vd-field-label"><i class="fas fa-concierge-bell"></i> Services</span><div class="d-flex flex-wrap mt-1">' + servBadgesHtml + '</div></div></div>';
                    }
                }
                // Created & Updated
                if (lead.created_at) {
                    var createdDate = new Date(lead.created_at);
                    leadInfoHtml += fieldHtml('fa-calendar-plus', 'Created On', createdDate.toLocaleDateString('en-IN', {day:'2-digit',month:'short',year:'numeric'}) + ' ' + createdDate.toLocaleTimeString('en-IN', {hour:'2-digit',minute:'2-digit',hour12:true}));
                }
                if (lead.updated_at) {
                    var updatedDate = new Date(lead.updated_at);
                    leadInfoHtml += fieldHtml('fa-calendar-check', 'Last Modified', updatedDate.toLocaleDateString('en-IN', {day:'2-digit',month:'short',year:'numeric'}) + ' ' + updatedDate.toLocaleTimeString('en-IN', {hour:'2-digit',minute:'2-digit',hour12:true}));
                }
                document.getElementById('viewLeadInfo').innerHTML = leadInfoHtml;

                // Address Details
                var addressHtml = '';
                addressHtml += fieldHtml('fa-map-pin', 'City', lead.city || (user.city || ''));
                addressHtml += fieldHtml('fa-map', 'State', lead.state);
                addressHtml += fieldHtml('fa-hashtag', 'Pincode', lead.pincode);
                addressHtml += fieldHtml('fa-globe-americas', 'Country', lead.applying_country_for_a_visa);
                addressHtml += fieldHtml('fa-map-marker-alt', 'Address', lead.address);
                document.getElementById('viewAddressInfo').innerHTML = addressHtml;

                // Additional Information
                var additionalHtml = '';
                additionalHtml += fieldHtml('fa-money-bill-wave', 'Revenue', lead.revenue);
                additionalHtml += fieldHtml('fa-calendar', 'Followup Date', lead.followup_date ? new Date(lead.followup_date).toLocaleDateString('en-IN', {day:'2-digit',month:'short',year:'numeric'}) : '');
                additionalHtml += fieldHtml('fa-sticky-note', 'Remark', lead.remark);
                document.getElementById('viewAdditionalInfo').innerHTML = additionalHtml;

                // Pain Points
                var painSection = document.getElementById('viewPainPointsSection');
                var painDiv = document.getElementById('viewPainPoints');
                if (lead.pain_points && lead.pain_points.trim()) {
                    painDiv.innerHTML = lead.pain_points;
                    painSection.style.display = 'block';
                } else {
                    painSection.style.display = 'none';
                }

                // Show modal
                var modal = new bootstrap.Modal(document.getElementById('viewLeadDetailsModal'));
                modal.show();
            }
        </script>
    @endpush
@endsection
