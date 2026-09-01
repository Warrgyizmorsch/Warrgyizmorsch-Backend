<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Route; // your Route model

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            ['name' => 'Dashboard', 'route_name' => 'dashboard'],
            ['name' => 'Status Master', 'route_name' => 'bucket.index'],
            ['name' => 'Lead Questions', 'route_name' => 'lead_questions.index'],
            ['name' => 'Lead Sources', 'route_name' => 'lead_sources.index'],
            ['name' => 'Service Master', 'route_name' => 'category.index'],
            ['name' => 'Tag Master', 'route_name' => 'tags.index'],
            ['name' => 'New Leads Table', 'route_name' => 'leads.table.index'],
            ['name' => 'Pipeline Lead', 'route_name' => 'leads.table.pipeline'],
            ['name' => 'Created Deals', 'route_name' => 'created.deals.index'],
            ['name' => 'Pipeline Deal', 'route_name' => 'created.deals.pipeline'],
            ['name' => 'Follow-ups', 'route_name' => 'followups.index'],
        ];

        foreach ($routes as $route) {
            Route::updateOrCreate(
                ['route_name' => $route['route_name']],
                [
                    'name' => $route['name'],
                    'method' => 'get',
                    'is_deleted' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
