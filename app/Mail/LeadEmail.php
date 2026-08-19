<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class LeadEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $emailSubject;
    public string $emailBody;
    public ?UploadedFile $attachmentFile;

    /**
     * Create a new message instance.
     */
    public function __construct(string $emailSubject, string $emailBody, ?UploadedFile $attachmentFile = null)
    {
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
        $this->attachmentFile = $attachmentFile;
    }

    /**
     * Get the message envelope dynamically using logged-in user email and name.
     */
    public function envelope(): Envelope
    {
        $user = Auth::user();

        // Get logged-in user email and name (fallback to config if empty)
        $senderEmail = ($user && !empty($user->email)) ? $user->email : config('mail.from.address', 'rahul.warrgyizmorsch@gmail.com');
        $senderName = ($user && !empty($user->name)) ? $user->name : config('mail.from.name', 'Warrgyizmorsch');

        return new Envelope(
            from: new Address($senderEmail, $senderName),
            replyTo: [
                new Address($senderEmail, $senderName)
            ],
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lead_dynamic_email',
            with: [
                'bodyContent' => $this->emailBody,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->attachmentFile && $this->attachmentFile->isValid()) {
            return [
                Attachment::fromPath($this->attachmentFile->getRealPath())
                    ->as($this->attachmentFile->getClientOriginalName())
                    ->withMime($this->attachmentFile->getClientMimeType()),
            ];
        }

        return [];
    }
}
