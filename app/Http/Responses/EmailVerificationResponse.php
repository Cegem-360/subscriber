<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Models\User;
use Filament\Auth\Http\Responses\Contracts\EmailVerificationResponse as Responsable;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

final class EmailVerificationResponse implements Responsable
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && ! $user->isAdmin()) {
            return redirect()->intended(route('modules'));
        }

        return redirect()->intended(Filament::getUrl());
    }
}
