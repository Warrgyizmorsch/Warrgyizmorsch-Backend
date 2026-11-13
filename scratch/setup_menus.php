<?php
require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Menu;

echo "--- CHECKING MENUS & ROUTES ---\n";

// 1. Ensure routes exist in `routes` table
$newLeadsRoute = DB::table('routes')->where('route_name', 'leads.table.index')->first();
if (!$newLeadsRoute) {
    $newLeadsRouteId = DB::table('routes')->insertGetId([
        'route_name'  => 'leads.table.index',
        'method'      => 'GET',
        'is_deleted'  => 0,
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);
    echo "Created route: leads.table.index (ID: $newLeadsRouteId)\n";
} else {
    $newLeadsRouteId = $newLeadsRoute->id;
    echo "Found route: leads.table.index (ID: $newLeadsRouteId)\n";
}

$createdDealsRoute = DB::table('routes')->where('route_name', 'created.deals.index')->first();
if (!$createdDealsRoute) {
    $createdDealsRouteId = DB::table('routes')->insertGetId([
        'route_name'  => 'created.deals.index',
        'method'      => 'GET',
        'is_deleted'  => 0,
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);
    echo "Created route: created.deals.index (ID: $createdDealsRouteId)\n";
} else {
    $createdDealsRouteId = $createdDealsRoute->id;
    echo "Found route: created.deals.index (ID: $createdDealsRouteId)\n";
}

// 2. Find parent 'Leads' menu
$leadsParentMenu = DB::table('menus')->whereNull('parent_id')->where('title', 'LIKE', '%Lead%')->where('is_deleted', 0)->first();
if (!$leadsParentMenu) {
    $leadsParentId = DB::table('menus')->insertGetId([
        'parent_id'  => null,
        'title'      => 'Leads',
        'icon'       => 'feather-users',
        'route_id'   => null,
        'sort_order' => 5,
        'is_deleted' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Created parent Leads menu (ID: $leadsParentId)\n";
} else {
    $leadsParentId = $leadsParentMenu->id;
    echo "Found parent Leads menu (ID: $leadsParentId)\n";
}

// 3. Ensure 'New Leads Table' menu item exists
$newLeadsMenu = DB::table('menus')->where('title', 'New Leads Table')->where('is_deleted', 0)->first();
if (!$newLeadsMenu) {
    $newLeadsMenuId = DB::table('menus')->insertGetId([
        'parent_id'  => $leadsParentId,
        'title'      => 'New Leads Table',
        'icon'       => 'feather-list',
        'route_id'   => $newLeadsRouteId,
        'sort_order' => 1,
        'is_deleted' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Created menu: New Leads Table (ID: $newLeadsMenuId)\n";
} else {
    $newLeadsMenuId = $newLeadsMenu->id;
    DB::table('menus')->where('id', $newLeadsMenuId)->update([
        'parent_id' => $leadsParentId,
        'route_id'  => $newLeadsRouteId,
    ]);
    echo "Updated menu: New Leads Table (ID: $newLeadsMenuId)\n";
}

// 4. Ensure 'Created Deals' menu item exists
$createdDealsMenu = DB::table('menus')->where('title', 'Created Deals')->where('is_deleted', 0)->first();
if (!$createdDealsMenu) {
    $createdDealsMenuId = DB::table('menus')->insertGetId([
        'parent_id'  => $leadsParentId,
        'title'      => 'Created Deals',
        'icon'       => 'feather-check-square',
        'route_id'   => $createdDealsRouteId,
        'sort_order' => 3,
        'is_deleted' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Created menu: Created Deals (ID: $createdDealsMenuId)\n";
} else {
    $createdDealsMenuId = $createdDealsMenu->id;
    DB::table('menus')->where('id', $createdDealsMenuId)->update([
        'parent_id' => $leadsParentId,
        'route_id'  => $createdDealsRouteId,
    ]);
    echo "Updated menu: Created Deals (ID: $createdDealsMenuId)\n";
}

// 5. Grant permissions to all active roles
$roles = DB::table('roles')->pluck('id')->toArray();
if (empty($roles)) {
    $roles = [1, 2, 3];
}

foreach ($roles as $roleId) {
    foreach ([$newLeadsMenuId, $createdDealsMenuId] as $mId) {
        DB::table('role_permissions')->updateOrInsert(
            ['role_id' => $roleId, 'menu_id' => $mId],
            ['is_allowed' => 1, 'updated_at' => now()]
        );
    }
}
echo "Granted role permissions for all roles.\n";

// 6. Clear cache and bump version
Menu::bumpMenuVersion();
\Illuminate\Support\Facades\Cache::flush();
echo "Cache cleared & menu version bumped successfully!\n";
