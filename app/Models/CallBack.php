<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBack extends Model
{
    use HasFactory;

    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table = 'callback_messages';

    /**
     * Mass assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lead_id',
        'created_by',
        'message',
        'status',
        'bucket',
        'next_followup_date',
        'is_done',
        'call_recording',
        'lead_engagement_status',
        'followup_type',
        'followup_status',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')
                    ->select(['id', 'name']); // only fetch id + name
    }
   
    public function lead()
    {
        return $this->belongsTo(Leads::class ,'lead_id')->select(['id','uid','lead_owner']);
    }


}
