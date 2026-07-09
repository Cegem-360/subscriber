<?php

declare(strict_types=1);

use App\Filament\Resources\SyncApps\Pages\CreateSyncApp;
use App\Filament\Resources\SyncApps\Pages\EditSyncApp;
use App\Filament\Resources\SyncApps\Pages\ListSyncApps;
use App\Models\User;
use Livewire\Livewire;
use Madbox99\UserTeamSync\Models\SyncApp;

test('can render sync apps list page', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(ListSyncApps::class)
        ->assertSuccessful();
});

test('can list sync apps', function (): void {
    $apps = collect([
        SyncApp::query()->create(['name' => 'app-1', 'url' => 'https://app1.test', 'is_active' => true]),
        SyncApp::query()->create(['name' => 'app-2', 'url' => 'https://app2.test', 'is_active' => true]),
    ]);

    Livewire::actingAs(User::factory()->create())
        ->test(ListSyncApps::class)
        ->assertCanSeeTableRecords($apps);
});

test('can search sync apps by name', function (): void {
    $appToFind = SyncApp::query()->create(['name' => 'findme', 'url' => 'https://findme.test', 'is_active' => true]);
    $otherApp = SyncApp::query()->create(['name' => 'other', 'url' => 'https://other.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(ListSyncApps::class)
        ->searchTable('findme')
        ->assertCanSeeTableRecords([$appToFind])
        ->assertCanNotSeeTableRecords([$otherApp]);
});

test('can render create sync app page', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(CreateSyncApp::class)
        ->assertSuccessful();
});

test('can create a sync app', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(CreateSyncApp::class)
        ->fillForm([
            'name' => 'new-app',
            'url' => 'https://new-app.test',
            'api_key' => 'secret-key-123',
            'is_active' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $app = SyncApp::query()->where('name', 'new-app')->first();

    expect($app)->not->toBeNull()
        ->and($app->url)->toBe('https://new-app.test')
        ->and($app->is_active)->toBeTrue();
});

test('can validate sync app creation', function (): void {
    Livewire::actingAs(User::factory()->create())
        ->test(CreateSyncApp::class)
        ->fillForm([
            'name' => '',
            'url' => '',
        ])
        ->call('create')
        ->assertHasFormErrors(['name', 'url']);
});

test('can validate unique name on creation', function (): void {
    SyncApp::query()->create(['name' => 'existing', 'url' => 'https://existing.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(CreateSyncApp::class)
        ->fillForm([
            'name' => 'existing',
            'url' => 'https://another.test',
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => 'unique']);
});

test('can render edit sync app page', function (): void {
    $app = SyncApp::query()->create(['name' => 'edit-test', 'url' => 'https://edit.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(EditSyncApp::class, ['record' => $app->id])
        ->assertSuccessful();
});

test('can retrieve sync app data for editing', function (): void {
    $app = SyncApp::query()->create(['name' => 'retrieve-test', 'url' => 'https://retrieve.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(EditSyncApp::class, ['record' => $app->id])
        ->assertFormSet([
            'name' => 'retrieve-test',
            'url' => 'https://retrieve.test',
            'is_active' => true,
        ]);
});

test('can update a sync app', function (): void {
    $app = SyncApp::query()->create(['name' => 'update-test', 'url' => 'https://update.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(EditSyncApp::class, ['record' => $app->id])
        ->fillForm([
            'name' => 'updated-name',
            'url' => 'https://updated.test',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $app->refresh();

    expect($app->name)->toBe('updated-name')
        ->and($app->url)->toBe('https://updated.test');
});

test('can toggle sync app active status', function (): void {
    $app = SyncApp::query()->create(['name' => 'toggle-test', 'url' => 'https://toggle.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(ListSyncApps::class)
        ->callTableAction('toggle_status', $app);

    $app->refresh();

    expect($app->is_active)->toBeFalse();
});

test('can delete a sync app', function (): void {
    $app = SyncApp::query()->create(['name' => 'delete-test', 'url' => 'https://delete.test', 'is_active' => true]);

    Livewire::actingAs(User::factory()->create())
        ->test(EditSyncApp::class, ['record' => $app->id])
        ->callAction('delete');

    expect(SyncApp::query()->find($app->id))->toBeNull();
});
