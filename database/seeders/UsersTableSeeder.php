<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create a regular user
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@library.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create some random users
        User::factory(8)->create([
            'is_admin' => false,
        ]);
    }
}
