<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Membership;
use App\Models\Package;
use App\Models\Service;
use App\Policies\UserPolicy;
use App\Policies\MembershipPolicy;
use App\Policies\PackagePolicy;
use App\Policies\ServicePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Membership::class => MembershipPolicy::class,
        Package::class => PackagePolicy::class,
        Service::class => ServicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates for specific actions
        Gate::define('access-admin-panel', function (User $user) {
            return $user->hasAnyRole(['admin', 'gym_manager', 'gym_instructor']);
        });

        Gate::define('manage-roles', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-reports', function (User $user) {
            return $user->hasAnyRole(['admin', 'gym_manager']);
        });

        Gate::define('manage-payments', function (User $user) {
            return $user->hasAnyRole(['admin', 'gym_manager']);
        });

        Gate::define('manage-equipment', function (User $user) {
            return $user->hasAnyRole(['admin', 'gym_manager']);
        });

        Gate::define('manage-announcements', function (User $user) {
            return $user->hasAnyRole(['admin', 'gym_manager']);
        });

        Gate::define('view-member-progress', function (User $user, User $member) {
            // Admin and managers can view all member progress
            if ($user->hasAnyRole(['admin', 'gym_manager'])) {
                return true;
            }

            // Instructors can view their assigned members' progress
            if ($user->hasRole('gym_instructor') && $member->hasRole('gym_member')) {
                return $user->members()->where('member_id', $member->id)->exists();
            }

            // Members can view their own progress
            return $user->id === $member->id;
        });

        Gate::define('create-progress-log', function (User $user, User $member) {
            // Admin, managers, and instructors can create progress logs for members
            if ($user->hasAnyRole(['admin', 'gym_manager'])) {
                return true;
            }

            // Instructors can create progress logs for their assigned members
            if ($user->hasRole('gym_instructor') && $member->hasRole('gym_member')) {
                return $user->members()->where('member_id', $member->id)->exists();
            }

            // Members can create their own progress logs
            return $user->id === $member->id;
        });
    }
}
