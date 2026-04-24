<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class ContactInquiryMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        public string $source,
        public array $data,
    ) {}

    public function envelope(): Envelope
    {
        $name = trim(((string) ($this->data['lastName'] ?? '')) . ' ' . ((string) ($this->data['firstName'] ?? '')));
        $subjectPrefix = $this->source === 'pricing'
            ? 'Új árajánlatkérés'
            : 'Új kapcsolatfelvétel';

        return new Envelope(
            subject: $name !== ''
                ? sprintf('%s – %s', $subjectPrefix, $name)
                : $subjectPrefix,
            replyTo: ! empty($this->data['email'])
                ? [new Address((string) $this->data['email'], $name !== '' ? $name : null)]
                : [],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-inquiry',
            with: [
                'source' => $this->source,
                'data' => $this->data,
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
