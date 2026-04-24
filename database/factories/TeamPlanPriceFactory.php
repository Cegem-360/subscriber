<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Team;
use App\Models\TeamPlanPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TeamPlanPrice>
 */
class TeamPlanPriceFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $priceHuf = $this->faker->randomElement([100000, 150000, 200000, 300000, 400000]);

        return [
            'team_id' => Team::factory(),
            'plan_id' => Plan::factory(),
            'price' => $priceHuf,
            'price_eur' => (int) round($priceHuf / 400),
            'stripe_price_id' => null,
            'stripe_price_id_eur' => null,
        ];
    }
}
