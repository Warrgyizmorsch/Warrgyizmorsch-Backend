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
            ['name' => 'Archive Leads', 'route_name' => 'archive.leads.index'],
            ['name' => 'Archive Single Lead', 'route_name' => 'archive.leads.archive'],
            ['name' => 'Bulk Archive Leads', 'route_name' => 'archive.leads.bulkArchive'],
            ['name' => 'Restore Single Lead', 'route_name' => 'archive.leads.restore'],
            ['name' => 'Bulk Restore Leads', 'route_name' => 'archive.leads.bulkRestore'],
            ['name' => 'Bulk Delete Archive Leads', 'route_name' => 'archive.leads.bulkDelete'],
            ['name' => 'Archive Deals', 'route_name' => 'archive.deals.index'],
            ['name' => 'Archive Single Deal', 'route_name' => 'archive.deals.archive'],
            ['name' => 'Bulk Archive Deals', 'route_name' => 'archive.deals.bulkArchive'],
            ['name' => 'Restore Single Deal', 'route_name' => 'archive.deals.restore'],
            ['name' => 'Bulk Restore Deals', 'route_name' => 'archive.deals.bulkRestore'],
            ['name' => 'Bulk Delete Archive Deals', 'route_name' => 'archive.deals.bulkDelete'],
            ['name' => 'Bulk Delete Leads', 'route_name' => 'leads.bulkDelete'],
            ['name' => 'Archive Lead Action', 'route_name' => 'lead.archive'],
            ['name' => 'Restore Lead Action', 'route_name' => 'lead.restore'],
            ['name' => 'List Users', 'route_name' => 'users.index'],
            ['name' => 'Add User', 'route_name' => 'users.create'],
            ['name' => 'Login History', 'route_name' => 'users.session'],
            ['name' => 'Roles', 'route_name' => 'roles.index'],
            ['name' => 'Routes', 'route_name' => 'routes.index'],
            ['name' => 'Menus', 'route_name' => 'menus.index'],
            ['name' => 'Role Permissions', 'route_name' => 'role-permissions.index'],
            ['name' => 'User Permissions', 'route_name' => 'user-permissions.index'],
            ['name' => 'All Blog', 'route_name' => 'blog.index'],
            ['name' => 'Add Blog', 'route_name' => 'blog.create'],
            ['name' => 'Author', 'route_name' => 'author.index'],
            ['name' => 'Warrgyizmorsch Leads', 'route_name' => 'warr-leads.index'],
            ['name' => 'Warr Service Pages All', 'route_name' => 'warr-service-pages.index'],
            ['name' => 'Warr Service Pages Create', 'route_name' => 'warr-service-pages.create'],
            ['name' => 'Warr Services', 'route_name' => 'warr-services.index'],
            ['name' => 'Warr Countries', 'route_name' => 'warr-countries.index'],
            ['name' => 'Warr Cities', 'route_name' => 'warr-cities.index'],
            ['name' => 'Daily Report', 'route_name' => 'lead.dailyReport'],
            ['name' => 'New Daily Report', 'route_name' => 'lead.newdailyReport'],
            ['name' => 'Kpi Report', 'route_name' => 'lead.followUpData'],
            ['name' => 'Counsellor Report', 'route_name' => 'lead.councillorReport'],
            ['name' => 'Source Report', 'route_name' => 'lead.sourcePerformance'],
            ['name' => 'Campaign Report', 'route_name' => 'lead.campaignPerformance'],
            ['name' => 'Lead Activities', 'route_name' => 'lead.leadActivity'],
            ['name' => 'Modern Lead', 'route_name' => 'modern.leads.index'],
            ['name' => 'Store Blog', 'route_name' => 'blog.store'],
            ['name' => 'Edit Blog', 'route_name' => 'blog.edit'],
            ['name' => 'Update Blog', 'route_name' => 'blog.update'],
            ['name' => 'Delete Blog', 'route_name' => 'blog.destroy'],
            ['name' => 'Store Author', 'route_name' => 'author.store'],
            ['name' => 'Edit Author', 'route_name' => 'author.edit'],
            ['name' => 'Delete Author', 'route_name' => 'author.destroy'],
            ['name' => 'Update Warr Lead', 'route_name' => 'warr-leads.updateWarrLead'],
            ['name' => 'Store Service Page', 'route_name' => 'warr-service-pages.store'],
            ['name' => 'Edit Service Page', 'route_name' => 'warr-service-pages.edit'],
            ['name' => 'Update Service Page', 'route_name' => 'warr-service-pages.update'],
            ['name' => 'Delete Service Page', 'route_name' => 'warr-service-pages.delete'],
            ['name' => 'Service Page Cities', 'route_name' => 'warr-service-pages.cities'],
            ['name' => 'Store Warr Country', 'route_name' => 'warr-countries.store'],
            ['name' => 'Delete Warr Country', 'route_name' => 'warr-countries.destroy'],
            ['name' => 'Store Warr City', 'route_name' => 'warr-cities.store'],
            ['name' => 'Delete Warr City', 'route_name' => 'warr-cities.destroy'],
            ['name' => 'Store Warr Service', 'route_name' => 'warr-services.store'],
            ['name' => 'Delete Warr Service', 'route_name' => 'warr-services.destroy'],
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
