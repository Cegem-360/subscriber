<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Mail\VerifyEmailMail;
use Filament\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Contracts\Mail\Mailable;
use Override;

final class VerifyEmailNotification extends BaseVerifyEmail
{
    /**
     * Build the branded e-mail verification message.
     *
     * The panel injects the signed verification URL into $this->url before sending.
     */
    #[Override]
    public function toMail($notifiable): Mailable
    {
        $expireMinutes = (int) config('auth.verification.expire', 60);

        return (new VerifyEmailMail(
            name: (string) ($notifiable->name ?? ''),
            verificationUrl: $this->url,
            expireMinutes: $expireMinutes,
        ))->to($notifiable->getEmailForVerification());
    }
}
