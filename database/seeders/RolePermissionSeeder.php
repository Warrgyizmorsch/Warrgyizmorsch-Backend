<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Fetch all menu IDs and route IDs
        $menus = DB::table('menus')->pluck('id');
        $routes = DB::table('routes')->pluck('id');

        $roleIds = [1, 2, 3]; // Admin, User, Executive

        // Assign all menus and routes to active roles
        foreach ($roleIds as $roleId) {
            foreach ($menus as $menuId) {
                $permissions[] = [
                    'role_id'    => $roleId,
                    'menu_id'    => $menuId,
                    'route_id'   => null,
                    'is_allowed' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach ($routes as $routeId) {
                $permissions[] = [
                    'role_id'    => $roleId,
                    'menu_id'    => null,
                    'route_id'   => $routeId,
                    'is_allowed' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Insert permissions (avoid duplicates)
        DB::table('role_permissions')->upsert(
            $permissions,
            ['role_id', 'menu_id', 'route_id'], // unique keys
            ['is_allowed', 'updated_at'] // update fields
        );
    }
}
