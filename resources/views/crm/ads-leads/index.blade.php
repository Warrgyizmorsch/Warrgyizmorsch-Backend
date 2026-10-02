@extends('layouts.app')

@section('content')

    <style>
        #adsLeadTable thead th {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #f8fafc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }

        .table-responsive { 
            overflow-x: auto; 
            border-radius: 8px;
        }

        .url-truncate {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
        }

        .badge-spend {
            background-color: #ecfdf5;
            color: #047857;
            font-weight: 600;
            border: 1px solid #a7f3d0;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .badge-service {
            background-color: #eff6ff;
            color: #1d4ed8;
            font-weight: 500;
            border: 1px solid #bfdbfe;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-block;
            max-width: 220px;
            word-break: break-word;
        }

        .goal-text {
            max-width: 240px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.85rem;
            color: #4b5563;
        }

        .btn-send-lead {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            border: none;
            color: #fff;
            padding: 6px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.25);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-send-lead:hover {
            background: linear-gradient(135deg, #4338ca 0%, #2563eb 100%);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.35);
        }

        .tab-btn {
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
    </style>

    @php
        $filtersApplied = request('search') || request('from') || request('to');
    @endphp

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Ads Leads</h5>
            </div>

            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">SEO</li>
                <li class="breadcrumb-item active">Ads Leads</li>
            </ul>

            <span class="badge bg-primary px-2 py-1 ms-2" style="font-size: 0.8rem;">
                Active: {{ $totalActiveCount }} | Converted: {{ $totalConvertedCount }}
            </span>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items d-flex gap-2">
                <button class="btn btn-light-brand" type="button"
                        data-bs-toggle="collapse" data-bs-target="#adsLeadFilters">
                    <i class="feather-filter me-2"></i> Filters
                    @if($filtersApplied)
                        <span class="badge bg-danger ms-1">Active</span>
                    @endif
                </button>
            </div>
        </div>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="feather-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <i class="feather-alert-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER PANEL --}}
    <div id="adsLeadFilters" class="accordion-collapse collapse page-header-collapse {{ $filtersApplied ? 'show' : '' }}">
        <div class="accordion-body pb-2">
            <form method="GET" action="{{ route('ads-leads.index') }}" class="row g-3 mb-4">
                <input type="hidden" name="tab" value="{{ $tab }}">

                <div class="col-md-4">
                    <label class="form-label fw-bold">Search</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by name, email, phone, website..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">From Date</label>
                    <input type="date" name="from" class="form-control"
                           value="{{ request('from') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">To Date</label>
                    <input type="date" name="to" class="form-control"
                           value="{{ request('to') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="feather-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('ads-leads.index', ['tab' => $tab]) }}" class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABS NAVIGATION --}}
    <div class="d-flex align-items-center justify-content-between mb-3 mt-3">
        <ul class="nav nav-pills gap-2">
            <li class="nav-item">
                <a class="nav-link tab-btn {{ $tab === 'active' ? 'active bg-primary text-white' : 'btn-light text-dark' }}"
                   href="{{ route('ads-leads.index', array_merge(request()->except('page'), ['tab' => 'active'])) }}">
                    <i class="feather-inbox me-1"></i> Active Leads
                    <span class="badge {{ $tab === 'active' ? 'bg-white text-primary' : 'bg-secondary' }} ms-1">
                        {{ $totalActiveCount }}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-btn {{ $tab === 'converted' ? 'active bg-success text-white' : 'btn-light text-dark' }}"
                   href="{{ route('ads-leads.index', array_merge(request()->except('page'), ['tab' => 'converted'])) }}">
                    <i class="feather-check-circle me-1"></i> Converted Leads
                    <span class="badge {{ $tab === 'converted' ? 'bg-white text-success' : 'bg-secondary' }} ms-1">
                        {{ $totalConvertedCount }}
                    </span>
                </a>
            </li>
        </ul>

        <div class="text-muted small">
            Showing {{ $leads->firstItem() ?? 0 }} - {{ $leads->lastItem() ?? 0 }} of {{ $filteredCount }} leads
        </div>
    </div>

    {{-- MAIN TABLE CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="adsLeadTable">
                    <thead>
                        <tr>
                            <th style="width: 50px;" class="text-center">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Website URL</th>
                            <th>Interested Services</th>
                            <th>Monthly Spend</th>
                            <th>Growth Goal</th>
                            <th>Date</th>
                            <th class="text-center" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leads as $lead)
                            <tr id="lead-row-{{ $lead->id }}">
                                <td class="text-center fw-bold text-muted">
                                    {{ $leads->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $lead->name }}</div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $lead->email }}" class="text-decoration-none">
                                        {{ $lead->email }}
                                    </a>
                                </td>
                                <td>
                                    @if($lead->phone_number)
                                        <a href="tel:{{ $lead->phone_number }}" class="text-decoration-none text-muted">
                                            <i class="feather-phone me-1 text-primary"></i>{{ $lead->phone_number }}
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->website_url)
                                        <a href="{{ Str::startsWith($lead->website_url, ['http://', 'https://']) ? $lead->website_url : 'https://' . $lead->website_url }}"
                                           target="_blank" rel="noopener noreferrer"
                                           class="text-decoration-none text-primary url-truncate"
                                           title="{{ $lead->website_url }}">
                                            <i class="feather-external-link me-1"></i>{{ $lead->website_url }}
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->interested_services)
                                        <span class="badge-service" title="{{ $lead->interested_services }}">
                                            {{ $lead->interested_services }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->monthly_spend)
                                        <span class="badge-spend">
                                            {{ $lead->monthly_spend }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lead->growth_goal)
                                        <div class="goal-text" title="{{ $lead->growth_goal }}">
                                            {{ $lead->growth_goal }}
                                        </div>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small text-muted">
                                        {{ $lead->created_at ? $lead->created_at->format('d M, Y') : '—' }}
                                    </div>
                                    <div class="text-muted" style="font-size: 0.72rem;">
                                        {{ $lead->created_at ? $lead->created_at->format('h:i A') : '' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if(!$lead->is_converted)
                                        <form action="{{ route('ads-leads.sendToLead', $lead->id) }}" method="POST"
                                              onsubmit="return confirm('Kya aap is lead ko CRM Main Leads me bhejna chahte hain? Waha se ye normal lead create ho jayegi.');">
                                            @csrf
                                            <button type="submit" class="btn btn-send-lead d-inline-flex align-items-center gap-1">
                                                <i class="feather-user-plus"></i> Send to Lead
                                            </button>
                                        </form>
                                    @else
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                <i class="feather-check me-1"></i> Converted
                                            </span>
                                            @if($lead->converted_lead_id)
                                                <span class="text-muted small mt-1" style="font-size: 0.75rem;">
                                                    Lead #{{ $lead->converted_lead_id }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="feather-inbox display-6 d-block mb-2 text-secondary"></i>
                                        <h6>No {{ $tab === 'converted' ? 'converted' : 'active' }} ads leads found.</h6>
                                        <p class="small mb-0">New leads submitted via the API will show up here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($leads->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-end">
                    {{ $leads->links() }}
                </div>
            </div>
        @endif
    </div>

@endsection
