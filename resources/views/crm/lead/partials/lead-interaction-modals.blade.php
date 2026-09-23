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
            <input type="hidden" name="lead_bucket_id" id="editStatusBucketIdInput" value="">
            <input type="hidden" name="lead_bucket_name" id="editStatusBucketNameInput" value="">
            <input type="hidden" name="lead_status" id="editStatusFinalStatusInput" value="">
            
            {{-- Status & Engagement Card --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-sliders text-primary fs-12"></i>
                        <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">
                            Change Status
                        </h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    {{-- Current Saved Status Display (Never altered by master deletion) --}}
                    <div class="mb-3 p-2.5 rounded-3 bg-light border d-flex align-items-center justify-content-between" id="currentLeadStatusBox">
                        <div>
                            <span class="fs-11 text-muted text-uppercase fw-semibold d-block">Current Saved Status</span>
                            <span class="fw-bold fs-13 text-dark" id="currentLeadStatusBadge">-</span>
                        </div>
                        <span class="badge bg-secondary-subtle text-secondary fs-11 px-2 py-1" id="currentLeadBucketBadge"></span>
                    </div>
                    <!-- Engagement Status (Commented out)
                    @if(!empty($isDealView))
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
                    @else
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
                    @endif
                    -->

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

<!--
{{-- Shared To-Do Offcanvas (Commented out) --}}
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
-->

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

                <!-- Upcoming Events & Meetings -->
                <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                    <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fs-12 fw-bold text-primary mb-0 text-uppercase tracking-wider">
                            <i class="feather-calendar me-1"></i> Upcoming Events & Meetings
                        </h6>
                        <button type="button" class="btn btn-xs btn-primary rounded-2 px-2.5 py-1" onclick="openCreateLeadEventModal()">
                            <i class="feather-plus me-1"></i> Schedule Event
                        </button>
                    </div>
                    <div class="card-body p-3">
                        <div id="vd_events_container">
                            <div class="text-center py-3 text-muted fs-12">Loading events...</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top bg-white px-4 py-2.5">
                <button type="button" class="btn btn-light text-secondary border px-4 fs-13 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Lead Event Modal (Schedule/Edit Event) --}}
<div class="modal fade" id="leadEventModal" tabindex="-1" aria-labelledby="leadEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-0 text-white px-4 py-3" style="background: linear-gradient(135deg, #006FC9 0%, #005299 100%);">
                <div class="d-flex align-items-center gap-2">
                    <i class="feather-calendar fs-5"></i>
                    <h5 class="modal-title fw-bold text-white mb-0 fs-15" id="leadEventModalTitle">Schedule Event</h5>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="leadEventForm" onsubmit="handleLeadEventFormSubmit(event)">
                @csrf
                <input type="hidden" id="lem_event_id" name="event_id">
                <input type="hidden" id="lem_lead_id" name="lead_id">

                <div class="modal-body p-4 bg-light">
                    <!-- Event Type -->
                    <div class="mb-3">
                        <label class="form-label fs-12 fw-bold text-dark mb-1">Event Type <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="lem_event_type" name="event_type" required>
                            <option value="meeting_schedule">Meeting Schedule</option>
                            <option value="discovery_call">Discovery Call</option>
                            <option value="projection_call">Projection Call</option>
                            <option value="conversion">Conversion</option>
                        </select>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label fs-12 fw-bold text-dark mb-1">Title / Purpose</label>
                        <input type="text" class="form-control form-control-sm" id="lem_title" name="title" placeholder="e.g. Initial Demo, Product Consultation">
                    </div>

                    <!-- Date & Start Time -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fs-12 fw-bold text-dark mb-1">Event Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" id="lem_event_date" name="event_date" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-12 fw-bold text-dark mb-1">Start Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control form-control-sm" id="lem_start_time" name="start_time" required>
                        </div>
                    </div>

                    <!-- End Time & Assignee -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fs-12 fw-bold text-dark mb-1">End Time</label>
                            <input type="time" class="form-control form-control-sm" id="lem_end_time" name="end_time">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-12 fw-bold text-dark mb-1">Assigned To</label>
                            <select class="form-select form-select-sm" id="lem_assigned_to" name="assigned_to">
                                <option value="">Lead Owner / Default</option>
                                @if(isset($users))
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-2">
                        <label class="form-label fs-12 fw-bold text-dark mb-1">Notes / Description</label>
                        <textarea class="form-control form-control-sm" id="lem_description" name="description" rows="3" placeholder="Key agenda or preparation notes..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top bg-white px-4 py-2.5 d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary px-4 fw-semibold" id="lem_submit_btn">Save Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('crm.lead.partials.lead-modal')
<style>
    @include('crm.lead.partials.lead-interaction-styles')
</style>

{{-- Comments & History Right Offcanvas --}}
<div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="commentsOffcanvas" aria-labelledby="cm_leadName" style="width: min(500px, 100vw);">
    <div class="offcanvas-header border-0 px-4 py-3 text-white" style="background: linear-gradient(135deg, #006FC9 0%, #005299 100%);">
        <div class="d-flex align-items-center gap-3 overflow-hidden">
            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" id="cm_header_avatar_box" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.18); border: 1.5px solid rgba(255, 255, 255, 0.32); backdrop-filter: blur(8px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <span class="fw-bold fs-16 text-white" id="cm_leadInitial"><i class="feather-activity fs-5"></i></span>
            </div>
            <div class="overflow-hidden">
                <h5 class="offcanvas-title fw-bold text-white mb-0 fs-15 text-truncate" id="cm_leadName">Lead Activity & History</h5>
                <div class="d-flex align-items-center gap-1.5 opacity-75 fs-11 mt-0.5">
                    <i class="feather-clock fs-10"></i>
                    <span id="cm_leadSubtitle">Communication, Remarks & Events</span>
                </div>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white opacity-75 flex-shrink-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Navigation Tabs Header -->
    <div class="bg-white border-bottom px-3 py-2">
        <div class="nav nav-pills cm-segmented-pills d-flex gap-1" id="cm_tabs" role="tablist">
            <button class="nav-link active flex-fill d-flex align-items-center justify-content-center gap-1 py-1.5 px-2 cm-tab-btn" 
                    id="cm_tab_comments_btn" 
                    data-bs-toggle="tab" 
                    data-bs-target="#cm_tab_comments" 
                    type="button" 
                    role="tab" 
                    aria-controls="cm_tab_comments" 
                    aria-selected="true"
                    title="Communication, Comments & Follow-ups">
                <i class="feather-message-square fs-12"></i>
                <span class="fs-12">Remarks</span>
                <span class="badge rounded-pill bg-primary text-white ms-0.5 fs-10 px-1.5 py-0.5" id="cm_badge_comments_count">0</span>
            </button>
            <button class="nav-link flex-fill d-flex align-items-center justify-content-center gap-1 py-1.5 px-2 cm-tab-btn" 
                    id="cm_tab_status_btn" 
                    data-bs-toggle="tab" 
                    data-bs-target="#cm_tab_status" 
                    type="button" 
                    role="tab" 
                    aria-controls="cm_tab_status" 
                    aria-selected="false"
                    title="Status Transition Audit Log">
                <i class="feather-git-commit fs-12"></i>
                <span class="fs-12">Status History</span>
                <span class="badge rounded-pill bg-secondary-subtle text-secondary ms-0.5 fs-10 px-1.5 py-0.5" id="cm_badge_status_count">0</span>
            </button>
            <button class="nav-link flex-fill d-flex align-items-center justify-content-center gap-1 py-1.5 px-2 cm-tab-btn" 
                    id="cm_tab_events_btn" 
                    data-bs-toggle="tab" 
                    data-bs-target="#cm_tab_events" 
                    type="button" 
                    role="tab" 
                    aria-controls="cm_tab_events" 
                    aria-selected="false"
                    title="Scheduled Meetings & Activities">
                <i class="feather-calendar fs-12"></i>
                <span class="fs-12">Upcoming Events</span>
                <span class="badge rounded-pill bg-secondary-subtle text-secondary ms-0.5 fs-10 px-1.5 py-0.5" id="cm_badge_events_count">0</span>
            </button>
        </div>
    </div>

    <div class="offcanvas-body p-3" style="background: #f8fafc; overflow-y: auto;" id="cm_body">
        <div class="tab-content" id="cm_tabContent">
            <!-- TAB 1: Communication & Remarks -->
            <div class="tab-pane fade show active" id="cm_tab_comments" role="tabpanel" aria-labelledby="cm_tab_comments_btn">
                <div class="d-flex align-items-center justify-content-center gap-2 py-5 text-muted fs-13">
                    <span class="spinner-border spinner-border-sm text-primary"></span>
                    <span>Loading remarks...</span>
                </div>
            </div>

            <!-- TAB 2: Status History -->
            <div class="tab-pane fade" id="cm_tab_status" role="tabpanel" aria-labelledby="cm_tab_status_btn">
                <div class="d-flex align-items-center justify-content-center gap-2 py-5 text-muted fs-13">
                    <span class="spinner-border spinner-border-sm text-primary"></span>
                    <span>Loading status history...</span>
                </div>
            </div>

            <!-- TAB 3: Upcoming Events -->
            <div class="tab-pane fade" id="cm_tab_events" role="tabpanel" aria-labelledby="cm_tab_events_btn">
                <div class="d-flex align-items-center justify-content-center gap-2 py-5 text-muted fs-13">
                    <span class="spinner-border spinner-border-sm text-primary"></span>
                    <span>Loading events & schedule...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="border-top bg-white px-4 py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted fs-11 d-flex align-items-center gap-1"><i class="feather-shield text-primary"></i> Secure CRM Audit Trail</small>
        <button type="button" class="btn btn-light border px-4 fs-12 fw-semibold text-secondary rounded-2 shadow-2xs" data-bs-dismiss="offcanvas">Close</button>
    </div>
</div>

{{-- Dedicated Upcoming Events & Activities Offcanvas --}}
<div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="upcomingEventsOffcanvas" aria-labelledby="upcomingEventsOffcanvasLabel" style="width: 480px; max-width: 95vw; z-index: 1065;">
    <!-- Offcanvas Header -->
    <div class="offcanvas-header text-white px-4 py-3" style="background: linear-gradient(135deg, #006FC9 0%, #005299 100%);">
        <div class="d-flex align-items-center gap-2 overflow-hidden">
            <div class="rounded-circle p-2 d-flex align-items-center justify-content-center text-white" style="width: 38px; height: 38px; background: rgba(255,255,255,0.2);">
                <i class="feather-calendar fs-5"></i>
            </div>
            <div class="text-truncate">
                <h5 class="offcanvas-title fw-bold text-white mb-0 fs-15 text-truncate" id="ue_lead_title">Upcoming Activities & Events</h5>
                <small class="text-white-50 fs-11" id="ue_lead_subtitle">Lead Activities & Schedule</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white opacity-75 flex-shrink-0 shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Offcanvas Body -->
    <div class="offcanvas-body p-0 d-flex flex-column" style="background: #f8fafc; overflow-y: auto;">
        {{-- Section 1: Schedule Form Box --}}
        <div class="p-3 bg-white border-bottom shadow-2xs">
            <div class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom">
                <span class="fs-12 fw-bold text-dark text-uppercase d-flex align-items-center gap-1.5">
                    <i class="feather-plus-circle text-primary fs-14"></i> Schedule New Activity / Event
                </span>
            </div>

            <form id="ue_schedule_form" onsubmit="handleUpcomingEventSubmit(event)">
                @csrf
                <input type="hidden" id="ue_lead_id" name="lead_id">

                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="form-label fs-11 fw-bold text-muted mb-0.5">Event Type <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="ue_event_type" name="event_type" required style="font-size: 12px;">
                            <option value="meeting_schedule">Meeting Schedule</option>
                            <option value="discovery_call">Discovery Call</option>
                            <option value="projection_call">Projection Call</option>
                            <option value="conversion">Conversion</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label fs-11 fw-bold text-muted mb-0.5">Assigned To</label>
                        <select class="form-select form-select-sm" id="ue_assigned_to" name="assigned_to" style="font-size: 12px;">
                            <option value="">Lead Owner / Default</option>
                            @if(isset($users))
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            @elseif(isset($owners))
                                @foreach($owners as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fs-11 fw-bold text-muted mb-0.5">Title / Subject</label>
                    <input type="text" class="form-control form-control-sm" id="ue_title" name="title" placeholder="e.g. Initial Demo, Product Consultation" style="font-size: 12px;">
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="form-label fs-11 fw-bold text-muted mb-0.5">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="ue_event_date" name="event_date" required min="{{ date('Y-m-d') }}" style="font-size: 12px;">
                    </div>
                    <div class="col-6">
                        <label class="form-label fs-11 fw-bold text-muted mb-0.5">Start Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control form-control-sm" id="ue_start_time" name="start_time" required style="font-size: 12px;">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fs-11 fw-bold text-muted mb-0.5">Notes / Description</label>
                    <textarea class="form-control form-control-sm" id="ue_description" name="description" rows="2" placeholder="Key agenda or preparation notes..." style="font-size: 12px;"></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-sm btn-primary px-3 py-1.5 fw-semibold d-inline-flex align-items-center gap-1" id="ue_submit_btn">
                        <i class="feather-calendar fs-12"></i> Schedule Activity
                    </button>
                </div>
            </form>
        </div>

        {{-- Section 2: Events & Activities History --}}
        <div class="p-3 flex-grow-1">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-12 fw-bold text-dark text-uppercase">
                    <i class="feather-clock text-primary me-1"></i> Activity History & Events
                </span>
                <span class="badge bg-primary text-white rounded-pill px-2 py-0.5 fs-10" id="ue_events_count">0</span>
            </div>

            <div id="ue_events_container">
                <div class="text-center py-4 text-muted fs-12">Loading events...</div>
            </div>
        </div>
    </div>

    <!-- Offcanvas Footer -->
    <div class="border-top bg-white px-4 py-2.5 d-flex justify-content-between align-items-center">
        <small class="text-muted fs-11 d-flex align-items-center gap-1"><i class="feather-calendar text-primary"></i> Dedicated Lead Activity Center</small>
        <button type="button" class="btn btn-sm btn-light border px-4 fs-12 fw-semibold text-secondary rounded-2" data-bs-dismiss="offcanvas">Close</button>
    </div>
</div>
