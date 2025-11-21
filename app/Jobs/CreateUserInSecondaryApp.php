<?php

declare(strict_types=1);

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateUserInSecondaryApp implements ShouldQueue
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
        public string $email,
        public string $name,
        public string $passwordHash,
        public string $role,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $secondaryAppUrls = config('services-app-urls');
        $api_key = config('services-app-urls.app_api_key');

        foreach ($secondaryAppUrls as $key => $values) {
            if ($key === array_key_first($secondaryAppUrls)) {
                continue;
            }
            if (! $values['active']) {
                continue;
            }
            try {
                $http = Http::withHeaders([
                    'Authorization' => "Bearer {$api_key}",
                    'Accept' => 'application/json',
                ]);

                // Skip SSL verification for local .test domains (Laravel Herd)
                if (str_ends_with((string) $values['url'], '.test')) {
                    $http = $http->withoutVerifying();
                }

                $response = $http->timeout(10)
                    ->post("{$values['url']}/api/create-user", [
                        'email' => $this->email,
                        'name' => $this->name,
                        'password_hash' => $this->passwordHash,
                        'role' => $this->role,
                    ]);

                if ($response->successful()) {
                    Log::info("User creation successful for {$this->email} to {$values['url']}");
                } else {
                    Log::warning("User creation failed for {$this->email} to {$values['url']}: {$response->body()}");
                }
            } catch (Exception $e) {
                Log::error("Exception during user creation for {$this->email}: {$e->getMessage()}");
            }
        }
    }
}
