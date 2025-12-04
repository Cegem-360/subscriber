<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Enums\Country;
use App\Enums\UserRole;
use App\Jobs\CreateTeamInSecondaryApp;
use App\Jobs\CreateUserInSecondaryApp;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;

final class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration($data);

        Bus::chain([
            new CreateUserInSecondaryApp(
                email: $user->email,
                name: $user->name,
                password: $data['password'],
                role: $user->role?->value ?? UserRole::Subscriber->value,
                ownerEmail: $user->email,
            ),
            new CreateTeamInSecondaryApp(
                teamName: $user->company_name,
                userEmail: $user->email,
                userName: $user->name,
            ),
        ])->dispatch();

        return $user;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyFieldset(),
            ]);
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
            ->columns(2);
    }
}
