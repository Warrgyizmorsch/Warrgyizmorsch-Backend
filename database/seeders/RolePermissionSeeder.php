<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $roles = DB::table('roles')->where('is_deleted', 0)->get(['id', 'name']);
        $menus = DB::table('menus')->where('is_deleted', 0)->get(['id', 'title', 'parent_id']);
        $routes = DB::table('routes')->where('is_deleted', 0)->get(['id', 'route_name']);
        $seoRoot = $menus->firstWhere('title', 'SEO');
        $seoMenuIds = $seoRoot ? $this->descendantIds($menus, (int) $seoRoot->id) : [];
        $dashboardMenuId = optional($menus->firstWhere('title', 'Dashboard'))->id;
        $seoRoutes = [
            'dashboard', 'blog.index', 'blog.create', 'blog.store', 'blog.edit', 'blog.update', 'blog.destroy',
            'author.index', 'author.store', 'author.edit', 'author.destroy',
            'warr-leads.index', 'warr-leads.updateWarrLead',
            'warr-service-pages.index', 'warr-service-pages.create', 'warr-service-pages.store',
            'warr-service-pages.edit', 'warr-service-pages.update', 'warr-service-pages.delete', 'warr-service-pages.cities',
            'warr-countries.index', 'warr-countries.store', 'warr-countries.destroy',
            'warr-cities.index', 'warr-cities.store', 'warr-cities.destroy',
            'warr-services.index', 'warr-services.store', 'warr-services.destroy',
        ];

        foreach ($roles as $role) {
            $isSeo = strcasecmp($role->name, 'SEO') === 0;
            $isAdmin = strcasecmp($role->name, 'Admin') === 0;
            foreach ($menus as $menu) {
                $allowed = $isSeo
                    ? (($menu->id == $dashboardMenuId || in_array($menu->id, $seoMenuIds, true)) ? 1 : 0)
                    : (($isAdmin && in_array($menu->id, $seoMenuIds, true)) ? 0 : 1);
                DB::table('role_permissions')->updateOrInsert(
                    ['role_id' => $role->id, 'menu_id' => $menu->id],
                    ['route_id' => null, 'is_allowed' => $allowed, 'created_at' => $now, 'updated_at' => $now]
                );
            }
            foreach ($routes as $route) {
                $allowed = $isSeo ? (in_array($route->route_name, $seoRoutes, true) ? 1 : 0) : 1;
                DB::table('role_permissions')->updateOrInsert(
                    ['role_id' => $role->id, 'route_id' => $route->id],
                    ['menu_id' => null, 'is_allowed' => $allowed, 'created_at' => $now, 'updated_at' => $now]
                );
            }
        }
    }

    private function descendantIds($menus, int $rootId): array
    {
        $ids = [$rootId];
        $parents = [$rootId];
        while ($parents) {
            $children = $menus->whereIn('parent_id', $parents)->pluck('id')->map(fn ($id) => (int) $id)->all();
            $ids = array_merge($ids, $children);
            $parents = $children;
        }
        return array_values(array_unique($ids));
    }
}
