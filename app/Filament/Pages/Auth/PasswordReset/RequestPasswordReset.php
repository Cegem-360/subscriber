<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth\PasswordReset;

use Override;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BasePage;
use Filament\Forms\Components\TextInput;

final class RequestPasswordReset extends BasePage
{
    public string $view = 'filament.pages.auth.password-reset.request-password-reset';

    protected static string $layout = 'filament.layouts.auth';

    #[Override]
    protected function getEmailFormComponent(): TextInput
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
