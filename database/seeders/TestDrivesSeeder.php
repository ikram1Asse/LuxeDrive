<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Client;
use App\Models\TestDrive;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDrivesSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id')->get();
        $cars = Car::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $cars->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];
            $car = $cars[$i % $cars->count()];

            TestDrive::updateOrCreate(
                [
                    'client_id' => $client->id,
                    'car_id' => $car->id,
                    'date' => now()->subDays(20 - $i)->toDateString(),
                ],
                [
                    'time' => sprintf('%02d:%02d:00', 10 + ($i % 7), ($i * 5) % 60),
                    'status' => $statuses[$i % count($statuses)],
                    'notes' => 'Test drive #'.($i + 1),
                ]
            );
        }
    }
}
