<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Responses\EmailVerificationResponse;
use App\Models\Subscription;
use App\Notifications\ResetPasswordNotification;
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
use Filament\Forms\Components\Field;
use Filament\Schemas\Components\Fieldset;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

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
