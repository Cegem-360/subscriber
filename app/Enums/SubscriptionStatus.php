<?php

declare(strict_types=1);

namespace App\Enums;

enum SubscriptionStatus: string
{
    case Active = 'active';
    case Canceled = 'canceled';
    case Incomplete = 'incomplete';
    case IncompleteExpired = 'incomplete_expired';
    case PastDue = 'past_due';
    case Trialing = 'trialing';
    case Unpaid = 'unpaid';

    public function label(): string
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

    public function color(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Trialing => 'info',
            self::PastDue => 'warning',
            self::Canceled, self::Incomplete, self::IncompleteExpired, self::Unpaid => 'danger',
        };
    }
}
