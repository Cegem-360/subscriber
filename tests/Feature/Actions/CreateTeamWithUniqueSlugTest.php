<?php

declare(strict_types=1);

use App\Actions\CreateTeamWithUniqueSlug;
use App\Models\Team;

it('slugifies the name when no team exists yet', function (): void {
    $team = app(CreateTeamWithUniqueSlug::class)->handle('Acme Kft.');

    expect($team->slug)->toBe('acme-kft')
        ->and($team->name)->toBe('Acme Kft.');
});

it('gives a second team with the same name a suffixed slug', function (): void {
    $first = app(CreateTeamWithUniqueSlug::class)->handle('Acme Kft.');
    $second = app(CreateTeamWithUniqueSlug::class)->handle('Acme Kft.');

    expect($first->slug)->toBe('acme-kft')
        ->and($second->slug)->toBe('acme-kft-2')
        ->and($second->id)->not->toBe($first->id);
});

it('keeps counting up past an existing suffixed slug', function (): void {
    Team::query()->create(['name' => 'Acme Kft.', 'slug' => 'acme-kft']);
    Team::query()->create(['name' => 'Acme Kft.', 'slug' => 'acme-kft-2']);

    $team = app(CreateTeamWithUniqueSlug::class)->handle('Acme Kft.');

    expect($team->slug)->toBe('acme-kft-3');
});

it('falls back to a generic base when the name slugifies to nothing', function (): void {
    $team = app(CreateTeamWithUniqueSlug::class)->handle('!!!');

    expect($team->slug)->toBe('team');
});
