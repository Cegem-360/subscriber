<?php

declare(strict_types=1);

namespace App\Concerns;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Shared gate for "read-only until the email is verified" behavior. The same
 * check drives both the backend guards on write actions and the UI visibility
 * of the buttons that trigger them, so the two can never drift apart.
 */
trait RequiresEmailVerification
{
    public function userEmailVerified(): bool
    {
        return Auth::user()?->hasVerifiedEmail() ?? false;
    }

    /**
     * Call at the very start of any write action. Returns false (and warns the
     * user) when the email is not verified, so the caller can bail out early.
     */
    protected function guardWrite(): bool
    {
        if ($this->userEmailVerified()) {
            return true;
        }

        Notification::make()
            ->warning()
            ->title(__('Verify your email address'))
            ->body(__('You must verify your email address before performing this action.'))
            ->send();

        return false;
    }
}
