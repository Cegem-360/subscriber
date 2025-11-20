<?php

declare(strict_types=1);

use App\Http\Controllers\SubscriptionController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Events\WebhookReceived;

Route::get('/', fn (): Factory|View => view('welcome'))->name('welcome');
Route::get('/module-order', fn (): Factory|View => view('module-order'))->name('module.order');
Route::middleware(['guest'])->group(function (): void {
    Route::get('/login', fn (): Factory|View => view('auth.login'))->name('login');
    Route::get('/register', fn (): Factory|View => view('auth.register'))->name('register');
});
Route::middleware(['auth'])->group(function (): void {
    Route::get('/subscriptions', function (): Factory|View {
        return view('subscriptions', [
            'subscriptions' => Auth::user()->subscriptions,
        ]);
    })->name('subscriptions');
});

Route::middleware(['auth'])->group(function (): void {
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
