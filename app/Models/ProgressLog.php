<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_id',
        'instructor_id',
        'date',
        'weight',
        'body_fat_percentage',
        'muscle_mass',
        'notes',
        'photos',
        'measurements',
    ];

    protected $casts = [
        'date' => 'date',
        'weight' => 'decimal:2',
        'body_fat_percentage' => 'decimal:2',
        'muscle_mass' => 'decimal:2',
        'photos' => 'array',
        'measurements' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
