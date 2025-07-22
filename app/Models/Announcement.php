<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'published_by',
        'published_at',
        'expires_at',
        'is_published',
        'priority',
        'target_audience',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_published' => 'boolean',
        'target_audience' => 'array',
    ];

    // Priority levels
    const PRIORITY_LOW = 'low';
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    public static function getPriorities()
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_NORMAL => 'Normal',
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_URGENT => 'Urgent',
        ];
    }

    // Relationships
    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now())
                     ->where(function ($q) {
                         $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
                     });
    }

    public function scopeActive($query)
    {
        return $query->published();
    }
}
