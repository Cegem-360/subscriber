<?php

declare(strict_types=1);

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\StyleGuide;
use App\Livewire\SubscriberModulsList;
use App\Livewire\UpdateModulePage;
use App\Livewire\ViewSubscriptionPage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Events\WebhookReceived;

Route::get('/', fn (): Factory|View => view('home'))->name('home');
Route::get('/welcome', fn (): Factory|View => view('welcome'))->name('welcome');
Route::get('/module-order', fn (): Factory|View => view('module-order'))->name('module.order');
Route::get('/style-guide', StyleGuide::class)->name('style-guide');

// Email verification routes
Route::get('/email/verify', fn () => redirect()->route('filament.admin.auth.email-verification.prompt'))
    ->middleware(['auth'])
    ->name('verification.notice');

// Guest-accessible email verification (no login required)
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
    ->middleware(['guest', 'signed'])
    ->name('verification.verify');

Route::middleware(['guest'])->group(function (): void {
    Route::get('/login', fn () => redirect()->route('filament.admin.auth.login'))->name('login');
    Route::get('/register', fn (): Factory|View => view('auth.register'))->name('register');
});
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/modules', SubscriberModulsList::class)->name('modules');

    Route::get('/subscriptions', fn (): Factory|View => view('subscriptions', [
        'subscriptions' => Auth::user()->subscriptions,
    ]))->name('subscriptions');

    Route::get('/subscription/{subscription}', ViewSubscriptionPage::class)->name('subscription.view');
    Route::get('/subscription/{subscription}/update', UpdateModulePage::class)->name('subscription.update');

    Route::get('/manage-users', fn (): Factory|View => view('manage-users'))->name('manage.users');
});

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::post('/subscription/checkout/{plan}', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/subscription/success/{plan}', [SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

// Debug endpoint - trigger event manually
Route::get('/stripe/webhook/debug', function () {
    Log::info('🔍 Debug: Manually triggering WebhookReceived event');

    $payload = [
        'type' => 'customer.subscription.created',
        'id' => 'evt_test_' . time(),
        'data' => [
            'object' => [
                'id' => 'sub_test_' . time(),
                'customer' => 'cus_test',
                'status' => 'active',
            ],
        ],
    ];

    event(new WebhookReceived($payload));

    return response()->json([
        'message' => 'Event triggered manually',
        'check_logs' => storage_path('logs/laravel.log'),
    ]);
})->name('webhook.debug');
