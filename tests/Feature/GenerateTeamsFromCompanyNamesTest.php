<?php

declare(strict_types=1);

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a team for each unique company_name and attaches users', function (): void {
    User::factory()->create(['company_name' => 'Acme Kft.']);
    User::factory()->create(['company_name' => 'Acme Kft.']);
    User::factory()->create(['company_name' => 'Beta Zrt.']);

    $this->artisan('teams:generate-from-users')
        ->assertSuccessful();

    expect(Team::query()->count())->toBe(2);

    $acme = Team::query()->where('slug', 'acme-kft')->firstOrFail();
    $beta = Team::query()->where('slug', 'beta-zrt')->firstOrFail();

    expect($acme->users()->count())->toBe(2);
    expect($beta->users()->count())->toBe(1);
});

it('is idempotent — running twice does not duplicate teams or attachments', function (): void {
    User::factory()->create(['company_name' => 'Acme Kft.']);
    User::factory()->create(['company_name' => 'Acme Kft.']);

    $this->artisan('teams:generate-from-users')->assertSuccessful();
    $this->artisan('teams:generate-from-users')->assertSuccessful();

    expect(Team::query()->count())->toBe(1);
    expect(Team::query()->first()->users()->count())->toBe(2);
});

it('skips users with empty company_name', function (): void {
    User::factory()->create(['company_name' => 'Acme Kft.']);
    User::factory()->create(['company_name' => '']);

    $this->artisan('teams:generate-from-users')->assertSuccessful();

    expect(Team::query()->count())->toBe(1);
    expect(Team::query()->first()->users()->count())->toBe(1);
});

it('does not persist changes in dry-run mode', function (): void {
    User::factory()->create(['company_name' => 'Acme Kft.']);

    $this->artisan('teams:generate-from-users', ['--dry-run' => true])
        ->assertSuccessful();

    expect(Team::query()->count())->toBe(0);
});
