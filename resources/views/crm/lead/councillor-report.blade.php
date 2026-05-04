@extends('layouts.app')

@section('content')

    <style>
        .table-responsive {
            overflow-x: auto;
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

        /* Table Base */
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
    </style>

    <div class="main-wrapper">

        {{-- ===================== HEADER AREA ===================== --}}
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10"> Counsellor Report</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"> Counsellor Report</li>
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

        {{-- Filters --}}
        {{-- Collapsible Lead Stats --}}
        <div id="collapseDailyReportFilter" class="accordion-collapse collapse page-header-collapse ">
            <div class="accordion-body pb-2">
                <form method="GET" action="{{ route('lead.councillorReport') }}" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="councillor_name" class="form-label">Counsellor Name</label>
                        <select name="councillor_name" id="councillor_name" class="form-control">
                            <option value="">Select Counsellor</option>
                            @foreach($councillors as $id => $name)
                            <option value="{{ $id }}" {{ request('councillor_name') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                      <div class="col-md-3">
                        <label class="form-label">From Date</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">To Date</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>
                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="feather-filter me-1"></i> Filter
                        </button>

                        <a href="{{ route('lead.councillorReport') }}" class="btn btn-danger">
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
                        <div class="card-body p-0">
                            <div class="card-body p-0">
                                <div class="p-3">

                                    <h5 class="mb-3">Counsellor Funnel</h5>
                                    <div class="d-flex flex-column flex-lg-row gap-4 align-items-start justify-content-center">


                                        {{-- RIGHT: FUNNEL CHART --}}
                                        <div class="d-flex align-items-center " style="width:60%;">

                                            <!-- LEFT: Funnel -->
                                            <div id="funnelChart" style="height:300px; width:60%;"></div>

                                            <!-- RIGHT: Custom Legend -->
                                            <div id="funnelLegend" style="width:40%; padding-left:20px;"></div>

                                        </div>

                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-hover" id="leadList">

                                            <thead>
                                                <tr>
                                                    <th class="text-start">Counsellor Name</th>
                                                    <th>Total Leads</th>
                                                    <th>Untouched</th>
                                                    <th>Not Connected</th>
                                                    <th>Counselling in Progress</th>
                                                    <th>Application Process</th>
                                                    <th>Offer Stage</th>
                                                    <th>Visa Process</th>
                                                    <th>Converted</th>
                                                    <th>Lost</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($data as $row)
                                                <tr>
                                                    <td class="text-start">
                                                        <strong>{{ $row->owner->name ?? 'Unknown' }}</strong>
                                                    </td>

                                                    <td>
                                                        <strong>{{ $row->total_leads ?? 0 }}</strong>
                                                    </td>

                                                    <td>{{ $row->untouched }}</td>
                                                    <td>{{ $row->not_connected }}</td>
                                                    <td>{{ $row->counselling }}</td>
                                                    <td>{{ $row->application }}</td>
                                                    <td>{{ $row->offer_stage }}</td>
                                                    <td>{{ $row->visa_process }}</td>
                                                    <td>{{ $row->converted }}</td>
                                                    <td><strong>{{ $row->lost ?? 0 }}</strong></td>
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


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <script>
           window.onload = function () {

    let colors = [
        '#E67E3F',
        '#E5D46A',
        '#76B7B2',
        '#8FD18B',
        '#3B6FB6',
        '#E76F51',
        '#F4E7A1',
        '#A29BFE',
        '#FF9FF3'
    ];

    let data = [
        { name: 'Total Leads', real: {{ $totals->sum('total_leads') ?? 0 }} },
        { name: 'Lost', real: {{ $totals->sum('lost') ?? 0 }} },
        { name: 'Not Connected', real: {{ $totals->sum('not_connected') ?? 0 }} },
        { name: 'Untouched', real: {{ $totals->sum('untouched') ?? 0 }} },
        { name: 'Counselling', real: {{ $totals->sum('counselling') ?? 0 }} },
        { name: 'Application', real: {{ $totals->sum('application') ?? 0 }} },
        { name: 'Offer Stage', real: {{ $totals->sum('offer_stage') ?? 0 }} },
        { name: 'Visa', real: {{ $totals->sum('visa_process') ?? 0 }} },
        { name: 'Converted', real: {{ $totals->sum('converted') ?? 0 }} }
    ];

    // 🔥 Sort descending
    data.sort((a, b) => b.real - a.real);

    let finalData = data.map((item, index) => ({
        name: item.name,
        y: 100, // shape same
        real: item.real,
        color: colors[index % colors.length]
    }));

    // ================= FUNNEL CHART =================
    Highcharts.chart('funnelChart', {
        chart: {
            type: 'funnel'
        },

        title: {
            text: ''
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.point.name + '</b>: ' + this.point.real;
            }
        },

        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    inside: true, // 🔥 center me
                    style: {
                        color: '#000',
                        fontSize: '13px',
                        fontWeight: '600',
                        textOutline: 'none'
                    },
                    formatter: function () {
                        return this.point.real; // 🔥 sirf count
                    }
                },
                neckWidth: '0%',
                neckHeight: '0%',
                width: '80%'
            }
        },

        series: [{
            name: 'Leads',
            data: finalData
        }]
    });

    // ================= RIGHT SIDE LEGEND =================
    let legendHTML = '';

    finalData.forEach(item => {
        legendHTML += `
            <div style="display:flex; align-items:center; margin-bottom:10px;">
                
                <div style="
                    width:14px;
                    height:14px;
                    background:${item.color};
                    margin-right:10px;
                    border-radius:3px;">
                </div>

                <div style="flex:1; font-size:14px;">
                    ${item.name}
                </div>

                <div style="font-weight:600;">
                    ${item.real}
                </div>

            </div>
        `;
    });

    document.getElementById('funnelLegend').innerHTML = legendHTML;

};
</script>
@endsection