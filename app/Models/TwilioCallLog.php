<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwilioCallLog extends Model
{
    protected $table = 'twilio_call_logs';

    protected $fillable = [
        'call_sid',
        'direction',
        'status',
        'from_number',
        'to_number',
        'customer_name',
        'duration',
        'agent_user_id',
        'agent_identity',
        'started_at',
        'ended_at',
        'notes',
        'recording_url',
        'recording_sid',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
        'duration'   => 'integer',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_user_id');
    }

    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->duration ?? 0;
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        return sprintf('%02d:%02d', $minutes, $remainingSeconds);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'completed'   => 'Completed',
            'missed'      => 'Missed Call',
            'no-answer'   => 'No Answer',
            'failed'      => 'Failed',
            'cancelled'   => 'Cancelled',
            'in-progress' => 'In Progress',
            'ringing'     => 'Ringing',
            default       => ucfirst($this->status),
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'completed'   => 'badge-light-success text-success',
            'missed'      => 'badge-light-danger text-danger',
            'no-answer'   => 'badge-light-warning text-warning',
            'failed'      => 'badge-light-danger text-danger',
            'cancelled'   => 'badge-light-secondary text-muted',
            'in-progress' => 'badge-light-primary text-primary',
            'ringing'     => 'badge-light-info text-info',
            default       => 'badge-light-secondary text-muted',
        };
    }
}

