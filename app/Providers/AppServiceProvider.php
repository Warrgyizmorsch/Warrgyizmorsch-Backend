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
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('leads') && !\Illuminate\Support\Facades\Schema::hasColumn('leads', 'is_converted')) {
                \Illuminate\Support\Facades\Schema::table('leads', function ($table) {
                    $table->tinyInteger('is_converted')->default(0)->after('lead_bucket_id');
                });
            }
            if (!\Illuminate\Support\Facades\Schema::hasTable('orders')) {
                \Illuminate\Support\Facades\Schema::create('orders', function ($table) {
                    $table->id();
                    $table->string('order_number')->unique();
                    $table->unsignedBigInteger('lead_id')->nullable();
                    $table->unsignedBigInteger('uid')->nullable();
                    $table->unsignedBigInteger('order_bucket_id')->nullable();
                    $table->string('order_status')->nullable();
                    $table->string('order_engagement_status')->nullable();
                    $table->unsignedBigInteger('order_owner')->nullable();
                    $table->unsignedBigInteger('category_id')->nullable();
                    $table->string('product')->nullable();
                    $table->json('services')->nullable();
                    $table->text('pain_points')->nullable();
                    $table->json('client_details')->nullable();
                    $table->json('documents')->nullable();
                    $table->decimal('amount', 12, 2)->default(0);
                    $table->text('notes')->nullable();
                    $table->timestamp('converted_at')->nullable();
                    $table->tinyInteger('is_active')->default(1);
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            // Ignore schema error
        }
        View::composer('*', function ($view) {
            $viewData = $view->getData();
        
            // Safely check if 'meta' is already passed
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

            // Load menus for logged-in user
            if (Auth::check()) {
                $user = Auth::user();
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

                // Dynamically build Order Master Menu if not present
                $orderMasterExists = $menus->contains(fn($m) => strtolower($m->title ?? '') === 'order master');
                if (!$orderMasterExists) {
                    $orderBuckets = \App\Models\Bucket::whereNull('parent_id')
                        ->where('is_deleted', 0)
                        ->where('name', 'NOT LIKE', '%lead%')
                        ->orderBy('id', 'asc')
                        ->get();

                    if ($orderBuckets->count() > 0) {
                        $orderMasterMenu = new \App\Models\Menu([
                            'title' => 'Order Master',
                            'icon'  => 'feather-shopping-bag',
                        ]);

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

                        // Insert right after Leads menu
                        $leadsIndex = $menus->search(fn($m) => str_contains(strtolower($m->title ?? ''), 'lead'));
                        if ($leadsIndex !== false) {
                            $menus->splice($leadsIndex + 1, 0, [$orderMasterMenu]);
                        } else {
                            $menus->push($orderMasterMenu);
                        }
                    }
                }
            } else {
                $menus = collect(); // empty collection if not logged in
            }

            $view->with('menus', $menus);
        });
    }
}
