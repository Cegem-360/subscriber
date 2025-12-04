<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Enums\Country;
use App\Jobs\SyncUserToSecondaryApp;
use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Log;

final class EditProfile extends BaseEditProfile
{
    protected static string $layout = 'components.layouts.app';

    public string $view = 'filament.pages.edit-profile';

    public function getHeading(): string
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

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

                Section::make(__('Company Information'))
                    ->description(__('Your company or billing details.'))
                    ->components([
                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('tax_number')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('address')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('postal_code')
                            ->required()
                            ->maxLength(20),

                        Select::make('country')
                            ->options(Country::class)
                            ->required(),
                    ])
                    ->columns(2),

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
            ])
            ->statePath('data');
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

    public function save(): void
    {
        $data = $this->form->getState();

        // Capture raw password before it gets hashed
        $rawPassword = $data['password'] ?? null;

        // Call parent save (this will hash the password via the model cast)
        parent::save();

        // If password was changed, sync raw password to secondary apps
        if (filled($rawPassword)) {
            Log::info('EditProfile: Password changed, syncing to secondary apps', [
                'email' => $this->getUser()->email,
                'password_length' => strlen((string) $rawPassword),
                'password_preview' => substr((string) $rawPassword, 0, 3) . '***',
            ]);

            dispatch(new SyncUserToSecondaryApp(
                email: $this->getUser()->email,
                changedData: ['password' => $rawPassword],
            ));
        }
    }
}
