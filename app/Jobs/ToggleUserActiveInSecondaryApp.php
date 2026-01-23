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
        Log::info('🚀 ToggleUserActiveInSecondaryApp: Job started', [
            'user_email' => $this->userEmail,
            'is_active' => $this->isActive,
            'app_key' => $this->appKey,
            'attempt' => $this->attempts(),
        ]);

        $app = $appService->getApp($this->appKey);

        if (! $app) {
            Log::warning('❌ ToggleUserActiveInSecondaryApp: App not found in config', [
                'app_key' => $this->appKey,
                'user_email' => $this->userEmail,
                'available_apps' => array_keys(config('microservices.apps', [])),
            ]);

            return;
        }

        $defaultApiKey = $appService->getDefaultApiKey();
        $action = $this->isActive ? 'activate' : 'deactivate';
        $apiKey = $app['api_key'] ?? $defaultApiKey;

        Log::info("🔧 ToggleUserActiveInSecondaryApp: Preparing CRM {$action} request", [
            'app_key' => $this->appKey,
            'app_url' => $app['url'],
            'app_active' => $app['active'] ?? false,
            'user_email' => $this->userEmail,
            'has_custom_api_key' => isset($app['api_key']),
            'endpoint' => "{$app['url']}/api/toggle-user-active",
        ]);

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ]);

            // Skip SSL verification for local .test domains (Laravel Herd)
            if (str_ends_with($app['url'], '.test')) {
                $http = $http->withoutVerifying();
                Log::debug('🔓 ToggleUserActiveInSecondaryApp: SSL verification disabled for .test domain');
            }

            Log::info('📡 ToggleUserActiveInSecondaryApp: Sending HTTP POST to CRM', [
                'app_key' => $this->appKey,
                'app_url' => $app['url'],
                'endpoint' => '/api/toggle-user-active',
                'user_email' => $this->userEmail,
                'is_active' => $this->isActive,
                'timeout' => 10,
            ]);

            /** @var \Illuminate\Http\Client\Response $response */
            $response = $http->timeout(10)
                ->post("{$app['url']}/api/toggle-user-active", [
                    'email' => $this->userEmail,
                    'is_active' => $this->isActive,
                ]);

            if ($response->successful()) {
                Log::info("✅ ToggleUserActiveInSecondaryApp: CRM {$action} successful", [
                    'user_email' => $this->userEmail,
                    'app_url' => $app['url'],
                    'app_key' => $this->appKey,
                    'response_status' => $response->status(),
                    'response_body' => $response->json() ?? $response->body(),
                ]);
            } else {
                Log::warning("⚠️ ToggleUserActiveInSecondaryApp: CRM {$action} failed", [
                    'user_email' => $this->userEmail,
                    'app_url' => $app['url'],
                    'app_key' => $this->appKey,
                    'response_status' => $response->status(),
                    'response_body' => $response->body(),
                ]);
            }
        } catch (Exception $e) {
            Log::error("❌ ToggleUserActiveInSecondaryApp: Exception during CRM {$action}", [
                'user_email' => $this->userEmail,
                'app_url' => $app['url'],
                'app_key' => $this->appKey,
                'exception_message' => $e->getMessage(),
                'exception_class' => \get_class($e),
                'attempt' => $this->attempts(),
                'max_attempts' => $this->tries,
            ]);

            throw $e; // Re-throw to trigger retry
        }
    }
}
