<?php

declare(strict_types=1);

use App\Enums\Country;
use App\Enums\UserRole;
use App\Filament\Pages\Auth\Register;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

describe('Registration page', function (): void {
    it('renders the registration page', function (): void {
        get('/admin/register')
            ->assertOk();
    });

    it('shows company information fieldset', function (): void {
        get('/admin/register')
            ->assertOk()
            ->assertSee(__('Company information'));
    });

    it('has the custom register component configured', function (): void {
        $panel = filament()->getPanel('admin');

        expect($panel->getRegistrationRouteAction())->toBe(Register::class);
    });

    it('shows all required form fields', function (): void {
        get('/admin/register')
            ->assertOk()
            ->assertSee(__('Company name'))
            ->assertSee(__('Tax number'))
            ->assertSee(__('Address'))
            ->assertSee(__('City'))
            ->assertSee(__('Postal code'))
            ->assertSee(__('Country'));
    });

    it('shows standard registration fields', function (): void {
        get('/admin/register')
            ->assertOk()
            ->assertSee(__('filament-panels::pages/auth/register.form.name.label'))
            ->assertSee(__('filament-panels::pages/auth/register.form.email.label'))
            ->assertSee(__('filament-panels::pages/auth/register.form.password.label'));
    });
});

describe('Registration form component', function (): void {
    it('can render the register component', function (): void {
        livewire(Register::class)
            ->assertSuccessful();
    });

    it('has country field with Hungary as default', function (): void {
        livewire(Register::class)
            ->assertFormFieldExists('country')
            ->assertFormSet(['country' => Country::Hungary]);
    });

    it('has all required company fields', function (): void {
        livewire(Register::class)
            ->assertFormFieldExists('company_name')
            ->assertFormFieldExists('tax_number')
            ->assertFormFieldExists('address')
            ->assertFormFieldExists('city')
            ->assertFormFieldExists('postal_code')
            ->assertFormFieldExists('country');
    });

    it('has standard registration fields', function (): void {
        livewire(Register::class)
            ->assertFormFieldExists('name')
            ->assertFormFieldExists('email')
            ->assertFormFieldExists('password')
            ->assertFormFieldExists('passwordConfirmation');
    });

    it('uses Country enum for country field options', function (): void {
        // Verify the Country enum has all expected countries
        expect(Country::cases())
            ->toHaveCount(11)
            ->and(Country::Hungary->value)->toBe('HU')
            ->and(Country::Austria->value)->toBe('AT')
            ->and(Country::Germany->value)->toBe('DE');
    });
});

describe('Registration and login flow', function (): void {
    it('can log in with the password used during registration', function (): void {
        Http::fake();

        $password = 'MySecurePass123!';

        livewire(Register::class)
            ->fillForm([
                'name' => 'Test User',
                'email' => 'registration-test@example.com',
                'password' => $password,
                'passwordConfirmation' => $password,
                'company_name' => 'Test Company',
                'tax_number' => '12345678',
                'address' => 'Test Street 1',
                'city' => 'Budapest',
                'postal_code' => '1234',
                'country' => Country::Hungary,
            ])
            ->call('register')
            ->assertRedirect();

        $user = User::query()->where('email', 'registration-test@example.com')->first();

        expect($user)->not->toBeNull();
        expect(Hash::check($password, $user->password))->toBeTrue('Password hash in DB should match the registration password');
        expect(Auth::attempt(['email' => $user->email, 'password' => $password]))->toBeTrue('Auth::attempt should succeed with the registration password');
    });

    it('creates a local team with a slug derived from the company name', function (): void {
        Http::fake();

        $password = 'MySecurePass123!';

        livewire(Register::class)
            ->fillForm([
                'name' => 'Slug Owner',
                'email' => 'slug-team-test@example.com',
                'password' => $password,
                'passwordConfirmation' => $password,
                'company_name' => 'Slug Team Kft.',
                'tax_number' => '12345678',
                'address' => 'Slug Street 1',
                'city' => 'Budapest',
                'postal_code' => '1234',
                'country' => Country::Hungary,
            ])
            ->call('register')
            ->assertHasNoFormErrors();

        $user = User::query()->where('email', 'slug-team-test@example.com')->firstOrFail();
        $team = $user->teams()->firstOrFail();

        expect($team->slug)->toBe('slug-team-kft')
            ->and($team->name)->toBe('Slug Team Kft.');
    });

    it('rejects registration when the company name maps to an existing team slug', function (): void {
        Http::fake();

        Team::query()->create(['name' => 'Foglalt Kft.', 'slug' => 'foglalt-kft']);

        $password = 'MySecurePass123!';

        livewire(Register::class)
            ->fillForm([
                'name' => 'Second Owner',
                'email' => 'second-owner@example.com',
                // Different casing/punctuation, same generated slug "foglalt-kft".
                'company_name' => 'Foglalt KFT',
                'tax_number' => '87654321',
                'address' => 'Second Street 2',
                'city' => 'Budapest',
                'postal_code' => '4321',
                'country' => Country::Hungary,
                'password' => $password,
                'passwordConfirmation' => $password,
            ])
            ->call('register')
            ->assertHasFormErrors(['company_name']);

        expect(User::query()->where('email', 'second-owner@example.com')->exists())->toBeFalse();
    });

    it('registers the main account with the Manager role so it can manage its users', function (): void {
        Http::fake();

        $password = 'MySecurePass123!';

        livewire(Register::class)
            ->fillForm([
                'name' => 'Owner User',
                'email' => 'owner-role-test@example.com',
                'password' => $password,
                'passwordConfirmation' => $password,
                'company_name' => 'Owner Company',
                'tax_number' => '12345678',
                'address' => 'Owner Street 1',
                'city' => 'Budapest',
                'postal_code' => '1234',
                'country' => Country::Hungary,
            ])
            ->call('register')
            ->assertRedirect();

        $user = User::query()->where('email', 'owner-role-test@example.com')->firstOrFail();

        expect($user->role)->toBe(UserRole::Manager);
    });
});
