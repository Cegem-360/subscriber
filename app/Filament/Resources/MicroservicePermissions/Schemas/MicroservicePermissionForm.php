<?php

declare(strict_types=1);

namespace App\Filament\Resources\MicroservicePermissions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MicroservicePermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subscription_id')
                    ->relationship('subscription', 'id')
                    ->required(),
                TextInput::make('microservice_name')
                    ->required(),
                TextInput::make('microservice_slug')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                DateTimePicker::make('activated_at'),
                DateTimePicker::make('expires_at'),
            ]);
    }
}
