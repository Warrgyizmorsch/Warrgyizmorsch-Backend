@extends('layouts.app')

@section('content')

    <style>
        .table-responsive {
            overflow-x: auto;
            /* adjust height if needed */
        }

        #leadList thead th {
            position: sticky;
            top: 0;
            background: #ffffff;
            /* important so it doesn't turn transparent */
            z-index: 10;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05);
        }

        .highlight-column {
            background-color: #fafafaf5 !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Make content take full height so footer stays at bottom */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        #leadList {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            font-size: 14px;
        }

        /* Header */
        #leadList thead th {
            background: #f8f9fb;
            color: #344054;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Dark Mode Support */
        body.dark-mode #leadList thead th {
            background: #1f2937;
            color: #e5e7eb;
        }

        /* Rows */
        #leadList tbody tr {
            transition: all 0.2s ease;
        }

        /* Zebra striping */
        #leadList tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        body.dark-mode #leadList tbody tr:nth-child(even) {
            background-color: #111827;
        }

        /* Hover Effect */
        #leadList tbody tr:hover {
            background-color: #e8f0fe !important;
            cursor: pointer;
        }

        body.dark-mode #leadList tbody tr:hover {
            background-color: #1e3a8a !important;
        }

        /* Cell padding */
        #leadList th,
        #leadList td {
            padding: 12px 14px;
            border-bottom: 1px solid #eee;
        }

        body.dark-mode #leadList th,
        body.dark-mode #leadList td {
            border-bottom: 1px solid #374151;
        }

        /* First column highlight */
        #leadList td:first-child {
            font-weight: 600;
            color: #111827;
        }

        body.dark-mode #leadList td:first-child {
            color: #f9fafb;
        }

        /* Numbers styling */
        #leadList td:not(:first-child) {
            text-align: center;
            font-weight: 500;
        }

        /* ================= TABLE SORTING ================= */

        #leadList th.sortable {
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }

        #leadList th.sortable .sort-icons {
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-left: 6px;
            font-size: 7px;
            line-height: 7px;
            opacity: 0.5;
            vertical-align: middle;
        }
    </style>

    <div class="main-wrapper">

        {{-- ===================== HEADER AREA ===================== --}}
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Follow Up</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>

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

                        {{-- Chart Toggle --}}
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseDailyReportFilter">
                            <i class="feather-bar-chart"></i>Filter
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div id="collapseDailyReportFilter"
            class="accordion-collapse collapse page-header-collapse {{ request('search') || request('from') || request('to') || request('source') || request('status') || request('lead_owner') || request('country') || request('course') || request('campaign_name') || request('adset_name') || request('ad_name') ? 'show' : '' }}">
            <div class="accordion-body pb-2">
                <form method="GET" action="{{ route('lead.followUpData') }}" class="row g-3 mb-4">

                    <div class="col-md-3">
                        <label class="form-label">From Date</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">To Date</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="feather-filter me-1"></i> Filter
                        </button>

                        <a href="{{ route('lead.followUpData') }}" class="btn btn-danger">
                            Reset
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- ===================== MAIN CONTENT ===================== --}}
        <div class="main-content mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">

                        <div class="table-responsive">

                            <table class="table table-hover" id="leadList">

                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-start sortable" style="min-width:320px;">Counselor
                                            Name<span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span></th>
                                        <th rowspan="2" class="sortable">Done Followups<span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span></th>

                                        <!-- Group Headers -->
                                        <th colspan="2">Call</th>
                                        <th colspan="2">Whatsapp Call</th>
                                        <th colspan="2">Whatsapp</th>


                                        <!-- <th rowspan="2">Planned Followups</th>
                                                            <th rowspan="2">Missed Followups</th> -->
                                    </tr>

                                    <tr>
                                        <!-- Sub Headers -->
                                        <th class="sortable">
                                            Connected
                                            <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span>
                                        </th>

                                        <th class="sortable">
                                            Not Connected
                                            <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span>
                                        </th>

                                        <!-- Whatsapp Call -->
                                        <th class="sortable">
                                            Connected
                                            <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span>
                                        </th>

                                        <th class="sortable">
                                            Not Connected
                                            <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span>
                                        </th>

                                        <!-- Whatsapp -->
                                        <th class="sortable">
                                            Discussion Start
                                        <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span></th>

                                        <th class="sortable">
                                            No Response
                                        <span class="sort-icons">
                                                <span>▲</span>
                                                <span>▼</span>
                                            </span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($leads as $row)
                                        <tr>
                                            <td class="text-start">
                                                <strong>{{ $row->user->name ?? 'user' }}</strong>
                                            </td>

                                            <td>{{ $row->done_followups }}</td>

                                            <!-- Call -->
                                            <td>{{ $row->call_connected }}</td>
                                            <td>{{ $row->call_not_connected }}</td>

                                            <!-- Whatsapp Call -->
                                            <td>{{ $row->whatsapp_call_connected }}</td>
                                            <td>{{ $row->whatsapp_call_not_connected }}</td>

                                            <td>{{ $row->discussion_start }}</td>
                                            <td>{{ $row->no_response }}</td>

                                            <!-- Others -->


                                            <!-- <td>{{ $row->planned_followups }}</td>
                                                                                <td>{{ $row->missed_followups }}</td> -->


                                            <!-- <td style="cursor:pointer; position:relative;">

                                                                                    {{-- Done Toggle --}}
                                                                                    <div class="done-toggle d-flex align-items-center justify-content-center gap-1 fw-bold" data-id="{{ $row->created_by }}">
                                                                                        <span>{{ $row->done_followups }}</span>
                                                                                        <i class="bi bi-chevron-right toggle-icon"></i>
                                                                                    </div>

                                                                                    {{-- Level 1 Container --}}
                                                                                    <div class="done-content d-none mt-2" id="done-{{ $row->created_by }}">

                                                                                        <div class="d-flex justify-content-between gap-2">

                                                                                            {{-- CALL --}}
                                                                                            <div class="flex-fill border rounded p-1 text-start">
                                                                                                <div class="type-toggle d-flex justify-content-between align-items-center" data-target="call-{{ $row->created_by }}">
                                                                                                    <span> Call ({{ $row->phone_call }})</span>
                                                                                                    <i class="bi bi-chevron-right type-icon"></i>
                                                                                                </div>

                                                                                                <div class="type-content d-none mt-2 small text-muted" id="call-{{ $row->created_by }}">
                                                                                                    <div> Connected: {{ $row->call_connected }}</div>
                                                                                                    <div> Not Connected: {{ $row->call_not_connected }}</div>
                                                                                                </div>
                                                                                            </div>

                                                                                            {{-- WHATSAPP CALL --}}
                                                                                            <div class="flex-fill border rounded p-1 text-start ">
                                                                                                <div class="type-toggle d-flex justify-content-between align-items-center" data-target="wacall-{{ $row->created_by }}">
                                                                                                    <span> WA Call ({{ $row->whatsapp_call }})</span>
                                                                                                    <i class="bi bi-chevron-right type-icon"></i>
                                                                                                </div>

                                                                                                <div class="type-content d-none mt-2 small text-muted text-start" id="wacall-{{ $row->created_by }}">
                                                                                                    <div class="text-start"> Connected: {{ $row->whatsapp_call_connected }}</div>
                                                                                                    <div> Not Connected: {{ $row->whatsapp_call_not_connected }}</div>
                                                                                                </div>
                                                                                            </div>

                                                                                            {{-- WHATSAPP --}}
                                                                                            <div class="flex-fill border rounded p-1 text-start">
                                                                                                <div class="type-toggle d-flex justify-content-between align-items-center" data-target="wa-{{ $row->created_by }}">
                                                                                                    <span> WA ({{ $row->whatsapp }})</span>
                                                                                                    <i class="bi bi-chevron-right type-icon"></i>
                                                                                                </div>

                                                                                                <div class="type-content d-none mt-2 small text-muted" id="wa-{{ $row->created_by }}">
                                                                                                    <div> Discussion Start: {{ $row->discussion_start }}</div>
                                                                                                    <div> No Response: {{ $row->no_response }}</div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>

                                                                                </td> -->


                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center p-5 text-muted">
                                                No Records Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

                        </div>

                        <div class="m-4" style="display: flex; justify-content: center;">
                            {{ $leads->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 👉 Done toggle
            document.querySelectorAll('.done-toggle').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();

                    let id = this.dataset.id;
                    let box = document.getElementById('done-' + id);
                    let icon = this.querySelector('.toggle-icon');

                    box.classList.toggle('d-none');

                    icon.classList.toggle('bi-chevron-right');
                    icon.classList.toggle('bi-chevron-down');
                });
            });

            // 👉 Type toggle (nested)
            document.querySelectorAll('.type-toggle').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();

                    let target = this.dataset.target;
                    let box = document.getElementById(target);
                    let icon = this.querySelector('.type-icon');

                    box.classList.toggle('d-none');

                    icon.classList.toggle('bi-chevron-right');
                    icon.classList.toggle('bi-chevron-down');
                });
            });

            // ================= TABLE SORTING =================

            const table = document.getElementById("leadList");
            const headers = table.querySelectorAll("th.sortable");

            headers.forEach((header, index) => {

                let ascending = true;

                header.addEventListener("click", function () {

                    const tbody = table.querySelector("tbody");

                    const rows = Array.from(
                        tbody.querySelectorAll("tr")
                    ).filter(row => row.children.length > 1);

                    rows.sort((a, b) => {

                        let aText = a.children[index].innerText.trim();
                        let bText = b.children[index].innerText.trim();

                        let aNum = parseFloat(aText.replace(/,/g, ""));
                        let bNum = parseFloat(bText.replace(/,/g, ""));

                        // Number sorting
                        if (!isNaN(aNum) && !isNaN(bNum)) {

                            return ascending
                                ? aNum - bNum
                                : bNum - aNum;
                        }

                        // Text sorting
                        return ascending
                            ? aText.localeCompare(bText)
                            : bText.localeCompare(aText);

                    });

                    rows.forEach(row => tbody.appendChild(row));

                    ascending = !ascending;
                });

            });
        });
    </script>
@endsection