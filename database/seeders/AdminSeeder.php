<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@luxedrive.com'],
            [
                'name' => 'Admin',
                'phone' => '+1 (555) 000-0000',
                'role' => 'admin',
                'job_title' => 'Administrator',
                'hired_at' => now()->toDateString(),
                'password' => 'admin123456',
            ]
        );

        User::updateOrCreate(
            ['email' => 'employee@luxedrive.com'],
            [
                'name' => 'Test Employee',
                'phone' => '+1 (555) 111-1111',
                'role' => 'employee',
                'job_title' => 'Salesperson',
                'hired_at' => now()->toDateString(),
                'password' => 'employee123456',
            ]
        );
    }
}
