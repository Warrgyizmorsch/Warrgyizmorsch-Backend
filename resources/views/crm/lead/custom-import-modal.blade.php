<!-- ========================================== -->
<!-- TWO-STEP CUSTOM EXCEL / CSV IMPORT MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="customImportModal" tabindex="-1" aria-labelledby="customImportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2" id="customImportModalLabel">
                    <i class="feather-file-text fs-18"></i> Custom Excel/CSV Import & Field Mapping
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4" style="background-color: #f8fafc;">

                <!-- STEP 1: Temporary File Upload UI -->
                <div id="ci-step-1">
                    <div class="alert alert-info border-0 shadow-sm mb-4 d-flex align-items-start gap-3" style="background-color: #eff6ff; color: #1e40af;">
                        <i class="feather-info fs-20 mt-1"></i>
                        <div style="font-size: 13.5px;">
                            <strong>Step 1 of 2:</strong> Select your Excel (.xlsx, .xls) or CSV file. 
                            The file will be temporarily checked on the server to extract column headers. 
                            <span class="text-danger fw-bold">No data will be inserted into the database until you approve the mapping in Step 2.</span>
                        </div>
                    </div>

                    <div class="card border border-2 border-dashed text-center p-5 bg-white mb-3" style="border-color: #cbd5e1 !important; border-radius: 12px;">
                        <div class="mb-3">
                            <i class="feather-upload-cloud text-primary display-4"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Choose Excel or CSV File</h6>
                        <p class="text-muted small mb-3">Supported formats: .xlsx, .xls, .csv (Max 20MB)</p>
                        
                        <div class="col-md-8 mx-auto">
                            <input type="file" id="ci-file-input" class="form-control form-control-lg" accept=".csv,.xlsx,.xls">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ asset('samples/Sample_100_Leads_With_Duplicates_And_5_Comments.xlsx') }}" download class="btn btn-outline-success fw-semibold shadow-sm">
                            <i class="feather-download me-1"></i> Download 100 Test Leads Template (With Duplicates & 5 Comments)
                        </a>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="ci-btn-upload" class="btn btn-primary px-4 fw-bold">
                                Upload & Map Fields <i class="feather-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: 2-Column Excel Header to DB Field / Custom Attribute Mapping UI -->
                <div id="ci-step-2" class="d-none">
                    
                    <div class="alert alert-success border-0 shadow-sm mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: #f0fdf4; color: #166534; border-radius: 10px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="feather-check-circle fs-18 text-success"></i>
                            <div>
                                <strong id="ci-file-info" class="d-block" style="font-size: 13.5px;">File uploaded successfully!</strong>
                                <span style="font-size: 12px; color: #15803d;">Map each Excel column on the left to a Database field or Custom Attribute on the right:</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success px-3 py-2 fs-12" id="ci-header-count">0 Sheet Columns</span>
                            <span class="badge bg-primary px-3 py-2 fs-12" id="ci-mapped-count">0 Mapped to Standard DB</span>
                            <span class="badge bg-secondary px-3 py-2 fs-12" id="ci-custom-attr-count">0 Custom Attributes</span>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 shadow-sm mb-3 d-flex align-items-start gap-2" style="background: #eff6ff; color: #1e40af; font-size: 12.5px; border-radius: 8px;">
                        <i class="feather-info fs-16 mt-0.5"></i>
                        <div>
                            <strong>Dynamic Custom Attributes:</strong> Any Excel column mapped as a Custom Attribute (or unmapped) will automatically be saved into the lead's <code>custom_attributes</code> JSON column and displayed in Lead View/Edit!
                        </div>
                    </div>

                    <input type="hidden" id="ci-temp-file-id">
                    <input type="hidden" id="ci-selected-rows">

                    <!-- Duplicate Lead Inspection & Selection Card -->
                    <div class="card mb-3 border shadow-sm" style="border-radius: 10px;" id="ci-dup-selection-card">
                        <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center justify-content-between flex-wrap gap-2" style="font-size: 13px;">
                            <span><i class="feather-users me-1 text-primary"></i> 1. Select Rows to Import (Fresh Leads vs Checked Duplicate Leads)</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success px-2 py-1 fs-11" id="ci-badge-new-count">0 Fresh Leads</span>
                                <span class="badge bg-danger px-2 py-1 fs-11" id="ci-badge-dup-count">0 Duplicate Leads</span>
                                <span class="badge bg-dark px-2 py-1 fs-11" id="ci-badge-total-selected">0 Rows Selected</span>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <!-- Tabs for Fresh Leads vs Duplicate Leads -->
                            <ul class="nav nav-tabs nav-justified mb-2" id="ciDupTab" role="tablist" style="font-size: 13px;">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold text-success py-1.5" id="ci-tab-new-leads" data-bs-toggle="tab" data-bs-target="#ci-pane-new-leads" type="button" role="tab">
                                        <i class="feather-check-circle me-1"></i> Fresh New Leads (<span id="ci-tab-cnt-new">0</span>)
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold text-danger py-1.5" id="ci-tab-dup-leads" data-bs-toggle="tab" data-bs-target="#ci-pane-dup-leads" type="button" role="tab">
                                        <i class="feather-alert-circle me-1"></i> Duplicate Leads (<span id="ci-tab-cnt-dup">0</span>)
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="ciDupTabContent">
                                <!-- Fresh New Leads Pane -->
                                <div class="tab-pane fade show active" id="ci-pane-new-leads" role="tabpanel">
                                    <div class="table-responsive overflow-auto" style="max-height: 200px;">
                                        <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12px;">
                                            <thead class="table-light sticky-top">
                                                <tr>
                                                    <th width="40" class="text-center">
                                                        <input type="checkbox" class="form-check-input" id="ci-check-all-new" checked style="cursor: pointer;" title="Select/Deselect All Fresh Leads">
                                                    </th>
                                                    <th># Row</th>
                                                    <th>Name</th>
                                                    <th>Email Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ci-new-leads-tbody"></tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Duplicate Leads Pane -->
                                <div class="tab-pane fade" id="ci-pane-dup-leads" role="tabpanel">
                                    <div class="table-responsive overflow-auto" style="max-height: 200px;">
                                        <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12px;">
                                            <thead class="table-light sticky-top">
                                                <tr>
                                                    <th width="40" class="text-center">
                                                        <input type="checkbox" class="form-check-input" id="ci-check-all-dup" style="cursor: pointer;" title="Select/Deselect All Duplicate Leads">
                                                    </th>
                                                    <th># Row</th>
                                                    <th>Sheet Name</th>
                                                    <th>Sheet Email</th>
                                                    <th>Sheet Phone</th>
                                                    <th>Matched DB User</th>
                                                    <th>Match Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ci-dup-leads-tbody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mapping Form 2-Column Grid -->
                    <form id="ci-mapping-form">
                        
                        <!-- Table Header Bar -->
                        <div class="card mb-2 border-0 bg-primary text-white shadow-sm" style="border-radius: 8px;">
                            <div class="card-body py-2 px-3">
                                <div class="row align-items-center fw-bold" style="font-size: 13.5px;">
                                    <div class="col-md-6 d-flex align-items-center gap-2">
                                        <i class="feather-file-text fs-16"></i> 1. Uploaded Sheet Columns (Static Left)
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="feather-database fs-16"></i> 2. Select Database Field / Custom Attribute (Dropdown Right)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic 2-Column Mapping Container -->
                        <div id="ci-two-column-mapping-container" class="mb-3 overflow-auto pe-1" style="max-height: 480px;">
                            <!-- Dynamically populated via JavaScript -->
                        </div>

                        <!-- Live Data Preview Box -->
                        <div class="card mb-3 border shadow-sm" style="border-radius: 10px;">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 13px;">
                                <i class="feather-eye text-info"></i> Sample Sheet Data Preview (First 3 Rows)
                            </div>
                            <div class="card-body p-0 overflow-auto" style="max-height: 170px;">
                                <table class="table table-sm table-bordered table-striped mb-0 text-nowrap" style="font-size: 12px;" id="ci-preview-table">
                                    <thead class="table-light sticky-top">
                                        <tr id="ci-preview-thead"></tr>
                                    </thead>
                                    <tbody id="ci-preview-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                    </form>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <button type="button" class="btn btn-outline-secondary px-3" onclick="resetToStep1()">
                            <i class="feather-arrow-left me-1"></i> Back to Upload
                        </button>
                        
                        <button type="button" id="ci-btn-process" class="btn btn-success px-4 fw-bold shadow-sm">
                            <i class="feather-check-circle me-1"></i> Start Import Now
                        </button>
                    </div>

                </div>

                <!-- STEP 3: Live Progress UI (Row-by-Row Entry Ingestion) -->
                <div id="ci-step-3" class="d-none">
                    <div class="card border-0 shadow-sm p-4 bg-white text-center" style="border-radius: 12px;">
                        <div class="mb-3">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status" id="ci-progress-spinner">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div id="ci-progress-success-icon" class="d-none">
                                <i class="feather-check-circle text-success" style="font-size: 3.5rem;"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2" id="ci-progress-title">Importing Leads...</h5>
                        <p class="text-muted small mb-4" id="ci-progress-subtitle">Please wait while your file entries are being processed and inserted line-by-line.</p>

                        <!-- Progress Bar -->
                        <div class="progress mb-3" style="height: 22px; border-radius: 11px; background-color: #e2e8f0;">
                            <div id="ci-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary fw-bold fs-12" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>

                        <!-- Stats Counts -->
                        <div class="row g-2 text-center mt-2">
                            <div class="col-4">
                                <div class="p-2 border rounded bg-light">
                                    <span class="d-block text-muted small fw-semibold">Total Rows</span>
                                    <strong class="fs-15 text-dark" id="ci-stat-total">0</strong>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 border rounded bg-light">
                                    <span class="d-block text-muted small fw-semibold">Inserted</span>
                                    <strong class="fs-15 text-success" id="ci-stat-inserted">0</strong>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 border rounded bg-light">
                                    <span class="d-block text-muted small fw-semibold">Progress</span>
                                    <strong class="fs-15 text-primary" id="ci-stat-percentage">0%</strong>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-none" id="ci-step-3-done-btn">
                            <button type="button" class="btn btn-primary px-5 fw-bold" onclick="location.reload()">
                                <i class="feather-check me-1"></i> Done & Refresh Leads
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function openCustomImportModal() {
        resetToStep1();
        var modal = new bootstrap.Modal(document.getElementById('customImportModal'));
        modal.show();
    }

    function resetToStep1() {
        document.getElementById('ci-step-1').classList.remove('d-none');
        document.getElementById('ci-step-2').classList.add('d-none');
        document.getElementById('ci-step-3').classList.add('d-none');
        document.getElementById('ci-file-input').value = '';
        document.getElementById('ci-temp-file-id').value = '';
        
        document.getElementById('ci-progress-spinner').classList.remove('d-none');
        document.getElementById('ci-progress-success-icon').classList.add('d-none');
        document.getElementById('ci-step-3-done-btn').classList.add('d-none');
        document.getElementById('ci-progress-title').innerText = 'Importing Leads...';
        document.getElementById('ci-progress-subtitle').innerText = 'Please wait while your file entries are being processed and inserted line-by-line.';
        const progressBar = document.getElementById('ci-progress-bar');
        progressBar.style.width = '0%';
        progressBar.innerText = '0%';
        progressBar.classList.add('progress-bar-animated', 'progress-bar-striped');
        document.getElementById('ci-stat-total').innerText = '0';
        document.getElementById('ci-stat-inserted').innerText = '0';
        document.getElementById('ci-stat-percentage').innerText = '0%';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const btnUpload = document.getElementById('ci-btn-upload');
        const btnProcess = document.getElementById('ci-btn-process');
        const fileInput = document.getElementById('ci-file-input');

        // Master definition of Database fields grouped by categories (Study & Visa removed as requested)
        const CRM_DB_FIELD_GROUPS = [
            {
                groupName: "👤 Customer & Contact Fields",
                fields: [
                    { key: "name", label: "Full Name / Client Name *", keywords: ["name", "full name", "first name", "client_name", "student_name", "lead_name", "candidate_name", "customer_name"] },
                    { key: "contact_no", label: "Mobile / Phone Number *", keywords: ["phone", "mobile", "contact", "phone number", "contact no", "phone_number", "mobile_no", "mobile number", "mobile_number", "tel"] },
                    { key: "email", label: "Email Address", keywords: ["email", "mail", "e-mail", "email address", "work_email_address", "user_email"] },
                    { key: "country_code", label: "Country Code (+91)", keywords: ["country code", "code", "dial code", "country_code"] },
                    { key: "city", label: "City", keywords: ["city", "location", "town"] },
                    { key: "state", label: "State", keywords: ["state", "province"] },
                    { key: "pincode", label: "Pincode / Zip Code", keywords: ["pincode", "zip", "zipcode", "postal_code", "pin_code"] },
                    { key: "address", label: "Full Address", keywords: ["address", "full address", "street"] }
                ]
            },
            {
                groupName: "🏢 Company & Business Details",
                fields: [
                    { key: "company_name", label: "Company Name", keywords: ["company", "company_name", "organization", "org_name"] },
                    { key: "business_name", label: "Business / Brand Name", keywords: ["business_name", "business"] },
                    { key: "product", label: "Product / Category", keywords: ["product", "category", "service_category"] },
                    { key: "services", label: "Services Offered", keywords: ["services", "service"] },
                    { key: "industry", label: "Industry / Sector", keywords: ["industry", "sector"] },
                    { key: "employee_strength", label: "Employee Strength", keywords: ["employee_strength", "employees", "company_size"] },
                    { key: "website", label: "Website URL", keywords: ["website", "site"] },
                    { key: "gst_number", label: "GST Number", keywords: ["gst_number", "gst", "gstin"] }
                ]
            },
            {
                groupName: "📢 Ads & Marketing Details",
                fields: [
                    { key: "campaign_name", label: "Campaign Name", keywords: ["campaign_name", "campaign"] },
                    { key: "campaign_id", label: "Campaign ID", keywords: ["campaign_id", "campaign id", "campaign_id"] },
                    { key: "adset_name", label: "Adset Name", keywords: ["adset_name", "adset"] },
                    { key: "adset_id", label: "Adset ID", keywords: ["adset_id", "adset id", "adset_id"] },
                    { key: "ad_name", label: "Ad Name", keywords: ["ad_name", "ad"] },
                    { key: "ad_id", label: "Ad ID", keywords: ["ad_id", "ad id", "ad_id"] },
                    { key: "form_name", label: "Form Name", keywords: ["form_name", "form"] },
                    { key: "form_id", label: "Form ID", keywords: ["form_id", "form id", "form_id"] },
                    { key: "platform", label: "Platform / Lead Source", keywords: ["platform", "source", "lead_source", "website"] },
                    { key: "page_url", label: "Landing / Page URL", keywords: ["page_url", "url", "link"] },
                    { key: "date", label: "Lead Date / Created Time", keywords: ["created_time", "created_at", "date", "time", "lead_date"] }
                ]
            },
            {
                groupName: "📋 Lead Status & Requirements",
                fields: [
                    { key: "budget", label: "Budget", keywords: ["budget", "price", "amount"] },
                    { key: "lead_status", label: "Lead Stage / Status", keywords: ["lead_status", "status", "stage"] },
                    { key: "lead_engagement_status", label: "Engagement Status (Hot/Warm/Cold)", keywords: ["engagement", "lead_engagement", "temperature"] },
                    { key: "pain_points", label: "Pain Points / Requirements", keywords: ["pain_points", "requirements", "needs"] },
                    { key: "description", label: "Description / Remarks / Notes", keywords: ["description", "remark", "notes", "message", "comments"] },
                    { key: "callback_message", label: "Followup Comment / Remark", keywords: ["message", "remarks", "comment", "callback_message", "feedback"] }
                ]
            },
            {
                groupName: "✨ System Custom Attributes (lead_questions)",
                fields: [
                    @foreach(\App\Models\LeadQuestion::where('is_active', 1)->get() as $q)
                    { key: {!! json_encode($q->field_name) !!}, label: {!! json_encode($q->label) !!}, keywords: [{!! json_encode(strtolower($q->field_name)) !!}, {!! json_encode(strtolower($q->label)) !!}] },
                    @endforeach
                ]
            }
        ];

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Select/Deselect All Fresh Leads in Step 2
        const chkAllNewStep2 = document.getElementById('ci-check-all-new');
        if (chkAllNewStep2) {
            chkAllNewStep2.addEventListener('change', function () {
                document.querySelectorAll('.ci-new-lead-cb').forEach(cb => {
                    cb.checked = this.checked;
                });
                updateCiSelectedRowsCount();
            });
        }

        // Select/Deselect All Duplicate Leads in Step 2
        const chkAllDupStep2 = document.getElementById('ci-check-all-dup');
        if (chkAllDupStep2) {
            chkAllDupStep2.addEventListener('change', function () {
                document.querySelectorAll('.ci-dup-lead-cb').forEach(cb => {
                    cb.checked = this.checked;
                });
                updateCiSelectedRowsCount();
            });
        }

        function populateLeadSelectionTables(data) {
            const newTbody = document.getElementById('ci-new-leads-tbody');
            const dupTbody = document.getElementById('ci-dup-leads-tbody');
            if (!newTbody || !dupTbody) return;

            const newList = data.new_list || [];
            const dupList = data.existing_list || [];

            const cntNewEl = document.getElementById('ci-tab-cnt-new');
            if (cntNewEl) cntNewEl.innerText = newList.length;

            const badgeNewEl = document.getElementById('ci-badge-new-count');
            if (badgeNewEl) badgeNewEl.innerText = `${newList.length} Fresh Leads`;

            const cntDupEl = document.getElementById('ci-tab-cnt-dup');
            if (cntDupEl) cntDupEl.innerText = dupList.length;

            const badgeDupEl = document.getElementById('ci-badge-dup-count');
            if (badgeDupEl) badgeDupEl.innerText = `${dupList.length} Duplicate Leads`;

            // Render Fresh Leads Table
            newTbody.innerHTML = '';
            if (newList.length === 0) {
                newTbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-2">No fresh leads found in Excel file.</td></tr>';
            } else {
                newList.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.className = 'align-middle';
                    tr.innerHTML = `
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input ci-lead-select-cb ci-new-lead-cb" value="${item.row}" checked style="cursor: pointer;">
                        </td>
                        <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                        <td class="fw-bold">${escapeHtml(item.name)}</td>
                        <td>${escapeHtml(item.email)}</td>
                        <td>${escapeHtml(item.phone)}</td>
                        <td><span class="badge bg-soft-success text-success"><i class="feather-check me-1"></i>Fresh Entry</span></td>
                    `;
                    newTbody.appendChild(tr);
                });
            }

            // Render Duplicate Leads Table
            dupTbody.innerHTML = '';
            if (dupList.length === 0) {
                dupTbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted py-2">No duplicate leads found in database! All rows are fresh.</td></tr>';
            } else {
                dupList.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.className = 'align-middle';
                    tr.innerHTML = `
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input ci-lead-select-cb ci-dup-lead-cb" value="${item.row}" style="cursor: pointer;">
                        </td>
                        <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                        <td class="fw-bold">${escapeHtml(item.name)}</td>
                        <td>${escapeHtml(item.email)}</td>
                        <td>${escapeHtml(item.phone)}</td>
                        <td class="text-danger fw-semibold"><i class="feather-user me-1"></i>${escapeHtml(item.db_name)}</td>
                        <td><span class="badge bg-soft-danger text-danger">${escapeHtml(item.match_type)}</span></td>
                    `;
                    dupTbody.appendChild(tr);
                });
            }

            document.querySelectorAll('.ci-lead-select-cb').forEach(cb => {
                cb.addEventListener('change', updateCiSelectedRowsCount);
            });

            updateCiSelectedRowsCount();
        }

        function updateCiSelectedRowsCount() {
            const selectedBoxes = document.querySelectorAll('.ci-lead-select-cb:checked');
            const count = selectedBoxes.length;

            const totalSelectedBadge = document.getElementById('ci-badge-total-selected');
            if (totalSelectedBadge) totalSelectedBadge.innerText = `${count} Rows Selected`;

            const btnProcess = document.getElementById('ci-btn-process');
            if (btnProcess) {
                btnProcess.innerHTML = `<i class="feather-check-circle me-1"></i> Start Import Now (${count} Leads Selected)`;
            }

            const selectedRowsArr = Array.from(selectedBoxes).map(cb => parseInt(cb.value));
            const elSelectedRows = document.getElementById('ci-selected-rows');
            if (elSelectedRows) elSelectedRows.value = JSON.stringify(selectedRowsArr);
        }

        if (btnUpload) {
            btnUpload.addEventListener('click', function () {
                if (!fileInput.files.length) {
                    Swal.fire('File Required', 'Please select an Excel or CSV file to proceed.', 'warning');
                    return;
                }

                const file = fileInput.files[0];
                const formData = new FormData();
                formData.append('file', file);

                btnUpload.disabled = true;
                btnUpload.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Reading File & Checking Duplicates...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch("{{ route('modern.leads.compare') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json().catch(() => ({ status: 'error', message: `Server error (${res.status} ${res.statusText})` }));
                    return { ok: res.ok, data };
                })
                .then(({ ok, data }) => {
                    btnUpload.disabled = false;
                    btnUpload.innerHTML = 'Upload & Map Fields <i class="feather-arrow-right ms-1"></i>';

                    if (ok && data.status === 'success') {
                        const elTempId = document.getElementById('ci-temp-file-id');
                        if (elTempId) elTempId.value = data.temp_file_id;

                        const elFileInfo = document.getElementById('ci-file-info');
                        if (elFileInfo) elFileInfo.innerText = `File "${file.name}" uploaded & scanned successfully!`;

                        const elHeaderCount = document.getElementById('ci-header-count');
                        if (elHeaderCount) elHeaderCount.innerText = `${data.headers.length} Sheet Columns`;

                        populateLeadSelectionTables(data);
                        populateTwoColumnMapping(data.headers, data.preview);
                        populatePreviewTable(data.headers, data.preview);

                        document.getElementById('ci-step-1').classList.add('d-none');
                        document.getElementById('ci-step-2').classList.remove('d-none');
                    } else {
                        let msg = data.message;
                        if (data.errors) {
                            msg = Object.values(data.errors).flat().join('<br>');
                        }
                        Swal.fire('Upload Error', msg || 'Could not read file.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    btnUpload.disabled = false;
                    btnUpload.innerHTML = 'Upload & Map Fields <i class="feather-arrow-right ms-1"></i>';
                    Swal.fire('Error', 'An unexpected error occurred: ' + (err.message || err), 'error');
                });
            });
        }

        // Render 2-Column Excel Header to DB Field Mapping UI
        function populateTwoColumnMapping(headers, previewRows) {
            const container = document.getElementById('ci-two-column-mapping-container');
            if (!container) return;
            container.innerHTML = '';

            const firstPreviewRow = (previewRows && previewRows.length > 0) ? previewRows[0] : {};
            const usedDbFields = new Set();

            headers.forEach((h, index) => {
                const headerLower = (h.name || '').toLowerCase().trim();
                const sampleVal = firstPreviewRow[h.name] !== undefined && firstPreviewRow[h.name] !== null ? String(firstPreviewRow[h.name]) : '';

                // Determine best matching CRM DB Field
                let bestDbKey = '';
                let maxScore = 0;

                if (headerLower === 'id' || headerLower === 'row_id') {
                    // Ignore Excel id header so DB primary key auto-increments
                    bestDbKey = '';
                } else {
                    CRM_DB_FIELD_GROUPS.forEach(group => {
                        group.fields.forEach(field => {
                            if ((field.key === 'name' || field.key === 'contact_no') && (headerLower.includes('ad_') || headerLower.includes('campaign_'))) {
                                return;
                            }

                            field.keywords.forEach(kw => {
                                if (!kw) return;
                                if (headerLower === kw) {
                                    maxScore = 100; bestDbKey = field.key;
                                } else if (headerLower.replace(/[^a-z0-9]/g, '_') === kw.replace(/[^a-z0-9]/g, '_')) {
                                    if (maxScore < 90) { maxScore = 90; bestDbKey = field.key; }
                                } else if (headerLower.includes(kw)) {
                                    if (maxScore < 50) { maxScore = 50; bestDbKey = field.key; }
                                }
                            });
                        });
                    });
                }

                if (bestDbKey && !usedDbFields.has(bestDbKey)) {
                    usedDbFields.add(bestDbKey);
                } else if (bestDbKey && usedDbFields.has(bestDbKey) && maxScore < 90) {
                    bestDbKey = ''; // Avoid duplicate auto-matching for low score
                }

                // Build Options HTML (Default is -- Select Database Field / Do Not Import --)
                let optionsHtml = `<option value="" ${!bestDbKey ? 'selected' : ''}>-- Select Database Field / Do Not Import --</option>`;

                CRM_DB_FIELD_GROUPS.forEach(group => {
                    optionsHtml += `<optgroup label="${escapeHtml(group.groupName)}">`;
                    group.fields.forEach(field => {
                        const isSelected = (field.key === bestDbKey) ? 'selected' : '';
                        optionsHtml += `<option value="${field.key}" ${isSelected}>${escapeHtml(field.label)} [${field.key}]</option>`;
                    });
                    optionsHtml += `</optgroup>`;
                });

                const rowCard = document.createElement('div');
                rowCard.className = 'card mb-2 border shadow-sm style-row-card';
                rowCard.style.borderRadius = '8px';

                rowCard.innerHTML = `
                    <div class="card-body p-2 px-3">
                        <div class="row align-items-center g-2">
                            <!-- Left Column: Fixed Uploaded Excel Header -->
                            <div class="col-md-6 border-end-md">
                                <div class="d-flex align-items-center justify-content-between pe-md-2">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                                        <span class="badge bg-primary px-2 py-1 fs-11 flex-shrink-0">Col ${index + 1}</span>
                                        <strong class="text-dark fs-13 text-truncate" title="${escapeHtml(h.name)}">${escapeHtml(h.name)}</strong>
                                    </div>
                                    ${sampleVal ? `<small class="badge bg-light text-muted fw-normal text-truncate ms-2" style="max-width: 170px;" title="Sample: ${escapeHtml(sampleVal)}">Ex: "${escapeHtml(sampleVal)}"</small>` : ''}
                                </div>
                            </div>
                            <!-- Right Column: Select DB Field Dropdown -->
                            <div class="col-md-6">
                                <select class="form-select form-select-sm ci-excel-header-select border-primary fw-medium" data-excel-header="${escapeHtml(h.name)}">
                                    ${optionsHtml}
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(rowCard);
            });

            updateTwoColumnStats(headers);

            container.querySelectorAll('.ci-excel-header-select').forEach(select => {
                select.addEventListener('change', function () {
                    updateTwoColumnStats(headers);
                });
            });
        }

        function promptAddCustomAttributeForRow(btn, headerName) {
            let selectEl = null;
            if (btn && btn.closest) {
                selectEl = btn.closest('.input-group')?.querySelector('.ci-excel-header-select') 
                        || btn.closest('.row')?.querySelector('.ci-excel-header-select');
            }

            Swal.fire({
                title: '✨ Add Custom Attribute',
                target: document.getElementById('customImportModal') || 'body',
                html: `
                    <div class="text-start p-2">
                        <div class="mb-2">
                            <label class="form-label text-dark fw-bold fs-13 mb-1">Attribute Name <span class="text-danger">*</span></label>
                            <input type="text" id="swal_attr_label" class="form-control" placeholder="Enter attribute name (e.g. Passport Expiry, Preferred Location...)" value="${escapeHtml(headerName && headerName !== 'Custom Attribute' ? headerName : '')}" autocomplete="off">
                        </div>
                    </div>
                `,
                didOpen: () => {
                    const labelInp = document.getElementById('swal_attr_label');
                    if (labelInp) {
                        setTimeout(() => {
                            labelInp.focus();
                            labelInp.select();
                        }, 100);
                    }
                },
                showCancelButton: true,
                confirmButtonText: '<i class="feather-check-circle me-1"></i> Save & Select Attribute',
                confirmButtonColor: '#006FC9',
                cancelButtonText: 'Cancel',
                focusConfirm: false,
                preConfirm: () => {
                    const label = document.getElementById('swal_attr_label')?.value.trim();
                    if (!label) {
                        Swal.showValidationMessage('Please enter a valid attribute name!');
                        return false;
                    }
                    return { label };
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const { label } = result.value;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

                    Swal.fire({
                        title: 'Saving Attribute...',
                        text: 'Please wait...',
                        target: document.getElementById('customImportModal') || 'body',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    fetch("{{ route('lead_questions.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            label: label,
                            field_name: label,
                            is_active: 1
                        })
                    })
                    .then(async res => {
                        const data = await res.json().catch(() => ({ status: 'error', message: `Server error (${res.status})` }));
                        return { ok: res.ok, data };
                    })
                    .then(({ ok, data }) => {
                        if (ok && (data.status === 'success' || data.question)) {
                            const savedKey = (data.question && data.question.field_name) ? data.question.field_name : label.toLowerCase().replace(/[^a-z0-9]+/g, '_');
                            const savedLabel = (data.question && data.question.label) ? data.question.label : label;

                            // Append option to System Custom Attributes optgroup in all dropdowns
                            document.querySelectorAll('.ci-excel-header-select').forEach(sel => {
                                let existingOpt = Array.from(sel.options).find(opt => opt.value === savedKey);
                                if (!existingOpt) {
                                    existingOpt = document.createElement('option');
                                    existingOpt.value = savedKey;
                                    existingOpt.innerText = `${savedLabel} [${savedKey}]`;

                                    let optGroup = Array.from(sel.querySelectorAll('optgroup')).find(g => g.label.includes('System Custom Attributes'));
                                    if (optGroup) {
                                        optGroup.appendChild(existingOpt);
                                    } else {
                                        sel.appendChild(existingOpt);
                                    }
                                }
                            });

                            if (selectEl) {
                                selectEl.value = savedKey;
                                selectEl.dispatchEvent(new Event('change'));
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Attribute Created & Selected!',
                                text: `"${savedLabel}" saved to database and auto-selected.`,
                                target: document.getElementById('customImportModal') || 'body',
                                toast: true,
                                position: 'top-end',
                                timer: 2500,
                                showConfirmButton: false
                            });
                        } else {
                            const errMsg = (data && data.message) ? data.message : 'Could not save attribute.';
                            Swal.fire({
                                icon: 'error',
                                title: 'Attribute Save Failed',
                                text: errMsg,
                                target: document.getElementById('customImportModal') || 'body'
                            });
                        }
                    })
                    .catch(err => {
                        console.error('Attribute creation error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'An error occurred while saving custom attribute.',
                            target: document.getElementById('customImportModal') || 'body'
                        });
                    });
                }
            });
        }

        function updateTwoColumnStats(headers) {
            const selects = document.querySelectorAll('.ci-excel-header-select');
            let mappedCount = 0;
            let customAttrCount = 0;

            selects.forEach(select => {
                if (select.value) {
                    mappedCount++;
                } else {
                    customAttrCount++;
                }
            });

            const mappedBadge = document.getElementById('ci-mapped-count');
            const customBadge = document.getElementById('ci-custom-attr-count');
            if (mappedBadge) mappedBadge.innerText = `${mappedCount} Mapped to Standard DB`;
            if (customBadge) customBadge.innerText = `${customAttrCount} Custom Attributes`;
        }

        function populatePreviewTable(headers, previewRows) {
            const thead = document.getElementById('ci-preview-thead');
            const tbody = document.getElementById('ci-preview-tbody');
            if (!thead || !tbody) return;

            thead.innerHTML = '';
            tbody.innerHTML = '';

            if (!headers || !headers.length) return;

            headers.forEach(h => {
                const th = document.createElement('th');
                th.innerText = h.name || '';
                thead.appendChild(th);
            });

            (previewRows || []).forEach(row => {
                const tr = document.createElement('tr');
                headers.forEach(h => {
                    const td = document.createElement('td');
                    td.innerText = row[h.name] !== undefined && row[h.name] !== null ? String(row[h.name]) : '';
                    tr.appendChild(td);
                });
                tbody.appendChild(tr);
            });
        }

        // Process Import Form Submission
        if (btnProcess) {
            btnProcess.addEventListener('click', function () {
                const tempFileId = document.getElementById('ci-temp-file-id').value;
                if (!tempFileId) {
                    Swal.fire('Error', 'Temporary file ID is missing. Please re-upload your file.', 'error');
                    return;
                }

                // Build mapping object (dbField => excelHeader) AND column_mappings array for multiple comment fields
                const mapping = {};
                const columnMappings = [];
                const selectElements = document.querySelectorAll('.ci-excel-header-select');

                selectElements.forEach(select => {
                    const dbField = select.value;
                    const excelHeader = select.getAttribute('data-excel-header');
                    if (excelHeader) {
                        if (dbField) {
                            mapping[dbField] = excelHeader;
                        }
                        columnMappings.push({
                            excel_header: excelHeader,
                            db_field: dbField || ''
                        });
                    }
                });

                // Switch UI to Step 3 (Live Progress View)
                document.getElementById('ci-step-2').classList.add('d-none');
                document.getElementById('ci-step-3').classList.remove('d-none');

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const progressBar = document.getElementById('ci-progress-bar');
                const statTotal = document.getElementById('ci-stat-total');
                const statInserted = document.getElementById('ci-stat-inserted');
                const statPercentage = document.getElementById('ci-stat-percentage');

                // Simulated progress animation start
                let currentPct = 10;
                let insertedCount = 0;
                let totalRowsCount = 0;

                progressBar.style.width = currentPct + '%';
                progressBar.innerText = currentPct + '%';
                statPercentage.innerText = currentPct + '%';

                const progressInterval = setInterval(() => {
                    if (currentPct < 90) {
                        currentPct += Math.floor(Math.random() * 8) + 3;
                        if (currentPct > 90) currentPct = 90;
                        progressBar.style.width = currentPct + '%';
                        progressBar.innerText = currentPct + '%';
                        statPercentage.innerText = currentPct + '%';

                        if (totalRowsCount > 0) {
                            const estInserted = Math.round((currentPct / 100) * totalRowsCount);
                            statInserted.innerText = estInserted;
                        }
                    }
                }, 300);

                const selectedRowsVal = document.getElementById('ci-selected-rows')?.value;
                let selectedRowsArr = null;
                if (selectedRowsVal) {
                    try { selectedRowsArr = JSON.parse(selectedRowsVal); } catch(e) {}
                }

                fetch("{{ route('modern.leads.import.process') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        temp_file_id: tempFileId,
                        mapping: mapping,
                        column_mappings: columnMappings,
                        selected_rows: selectedRowsArr
                    })
                })
                .then(res => res.json())
                .then(data => {
                    clearInterval(progressInterval);

                    if (data.status === 'success') {
                        // Complete progress to 100%
                        progressBar.style.width = '100%';
                        progressBar.innerText = '100%';
                        progressBar.classList.remove('progress-bar-animated', 'progress-bar-striped');
                        
                        statTotal.innerText = data.imported_count || data.total_rows || 'N/A';
                        statInserted.innerText = data.imported_count || 'N/A';
                        statPercentage.innerText = '100%';

                        document.getElementById('ci-progress-spinner').classList.add('d-none');
                        document.getElementById('ci-progress-success-icon').classList.remove('d-none');
                        document.getElementById('ci-progress-title').innerText = 'Import Complete!';
                        document.getElementById('ci-progress-subtitle').innerText = data.message || 'All entries imported successfully into database!';
                        document.getElementById('ci-step-3-done-btn').classList.remove('d-none');

                    } else {
                        document.getElementById('ci-step-3').classList.add('d-none');
                        document.getElementById('ci-step-2').classList.remove('d-none');
                        btnProcess.disabled = false;
                        btnProcess.innerHTML = '<i class="feather-check-circle me-1"></i> Start Import Now';
                        Swal.fire('Import Error', data.message || 'Import failed.', 'error');
                    }
                })
                .catch(err => {
                    clearInterval(progressInterval);
                    console.error(err);
                    document.getElementById('ci-step-3').classList.add('d-none');
                    document.getElementById('ci-step-2').classList.remove('d-none');
                    btnProcess.disabled = false;
                    btnProcess.innerHTML = '<i class="feather-check-circle me-1"></i> Start Import Now';
                    Swal.fire('Error', 'An error occurred while importing data.', 'error');
                });
            });
        }
    });
</script>

<!-- ========================================== -->
<!-- COMPARE EXCEL VS DATABASE MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="compareExcelModal" tabindex="-1" aria-labelledby="compareExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            
            <!-- Modal Header -->
            <div class="modal-header bg-info text-white py-3">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center gap-2" id="compareExcelModalLabel">
                    <i class="feather-check-square fs-18"></i> Compare Excel Sheet vs Existing Database Leads
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4" style="background-color: #f8fafc;">

                <!-- STEP 1: Upload File for Comparison -->
                <div id="comp-step-1">
                    <div class="alert alert-primary border-0 shadow-sm mb-4 d-flex align-items-start gap-3" style="background-color: #f0f9ff; color: #0369a1;">
                        <i class="feather-info fs-20 mt-1"></i>
                        <div style="font-size: 13.5px;">
                            <strong>Excel Lead Comparison:</strong> Select an Excel (.xlsx, .xls) or CSV file. 
                            The system will automatically scan rows against your database by <strong>Email & Phone Number</strong> 
                            and separate <strong>Already Existing Leads</strong> vs <strong>New Leads</strong> into clear list tables.
                        </div>
                    </div>

                    <div class="card border border-2 border-dashed text-center p-5 bg-white mb-3" style="border-color: #cbd5e1 !important; border-radius: 12px;">
                        <div class="mb-3">
                            <i class="feather-search text-info display-4"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Choose Excel / CSV File to Compare</h6>
                        <p class="text-muted small mb-3">Supported formats: .xlsx, .xls, .csv</p>
                        
                        <div class="col-md-8 mx-auto">
                            <input type="file" id="comp-file-input" class="form-control form-control-lg" accept=".csv,.xlsx,.xls">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="comp-btn-start" class="btn btn-info text-white px-4 fw-bold">
                            <i class="feather-search me-1"></i> Compare with Database
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Comparison Result Tabs & Lists -->
                <div id="comp-step-2" class="d-none">

                    <!-- Summary Stat Badges -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded shadow-sm d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block text-muted small fw-semibold">Total Scanned Rows</span>
                                    <h4 class="fw-bold mb-0 text-dark" id="comp-stat-total">0</h4>
                                </div>
                                <div class="bg-soft-primary p-3 rounded-circle text-primary">
                                    <i class="feather-file-text fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded shadow-sm d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block text-muted small fw-semibold">Already in Database (Existing)</span>
                                    <h4 class="fw-bold mb-0 text-danger" id="comp-stat-existing">0</h4>
                                </div>
                                <div class="bg-soft-danger p-3 rounded-circle text-danger">
                                    <i class="feather-user-check fs-20"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white border rounded shadow-sm d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block text-muted small fw-semibold">New Fresh Leads (Unique)</span>
                                    <h4 class="fw-bold mb-0 text-success" id="comp-stat-new">0</h4>
                                </div>
                                <div class="bg-soft-success p-3 rounded-circle text-success">
                                    <i class="feather-user-plus fs-20"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <ul class="nav nav-pills mb-3 border-bottom pb-2 gap-2" id="compTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold px-3 py-2 btn-soft-danger" id="comp-existing-tab" data-bs-toggle="tab" data-bs-target="#comp-existing-pane" type="button" role="tab">
                                <i class="feather-user-x me-1"></i> Existing Leads in DB (<span id="comp-badge-existing">0</span>)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold px-3 py-2 btn-soft-success ms-2" id="comp-new-tab" data-bs-toggle="tab" data-bs-target="#comp-new-pane" type="button" role="tab">
                                <i class="feather-check-circle me-1"></i> New / Fresh Leads (<span id="comp-badge-new">0</span>)
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="compTabContent">
                        
                        <!-- Pane 1: Existing Leads List (Duplicates) -->
                        <div class="tab-pane fade show active" id="comp-existing-pane" role="tabpanel">
                            <div class="card border shadow-sm">
                                <div class="card-header bg-light py-2 fw-bold text-danger d-flex align-items-center justify-content-between">
                                    <span><i class="feather-alert-circle me-1"></i> Leads Already Present in Database (Check box to force import duplicate)</span>
                                    <span class="badge bg-danger">Duplicate Leads</span>
                                </div>
                                <div class="card-body p-0 overflow-auto" style="max-height: 320px;">
                                    <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light sticky-top">
                                            <tr>
                                                <th width="45" class="text-center">
                                                    <input type="checkbox" class="form-check-input" id="comp-check-all-existing" style="cursor: pointer;" title="Select/Deselect All Duplicates">
                                                </th>
                                                <th># Row</th>
                                                <th>Sheet Name</th>
                                                <th>Sheet Email</th>
                                                <th>Sheet Phone</th>
                                                <th>Matched DB Name</th>
                                                <th>Match Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody id="comp-existing-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pane 2: New Leads List -->
                        <div class="tab-pane fade" id="comp-new-pane" role="tabpanel">
                            <div class="card border shadow-sm">
                                <div class="card-header bg-light py-2 fw-bold text-success d-flex align-items-center justify-content-between">
                                    <span><i class="feather-check-circle me-1"></i> Fresh New Leads (Not Present in DB)</span>
                                    <span class="badge bg-success">Ready to Import</span>
                                </div>
                                <div class="card-body p-0 overflow-auto" style="max-height: 320px;">
                                    <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light sticky-top">
                                            <tr>
                                                <th width="45" class="text-center">
                                                    <input type="checkbox" class="form-check-input" id="comp-check-all-new" checked style="cursor: pointer;" title="Select/Deselect All New Leads">
                                                </th>
                                                <th># Row</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Phone Number</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="comp-new-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 mt-3 border-top">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetCompareModal()">
                            <i class="feather-arrow-left me-1"></i> Compare Another File
                        </button>
                        <button type="button" id="comp-btn-import-selected" class="btn btn-success fw-bold px-4 shadow-sm" onclick="proceedFromCompareToImport()">
                            <i class="feather-upload me-1"></i> Proceed to Import Selected Leads (<span id="comp-selected-count">0</span> Selected)
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    let compLastResponseData = null;

    function openCompareExcelModal() {
        resetCompareModal();
        var modal = new bootstrap.Modal(document.getElementById('compareExcelModal'));
        modal.show();
    }

    function resetCompareModal() {
        document.getElementById('comp-step-1').classList.remove('d-none');
        document.getElementById('comp-step-2').classList.add('d-none');
        document.getElementById('comp-file-input').value = '';
        compLastResponseData = null;
    }

    function updateCompareSelectedCount() {
        const checkedCount = document.querySelectorAll('.comp-row-cb:checked').length;
        const countSpan = document.getElementById('comp-selected-count');
        if (countSpan) countSpan.innerText = checkedCount;
    }

    function proceedFromCompareToImport() {
        const checkedBoxes = document.querySelectorAll('.comp-row-cb:checked');
        if (!checkedBoxes.length) {
            Swal.fire('No Leads Selected', 'Please check at least one lead (New or Duplicate) to proceed with import.', 'warning');
            return;
        }

        const selectedRows = Array.from(checkedBoxes).map(cb => parseInt(cb.value));

        const compModalEl = document.getElementById('compareExcelModal');
        const compModal = bootstrap.Modal.getInstance(compModalEl);
        if (compModal) compModal.hide();

        setTimeout(() => {
            resetToStep1();

            const elTempId = document.getElementById('ci-temp-file-id');
            if (elTempId && compLastResponseData && compLastResponseData.temp_file_id) {
                elTempId.value = compLastResponseData.temp_file_id;
            }

            const elSelectedRows = document.getElementById('ci-selected-rows');
            if (elSelectedRows) {
                elSelectedRows.value = JSON.stringify(selectedRows);
            }

            if (compLastResponseData && compLastResponseData.headers) {
                const elFileInfo = document.getElementById('ci-file-info');
                if (elFileInfo) elFileInfo.innerText = `File compared successfully! (${selectedRows.length} rows selected for import)`;

                const elHeaderCount = document.getElementById('ci-header-count');
                if (elHeaderCount) elHeaderCount.innerText = `${compLastResponseData.headers.length} Sheet Columns`;

                populateTwoColumnMapping(compLastResponseData.headers, compLastResponseData.preview || []);
                populatePreviewTable(compLastResponseData.headers, compLastResponseData.preview || []);

                document.getElementById('ci-step-1').classList.add('d-none');
                document.getElementById('ci-step-2').classList.remove('d-none');
            }

            var customImportModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('customImportModal'));
            customImportModal.show();

            Swal.fire({
                icon: 'info',
                title: 'Selected Rows Ready',
                text: `${selectedRows.length} selected row(s) (including checked duplicates) loaded into mapping step!`,
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const btnCompareStart = document.getElementById('comp-btn-start');
        const compFileInput = document.getElementById('comp-file-input');

        // Select/Deselect All Existing Checkboxes
        const chkAllExisting = document.getElementById('comp-check-all-existing');
        if (chkAllExisting) {
            chkAllExisting.addEventListener('change', function () {
                document.querySelectorAll('.comp-existing-cb').forEach(cb => {
                    cb.checked = this.checked;
                });
                updateCompareSelectedCount();
            });
        }

        // Select/Deselect All New Checkboxes
        const chkAllNew = document.getElementById('comp-check-all-new');
        if (chkAllNew) {
            chkAllNew.addEventListener('change', function () {
                document.querySelectorAll('.comp-new-cb').forEach(cb => {
                    cb.checked = this.checked;
                });
                updateCompareSelectedCount();
            });
        }

        if (btnCompareStart) {
            btnCompareStart.addEventListener('click', function () {
                if (!compFileInput.files.length) {
                    Swal.fire('File Required', 'Please select an Excel or CSV file to compare.', 'warning');
                    return;
                }

                const file = compFileInput.files[0];
                const formData = new FormData();
                formData.append('file', file);

                btnCompareStart.disabled = true;
                btnCompareStart.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Comparing Data...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch("{{ route('modern.leads.compare') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    btnCompareStart.disabled = false;
                    btnCompareStart.innerHTML = '<i class="feather-search me-1"></i> Compare with Database';

                    if (data.status === 'success') {
                        compLastResponseData = data;

                        document.getElementById('comp-stat-total').innerText = data.total_scanned;
                        document.getElementById('comp-stat-existing').innerText = data.existing_count;
                        document.getElementById('comp-stat-new').innerText = data.new_count;
                        document.getElementById('comp-badge-existing').innerText = data.existing_count;
                        document.getElementById('comp-badge-new').innerText = data.new_count;

                        // Render Existing Leads Table (Duplicates)
                        const existingTbody = document.getElementById('comp-existing-tbody');
                        existingTbody.innerHTML = '';
                        if (data.existing_list.length === 0) {
                            existingTbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted py-3">No existing leads found in database. All rows are new!</td></tr>';
                        } else {
                            data.existing_list.forEach(item => {
                                const tr = document.createElement('tr');
                                tr.className = 'align-middle';
                                tr.innerHTML = `
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input comp-row-cb comp-existing-cb" value="${item.row}" style="cursor: pointer;">
                                    </td>
                                    <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                                    <td class="fw-bold">${escapeHtml(item.name)}</td>
                                    <td>${escapeHtml(item.email)}</td>
                                    <td>${escapeHtml(item.phone)}</td>
                                    <td class="text-danger fw-semibold"><i class="feather-user me-1"></i>${escapeHtml(item.db_name)}</td>
                                    <td><span class="badge bg-soft-danger text-danger">${escapeHtml(item.match_type)}</span></td>
                                `;
                                existingTbody.appendChild(tr);
                            });
                        }

                        // Render New Leads Table
                        const newTbody = document.getElementById('comp-new-tbody');
                        newTbody.innerHTML = '';
                        if (data.new_list.length === 0) {
                            newTbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-3">No new leads found in Excel file.</td></tr>';
                        } else {
                            data.new_list.forEach(item => {
                                const tr = document.createElement('tr');
                                tr.className = 'align-middle';
                                tr.innerHTML = `
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input comp-row-cb comp-new-cb" value="${item.row}" checked style="cursor: pointer;">
                                    </td>
                                    <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                                    <td class="fw-bold">${escapeHtml(item.name)}</td>
                                    <td>${escapeHtml(item.email)}</td>
                                    <td>${escapeHtml(item.phone)}</td>
                                    <td><span class="badge bg-soft-success text-success"><i class="feather-check me-1"></i>Fresh Entry</span></td>
                                `;
                                newTbody.appendChild(tr);
                            });
                        }

                        // Add change listeners to individual row checkboxes
                        document.querySelectorAll('.comp-row-cb').forEach(cb => {
                            cb.addEventListener('change', updateCompareSelectedCount);
                        });

                        updateCompareSelectedCount();

                        // Switch to Step 2
                        document.getElementById('comp-step-1').classList.add('d-none');
                        document.getElementById('comp-step-2').classList.remove('d-none');

                    } else {
                        Swal.fire('Comparison Error', data.message || 'Could not compare file.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    btnCompareStart.disabled = false;
                    btnCompareStart.innerHTML = '<i class="feather-search me-1"></i> Compare with Database';
                    Swal.fire('Error', 'An error occurred while comparing file.', 'error');
                });
            });
        }
    });
</script>

<!-- ========================================== -->
<!-- ADD SYSTEM CUSTOM ATTRIBUTE BOOTSTRAP MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="addCustomAttributeModal" tabindex="-1" aria-labelledby="addCustomAttributeModalLabel" aria-hidden="true" style="z-index: 1070;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white fs-15 d-flex align-items-center gap-2" id="addCustomAttributeModalLabel">
                    <i class="feather-plus-circle"></i> Create System Custom Attribute
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white">
                <form id="createCustomAttrModalForm" onsubmit="event.preventDefault(); submitCustomAttributeModal();">
                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold fs-13 mb-1">Attribute Display Label <span class="text-danger">*</span></label>
                        <input type="text" id="caa_label" class="form-control" placeholder="e.g. Passport Expiry Date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold fs-13 mb-1">System Database Field Key</label>
                        <input type="text" id="caa_field_name" class="form-control bg-light" placeholder="e.g. passport_expiry_date" readonly>
                        <small class="text-muted fs-11">This field key will be saved in system <code>lead_questions</code> table.</small>
                    </div>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="caa_is_active" checked>
                        <label class="form-check-label fw-semibold text-dark fs-13" for="caa_is_active">Set as Active Attribute</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2.5 px-4 border-top">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="btn-save-custom-attr-modal" class="btn btn-primary px-4 fw-bold" onclick="submitCustomAttributeModal()">
                    <i class="feather-check-circle me-1"></i> Save & Select Attribute
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labelInp = document.getElementById('caa_label');
        if (labelInp) {
            labelInp.addEventListener('input', function() {
                document.getElementById('caa_field_name').value = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
            });
        }
    });

    function submitCustomAttributeModal() {
        const label = document.getElementById('caa_label').value.trim();
        const fieldName = document.getElementById('caa_field_name').value.trim();
        const isActive = document.getElementById('caa_is_active').checked ? 1 : 0;

        if (!label || !fieldName) {
            Swal.fire('Validation Error', 'Please enter a valid attribute display label!', 'warning');
            return;
        }

        const saveBtn = document.getElementById('btn-save-custom-attr-modal');
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch("{{ route('lead_questions.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                label: label,
                field_name: fieldName,
                is_active: isActive
            })
        })
        .then(res => res.json())
        .then(data => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="feather-check-circle me-1"></i> Save & Select Attribute';

            const modalEl = document.getElementById('addCustomAttributeModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();

            document.querySelectorAll('.ci-excel-header-select').forEach(selectEl => {
                let existingOpt = Array.from(selectEl.options).find(opt => opt.value === fieldName);
                if (!existingOpt) {
                    existingOpt = document.createElement('option');
                    existingOpt.value = fieldName;
                    existingOpt.innerText = `✨ ${label} [${fieldName}]`;
                    selectEl.insertBefore(existingOpt, selectEl.children[1] || null);
                }
            });

            if (currentTargetSelectEl) {
                currentTargetSelectEl.value = fieldName;
                currentTargetSelectEl.dispatchEvent(new Event('change'));
            }

            Swal.fire({
                icon: 'success',
                title: 'Attribute Created!',
                text: `"${label}" saved to system lead_questions table and selected.`,
                toast: true,
                position: 'top-end',
                timer: 2500,
                showConfirmButton: false
            });
        })
        .catch(err => {
            console.error(err);
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="feather-check-circle me-1"></i> Save & Select Attribute';

            const modalEl = document.getElementById('addCustomAttributeModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();

            if (currentTargetSelectEl) {
                let existingOpt = Array.from(currentTargetSelectEl.options).find(opt => opt.value === fieldName);
                if (!existingOpt) {
                    existingOpt = document.createElement('option');
                    existingOpt.value = fieldName;
                    existingOpt.innerText = `✨ ${label} [${fieldName}]`;
                    currentTargetSelectEl.insertBefore(existingOpt, currentTargetSelectEl.children[1] || null);
                }
                currentTargetSelectEl.value = fieldName;
                currentTargetSelectEl.dispatchEvent(new Event('change'));
            }
        });
    }
</script>
