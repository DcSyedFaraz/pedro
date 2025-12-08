<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run seeders in the correct order:
        // 1. Permissions and Users first (required for all other data)
        // 2. Jobs (requires Users)
        // 3. WorkOrders (requires both Jobs and Users/Vendors)

        $this->call([
            // PermissionTableSeeder::class,
            // CreateAdminUserSeeder::class,
            // Uncomment below to seed Jobs and WorkOrders automatically
            JobSeeder::class,
            WorkOrdersSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
