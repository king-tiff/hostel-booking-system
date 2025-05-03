<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Always hash passwords!
        ]);
        $admin->assignRole('admin'); // Assign 'admin' role

        // Create Landlord User
        $landlord = User::create([
            'name' => 'Landlord User',
            'email' => 'landlord@example.com',
            'password' => Hash::make('password'),
        ]);
        $landlord->assignRole('landlord');

        // Create Regular User
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('user');

        // Optional: Create multiple test users
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user'); // Assign default role
        });
    }
}
