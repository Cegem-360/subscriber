<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BasePage;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Override;

final class Login extends BasePage
{
    public string $view = 'filament.pages.auth.login';

    protected static string $layout = 'filament.layouts.auth';

    #[Override]
    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label('Add meg a munkahelyi e-mail címed')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->placeholder('pelda@ceg.hu')
            ->extraInputAttributes(['tabindex' => 1]);
    }

    #[Override]
    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label('Jelszó')
            ->password()
            ->revealable()
            ->autocomplete('current-password')
            ->required()
            ->extraInputAttributes(['tabindex' => 2]);
    }

    #[Override]
    protected function getRememberFormComponent(): Checkbox
    {
        return Checkbox::make('remember')
            ->label('Emlékezz rám')
            ->extraInputAttributes(['tabindex' => 3]);
    }

    #[Override]
    public function mount(): void
    {
        parent::mount();

        // Show notification from email verification redirect
        if ($notification = session('notification')) {
            Notification::make()
                ->title($notification['title'] ?? '')
                ->body($notification['body'] ?? '')
                ->{$notification['status'] ?? 'info'}()
                ->send();
        }

        if (app()->environment('local')) {
            $this->form->fill([
                'email' => 'admin@admin.com',
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }

    #[Override]
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
