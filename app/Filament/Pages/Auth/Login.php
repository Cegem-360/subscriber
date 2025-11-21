<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BasePage;
use Illuminate\Support\Facades\Auth;

final class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();
        if (app()->environment('local')) {
            $this->form->fill([
                'email' => 'admin@admin.com',
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }

    public function authenticate(): ?LoginResponse
    {
        $response = parent::authenticate();

        $user = Auth::user();

        if ($user && ! $user->isAdmin()) {
            $this->redirect(route('modules'));

            return null;
        }

        return $response;
    }
}
