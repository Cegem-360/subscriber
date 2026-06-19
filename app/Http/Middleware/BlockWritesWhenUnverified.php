<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps the panel read-only for users with an unverified email: the full-page
 * create/edit forms are write entry points, so we block them and bounce the
 * user back to the resource index. Listing and viewing stay open.
 */
final class BlockWritesWhenUnverified
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user && ! $user->hasVerifiedEmail() && $request->routeIs('filament.admin.resources.*.create', 'filament.admin.resources.*.edit')) {
            Notification::make()
                ->warning()
                ->title(__('Verify your email address'))
                ->body(__('You must verify your email address before performing this action.'))
                ->send();

            $indexRoute = (string) preg_replace('/\.(create|edit)$/', '.index', (string) $request->route()?->getName());

            return redirect()->route($indexRoute);
        }

        return $next($request);
    }
}
