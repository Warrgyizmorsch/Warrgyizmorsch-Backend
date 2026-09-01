{{-- Shared Edit Status Offcanvas --}}
<div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas" aria-labelledby="editStatusOffcanvasLabel" style="width: 420px; background: #f8fafc;">
    <div class="offcanvas-header border-bottom bg-white py-3 px-4 shadow-2xs">
        <div class="d-flex align-items-center gap-2.5">
            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-13 shadow-2xs" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
                <h6 class="offcanvas-title fw-bold text-dark mb-0 fs-14" id="editStatusOffcanvasLabel">Edit Status</h6>
                <span class="fs-11 text-muted">Lead: <strong class="text-dark text-capitalize" id="sharedEditStatusLeadName">User</strong></span>
            </div>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3.5">
        <form id="sharedQuickUpdateForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lead_bucket_id" value="46">
            
            {{-- Status & Engagement Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-sliders text-primary fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Status & Engagement</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-fire text-danger me-1 fs-10"></i>Engagement Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="lead_engagement_status" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Engagement Status</option>
                            <option value="hot">🔥 Hot</option>
                            <option value="warm">⚡ Warm</option>
                            <option value="cold">❄️ Cold</option>
                            <option value="dead">💀 Dead</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-tag text-primary me-1 fs-10"></i>Lead Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="main_lead_status" id="editStatusMainSelect" onchange="onOffcanvasMainStatusChange(this.value)" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Lead Status</option>
                            @if(isset($childBuckets) && count($childBuckets) > 0)
                                @foreach($childBuckets as $mainBucket)
                                    <option value="{{ $mainBucket->name }}">{{ $mainBucket->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div id="editStatusSubStatusWrap" class="d-none">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-tags text-info me-1 fs-10"></i>Sub Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="sub_lead_status" id="editStatusSubSelect" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="">Select Sub Status (Optional)</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-tags text-primary me-1"></i>Tags</span>
                            <a href="{{ route('tags.index') }}" target="_blank" class="text-primary text-decoration-none fs-11 text-capitalize fw-normal" title="Tag Master">+ Manage</a>
                        </label>
                        
                        <!-- Custom Multi-Select Tag Dropdown for Offcanvas -->
                        <div class="custom-tag-multiselect dropdown" id="offcanvasTagMultiSelectWrap">
                            <div class="tag-select-trigger form-control d-flex align-items-center justify-content-between flex-wrap gap-1 p-2" 
                                 data-bs-toggle="dropdown" 
                                 data-bs-auto-close="outside" 
                                 aria-expanded="false" 
                                 role="button" 
                                 style="min-height: 40px; cursor: pointer; border-radius: 8px; border-color: #cbd5e1; background-color: #fff;">
                                <div class="selected-tags-chips d-flex align-items-center flex-wrap gap-1" id="offcanvasSelectedTagsChips">
                                    <span class="placeholder-text text-muted fs-12"><i class="fas fa-tag me-1 text-secondary opacity-50"></i>Select tags...</span>
                                </div>
                                <i class="fas fa-chevron-down text-muted fs-11 ms-auto"></i>
                            </div>
                            
                            <div class="dropdown-menu p-2 shadow-lg border-0 w-100 mt-1" style="max-height: 260px; overflow-y: auto; border-radius: 10px; z-index: 1060;">
                                <div class="px-2 py-1 mb-1 border-bottom">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted fs-11"></i></span>
                                        <input type="text" class="form-control form-control-sm border-0 bg-light shadow-none" placeholder="Search tags..." id="offcanvasTagSearch" oninput="filterTagOptions(this, 'offcanvasTagList')">
                                    </div>
                                </div>
                                
                                <div class="tag-options-list py-1" id="offcanvasTagList">
                                    @forelse(($allTags ?? collect()) as $tag)
                                        <label class="tag-option-item dropdown-item d-flex align-items-center justify-content-between py-1.5 px-2 rounded cursor-pointer mb-0.5" style="cursor: pointer;">
                                            <div class="d-flex align-items-center gap-2">
                                                <input type="checkbox" class="form-check-input m-0 tag-checkbox" value="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" data-tag-color="{{ $tag->color }}" onchange="syncTagSelection('offcanvas')">
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
                            <select name="tag_ids[]" id="sharedLeadTagsSelect" class="d-none" multiple>
                                @foreach(($allTags ?? collect()) as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Communication Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-comments text-info fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Communication & Comment</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Communication Type</label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_type" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Communication Type</option>
                            <option value="Call">Call</option>
                            <option value="WhatsApp Call">WhatsApp Call</option>
                            <option value="Whatsapp">Whatsapp</option>
                            <option value="Email">Email</option>
                            <option value="Meeting">Meeting</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Communication Status</label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_status" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="" disabled selected>Select Communication Status</option>
                            <option value="Answered">Answered</option>
                            <option value="Unanswered">Unanswered</option>
                            <option value="Busy">Busy</option>
                            <option value="Switched Off">Switched Off</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Add Comment / Message</label>
                        <textarea class="form-control border-slate shadow-2xs fs-13" name="message" rows="3" placeholder="Write a comment or message..." style="border-color: #cbd5e1; border-radius: 8px; resize: none;"></textarea>
                    </div>
                </div>
            </div>

            {{-- Next Followup & Attachments Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check text-warning fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Next Follow-up & Attachments</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Next Follow-up Date & Time</label>
                        <input type="datetime-local" class="form-control border-slate shadow-2xs fs-13" name="next_followup_date" style="border-color: #cbd5e1; border-radius: 8px;">
                    </div>
                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">Attachments (Multiple PDF/Doc/Images)</label>
                        <input type="file" class="form-control border-slate shadow-2xs fs-12" name="followup_documents[]" multiple style="border-color: #cbd5e1; border-radius: 8px;">
                        <div id="sharedExistingAttachments" class="mt-2"></div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top mt-4">
                <button type="button" class="btn btn-light text-secondary fw-semibold border px-3 py-1.5 fs-13" data-bs-dismiss="offcanvas">CLOSE</button>
                <button type="submit" class="btn text-white fw-bold px-4 py-1.5 fs-13 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%); border: none; border-radius: 6px;">
                    <i class="fas fa-check-circle fs-12"></i> UPDATE STATUS
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Shared To-Do Offcanvas --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="todoOffcanvas" style="width: 420px;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark" style="font-size: 18px;">To-Do Task</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-4" style="background-color: #f8fafc;">
            <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Add New To-Do Task:</h6>
            <form id="sharedTodoForm" action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted mb-1" style="font-size: 13px;">Summary:</label>
                    <textarea class="form-control" name="summary" rows="3" placeholder="Write Your Summary" required style="font-size: 14px; border-color: #cbd5e1;"></textarea>
                </div>
                @if(auth()->check() && auth()->user()->role_id == 1)
                    <div class="mb-3">
                        <label class="form-label text-muted mb-1" style="font-size: 13px;">Assign To</label>
                        <select class="form-select" name="assign_to" required style="font-size: 14px; border-color: #cbd5e1;">
                            <option value="" disabled selected>Select User</option>
                            @if(isset($owners))
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label text-muted mb-1" style="font-size: 13px;">Due Date</label>
                    <input type="datetime-local" class="form-control" name="due_date" required style="font-size: 14px; border-color: #cbd5e1;">
                </div>
                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-warning fw-bold px-4 py-2" style="font-size: 13px;">SAVE TO-DO</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- View Lead Details Modal --}}
<div class="modal fade" id="viewLeadDetailsModal" tabindex="-1" aria-labelledby="viewLeadDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header border-0 px-4 py-3 text-white" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 38px; height: 38px;">
                        <i class="feather-user fs-5 text-white"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0 fs-15" id="vd_leadName">Lead Details</h5>
                        <small class="text-white opacity-75 fs-11" id="vd_leadSubtitle">Complete Information</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background: #f8fafc;">
                <!-- Status Badges -->
                <div class="d-flex flex-wrap gap-2 mb-3" id="vd_badges"></div>

                <!-- Personal Info -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-user me-1"></i> Personal & Contact Information</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_personalInfo"></div>
                    </div>
                </div>

                <!-- Lead Information -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-target me-1"></i> Lead Information & Campaign</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_leadInfo"></div>
                    </div>
                </div>

                <!-- Address & Location -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider"><i class="feather-map-pin me-1"></i> Address Details</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-3" id="vd_addressInfo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top bg-white px-4 py-2.5">
                <button type="button" class="btn btn-light text-secondary border px-4 fs-13 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('crm.lead.partials.lead-modal')
{{-- Comments & History Right Offcanvas --}}
<div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="commentsOffcanvas" aria-labelledby="cm_leadName" style="width: min(460px, 100vw);">
    <div class="offcanvas-header border-0 px-4 py-3 text-white" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%);">
        <div class="d-flex align-items-center gap-3 overflow-hidden">
            <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25 flex-shrink-0" style="width: 38px; height: 38px;">
                <i class="feather-message-square fs-5 text-white"></i>
            </div>
            <div class="overflow-hidden">
                <h5 class="offcanvas-title fw-bold text-white mb-0 fs-15 text-truncate" id="cm_leadName">Comments & History</h5>
                <small class="text-white opacity-75 fs-11">All Activity Logs & Remarks</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white flex-shrink-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3" style="background: #f8fafc; overflow-y: auto;" id="cm_body">
        <div class="d-flex align-items-center justify-content-center gap-2 py-5 text-muted fs-13">
            <span class="spinner-border spinner-border-sm text-primary"></span>
            <span>Loading comments...</span>
        </div>
    </div>
    <div class="border-top bg-white px-3 py-3 d-flex justify-content-end">
        <button type="button" class="btn btn-light text-secondary border px-4 fs-13 fw-semibold" data-bs-dismiss="offcanvas">Close</button>
    </div>
</div>
