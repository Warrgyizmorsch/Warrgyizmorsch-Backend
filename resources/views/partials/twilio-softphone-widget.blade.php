@once
<!-- Twilio Voice WebRTC SDK -->
<script src="https://cdn.jsdelivr.net/npm/@twilio/voice-sdk@2.11.0/dist/twilio.min.js"></script>

<style>
.twilio-softphone-box {
    position: fixed;
    right: 25px;
    bottom: 30px;
    width: 320px;
    max-width: calc(100vw - 30px);
    background: #1e1e2d;
    color: #fff;
    border-radius: 16px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.12);
    z-index: 99999;
    overflow: hidden;
    display: none;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    animation: twilioSlideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes twilioSlideUp {
    from { opacity: 0; transform: translateY(20px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.twilio-softphone-header {
    padding: 12px 16px;
    background: #151521;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.twilio-dialpad-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    padding: 14px 18px;
}
.twilio-dialpad-btn {
    height: 50px;
    border-radius: 12px;
    background: #2b2b40;
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.06);
    font-size: 18px;
    font-weight: 600;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
    line-height: 1;
}
.twilio-dialpad-btn span.subtext {
    font-size: 9px;
    letter-spacing: 1px;
    color: rgba(255, 255, 255, 0.4);
    margin-top: 3px;
    text-transform: uppercase;
}
.twilio-dialpad-btn:hover { 
    background: #383857; 
    color: #38bdf8; 
    border-color: rgba(56, 189, 248, 0.3);
    transform: translateY(-1px);
}
.twilio-dialpad-btn:active {
    transform: translateY(1px);
    background: #252538;
}
.pulse-ringing { 
    animation: pulseRing 1.5s infinite; 
}
@keyframes pulseRing {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { box-shadow: 0 0 0 16px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}
.pulse-dialing {
    animation: pulseDial 1.5s infinite;
}
@keyframes pulseDial {
    0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
    70% { box-shadow: 0 0 0 16px rgba(59, 130, 246, 0); }
    100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
}
.twilio-floating-dial-trigger {
    position: fixed;
    right: 25px;
    bottom: 30px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.45);
    cursor: pointer;
    z-index: 99998;
    transition: all 0.25s ease;
    border: 2px solid rgba(255, 255, 255, 0.2);
}
.twilio-floating-dial-trigger:hover {
    transform: scale(1.08);
    box-shadow: 0 14px 30px rgba(16, 185, 129, 0.6);
}
</style>

<!-- Floating Softphone Launch Icon -->
<div class="twilio-floating-dial-trigger" id="twilioSoftphoneTrigger" onclick="twilioSoftphone.toggleWidget()" title="Open Twilio Dialer">
    <i class="fa fa-phone"></i>
</div>

<!-- Floating Softphone Dialer Widget Box -->
<div class="twilio-softphone-box" id="twilioSoftphoneBox">
    <!-- Header -->
    <div class="twilio-softphone-header">
        <div class="d-flex align-items-center gap-2">
            <i class="fa fa-phone text-primary" style="font-size: 13px;"></i>
            <span class="fw-bold" style="font-size: 13px; letter-spacing: 0.3px;">Twilio Softphone</span>
            <span id="twilioStatusText" class="badge bg-secondary" style="font-size: 9px; padding: 3px 6px; border-radius: 6px;">Initializing...</span>
        </div>
        <button type="button" class="btn btn-sm text-white p-0" onclick="twilioSoftphone.toggleWidget()" style="background: none; border: none; opacity: 0.7;">
            <i class="fa fa-times"></i>
        </button>
    </div>

    <!-- 1. Standby / Dialpad View -->
    <div id="twilioDialpadView" class="p-3">
        <!-- Number Display -->
        <div class="position-relative mb-2">
            <input type="text" id="twilioDialNumberInput" class="form-control text-white text-center fw-bold" 
                   placeholder="+91..." 
                   style="background: #151521; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 10px; font-size: 18px; height: 46px; letter-spacing: 1px;">
            <button type="button" class="btn text-muted position-absolute end-0 top-0 h-100 px-3 d-flex align-items-center" 
                    onclick="twilioSoftphone.backspace()" style="background: none; border: none;">
                <i class="fa fa-backspace" style="font-size: 14px;"></i>
            </button>
        </div>

        <!-- Dialpad Grid -->
        <div class="twilio-dialpad-grid px-0 pt-1 pb-2">
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('1')">1<span class="subtext">&nbsp;</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('2')">2<span class="subtext">ABC</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('3')">3<span class="subtext">DEF</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('4')">4<span class="subtext">GHI</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('5')">5<span class="subtext">JKL</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('6')">6<span class="subtext">MNO</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('7')">7<span class="subtext">PQRS</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('8')">8<span class="subtext">TUV</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('9')">9<span class="subtext">WXYZ</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('*')">*<span class="subtext">&nbsp;</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('0')">0<span class="subtext">+</span></button>
            <button type="button" class="twilio-dialpad-btn" onclick="twilioSoftphone.appendDigit('#')">#<span class="subtext">&nbsp;</span></button>
        </div>

        <!-- Call Button -->
        <div class="text-center mt-1">
            <button type="button" class="btn btn-success w-100 py-2.5 fw-bold d-flex align-items-center justify-content-center gap-2 shadow" 
                    onclick="twilioSoftphone.dialFromInput()" 
                    style="border-radius: 12px; font-size: 15px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                <i class="fa fa-phone"></i> Call Now
            </button>
        </div>
    </div>

    <!-- 2. Active Call Screen -->
    <div id="twilioActiveCallView" class="d-none text-center py-4 px-3">
        <div class="pulse-dialing rounded-circle bg-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
            <i class="fa fa-phone text-white fs-4"></i>
        </div>
        <h5 class="text-white mb-1 fw-bold" id="twilioActiveCallName">Dialing...</h5>
        <div class="text-white-50 small mb-2 font-monospace" id="twilioActiveCallNumber">+1...</div>
        <div class="badge bg-success mb-3 px-3 py-1.5" id="twilioActiveCallTimer" style="font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">Connecting...</div>

        <!-- In-Call Actions (Mute, Hold, Hangup) -->
        <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
            <button type="button" id="twilioMuteBtn" class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center" 
                    style="width: 44px; height: 44px; background: #2b2b40; border: 1px solid rgba(255, 255, 255, 0.1);" 
                    onclick="twilioSoftphone.toggleMute()" title="Mute / Unmute">
                <i class="fa fa-microphone-slash"></i>
            </button>
            <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center shadow-lg" 
                    style="width: 52px; height: 52px; background: #ef4444; border: none;" 
                    onclick="twilioSoftphone.hangup()" title="End Call">
                <i class="fa fa-phone-slash fs-5"></i>
            </button>
            <button type="button" id="twilioHoldBtn" class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center" 
                    style="width: 44px; height: 44px; background: #2b2b40; border: 1px solid rgba(255, 255, 255, 0.1);" 
                    onclick="twilioSoftphone.toggleHold()" title="Hold / Unhold">
                <i class="fa fa-pause"></i>
            </button>
        </div>
    </div>

    <!-- 3. Incoming Call Screen -->
    <div id="twilioIncomingCallView" class="d-none text-center py-4 px-3">
        <div class="pulse-ringing rounded-circle bg-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 58px; height: 58px;">
            <i class="fa fa-phone-volume text-white fs-4"></i>
        </div>
        <h5 class="text-white mb-1 fw-bold">Incoming Call</h5>
        <div class="text-white-50 small mb-3 font-monospace" id="twilioIncomingFromNumber">+1...</div>
        <div class="d-flex justify-content-center gap-3 mt-2">
            <button type="button" class="btn btn-success rounded-circle d-flex align-items-center justify-content-center shadow" 
                    style="width: 50px; height: 50px; background: #10b981; border: none;" 
                    onclick="twilioSoftphone.acceptIncoming()" title="Accept Call">
                <i class="fa fa-phone fs-5"></i>
            </button>
            <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center shadow" 
                    style="width: 50px; height: 50px; background: #ef4444; border: none;" 
                    onclick="twilioSoftphone.rejectIncoming()" title="Reject Call">
                <i class="fa fa-phone-slash fs-5"></i>
            </button>
        </div>
    </div>
</div>

<script>
class TwilioSoftphoneController {
    constructor() {
        this.device = null;
        this.activeCall = null;
        this.incomingCall = null;
        this.callTimerInterval = null;
        this.callSeconds = 0;
        this.isMuted = false;
        this.isHeld = false;
        this.isReady = false;
        this.isInitializing = false;
        this.currentCallData = null;
    }

    async init() {
        if (this.isInitializing) return false;
        this.isInitializing = true;

        if (typeof Twilio === 'undefined' || !Twilio.Device) {
            console.warn('Twilio Voice SDK not loaded yet.');
            this.isInitializing = false;
            return false;
        }

        try {
            $('#twilioStatusText').text('Connecting...').removeClass('bg-success bg-danger').addClass('bg-secondary');
            const res = await $.ajax({
                url: "{{ route('twilio.token') }}",
                type: "GET",
                dataType: "json"
            });

            if (!res || !res.token) {
                console.error('Failed to obtain Twilio token:', res?.message);
                $('#twilioStatusText').text('Config Error').removeClass('bg-secondary bg-success').addClass('bg-danger');
                this.isInitializing = false;
                return false;
            }

            if (this.device) {
                try { this.device.destroy(); } catch(e){}
            }

            // Initialize Device with resilient multi-edge fallback
            this.device = new Twilio.Device(res.token, {
                edge: ['singapore', 'ashburn', 'dublin', 'roaming'],
                codecPreferences: ['opus', 'pcmu'],
                fakeLocalDTMF: true,
                enableRingingState: true,
            });

            this.device.on('registered', () => {
                this.isReady = true;
                $('#twilioStatusText').text('Online').removeClass('bg-danger bg-secondary').addClass('bg-success');
            });

            this.device.on('unregistered', () => {
                this.isReady = false;
                $('#twilioStatusText').text('Offline').removeClass('bg-success bg-secondary').addClass('bg-danger');
            });

            this.device.on('error', (twilioError) => {
                console.warn('Twilio Device warning/error:', twilioError);
                if (twilioError.code === 31205) {
                    // Token expired -> refresh
                    this.refreshToken();
                }
            });

            this.device.on('incoming', (call) => this.handleIncoming(call));

            this.device.on('tokenWillExpire', async () => {
                await this.refreshToken();
            });

            await this.device.register();
            this.isInitializing = false;
            return true;
        } catch (e) {
            console.error('Twilio softphone init failed:', e);
            $('#twilioStatusText').text('Offline').removeClass('bg-secondary bg-success').addClass('bg-danger');
            this.isInitializing = false;
            return false;
        }
    }

    async refreshToken() {
        try {
            const fresh = await $.get("{{ route('twilio.token') }}");
            if (fresh && fresh.token && this.device) {
                await this.device.updateToken(fresh.token);
                console.log('Twilio token refreshed successfully');
            }
        } catch(err) {
            console.error('Token refresh failed:', err);
        }
    }

    toggleWidget() {
        if (!this.isReady) this.init();
        const box = $('#twilioSoftphoneBox');
        if (box.is(':visible')) {
            box.fadeOut(180);
            $('#twilioSoftphoneTrigger').fadeIn(180);
        } else {
            box.fadeIn(200);
            $('#twilioSoftphoneTrigger').fadeOut(180);
        }
    }

    appendDigit(digit) {
        if (this.activeCall) {
            // Send DTMF tones during active call
            try { this.activeCall.sendDigits(digit); } catch(e){}
        }
        const input = $('#twilioDialNumberInput');
        input.val(input.val() + digit);
    }

    backspace() {
        const input = $('#twilioDialNumberInput');
        const current = input.val();
        input.val(current.slice(0, -1));
    }

    dialFromInput() {
        const phone = $('#twilioDialNumberInput').val();
        if (!phone || phone.trim().length < 4) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Please enter a valid phone number.',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                alert('Please enter a valid phone number.');
            }
            return;
        }
        this.makeCall(phone, 'Customer');
    }

    async makeCall(numberToDial, displayName = '') {
        let phone = String(numberToDial || '').trim().replace(/[\s\-\(\)]/g, '');
        if (!phone.startsWith('+')) {
            // Strip leading zero if present
            if (phone.startsWith('0')) phone = phone.substring(1);
            if (phone.length === 10) phone = '+91' + phone;
            else phone = '+' + phone;
        }

        if (!this.device || this.device.state !== 'registered') {
            if (!this.device && !this.isInitializing) {
                await this.init();
            }
            let waitTicks = 0;
            while (this.device && this.device.state === 'registering' && waitTicks < 15) {
                await new Promise(r => setTimeout(r, 200));
                waitTicks++;
            }
            if (!this.device) {
                const msg = 'Unable to connect to Twilio Voice Service. Check your Twilio settings.';
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: msg,
                        showConfirmButton: false,
                        timer: 3500
                    });
                } else {
                    alert(msg);
                }
                return;
            }
        }

        $('#twilioSoftphoneTrigger').fadeOut(180);
        $('#twilioSoftphoneBox').show();
        $('#twilioDialpadView').addClass('d-none');
        $('#twilioIncomingCallView').addClass('d-none');
        $('#twilioActiveCallView').removeClass('d-none');
        $('#twilioActiveCallName').text(displayName || 'Customer');
        $('#twilioActiveCallNumber').text(phone);
        $('#twilioActiveCallTimer').text('Calling...').removeClass('bg-success').addClass('bg-secondary');

        this.currentCallData = {
            direction: 'outbound',
            to_number: phone,
            customer_name: displayName || 'Customer',
            started_at: new Date().toISOString()
        };

        try {
            const call = await this.device.connect({ params: { To: phone } });
            this.setupCallEvents(call);
        } catch (err) {
            console.error('Call failed to start:', err);
            this.endCallUI();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Call Unsuccessful: ' + (err.message || 'Error connecting call'),
                    showConfirmButton: false,
                    timer: 4000
                });
            } else {
                alert('Call Unsuccessful: ' + (err.message || 'Error'));
            }
        }
    }

    setupCallEvents(call) {
        this.activeCall = call;

        call.on('ringing', () => {
            $('#twilioActiveCallTimer').text('Ringing...').removeClass('bg-secondary bg-success').addClass('bg-info');
        });

        call.on('accept', () => {
            $('#twilioActiveCallTimer').text('00:00').removeClass('bg-info bg-secondary').addClass('bg-success');
            this.startTimer();
            this.postCallLog({
                call_sid: call.parameters?.CallSid || null,
                direction: 'outbound',
                to_number: this.currentCallData?.to_number || '',
                customer_name: this.currentCallData?.customer_name || 'Customer',
                status: 'in-progress',
                started_at: this.currentCallData?.started_at
            });
        });

        call.on('disconnect', () => {
            const duration = this.callSeconds || 0;
            this.postCallLog({
                call_sid: call.parameters?.CallSid || null,
                direction: 'outbound',
                to_number: this.currentCallData?.to_number || '',
                customer_name: this.currentCallData?.customer_name || 'Customer',
                status: duration > 0 ? 'completed' : 'no-answer',
                duration: duration,
                ended_at: new Date().toISOString()
            });
            this.endCallUI();
        });

        call.on('error', (err) => {
            console.warn('Call error event:', err);
            this.endCallUI();
            const errMsg = err.message || (err.explanation || 'Twilio Error ' + (err.code || ''));
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Call Ended with Twilio Error',
                    html: `<div class="text-start">
                        <p class="mb-1 text-danger fw-bold">${errMsg}</p>
                        ${err.code ? `<small class="text-muted">Error Code: ${err.code}</small>` : ''}
                    </div>`,
                    confirmButtonText: 'OK'
                });
            } else {
                alert('Call Ended with Twilio Error: ' + errMsg + (err.code ? ' (Code: ' + err.code + ')' : ''));
            }
        });
    }

    handleIncoming(call) {
        this.incomingCall = call;
        const from = call.parameters?.From || 'Incoming Customer';
        $('#twilioSoftphoneTrigger').fadeOut(180);
        $('#twilioSoftphoneBox').show();
        $('#twilioDialpadView').addClass('d-none');
        $('#twilioActiveCallView').addClass('d-none');
        $('#twilioIncomingCallView').removeClass('d-none');
        $('#twilioIncomingFromNumber').text(from);

        call.on('disconnect', () => this.endCallUI());
        call.on('cancel', () => this.endCallUI());
        call.on('reject', () => this.endCallUI());
    }

    acceptIncoming() {
        if (this.incomingCall) {
            $('#twilioIncomingCallView').addClass('d-none');
            $('#twilioActiveCallView').removeClass('d-none');
            $('#twilioActiveCallName').text('Customer');
            $('#twilioActiveCallNumber').text(this.incomingCall.parameters?.From || '');
            this.incomingCall.accept();
            this.setupCallEvents(this.incomingCall);
            this.incomingCall = null;
        }
    }

    rejectIncoming() {
        if (this.incomingCall) {
            this.incomingCall.reject();
            this.incomingCall = null;
            this.endCallUI();
        }
    }

    toggleMute() {
        if (this.activeCall) {
            this.isMuted = !this.isMuted;
            this.activeCall.mute(this.isMuted);
            $('#twilioMuteBtn').toggleClass('btn-warning text-dark', this.isMuted);
        }
    }

    toggleHold() {
        if (this.activeCall) {
            this.isHeld = !this.isHeld;
            this.activeCall.mute(this.isHeld);
            $('#twilioHoldBtn').toggleClass('btn-warning text-dark', this.isHeld);
        }
    }

    hangup() {
        if (this.activeCall) {
            try { this.activeCall.disconnect(); } catch(e){}
        }
        this.endCallUI();
    }

    startTimer() {
        this.callSeconds = 0;
        clearInterval(this.callTimerInterval);
        this.callTimerInterval = setInterval(() => {
            this.callSeconds++;
            const mins = String(Math.floor(this.callSeconds / 60)).padStart(2, '0');
            const secs = String(this.callSeconds % 60).padStart(2, '0');
            $('#twilioActiveCallTimer').text(`${mins}:${secs}`);
        }, 1000);
    }

    postCallLog(data) {
        $.ajax({
            url: "{{ route('twilio.log.call') }}",
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: data
        });
    }

    endCallUI() {
        clearInterval(this.callTimerInterval);
        this.activeCall = null;
        this.incomingCall = null;
        this.callSeconds = 0;
        this.isMuted = false;
        this.isHeld = false;
        $('#twilioMuteBtn').removeClass('btn-warning text-dark');
        $('#twilioHoldBtn').removeClass('btn-warning text-dark');
        $('#twilioActiveCallView').addClass('d-none');
        $('#twilioIncomingCallView').addClass('d-none');
        $('#twilioDialpadView').removeClass('d-none');
        setTimeout(() => {
            $('#twilioSoftphoneBox').fadeOut(250);
            $('#twilioSoftphoneTrigger').fadeIn(250);
        }, 1200);
    }
}

// Instantiate global softphone
window.twilioSoftphone = new TwilioSoftphoneController();

// Auto-initialize when document is ready
$(document).ready(function() {
    window.twilioSoftphone.init();
});

// Global Trigger Function (Can be called from any button in the CRM)
window.initiateTwilioCall = function(phone, name = 'Customer') {
    if (!phone) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: 'Please provide a valid phone number.',
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            alert('Please provide a valid phone number.');
        }
        return;
    }
    window.twilioSoftphone.makeCall(phone, name);
};
</script>
@endonce
