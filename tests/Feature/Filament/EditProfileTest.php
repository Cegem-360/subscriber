<?php

declare(strict_types=1);

use App\Filament\Pages\EditProfile;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('can render edit profile page', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(EditProfile::class)
        ->assertSuccessful();
});

test('can retrieve user data for editing', function (): void {
    Livewire::actingAs(User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]))
        ->test(EditProfile::class)
        ->assertSchemaStateSet([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
});

test('hides billing section when user has no stripe customer', function (): void {
    Livewire::actingAs(User::factory()->create(['stripe_id' => null]))
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertSee(__('Profile Information'))
        ->assertSee(__('Update Password'))
        ->assertDontSee(__('Billing Information'));
});

test('shows billing section when user has stripe customer', function (): void {
    config(['cashier.key' => 'sk_test_fake_key']);

    Livewire::actingAs(User::factory()->create(['stripe_id' => 'cus_test123']))
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertSee(__('Billing Information'))
        ->assertSee(__('Stripe Customer ID'));
});

test('billing portal action appears for users with stripe customer', function (): void {
    config(['cashier.key' => 'sk_test_fake_key']);

    Livewire::actingAs(User::factory()->create(['stripe_id' => 'cus_test123']))
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertActionExists('billing_portal');
});

test('billing portal action does not appear for users without stripe customer', function (): void {
    Livewire::actingAs(User::factory()->create(['stripe_id' => null]))
        ->test(EditProfile::class)
        ->assertSuccessful()
        ->assertActionDoesNotExist('billing_portal');
});

test('can access profile page via route', function (): void {
    actingAs(User::factory()->create());

    get(route('filament.admin.auth.profile'))
        ->assertSuccessful();
});
