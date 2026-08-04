<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\EmailVerificationResponse;
use App\Models\OauthClient;
use App\Models\Subscription;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Filament\Actions\AssociateAction;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Auth\Http\Responses\Contracts\EmailVerificationResponse as EmailVerificationResponseContract;
use Filament\Auth\Notifications\ResetPassword as FilamentResetPassword;
use Filament\Auth\Notifications\VerifyEmail as FilamentVerifyEmail;
use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Fieldset;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Columns\Column;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Passport\Passport;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailVerificationResponseContract::class, EmailVerificationResponse::class);

        // Send the branded reset-password email. Filament resolves the reset
        // notification from the container and injects the reset URL into it.
        $this->app->bind(FilamentResetPassword::class, ResetPasswordNotification::class);

        // Send the branded e-mail verification message. Filament resolves the
        // verification notification from the container and injects the signed URL.
        $this->app->bind(FilamentVerifyEmail::class, VerifyEmailNotification::class);

        // The module apps are all server-side and use the authorization_code
        // grant, so the device flow is dead surface: it publishes an unbranded
        // vendor page and three more routes on the identity domain that nothing
        // can legitimately use. Passport registers those routes in its own
        // boot(), and package providers boot before this one — so this has to
        // happen during register(), where it still takes effect.
        Passport::$deviceCodeGrantEnabled = false;

        // Our client model decides per-client whether to skip the consent
        // screen (first-party clients registered in sync_apps do), and
        // AuthorizationController::authorize() type-hints
        // Contracts\AuthorizationViewResponse as a constructor-less method
        // parameter, so the container resolves it on every hit to
        // oauth/authorize — even for requests that end up skipping the
        // view entirely. Passport 13 ships no views or binding for it out
        // of the box, so without authorizationView() that resolution
        // throws BindingResolutionException and the route 500s. Same
        // register()-vs-boot() timing constraint as above: Passport's own
        // provider boots before this one, so both calls have to happen here.
        Passport::useClientModel(OauthClient::class);

        Passport::authorizationView(
            fn (array $parameters): Response => response()->view('auth.oauth-authorize', $parameters),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useSubscriptionModel(Subscription::class);

        // Set Filament colors globally (for standalone components outside panel)
        FilamentColor::register([
            'primary' => Color::Indigo,
        ]);

        Fieldset::configureUsing(fn (Fieldset $fieldset) => $fieldset->translateLabel());
        Field::configureUsing(fn (Field $field) => $field->translateLabel());
        Column::configureUsing(fn (Column $column) => $column->translateLabel());
        $this->hideWriteActionsForUnverifiedUsers();
    }

    /**
     * Hide every mutating Filament action while the current user's email is
     * unverified. Filament re-checks visibility server-side when an action is
     * invoked, so this is a real guard, not only a visual one. Read actions
     * (view, list) are left untouched.
     */
    private function hideWriteActionsForUnverifiedUsers(): void
    {
        $mutatingActions = [
            CreateAction::class,
            EditAction::class,
            DeleteAction::class,
            DeleteBulkAction::class,
            ReplicateAction::class,
            RestoreAction::class,
            RestoreBulkAction::class,
            ForceDeleteAction::class,
            ForceDeleteBulkAction::class,
            AttachAction::class,
            AssociateAction::class,
            DetachAction::class,
            DetachBulkAction::class,
            DissociateAction::class,
        ];

        foreach ($mutatingActions as $action) {
            $action::configureUsing(
                fn ($configuredAction) => $configuredAction->visible(
                    fn (): bool => Auth::user()?->hasVerifiedEmail() ?? true,
                ),
            );
        }
    }
}
