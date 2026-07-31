<?php

declare(strict_types=1);

use App\Actions\CreateTeamWithUniqueSlug;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

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

it('recovers when a concurrent insert steals the slug between the check and the create', function (): void {
    // Simulate a genuine race: another request's team insert lands *after*
    // our exists() check for 'acme-kft' passed but *before* our own
    // create() reaches the database, so the real unique constraint on
    // teams.slug fires and the action's catch branch must recover from it.
    // The raw DB::table()->insert() bypasses Eloquent events so it cannot
    // recurse into this same hook.
    $hasFired = false;

    Team::creating(function (Team $team) use (&$hasFired): void {
        if ($hasFired) {
            return;
        }

        $hasFired = true;

        DB::table('teams')->insert([
            'name' => 'Competitor Kft.',
            'slug' => $team->slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    });

    try {
        $team = app(CreateTeamWithUniqueSlug::class)->handle('Acme Kft.');

        expect($hasFired)->toBeTrue()
            ->and($team->exists)->toBeTrue()
            ->and($team->slug)->toBe('acme-kft-2');
    } finally {
        Team::flushEventListeners();
    }
});
