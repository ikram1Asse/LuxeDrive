<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        $reserves = Reserve::with(['client', 'voiture'])->all();
        return view('reserves.index', compact('reserves'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('reserves.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date|after:today',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:En attente,Confirmé,Annulé,Terminé',
            'commentaire' => 'nullable|string',
        ]);

        Reserve::create($validated);
        return redirect()->route('reserves.index')->with('success', 'Réservation créée avec succès');
    }

    public function show(Reserve $reserve)
    {
        return view('reserves.show', compact('reserve'));
    }

    public function edit(Reserve $reserve)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('reserves.edit', compact('reserve', 'clients', 'voitures'));
    }

    public function update(Request $request, Reserve $reserve)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date|after:today',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:En attente,Confirmé,Annulé,Terminé',
            'commentaire' => 'nullable|string',
        ]);

        $reserve->update($validated);
        return redirect()->route('reserves.index')->with('success', 'Réservation mise à jour avec succès');
    }

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('reserves.index')->with('success', 'Réservation supprimée avec succès');
    }
}
