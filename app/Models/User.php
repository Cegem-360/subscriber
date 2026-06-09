<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Override;

#[Fillable([
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
    use HasFactory;
    use Notifiable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
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
     * Subscriptions the user can access: those they own plus those they are a
     * member of. Bypasses the owner-only global scope on purpose, since it is
     * explicitly constrained to this user.
     */
    public function accessibleSubscriptions(): Builder
    {
        return Subscription::query()
            ->withoutGlobalScopes()
            ->where(function (Builder $query): void {
                $query->where('subscriptions.user_id', $this->id)
                    ->orWhereHas('members', fn (Builder $members) => $members->whereKey($this->id));
            });
    }

    public function isManager(): bool
    {
        return $this->role === UserRole::Manager;
    }

    public function hasValidVerificationHash(string $hash): bool
    {
        return hash_equals($hash, hash('sha1', $this->getEmailForVerification()));
    }
}
