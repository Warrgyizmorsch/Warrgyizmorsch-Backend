@php
    $userName = $lead->user->name ?? $lead->business_name ?? 'Lead #' . $lead->id;
    $contactNo = $lead->user->contact_no ?? '';
    $userEmail = $lead->user->email ?? '';
    $ownerName = $lead->owner->name ?? 'Unassigned';
    $bucketColor = $lead->bucket->bucket_color ?? '#006FC9';
    $engagementStatus = strtolower($lead->lead_engagement_status ?? '');
    
    $badgeBg = 'bg-light-secondary text-secondary';
    if ($engagementStatus === 'hot' || $engagementStatus === 'hot lead') {
        $badgeBg = 'bg-danger text-white';
    } elseif ($engagementStatus === 'warm' || $engagementStatus === 'warm lead') {
        $badgeBg = 'bg-warning text-dark';
    } elseif ($engagementStatus === 'cold' || $engagementStatus === 'cold lead') {
        $badgeBg = 'bg-info text-white';
    }

    $lastNote = $lead->latestMessage ? $lead->latestMessage->message : null;
    $createdDate = $lead->date ? $lead->date->format('d M Y') : ($lead->created_at ? $lead->created_at->format('d M Y') : '');
@endphp

<div class="card pipeline-lead-card mb-3 border-0 shadow-sm rounded-3" 
     data-lead-id="{{ $lead->id }}" 
     data-bucket-id="{{ $lead->lead_bucket_id }}"
     draggable="true">
    <div class="card-body p-3"
         onclick="if (!event.target.closest('button, a, select, input')) openViewDetailsModalLazy({{ $lead->id }})">
        {{-- Card Header: Engagement Status & Date --}}
        <div class="d-flex align-items-center justify-content-between mb-2">
            <!-- <span class="badge {{ $badgeBg }} px-2 py-1 fs-11 rounded-2 text-uppercase fw-semibold">
                {{ $lead->lead_engagement_status ?? 'Standard' }}
            </span> -->
            <small class="text-muted fs-11 ms-auto">
                <i class="feather-calendar me-1"></i>{{ $createdDate }}
            </small>
        </div>

        {{-- Lead Title & Business Name --}}
        <h6 class="mb-1 fw-bold text-dark fs-14">
            <a href="javascript:void(0)" onclick="openViewDetailsModalLazy({{ $lead->id }})" class="text-dark text-decoration-none hover-primary">
                {{ $userName }}
            </a>
        </h6>

        @if(!empty($lead->business_name) && $lead->business_name !== $userName)
            <div class="fs-12 text-muted mb-2">
                <i class="feather-briefcase me-1"></i>{{ $lead->business_name }}
            </div>
        @endif

        {{-- Contact Info --}}
        <div class="d-flex flex-wrap gap-2 fs-12 mb-2 text-secondary">
            @if($contactNo)
                <div>
                    <i class="feather-phone text-primary me-1"></i>
                    <a href="tel:{{ $contactNo }}" class="text-secondary text-decoration-none">{{ $contactNo }}</a>
                </div>
            @endif
            @if($userEmail)
                <div class="text-truncate" style="max-width: 180px;" title="{{ $userEmail }}">
                    <i class="feather-mail text-primary me-1"></i>{{ $userEmail }}
                </div>
            @endif
        </div>

        {{-- Last Follow-up Note Preview --}}
        @if($lastNote)
            <div class="bg-light p-2 rounded-2 fs-11 text-dark mb-2 border-start border-2 border-primary text-truncate" title="{{ $lastNote }}">
                <i class="feather-message-circle me-1 text-primary"></i>{{ $lastNote }}
            </div>
        @endif

        {{-- Footer: Owner Badge & Quick Actions --}}
        <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light mt-2">
            <div class="d-flex align-items-center fs-11 text-muted">
                <div class="avatar avatar-xs bg-light-primary text-primary rounded-circle me-1 fw-bold fs-10 d-flex align-items-center justify-content-center" style="width: 22px; height: 22px;">
                    {{ strtoupper(substr($ownerName, 0, 1)) }}
                </div>
                <span class="text-truncate" style="max-width: 100px;">{{ $ownerName }}</span>
            </div>

            <div class="d-flex align-items-center gap-1">
                @if($contactNo)
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $contactNo) }}" target="_blank" class="btn btn-sm btn-icon btn-light-success rounded-circle p-1" style="width: 26px; height: 26px;" title="WhatsApp">
                        <i class="fa-brands fa-whatsapp fs-12"></i>
                    </a>
                @endif
                <button type="button" class="btn btn-sm btn-icon btn-light-success rounded-circle p-1" style="width: 28px; height: 28px;" onclick="openLeadEditModal({{ $lead->id }})" title="Edit Lead">
                    <i class="feather-edit fs-12"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-light-warning rounded-circle p-1" style="width: 28px; height: 28px;" onclick="openEditStatusOffcanvas({{ $lead->id }}, '{{ addslashes($lead->lead_status ?? optional($lead->bucket)->name ?? '') }}', '{{ addslashes($lead->lead_engagement_status ?? '') }}', {{ $lead->lead_bucket_id ?? 0 }})" title="Add Follow-up">
                    <i class="feather-calendar fs-12"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-light-info rounded-circle p-1" style="width: 28px; height: 28px;" onclick="openCommentsModal({{ $lead->id }}, '{{ addslashes($userName) }}')" title="History">
                    <i class="feather-clock fs-12"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-light-primary rounded-circle p-1" style="width: 28px; height: 28px;" onclick="openViewDetailsModalLazy({{ $lead->id }})" title="View Details">
                    <i class="feather-eye fs-12"></i>
                </button>
            </div>
        </div>
    </div>
</div>
