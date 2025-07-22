<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Package;
use App\Models\Membership;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::factory()->admin()->create();
        $admin->assignRole('admin');

        // Create Gym Manager
        $manager = User::factory()->gymManager()->create();
        $manager->assignRole('gym_manager');

        // Create Gym Instructors
        $instructors = User::factory()->gymInstructor()->count(5)->create();
        foreach ($instructors as $instructor) {
            $instructor->assignRole('gym_instructor');
        }

        // Create Gym Members with Memberships
        $packages = Package::where('is_active', true)->get();
        
        if ($packages->count() > 0) {
            // Create 20 active members
            $members = User::factory()->gymMember()->count(20)->create();
            
            foreach ($members as $member) {
                $member->assignRole('gym_member');
                
                // Assign a random package
                $package = $packages->random();
                
                // Create membership with varying start dates (some recent, some older)
                $startDate = Carbon::now()->subDays(rand(0, 365));
                $endDate = $startDate->copy()->addMonths($package->duration_months);
                
                // Determine membership status based on end date
                $status = $endDate < now() ? 
                    (rand(1, 10) > 8 ? Membership::STATUS_EXPIRED : Membership::STATUS_ACTIVE) : 
                    Membership::STATUS_ACTIVE;
                
                // Generate unique card number
                $cardNumber = 'GYM' . str_pad($member->id, 6, '0', STR_PAD_LEFT);
                
                Membership::create([
                    'user_id' => $member->id,
                    'package_id' => $package->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status' => $status,
                    'registration_fee' => 5000.00,
                    'monthly_fee' => $package->price / $package->duration_months,
                    'discount_applied' => rand(0, 1) ? rand(500, 2000) : 0,
                    'card_number' => $cardNumber,
                ]);
            }

            // Create some members with expired memberships
            $expiredMembers = User::factory()->gymMember()->count(5)->create();
            
            foreach ($expiredMembers as $member) {
                $member->assignRole('gym_member');
                
                $package = $packages->random();
                
                // Create expired membership
                $startDate = Carbon::now()->subMonths(rand(6, 24));
                $endDate = $startDate->copy()->addMonths($package->duration_months);
                
                $cardNumber = 'GYM' . str_pad($member->id, 6, '0', STR_PAD_LEFT);
                
                Membership::create([
                    'user_id' => $member->id,
                    'package_id' => $package->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status' => Membership::STATUS_EXPIRED,
                    'registration_fee' => 5000.00,
                    'monthly_fee' => $package->price / $package->duration_months,
                    'discount_applied' => 0,
                    'card_number' => $cardNumber,
                ]);
            }

            // Assign some members to instructors (member-instructor relationships)
            $allMembers = User::role('gym_member')->get();
            $allInstructors = User::role('gym_instructor')->get();
            
            foreach ($allInstructors as $instructor) {
                // Each instructor gets 5-10 members
                $assignedMembers = $allMembers->random(rand(5, 10));
                $instructor->members()->attach($assignedMembers->pluck('id'));
            }
        }

        // Create some visitors (users without roles/memberships)
        User::factory()->count(10)->create();
        foreach (User::doesntHave('roles')->get() as $visitor) {
            $visitor->assignRole('visitor');
        }

        $this->command->info('Users seeded successfully:');
        $this->command->info('- 1 Admin');
        $this->command->info('- 1 Gym Manager');
        $this->command->info('- 5 Gym Instructors');
        $this->command->info('- 25 Gym Members (20 active, 5 expired)');
        $this->command->info('- 10 Visitors');
        $this->command->info('');
        $this->command->info('Login credentials:');
        $this->command->info('Admin: admin@fitlifegym.com / password');
        $this->command->info('Manager: manager@fitlifegym.com / password');
        $this->command->info('All other users: [their email] / password');
    }
} 