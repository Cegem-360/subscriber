<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('teams:generate-from-users {--dry-run : Preview changes without writing to the database}')]
#[Description('Generate teams from users.company_name and attach users to their matching team.')]
final class GenerateTeamsFromCompanyNamesCommand extends Command
{
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY-RUN mode — no changes will be persisted.');
        }

        $users = User::query()
            ->whereNotNull('company_name')
            ->where('company_name', '!=', '')
            ->orderBy('company_name')
            ->get();

        if ($users->isEmpty()) {
            $this->info('No users with company_name found. Nothing to do.');

            return self::SUCCESS;
        }

        $grouped = $users->groupBy(fn (User $user): string => trim((string) $user->company_name));

        $this->info(sprintf('Processing %d companies from %d users.', $grouped->count(), $users->count()));

        $teamsCreated = 0;
        $teamsExisting = 0;
        $usersAttached = 0;

        foreach ($grouped as $companyName => $groupUsers) {
            $slug = Str::slug($companyName);

            if ($slug === '') {
                $this->warn(sprintf('Skipping company name "%s" — slug resolves to empty.', $companyName));

                continue;
            }

            $team = Team::query()->where('slug', $slug)->first();

            if ($team === null) {
                $teamsCreated++;
                $this->line(sprintf('  + Creating team: %s (slug: %s)', $companyName, $slug));

                if (! $dryRun) {
                    $team = Team::query()->create([
                        'name' => $companyName,
                        'slug' => $slug,
                    ]);
                }
            } else {
                $teamsExisting++;
                $this->line(sprintf('  · Team exists: %s', $companyName));
            }

            if ($dryRun || $team === null) {
                $usersAttached += $groupUsers->count();

                continue;
            }

            $userIds = $groupUsers->pluck('id')->all();
            $existingIds = $team->users()->pluck('users.id')->all();
            $newIds = array_diff($userIds, $existingIds);

            if ($newIds !== []) {
                $team->users()->syncWithoutDetaching($newIds);
                $usersAttached += count($newIds);
                $this->line(sprintf('    · Attached %d user(s).', count($newIds)));
            }
        }

        $this->newLine();
        $this->info(sprintf(
            'Done. Created %d team(s), %d already existed. Attached %d user(s).',
            $teamsCreated,
            $teamsExisting,
            $usersAttached,
        ));

        return self::SUCCESS;
    }
}
