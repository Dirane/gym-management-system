<?php

namespace App\Policies;

use App\Models\Package;
use App\Models\User;

class PackagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can view packages (for selecting memberships)
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Package $package): bool
    {
        // All authenticated users can view individual packages
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
    public function update(User $user, Package $package): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Package $package): bool
    {
        // Only admin can delete packages to prevent accidental loss of membership data
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Package $package): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Package $package): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can activate/deactivate the package.
     */
    public function toggleStatus(User $user, Package $package): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }
}
