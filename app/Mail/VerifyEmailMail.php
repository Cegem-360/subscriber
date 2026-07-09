<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class VerifyEmailMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $verificationUrl,
        public int $expireMinutes,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cégem 360 — e-mail cím megerősítése',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email',
            with: [
                'name' => $this->name,
                'verificationUrl' => $this->verificationUrl,
                'expireMinutes' => $this->expireMinutes,
            ],
        );
    }
}
