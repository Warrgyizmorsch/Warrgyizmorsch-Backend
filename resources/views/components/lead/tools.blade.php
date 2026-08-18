@props(['buckets','filterBucket', 'totalLeadsCount', 'filteredLeadCount', 'sources', 'owners','categories', 'title', 'showViewSwitcher' => true])

<div class="page-header">
    <div class="page-header-left d-flex align-items-center">

        <div class="page-header-title">
            <h5 class="m-b-10">{{ $title ?? 'Leads' }}</h5>
        </div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">{{ $title ?? 'Leads' }}</li>
        </ul>

    </div>

<style>
    .view-toggle-btn {
        border: none !important;
        border-radius: 4px !important;
        transition: all 0.2s ease !important;
        color: #64748b !important;
        background: transparent !important;
    }
    .view-toggle-btn.active-view {
        background-color: #ffffff !important;
        color: #006FC9 !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
    }
    .view-toggle-btn:hover:not(.active-view) {
        color: #1e293b !important;
        background-color: rgba(255,255,255,0.6) !important;
    }
</style>

    <div class="page-header-right ms-auto">
        <div class="d-flex align-items-center gap-2">

            @if($showViewSwitcher)
            {{-- View Switcher (List / Pipeline) --}}
            <div class="btn-group p-1 bg-light rounded-2 border me-1" role="group" aria-label="View Switcher" style="background: #f1f5f9 !important;">
                <a href="{{ route('modern.leads.index', array_merge(request()->except('view', 'page'), ['view' => 'list'])) }}"
                    class="btn btn-sm px-2.5 py-1 text-muted d-flex align-items-center gap-1 view-toggle-btn {{ request('view') !== 'pipeline' ? 'active-view' : '' }}"
                    id="btn-list-view" 
                    title="List View">
                    <i class="feather-list fs-14"></i>
                    <span class="d-none d-sm-inline fs-12 fw-semibold">List View</span>
                </a>
                <a href="{{ route('modern.leads.index', array_merge(request()->except('view', 'page'), ['view' => 'pipeline'])) }}"
                    class="btn btn-sm px-2.5 py-1 text-muted d-flex align-items-center gap-1 view-toggle-btn {{ request('view') === 'pipeline' ? 'active-view' : '' }}"
                    id="btn-pipeline-view" 
                    title="Pipeline View">
                    <i class="feather-columns fs-14"></i>
                    <span class="d-none d-sm-inline fs-12 fw-semibold">Pipeline View</span>
                </a>
            </div>
            @endif

            {{-- Collapse Toggle --}}
            <button class="btn btn-icon btn-light-brand"
                data-bs-toggle="collapse"
                data-bs-target="#collapseOne">
                <i class="feather-bar-chart"></i>
            </button>

            {{-- Bucket Dropdown --}}
            <div class="dropdown">
                <button class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown">
                    <i class="feather-filter"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end">

                    <a href="{{ route('modern.leads.index', request()->except('bucket_id', 'converted')) }}"
                        class="dropdown-item {{ !request('bucket_id') && !request('converted') ? 'active' : '' }}">
                        All Buckets
                    </a>

                    <a href="{{ route('modern.leads.index', array_merge(request()->query(), ['converted' => 1, 'bucket_id' => ''])) }}"
                        class="dropdown-item {{ request('converted') == 1 ? 'active' : '' }}">
                        Converted
                    </a>

                    @foreach($buckets as $bucket)
                    <a href="{{ route('modern.leads.index', array_merge(request()->query(), ['bucket_id' => $bucket->id, 'converted' => '', 'lead_status' => ''])) }}"
                        class="dropdown-item {{ request('bucket_id') == $bucket->id ? 'active' : '' }}">
                        {{ $bucket->name }}
                    </a>
                    @endforeach

                </div>
            </div>

            {{-- Create --}}
            <button class="btn btn-icon btn-light-brand"
                onclick="openCreateModal()">
                <i class="feather-plus"></i>
            </button>


            {{-- Import --}}
            <div class="dropdown d-flex align-items-center">
                <button class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown">
                    <i class="feather-paperclip"></i>
                </button>

                <span id="import-spinner" class="spinner-border spinner-border-sm text-primary ms-2 d-none"></span>

                <div class="dropdown-menu dropdown-menu-end">
                    <!-- ✅ EXPORT -->
                    <a href="{{ route('leads.export', request()->query()) }}" class="dropdown-item">
                        <i class="feather-download me-2"></i> Export Excel
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('lead.sample') }}" class="dropdown-item">Download Sample</a>
                    
                    <div class="dropdown-divider"></div>
                    <!-- <label for="importFile" class="dropdown-item">Import</label> -->
                    <a href="javascript:void(0)" onclick="openCustomImportModal()" class="dropdown-item fw-bold text-primary">
                        <i class="feather-upload me-2"></i> Custom Import (Mapping)
                    </a>

                    <a href="javascript:void(0)" onclick="openCompareExcelModal()" class="dropdown-item fw-bold text-info">
                        <i class="feather-check-square me-2"></i> Compare Excel vs Database
                    </a>

                    <label for="importFile" class="dropdown-item text-muted">Auto Import (Direct)</label>
                    <input type="file" id="importFile" class="d-none" accept=".csv,.xlsx,.xls">
                </div>
            </div>

        </div>
    </div>
