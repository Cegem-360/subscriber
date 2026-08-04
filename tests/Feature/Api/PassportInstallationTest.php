<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\HasApiTokens;

it('registers an api guard backed by the passport driver', function (): void {
    expect(config('auth.guards.api.driver'))->toBe('passport')
        ->and(config('auth.guards.api.provider'))->toBe('users');
});

it('gives the User model passport token support', function (): void {
    // A HasApiTokens nélkül a Passport nem tudja a felhasználót
    // erőforrás-tulajdonosként kezelni a tokencserénél.
    expect(in_array(HasApiTokens::class, class_uses_recursive(User::class), true))->toBeTrue();
});

it('can resolve the passport client repository', function (): void {
    expect(app(ClientRepository::class))->toBeInstanceOf(ClientRepository::class);
});

it('creates the oauth tables', function (): void {
    expect(Schema::hasTable('oauth_clients'))->toBeTrue()
        ->and(Schema::hasTable('oauth_access_tokens'))->toBeTrue()
        ->and(Schema::hasTable('oauth_auth_codes'))->toBeTrue();
});
