<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Create an admin user if it doesn't already exist
    User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Replace with a secure password
                'role_id' => 1, // Assuming 1 is the role_id for Admin
            ]
        );

    // Create a regular user if it doesn't already exist
    User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'), // Replace with a secure password
                'role_id' => 2, // Assuming 2 is the role_id for User
            ]
        );
}
}