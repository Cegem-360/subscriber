<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth\PasswordReset;

use Filament\Auth\Pages\PasswordReset\ResetPassword as BasePage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Validation\Rules\Password as PasswordRule;

final class ResetPassword extends BasePage
{
    public string $view = 'filament.pages.auth.password-reset.reset-password';

    protected static string $layout = 'filament.layouts.auth';

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('E-mail cím')
            ->disabled()
            ->autofocus();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Új jelszó')
            ->password()
            ->revealable()
            ->autocomplete('new-password')
            ->required()
            ->rule(PasswordRule::default())
            ->same('passwordConfirmation')
            ->validationAttribute('jelszó');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('Jelszó megerősítése')
            ->password()
            ->revealable()
            ->autocomplete('new-password')
            ->required()
            ->dehydrated(false);
    }
}
