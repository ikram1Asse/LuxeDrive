<?php

namespace Database\Seeders;

use App\Models\Voiture;
use Illuminate\Database\Seeder;

class VoituresSeeder extends Seeder
{
    public function run(): void
    {
        $voitures = [
            [
                'modele' => 'Audi A3',
                'annee' => 2020,
                'prix' => 220000,
                'kilometrage' => 45000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Noir',
                'horsepower' => 150,
                'drivetrain' => 'Quattro',
                'description' => 'Compacte, confortable et économique.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_A3.jpeg',
            ],
            [
                'modele' => 'Audi A4',
                'annee' => 2019,
                'prix' => 260000,
                'kilometrage' => 52000,
                'carburant' => 'Diesel',
                'transmission' => 'Manuelle',
                'couleur' => 'Noir',
                'horsepower' => 190,
                'drivetrain' => 'Quattro',
                'description' => 'Tenue de route et performances reconnues.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_A4.jpeg',
            ],
            [
                'modele' => 'Audi A6 Limousine TFSI',
                'annee' => 2021,
                'prix' => 420000,
                'kilometrage' => 22000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Noir',
                'horsepower' => 245,
                'drivetrain' => 'Quattro',
                'description' => 'Luxe, espace et conduite dynamique.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_A6 Limousine TFSI.jpeg',
            ],
            [
                'modele' => 'Audi A8',
                'annee' => 2021,
                'prix' => 780000,
                'kilometrage' => 20000,
                'carburant' => 'Diesel',
                'transmission' => 'Automatique',
                'couleur' => 'Blanc',
                'horsepower' => 286,
                'drivetrain' => 'Quattro',
                'description' => 'Ultra-luxe et conduite sereine.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_A8.jpeg',
            ],
            [
                'modele' => 'Audi Q2',
                'annee' => 2020,
                'prix' => 280000,
                'kilometrage' => 38000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Noir',
                'horsepower' => 160,
                'drivetrain' => 'Traction',
                'description' => 'SUV urbain, style et agilité.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_Q2.jpeg',
            ],
            [
                'modele' => 'Audi Q8',
                'annee' => 2022,
                'prix' => 650000,
                'kilometrage' => 15000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Blanc',
                'horsepower' => 340,
                'drivetrain' => 'Quattro',
                'description' => 'Grand SUV premium, très puissant.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_Q8_white.jpeg',
            ],
            [
                'modele' => 'Audi Q8',
                'annee' => 2021,
                'prix' => 590000,
                'kilometrage' => 28000,
                'carburant' => 'Diesel',
                'transmission' => 'Automatique',
                'couleur' => 'Noir',
                'horsepower' => 300,
                'drivetrain' => 'Quattro',
                'description' => 'Élégant, silencieux et confortable.',
                'statut' => 'Réservée',
                'image_principale' => 'audi_Q8.jpeg',
            ],
            [
                'modele' => 'Audi R8',
                'annee' => 2018,
                'prix' => 950000,
                'kilometrage' => 12000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Blanc',
                'horsepower' => 540,
                'drivetrain' => 'Quattro',
                'description' => 'Supercar iconique, sensations fortes.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_R8.jpeg',
            ],
            [
                'modele' => 'Audi S5',
                'annee' => 2019,
                'prix' => 480000,
                'kilometrage' => 34000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Bleu',
                'horsepower' => 354,
                'drivetrain' => 'Quattro',
                'description' => 'Sportive polyvalente.',
                'statut' => 'Disponible',
                'image_principale' => 'audi_S5.jpeg',
            ],
            [
                'modele' => 'Audi S7',
                'annee' => 2020,
                'prix' => 620000,
                'kilometrage' => 26000,
                'carburant' => 'Essence',
                'transmission' => 'Automatique',
                'couleur' => 'Blanc',
                'horsepower' => 373,
                'drivetrain' => 'Quattro',
                'description' => 'Berlina sportive, confort premium.',
                'statut' => 'Réservée',
                'image_principale' => 'audi_S7.jpeg',
            ],
            
        ];

        foreach ($voitures as $data) {
            // Prevent duplicates if re-seeding: unique-ish by modele+annee+prix
            Voiture::updateOrCreate(
                [
                    'modele' => $data['modele'],
                    'annee' => $data['annee'],
                    'prix' => $data['prix'],
                ],
                $data
            );
        }
    }
}

