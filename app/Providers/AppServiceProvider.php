<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Illuminate\Support\Facades\URL;

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
        // ✅ FORCE correct domain for this subdomain
        URL::forceRootUrl(config('app.url'));
        URL::forceScheme('https');

        View::composer('*', function ($view) {
            $viewData = $view->getData();

            if (!array_key_exists('meta', $viewData)) {
                $routeName = Route::currentRouteName();
                $meta = config("meta.pages.$routeName", config('meta.default'));
                $view->with('meta', $meta);
            }

            if (Auth::check()) {
                $user = Auth::user();
                $menus = Menu::getMenusForUser($user);
            } else {
                $menus = collect();
            }

            $view->with('menus', $menus);
        });
    }
}
