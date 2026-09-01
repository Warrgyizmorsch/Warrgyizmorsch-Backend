<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'lead_id',
        'uid',
        'order_bucket_id',
        'order_status',
        'order_engagement_status',
        'order_owner',
        'converted_by',
        'category_id',
        'product',
        'services',
        'pain_points',
        'client_details',
        'documents',
        'amount',
        'notes',
        'converted_at',
        'is_active',
        'is_archived',
    ];

    protected $casts = [
        'services' => 'array',
        'client_details' => 'array',
        'documents' => 'array',
        'converted_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id', 'id');
    }

    public function bucket()
    {
        return $this->belongsTo(Bucket::class, 'order_bucket_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'order_owner', 'id');
    }

    public function converter()
    {
        return $this->belongsTo(User::class, 'converted_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(CallBack::class, 'lead_id', 'lead_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->orderBy('name');
    }
}
