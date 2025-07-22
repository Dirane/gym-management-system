<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_value',
        'current_value',
        'unit',
        'target_date',
        'status',
        'before_photo',
        'after_photo',
    ];

    protected $casts = [
        'target_date' => 'date',
        'target_value' => 'decimal:2',
        'current_value' => 'decimal:2',
    ];

    // Goal Status
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PAUSED = 'paused';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_PAUSED => 'Paused',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progressLogs()
    {
        return $this->hasMany(ProgressLog::class);
    }

    // Helper methods
    public function getProgressPercentage()
    {
        if ($this->target_value == 0) return 0;
        return min(100, ($this->current_value / $this->target_value) * 100);
    }
}
