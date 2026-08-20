<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'icon',
        'parent_id',
        'route_id',
        'sort_order',
        'is_deleted',
    ];

    protected static $memoizedMenus = [];

    /**
     * Get global cache version for menus
     */
    public static function getMenuVersion(): int
    {
        return (int) \Illuminate\Support\Facades\Cache::get('crm_menu_global_version', 1);
    }

    /**
     * Invalidate and bump global menu cache version
     */
    public static function bumpMenuVersion(): void
    {
        self::$memoizedMenus = [];
        try {
            if (\Illuminate\Support\Facades\Cache::has('crm_menu_global_version')) {
                \Illuminate\Support\Facades\Cache::increment('crm_menu_global_version');
            } else {
                \Illuminate\Support\Facades\Cache::put('crm_menu_global_version', 2, 86400 * 30);
            }
        } catch (\Exception $e) {
            // Ignore cache failure
        }
    }

    protected static function booted()
    {
        static::saved(function () {
            self::bumpMenuVersion();
        });
        static::deleted(function () {
            self::bumpMenuVersion();
        });
    }

    /**
     * Get allowed menus for a specific user (role + user override) with caching
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Support\Collection
     */
    public static function getMenusForUser($user)
    {
        if (!$user) {
            return collect();
        }

        $roleId = $user->role_id;
        $userId = $user->id;

        // Memoization within the current request
        $memoKey = $userId . '_' . ($roleId ?? 0);
        if (isset(self::$memoizedMenus[$memoKey])) {
            return self::$memoizedMenus[$memoKey];
        }

        $version = self::getMenuVersion();
        $cacheKey = "crm_user_menu_{$userId}_{$roleId}_v{$version}";

        $result = \Illuminate\Support\Facades\Cache::remember($cacheKey, 86400, function () use ($userId, $roleId) {
            // 🔹 1. Fetch allowed menu IDs for role in ONE single query (O(1) lookup)
            $allowedRoleMenuIds = $roleId ? RolePermission::where('role_id', $roleId)
                ->where('is_allowed', 1)
                ->whereNotNull('menu_id')
                ->pluck('menu_id')
                ->flip()
                ->toArray() : [];

            // 🔹 2. Fetch user override permissions in ONE single query (O(1) lookup)
            $userPermissions = UserPermission::where('user_id', $userId)
                ->whereNotNull('menu_id')
                ->pluck('is_allowed', 'menu_id')
                ->toArray();

            // 🔹 3. Load top-level menus with recursive children + route eager-loaded
            $menus = self::with(['childrenRecursive.route', 'route'])
                ->whereNull('parent_id')
                ->where('is_deleted', false)
                ->orderBy('sort_order')
                ->get();

            // 🔹 4. Recursive filter in memory without ANY extra database queries
            $filterMenu = function ($menu) use ($userPermissions, $allowedRoleMenuIds, &$filterMenu) {
                $menuId = $menu->id;

                // Check user override, fallback to role permission
                $isAllowed = isset($userPermissions[$menuId])
                    ? (bool) $userPermissions[$menuId]
                    : isset($allowedRoleMenuIds[$menuId]);

                // Recurse into children
                $filteredChildren = collect();
                if ($menu->childrenRecursive) {
                    foreach ($menu->childrenRecursive as $child) {
                        $keep = $filterMenu($child);
                        if ($keep) {
                            $filteredChildren->push($keep);
                        }
                    }
                }

                // Attach filtered children
                $menu->setRelation('children', $filteredChildren);
                $menu->setRelation('childrenRecursive', $filteredChildren);

                // Keep this menu if allowed OR has allowed children
                if ($isAllowed || $filteredChildren->isNotEmpty()) {
                    if (!$isAllowed) {
                        $menu->setRelation('route', null);
                    }
                    return $menu;
                }

                return null;
            };

            // Apply to roots
            return $menus
                ->map(fn($m) => $filterMenu($m))
                ->filter()
                ->values();
        });

        self::$memoizedMenus[$memoKey] = $result;

        return $result;
    }


    /**
     * Parent Menu
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id')
            ->where('is_deleted', 0);
    }

    /**
     * Child Menus
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('is_deleted', 0);
    }

    // Recursive relation
    public function childrenRecursive()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('is_deleted', 0)
            ->orderBy('sort_order', 'asc') // 👈 add ordering here
            ->with('childrenRecursive');
    }

    // Menu belongs to Route
    public function route()
    {
        return $this->belongsTo(Route::class)
            ->where('is_deleted', 0);
    }

    // In Menu.php model
    public function routesForPermission()
    {
        return $this->hasMany(Route::class, 'menu_id', 'id')
            ->where('is_deleted', 0);
    }


    // Menu has many RolePermissions
    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    // Menu has many UserPermissions
    public function userPermissions()
    {
        return $this->hasMany(UserPermission::class);
    }
}
