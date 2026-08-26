<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as LaravelRoute;
use App\Models\Route as RouteModel;
use App\Models\UserPermission;
use App\Models\RolePermission;

class CheckPermission
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'Please login to continue']);
        }

        if ($user->role_id == 1) {
            return $next($request);
        }

        $currentRouteName = LaravelRoute::currentRouteName();

        if (!$currentRouteName) {
            abort(403, 'Unauthorized: Route has no name.');
        }

        $dbRoute = RouteModel::firstOrCreate(
            ['route_name' => $currentRouteName],
            ['is_deleted' => false]
        );

        if (!$dbRoute || $dbRoute->is_deleted) {
            abort(403, 'Unauthorized: Route not registered in system.');
        }

        $routeId = $dbRoute->id;

        // 1️⃣ Check explicit user permission
        $userPermission = UserPermission::where('user_id', $user->id)
            ->where('route_id', $routeId)
            ->first();

        if ($userPermission) {
            if ($userPermission->is_allowed) {
                return $next($request); // explicitly allowed
            } else {
                abort(403, 'Unauthorized: You don’t have permission to access this page.'); // explicitly denied
            }
        }

        // 2️⃣ Check role permission if no explicit user permission
        if ($user->role_id) {
            $rolePermission = RolePermission::where('role_id', $user->role_id)
                ->where('route_id', $routeId)
                ->first();

            if ($rolePermission && $rolePermission->is_allowed) {
                return $next($request); // role allows
            }
        }

        // 3️⃣ Neither user nor role allows
        abort(403, 'Unauthorized: You don’t have permission to access this page.');
    }
}
