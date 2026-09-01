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
                // Perform one-time DB menu sync if records missing
                try {
                    $nlRouteId = DB::table('routes')->where('route_name', 'leads.table.index')->value('id');
                    if (!$nlRouteId) {
                        $nlRouteId = DB::table('routes')->insertGetId(['route_name' => 'leads.table.index', 'method' => 'GET', 'is_deleted' => 0, 'created_at' => now(), 'updated_at' => now()]);
                    }
                    $cdRouteId = DB::table('routes')->where('route_name', 'created.deals.index')->value('id');
                    if (!$cdRouteId) {
                        $cdRouteId = DB::table('routes')->insertGetId(['route_name' => 'created.deals.index', 'method' => 'GET', 'is_deleted' => 0, 'created_at' => now(), 'updated_at' => now()]);
                    }
                    $leadsParentId = DB::table('menus')->whereNull('parent_id')->where('title', 'LIKE', '%Lead%')->value('id');
                    if ($leadsParentId) {
                        $m1Exists = DB::table('menus')->where('parent_id', $leadsParentId)->where('title', 'New Leads Table')->exists();
                        if (!$m1Exists) {
                            $mId1 = DB::table('menus')->insertGetId(['parent_id' => $leadsParentId, 'title' => 'New Leads Table', 'icon' => 'feather-list', 'route_id' => $nlRouteId, 'sort_order' => 1, 'is_deleted' => 0, 'created_at' => now(), 'updated_at' => now()]);
                            foreach ([1, 2, 3] as $rId) {
                                DB::table('role_permissions')->updateOrInsert(['role_id' => $rId, 'menu_id' => $mId1], ['is_allowed' => 1, 'updated_at' => now()]);
                            }
                            Menu::bumpMenuVersion();
                        }
                        $m2Exists = DB::table('menus')->where('parent_id', $leadsParentId)->where('title', 'Created Deals')->exists();
                        if (!$m2Exists) {
                            $mId2 = DB::table('menus')->insertGetId(['parent_id' => $leadsParentId, 'title' => 'Created Deals', 'icon' => 'feather-check-square', 'route_id' => $cdRouteId, 'sort_order' => 3, 'is_deleted' => 0, 'created_at' => now(), 'updated_at' => now()]);
                            foreach ([1, 2, 3] as $rId) {
                                DB::table('role_permissions')->updateOrInsert(['role_id' => $rId, 'menu_id' => $mId2], ['is_allowed' => 1, 'updated_at' => now()]);
                            }
                            Menu::bumpMenuVersion();
                        }
                    }
                } catch (\Throwable $e) {
                    \Log::error('Aside DB menu sync error: ' . $e->getMessage());
                }

                $user = Auth::user();
                $menus = Menu::getMenusForUser($user);

                // Ensure "New Leads Table", "Created Deals", and "Converted" exist under Leads menu in view
                $leadsMenu = $menus->first(fn($m) => str_contains(strtolower($m->title ?? ''), 'lead'));
                if ($leadsMenu) {
                    $children = $leadsMenu->children ? collect($leadsMenu->children) : collect();

                    // 1. New Leads Table
                    $hasNewLeads = $children->contains(fn($c) => str_contains(strtolower($c->title ?? ''), 'new lead'));
                    if (!$hasNewLeads) {
                        $newLeadMenu = new \App\Models\Menu(['title' => 'New Leads Table', 'icon' => 'feather-list']);
                        $nlRoute = new \stdClass();
                        $nlRoute->route_name = 'leads.table.index';
                        $newLeadMenu->route = $nlRoute;
                        $children->prepend($newLeadMenu);
                    }

                    // 2. Created Deals
                    $hasCreatedDeals = $children->contains(fn($c) => str_contains(strtolower($c->title ?? ''), 'created deal'));
                    if (!$hasCreatedDeals) {
                        $createdDealMenu = new \App\Models\Menu(['title' => 'Created Deals', 'icon' => 'feather-check-square']);
                        $cdRoute = new \stdClass();
                        $cdRoute->route_name = 'created.deals.index';
                        $createdDealMenu->route = $cdRoute;
                        $children->push($createdDealMenu);
                    }

                    // 3. Converted
                    $hasConverted = $children->contains(fn($c) => str_contains(strtolower($c->title ?? ''), 'converted'));
                    if (!$hasConverted) {
                        $convertedMenu = new \App\Models\Menu(['title' => 'Converted', 'icon' => 'feather-award']);
                        $cRoute = new \stdClass();
                        $cRoute->route_name = 'modern.leads.index';
                        $convertedMenu->route = $cRoute;
                        $convertedMenu->custom_params = ['converted' => 1];
                        $children->push($convertedMenu);
                    }

                    $leadsMenu->setRelation('children', $children);
                }

                    // Add dynamic Follow-ups menu item with 3 tabs
                    $hasFollowups = $menus->contains(fn($m) => str_contains(strtolower($m->title ?? ''), 'followup') || str_contains(strtolower($m->title ?? ''), 'follow-up') || str_contains(strtolower($m->title ?? ''), 'follow up'));
                    if (!$hasFollowups) {
                        $followupMenu = new \App\Models\Menu([
                            'title' => 'Follow-ups',
                            'icon' => 'feather-phone-call',
                        ]);
                        $fRoute = new \stdClass();
                        $fRoute->route_name = 'followups.index';
                        $followupMenu->route = $fRoute;

                        $fChildren = collect();
                        
                        $allF = new \App\Models\Menu(['title' => 'Follow Ups']);
                        $aR = new \stdClass(); $aR->route_name = 'followups.index'; $allF->route = $aR; $allF->custom_params = ['tab' => 'all'];
                        $fChildren->push($allF);

                        $nextF = new \App\Models\Menu(['title' => 'Next Followup']);
                        $nR = new \stdClass(); $nR->route_name = 'followups.index'; $nextF->route = $nR; $nextF->custom_params = ['tab' => 'next'];
                        $fChildren->push($nextF);

                        $dueF = new \App\Models\Menu(['title' => 'Due Followup']);
                        $dR = new \stdClass(); $dR->route_name = 'followups.index'; $dueF->route = $dR; $dueF->custom_params = ['tab' => 'due'];
                        $fChildren->push($dueF);

                        $followupMenu->setRelation('children', $fChildren);

                        $leadsIdx = $menus->search(fn($m) => str_contains(strtolower($m->title ?? ''), 'lead'));
                        if ($leadsIdx !== false) {
                            $menus->splice($leadsIdx + 1, 0, [$followupMenu]);
                        } else {
                            $menus->push($followupMenu);
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
            } else {
                $menus = collect(); // empty collection if not logged in
            }

            $view->with('menus', $menus);
        });
    }
}

