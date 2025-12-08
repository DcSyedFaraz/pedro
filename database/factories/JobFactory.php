<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customer = User::role('User')->inRandomOrder()->first()
                    ?? User::inRandomOrder()->first()
                    ?? User::factory()->create();

        $accountManager = User::role('account manager')->inRandomOrder()->first()
                          ?? User::inRandomOrder()->first()
                          ?? User::factory()->create();

        return [
            'name' => $this->faker->words(3, true),
            'customer_id' => $customer->id,
            'estimate_id' => $this->faker->numberBetween(1, 1000),
            'account_manager_id' => $accountManager->id,
            'user_id' => $customer->id,
            'location_unit' => 'Unit ' . $this->faker->numberBetween(1, 500),
            'location_name' => $this->faker->company . ' Building',
            'location_gated_property' => $this->faker->randomElement(['Yes', 'No']),
            'location_address' => $this->faker->streetAddress,
            'location_city' => $this->faker->city,
            'location_state' => $this->faker->stateAbbr,
            'location_zipcode' => $this->faker->postcode,
            'job_cat_id' => $this->faker->numberBetween(1, 10),
            'job_sub_cat_id' => (string) $this->faker->numberBetween(1, 20),
            'job_description' => $this->faker->paragraph,
            'job_sub_description' => $this->faker->paragraph,
            'po_no' => 'PO-' . $this->faker->numerify('######'),
            'job_source' => $this->faker->randomElement(['Phone', 'Email', 'Web', 'Walk-in', 'Referral']),
            'agent' => $this->faker->name,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => json_encode([$this->faker->phoneNumber]),
            'ext_id' => $this->faker->numberBetween(1, 999),
            'ext' => json_encode([$this->faker->numerify('###')]),
            'email' => json_encode([$this->faker->safeEmail]),
            'customer_homeowner' => $this->faker->name,
            'customer_unit_cordination' => $this->faker->name,
            'current_status' => $this->faker->numberBetween(1, 10),
            'start_date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'start_duration' => $this->faker->numberBetween(1, 8) . ' hours',
            'end_duration' => $this->faker->numberBetween(1, 8) . ' hours',
            'end_date' => $this->faker->dateTimeBetween('+31 days', '+60 days')->format('Y-m-d'),
            'multe_job' => $this->faker->randomElement(['yes', 'no']),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'time_duration' => $this->faker->numberBetween(1, 8) . ' hours',
            'job_priority' => $this->faker->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'assigned_tech' => $this->faker->name,
            'notify_tech_assign' => $this->faker->randomElement(['on','off']),
            'notes_for_tech' => $this->faker->paragraph,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d H:i:s'),
            'completion_notes' => $this->faker->optional()->paragraph,
            'image' => null,
            'document' => null,
            'billable' => $this->faker->randomElement(['yes', 'no']),
            'mark_description' => $this->faker->paragraph,
            'note_to_cust' => $this->faker->sentence,
        ];
    }
}
