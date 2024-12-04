<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Hamidu',
            'last_name' => 'Yusuph',
            'email' => 'admin@gmail.com',
            'phone_number' => '0778854047',
            'Date_OF_Birth' => fake()->date('Y-m-d', '-18 years'), // Generate a date of birth at least 18 years ago
            'Address' => fake()->address(), // Generate a full address
            'role' => 'admin',
            'status' => fake()->randomElement(['active']), // Random status
            'email_verified_at' => now(), // Set the email verification timestamp
            'password' =>  Hash::make('password'), // Generate a hashed password
            'remember_token' => Str::random(10), // Generate a random token
        ]);
    }
}
