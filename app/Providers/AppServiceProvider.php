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
        View::composer('*', function ($view) {
            $viewData = $view->getData();
        
            // Safely check if 'meta' is already passed
            if (!array_key_exists('meta', $viewData)) {
                $routeName = Route::currentRouteName();
                $meta = config("meta.pages.$routeName", config('meta.default'));
                $view->with('meta', $meta);
            }

            // Load menus for logged-in user
            if (Auth::check()) {
                $user = Auth::user();
                $menus = Menu::getMenusForUser($user);
            } else {
                $menus = collect(); // empty collection if not logged in
            }

            $view->with('menus', $menus);
        });

        View::composer('*', function ($view) {
            $homeData = app(\App\Services\HomePageDataService::class); // adjust namespace
            $view->with('testimonials', $homeData->getTestimonials());
        });
    }
}
