<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use App\Models\WorkOrders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get vendors (users with vendor role)
        $vendors = User::role('vendor')->get();

        // If no vendors exist, get any users or create test vendors
        if ($vendors->isEmpty()) {
            $vendors = User::limit(5)->get();

            if ($vendors->isEmpty()) {
                $this->command->error('No users found in the database. Please create users first.');
                return;
            }
        }

        // Get jobs
        $jobs = Job::limit(20)->get();

        if ($jobs->isEmpty()) {
            $this->command->error('No jobs found in the database. Please create jobs first.');
            return;
        }

        $statuses = ['pending', 'accepted', 'completed', 'in_progress'];
        $priorities = ['low', 'medium', 'high', 'urgent'];

        $this->command->info('Creating work orders...');

        // Create work orders for each vendor
        foreach ($vendors as $vendor) {
            // Create 5-10 work orders per vendor
            $count = rand(5, 10);

            for ($i = 0; $i < $count; $i++) {
                $job = $jobs->random();

                // Avoid declined status to ensure data shows up in the index
                $status = $statuses[array_rand($statuses)];

                WorkOrders::create([
                    'job_id' => $job->id,
                    'vendor_id' => $vendor->id,
                    'status' => $status,
                    'deadline' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'payment_info' => rand(0, 1) ? 'quick_pay' : 'regular',
                    'priority' => $priorities[array_rand($priorities)],
                    'note' => 'Test work order ' . ($i + 1) . ' for vendor ' . $vendor->name,
                ]);
            }

            $this->command->info("Created {$count} work orders for vendor: {$vendor->name} (ID: {$vendor->id})");
        }

        // Create some declined work orders (these should NOT show in vendor index)
        foreach ($vendors->take(2) as $vendor) {
            $job = $jobs->random();

            WorkOrders::create([
                'job_id' => $job->id,
                'vendor_id' => $vendor->id,
                'status' => 'declined',
                'deadline' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'payment_info' => 'regular',
                'priority' => 'low',
                'note' => 'Declined work order for testing - should not appear in vendor index',
            ]);

            $this->command->info("Created 1 declined work order for vendor: {$vendor->name} (ID: {$vendor->id})");
        }

        $totalWorkOrders = WorkOrders::count();
        $this->command->info("Successfully created work orders. Total work orders in database: {$totalWorkOrders}");
        $this->command->info("To test the API, authenticate as one of these vendor IDs: " . $vendors->pluck('id')->join(', '));
    }
}
