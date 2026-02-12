<?php

declare(strict_types=1);

use App\Enums\Country;
use App\Filament\Pages\Auth\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

describe('Registration page', function (): void {
    it('renders the registration page', function (): void {
        $this->get('/admin/register')
            ->assertOk();
    });

    it('shows company information fieldset', function (): void {
        $this->get('/admin/register')
            ->assertOk()
            ->assertSee(__('Company information'));
    });

    it('has the custom register component configured', function (): void {
        $panel = filament()->getPanel('admin');

        expect($panel->getRegistrationRouteAction())->toBe(Register::class);
    });

    it('shows all required form fields', function (): void {
        $this->get('/admin/register')
            ->assertOk()
            ->assertSee(__('Company name'))
            ->assertSee(__('Tax number'))
            ->assertSee(__('Address'))
            ->assertSee(__('City'))
            ->assertSee(__('Postal code'))
            ->assertSee(__('Country'));
    });

    it('shows standard registration fields', function (): void {
        $this->get('/admin/register')
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
});
