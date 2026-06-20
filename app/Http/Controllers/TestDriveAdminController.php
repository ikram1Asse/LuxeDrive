<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class TestDriveAdminController extends Controller
{
    public function index()
    {
        $testDrives = TestDrive::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.test-drives.index', compact('testDrives'));
    }

    public function indexReadOnly()
    {
        // Client model uses a non-standard PK: id_client.
        $testDrives = TestDrive::with('client', 'voiture')->latest()->paginate(15);
        return view('admin.employee.test-drives.index', compact('testDrives'));
    }


    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::where('statut', 'disponible')->get();
        return view('admin.test-drives.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_test' => 'required|date|after:today',
            'heure_test' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirme,annule,effectue',
            'commentaire' => 'nullable|string',
        ]);

        TestDrive::create($validated);

        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive scheduled successfully.');
    }

    public function edit(TestDrive $testDrive)
    {
        $clients = Client::all();
        $voitures = Voiture::where('statut', 'disponible')->orWhere('id', $testDrive->id_voiture)->get();
        return view('admin.test-drives.edit', compact('testDrive', 'clients', 'voitures'));
    }

    public function update(Request $request, TestDrive $testDrive)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_test' => 'required|date',
            'heure_test' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirme,annule,effectue',
            'commentaire' => 'nullable|string',
        ]);

        $testDrive->update($validated);

        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive updated successfully.');
    }

    public function destroy(TestDrive $testDrive)
    {
        $testDrive->delete();
        return redirect()->route('admin.test-drives.index')
            ->with('success', 'Test drive deleted successfully.');
    }
}
