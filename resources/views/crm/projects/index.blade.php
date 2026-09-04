@extends('layouts.app')

@section('title', 'Project Master - CRM')

@push('styles')
<style>
    /* Project Master Design System */
    .project-header-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px 24px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        margin-bottom: 22px;
    }

    .project-stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .project-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    }

    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-icon-primary {
        background: #eff6ff;
        color: #006FC9;
    }

    .stat-icon-success {
        background: #ecfdf5;
        color: #059669;
    }

    .stat-icon-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .project-filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
        margin-bottom: 20px;
    }

    .project-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    .project-table {
        margin-bottom: 0;
        width: 100%;
    }

    .project-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .project-table td {
        padding: 15px 18px;
        vertical-align: middle;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13.5px;
    }

    .project-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .project-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .project-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eff6ff;
        color: #006FC9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
        font-weight: 600;
    }

    .project-name-text {
        font-weight: 600;
        color: #0f172a;
        font-size: 14px;
    }

    .project-desc-text {
        color: #64748b;
        font-size: 13px;
        max-width: 420px;
        line-height: 1.45;
        word-break: break-word;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.2px;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        user-select: none;
    }

    .status-badge-active {
        background: #ecfdf5;
        color: #059669;
        border-color: #a7f3d0;
    }

    .status-badge-active:hover {
        background: #d1fae5;
    }

    .status-badge-inactive {
        background: #f1f5f9;
        color: #64748b;
        border-color: #cbd5e1;
    }

    .status-badge-inactive:hover {
        background: #e2e8f0;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
    }

    .status-badge-active .status-dot {
        background: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }

    .status-badge-inactive .status-dot {
        background: #94a3b8;
    }

    /* Action Buttons */
    .action-btn-group {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        background: transparent;
        font-size: 14px;
        transition: all 0.15s ease;
        color: #64748b;
    }

    .btn-action-edit:hover {
        background: #eff6ff;
        color: #006FC9;
        border-color: #bfdbfe;
    }

    .btn-action-delete:hover {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    /* Empty state */
    .empty-state-box {
        padding: 56px 20px;
        text-align: center;
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 16px;
    }

    /* Modal Styling */
    .modal-content-custom {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        overflow: hidden;
    }

    .modal-header-custom {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 18px 24px;
    }

    .modal-body-custom {
        padding: 24px;
    }

    .modal-footer-custom {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 16px 24px;
    }

    .form-control-modern {
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 9px 13px;
        font-size: 13.5px;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    .form-control-modern:focus {
        border-color: #006FC9;
        box-shadow: 0 0 0 3px rgba(0, 111, 201, 0.12);
    }
</style>
@endpush

@section('content')
<div class="nxl-content">
    {{-- Page Header --}}
    <div class="project-header-card">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <h4 class="fw-bold mb-0 text-dark">Project Master</h4>
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-2.5 py-1 rounded-pill">Master</span>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-0" style="background: transparent;">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item text-muted">Master</li>
                        <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">Projects</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 px-3 py-2 fw-medium shadow-sm" id="btnOpenAddModal">
                    <i class="feather-plus fs-6"></i>
                    <span>Add Project</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Metric Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="project-stat-card">
                <div class="stat-icon-wrapper stat-icon-primary">
                    <i class="feather-briefcase"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium text-uppercase">Total Projects</div>
                    <div class="fs-4 fw-bold text-dark mt-0.5" id="statTotalCount">{{ number_format($totalCount) }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="project-stat-card">
                <div class="stat-icon-wrapper stat-icon-success">
                    <i class="feather-check-circle"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium text-uppercase">Active Projects</div>
                    <div class="fs-4 fw-bold text-success mt-0.5" id="statActiveCount">{{ number_format($activeCount) }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="project-stat-card">
                <div class="stat-icon-wrapper stat-icon-secondary">
                    <i class="feather-slash"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium text-uppercase">Inactive Projects</div>
                    <div class="fs-4 fw-bold text-secondary mt-0.5" id="statInactiveCount">{{ number_format($inactiveCount) }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Toolbar --}}
    <div class="project-filter-card">
        <form method="GET" action="{{ route('projects.index') }}" id="filterForm" class="row g-2 align-items-center">
            <div class="col-12 col-md-5 col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">
                        <i class="feather-search"></i>
                    </span>
                    <input type="text" name="search" id="searchInput" class="form-control form-control-modern border-start-0 ps-0" 
                           placeholder="Search by project name or description..." 
                           value="{{ $search }}">
                    @if(!empty($search))
                        <a href="{{ route('projects.index', array_filter(['status' => $status])) }}" class="input-group-text bg-white border-start-0 text-muted text-decoration-none" title="Clear search">
                            <i class="feather-x"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-3">
                <select name="status" id="statusFilter" class="form-select form-control-modern" onchange="document.getElementById('filterForm').submit();">
                    <option value="">All Statuses</option>
                    <option value="Active" {{ $status === 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-6 col-md-3 col-lg-3 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary d-inline-flex align-items-center gap-1.5 flex-fill justify-content-center">
                    <i class="feather-filter"></i>
                    <span>Filter</span>
                </button>
                @if(!empty($search) || !empty($status))
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1.5 justify-content-center" title="Reset Filters">
                        <i class="feather-rotate-ccw"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="project-table-card">
        <div class="table-responsive">
            <table class="table project-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th style="min-width: 200px;">Project Name</th>
                        <th style="min-width: 280px;">Description</th>
                        <th style="width: 140px;" class="text-center">Status</th>
                        <th style="width: 160px;">Created Date</th>
                        <th style="width: 110px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="projectTableBody">
                    @forelse($projects as $index => $project)
                        <tr id="project-row-{{ $project->id }}">
                            <td class="text-muted fw-semibold">
                                {{ ($projects->currentPage() - 1) * $projects->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2.5">
                                    <div class="project-avatar">
                                        <i class="feather-briefcase"></i>
                                    </div>
                                    <div>
                                        <div class="project-name-text">{{ $project->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if(!empty($project->description))
                                    <div class="project-desc-text" title="{{ $project->description }}">
                                        {{ Str::limit($project->description, 110) }}
                                    </div>
                                @else
                                    <span class="text-muted fst-italic small">No description provided</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="status-badge {{ $project->status === 'Active' ? 'status-badge-active' : 'status-badge-inactive' }} btn-toggle-status"
                                      data-id="{{ $project->id }}"
                                      data-name="{{ $project->name }}"
                                      data-status="{{ $project->status }}"
                                      title="Click to toggle status">
                                    <span class="status-dot"></span>
                                    <span class="status-text">{{ $project->status }}</span>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1.5 text-muted small">
                                    <i class="feather-calendar"></i>
                                    <span>{{ $project->created_at ? $project->created_at->format('M d, Y') : '-' }}</span>
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="action-btn-group">
                                    <button type="button" 
                                            class="btn-action btn-action-edit btn-edit-project" 
                                            data-id="{{ $project->id }}"
                                            title="Edit Project">
                                        <i class="feather-edit-2"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn-action btn-action-delete btn-delete-project" 
                                            data-id="{{ $project->id }}"
                                            data-name="{{ $project->name }}"
                                            title="Delete Project">
                                        <i class="feather-trash-2"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state-box">
                                    <div class="empty-state-icon">
                                        <i class="feather-folder"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">No Projects Found</h5>
                                    <p class="text-muted small mb-3">
                                        @if(!empty($search) || !empty($status))
                                            No projects matched your search criteria. Try resetting the filters.
                                        @else
                                            Get started by creating your very first project.
                                        @endif
                                    </p>
                                    @if(!empty($search) || !empty($status))
                                        <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-secondary">Reset Filters</a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('btnOpenAddModal').click();">
                                            <i class="feather-plus me-1"></i> Add Project
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 px-4 py-3 border-top">
                <div class="text-muted small">
                    Showing <strong>{{ $projects->firstItem() }}</strong> to <strong>{{ $projects->lastItem() }}</strong> of <strong>{{ $projects->total() }}</strong> projects
                </div>
                <div>
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Add & Edit Project Modal --}}
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <form id="projectForm" novalidate>
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                <input type="hidden" id="projectId" name="project_id" value="">

                <div class="modal-header modal-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stat-icon-wrapper stat-icon-primary" style="width: 36px; height: 36px; font-size: 16px;">
                            <i class="feather-briefcase" id="modalHeaderIcon"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" id="projectModalLabel">Add New Project</h5>
                            <small class="text-muted">Enter the details for this project</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-custom">
                    <div class="alert alert-danger d-none py-2 px-3 small" id="formGeneralError"></div>

                    {{-- Project Name --}}
                    <div class="mb-3.5">
                        <label for="projectName" class="form-label fw-semibold text-dark small mb-1">
                            Project Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-modern" 
                               id="projectName" 
                               name="name" 
                               placeholder="e.g. Website Redesign 2026" 
                               required 
                               maxlength="190">
                        <div class="invalid-feedback small" id="nameError">Please enter a project name.</div>
                    </div>

                    {{-- Project Description --}}
                    <div class="mb-3.5">
                        <label for="projectDescription" class="form-label fw-semibold text-dark small mb-1">
                            Project Description <span class="text-muted fw-normal">(Optional)</span>
                        </label>
                        <textarea class="form-control form-control-modern" 
                                  id="projectDescription" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Provide a brief summary of this project's purpose and scope..." 
                                  maxlength="2000"></textarea>
                        <div class="invalid-feedback small" id="descriptionError"></div>
                    </div>

                    {{-- Project Status --}}
                    <div class="mb-2">
                        <label class="form-label fw-semibold text-dark small mb-1">
                            Project Status <span class="text-danger">*</span>
                        </label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" checked>
                                <label class="form-check-label fw-medium text-dark small" for="statusActive">
                                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Active</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statusInactive" value="Inactive">
                                <label class="form-check-label fw-medium text-dark small" for="statusInactive">
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill">Inactive</span>
                                </label>
                            </div>
                        </div>
                        <div class="invalid-feedback small" id="statusError"></div>
                    </div>
                </div>

                <div class="modal-footer modal-footer-custom d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light px-3 py-2 fw-medium" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-medium d-inline-flex align-items-center gap-2" id="btnSubmitProject">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status" aria-hidden="true"></span>
                        <span id="btnSubmitText">Save Project</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // Toast Notification helper using SweetAlert2
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    @if(session('success'))
        Toast.fire({ icon: 'success', title: @json(session('success')) });
    @endif
    @if(session('error'))
        Toast.fire({ icon: 'error', title: @json(session('error')) });
    @endif

    // Modal elements
    const projectModalEl = document.getElementById('projectModal');
    const projectModal = new bootstrap.Modal(projectModalEl);
    const projectForm = document.getElementById('projectForm');
    const projectModalLabel = document.getElementById('projectModalLabel');
    const btnSubmitText = document.getElementById('btnSubmitText');
    const submitSpinner = document.getElementById('submitSpinner');
    const btnSubmitProject = document.getElementById('btnSubmitProject');
    const formMethod = document.getElementById('formMethod');
    const projectIdInput = document.getElementById('projectId');
    const projectNameInput = document.getElementById('projectName');
    const projectDescInput = document.getElementById('projectDescription');
    const statusActiveRadio = document.getElementById('statusActive');
    const statusInactiveRadio = document.getElementById('statusInactive');
    const formGeneralError = document.getElementById('formGeneralError');

    // Reset Form
    function resetProjectForm() {
        projectForm.reset();
        projectForm.classList.remove('was-validated');
        projectIdInput.value = '';
        formMethod.value = 'POST';
        projectModalLabel.innerText = 'Add New Project';
        btnSubmitText.innerText = 'Save Project';
        statusActiveRadio.checked = true;
        formGeneralError.classList.add('d-none');
        formGeneralError.innerText = '';
        clearValidationErrors();
    }

    function clearValidationErrors() {
        ['name', 'description', 'status'].forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) input.classList.remove('is-invalid');
            const errorEl = document.getElementById(`${field}Error`);
            if (errorEl) errorEl.innerText = '';
        });
    }

    // Open Add Modal
    document.getElementById('btnOpenAddModal')?.addEventListener('click', function () {
        resetProjectForm();
        projectModal.show();
        setTimeout(() => projectNameInput.focus(), 400);
    });

    // Open Edit Modal
    document.querySelectorAll('.btn-edit-project').forEach(btn => {
        btn.addEventListener('click', function () {
            const projectId = this.dataset.id;
            resetProjectForm();

            btnSubmitProject.disabled = true;
            btnSubmitText.innerText = 'Loading...';
            submitSpinner.classList.remove('d-none');
            projectModal.show();

            fetch(`/projects/${projectId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to load project details.');
                return res.json();
            })
            .then(data => {
                if (data.success && data.project) {
                    const p = data.project;
                    projectIdInput.value = p.id;
                    formMethod.value = 'PUT';
                    projectNameInput.value = p.name;
                    projectDescInput.value = p.description || '';
                    if (p.status === 'Inactive') {
                        statusInactiveRadio.checked = true;
                    } else {
                        statusActiveRadio.checked = true;
                    }

                    projectModalLabel.innerText = 'Edit Project';
                    btnSubmitText.innerText = 'Update Project';
                }
            })
            .catch(err => {
                Toast.fire({ icon: 'error', title: err.message || 'Error fetching project.' });
                projectModal.hide();
            })
            .finally(() => {
                btnSubmitProject.disabled = false;
                submitSpinner.classList.add('d-none');
                if (btnSubmitText.innerText === 'Loading...') {
                    btnSubmitText.innerText = 'Update Project';
                }
            });
        });
    });

    // Form Submission (Add or Update)
    projectForm.addEventListener('submit', function (e) {
        e.preventDefault();
        clearValidationErrors();
        formGeneralError.classList.add('d-none');

        const isEdit = Boolean(projectIdInput.value);
        const url = isEdit ? `/projects/${projectIdInput.value}` : '/projects';
        const method = isEdit ? 'PUT' : 'POST';

        const nameVal = projectNameInput.value.trim();
        if (!nameVal) {
            projectNameInput.classList.add('is-invalid');
            document.getElementById('nameError').innerText = 'Please enter a project name.';
            projectNameInput.focus();
            return;
        }

        const formData = {
            _token: csrfToken,
            _method: method,
            name: nameVal,
            description: projectDescInput.value.trim(),
            status: statusActiveRadio.checked ? 'Active' : 'Inactive'
        };

        btnSubmitProject.disabled = true;
        submitSpinner.classList.remove('d-none');
        btnSubmitText.innerText = isEdit ? 'Updating...' : 'Saving...';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(formData)
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) {
                if (res.status === 422 && data.errors) {
                    for (const [key, msgs] of Object.entries(data.errors)) {
                        const input = document.querySelector(`[name="${key}"]`);
                        if (input) input.classList.add('is-invalid');
                        const errorEl = document.getElementById(`${key}Error`);
                        if (errorEl) errorEl.innerText = msgs[0];
                    }
                    throw new Error('Please check the form for errors.');
                }
                throw new Error(data.message || 'Something went wrong.');
            }
            return data;
        })
        .then(data => {
            projectModal.hide();
            Toast.fire({
                icon: 'success',
                title: data.message || 'Project saved successfully!'
            });
            setTimeout(() => window.location.reload(), 600);
        })
        .catch(err => {
            if (!err.message.includes('check the form')) {
                formGeneralError.innerText = err.message;
                formGeneralError.classList.remove('d-none');
            }
        })
        .finally(() => {
            btnSubmitProject.disabled = false;
            submitSpinner.classList.add('d-none');
            btnSubmitText.innerText = isEdit ? 'Update Project' : 'Save Project';
        });
    });

    // Status Toggle
    document.querySelectorAll('.btn-toggle-status').forEach(badge => {
        badge.addEventListener('click', function () {
            const projectId = this.dataset.id;
            const projectName = this.dataset.name;
            const currentStatus = this.dataset.status;
            const targetStatus = currentStatus === 'Active' ? 'Inactive' : 'Active';

            Swal.fire({
                title: 'Change Status?',
                html: `Are you sure you want to change status of <strong>${projectName}</strong> to <span class="badge ${targetStatus === 'Active' ? 'bg-success' : 'bg-secondary'}">${targetStatus}</span>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#006FC9',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/projects/${projectId}/status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            setTimeout(() => window.location.reload(), 500);
                        } else {
                            Toast.fire({ icon: 'error', title: 'Failed to update status.' });
                        }
                    })
                    .catch(err => {
                        Toast.fire({ icon: 'error', title: 'Error toggling status.' });
                    });
                }
            });
        });
    });

    // Delete Project
    document.querySelectorAll('.btn-delete-project').forEach(btn => {
        btn.addEventListener('click', function () {
            const projectId = this.dataset.id;
            const projectName = this.dataset.name;

            Swal.fire({
                title: 'Delete Project?',
                html: `Are you sure you want to delete <strong>${projectName}</strong>?<br><small class="text-danger">This action cannot be undone.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="feather-trash-2 me-1"></i> Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/projects/${projectId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            const row = document.getElementById(`project-row-${projectId}`);
                            if (row) {
                                row.style.transition = 'all 0.3s ease';
                                row.style.opacity = '0';
                                row.style.transform = 'scale(0.95)';
                                setTimeout(() => window.location.reload(), 400);
                            } else {
                                window.location.reload();
                            }
                        } else {
                            Toast.fire({ icon: 'error', title: data.message || 'Failed to delete project.' });
                        }
                    })
                    .catch(err => {
                        Toast.fire({ icon: 'error', title: 'Error deleting project.' });
                    });
                }
            });
        });
    });
});
</script>
@endpush
