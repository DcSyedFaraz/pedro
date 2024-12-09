<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\ChecklistItem;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateRequest;
use App\Models\InspectionChecklist;
use App\Models\Job;
use App\Models\Location;
use App\Models\WorkOrders;
use Database\Factories\ChecklistItemFactory;
use Database\Factories\CustomerFactory;
use Database\Factories\InspectionChecklistFactory;
use Database\Factories\JobFactory;
use Database\Factories\WorkOrdersFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(1)->admin()->create();
        User::factory()->count(1)->user()->create();
        User::factory()->count(1)->manager()->create();
        User::factory()->count(1)->vendor()->create();

        // Job::factory(1)->create();
        // WorkOrders::factory(1)->create();
        // Customer::factory(1)->create();
        // InspectionChecklist::factory(1)->create();
        // ChecklistItem::factory(2)->create();
        // Location::factory(2)->create();
        // Estimate::factory(2)->create();
        // EstimateRequest::factory(2)->create();
        // Bid::factory(2)->create();
    }
}
