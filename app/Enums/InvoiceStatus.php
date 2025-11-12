<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum InvoiceStatus: string implements HasColor, HasLabel
{
    case Paid = 'paid';
    case Open = 'open';
    case Draft = 'draft';
    case Void = 'void';
    case Uncollectible = 'uncollectible';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::Open => 'Open',
            self::Draft => 'Draft',
            self::Void => 'Void',
            self::Uncollectible => 'Uncollectible',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Paid => 'success',
            self::Open => 'warning',
            self::Draft => 'gray',
            self::Void, self::Uncollectible => 'danger',
        };
    }
}
