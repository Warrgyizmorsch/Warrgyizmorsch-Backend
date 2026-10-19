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

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
            <i class="fa fa-phone-volume text-primary"></i> Call Plugins
        </h3>
        <p class="text-muted fs-7 mb-0">
            Manage your Twilio Voice Calling integration, credentials, and WebRTC softphone dialer.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="fa fa-check-circle fs-4 text-success me-3"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Twilio Voice Call Plugin Card -->
        <div class="col-lg-8 col-xl-7">
            <div class="card h-100 border shadow-sm {{ $isTwilioActive ? 'border-primary' : 'border-secondary' }}" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header border-bottom py-3 px-4 d-flex align-items-center justify-content-between {{ $isTwilioActive ? 'bg-light-primary' : 'bg-light' }}">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle {{ $isTwilioActive ? 'bg-primary' : 'bg-secondary' }} d-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px;">
                            <i class="fa fa-phone text-white fs-5"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="fw-bold text-dark mb-0 fs-6">Twilio Voice Calling</h5>
                                <span id="twilioStatusBadge" class="badge {{ $isTwilioActive ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-8 fw-semibold px-2.5 py-1">
                                    <i class="fa fa-circle me-1 fs-9 {{ $isTwilioActive ? 'text-success' : 'text-danger' }}"></i>{{ $isTwilioActive ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="text-muted fs-8 mt-0.5">Direct WebRTC browser calling, Softphone dialer & Call recording</div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                            <input class="form-check-input cursor-pointer" type="checkbox" id="twilioPluginToggle" style="width: 2.6rem; height: 1.35rem;" {{ $isTwilioActive ? 'checked' : '' }} onchange="togglePluginStatus('twilio_call', this.checked)">
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <p class="text-muted fs-7 mb-3">
                            Direct WebRTC browser calling & click-to-dial directly from Leads and Orders page. Includes Live Softphone dialer with Hold, Mute & Inbound ringing.
                        </p>

                        <!-- Live Configuration Details -->
                        <div class="bg-light rounded-3 p-3.5 mb-3 border fs-7">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fw-semibold"><i class="fa fa-phone me-2 text-primary fs-8"></i>Twilio Number:</span>
                                <strong class="text-dark font-monospace fs-7">{{ $twilioNumber ?: 'Not configured' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fw-semibold"><i class="fa fa-sliders-h me-2 text-primary fs-8"></i>Call Mode:</span>
                                <span class="badge bg-success-subtle text-success text-uppercase fw-bold">{{ $callMode }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-muted fw-semibold"><i class="fa fa-layer-group me-2 text-primary fs-8"></i>TwiML App SID:</span>
                                <strong class="text-dark font-monospace fs-8">{{ $twimlAppSid ? substr($twimlAppSid, 0, 18) . '...' : 'Not configured' }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Toolbar -->
                    <div>
                        <div class="d-flex gap-2 pt-2">
                            <button type="button" class="btn btn-sm btn-light-primary flex-fill fw-semibold py-2" data-bs-toggle="modal" data-bs-target="#twilioSettingsModal">
                                <i class="fa fa-cog me-1"></i> Twilio Settings
                            </button>
                            <button type="button" class="btn btn-sm btn-light-info flex-fill fw-semibold py-2" onclick="window.twilioSoftphone && window.twilioSoftphone.toggleWidget()">
                                <i class="fa fa-phone me-1"></i> Open Softphone
                            </button>
                            <button type="button" class="btn btn-sm btn-light-success flex-fill fw-semibold py-2" onclick="testTwilioCallDirect()">
                                <i class="fa fa-phone-volume me-1"></i> Test Call
                            </button>
                        </div>
                        <div class="mt-2.5">
                            <a href="{{ route('call.history') }}" class="btn btn-sm btn-light-warning w-100 fw-semibold text-center py-2">
                                <i class="fa fa-history me-1"></i> View Call History & Logs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Twilio Webhook Endpoints & Live Status Info Card -->
        <div class="col-lg-4 col-xl-5">
            <div class="card h-100 border shadow-sm" style="border-radius: 14px;">
                <div class="card-header border-bottom py-3 px-4 bg-light">
                    <h5 class="fw-bold text-dark mb-0 fs-6 d-flex align-items-center gap-2">
                        <i class="fa fa-link text-primary"></i> Twilio Webhook Endpoints
                    </h5>
                    <div class="text-muted fs-8 mt-0.5">Use these in your Twilio Console Phone Number & TwiML App</div>
                </div>
                <div class="card-body p-4 fs-7">
                    <!-- Voice Webhook -->
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-8 text-uppercase text-muted mb-1">
                            Voice Request URL (POST)
                        </label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control font-monospace fs-8 bg-light" readonly value="{{ url('/api/twilio/voice') }}" id="voiceWebhookUrl">
                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('voiceWebhookUrl').value); alert('Voice URL copied to clipboard!');">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                        <span class="fs-9 text-muted">Paste in Twilio Console > Phone Numbers > Voice Configuration.</span>
                    </div>

                    <!-- Status Callback Webhook -->
                    <div class="mb-3">
                        <label class="form-label fw-bold fs-8 text-uppercase text-muted mb-1">
                            Status / Recording Callback URL (POST)
                        </label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control font-monospace fs-8 bg-light" readonly value="{{ url('/api/twilio/status-callback') }}" id="statusWebhookUrl">
                            <button class="btn btn-outline-secondary" type="button" onclick="navigator.clipboard.writeText(document.getElementById('statusWebhookUrl').value); alert('Status Callback URL copied to clipboard!');">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                        <span class="fs-9 text-muted">Logs completed calls and syncs duration & recording URLs.</span>
                    </div>

                    <!-- WebRTC Softphone Features -->
                    <div class="border-top pt-3 mt-3">
                        <h6 class="fw-bold text-dark fs-7 mb-2">Twilio Features Activated:</h6>
                        <ul class="list-unstyled mb-0 fs-8 text-muted">
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2"></i> Browser-based WebRTC Calling (No hardware needed)</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2"></i> Click-to-dial in Leads, Orders & Pipeline cards</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2"></i> Dual-channel stereo call recording & instant playback</li>
                            <li class="mb-1.5"><i class="fa fa-check text-success me-2"></i> Floating Softphone Dialer with Hold, Mute & DTMF</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SCREEN 4: Modal: Twilio Settings -->
<div class="modal fade" id="twilioSettingsModal" tabindex="-1" aria-labelledby="twilioSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 14px;">
            <div class="modal-header border-bottom py-3 px-4">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="twilioSettingsModalLabel">
                    <i class="fa fa-phone text-primary"></i> Twilio Voice & WebRTC Settings
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="twilioSettingsForm" method="POST" action="{{ route('plugins.twilio.save') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="alert alert-light-primary d-flex align-items-center mb-4 border border-primary-subtle rounded-3 p-3">
                        <i class="fa fa-info-circle fs-4 text-primary me-3"></i>
                        <div class="fs-7">
                            Configure your Twilio Voice credentials from your <a href="https://console.twilio.com/" target="_blank" class="fw-bold text-primary">Twilio Console</a> for browser WebRTC & Bridge calling.
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-7 mb-1">Account SID <span class="text-danger">*</span></label>
                            <input type="text" name="account_sid" id="setting_account_sid" class="form-control font-monospace fs-7" placeholder="e.g. ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twilioSid }}" required>
                            <div class="text-muted fs-8 mt-1">Twilio Console > Account Info</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-7 mb-1">Auth Token <span class="text-danger">*</span></label>
                            <input type="password" name="auth_token" id="setting_auth_token" class="form-control font-monospace fs-7" placeholder="e.g. xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twilioToken }}" required>
                            <div class="text-muted fs-8 mt-1">Twilio Console > Auth Token</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-7 mb-1">Twilio Caller Phone Number (From) <span class="text-danger">*</span></label>
                            <input type="text" name="twilio_number" class="form-control font-monospace fs-7" placeholder="e.g. +12766776335" value="{{ $twilioNumber }}" required>
                            <div class="text-muted fs-8 mt-1">Your Twilio purchased/trial virtual number.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold fs-7 mb-1">Default Agent Phone Number (For Bridge Mode)</label>
                            <input type="text" name="default_agent_number" class="form-control font-monospace fs-7" placeholder="e.g. +919876543210" value="{{ $agentNumber }}">
                            <div class="text-muted fs-8 mt-1">Twilio will call this phone first in Mobile Bridge mode.</div>
                        </div>

                        <!-- WebRTC Credentials Toggle Header -->
                        <div class="col-12 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 border">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary-subtle p-2 text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="fa fa-globe fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0 fs-7">WebRTC Browser Softphone Mode (API Key & TwiML App)</h6>
                                        <div class="text-muted fs-8">Direct browser calling with mic, dialpad, hold, mute, and live call disconnect.</div>
                                    </div>
                                </div>
                                <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                                    <input class="form-check-input cursor-pointer" type="checkbox" id="webrtc_enable_toggle" style="width: 2.5rem; height: 1.3rem;" {{ $callMode === 'webrtc' ? 'checked' : '' }} onchange="toggleWebRtcFields(this.checked)">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="call_mode" id="call_mode_input" value="{{ $callMode }}">

                        <!-- WebRTC Credentials Container -->
                        <div class="col-12 {{ $callMode === 'webrtc' ? '' : 'd-none' }}" id="webrtc_fields_container">
                            <div class="card border border-primary border-dashed bg-light-primary mb-0 rounded-3">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fw-bold text-dark fs-7">API Key Credentials</span>
                                        <!-- 1-Click Auto-Generate Keys Button -->
                                        <button type="button" class="btn btn-sm btn-primary py-1 px-3 fs-8 fw-semibold shadow-xs" id="autoFixKeysBtn" onclick="autoFixTwilioKeys()">
                                            <i class="fa fa-magic me-1"></i> Auto-Generate & Save Key from Twilio
                                        </button>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold fs-8 mb-1">API Key SID (SK...)</label>
                                            <input type="text" name="api_key_sid" id="setting_api_key_sid" class="form-control font-monospace fs-7" placeholder="e.g. SKxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $apiKeySid }}">
                                            <div class="text-muted fs-8 mt-1">Found in Twilio Console > API Keys & Tokens</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold fs-8 mb-1">API Secret</label>
                                            <input type="password" name="api_secret" id="setting_api_secret" class="form-control font-monospace fs-7" placeholder="Secret revealed when API Key was created" value="{{ $apiSecret }}">
                                            <div class="text-muted fs-8 mt-1">Secret revealed when API Key was created.</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-8 mb-1">TwiML App SID (AP...)</label>
                                            <input type="text" name="twiml_app_sid" class="form-control font-monospace fs-7" placeholder="e.g. APxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" value="{{ $twimlAppSid }}">
                                            <div class="text-muted fs-8 mt-1">Found in Twilio Console > Voice > TwiML Apps (Application SID)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold px-4">Save Settings</button>
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
        url: "{{ route('plugins.toggle') }}",
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { plugin_key: pluginKey, is_active: isActive ? 1 : 0 },
        success: function(res) {
            const badge = $('#twilioStatusBadge');
            if (isActive) {
                badge.removeClass('bg-danger-subtle text-danger').addClass('bg-success-subtle text-success').html('<i class="fa fa-circle me-1 fs-9 text-success"></i>Active');
            } else {
                badge.removeClass('bg-success-subtle text-success').addClass('bg-danger-subtle text-danger').html('<i class="fa fa-circle me-1 fs-9 text-danger"></i>Inactive');
            }
        }
    });
}

function autoFixTwilioKeys() {
    const btn = $('#autoFixKeysBtn');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Generating Keys...');

    $.ajax({
        url: "{{ route('plugins.twilio.autofix') }}",
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
