@props(['buckets','filterBucket', 'totalLeadsCount', 'filteredLeadCount', 'sources', 'owners','categories', 'title', 'showViewSwitcher' => true])

@php
    $isDealRoute = request()->is('created-deals*') || request()->routeIs('created.deals.*');
    $btnLabel = $isDealRoute ? 'New deal' : 'New lead';
@endphp

<style>
    /* Monday CRM Top Header Styling */
    .monday-header-wrapper {
        background: #ffffff;
        border-bottom: 1px solid #e6e9ef;
        padding: 18px 24px 0 24px;
        margin-bottom: 16px;
    }
    .monday-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .monday-title-text {
        font-size: 24px;
        font-weight: 700;
        color: #323338;
        letter-spacing: -0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }
    .monday-title-chevron {
        font-size: 16px;
        color: #676879;
        cursor: pointer;
    }
    .monday-top-tabs {
        display: flex;
        align-items: center;
        gap: 4px;
        border-bottom: 1px solid #d0d4e4;
        margin-bottom: 12px;
    }
    .monday-tab-btn {
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        color: #676879;
        text-decoration: none !important;
        border-bottom: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
        border-radius: 4px 4px 0 0;
    }
    .monday-tab-btn:hover {
        color: #323338;
        background: #f5f6f8;
    }
    .monday-tab-btn.is-active {
        color: #0073ea;
        font-weight: 600;
        border-bottom-color: #0073ea;
        background: transparent;
    }
    .monday-tab-dots {
        font-size: 11px;
        opacity: 0.6;
        margin-left: 2px;
    }

    /* Monday CRM Toolbar */
    .monday-toolbar-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding-bottom: 14px;
    }
    .monday-primary-btn {
        background-color: #0073ea;
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 7px 16px;
        border-radius: 4px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 1px 3px rgba(0, 115, 234, 0.2);
        transition: background-color 0.15s ease, box-shadow 0.15s ease;
    }
    .monday-primary-btn:hover {
        background-color: #0060b9;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0, 115, 234, 0.35);
    }
    .monday-tool-btn {
        background: #ffffff;
        color: #676879;
        font-size: 13px;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 4px;
        border: 1px solid #d0d4e4;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
        cursor: pointer;
        text-decoration: none !important;
    }
    .monday-tool-btn:hover {
        background: #f5f6f8;
        color: #323338;
        border-color: #c3c6d4;
    }
    .monday-tool-btn.is-active {
        background: #e5f4ff;
        color: #0073ea;
        border-color: #0073ea;
    }
    .monday-search-box {
        position: relative;
        width: 220px;
    }
    .monday-search-box input {
        width: 100%;
        font-size: 13px;
        padding: 6px 10px 6px 30px;
        border-radius: 4px;
        border: 1px solid #d0d4e4;
        background: #ffffff;
        color: #323338;
        outline: none;
        transition: all 0.15s ease;
    }
    .monday-search-box input:focus {
        border-color: #0073ea;
        box-shadow: 0 0 0 2px rgba(0, 115, 234, 0.2);
    }
    .monday-search-box .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #676879;
        font-size: 13px;
        pointer-events: none;
    }
</style>

