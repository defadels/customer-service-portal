<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@corisindo.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'department' => 'IT',
            'skills' => ['Management', 'System Administration', 'Customer Service'],
            'status' => 'active',
        ]);

        // Create Supervisor User
        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@corisindo.com',
            'password' => Hash::make('password123'),
            'role' => 'supervisor',
            'phone' => '081234567891',
            'department' => 'Customer Service',
            'skills' => ['Team Management', 'Customer Service', 'Problem Solving'],
            'status' => 'active',
        ]);

        // Create Agent User
        User::create([
            'name' => 'Agent',
            'email' => 'agent@corisindo.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
            'phone' => '081234567892',
            'department' => 'Customer Service',
            'skills' => ['Customer Service', 'Communication', 'Problem Solving'],
            'status' => 'active',
        ]);

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: admin@corisindo.com, Password: password123');
        $this->command->info('Email: supervisor@corisindo.com, Password: password123');
        $this->command->info('Email: agent@corisindo.com, Password: password123');
    }
}
