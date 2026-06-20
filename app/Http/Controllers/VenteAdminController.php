<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Voiture;
use App\Models\Employe;
use Illuminate\Http\Request;

class VenteAdminController extends Controller
{
    public function index()
    {
        $ventes = Vente::with('client', 'voiture', 'employe')->latest()->paginate(15);
        return view('admin.ventes.index', compact('ventes'));
    }

    public function indexReadOnly()
    {
        $ventes = Vente::with('client', 'voiture', 'employe')->latest()->paginate(15);
        return view('admin.employee.ventes.index', compact('ventes'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::where('statut', 'disponible')->get();
        $employes = Employe::all();
        return view('admin.ventes.create', compact('clients', 'voitures', 'employes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'id_employe' => 'required|exists:employes,id_employe',
            'date_vente' => 'required|date',
            'prix_final' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:especes,carte,virement',
            'statut' => 'required|in:en_cours,finalise,annule',
            'commentaire' => 'nullable|string',
        ]);

        Vente::create($validated);

        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale created successfully.');
    }

    public function edit(Vente $vente)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        $employes = Employe::all();
        return view('admin.ventes.edit', compact('vente', 'clients', 'voitures', 'employes'));
    }

    public function update(Request $request, Vente $vente)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'id_employe' => 'required|exists:employes,id_employe',
            'date_vente' => 'required|date',
            'prix_final' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:especes,carte,virement',
            'statut' => 'required|in:en_cours,finalise,annule',
            'commentaire' => 'nullable|string',
        ]);

        $vente->update($validated);

        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale updated successfully.');
    }

    public function destroy(Vente $vente)
    {
        $vente->delete();
        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale deleted successfully.');
    }
}
