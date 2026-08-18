<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLoginOtp extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $userName;
    public $userEmail;

    /**
     * Create a new message instance.
     *
     * @param string $otp
     * @param string $userName
     * @param string $userEmail
     * @return void
     */
    public function __construct($otp, $userName, $userEmail)
    {
        $this->otp = $otp;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Login Verification OTP Code')
                    ->view('emails.login_otp');
    }
}
