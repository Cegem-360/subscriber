<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\LegalDocument;
use Database\Factories\LegalAcceptanceFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

/**
 * An auditable record of a user accepting a legal document at a point in time.
 * Every acceptance is its own row, so a later revision of the document never
 * overwrites the evidence of what the user actually agreed to.
 */
#[Fillable([
    'user_id',
    'document',
    'document_effective_at',
    'context',
    'accepted_at',
    'ip_address',
    'user_agent',
])]
class LegalAcceptance extends Model
{
    /** @use HasFactory<LegalAcceptanceFactory> */
    use HasFactory;

    #[Override]
    protected function casts(): array
    {
        return [
            'document' => LegalDocument::class,
            'document_effective_at' => 'date',
            'accepted_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
