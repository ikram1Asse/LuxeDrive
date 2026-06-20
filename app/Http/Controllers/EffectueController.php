<?php

namespace App\Http\Controllers;

use App\Models\Effectue;
use App\Models\Vente;
use App\Models\Employe;
use Illuminate\Http\Request;

class EffectueController extends Controller
{
    public function index()
    {
        $effectues = Effectue::with(['vente', 'employe'])->all();
        return view('effectues.index', compact('effectues'));
    }

    public function create()
    {
        $ventes = Vente::all();
        $employes = Employe::all();
        return view('effectues.create', compact('ventes', 'employes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_vente' => 'required|exists:ventes,id_vente',
            'id_employe' => 'required|exists:employes,id',
        ]);

        Effectue::create($validated);
        return redirect()->route('effectues.index')->with('success', 'Effectue créé avec succès');
    }

    public function show(Effectue $effectue)
    {
        return view('effectues.show', compact('effectue'));
    }

    public function edit(Effectue $effectue)
    {
        $ventes = Vente::all();
        $employes = Employe::all();
        return view('effectues.edit', compact('effectue', 'ventes', 'employes'));
    }

    public function update(Request $request, Effectue $effectue)
    {
        $validated = $request->validate([
            'id_vente' => 'required|exists:ventes,id_vente',
            'id_employe' => 'required|exists:employes,id',
        ]);

        $effectue->update($validated);
        return redirect()->route('effectues.index')->with('success', 'Effectue mis à jour avec succès');
    }

    public function destroy(Effectue $effectue)
    {
        $effectue->delete();
        return redirect()->route('effectues.index')->with('success', 'Effectue supprimé avec succès');
    }
}
