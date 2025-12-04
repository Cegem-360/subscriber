<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\SecondaryAppService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateTeamInSecondaryApp implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $teamName,
        public string $userEmail,
        public ?string $slug = null,
        public ?string $userName = null,
    ) {
        $this->slug = $slug ?? Str::slug($teamName);
    }

    /**
     * Execute the job.
     */
    public function handle(SecondaryAppService $appService): void
    {
        $defaultApiKey = $appService->getDefaultApiKey();

        foreach ($appService->getActiveApps() as $app) {
            $apiKey = $app['api_key'] ?? $defaultApiKey;

            try {
                $http = Http::withHeaders([
                    'Authorization' => "Bearer {$apiKey}",
                    'Accept' => 'application/json',
                ]);

                // Skip SSL verification for local .test domains (Laravel Herd)
                if (str_ends_with((string) $app['url'], '.test')) {
                    $http = $http->withoutVerifying();
                }

                Log::info('CreateTeamInSecondaryApp: Sending team creation request', [
                    'app_url' => $app['url'],
                    'team_name' => $this->teamName,
                    'slug' => $this->slug,
                    'user_email' => $this->userEmail,
                ]);

                $response = $http->timeout(10)
                    ->post("{$app['url']}/api/create-team", [
                        'name' => $this->teamName,
                        'slug' => $this->slug,
                        'user_email' => $this->userEmail,
                        'user_name' => $this->userName,
                    ]);

                if ($response->successful()) {
                    Log::info("Team creation successful for {$this->teamName} to {$app['url']}", [
                        'team_id' => $response->json('team_id'),
                    ]);
                } else {
                    Log::warning("Team creation failed for {$this->teamName} to {$app['url']}: {$response->body()}");
                }
            } catch (Exception $e) {
                Log::error("Exception during team creation for {$this->teamName}: {$e->getMessage()}");
            }
        }
    }
}
