<?php

declare(strict_types=1);

namespace App\Services\OauthProxy;

/**
 * Validates that a tenant URL is permitted to use this proxy. The whitelist is
 * stored as a comma-separated env value and read from config('oauth_proxy.allowed_tenants').
 * Comparison is host-only and case-insensitive; scheme must always be HTTPS in
 * production, but http://*.test is permitted for local development.
 */
final readonly class TenantGuard
{
    /**
     * @param  array<int, string>  $allowedHosts
     */
    public function __construct(
        private array $allowedHosts,
    ) {}

    public function isAllowed(string $tenantUrl): bool
    {
        $parts = parse_url($tenantUrl);

        if ($parts === false || ! isset($parts['scheme'], $parts['host'])) {
            return false;
        }

        $scheme = strtolower((string) $parts['scheme']);
        $host = strtolower((string) $parts['host']);

        if (! in_array($host, array_map('strtolower', $this->allowedHosts), true)) {
            return false;
        }

        if ($scheme === 'https') {
            return true;
        }

        return $scheme === 'http' && str_ends_with($host, '.test');
    }

    public function buildReturnUrl(string $tenantUrl, string $returnPath, array $query): string
    {
        $base = rtrim($tenantUrl, '/');
        $path = '/' . ltrim($returnPath, '/');

        return $base . $path . '?' . http_build_query($query);
    }
}
