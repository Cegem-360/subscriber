<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

/**
 * A pre-authentication, IP-keyed throttle for routes where an unauthenticated
 * request is still expensive to reject.
 *
 * `GET /api/userinfo` costs a full JWT parse plus RS256 signature
 * verification inside Passport's ResourceServer before it can even return a
 * 401, so an anonymous caller has attacker-controlled cost with no ceiling.
 *
 * It is keyed by IP address only, deliberately. A pre-auth limiter cannot
 * key by user id: the user is not known yet, because authentication has not
 * run. Keying by IP is therefore the correct and honest design here, not a
 * compromise, and it must not be "improved" later to look up
 * `$request->user()`.
 *
 * This class deliberately does NOT extend
 * `Illuminate\Routing\Middleware\ThrottleRequests`. Subclassing it would make
 * this middleware sortable by `Illuminate\Routing\SortedMiddleware` under the
 * *framework's* `ThrottleRequests` priority slot, so a later, unrelated
 * global priority change could silently move it after `Authenticate` again —
 * the exact bug this middleware replaces a fix for.
 *
 * Simply listing this middleware before `auth:api` in the route definition
 * is NOT enough on its own: `bootstrap/app.php` explicitly registers this
 * class, and only this class, in the priority list via
 * `prependToPriorityList()`, positioned before
 * `Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests`. Without that,
 * `SortedMiddleware` still reorders `Authenticate` ahead of unrelated
 * *recognised* middleware (e.g. `SubstituteBindings`, which the `api` group
 * always applies ahead of route-specific middleware) when it hops to satisfy
 * the framework's own default priority — and because this class itself isn't
 * in the priority map, it gets dragged along wherever that hop leaves it,
 * landing after `Authenticate` regardless of its position in the route's
 * middleware array. Registering only this one middleware class — not the
 * shared `ThrottleRequests`/`Authenticate` ordering used everywhere else in
 * the app — keeps the fix scoped to this single route.
 */
final class ThrottlePreAuthByIp
{
    private const int MAX_ATTEMPTS_PER_MINUTE = 60;

    private const int DECAY_SECONDS = 60;

    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveKey($request);

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS_PER_MINUTE)) {
            return response()->json(['message' => 'Too Many Attempts.'], 429);
        }

        RateLimiter::hit($key, self::DECAY_SECONDS);

        return $next($request);
    }

    private function resolveKey(Request $request): string
    {
        return 'pre-auth-throttle:' . ($request->ip() ?? 'unknown');
    }
}
