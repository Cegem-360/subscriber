<?php

declare(strict_types=1);

namespace App\Mcp\Tools;

use Exception;
use Filament\Panel;
use Filament\Contracts\Plugin;
use Throwable;
use Filament\Facades\Filament;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;

class GetFilamentPanelInfoTool extends Tool
{
    /**
     * The tool's description.
     */
    protected string $description = <<<'MARKDOWN'
        Get detailed information about a Filament panel including its configuration,
        registered plugins, authentication settings, and theme configuration.
    MARKDOWN;

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $panelId = $request->get('panel_id');

        if ($panelId) {
            try {
                $panel = Filament::getPanel($panelId);

                if ($panel === null) {
                    return Response::error("Panel '{$panelId}' not found.");
                }

                return Response::text(json_encode(
                    $this->getPanelInfo($panel),
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
                ));
            } catch (Exception) {
                return Response::error("Panel '{$panelId}' not found.");
            }
        }

        $panels = Filament::getPanels();
        $result = [];

        foreach ($panels as $id => $panel) {
            $result[$id] = $this->getPanelInfo($panel);
        }

        return Response::text(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'panel_id' => $schema->string()
                ->description('The panel ID to get info for. If not provided, returns info for all panels.'),
        ];
    }

    private function getPanelInfo(Panel $panel): array
    {
        return [
            'id' => $panel->getId(),
            'path' => $panel->getPath(),
            'is_default' => $panel->isDefault(),
            'has_login' => $panel->hasLogin(),
            'has_registration' => $panel->hasRegistration(),
            'has_email_verification' => $panel->hasEmailVerification(),
            'has_password_reset' => $panel->hasPasswordReset(),
            'has_profile' => $panel->hasProfile(),
            'resources_count' => \count($panel->getResources()),
            'pages_count' => \count($panel->getPages()),
            'widgets_count' => \count($panel->getWidgets()),
            'plugins' => array_map(
                fn (Plugin $plugin): string => $plugin->getId(),
                $panel->getPlugins(),
            ),
            'colors' => $this->getColors($panel),
        ];
    }

    private function getColors(Panel $panel): array
    {
        try {
            $colors = $panel->getColors();

            return array_map(fn(array|string $color): array|string => $color, $colors);
        } catch (Throwable) {
            return [];
        }
    }
}
