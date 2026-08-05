<?php

declare(strict_types=1);

use App\Console\Commands\IdentityPreflightCommand;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
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

/**
 * Builds an /api/identity-audit response. `evaluateApp()` resolves every org
 * against the receiver's FULL team table, not just the membership rows, so
 * every team referenced by a membership must also appear in $teams.
 *
 * @param  list<array<string, mixed>>  $teams
 * @param  list<array<string, mixed>>  $users
 * @param  list<array<string, mixed>>  $memberships
 * @return array<string, mixed>
 */
function identityAuditPayload(array $teams, array $users, array $memberships): array
{
    return [
        'teams' => $teams,
        'users' => $users,
        'memberships' => $memberships,
        'pending_team_attachments' => [],
    ];
}

it('passes for a clean app where every membership survives via a uuid match', function (): void {
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);
    $user->teams()->attach($team);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $team->uuid, 'name' => 'Acme', 'slug' => 'acme']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => $team->slug, 'team_uuid' => $team->uuid],
            ],
        )),
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
    $orphanUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [
                ['id' => 1, 'uuid' => $keptTeam->uuid, 'name' => 'Keep', 'slug' => 'keep'],
                ['id' => 2, 'uuid' => $orphanUuid, 'name' => 'Orphan', 'slug' => 'orphan-team'],
            ],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => $keptTeam->slug, 'team_uuid' => $keptTeam->uuid],
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'orphan-team', 'team_uuid' => $orphanUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['orphan-team' => 0],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would lose at least one membership: 1')
        ->expectsOutputToContain('orphan-team: empty, safe to detach')
        ->expectsOutputToContain('PASSED')
        ->assertExitCode(0);
});

it('fails when a detached team holds records', function (): void {
    $user = User::factory()->create();
    $teamUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $teamUuid, 'name' => 'Legacy Clients', 'slug' => 'legacy-clients']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'legacy-clients', 'team_uuid' => $teamUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['legacy-clients' => 49123],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('legacy-clients: 49123 record(s) at risk')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('flags a local user with no teams, even with no receiver memberships to lose', function (): void {
    // I3: the metric must come from the LOCAL user's own team count, not from
    // originalCount - detachedCount. A user who never had any receiver
    // memberships to begin with is still the real casualty if their local
    // account has no teams either — nothing will ever grant them one.
    $user = User::factory()->create();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [],
        )),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would be left with ZERO teams')
        ->assertExitCode(0);

    Http::assertSentCount(1);
});

it('spares a receiver team with no uuid whose slug matches a local team, mirroring adoption', function (): void {
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Legacy', 'slug' => 'legacy-team']);
    $user->teams()->attach($team);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            // The receiver's own team has no uuid yet (never pushed), but its
            // slug matches the local team, and no OTHER receiver team already
            // claims the local team's uuid — resolveTeam() adopts it.
            teams: [['id' => 1, 'uuid' => null, 'name' => 'Legacy', 'slug' => 'legacy-team']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'legacy-team', 'team_uuid' => null],
            ],
        )),
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

it('fails loudly on a typo in --app instead of silently checking nothing', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload([], [], [])),
    ]);

    artisan('identity:preflight', ['--app' => 'typoed-app'])
        ->expectsOutputToContain('Unknown or inactive app')
        ->assertExitCode(1);

    Http::assertNothingSent();
});

it('still passes cleanly when there are genuinely no active apps at all', function (): void {
    SyncApp::query()->delete();

    artisan('identity:preflight')
        ->expectsOutputToContain('No active apps configured')
        ->assertExitCode(0);

    Http::assertNothingSent();
});

it('limits the run to a single app via --app', function (): void {
    SyncApp::create([
        'name' => 'anest',
        'url' => 'https://anest.test',
        'api_key' => 'secret',
        'is_active' => true,
    ]);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload([], [], [])),
    ]);

    artisan('identity:preflight', ['--app' => 'crm'])
        ->expectsOutputToContain('crm')
        ->assertExitCode(0);

    Http::assertNotSent(fn ($request): bool => str_contains($request->url(), 'anest.test'));
});

