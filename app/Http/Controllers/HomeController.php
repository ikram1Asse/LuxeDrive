<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\TestDrive;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::where('status', 'available')->get();

        return view('home.index', compact('cars'));
    }

    public function storeTestDrive(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
        ]);

        $client = Client::where('phone', $validated['phone'])->first();

        if (! $client) {
            $nameParts = explode(' ', $validated['name'], 2);
            $client = Client::create([
                'first_name' => $nameParts[0] ?? $validated['name'],
                'last_name' => $nameParts[1] ?? '',
                'phone' => $validated['phone'],
                'email' => $validated['phone'].'@luxedrive.local',
                'address' => '',
                'password' => 'client123456',
            ]);
        }

        TestDrive::create([
            'client_id' => $client->id,
            'car_id' => $request->input('car_id', Car::query()->value('id')),
            'date' => $validated['date'],
            'time' => $request->input('time', '10:00'),
            'status' => 'pending',
            'notes' => $request->input('notes'),
        ]);

        return redirect('/')->with('success', 'Votre demande de test drive a été enregistrée!');
    }
}
