<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Menu;

class AdsLeadMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Insert or update routes in `routes` table
        $routes = [
            ['name' => 'Ads Leads', 'route_name' => 'ads-leads.index'],
            ['name' => 'Send Ads Lead to CRM', 'route_name' => 'ads-leads.sendToLead'],
            ['name' => 'Delete Ads Lead', 'route_name' => 'ads-leads.destroy'],
        ];

        $routeIds = [];
        foreach ($routes as $route) {
            $existing = DB::table('routes')->where('route_name', $route['route_name'])->first();
            if ($existing) {
                DB::table('routes')->where('id', $existing->id)->update([
                    'name' => $route['name'],
                    'is_deleted' => false,
                    'updated_at' => $now,
                ]);
                $routeIds[$route['route_name']] = $existing->id;
            } else {
                $id = DB::table('routes')->insertGetId([
                    'name' => $route['name'],
                    'route_name' => $route['route_name'],
                    'method' => 'get',
                    'is_deleted' => false,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                $routeIds[$route['route_name']] = $id;
            }
        }

        $adsIndexRouteId = $routeIds['ads-leads.index'] ?? null;

        // 2. Locate SEO menu parent
        $seoMenu = DB::table('menus')->where('title', 'SEO')->where('is_deleted', 0)->first();
        $seoId = $seoMenu ? $seoMenu->id : null;

        if (!$seoId) {
            $seoId = DB::table('menus')->insertGetId([
                'title' => 'SEO',
                'icon' => 'feather-globe',
                'parent_id' => null,
                'route_id' => null,
                'sort_order' => 12,
                'is_deleted' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 3. Upsert 'Ads Leads' menu under SEO
        $adsMenu = DB::table('menus')
            ->where('title', 'Ads Leads')
            ->where('parent_id', $seoId)
            ->first();

        if ($adsMenu) {
            DB::table('menus')->where('id', $adsMenu->id)->update([
                'icon' => 'feather-target',
                'route_id' => $adsIndexRouteId,
                'sort_order' => 5,
                'is_deleted' => 0,
                'updated_at' => $now,
            ]);
            $adsMenuId = $adsMenu->id;
        } else {
            $adsMenuId = DB::table('menus')->insertGetId([
                'title' => 'Ads Leads',
                'parent_id' => $seoId,
                'icon' => 'feather-target',
                'route_id' => $adsIndexRouteId,
                'sort_order' => 5,
                'is_deleted' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 4. Configure Role Permissions:
        // Admin and SEO roles get allowed (1), all other roles get denied (0)
        $roles = DB::table('roles')->where('is_deleted', 0)->get();

        foreach ($roles as $role) {
            $isAdmin = strcasecmp($role->name, 'Admin') === 0 || $role->id == 1;
            $isSeo = strcasecmp($role->name, 'SEO') === 0;

            $isAllowed = ($isAdmin || $isSeo) ? 1 : 0;

            // Menu permission
            DB::table('role_permissions')->updateOrInsert(
                ['role_id' => $role->id, 'menu_id' => $adsMenuId],
                ['route_id' => null, 'is_allowed' => $isAllowed, 'updated_at' => $now, 'created_at' => $now]
            );

            // Also ensure SEO parent menu is allowed for Admin and SEO
            DB::table('role_permissions')->updateOrInsert(
                ['role_id' => $role->id, 'menu_id' => $seoId],
                ['route_id' => null, 'is_allowed' => $isAllowed, 'updated_at' => $now, 'created_at' => $now]
            );

            // Route permissions for all 3 ads routes
            foreach ($routeIds as $rId) {
                DB::table('role_permissions')->updateOrInsert(
                    ['role_id' => $role->id, 'route_id' => $rId],
                    ['menu_id' => null, 'is_allowed' => $isAllowed, 'updated_at' => $now, 'created_at' => $now]
                );
            }
        }

        // 5. Invalidate menu cache
        Menu::bumpMenuVersion();
        Cache::flush();

        $this->command->info('Ads Lead routes, menu under SEO, and permissions for Admin & SEO have been seeded successfully.');
    }
}
