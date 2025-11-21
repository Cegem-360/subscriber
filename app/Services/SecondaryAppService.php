<?php

declare(strict_types=1);

namespace App\Services;

class SecondaryAppService
{
    /**
     * Get all configured apps.
     *
     * @return array<string, array{url: string, api_key: ?string, active: bool}>
     */
    public function getApps(): array
    {
        return config('microservices.apps', []);
    }

    /**
     * Get only active apps.
     *
     * @return array<string, array{url: string, api_key: ?string, active: bool}>
     */
    public function getActiveApps(): array
    {
        return array_filter($this->getApps(), fn (array $app): bool => $app['active']);
    }

    /**
     * Get API key for a specific app, falling back to default if not set.
     */
    public function getApiKey(string $appName): ?string
    {
        $app = $this->getApps()[$appName] ?? null;

        if (! $app) {
            return null;
        }

        return $app['api_key'] ?? $this->getDefaultApiKey();
    }

    /**
     * Get the default API key.
     */
    public function getDefaultApiKey(): ?string
    {
        return config('microservices.default_api_key');
    }

    /**
     * Get a specific app configuration.
     *
     * @return array{url: string, api_key: ?string, active: bool}|null
     */
    public function getApp(string $appName): ?array
    {
        return $this->getApps()[$appName] ?? null;
    }
}
