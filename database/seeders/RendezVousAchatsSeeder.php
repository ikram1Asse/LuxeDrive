<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\RendezVousAchat;
use App\Models\Voiture;
use Illuminate\Database\Seeder;

class RendezVousAchatsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id_client')->get();
        $voitures = Voiture::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $voitures->isEmpty()) {
            return;
        }

        $statuts =['en_attente', 'confirme', 'annule', 'effectue'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[($i + 2) % $clients->count()];
            $voiture = $voitures[$i % $voitures->count()];

            RendezVousAchat::updateOrCreate(
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_rdv' => now()->subDays(10 - $i)->toDateString(),
                ],
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_rdv' => now()->subDays(10 - $i)->toDateString(),
                    'heure_rdv' => sprintf('%02d:%02d:00', 11 + ($i % 6), ($i * 3) % 60),
                    'statut' => $statuts[$i % count($statuts)],
                    'commentaire' => 'RDV achat #{' . ($i + 1) . '}',
                ]
            );
        }
    }
}

