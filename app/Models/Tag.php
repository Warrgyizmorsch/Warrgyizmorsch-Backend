<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'color', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function leads()
    {
        return $this->morphedByMany(Leads::class, 'taggable');
    }

    public function orders()
    {
        return $this->morphedByMany(Order::class, 'taggable');
    }
}
