<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can view services
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): bool
    {
        // All authenticated users can view individual services
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can book the service.
     */
    public function book(User $user, Service $service): bool
    {
        // All authenticated users can book services
        return true;
    }

    /**
     * Determine whether the user can manage service bookings.
     */
    public function manageBookings(User $user, Service $service): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager', 'gym_instructor']);
    }

    /**
     * Determine whether the user can activate/deactivate the service.
     */
    public function toggleStatus(User $user, Service $service): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }
}
