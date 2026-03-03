<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class RedirectNonAdminFromPanel
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && $user->hasVerifiedEmail() && ! $user->isAdmin() && ! $request->routeIs('filament.admin.auth.logout', 'filament.admin.auth.login')) {
            return redirect()->route('modules');
        }

        return $next($request);
    }
}
