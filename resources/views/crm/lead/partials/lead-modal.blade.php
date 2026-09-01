    {{-- ADD/EDIT LEAD FORM --}}
    <div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-light border-bottom">
                    <h5 class="modal-title fw-bold text-dark" id="leadModalTitle">
                        <i class="feather-user text-primary me-2"></i> <span>Create New Lead</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="leadForm" method="POST" enctype="multipart/form-data" action="{{ route('lead.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="modal-body p-3 bg-white" style="max-height: 65vh; overflow-y: auto;">
                        <!-- Upper Section: Side-by-Side Left and Right Columns -->
                        <div class="row">
                            <!-- Left Column: Client Details -->
                            <div class="col-lg-6 border-end pe-3">
                                <h6 class="fw-bold mb-2 text-primary border-bottom pb-1">Client Details</h6>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Client Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="inp_name" class="form-control form-control-sm auto-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Mobile <span class="text-danger">*</span></label>
                                        <input type="tel" name="mobile" id="inp_mobile" class="form-control form-control-sm phone-input" required>
                                        <input type="hidden" name="country_code" id="inp_country_code" class="country-code-input">
                                    </div>
                                    
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Email</label>
                                        <input type="email" name="email" id="inp_email" class="form-control form-control-sm auto-email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Company Name</label>
                                        <input type="text" name="business_name" id="inp_business" class="form-control form-control-sm" placeholder="Company Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">City</label>
                                        <input type="text" name="city" id="inp_city" class="form-control form-control-sm auto-city" placeholder="City">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">State</label>
                                        <input type="text" name="state" id="inp_state" class="form-control form-control-sm" placeholder="State">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label-sm">Pincode</label>
                                        <input type="text" name="pincode" id="inp_pincode" class="form-control form-control-sm" placeholder="Pincode / Zip">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label-sm">Address</label>
                                        <textarea name="address" id="inp_address" class="form-control form-control-sm" rows="2" placeholder="Full Street Address..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Employee Strength</label>
                                        <select name="employee_strength" id="inp_employee_strength" class="form-select form-select-sm">
                                            <option value="">Select Strength</option>
                                            <option value="1-10 employees">1-10 employees</option>
                                            <option value="11-50 employees">11-50 employees</option>
                                            <option value="51-200 employees">51-200 employees</option>
                                            <option value="201-500 employees">201-500 employees</option>
                                            <option value="500+ employees">500+ employees</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Industry</label>
                                        <select name="industry" id="inp_industry" class="form-select form-select-sm">
                                            <option value="">Select Industry</option>
                                            <option value="IT & Technology">IT & Technology</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Finance & Banking">Finance & Banking</option>
                                            <option value="Education">Education</option>
                                            <option value="Real Estate">Real Estate</option>
                                            <option value="Retail & E-commerce">Retail & E-commerce</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Professional Services">Professional Services</option>
                                            <option value="Marketing & Advertising">Marketing & Advertising</option>
                                            <option value="Logistics & Transportation">Logistics & Transportation</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-sm">Website</label>
                                        <input type="text" name="website" id="inp_website"  class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">GST NO.</label>
                                        <input type="text" name="gst_number" id="inp_gst" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label-sm fw-semibold text-secondary d-flex align-items-center justify-content-between mb-1">
                                            <span><i class="fas fa-tags text-primary me-1"></i>Tags</span>
                                            <a href="{{ route('tags.index') }}" target="_blank" class="text-primary text-decoration-none fs-11 fw-normal" title="Tag Master">+ Manage Tags</a>
                                        </label>
                                        
                                        <!-- Custom Multi-Select Tag Dropdown -->
                                        <div class="custom-tag-multiselect dropdown" id="leadTagMultiSelectWrap">
                                            <div class="tag-select-trigger form-control d-flex align-items-center justify-content-between flex-wrap gap-1 p-2" 
                                                 data-bs-toggle="dropdown" 
                                                 data-bs-auto-close="outside" 
                                                 aria-expanded="false" 
                                                 role="button" 
                                                 style="min-height: 40px; cursor: pointer; border-radius: 8px; border-color: #cbd5e1; background-color: #fff;">
                                                <div class="selected-tags-chips d-flex align-items-center flex-wrap gap-1" id="leadModalSelectedTagsChips">
                                                    <span class="placeholder-text text-muted fs-12"><i class="fas fa-tag me-1 text-secondary opacity-50"></i>Select tags...</span>
                                                </div>
                                                <i class="fas fa-chevron-down text-muted fs-11 ms-auto"></i>
                                            </div>
                                            
                                            <div class="dropdown-menu p-2 shadow-lg border-0 w-100 mt-1" style="max-height: 280px; overflow-y: auto; border-radius: 10px; z-index: 1060;">
                                                <div class="px-2 py-1 mb-1 border-bottom">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted fs-11"></i></span>
                                                        <input type="text" class="form-control form-control-sm border-0 bg-light shadow-none" placeholder="Search tags..." id="leadModalTagSearch" oninput="filterTagOptions(this, 'leadModalTagList')">
                                                    </div>
                                                </div>
                                                
                                                <div class="tag-options-list py-1" id="leadModalTagList">
                                                    @forelse(($allTags ?? collect()) as $tag)
                                                        <label class="tag-option-item dropdown-item d-flex align-items-center justify-content-between py-1.5 px-2 rounded cursor-pointer mb-0.5" style="cursor: pointer;">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <input type="checkbox" class="form-check-input m-0 tag-checkbox" value="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" data-tag-color="{{ $tag->color }}" onchange="syncTagSelection('leadModal')">
                                                                <span class="badge rounded-pill text-white fs-11" style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                                                            </div>
                                                            <span class="text-muted fs-11">ID #{{ $tag->id }}</span>
                                                        </label>
                                                    @empty
                                                        <div class="text-center py-2 text-muted fs-12">No tags found. Create in Tag Master.</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            
                                            <!-- Hidden synced multi-select for form submission -->
                                            <select name="tag_ids[]" id="inp_tags" class="d-none" multiple>
                                                @foreach(($allTags ?? collect()) as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <small class="text-muted fs-11 mt-1 d-block">Dropdown se multiple tags select kar sakte hain.</small>
                                    </div>
                                </div>

                                <!-- Additional Contacts (Cloned) under Client Details -->
                                <div class="mt-4 border-top pt-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.9rem;">Additional Contacts</h6>
                                            <span id="contactCountBadge" class="badge bg-soft-primary text-primary rounded-pill px-2 py-0.5" style="font-size: 0.75rem; line-height: 1;">0</span>
                                        </div>
                                        <button type="button" id="btnAddContact" class="btn btn-xs text-white d-flex align-items-center gap-1 fw-medium" style="background-color: #006FC9; font-size: 0.75rem; padding: 0.25rem 0.5rem; border: none; transition: background-color 0.2s ease;">
                                            <i class="feather-plus"></i> Clone Contact
                                        </button>
                                    </div>
                                    <div id="clonedContactsContainer" class="mt-2"></div>
                                </div>
                            </div>

                            <!-- Right Column: Lead Details -->
                            <div class="col-lg-6 ps-3">
                                <h6 class="fw-bold mb-2 text-primary border-bottom pb-1">Lead Details</h6>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Lead Source</label>
                                        <select name="platform" id="inp_platform" class="form-select form-select-sm">
                                            <option value="">Select Source</option>
                                            @foreach($sources ?? [] as $source)
                                                <option value="{{ $source }}">{{ $source }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Lead Owner</label>
                                        <select name="lead_owner" id="inp_owner" class="form-select form-select-sm">
                                            <option value="">Select Owner</option>
                                            @foreach($owners ?? [] as $owner)
                                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Budget</label>
                                        <input type="text" name="budget" id="inp_budget" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-sm">Choose Product</label>
                                        <select name="product" id="inp_product" class="form-select form-select-sm">
                                            <option value="">Select Product</option>
                                            <option value="SAAS">SAAS</option>
                                            <option value="SAAP">SAAP</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="row g-2 mb-2">
                                <div class="col-md-12">
                                        <label class="form-label-sm">Service</label>
                                        <select name="services[]" id="inp_services" class="form-select" data-select2-selector="label" multiple>
                                            @foreach(($categorys ?? $categories ?? \App\Models\Category::where('is_active', 1)->orderBy('category_name')->get()) as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                               
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <label class="form-label-sm">Pain Points & Current System</label>
                                        <div id="pain_points_editor" style="height: 150px;"></div>
                                        <input type="hidden" name="pain_points" id="inp_pain_points">
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-md-12">
                                        <label class="form-label-sm fw-bold text-dark">Upload Documents</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light"><i class="feather-paperclip"></i></span>
                                            <input type="file" name="documents[]" id="inp_documents" class="form-control form-control-sm" multiple>
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Select multiple files if needed (PDF, DOC, DOCX, JPG, PNG).</small>
                                        <div id="existing_documents_container" class="mt-2 d-flex flex-wrap gap-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light mx-n4 mb-n4 px-4 py-3 mt-4 border-top">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnSubmit" class="btn text-white px-4 fw-medium"
                            style="background-color: #006FC9;">Create Lead</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Email model --}}
    <div class="modal fade-scale" id="composeMail" tabindex="-1" aria-labelledby="composeMail" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content position-relative">
                <div class="mail-loader" id="mailLoader"></div>
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Compose Mail</span>
                        <small class="d-block fs-11 fw-normal text-muted">Compose Your Message</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <div class="position-relative border-bottom">
                        <div class="px-2 d-flex align-items-center">
                            <div class="p-0 w-100">

                                <select class="form-control border-0 email-template-dropdown">
                                    <option selected disabled>Select Template</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative border-bottom">
                        <div class="px-2 d-flex align-items-center">
                            <div class="p-0 w-100">
                                <input class="form-control border-0 text-dark" name="tomailmodal" placeholder="TO">
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                            class="position-absolute top-50 end-0 translate-middle badge bg-gray-100 border border-gray-3 fs-10 fw-semibold text-uppercase text-dark rounded-pill c-pointer z-index-100"
                            id="ccbccToggleModal"><span data-bs-toggle="tooltip" data-bs-trigger="hover" title="CC / BCC"
                                style="font-size: 9px !important">CC / BCC</span></a>
                    </div>
                    <div class="border-bottom mail-cc-bcc-fields" id="ccbccToggleModalFileds" style="display: none">
                        <div class="px-2 w-100 d-flex align-items-center border-bottom">
                            <input class="form-control border-0 text-dark" id="cc" name="ccmailmodal" placeholder="CC">
                        </div>
                        <div class="px-2 w-100 d-flex align-items-center">
                            <input class="form-control border-0 text-dark" id="bcc" name="bccmailmodal" placeholder="BCC">
                        </div>
                    </div>
                    <div class="px-3 w-100 d-flex align-items-center">
                        <input class="form-control border-0 my-1 w-100 shadow-none" name="subject" type="email"
                            placeholder="Subject">
                    </div>
                    <div class="editor w-100 m-0">
                        <div class="ht-300 border-bottom-0" id="mailEditorModal"></div>
                    </div>
                </div>
                <!--! BEGIN: [modal-footer] !-->
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <!--! BEGIN: [mail-editor-action-left] !-->
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-primary dropdown-toggle" data-bs-toggle="tooltip"
                                    data-bs-trigger="hover" title="Send Message"> Send </span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0)" class="dropdown-item" data-action-target="#mailActionMessage">
                                    <i class="feather-send me-3"></i>
                                    <span>Instant Send</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item successAlertMessage">
                                    <i class="feather-clock me-3"></i>
                                    <span>Schedule Send</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item successAlertMessage">
                                    <i class="feather-x me-3"></i>
                                    <span>Discard Now</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item successAlertMessage">
                                    <i class="feather-edit-3 me-3"></i>
                                    <span>Save as Draft</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown me-2 d-none d-sm-block">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Pick Template">
                                    <i class="feather-hash"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu wd-300">
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Welcome you message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Your issues solved</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Thank you message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Make a offer message</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Add the Unsubscribe option</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Thank your customer for joining</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-save me-3"></i>
                                    <span>Save as Template</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-sun me-3"></i>
                                    <span>Manage Template</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Upload Attachments">
                                    <i class="feather-upload"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-image me-3"></i>
                                    <span>Upload Images</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-video me-3"></i>
                                    <span>Upload Videos</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-mic me-3"></i>
                                    <span>Upload Musics</span>
                                </a>
                                <a href="javascript:void(0)" class="dropdown-item">
                                    <i class="feather-file-text me-3"></i>
                                    <span>Upload Documents</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--! BEGIN: [mail-editor-action-right] !-->
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" data-bs-offset="0, 0">
                                <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Editing Actions">
                                    <i class="feather-more-horizontal"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-type me-3"></i>
                                        <span>Plain Text Mode</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-check me-3"></i>
                                        <span>Check Spelling</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-compass me-3"></i>
                                        <span>Smart Compose</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        <i class="feather-feather me-3"></i>
                                        <span>Manage Signature</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0);" data-bs-dismiss="modal">
                            <span class="btn btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                title="Delete Message">
                                <i class="feather-x"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

