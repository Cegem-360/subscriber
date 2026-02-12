<?php

declare(strict_types=1);

use App\Filament\Pages\Auth\PasswordReset\RequestPasswordReset;
use App\Filament\Pages\Auth\PasswordReset\ResetPassword;
use App\Models\User;
use Filament\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;

use function Pest\Livewire\livewire;

describe('Password reset request page', function (): void {
    it('renders the request password reset page', function (): void {
        $this->get('/admin/password-reset/request')
            ->assertOk();
    });

    it('shows the forgot password heading', function (): void {
        $this->get('/admin/password-reset/request')
            ->assertOk()
            ->assertSee('Elfelejtett jelszó');
    });

    it('has the custom request password reset component configured', function (): void {
        $panel = filament()->getPanel('admin');

        expect($panel->hasPasswordReset())->toBeTrue();
    });

    it('shows a link back to login', function (): void {
        $this->get('/admin/password-reset/request')
            ->assertOk()
            ->assertSee('Bejelentkezés');
    });
});

describe('Password reset request form', function (): void {
    it('can render the request password reset component', function (): void {
        livewire(RequestPasswordReset::class)
            ->assertSuccessful();
    });

    it('has the email form field', function (): void {
        livewire(RequestPasswordReset::class)
            ->assertFormFieldExists('email');
    });

    it('sends a password reset link to a valid user', function (): void {
        Notification::fake();

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        livewire(RequestPasswordReset::class)
            ->fillForm(['email' => $user->email])
            ->call('request')
            ->assertNotified();

        Notification::assertSentTo($user, ResetPasswordNotification::class);
    });

    it('does not send a reset link for an invalid email', function (): void {
        Notification::fake();

        livewire(RequestPasswordReset::class)
            ->fillForm(['email' => 'nonexistent@example.com'])
            ->call('request')
            ->assertNotified();

        Notification::assertNothingSent();
    });

    it('requires email field', function (): void {
        livewire(RequestPasswordReset::class)
            ->fillForm(['email' => ''])
            ->call('request')
            ->assertHasFormErrors(['email' => 'required']);
    });

    it('validates email format', function (): void {
        livewire(RequestPasswordReset::class)
            ->fillForm(['email' => 'not-an-email'])
            ->call('request')
            ->assertHasFormErrors(['email' => 'email']);
    });
});

describe('Password reset page', function (): void {
    it('renders the reset password page', function (): void {
        $url = URL::signedRoute('filament.admin.auth.password-reset.reset', [
            'token' => 'test-token',
            'email' => 'test@example.com',
        ]);

        $this->get($url)->assertOk();
    });

    it('shows the reset password heading', function (): void {
        $url = URL::signedRoute('filament.admin.auth.password-reset.reset', [
            'token' => 'test-token',
            'email' => 'test@example.com',
        ]);

        $this->get($url)
            ->assertOk()
            ->assertSee('Jelszó visszaállítása');
    });

    it('rejects unsigned requests', function (): void {
        $this->get('/admin/password-reset/reset?token=test-token&email=test@example.com')
            ->assertForbidden();
    });
});

describe('Password reset form', function (): void {
    it('can render the reset password component', function (): void {
        livewire(ResetPassword::class, ['token' => 'test-token', 'email' => 'test@example.com'])
            ->assertSuccessful();
    });

    it('has all required form fields', function (): void {
        livewire(ResetPassword::class, ['token' => 'test-token', 'email' => 'test@example.com'])
            ->assertFormFieldExists('email')
            ->assertFormFieldExists('password')
            ->assertFormFieldExists('passwordConfirmation');
    });

    it('resets the password with a valid token', function (): void {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        livewire(ResetPassword::class, ['token' => $token, 'email' => $user->email])
            ->fillForm([
                'password' => 'new-password-123',
                'passwordConfirmation' => 'new-password-123',
            ])
            ->call('resetPassword')
            ->assertNotified();
    });

    it('syncs the new password to receiver apps after reset', function (): void {
        Http::fake();

        config()->set('user-team-sync.publisher.app_source', 'config');
        config()->set('user-team-sync.publisher.apps', [
            'test-app' => ['url' => 'https://test-app.test', 'api_key' => 'test-key', 'active' => true],
        ]);

        $user = User::factory()->create();
        $token = Password::createToken($user);

        livewire(ResetPassword::class, ['token' => $token, 'email' => $user->email])
            ->fillForm([
                'password' => 'new-password-123',
                'passwordConfirmation' => 'new-password-123',
            ])
            ->call('resetPassword')
            ->assertNotified();

        Http::assertSent(fn ($request): bool => str_contains($request->url(), '/api/sync-password')
            && $request['email'] === $user->email,
        );
    });

    it('fails with an invalid token', function (): void {
        $user = User::factory()->create();

        livewire(ResetPassword::class, ['token' => 'invalid-token', 'email' => $user->email])
            ->fillForm([
                'password' => 'new-password-123',
                'passwordConfirmation' => 'new-password-123',
            ])
            ->call('resetPassword')
            ->assertNotified();
    });

    it('requires matching password confirmation', function (): void {
        livewire(ResetPassword::class, ['token' => 'test-token', 'email' => 'test@example.com'])
            ->fillForm([
                'password' => 'new-password-123',
                'passwordConfirmation' => 'different-password',
            ])
            ->call('resetPassword')
            ->assertHasFormErrors(['password' => 'same']);
    });
});

describe('Login page password reset link', function (): void {
    it('shows the forgot password link on login page', function (): void {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Elfelejtetted a jelszavad?');
    });
});
