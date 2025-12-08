<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkOrders>
 */
class WorkOrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'job_id' => Job::inRandomOrder()->first()?->id ?? Job::factory()->create()->id,
            'vendor_id' => User::role('vendor')->inRandomOrder()->first()?->id ?? User::inRandomOrder()->first()?->id ?? 1,
            'status' => $this->faker->randomElement([
                'pending',
                'accepted',
                'completed',
                'in_progress'
            ]),
            'deadline' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'payment_info' => $this->faker->randomElement(['quick_pay', 'regular', null]),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'note' => $this->faker->sentence(10),
        ];
    }
}
