<?php

namespace Database\Seeders;

use App\Models\ImageVoiture;
use Illuminate\Database\Seeder;

class ImageVoituresSeeder extends Seeder
{
    public function run(): void
    {
        $carsByModele = [
            'Audi A3' => [
                'audi_A3.jpeg',
                'audi-a3-interior.jpeg',
            ],
            'Audi A4' => [
                'audi_A4.jpeg',
                'audi-a4-interior.jpeg',
            ],
            'Audi A6 Limousine TFSI' => [
                'audi_A6 Limousine TFSI.jpeg',
                'audi-a6-interior.jpeg',
            ],
            'Audi A8' => [
                'audi_A8.jpeg',
                'audi-a8-interior.jpeg',
            ],
            'Audi Q2' => [
                'audi_Q2.jpeg',
                'audi-q2-interior.jpeg',
            ],
            'Audi Q8' => [
                'audi_Q8_white.jpeg',
                'audi-q8-interior.jpeg',
            ],
            'Audi R8' => [
                'audi_R8.jpeg',
                'audi-r8-interior.jpeg',
            ],
            'Audi S5' => [
                'audi_S5.jpeg',
                'audi-s5-interior.jpeg',
            ],
            'Audi S7' => [
                'audi_S7.jpeg',
                'audi-s7-interior.jpeg',
            ],
        ];

        foreach ($carsByModele as $modele => $images) {
            $voitures = \App\Models\Voiture::query()->where('modele', $modele)->get();

            // If the modele isn't present in DB, skip.
            if ($voitures->isEmpty()) {
                continue;
            }

            foreach ($voitures as $voiture) {
                // Ensure we always have exactly the expected images per car.
                ImageVoiture::where('id_voiture', $voiture->id)->delete();

                foreach ($images as $index => $image) {
                    ImageVoiture::create([
                        'id_voiture' => $voiture->id,
                        'url' => $image,
                        'ordre' => $index + 1,
                    ]);
                }
            }
        }
    }
}


