<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\TestDrive;
use Illuminate\Http\Request;

class TestDriveAdminController extends Controller
{
    public function index()
    {
        $testDrives = TestDrive::with('client', 'car')->latest()->paginate(15);

        return view('admin.test-drives.index', compact('testDrives'));
    }

    public function indexReadOnly()
    {
        $testDrives = TestDrive::with('client', 'car')->latest()->paginate(15);

        return view('employee.test-drives.index', compact('testDrives'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Car::where('status', 'available')->get();

        return view('admin.test-drives.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        TestDrive::create($this->validatedData($request) + [
            'user_id' => $request->input('user_id', auth('admin')->id()),
        ]);

        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive scheduled successfully.');
    }

    public function edit(TestDrive $test_drive)
    {
        $clients = Client::all();
        $voitures = Car::where('status', 'available')->orWhere('id', $test_drive->car_id)->get();
        $testDrive = $test_drive;

        return view('admin.test-drives.edit', compact('testDrive', 'clients', 'voitures'));
    }

    public function update(Request $request, TestDrive $test_drive)
    {
        $test_drive->update($this->validatedData($request, false));

        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive updated successfully.');
    }

    public function destroy(TestDrive $test_drive)
    {
        $test_drive->delete();

        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive deleted successfully.');
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
