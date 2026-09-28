<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Client;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::query()->orderBy('id')->get();
        $employees = User::query()->whereIn('role', ['admin', 'employee'])->orderBy('id')->get();
        $cars = Car::query()->orderBy('id')->get();

        if ($clients->isEmpty() || $employees->isEmpty() || $cars->isEmpty()) {
            return;
        }

        $methods = ['cash', 'card', 'transfer'];
        $statuses = ['in_progress', 'completed', 'cancelled'];

        for ($i = 0; $i < 10; $i++) {
            $client = $clients[$i % $clients->count()];
            $car = $cars[$i % $cars->count()];
            $employee = $employees[$i % $employees->count()];

            Sale::updateOrCreate(
                [
                    'client_id' => $client->id,
                    'car_id' => $car->id,
                    'sold_at' => now()->subDays(8 - $i)->toDateString(),
                ],
                [
                    'user_id' => $employee->id,
                    'final_price' => (float) $car->price + ($i * 1250),
                    'payment_method' => $methods[$i % count($methods)],
                    'status' => $statuses[$i % count($statuses)],
                    'notes' => 'Sale #'.($i + 1),
                ]
            );
        }
    }
}
