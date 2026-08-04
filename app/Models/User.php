<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Override;

#[Fillable([
    'uuid',
    'name',
    'email',
    'password',
    'role',
    'company_name',
    'tax_number',
    'address',
    'city',
    'postal_code',
    'country',
    'stripe_id',
    'billingo_partner_id',
])]
#[Hidden([
    'password',
    'remember_token',
])]
final class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected static function booted(): void
    {
        self::creating(function (self $user): void {
            $user->uuid ??= (string) Str::uuid();
        });
    }

    #[Override]
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function apiTokens(): HasMany
    {
        return $this->hasMany(ApiToken::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isSubscriber(): bool
    {
        return $this->role === UserRole::Subscriber;
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function memberSubscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }

    /**
     * Subscriptions the user can access. A member mirrors the main account: they
     * see every subscription owned by any account whose subscription they belong
     * to, plus their own. Bypasses the owner-only global scope on purpose, since
     * it is explicitly constrained to the resolved owner ids.
     */
    public function accessibleSubscriptions(): Builder
    {
        $ownerIds = Subscription::query()
            ->withoutGlobalScopes()
            ->whereHas('members', fn (Builder $members) => $members->whereKey($this->id))
            ->pluck('user_id')
            ->push($this->id)
            ->unique()
            ->all();

        return Subscription::query()
            ->withoutGlobalScopes()
            ->whereIn('subscriptions.user_id', $ownerIds);
    }

    /**
     * Distinct app keys (plan category slugs) the user should be active on,
     * derived from every module of every main account they belong to.
     *
     * @return array<int, string>
     */
    public function accessibleAppKeys(): array
    {
        return $this->accessibleSubscriptions()
            ->activeSubscription()
            ->with('plan.planCategory')
            ->get()
            ->map(fn (Subscription $subscription): ?string => $subscription->plan?->planCategory?->slug)
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function isManager(): bool
    {
        return $this->role === UserRole::Manager;
    }

    /**
     * Scope to accounts within the owner's organization (sharing a team), so a
     * manager can only attach accounts from their own organization.
     */
    #[Scope]
    protected function inOrganizationOf(Builder $query, ?User $owner): void
    {
        $teamIds = $owner?->teams()->pluck('teams.id')->all() ?? [];

        $query->whereHas('teams', fn (Builder $teams) => $teams->whereIn('teams.id', $teamIds));
    }

    public function hasValidVerificationHash(string $hash): bool
    {
        return hash_equals($hash, hash('sha1', $this->getEmailForVerification()));
    }
}
