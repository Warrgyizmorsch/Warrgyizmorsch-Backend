<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            $now = now();

            // 1. Guarantee that all routes exist in the database first
            (new RouteSeeder())->run();

            // Helper to get route ID by route_name
            $getRouteId = function (string $routeName) {
                return DB::table('routes')->where('route_name', $routeName)->where('is_deleted', 0)->value('id')
                    ?? DB::table('routes')->where('route_name', $routeName)->value('id');
            };

            // 2. Delete obsolete menus
            $deleteTitles = ['%Order Master%', '%Pipeline Lead%', '%Old Leads%'];
            foreach ($deleteTitles as $titlePattern) {
                $menuIds = DB::table('menus')->where('title', 'LIKE', $titlePattern)->pluck('id')->toArray();
                if (!empty($menuIds)) {
                    DB::table('role_permissions')->whereIn('menu_id', $menuIds)->delete();
                    DB::table('user_permissions')->whereIn('menu_id', $menuIds)->delete();
                    DB::table('menus')->whereIn('id', $menuIds)->delete();
                }
            }

            // 3. Upsert Menus

            // 1. Dashboard (Lead Pipeline Dashboard)
            $dashboardRouteId = $getRouteId('dashboard');
            $dashboardMenuId = $this->upsertMenu('Dashboard', null, 'feather-home', $dashboardRouteId, 1, $now);

            // 2. Management (Parent)
            $managementId = $this->upsertMenu('Management', null, 'feather-settings', null, 2, $now);
            $this->upsertMenu('Roles', $managementId, 'feather-user-check', $getRouteId('roles.index'), 1, $now);
            $this->upsertMenu('Routes', $managementId, 'feather-git-commit', $getRouteId('routes.index'), 2, $now);
            $this->upsertMenu('Menus', $managementId, 'feather-menu', $getRouteId('menus.index'), 3, $now);
            $permissionsId = $this->upsertMenu('Permissions', $managementId, 'feather-lock', null, 4, $now);
            $this->upsertMenu('Role Permissions', $permissionsId, 'feather-shield', $getRouteId('role-permissions.index'), 1, $now);
            $this->upsertMenu('User Overrides', $permissionsId, 'feather-user-check', $getRouteId('user-permissions.index'), 2, $now);

            // 3. Users (Parent)
            $usersId = $this->upsertMenu('Users', null, 'feather-users', null, 3, $now);
            $this->upsertMenu('Add User', $usersId, 'feather-user-plus', $getRouteId('users.create'), 1, $now);
            $this->upsertMenu('List Users', $usersId, 'feather-list', $getRouteId('users.index'), 2, $now);
            $this->upsertMenu('Login History', $usersId, 'feather-clock', $getRouteId('users.session'), 3, $now);

            // 5. Master (Parent)
            $masterId = $this->upsertMenu('Master', null, 'feather-database', null, 5, $now);
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

            // 6. Lead (Direct Table View - MUST have NO children)
            $leadRouteId = $getRouteId('leads.table.index');
            $leadMenuId = $this->upsertMenu('Lead', null, 'feather-users', $leadRouteId, 6, $now);
            // Clean any stale child menus that had parent_id = leadMenuId
            DB::table('menus')->where('parent_id', $leadMenuId)->update(['is_deleted' => 1, 'parent_id' => null]);

            // 7. Deal (Direct View - MUST have NO children)
            $dealRouteId = $getRouteId('created.deals.index');
            $dealMenuId = $this->upsertMenu('Deal', null, 'feather-briefcase', $dealRouteId, 7, $now);
            DB::table('menus')->where('parent_id', $dealMenuId)->update(['is_deleted' => 1, 'parent_id' => null]);

            // 8. Follow-ups (Direct View - MUST have NO children)
            $followupRouteId = $getRouteId('followups.index');
            $followupMenuId = $this->upsertMenu('Follow-ups', null, 'feather-calendar', $followupRouteId, 8, $now);
            DB::table('menus')->where('parent_id', $followupMenuId)->update(['is_deleted' => 1, 'parent_id' => null]);

            // 9. Archive (Parent Menu - Placed directly below Follow-ups)
            $archiveId = $this->upsertMenu('Archive', null, 'feather-archive', null, 9, $now);
            $archiveChildren = [
                ['title' => 'Archive Leads', 'route' => 'archive.leads.index', 'icon' => 'feather-users', 'sort' => 1],
                ['title' => 'Archive Deals', 'route' => 'archive.deals.index', 'icon' => 'feather-briefcase', 'sort' => 2],
            ];
            foreach ($archiveChildren as $child) {
                $routeId = $getRouteId($child['route']);
                $this->upsertMenu($child['title'], $archiveId, $child['icon'], $routeId, $child['sort'], $now);
            }

            // 10. Lead Report (Parent)
            $reportId = $this->upsertMenu('Lead Report', null, 'feather-bar-chart-2', null, 10, $now);
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

            // 11. Modern Lead
            $modernLeadRouteId = $getRouteId('modern.leads.index');
            $modernMenuId = $this->upsertMenu('Modern Lead', null, 'feather-layout', $modernLeadRouteId, 11, $now);
            DB::table('menus')->where('parent_id', $modernMenuId)->update(['is_deleted' => 1, 'parent_id' => null]);

            // 12. SEO (Parent)
            $seoId = $this->upsertMenu('SEO', null, 'feather-globe', null, 12, $now);
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

            // 4. Role Permissions Auto-Assignment
            $allActiveMenus = DB::table('menus')->where('is_deleted', 0)->get();
            $roles = DB::table('roles')->where('is_deleted', 0)->get(['id', 'name']);
            $seoMenuIds = $this->menuTreeIds($seoId);

            foreach ($roles as $role) {
                foreach ($allActiveMenus as $m) {
                    $isAllowed = 1;
                    $rId = $role->id;
                    if (strcasecmp($role->name, 'SEO') === 0) {
                        $isAllowed = ($m->id === $dashboardMenuId || in_array($m->id, $seoMenuIds, true)) ? 1 : 0;
                    }
                    if (strcasecmp($role->name, 'Admin') === 0 && in_array($m->id, $seoMenuIds, true)) {
                        $isAllowed = 0;
                    }
                    // Role 3 (Agent) restrictions if desired
                    if ($rId == 3 && in_array($m->title, ['Management', 'Roles', 'Routes', 'Menus', 'Users', 'Add User', 'List Users', 'Permissions'])) {
                        $isAllowed = 0;
                    }

                    DB::table('role_permissions')->updateOrInsert(
                        ['role_id' => $rId, 'menu_id' => $m->id],
                        ['is_allowed' => $isAllowed, 'updated_at' => $now, 'created_at' => $now]
                    );
                }
            }

            Menu::bumpMenuVersion();
            Cache::flush();
        });
    }

    private function menuTreeIds(int $rootId): array
    {
        $ids = [$rootId];
        $parents = [$rootId];
        while ($parents) {
            $children = DB::table('menus')->whereIn('parent_id', $parents)->where('is_deleted', 0)->pluck('id')->map(fn ($id) => (int) $id)->all();
            $ids = array_merge($ids, $children);
            $parents = $children;
        }
        return array_values(array_unique($ids));
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
