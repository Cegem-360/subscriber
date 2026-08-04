<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\LegalDocument;
use App\Models\User;

final class RecordLegalAcceptance
{
    /**
     * Store one auditable row per accepted legal document, stamping the
     * effective date of the version the user was shown, so a later revision of
     * the document cannot retroactively change what they agreed to.
     *
     * @param  list<LegalDocument>  $documents
     */
    public function handle(
        User $user,
        array $documents,
        string $context,
        ?string $ipAddress = null,
        ?string $userAgent = null,
    ): void {
        $acceptedAt = now();

        foreach ($documents as $document) {
            $user->legalAcceptances()->create([
                'document' => $document,
                'document_effective_at' => $document->effectiveAt(),
                'context' => $context,
                'accepted_at' => $acceptedAt,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
            ]);
        }
    }
}
