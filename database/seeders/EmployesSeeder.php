<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployesSeeder extends Seeder
{

    public function run(): void
    {
        $employes = [
            [
                'nom' => 'Hassan El Amrani',
                'email' => 'hassan.elamrani@example.com',
                'telephone' => '0611111111',
                'role' => 'Vendeur',
                'date_embauche' => '2022-05-15',
                'password' => Hash::make('employee123456'),
            ],

            [
                'nom' => 'Sara Benjelloun',
                'email' => 'sara.benjelloun@example.com',
                'telephone' => '0622222222',
                'role' => 'Conseillère',
                'date_embauche' => '2021-11-01',
                'password' => Hash::make('employee123456'),
            ],

            [
                'nom' => 'Yassine Kettani',
                'email' => 'yassine.kettani@example.com',
                'telephone' => '0633333333',
                'role' => 'Manager',
                'date_embauche' => '2020-09-10',
                'password' => Hash::make('employee123456'),
            ],

        ];

        foreach ($employes as $data) {
            Employe::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}

