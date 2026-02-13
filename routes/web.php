<?php

declare(strict_types=1);

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Page\AkademiaPage;
use App\Livewire\Page\BlogCategoryPage;
use App\Livewire\Page\BlogIndexPage;
use App\Livewire\Page\BlogPostPage;
use App\Livewire\Page\Company\AffiliatePage;
use App\Livewire\Page\Company\PartnerprogramPage;
use App\Livewire\Page\Company\RolunkPage;
use App\Livewire\Page\Company\SajtoPage;
use App\Livewire\Page\Company\UgyfelsztoriPage;
use App\Livewire\Page\ContactPage;
use App\Livewire\Page\CustomSolutionsPage;
use App\Livewire\Page\Features\AiPage;
use App\Livewire\Page\Features\AutomatizacioPage;
use App\Livewire\Page\Features\DokumentumokPage;
use App\Livewire\Page\Features\IntegracioPage;
use App\Livewire\Page\Features\IranyitopultokPage;
use App\Livewire\Page\HibabejelentesPage;
use App\Livewire\Page\Legal\AdatvedelmiTajekoztatoPage;
use App\Livewire\Page\Legal\CookieBeallitasokPage;
use App\Livewire\Page\Legal\JogiNyilatkozatPage;
use App\Livewire\Page\Legal\SzolgaltatasiFeltetelekPage;
use App\Livewire\Page\PricingPage;
use App\Livewire\Page\Products\AichatPage;
use App\Livewire\Page\Products\AutomatizalasPage;
use App\Livewire\Page\Products\BeszerzesPage;
use App\Livewire\Page\Products\CrmPage;
use App\Livewire\Page\Products\DatamindPage;
use App\Livewire\Page\Products\ErtekesitesPage;
use App\Livewire\Page\Products\GyartasPage;
use App\Livewire\Page\Products\KontrollingPage;
use App\Livewire\Page\Products\MarketinghubPage;
use App\Livewire\Page\Products\SeoEszkozPage;
use App\Livewire\Page\Products\SzervizPage;
use App\Livewire\Page\QuoteRequestPage;
use App\Livewire\Page\SolutionsEnterprisePage;
use App\Livewire\Page\SolutionsKkvPage;
use App\Livewire\Page\SugoPage;
use App\Livewire\Page\TagPage;
use App\Livewire\Page\TamogatasPage;
use App\Livewire\Page\UjdonsagokPage;
use App\Livewire\Page\UpdateModulePage;
use App\Livewire\Page\UseCases\EpitoiparPage;
use App\Livewire\Page\UseCases\ErtekesitesUseCasePage;
use App\Livewire\Page\UseCases\FejlesztokPage;
use App\Livewire\Page\UseCases\HrPage;
use App\Livewire\Page\UseCases\IparPage;
use App\Livewire\Page\UseCases\ItPage;
use App\Livewire\Page\UseCases\MarketingPage;
use App\Livewire\Page\UseCases\ProjektmenedzsmentPage;
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
Route::get(uri: '/termekek/digitalis-munkalap', action: SzervizPage::class)->name(name: 'products.szerviz');
Route::get(uri: '/termekek/seo-eszkoz', action: SeoEszkozPage::class)->name(name: 'products.seo');
Route::get(uri: '/termekek/marketinghub', action: MarketinghubPage::class)->name(name: 'products.marketinghub');
Route::get(uri: '/termekek/datamind', action: DatamindPage::class)->name(name: 'products.datamind');
Route::get(uri: '/termekek/ai-chat', action: AichatPage::class)->name(name: 'products.aichat');

// Use case pages
Route::get(uri: '/felhasznalasi-teruletek/marketing', action: MarketingPage::class)->name(name: 'usecases.marketing');
Route::get(uri: '/felhasznalasi-teruletek/projektmenedzsment', action: ProjektmenedzsmentPage::class)->name(name: 'usecases.projektmenedzsment');
Route::get(uri: '/felhasznalasi-teruletek/ertekesites', action: ErtekesitesUseCasePage::class)->name(name: 'usecases.ertekesites');
Route::get(uri: '/felhasznalasi-teruletek/fejlesztok', action: FejlesztokPage::class)->name(name: 'usecases.fejlesztok');
Route::get(uri: '/felhasznalasi-teruletek/hr', action: HrPage::class)->name(name: 'usecases.hr');
Route::get(uri: '/felhasznalasi-teruletek/it', action: ItPage::class)->name(name: 'usecases.it');
Route::get(uri: '/felhasznalasi-teruletek/ipar', action: IparPage::class)->name(name: 'usecases.ipar');
Route::get(uri: '/felhasznalasi-teruletek/epitoipar', action: EpitoiparPage::class)->name(name: 'usecases.epitoipar');

// Feature pages
Route::get(uri: '/funkciok/dokumentumok', action: DokumentumokPage::class)->name(name: 'features.dokumentumok');
Route::get(uri: '/funkciok/integraciok', action: IntegracioPage::class)->name(name: 'features.integraciok');
Route::get(uri: '/funkciok/automatizaciok', action: AutomatizacioPage::class)->name(name: 'features.automatizaciok');
Route::get(uri: '/funkciok/ai', action: AiPage::class)->name(name: 'features.ai');
Route::get(uri: '/funkciok/iranyitopultok', action: IranyitopultokPage::class)->name(name: 'features.iranyitopultok');

// Company pages
Route::get(uri: '/rolunk', action: RolunkPage::class)->name(name: 'company.rolunk');
Route::get(uri: '/sajto', action: SajtoPage::class)->name(name: 'company.sajto');
Route::get(uri: '/ugyfelsztorik', action: UgyfelsztoriPage::class)->name(name: 'company.ugyfelsztorik');
Route::get(uri: '/partnerprogram', action: PartnerprogramPage::class)->name(name: 'company.partnerprogram');
Route::get(uri: '/affiliate', action: AffiliatePage::class)->name(name: 'company.affiliate');

// Resource pages
Route::get(uri: '/sugo', action: SugoPage::class)->name(name: 'sugo');
Route::get(uri: '/blog', action: BlogIndexPage::class)->name(name: 'blog.index');
Route::get(uri: '/ujdonsagok', action: UjdonsagokPage::class)->name(name: 'ujdonsagok');
Route::get(uri: '/akademia', action: AkademiaPage::class)->name(name: 'akademia');

// Support pages
Route::get(uri: '/tamogatas', action: TamogatasPage::class)->name(name: 'tamogatas');
Route::get(uri: '/hibabejelentes', action: HibabejelentesPage::class)->name(name: 'hibabejelentes');

// Legal pages
Route::get(uri: '/jogi-nyilatkozat', action: JogiNyilatkozatPage::class)->name(name: 'legal.jogi-nyilatkozat');
Route::get(uri: '/szolgaltatasi-feltetelek', action: SzolgaltatasiFeltetelekPage::class)->name(name: 'legal.szolgaltatasi-feltetelek');
Route::get(uri: '/adatvedelmi-tajekoztato', action: AdatvedelmiTajekoztatoPage::class)->name(name: 'legal.adatvedelmi-tajekoztato');
Route::get(uri: '/cookie-beallitasok', action: CookieBeallitasokPage::class)->name(name: 'legal.cookie-beallitasok');

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
