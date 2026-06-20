<?php

namespace App\Http\Controllers;

use App\Models\RendezVousAchat;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class RendezVousAdminController extends Controller
{
    public function index()
    {
        $rdvs = RendezVousAchat::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.rdv.index', compact('rdvs'));
    }

    public function indexReadOnly()
    {
        $rdvs = RendezVousAchat::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.employee.rdv.index', compact('rdvs'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('admin.rdv.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date|after:today',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirme,annule,effectue',
            'commentaire' => 'nullable|string',
        ]);

        RendezVousAchat::create($validated);

        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(RendezVousAchat $rdv)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('admin.rdv.edit', compact('rdv', 'clients', 'voitures'));
    }

    public function update(Request $request, RendezVousAchat $rdv)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirme,annule,effectue',
            'commentaire' => 'nullable|string',
        ]);

        $rdv->update($validated);

        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(RendezVousAchat $rdv)
    {
        $rdv->delete();
        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}

