<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = Voiture::all();
        return view('models.index', compact('voitures'));
    }

    public function create()
    {
        return view('voitures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:50',
            'horsepower' => 'nullable|integer|min:0',
            'drivetrain' => 'nullable|string|max:50',
            'transmission' => 'required|string|max:50',
            'couleur' => 'required|string|max:50',
            'description' => 'nullable|string',
            'statut' => 'required|in:Disponible,Réservée,Vendue',
            'image_principale' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_principale')) {
            $validated['image_principale'] = $request->file('image_principale')->store('images/voitures', 'public');
        }

        Voiture::create($validated);
        return redirect()->route('voitures.index')->with('success', 'Voiture créée avec succès');
    }

    public function show(Voiture $voiture)
    {
        $voiture->load('images');
        
        return view('models.carDetails', compact('voiture'));
    }

    public function edit(Voiture $voiture)
    {
        return view('voitures.edit', compact('voiture'));
    }

    public function update(Request $request, Voiture $voiture)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:50',
            'horsepower' => 'nullable|integer|min:0',
            'drivetrain' => 'nullable|string|max:50',
            'transmission' => 'required|string|max:50',
            'couleur' => 'required|string|max:50',
            'description' => 'nullable|string',
            'statut' => 'required|in:Disponible,Réservée,Vendue',
            'image_principale' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_principale')) {
            $validated['image_principale'] = $request->file('image_principale')->store('images/voitures', 'public');
        }

        $voiture->update($validated);
        return redirect()->route('voitures.index')->with('success', 'Voiture mise à jour avec succès');
    }

    public function destroy(Voiture $voiture)
    {
        $voiture->delete();
        return redirect()->route('voitures.index')->with('success', 'Voiture supprimée avec succès');
    }
}
