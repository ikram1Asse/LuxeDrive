<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id')->get();
        $cars = Car::query()->orderBy('id')->get();
        $staff = User::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $cars->isEmpty() || $staff->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];
            $car = $cars[($i + 1) % $cars->count()];

            Appointment::updateOrCreate(
                [
                    'client_id' => $client->id,
                    'car_id' => $car->id,
                    'type' => 'general',
                    'date' => now()->subDays(15 - $i)->toDateString(),
                ],
                [
                    'user_id' => $staff[$i % $staff->count()]->id,
                    'time' => sprintf('%02d:%02d:00', 9 + ($i % 7), ($i * 7) % 60),
                    'status' => $statuses[$i % count($statuses)],
                    'notes' => 'General appointment #'.($i + 1),
                ]
            );
        }

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[($i + 2) % $clients->count()];
            $car = $cars[$i % $cars->count()];

            Appointment::updateOrCreate(
                [
                    'client_id' => $client->id,
                    'car_id' => $car->id,
                    'type' => 'purchase',
                    'date' => now()->subDays(10 - $i)->toDateString(),
                ],
                [
                    'user_id' => $staff[($i + 1) % $staff->count()]->id,
                    'time' => sprintf('%02d:%02d:00', 11 + ($i % 6), ($i * 3) % 60),
                    'status' => $statuses[$i % count($statuses)],
                    'notes' => 'Purchase appointment #'.($i + 1),
                ]
            );
        }
    }
}
