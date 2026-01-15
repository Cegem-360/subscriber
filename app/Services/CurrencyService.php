<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Number;

class CurrencyService
{
    public const CURRENCY_HUF = 'HUF';

    public const CURRENCY_EUR = 'EUR';

    public function format(float $amount, string $currency): string
    {
        return Number::currency($amount, in: $currency, locale: 'hu', precision: 0);
    }

    public function getCurrentCurrency(): string
    {
        return session('currency', self::CURRENCY_HUF);
    }

    public function setCurrentCurrency(string $currency): void
    {
        $validCurrencies = [self::CURRENCY_HUF, self::CURRENCY_EUR];

        if (in_array($currency, $validCurrencies, true)) {
            session(['currency' => $currency]);
        }
    }
}
