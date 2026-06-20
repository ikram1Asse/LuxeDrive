<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Voiture;
use App\Models\Employe;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::with(['client', 'voiture', 'employe'])->all();
        return view('ventes.index', compact('ventes'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        $employes = Employe::all();
        return view('ventes.create', compact('clients', 'voitures', 'employes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'id_employe' => 'required|exists:employes,id',
            'date_vente' => 'required|date',
            'prix_final' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:50',
            'statut' => 'required|in:En cours,Finalisée',
            'commentaire' => 'nullable|string',
        ]);

        Vente::create($validated);
        return redirect()->route('ventes.index')->with('success', 'Vente créée avec succès');
    }

    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }

    public function edit(Vente $vente)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        $employes = Employe::all();
        return view('ventes.edit', compact('vente', 'clients', 'voitures', 'employes'));
    }

    public function update(Request $request, Vente $vente)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'id_employe' => 'required|exists:employes,id',
            'date_vente' => 'required|date',
            'prix_final' => 'required|numeric|min:0',
            'mode_paiement' => 'required|string|max:50',
            'statut' => 'required|in:En cours,Finalisée',
            'commentaire' => 'nullable|string',
        ]);

        $vente->update($validated);
        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès');
    }

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès');
    }
}
