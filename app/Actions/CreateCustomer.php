<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Filament\Auth\Notifications\VerifyEmail;
use Filament\Facades\Filament;
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
        /** @var array{0: User, 1: Team|null, 2: Collection<int, Subscription>, 3: array<int, array{0: User, 1: string}>} $context */
        $context = DB::transaction(function () use ($data): array {
            $owner = $this->createOwnerRecord($data);

            $team = ! empty($data['create_team'])
                ? $this->createTeamRecord($this->resolveTeamName($data, $owner), $owner)
                : null;

            $subscriptions = $this->createSubscriptions($owner, $data['plans'] ?? [], $team);

            $members = array_map(
                fn (array $member): array => [$this->createMemberRecord($member, $owner), $member['password']],
                $data['members'] ?? [],
            );

            return [$owner, $team, $subscriptions, $members];
        });

        [$owner, $team, $subscriptions, $members] = $context;

        $this->provisionAcrossApps($owner, $team, $subscriptions, $members, $data['password']);

        $this->sendEmailVerificationNotifications($owner, $members);

        return $owner;
    }

    /**
     * Send the same email verification notification that the public
     * registration flow sends, so the owner and every member must verify
     * their address before they can use the app. Runs after commit; the
     * notification is queued (ShouldQueue), so a queue worker must be running.
     *
     * @param  array<int, array{0: User, 1: string}>  $members
     */
    private function sendEmailVerificationNotifications(User $owner, array $members): void
    {
        $this->sendEmailVerificationNotification($owner);

        foreach ($members as [$member]) {
            $this->sendEmailVerificationNotification($member);
        }
    }

    private function sendEmailVerificationNotification(User $user): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $notification = app(VerifyEmail::class);
        $notification->url = Filament::getVerifyEmailUrl($user);

        $user->notify($notification);
    }

    /**
     * Cross-app provisioning, run AFTER the local transaction commits so a
     * rollback never leaves orphaned remote accounts (QUEUE_CONNECTION=sync
     * runs these jobs inline). The SubscriptionObserver's owner activation
     * still fires on subscription creation inside the transaction — that is
     * pre-existing shared behaviour and a toggle (not a create), so it is
     * intentionally left as-is.
     *
     * @param  Collection<int, Subscription>  $subscriptions
     * @param  array<int, array{0: User, 1: string}>  $members
     */
    private function provisionAcrossApps(User $owner, ?Team $team, Collection $subscriptions, array $members, string $ownerPassword): void
    {
        UserTeamSync::createUser(
            email: $owner->email,
            name: $owner->name,
            password: $ownerPassword,
            role: $owner->role->value,
            ownerEmail: $owner->email,
        );

        if ($team instanceof Team) {
            UserTeamSync::createTeam(
                teamName: $team->name,
                userEmail: $owner->email,
                slug: $team->slug,
                userName: $owner->name,
            );
        }

        foreach ($members as [$member, $rawPassword]) {
            foreach ($subscriptions as $subscription) {
                $this->attachMember->handle($subscription, $member, $rawPassword);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function createOwnerRecord(array $data): User
    {
        return User::query()->create([
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
        ]);
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

    /**
     * @param  array<string, mixed>  $data
     */
    private function resolveTeamName(array $data, User $owner): string
    {
        return filled($data['team_name'] ?? null) ? (string) $data['team_name'] : (string) $owner->company_name;
    }

    private function createTeamRecord(string $name, User $owner): Team
    {
        $team = Team::query()->create([
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::lower(Str::random(6)),
        ]);

        $owner->teams()->attach($team);

        return $team;
    }

    /**
     * @param  array{name: string, email: string, password: string, role: string}  $member
     */
    private function createMemberRecord(array $member, User $owner): User
    {
        return User::query()->create([
            'name' => $member['name'],
            'email' => $member['email'],
            'password' => Hash::make($member['password']),
            'role' => $member['role'],
            'company_name' => $owner->company_name,
        ]);
    }
}
