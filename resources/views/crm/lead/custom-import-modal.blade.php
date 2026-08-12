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

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="ci-btn-upload" class="btn btn-primary px-4 fw-bold">
                            Upload & Map Fields <i class="feather-arrow-right ms-1"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Column Mapping UI (Hidden initially) -->
                <div id="ci-step-2" class="d-none">
                    
                    <div class="alert alert-success border-0 shadow-sm mb-3 d-flex align-items-center justify-content-between" style="background: #f0fdf4; color: #166534;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="feather-check-circle fs-18"></i>
                            <span class="small fw-semibold" id="ci-file-info">File uploaded successfully. Map your columns below:</span>
                        </div>
                        <span class="badge bg-success" id="ci-header-count">0 Headers Found</span>
                    </div>

                    <div class="alert alert-warning border-0 shadow-sm mb-4 d-flex align-items-start gap-2" style="background: #fffbeb; color: #92400e; font-size: 13px;">
                        <i class="feather-alert-triangle fs-16 mt-0.5"></i>
                        <div>
                            <strong>Note:</strong> Any Excel field that is <u>not mapped</u> to a standard database field will automatically be stored inside the <strong>custom_attributes</strong> JSON column for that lead.
                        </div>
                    </div>

                    <input type="hidden" id="ci-temp-file-id">

                    <!-- Mapping Form Grid -->
                    <form id="ci-mapping-form">

                        <!-- Column Header Title Bar -->
                        <div class="card mb-3 border-0 bg-primary text-white shadow-sm" style="border-radius: 10px;">
                            <div class="card-body py-2 px-3">
                                <div class="row align-items-center fw-bold" style="font-size: 13.5px;">
                                    <div class="col-md-6 d-flex align-items-center gap-2">
                                        <i class="feather-database"></i> 1. CRM Lead / System Field (Left Column)
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center gap-2">
                                        <i class="feather-file-text"></i> 2. Select Matching Sheet Column (Right Dropdown)
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 1: User / Contact Information -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-user text-primary"></i> User & Contact Fields (Users Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3 align-items-center">
                                    
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-dark" style="font-size: 13px;"><i class="feather-user me-2 text-primary"></i> Full Name / First Name *</span>
                                            <span class="badge bg-soft-primary text-primary" style="font-size: 10px;">Required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="name" id="map-name" data-match="name,full name,first name,client_name,student_name">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Mobile No -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-dark" style="font-size: 13px;"><i class="feather-phone me-2 text-primary"></i> Mobile No / Phone *</span>
                                            <span class="badge bg-soft-primary text-primary" style="font-size: 10px;">Required</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="contact_no" id="map-contact_no" data-match="phone,mobile,contact,phone number,contact no,phone_number">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-mail me-2 text-secondary"></i> Email Address</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="email" id="map-email" data-match="email,mail,e-mail,email address,work_email_address">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Country Code -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-globe me-2 text-secondary"></i> Country Code (e.g. +91)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="country_code" id="map-country_code" data-match="country code,code,dial code,country_code">
                                            <option value="">-- Default (+91) --</option>
                                        </select>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-briefcase me-2 text-secondary"></i> Company Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="company_name" id="map-company_name" data-match="company,company_name,organization">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-map-pin me-2 text-secondary"></i> City</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="city" id="map-city" data-match="city,location,town">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-navigation me-2 text-secondary"></i> State</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="state" id="map-state" data-match="state,province">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-hash me-2 text-secondary"></i> Pincode / Zip Code</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="pincode" id="map-pincode" data-match="pincode,zip,zipcode,postal_code">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;"><i class="feather-home me-2 text-secondary"></i> Full Address</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="address" id="map-address" data-match="address,full address,street">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Campaign, Meta & Source Fields -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-layers text-info"></i> Campaign, Meta Ads & Lead Source Fields (Leads Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3 align-items-center">
                                    
                                    <!-- Campaign Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Campaign Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="campaign_name" id="map-campaign" data-match="campaign_name,campaign">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Adset Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Adset Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="adset_name" id="map-adset" data-match="adset_name,adset">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Ad Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Ad Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="ad_name" id="map-adname" data-match="ad_name,ad">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Form Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Form Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="form_name" id="map-formname" data-match="form_name,form">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Platform / Source -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Platform / Lead Source</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="platform" id="map-platform" data-match="platform,source,lead_source,website">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Page URL -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Landing / Page URL</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="page_url" id="map-page_url" data-match="page_url,url,link">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Lead Date / Created Time</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="date" id="map-date" data-match="created_time,created_at,date,time,lead_date">
                                            <option value="">-- Auto (Current Date) --</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <!-- Section 4: Business, Product & Corporate Fields -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-briefcase text-success"></i> Business, Product & Corporate Fields (Leads Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3 align-items-center">
                                    
                                    <!-- Product -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Product / Category</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="product" id="map-product" data-match="product,category,service_category">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Services -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Services</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="services" id="map-services" data-match="services,service">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Business Name -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Business / Organization Name</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="business_name" id="map-business_name" data-match="business_name,company_name,business">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Industry -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Industry / Sector</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="industry" id="map-industry" data-match="industry,sector">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Employee Strength -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Employee Strength</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="employee_strength" id="map-employee_strength" data-match="employee_strength,employees,company_size">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Website -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Website URL</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="website" id="map-website" data-match="website,url,site">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- GST Number -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">GST Number</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="gst_number" id="map-gst_number" data-match="gst_number,gst,gstin">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Lead Status -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Lead Status / Stage</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="lead_status" id="map-lead_status" data-match="lead_status,status,stage">
                                            <option value="">-- Auto (Default Bucket Status) --</option>
                                        </select>
                                    </div>

                                    <!-- Engagement Status -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Engagement Status (Hot/Warm/Cold)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="lead_engagement_status" id="map-lead_engagement_status" data-match="engagement,lead_engagement,temperature">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Pain Points -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Pain Points / Requirements</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="pain_points" id="map-pain_points" data-match="pain_points,requirements,needs">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Description / Notes -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Description / Remarks / Notes (Leads Table)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="description" id="map-description" data-match="description,remark,notes,message,comments">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Section 5: Followup & Comment History Fields -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-message-square text-warning"></i> Followup & Comment History Fields (callback_messages Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3 align-items-center">
                                    
                                    <!-- Callback Message / Remark -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-dark" style="font-size: 13px;"><i class="feather-message-circle me-2 text-warning"></i> Add Message / Remark / Comment *</span>
                                            <span class="badge bg-soft-warning text-warning" style="font-size: 10px;">Drawer Note</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="callback_message" id="map-callback_message" data-match="message,remark,remarks,comment,comments,notes,callback_message,feedback">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Next Followup Date -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Next Follow Up Date</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="next_followup_date" id="map-next_followup_date" data-match="next_followup_date,followup_date,next_followup,follow_up_date">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Followup Type -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Communication Type (Call / Whatsapp / Note)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="followup_type" id="map-followup_type" data-match="followup_type,communication_type,type,mode">
                                            <option value="">-- Default (Imported Note) --</option>
                                        </select>
                                    </div>

                                    <!-- Followup Status -->
                                    <div class="col-md-6">
                                        <div class="p-2 border rounded bg-white">
                                            <span class="fw-semibold text-dark" style="font-size: 13px;">Communication Status (Connected / No Response)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select ci-header-select" name="followup_status" id="map-followup_status" data-match="followup_status,communication_status,call_status">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Live Data Preview Box -->
                        <div class="card mb-3 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 13px;">
                                <i class="feather-eye text-info"></i> Sample Sheet Data Preview (First 3 Rows)
                            </div>
                            <div class="card-body p-0 overflow-auto" style="max-height: 180px;">
                                <table class="table table-sm table-bordered table-striped mb-0 text-nowrap" style="font-size: 12px;" id="ci-preview-table">
                                    <thead class="table-light">
                                        <tr id="ci-preview-thead"></tr>
                                    </thead>
                                    <tbody id="ci-preview-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                    </form>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <button type="button" class="btn btn-outline-secondary" onclick="resetToStep1()">
                            <i class="feather-arrow-left me-1"></i> Back to Upload
                        </button>
                        
                        <button type="button" id="ci-btn-process" class="btn btn-success px-4 fw-bold">
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
    // Global function to open the Custom Import Modal
    function openCustomImportModal() {
        resetToStep1();
        var modal = new bootstrap.Modal(document.getElementById('customImportModal'));
        modal.show();
    }

    // Reset modal state back to Step 1
    function resetToStep1() {
        document.getElementById('ci-step-1').classList.remove('d-none');
        document.getElementById('ci-step-2').classList.add('d-none');
        document.getElementById('ci-step-3').classList.add('d-none');
        document.getElementById('ci-file-input').value = '';
        document.getElementById('ci-temp-file-id').value = '';
        
        // Reset Progress UI
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

        // Step 1: Upload File & Read Headers
        if (btnUpload) {
            btnUpload.addEventListener('click', function () {
                if (!fileInput.files.length) {
                    Swal.fire('File Required', 'Please select an Excel or CSV file to proceed.', 'warning');
                    return;
                }

                const file = fileInput.files[0];
                const formData = new FormData();
                formData.append('file', file);

                // Disable button & show spinner
                btnUpload.disabled = true;
                btnUpload.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Reading File...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                fetch("{{ route('modern.leads.import.upload') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    btnUpload.disabled = false;
                    btnUpload.innerHTML = 'Upload & Map Fields <i class="feather-arrow-right ms-1"></i>';

                    if (data.status === 'success') {
                        // Save temp file id
                        document.getElementById('ci-temp-file-id').value = data.temp_file_id;
                        document.getElementById('ci-file-info').innerText = `File "${file.name}" uploaded. Map fields below:`;
                        document.getElementById('ci-header-count').innerText = `${data.headers.length} Headers Found`;

                        // Populate Dropdowns in Step 2
                        populateMappingDropdowns(data.headers);

                        // Populate Data Preview Table
                        populatePreviewTable(data.headers, data.preview);

                        // Switch view to Step 2
                        document.getElementById('ci-step-1').classList.add('d-none');
                        document.getElementById('ci-step-2').classList.remove('d-none');
                    } else {
                        Swal.fire('Upload Error', data.message || 'Could not read file.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    btnUpload.disabled = false;
                    btnUpload.innerHTML = 'Upload & Map Fields <i class="feather-arrow-right ms-1"></i>';
                    Swal.fire('Error', 'An unexpected error occurred while uploading file.', 'error');
                });
            });
        }

        // Helper to populate header dropdown selects with smart auto-selection
        function populateMappingDropdowns(headers) {
            const selectElements = document.querySelectorAll('.ci-header-select');

            selectElements.forEach(select => {
                // Clear existing dynamic options (keep option 0 default)
                select.innerHTML = select.options[0].outerHTML;

                const matchKeywords = (select.getAttribute('data-match') || '').toLowerCase().split(',').map(s => s.trim());
                let bestMatchOption = null;
                let maxScore = 0;

                headers.forEach(h => {
                    const option = document.createElement('option');
                    option.value = h.name;
                    option.text = `${h.name} (Col ${h.col})`;
                    select.appendChild(option);

                    const headerLower = h.name.toLowerCase().trim();

                    // Avoid matching ad_name/campaign_name for Name & Contact
                    if ((select.name === 'name' || select.name === 'contact_no') && (headerLower.includes('ad_') || headerLower.includes('campaign_'))) {
                        return;
                    }

                    let score = 0;
                    matchKeywords.forEach(kw => {
                        if (!kw) return;
                        if (headerLower === kw) {
                            score += 10; // Exact match
                        } else if (headerLower.replace(/[^a-z0-9]/g, '_') === kw.replace(/[^a-z0-9]/g, '_')) {
                            score += 9;
                        } else if (headerLower.includes(kw)) {
                            score += 5;
                        }
                    });

                    if (score > maxScore) {
                        maxScore = score;
                        bestMatchOption = option;
                    }
                });

                if (bestMatchOption && maxScore > 0) {
                    bestMatchOption.selected = true;
                }
            });
        }

        // Helper to populate sample preview table
        function populatePreviewTable(headers, previewRows) {
            const thead = document.getElementById('ci-preview-thead');
            const tbody = document.getElementById('ci-preview-tbody');

            thead.innerHTML = '';
            tbody.innerHTML = '';

            headers.forEach(h => {
                const th = document.createElement('th');
                th.innerText = h.name;
                thead.appendChild(th);
            });

            (previewRows || []).forEach(row => {
                const tr = document.createElement('tr');
                headers.forEach(h => {
                    const td = document.createElement('td');
                    td.innerText = row[h.name] || '';
                    tr.appendChild(td);
                });
                tbody.appendChild(tr);
            });
        }

        // Step 2: Final Import Submission with Live Row-by-Row Progress
        if (btnProcess) {
            btnProcess.addEventListener('click', function () {
                const tempFileId = document.getElementById('ci-temp-file-id').value;
                if (!tempFileId) {
                    Swal.fire('Error', 'Temporary file ID is missing. Please re-upload your file.', 'error');
                    return;
                }

                // Build mapping object
                const mapping = {};
                const selectElements = document.querySelectorAll('.ci-header-select');

                selectElements.forEach(select => {
                    if (select.value) {
                        mapping[select.name] = select.value;
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

                fetch("{{ route('modern.leads.import.process') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        temp_file_id: tempFileId,
                        mapping: mapping
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
                        
                        <!-- Pane 1: Existing Leads List -->
                        <div class="tab-pane fade show active" id="comp-existing-pane" role="tabpanel">
                            <div class="card border shadow-sm">
                                <div class="card-header bg-light py-2 fw-bold text-danger d-flex align-items-center justify-content-between">
                                    <span><i class="feather-alert-circle me-1"></i> Leads Already Present in Database (Matched by Email/Phone)</span>
                                    <span class="badge bg-danger">Duplicate Warning</span>
                                </div>
                                <div class="card-body p-0 overflow-auto" style="max-height: 300px;">
                                    <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light sticky-top">
                                            <tr>
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
                                <div class="card-body p-0 overflow-auto" style="max-height: 300px;">
                                    <table class="table table-sm table-striped table-hover mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light sticky-top">
                                            <tr>
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
                        <button type="button" class="btn btn-primary fw-bold" onclick="switchToCustomImport()">
                            <i class="feather-upload me-1"></i> Proceed to Custom Import
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function openCompareExcelModal() {
        resetCompareModal();
        var modal = new bootstrap.Modal(document.getElementById('compareExcelModal'));
        modal.show();
    }

    function resetCompareModal() {
        document.getElementById('comp-step-1').classList.remove('d-none');
        document.getElementById('comp-step-2').classList.add('d-none');
        document.getElementById('comp-file-input').value = '';
    }

    function switchToCustomImport() {
        const compModalEl = document.getElementById('compareExcelModal');
        const compModal = bootstrap.Modal.getInstance(compModalEl);
        if (compModal) compModal.hide();

        setTimeout(() => {
            openCustomImportModal();
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const btnCompareStart = document.getElementById('comp-btn-start');
        const compFileInput = document.getElementById('comp-file-input');

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
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    btnCompareStart.disabled = false;
                    btnCompareStart.innerHTML = '<i class="feather-search me-1"></i> Compare with Database';

                    if (data.status === 'success') {
                        document.getElementById('comp-stat-total').innerText = data.total_scanned;
                        document.getElementById('comp-stat-existing').innerText = data.existing_count;
                        document.getElementById('comp-stat-new').innerText = data.new_count;
                        document.getElementById('comp-badge-existing').innerText = data.existing_count;
                        document.getElementById('comp-badge-new').innerText = data.new_count;

                        // Render Existing Leads Table
                        const existingTbody = document.getElementById('comp-existing-tbody');
                        existingTbody.innerHTML = '';
                        if (data.existing_list.length === 0) {
                            existingTbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-3">No existing leads found in database. All rows are new!</td></tr>';
                        } else {
                            data.existing_list.forEach(item => {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                                    <td class="fw-bold">${item.name}</td>
                                    <td>${item.email}</td>
                                    <td>${item.phone}</td>
                                    <td class="text-danger fw-semibold"><i class="feather-user me-1"></i>${item.db_name}</td>
                                    <td><span class="badge bg-soft-danger text-danger">${item.match_type}</span></td>
                                `;
                                existingTbody.appendChild(tr);
                            });
                        }

                        // Render New Leads Table
                        const newTbody = document.getElementById('comp-new-tbody');
                        newTbody.innerHTML = '';
                        if (data.new_list.length === 0) {
                            newTbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-3">No new leads found in Excel file.</td></tr>';
                        } else {
                            data.new_list.forEach(item => {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                    <td><span class="badge bg-secondary">Row ${item.row}</span></td>
                                    <td class="fw-bold">${item.name}</td>
                                    <td>${item.email}</td>
                                    <td>${item.phone}</td>
                                    <td><span class="badge bg-soft-success text-success"><i class="feather-check me-1"></i>Fresh Entry</span></td>
                                `;
                                newTbody.appendChild(tr);
                            });
                        }

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
