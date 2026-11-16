<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetaLeadsPermissionSeeder extends Seeder
{
    /**
     * Seed routes, menus, and role permissions for Meta Leads & Conversions API integration.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::transaction(function () use ($now) {
            // 1. Register all Meta Leads and Retargeting routes in `routes` table
            $routes = [
                ['name' => 'All Meta Leads', 'route_name' => 'modern.leads.meta', 'method' => 'GET'],
                ['name' => 'Meta Retargeting Dashboard', 'route_name' => 'meta.retargeting.index', 'method' => 'GET'],
                ['name' => 'Meta Retargeting Lead Preview', 'route_name' => 'meta.retargeting.preview', 'method' => 'GET'],
                ['name' => 'Create Meta Custom Audience', 'route_name' => 'meta.retargeting.create_audience', 'method' => 'POST'],
                ['name' => 'Sync Leads to Meta Custom Audience', 'route_name' => 'meta.retargeting.sync', 'method' => 'POST'],
                ['name' => 'Sync Leads to Meta Dataset CAPI', 'route_name' => 'meta.retargeting.sync_dataset', 'method' => 'POST'],
                ['name' => 'Subscribe Page to Meta Webhook', 'route_name' => 'meta.retargeting.subscribe', 'method' => 'POST'],
                ['name' => 'Meta Webhook Verify', 'route_name' => 'meta.webhook.verify', 'method' => 'GET'],
                ['name' => 'Meta Webhook Event Handler', 'route_name' => 'meta.webhook.handle', 'method' => 'POST'],
            ];

            $routeIds = [];
            foreach ($routes as $route) {
                $existing = DB::table('routes')->where('route_name', $route['route_name'])->first();
                if ($existing) {
                    DB::table('routes')->where('id', $existing->id)->update([
                        'name' => $route['name'],
                        'method' => strtolower($route['method']),
                        'is_deleted' => 0,
                        'updated_at' => $now,
                    ]);
                    $routeIds[$route['route_name']] = $existing->id;
                } else {
                    $id = DB::table('routes')->insertGetId([
                        'name' => $route['name'],
                        'route_name' => $route['route_name'],
                        'method' => strtolower($route['method']),
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                    $routeIds[$route['route_name']] = $id;
                }
            }

            // 2. Insert or update Meta Leads Menu in `menus` table
            $parentMenu = DB::table('menus')
                ->where('title', 'Meta Leads')
                ->whereNull('parent_id')
                ->first();

            if ($parentMenu) {
                $parentMenuId = $parentMenu->id;
                DB::table('menus')->where('id', $parentMenuId)->update([
                    'icon' => 'feather-facebook text-primary',
                    'is_deleted' => 0,
                    'sort_order' => 6,
                    'updated_at' => $now,
                ]);
            } else {
                $parentMenuId = DB::table('menus')->insertGetId([
                    'title' => 'Meta Leads',
                    'icon' => 'feather-facebook text-primary',
                    'parent_id' => null,
                    'route_id' => null,
                    'is_deleted' => 0,
                    'sort_order' => 6,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $subMenus = [
                [
                    'title' => 'All Meta Leads',
                    'icon' => 'feather-list',
                    'route_name' => 'modern.leads.meta',
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Retargeting & Audiences',
                    'icon' => 'feather-target',
                    'route_name' => 'meta.retargeting.index',
                    'sort_order' => 2,
                ],
            ];

            $menuIds = [$parentMenuId];
            foreach ($subMenus as $sub) {
                $routeId = $routeIds[$sub['route_name']] ?? null;
                $existingSub = DB::table('menus')
                    ->where('title', $sub['title'])
                    ->where('parent_id', $parentMenuId)
                    ->first();

                if ($existingSub) {
                    DB::table('menus')->where('id', $existingSub->id)->update([
                        'icon' => $sub['icon'],
                        'route_id' => $routeId,
                        'sort_order' => $sub['sort_order'],
                        'is_deleted' => 0,
                        'updated_at' => $now,
                    ]);
                    $menuIds[] = $existingSub->id;
                } else {
                    $subId = DB::table('menus')->insertGetId([
                        'title' => $sub['title'],
                        'icon' => $sub['icon'],
                        'parent_id' => $parentMenuId,
                        'route_id' => $routeId,
                        'sort_order' => $sub['sort_order'],
                        'is_deleted' => 0,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                    $menuIds[] = $subId;
                }
            }

            // 3. Grant Permissions in `role_permissions` table
            $roles = DB::table('roles')->where('is_deleted', 0)->get(['id', 'name']);

            foreach ($roles as $role) {
                // Deny pure clients/User role; allow Admin, Managers, Employees, SEO
                $isClient = strtolower($role->name) === 'user';
                $isAllowed = $isClient ? 0 : 1;

                // Grant Menus
                foreach ($menuIds as $menuId) {
                    DB::table('role_permissions')->updateOrInsert(
                        ['role_id' => $role->id, 'menu_id' => $menuId],
                        [
                            'route_id' => null,
                            'is_allowed' => $isAllowed,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }

                // Grant Routes
                foreach ($routeIds as $rId) {
                    DB::table('role_permissions')->updateOrInsert(
                        ['role_id' => $role->id, 'route_id' => $rId],
                        [
                            'menu_id' => null,
                            'is_allowed' => $isAllowed,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }
            }
        });

        $this->command->info('Meta Leads & Retargeting routes, menus, and permissions seeded successfully!');
    }
}
