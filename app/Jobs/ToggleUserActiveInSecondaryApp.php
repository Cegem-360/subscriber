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

class ToggleUserActiveInSecondaryApp implements ShouldQueue
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
        public string $userEmail,
        public bool $isActive,
        public string $appKey,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(SecondaryAppService $appService): void
    {
        $app = $appService->getApp($this->appKey);

        if (! $app) {
            Log::warning("ToggleUserActiveInSecondaryApp: App not found for key: {$this->appKey}");

            return;
        }

        $defaultApiKey = $appService->getDefaultApiKey();
        $action = $this->isActive ? 'activate' : 'deactivate';
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

            Log::info("ToggleUserActiveInSecondaryApp: Sending {$action} request", [
                'app_key' => $this->appKey,
                'app_url' => $app['url'],
                'user_email' => $this->userEmail,
                'is_active' => $this->isActive,
            ]);

            $response = $http->timeout(10)
                ->post("{$app['url']}/api/toggle-user-active", [
                    'email' => $this->userEmail,
                    'is_active' => $this->isActive,
                ]);

            if ($response->successful()) {
                Log::info("User {$action} successful for {$this->userEmail} to {$app['url']}");
            } else {
                Log::warning("User {$action} failed for {$this->userEmail} to {$app['url']}: {$response->body()}");
            }
        } catch (Exception $e) {
            Log::error("Exception during user {$action} for {$this->userEmail}: {$e->getMessage()}");
        }
    }
}
