<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_minutes',
        'max_participants',
        'is_active',
        'name_fr',
        'description_fr',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Translation methods
    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'fr' && $this->name_fr) {
            return $this->name_fr;
        }
        return $this->name;
    }

    public function getTranslatedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'fr' && $this->description_fr) {
            return $this->description_fr;
        }
        return $this->description;
    }

    // Relationships
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'service_instructor', 'service_id', 'instructor_id');
    }
}
