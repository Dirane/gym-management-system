<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Admin and managers can view all users
        if ($user->hasAnyRole(['admin', 'gym_manager'])) {
            return true;
        }

        // Instructors can view their assigned members
        if ($user->hasRole('gym_instructor') && $model->hasRole('gym_member')) {
            return $user->members()->where('member_id', $model->id)->exists();
        }

        // Users can view their own profile
        return $user->id === $model->id;
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
    public function update(User $user, User $model): bool
    {
        // Admin can update all users
        if ($user->hasRole('admin')) {
            return true;
        }

        // Gym manager can update non-admin users
        if ($user->hasRole('gym_manager') && !$model->hasRole('admin')) {
            return true;
        }

        // Users can update their own profile
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Admin can delete non-admin users
        if ($user->hasRole('admin') && !$model->hasRole('admin')) {
            return true;
        }

        // Gym manager can delete members and instructors
        if ($user->hasRole('gym_manager') && $model->hasAnyRole(['gym_member', 'gym_instructor', 'visitor'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can assign roles to users.
     */
    public function assignRole(User $user, User $model): bool
    {
        // Only admin can assign admin role
        if ($user->hasRole('admin')) {
            return true;
        }

        // Gym manager can assign non-admin roles
        if ($user->hasRole('gym_manager') && !$model->hasRole('admin')) {
            return true;
        }

        return false;
    }
}
