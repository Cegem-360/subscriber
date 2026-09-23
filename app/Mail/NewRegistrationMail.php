<?php

declare(strict_types=1);

namespace App\Mail;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Tells the Cégem 360 team that a new customer registered on the site.
 */
final class NewRegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->user->email, $this->user->name)],
            subject: sprintf('Új regisztráció – %s (%s)', $this->user->name, $this->user->company_name),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-registration',
            with: [
                'user' => $this->user,
                'adminUrl' => UserResource::getUrl('edit', ['record' => $this->user], panel: 'admin'),
            ],
        );
    }
}
