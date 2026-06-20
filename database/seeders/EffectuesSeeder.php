<?php

namespace Database\Seeders;

use App\Models\Effectue;
use App\Models\Employe;
use App\Models\Vente;
use Illuminate\Database\Seeder;

class EffectuesSeeder extends Seeder
{
    public function run(): void
    {
        $ventes = Vente::query()->orderBy('id_vente')->get();
        $employes = Employe::query()->orderBy('id')->get();

        if ($ventes->isEmpty() || $employes->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $vente = $ventes[$i % $ventes->count()];
            $employe = $employes[$i % $employes->count()];

            Effectue::updateOrCreate(
                [
                    'id_vente' => $vente->id_vente,
                    'id_employe' => $employe->id,
                ],
                [
                    'id_vente' => $vente->id_vente,
                    'id_employe' => $employe->id,
                ]
            );
        }
    }
}

