<?php

declare(strict_types=1);

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Http;
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

it('reports a team that exists on the publisher but not on the receiver', function (): void {
    Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:audit')
        ->expectsOutputToContain('crm')
        ->expectsOutputToContain('acme')
        ->assertExitCode(0);
});

it('reports a team that exists only on the receiver', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [['id' => 3, 'name' => 'Local Only', 'slug' => 'local-only']],
            'users' => [],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:audit')
        ->expectsOutputToContain('local-only')
        ->assertExitCode(0);
});

it('reports a user missing from the receiver', function (): void {
    User::factory()->create(['email' => 'hianyzo@example.com']);

    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:audit')
        ->expectsOutputToContain('hianyzo@example.com')
        ->assertExitCode(0);
});

it('survives an app that has not been upgraded yet', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response('Not Found', 404),
    ]);

    artisan('identity:audit')
        ->expectsOutputToContain('crm')
        ->expectsOutputToContain('identity-audit')
        ->assertExitCode(0);
});

it('writes the full report to storage', function (): void {
    Http::fake([
        'https://crm.test/api/identity-audit' => Http::response([
            'teams' => [],
            'users' => [],
            'memberships' => [],
            'pending_team_attachments' => [],
        ]),
    ]);

    artisan('identity:audit')->assertExitCode(0);

    // freezeTime() in tests/Pest.php makes the filename deterministic, so
    // assert on the exact path rather than globbing — a glob would pick up
    // reports left behind by earlier runs.
    $path = storage_path('app/identity-audit-' . now()->format('Ymd-His') . '.json');

    expect(file_exists($path))->toBeTrue();

    $report = json_decode((string) file_get_contents($path), true);

    expect($report)->toHaveKey('crm');

    unlink($path);
});
