<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PluginSetting extends Model
{
    protected $table = 'plugin_settings';

    protected $fillable = [
        'plugin_key',
        'name',
        'category',
        'description',
        'is_active',
        'settings',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings'  => 'array',
    ];
}