it('adopts a uuid-less receiver user by email and evaluates it for membership loss (C1)', function (): void {
    // This is exactly the pre-uuid cohort the 49,000-record incident came
    // from: no uuid on the receiver row, but resolveUser() adopts it by
    // email, and sync() still detaches whatever it does not resolve.
    $user = User::factory()->create(['email' => 'legacy@example.com']);
    $teamUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $teamUuid, 'name' => 'Legacy Clients', 'slug' => 'legacy-clients']],
            users: [['id' => 1, 'uuid' => null, 'email' => 'legacy@example.com']],
            memberships: [
                ['user_email' => 'legacy@example.com', 'user_uuid' => null, 'team_slug' => 'legacy-clients', 'team_uuid' => $teamUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['legacy-clients' => 812],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would lose at least one membership: 1')
        ->expectsOutputToContain('legacy-clients: 812 record(s) at risk')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);

    Http::assertSentCount(2);
});

it('reports an identity conflict and fails, because that login would 500 (C1)', function (): void {
    // Receiver row already carries SOME uuid, but not the local user's — and
    // its email matches a DIFFERENT local user. resolveUser() finds it by
    // email, sees a non-empty foreign uuid, and throws.
    $user = User::factory()->create(['email' => 'conflict@example.com']);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [],
            users: [['id' => 1, 'uuid' => (string) Str::uuid(), 'email' => 'conflict@example.com']],
            memberships: [],
        )),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Identity conflicts')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);

    Http::assertSentCount(1);
});

it('reports a receiver user matching neither uuid nor email as genuinely out of scope', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [],
            users: [['id' => 1, 'uuid' => (string) Str::uuid(), 'email' => 'stranger@example.com']],
            memberships: [],
        )),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('No counterpart on this app, by uuid or email: 1')
        ->expectsOutputToContain('PASSED')
        ->assertExitCode(0);
});

it('detaches a slug-matched legacy team when a different receiver team already claims the org uuid (C2)', function (): void {
    // Publisher-side: one team, uuid U, slug 'x'.
    $user = User::factory()->create();
    $localTeam = Team::query()->create(['name' => 'Current', 'slug' => 'x']);
    $user->teams()->attach($localTeam);

    // Receiver-side: team A already carries uuid U (drifted slug 'x-old'),
    // AND a separate legacy team B has slug 'x' but no uuid yet. Both exist;
    // the receiver user currently belongs to BOTH.
    $teamAUuid = $localTeam->uuid;

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [
                ['id' => 1, 'uuid' => $teamAUuid, 'name' => 'Pushed', 'slug' => 'x-old'],
                ['id' => 2, 'uuid' => null, 'name' => 'Legacy', 'slug' => 'x'],
            ],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'x-old', 'team_uuid' => $teamAUuid],
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'x', 'team_uuid' => null],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['x' => 7],
        ]),
    ]);

    artisan('identity:preflight')
        // Team A (matched by uuid) survives — only team B (the slug-match
        // loser) should show up as at risk.
        ->expectsOutputToContain('x: 7 record(s) at risk')
        ->doesntExpectOutputToContain('x-old:')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('does not let a uuid-carrying team survive on a coincidental slug match', function (): void {
    // Guards against widening the adoption lookup to match by slug even when
    // the receiver team's own uuid is set (and does not match the org's).
    // The receiver team's uuid here is the SAME value on both its `teams`
    // roster entry and its own membership row — as it always is in real
    // data, since they describe the exact same receiver-side row.
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Local', 'slug' => 'shared-slug']);
    $user->teams()->attach($team);
    $unrelatedTeamUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $unrelatedTeamUuid, 'name' => 'Unrelated', 'slug' => 'shared-slug']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'shared-slug', 'team_uuid' => $unrelatedTeamUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['shared-slug' => 3],
        ]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Would lose at least one membership: 1')
        ->assertExitCode(1);
});

