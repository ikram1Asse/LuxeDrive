<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
class ClientsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'last_name' => 'Dupont',
                'first_name' => 'Alice',
                'email' => 'alice.dupont@example.com',
                'phone' => '0600000001',
                'address' => '12 Rue de Paris, Casablanca',
                'registered_at' => '2024-01-10',
                'password' => 'client123456',
            ],
            [
                'last_name' => 'Martin',
                'first_name' => 'Karim',
                'email' => 'karim.martin@example.com',
                'phone' => '0600000002',
                'address' => '45 Avenue Hassan II, Rabat',
                'registered_at' => '2024-02-05',
                'password' => 'client123456',
            ],
            [
                'last_name' => 'Benali',
                'first_name' => 'Nadia',
                'email' => 'nadia.benali@example.com',
                'phone' => '0600000003',
                'address' => '7 Boulevard Mohamed V, Marrakech',
                'registered_at' => '2024-02-20',
                'password' => 'client123456',
            ],
            [
                'last_name' => 'El Idrissi',
                'first_name' => 'Youssef',
                'email' => 'youssef.elidrissi@example.com',
                'phone' => '0600000004',
                'address' => '99 Route de l\'Oasis, Agadir',
                'registered_at' => '2024-03-12',
                'password' => 'client123456',
            ],
            [
                'last_name' => 'Ziani',
                'first_name' => 'Salma',
                'email' => 'salma.ziani@example.com',
                'phone' => '0600000005',
                'address' => '3 Rue des Orangers, Fès',
                'registered_at' => '2024-03-28',
                'password' => 'client123456',
            ],
        ];

        foreach ($clients as $data) {
            Client::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
