<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\TestDrive;
use App\Models\Voiture;
use Illuminate\Database\Seeder;

class TestDrivesSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id_client')->get();
        $voitures = Voiture::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $voitures->isEmpty()) {
            return;
        }

        $statuts = ['en_attente', 'confirme', 'annule', 'effectue'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];
            $voiture = $voitures[$i % $voitures->count()];

            TestDrive::updateOrCreate(
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_test' => now()->subDays(20 - $i)->toDateString(),
                ],
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_test' => now()->subDays(20 - $i)->toDateString(),
                    'heure_test' => sprintf('%02d:%02d:00', 10 + ($i % 7), ($i * 5) % 60),
                    'statut' => $statuts[$i % count($statuts)],
                    'commentaire' => 'Test drive #{' . ($i + 1) . '}',
                ]
            );
        }
    }
}

