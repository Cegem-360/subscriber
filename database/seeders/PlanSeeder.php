<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BillingPeriod;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => 'basic',
                'description' => 'Perfect for getting started with our platform',
                'price' => 9.99,
                'billing_period' => BillingPeriod::Monthly,
                'stripe_price_id' => null, // Set this after creating in Stripe
                'stripe_product_id' => null,
                'features' => [
                    '100 API requests per minute',
                    'Email support',
                    'Basic analytics',
                    '1 microservice access',
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pro Plan',
                'slug' => 'pro',
                'description' => 'Best for growing teams and businesses',
                'price' => 29.99,
                'billing_period' => BillingPeriod::Monthly,
                'stripe_price_id' => null,
                'stripe_product_id' => null,
                'features' => [
                    '500 API requests per minute',
                    'Priority email support',
                    'Advanced analytics',
                    '2 microservice access',
                    'Custom integrations',
                ],

                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise Plan',
                'slug' => 'enterprise',
                'description' => 'For large organizations with custom needs',
                'price' => 99.99,
                'billing_period' => BillingPeriod::Monthly,
                'stripe_price_id' => null,
                'stripe_product_id' => null,
                'features' => [
                    'Unlimited API requests',
                    'Dedicated account manager',
                    'Premium support',
                    'All microservice access',
                    'Custom integrations',
                    'SLA guarantee',
                ],

                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $planData) {
            Plan::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData,
            );
        }
    }
}
