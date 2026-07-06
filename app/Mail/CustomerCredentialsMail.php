<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class CustomerCredentialsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $loginUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Belépési adatok – Cégem 360',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.customer-credentials',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'loginUrl' => $this->loginUrl,
            ],
        );
    }
}
