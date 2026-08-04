<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;

enum LegalDocument: string implements HasLabel
{
    case TermsOfService = 'terms_of_service';
    case PrivacyPolicy = 'privacy_policy';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::TermsOfService => __('Terms of service'),
            self::PrivacyPolicy => __('Privacy notice'),
        };
    }

    /**
     * The effective date of the currently published version of the document.
     */
    public function effectiveAt(): Carbon
    {
        return Carbon::parse(match ($this) {
            self::TermsOfService => config('legal.terms.effective_at'),
            self::PrivacyPolicy => config('legal.privacy.effective_at'),
        });
    }

    public function routeName(): string
    {
        return match ($this) {
            self::TermsOfService => 'legal.szolgaltatasi-feltetelek',
            self::PrivacyPolicy => 'legal.adatvedelmi-tajekoztato',
        };
    }
}
