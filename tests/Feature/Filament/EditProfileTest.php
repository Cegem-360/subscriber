<?php

declare(strict_types=1);

use App\Filament\Pages\EditProfile;
use App\Models\User;
use Livewire\Livewire;

test('can render edit profile page', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSuccessful();
});

test('can retrieve user data for editing', function (): void {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSchemaStateSet([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
});

test('hides billing section when user has no stripe customer', function (): void {
    $user = User::factory()->create(['stripe_id' => null]);

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertSee('Profile Information')
        ->assertSee('Update Password')
        ->assertDontSee('Billing Information');
});

test('shows billing section when user has stripe customer', function (): void {
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertSee('Billing Information')
        ->assertSee('Stripe Customer ID');
});

test('billing portal action appears for users with stripe customer', function (): void {
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertActionExists('billing_portal');
});

test('billing portal action does not appear for users without stripe customer', function (): void {
    $user = User::factory()->create(['stripe_id' => null]);

    Livewire::actingAs($user)
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertActionDoesNotExist('billing_portal');
});

test('can access profile page via route', function (): void {
    $this->actingAs(User::factory()->create());

    $this->get(route('filament.admin.auth.profile'))
        ->assertSuccessful();
});
