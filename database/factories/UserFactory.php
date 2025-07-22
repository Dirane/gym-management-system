<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'emergency_contact' => fake()->name(),
            'emergency_phone' => fake()->phoneNumber(),
            'medical_conditions' => fake()->optional(0.3)->paragraph(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create an admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Admin User',
            'email' => 'admin@fitlifegym.com',
        ]);
    }

    /**
     * Create a gym manager user.
     */
    public function gymManager(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Gym Manager',
            'email' => 'manager@fitlifegym.com',
        ]);
    }

    /**
     * Create a gym instructor user.
     */
    public function gymInstructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => fake()->name(),
            'email' => 'instructor' . fake()->unique()->numberBetween(1, 10) . '@fitlifegym.com',
        ]);
    }

    /**
     * Create a gym member user.
     */
    public function gymMember(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ]);
    }
}
