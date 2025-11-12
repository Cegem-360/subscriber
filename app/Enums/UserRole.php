<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum UserRole: string implements HasColor, HasLabel
{
    case Admin = 'admin';
    case Subscriber = 'subscriber';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::Subscriber => __('Subscriber'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Admin => 'danger',
            self::Subscriber => 'success',
        };
    }
}
