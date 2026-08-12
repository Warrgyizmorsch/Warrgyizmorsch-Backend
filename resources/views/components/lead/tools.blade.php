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

                    <label for="importFile" class="dropdown-item text-muted">Auto Import (Direct)</label>
                    <input type="file" id="importFile" class="d-none" accept=".csv,.xlsx,.xls">
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ✅ COLLAPSE --}}
<!-- @php
    $actualFilterQueryParams = request()->except('bucket_id', 'lead_status', 'per_page', 'page');
    $hasActualFilters = !empty($actualFilterQueryParams);
@endphp
<div id="collapseOne" class="collapse mt-3 {{ $hasActualFilters ? 'show' : '' }}"> -->
<div id="collapseOne" class="collapse mt-3">
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

                <div class="col-12 col-md-2 d-block d-md-block">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search..."
                        value="{{ request('search') }}">
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

                <div class="col-md-2 d-none d-md-block">
                    <input type="text" name="country" class="form-control"
                        placeholder="Country"
                        value="{{ request('country') }}">
                </div>

                <div class="col-md-2 d-none d-md-block">
                    <input type="text" name="course" class="form-control"
                        placeholder="Course"
                        value="{{ request('course') }}">
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
