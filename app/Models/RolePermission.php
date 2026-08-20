<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['role_id', 'route_id', 'menu_id'];

    protected static function booted()
    {
        static::saved(function () {
            Menu::bumpMenuVersion();
        });
        static::deleted(function () {
            Menu::bumpMenuVersion();
        });
    }

    // RolePermission belongs to Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // RolePermission belongs to Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // RolePermission belongs to Route
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
