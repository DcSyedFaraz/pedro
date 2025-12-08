<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if we have users with required roles
        $customers = User::role('User')->get();
        $accountManagers = User::role('account manager')->get();

        if ($customers->isEmpty()) {
            $this->command->warn('No customers (User role) found. Using any available users as customers.');
            $customers = User::limit(10)->get();
        }

        if ($accountManagers->isEmpty()) {
            $this->command->warn('No account managers found. Using first available user or admin.');
            $accountManagers = User::limit(5)->get();
        }

        if ($customers->isEmpty() || $accountManagers->isEmpty()) {
            $this->command->error('No users found in the database. Please run CreateAdminUserSeeder first.');
            return;
        }

        $this->command->info('Creating jobs...');

        $jobStatuses = [1, 2, 3, 5, 6, 7, 8, 9, 10]; // Various job statuses
        $jobCategories = ['Plumbing', 'Electrical', 'HVAC', 'Maintenance', 'Repair', 'Installation'];
        $locations = [
            ['city' => 'New York', 'state' => 'NY', 'zipcode' => '10001'],
            ['city' => 'Los Angeles', 'state' => 'CA', 'zipcode' => '90001'],
            ['city' => 'Chicago', 'state' => 'IL', 'zipcode' => '60601'],
            ['city' => 'Houston', 'state' => 'TX', 'zipcode' => '77001'],
            ['city' => 'Phoenix', 'state' => 'AZ', 'zipcode' => '85001'],
            ['city' => 'Philadelphia', 'state' => 'PA', 'zipcode' => '19019'],
            ['city' => 'San Antonio', 'state' => 'TX', 'zipcode' => '78201'],
            ['city' => 'San Diego', 'state' => 'CA', 'zipcode' => '92101'],
            ['city' => 'Dallas', 'state' => 'TX', 'zipcode' => '75201'],
            ['city' => 'San Jose', 'state' => 'CA', 'zipcode' => '95101'],
        ];

        // Create 50 jobs
        for ($i = 0; $i < 50; $i++) {
            $customer = $customers->random();
            $accountManager = $accountManagers->random();
            $location = $locations[array_rand($locations)];
            $category = $jobCategories[array_rand($jobCategories)];

            Job::create([
                'name' => $category . ' Job #' . ($i + 1),
                'customer_id' => $customer->id,
                'estimate_id' => rand(1, 100),
                'account_manager_id' => $accountManager->id,
                'user_id' => $customer->id,
                'location_unit' => 'Unit ' . rand(1, 500),
                'location_name' => fake()->company() . ' Building',
                'location_gated_property' => rand(0, 1) ? 'Yes' : 'No',
                'location_address' => fake()->streetAddress(),
                'location_city' => $location['city'],
                'location_state' => $location['state'],
                'location_zipcode' => $location['zipcode'],
                'job_cat_id' => rand(1, 10),
                'job_sub_cat_id' => (string) rand(1, 20),
                'job_description' => 'Job description for ' . $category . ': ' . fake()->sentence(20),
                'job_sub_description' => fake()->paragraph(3),
                'po_no' => 'PO-' . fake()->unique()->numerify('######'),
                'job_source' => fake()->randomElement(['Phone', 'Email', 'Web', 'Walk-in', 'Referral']),
                'agent' => fake()->name(),
                // Primary Contact
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'phone' => json_encode([fake()->phoneNumber()]),
                'ext_id' => rand(1, 999),
                'ext' => json_encode([fake()->numerify('###')]),
                'email' => json_encode([fake()->safeEmail()]),
                // Custom fields
                'customer_homeowner' => fake()->name(),
                'customer_unit_cordination' => fake()->name(),
                // Job information
                'current_status' => $jobStatuses[array_rand($jobStatuses)],
                'start_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'start_duration' => rand(1, 8) . ' hours',
                'end_duration' => rand(1, 8) . ' hours',
                'end_date' => now()->addDays(rand(31, 60))->format('Y-m-d'),
                'multe_job' => rand(0, 1) ? 'yes' : 'no',
                'start_time' => fake()->time('H:i'),
                'end_time' => fake()->time('H:i'),
                'time_duration' => rand(1, 8) . ' hours',
                'job_priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Urgent']),
                'assigned_tech' => fake()->name(),
                'notify_tech_assign' => fake()->randomElement(['on', 'off']),
                'notes_for_tech' => fake()->paragraph(2),
                'scheduled_at' => now()->addDays(rand(1, 30))->format('Y-m-d H:i:s'),
                'completion_notes' => rand(0, 1) ? fake()->paragraph() : null,
                'image' => null, // We'll leave images null for seeder
                'document' => null,
                'billable' => fake()->randomElement(['yes', 'no']),
                'mark_description' => fake()->paragraph(),
                'note_to_cust' => fake()->sentence(),
            ]);

            if (($i + 1) % 10 == 0) {
                $this->command->info("Created " . ($i + 1) . " jobs...");
            }
        }

        $totalJobs = Job::count();
        $this->command->info("Successfully created jobs. Total jobs in database: {$totalJobs}");
    }
}
