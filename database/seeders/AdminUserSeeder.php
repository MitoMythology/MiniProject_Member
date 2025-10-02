<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // สร้าง Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // สร้าง Manager
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // สร้าง Staff
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // สร้าง Member
        User::create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // สร้าง Pending Member
        User::create([
            'name' => 'Pending Member',
            'email' => 'pending@example.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'status' => 'pending',
        ]);
    }
}
