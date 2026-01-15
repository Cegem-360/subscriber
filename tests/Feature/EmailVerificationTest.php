<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

it('allows guest to verify email with valid signed link', function (): void {
    Event::fake([Verified::class]);

    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1((string) $user->email)],
    );

    $response = $this->get($verificationUrl);

    $response->assertRedirect(route('filament.admin.auth.login'));
    $response->assertSessionHas('notification.status', 'success');
    $response->assertSessionHas('notification.title', __('Email verified successfully'));

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();

    Event::assertDispatched(Verified::class, fn($event): bool => $event->user->id === $user->id);
});

it('shows info notification when email is already verified', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1((string) $user->email)],
    );

    $response = $this->get($verificationUrl);

    $response->assertRedirect(route('filament.admin.auth.login'));
    $response->assertSessionHas('notification.status', 'info');
    $response->assertSessionHas('notification.title', __('Email already verified'));
});

it('rejects invalid verification hash', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => 'invalid-hash'],
    );

    $response = $this->get($verificationUrl);

    $response->assertForbidden();
    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

it('rejects unsigned verification link', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $response = $this->get("/email/verify/{$user->id}/" . sha1((string) $user->email));

    $response->assertForbidden();
    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

it('does not require authentication to verify email', function (): void {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    // Ensure we are not authenticated
    $this->assertGuest();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1((string) $user->email)],
    );

    $response = $this->get($verificationUrl);

    // Should succeed without being logged in
    $response->assertRedirect(route('filament.admin.auth.login'));
    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});
