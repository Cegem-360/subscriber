<?php

declare(strict_types=1);

namespace App\Services\OauthProxy;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use InvalidArgumentException;

/**
 * Encrypted, time-limited container for the data that the proxy needs to
 * remember between /start and /callback. The OAuth provider treats this as
 * an opaque `state` parameter and echoes it back unchanged.
 *
 * @phpstan-type StatePayload array{
 *     tenant: string,
 *     return_path: string,
 *     inner_state: string,
 *     nonce: string,
 *     expires_at: int,
 * }
 */
final readonly class ProxyState
{
    public function __construct(
        public string $tenant,
        public string $returnPath,
        public string $innerState,
        public string $nonce,
        public int $expiresAt,
    ) {}

    public static function issue(string $tenant, string $returnPath, string $innerState, int $ttlSeconds): self
    {
        return new self(
            tenant: $tenant,
            returnPath: $returnPath,
            innerState: $innerState,
            nonce: Str::random(32),
            expiresAt: now()->addSeconds($ttlSeconds)->timestamp,
        );
    }

    public function encrypt(): string
    {
        return Crypt::encrypt([
            'tenant' => $this->tenant,
            'return_path' => $this->returnPath,
            'inner_state' => $this->innerState,
            'nonce' => $this->nonce,
            'expires_at' => $this->expiresAt,
        ]);
    }

    public static function decrypt(string $encrypted): self
    {
        $data = Crypt::decrypt($encrypted);

        if (! is_array($data)) {
            throw new InvalidArgumentException('Decrypted state is not an array.');
        }

        foreach (['tenant', 'return_path', 'inner_state', 'nonce', 'expires_at'] as $key) {
            if (! array_key_exists($key, $data)) {
                throw new InvalidArgumentException("Decrypted state is missing key [{$key}].");
            }
        }

        return new self(
            tenant: (string) $data['tenant'],
            returnPath: (string) $data['return_path'],
            innerState: (string) $data['inner_state'],
            nonce: (string) $data['nonce'],
            expiresAt: (int) $data['expires_at'],
        );
    }

    public function isExpired(): bool
    {
        return now()->timestamp >= $this->expiresAt;
    }
}
