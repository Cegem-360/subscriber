<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class OrderConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $moduleName,
        public ?string $moduleUrl,
        public string $billingPeriodLabel,
        public ?string $nextRenewalDate,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cégem 360 — rendelés visszaigazolása',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'moduleName' => $this->moduleName,
                'moduleUrl' => $this->moduleUrl,
                'billingPeriodLabel' => $this->billingPeriodLabel,
                'nextRenewalDate' => $this->nextRenewalDate,
            ],
        );
    }
}
