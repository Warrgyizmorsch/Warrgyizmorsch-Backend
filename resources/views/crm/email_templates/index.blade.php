@extends('layouts.app')

@section('content')
    <div class="nxl-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Email Template Master</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Masters</li>
                    <li class="breadcrumb-item">Email Templates</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <button type="button" class="btn btn-primary d-flex align-items-center gap-2" onclick="openAddModal()">
                    <i class="feather-plus"></i>
                    <span>Add Email Template</span>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="feather-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="feather-alert-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filters Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('email-templates.index') }}" class="row g-3 align-items-center">
                        <div class="col-md-4 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search template name, subject..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <select name="type" class="form-select" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-6 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            @if(request()->hasAny(['search', 'type', 'status']))
                                <a href="{{ route('email-templates.index') }}" class="btn btn-light" title="Reset Filters"><i class="feather-refresh-cw"></i></a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Templates Table Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280;">
                                <tr>
                                    <th class="ps-4">Template Name</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $tpl)
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">
                                            {{ $tpl->name }}
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary px-2 py-1 fs-11 rounded-2">
                                                {{ $tpl->type }}
                                            </span>
                                        </td>
                                        <td class="text-truncate" style="max-width: 250px;" title="{{ $tpl->subject }}">
                                            {{ $tpl->subject }}
                                        </td>
                                        <td>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch{{ $tpl->id }}" {{ $tpl->status ? 'checked' : '' }} onchange="toggleTemplateStatus({{ $tpl->id }})">
                                                <label class="form-check-label fs-12 text-muted" for="statusSwitch{{ $tpl->id }}">
                                                    {{ $tpl->status ? 'Active' : 'Inactive' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fs-12 text-muted">
                                            {{ optional($tpl->creator)->name ?? 'System' }}
                                        </td>
                                        <td class="fs-12 text-muted">
                                            {{ $tpl->created_at ? $tpl->created_at->format('d M Y, h:i A') : 'N/A' }}
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-inline-flex gap-1">
                                                <button type="button" class="btn btn-xs btn-icon btn-light text-info border rounded-2" title="View Preview" onclick="viewTemplatePreview({{ $tpl->id }})">
                                                    <i class="feather-eye fs-12"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-icon btn-light text-primary border rounded-2" title="Edit Template" onclick="openEditModal({{ $tpl->id }})">
                                                    <i class="feather-edit fs-12"></i>
                                                </button>
                                                <form action="{{ route('email-templates.destroy', $tpl->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this template?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-icon btn-light text-danger border rounded-2" title="Delete Template">
                                                        <i class="feather-trash-2 fs-12"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="feather-mail fs-3 d-block mb-2 text-muted"></i>
                                            <span>No email templates found. Click <strong>+ Add Email Template</strong> to create one.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($templates->hasPages())
                    <div class="card-footer bg-white border-0 px-4 py-3">
                        {{ $templates->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- CREATE / EDIT TEMPLATE MODAL -->
    <div class="modal fade" id="templateModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header bg-light border-bottom px-4 py-3">
                    <h5 class="modal-title fw-bold text-dark" id="templateModalTitle">Add Email Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="templateForm" method="POST" action="{{ route('email-templates.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold text-dark fs-13">Template Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="tplName" class="form-control" placeholder="e.g. Welcome Lead Email" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark fs-13">Template Type <span class="text-danger">*</span></label>
                                <input type="text" name="type" id="tplType" class="form-control" list="typeSuggestions" placeholder="e.g. Welcome, Follow Up" required>
                                <datalist id="typeSuggestions">
                                    <option value="General">
                                    <option value="Welcome">
                                    <option value="Follow Up">
                                    <option value="Payment Reminder">
                                    <option value="Document Required">
                                </datalist>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark fs-13">Email Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" id="tplSubject" class="form-control" placeholder="Subject line (you can use variables like @{{lead_name}})" required>
                            </div>

                            <!-- Dynamic Variable Chips Section -->
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3 border">
                                    <label class="form-label fw-bold text-primary fs-12 mb-2 d-flex align-items-center gap-1">
                                        <i class="feather-code"></i> Available Dynamic Variables (Click variable to insert into Subject / Body):
                                    </label>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($availableVariables as $var => $desc)
                                            <button type="button" class="btn btn-xs btn-outline-primary bg-white text-primary rounded-pill border shadow-2xs py-1 px-2" style="font-size: 11px;" onclick="insertVariable('{{ $var }}')" title="{{ $desc }}">
                                                <strong class="font-monospace">{{ $var }}</strong> <span class="text-muted opacity-75">({{ $desc }})</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark fs-13">Email Body (HTML / Rich Text) <span class="text-danger">*</span></label>
                                <textarea name="body" id="tplBody" class="form-control font-monospace fs-13" rows="10" placeholder="Hello @{{lead_name}},&#10;&#10;Thank you for contacting @{{company_name}}..." required></textarea>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" value="1" id="tplStatus" checked>
                                    <label class="form-check-label fw-semibold fs-13" for="tplStatus">Active Template</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top bg-light px-4 py-3">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">Save Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VIEW PREVIEW MODAL -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header bg-primary text-white border-0 px-4 py-3">
                    <h5 class="modal-title fw-bold text-white mb-0" id="previewModalTitle">Template Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="fw-bold text-muted fs-11 text-uppercase">Subject Line</label>
                        <div class="fw-semibold text-dark p-2 bg-light rounded border fs-14" id="previewSubject"></div>
                    </div>
                    <div>
                        <label class="fw-bold text-muted fs-11 text-uppercase">Body Content</label>
                        <div class="p-3 bg-white rounded border shadow-2xs overflow-auto" style="min-height: 200px; max-height: 400px;" id="previewBody"></div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light px-4 py-3">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let lastFocusedInput = null;

        document.addEventListener("DOMContentLoaded", function () {
            const tplSub = document.getElementById('tplSubject');
            const tplBody = document.getElementById('tplBody');

            if (tplSub) tplSub.addEventListener('focus', () => lastFocusedInput = tplSub);
            if (tplBody) tplBody.addEventListener('focus', () => lastFocusedInput = tplBody);
        });

        function insertVariable(varText) {
            const tplBody = document.getElementById('tplBody');
            const targetInput = lastFocusedInput || tplBody;

            if (targetInput) {
                const start = targetInput.selectionStart || targetInput.value.length;
                const end = targetInput.selectionEnd || targetInput.value.length;
                const text = targetInput.value;

                targetInput.value = text.substring(0, start) + varText + text.substring(end);
                targetInput.focus();
                targetInput.setSelectionRange(start + varText.length, start + varText.length);
            }
        }

        function openAddModal() {
            document.getElementById('templateModalTitle').textContent = 'Add Email Template';
            const form = document.getElementById('templateForm');
            form.action = "{{ route('email-templates.store') }}";
            document.getElementById('formMethod').value = 'POST';

            document.getElementById('tplName').value = '';
            document.getElementById('tplType').value = 'General';
            document.getElementById('tplSubject').value = '';
            document.getElementById('tplBody').value = '';
            document.getElementById('tplStatus').checked = true;

            const modal = new bootstrap.Modal(document.getElementById('templateModal'));
            modal.show();
        }

        function openEditModal(templateId) {
            fetch("{{ url('/email-templates') }}/" + templateId + "/edit")
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success' && data.template) {
                        const t = data.template;
                        document.getElementById('templateModalTitle').textContent = 'Edit Email Template';
                        const form = document.getElementById('templateForm');
                        form.action = "{{ url('/email-templates') }}/" + templateId;
                        document.getElementById('formMethod').value = 'PUT';

                        document.getElementById('tplName').value = t.name || '';
                        document.getElementById('tplType').value = t.type || 'General';
                        document.getElementById('tplSubject').value = t.subject || '';
                        document.getElementById('tplBody').value = t.body || '';
                        document.getElementById('tplStatus').checked = Boolean(t.status);

                        const modal = new bootstrap.Modal(document.getElementById('templateModal'));
                        modal.show();
                    }
                })
                .catch(err => console.error(err));
        }

        function viewTemplatePreview(templateId) {
            fetch("{{ url('/email-templates') }}/" + templateId + "/edit")
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success' && data.template) {
                        const t = data.template;
                        document.getElementById('previewModalTitle').textContent = 'Preview: ' + t.name;
                        document.getElementById('previewSubject').textContent = t.subject;
                        document.getElementById('previewBody').innerHTML = t.body.replace(/\n/g, '<br>');

                        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
                        modal.show();
                    }
                });
        }

        function toggleTemplateStatus(templateId) {
            fetch("{{ url('/email-templates') }}/" + templateId + "/toggle-status", {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status !== 'success') {
                    alert('Could not update status');
                }
            })
            .catch(err => console.error(err));
        }
    </script>
@endsection
