<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EmailVerification\EmailVerificationPrompt as BaseEmailVerificationPrompt;
use Filament\Facades\Filament;

final class EmailVerificationPrompt extends BaseEmailVerificationPrompt
{
    public function mount(): void
    {
        /** @var \App\Models\User|null $user */
        $user = Filament::auth()->user();

        if (! $user || $user->hasVerifiedEmail()) {
            if ($user && ! $user->isAdmin()) {
                redirect()->intended(route('modules'));

                return;
            }

            redirect()->intended(Filament::getUrl());

            return;
        }
    }
}
