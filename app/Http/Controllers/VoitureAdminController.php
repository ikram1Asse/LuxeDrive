<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class VoitureAdminController extends Controller
{
    public function index()
    {
        $voitures = Car::latest()->paginate(15);

        return view('admin.voitures.index', compact('voitures'));
    }

    public function indexReadOnly()
    {
        $voitures = Car::latest()->paginate(15);

        return view('employee.voitures.index', compact('voitures'));
    }

    public function create()
    {
        return view('admin.voitures.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatedCar($request);
        unset($validated['main_image']);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        Car::create($validated);

        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car added successfully.');
    }

    public function edit(Car $voiture)
    {
        return view('admin.voitures.edit', compact('voiture'));
    }

    public function update(Request $request, Car $voiture)
    {
        $validated = $this->validatedCar($request);
        unset($validated['main_image']);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('cars', 'public');
        }

        $voiture->update($validated);

        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $voiture)
    {
        $voiture->delete();

        return redirect()->route('admin.voitures.index')
            ->with('success', 'Car deleted successfully.');
    }

    private function validatedCar(Request $request): array
    {
        return $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2100',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'fuel' => 'required|string|max:50',
            'horsepower' => 'required|integer|min:0',
            'drivetrain' => 'required|string|max:50',
            'transmission' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
            'main_image' => 'nullable|image|max:2048',
        ]);
    }
}
