<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Enums\Country;
use App\Enums\UserRole;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Override;

final class Register extends BaseRegister
{
    public string $view = 'filament.pages.auth.register';

    protected static string $layout = 'filament.layouts.auth-split';

    private ?string $rawPassword = null;

    protected function beforeValidate(): void
    {
        // Capture raw password before form dehydration hashes it
        $this->rawPassword = $this->data['password'] ?? null;
    }

    #[Override]
    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration($data);

        UserTeamSync::createUser(
            email: $user->email,
            name: $user->name,
            password: $this->rawPassword,
            role: $user->role?->value ?? UserRole::Manager->value,
            ownerEmail: $user->email,
        );

        UserTeamSync::createTeam(
            teamName: $user->company_name,
            userEmail: $user->email,
            userName: $user->name,
        );

        return $user;
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyFieldset(),
            ])
            ->columns(2);
    }

    private function getCompanyFieldset(): Fieldset
    {
        return Fieldset::make('Company information')
            ->translateLabel()
            ->schema([
                TextInput::make('company_name')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make('tax_number')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make('city')
                    ->required()
                    ->maxLength(length: 255),

                TextInput::make(name: 'postal_code')
                    ->required()
                    ->maxLength(length: 20),

                Select::make('country')
                    ->options(Country::class)
                    ->default(Country::Hungary)
                    ->required(),
            ])
            ->columns(2)
            ->columnSpanFull();
    }
}
