<?php

declare(strict_types=1);

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Page\BlogCategoryPage;
use App\Livewire\Page\BlogPostPage;
use App\Livewire\Page\ContactPage;
use App\Livewire\Page\CustomSolutionsPage;
use App\Livewire\Page\PricingPage;
use App\Livewire\Page\Products\AutomatizalasPage;
use App\Livewire\Page\Products\BeszerzesPage;
use App\Livewire\Page\Products\CrmPage;
use App\Livewire\Page\Products\ErtekesitesPage;
use App\Livewire\Page\Products\GyartasPage;
use App\Livewire\Page\Products\KontrollingPage;
use App\Livewire\Page\Products\SzervizPage;
use App\Livewire\Page\QuoteRequestPage;
use App\Livewire\Page\SolutionsEnterprisePage;
use App\Livewire\Page\SolutionsKkvPage;
use App\Livewire\Page\TagPage;
use App\Livewire\Page\UpdateModulePage;
use App\Livewire\Page\ViewSubscriptionPage;
use App\Livewire\StyleGuide;
use App\Livewire\SubscriberModulsList;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Events\WebhookReceived;

Route::get(uri: '/', action: fn (): Factory|View => view(view: 'home'))->name(name: 'home');
Route::get(uri: '/welcome', action: fn (): Factory|View => view(view: 'welcome'))->name(name: 'welcome');
Route::view(uri: '/altalanos-szerzodesi-feltetelek', view: 'privacy-policy')->name(name: 'privacy-policy');
// Language switch route
Route::get('/language/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'hu'], true)) {
        abort(400);
    }

    $cookie = cookie('locale', $locale, 60 * 24 * 365);

    $referer = request()->headers->get('referer');
    $redirectUrl = $referer ?: url()->previous();

    return redirect($redirectUrl)->withCookie($cookie);
})->name('language.switch');
Route::get(uri: '/style-guide', action: StyleGuide::class)->name(name: 'style-guide');
Route::get(uri: '/arak', action: PricingPage::class)->name(name: 'pricing');
Route::get(uri: '/ajanlatkeres', action: QuoteRequestPage::class)->name(name: 'quote-request');

// Blog routes
Route::get(uri: '/eroforrasok/{blogCategory:slug}', action: BlogCategoryPage::class)->name(name: 'blog.category');
Route::get(uri: '/eroforrasok/{blogCategory:slug}/{blog:slug}', action: BlogPostPage::class)->name(name: 'blog.show');
Route::get(uri: '/tag/{tag:slug}', action: TagPage::class)->name(name: 'blog.tag');

// Solutions pages
Route::get(uri: '/megoldasok/kkv', action: SolutionsKkvPage::class)->name(name: 'solutions.kkv');
Route::get(uri: '/megoldasok/nagyvallalat', action: SolutionsEnterprisePage::class)->name(name: 'solutions.enterprise');
Route::get(uri: '/egyedi-megoldasok', action: CustomSolutionsPage::class)->name(name: 'solutions.custom');
Route::get(uri: '/kapcsolat', action: ContactPage::class)->name(name: 'contact');

// Product/Module pages
Route::get(uri: '/termekek/crm', action: CrmPage::class)->name(name: 'products.crm');
Route::get(uri: '/termekek/kontrolling', action: KontrollingPage::class)->name(name: 'products.kontrolling');
Route::get(uri: '/termekek/beszerzes-logisztika', action: BeszerzesPage::class)->name(name: 'products.beszerzes');
Route::get(uri: '/termekek/ertekesites', action: ErtekesitesPage::class)->name(name: 'products.ertekesites');
Route::get(uri: '/termekek/gyartasiranyitas', action: GyartasPage::class)->name(name: 'products.gyartas');
Route::get(uri: '/termekek/automatizalas', action: AutomatizalasPage::class)->name(name: 'products.automatizalas');
Route::get(uri: '/termekek/szerviz-munkalap', action: SzervizPage::class)->name(name: 'products.szerviz');

// Email verification routes
Route::get(uri: '/email/verify', action: fn (): Redirector|RedirectResponse => to_route(route: 'filament.admin.auth.email-verification.prompt'))
    ->middleware(middleware: ['auth'])
    ->name(name: 'verification.notice');

// Guest-accessible email verification (no login required)
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
    ->middleware(['guest', 'signed'])
    ->name('verification.verify');

Route::middleware(['guest'])->group(function (): void {
    Route::get(uri: '/login', action: fn (): Redirector|RedirectResponse => to_route(route: 'filament.admin.auth.login'))->name(name: 'login');
    Route::get(uri: '/register', action: fn (): Redirector|RedirectResponse => to_route(route: 'filament.admin.auth.register'))->name(name: 'register');
});
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get(uri: '/modules', action: SubscriberModulsList::class)->name(name: 'modules');
    Route::get(uri: '/module-order', action: fn (): Factory|View => view(view: 'module-order'))->name(name: 'module.order');

    Route::get(uri: '/subscriptions', action: fn (): Factory|View => view('subscriptions', [
        'subscriptions' => Auth::user()->subscriptions,
    ]))->name('subscriptions');

    Route::get(uri: '/manage-users', action: fn (): Factory|View => view('manage-users'))->name(name: 'manage.users');

    // Subscription routes - specific routes before wildcard routes
    Route::post(uri: '/subscription/checkout/{plan}', action: [SubscriptionController::class, 'checkout'])->name(name: 'subscription.checkout');
    Route::get(uri: '/subscription/success/{plan}', action: [SubscriptionController::class, 'success'])->name(name: 'subscription.success');
    Route::get(uri: '/subscription/cancel', action: [SubscriptionController::class, 'cancel'])->name(name: 'subscription.cancel');

    // Wildcard subscription routes - must come after specific routes
    Route::get(uri: '/subscription/{subscription}', action: ViewSubscriptionPage::class)->name(name: 'subscription.view');
    Route::get(uri: '/subscription/{subscription}/update', action: UpdateModulePage::class)->name(name: 'subscription.update');
});

// Debug endpoint - trigger event manually
Route::get(uri: '/stripe/webhook/debug', action: function () {
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
})->name(name: 'webhook.debug');
