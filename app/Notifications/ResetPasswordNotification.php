<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Mail\PasswordResetMail;
use Filament\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Contracts\Mail\Mailable;
use Override;

final class ResetPasswordNotification extends BaseResetPassword
{
    /**
     * Build the branded reset-password email.
     *
     * The panel injects the reset URL into $this->url before sending.
     */
    #[Override]
    public function toMail($notifiable): Mailable
    {
        $expireMinutes = (int) config(
            'auth.passwords.' . config('auth.defaults.passwords') . '.expire',
            60,
        );

        return (new PasswordResetMail(
            name: (string) ($notifiable->name ?? ''),
            resetUrl: $this->url,
            expireMinutes: $expireMinutes,
        ))->to($notifiable->getEmailForPasswordReset());
    }
}