</div>

@php
    $actualFilterQueryParams = request()->except('bucket_id', 'lead_status', 'per_page', 'page', 'view');
    $hasActiveFilters = !empty(array_filter($actualFilterQueryParams, fn($val) => $val !== null && $val !== ''));
@endphp
<div id="collapseOne" class="collapse mt-3 {{ $hasActiveFilters ? 'show' : '' }}">
    <div class="card card-body shadow-sm">

        <form method="GET" action="{{ route('modern.leads.index') }}">

            {{-- ✅ Preserve bucket --}}
            @if(request('bucket_id'))
            <input type="hidden" name="bucket_id" value="{{ request('bucket_id') }}">
            @endif

            @if(request('lead_status'))
            <input type="hidden"
                name="lead_status"
                value="{{ request('lead_status') }}">
            @endif

            <div class="row g-3">

                <div class="col-12 col-md-3 position-relative">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="feather-search text-muted" id="search-icon"></i>
                            <span class="spinner-border spinner-border-sm text-primary d-none" id="search-spinner" role="status" style="width: 14px; height: 14px;"></span>
                        </span>
                        <input type="text" name="search" id="lead-live-search" class="form-control border-start-0"
                            placeholder="Search Name, Email, Phone..."
                            value="{{ request('search') }}" autocomplete="off">
                    </div>
                    <div id="search-suggestions-box" class="dropdown-menu shadow-lg w-100 mt-1 overflow-auto" style="max-height: 320px; display: none; z-index: 1050; border-radius: 8px;"></div>
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="date" name="from" class="form-control"
                        value="{{ request('from') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="date" name="to" class="form-control"
                        value="{{ request('to') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <select name="source" class="form-select">
                        <option value="">All Sources</option>
                        @foreach($sources ?? [] as $source)
                        <option value="{{ $source }}"
                            {{ request('source') == $source ? 'selected' : '' }}>
                            {{ $source }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-none d-md-block">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach($filterBucket as $bucket)
                        @if($bucket->children)
                        <optgroup label="{{ $bucket->name }}">
                            @foreach($bucket->children as $child)
                            <option value="{{ $child->name }}"
                                {{ request('status') == $child->name ? 'selected' : '' }}>
                                {{ $child->name }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2 d-block d-md-block">
                    <select name="lead_engagement_status" class="form-select">
                        <option value="">All Engagement</option>
                        <option value="hot" {{ request('lead_engagement_status') == 'hot' ? 'selected' : '' }}>Hot</option>
                        <option value="warm" {{ request('lead_engagement_status') == 'warm' ? 'selected' : '' }}>Warm</option>
                        <option value="cold" {{ request('lead_engagement_status') == 'cold' ? 'selected' : '' }}>Cold</option>
                        <option value="dead" {{ request('lead_engagement_status') == 'dead' ? 'selected' : '' }}>Dead</option>
                    </select>
                </div>


                <div class="col-md-3 d-none d-md-block">
                    <select name="owner_id" class="form-select">
                        <option value="">All Owners</option>
                        <option value="null" {{ old('owner_id', request('owner_id')) == 'null' ? 'selected' : '' }}>Unknown</option>
                        @foreach($owners ?? [] as $owner)
                        <option value="{{ $owner->id }}"
                            {{ request('owner_id') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-none d-md-block">
                    <input type="text" name="company" class="form-control"
                        placeholder="Search Company..."
                        value="{{ request('company') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="text" name="campaign_name" class="form-control"
                        placeholder="Campaign"
                        value="{{ request('campaign_name') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="text" name="adset_name" class="form-control"
                        placeholder="Adset"
                        value="{{ request('adset_name') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="text" name="ad_name" class="form-control"
                        placeholder="Ad Name"
                        value="{{ request('ad_name') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>

                        @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="col-12 col-md-6 p-2 d-flex gap-2 flex-wrap">

                    <button type="submit" name="lead_engagement_status" value=""
                        class="btn btn-sm  {{ request('lead_engagement_status') == '' ? 'btn-primary' : 'btn-light' }}">
                        All
                    </button>

                    <button type="submit" name="lead_engagement_status" value="hot"
                        class="btn btn-sm {{ request('lead_engagement_status') == 'hot' ? 'btn-danger' : 'btn-light' }}">
                         Hot
                    </button>

                    <button type="submit" name="lead_engagement_status" value="warm"
                        class="btn btn-sm {{ request('lead_engagement_status') == 'warm' ? 'btn-warning' : 'btn-light' }}">
                         Warm
                    </button>

                    <button type="submit" name="lead_engagement_status" value="cold"
                        class="btn btn-sm {{ request('lead_engagement_status') == 'cold' ? 'btn-info' : 'btn-light' }}">
                         Cold
                    </button>

                    <button type="submit" name="lead_engagement_status" value="dead"
                        class="btn btn-sm {{ request('lead_engagement_status') == 'dead' ? 'btn-dark' : 'btn-light' }}">
                         Dead
                    </button>

                </div> -->


            </div>

            {{-- ✅ BUTTONS SAME LINE --}}
            <div class="d-flex justify-content-start gap-2 mt-4 border-top pt-3">

                <a href="{{ route('modern.leads.index') }}"
                    class="btn btn-light border text-danger">
                    Reset
                </a>

                <button type="submit" class="btn btn-primary">
                    Filter
                </button>

            </div>

        </form>

    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- IMPORT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fileInput = document.getElementById('importFile');
        const spinner = document.getElementById('import-spinner');

        fileInput.addEventListener('change', function() {

            if (!this.files.length) return;

            const formData = new FormData();
            formData.append('file', this.files[0]);

            spinner.classList.remove('d-none');

            fetch("{{ route('lead.import') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status === "success") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        const jobId = data.job_id;

                        const interval = setInterval(() => {
                            fetch(`/lead-import-status/${jobId}`)
                                .then(res => res.json())
                                .then(resp => {
                                    if (resp.status === 'success') {
                                        const job = resp.data;

                                        if (job.job_status === 'completed' || job.job_status === 'failed') {
                                            clearInterval(interval);
                                            spinner.classList.add('d-none');
                                        }
                                    }
                                });
                        }, 2000);

                    } else {
                        spinner.classList.add('d-none');
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(() => {
                    spinner.classList.add('d-none');
                    Swal.fire('Error', 'Something went wrong', 'error');
                });

        });

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterCollapse = document.getElementById('collapseOne');
    if (filterCollapse) {
        const savedState = localStorage.getItem('lead_filter_collapse_state');
        if (savedState === 'open') {
            filterCollapse.classList.add('show');
        } else if (savedState === 'closed' && !{{ $hasActiveFilters ? 'true' : 'false' }}) {
            filterCollapse.classList.remove('show');
        }

        filterCollapse.addEventListener('shown.bs.collapse', function () {
            localStorage.setItem('lead_filter_collapse_state', 'open');
        });
        filterCollapse.addEventListener('hidden.bs.collapse', function () {
            localStorage.setItem('lead_filter_collapse_state', 'closed');
        });
    }

    const searchInput = document.getElementById('lead-live-search');
    const suggestionsBox = document.getElementById('search-suggestions-box');
    const searchIcon = document.getElementById('search-icon');
    const searchSpinner = document.getElementById('search-spinner');

    if (!searchInput || !suggestionsBox) return;

    let debounceTimer;
    let selectedIndex = -1;

    function showSpinner() {
        if (searchIcon) searchIcon.classList.add('d-none');
        if (searchSpinner) searchSpinner.classList.remove('d-none');
    }

    function hideSpinner() {
        if (searchSpinner) searchSpinner.classList.add('d-none');
        if (searchIcon) searchIcon.classList.remove('d-none');
    }

    function getItems() {
        return suggestionsBox.querySelectorAll('.search-suggestion-item');
    }

    function updateActiveItem() {
        const items = getItems();
        items.forEach((item, idx) => {
            if (idx === selectedIndex) {
                item.classList.add('active');
                item.style.backgroundColor = '#f1f5f9';
                item.style.borderLeft = '4px solid #006FC9';
                item.scrollIntoView({ block: 'nearest' });
            } else {
                item.classList.remove('active');
                item.style.backgroundColor = '';
                item.style.borderLeft = '';
            }
        });
    }

    searchInput.addEventListener('keydown', function(e) {
        if (suggestionsBox.style.display === 'none') return;
        const items = getItems();
        if (!items || items.length === 0) return;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = (selectedIndex + 1) < items.length ? selectedIndex + 1 : 0;
            updateActiveItem();
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = (selectedIndex - 1) >= 0 ? selectedIndex - 1 : items.length - 1;
            updateActiveItem();
        } else if (e.key === 'Enter') {
            if (selectedIndex >= 0 && items[selectedIndex]) {
                e.preventDefault();
                items[selectedIndex].click();
            }
        } else if (e.key === 'Escape') {
            suggestionsBox.style.display = 'none';
            selectedIndex = -1;
        }
    });

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        selectedIndex = -1;
        const query = this.value.trim();

        if (query.length < 1) {
            hideSpinner();
            suggestionsBox.innerHTML = '';
            suggestionsBox.style.display = 'none';
            return;
        }

        showSpinner();
        suggestionsBox.innerHTML = `
            <div class="dropdown-item text-muted small p-2.5 text-center">
                <span class="spinner-border spinner-border-sm me-2 text-primary" role="status" style="width: 13px; height: 13px;"></span> Searching matching leads...
            </div>`;
        suggestionsBox.style.display = 'block';

        debounceTimer = setTimeout(() => {
            fetch(`{{ route('modern.leads.search.suggestions') }}?search=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    hideSpinner();
                    selectedIndex = -1;
                    if (!data || data.length === 0) {
                        suggestionsBox.innerHTML = '<div class="dropdown-item text-muted small p-2.5"><i class="feather-info me-1 text-warning"></i> No matching leads found</div>';
                        suggestionsBox.style.display = 'block';
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        const selectVal = (item.contact_no && item.contact_no !== 'N/A' && item.contact_no.trim() !== '') 
                            ? item.contact_no 
                            : ((item.email && item.email.trim() !== '') ? item.email : item.name);

                        html += `
                            <a href="javascript:void(0);" class="dropdown-item py-2 px-3 border-bottom search-suggestion-item text-decoration-none" data-value="${selectVal}">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong class="text-dark fs-13">${item.name}</strong>
                                    <span class="badge bg-soft-primary text-primary fs-11">${item.status}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-muted small fs-11">
                                    <span><i class="feather-phone me-1"></i>${item.contact_no}</span>
                                    <span>${item.email ? '<i class="feather-mail me-1"></i>' + item.email : ''}</span>
                                </div>
                                ${item.company ? `<div class="text-secondary fs-11 mt-1"><i class="feather-briefcase me-1"></i>${item.company}</div>` : ''}
                            </a>
                        `;
                    });

                    suggestionsBox.innerHTML = html;
                    suggestionsBox.style.display = 'block';

                    suggestionsBox.querySelectorAll('.search-suggestion-item').forEach(el => {
                        el.addEventListener('click', function() {
                            searchInput.value = this.getAttribute('data-value');
                            suggestionsBox.style.display = 'none';
                            selectedIndex = -1;
                            const form = searchInput.closest('form');
                            if (form) form.submit();
                        });
                    });
                })
                .catch(err => {
                    hideSpinner();
                    selectedIndex = -1;
                    suggestionsBox.innerHTML = '<div class="dropdown-item text-muted small p-2.5"><i class="feather-info me-1 text-warning"></i> No matching leads found</div>';
                    suggestionsBox.style.display = 'block';
                    console.error('Search error:', err);
                });
        }, 250);
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
            selectedIndex = -1;
        }
    });
});
</script>
