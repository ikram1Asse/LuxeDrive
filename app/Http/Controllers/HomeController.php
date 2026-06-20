<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use App\Models\TestDrive;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Voiture::where('statut', 'Disponible')->get();
        return view('home.index', compact('cars'));
    }

    public function storeTestDrive(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
        ]);

        // Create or find client
        $client = Client::where('telephone', $validated['phone'])->first();
        
        if (!$client) {
            $nameParts = explode(' ', $validated['name'], 2);
            $client = Client::create([
                'nom' => $nameParts[0] ?? $validated['name'],
                'prenom' => $nameParts[1] ?? '',
                'telephone' => $validated['phone'],
                'email' => $validated['phone'] . '@luxedrive.local',
                'adresse' => 'À compléter',
            ]);
        }

        TestDrive::create([
            'id_client' => $client->id_client,
            'id_voiture' => $request->input('id_voiture', 1),
            'date_test' => $validated['date'],
            'heure_test' => $request->input('heure_test', '10:00'),
            'statut' => 'En attente',
            'commentaire' => $request->input('commentaire'),
        ]);

        return redirect()->route('home')->with('success', 'Votre demande de test drive a été enregistrée!');
    }
}