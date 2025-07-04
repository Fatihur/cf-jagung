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
        // Create test users
        User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'demo@demo.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