<div class="monday-header-wrapper">
    {{-- 1. Main Title & Right Tools --}}
    <div class="monday-title-row">
        <div class="d-flex align-items-center gap-2">
            <h1 class="monday-title-text">
                {{ $title ?? 'Leads' }}
                <i class="feather-chevron-down monday-title-chevron"></i>
            </h1>
        </div>

        <div class="d-flex align-items-center gap-2">
            {{-- Export / Import dropdown --}}
            <div class="dropdown">
                <button class="monday-tool-btn" data-bs-toggle="dropdown" aria-expanded="false" title="Export & Import Options">
                    <i class="feather-download"></i>
                    <span>Export / Import</span>
                    <i class="feather-chevron-down" style="font-size: 11px;"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 py-2" style="border-radius: 8px; min-width: 210px;">
                    <a href="{{ route('leads.export', request()->query()) }}" class="dropdown-item py-1.5 fs-13 d-flex align-items-center gap-2">
                        <i class="feather-download text-success"></i> Export to Excel
                    </a>
                    <div class="dropdown-divider my-1"></div>
                    <a href="javascript:void(0)" onclick="openCustomImportModal()" class="dropdown-item py-1.5 fs-13 d-flex align-items-center gap-2 fw-semibold text-primary">
                        <i class="feather-upload"></i> Custom Import (Mapping)
                    </a>
                    @unless(request()->routeIs('leads.table.*'))
                    <a href="{{ route('lead.sample') }}" class="dropdown-item py-1.5 fs-13 text-muted">
                        <i class="feather-file-text me-1"></i> Download Sample Excel
                    </a>
                    <a href="javascript:void(0)" onclick="openCompareExcelModal()" class="dropdown-item py-1.5 fs-13 text-info">
                        <i class="feather-check-square me-1"></i> Compare Excel vs DB
                    </a>
                    @endunless
                </div>
            </div>

            {{-- Create Button (Top Right shortcut as well) - Commented out for Created Deals --}}
            @unless($isDealRoute)
            <button class="monday-primary-btn" onclick="openCreateModal()" title="Add {{ $btnLabel }}">
                <i class="feather-plus"></i>
                <span class="d-none d-sm-inline">{{ $btnLabel }}</span>
            </button>
            @endunless
        </div>
    </div>

    {{-- 2. Monday View Tabs (Main Table / Pipeline View) --}}
    @if($showViewSwitcher)
    @php
        if ($isDealRoute) {
            $listRoute = route('created.deals.index', request()->query());
            $pipelineRoute = route('created.deals.pipeline', request()->query());
            $isPipelineActive = request()->is('created-deals/pipeline*') || request()->routeIs('created.deals.pipeline');
        } elseif (request()->is('new-leads-table*') || request()->routeIs('leads.table.*')) {
            $listRoute = route('leads.table.index', request()->query());
            $pipelineRoute = route('leads.table.pipeline', request()->query());
            $isPipelineActive = request()->is('new-leads-table/pipeline*') || request()->routeIs('leads.table.pipeline');
        } else {
            $listRoute = route('modern.leads.index', array_merge(request()->except('view', 'page'), ['view' => 'list']));
            $pipelineRoute = route('modern.leads.index', array_merge(request()->except('view', 'page'), ['view' => 'pipeline']));
            $isPipelineActive = request('view') === 'pipeline';
        }
    @endphp
    <div class="monday-top-tabs">
        <a href="{{ $listRoute }}" class="monday-tab-btn {{ !$isPipelineActive ? 'is-active' : '' }}">
            <i class="feather-table"></i>
            <span>Main table</span>
            <span class="monday-tab-dots">•••</span>
        </a>
        <a href="{{ $pipelineRoute }}" class="monday-tab-btn {{ $isPipelineActive ? 'is-active' : '' }}">
            <i class="feather-trello"></i>
            <span>Pipeline view</span>
        </a>
        <a href="{{ route('events.index') }}" class="monday-tab-btn {{ request()->routeIs('events.*') ? 'is-active' : '' }}">
            <i class="feather-calendar"></i>
            <span>Upcoming Events</span>
        </a>
    </div>
    @endif

    {{-- 3. Monday Action Bar (Search, Person, Filter, Bucket) --}}
    <div class="monday-toolbar-row">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            {{-- Blue Primary New Button - Commented out for Created Deals --}}
            @unless($isDealRoute)
            <button type="button" class="monday-primary-btn" onclick="openCreateModal()">
                <i class="feather-plus"></i>
                <span>{{ $btnLabel }}</span>
            </button>
            @endunless

            {{-- Live Search Input (Triggers main form search) --}}
            <div class="monday-search-box">
                <i class="feather-search search-icon"></i>
                <input type="text" placeholder="Search this board" value="{{ request('search') }}" onkeydown="if(event.key==='Enter'){ const f=document.querySelector('.lead-filter-form'); if(f){ const inp=f.querySelector('#lead-live-search'); if(inp){ inp.value=this.value; f.submit(); } } }">
            </div>

            {{-- Filter Toggle Button (opens advanced filters collapse) --}}
            <button class="monday-tool-btn {{ !empty($hasActiveFilters) ? 'is-active' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <i class="feather-filter"></i>
                <span>Filter</span>
                @if(!empty($hasActiveFilters))
                    <span class="badge bg-primary text-white rounded-pill px-1.5 py-0 fs-10 ms-1">Active</span>
                @endif
            </button>

            @php
                if (request()->routeIs('created.deals.*')) {
                    $bucketBaseRoute = 'created.deals.index';
                } elseif (request()->routeIs('leads.table.*')) {
                    $bucketBaseRoute = 'leads.table.index';
                } else {
                    $bucketBaseRoute = 'modern.leads.index';
                }
            @endphp
            {{-- Buckets Filter Dropdown --}}
            <div class="dropdown">
                <button class="monday-tool-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="feather-layers"></i>
                    <span>{{ request('bucket_id') ? (optional($buckets->firstWhere('id', request('bucket_id')))->name ?? 'Bucket') : 'All Buckets' }}</span>
                </button>
                <div class="dropdown-menu shadow-lg border-0 py-2 fs-13" style="max-height: 280px; overflow-y: auto; border-radius: 8px;">
                    <a href="{{ route($bucketBaseRoute, request()->except('bucket_id', 'converted')) }}"
                        class="dropdown-item py-1.5 {{ !request('bucket_id') && !request('converted') ? 'active' : '' }}">
                        All Buckets
                    </a>
                    @foreach($buckets as $bucket)
                    <a href="{{ route($bucketBaseRoute, array_merge(request()->query(), ['bucket_id' => $bucket->id, 'converted' => '', 'lead_status' => ''])) }}"
                        class="dropdown-item py-1.5 {{ request('bucket_id') == $bucket->id ? 'active' : '' }}">
                        {{ $bucket->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right tools --}}
        <div class="d-flex align-items-center gap-2">
            <span class="fs-12 text-muted fw-semibold d-none d-md-inline">
                Total: <strong class="text-dark">{{ $totalLeadsCount ?? 0 }}</strong>
            </span>
        </div>
    </div>
