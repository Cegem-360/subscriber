<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\SubscriptionStatus;
use App\Enums\SubscriptionType;
use App\Mail\CustomerCredentialsMail;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Madbox99\UserTeamSync\Facades\UserTeamSync;
use Madbox99\UserTeamSync\Publisher\Jobs\ToggleUserActiveJob;

final readonly class CreateCustomer
{
    public function __construct(
        private AttachSubscriptionMember $attachMember,
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

            $team = empty($data['create_team'])
                ? null
                : $this->createTeamRecord($this->resolveTeamName($data, $owner), $owner);

            $subscriptions = $this->createSubscriptions($owner, $data['plans'] ?? [], $team);

            $members = array_map(
                fn (array $member): array => [$this->createMemberRecord($member, $owner), $member['password']],
                $data['members'] ?? [],
            );

            return [$owner, $team, $subscriptions, $members];
        });

        [$owner, $team, $subscriptions, $members] = $context;

        $this->provisionAcrossApps($owner, $team, $subscriptions, $members, $data['password']);

        $this->sendCredentialEmails($owner, $data['password'], $members, $subscriptions);

        return $owner;
    }

    /**
     * Email login credentials (address + raw password) to the owner and every
     * member so they can sign in — the admin sets these passwords in the wizard,
     * so the customers have no other way to learn them. Runs after commit; the
     * mailable is queued (ShouldQueue), so a queue worker must be running.
     *
     * @param  array<int, array{0: User, 1: string}>  $members
     * @param  Collection<int, Subscription>  $subscriptions
     */
    private function sendCredentialEmails(User $owner, string $ownerPassword, array $members, Collection $subscriptions): void
    {
        $modules = $this->resolveModules($subscriptions);

        $this->sendCredentialEmail($owner, $ownerPassword, $modules);

        foreach ($members as [$member, $rawPassword]) {
            $this->sendCredentialEmail($member, $rawPassword, $modules);
        }
    }

    /**
     * @param  array<int, array{name: string, url: string|null, icon: string|null}>  $modules
     */
    private function sendCredentialEmail(User $user, string $rawPassword, array $modules): void
    {
        Mail::to($user->email)->send(new CustomerCredentialsMail(
            name: $user->name,
            email: $user->email,
            password: $rawPassword,
            loginUrl: (string) Filament::getLoginUrl(),
            modules: $modules,
        ));
    }

    /**
     * The active modules the customer gains access to, taken from the plan
     * category behind each subscription (name, direct URL and icon).
     *
     * @param  Collection<int, Subscription>  $subscriptions
     * @return array<int, array{name: string, url: string|null, icon: string|null}>
     */
    private function resolveModules(Collection $subscriptions): array
    {
        return $subscriptions
            ->map(fn (Subscription $subscription) => $subscription->plan?->planCategory)
            ->filter()
            ->unique('id')
            ->map(fn ($category): array => [
                'name' => (string) $category->name,
                'url' => $category->url,
                'icon' => $category->icon,
            ])
            ->values()
            ->all();
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
            uuid: $owner->uuid,
        );

        if ($team instanceof Team) {
            UserTeamSync::createTeam(
                teamName: $team->name,
                userEmail: $owner->email,
                slug: $team->slug,
                userName: $owner->name,
                uuid: $team->uuid,
            );
        }

        $this->activateOwnerAcrossApps($owner, $subscriptions);

        foreach ($members as [$member, $rawPassword]) {
            foreach ($subscriptions as $subscription) {
                $this->attachMember->handle($subscription, $member, $rawPassword);
            }
        }
    }

    /**
     * Activate the owner on every sub-app they hold a subscription for. Dispatched
     * with a delay so it runs only after the CreateUserJob above has synced the
     * owner to the receiver apps — otherwise the toggle updates zero rows and the
     * owner is left inactive (locked out by the active-subscription middleware).
     *
     * @param  Collection<int, Subscription>  $subscriptions
     */
    private function activateOwnerAcrossApps(User $owner, Collection $subscriptions): void
    {
        $appKeys = $subscriptions
            ->map(fn (Subscription $subscription): ?string => $subscription->plan?->planCategory?->slug)
            ->filter()
            ->unique();

        foreach ($appKeys as $appKey) {
            dispatch(new ToggleUserActiveJob(userEmail: $owner->email, isActive: true, appKey: $appKey))
                ->delay(now()->addSeconds(20));
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
            'email_verified_at' => now(),
        ]);
    }

    /**
     * @param  array<int, array{plan_id: int|string, quantity: int|string}>  $plans
     * @return Collection<int, Subscription>
     */
    private function createSubscriptions(User $owner, array $plans, ?Team $team): Collection
    {
        // Suppress the SubscriptionObserver's activation toggle here: it would
        // fire inside the transaction, before the owner is synced to the sub-apps,
        // so the toggle would hit a not-yet-existing user and silently no-op. The
        // owner is activated explicitly after the sync in activateOwnerAcrossApps().
        return Subscription::withoutEvents(fn (): Collection => collect($plans)->map(function (array $row) use ($owner, $team): Subscription {
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
        })->values());
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
            'email_verified_at' => now(),
        ]);
    }
}
