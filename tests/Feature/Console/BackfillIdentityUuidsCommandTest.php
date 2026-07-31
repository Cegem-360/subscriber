<?php

declare(strict_types=1);

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\artisan;

it('fills the uuid on users and teams that have none', function (): void {
    $user = User::factory()->create();
    $team = Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);

    DB::table('users')->where('id', $user->id)->update(['uuid' => null]);
    DB::table('teams')->where('id', $team->id)->update(['uuid' => null]);

    artisan('identity:backfill-uuids')->assertExitCode(0);

    expect($user->refresh()->uuid)->not->toBeNull()
        ->and($team->refresh()->uuid)->not->toBeNull();
});

it('leaves an existing uuid untouched', function (): void {
    $team = Team::query()->create(['name' => 'Acme', 'slug' => 'acme']);
    $original = $team->refresh()->uuid;

    expect($original)->not->toBeNull();

    artisan('identity:backfill-uuids')->assertExitCode(0);

    expect($team->refresh()->uuid)->toBe($original);
});

it('assigns a uuid automatically to newly created records', function (): void {
    $team = Team::query()->create(['name' => 'Fresh', 'slug' => 'fresh']);
    $user = User::factory()->create();

    expect($team->uuid)->not->toBeNull()
        ->and($user->uuid)->not->toBeNull();
});

it('gives every record a distinct uuid', function (): void {
    Team::query()->create(['name' => 'One', 'slug' => 'one']);
    Team::query()->create(['name' => 'Two', 'slug' => 'two']);

    expect(Team::query()->distinct()->count('uuid'))->toBe(2);
});
