<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'job_title' => 'Tester',
            ]
        );

        $this->call([
            AdminSeeder::class,
            ClientsSeeder::class,
            CarsSeeder::class,
            EmployeesSeeder::class,
            TestDrivesSeeder::class,
            AppointmentsSeeder::class,
            SalesSeeder::class,
            CarImagesSeeder::class,
        ]);
    }
}
