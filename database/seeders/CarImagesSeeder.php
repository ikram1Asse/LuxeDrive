<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Database\Seeder;

class CarImagesSeeder extends Seeder
{
    public function run(): void
    {
        $carsByModel = [
            'Audi A3' => ['audi_A3.jpeg', 'audi-a3-interior.jpeg'],
            'Audi A4' => ['audi_A4.jpeg', 'audi-a4-interior.jpeg'],
            'Audi A6 Limousine TFSI' => ['audi_A6 Limousine TFSI.jpeg', 'audi-a6-interior.jpeg'],
            'Audi A8' => ['audi_A8.jpeg', 'audi-a8-interior.jpeg'],
            'Audi Q2' => ['audi_Q2.jpeg', 'audi-q2-interior.jpeg'],
            'Audi Q8' => ['audi_Q8_white.jpeg', 'audi-q8-interior.jpeg'],
            'Audi R8' => ['audi_R8.jpeg', 'audi-r8-interior.jpeg'],
            'Audi S5' => ['audi_S5.jpeg', 'audi-s5-interior.jpeg'],
            'Audi S7' => ['audi_S7.jpeg', 'audi-s7-interior.jpeg'],
        ];

        foreach ($carsByModel as $model => $images) {
            $cars = Car::query()->where('model', $model)->get();

            if ($cars->isEmpty()) {
                continue;
            }

            foreach ($cars as $car) {
                CarImage::where('car_id', $car->id)->delete();

                foreach ($images as $index => $image) {
                    CarImage::create([
                        'car_id' => $car->id,
                        'url' => $image,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }
    }
}
