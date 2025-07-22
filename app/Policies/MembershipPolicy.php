<?php

namespace App\Policies;

use App\Models\Membership;
use App\Models\User;

class MembershipPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager', 'gym_instructor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Membership $membership): bool
    {
        // Admin and managers can view all memberships
        if ($user->hasAnyRole(['admin', 'gym_manager'])) {
            return true;
        }

        // Instructors can view memberships of their assigned members
        if ($user->hasRole('gym_instructor')) {
            return $user->members()->where('member_id', $membership->user_id)->exists();
        }

        // Members can view their own membership
        return $user->id === $membership->user_id;
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
    public function update(User $user, Membership $membership): bool
    {
        // Admin and managers can update all memberships
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Membership $membership): bool
    {
        // Admin and managers can delete memberships
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Membership $membership): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Membership $membership): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can renew the membership.
     */
    public function renew(User $user, Membership $membership): bool
    {
        // Admin and managers can renew any membership
        if ($user->hasAnyRole(['admin', 'gym_manager'])) {
            return true;
        }

        // Members can renew their own membership
        return $user->id === $membership->user_id;
    }

    /**
     * Determine whether the user can suspend the membership.
     */
    public function suspend(User $user, Membership $membership): bool
    {
        return $user->hasAnyRole(['admin', 'gym_manager']);
    }
}
