<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientsSeeder extends Seeder
{

    public function run(): void
    {
        $clients = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Alice',
                'email' => 'alice.dupont@example.com',
                'telephone' => '0600000001',
                'adresse' => '12 Rue de Paris, Casablanca',
                'date_inscription' => '2024-01-10',
                'password' => Hash::make('client123456'),
            ],

            [
                'nom' => 'Martin',
                'prenom' => 'Karim',
                'email' => 'karim.martin@example.com',
                'telephone' => '0600000002',
                'adresse' => '45 Avenue Hassan II, Rabat',
                'date_inscription' => '2024-02-05',
                'password' => Hash::make('client123456'),
            ],

            [
                'nom' => 'Benali',
                'prenom' => 'Nadia',
                'email' => 'nadia.benali@example.com',
                'telephone' => '0600000003',
                'adresse' => '7 Boulevard Mohamed V, Marrakech',
                'date_inscription' => '2024-02-20',
                'password' => Hash::make('client123456'),
            ],

            [
                'nom' => 'El Idrissi',
                'prenom' => 'Youssef',
                'email' => 'youssef.elidrissi@example.com',
                'telephone' => '0600000004',
                'adresse' => '99 Route de l\'Oasis, Agadir',
                'date_inscription' => '2024-03-12',
                'password' => Hash::make('client123456'),
            ],

            [
                'nom' => 'Ziani',
                'prenom' => 'Salma',
                'email' => 'salma.ziani@example.com',
                'telephone' => '0600000005',
                'adresse' => '3 Rue des Orangers, Fès',
                'date_inscription' => '2024-03-28',
                'password' => Hash::make('client123456'),
            ],

        ];

        foreach ($clients as $data) {
            Client::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}

