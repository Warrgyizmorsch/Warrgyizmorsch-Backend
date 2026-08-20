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
                    $menus = Menu::getMenusForUser($user);

                    // Add "Converted" sub-menu to Leads menu dynamically
                    $leadsMenu = $menus->first(fn($m) => str_contains(strtolower($m->title ?? ''), 'lead'));
                    if ($leadsMenu) {
                        $children = $leadsMenu->children ? collect($leadsMenu->children) : collect();
                        $hasConverted = $children->contains(fn($c) => str_contains(strtolower($c->title ?? ''), 'converted'));

                        if (!$hasConverted) {
                            $convertedMenu = new \App\Models\Menu(['title' => 'Converted']);
                            $cRoute = new \stdClass();
                            $cRoute->route_name = 'modern.leads.index';
                            $convertedMenu->route = $cRoute;
                            $convertedMenu->custom_params = ['converted' => 1];

                            $children->push($convertedMenu);
                            $leadsMenu->setRelation('children', $children);
                        }
                    }

                    // Dynamic Order Master sub-menus (only if user has permission for Order Master)
                    $orderMasterMenu = $menus->first(fn($m) => strtolower($m->title ?? '') === 'order master');
                    if ($orderMasterMenu) {
                        $orderBuckets = \App\Models\Bucket::whereNull('parent_id')
                            ->where('is_deleted', 0)
                            ->where('name', 'NOT LIKE', '%lead%')
                            ->orderBy('id', 'asc')
                            ->get();

                        if ($orderBuckets->count() > 0) {
                            $children = collect();

                            // 1. My Orders (All Orders)
                            $myOrdersChild = new \App\Models\Menu(['title' => 'My Orders']);
                            $myOrdersRoute = new \stdClass();
                            $myOrdersRoute->route_name = 'orders.index';
                            $myOrdersChild->route = $myOrdersRoute;
                            $children->push($myOrdersChild);

                            // 2. Individual Status Sub-menus
                            foreach ($orderBuckets as $b) {
                                $childMenu = new \App\Models\Menu(['title' => $b->name]);
                                $cRoute = new \stdClass();
                                $cRoute->route_name = 'orders.index';
                                $childMenu->route = $cRoute;
                                $childMenu->custom_params = ['bucket_id' => $b->id];
                                $children->push($childMenu);
                            }

                            $orderMasterMenu->setRelation('children', $children);
                        }
                    }

                    // Dynamic Email Templates menu item
                    $hasEmailTemplates = $menus->contains(fn($m) => str_contains(strtolower($m->title ?? ''), 'email template'));
                    if (!$hasEmailTemplates) {
                        $tplMenu = new \App\Models\Menu([
                            'title' => 'Email Templates',
                            'icon' => 'feather-mail',
                        ]);
                        $tRoute = new \stdClass();
                        $tRoute->route_name = 'email-templates.index';
                        $tplMenu->route = $tRoute;

                        $mgmtMenu = $menus->first(fn($m) => str_contains(strtolower($m->title ?? ''), 'management') || str_contains(strtolower($m->title ?? ''), 'master'));
                        if ($mgmtMenu) {
                            $children = $mgmtMenu->children ? collect($mgmtMenu->children) : collect();
                            $children->push($tplMenu);
                            $mgmtMenu->setRelation('children', $children);
                        } else {
                            $menus->push($tplMenu);
                        }
                    }

                    // Rename 'Lead Questions' / 'Question' / 'Questions' menu title to 'Attribute' (including child menus)
                    $renameMenuToAttribute = function ($menuList) use (&$renameMenuToAttribute) {
                        foreach ($menuList as $m) {
                            $titleLower = strtolower(trim($m->title ?? ''));
                            if (in_array($titleLower, ['lead question', 'lead questions', 'question', 'questions'])) {
                                $m->title = 'Attribute';
                            }
                            if ($m->children && count($m->children)) {
                                $renameMenuToAttribute($m->children);
                            }
                        }
                    };
                    $renameMenuToAttribute($menus);

                    return $menus;
                });
            } else {
                $menus = collect(); // empty collection if not logged in
            }

            $view->with('menus', $menus);
        });
    }
}

