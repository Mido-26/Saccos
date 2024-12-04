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
            'first_name' => fake()->firstName(), // Generate a first name
            'last_name' => fake()->lastName(), // Generate a last name
            'email' => fake()->unique()->safeEmail(), // Generate a unique email
            'phone_number' => fake()->unique()->phoneNumber(), // Generate a unique phone number
            'Date_OF_Birth' => fake()->date('Y-m-d', '-18 years'), // Generate a date of birth at least 18 years ago
            'Address' => fake()->address(), // Generate a full address
            'status' => fake()->randomElement(['active', 'inactive',]), // Random status
            'email_verified_at' => now(), // Set the email verification timestamp
            'password' => static::$password ??= Hash::make('password'), // Generate a hashed password
            'remember_token' => Str::random(10), // Generate a random token
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
}
