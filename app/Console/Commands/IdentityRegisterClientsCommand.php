<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Laravel\Passport\ClientRepository;
use Madbox99\UserTeamSync\Models\SyncApp;

/**
 * Appnként egy confidential authorization_code klienst hoz létre.
 *
 * Idempotens: egy már felvett klienst nem duplikál. A secret csak
 * létrehozáskor olvasható, ezért egyszer kiírjuk — utána már nem kérdezhető le.
 */
#[Signature('identity:register-clients')]
#[Description('Create an OAuth client for every active module app.')]
final class IdentityRegisterClientsCommand extends Command
{
    public function handle(ClientRepository $clients): int
    {
        $apps = SyncApp::query()->where('is_active', true)->get();

        if ($apps->isEmpty()) {
            $this->warn('No active apps configured. Nothing to register.');

            return self::SUCCESS;
        }

        foreach ($apps as $app) {
            if ($app->oauth_client_id !== null) {
                $this->line("  {$app->name}: már van kliense, kihagyva.");

                continue;
            }

            $redirectUri = rtrim((string) $app->url, '/') . '/auth/callback';

            $client = $clients->createAuthorizationCodeGrantClient(
                name: $app->name,
                redirectUris: [$redirectUri],
                confidential: true,
            );

            $app->forceFill(['oauth_client_id' => $client->getKey()])->save();

            $this->newLine();
            $this->info("=== {$app->name} ===");
            $this->line("  redirect: {$redirectUri}");
            $this->line("  IDENTITY_CLIENT_ID={$client->getKey()}");
            $this->line("  IDENTITY_CLIENT_SECRET={$client->plainSecret}");
        }

        $this->newLine();
        $this->warn('A secret csak most olvasható. Mentsd el az adott app .env fájljába.');

        return self::SUCCESS;
    }
}