it('fails when the record-count call itself fails after a successful audit', function (): void {
    $user = User::factory()->create();
    $teamUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $teamUuid, 'name' => 'Gone', 'slug' => 'gone']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'gone', 'team_uuid' => $teamUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response('Internal Server Error', 500),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('Could not retrieve record counts')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('reports a gap when the receiver cannot resolve a requested slug to a team', function (): void {
    $user = User::factory()->create();
    $teamUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [['id' => 1, 'uuid' => $teamUuid, 'name' => 'Gone', 'slug' => 'gone']],
            users: [['id' => 1, 'uuid' => $user->uuid, 'email' => $user->email]],
            memberships: [
                ['user_email' => $user->email, 'user_uuid' => $user->uuid, 'team_slug' => 'gone', 'team_uuid' => $teamUuid],
            ],
        )),
        // The receiver's record_counts response simply omits the slug — this
        // is exactly what its controller does for a slug it cannot resolve.
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response(['record_counts' => []]),
    ]);

    artisan('identity:preflight')
        ->expectsOutputToContain('gone: record count unknown')
        ->expectsOutputToContain('FAILED')
        ->assertExitCode(1);
});

it('requests every distinct at-risk slug exactly once, across multiple users', function (): void {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $sharedUuid = (string) Str::uuid();
    $otherUuid = (string) Str::uuid();

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response(identityAuditPayload(
            teams: [
                ['id' => 1, 'uuid' => $sharedUuid, 'name' => 'Shared Orphan', 'slug' => 'shared-orphan'],
                ['id' => 2, 'uuid' => $otherUuid, 'name' => 'Other Orphan', 'slug' => 'other-orphan'],
            ],
            users: [
                ['id' => 1, 'uuid' => $userA->uuid, 'email' => $userA->email],
                ['id' => 2, 'uuid' => $userB->uuid, 'email' => $userB->email],
            ],
            memberships: [
                // Both users would lose the SAME orphan team — must be counted once.
                ['user_email' => $userA->email, 'user_uuid' => $userA->uuid, 'team_slug' => 'shared-orphan', 'team_uuid' => $sharedUuid],
                ['user_email' => $userB->email, 'user_uuid' => $userB->uuid, 'team_slug' => 'shared-orphan', 'team_uuid' => $sharedUuid],
                ['user_email' => $userB->email, 'user_uuid' => $userB->uuid, 'team_slug' => 'other-orphan', 'team_uuid' => $otherUuid],
            ],
        )),
        'https://crm.test/api/identity-audit?count_teams=*' => Http::response([
            'record_counts' => ['shared-orphan' => 0, 'other-orphan' => 0],
        ]),
    ]);

    artisan('identity:preflight')->assertExitCode(0);

    Http::assertSent(function ($request): bool {
        if (! str_contains($request->url(), 'count_teams=')) {
            return false;
        }

        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);
        $slugs = explode(',', $query['count_teams']);

        sort($slugs);

        return $slugs === ['other-orphan', 'shared-orphan'];
    });
});

/**
 * The value of identity:preflight depends entirely on its matching rules
 * mirroring IdentityProvisioner exactly. Reimplementing resolveTeam()'s
 * decision as a pure predicate is unavoidable — it mutates state (creates
 * and saves teams) as a side effect, which a dry-run preflight must never
 * do — so this test invokes the REAL resolveTeam() via reflection, on
 * fixtures where the uuid rule and the slug rule genuinely compete, and
 * checks that the command's own resolution (also exercised via reflection,
 * since it is private) agrees with what resolveTeam() actually did.
 *
 * teamA already carries the org's uuid but a drifted slug ('x-old'). teamB
 * is a legacy row with no uuid at all but the org's CURRENT slug ('x').
 * A naive slug-only check would rescue teamB; the real resolveTeam() must
 * not, because the uuid branch is checked first and wins outright.
 */
