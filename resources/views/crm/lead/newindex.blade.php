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

        /* ============================================================ */
        /* PREMIUM PIPELINE (KANBAN) BOARD STYLING (MATCHING REFERENCE UI) */
        /* ============================================================ */
        .lead-pipeline-wrapper { overflow-x: auto; padding-bottom: 16px; scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        .lead-pipeline-board { display: flex; gap: 16px; min-width: max-content; align-items: stretch; padding: 4px 0; }
        
        .pipeline-column { min-width: 285px !important; width: 285px !important; flex: 0 0 285px !important; border-radius: 16px !important; display: flex; flex-direction: column; border: 1px solid rgba(0,0,0,0.05) !important; transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
        .pipeline-column.drag-over { border-color: #006FC9 !important; box-shadow: 0 0 0 3px rgba(0,111,201,.15) !important; }

        /* Column Theme Tints */
        .pipeline-col-theme-blue { background-color: #f0f7ff !important; border-color: #dbeafe !important; }
        .pipeline-col-theme-blue .pipeline-column-header-title { color: #0284c7 !important; }
        .pipeline-col-theme-blue .column-count-badge { background-color: #0284c7 !important; color: #ffffff !important; }

        .pipeline-col-theme-orange { background-color: #fff7ed !important; border-color: #ffedd5 !important; }
        .pipeline-col-theme-orange .pipeline-column-header-title { color: #ea580c !important; }
        .pipeline-col-theme-orange .column-count-badge { background-color: #ea580c !important; color: #ffffff !important; }

        .pipeline-col-theme-purple { background-color: #faf5ff !important; border-color: #f3e8ff !important; }
        .pipeline-col-theme-purple .pipeline-column-header-title { color: #9333ea !important; }
        .pipeline-col-theme-purple .column-count-badge { background-color: #9333ea !important; color: #ffffff !important; }

        .pipeline-col-theme-yellow { background-color: #fefce8 !important; border-color: #fef08a !important; }
        .pipeline-col-theme-yellow .pipeline-column-header-title { color: #d97706 !important; }
        .pipeline-col-theme-yellow .column-count-badge { background-color: #d97706 !important; color: #ffffff !important; }

        .pipeline-col-theme-green { background-color: #f0fdf4 !important; border-color: #dcfce7 !important; }
        .pipeline-col-theme-green .pipeline-column-header-title { color: #16a34a !important; }
        .pipeline-col-theme-green .column-count-badge { background-color: #16a34a !important; color: #ffffff !important; }

        /* Header & Badges */
        .pipeline-column-header { padding: 14px 16px 10px 16px; display: flex; align-items: flex-start; justify-content: space-between; text-decoration: none !important; }
        .pipeline-column-header-title { font-size: 14px; font-weight: 700; line-height: 1.2; margin-bottom: 2px; }
        .pipeline-column-header-subtitle { font-size: 12px; font-weight: 600; color: #64748b; }
        .column-count-badge { font-size: 11.5px; font-weight: 700; width: 24px; height: 24px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }

        /* Cards List Container & Subtle Custom Scrollbar */
        .pipeline-cards-list { padding: 0 12px; min-height: 120px; max-height: calc(100vh - 240px); overflow-y: auto; display: flex; flex-direction: column; gap: 12px; scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        .pipeline-cards-list::-webkit-scrollbar,
        .lead-pipeline-wrapper::-webkit-scrollbar { width: 5px; height: 6px; }
        .pipeline-cards-list::-webkit-scrollbar-track,
        .lead-pipeline-wrapper::-webkit-scrollbar-track { background: transparent; }
        .pipeline-cards-list::-webkit-scrollbar-thumb,
        .lead-pipeline-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .pipeline-cards-list::-webkit-scrollbar-thumb:hover,
        .lead-pipeline-wrapper::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Individual Card Styling (Compact Height) */
        .pipeline-card { background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 12px !important; padding: 9px 12px !important; cursor: grab; user-select: none; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03); transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); margin-bottom: 0 !important; }
        .pipeline-card:hover { border-color: #cbd5e1 !important; box-shadow: 0 5px 14px rgba(0, 0, 0, 0.06) !important; transform: translateY(-1.5px); }
        .pipeline-card:active { cursor: grabbing; }

        /* Card Elements */
        .pipeline-card-avatar { width: 30px; height: 30px; border-radius: 50%; background: #f1f5f9; color: #334155; font-size: 10.5px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #e2e8f0; }
        .pipeline-card-title { font-size: 12.5px; font-weight: 700; color: #0f172a; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .pipeline-card-company { font-size: 10.5px; font-weight: 500; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 1px; }
        .pipeline-card-phone { font-size: 11px; font-weight: 500; color: #475569; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
        .pipeline-card-badges { display: flex; gap: 5px; flex-wrap: wrap; margin-top: 5px; }
        
        .pipeline-pill-badge { font-size: 9.5px; font-weight: 700; padding: 2px 8px; border-radius: 20px; display: inline-flex; align-items: center; }
        .pipeline-pill-saap { background: #e0f2fe; color: #0284c7; }
        .pipeline-pill-saas { background: #f3e8ff; color: #9333ea; }
        .pipeline-pill-new { background: #f1f5f9; color: #475569; }
        .pipeline-pill-hot { background: #ffe4e6; color: #e11d48; }
        .pipeline-pill-warm { background: #fef3c7; color: #d97706; }
        .pipeline-pill-cold { background: #e0f2fe; color: #0284c7; }
        .pipeline-pill-dead { background: #f1f5f9; color: #64748b; }

        /* Compact Dropdown Menu */
        .engagement-dropdown-menu {
            min-width: 75px !important;
            width: max-content !important;
            max-width: 95px !important;
            padding: 2px !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15) !important;
            z-index: 1060 !important;
        }
        .engagement-dropdown-menu .dropdown-item {
            padding: 1.5px 3px !important;
            margin-bottom: 1px;
            border-radius: 5px !important;
        }
        .engagement-dropdown-menu .dropdown-item:last-child {
            margin-bottom: 0;
        }

        .pipeline-card-owner { font-size: 11px; font-weight: 600; color: #334155; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
        .pipeline-card-footer { margin-top: 6px; padding-top: 6px; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; font-size: 10.5px; color: #64748b; }

        /* Column Add Button */
        .pipeline-column-footer { padding: 10px 16px 14px 16px; text-align: center; margin-top: auto; }
        .pipeline-add-btn { font-size: 13px; font-weight: 600; color: #006FC9; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s ease; }
        .pipeline-add-btn:hover { color: #004b87; transform: scale(1.03); }

        .pipeline-empty { min-height: 80px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 1.5px dashed rgba(0,0,0,.12); border-radius: 12px; color: #94a3b8; font-size: 11.5px; background: rgba(255,255,255,0.6); }
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
                @endif
            </div>
            <button type="button" class="lead-tab-arrow next" aria-label="Next statuses" data-status-scroll="next">
                <i class="feather-chevron-right"></i>
            </button>
        </div>

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
        <div class="lead-tab-strip py-2 px-3 border-top border-bottom" style="background: #f8fafc;">
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
                                    <a data-bs-toggle="collapse" href="#details-{{ $lead->id }}" onclick="loadLeadDetailsCollapse({{ $lead->id }})" class="fw-bold text-dark text-decoration-none hover-blue fs-13 text-truncate" style="--hover-color: #006FC9; color: #0f172a !important;" title="{{ $userName }}">
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
                                        <!-- <span>Created <strong>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</strong></span> -->
                                         <span>Created <strong>{{ $lead->created_at ? $lead->created_at->format('d M Y') : 'N/A' }}</strong></span>
                                    </div>
                                </div>

                                {{-- 4. EDIT, (i), HOT / SAAP --}}
                                <div class="d-flex flex-column justify-content-center gap-1 flex-shrink-0" style="width: 72px;">
                                    {{-- Row 1: Edit & Info buttons --}}
                                    <div class="d-flex align-items-center gap-1">
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-primary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="Edit Lead Form" onclick="openEditModalLazy({{ $lead->id }})">
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
                                        <div class="d-flex align-items-center gap-1.5 flex-grow-1 text-truncate" style="cursor:pointer; min-width: 0;" onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 46 }})">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 shadow-2xs" style="width: 28px; height: 28px; background-color: {{ $iconBg }};">
                                                <i class="fas fa-tag fs-11" style="color: {{ $iconColor }};"></i>
                                            </div>
                                            <div class="d-flex flex-column text-truncate" style="min-width: 0;">
                                                <span class="fw-bold fs-11 text-dark text-truncate" style="color: #0f172a !important;">{{ $statusName }}</span>
                                                <span class="fs-9 text-muted" style="font-size: 9px;">Lead Status</span>
                                            </div>
                                        </div>
                                        <div class="ps-0.5 flex-shrink-0">
                                            <button type="button" class="btn btn-xs btn-icon rounded-2 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; background-color: {{ $btnBg }}; color: {{ $btnColor }}; border: 1px solid {{ $borderColor }};" onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 46 }})" title="Edit Status">
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
                                        <a class="open-callback position-absolute" href="javascript:void(0);" onclick="openHistoryOffcanvas({{ $lead->id }})" style="bottom: 4px; right: 5px; font-size: 12px; color: #006FC9;" title="Add/View Comments">
                                            <i class="fas fa-comment-dots"></i>
                                        </a>
                                    @else
                                        <div class="d-flex align-items-center justify-content-between text-muted fs-10 h-100 py-1">
                                            <span>No comments</span>
                                            <a class="open-callback" href="javascript:void(0);" onclick="openHistoryOffcanvas({{ $lead->id }})" style="font-size: 12px; color: #006FC9;" title="Add Comment">
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
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-primary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="View Details" onclick="openViewDetailsModalLazy({{ $lead->id }})">
                                            <i class="fas fa-eye fs-10"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light text-secondary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" onclick="openEditModalLazy({{ $lead->id }})" title="Edit Lead">
                                            <i class="fas fa-edit fs-10"></i>
                                        </a>
                                        <a data-bs-toggle="collapse" href="#details-{{ $lead->id }}" onclick="loadLeadDetailsCollapse({{ $lead->id }})" class="btn btn-xs btn-icon btn-light text-muted border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" title="Expand Details">
                                            <i class="fas fa-chevron-down fs-10"></i>
                                        </a>
                                    </div>
                                    {{-- Row 2: Convert Button, Send Email & Dropdown --}}
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button" class="btn btn-xs btn-icon rounded-2 border shadow-2xs d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; background-color: #dcfce7; color: #16a34a; border-color: #86efac !important;" onclick="convertLeads([{{ $lead->id }}]); return false;" title="Convert Lead to Order">
                                            <i class="fas fa-arrows-rotate fs-10"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-icon btn-light text-primary border shadow-2xs rounded-2 d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;" onclick="openSendEmailModal({{ $lead->id }}, '{{ e(optional($lead->user)->name ?? '') }}', '{{ e(optional($lead->user)->email ?? '') }}')" title="Send Email">
                                            <i class="fas fa-paper-plane fs-10"></i>
                                        </button>
                                        <div class="dropdown">
                                            <a class="btn btn-xs btn-icon btn-light text-dark border shadow-2xs rounded-2 d-flex align-items-center justify-content-center dropdown-toggle" style="width: 25px; height: 25px;" href="#" role="button" id="moreOptions{{ $lead->id }}" data-bs-toggle="dropdown" aria-expanded="false" title="More Options">
                                                <i class="fas fa-ellipsis-v fs-10"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="moreOptions{{ $lead->id }}">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-primary fw-bold" href="javascript:void(0);" onclick="openSendEmailModal({{ $lead->id }}, '{{ e(optional($lead->user)->name ?? '') }}', '{{ e(optional($lead->user)->email ?? '') }}')">
                                                        <i class="fas fa-paper-plane me-2 text-primary" style="width: 20px;"></i>
                                                        Send Email
                                                    </a>
                                                </li>
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
                                                        onclick="openWhatsAppOffcanvas({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'User') }}', '{{ optional($lead->user)->contact_no ?? '-' }}', '{{ asset($lead->user?->image ? 'storage/' . $lead->user->image : 'images/blank.jpeg') }}')">
                                                        <i class="fab fa-whatsapp me-2" style="color: #006FC9; width: 20px;"></i>WhatsApp
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center text-muted" style="color: #006FC9;"
                                                        onclick="openSMSOffcanvas({{ $lead->id }}, '{{ addslashes(optional($lead->user)->name ?? 'User') }}', '{{ optional($lead->user)->contact_no ?? '' }}')">
                                                        <i class="fa-solid fa-message me-2" style="color: #006FC9; width: 20px;"></i>SMS
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Dynamic Lazy-Loaded Details Collapse --}}
                        <div class="collapse w-100" id="details-{{ $lead->id }}">
                            <div class="lead-details-pane border-top p-4 bg-white" style="border-left: 4px solid #006FC9; border-bottom-left-radius: 0.375rem; border-bottom-right-radius: 0.375rem;">
                                <div class="lead-details-content" id="details-content-{{ $lead->id }}">
                                    <div class="text-center py-4">
                                        <div class="spinner-border text-primary spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="text-muted small mt-2">Loading lead details...</p>
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
        <div class="lead-pipeline-wrapper">
            <div class="lead-pipeline-board">
            @php
                $childStatusNames = $childBuckets->pluck('name')->toArray();
                $existingStatusesInLeads = $pipelineLeads->pluck('lead_status')->map(fn($s) => $s ?: 'Yet to Call')->unique()->toArray();
                $pipelineStatuses = array_values(array_unique(array_merge($childStatusNames, $existingStatusesInLeads)));
                if (empty($pipelineStatuses)) {
                    $pipelineStatuses = ['Yet to Call', 'Qualifying', 'Proposal Sent', 'Negotiation', 'Awaiting Confirmation', 'Converted', 'Lost'];
                }
                $leadsByStatus = $pipelineLeads->groupBy(function($l) {
                    return $l->lead_status ?: 'Yet to Call';
                });
            @endphp

            @foreach($pipelineStatuses as $index => $statusName)
                @php
                    $statusLeads = $leadsByStatus->get($statusName, collect());
                    $colTheme = match(true) {
                        str_contains(strtolower($statusName), 'yet to call') || str_contains(strtolower($statusName), 'new') => 'pipeline-col-theme-blue',
                        str_contains(strtolower($statusName), 'qualifying') || str_contains(strtolower($statusName), 'contacted') => 'pipeline-col-theme-orange',
                        str_contains(strtolower($statusName), 'proposal') || str_contains(strtolower($statusName), 'sent') => 'pipeline-col-theme-purple',
                        str_contains(strtolower($statusName), 'negotiation') || str_contains(strtolower($statusName), 'follow') => 'pipeline-col-theme-yellow',
                        str_contains(strtolower($statusName), 'awaiting') || str_contains(strtolower($statusName), 'converted') || str_contains(strtolower($statusName), 'won') || str_contains(strtolower($statusName), 'start') => 'pipeline-col-theme-green',
                        default => match($index % 5) {
                            0 => 'pipeline-col-theme-blue',
                            1 => 'pipeline-col-theme-orange',
                            2 => 'pipeline-col-theme-purple',
                            3 => 'pipeline-col-theme-yellow',
                            default => 'pipeline-col-theme-green',
                        }
                    };

                    $totalVal = ($statusLeads->count() ?: 1) * 1.5;
                    $valFormatted = '₹ ' . number_format($totalVal, 1) . 'M';
                @endphp

                <div class="pipeline-column {{ $colTheme }}">
                    {{-- Column Header --}}
                    <div class="pipeline-column-header">
                        <div>
                            <div class="pipeline-column-header-title" title="{{ $statusName }}">{{ $statusName }}</div>
                            <div class="pipeline-column-header-subtitle">Lead</div>
                        </div>
                        <span class="column-count-badge">
                            {{ $statusLeads->count() }}
                        </span>
                    </div>

                    {{-- Cards List --}}
                    <div class="pipeline-cards-list" data-status-name="{{ $statusName }}">
                        @forelse($statusLeads as $lead)
                            @php
                                $nameStr = trim(optional($lead->user)->name ?? 'Unknown');
                                $nameParts = explode(' ', $nameStr);
                                $initials = strtoupper(substr($nameParts[0] ?? 'U', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
                                $eng = strtolower(trim($lead->lead_engagement_status ?? 'new'));
                                $engPillClass = match($eng) {
                                    'hot' => 'pipeline-pill-hot',
                                    'warm' => 'pipeline-pill-warm',
                                    'cold' => 'pipeline-pill-cold',
                                    'dead' => 'pipeline-pill-dead',
                                    default => 'pipeline-pill-new',
                                };
                                $rawPrio = $lead->lead_priority ?: $lead->priority;
                                $prio = strtolower(trim($rawPrio ?? ''));
                                $priorityFlag = match($prio) {
                                    'high' => ['class' => 'text-danger', 'label' => 'High'],
                                    'low' => ['class' => 'text-success', 'label' => 'Low'],
                                    'medium' => ['class' => 'text-warning', 'label' => 'Medium'],
                                    default => null,
                                };
                            @endphp
                            <div class="pipeline-card"
                                id="pipeline-card-{{ $lead->id }}"
                                data-lead-id="{{ $lead->id }}">
                                
                                {{-- Header Row: Avatar + Name & Company + Quick Action Icons --}}
                                <div class="d-flex align-items-start justify-content-between gap-2">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                                        <div class="pipeline-card-avatar">{{ $initials ?: 'LD' }}</div>
                                        <div class="overflow-hidden">
                                            <div class="pipeline-card-title" title="{{ $nameStr }}">{{ $nameStr }}</div>
                                            @php
                                                $compName = $lead->business_name ?: optional($lead->user)->company_name;
                                            @endphp
                                            @if($compName)
                                                <div class="pipeline-card-company" title="{{ $compName }}">{{ $compName }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0 text-muted">
                                        {{-- 1. Comment History Button (Message icon) --}}
                                        <a href="javascript:void(0);" class="text-secondary text-hover-primary open-callback" style="font-size: 10.5px;" title="Comment History" onclick="openHistoryOffcanvas({{ $lead->id }})">
                                            <i class="far fa-comment-alt"></i>
                                        </a>

                                        {{-- 2. Add Comment / Edit Followup Button --}}
                                        <a href="javascript:void(0);" class="text-secondary text-hover-primary" style="font-size: 10.5px;" title="Add Comment / Edit Followup" onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($statusName) }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 46 }})">
                                            <i class="fas fa-plus-circle text-primary"></i>
                                        </a>

                                        @php
                                            $optLead = [
                                                'id' => $lead->id,
                                                'lead_bucket_id' => $lead->lead_bucket_id,
                                                'lead_status' => $lead->lead_status,
                                                'lead_engagement_status' => $lead->lead_engagement_status,
                                                'product' => $lead->product,
                                                'lead_owner' => $lead->lead_owner,
                                                'lead_source' => $lead->lead_source,
                                                'lead_priority' => $lead->lead_priority,
                                                'business_name' => $lead->business_name,
                                                'description' => $lead->description,
                                                'deal_value' => $lead->deal_value,
                                            ];
                                            $optUser = [
                                                'id' => optional($lead->user)->id,
                                                'name' => optional($lead->user)->name,
                                                'email' => optional($lead->user)->email,
                                                'contact_no' => optional($lead->user)->contact_no,
                                                'country_code' => optional($lead->user)->country_code,
                                                'company_name' => optional($lead->user)->company_name,
                                            ];
                                        @endphp
                                        <a href="javascript:void(0);" class="text-secondary text-hover-primary" style="font-size: 10.5px;" title="Edit Lead Form"
                                            data-lead="{{ json_encode($optLead) }}" data-user="{{ json_encode($optUser) }}"
                                            onclick="openEditModal(this)"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>

                                {{-- Phone Row --}}
                                <div class="pipeline-card-phone">
                                    <i class="fas fa-phone-alt fs-11 text-muted"></i>
                                    <span>{{ optional($lead->user)->contact_no ?? 'N/A' }}</span>
                                </div>

                                {{-- Badges Row --}}
                                <div class="pipeline-card-badges">
                                    @if($lead->product)
                                        <span class="pipeline-pill-badge pipeline-pill-saap">{{ strtoupper($lead->product) }}</span>
                                    @else
                                        <span class="pipeline-pill-badge pipeline-pill-saap">SAAP</span>
                                    @endif
                                    {{-- Interactive Engagement Status Dropdown --}}
                                    <div class="dropdown d-inline-block" onclick="event.stopPropagation();">
                                        <a href="javascript:void(0);" 
                                           class="pipeline-pill-badge {{ $engPillClass }} dropdown-toggle text-decoration-none" 
                                           data-bs-toggle="dropdown" 
                                           aria-expanded="false"
                                           title="Click to change Engagement Status">
                                            <span>{{ ucfirst($eng ?: 'New') }}</span>
                                        </a>
                                        <ul class="dropdown-menu engagement-dropdown-menu shadow-sm border-0">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'new', this)">
                                                    <span class="pipeline-pill-badge pipeline-pill-new">New</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'hot', this)">
                                                    <span class="pipeline-pill-badge pipeline-pill-hot">Hot</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'warm', this)">
                                                    <span class="pipeline-pill-badge pipeline-pill-warm">Warm</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'cold', this)">
                                                    <span class="pipeline-pill-badge pipeline-pill-cold">Cold</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="updateLeadEngagement({{ $lead->id }}, 'dead', this)">
                                                    <span class="pipeline-pill-badge pipeline-pill-dead">Dead</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Owner Row --}}
                                <div class="pipeline-card-owner">
                                    @php
                                        $oImg = optional($lead->owner)->profile_image ?: optional($lead->owner)->image;
                                    @endphp
                                    @if($oImg)
                                        <img src="{{ asset($oImg) }}" class="rounded-circle me-1" width="18" height="18" style="object-fit:cover;" alt="Owner">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center fw-bold me-1" style="width:18px;height:18px;font-size:9px;">
                                            {{ strtoupper(substr(optional($lead->owner)->name ?? 'A', 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ optional($lead->owner)->name ?? 'Ayush Pariyani' }}</span>
                                </div>

                                {{-- Footer Row: Created Date + Priority Flag --}}
                                <div class="pipeline-card-footer">
                                    <div>
                                        <i class="far fa-calendar me-1"></i>
                                        <span>{{ optional($lead->created_at)->format('d M Y, h:i A') }}</span>
                                    </div>
                                    @if($priorityFlag)
                                        <div class="fw-semibold {{ $priorityFlag['class'] }}">
                                            <i class="fas fa-flag me-1"></i>{{ $priorityFlag['label'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="pipeline-empty empty-column-msg">
                                <i class="fas fa-layer-group mb-1 fs-5"></i>
                                <span>No leads in this status</span>
                            </div>
                        @endforelse
                    </div>

                    {{-- Column Bottom Add Lead Button --}}
                    <div class="pipeline-column-footer">
                        <a href="javascript:void(0);" onclick="openCreateModal()" class="pipeline-add-btn">
                            <i class="fas fa-plus fs-12"></i> Add Lead
                        </a>
                    </div>
                </div>
            @endforeach
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
                    animation: 200,
                    ghostClass: 'bg-soft-primary',
                    chosenClass: 'shadow-lg',
                    dragClass: 'sortable-drag',
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    emptyInsertThreshold: 10,
                    filter: '.empty-column-msg, a, button, input, select, textarea, .dropdown-menu, .open-callback',
                    preventOnFilter: false,
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
                        fetch(`{{ url('/modern-leads/drag-update') }}/${leadId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                lead_status: newStatus
                            })
                        })
                        .then(async res => {
                            const contentType = res.headers.get('content-type') || '';
                            if (!contentType.includes('application/json')) {
                                throw new Error('Server error during drag update. Please try again.');
                            }
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

                    <!-- Section: Email History -->
                    <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-3 d-flex align-items-center justify-content-between" style="color: #006FC9; font-size: 14px;">
                                <span><i class="fas fa-history me-2"></i> Email History</span>
                                <button type="button" class="btn btn-xs btn-outline-primary rounded-pill px-2 py-1" id="triggerSendEmailFromViewBtn">
                                    <i class="fas fa-paper-plane me-1"></i> Send Email
                                </button>
                            </h6>
                            <div id="viewEmailHistoryContent" class="table-responsive">
                                <div class="text-center text-muted py-3 fs-12"><i class="fas fa-spinner fa-spin me-2"></i> Loading email history...</div>
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

    <!-- DYNAMIC SEND EMAIL MODAL -->
    <div class="modal fade" id="dynamicSendEmailModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-0 px-4 py-3" style="background: linear-gradient(135deg, #006FC9, #0056a3);">
                    <div class="d-flex align-items-center gap-3 text-white">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 40px; height: 40px;">
                            <i class="fas fa-paper-plane" style="font-size: 16px;"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0" id="sendEmailModalTitle">Send Email to Lead</h5>
                            <small class="text-white opacity-75" id="sendEmailRecipientText">Recipient Email</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4" style="background: #f8fafc; max-height: 75vh; overflow-y: auto;">
                    <input type="hidden" id="sendEmailLeadId" value="">
                    
                    <div id="sendEmailAlert" class="alert d-none mb-3" role="alert"></div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark fs-13">Select Email Template <span class="text-danger">*</span></label>
                        <select id="sendEmailTemplateSelect" class="form-select border-primary-subtle shadow-2xs" onchange="onTemplateSelected()">
                            <option value="">-- Choose Active Template --</option>
                        </select>
                    </div>

                    <!-- Preview Container -->
                    <div id="sendEmailPreviewCard" class="card border shadow-2xs d-none" style="border-radius: 12px; background: #ffffff;">
                        <div class="card-header bg-light border-bottom px-3 py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-bold text-primary fs-12"><i class="fas fa-eye me-1"></i> Generated Email Preview</span>
                                <span class="badge bg-soft-success text-success fs-11" id="previewToBadge"></span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="mb-3">
                                <label class="fw-semibold text-muted fs-11 text-uppercase mb-1">To Email (Editable):</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light text-muted"><i class="fas fa-envelope fs-11"></i></span>
                                    <input type="email" id="customToEmailInput" class="form-control border-primary-subtle fw-bold text-dark fs-13" placeholder="Enter recipient email address..." oninput="updatePreviewToBadge(this.value)">
                                </div>
                                <small class="text-muted fs-11 mt-1 d-block"><i class="fas fa-info-circle me-1 text-primary"></i> You can edit this email address if the lead's email was incorrect.</small>
                            </div>
                            <div class="mb-3">
                                <label class="fw-semibold text-muted fs-11 text-uppercase mb-1">Subject Line:</label>
                                <div class="fw-bold text-dark fs-14 p-2 bg-light rounded border" id="previewSubjectText"></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-semibold text-muted fs-11 text-uppercase mb-1">Email Body:</label>
                                <div class="p-3 bg-white rounded border shadow-2xs overflow-auto fs-13" style="min-height: 180px; max-height: 350px; line-height: 1.6;" id="previewBodyText"></div>
                            </div>
                            <div class="pt-2 border-top">
                                <label class="fw-semibold text-dark fs-12 mb-1 d-flex align-items-center gap-1">
                                    <i class="fas fa-paperclip text-primary"></i> Attach File / Image (Optional, Max 10MB)
                                </label>
                                <input type="file" id="emailAttachmentInput" class="form-control form-control-sm border-primary-subtle fs-12" accept="image/*,.pdf,.doc,.docx" onchange="onAttachmentFileSelected(this)">
                                <div id="attachmentFilePreview" class="d-none mt-2 p-2 bg-light rounded border d-flex align-items-center justify-content-between">
                                    <span class="fs-12 text-dark fw-semibold" id="attachmentFileName"></span>
                                    <button type="button" class="btn btn-xs text-danger p-0 border-0 ms-2" onclick="removeAttachmentFile()"><i class="fas fa-times-circle me-1"></i> Remove File</button>
                                </div>
                                <small class="text-muted fs-11 mt-1 d-block"><i class="fas fa-info-circle me-1 text-primary"></i> Attached files (PDF/Image) will be sent directly with email without being saved to database.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top bg-white px-4 py-3">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary px-4 d-flex align-items-center gap-2" id="confirmSendEmailBtn" onclick="submitSendEmail()" disabled>
                        <i class="fas fa-paper-plane"></i>
                        <span>Send Email</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW SENT EMAIL LOG MODAL -->
    <div class="modal fade" id="viewSentEmailLogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header bg-dark text-white border-0 px-4 py-3">
                    <h5 class="modal-title fw-bold text-white mb-0" id="viewLogModalTitle">Sent Email Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="fw-bold text-muted fs-11 text-uppercase">Recipient & Date</label>
                            <span id="viewLogStatusBadge" class="badge"></span>
                        </div>
                        <div class="fw-semibold text-dark fs-13" id="viewLogRecipient"></div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted fs-11 text-uppercase">Subject</label>
                        <div class="fw-bold text-dark p-2 bg-light rounded border fs-14" id="viewLogSubject"></div>
                    </div>
                    <div>
                        <label class="fw-bold text-muted fs-11 text-uppercase">Email Content Sent</label>
                        <div class="p-3 bg-white rounded border shadow-2xs overflow-auto" style="min-height: 180px; max-height: 350px;" id="viewLogBody"></div>
                    </div>
                    <div id="viewLogErrorSection" class="mt-3 d-none">
                        <label class="fw-bold text-danger fs-11 text-uppercase">Error Details</label>
                        <div class="p-2 bg-soft-danger text-danger rounded border border-danger fs-12 font-monospace" id="viewLogErrorMessage"></div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light px-4 py-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
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
                            let defaultSelectVal = pendingSubStatus;
                            if (!defaultSelectVal) {
                                let foundYetToCall = children.find(c => c.name && c.name.toLowerCase().includes('yet to call'));
                                if (foundYetToCall) {
                                    defaultSelectVal = foundYetToCall.name;
                                }
                            }

                            children.forEach(function (child) {
                                let isSelected = (defaultSelectVal && (child.name.toLowerCase() === defaultSelectVal.toLowerCase() || child.id == defaultSelectVal)) ? 'selected' : '';
                                statusSelect.append(
                                    `<option value="${child.name}" data-bg="${child.color || ''}" ${isSelected}>
                                        ${child.name}
                                    </option>`
                                );
                            });

                            if (defaultSelectVal) {
                                statusSelect.val(defaultSelectVal);
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
                        '<span class="vd-field-value text-break text-wrap" style="word-break: break-word; white-space: normal;">' + v + '</span>' +
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
                leadInfoHtml += fieldHtml('fa-bullhorn', 'Source', lead.lead_source || lead.platform);
                leadInfoHtml += fieldHtml('fa-link', 'Sub Source', lead.lead_sub_source);
                leadInfoHtml += fieldHtml('fa-bullseye', 'Campaign Name', lead.campaign_name);
                leadInfoHtml += fieldHtml('fa-layer-group', 'Ad Set Name', lead.adset_name);
                leadInfoHtml += fieldHtml('fa-ad', 'Ad Name', lead.ad_name);
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

                // Render Dynamic Custom Attributes
                var customAttrs = lead.custom_attributes;
                if (typeof customAttrs === 'string') {
                    try { customAttrs = JSON.parse(customAttrs); } catch(e) { customAttrs = null; }
                }
                if (customAttrs && typeof customAttrs === 'object' && Object.keys(customAttrs).length > 0) {
                    Object.keys(customAttrs).forEach(function(key) {
                        if (customAttrs[key] !== null && customAttrs[key] !== undefined && customAttrs[key] !== '') {
                            var formattedKey = key.replace(/_/g, ' ').replace(/\b\w/g, function(l){ return l.toUpperCase(); });
                            additionalHtml += fieldHtml('fa-sliders-h', formattedKey, customAttrs[key]);
                        }
                    });
                }

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

                // Bind Email Send Trigger & Load Email History
                var triggerBtn = document.getElementById('triggerSendEmailFromViewBtn');
                if (triggerBtn) {
                    triggerBtn.onclick = function() {
                        openSendEmailModal(lead.id, user.name, user.email);
                    };
                }
                if (lead.id) {
                    loadLeadEmailHistory(lead.id);
                }

                // Show modal
                var modal = new bootstrap.Modal(document.getElementById('viewLeadDetailsModal'));
                modal.show();
            }

            function updateLeadEngagement(leadId, status, el) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch(`/lead/${leadId}/engagement-status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ lead_engagement_status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: 'Engagement status updated successfully.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        setTimeout(function() { location.reload(); }, 500);
                    } else {
                        alert(data.message || 'Could not update status');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Failed to update engagement status');
                });
            }

            function openEditModalLazy(leadId) {
                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.lead) {
                            let dummyEl = document.createElement('div');
                            dummyEl.setAttribute('data-lead', JSON.stringify(data.lead));
                            dummyEl.setAttribute('data-user', JSON.stringify(data.user || {}));
                            openEditModal(dummyEl);
                        }
                    });
            }

            function openViewDetailsModalLazy(leadId) {
                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.lead) {
                            let lead = data.lead;
                            let user = data.user || {};
                            let owner = lead.owner || {};
                            let dummyEl = document.createElement('div');
                            dummyEl.setAttribute('data-lead', JSON.stringify(lead));
                            dummyEl.setAttribute('data-user', JSON.stringify(user));
                            dummyEl.setAttribute('data-owner', JSON.stringify(owner));
                            dummyEl.setAttribute('data-bucket', (lead.bucket && lead.bucket.name) ? lead.bucket.name : 'N/A');
                            dummyEl.setAttribute('data-status', lead.lead_status || 'N/A');
                            dummyEl.setAttribute('data-engagement', lead.lead_engagement_status || 'N/A');
                            openViewDetailsModal(dummyEl);
                        }
                    });
            }

            // Global Status Hierarchy Mapping for Offcanvas
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

            // Global Lazy Loading & Offcanvas Helpers
            function openEditStatusOffcanvas(leadId, leadStatus, engagementStatus, bucketId) {
                let offcanvasEl = document.getElementById('editStatusOffcanvas');
                let form = document.getElementById('sharedQuickUpdateForm');
                form.action = "{{ url('/modern-leads/quick-update') }}/" + leadId;
                
                let engSelect = form.querySelector('[name="lead_engagement_status"]');
                if (engSelect) engSelect.value = (engagementStatus || '').toLowerCase();
                
                let mainSelect = document.getElementById('editStatusMainSelect');
                let subSelect = document.getElementById('editStatusSubSelect');

                // Determine matched main status and child sub status
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

                // Form submit handler to set final lead_status and lead_bucket_id
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

                let attachContainer = document.getElementById('sharedExistingAttachments');
                if (attachContainer) attachContainer.innerHTML = '';

                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('sharedEditStatusLeadName').textContent = data.user?.name || 'User';
                            if (data.messages && data.messages.length > 0) {
                                let lastMsg = data.messages[0];
                                if (lastMsg.followup_documents && lastMsg.followup_documents.length > 0) {
                                    let html = '<span class="fs-10 text-muted fw-semibold uppercase">Existing Attachments:</span>';
                                    lastMsg.followup_documents.forEach(doc => {
                                        let path = typeof doc === 'object' ? doc.path : doc;
                                        let name = typeof doc === 'object' ? doc.name : path.split('/').pop();
                                        let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(path);
                                        let downloadUrl = "{{ route('document.download') }}?path=" + encodeURIComponent(path) + "&name=" + encodeURIComponent(name);
                                        html += `<div class="p-2 border rounded-2 bg-light d-flex align-items-center justify-content-between shadow-2xs mt-1" style="font-size: 11px;">
                                            <span class="text-truncate me-2 fw-medium text-dark"><i class="far fa-file-alt text-primary me-1"></i>${name}</span>
                                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                <a href="${viewUrl}" target="_blank" class="btn btn-xs btn-light text-info p-1 px-2 rounded border text-decoration-none">View</a>
                                                <a href="${downloadUrl}" class="btn btn-xs btn-light text-primary p-1 px-2 rounded border text-decoration-none">Download</a>
                                            </div>
                                        </div>`;
                                    });
                                    if (attachContainer) attachContainer.innerHTML = html;
                                }
                            }
                        }
                    });

                let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                bsOffcanvas.show();
            }

            function openHistoryOffcanvas(leadId) {
                let offcanvasEl = document.getElementById('proposalSentOffcanvas');
                let titleName = document.getElementById('sharedHistoryLeadName');
                let body = document.getElementById('sharedHistoryBody');
                
                titleName.textContent = 'Loading...';
                body.innerHTML = `<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>`;
                
                let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                bsOffcanvas.show();

                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            titleName.textContent = data.user?.name || 'User';
                            let lead = data.lead || {};
                            let currentBucket = (lead.bucket && lead.bucket.name) ? lead.bucket.name : 'N/A';
                            let currentStatus = lead.lead_status || 'N/A';

                            if (!data.messages || data.messages.length === 0) {
                                body.innerHTML = `
                                    <div class="card border-0 shadow-2xs rounded-3 mb-3 bg-white">
                                        <div class="card-body p-3">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-1">Current Active Stage</span>
                                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                                <span class="badge bg-primary-subtle text-primary border px-2.5 py-1 fs-12 fw-bold"><i class="fas fa-layer-group me-1"></i> ${currentBucket}</span>
                                                <span class="badge bg-success-subtle text-success border px-2.5 py-1 fs-12 fw-bold"><i class="fas fa-flag me-1"></i> ${currentStatus}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center py-5 bg-white rounded-3 border">
                                        <i class="fa-regular fa-folder-open text-muted fs-1 mb-2 opacity-50"></i>
                                        <p class="text-muted fs-13 mb-0">No history activity logged yet.</p>
                                    </div>`;
                                return;
                            }

                            let html = `
                            <!-- Top Lead Stage Overview Card -->
                            <div class="card border-0 shadow-2xs rounded-3 mb-3 bg-white">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fs-11 text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Current Stage Tracking</span>
                                        <span class="badge bg-light text-secondary border fs-10 px-2 py-0.5">${data.messages.length} Logs</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span class="badge bg-primary-subtle text-primary border px-2.5 py-1 fs-12 fw-bold"><i class="fas fa-layer-group me-1"></i> Bucket: ${currentBucket}</span>
                                        <span class="badge bg-success-subtle text-success border px-2.5 py-1 fs-12 fw-bold"><i class="fas fa-flag me-1"></i> Status: ${currentStatus}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- History Stage Tracking Timeline -->
                            <div class="history-timeline-container position-relative ms-2 ps-3" style="border-left: 2px dashed #cbd5e1;">`;

                            data.messages.forEach(msg => {
                                let isDone = msg.is_done == 1;
                                let dotColor = isDone ? '#10b981' : (msg.next_followup_date ? '#006FC9' : '#64748b');

                                html += `
                                <div class="history-item position-relative mb-3.5">
                                    <!-- Timeline Dot Node -->
                                    <div class="position-absolute rounded-circle bg-white shadow-2xs d-flex align-items-center justify-content-center"
                                         style="left: -22px; top: 12px; width: 18px; height: 18px; border: 3px solid ${dotColor}; z-index: 2;">
                                        <div class="rounded-circle" style="width: 5px; height: 5px; background-color: ${dotColor};"></div>
                                    </div>

                                    <!-- Card Box -->
                                    <div class="card border shadow-2xs rounded-3 bg-white">
                                        <div class="card-body p-3">
                                            <!-- Status & Sub Status Stage Tracking Pill Bar -->
                                            ${(msg.bucket || msg.status) ? `
                                                <div class="p-2 bg-light rounded-2 border d-flex align-items-center gap-2 mb-2 flex-wrap fs-11">
                                                    <i class="fas fa-code-branch text-primary fs-12"></i>
                                                    <span class="fw-bold text-dark">Stage Track:</span>
                                                    ${msg.bucket ? `<span class="badge bg-white text-dark border fw-medium px-2 py-0.5"><i class="fas fa-layer-group text-primary me-1"></i> ${msg.bucket}</span>` : ''}
                                                    ${(msg.bucket && msg.status) ? `<i class="fas fa-chevron-right text-muted fs-10"></i>` : ''}
                                                    ${msg.status ? `<span class="badge bg-white text-dark border fw-medium px-2 py-0.5"><i class="fas fa-flag text-success me-1"></i> ${msg.status}</span>` : ''}
                                                </div>
                                            ` : ''}

                                            <!-- Message Remark Body -->
                                            ${msg.message ? `
                                                <p class="text-dark mb-2 fs-13" style="line-height: 1.5; word-wrap: break-word;">${msg.message}</p>
                                            ` : ''}

                                            <!-- Next Followup Scheduled -->
                                            ${msg.next_followup_date ? `
                                                <div class="p-2 px-2.5 rounded-2 d-inline-flex align-items-center gap-2 mb-2" style="background-color: #eff6ff; border-left: 3px solid #006FC9; font-size: 12px;">
                                                    <i class="far fa-calendar-check text-primary"></i>
                                                    <span class="text-primary fw-semibold">Follow-up: <strong>${msg.next_followup_date}</strong></span>
                                                </div>
                                            ` : ''}

                                            <!-- Call Recording Player -->
                                            ${msg.call_recording ? `
                                                <div class="p-2 rounded-2 bg-light border d-flex align-items-center gap-2 mt-2 mb-2">
                                                    <i class="fas fa-volume-high text-success fs-13"></i>
                                                    <audio controls style="width:100%; height:28px;">
                                                        <source src="${msg.call_recording}" type="audio/mpeg">
                                                    </audio>
                                                </div>
                                            ` : ''}

                                            <!-- Attached Followup Documents -->
                                            ${msg.followup_documents && msg.followup_documents.length > 0 ? `
                                                <div class="d-flex align-items-center gap-1.5 flex-wrap mt-2 pt-2 border-top">
                                                    <small class="text-muted fw-bold fs-10">FILES:</small>
                                                    ${msg.followup_documents.map(doc => {
                                                        let docPath = typeof doc === 'object' ? doc.path : doc;
                                                        let docName = typeof doc === 'object' ? doc.name : docPath.split('/').pop();
                                                        let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(docPath);
                                                        return `<a href="${viewUrl}" target="_blank" class="badge bg-light text-dark border p-1 rounded d-inline-flex align-items-center gap-1 text-decoration-none fs-10">
                                                            <i class="fas fa-paperclip text-primary"></i> ${docName}
                                                        </a>`;
                                                    }).join('')}
                                                </div>
                                            ` : ''}

                                            <!-- Footer: User Avatar, Name & Timestamp -->
                                            <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top fs-11">
                                                <div class="d-flex align-items-center gap-1.5 fw-bold text-dark">
                                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; font-size: 10px;">
                                                        ${(msg.user_name || 'U').charAt(0).toUpperCase()}
                                                    </div>
                                                    <span>${msg.user_name || 'User'}</span>
                                                </div>
                                                <div class="text-muted d-flex align-items-center gap-1">
                                                    <i class="far fa-clock"></i> ${msg.created_at_formatted || 'N/A'}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });

                            html += `</div>`;
                            body.innerHTML = html;
                        }
                    });
            }

            function openWhatsAppOffcanvas(leadId, name, phone, image) {
                let offcanvasEl = document.getElementById('whatsappSentOffcanvas');
                document.getElementById('sharedWhatsAppName').textContent = name;
                document.getElementById('sharedWhatsAppPhone').textContent = phone;
                document.getElementById('sharedWhatsAppImg').src = image;
                let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                bsOffcanvas.show();
            }

            function openSMSOffcanvas(leadId, name, phone) {
                let offcanvasEl = document.getElementById('SMSSentOffcanvas');
                document.getElementById('sharedSMSName').textContent = name;
                let numInput = document.getElementById('sharedSMSMobileNum');
                if (numInput) numInput.value = phone;
                let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                bsOffcanvas.show();
            }

            function openTodoOffcanvas(leadId) {
                let offcanvasEl = document.getElementById('todoOffcanvas');
                let form = document.getElementById('sharedTodoForm');
                form.action = "{{ url('/modern-leads/todo') }}/" + leadId;
                let tasksContainer = document.getElementById('sharedTodoTasksContainer');
                tasksContainer.innerHTML = `<div class="text-center py-4"><div class="spinner-border text-primary spinner-border-sm" role="status"></div></div>`;
                
                let bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                bsOffcanvas.show();

                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            if (!data.todoTasks || data.todoTasks.length === 0) {
                                tasksContainer.innerHTML = `<div class="text-center py-4"><p class="text-muted small">No To-Do tasks found for this lead.</p></div>`;
                                return;
                            }
                            let html = '';
                            data.todoTasks.forEach(task => {
                                html += `<div class="card mb-3 shadow-none" style="border: 1px dashed #cbd5e1; border-radius: 8px;">
                                    <div class="card-body p-3 d-flex align-items-center">
                                        <div class="rounded text-center p-2 me-3 d-flex flex-column justify-content-center" style="background-color: #e6f0ff; color: #006FC9; min-width: 55px; height: 55px;">
                                            <span class="fw-bold" style="font-size: 18px; line-height: 1;">${task.due_day}</span>
                                            <span class="fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">${task.due_month}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-1 gap-2">
                                                <span class="fw-bold text-dark" style="font-size: 14px;">${task.summary || 'To-Do Task'}</span>
                                                <span class="badge" style="background-color: #e6f0ff; color: #006FC9; font-size: 10px;">${task.status}</span>
                                            </div>
                                            <div class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">${task.assignee_name}</div>
                                            <div class="text-muted" style="font-size: 11px;">${task.due_time}</div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            tasksContainer.innerHTML = html;
                        }
                    });
            }

            function loadLeadDetailsCollapse(leadId) {
                let container = document.getElementById('details-content-' + leadId);
                if (!container || container.getAttribute('data-loaded') === 'true') return;

                fetch("{{ url('/modern-leads') }}/" + leadId + "/details-data")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            container.setAttribute('data-loaded', 'true');
                            renderLeadDetailsTabs(container, data.lead, data.user, data.messages);
                        }
                    });
            }

            function renderLeadDetailsTabs(container, lead, user, messages) {
                let leadId = lead.id;
                let userName = user ? (user.name || 'N/A') : 'N/A';
                let userEmail = user ? (user.email || 'N/A') : 'N/A';
                let userPhone = user ? (user.contact_no || 'N/A') : 'N/A';

                let categoryName = lead.category ? (lead.category.category_name || 'N/A') : 'N/A';
                let country = lead.applying_country_for_a_visa || 'N/A';
                let city = lead.city || (user ? user.city : '') || 'N/A';
                let state = lead.state || 'N/A';
                let pincode = lead.pincode || 'N/A';
                let address = lead.address || 'N/A';
                let empStrength = lead.employee_strength || 'N/A';
                let industry = lead.industry || 'N/A';
                let createdDate = lead.created_at || 'N/A';

                let clientDetails = [];
                if (lead.client_details) {
                    try {
                        clientDetails = typeof lead.client_details === 'string' ? JSON.parse(lead.client_details) : lead.client_details;
                    } catch (e) { clientDetails = []; }
                }

                let platform = lead.platform || 'N/A';
                let website = lead.website || '';
                let businessName = lead.business_name || 'N/A';
                let gstNumber = lead.gst_number || 'N/A';
                let pageUrl = lead.page_url || '';
                let product = lead.product || 'N/A';
                let painPoints = lead.pain_points || 'N/A';
                let campaignName = lead.campaign_name || 'N/A';
                let campaignId = lead.campaign_id || 'N/A';
                let adsetName = lead.adset_name || 'N/A';
                let adsetId = lead.adset_id || 'N/A';
                let adName = lead.ad_name || 'N/A';
                let adId = lead.ad_id || 'N/A';
                let formName = lead.form_name || 'N/A';
                let formId = lead.form_id || 'N/A';

                let todayStart = new Date();
                todayStart.setHours(0,0,0,0);

                let todayEnd = new Date();
                todayEnd.setHours(23,59,59,999);

                let plannedActivities = [];
                let todayActivities = [];
                let pastActivities = [];
                let overdueOrDone = [];

                if (messages && messages.length > 0) {
                    messages.forEach(msg => {
                        let msgDate = msg.created_at_raw ? new Date(msg.created_at_raw) : null;
                        let fdate = msg.next_followup_date_raw ? new Date(msg.next_followup_date_raw) : null;

                        if (fdate && fdate > todayEnd && (msg.is_done == 0 || !msg.is_done)) {
                            plannedActivities.push(msg);
                        }
                        if ((msgDate && msgDate >= todayStart && msgDate <= todayEnd) || (fdate && fdate >= todayStart && fdate <= todayEnd)) {
                            todayActivities.push(msg);
                        }
                        if (msgDate && msgDate < todayStart) {
                            pastActivities.push(msg);
                        }
                        if ((fdate && fdate < todayStart && (msg.is_done == 0 || !msg.is_done)) || msg.is_done == 1) {
                            overdueOrDone.push(msg);
                        }
                    });
                }

                let leadDocs = [];
                if (lead.documents) {
                    try {
                        leadDocs = typeof lead.documents === 'string' ? JSON.parse(lead.documents) : lead.documents;
                    } catch(e) { leadDocs = []; }
                }

                let followupDocs = [];
                if (messages && messages.length > 0) {
                    messages.forEach(msg => {
                        if (msg.followup_documents && msg.followup_documents.length > 0) {
                            msg.followup_documents.forEach(fdoc => {
                                followupDocs.push({
                                    doc: fdoc,
                                    date: msg.created_at_formatted,
                                    user: msg.user_name
                                });
                            });
                        }
                    });
                }

                let html = `
                <ul class="nav nav-tabs border-bottom-0 mb-4 gap-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link lead-custom-tab active" id="personal-tab-${leadId}" data-bs-toggle="tab" data-bs-target="#personal-${leadId}" type="button" role="tab">Personal Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link lead-custom-tab" id="source-tab-${leadId}" data-bs-toggle="tab" data-bs-target="#source-${leadId}" type="button" role="tab">Source Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link lead-custom-tab" id="followup-tab-${leadId}" data-bs-toggle="tab" data-bs-target="#followup-${leadId}" type="button" role="tab">Followup Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link lead-custom-tab" id="documents-tab-${leadId}" data-bs-toggle="tab" data-bs-target="#documents-${leadId}" type="button" role="tab">Documents</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- 1. PERSONAL DETAILS TAB (Modern Card Grid) -->
                    <div class="tab-pane fade show active" id="personal-${leadId}" role="tabpanel">
                        <div class="p-2">
                            <div class="row g-3">
                                <!-- Category Name -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Category</span>
                                            <span class="badge bg-light text-primary border fs-12 fw-semibold px-2 py-0.5">${categoryName}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Full Name -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Full Name</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block">${userName}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Email Address</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block" title="${userEmail}">${userEmail}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile No -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Mobile Number</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block">${userPhone}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Country -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-globe-americas"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Country</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${country}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- City -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">City</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${city}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- State -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-map"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">State</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${state}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pincode -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Pincode</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${pincode}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-house"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Address</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block" title="${address}">${address}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Strength -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Employee Strength</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${empStrength}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Industry -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-industry"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Industry</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${industry}</span>
                                        </div>
                                    </div>
                                </div>

                                 <!-- Lead Added On -->
                                <div class="col-md-3 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Lead Added On</span>
                                            <span class="fs-13 text-dark fw-medium text-truncate d-block">${createdDate}</span>
                                        </div>
                                    </div>
                                </div>

                                ${(() => {
                                    let cAttrs = lead.custom_attributes;
                                    if (typeof cAttrs === 'string') { try { cAttrs = JSON.parse(cAttrs); } catch(e) { cAttrs = null; } }
                                    if (cAttrs && typeof cAttrs === 'object' && Object.keys(cAttrs).length > 0) {
                                        let items = Object.entries(cAttrs).map(([k, v]) => `
                                            <div class="col-md-3 col-sm-6">
                                                <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                                    <div class="rounded-circle bg-info-subtle text-info d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                                        <i class="fas fa-sliders-h"></i>
                                                    </div>
                                                    <div class="w-100 overflow-hidden">
                                                        <span class="fs-10 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">${k.replace(/_/g, ' ').toUpperCase()}</span>
                                                        <span class="fs-13 text-dark fw-bold text-wrap text-break d-block" style="word-break: break-word; white-space: normal;" title="${v}">${v}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        `).join('');
                                        return `<div class="col-12 mt-3"><hr class="my-2"><h6 class="fw-bold mb-3 text-info d-flex align-items-center gap-2" style="font-size: 14px;"><i class="fas fa-sliders-h"></i> Custom Attributes / Dynamic Fields</h6><div class="row g-3">${items}</div></div>`;
                                    }
                                    return '';
                                })()}

                                ${Array.isArray(clientDetails) && clientDetails.length > 0 ? `
                                    <div class="col-12 mt-3">
                                        <hr class="my-3">
                                        <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2" style="font-size: 14px;">
                                            <i class="fas fa-user-gear"></i> Additional Client Contacts / Details
                                        </h6>
                                        <div class="row g-3">
                                            ${clientDetails.map(contact => contact && (contact.name || contact.phone || contact.email) ? `
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <div class="card h-100 border shadow-2xs rounded-3 bg-white">
                                                        <div class="card-body p-3">
                                                            <div class="d-flex align-items-center gap-2.5 mb-2 pb-2 border-bottom">
                                                                <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 34px; height: 34px; font-size: 13px;">
                                                                    <i class="fas fa-user"></i>
                                                                </div>
                                                                <div class="text-truncate">
                                                                    <h6 class="fw-bold text-dark mb-0 fs-13 text-truncate">${contact.name || 'N/A'}</h6>
                                                                    <span class="badge bg-light text-secondary border fs-10 px-2 py-0.5">${contact.designation || 'No Designation'}</span>
                                                                </div>
                                                            </div>
                                                            ${contact.email ? `<div class="d-flex align-items-center gap-2 mb-1.5 fs-12 text-muted"><i class="fas fa-envelope text-primary" style="width: 14px;"></i><span class="text-dark text-break">${contact.email}</span></div>` : ''}
                                                            ${contact.phone ? `<div class="d-flex align-items-center gap-2 fs-12 text-muted"><i class="fas fa-phone text-success" style="width: 14px;"></i><span class="text-dark fw-medium">${contact.phone}</span></div>` : ''}
                                                        </div>
                                                    </div>
                                                </div>
                                            ` : '').join('')}
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    </div>

                    <!-- 2. SOURCE DETAILS TAB (Modern Card Grid & Callout) -->
                    <div class="tab-pane fade" id="source-${leadId}" role="tabpanel">
                        <div class="p-2">
                            <div class="row g-3">
                                <!-- Source Platform -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Source Platform</span>
                                            <span class="badge bg-light text-primary border fs-12 fw-semibold px-2.5 py-1">${platform}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campaign Name & ID -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-bullseye"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Campaign Name</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block" title="${campaignName}">${campaignName}</span>
                                            ${campaignId && campaignId !== 'N/A' ? `<small class="fs-11 text-muted d-block mt-0.5">ID: ${campaignId}</small>` : ''}
                                        </div>
                                    </div>
                                </div>

                                <!-- Ad Set Name & ID -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Ad Set Name</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block" title="${adsetName}">${adsetName}</span>
                                            ${adsetId && adsetId !== 'N/A' ? `<small class="fs-11 text-muted d-block mt-0.5">ID: ${adsetId}</small>` : ''}
                                        </div>
                                    </div>
                                </div>

                                <!-- Ad Name & ID -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-ad"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Ad Name</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block" title="${adName}">${adName}</span>
                                            ${adId && adId !== 'N/A' ? `<small class="fs-11 text-muted d-block mt-0.5">ID: ${adId}</small>` : ''}
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Name & ID -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-wpforms"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Form Name</span>
                                            <span class="fs-13 text-dark fw-bold text-truncate d-block" title="${formName}">${formName}</span>
                                            ${formId && formId !== 'N/A' ? `<small class="fs-11 text-muted d-block mt-0.5">ID: ${formId}</small>` : ''}
                                        </div>
                                    </div>
                                </div>

                                <!-- Company Name -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Company / Business Name</span>
                                            <span class="fs-14 text-dark fw-bold text-truncate d-block">${businessName}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- GST Number -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">GST Number</span>
                                            <span class="fs-14 text-dark fw-semibold text-truncate d-block">${gstNumber}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Website URL -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-globe"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Website</span>
                                            ${website ? `<a href="${website.startsWith('http') ? website : 'https://' + website}" target="_blank" class="fs-13 text-primary fw-semibold text-decoration-none text-truncate d-inline-flex align-items-center gap-1"><i class="fas fa-external-link-alt fs-10"></i> ${website}</a>` : '<span class="fs-13 text-muted">N/A</span>'}
                                        </div>
                                    </div>
                                </div>

                                <!-- Page URL / Landing Page -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-link"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Landing Page URL</span>
                                            ${pageUrl ? `<a href="${pageUrl}" target="_blank" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1 fw-semibold"><i class="fas fa-arrow-up-right-from-square"></i> Visit Landing Page</a>` : '<span class="fs-13 text-muted">N/A</span>'}
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Interested -->
                                <div class="col-md-4 col-sm-6">
                                    <div class="p-3 bg-white border rounded-3 shadow-2xs h-100 d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <div class="text-truncate">
                                            <span class="fs-11 text-muted text-uppercase fw-bold d-block mb-0.5" style="letter-spacing: 0.5px;">Product</span>
                                            <span class="badge bg-light text-dark border fs-12 fw-semibold px-2.5 py-1">${product}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pain Points Callout Container -->
                                <div class="col-12 mt-2">
                                    <div class="p-3.5 rounded-3 border shadow-2xs" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f7ff 100%); border-left: 4px solid #006FC9 !important;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-quote-left text-primary fs-14"></i>
                                            <h6 class="fs-12 text-uppercase fw-bold text-primary mb-0" style="letter-spacing: 0.5px;">Pain Points & Current System Context</h6>
                                        </div>
                                        <div class="text-dark fs-13" style="line-height: 1.6; word-wrap: break-word;">
                                            ${painPoints && painPoints !== 'N/A' ? painPoints : '<span class="text-muted italic">No specific pain points or current system details logged.</span>'}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. FOLLOWUP DETAILS TAB (Scrollable Vertical Life Timeline Stepper) -->
                    <div class="tab-pane fade" id="followup-${leadId}" role="tabpanel">
                        <div class="p-3">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2" style="font-size: 15px;">
                                    <i class="fas fa-timeline text-primary"></i> Follow-up Lifecycle Timeline
                                </h6>
                                <span class="badge bg-primary-subtle text-primary px-3 py-1 fs-12 fw-semibold">
                                    ${messages ? messages.length : 0} Total Activities
                                </span>
                            </div>

                            ${messages && messages.length > 0 ? `
                                <div class="timeline-scroll-wrapper pe-2" style="max-height: 480px; overflow-y: auto;">
                                    <div class="timeline-stepper-container position-relative ms-3 ps-4 my-2" style="border-left: 2px dashed #cbd5e1;">
                                        ${messages.map(msg => {
                                            let isDone = msg.is_done == 1;
                                            let dotColor = isDone ? '#10b981' : (msg.next_followup_date ? '#006FC9' : '#64748b');
                                            let statusText = msg.status || 'Followup';
                                            let statusBg = isDone ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary';
                                            
                                            let typeIcon = 'fa-comment-dots';
                                            if (msg.followup_type) {
                                                let ft = msg.followup_type.toLowerCase();
                                                if (ft.includes('call')) typeIcon = 'fa-phone-alt';
                                                else if (ft.includes('whatsapp')) typeIcon = 'fa-brands fa-whatsapp';
                                                else if (ft.includes('email')) typeIcon = 'fa-envelope';
                                                else if (ft.includes('meeting')) typeIcon = 'fa-handshake';
                                            }

                                            return `
                                            <div class="timeline-item position-relative mb-4">
                                                <!-- Step Node Dot -->
                                                <div class="position-absolute rounded-circle bg-white shadow-2xs d-flex align-items-center justify-content-center"
                                                     style="left: -35px; top: 12px; width: 22px; height: 22px; border: 3px solid ${dotColor}; z-index: 2;">
                                                    <div class="rounded-circle" style="width: 6px; height: 6px; background-color: ${dotColor};"></div>
                                                </div>

                                                <!-- Activity Card Box -->
                                                <div class="card border shadow-2xs rounded-3 bg-white">
                                                    <div class="card-body p-3.5">
                                                        <!-- Header Bar: Avatar, User, Status Badge, Timestamp -->
                                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2.5">
                                                            <div class="d-flex align-items-center gap-2.5">
                                                                <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 34px; height: 34px; font-size: 13px;">
                                                                    ${(msg.user_name || 'U').charAt(0).toUpperCase()}
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <span class="fw-bold text-dark fs-14">${msg.user_name || 'User'}</span>
                                                                        <span class="badge ${statusBg} border fs-11 px-2.5 py-0.5 fw-semibold">
                                                                            Status: ${statusText}
                                                                        </span>
                                                                    </div>
                                                                    ${msg.followup_type ? `<span class="badge bg-light text-secondary border fs-10 px-2 py-0.5 mt-0.5"><i class="fas ${typeIcon} me-1 text-primary"></i> ${msg.followup_type}</span>` : ''}
                                                                </div>
                                                            </div>
                                                            <div class="text-muted fs-11 d-flex align-items-center gap-1 bg-light px-2.5 py-1 rounded-2 border">
                                                                <i class="far fa-clock"></i> ${msg.created_at_formatted || 'N/A'}
                                                            </div>
                                                        </div>

                                                        <!-- Bucket Badge if present -->
                                                        ${msg.bucket ? `
                                                            <div class="mb-2">
                                                                <span class="badge bg-light text-dark border fs-11 px-2.5 py-1">
                                                                    <i class="fas fa-layer-group text-primary me-1"></i> Bucket: <strong>${msg.bucket}</strong>
                                                                </span>
                                                            </div>
                                                        ` : ''}

                                                        <!-- Logged Message Body -->
                                                        ${msg.message ? `
                                                            <div class="p-3 bg-light rounded-3 text-dark fs-13 mb-2" style="line-height: 1.5; word-wrap: break-word;">
                                                                ${msg.message}
                                                            </div>
                                                        ` : ''}

                                                        <!-- Next Followup Date Callout -->
                                                        ${msg.next_followup_date ? `
                                                            <div class="p-2 px-3 rounded-2 d-inline-flex align-items-center gap-2 mt-1" style="background-color: #eff6ff; border-left: 4px solid #006FC9;">
                                                                <i class="far fa-calendar-check text-primary fs-13"></i>
                                                                <span class="fs-12 text-primary fw-semibold">Next Scheduled Follow-up: <strong>${msg.next_followup_date}</strong></span>
                                                            </div>
                                                        ` : ''}

                                                        <!-- Audio Recording Player -->
                                                        ${msg.call_recording ? `
                                                            <div class="p-2.5 rounded-3 bg-light border d-flex align-items-center gap-2 mt-2.5">
                                                                <i class="fas fa-volume-high text-success fs-14 me-1"></i>
                                                                <audio controls style="width: 100%; height: 32px;">
                                                                    <source src="${msg.call_recording}" type="audio/mpeg">
                                                                </audio>
                                                            </div>
                                                        ` : ''}

                                                        <!-- Followup Attached Documents -->
                                                        ${msg.followup_documents && msg.followup_documents.length > 0 ? `
                                                            <div class="d-flex align-items-center gap-2 flex-wrap mt-2.5 pt-2 border-top">
                                                                <small class="text-muted fw-bold fs-11">ATTACHED FILES:</small>
                                                                ${msg.followup_documents.map(doc => {
                                                                    let docPath = typeof doc === 'object' ? doc.path : doc;
                                                                    let docName = typeof doc === 'object' ? doc.name : docPath.split('/').pop();
                                                                    let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(docPath);
                                                                    return `<a href="${viewUrl}" target="_blank" class="badge bg-white text-dark border p-1.5 rounded d-inline-flex align-items-center gap-1 text-decoration-none fs-11">
                                                                        <i class="fas fa-paperclip text-primary"></i> ${docName}
                                                                    </a>`;
                                                                }).join('')}
                                                            </div>
                                                        ` : ''}
                                                    </div>
                                                </div>
                                            </div>`;
                                        }).join('')}
                                    </div>
                                </div>
                            ` : `
                                <div class="text-center py-5 bg-light rounded-3 border">
                                    <i class="far fa-comments text-muted fs-1 mb-2 opacity-50"></i>
                                    <h6 class="fw-bold text-dark mb-1 fs-14">No Followup Activity Logged</h6>
                                    <p class="text-muted fs-12 mb-0">No lifecycle timeline events found for this lead.</p>
                                </div>
                            `}
                        </div>
                    </div>

                    <!-- 4. DOCUMENTS TAB -->
                    <div class="tab-pane fade" id="documents-${leadId}" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card h-100 border shadow-none" style="background-color: #f8fafc; border-radius: 8px;">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2">
                                            <i class="feather feather-folder text-primary"></i> Lead Form Documents
                                        </h6>
                                        ${leadDocs && leadDocs.length > 0 ? leadDocs.map(doc => {
                                            let docPath = typeof doc === 'object' ? doc.path : doc;
                                            let docName = typeof doc === 'object' ? doc.name : docPath.split('/').pop();
                                            let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(docPath);
                                            let downloadUrl = "{{ route('document.download') }}?path=" + encodeURIComponent(docPath) + "&name=" + encodeURIComponent(docName);
                                            return `
                                            <div class="d-flex align-items-center justify-content-between p-2 bg-white border rounded mb-2">
                                                <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                                    <i class="feather feather-file-text text-primary fs-16"></i>
                                                    <span class="fs-13 text-dark text-truncate fw-medium">${docName}</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-1 ms-2 flex-shrink-0">
                                                    <a href="${viewUrl}" target="_blank" class="btn btn-xs btn-outline-info d-flex align-items-center gap-1 px-2 py-1" style="font-size: 11px;">
                                                        <i class="feather feather-eye"></i> View
                                                    </a>
                                                    <a href="${downloadUrl}" class="btn btn-xs btn-primary d-flex align-items-center gap-1 text-white px-2 py-1" style="font-size: 11px;">
                                                        <i class="feather feather-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>`;
                                        }).join('') : '<div class="text-muted fs-13 italic p-2 bg-white border rounded text-center">No lead form documents uploaded.</div>'}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border shadow-none" style="background-color: #f8fafc; border-radius: 8px;">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-3 text-primary d-flex align-items-center gap-2">
                                            <i class="feather feather-paperclip text-primary"></i> Followup Documents
                                        </h6>
                                        ${followupDocs && followupDocs.length > 0 ? followupDocs.map(item => {
                                            let fdoc = item.doc;
                                            let docPath = typeof fdoc === 'object' ? fdoc.path : fdoc;
                                            let docName = typeof fdoc === 'object' ? fdoc.name : docPath.split('/').pop();
                                            let viewUrl = "{{ route('document.view') }}?path=" + encodeURIComponent(docPath);
                                            let downloadUrl = "{{ route('document.download') }}?path=" + encodeURIComponent(docPath) + "&name=" + encodeURIComponent(docName);
                                            return `
                                            <div class="d-flex align-items-center justify-content-between p-2 bg-white border rounded mb-2">
                                                <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                                    <i class="feather feather-file-text text-success fs-16"></i>
                                                    <div class="text-truncate">
                                                        <span class="fs-13 text-dark d-block text-truncate fw-medium">${docName}</span>
                                                        <small class="text-muted fs-11" style="font-size: 10px;">By ${item.user} on ${item.date}</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-1 ms-2 flex-shrink-0">
                                                    <a href="${viewUrl}" target="_blank" class="btn btn-xs btn-outline-info d-flex align-items-center gap-1 px-2 py-1" style="font-size: 11px;">
                                                        <i class="feather feather-eye"></i> View
                                                    </a>
                                                    <a href="${downloadUrl}" class="btn btn-xs btn-primary d-flex align-items-center gap-1 text-white px-2 py-1" style="font-size: 11px;">
                                                        <i class="feather feather-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>`;
                                        }).join('') : '<div class="text-muted fs-13 italic p-2 bg-white border rounded text-center">No followup documents uploaded.</div>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

                container.innerHTML = html;

                container.querySelectorAll('[data-bs-toggle="tab"]').forEach(tabBtn => {
                    tabBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        let targetId = this.getAttribute('data-bs-target');
                        container.querySelectorAll('.nav-link').forEach(btn => btn.classList.remove('active'));
                        container.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
                        this.classList.add('active');
                        let targetPane = container.querySelector(targetId);
                        if (targetPane) targetPane.classList.add('show', 'active');
                    });
                });
            }
        </script>

        {{-- Single Shared Global Offcanvases --}}
        <!-- Shared History Offcanvas -->
        <div class="content-area offcanvas offcanvas-end" data-scrollbar-target="#psScrollbarInit" style="width:450px" tabindex="-1" id="proposalSentOffcanvas" aria-labelledby="proposalSentOffcanvasLabel">
            <div class="content-area-header sticky-top bg-white border-bottom p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <i class="fas fa-history text-primary"></i> History & Comments (<span id="sharedHistoryLeadName">User</span>)
                    </h6>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <div class="content-area-body h-100 p-3" id="sharedHistoryBody" style="background-color: #f8fafc; overflow-y: auto;"></div>
        </div>

        <!-- Shared WhatsApp Offcanvas -->
        <div class="content-area offcanvas offcanvas-end" style="width:400px" tabindex="-1" id="whatsappSentOffcanvas" aria-labelledby="whatsappOffcanvasLabel">
            <div class="content-area-header sticky-top bg-white p-3 border-bottom">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-image">
                            <img id="sharedWhatsAppImg" src="{{ asset('images/blank.jpeg') }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                        </div>
                        <div>
                            <div class="fw-bold text-dark fs-14" id="sharedWhatsAppName">User</div>
                            <div class="fs-10 text-success fw-semibold" id="sharedWhatsAppPhone">-</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <div class="content-area-body h-100 p-4" style="background-color:#efeae2; overflow-y: auto;">
                <div class="text-center text-muted fs-12 my-auto">Start typing a message below...</div>
            </div>
            <div class="d-flex align-items-center justify-content-between border-top bg-white p-2 sticky-bottom">
                <input class="form-control border-0" placeholder="Type your message here...">
                <button class="btn btn-primary btn-sm ms-2"><i class="feather-send"></i></button>
            </div>
        </div>

        <!-- Shared SMS Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="SMSSentOffcanvas" aria-labelledby="SMSSentOffcanvasLabel" style="width: 400px;">
            <div class="offcanvas-header border-bottom bg-light py-3">
                <h6 class="offcanvas-title d-flex align-items-center gap-2 fw-bold text-dark">
                    <i class="fa-regular fa-comment-dots text-secondary"></i>
                    Send SMS to <span id="sharedSMSName" class="text-capitalize">User</span>
                </h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-3" style="background-color: #f4f6f8;">
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-12">Target Number</label>
                    <input type="text" class="form-control" id="sharedSMSMobileNum" placeholder="Mobile No.">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-12">Template</label>
                    <select class="form-control template-dropdown fs-13">
                        <option selected disabled>Select Template</option>
                    </select>
                </div>
                <div class="mb-3 flex-grow-1 d-flex flex-column">
                    <label class="form-label fw-semibold fs-12">Message</label>
                    <textarea class="form-control flex-grow-1" rows="8" placeholder="Type your message..."></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-auto">
                    <button class="btn btn-light border" data-bs-dismiss="offcanvas">Cancel</button>
                    <button class="btn text-white" style="background-color: #006FC9;">Send SMS</button>
                </div>
            </div>
        </div>

        <!-- Shared Edit Status Offcanvas -->
        <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas" aria-labelledby="editStatusOffcanvasLabel" style="width: 420px; background: #f8fafc;">
            <div class="offcanvas-header border-bottom bg-white py-3 px-4 shadow-2xs">
                <div class="d-flex align-items-center gap-2.5">
                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-13 shadow-2xs" style="width: 36px; height: 36px;">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h6 class="offcanvas-title fw-bold text-dark mb-0 fs-14" id="editStatusOffcanvasLabel">
                            Edit Status
                        </h6>
                        <span class="fs-11 text-muted">
                            Lead: <strong class="text-dark text-capitalize" id="sharedEditStatusLeadName">User</strong>
                        </span>
                    </div>
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-3.5">
                <form id="sharedQuickUpdateForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lead_bucket_id" value="46">
                    
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
                                    <option value="" disabled selected>Select Engagement Status</option>
                                    <option value="hot">🔥 Hot</option>
                                    <option value="warm">⚡ Warm</option>
                                    <option value="cold">❄️ Cold</option>
                                    <option value="dead">💀 Dead</option>
                                </select>
                            </div>

                            {{-- Lead Status --}}
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

                            {{-- Sub Status --}}
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

                    {{-- Card Box 2: Communication & Comment --}}
                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="fas fa-comments text-info fs-12"></i>
                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Communication & Comment</h6>
                        </div>
                        <div class="card-body p-3">
                            {{-- Followup / Communication Type --}}
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                    <i class="fas fa-phone text-info me-1 fs-10"></i>Communication Type
                                </label>
                                <select class="form-select border-slate shadow-2xs fs-13" name="followup_type" style="border-color: #cbd5e1; border-radius: 8px;">
                                    <option value="" disabled selected>Select Communication Type</option>
                                    <option value="Call">Call</option>
                                    <option value="WhatsApp Call">WhatsApp Call</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Email">Email</option>
                                    <option value="Meeting">Meeting</option>
                                </select>
                            </div>

                            {{-- Followup / Communication Status --}}
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                    <i class="fas fa-signal text-info me-1 fs-10"></i>Communication Status
                                </label>
                                <select class="form-select border-slate shadow-2xs fs-13" name="followup_status" style="border-color: #cbd5e1; border-radius: 8px;">
                                    <option value="" disabled selected>Select Communication Status</option>
                                    <option value="Answered">Answered</option>
                                    <option value="Unanswered">Unanswered</option>
                                    <option value="Busy">Busy</option>
                                    <option value="Switched Off">Switched Off</option>
                                </select>
                            </div>

                            {{-- Add Message / Comment --}}
                            <div class="comment-message-box">
                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                    <i class="fas fa-comment-dots text-primary me-1 fs-10"></i>Add Comment / Message
                                </label>
                                <textarea class="form-control border-slate shadow-2xs fs-13" name="message" rows="3" placeholder="Write a comment or message..." style="border-color: #cbd5e1; border-radius: 8px; resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Card Box 3: Next Follow-up & Attachments --}}
                    <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                        <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="fas fa-calendar-check text-warning fs-12"></i>
                            <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Next Follow-up & Attachments</h6>
                        </div>
                        <div class="card-body p-3">
                            {{-- Next Follow Up Date --}}
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                    <i class="fas fa-calendar-alt text-primary me-1 fs-10"></i>Next Follow-up Date & Time
                                </label>
                                <input type="datetime-local" class="form-control border-slate shadow-2xs fs-13" name="next_followup_date" style="border-color: #cbd5e1; border-radius: 8px;">
                            </div>

                            {{-- Attachments --}}
                            <div>
                                <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                                    <i class="fas fa-paperclip text-success me-1 fs-10"></i>Attachments (Multiple PDF/Doc/Images)
                                </label>
                                <input type="file" class="form-control border-slate shadow-2xs fs-12" name="followup_documents[]" multiple style="border-color: #cbd5e1; border-radius: 8px;">
                                <div id="sharedExistingAttachments" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Offcanvas Footer --}}
                    <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top mt-4">
                        <button type="button" class="btn btn-light text-secondary fw-semibold border px-3 py-1.5 fs-13" data-bs-dismiss="offcanvas">CLOSE</button>
                        <button type="submit" class="btn text-white fw-bold px-4 py-1.5 fs-13 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%); border: none; border-radius: 6px;">
                            <i class="fas fa-check-circle fs-12"></i> UPDATE STATUS
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Shared To-Do Offcanvas -->
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
                <hr class="m-0" style="border-color: #e2e8f0;">
                <div class="p-4 bg-white" id="sharedTodoTasksContainer"></div>
            </div>
        </div>

        <script>
            // ========== DYNAMIC SEND EMAIL & EMAIL HISTORY JS ==========
            function updatePreviewToBadge(val) {
                const badge = document.getElementById('previewToBadge');
                if (badge) badge.textContent = 'To: ' + (val || '');
                const text = document.getElementById('sendEmailRecipientText');
                if (text) text.textContent = 'Recipient: ' + (val || 'No Email Address');
            }

            function onAttachmentFileSelected(input) {
                const previewContainer = document.getElementById('attachmentFilePreview');
                const nameSpan = document.getElementById('attachmentFileName');
                
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
                    let iconClass = 'fas fa-paperclip text-primary';
                    if (file.type.includes('pdf')) iconClass = 'fas fa-file-pdf text-danger';
                    else if (file.type.includes('image')) iconClass = 'fas fa-file-image text-success';
                    
                    nameSpan.innerHTML = `<i class="${iconClass} me-1"></i> ${file.name} <span class="text-muted fs-11">(${sizeMb} MB)</span>`;
                    previewContainer.classList.remove('d-none');
                } else {
                    removeAttachmentFile();
                }
            }

            function removeAttachmentFile() {
                const input = document.getElementById('emailAttachmentInput');
                if (input) input.value = '';
                const previewContainer = document.getElementById('attachmentFilePreview');
                if (previewContainer) previewContainer.classList.add('d-none');
            }

            function openSendEmailModal(leadId, leadName, leadEmail) {
                document.getElementById('sendEmailLeadId').value = leadId;
                document.getElementById('sendEmailModalTitle').textContent = 'Send Email to ' + (leadName || 'Lead');
                document.getElementById('sendEmailRecipientText').textContent = 'Recipient: ' + (leadEmail || 'No Email Address');
                
                const emailInput = document.getElementById('customToEmailInput');
                if (emailInput) emailInput.value = leadEmail || '';

                removeAttachmentFile();

                const alertDiv = document.getElementById('sendEmailAlert');
                alertDiv.className = 'alert d-none';
                
                const previewCard = document.getElementById('sendEmailPreviewCard');
                previewCard.classList.add('d-none');
                
                const confirmBtn = document.getElementById('confirmSendEmailBtn');
                confirmBtn.disabled = true;

                // Load active templates
                const select = document.getElementById('sendEmailTemplateSelect');
                select.innerHTML = '<option value="">-- Loading Active Templates... --</option>';

                fetch("{{ route('lead-email.active-templates') }}")
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.templates.length > 0) {
                            let options = '<option value="">-- Select Email Template --</option>';
                            data.templates.forEach(t => {
                                options += `<option value="${t.id}">[ ${t.type} ] ${t.name}</option>`;
                            });
                            select.innerHTML = options;
                        } else {
                            select.innerHTML = '<option value="">-- No active templates found --</option>';
                        }
                    })
                    .catch(err => {
                        select.innerHTML = '<option value="">-- Error loading templates --</option>';
                    });

                const modal = new bootstrap.Modal(document.getElementById('dynamicSendEmailModal'));
                modal.show();
            }

            function onTemplateSelected() {
                const leadId = document.getElementById('sendEmailLeadId').value;
                const templateId = document.getElementById('sendEmailTemplateSelect').value;
                const previewCard = document.getElementById('sendEmailPreviewCard');
                const confirmBtn = document.getElementById('confirmSendEmailBtn');
                const alertDiv = document.getElementById('sendEmailAlert');

                alertDiv.className = 'alert d-none';

                if (!templateId) {
                    previewCard.classList.add('d-none');
                    confirmBtn.disabled = true;
                    return;
                }

                fetch("{{ route('lead-email.preview') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ lead_id: leadId, template_id: templateId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const emailInput = document.getElementById('customToEmailInput');
                        if (emailInput && (!emailInput.value || !emailInput.value.trim())) {
                            emailInput.value = data.to_email || '';
                        }
                        updatePreviewToBadge(emailInput ? emailInput.value : data.to_email);
                        
                        document.getElementById('previewSubjectText').textContent = data.subject;
                        document.getElementById('previewBodyText').innerHTML = data.body;
                        
                        previewCard.classList.remove('d-none');
                        confirmBtn.disabled = false;
                    } else {
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.textContent = data.message || 'Could not generate template preview.';
                        previewCard.classList.add('d-none');
                        confirmBtn.disabled = true;
                    }
                })
                .catch(err => {
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.textContent = 'Error connecting to server.';
                    previewCard.classList.add('d-none');
                    confirmBtn.disabled = true;
                });
            }

            function submitSendEmail() {
                const leadId = document.getElementById('sendEmailLeadId').value;
                const templateId = document.getElementById('sendEmailTemplateSelect').value;
                const customToEmail = document.getElementById('customToEmailInput') ? document.getElementById('customToEmailInput').value : '';
                const confirmBtn = document.getElementById('confirmSendEmailBtn');
                const alertDiv = document.getElementById('sendEmailAlert');

                if (!customToEmail || !customToEmail.trim()) {
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.textContent = 'Please enter a valid recipient email address.';
                    return;
                }

                confirmBtn.disabled = true;
                confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';

                const formData = new FormData();
                formData.append('lead_id', leadId);
                formData.append('template_id', templateId);
                formData.append('custom_to_email', customToEmail.trim());

                const fileInput = document.getElementById('emailAttachmentInput');
                if (fileInput && fileInput.files && fileInput.files[0]) {
                    formData.append('attachment', fileInput.files[0]);
                }

                fetch("{{ route('lead-email.send') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Send Email';

                    if (data.status === 'success') {
                        const sendModalEl = document.getElementById('dynamicSendEmailModal');
                        const sendModal = bootstrap.Modal.getInstance(sendModalEl);
                        if (sendModal) sendModal.hide();

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Sent!',
                                text: data.message || 'Email sent successfully.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            alert(data.message || 'Email sent successfully.');
                        }

                        // Refresh Email History if open
                        if (leadId) loadLeadEmailHistory(leadId);
                    } else {
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.textContent = data.message || 'Unable to send email. Please try again.';
                    }
                })
                .catch(err => {
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Send Email';
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.textContent = 'An unexpected error occurred while sending email.';
                });
            }

            function loadLeadEmailHistory(leadId) {
                const container = document.getElementById('viewEmailHistoryContent');
                if (!container) return;

                container.innerHTML = '<div class="text-center text-muted py-3 fs-12"><i class="fas fa-spinner fa-spin me-2"></i> Loading email history...</div>';

                fetch("{{ url('/lead-email/history') }}/" + leadId)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.logs.length > 0) {
                            let html = '<table class="table table-sm table-hover align-middle mb-0 fs-12">';
                            html += '<thead class="bg-light"><tr><th>Template</th><th>Recipient</th><th>Sent By</th><th>Sent Date</th><th>Status</th><th class="text-end">Action</th></tr></thead><tbody>';
                            
                            data.logs.forEach(log => {
                                let statusBadge = '<span class="badge bg-secondary">Pending</span>';
                                if (log.status === 'Sent') statusBadge = '<span class="badge bg-success">Sent</span>';
                                else if (log.status === 'Failed') statusBadge = '<span class="badge bg-danger" title="' + (log.error_message || '') + '">Failed</span>';

                                html += `<tr>
                                    <td class="fw-semibold text-dark">${log.template_name}</td>
                                    <td>${log.to_email}</td>
                                    <td class="text-muted">${log.sent_by}</td>
                                    <td class="text-muted">${log.sent_date}</td>
                                    <td>${statusBadge}</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-xs btn-light text-primary border" onclick="openSentEmailLogModal(${log.id})">
                                            <i class="fas fa-eye me-1"></i> View
                                        </button>
                                    </td>
                                </tr>`;
                            });
                            html += '</tbody></table>';
                            container.innerHTML = html;

                            // Cache logs globally for view modal lookup
                            window.currentEmailLogs = data.logs;
                        } else {
                            container.innerHTML = '<div class="text-center text-muted py-3 fs-12"><i class="far fa-envelope-open me-2"></i> No email history found for this lead.</div>';
                        }
                    })
                    .catch(err => {
                        container.innerHTML = '<div class="text-center text-danger py-3 fs-12">Failed to load email history.</div>';
                    });
            }

            function openSentEmailLogModal(logId) {
                if (!window.currentEmailLogs) return;
                const log = window.currentEmailLogs.find(l => l.id == logId);
                if (!log) return;

                document.getElementById('viewLogModalTitle').textContent = 'Email Log: ' + log.template_name;
                document.getElementById('viewLogRecipient').textContent = 'To: ' + log.to_email + ' • Sent By: ' + log.sent_by + ' • ' + log.sent_date;
                document.getElementById('viewLogSubject').textContent = log.subject;
                document.getElementById('viewLogBody').innerHTML = log.body.replace(/\n/g, '<br>');

                const badge = document.getElementById('viewLogStatusBadge');
                badge.className = 'badge ' + (log.status === 'Sent' ? 'bg-success' : 'bg-danger');
                badge.textContent = log.status;

                const errSec = document.getElementById('viewLogErrorSection');
                if (log.status === 'Failed' && log.error_message) {
                    document.getElementById('viewLogErrorMessage').textContent = log.error_message;
                    errSec.classList.remove('d-none');
                } else {
                    errSec.classList.add('d-none');
                }

                const modal = new bootstrap.Modal(document.getElementById('viewSentEmailLogModal'));
                modal.show();
            }
        </script>

        @include('crm.lead.custom-import-modal')
    @endpush
@endsection
