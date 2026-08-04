<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->ensurePassportKeysExist();
    }

    /**
     * `Auth::guard('api')` eagerly resolves Passport's ResourceServer, which
     * throws a `LogicException` if `storage/oauth-{public,private}.key` are
     * absent. Those files are gitignored (`/storage/*.key`), so a fresh
     * clone has none and every `/api/*` test — including the unauthenticated
     * 401 ones — would fail before this guard.
     *
     * Generate them once, locally, only when missing; regenerating on every
     * run would be wasteful and slow. Never commit the generated key files.
     */
    private function ensurePassportKeysExist(): void
    {
        $publicKey = Passport::keyPath('oauth-public.key');
        $privateKey = Passport::keyPath('oauth-private.key');

        if (file_exists($publicKey) && file_exists($privateKey)) {
            return;
        }

        Artisan::call('passport:keys', ['--force' => true]);
    }
}
