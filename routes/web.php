<?php

declare(strict_types=1);

use App\Http\Controllers\SubscriptionController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): Factory|View => view('welcome'))->name('welcome');

Route::middleware(['auth'])->group(function (): void {
    Route::post('/subscription/checkout/{plan}', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/subscription/success/{plan}', [SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

// Webhook status check endpoint (csak fejlesztési célra)
Route::get('/stripe/webhook/status', function () {
    return response()->json([
        'status' => 'ready',
        'webhook_url' => url('/stripe/webhook'),
        'message' => 'Stripe webhook endpoint is configured and ready to receive POST requests',
        'recent_logs' => \Illuminate\Support\Facades\File::exists(storage_path('logs/laravel.log'))
            ? array_slice(array_filter(explode("\n", \Illuminate\Support\Facades\File::get(storage_path('logs/laravel.log')))), -10)
            : ['No logs yet'],
    ]);
})->name('webhook.status');

// Test webhook endpoint (csak fejlesztési célra)
Route::post('/stripe/webhook/test', function () {
    \Illuminate\Support\Facades\Log::info('🧪 Test webhook called', [
        'timestamp' => now(),
        'request_data' => request()->all(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Test webhook received successfully',
        'timestamp' => now(),
    ]);
})->middleware('api')->name('webhook.test');

// Debug endpoint - trigger event manually
Route::get('/stripe/webhook/debug', function () {
    \Illuminate\Support\Facades\Log::info('🔍 Debug: Manually triggering WebhookReceived event');

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

    event(new \Laravel\Cashier\Events\WebhookReceived($payload));

    return response()->json([
        'message' => 'Event triggered manually',
        'check_logs' => storage_path('logs/laravel.log'),
    ]);
})->name('webhook.debug');
