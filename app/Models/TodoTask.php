<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $fillable = [
        'lead_id',
        'assigned_to',
        'created_by', 
        'summary', 
        'due_date', 
        'status',
        'remark'
        ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $maxId = \Illuminate\Support\Facades\DB::table('todo_tasks')->max('id');
                $model->id = ($maxId ? (int)$maxId : 0) + 1;
            }
        });
    }

    // Jis user ko task assign kiya gaya hai
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
