<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

/**
 * Thrown when a row that is required to carry a stable public identifier
 * (uuid) does not have one yet.
 *
 * The uuid columns on users and teams are nullable on purpose: rows that
 * existed before the identity migration are filled in later by a separate
 * backfill command. Emitting a null identifier from the identity provider
 * would hand downstream apps a broken primary key, so this fails loudly
 * instead of silently substituting or dropping data.
 */
final class MissingUuidException extends RuntimeException
{
    public static function forUser(int $id): self
    {
        return new self("User #{$id} has no uuid yet; it has not been backfilled.");
    }

    public static function forTeam(int $id): self
    {
        return new self("Team #{$id} has no uuid yet; it has not been backfilled.");
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(['message' => $this->getMessage()], 500);
    }
}
