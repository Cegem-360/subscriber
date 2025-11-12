<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum SubscriptionStatus: string implements HasColor, HasLabel
{
    case Active = 'active';
    case Canceled = 'canceled';
    case Incomplete = 'incomplete';
    case IncompleteExpired = 'incomplete_expired';
    case PastDue = 'past_due';
    case Trialing = 'trialing';
    case Unpaid = 'unpaid';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Active => 'Active',
            self::Canceled => 'Canceled',
            self::Incomplete => 'Incomplete',
            self::IncompleteExpired => 'Incomplete Expired',
            self::PastDue => 'Past Due',
            self::Trialing => 'Trialing',
            self::Unpaid => 'Unpaid',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Active => 'success',
            self::Trialing => 'info',
            self::PastDue => 'warning',
            self::Canceled, self::Incomplete, self::IncompleteExpired, self::Unpaid => 'danger',
        };
    }
}
