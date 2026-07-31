<?php

declare(strict_types=1);

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

it('sends every user and team uuid to each active app', function (): void {
    $user = User::factory()->create(['email' => 'owner@example.com']);
    $team = Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);

    Http::fake([
        'https://crm.test/api/identity-uuids' => Http::response([
            'users_updated' => 1, 'users_missing' => [], 'users_conflicting' => [],
            'teams_updated' => 1, 'teams_missing' => [], 'teams_conflicting' => [],
        ]),
    ]);

    artisan('identity:push-uuids')->assertExitCode(0);

    Http::assertSent(function ($request) use ($user, $team): bool {
        return $request->url() === 'https://crm.test/api/identity-uuids'
            && $request['users'][0] === ['email' => $user->email, 'uuid' => $user->uuid]
            && $request['teams'][0] === ['slug' => $team->slug, 'uuid' => $team->uuid];
    });
});

it('reports conflicts loudly and exits non-zero', function (): void {
    User::factory()->create();

    Http::fake([
        'https://crm.test/api/identity-uuids' => Http::response([
            'users_updated' => 0, 'users_missing' => [], 'users_conflicting' => ['owner@example.com'],
            'teams_updated' => 0, 'teams_missing' => [], 'teams_conflicting' => [],
        ]),
    ]);

    artisan('identity:push-uuids')
        ->expectsOutputToContain('conflict')
        ->assertExitCode(1);
});

it('skips records that have no uuid yet', function (): void {
    $user = User::factory()->create();
    DB::table('users')->where('id', $user->id)->update(['uuid' => null]);

    Http::fake([
        'https://crm.test/api/identity-uuids' => Http::response([
            'users_updated' => 0, 'users_missing' => [], 'users_conflicting' => [],
            'teams_updated' => 0, 'teams_missing' => [], 'teams_conflicting' => [],
        ]),
    ]);

    artisan('identity:push-uuids')->assertExitCode(0);

    Http::assertSent(fn ($request): bool => $request['users'] === []);
});
