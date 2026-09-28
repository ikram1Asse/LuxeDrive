<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function showBook()
    {
        return view('appointment.book');
    }

    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
        ]);

        $nameParts = explode(' ', $validated['nom'], 2);
        $client = Client::firstOrCreate(
            ['phone' => $validated['telephone']],
            [
                'first_name' => $nameParts[0],
                'last_name' => $nameParts[1] ?? '',
                'email' => $validated['telephone'].'@luxedrive.local',
                'address' => '',
                'password' => 'client123456',
            ]
        );

        Appointment::create([
            'client_id' => $client->id,
            'car_id' => $request->input('car_id', Car::query()->value('id')),
            'type' => 'purchase',
            'date' => $validated['date'],
            'time' => $request->input('time', '10:00'),
            'status' => 'pending',
        ]);

        return redirect('/')->with('success', 'Appointment booking submitted successfully!');
    }
}
