<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSidebarMenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $now = now();

            $routeIds = [];
            foreach ([
                ['name' => 'New Leads Table', 'route_name' => 'leads.table.index'],
                ['name' => 'Created Deals', 'route_name' => 'created.deals.index'],
                ['name' => 'Follow-ups', 'route_name' => 'followups.index'],
                ['name' => 'Tag Master', 'route_name' => 'tags.index'],
                ['name' => 'Project Master', 'route_name' => 'projects.index'],
            ] as $route) {
                DB::table('routes')->updateOrInsert(
                    ['route_name' => $route['route_name']],
                    [
                        'name' => $route['name'],
                        'method' => 'get',
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
                $routeIds[$route['route_name']] = DB::table('routes')
                    ->where('route_name', $route['route_name'])
                    ->value('id');
            }

            // Preserve the existing core administration menus; only normalize order.
            $coreOrder = [
                'Dashboard' => 1,
                'Management' => 2,
                'Users' => 3,
                'Permissions' => 4,
            ];
            foreach ($coreOrder as $title => $sortOrder) {
                DB::table('menus')->where('title', $title)->update([
                    'parent_id' => null,
                    'sort_order' => $sortOrder,
                    'is_deleted' => 0,
                    'updated_at' => $now,
                ]);
            }

            $masterId = $this->upsertMenu('Master', null, 'feather-database', null, 5, $now);

            $masterChildren = [
                ['existing' => 'Status', 'title' => 'Status Master', 'route' => 'bucket.index', 'icon' => 'feather-layers', 'sort' => 1],
                ['existing' => 'Lead Questions', 'title' => 'Attribute', 'route' => 'lead_questions.index', 'icon' => 'feather-sliders', 'sort' => 2],
                ['existing' => 'Lead Sources', 'title' => 'Lead Source', 'route' => 'lead_sources.index', 'icon' => 'feather-share-2', 'sort' => 3],
                ['existing' => 'Services', 'title' => 'Service', 'route' => 'category.index', 'icon' => 'feather-grid', 'sort' => 4],
                ['existing' => 'Tag Master', 'title' => 'Tag Master', 'route' => 'tags.index', 'icon' => 'feather-tag', 'sort' => 5],
                ['existing' => 'Project Master', 'title' => 'Project Master', 'route' => 'projects.index', 'icon' => 'feather-briefcase', 'sort' => 6],
            ];

            foreach ($masterChildren as $child) {
                $routeId = DB::table('routes')->where('route_name', $child['route'])->value('id');
                $existingId = DB::table('menus')->where('title', $child['existing'])->value('id')
                    ?? DB::table('menus')->where('title', $child['title'])->value('id');

                if ($existingId) {
                    DB::table('menus')->where('id', $existingId)->update([
                        'parent_id' => $masterId,
                        'title' => $child['title'],
                        'icon' => $child['icon'],
                        'route_id' => $routeId,
                        'sort_order' => $child['sort'],
                        'is_deleted' => 0,
                        'updated_at' => $now,
                    ]);
                    $childMenuId = (int) $existingId;
                } else {
                    $childMenuId = $this->upsertMenu($child['title'], $masterId, $child['icon'], $routeId, $child['sort'], $now);
                }

                $this->allowAdminMenu($childMenuId, $now);
                if ($routeId) {
                    $this->allowAdminRoute((int) $routeId, $now);
                }
            }

            // Reuse the existing Leads root so its historic permissions remain intact.
            $leadId = DB::table('menus')->where('title', 'Leads')->value('id')
                ?? DB::table('menus')->where('title', 'Lead')->value('id');
            if ($leadId) {
                DB::table('menus')->where('id', $leadId)->update([
                    'parent_id' => null,
                    'title' => 'Lead',
                    'icon' => 'feather-users',
                    'route_id' => $routeIds['leads.table.index'],
                    'sort_order' => 6,
                    'is_deleted' => 0,
                    'updated_at' => $now,
                ]);
            } else {
                $leadId = $this->upsertMenu('Lead', null, 'feather-users', $routeIds['leads.table.index'], 6, $now);
            }
            DB::table('menus')->where('parent_id', $leadId)->update(['is_deleted' => 1, 'updated_at' => $now]);

            $dealId = $this->upsertMenu('Deal', null, 'feather-briefcase', $routeIds['created.deals.index'], 7, $now);
            $followupId = $this->upsertMenu('Follow-ups', null, 'feather-calendar', $routeIds['followups.index'], 8, $now);

            DB::table('menus')->where('title', 'Lead Report')->update([
                'parent_id' => null,
                'sort_order' => 9,
                'is_deleted' => 0,
                'updated_at' => $now,
            ]);

            // Blogs becomes SEO; its existing Blog children remain unchanged.
            $seoId = DB::table('menus')->where('title', 'Blogs')->value('id')
                ?? DB::table('menus')->where('title', 'SEO')->value('id');
            if ($seoId) {
                DB::table('menus')->where('id', $seoId)->update([
                    'parent_id' => null,
                    'title' => 'SEO',
                    'icon' => 'feather-globe',
                    'route_id' => null,
                    'sort_order' => 10,
                    'is_deleted' => 0,
                    'updated_at' => $now,
                ]);
            } else {
                $seoId = $this->upsertMenu('SEO', null, 'feather-globe', null, 10, $now);
            }

            // Preserve remaining legacy admin modules by nesting them under SEO.
            $preservedRootTitles = ['Order Master', 'Warrgyizmorsch Leads', 'Warr Service Pages', 'Warr Crud'];
            $legacySort = 10;
            foreach ($preservedRootTitles as $title) {
                DB::table('menus')->where('title', $title)->where('id', '!=', $seoId)->update([
                    'parent_id' => $seoId,
                    'sort_order' => $legacySort++,
                    'is_deleted' => 0,
                    'updated_at' => $now,
                ]);
            }

            foreach ([$masterId, $leadId, $dealId, $followupId, $seoId] as $menuId) {
                $this->allowAdminMenu($menuId, $now);
            }
            foreach ($routeIds as $routeId) {
                $this->allowAdminRoute($routeId, $now);
            }

            Menu::bumpMenuVersion();
        });
    }

    private function upsertMenu(string $title, ?int $parentId, string $icon, ?int $routeId, int $sortOrder, $now): int
    {
        $menuId = DB::table('menus')->where('title', $title)->value('id');
        $values = [
            'parent_id' => $parentId,
            'icon' => $icon,
            'route_id' => $routeId,
            'sort_order' => $sortOrder,
            'is_deleted' => 0,
            'updated_at' => $now,
        ];

        if ($menuId) {
            DB::table('menus')->where('id', $menuId)->update($values);
            return (int) $menuId;
        }

        return (int) DB::table('menus')->insertGetId(array_merge($values, [
            'title' => $title,
            'created_at' => $now,
        ]));
    }

    private function allowAdminMenu(int $menuId, $now): void
    {
        DB::table('role_permissions')->updateOrInsert(
            ['role_id' => 1, 'menu_id' => $menuId, 'route_id' => null],
            ['is_allowed' => 1, 'created_at' => $now, 'updated_at' => $now]
        );
    }

    private function allowAdminRoute(int $routeId, $now): void
    {
        DB::table('role_permissions')->updateOrInsert(
            ['role_id' => 1, 'menu_id' => null, 'route_id' => $routeId],
            ['is_allowed' => 1, 'created_at' => $now, 'updated_at' => $now]
        );
    }
}
