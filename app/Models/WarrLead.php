<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrLead extends Model
{
    use HasFactory;

    protected $table = 'warr_leads';

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'mobile_no',
        'designation',
        'company_size',
        'service_categories',
        'message',
        'comment',
        'source',
        'page_url',
        'form_type',
        'form_details',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'form_details' => 'array',
        ];
    }
}
