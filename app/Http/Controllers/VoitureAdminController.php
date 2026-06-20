<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureAdminController extends Controller
{
    public function index()
    {
        $voitures = Voiture::latest()->paginate(15);
        return view('admin.voitures.index', compact('voitures'));
    }

    public function indexReadOnly()
    {
        $voitures = Voiture::latest()->paginate(15);
        return view('admin.employee.voitures.index', compact('voitures'));
    }

    public function create()
    {
        return view('admin.voitures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:2100',
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:50',
            'horsepower' => 'required|integer|min:0',
            'drivetrain' => 'required|string|max:50',
            'transmission' => 'required|string|max:50',
            'couleur' => 'required|string|max:50',
            'description' => 'nullable|string',
            'statut' => 'required|in:disponible,reserve,vendu',
            'image_principale' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_principale')) {
            $path = $request->file('image_principale')->store('voitures', 'public');
            $validated['image_principale'] = $path;
        }

        Voiture::create($validated);

        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car added successfully.');
    }

    public function edit(Voiture $voiture)
    {
        return view('admin.voitures.edit', compact('voiture'));
    }

    public function update(Request $request, Voiture $voiture)
    {
        $validated = $request->validate([
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:2100',
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',
            'carburant' => 'required|string|max:50',
            'horsepower' => 'required|integer|min:0',
            'drivetrain' => 'required|string|max:50',
            'transmission' => 'required|string|max:50',
            'couleur' => 'required|string|max:50',
            'description' => 'nullable|string',
            'statut' => 'required|in:disponible,vendu,reserve',
            'image_principale' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_principale')) {
            $path = $request->file('image_principale')->store('voitures', 'public');
            $validated['image_principale'] = $path;
        }

        $voiture->update($validated);

        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Voiture $voiture)
    {
        $voiture->delete();
        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car deleted successfully.');
    }
}
