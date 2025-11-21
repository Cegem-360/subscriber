<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a user with factory', function () {
    $user = User::factory()->create();

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->id)->not->toBeNull()
        ->and($user->email)->not->toBeNull()
        ->and($user->name)->not->toBeNull();
});

it('creates multiple users with factory', function () {
    $users = User::factory()->count(3)->create();

    expect($users)->toHaveCount(3);
});

it('creates user with custom attributes', function () {
    $user = User::factory()->create([
        'name' => 'Custom Name',
        'email' => 'custom@example.com',
    ]);

    expect($user->name)->toBe('Custom Name')
        ->and($user->email)->toBe('custom@example.com');
});

it('creates unverified user with factory', function () {
    $user = User::factory()->unverified()->create();

    expect($user->email_verified_at)->toBeNull();
});

it('creates admin user with factory', function () {
    $user = User::factory()->admin()->create();

    expect($user->role)->toBe(UserRole::Admin);
});

it('creates manager user with factory', function () {
    $user = User::factory()->manager()->create();

    expect($user->role)->toBe(UserRole::Manager);
});
