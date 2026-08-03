@extends('layouts.app')

@section('content')

    <style>
        .lead-custom-tab {
            color: #6c757d !important;
            background: transparent !important;
            border: none !important;
            border-bottom: 3px solid transparent !important;
            padding: 0 0 0.5rem 0 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .lead-custom-tab:hover {
            color: #006FC9 !important;
        }

        .lead-custom-tab.active {
            color: #212529 !important;
            font-weight: bold !important;
            border-bottom: 3px solid #006FC9 !important;
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
        .order-status-strip { position: relative; max-width: 100%; overflow: hidden; background: #fff; border-bottom: 1px solid #e9ecef; padding: 10px 16px; }
        .order-status-strip.has-overflow { padding-left: 44px; padding-right: 44px; }
        .order-status-scroll { display: flex; box-sizing: border-box; width: 100%; max-width: 100%; min-width: 0; align-items: center; gap: 8px; overflow-x: scroll; overscroll-behavior-x: contain; scrollbar-width: none; scroll-behavior: smooth; scroll-snap-type: x proximity; }
        .order-status-scroll::-webkit-scrollbar { display: none; }
        .order-status-tab { flex: 0 0 auto; scroll-snap-align: start; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #cfe4f8; border-radius: 999px; padding: 6px 12px; background: #f2f8ff; color: #006FC9; font-size: 12px; font-weight: 700; line-height: 1; text-decoration: none; }
        .order-status-tab:hover { color: #006FC9; background: #e5f2ff; }
        .order-status-tab.is-active { background: #006FC9; border-color: #006FC9; color: #fff; box-shadow: 0 3px 8px rgba(0, 111, 201, .18); }
        .order-status-arrow { display: none; position: absolute; top: 50%; z-index: 1; transform: translateY(-50%); width: 30px; height: 30px; padding: 0; border: 1px solid #dbe3ec; border-radius: 50%; background: #fff; color: #006FC9; box-shadow: 0 2px 6px rgba(15, 23, 42, .12); }
        .order-status-strip.has-overflow .order-status-arrow { display: inline-flex; align-items: center; justify-content: center; }
        .order-status-arrow:disabled { opacity: .35; cursor: default; }
        .order-status-arrow.prev { left: 10px; }
        .order-status-arrow.next { right: 10px; }
        .order-list-toolbar { background: #fff; border-bottom: 1px solid #e9ecef; padding-top: 10px; padding-bottom: 10px; }
        @media (max-width: 575.98px) {
            .order-list-toolbar { gap: 12px !important; }
            .order-list-toolbar > div:last-child { width: 100%; justify-content: flex-end; }
        }
    </style>

    <div class="container-fluid px-0">

        <x-lead.tools :title="'Orders'" :buckets="$orderBuckets" :filterBucket="collect()" :totalLeadsCount="$totalOrdersCount"
            :filteredLeadCount="$filteredOrdersCount" :owners="$owners" :sources="$sources" :categories="$categories" :showViewSwitcher="false" />

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Order Master Status Navigation Bar --}}
        <div class="order-status-strip has-overflow mt-3">
            <button type="button" class="order-status-arrow prev" data-order-status-scroll="prev" aria-label="Previous order statuses" onclick="var tabs = document.getElementById('order-status-scroll'); tabs.scrollLeft -= Math.max(tabs.clientWidth * .75, 180);"><i class="feather-chevron-left"></i></button>
            <div class="order-status-scroll" id="order-status-scroll">
            @php
                $isAllActive = !request()->has('bucket_id') || request('bucket_id') === 'all' || request('bucket_id') === 'all_orders';
            @endphp
            <a href="{{ route('orders.index') }}"
                class="order-status-tab {{ $isAllActive ? 'is-active' : '' }}">
                <i class="feather-layers"></i>
                My Orders ({{ $totalOrdersCount }})
            </a>

            @if($orderBuckets->count())
                @foreach($orderBuckets as $bucket)
                    @php
                        $isActive = request('bucket_id') == $bucket->id;
                    @endphp
                    <a href="{{ route('orders.index', ['bucket_id' => $bucket->id]) }}"
                        class="order-status-tab {{ $isActive ? 'is-active' : '' }}">
                        <i class="feather-circle"></i>
                        {{ $bucket->name }} ({{ $bucket->leads_count }})
                    </a>
                @endforeach
            @endif
            </div>
            <button type="button" class="order-status-arrow next" data-order-status-scroll="next" aria-label="Next order statuses" onclick="var tabs = document.getElementById('order-status-scroll'); tabs.scrollLeft += Math.max(tabs.clientWidth * .75, 180);"><i class="feather-chevron-right"></i></button>
        </div>

        <div class="order-list-toolbar d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 px-3">
            <div class="d-flex align-items-center">
                <div class="form-check">
                    <input type="checkbox" id="selectAll" class="form-check-input">
                </div>

                <div class="d-flex align-items-center gap-2 ms-2">
                    <label class="mb-0">Show</label>
                    <form method="GET">
                        @foreach(request()->except('per_page', 'page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <span>Entries</span>
                </div>
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
                <a href="javascript:void(0);" class="bulk-owner" style="color: #006FC9;" title="Assign Owner">
                    <i class="fas fa-user-plus fs-5"></i>
                </a>
            </div>
        </div>

        {{-- Converted Orders List from `orders` table --}}
        <div class="row">
            <div class="col-12">
                @forelse($orders as $order)
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="card-body d-flex flex-wrap flex-xxl-nowrap align-items-center justify-content-between gap-3 p-3">
                            @php
                                $lead = $order->lead ?? $order;
                                $leadId = $order->lead_id ?? $order->id;
                                $engStatus = strtolower($order->order_engagement_status ?? 'n/a');
                            @endphp

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input lead-checkbox" value="{{ $order->id }}"
                                    data-email="{{ optional($order->user)->email }}">
                            </div>

                            <div class="d-flex justify-content-center align-items-center mx-2" title="Order Progress">
                                <div class="rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="
                                    width: 45px;
                                    height: 45px;
                                    background: conic-gradient(#28a745 100%, #e9ecef 0%);
                                ">
                                    <div class="rounded-circle bg-white d-flex justify-content-center align-items-center"
                                        style="width: 35px; height: 35px;">
                                        <span class="fs-12 fw-bold text-dark">100%</span>
                                    </div>
                                </div>
                            </div>

                            @php
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
                            @endphp
                            <div class="d-flex align-items-start">
                                <div style="width: 280px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="mb-0 fw-bold text-dark">
                                            <a data-bs-toggle="collapse" href="#details-{{ $leadId }}"
                                                class="text-dark text-decoration-none hover-blue"
                                                style="--hover-color: #006FC9;">
                                                {{ optional($order->user)->name ?? 'Customer' }}
                                            </a>
                                        </p>
                                        <span class="badge bg-light text-secondary rounded-pill border">#{{ $order->order_number }}</span>
                                    </div>
                                    <small class="text-muted d-block mt-1">{{ optional($order->user)->contact_no ?? 'N/A' }}</small>
                                    <div class="d-flex align-items-center gap-1 mt-1 flex-wrap">
                                        <div class="badge {{ $badgeClass }} fw-semibold px-2 py-1 text-capitalize"
                                            style="font-size: 13px;">
                                            {{ $engStatus }}
                                        </div>
                                        @if($order->product)
                                            <span class="badge fw-semibold px-2 py-1 text-capitalize"
                                                style="font-size: 13px; background-color: rgba(0, 111, 201, 0.1); color: #006FC9; border: 1px solid rgba(0, 111, 201, 0.2);">
                                                {{ $order->product }}
                                            </span>
                                        @else
                                            <span class="badge fw-semibold px-2 py-1 text-capitalize text-muted"
                                                style="font-size: 13px; background-color: rgba(108, 117, 125, 0.08); color: #6c757d; border: 1px solid rgba(108, 117, 125, 0.15);">
                                                No Product
                                            </span>
                                        @endif
                                    </div>
                                    <div class="mt-1">
                                        <small class="" style="font-size: .815em; line-height: 0.8;">Converted On</small>
                                        <span class="text-muted fw-semibold"
                                            style="font-size:.815em; line-height: 0.8;">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y h:i A') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- STATUS EDIT OFFCANVAS TRIGGER --}}
                            <div class="flex ms-2" style="min-width: 200px;">
                                <div class="d-inline-flex align-items-center justify-content-between bg-dark text-white rounded px-2 py-2 w-100"
                                    style="max-width: 190px; cursor:pointer;" data-bs-toggle="offcanvas"
                                    data-bs-target="#editStatusOffcanvas-{{ $leadId }}">
                                    <span class="fs-12 text-truncate">{{ $order->bucket->name ?? 'Active production' }}</span>
                                    <i class="fa-solid fa-pen-to-square text-secondary ms-2"></i>
                                </div>
                            </div>

                            {{-- Owner & Converted By --}}
                            <div class="d-flex flex-column me-2" style="min-width: 130px;">
                                <small class="text-muted fs-11">Owner: <span class="fw-semibold text-dark fs-12">{{ optional($order->owner)->name ?? 'Unassigned' }}</span></small>
                                <small class="text-muted fs-11 mt-1">Converted By: <span class="fw-semibold text-primary fs-12">{{ optional($order->converter)->name ?? 'N/A' }}</span></small>
                            </div>

                            {{-- Action Icons Bar --}}
                            <div class="d-flex align-items-center gap-2 ms-auto">
                                <a href="javascript:void(0);" class="text-secondary fs-5 open-callback"
                                    data-bs-toggle="offcanvas" data-bs-target="#proposalSent{{ $leadId }}" title="Comments / Callbacks">
                                    <i class="fas fa-comment-dots" style="color: #006FC9;"></i>
                                </a>
                                <a class="text-dark p-1 collapsed" data-bs-toggle="collapse"
                                    href="#details-{{ $leadId }}" role="button" title="View Order Details">
                                    <i class="fas fa-chevron-down fs-6 p-2 rounded-circle border text-white"
                                        style="background-color: #006FC9;"></i>
                                </a>
                            </div>
                        </div>

                        {{-- COLLAPSIBLE ORDER DETAILS - TABBED LAYOUT --}}
                        <div class="collapse border-top" id="details-{{ $leadId }}">
                            <div class="px-3 pt-2 pb-3 bg-white">
                                {{-- Tab Navigation --}}
                                <ul class="nav nav-tabs border-bottom-0" id="orderTab-{{ $leadId }}" role="tablist" style="gap: 0;">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active px-3 py-2 text-dark fw-semibold border-0 bg-transparent" id="personal-tab-{{ $leadId }}" data-bs-toggle="tab" data-bs-target="#personal-{{ $leadId }}" type="button" role="tab" style="font-size: 13px;">Personal Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-3 py-2 text-muted fw-semibold border-0 bg-transparent" id="source-tab-{{ $leadId }}" data-bs-toggle="tab" data-bs-target="#source-{{ $leadId }}" type="button" role="tab" style="font-size: 13px;">Source Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-3 py-2 text-muted fw-semibold border-0 bg-transparent" id="followup-tab-{{ $leadId }}" data-bs-toggle="tab" data-bs-target="#followup-{{ $leadId }}" type="button" role="tab" style="font-size: 13px;">Followup Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link px-3 py-2 text-muted fw-semibold border-0 bg-transparent" id="docs-tab-{{ $leadId }}" data-bs-toggle="tab" data-bs-target="#docs-{{ $leadId }}" type="button" role="tab" style="font-size: 13px;">Documents</button>
                                    </li>
                                </ul>
                                <hr class="mt-0 mb-0" style="border-color: #e0e0e0;">

                                {{-- Tab Content --}}
                                <div class="tab-content pt-3" id="orderTabContent-{{ $leadId }}">
                                    @php
                                        $client = $order->client_details ?? ($order->lead->client_details ?? []);
                                        $leadData = $order->lead;
                                    @endphp

                                    {{-- Personal Details Tab --}}
                                    <div class="tab-pane fade show active" id="personal-{{ $leadId }}" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Name</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->user)->name ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Email</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->user)->email ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Mobile No.</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->user)->contact_no ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Country</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->user)->country ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-4 mt-1">
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">City</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->user)->city ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Employee Strength</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $client['employee_strength'] ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Industry</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $client['industry'] ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Order Added On</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Source Details Tab --}}
                                    <div class="tab-pane fade" id="source-{{ $leadId }}" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Company Name</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $client['business_name'] ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Website</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $client['website'] ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">GST Number</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $client['gst_number'] ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Product</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $order->product ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-4 mt-1">
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Category</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->category)->name ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Services</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">
                                                    @if(!empty($order->services))
                                                        {{ is_array($order->services) ? implode(', ', $order->services) : $order->services }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Owner</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->owner)->name ?? 'Unassigned' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Converted By</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ optional($order->converter)->name ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Followup Details Tab --}}
                                    <div class="tab-pane fade" id="followup-{{ $leadId }}" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Current Status</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $order->bucket->name ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Sub-Status</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $order->order_status ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Engagement</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500; text-transform: capitalize;">{{ $order->order_engagement_status ?? 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Order Number</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $order->order_number }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-4 mt-1">
                                            <div class="col-6">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Pain Points</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{!! $order->pain_points ?? 'None recorded' !!}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Amount</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ $order->amount ? '₹' . number_format($order->amount, 2) : 'N/A' }}</div>
                                            </div>
                                            <div class="col-3">
                                                <div style="font-size: 11px; font-weight: 600; color: #006FC9; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Last Updated</div>
                                                <div style="font-size: 13px; color: #333; font-weight: 500;">{{ \Carbon\Carbon::parse($order->updated_at)->format('M d, Y h:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Documents Tab --}}
                                    <div class="tab-pane fade" id="docs-{{ $leadId }}" role="tabpanel">
                                        @if(!empty($order->documents))
                                            <div class="row g-3">
                                                @foreach($order->documents as $doc)
                                                    @php
                                                        $dPath = is_array($doc) ? ($doc['path'] ?? '') : $doc;
                                                        $dName = is_array($doc) ? ($doc['name'] ?? basename($dPath)) : basename($dPath);
                                                    @endphp
                                                    <div class="col-3">
                                                        <div class="d-flex align-items-center p-2 border rounded bg-light" style="gap: 8px;">
                                                            <i class="fas fa-file-alt text-muted" style="font-size: 16px;"></i>
                                                            <div class="flex-grow-1 text-truncate" style="font-size: 12px; font-weight: 500; color: #333;">{{ $dName }}</div>
                                                            <a href="{{ route('document.view', ['path' => $dPath]) }}" target="_blank" class="text-primary" style="font-size: 14px;" title="View"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="font-size: 13px; color: #999;">No documents uploaded</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- EDIT STATUS OFFCANVAS FOR THIS ORDER --}}
                        <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas-{{ $leadId }}" style="width: 420px;">
                            <div class="offcanvas-header bg-dark text-white p-3">
                                <h6 class="offcanvas-title text-white fw-bold mb-0">Update Order Status</h6>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body p-4">
                                <form action="{{ route('lead.updateQuick', $leadId) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-1">Bucket Status</label>
                                        <select class="form-select bg-light border-0 shadow-sm edit-bucket-select" name="lead_bucket_id" data-lead-id="{{ $leadId }}" onchange="updateSubStatuses(this, '{{ $leadId }}')">
                                            @foreach($allBuckets as $b)
                                                <option value="{{ $b->id }}" {{ ($order->order_bucket_id == $b->id) ? 'selected' : '' }}>
                                                    {{ $b->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-1">Sub-Status</label>
                                        <select class="form-select bg-light border-0 shadow-sm" name="lead_status" id="statusSelect-{{ $leadId }}">
                                            <option value="">Select Status</option>
                                            @php
                                                $currentBucketObj = $allBuckets->firstWhere('id', $order->order_bucket_id);
                                            @endphp
                                            @if($currentBucketObj && $currentBucketObj->children && $currentBucketObj->children->count())
                                                @foreach($currentBucketObj->children as $child)
                                                    <option value="{{ $child->name }}" {{ ($order->order_status == $child->name) ? 'selected' : '' }}>
                                                        {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            @elseif($order->order_status)
                                                <option value="{{ $order->order_status }}" selected>{{ $order->order_status }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-1">Engagement</label>
                                        <select class="form-select bg-light border-0 shadow-sm" name="lead_engagement_status">
                                            <option value="hot" {{ $engStatus === 'hot' ? 'selected' : '' }}>Hot</option>
                                            <option value="warm" {{ $engStatus === 'warm' ? 'selected' : '' }}>Warm</option>
                                            <option value="cold" {{ $engStatus === 'cold' ? 'selected' : '' }}>Cold</option>
                                            <option value="dead" {{ $engStatus === 'dead' ? 'selected' : '' }}>Dead</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-1">Comment / Note</label>
                                        <textarea class="form-control bg-light border-0 shadow-sm" name="message" rows="3" placeholder="Add status comment..."></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                                        <button type="submit" class="btn btn-warning fw-bold">Update Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- COMMENTS OFFCANVAS FOR THIS ORDER --}}
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="proposalSent{{ $leadId }}" style="width: 400px;">
                            <div class="offcanvas-header bg-primary text-white">
                                <h6 class="offcanvas-title text-white fw-bold mb-0">Comments & Callbacks</h6>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body p-3">
                                <form action="{{ route('lead.callbackDone') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="lead_id" value="{{ $leadId }}">
                                    <div class="mb-3">
                                        <label class="form-label small">New Note / Message</label>
                                        <textarea name="message" class="form-control" rows="3" required placeholder="Type callback message..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm w-100 mb-3">Save Comment</button>
                                </form>
                                <hr>
                                <h6 class="fw-bold mb-2">Past History</h6>
                                @if(isset($order->lead->messages) && $order->lead->messages->count())
                                    @foreach($order->lead->messages->sortByDesc('created_at') as $msg)
                                        <div class="p-2 mb-2 bg-light border rounded fs-12">
                                            <div class="d-flex justify-content-between text-muted fs-11">
                                                <strong>{{ optional($msg->user)->name ?? 'User' }}</strong>
                                                <span>{{ \Carbon\Carbon::parse($msg->created_at)->format('d M h:i A') }}</span>
                                            </div>
                                            <div class="mt-1 text-dark">{{ $msg->message }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted small">No comments recorded yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card card-body text-center py-5 shadow-sm">
                        <i class="feather-shopping-bag text-muted display-4 mb-3"></i>
                        <h5 class="text-muted">No Orders Found in `orders` Table</h5>
                        <p class="text-muted mb-0">No orders match your active filter criteria.</p>
                    </div>
                @endforelse

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="text-muted fs-13 mb-0">
                        Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders
                    </p>
                    <div>
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Order Detail Tabs Styling */
        .nav-tabs .nav-link {
            border-bottom: 3px solid transparent !important;
            transition: all 0.2s ease;
        }
        .nav-tabs .nav-link.active {
            color: #333 !important;
            border-bottom: 3px solid #006FC9 !important;
        }
        .nav-tabs .nav-link:not(.active) {
            color: #888 !important;
            border-bottom: 3px solid transparent !important;
        }
        .nav-tabs .nav-link:hover:not(.active) {
            color: #555 !important;
            border-bottom: 3px solid #ccc !important;
        }
    </style>

    <script>
        function dbChangeOrderEngagement(leadId, newStatus) {
            fetch('/modern-leads/drag-update/' + leadId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ lead_engagement_status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }

        window.bucketSubStatusesMap = {
            @foreach($allBuckets as $b)
                "{{ $b->id }}": [
                    @if($b->children && $b->children->count())
                        @foreach($b->children as $child)
                            { id: "{{ $child->id }}", name: "{{ addslashes($child->name) }}" },
                        @endforeach
                    @endif
                ],
            @endforeach
        };

        window.updateSubStatuses = function(selectElem, leadId) {
            var bucketId = $(selectElem).val();
            var statusSelect = $('#statusSelect-' + leadId);

            statusSelect.empty().append('<option value="">Select Status</option>');

            if (!bucketId) return;

            var subStatuses = window.bucketSubStatusesMap[bucketId] || [];
            if (subStatuses && subStatuses.length > 0) {
                $.each(subStatuses, function(idx, item) {
                    statusSelect.append('<option value="' + item.name + '">' + item.name + '</option>');
                });
            } else {
                $.ajax({
                    url: "{{ route('lead.getSubStatus') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        bucket_id: bucketId,
                        lead_bucket_id: bucketId
                    },
                    success: function(response) {
                        var items = Array.isArray(response) ? response : (response.children || []);
                        if (items && items.length > 0) {
                            $.each(items, function(key, value) {
                                statusSelect.append('<option value="' + value.name + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            }
        };

        $(document).on('change', '.edit-bucket-select', function() {
            var leadId = $(this).data('lead-id');
            updateSubStatuses(this, leadId);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const statusScroll = document.getElementById('order-status-scroll');
            const statusStrip = statusScroll?.closest('.order-status-strip');
            const previousButton = document.querySelector('[data-order-status-scroll="prev"]');
            const nextButton = document.querySelector('[data-order-status-scroll="next"]');

            if (!statusScroll || !statusStrip || !previousButton || !nextButton) return;

            const updateArrowState = () => {
                const hasOverflow = statusScroll.scrollWidth > statusScroll.clientWidth + 1 || window.innerWidth < 768;
                statusStrip.classList.toggle('has-overflow', hasOverflow);
                previousButton.disabled = false;
                nextButton.disabled = false;
            };

            const scrollStatuses = (direction) => {
                const step = Math.max(statusScroll.clientWidth * .75, 180);
                const maxScrollLeft = statusScroll.scrollWidth - statusScroll.clientWidth;
                const targetLeft = Math.max(0, Math.min(maxScrollLeft, statusScroll.scrollLeft + (direction * step)));
                statusScroll.scrollLeft = targetLeft;
                updateArrowState();
            };

            statusScroll.addEventListener('scroll', updateArrowState, { passive: true });
            window.addEventListener('resize', updateArrowState);
            updateArrowState();
            window.setTimeout(updateArrowState, 150);

            if (window.ResizeObserver) {
                new ResizeObserver(updateArrowState).observe(statusScroll);
            }
        });
    </script>
@endsection
