<?php

namespace Database\Seeders;

use App\Models\EmployeAuth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        EmployeAuth::updateOrCreate(
            ['email' => 'admin@luxedrive.com'],
            [
                'nom' => 'Admin',
                'telephone' => '+1 (555) 000-0000',
                'role' => 'admin',
                'date_embauche' => now()->toDateString(),
                'password' => Hash::make("admin123456"),
            ]
        );

        EmployeAuth::updateOrCreate(
            ['email' => 'employee@luxedrive.com'],
            [
                'nom' => 'Test Employe',
                'telephone' => '+1 (555) 111-1111',
                'role' => 'vendeur',
                'date_embauche' => now()->toDateString(),
                'password' => Hash::make("employee123456"),
            ]
        );
    }
}



