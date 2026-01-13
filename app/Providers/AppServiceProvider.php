<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Subscription;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useSubscriptionModel(Subscription::class);

        // Set Filament colors globally (for standalone components outside panel)
        FilamentColor::register([
            'primary' => Color::Indigo,
        ]);

        Fieldset::configureUsing(fn (Fieldset $fieldset) => $fieldset->translateLabel());
        TextInput::configureUsing(fn (TextInput $textInput) => $textInput->translateLabel());
        Select::configureUsing(fn (Select $select) => $select->translateLabel());
        TextColumn::configureUsing(fn (TextColumn $textColumn) => $textColumn->translateLabel());

        /* Event::listen(
            WebhookReceived::class,
        ); */
    }
}
