<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationComplete extends Mailable
{
    use Queueable, SerializesModels;

    public $verification;

    public function __construct($verification)
    {
        $this->verification = $verification;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Degree Verification Complete',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.verification-complete',
        );
    }

    public function attachments()
    {
        return [];
    }
}