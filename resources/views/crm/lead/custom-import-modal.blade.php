<!-- ========================================== -->
<!-- TWO-STEP CUSTOM EXCEL / CSV IMPORT MODAL -->
<!-- ========================================== -->
<div class="modal fade" id="customImportModal" tabindex="-1" aria-labelledby="customImportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                        
                        <!-- Section 1: User / Contact Information -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-user text-primary"></i> User & Contact Fields (Users Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-secondary mb-1" style="font-size: 12.5px;">Full Name / First Name *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-user"></i></span>
                                            <select class="form-select ci-header-select" name="name" id="map-name" data-match="name,full name,first name,client_name,student_name">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Mobile No -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-secondary mb-1" style="font-size: 12.5px;">Mobile No / Phone *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-phone"></i></span>
                                            <select class="form-select ci-header-select" name="contact_no" id="map-contact_no" data-match="phone,mobile,contact,phone number,contact no,phone_number">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-mail"></i></span>
                                            <select class="form-select ci-header-select" name="email" id="map-email" data-match="email,mail,e-mail,email address,work_email_address">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Country Code -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Country Code (e.g. +91)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-globe"></i></span>
                                            <select class="form-select ci-header-select" name="country_code" id="map-country_code" data-match="country code,code,dial code,country_code">
                                                <option value="">-- Default (+91) --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Company Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-briefcase"></i></span>
                                            <select class="form-select ci-header-select" name="company_name" id="map-company_name" data-match="company,company_name,organization">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">City</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-map-pin"></i></span>
                                            <select class="form-select ci-header-select" name="city" id="map-city" data-match="city,location,town">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">State</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-navigation"></i></span>
                                            <select class="form-select ci-header-select" name="state" id="map-state" data-match="state,province">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Pincode / Zip Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-hash"></i></span>
                                            <select class="form-select ci-header-select" name="pincode" id="map-pincode" data-match="pincode,zip,zipcode,postal_code">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Full Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-home"></i></span>
                                            <select class="form-select ci-header-select" name="address" id="map-address" data-match="address,full address,street">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
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
                                <div class="row g-3">
                                    
                                    <!-- Campaign Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Campaign Name</label>
                                        <select class="form-select ci-header-select" name="campaign_name" id="map-campaign" data-match="campaign_name,campaign">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Adset Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Adset Name</label>
                                        <select class="form-select ci-header-select" name="adset_name" id="map-adset" data-match="adset_name,adset">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Ad Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Ad Name</label>
                                        <select class="form-select ci-header-select" name="ad_name" id="map-adname" data-match="ad_name,ad">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Form Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Form Name</label>
                                        <select class="form-select ci-header-select" name="form_name" id="map-formname" data-match="form_name,form">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Platform / Source -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Platform / Lead Source</label>
                                        <select class="form-select ci-header-select" name="platform" id="map-platform" data-match="platform,source,lead_source,website">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Page URL -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Landing / Page URL</label>
                                        <select class="form-select ci-header-select" name="page_url" id="map-page_url" data-match="page_url,url,link">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Lead Date / Created Time</label>
                                        <select class="form-select ci-header-select" name="date" id="map-date" data-match="created_time,created_at,date,time,lead_date">
                                            <option value="">-- Auto (Current Date) --</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Academic, Requirement & Visa Fields -->
                        <div class="card mb-4 border shadow-sm">
                            <div class="card-header bg-light py-2 fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 14px;">
                                <i class="feather-target text-primary"></i> Academic, Visa & Requirement Fields (Leads Table)
                            </div>
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    
                                    <!-- Applying Country -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Applying Country / Visa Destination</label>
                                        <select class="form-select ci-header-select" name="applying_country_for_a_visa" id="map-country" data-match="country,destination,applying_country,visa_country">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Visa Type -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Visa Type</label>
                                        <select class="form-select ci-header-select" name="visa_type" id="map-visa_type" data-match="visa_type,visa">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Target Course -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Target Course / Program</label>
                                        <select class="form-select ci-header-select" name="what_course_are_you_planning_to_study" id="map-course" data-match="course,program,study,planning_to_study">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Preferred Intake -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Preferred Intake</label>
                                        <select class="form-select ci-header-select" name="whats_your_preferred_intake" id="map-intake" data-match="intake,preferred_intake,target_intake">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Budget -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Budget Range</label>
                                        <select class="form-select ci-header-select" name="budget" id="map-budget" data-match="budget,expected_budget,amount">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Highest Education -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Highest Education / Qualification</label>
                                        <select class="form-select ci-header-select" name="highest_completed" id="map-education" data-match="education,qualification,highest_completed,academic">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Any Academic Gap -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Any Academic Gap</label>
                                        <select class="form-select ci-header-select" name="any_academic_gap" id="map-academic_gap" data-match="academic_gap,gap">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- English Test Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">English Test Status (IELTS/PTE)</label>
                                        <select class="form-select ci-header-select" name="english_test_status" id="map-english" data-match="english,ielts,pte,english_test">
                                            <option value="">-- Ignore / Not in file --</option>
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
                                <div class="row g-3">
                                    
                                    <!-- Product -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Product / Category</label>
                                        <select class="form-select ci-header-select" name="product" id="map-product" data-match="product,category,service_category">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Services -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Services</label>
                                        <select class="form-select ci-header-select" name="services" id="map-services" data-match="services,service">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Business Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Business / Organization Name</label>
                                        <select class="form-select ci-header-select" name="business_name" id="map-business_name" data-match="business_name,company_name,business">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Industry -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Industry / Sector</label>
                                        <select class="form-select ci-header-select" name="industry" id="map-industry" data-match="industry,sector">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Employee Strength -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Employee Strength</label>
                                        <select class="form-select ci-header-select" name="employee_strength" id="map-employee_strength" data-match="employee_strength,employees,company_size">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Website -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Website URL</label>
                                        <select class="form-select ci-header-select" name="website" id="map-website" data-match="website,url,site">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- GST Number -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">GST Number</label>
                                        <select class="form-select ci-header-select" name="gst_number" id="map-gst_number" data-match="gst_number,gst,gstin">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Lead Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Lead Status / Stage</label>
                                        <select class="form-select ci-header-select" name="lead_status" id="map-lead_status" data-match="lead_status,status,stage">
                                            <option value="">-- Auto (Default Bucket Status) --</option>
                                        </select>
                                    </div>

                                    <!-- Engagement Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Engagement Status (Hot/Warm/Cold)</label>
                                        <select class="form-select ci-header-select" name="lead_engagement_status" id="map-lead_engagement_status" data-match="engagement,lead_engagement,temperature">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Pain Points -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Pain Points / Requirements</label>
                                        <select class="form-select ci-header-select" name="pain_points" id="map-pain_points" data-match="pain_points,requirements,needs">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Description / Notes -->
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Description / Remarks / Notes (Leads Table)</label>
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
                                <div class="row g-3">
                                    
                                    <!-- Callback Message / Remark -->
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-secondary mb-1" style="font-size: 12.5px;">Add Message / Remark / Comment *</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="feather-message-circle"></i></span>
                                            <select class="form-select ci-header-select" name="callback_message" id="map-callback_message" data-match="message,remark,remarks,comment,comments,notes,callback_message,feedback">
                                                <option value="">-- Ignore / Not in file --</option>
                                            </select>
                                        </div>
                                        <small class="text-muted" style="font-size: 11px;">Any message mapped here will be saved directly into the lead's Comment History drawer.</small>
                                    </div>

                                    <!-- Next Followup Date -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Next Follow Up Date</label>
                                        <select class="form-select ci-header-select" name="next_followup_date" id="map-next_followup_date" data-match="next_followup_date,followup_date,next_followup,follow_up_date">
                                            <option value="">-- Ignore / Not in file --</option>
                                        </select>
                                    </div>

                                    <!-- Followup Type -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Communication Type (Call / Whatsapp / Note)</label>
                                        <select class="form-select ci-header-select" name="followup_type" id="map-followup_type" data-match="followup_type,communication_type,type,mode">
                                            <option value="">-- Default (Imported Note) --</option>
                                        </select>
                                    </div>

                                    <!-- Followup Status -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary mb-1" style="font-size: 12.5px;">Communication Status (Connected / No Response)</label>
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
        document.getElementById('ci-file-input').value = '';
        document.getElementById('ci-temp-file-id').value = '';
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

        // Step 2: Final Import Submission
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

                // Show processing indicator
                btnProcess.disabled = true;
                btnProcess.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Importing Data...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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
                    btnProcess.disabled = false;
                    btnProcess.innerHTML = '<i class="feather-check-circle me-1"></i> Start Import Now';

                    if (data.status === 'success') {
                        // Hide modal
                        const modalEl = document.getElementById('customImportModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Import Completed!',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Import Error', data.message || 'Import failed.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    btnProcess.disabled = false;
                    btnProcess.innerHTML = '<i class="feather-check-circle me-1"></i> Start Import Now';
                    Swal.fire('Error', 'An error occurred while importing data.', 'error');
                });
            });
        }
    });
</script>
