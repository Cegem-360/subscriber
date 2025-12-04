<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use App\Enums\Country;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

final class Register extends BaseRegister
{
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
