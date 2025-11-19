<?php

declare(strict_types=1);

namespace App\Providers;

use App\Listeners\CreateMicroservicePermissions;
use App\Models\Subscription;
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

        Event::listen(
            WebhookReceived::class,
            CreateMicroservicePermissions::class,
        );
    }
}
