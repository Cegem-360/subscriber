<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\EmailVerificationResponse;
use App\Models\Subscription;
use Filament\Auth\Http\Responses\Contracts\EmailVerificationResponse as EmailVerificationResponseContract;
use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Fieldset;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationResponseContract::class, EmailVerificationResponse::class);
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
        Field::configureUsing(fn (Field $field) => $field->translateLabel());
    }
}
