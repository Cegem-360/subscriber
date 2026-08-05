<?php

declare(strict_types=1);

use App\Console\Commands\IdentityPreflightCommand;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Client\IdentityProvisioner;
use Madbox99\UserTeamSync\Models\SyncApp;

use function Pest\Laravel\artisan;

beforeEach(function (): void {
    config()->set('user-team-sync.publisher.app_source', 'database');

    SyncApp::create([
        'name' => 'crm',
        'url' => 'https://crm.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);
});

it('passes for a clean app where every membership survives', function (): void {
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);
    $user->teams()->attach($team);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            'memberships' => [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => $team->slug, 'team_uuid' => $team->uuid],
            ],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Unaffected: 1')
        ->expectsOutputToContain('PASSED')
        ->assertExitCode(0);

    // Nothing is at risk, so the record-count round trip must never fire.
    Http::assertSentCount(1);
});

it('passes when the only detached team is empty', function (): void {
    $user = User::factory()->create();
    $keptTeam = Team::query()->create(['name' => 'Keep', 'slug' => 'keep']);
    $user->teams()->attach($keptTeam);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            'memberships' => [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => $keptTeam->slug, 'team_uuid' => $keptTeam->uuid],
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'orphan-team', 'team_uuid' => (string) Str::uuid()],
            ],
            'pending_team_attachments' => [],
        ]),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'teams' => [],
            'users' => [],
            'memberships' => [],
            'pending_team_attachments' => [],
            'record_counts' => ['orphan-team' => 0],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would lose at least one membership: 1')
        ->expectsOutputToContain('orphan-team: empty, safe to detach')
        ->expectsOutputToContain('PASSED')
        ->assertExitCode(0);

    Http::assertSent(fn ($request): bool => str_contains($request->url(), 'count_teams=orphan-team'));
});

it('fails when a detached team holds records', function (): void {
    $user = User::factory()->create();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            'memberships' => [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'legacy-clients', 'team_uuid' => (string) Str::uuid()],
            ],
            'pending_team_attachments' => [],
        ]),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['legacy-clients' => 49123],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('legacy-clients: 49123 record(s) at risk')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('flags a user who would be left with zero teams', function (): void {
    $user = User::factory()->create();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            'memberships' => [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'gone', 'team_uuid' => (string) Str::uuid()],
            ],
            'pending_team_attachments' => [],
        ]),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['gone' => 0],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would be left with ZERO teams')
        ->assertExitCode(0);
});

it('spares a receiver team with no uuid whose slug matches a local team, mirroring adoption', function (): void {
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Legacy', 'slug' => 'legacy-team']);
    $user->teams()->attach($team);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            'memberships' => [
                // The receiver's own team has no uuid yet (never pushed), but its
                // slug matches the local team — IdentityProvisioner::resolveTeam()
                // adopts it rather than detaching it.
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'legacy-team', 'team_uuid' => null],
            ],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Unaffected: 1')
        ->assertExitCode(0);

    Http::assertSentCount(1);
});

it('reports an unreachable app and fails', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => fn () => throw new ConnectionException('Could not resolve host'),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Unreachable')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('reports an app whose response lacks uuids and fails', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [['id' => 1, 'name' => 'Acme', 'slug' => 'acme']],
            'users' => [['id' => 1, 'email' => 'old@example.com']],
            'memberships' => [
                ['user_email' => 'old@example.com', 'team_slug' => 'acme'],
            ],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('without uuid support')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('reports a receiver user with no uuid as unable to sign in via SSO, without counting it as at risk', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => null, 'email' => 'legacy@example.com']],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('No uuid — cannot sign in via SSO: 1')
        ->expectsOutputToContain('PASSED')
        ->assertExitCode(0);
});

it('reports a receiver user with a uuid but no local counterpart', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [['id' => 1, 'uuid' => (string) Str::uuid(), 'email' => 'stranger@example.com']],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('No counterpart on this app: 1')
        ->assertExitCode(0);
});

