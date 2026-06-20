<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Reserve;
use App\Models\Voiture;
use Illuminate\Database\Seeder;

class ReservesSeeder extends Seeder
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
            $voiture = $voitures[($i + 1) % $voitures->count()];

            Reserve::updateOrCreate(
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_rdv' => now()->subDays(15 - $i)->toDateString(),
                ],
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_rdv' => now()->subDays(15 - $i)->toDateString(),
                    'heure_rdv' => sprintf('%02d:%02d:00', 9 + ($i % 7), ($i * 7) % 60),
                    'statut' => $statuts[$i % count($statuts)],
                    'commentaire' => 'Réservation #{' . ($i + 1) . '}',
                ]
            );
        }
    }
}

