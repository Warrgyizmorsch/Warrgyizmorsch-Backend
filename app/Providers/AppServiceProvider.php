<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Meta data view composer (for main app layout)
        View::composer('layouts.app', function ($view) {
            $viewData = $view->getData();
            if (!array_key_exists('meta', $viewData)) {
                $routeName = Route::currentRouteName();
                $meta = config("meta.pages.$routeName");

                if (!$meta) {
                    $meta = config('meta.default', [
                        'title' => 'Admin Panel',
                        'description' => '',
                    ]);
                }
                $view->with('meta', $meta);
            }
        });

        // 2. Navigation / Sidebar view composer (scoped to layouts.aside only)
        View::composer('layouts.aside', function ($view) {
            $viewData = $view->getData();
            if (array_key_exists('menus', $viewData)) {
                return;
            }

            if (Auth::check()) {
                $user = Auth::user();
                $version = Menu::getMenuVersion();
                $cacheKey = "crm_full_aside_menu_{$user->id}_{$user->role_id}_v{$version}";

                $menus = \Illuminate\Support\Facades\Cache::remember($cacheKey, 86400, function () use ($user) {
                    return Menu::getMenusForUser($user);
                });
            } else {
                $menus = collect();
            }

            $view->with('menus', $menus);
        });
    }
}
