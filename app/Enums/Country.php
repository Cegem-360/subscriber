<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Country: string implements HasLabel
{
    case Hungary = 'HU';
    case Austria = 'AT';
    case Germany = 'DE';
    case Slovakia = 'SK';
    case Romania = 'RO';
    case Croatia = 'HR';
    case Slovenia = 'SI';
    case Serbia = 'RS';
    case Ukraine = 'UA';
    case Poland = 'PL';
    case Czechia = 'CZ';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Hungary => __('Hungary'),
            self::Austria => __('Austria'),
            self::Germany => __('Germany'),
            self::Slovakia => __('Slovakia'),
            self::Romania => __('Romania'),
            self::Croatia => __('Croatia'),
            self::Slovenia => __('Slovenia'),
            self::Serbia => __('Serbia'),
            self::Ukraine => __('Ukraine'),
            self::Poland => __('Poland'),
            self::Czechia => __('Czechia'),
        };
    }
}
