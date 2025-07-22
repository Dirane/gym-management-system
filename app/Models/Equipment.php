<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'model',
        'serial_number',
        'purchase_date',
        'status',
        'maintenance_date',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'maintenance_date' => 'date',
    ];

    // Equipment Status Enum
    const STATUS_GOOD = 'good';
    const STATUS_NEEDS_REPAIR = 'needs_repair';
    const STATUS_DAMAGED = 'damaged';
    const STATUS_OUT_OF_ORDER = 'out_of_order';

    public static function getStatuses()
    {
        return [
            self::STATUS_GOOD => 'Good',
            self::STATUS_NEEDS_REPAIR => 'Needs Repair',
            self::STATUS_DAMAGED => 'Damaged',
            self::STATUS_OUT_OF_ORDER => 'Out of Order',
        ];
    }
}
