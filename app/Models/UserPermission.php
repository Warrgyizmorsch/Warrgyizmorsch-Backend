<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = ['user_id', 'route_id', 'menu_id'];

    protected static function booted()
    {
        static::saved(function () {
            Menu::bumpMenuVersion();
        });
        static::deleted(function () {
            Menu::bumpMenuVersion();
        });
    }

    // UserPermission belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // UserPermission belongs to Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // UserPermission belongs to Route
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
