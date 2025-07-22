<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_months',
        'features',
        'is_active',
        'name_fr',
        'description_fr',
        'features_fr',
    ];

    protected $casts = [
        'features' => 'array',
        'features_fr' => 'array',
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

    public function getTranslatedFeaturesAttribute()
    {
        $locale = app()->getLocale();
        if ($locale === 'fr' && $this->features_fr) {
            return $this->features_fr;
        }
        return $this->features;
    }

    // Relationships
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
