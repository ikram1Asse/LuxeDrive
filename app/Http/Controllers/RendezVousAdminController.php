<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;

class RendezVousAdminController extends Controller
{
    public function index()
    {
        $rdvs = Appointment::with('client', 'car')->where('type', 'purchase')->latest()->paginate(15);

        return view('admin.rdv.index', compact('rdvs'));
    }

    public function indexReadOnly()
    {
        $rdvs = Appointment::with('client', 'car')->where('type', 'purchase')->latest()->paginate(15);

        return view('employee.rdv.index', compact('rdvs'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Car::all();

        return view('admin.rdv.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        Appointment::create($this->validatedData($request) + [
            'type' => 'purchase',
            'user_id' => $request->input('user_id', auth('admin')->id()),
        ]);

        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $rdv)
    {
        $clients = Client::all();
        $voitures = Car::all();

        return view('admin.rdv.edit', compact('rdv', 'clients', 'voitures'));
    }

    public function update(Request $request, Appointment $rdv)
    {
        $rdv->update($this->validatedData($request, false) + ['type' => 'purchase']);

        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $rdv)
    {
        $rdv->delete();

        return redirect()->route('admin.rdv.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    private function validatedData(Request $request, bool $futureDate = true): array
    {
        return $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'date' => $futureDate ? 'required|date|after:today' : 'required|date',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);
    }
}
