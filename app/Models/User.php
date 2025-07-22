<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'date_of_birth',
        'emergency_contact',
        'emergency_phone',
        'medical_conditions',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['admin', 'gym_manager', 'gym_instructor']);
    }

    // Relationships
    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function progressLogs()
    {
        return $this->hasMany(ProgressLog::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Instructors assigned to this member (many-to-many)
    public function instructors()
    {
        return $this->belongsToMany(User::class, 'member_instructor', 'member_id', 'instructor_id');
    }

    // Members assigned to this instructor (many-to-many)
    public function members()
    {
        return $this->belongsToMany(User::class, 'member_instructor', 'instructor_id', 'member_id');
    }

    // Services selected by this user (many-to-many)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'user_service');
    }
}