</div>

@php
    if (request()->routeIs('leads.table.pipeline*')) {
        $filterPageRoute = 'leads.table.pipeline';
    } elseif (request()->routeIs('leads.table.*')) {
        $filterPageRoute = 'leads.table.index';
    } elseif (request()->routeIs('created.deals.*')) {
        $filterPageRoute = 'created.deals.index';
    } else {
        $filterPageRoute = 'modern.leads.index';
    }

    $ignoredFilterParams = ['bucket_id', 'lead_status', 'per_page', 'page', 'view'];
    if (request()->routeIs('leads.table.*')) {
        $ignoredFilterParams[] = 'lead_engagement_status';
    }
    $actualFilterQueryParams = request()->except($ignoredFilterParams);
    $hasActiveFilters = !empty(array_filter($actualFilterQueryParams, fn($val) => $val !== null && $val !== ''));

    $hasActiveMoreFilters = !empty(request('company')) || 
                            !empty(request('campaign_name')) || 
                            !empty(request('adset_name')) || 
                            !empty(request('ad_name')) || 
                            !empty(request('category_id')) ||
                            (!request()->routeIs('leads.table.*') && !empty(request('lead_engagement_status')));
@endphp
<div id="collapseOne" class="collapse mt-3 {{ $hasActiveFilters ? 'show' : '' }}">
    <div class="card card-body shadow-sm border-0" style="border-radius: 12px; border: 1px solid #e2e8f0 !important; background: #ffffff;">

        <form method="GET" action="{{ route($filterPageRoute) }}" class="lead-filter-form">

            {{-- ✅ Preserve bucket --}}
            @if(request('bucket_id'))
            <input type="hidden" name="bucket_id" value="{{ request('bucket_id') }}">
            @endif

            @if(request('lead_status'))
            <input type="hidden"
                name="lead_status"
                value="{{ request('lead_status') }}">
            @endif

            {{-- Hidden input for exact selected User ID --}}
            <input type="hidden" name="search_uid" id="search-uid-input" value="{{ request('search_uid') }}">

            {{-- 🌟 MAIN FILTERS (Always Visible) --}}
            <div class="row g-2.5 align-items-center">
                {{-- 1. Search Name, Email, Phone --}}
                <div class="col-12 col-md-4 col-xl-3 position-relative">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="feather-search fs-14" id="search-icon"></i>
                            <span class="spinner-border spinner-border-sm text-primary d-none" id="search-spinner" role="status" style="width: 14px; height: 14px;"></span>
                        </span>
                        <input type="text" name="search" id="lead-live-search" class="form-control border-start-0 ps-1"
                            placeholder="Search Name, Email, Phone..."
                            value="{{ request('search') }}" autocomplete="off">
                    </div>
                    <div id="search-suggestions-box" class="dropdown-menu shadow-lg w-100 mt-1 overflow-auto" style="max-height: 320px; display: none; z-index: 1050; border-radius: 8px;"></div>
                </div>

                {{-- 2. Date From --}}
                <div class="col-6 col-md-2 col-xl-2">
                    <input type="date" name="from" class="form-control"
                        title="From Date"
                        value="{{ request('from') }}">
                </div>

                {{-- 3. Date To --}}
                <div class="col-6 col-md-2 col-xl-2">
                    <input type="date" name="to" class="form-control"
                        title="To Date"
                        value="{{ request('to') }}">
                </div>

                {{-- 4. All Sources --}}
                <div class="col-12 col-sm-6 col-md-2 col-xl-2">
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

                {{-- 5. All Owners --}}
                <div class="col-12 col-sm-6 col-md-2 col-xl-3">
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
            </div>

            {{-- 🌟 MORE FILTERS (Hidden by default, shown on Load More) --}}
            <div class="collapse {{ $hasActiveMoreFilters ? 'show' : '' }} mt-3 pt-3 border-top" id="moreFiltersCollapse">
                <div class="row g-2.5 align-items-center">
                    {{-- Search Company --}}
                    <div class="col-12 col-sm-6 col-md-3">
                        <input type="text" name="company" class="form-control"
                            placeholder="Search Company..."
                            value="{{ request('company') }}">
                    </div>

                    {{-- Campaign --}}
                    <div class="col-12 col-sm-6 col-md-2">
                        <input type="text" name="campaign_name" class="form-control"
                            placeholder="Campaign"
                            value="{{ request('campaign_name') }}">
                    </div>

                    {{-- Adset --}}
                    <div class="col-12 col-sm-6 col-md-2">
                        <input type="text" name="adset_name" class="form-control"
                            placeholder="Adset"
                            value="{{ request('adset_name') }}">
                    </div>

                    {{-- Ad Name --}}
                    <div class="col-12 col-sm-6 col-md-2">
                        <input type="text" name="ad_name" class="form-control"
                            placeholder="Ad Name"
                            value="{{ request('ad_name') }}">
                    </div>

                    {{-- All Categories --}}
                    <div class="col-12 col-sm-6 col-md-3">
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

                    {{-- Engagement Status (for views that support it) --}}
                    @unless(request()->routeIs('leads.table.*'))
                    <div class="col-12 col-sm-6 col-md-2 mt-2">
                        <select name="lead_engagement_status" class="form-select">
                            <option value="">All Engagement</option>
                            <option value="hot" {{ request('lead_engagement_status') == 'hot' ? 'selected' : '' }}>Hot</option>
                            <option value="warm" {{ request('lead_engagement_status') == 'warm' ? 'selected' : '' }}>Warm</option>
                            <option value="cold" {{ request('lead_engagement_status') == 'cold' ? 'selected' : '' }}>Cold</option>
                            <option value="dead" {{ request('lead_engagement_status') == 'dead' ? 'selected' : '' }}>Dead</option>
                        </select>
                    </div>
                    @endunless
                </div>
            </div>

            {{-- 🌟 ACTION BUTTONS (Filter, Reset, Load More) --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3 pt-3 border-top">
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary px-3 py-1.5 d-inline-flex align-items-center gap-1.5 shadow-sm fw-medium fs-13">
                        <i class="feather-filter fs-14"></i>
                        <span>Filter</span>
                    </button>

                    <a href="{{ route($filterPageRoute) }}"
                        class="btn btn-light border px-3 py-1.5 d-inline-flex align-items-center gap-1.5 text-danger fw-medium fs-13">
                        <i class="feather-rotate-ccw fs-14"></i>
                        <span>Reset</span>
                    </a>
                </div>

                <div>
                    <button type="button" 
                        class="btn btn-light border px-3 py-1.5 d-inline-flex align-items-center gap-2 text-dark shadow-sm rounded-2" 
                        id="moreFiltersToggleBtn" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#moreFiltersCollapse" 
                        aria-expanded="{{ $hasActiveMoreFilters ? 'true' : 'false' }}">
                        <i class="feather-{{ $hasActiveMoreFilters ? 'minus-circle' : 'plus-circle' }} text-primary fs-14" id="moreFiltersIcon"></i>
                        <span id="moreFiltersBtnText" class="fw-semibold fs-13">{{ $hasActiveMoreFilters ? 'Show Less' : 'Load More' }}</span>
                        @if($hasActiveMoreFilters)
                            <span class="badge bg-primary text-white rounded-pill px-2 py-0.5 fs-10">Active</span>
                        @endif
                    </button>
                </div>
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

    // Toggle "Load More" / "Show Less" state
    const moreFiltersCollapse = document.getElementById('moreFiltersCollapse');
    const moreFiltersBtnText = document.getElementById('moreFiltersBtnText');
    const moreFiltersIcon = document.getElementById('moreFiltersIcon');

    if (moreFiltersCollapse) {
        moreFiltersCollapse.addEventListener('show.bs.collapse', function () {
            if (moreFiltersBtnText) moreFiltersBtnText.textContent = 'Show Less';
            if (moreFiltersIcon) {
                moreFiltersIcon.classList.remove('feather-plus-circle');
                moreFiltersIcon.classList.add('feather-minus-circle');
            }
        });
        moreFiltersCollapse.addEventListener('hide.bs.collapse', function () {
            if (moreFiltersBtnText) moreFiltersBtnText.textContent = 'Load More';
            if (moreFiltersIcon) {
                moreFiltersIcon.classList.remove('feather-minus-circle');
                moreFiltersIcon.classList.add('feather-plus-circle');
            }
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

        // Clear hidden user_id input when user types manually
        const hiddenUidInput = document.getElementById('search-uid-input');
        if (hiddenUidInput) hiddenUidInput.value = '';

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
                            <a href="javascript:void(0);" class="dropdown-item py-2 px-3 border-bottom search-suggestion-item text-decoration-none" data-user-id="${item.user_id || ''}" data-name="${item.name || ''}" data-value="${selectVal}">
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
                            const selectedUid = this.getAttribute('data-user-id');
                            const selectedName = this.getAttribute('data-name');
                            const hiddenInput = document.getElementById('search-uid-input');
                            
                            if (hiddenInput && selectedUid) {
                                hiddenInput.value = selectedUid;
                            }
                            searchInput.value = selectedName || this.getAttribute('data-value');
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
