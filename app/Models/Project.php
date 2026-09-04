<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to search by project name or description.
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!empty($term)) {
            return $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            });
        }
        return $query;
    }

    /**
     * Scope to filter by status.
     */
    public function scopeFilterStatus($query, ?string $status)
    {
        if (!empty($status) && in_array($status, ['Active', 'Inactive'], true)) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Check if project is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'Active';
    }
}
