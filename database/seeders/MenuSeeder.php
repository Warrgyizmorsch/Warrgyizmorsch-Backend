<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // 1. Dashboard (No children)
        $dashboardRouteId = DB::table('routes')->where('route_name', 'dashboard')->value('id');
        if (!DB::table('menus')->where('title', 'Dashboard')->exists()) {
            DB::table('menus')->insert([
                'parent_id'   => null,
                'title'       => 'Dashboard',
                'icon'        => 'fas fa-home',
                'route_id'    => $dashboardRouteId,
                'sort_order'  => 1,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // 2. Management (Parent)
        $managementId = DB::table('menus')->where('title', 'Management')->value('id');
        if (!$managementId) {
            $managementId = DB::table('menus')->insertGetId([
                'parent_id'   => null,
                'title'       => 'Management',
                'icon'        => 'fas fa-cogs',
                'route_id'    => null,
                'sort_order'  => 2,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // 3. Users (Parent)
        $usersId = DB::table('menus')->where('title', 'Users')->value('id');
        if (!$usersId) {
            $usersId = DB::table('menus')->insertGetId([
                'parent_id'   => null,
                'title'       => 'Users',
                'icon'        => 'fas fa-users',
                'route_id'    => null,
                'sort_order'  => 3,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // 4. Permissions (Parent)
        if (!DB::table('menus')->where('title', 'Permissions')->exists()) {
            DB::table('menus')->insert([
                'parent_id'   => null,
                'title'       => 'Permissions',
                'icon'        => 'fas fa-lock',
                'route_id'    => null,
                'sort_order'  => 4,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // 5. Leads (Parent)
        $leadsRouteId = DB::table('routes')->where('route_name', 'modern.leads.index')->value('id');
        $newLeadsRouteId = DB::table('routes')->where('route_name', 'leads.table.index')->value('id');
        $createdDealsRouteId = DB::table('routes')->where('route_name', 'created.deals.index')->value('id');

        $leadsId = DB::table('menus')->where('title', 'Leads')->value('id');
        if (!$leadsId) {
            $leadsId = DB::table('menus')->insertGetId([
                'parent_id'   => null,
                'title'       => 'Leads',
                'icon'        => 'feather-users',
                'route_id'    => $leadsRouteId,
                'sort_order'  => 5,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        // Insert submenus under Leads
        $submenus = [
            ['title' => 'New Leads Table', 'icon' => 'feather-list', 'route_id' => $newLeadsRouteId, 'sort_order' => 1],
            ['title' => 'Modern Leads', 'icon' => 'feather-users', 'route_id' => $leadsRouteId, 'sort_order' => 2],
            ['title' => 'Created Deals', 'icon' => 'feather-check-square', 'route_id' => $createdDealsRouteId, 'sort_order' => 3],
        ];

        foreach ($submenus as $sm) {
            if (!DB::table('menus')->where('parent_id', $leadsId)->where('title', $sm['title'])->exists()) {
                DB::table('menus')->insert([
                    'parent_id'   => $leadsId,
                    'title'       => $sm['title'],
                    'icon'        => $sm['icon'],
                    'route_id'    => $sm['route_id'],
                    'sort_order'  => $sm['sort_order'],
                    'is_deleted'  => false,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        // 6. Follow-ups (Parent)
        $followupRouteId = DB::table('routes')->where('route_name', 'followups.index')->value('id');
        $followupId = DB::table('menus')->where('title', 'Follow-ups')->value('id');
        if (!$followupId) {
            $followupId = DB::table('menus')->insertGetId([
                'parent_id'   => null,
                'title'       => 'Follow-ups',
                'icon'        => 'feather-phone-call',
                'route_id'    => $followupRouteId,
                'sort_order'  => 6,
                'is_deleted'  => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $fSubmenus = [
            ['title' => 'Follow Ups', 'icon' => 'feather-list', 'sort_order' => 1],
            ['title' => 'Next Followup', 'icon' => 'feather-clock', 'sort_order' => 2],
            ['title' => 'Due Followup', 'icon' => 'feather-alert-triangle', 'sort_order' => 3],
        ];

        foreach ($fSubmenus as $sm) {
            if (!DB::table('menus')->where('parent_id', $followupId)->where('title', $sm['title'])->exists()) {
                DB::table('menus')->insert([
                    'parent_id'   => $followupId,
                    'title'       => $sm['title'],
                    'icon'        => $sm['icon'],
                    'route_id'    => $followupRouteId,
                    'sort_order'  => $sm['sort_order'],
                    'is_deleted'  => false,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
