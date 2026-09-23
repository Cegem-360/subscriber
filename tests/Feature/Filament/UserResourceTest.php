<?php

declare(strict_types=1);

use App\Enums\UserRole;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\User;
use Livewire\Livewire;

test('edit form exposes every user attribute as an editable field', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(EditUser::class, ['record' => $user->id])
        ->assertFormFieldExists('name')
        ->assertFormFieldExists('email')
        ->assertFormFieldExists('phone')
        ->assertFormFieldExists('role')
        ->assertFormFieldExists('password')
        ->assertFormFieldExists('email_verified_at')
        ->assertFormFieldExists('company_name')
        ->assertFormFieldExists('tax_number')
        ->assertFormFieldExists('address')
        ->assertFormFieldExists('city')
        ->assertFormFieldExists('postal_code')
        ->assertFormFieldExists('country')
        ->assertFormFieldExists('stripe_id')
        ->assertFormFieldExists('billingo_partner_id')
        ->assertFormFieldExists('pm_type')
        ->assertFormFieldExists('pm_last_four')
        ->assertFormFieldExists('trial_ends_at')
        ->assertFormFieldExists('created_at')
        ->assertFormFieldExists('updated_at');
});

test('can edit timestamp and billing attributes', function (): void {
    $user = User::factory()->create();

    $createdAt = now()->subYear()->startOfMinute();
    $trialEndsAt = now()->addMonth()->startOfMinute();

    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(EditUser::class, ['record' => $user->id])
        ->fillForm([
            'created_at' => $createdAt,
            'trial_ends_at' => $trialEndsAt,
            'pm_type' => 'visa',
            'pm_last_four' => '4242',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $user->refresh();

    expect($user->created_at->equalTo($createdAt))->toBeTrue()
        ->and($trialEndsAt->equalTo($user->trial_ends_at))->toBeTrue()
        ->and($user->pm_type)->toBe('visa')
        ->and($user->pm_last_four)->toBe('4242');
});

test('can edit the phone number', function (): void {
    $user = User::factory()->create(['phone' => null]);

    Livewire::actingAs(User::factory()->create(['role' => UserRole::Admin]))
        ->test(EditUser::class, ['record' => $user->id])
        ->fillForm(['phone' => '+36 30 123 4567'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($user->refresh()->phone)->toBe('+36 30 123 4567');
});
