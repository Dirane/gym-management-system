<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'status',
        'registration_fee',
        'monthly_fee',
        'discount_applied',
        'card_number',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_fee' => 'decimal:2',
        'monthly_fee' => 'decimal:2',
        'discount_applied' => 'decimal:2',
    ];

    // Membership Status
    const STATUS_ACTIVE = 'active';
    const STATUS_EXPIRED = 'expired';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PENDING = 'pending';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending Payment',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_SUSPENDED => 'Suspended',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE && $this->end_date >= now();
    }

    public function isExpired()
    {
        return $this->end_date < now();
    }
}
