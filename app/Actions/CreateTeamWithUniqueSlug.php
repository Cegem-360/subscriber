<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Team;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Str;

/**
 * Always creates a NEW team with a guaranteed-unique slug.
 *
 * The slug is not an identity key — it only routes Filament tenant URLs — so
 * suffixing it on collision is safe. Joining an existing same-named team is
 * deliberately NOT done: a team carries the subscription and is the tenant
 * boundary, so attaching a stranger's registration to it would leak data.
 */
final class CreateTeamWithUniqueSlug
{
    private const int MAX_ATTEMPTS = 25;

    public function handle(string $name): Team
    {
        $base = Str::slug($name);

        if ($base === '') {
            $base = 'team';
        }

        for ($attempt = 1; $attempt <= self::MAX_ATTEMPTS; $attempt++) {
            $slug = $attempt === 1 ? $base : $base . '-' . $attempt;

            if (Team::query()->where('slug', $slug)->exists()) {
                continue;
            }

            try {
                return Team::query()->create(['name' => $name, 'slug' => $slug]);
            } catch (UniqueConstraintViolationException) {
                // Another request claimed this slug between the check and the
                // insert. Move on to the next suffix.
                continue;
            }
        }

        // Pathological contention or 25+ same-named teams: fall back to a
        // random suffix, which cannot collide in practice.
        return Team::query()->create([
            'name' => $name,
            'slug' => $base . '-' . Str::lower(Str::random(6)),
        ]);
    }
}
