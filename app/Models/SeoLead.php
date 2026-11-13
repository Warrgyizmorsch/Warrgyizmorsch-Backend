<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoLead extends Model
{
    use HasFactory;

    protected $table = 'seo_leads';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'website_url',
        'interested_services',
        'monthly_spend',
        'growth_goal',
        'status',
        'is_converted',
        'converted_lead_id',
        'converted_at',
    ];

    protected $casts = [
        'is_converted' => 'boolean',
        'converted_at' => 'datetime',
    ];

    public function convertedLead()
    {
        return $this->belongsTo(Leads::class, 'converted_lead_id');
    }
}
