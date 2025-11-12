<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $token
 * @property array<array-key, mixed>|null $abilities
 * @property \Carbon\CarbonImmutable|null $last_used_at
 * @property \Carbon\CarbonImmutable|null $expires_at
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ApiTokenFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereAbilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ApiToken whereUserId($value)
 */
	class ApiToken extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int|null $subscription_id
 * @property string|null $stripe_invoice_id
 * @property string|null $stripe_payment_intent_id
 * @property string|null $billingo_invoice_id
 * @property string|null $invoice_number
 * @property numeric $amount
 * @property string $currency
 * @property \App\Enums\InvoiceStatus $status
 * @property \Carbon\CarbonImmutable|null $billingo_synced_at
 * @property string|null $pdf_path
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Subscription|null $subscription
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\InvoiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice paid()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereBillingoInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereBillingoSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice wherePdfPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStripeInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStripePaymentIntentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUserId($value)
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $subscription_id
 * @property string $microservice_name
 * @property string $microservice_slug
 * @property bool $is_active
 * @property \Carbon\CarbonImmutable|null $activated_at
 * @property \Carbon\CarbonImmutable|null $expires_at
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Subscription $subscription
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission expired()
 * @method static \Database\Factories\MicroservicePermissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereMicroserviceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereMicroserviceSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MicroservicePermission whereUpdatedAt($value)
 */
	class MicroservicePermission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property numeric $price
 * @property \App\Enums\BillingPeriod $billing_period
 * @property string|null $stripe_price_id
 * @property string|null $stripe_product_id
 * @property array<array-key, mixed>|null $features
 * @property array<array-key, mixed>|null $microservices
 * @property bool $is_active
 * @property int $sort_order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan active()
 * @method static \Database\Factories\PlanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereBillingPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereMicroservices($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereStripePriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $stripe_id
 * @property \App\Enums\SubscriptionStatus $stripe_status
 * @property string|null $stripe_price
 * @property int|null $quantity
 * @property \Carbon\CarbonImmutable|null $trial_ends_at
 * @property \Carbon\CarbonImmutable|null $ends_at
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int|null $plan_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\SubscriptionItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $localInvoices
 * @property-read int|null $local_invoices_count
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MicroservicePermission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\Plan|null $plan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription canceled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription ended()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription expiredTrial()
 * @method static \Laravel\Cashier\Database\Factories\SubscriptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription incomplete()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription notCanceled()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription notOnGracePeriod()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription notOnTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription onGracePeriod()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription onTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription pastDue()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription recurring()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereStripePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereUserId($value)
 */
	class Subscription extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string|null $stripe_customer_id
 * @property string|null $billingo_partner_id
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property \App\Enums\UserRole $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ApiToken> $apiTokens
 * @property-read int|null $api_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User hasExpiredGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBillingoPartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePmLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStripeCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	final class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser, \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

