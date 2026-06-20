<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Employe;
use App\Models\Vente;
use App\Models\Voiture;
use Illuminate\Database\Seeder;

class VentesSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id_client')->get();
        $employes = Employe::query()->orderBy('id')->get();
        $voitures = Voiture::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $employes->isEmpty() || $voitures->isEmpty()) {
            return;
        }

        $modes = ['especes', 'carte', 'virement'];
        $statuts = ['en_cours','finalise','annule'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];
            $voiture = $voitures[$i % $voitures->count()];
            $employe = $employes[$i % $employes->count()];

            $prixFinal = (float) $voiture->prix + ($i * 1250);

            Vente::updateOrCreate(
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'date_vente' => now()->subDays(8 - $i)->toDateString(),
                ],
                [
                    'id_client' => $client->id_client,
                    'id_voiture' => $voiture->id,
                    'id_employe' => $employe->id,
                    'date_vente' => now()->subDays(8 - $i)->toDateString(),
                    'prix_final' => $prixFinal,
                    'mode_paiement' => $modes[$i % count($modes)],
                    'statut' => $statuts[$i % count($statuts)],
                    'commentaire' => 'Vente #{' . ($i + 1) . '}',
                ]
            );
        }
    }
}

