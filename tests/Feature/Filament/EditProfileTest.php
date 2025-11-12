<?php

declare(strict_types=1);

use App\Filament\Pages\EditProfile;
use App\Models\User;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $this->actingAs($this->user);
});

test('can render edit profile page', function () {
    livewire(EditProfile::class)
        ->assertSuccessful();
});

test('can retrieve user data for editing', function () {
    livewire(EditProfile::class)
        ->assertFormSet([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
});

test('profile form contains expected sections', function () {
    livewire(EditProfile::class)
        ->assertSee('Profile Information')
        ->assertSee('Update Password')
        ->assertDontSee('Billing Information');
});

test('hides billing section when user has no stripe customer', function () {
    $user = User::factory()->create(['stripe_id' => null]);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertDontSee('Billing Information');
});

test('shows billing section when user has stripe customer', function () {
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertSee('Billing Information')
        ->assertSee('Stripe Customer ID');
});

test('billing portal action appears for users with stripe customer', function () {
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertActionExists('billing_portal');
});

test('billing portal action does not appear for users without stripe customer', function () {
    $user = User::factory()->create(['stripe_id' => null]);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertActionDoesNotExist('billing_portal');
});

test('can access profile page via route', function () {
    $this->get(route('filament.admin.auth.profile'))
        ->assertSuccessful();
});
