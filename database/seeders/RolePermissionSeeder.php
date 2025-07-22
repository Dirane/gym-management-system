<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Member management
            'view members',
            'create members',
            'edit members',
            'delete members',
            
            // Instructor management
            'view instructors',
            'create instructors',
            'edit instructors',
            'delete instructors',
            
            // Package management
            'view packages',
            'create packages',
            'edit packages',
            'delete packages',
            
            // Service management
            'view services',
            'create services',
            'edit services',
            'delete services',
            
            // Equipment management
            'view equipment',
            'create equipment',
            'edit equipment',
            'delete equipment',
            
            // Membership management
            'view memberships',
            'create memberships',
            'edit memberships',
            'delete memberships',
            
            // Payment management
            'view payments',
            'create payments',
            'edit payments',
            'delete payments',
            
            // Announcement management
            'view announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',
            
            // Goal and Progress management
            'view goals',
            'create goals',
            'edit goals',
            'delete goals',
            'view progress',
            'create progress',
            'edit progress',
            'delete progress',
            
            // Reports
            'view reports',
            'export reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin role - full access
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Gym Manager role
        $managerRole = Role::firstOrCreate(['name' => 'gym_manager']);
        $managerPermissions = [
            'view members', 'create members', 'edit members', 'delete members',
            'view instructors', 'create instructors', 'edit instructors', 'delete instructors',
            'view packages', 'create packages', 'edit packages', 'delete packages',
            'view services', 'create services', 'edit services', 'delete services',
            'view equipment', 'create equipment', 'edit equipment', 'delete equipment',
            'view memberships', 'create memberships', 'edit memberships', 'delete memberships',
            'view payments', 'create payments', 'edit payments', 'delete payments',
            'view announcements', 'create announcements', 'edit announcements', 'delete announcements',
            'view goals', 'create goals', 'edit goals', 'delete goals',
            'view progress', 'create progress', 'edit progress', 'delete progress',
            'view reports', 'export reports',
        ];
        $managerRole->givePermissionTo($managerPermissions);

        // Gym Instructor role
        $instructorRole = Role::firstOrCreate(['name' => 'gym_instructor']);
        $instructorPermissions = [
            'view members',
            'view goals', 'edit goals',
            'view progress', 'create progress', 'edit progress',
            'view announcements',
        ];
        $instructorRole->givePermissionTo($instructorPermissions);

        // Gym Member role
        $memberRole = Role::firstOrCreate(['name' => 'gym_member']);
        $memberPermissions = [
            'view goals', 'create goals', 'edit goals',
            'view progress', 'create progress',
            'view announcements',
        ];
        $memberRole->givePermissionTo($memberPermissions);

        // Visitor role (for public users)
        $visitorRole = Role::firstOrCreate(['name' => 'visitor']);
        // Visitors have no special permissions - they can only browse public content

        // Assign admin role to existing user
        $adminUser = User::where('email', 'manager@gmail.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}
