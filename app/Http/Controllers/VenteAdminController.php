<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class VenteAdminController extends Controller
{
    public function index()
    {
        $ventes = Sale::with('client', 'car', 'employee')->latest()->paginate(15);

        return view('admin.ventes.index', compact('ventes'));
    }

    public function indexReadOnly()
    {
        $ventes = Sale::with('client', 'car', 'employee')->latest()->paginate(15);

        return view('employee.ventes.index', compact('ventes'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Car::where('status', 'available')->get();
        $employes = User::whereIn('role', ['admin', 'employee'])->get();

        return view('admin.ventes.create', compact('clients', 'voitures', 'employes'));
    }

    public function store(Request $request)
    {
        Sale::create($this->validatedData($request));

        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale created successfully.');
    }

    public function edit(Sale $vente)
    {
        $clients = Client::all();
        $voitures = Car::all();
        $employes = User::whereIn('role', ['admin', 'employee'])->get();

        return view('admin.ventes.edit', compact('vente', 'clients', 'voitures', 'employes'));
    }

    public function update(Request $request, Sale $vente)
    {
        $vente->update($this->validatedData($request));

        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $vente)
    {
        $vente->delete();

        return redirect()->route('admin.ventes.index')
            ->with('success', 'Sale deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'sold_at' => 'required|date',
            'final_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,transfer',
            'status' => 'required|in:in_progress,completed,cancelled',
            'notes' => 'nullable|string',
        ]);
    }
}
