<?php

declare(strict_types=1);

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\ThrottlePreAuthByIp;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [SetLocale::class]);
        $middleware->preventRequestForgery(except: [
            'stripe/*',
        ]);

        // Alias for the pre-auth, IP-keyed throttle applied explicitly on
        // routes where an unauthenticated request is still expensive to
        // reject (see the class PHPDoc for why this exists).
        $middleware->alias([
            'throttle.pre-auth-ip' => ThrottlePreAuthByIp::class,
        ]);

        // Listing `throttle.pre-auth-ip` before `auth:api` in a route's
        // middleware array is not sufficient by itself: Laravel's default
        // priority list already ranks `AuthenticatesRequests` ahead of
        // `SubstituteBindings`, and `SortedMiddleware` reorders `Authenticate`
        // to satisfy that regardless of where unrecognised, non-prioritised
        // middleware — like this one — sit in the route's middleware array,
        // dragging them along to wherever the reorder leaves them. Registering
        // only this one middleware class here — not the shared
        // `ThrottleRequests`/`Authenticate` relationship used by every other
        // route — keeps the fix scoped to this single route. See the class
        // PHPDoc for the full explanation.
        $middleware->prependToPriorityList(
            before: AuthenticatesRequests::class,
            prepend: ThrottlePreAuthByIp::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
