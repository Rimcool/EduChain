<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Verification;

class VerificationComplete extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Verification $verification) {}

    public function build()
    {
        return $this->subject('EduChain Verification Complete')
                    ->view('emails.verification_complete');
    }
}