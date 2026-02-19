<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class Plans extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $slug = 'subscription-plans';

    protected string $view = 'filament.pages.plans';

    protected static ?string $navigationLabel = 'Stripe szinkron';

    protected static ?string $title = 'Stripe szinkron';

    protected static ?int $navigationSort = 10;

    public string $consoleOutput = '';

    public bool $isRunning = false;

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('sync_stripe')
                    ->label('Szinkronizálás')
                    ->icon(Heroicon::ArrowPath)
                    ->action(fn () => $this->runCommand('stripe:sync-prices'))
                    ->requiresConfirmation()
                    ->modalHeading('Stripe szinkronizálás')
                    ->modalDescription('Szinkronizálja a helyi terveket a Stripe-pal.')
                    ->modalSubmitActionLabel('Indítás'),

                Action::make('sync_stripe_force')
                    ->label('Szinkronizálás (force)')
                    ->icon(Heroicon::ArrowPath)
                    ->color('warning')
                    ->action(fn () => $this->runCommand('stripe:sync-prices', ['--force' => true]))
                    ->requiresConfirmation()
                    ->modalHeading('Stripe szinkronizálás (force)')
                    ->modalDescription('Újra létrehozza az összes Stripe terméket és árat.')
                    ->modalSubmitActionLabel('Indítás'),

                Action::make('sync_stripe_dry_run')
                    ->label('Teszt futtatás (dry-run)')
                    ->icon(Heroicon::Eye)
                    ->action(fn () => $this->runCommand('stripe:sync-prices', ['--dry-run' => true])),
            ])
                ->label('stripe:sync-prices')
                ->icon(Heroicon::ArrowPath)
                ->color('primary'),

            Action::make('sync_subscription_items')
                ->label('subscriptions:sync-items')
                ->icon(Heroicon::ArrowPath)
                ->color('info')
                ->action(fn () => $this->runCommand('subscriptions:sync-items'))
                ->requiresConfirmation()
                ->modalHeading('Subscription items szinkronizálás')
                ->modalDescription('Szinkronizálja az előfizetési tételeket a Stripe-ból a helyi adatbázisba.')
                ->modalSubmitActionLabel('Indítás'),
        ];
    }

    public function runCommand(string $command, array $options = []): void
    {
        $this->isRunning = true;
        $this->consoleOutput = '';

        $exitCode = Artisan::call($command, $options);
        $output = Artisan::output();

        $optionString = collect($options)
            ->map(fn ($value, $key) => $value === true ? $key : "{$key}={$value}")
            ->implode(' ');

        $timestamp = now()->format('Y-m-d H:i:s');
        $this->consoleOutput = "$ php artisan {$command}"
            . ($optionString ? " {$optionString}" : '')
            . "\n[{$timestamp}]\n\n"
            . $output
            . "\n"
            . ($exitCode === 0
                ? 'Process exited with code 0 (success)'
                : "Process exited with code {$exitCode} (error)");

        $this->isRunning = false;
    }

    public function clearOutput(): void
    {
        $this->consoleOutput = '';
    }
}
