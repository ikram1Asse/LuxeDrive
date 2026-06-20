<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Database\Seeders\AdminSeeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin/User seed (kept from existing seeder)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')]
        );

        // Core tables
        $this->call([
            AdminSeeder::class,
            ClientsSeeder::class,
            VoituresSeeder::class,
            EmployesSeeder::class,
        ]);


        // Relationship / transactional tables
        $this->call([
            TestDrivesSeeder::class,
            ReservesSeeder::class,
            RendezVousAchatsSeeder::class,
            VentesSeeder::class,
            ImageVoituresSeeder::class,
            DemandesSeeder::class,
            EffectuesSeeder::class,
        ]);
    }
}

