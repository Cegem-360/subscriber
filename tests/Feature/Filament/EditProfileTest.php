<?php

declare(strict_types=1);

use App\Filament\Pages\EditProfile;
use App\Models\User;

use function Pest\Livewire\livewire;

test('can render edit profile page', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful();
});

test('can retrieve user data for editing', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertFormSet([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
});

test('hides billing section when user has no stripe customer', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create(['stripe_id' => null]);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertSee('Profile Information')
        ->assertSee('Update Password')
        ->assertDontSee('Billing Information');
});

test('shows billing section when user has stripe customer', function () {
    /** @var \Tests\TestCase $this */
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertSee('Billing Information')
        ->assertSee('Stripe Customer ID');
});

test('billing portal action appears for users with stripe customer', function () {
    /** @var \Tests\TestCase $this */
    config(['cashier.key' => 'sk_test_fake_key']);

    $user = User::factory()->create(['stripe_id' => 'cus_test123']);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertActionExists('billing_portal');
});

test('billing portal action does not appear for users without stripe customer', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create(['stripe_id' => null]);

    $this->actingAs($user);

    livewire(EditProfile::class)
        ->assertSuccessful()
        ->assertActionDoesNotExist('billing_portal');
});

test('can access profile page via route', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->get(route('filament.admin.auth.profile'))
        ->assertSuccessful();
});
