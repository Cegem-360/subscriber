<?php

declare(strict_types=1);

use App\Services\CurrencyService;

describe('CurrencyService', function (): void {
    it('formats numbers with Hungarian format and currency symbol', function (): void {
        $service = new CurrencyService();

        // Number::currency uses non-breaking spaces (\u{00A0})
        expect($service->format(350000, CurrencyService::CURRENCY_HUF))->toBe("350\u{00A0}000\u{00A0}Ft");
        expect($service->format(875, CurrencyService::CURRENCY_EUR))->toBe("875\u{00A0}EUR");
    });

    it('stores and retrieves currency preference from session', function (): void {
        $service = new CurrencyService();

        expect($service->getCurrentCurrency())->toBe(CurrencyService::CURRENCY_HUF);

        $service->setCurrentCurrency(CurrencyService::CURRENCY_EUR);

        expect($service->getCurrentCurrency())->toBe(CurrencyService::CURRENCY_EUR);
    });

    it('ignores invalid currency values', function (): void {
        $service = new CurrencyService();

        $service->setCurrentCurrency('INVALID');

        expect($service->getCurrentCurrency())->toBe(CurrencyService::CURRENCY_HUF);
    });
});
