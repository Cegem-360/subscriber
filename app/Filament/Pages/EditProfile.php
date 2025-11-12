<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

final class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Information')
                    ->description('Update your account profile information.')
                    ->components([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                    ]),

                Section::make('Update Password')
                    ->description('Ensure your account is using a long, random password to stay secure.')
                    ->components([
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCurrentPasswordFormComponent(),
                    ]),

                Section::make('Billing Information')
                    ->description('Manage your billing information and payment methods.')
                    ->hidden(fn (): bool => ! ($this->getUser()->stripe_id ?? false))
                    ->components([
                        TextInput::make('stripe_id')
                            ->label('Stripe Customer ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->default(fn (): ?string => $this->getUser()->stripe_id),

                        Actions::make([
                            Action::make('manage_billing')
                                ->label('Manage Billing Portal')
                                ->icon(Heroicon::CreditCard)
                                ->color('primary')
                                ->action(fn () => $this->redirect($this->getUser()->billingPortalUrl(route('filament.admin.auth.profile')), navigate: false))
                                ->openUrlInNewTab(false),
                        ])->fullWidth(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        $actions = [];

        // Add action to redirect to Stripe billing portal if user has Stripe customer
        if ($this->getUser()->stripe_id ?? false) {
            $actions[] = Action::make('billing_portal')
                ->label('Billing Portal')
                ->icon(Heroicon::CreditCard)
                ->color('gray')
                ->action(fn () => $this->redirect($this->getUser()->billingPortalUrl(route('filament.admin.auth.profile')), navigate: false))
                ->openUrlInNewTab(false);
        }

        return $actions;
    }
}
