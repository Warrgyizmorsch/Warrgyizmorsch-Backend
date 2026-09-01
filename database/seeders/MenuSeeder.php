<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $now = now();

            // 1. Delete Order Master & standalone Pipeline Lead from menus & role_permissions
            $deleteTitles = ['%Order Master%', '%Pipeline Lead%'];
            foreach ($deleteTitles as $titlePattern) {
                $menuIds = DB::table('menus')->where('title', 'LIKE', $titlePattern)->pluck('id')->toArray();
                if (!empty($menuIds)) {
                    DB::table('role_permissions')->whereIn('menu_id', $menuIds)->delete();
                    DB::table('user_permissions')->whereIn('menu_id', $menuIds)->delete();
                    DB::table('menus')->whereIn('id', $menuIds)->delete();
                }
            }

            // Helper to get route ID by route_name
            $getRouteId = function (string $routeName) {
                return DB::table('routes')->where('route_name', $routeName)->value('id');
            };

            // 1. Dashboard (Lead Pipeline Dashboard)
            $dashboardRouteId = $getRouteId('dashboard');
            $this->upsertMenu('Dashboard', null, 'feather-home', $dashboardRouteId, 1, $now);

            // 2. Management (Parent)
            $managementId = $this->upsertMenu('Management', null, 'feather-settings', null, 2, $now);

            // Management -> Submenus
            $this->upsertMenu('Roles', $managementId, 'feather-user-check', null, 1, $now);
            $this->upsertMenu('Routes', $managementId, 'feather-git-commit', null, 2, $now);
            $this->upsertMenu('Menus', $managementId, 'feather-menu', null, 3, $now);

            // 3. Users (Parent)
            $usersId = $this->upsertMenu('Users', null, 'feather-users', null, 3, $now);

            // Users -> Submenus
            $this->upsertMenu('Add User', $usersId, 'feather-user-plus', null, 1, $now);
            $this->upsertMenu('List Users', $usersId, 'feather-list', null, 2, $now);

            // 4. Permissions (Parent)
            $this->upsertMenu('Permissions', null, 'feather-lock', null, 4, $now);

            // 5. Master (Parent)
            $masterId = $this->upsertMenu('Master', null, 'feather-database', null, 5, $now);

            // Master -> Submenus
            $masterChildren = [
                ['title' => 'Status Master', 'route' => 'bucket.index', 'icon' => 'feather-layers', 'sort' => 1],
                ['title' => 'Attribute', 'route' => 'lead_questions.index', 'icon' => 'feather-sliders', 'sort' => 2],
                ['title' => 'Lead Source', 'route' => 'lead_sources.index', 'icon' => 'feather-share-2', 'sort' => 3],
                ['title' => 'Service', 'route' => 'category.index', 'icon' => 'feather-grid', 'sort' => 4],
                ['title' => 'Tag Master', 'route' => 'tags.index', 'icon' => 'feather-tag', 'sort' => 5],
            ];

            foreach ($masterChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $masterId, $child['icon'], $routeId, $child['sort'], $now);
            }

            // 6. Lead (Table View)
            $leadRouteId = $getRouteId('leads.table.index');
            $this->upsertMenu('Lead', null, 'feather-users', $leadRouteId, 6, $now);

            // 7. Deal
            $dealRouteId = $getRouteId('created.deals.index');
            $this->upsertMenu('Deal', null, 'feather-briefcase', $dealRouteId, 7, $now);

            // 8. Follow-ups
            $followupRouteId = $getRouteId('followups.index');
            $this->upsertMenu('Follow-ups', null, 'feather-calendar', $followupRouteId, 8, $now);

            // 9. Lead Report (Parent)
            $reportId = $this->upsertMenu('Lead Report', null, 'feather-bar-chart-2', null, 9, $now);
            $reportChildren = [
                ['title' => 'Daily Report', 'route' => 'lead.dailyReport', 'icon' => 'feather-file-text', 'sort' => 1],
                ['title' => 'New Daily Report', 'route' => 'lead.newdailyReport', 'icon' => 'feather-file-plus', 'sort' => 2],
                ['title' => 'Kpi Report', 'route' => 'lead.followUpData', 'icon' => 'feather-pie-chart', 'sort' => 3],
                ['title' => 'Counsellor Report', 'route' => 'lead.councillorReport', 'icon' => 'feather-user-check', 'sort' => 4],
                ['title' => 'Source Report', 'route' => 'lead.sourcePerformance', 'icon' => 'feather-activity', 'sort' => 5],
                ['title' => 'Campaign Report', 'route' => 'lead.campaignPerformance', 'icon' => 'feather-target', 'sort' => 6],
                ['title' => 'Lead Activities', 'route' => 'lead.leadActivity', 'icon' => 'feather-clock', 'sort' => 7],
            ];
            foreach ($reportChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $reportId, $child['icon'], $routeId, $child['sort'], $now);
            }

            // 10. Modern Lead (Placed directly above SEO)
            $modernLeadRouteId = $getRouteId('modern.leads.index');
            $this->upsertMenu('Modern Lead', null, 'feather-layout', $modernLeadRouteId, 10, $now);

            // 11. SEO (Parent)
            $seoId = $this->upsertMenu('SEO', null, 'feather-globe', null, 11, $now);
            $seoChildren = [
                ['title' => 'All Blog', 'route' => 'blog.index', 'icon' => 'feather-book-open', 'sort' => 1],
                ['title' => 'Add Blog', 'route' => 'blog.create', 'icon' => 'feather-plus-circle', 'sort' => 2],
                ['title' => 'Author', 'route' => 'author.index', 'icon' => 'feather-user', 'sort' => 3],
                ['title' => 'Warrgyizmorsch Leads', 'route' => 'warr-leads.index', 'icon' => 'feather-inbox', 'sort' => 4],
            ];
            foreach ($seoChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $seoId, $child['icon'], $routeId, $child['sort'], $now);
            }

            // Warr Service Pages (Submenu under SEO)
            $warrServicePagesId = $this->upsertMenu('Warr Service Pages', $seoId, 'feather-file', null, 5, $now);
            $warrPageChildren = [
                ['title' => 'All Pages', 'route' => 'warr-service-pages.index', 'icon' => 'feather-list', 'sort' => 1],
                ['title' => 'Create Page', 'route' => 'warr-service-pages.create', 'icon' => 'feather-plus-circle', 'sort' => 2],
            ];
            foreach ($warrPageChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $warrServicePagesId, $child['icon'], $routeId, $child['sort'], $now);
            }

            // Warr Crud (Submenu under SEO)
            $warrCrudId = $this->upsertMenu('Warr Crud', $seoId, 'feather-database', null, 6, $now);
            $warrCrudChildren = [
                ['title' => 'Add Services', 'route' => 'warr-services.index', 'icon' => 'feather-tool', 'sort' => 1],
                ['title' => 'Add Countries', 'route' => 'warr-countries.index', 'icon' => 'feather-flag', 'sort' => 2],
                ['title' => 'Add Cities', 'route' => 'warr-cities.index', 'icon' => 'feather-map-pin', 'sort' => 3],
            ];
            foreach ($warrCrudChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $warrCrudId, $child['icon'], $routeId, $child['sort'], $now);
            }

            Menu::bumpMenuVersion();
        });
    }

    private function upsertMenu(string $title, ?int $parentId, string $icon, ?int $routeId, int $sortOrder, $now): int
    {
        $existing = DB::table('menus')->where('title', $title)->first();

        $values = [
            'parent_id'  => $parentId,
            'icon'       => $icon,
            'route_id'   => $routeId,
            'sort_order' => $sortOrder,
            'is_deleted' => 0,
            'updated_at' => $now,
        ];

        if ($existing) {
            DB::table('menus')->where('id', $existing->id)->update($values);
            return (int) $existing->id;
        }

        return (int) DB::table('menus')->insertGetId(array_merge($values, [
            'title'      => $title,
            'created_at' => $now,
        ]));
    }
}
