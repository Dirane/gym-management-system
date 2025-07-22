<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Service;
use App\Models\Equipment;
use App\Models\Announcement;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create packages
        Package::create([
            'name' => 'Basic Monthly',
            'description' => 'Perfect for beginners looking to start their fitness journey. Access to all basic equipment and facilities.',
            'price' => 10000,
            'duration_months' => 1,
            'features' => [
                'Full gym access',
                'Locker room access',
                'Basic equipment usage',
                'Free Wi-Fi'
            ],
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Premium 6 Months',
            'description' => 'Our most popular package! Save money with 6-month commitment and get additional benefits.',
            'price' => 50000,
            'duration_months' => 6,
            'features' => [
                'Full gym access',
                'Unlimited group classes',
                'Personal trainer consultation',
                'Nutrition guidance',
                'Priority equipment access',
                'Guest passes (2 per month)',
                '10% discount on supplements'
            ],
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Elite Annual',
            'description' => 'Ultimate fitness experience for serious athletes and fitness enthusiasts.',
            'price' => 90000,
            'duration_months' => 12,
            'features' => [
                'Full gym access',
                'Unlimited group classes',
                'Monthly personal training sessions',
                'Nutrition consultation',
                'Body composition analysis',
                '24/7 gym access',
                'Free gym merchandise',
                'Guest passes (5 per month)',
                '20% discount on all services'
            ],
            'is_active' => true,
        ]);

        // Create services
        Service::create([
            'name' => 'Personal Training',
            'description' => 'One-on-one training sessions with certified trainers. Customized workout plans and nutrition guidance.',
            'price' => 15000,
            'duration_minutes' => 60,
            'max_participants' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Group Fitness Classes',
            'description' => 'High-energy group workouts including Zumba, HIIT, Yoga, and more. Fun and motivating environment.',
            'price' => 3000,
            'duration_minutes' => 45,
            'max_participants' => 20,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Yoga Classes',
            'description' => 'Relaxing and strengthening yoga sessions for all skill levels. Improve flexibility and mindfulness.',
            'price' => 2500,
            'duration_minutes' => 60,
            'max_participants' => 15,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Nutrition Consultation',
            'description' => 'Professional nutrition advice and meal planning to complement your fitness goals.',
            'price' => 8000,
            'duration_minutes' => 45,
            'max_participants' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Body Composition Analysis',
            'description' => 'Complete body analysis including BMI, muscle mass, and body fat percentage measurement.',
            'price' => 5000,
            'duration_minutes' => 30,
            'max_participants' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Strength Training Bootcamp',
            'description' => 'Intensive strength training sessions designed to build muscle and increase power.',
            'price' => 4000,
            'duration_minutes' => 50,
            'max_participants' => 12,
            'is_active' => true,
        ]);

        // Create equipment
        Equipment::create([
            'name' => 'Treadmill Pro X1',
            'category' => 'Cardio',
            'model' => 'ProX1-2023',
            'serial_number' => 'TM001',
            'purchase_date' => '2023-01-15',
            'status' => 'good',
            'maintenance_date' => '2024-07-01',
            'notes' => 'Regular maintenance completed. Working perfectly.',
        ]);

        Equipment::create([
            'name' => 'Olympic Barbell Set',
            'category' => 'Weight Training',
            'model' => 'Olympic-45lb',
            'serial_number' => 'BB001',
            'purchase_date' => '2023-02-20',
            'status' => 'good',
            'maintenance_date' => '2024-06-15',
            'notes' => 'Complete set with plates. All equipment in excellent condition.',
        ]);

        Equipment::create([
            'name' => 'Elliptical Machine',
            'category' => 'Cardio',
            'model' => 'ElliptiMax-500',
            'serial_number' => 'EM001',
            'purchase_date' => '2023-03-10',
            'status' => 'needs_repair',
            'maintenance_date' => '2024-07-10',
            'notes' => 'Display screen flickering. Scheduled for repair next week.',
        ]);

        Equipment::create([
            'name' => 'Leg Press Machine',
            'category' => 'Strength Training',
            'model' => 'LegMax-Pro',
            'serial_number' => 'LP001',
            'purchase_date' => '2023-04-05',
            'status' => 'good',
            'maintenance_date' => '2024-07-05',
            'notes' => 'Recently serviced. Safety checks passed.',
        ]);

        Equipment::create([
            'name' => 'Cable Crossover Machine',
            'category' => 'Strength Training',
            'model' => 'CrossMax-Dual',
            'serial_number' => 'CC001',
            'purchase_date' => '2023-05-12',
            'status' => 'good',
            'maintenance_date' => '2024-06-20',
            'notes' => 'All cables and pulleys working smoothly.',
        ]);

        // Get admin user for announcements
        $admin = User::where('email', 'manager@gmail.com')->first();
        if ($admin) {
            // Create announcements
            Announcement::create([
                'title' => 'New Equipment Arrival!',
                'content' => 'We\'re excited to announce the arrival of new state-of-the-art cardio equipment! Come check out our latest treadmills and elliptical machines featuring advanced tracking and entertainment systems.',
                'published_by' => $admin->id,
                'published_at' => now(),
                'expires_at' => now()->addMonth(),
                'is_published' => true,
                'priority' => 'high',
                'target_audience' => ['gym_member', 'gym_instructor'],
            ]);

            Announcement::create([
                'title' => 'Summer Fitness Challenge 2024',
                'content' => 'Join our 8-week summer fitness challenge starting August 1st! Prizes for top performers including free personal training sessions and supplements. Registration open now at the front desk.',
                'published_by' => $admin->id,
                'published_at' => now()->subDays(5),
                'expires_at' => now()->addWeeks(6),
                'is_published' => true,
                'priority' => 'normal',
                'target_audience' => ['gym_member'],
            ]);

            Announcement::create([
                'title' => 'Extended Hours During Peak Season',
                'content' => 'Starting this month, we\'re extending our weekday hours! The gym will now be open until 11 PM Monday through Friday to accommodate your busy schedules.',
                'published_by' => $admin->id,
                'published_at' => now()->subDays(10),
                'expires_at' => null,
                'is_published' => true,
                'priority' => 'normal',
                'target_audience' => ['gym_member', 'gym_instructor'],
            ]);

            Announcement::create([
                'title' => 'Maintenance Notice - Locker Room',
                'content' => 'Please be advised that the men\'s locker room will undergo scheduled maintenance on Saturday, July 27th from 6 AM to 12 PM. Alternative changing facilities will be available.',
                'published_by' => $admin->id,
                'published_at' => now()->subDays(2),
                'expires_at' => now()->addDays(5),
                'is_published' => true,
                'priority' => 'urgent',
                'target_audience' => ['gym_member', 'gym_instructor'],
            ]);
        }
    }
}
