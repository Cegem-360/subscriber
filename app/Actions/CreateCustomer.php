<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Facades\UserTeamSync;

final class CreateCustomer
{
    public function __construct(
        private readonly AttachSubscriptionMember $attachMember,
    ) {}

    /**
     * @param array{
     *   name: string, email: string, password: string, role: string,
     *   company_name: string, tax_number: string, address: string,
     *   city: string, postal_code: string, country: string,
     *   plans: array<int, array{plan_id: int|string, quantity: int|string}>,
     *   create_team: bool, team_name: string|null,
     *   members: array<int, array{name: string, email: string, password: string, role: string}>,
     * } $data
     */
    public function handle(array $data): User
    {
        return DB::transaction(function () use ($data): User {
            $owner = $this->createOwner($data);

            $team = ! empty($data['create_team'])
                ? $this->createTeam($this->resolveTeamName($data, $owner), $owner)
                : null;

            $subscriptions = $this->createSubscriptions($owner, $data['plans'] ?? [], $team);

            foreach ($data['members'] ?? [] as $member) {
                $this->createMember($member, $owner, $subscriptions);
            }

            return $owner;
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function createOwner(array $data): User
    {
        $owner = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'company_name' => $data['company_name'],
            'tax_number' => $data['tax_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
            'email_verified_at' => now(),
        ]);

        UserTeamSync::createUser(
            email: $owner->email,
            name: $owner->name,
            password: $data['password'],
            role: $owner->role->value,
            ownerEmail: $owner->email,
        );

        return $owner;
    }

    /**
     * @param  array<int, array{plan_id: int|string, quantity: int|string}>  $plans
     * @return Collection<int, Subscription>
     */
    private function createSubscriptions(User $owner, array $plans, ?Team $team): Collection
    {
        return collect($plans)->map(function (array $row) use ($owner, $team): Subscription {
            $plan = Plan::query()->findOrFail($row['plan_id']);

            return Subscription::query()->create([
                'user_id' => $owner->id,
                'plan_id' => $plan->id,
                'team_id' => $team?->id,
                'type' => SubscriptionType::Default,
                'stripe_id' => 'manual_' . Str::uuid()->toString(),
                'stripe_status' => SubscriptionStatus::Active,
                'stripe_price' => $plan->stripe_price_id,
                'quantity' => (int) $row['quantity'],
            ]);
        })->values();
    }

    // --- Team + member helpers filled in by later tasks ---

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolveTeamName(array $data, User $owner): string
    {
        return filled($data['team_name'] ?? null) ? (string) $data['team_name'] : (string) $owner->company_name;
    }

    private function createTeam(string $name, User $owner): Team
    {
        $team = Team::query()->create([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::lower(Str::random(6)),
        ]);

        $owner->teams()->attach($team);

        UserTeamSync::createTeam(
            teamName: $team->name,
            userEmail: $owner->email,
            userName: $owner->name,
        );

        return $team;
    }

    /**
     * @param  array{name: string, email: string, password: string, role: string}  $member
     * @param  Collection<int, Subscription>  $subscriptions
     */
    private function createMember(array $member, User $owner, Collection $subscriptions): void
    {
        $user = User::query()->create([
            'name' => $member['name'],
            'email' => $member['email'],
            'password' => Hash::make($member['password']),
            'role' => $member['role'],
            'company_name' => $owner->company_name,
            'email_verified_at' => now(),
        ]);

        foreach ($subscriptions as $subscription) {
            $this->attachMember->handle($subscription, $user, $member['password']);
        }
    }
}
