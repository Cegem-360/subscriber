<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable([
    'key',
    'value',
])]
final class Setting extends Model
{
    private const int CACHE_TTL = 3600;

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", self::CACHE_TTL, function () use ($key, $default) {
            $setting = self::query()->where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, mixed $value): void
    {
        self::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );

        Cache::forget("setting.{$key}");
    }
}
