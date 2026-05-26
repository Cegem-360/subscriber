<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Override;

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

    #[Override]
    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()?->isAdmin() ?? false;
    }

    protected function runCommand(string $command, array $options = []): void
    {
        $this->isRunning = true;
        $this->consoleOutput = '';

        $exitCode = Artisan::call($command, $options);
        $output = Artisan::output();

        $optionString = collect($options)
            ->map(fn ($value, $key): int|string => $value === true ? $key : "{$key}={$value}")
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

    public function syncPrices(): void
    {
        $this->runCommand('stripe:sync-prices');
    }

    public function syncPricesForce(): void
    {
        $this->runCommand('stripe:sync-prices', ['--force' => true]);
    }

    public function syncPricesDryRun(): void
    {
        $this->runCommand('stripe:sync-prices', ['--dry-run' => true]);
    }

    public function syncSubscriptionItems(): void
    {
        $this->runCommand('subscriptions:sync-items');
    }

    public function clearOutput(): void
    {
        $this->consoleOutput = '';
    }
}
