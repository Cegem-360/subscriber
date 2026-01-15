<?php

declare(strict_types=1);

use App\Filament\Resources\Users\UserResource;
use App\Mcp\Servers\FilamentServer;
use App\Mcp\Tools\GetFilamentPanelInfoTool;
use App\Mcp\Tools\GetFilamentResourceSchemaTool;
use App\Mcp\Tools\ListFilamentPagesTool;
use App\Mcp\Tools\ListFilamentResourcesTool;
use App\Mcp\Tools\ListFilamentWidgetsTool;

describe('ListFilamentResourcesTool', function (): void {
    it('lists all resources for the admin panel', function (): void {
        $response = FilamentServer::tool(ListFilamentResourcesTool::class, []);

        $response->assertOk();
        $response->assertSee('UserResource');
    });

    it('returns error for non-existent panel', function (): void {
        $response = FilamentServer::tool(ListFilamentResourcesTool::class, [
            'panel_id' => 'non-existent-panel',
        ]);

        $response->assertHasErrors(['Panel \'non-existent-panel\' not found.']);
    });
});

describe('GetFilamentResourceSchemaTool', function (): void {
    it('returns form and table schema for a resource', function (): void {
        $response = FilamentServer::tool(GetFilamentResourceSchemaTool::class, [
            'resource' => UserResource::class,
        ]);

        $response->assertOk();
        $response->assertSee('User');
    });

    it('returns error for non-existent resource class', function (): void {
        $response = FilamentServer::tool(GetFilamentResourceSchemaTool::class, [
            'resource' => 'NonExistent\\Resource\\Class',
        ]);

        $response->assertHasErrors();
    });
});

describe('ListFilamentWidgetsTool', function (): void {
    it('lists all widgets for the admin panel', function (): void {
        $response = FilamentServer::tool(ListFilamentWidgetsTool::class, []);

        $response->assertOk();
    });
});

describe('ListFilamentPagesTool', function (): void {
    it('lists all pages for the admin panel', function (): void {
        $response = FilamentServer::tool(ListFilamentPagesTool::class, []);

        $response->assertOk();
    });
});

describe('GetFilamentPanelInfoTool', function (): void {
    it('returns info for a specific panel', function (): void {
        $response = FilamentServer::tool(GetFilamentPanelInfoTool::class, [
            'panel_id' => 'admin',
        ]);

        $response->assertOk();
        $response->assertSee('"id": "admin"');
    });

    it('returns info for all panels when no panel_id provided', function (): void {
        $response = FilamentServer::tool(GetFilamentPanelInfoTool::class, []);

        $response->assertOk();
        $response->assertSee('"admin"');
    });

    it('returns error for non-existent panel', function (): void {
        $response = FilamentServer::tool(GetFilamentPanelInfoTool::class, [
            'panel_id' => 'non-existent-panel',
        ]);

        $response->assertHasErrors(['Panel \'non-existent-panel\' not found.']);
    });
});
