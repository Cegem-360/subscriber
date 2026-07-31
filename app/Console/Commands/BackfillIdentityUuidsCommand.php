<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Assigns a UUID to every pre-existing user and team on this app.
 *
 * New records get theirs from the model's creating hook; this only covers rows
 * that predate the uuid column. Idempotent — rows that already have one are
 * skipped, so it is safe to re-run.
 */
#[Signature('identity:backfill-uuids {--dry-run : Report what would change without writing}')]
#[Description('Assign a UUID to every user and team that does not have one yet.')]
final class BackfillIdentityUuidsCommand extends Command
{
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY-RUN mode — no changes will be persisted.');
        }

        $total = 0;

        foreach (['users' => User::class, 'teams' => Team::class] as $label => $modelClass) {
            /** @var class-string<Model> $modelClass */
            $query = $modelClass::query()->whereNull('uuid');
            $count = (clone $query)->count();

            $this->line(sprintf('%s: %d row(s) without a uuid.', $label, $count));

            if ($count === 0 || $dryRun) {
                $total += $count;

                continue;
            }

            $query->each(function (Model $model): void {
                $model->forceFill(['uuid' => (string) Str::uuid()])->saveQuietly();
            });

            $total += $count;
        }

        $this->newLine();
        $this->info(sprintf('%s %d row(s).', $dryRun ? 'Would update' : 'Updated', $total));

        return self::SUCCESS;
    }
}
