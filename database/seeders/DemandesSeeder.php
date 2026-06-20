<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Client;
use Illuminate\Database\Seeder;

class DemandesSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id_client')->get();
        if ($clients->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];

            $date = now()->subDays(12 - $i);

            Demande::updateOrCreate(
                [
                    'id_client' => $client->id_client,
                    'date_demande' => $date->format('Y-m-d H:i:s'),
                    'contenu' => 'Demande #{' . ($i + 1) . '}',
                ],
                [
                    'id_client' => $client->id_client,
                    'date_demande' => $date,
                    'contenu' => 'Demande #{' . ($i + 1) . '} : je souhaite plus d\'infos.',
                ]
            );
        }
    }
}

