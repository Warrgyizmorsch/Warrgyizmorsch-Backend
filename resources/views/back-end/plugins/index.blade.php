@extends('layouts.app')

@section('content')
@php
    $twilioSettings = optional($twilioPlugin)->settings ?? [];
    $isTwilioActive = (bool) (optional($twilioPlugin)->is_active ?? true);
    $twilioSid      = $twilioSettings['account_sid'] ?? env('TWILIO_ACCOUNT_SID', '');
    $twilioToken    = $twilioSettings['auth_token'] ?? env('TWILIO_AUTH_TOKEN', '');
    $twilioNumber   = $twilioSettings['twilio_number'] ?? env('TWILIO_NUMBER', '');
    $apiKeySid      = $twilioSettings['api_key_sid'] ?? env('TWILIO_API_KEY_SID', '');
    $apiSecret      = $twilioSettings['api_secret'] ?? env('TWILIO_API_SECRET', '');
    $twimlAppSid    = $twilioSettings['twiml_app_sid'] ?? env('TWILIO_TWIML_APP_SID', '');
    $agentNumber    = $twilioSettings['default_agent_number'] ?? ($currentUserPhone ?? '');
    $callMode       = $twilioSettings['call_mode'] ?? 'webrtc';
@endphp

<style>
    .plugin-page-card {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        background: #ffffff;
    }
    .plugin-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #edf2f7;
    }
    .plugin-detail-row:last-child {
        border-bottom: none;
    }
    .plugin-detail-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #475569;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .plugin-detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
    }
    .plugin-action-btn {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        padding: 9px 16px !important;
        border-radius: 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .modal-field-label {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        margin-bottom: 5px;
    }
    .modal-field-input {
        font-size: 14px !important;
        height: 42px !important;
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
    }
    .modal-field-hint {
        font-size: 12.5px !important;
        color: #64748b !important;
        margin-top: 4px;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2" style="font-size: 22px;">
            <i class="fa fa-phone-volume text-primary"></i> Call Plugins
        </h3>
        <p class="text-secondary mb-0" style="font-size: 14px;">
            Manage your Twilio Voice Calling integration, credentials, webhook callbacks, and WebRTC softphone dialer.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4 p-3 rounded-3 shadow-xs border-0">
            <i class="fa fa-check-circle fs-4 text-success me-3"></i>
            <div class="fw-semibold" style="font-size: 14px;">{{ session('success') }}</div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Twilio Voice Call Plugin Card -->
        <div class="col-lg-8 col-xl-7">
            <div class="card h-100 plugin-page-card border {{ $isTwilioActive ? 'border-primary' : 'border-secondary' }}" style="overflow: hidden;">
                <div class="card-header border-bottom py-3 px-4 d-flex align-items-center justify-content-between {{ $isTwilioActive ? 'bg-light-primary' : 'bg-light' }}">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle {{ $isTwilioActive ? 'bg-primary' : 'bg-secondary' }} d-flex align-items-center justify-content-center shadow-sm text-white" style="width: 48px; height: 48px;">
                            <i class="fa fa-phone fs-4"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 17px;">Twilio Voice Calling</h5>
                                <span id="twilioStatusBadge" class="badge {{ $isTwilioActive ? 'bg-success text-white' : 'bg-danger text-white' }} fw-semibold px-2.5 py-1" style="font-size: 12.5px; border-radius: 6px;">
                                    <i class="fa fa-circle me-1" style="font-size: 8px;"></i>{{ $isTwilioActive ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="text-secondary mt-0.5" style="font-size: 13px;">Direct WebRTC browser calling, Softphone dialer & Call recording</div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                            <input class="form-check-input cursor-pointer" type="checkbox" id="twilioPluginToggle" style="width: 2.8rem; height: 1.45rem;" {{ $isTwilioActive ? 'checked' : '' }} onchange="togglePluginStatus('twilio_call', this.checked)">
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <p class="text-secondary mb-3" style="font-size: 14px; line-height: 1.6;">
                            Direct WebRTC browser calling & click-to-dial directly from Leads, Orders, and Deals. Includes Live Softphone dialer with Hold, Mute, live timer, and Inbound ringing.
                        </p>

                        <!-- Live Configuration Details -->
                        <div class="bg-light rounded-3 mb-4 border" style="border-color: #e2e8f0 !important;">
                            <div class="plugin-detail-row">
                                <span class="plugin-detail-label">
                                    <i class="fa fa-phone text-primary" style="font-size: 14px;"></i> Twilio Caller Number:
                                </span>
                                <strong class="plugin-detail-value font-monospace" style="font-size: 14.5px; color: #0284c7;">
                                    {{ $twilioNumber ?: 'Not configured' }}
                                </strong>
                            </div>
                            <div class="plugin-detail-row">
                                <span class="plugin-detail-label">
                                    <i class="fa fa-sliders-h text-primary" style="font-size: 14px;"></i> Call Mode:
                                </span>
                                <span class="badge bg-success-subtle text-success text-uppercase fw-bold px-2.5 py-1.5" style="font-size: 12.5px;">
                                    {{ $callMode === 'webrtc' ? 'WebRTC Browser Softphone' : $callMode }}
                                </span>
                            </div>
                            <div class="plugin-detail-row">
                                <span class="plugin-detail-label">
                                    <i class="fa fa-layer-group text-primary" style="font-size: 14px;"></i> TwiML App SID:
                                </span>
                                <strong class="plugin-detail-value font-monospace" style="font-size: 13.5px;">
                                    {{ $twimlAppSid ? substr($twimlAppSid, 0, 20) . '...' : 'Not configured' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Toolbar -->
                    <div>
                        <div class="d-flex flex-wrap gap-2 pt-2">
                            <button type="button" class="btn btn-outline-primary flex-fill plugin-action-btn" data-bs-toggle="modal" data-bs-target="#twilioSettingsModal">
                                <i class="fa fa-cog me-1.5"></i> Twilio Settings
                            </button>
                            <button type="button" class="btn btn-primary flex-fill plugin-action-btn" onclick="window.twilioSoftphone && window.twilioSoftphone.toggleWidget()">
                                <i class="fa fa-phone me-1.5"></i> Open Softphone
                            </button>
                            <button type="button" class="btn btn-light-success text-success border border-success-subtle flex-fill plugin-action-btn" onclick="testTwilioCallDirect()">
                                <i class="fa fa-phone-volume me-1.5"></i> Test Call
                            </button>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('call.history') }}" class="btn btn-warning w-100 plugin-action-btn text-dark fw-bold shadow-xs py-2.5" style="background-color: #ff9f1c; border-color: #ff9f1c; color: #ffffff !important;">
                                <i class="fa fa-history me-1.5"></i> View Call History & Logs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Twilio Webhook Endpoints & Live Status Info Card -->
        <div class="col-lg-4 col-xl-5">
            <div class="card h-100 plugin-page-card border">
                <div class="card-header border-bottom py-3 px-4 bg-light">
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2" style="font-size: 16.5px;">
                        <i class="fa fa-link text-primary"></i> Twilio Webhook Endpoints
                    </h5>
                    <div class="text-secondary mt-0.5" style="font-size: 13px;">Use these in your Twilio Console Phone Number & TwiML App</div>
                </div>
                <div class="card-body p-4">
                    <!-- Voice Webhook -->
                    <div class="mb-3.5">
                        <label class="form-label fw-bold text-uppercase text-secondary mb-1" style="font-size: 12.5px; letter-spacing: 0.3px;">
                            Voice Request URL (POST)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control font-monospace bg-light" style="font-size: 13.5px; height: 42px;" readonly value="{{ url('/api/twilio/voice') }}" id="voiceWebhookUrl">
                            <button class="btn btn-outline-secondary px-3" type="button" onclick="navigator.clipboard.writeText(document.getElementById('voiceWebhookUrl').value); alert('Voice URL copied to clipboard!');" title="Copy to clipboard">
                                <i class="fa fa-copy fs-6"></i>
                            </button>
                        </div>
                        <span class="text-muted d-block mt-1" style="font-size: 12.5px;">Paste in Twilio Console &gt; Phone Numbers &gt; Voice Configuration.</span>
                    </div>

                    <!-- Status Callback Webhook -->
                    <div class="mb-3.5">
                        <label class="form-label fw-bold text-uppercase text-secondary mb-1" style="font-size: 12.5px; letter-spacing: 0.3px;">
                            Status / Recording Callback URL (POST)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control font-monospace bg-light" style="font-size: 13.5px; height: 42px;" readonly value="{{ url('/api/twilio/status-callback') }}" id="statusWebhookUrl">
                            <button class="btn btn-outline-secondary px-3" type="button" onclick="navigator.clipboard.writeText(document.getElementById('statusWebhookUrl').value); alert('Status Callback URL copied to clipboard!');" title="Copy to clipboard">
                                <i class="fa fa-copy fs-6"></i>
                            </button>
                        </div>
                        <span class="text-muted d-block mt-1" style="font-size: 12.5px;">Logs completed calls and syncs duration &amp; recording URLs.</span>
                    </div>

                    <!-- WebRTC Softphone Features -->
                    <div class="border-top pt-3 mt-3">
                        <h6 class="fw-bold text-dark mb-2.5" style="font-size: 14px;">Twilio Features Activated:</h6>
                        <ul class="list-unstyled mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.8;">
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2 fs-6"></i> Browser-based WebRTC Calling (No hardware needed)</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2 fs-6"></i> Click-to-dial in Leads, Orders &amp; Pipeline cards</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2 fs-6"></i> Dual-channel stereo call recording &amp; instant playback</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2 fs-6"></i> Floating Softphone Dialer with Hold, Mute &amp; DTMF</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Twilio Settings -->
<div class="modal fade" id="twilioSettingsModal" tabindex="-1" aria-labelledby="twilioSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom py-3 px-4">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="twilioSettingsModalLabel" style="font-size: 18px;">
                    <i class="fa fa-phone text-primary"></i> Twilio Voice &amp; WebRTC Settings
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="twilioSettingsForm" method="POST" action="{{ \Illuminate\Support\Facades\Route::has('plugins.twilio.save') ? route('plugins.twilio.save') : url('/admin/plugins/twilio/save') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-light-primary d-flex align-items-center mb-4 border border-primary-subtle rounded-3 p-3">
                        <i class="fa fa-info-circle fs-3 text-primary me-3"></i>
                        <div style="font-size: 13.5px; color: #1e293b;">
                            Configure your Twilio Voice credentials from your <a href="https://console.twilio.com/" target="_blank" class="fw-bold text-primary text-decoration-underline">Twilio Console</a> for browser WebRTC &amp; Bridge calling.
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="modal-field-label">Account SID <span class="text-danger">*</span></label>
                            <input type="text" name="account_sid" id="setting_account_sid" class="form-control modal-field-input font-monospace" placeholder="e.g. ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twilioSid }}" required>
                            <div class="modal-field-hint">Twilio Console &gt; Account Info</div>
                        </div>

                        <div class="col-md-6">
                            <label class="modal-field-label">Auth Token <span class="text-danger">*</span></label>
                            <input type="password" name="auth_token" id="setting_auth_token" class="form-control modal-field-input font-monospace" placeholder="e.g. xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twilioToken }}" required>
                            <div class="modal-field-hint">Twilio Console &gt; Auth Token</div>
                        </div>

                        <div class="col-md-6">
                            <label class="modal-field-label">Twilio Caller Phone Number (From) <span class="text-danger">*</span></label>
                            <input type="text" name="twilio_number" class="form-control modal-field-input font-monospace" placeholder="e.g. +12766776335" value="{{ $twilioNumber }}" required>
                            <div class="modal-field-hint">Your Twilio purchased/trial virtual number.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="modal-field-label">Default Agent Phone Number (For Bridge Mode)</label>
                            <input type="text" name="default_agent_number" class="form-control modal-field-input font-monospace" placeholder="e.g. +919876543210" value="{{ $agentNumber }}">
                            <div class="modal-field-hint">Twilio will call this phone first in Mobile Bridge mode.</div>
                        </div>

                        <!-- WebRTC Credentials Toggle Header -->
                        <div class="col-12 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 border">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary-subtle p-2 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fa fa-globe fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 14.5px;">WebRTC Browser Softphone Mode (API Key &amp; TwiML App)</h6>
                                        <div class="text-secondary" style="font-size: 13px;">Direct browser calling with mic, dialpad, hold, mute, and live call disconnect.</div>
                                    </div>
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                                    <input class="form-check-input cursor-pointer" type="checkbox" id="webrtc_enable_toggle" style="width: 2.6rem; height: 1.35rem;" {{ $callMode === 'webrtc' ? 'checked' : '' }} onchange="toggleWebRtcFields(this.checked)">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="call_mode" id="call_mode_input" value="{{ $callMode }}">

                        <!-- WebRTC Credentials Container -->
                        <div class="col-12 {{ $callMode === 'webrtc' ? '' : 'd-none' }}" id="webrtc_fields_container">
                            <div class="card border border-primary border-dashed bg-light-primary mb-0 rounded-3">
                                <div class="card-body p-3.5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fw-bold text-dark" style="font-size: 14px;">API Key Credentials</span>
                                        <!-- 1-Click Auto-Generate Keys Button -->
                                        <button type="button" class="btn btn-primary py-1.5 px-3 fw-semibold shadow-xs" style="font-size: 13px; border-radius: 6px;" id="autoFixKeysBtn" onclick="autoFixTwilioKeys()">
                                            <i class="fa fa-magic me-1"></i> Auto-Generate &amp; Save Key from Twilio
                                        </button>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="modal-field-label">API Key SID (SK...)</label>
                                            <input type="text" name="api_key_sid" id="setting_api_key_sid" class="form-control modal-field-input font-monospace" placeholder="e.g. SKxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $apiKeySid }}">
                                            <div class="modal-field-hint">Found in Twilio Console &gt; API Keys &amp; Tokens</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="modal-field-label">API Secret</label>
                                            <input type="password" name="api_secret" id="setting_api_secret" class="form-control modal-field-input font-monospace" placeholder="Secret revealed when API Key was created" value="{{ $apiSecret }}">
                                            <div class="modal-field-hint">Secret revealed when API Key was created.</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="modal-field-label">TwiML App SID (AP...)</label>
                                            <input type="text" name="twiml_app_sid" class="form-control modal-field-input font-monospace" placeholder="e.g. APxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twimlAppSid }}">
                                            <div class="modal-field-hint">Found in Twilio Console &gt; Voice &gt; TwiML Apps (Application SID)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-4">
                    <button type="button" class="btn btn-light fw-semibold px-4" data-bs-dismiss="modal" style="height: 42px;">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold px-4" style="height: 42px;">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleWebRtcFields(enabled) {
    $('#call_mode_input').val(enabled ? 'webrtc' : 'bridge');
    if (enabled) {
        $('#webrtc_fields_container').removeClass('d-none');
    } else {
        $('#webrtc_fields_container').addClass('d-none');
    }
}

function togglePluginStatus(pluginKey, isActive) {
    $.ajax({
        url: "{{ \Illuminate\Support\Facades\Route::has('plugins.toggle') ? route('plugins.toggle') : url('/admin/plugins/toggle-status') }}",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { plugin_key: pluginKey, is_active: isActive ? 1 : 0 },
        success: function(res) {
            const badge = $('#twilioStatusBadge');
            if (isActive) {
                badge.removeClass('bg-danger text-white').addClass('bg-success text-white').html('<i class="fa fa-circle me-1" style="font-size: 8px;"></i>Active');
            } else {
                badge.removeClass('bg-success text-white').addClass('bg-danger text-white').html('<i class="fa fa-circle me-1" style="font-size: 8px;"></i>Inactive');
            }
        }
    });
}

function autoFixTwilioKeys() {
    const btn = $('#autoFixKeysBtn');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Generating Keys...');

    $.ajax({
        url: "{{ \Illuminate\Support\Facades\Route::has('plugins.twilio.autofix') ? route('plugins.twilio.autofix') : url('/admin/plugins/twilio/auto-fix-keys') }}",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(res) {
            btn.prop('disabled', false).html('<i class="fa fa-magic me-1"></i> Auto-Generate & Save Key from Twilio');
            if (res.success) {
                $('#setting_api_key_sid').val(res.api_key_sid);
                $('#setting_api_secret').val(res.api_secret);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'New Twilio API Key and Secret generated and saved!',
                        showConfirmButton: false,
                        timer: 3500
                    });
                } else {
                    alert('Success: New Twilio API Key and Secret generated and saved!');
                }
            } else {
                alert('Error: ' + res.message);
            }
        },
        error: function(err) {
            btn.prop('disabled', false).html('<i class="fa fa-magic me-1"></i> Auto-Generate & Save Key from Twilio');
            alert('Failed to auto-generate keys. Check your Account SID and Auth Token.');
        }
    });
}

function testTwilioCallDirect() {
    if (window.twilioSoftphone) {
        window.twilioSoftphone.toggleWidget();
    } else {
        alert('Twilio Softphone is loading...');
    }
}
</script>
@endsection
