<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: string
{
    case Paid = 'paid';
    case Open = 'open';
    case Draft = 'draft';
    case Void = 'void';
    case Uncollectible = 'uncollectible';

    public function label(): string
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::Open => 'Open',
            self::Draft => 'Draft',
            self::Void => 'Void',
            self::Uncollectible => 'Uncollectible',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Paid => 'success',
            self::Open => 'warning',
            self::Draft => 'gray',
            self::Void, self::Uncollectible => 'danger',
        };
    }
}
