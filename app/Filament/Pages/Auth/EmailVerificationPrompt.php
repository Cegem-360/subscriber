<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Auth\Pages\EmailVerification\EmailVerificationPrompt as BaseEmailVerificationPrompt;
use Filament\Facades\Filament;
use Override;

final class EmailVerificationPrompt extends BaseEmailVerificationPrompt
{
    #[Override]
    public function mount(): void
    {
        /** @var User|null $user */
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
