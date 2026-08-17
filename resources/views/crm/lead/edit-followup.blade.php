{{-- CHANGE STATUS AND FOLLOW UP OFFCANVAS --}}
<div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="editStatusOffcanvas-{{ $lead->id }}"
    aria-labelledby="editStatusOffcanvasLabel-{{ $lead->id }}" style="width: 420px; background: #f8fafc;">
    
    {{-- Offcanvas Header --}}
    <div class="offcanvas-header border-bottom bg-white py-3 px-4 shadow-2xs">
        <div class="d-flex align-items-center gap-2.5">
            <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center fw-bold fs-13 shadow-2xs" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
            <div>
                <h6 class="offcanvas-title fw-bold text-dark mb-0 fs-14" id="editStatusOffcanvasLabel-{{ $lead->id }}">
                    Edit Followup
                </h6>
                <span class="fs-11 text-muted">
                    Lead: <strong class="text-dark">{{ optional($lead->user)->name ?? 'User' }}</strong>
                </span>
            </div>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-3.5">
        <form id="quickUpdateForm-{{ $lead->id }}" action="{{ route('lead.updateQuick', $lead->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="lead_bucket_id" class="bucket-select" value="{{ $lead->lead_bucket_id ?? 46 }}">

            {{-- Card Box 1: Status & Engagement --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-sliders text-primary fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Status & Engagement</h6>
                </div>
                <div class="card-body p-3">
                    {{-- Engagement Status --}}
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-fire text-danger me-1 fs-10"></i>Engagement Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="lead_engagement_status" style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="">Select Engagement</option>
                            <option value="hot" {{ strtolower($lead->lead_engagement_status) == 'hot' ? 'selected' : '' }}>🔥 Hot</option>
                            <option value="warm" {{ strtolower($lead->lead_engagement_status) == 'warm' ? 'selected' : '' }}>⚡ Warm</option>
                            <option value="cold" {{ strtolower($lead->lead_engagement_status) == 'cold' ? 'selected' : '' }}>❄️ Cold</option>
                            <option value="dead" {{ strtolower($lead->lead_engagement_status) == 'dead' ? 'selected' : '' }}>💀 Dead</option>
                        </select>
                    </div>

                    {{-- Lead Status --}}
                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-tag text-primary me-1 fs-10"></i>Lead Status <span class="text-danger">*</span>
                        </label>
                        <select name="lead_status"
                            class="form-select border-slate shadow-2xs status-select required-field fs-13"
                            style="border-color: #cbd5e1; border-radius: 8px;">
                            <option value="">Select Status</option>
                            @php
                                $statusBucket = $lead->bucket;
                                if ($statusBucket && $statusBucket->parent_id) {
                                    $statusBucket = isset($allBucketsWithChildren) ? ($allBucketsWithChildren[$statusBucket->parent_id] ?? null) : \App\Models\Bucket::with('children')->find($statusBucket->parent_id);
                                }
                                if (!$statusBucket || empty($statusBucket->children) || (is_object($statusBucket->children) && $statusBucket->children->isEmpty())) {
                                    $statusBucket = isset($allBucketsWithChildren) ? ($allBucketsWithChildren[46] ?? ($allBucketsWithChildren[1] ?? null)) : \App\Models\Bucket::with('children')->find(46);
                                }
                                $statusChildren = $statusBucket ? $statusBucket->children : collect();
                            @endphp
                            @foreach($statusChildren as $child)
                                <option data-bg="{{ $child->bucket_color }}" value="{{ $child->name }}" {{ $lead->lead_status == $child->name ? 'selected' : '' }}>
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('lead_status')
                            <small class="text-danger fs-11 mt-1 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Card Box 2: Communication & Comment --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-comments text-info fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Communication & Comment</h6>
                </div>
                <div class="card-body p-3">
                    {{-- Communication Type --}}
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-phone text-info me-1 fs-10"></i>Communication Type
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_type" style="border-color: #cbd5e1; border-radius: 8px;" onchange="checkFollowupCommentToggle(this)">
                            <option value="">-- Select Communication Type --</option>
                            <option value="WhatsApp Call">WhatsApp Call</option>
                            <option value="Call">Call</option>
                            <option value="Whatsapp">Whatsapp</option>
                        </select>
                    </div>

                    {{-- Communication Status --}}
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-signal text-info me-1 fs-10"></i>Communication Status
                        </label>
                        <select class="form-select border-slate shadow-2xs fs-13" name="followup_status" style="border-color: #cbd5e1; border-radius: 8px;" onchange="checkFollowupCommentToggle(this)">
                            <option value="">-- Select Communication Status --</option>
                            <option value="Connected">Connected</option>
                            <option value="Not Connected">Not Connected</option>
                            <option value="Discussion Start">Discussion Start</option>
                            <option value="No Response">No Response</option>
                        </select>
                    </div>

                    {{-- Add Message / Comment --}}
                    <div class="comment-message-box">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-comment-dots text-primary me-1 fs-10"></i>Add Comment / Message
                        </label>
                        <textarea class="form-control border-slate shadow-2xs fs-13" name="message" rows="3"
                            placeholder="Write followup notes or conversation details..." style="border-color: #cbd5e1; border-radius: 8px; resize: none;"></textarea>
                    </div>
                </div>
            </div>

            {{-- Card Box 3: Next Follow-up & Schedule --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-check text-warning fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Next Follow-up & Schedule</h6>
                </div>
                <div class="card-body p-3">
                    {{-- Next Follow Up Date --}}
                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-calendar-alt text-primary me-1 fs-10"></i>Next Follow Up Date & Time
                        </label>
                        <input type="datetime-local" class="form-control border-slate shadow-2xs fs-13"
                            name="next_followup_date" value="" style="border-color: #cbd5e1; border-radius: 8px;">
                    </div>
                </div>
            </div>

            {{-- Card Box 4: Audio Recordings & Document Uploads --}}
            <div class="card border rounded-3 shadow-2xs mb-3 bg-white">
                <div class="card-header bg-light bg-opacity-50 py-2 px-3 border-bottom d-flex align-items-center gap-2">
                    <i class="fas fa-paperclip text-success fs-12"></i>
                    <h6 class="fs-11 fw-bold text-dark mb-0 text-uppercase tracking-wider">Recordings & Document Uploads</h6>
                </div>
                <div class="card-body p-3">
                    {{-- Upload Call Recording --}}
                    <div class="mb-3">
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-microphone text-success me-1 fs-10"></i>Upload Call Recording
                        </label>
                        <input type="file" name="call_recording" class="form-control border-slate shadow-2xs fs-12" accept="audio/*" style="border-color: #cbd5e1; border-radius: 8px;">
                    </div>

                    {{-- Upload Documents --}}
                    <div>
                        <label class="form-label text-secondary fw-semibold mb-1 fs-11 text-uppercase tracking-wider">
                            <i class="fas fa-file-arrow-up text-primary me-1 fs-10"></i>Upload Documents
                        </label>
                        <input type="file" name="followup_documents[]" class="form-control border-slate shadow-2xs fs-12" multiple style="border-color: #cbd5e1; border-radius: 8px;">
                        <small class="text-muted d-block mt-1 fs-10">Formats supported: PDF, DOC, DOCX, JPG, PNG.</small>
                        
                        @if(!empty($lead->latestMessage->followup_documents))
                            <div class="mt-2.5 d-flex flex-column gap-1.5">
                                <span class="fs-10 text-muted fw-semibold uppercase">Existing Attachments:</span>
                                @foreach($lead->latestMessage->followup_documents as $doc)
                                    @php
                                        $docPath = is_array($doc) ? ($doc['path'] ?? '') : $doc;
                                        $docName = is_array($doc) ? ($doc['name'] ?? basename($docPath)) : basename($docPath);
                                    @endphp
                                    <div class="p-2 border rounded-2 bg-light d-flex align-items-center justify-content-between shadow-2xs" style="font-size: 11px;">
                                        <span class="text-truncate me-2 fw-medium text-dark"><i class="far fa-file-alt text-primary me-1"></i>{{ $docName }}</span>
                                        <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                            <a href="{{ route('document.view', ['path' => $docPath]) }}" target="_blank" class="btn btn-xs btn-light text-info p-1 px-2 rounded border text-decoration-none">
                                                <i class="fas fa-eye me-0.5"></i> View
                                            </a>
                                            <a href="{{ route('document.download', ['path' => $docPath, 'name' => $docName]) }}" class="btn btn-xs btn-light text-primary p-1 px-2 rounded border text-decoration-none">
                                                <i class="fas fa-download me-0.5"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Offcanvas Footer --}}
            <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top mt-4">
                <button type="button" class="btn btn-light text-secondary fw-semibold border px-3 py-1.5 fs-13" data-bs-dismiss="offcanvas">Cancel</button>
                <button type="submit" class="btn text-white fw-bold px-4 py-1.5 fs-13 shadow-sm d-inline-flex align-items-center gap-1.5" style="background: linear-gradient(135deg, #006FC9 0%, #0056a3 100%); border: none; border-radius: 6px;">
                    <i class="fas fa-check-circle fs-12"></i> Update Details
                </button>
            </div>
        </form>
    </div>
</div>