it('limits the run to a single app via --app', function (): void {
    SyncApp::create([
        'name' => 'anest',
        'url' => 'https://anest.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [], 'users' => [], 'memberships' => [], 'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:preflight', ['--app' => 'crm'])
        ->expectsOutputToContain('crm')
        ->assertExitCode(0);

    Http::assertNotSent(fn ($request): bool => str_contains($request->url(), 'anest.test'));
});

/**
 * The value of identity:preflight depends entirely on its matching rules
 * mirroring IdentityProvisioner::resolveTeam() exactly. Reimplementing that
 * private, DB-mutating method as a pure predicate is unavoidable — provision()
 * creates/saves teams as a side effect, which a dry-run preflight must never
 * do — so this test invokes the REAL resolveTeam() via reflection and checks
 * that IdentityPreflightCommand::survives() (also exercised via reflection,
 * since it is private) classifies the same fixtures the same way. If the
 * provisioner's resolution order ever changes, resolveTeam() would resolve a
 * different team than survives() expects and this test fails.
 */
it('mirrors the real IdentityProvisioner::resolveTeam() resolution order', function (): void {
    $matchedTeam = Team::query()->create(['name' => 'Matched', 'slug' => 'matched-team']);

    $adoptTeam = Team::query()->create(['name' => 'Legacy Adopt', 'slug' => 'adopt-me']);
    DB::table('teams')->where('id', $adoptTeam->id)->update(['uuid' => null]);
    $adoptTeam->refresh();

    $staleTeam = Team::query()->create(['name' => 'Stale', 'slug' => 'stale-team']);

    $orgForMatched = ['uuid' => $matchedTeam->uuid, 'slug' => $matchedTeam->slug, 'name' => 'Matched'];
    $orgForAdopt = ['uuid' => (string) Str::uuid(), 'slug' => $adoptTeam->slug, 'name' => 'Legacy Adopt'];

    $resolveTeam = new ReflectionMethod(IdentityProvisioner::class, 'resolveTeam');
    $resolveTeam->setAccessible(true);
    $provisioner = new IdentityProvisioner();

    $resolvedForMatched = $resolveTeam->invoke($provisioner, $orgForMatched);
    $resolvedForAdopt = $resolveTeam->invoke($provisioner, $orgForAdopt);

    // Ground truth: what the real provisioner actually resolved each claim to.
    expect($resolvedForMatched->is($matchedTeam))->toBeTrue();
    expect($resolvedForAdopt->is($adoptTeam))->toBeTrue();
    expect($adoptTeam->refresh()->uuid)->toBe($orgForAdopt['uuid']);

    $survives = new ReflectionMethod(IdentityPreflightCommand::class, 'survives');
    $survives->setAccessible(true);
    $command = (new ReflectionClass(IdentityPreflightCommand::class))->newInstanceWithoutConstructor();

    $localTeamUuids = [$orgForMatched['uuid']];
    $localTeamSlugs = [$orgForAdopt['slug']];

    $matchedMembership = ['team_slug' => $matchedTeam->slug, 'team_uuid' => $matchedTeam->uuid];
    $adoptMembership = ['team_slug' => $adoptTeam->slug, 'team_uuid' => null];
    $staleMembership = ['team_slug' => $staleTeam->slug, 'team_uuid' => $staleTeam->uuid];

    expect($survives->invoke($command, $matchedMembership, $localTeamUuids, $localTeamSlugs))->toBeTrue();
    expect($survives->invoke($command, $adoptMembership, $localTeamUuids, $localTeamSlugs))->toBeTrue();
    // staleTeam was never returned by any resolveTeam() call above, so the real
    // sync() would detach it — survives() must agree.
    expect($survives->invoke($command, $staleMembership, $localTeamUuids, $localTeamSlugs))->toBeFalse();
});