it('mirrors the real IdentityProvisioner::resolveTeam() resolution order under genuine rule competition', function (): void {
    // resolveTeam() calling save() on teamA changes its name/slug to the
    // org's values, which would otherwise fire this app's own publisher
    // observer and push an update to the live 'crm' SyncApp via HTTP — noise
    // unrelated to what this test verifies.
    Bus::fake();

    $teamA = Team::query()->create(['name' => 'Pushed', 'slug' => 'x-old']);
    $orgUuid = $teamA->uuid;

    $teamB = Team::query()->create(['name' => 'Legacy', 'slug' => 'x']);
    DB::table('teams')->where('id', $teamB->id)->update(['uuid' => null]);
    $teamB->refresh();

    $teamC = Team::query()->create(['name' => 'Stale', 'slug' => 'unrelated']);

    // A reordered resolveTeam() tries to hand teamA's uuid to teamB, which a
    // real UNIQUE(teams.uuid) index rejects outright — arguably the correct
    // outcome for a bug this serious, but it means the DB constraint would be
    // the thing catching the drift, not this test. Drop it here to force the
    // comparison below to do the catching instead, exactly as it would have
    // to on a receiver whose schema does not happen to carry that safety net.
    Schema::table('teams', fn (Blueprint $table) => $table->dropUnique(['uuid']));

    $orgX = ['uuid' => $orgUuid, 'slug' => 'x', 'name' => 'Current'];
    $orgFresh = ['uuid' => (string) Str::uuid(), 'slug' => 'brand-new', 'name' => 'Brand New'];
    // Its uuid matches nothing, but its slug collides with teamC's — teamC
    // already carries a uuid, so ->whereNull('uuid') must exclude it from
    // adoption. Without that guard, teamC would be silently overwritten.
    $orgCollidingWithC = ['uuid' => (string) Str::uuid(), 'slug' => $teamC->slug, 'name' => 'Impostor'];
    $teamCOriginalUuid = $teamC->uuid;

    $resolveTeam = new ReflectionMethod(IdentityProvisioner::class, 'resolveTeam');
    $resolveTeam->setAccessible(true);
    $provisioner = new IdentityProvisioner();

    // Ground truth: what the real provisioner resolves EVERY org to.
    $resolvedForX = $resolveTeam->invoke($provisioner, $orgX);
    $resolvedForFresh = $resolveTeam->invoke($provisioner, $orgFresh);
    $resolvedForCollision = $resolveTeam->invoke($provisioner, $orgCollidingWithC);

    expect($resolvedForX->is($teamA))->toBeTrue(); // uuid wins over teamB's slug match
    expect($resolvedForFresh->is($teamA))->toBeFalse();
    expect($resolvedForFresh->is($teamB))->toBeFalse();
    expect($resolvedForFresh->is($teamC))->toBeFalse(); // a brand-new team was created
    expect($resolvedForCollision->is($teamC))->toBeFalse(); // teamC has a uuid, so it must NOT be adopted by slug
    expect($teamC->refresh()->uuid)->toBe($teamCOriginalUuid); // and must be left untouched

    // The command's own algorithm, exercised through reflection, fed the
    // SAME receiver team roster (teamA, teamB, teamC as they existed BEFORE
    // any of the calls above, since the audit is read-only).
    $resolveId = new ReflectionMethod(IdentityPreflightCommand::class, 'resolveReceiverTeamId');
    $resolveId->setAccessible(true);
    $membershipTeamId = new ReflectionMethod(IdentityPreflightCommand::class, 'membershipTeamId');
    $membershipTeamId->setAccessible(true);
    $command = (new ReflectionClass(IdentityPreflightCommand::class))->newInstanceWithoutConstructor();

    $remoteTeamsByUuid = collect([
        ['id' => 1, 'uuid' => $orgUuid, 'name' => 'Pushed', 'slug' => 'x-old'],
        ['id' => 3, 'uuid' => $teamC->uuid, 'name' => 'Stale', 'slug' => 'unrelated'],
    ])->keyBy('uuid');

    $remoteTeamsByNullSlug = collect([
        ['id' => 2, 'uuid' => null, 'name' => 'Legacy', 'slug' => 'x'],
    ])->keyBy('slug');

    $remoteTeamsBySlug = collect([
        ['id' => 1, 'uuid' => $orgUuid, 'name' => 'Pushed', 'slug' => 'x-old'],
        ['id' => 2, 'uuid' => null, 'name' => 'Legacy', 'slug' => 'x'],
        ['id' => 3, 'uuid' => $teamC->uuid, 'name' => 'Stale', 'slug' => 'unrelated'],
    ])->keyBy('slug');

    $idForX = $resolveId->invoke($command, $orgX, $remoteTeamsByUuid, $remoteTeamsByNullSlug);
    $idForFresh = $resolveId->invoke($command, $orgFresh, $remoteTeamsByUuid, $remoteTeamsByNullSlug);
    $idForCollision = $resolveId->invoke($command, $orgCollidingWithC, $remoteTeamsByUuid, $remoteTeamsByNullSlug);

    // Translates a REAL resolveTeam() result into "the pre-existing receiver
    // row it resolved to, or null if it created/adopted something outside
    // {teamA, teamB, teamC}" — the exact shape resolveReceiverTeamId()
    // returns. Every comparison below is therefore anchored to what the
    // provisioner ACTUALLY did on this call, never to a hand-written
    // assumption: if resolveTeam() ever resolves orgFresh or
    // orgCollidingWithC to an existing team, $realId reports that team's
    // real id and the comparison catches the command disagreeing with it.
    $realId = function (Model $resolved) use ($teamA, $teamB, $teamC): int|string|null {
        return match (true) {
            $resolved->is($teamA) => $teamA->id,
            $resolved->is($teamB) => $teamB->id,
            $resolved->is($teamC) => $teamC->id,
            default => null,
        };
    };

    // Parity: the command's prediction must equal what resolveTeam() itself
    // just did, for all three orgs — not an assumption about any of them.
    expect($idForX)->toBe($realId($resolvedForX));
    expect($idForFresh)->toBe($realId($resolvedForFresh));
    expect($idForCollision)->toBe($realId($resolvedForCollision));

    $resolvedTeamIds = collect([$idForX, $idForFresh, $idForCollision])->filter(fn (int|string|null $id): bool => $id !== null);

    $teamAMembership = ['team_slug' => 'x-old', 'team_uuid' => $orgUuid];
    $teamBMembership = ['team_slug' => 'x', 'team_uuid' => null];
    $teamCMembership = ['team_slug' => 'unrelated', 'team_uuid' => $teamC->uuid];

    $teamAId = $membershipTeamId->invoke($command, $teamAMembership, $remoteTeamsByUuid, $remoteTeamsBySlug);
    $teamBId = $membershipTeamId->invoke($command, $teamBMembership, $remoteTeamsByUuid, $remoteTeamsBySlug);
    $teamCId = $membershipTeamId->invoke($command, $teamCMembership, $remoteTeamsByUuid, $remoteTeamsBySlug);

    // Ground-truth-anchored assertions: what the command predicts must equal
    // what the real resolveTeam() calls above actually resolved to.
    expect($resolvedTeamIds->contains($teamAId))->toBe($resolvedForX->is($teamA));
    expect($resolvedTeamIds->contains($teamBId))->toBeFalse(); // the slug-match loser: correctly detached
    expect($resolvedTeamIds->contains($teamCId))->toBeFalse(); // never returned by any resolveTeam() call above
});
