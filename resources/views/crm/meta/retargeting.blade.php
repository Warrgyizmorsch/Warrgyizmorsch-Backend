@extends('layouts.app')

@section('content')
<style>
    /* Meta Retargeting CRM Native Styles */
    .meta-stat-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        padding: 1.1rem 1.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
    }
    .meta-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
    }
    .meta-stat-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.4rem;
    }
    .meta-stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 0;
    }

    .meta-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .meta-card-header {
        padding: 1rem 1.25rem;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .meta-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .meta-card-body {
        padding: 1.25rem;
    }

    .meta-banner {
        background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
        border: 1px solid #bae6fd;
        border-left: 4px solid #0284c7;
        border-radius: 10px;
        padding: 0.9rem 1.25rem;
        margin-bottom: 1.25rem;
    }

    .audience-table {
        margin-bottom: 0;
        width: 100%;
        font-size: 0.85rem;
    }
    .audience-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.8rem !important;
        text-align: left;
    }
    .audience-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        text-align: left;
    }
    .audience-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .lead-preview-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 0.85rem 1rem;
    }

    @media (max-width: 767px) {
        .meta-stat-value {
            font-size: 1.35rem;
        }
        .page-header-right {
            margin-top: 0.75rem;
            width: 100%;
        }
        .page-header-right .d-flex {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
    }
</style>

<div class="main-content">
    {{-- Page Header --}}
    <div class="page-header mb-3">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><i class="feather-facebook me-2 text-primary"></i>Meta Leads Retargeting</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('modern.leads.meta') }}">Meta Leads</a></li>
                <li class="breadcrumb-item active">Retargeting</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-primary" id="btnSubscribeWebhook">
                    <i class="feather-radio me-1"></i> Subscribe Page Webhook
                </button>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateAudience">
                    <i class="feather-plus me-1"></i> New Custom Audience
                </button>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    <div id="metaAlertContainer"></div>

    {{-- Connection Banner --}}
    <div class="meta-banner mb-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success p-1 px-2"><i class="feather-check-circle me-1"></i>Active</span>
                <span class="fw-bold text-dark small">Page:</span>
                <span class="text-secondary small">{{ $connection['page_name'] ?? 'WarrgyizMorsch' }} ({{ $connection['page_id'] }})</span>
                <span class="text-muted d-none d-md-inline">|</span>
                <span class="fw-bold text-dark small d-none d-md-inline">Ad Account:</span>
                <span class="text-secondary small d-none d-md-inline">{{ $connection['ad_account_name'] ?? 'WarrgyizMorsch Ads' }} ({{ $connection['ad_account_id'] }})</span>
            </div>
            <div>
                <span class="badge bg-white text-dark border small">
                    <i class="feather-shield text-success me-1"></i>System User Token Verified
                </span>
            </div>
        </div>
    </div>

    {{-- Metric Cards --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="meta-stat-card">
                <div class="meta-stat-title">Total CRM Leads</div>
                <div class="meta-stat-value text-dark">{{ number_format($totalLeadsCount) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="meta-stat-card">
                <div class="meta-stat-title">Meta Leads Captured</div>
                <div class="meta-stat-value text-primary">{{ number_format($metaLeadsCount) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="meta-stat-card">
                <div class="meta-stat-title">Custom Audiences</div>
                <div class="meta-stat-value text-success">{{ count($audiences) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="meta-stat-card">
                <div class="meta-stat-title">Retargeting Engine</div>
                <div class="meta-stat-value text-info" style="font-size: 1.35rem;">Ready to Sync</div>
            </div>
        </div>
    </div>

    {{-- Main 2 Column Grid --}}
    <div class="row g-3">
        {{-- Left Column: Sync Leads Form --}}
        <div class="col-12 col-xl-7">
            <div class="meta-card">
                <div class="meta-card-header">
                    <h6 class="meta-card-title">
                        <i class="feather-upload-cloud text-primary"></i> Sync Leads to Meta Custom Audience
                    </h6>
                    <span class="badge bg-light text-primary border" style="font-size: 11px;">SHA-256 Hashing Active</span>
                </div>
                <div class="meta-card-body">
                    <form id="formSyncLeads" data-no-loader="true">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Target Custom Audience <span class="text-danger">*</span></label>
                            <select name="audience_id" id="audience_id" class="form-select form-select-sm" required>
                                <option value="">-- Select Meta Audience --</option>
                                @forelse($audiences as $aud)
                                    <option value="{{ $aud['id'] }}" {{ ($aud['name'] ?? '') === 'WTS Positive Leads' ? 'selected' : '' }}>
                                        {{ $aud['name'] ?? 'Unnamed' }} ({{ $aud['subtype'] ?? 'AUDIENCE' }} | ~{{ number_format($aud['approximate_count_lower_bound'] ?? 0) }} users)
                                    </option>
                                @empty
                                    <option value="" disabled selected>
                                        No Custom Audiences found. Click '+ New Custom Audience' above.
                                    </option>
                                @endforelse
                            </select>
                            <div class="form-text" style="font-size: 11.5px;">Meta Ads Manager me is audience ko retargeting campaign me use karein.</div>
                        </div>

                        <div class="border-top pt-3 mt-3">
                            <span class="text-muted small fw-bold text-uppercase d-block mb-2" style="letter-spacing: 0.5px;">Filter Leads from CRM</span>
                            <div class="row g-2">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">Lead Bucket</label>
                                    <select name="bucket_id" id="filter_bucket_id" class="form-select form-select-sm filter-trigger">
                                        <option value="all">All Buckets</option>
                                        @foreach($buckets as $bucket)
                                            <option value="{{ $bucket->id }}">{{ $bucket->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">Lead Status</label>
                                    <select name="lead_status" id="filter_lead_status" class="form-select form-select-sm filter-trigger">
                                        <option value="all">All Statuses</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">Platform / Source</label>
                                    <select name="platform" id="filter_platform" class="form-select form-select-sm filter-trigger">
                                        <option value="all">All Platforms</option>
                                        <option value="meta">Meta (Facebook & Instagram)</option>
                                        <option value="Website">Website</option>
                                        <option value="google">Google Ads</option>
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">Category</label>
                                    <select name="category_id" id="filter_category_id" class="form-select form-select-sm filter-trigger">
                                        <option value="all">All Categories</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">From Date</label>
                                    <input type="date" name="start_date" id="filter_start_date" class="form-control form-control-sm filter-trigger">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label class="form-label small fw-semibold text-muted mb-1">To Date</label>
                                    <input type="date" name="end_date" id="filter_end_date" class="form-control form-control-sm filter-trigger">
                                </div>
                            </div>
                        </div>

                        {{-- Matching Leads Preview Box --}}
                        <div class="lead-preview-box d-flex align-items-center justify-content-between mt-3">
                            <div>
                                <span class="text-muted small d-block">Eligible Matching Leads:</span>
                                <h6 class="mb-0 fw-bold text-dark fs-5" id="previewMatchingCount">Calculating...</h6>
                            </div>
                            <button type="button" class="btn btn-xs btn-outline-secondary" id="btnRefreshCount">
                                <i class="feather-refresh-cw me-1"></i> Refresh
                            </button>
                        </div>

                        <div class="mt-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-success" id="btnSyncToDataset" title="Conversions API (CAPI) ke through Meta Dataset (WTS-Ali) me leads bhejein">
                                <i class="feather-activity me-1"></i> Send CRM Events to Meta Dataset (CAPI)
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnSubmitSync">
                                <i class="feather-send me-1"></i> Sync Leads to Custom Audience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right Column: Custom Audiences Table --}}
        <div class="col-12 col-xl-5">
            <div class="meta-card">
                <div class="meta-card-header">
                    <h6 class="meta-card-title">
                        <i class="feather-users text-primary"></i> Meta Custom Audiences
                    </h6>
                    <span class="badge bg-light text-muted border">{{ count($audiences) }} List(s)</span>
                </div>
                <div class="p-0">
                    <div class="table-responsive" style="max-height: 480px; overflow-y: auto;">
                        <table class="audience-table">
                            <thead>
                                <tr>
                                    <th>Audience Name</th>
                                    <th>Type</th>
                                    <th class="text-end">Est. Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($audiences as $aud)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark text-truncate" style="max-width: 170px;" title="{{ $aud['name'] ?? '' }}">
                                                {{ $aud['name'] ?? 'Unnamed' }}
                                            </div>
                                            <span class="text-muted" style="font-size: 11px;">ID: {{ $aud['id'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border" style="font-size: 10px;">{{ $aud['subtype'] ?? 'CUSTOM' }}</span>
                                        </td>
                                        <td class="text-end fw-bold text-dark">
                                            {{ number_format($aud['approximate_count_lower_bound'] ?? 0) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted small">
                                            No Custom Audiences found on this Ad Account.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-2 px-3 bg-light border-top text-muted" style="font-size: 11px;">
                    <i class="feather-info me-1"></i> Meta matches hashed phones and emails to Facebook & Instagram profiles.
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Create New Meta Custom Audience --}}
<div class="modal fade" id="modalCreateAudience" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCreateAudience" data-no-loader="true">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Create Meta Custom Audience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Audience Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. WTS UK Intake - Positive Leads" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="e.g. Positive leads interested in UK student visa"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSubmitCreateAudience">Create Audience</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterInputs = document.querySelectorAll('.filter-trigger');
    const previewEl = document.getElementById('previewMatchingCount');
    const alertBox = document.getElementById('metaAlertContainer');

    function hideGlobalLoader() {
        const gl = document.getElementById('globalLoader');
        if (gl) gl.style.display = 'none';
    }

    // Force hide loader immediately on page ready
    hideGlobalLoader();

    function showAlert(type, message) {
        hideGlobalLoader();
        alertBox.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function fetchMatchingCount() {
        previewEl.innerText = 'Calculating...';
        const formData = new FormData(document.getElementById('formSyncLeads'));
        const params = new URLSearchParams(formData);

        fetch("{{ route('meta.retargeting.preview') }}?" + params.toString())
            .then(res => res.json())
            .then(data => {
                hideGlobalLoader();
                if (data.success) {
                    previewEl.innerText = Number(data.count).toLocaleString() + ' leads';
                } else {
                    previewEl.innerText = 'Error';
                }
            })
            .catch(() => {
                hideGlobalLoader();
                previewEl.innerText = 'Error';
            });
    }

    filterInputs.forEach(input => {
        input.addEventListener('change', fetchMatchingCount);
    });
    document.getElementById('btnRefreshCount').addEventListener('click', fetchMatchingCount);
    fetchMatchingCount();

    // Subscribe Webhook Handler
    document.getElementById('btnSubscribeWebhook').addEventListener('click', function () {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Subscribing...';

        fetch("{{ route('meta.retargeting.subscribe') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerHTML = '<i class="feather-radio me-1"></i> Subscribe Page Webhook';
            if (data.success) {
                showAlert('success', data.message);
            } else {
                showAlert('danger', data.message || 'Failed to subscribe webhook');
            }
        })
        .catch(() => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerHTML = '<i class="feather-radio me-1"></i> Subscribe Page Webhook';
            showAlert('danger', 'Error connecting to server.');
        });
    });

    // Create New Custom Audience Handler
    document.getElementById('formCreateAudience').addEventListener('submit', function (e) {
        e.preventDefault();
        hideGlobalLoader();
        const btn = document.getElementById('btnSubmitCreateAudience');
        btn.disabled = true;
        btn.innerText = 'Creating...';

        const formData = new FormData(this);

        fetch("{{ route('meta.retargeting.create_audience') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerText = 'Create Audience';
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('modalCreateAudience')).hide();
                showAlert('success', data.message);
                setTimeout(() => window.location.reload(), 1200);
            } else {
                showAlert('danger', data.message || 'Error creating audience');
            }
        })
        .catch(() => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerText = 'Create Audience';
            showAlert('danger', 'Error connecting to server.');
        });
    });

    // Sync Leads to Meta Audience Handler
    document.getElementById('formSyncLeads').addEventListener('submit', function (e) {
        e.preventDefault();
        hideGlobalLoader();
        const audSelect = document.getElementById('audience_id');
        if (!audSelect.value) {
            alert('Please select a Target Custom Audience first.');
            return;
        }

        const btn = document.getElementById('btnSubmitSync');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Hashing & Uploading to Meta...';

        const formData = new FormData(this);

        fetch("{{ route('meta.retargeting.sync') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerHTML = '<i class="feather-send me-1"></i> Sync Leads to Meta Custom Audience';
            if (data.success) {
                showAlert('success', data.message);
                setTimeout(() => window.location.reload(), 2000);
            } else {
                showAlert('danger', data.message || 'Error syncing leads.');
            }
        })
        .catch(() => {
            hideGlobalLoader();
            btn.disabled = false;
            btn.innerHTML = '<i class="feather-send me-1"></i> Sync Leads to Meta Custom Audience';
            showAlert('danger', 'Server error while syncing leads.');
        });
    });

    // Sync Leads to Meta Dataset (Events Manager / CAPI)
    const btnSyncToDataset = document.getElementById('btnSyncToDataset');
    if (btnSyncToDataset) {
        btnSyncToDataset.addEventListener('click', function(e) {
            e.preventDefault();
            hideGlobalLoader();

            if (!confirm('Kya aap eligible CRM leads ko Meta Dataset (WTS-Ali) me Conversions API ke through bhejna chahte hain? Isse Meta Events Manager me live activity connect ho jayegi.')) {
                return;
            }

            const originalHtml = btnSyncToDataset.innerHTML;
            btnSyncToDataset.disabled = true;
            btnSyncToDataset.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Sending to Meta Dataset (CAPI)...';

            const formSync = document.getElementById('formSyncLeads');
            const formData = new FormData(formSync);

            fetch("{{ route('meta.retargeting.sync_dataset') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                hideGlobalLoader();
                btnSyncToDataset.disabled = false;
                btnSyncToDataset.innerHTML = originalHtml;
                if (data.success) {
                    showAlert('success', data.message);
                } else {
                    showAlert('danger', data.message || 'Error sending events to Meta Dataset.');
                }
            })
            .catch(() => {
                hideGlobalLoader();
                btnSyncToDataset.disabled = false;
                btnSyncToDataset.innerHTML = originalHtml;
                showAlert('danger', 'Server error while sending events.');
            });
        });
    }
});
</script>
@endsection
