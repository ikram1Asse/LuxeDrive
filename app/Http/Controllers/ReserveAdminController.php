<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Client;
use Illuminate\Http\Request;

class ReserveAdminController extends Controller
{
    public function index()
    {
        $reserves = Appointment::with('client', 'car')->where('type', 'general')->latest()->paginate(15);

        return view('admin.reserves.index', compact('reserves'));
    }

    public function indexReadOnly()
    {
        $reserves = Appointment::with('client', 'car')->where('type', 'general')->latest()->paginate(15);

        return view('employee.reserves.index', compact('reserves'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Car::where('status', 'available')->get();

        return view('admin.reserves.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        Appointment::create($this->validatedData($request) + [
            'type' => 'general',
            'user_id' => $request->input('user_id', auth('admin')->id()),
        ]);

        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation created successfully.');
    }

    public function edit(Appointment $reserve)
    {
        $clients = Client::all();
        $voitures = Car::where('status', 'available')->orWhere('id', $reserve->car_id)->get();

        return view('admin.reserves.edit', compact('reserve', 'clients', 'voitures'));
    }

    public function update(Request $request, Appointment $reserve)
    {
        $reserve->update($this->validatedData($request, false) + ['type' => 'general']);

        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Appointment $reserve)
    {
        $reserve->delete();

        return redirect()->route('admin.reserves.index')
            ->with('success', 'Reservation deleted successfully.');
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
