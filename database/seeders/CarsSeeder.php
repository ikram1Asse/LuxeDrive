<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            ['model' => 'Audi A3', 'year' => 2020, 'price' => 220000, 'mileage' => 45000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Noir', 'horsepower' => 150, 'drivetrain' => 'Quattro', 'description' => 'Compacte, confortable et économique.', 'status' => 'available', 'main_image' => 'audi_A3.jpeg'],
            ['model' => 'Audi A4', 'year' => 2019, 'price' => 260000, 'mileage' => 52000, 'fuel' => 'Diesel', 'transmission' => 'Manuelle', 'color' => 'Noir', 'horsepower' => 190, 'drivetrain' => 'Quattro', 'description' => 'Tenue de route et performances reconnues.', 'status' => 'available', 'main_image' => 'audi_A4.jpeg'],
            ['model' => 'Audi A6 Limousine TFSI', 'year' => 2021, 'price' => 420000, 'mileage' => 22000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Noir', 'horsepower' => 245, 'drivetrain' => 'Quattro', 'description' => 'Luxe, espace et conduite dynamique.', 'status' => 'available', 'main_image' => 'audi_A6 Limousine TFSI.jpeg'],
            ['model' => 'Audi A8', 'year' => 2021, 'price' => 780000, 'mileage' => 20000, 'fuel' => 'Diesel', 'transmission' => 'Automatique', 'color' => 'Blanc', 'horsepower' => 286, 'drivetrain' => 'Quattro', 'description' => 'Ultra-luxe et conduite sereine.', 'status' => 'available', 'main_image' => 'audi_A8.jpeg'],
            ['model' => 'Audi Q2', 'year' => 2020, 'price' => 280000, 'mileage' => 38000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Noir', 'horsepower' => 160, 'drivetrain' => 'Traction', 'description' => 'SUV urbain, style et agilité.', 'status' => 'available', 'main_image' => 'audi_Q2.jpeg'],
            ['model' => 'Audi Q8', 'year' => 2022, 'price' => 650000, 'mileage' => 15000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Blanc', 'horsepower' => 340, 'drivetrain' => 'Quattro', 'description' => 'Grand SUV premium, très puissant.', 'status' => 'available', 'main_image' => 'audi_Q8_white.jpeg'],
            ['model' => 'Audi Q8', 'year' => 2021, 'price' => 590000, 'mileage' => 28000, 'fuel' => 'Diesel', 'transmission' => 'Automatique', 'color' => 'Noir', 'horsepower' => 300, 'drivetrain' => 'Quattro', 'description' => 'Élégant, silencieux et confortable.', 'status' => 'reserved', 'main_image' => 'audi_Q8.jpeg'],
            ['model' => 'Audi R8', 'year' => 2018, 'price' => 950000, 'mileage' => 12000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Blanc', 'horsepower' => 540, 'drivetrain' => 'Quattro', 'description' => 'Supercar iconique, sensations fortes.', 'status' => 'available', 'main_image' => 'audi_R8.jpeg'],
            ['model' => 'Audi S5', 'year' => 2019, 'price' => 480000, 'mileage' => 34000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Bleu', 'horsepower' => 354, 'drivetrain' => 'Quattro', 'description' => 'Sportive polyvalente.', 'status' => 'available', 'main_image' => 'audi_S5.jpeg'],
            ['model' => 'Audi S7', 'year' => 2020, 'price' => 620000, 'mileage' => 26000, 'fuel' => 'Essence', 'transmission' => 'Automatique', 'color' => 'Blanc', 'horsepower' => 373, 'drivetrain' => 'Quattro', 'description' => 'Berlina sportive, confort premium.', 'status' => 'reserved', 'main_image' => 'audi_S7.jpeg'],
        ];

        foreach ($cars as $data) {
            Car::updateOrCreate(
                [
                    'model' => $data['model'],
                    'year' => $data['year'],
                    'price' => $data['price'],
                ],
                $data
            );
        }
    }
}
