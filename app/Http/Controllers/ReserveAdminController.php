<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class ReserveAdminController extends Controller
{
    public function index()
    {
        $reserves = Reserve::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.reserves.index', compact('reserves'));
    }

    public function indexReadOnly()
    {
        $reserves = Reserve::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.employee.reserves.index', compact('reserves'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::where('statut', 'disponible')->get();
        return view('admin.reserves.create', compact('clients', 'voitures'));
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

        Reserve::create($validated);

        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function edit(Reserve $reserve)
    {
        $clients = Client::all();
        $voitures = Voiture::where('statut', 'disponible')->orWhere('id', $reserve->id_voiture)->get();
        return view('admin.reserves.edit', compact('reserve', 'clients', 'voitures'));
    }

    public function update(Request $request, Reserve $reserve)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_rdv' => 'required|date',
            'heure_rdv' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirme,annule,effectue',
            'commentaire' => 'nullable|string',
        ]);

        $reserve->update($validated);

        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation deleted successfully.');
    }
}
