<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum BillingPeriod: string implements HasLabel
{
    case Monthly = 'monthly';
    case Yearly = 'yearly';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Monthly => 'Monthly',
            self::Yearly => 'Yearly',
        };
    }
}
