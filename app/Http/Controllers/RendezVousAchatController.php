<?php

namespace App\Http\Controllers;

use App\Models\RendezVousAchat;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class RendezVousAchatController extends Controller
{
    public function index()
    {
        $rendezVousAchats = RendezVousAchat::with(['client', 'voiture'])->all();
        return view('rendez-vous-achats.index', compact('rendezVousAchats'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('rendez-vous-achats.create', compact('clients', 'voitures'));
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

        RendezVousAchat::create($validated);
        return redirect()->route('rendez-vous-achats.index')->with('success', 'Rendez-vous créé avec succès');
    }

    public function show(RendezVousAchat $rendezVousAchat)
    {
        return view('rendez-vous-achats.show', compact('rendezVousAchat'));
    }

    public function edit(RendezVousAchat $rendezVousAchat)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('rendez-vous-achats.edit', compact('rendezVousAchat', 'clients', 'voitures'));
    }

    public function update(Request $request, RendezVousAchat $rendezVousAchat)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date|after:today',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:En attente,Confirmé,Annulé,Terminé',
            'commentaire' => 'nullable|string',
        ]);

        $rendezVousAchat->update($validated);
        return redirect()->route('rendez-vous-achats.index')->with('success', 'Rendez-vous mis à jour avec succès');
    }

    public function destroy(RendezVousAchat $rendezVousAchat)
    {
        $rendezVousAchat->delete();
        return redirect()->route('rendez-vous-achats.index')->with('success', 'Rendez-vous supprimé avec succès');
    }
}
