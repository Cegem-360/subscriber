<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth\PasswordReset;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BasePage;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

final class RequestPasswordReset extends BasePage
{
    public string $view = 'filament.pages.auth.password-reset.request-password-reset';

    protected static string $layout = 'filament.layouts.auth';

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('E-mail cím')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus()
            ->placeholder('pelda@ceg.hu')
            ->extraInputAttributes(['tabindex' => 1]);
    }
}
