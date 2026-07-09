<?php

declare(strict_types=1);

use App\Enums\Country;
use App\Filament\Pages\Auth\Register;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Filament\Auth\Notifications\VerifyEmail as FilamentVerifyEmailNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

use function Pest\Livewire\livewire;

it('resolves the branded verify email notification from the container', function (): void {
    $notification = resolve(FilamentVerifyEmailNotification::class);

    expect($notification)->toBeInstanceOf(VerifyEmailNotification::class);
});

it('sends the branded verification notification on registration', function (): void {
    Http::fake();
    Notification::fake();

    $password = 'MySecurePass123!';

    livewire(Register::class)
        ->fillForm([
            'name' => 'Teszt Elek',
            'email' => 'verify-test@example.com',
            'password' => $password,
            'passwordConfirmation' => $password,
            'company_name' => 'Test Company',
            'tax_number' => '12345678',
            'address' => 'Test Street 1',
            'city' => 'Budapest',
            'postal_code' => '1234',
            'country' => Country::Hungary,
        ])
        ->call('register');

    $user = User::query()->where('email', 'verify-test@example.com')->firstOrFail();

    Notification::assertSentTo($user, VerifyEmailNotification::class);
});

it('builds the branded verify email carrying the signed verification link', function (): void {
    $user = User::factory()->create([
        'name' => 'Teszt Elek',
        'email' => 'link-test@example.com',
    ]);

    $notification = new VerifyEmailNotification();
    $notification->url = 'https://cegem360.eu/admin/email-verification/verify?signature=abc';

    $mail = $notification->toMail($user);

    expect($mail)->toBeInstanceOf(VerifyEmailMail::class)
        ->and($mail->name)->toBe('Teszt Elek')
        ->and($mail->verificationUrl)->toBe('https://cegem360.eu/admin/email-verification/verify?signature=abc');
});

it('renders the branded verify email view with the link and heading', function (): void {
    $rendered = (new VerifyEmailMail('Teszt Elek', 'https://cegem360.eu/admin/email-verification/verify?signature=abc', 60))
        ->render();

    expect($rendered)
        ->toContain('E-mail cím megerősítése')
        ->toContain('Teszt Elek')
        ->toContain('https://cegem360.eu/admin/email-verification/verify?signature=abc')
        ->toContain('60 perc');
});
