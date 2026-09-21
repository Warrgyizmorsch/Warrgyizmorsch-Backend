<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeadEvent extends Model
{
    use HasFactory;

    protected $table = 'lead_events';

    // Allowed Event Types
    public const TYPE_MEETING_SCHEDULE = 'meeting_schedule';
    public const TYPE_DISCOVERY_CALL = 'discovery_call';
    public const TYPE_PROJECTION_CALL = 'projection_call';
    public const TYPE_CONVERSION = 'conversion';

    // Allowed Event Statuses
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_RESCHEDULED = 'rescheduled';

    protected $fillable = [
        'lead_id',
        'event_type',
        'event_date',
        'start_time',
        'end_time',
        'assigned_to',
        'title',
        'description',
        'status',
        'completed_at',
        'created_by',
    ];

    protected $casts = [
        'event_date' => 'date:Y-m-d',
        'completed_at' => 'datetime',
    ];

    /**
     * Map of event types with human-readable labels
     */
    public static function getEventTypes(): array
    {
        return [
            self::TYPE_MEETING_SCHEDULE => 'Meeting Schedule',
            self::TYPE_DISCOVERY_CALL => 'Discovery Call',
            self::TYPE_PROJECTION_CALL => 'Projection Call',
            self::TYPE_CONVERSION => 'Conversion',
        ];
    }

    /**
     * Map of statuses with human-readable labels
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_SCHEDULED => 'Scheduled',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_RESCHEDULED => 'Rescheduled',
        ];
    }

    /**
     * Associated Lead
     */
    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    /**
     * Assigned User
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Creator of the event
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope: Scheduled events happening on or after today
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', self::STATUS_SCHEDULED)
                     ->where('event_date', '>=', Carbon::today()->toDateString());
    }

    /**
     * Scope: Scheduled events whose date is before today
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', self::STATUS_SCHEDULED)
                     ->where('event_date', '<', Carbon::today()->toDateString());
    }

    /**
     * Scope: Scheduled events for today
     */
    public function scopeToday($query)
    {
        return $query->where('status', self::STATUS_SCHEDULED)
                     ->whereDate('event_date', Carbon::today()->toDateString());
    }

    /**
     * Scope: Scheduled events for tomorrow
     */
    public function scopeTomorrow($query)
    {
        return $query->where('status', self::STATUS_SCHEDULED)
                     ->whereDate('event_date', Carbon::tomorrow()->toDateString());
    }

    /**
     * Scope: Scheduled events for this week
     */
    public function scopeThisWeek($query)
    {
        return $query->where('status', self::STATUS_SCHEDULED)
                     ->whereBetween('event_date', [
                         Carbon::now()->startOfWeek()->toDateString(),
                         Carbon::now()->endOfWeek()->toDateString()
                     ]);
    }

    /**
     * Formatted label for event type
     */
    public function getTypeLabelAttribute(): string
    {
        $types = self::getEventTypes();
        return $types[$this->event_type] ?? ucwords(str_replace('_', ' ', $this->event_type));
    }

    /**
     * Formatted label for status
     */
    public function getStatusLabelAttribute(): string
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? ucfirst($this->status);
    }
}
