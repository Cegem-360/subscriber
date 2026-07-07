<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EmailVerificationPrompt;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\PasswordReset\RequestPasswordReset;
use App\Filament\Pages\Auth\PasswordReset\ResetPassword;
use App\Filament\Pages\Auth\Register;
use App\Filament\Pages\EditProfile;
use App\Filament\Pages\Plans;
use App\Http\Middleware\BlockWritesWhenUnverified;
use App\Http\Middleware\RedirectNonAdminFromPanel;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup as FilamentNavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

final class AdminPanelServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->font('Figtree')
            ->spa()
            ->sidebarFullyCollapsibleOnDesktop()
            ->sidebarWidth('15rem')
            ->collapsibleNavigationGroups(false)
            ->navigationGroups([
                FilamentNavigationGroup::make('Beállítások')
                    ->extraSidebarAttributes(['class' => 'fi-nav-group-settings']),
                FilamentNavigationGroup::make('Blog')
                    ->extraSidebarAttributes(['class' => 'fi-nav-group-blog']),
            ])
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset(
                requestAction: RequestPasswordReset::class,
                resetAction: ResetPassword::class,
            )
            ->emailVerification(promptAction: EmailVerificationPrompt::class, isRequired: false)
            ->profile(EditProfile::class)
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->darkMode(true)
            ->renderHook(
                PanelsRenderHook::BODY_START,
                fn (): View => view('components.email-verification-banner'),
            )
            ->renderHook(
                PanelsRenderHook::SCRIPTS_AFTER,
                fn (): View => view('filament.sidebar-transition-script'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Plans::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                RedirectNonAdminFromPanel::class,
                BlockWritesWhenUnverified::class,
            ]);
    }
}
