<?php

namespace App\Http\Controllers;

use App\Models\TestDrive;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;

class TestDriveController extends Controller
{
    // Show book test drive form
    public function showBook()
    {
        return view('testdrive.book');
    }

    // Store book test drive
    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
        ]);

        return redirect('/')->with('success', 'Test drive booking submitted successfully!');
    }

    public function index()
    {
        $testDrives = TestDrive::with(['client', 'voiture'])->all();
        return view('test-drives.index', compact('testDrives'));
    }

    public function create()
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('test-drives.create', compact('clients', 'voitures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_test' => 'required|date|after:today',
            'heure_test' => 'required|date_format:H:i',
            'statut' => 'required|in:En attente,Confirmé,Annulé,Effectué',
            'commentaire' => 'nullable|string',
        ]);

        TestDrive::create($validated);
        return redirect()->route('test-drives.index')->with('success', 'Test drive créé avec succès');
    }

    public function show(TestDrive $testDrive)
    {
        return view('test-drives.show', compact('testDrive'));
    }

    public function edit(TestDrive $testDrive)
    {
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('test-drives.edit', compact('testDrive', 'clients', 'voitures'));
    }

    public function update(Request $request, TestDrive $testDrive)
    {
        $validated = $request->validate([
            'id_client' => 'required|exists:clients,id_client',
            'id_voiture' => 'required|exists:voitures,id',
            'date_test' => 'required|date|after:today',
            'heure_test' => 'required|date_format:H:i',
            'statut' => 'required|in:En attente,Confirmé,Annulé,Effectué',
            'commentaire' => 'nullable|string',
        ]);

        $testDrive->update($validated);
        return redirect()->route('test-drives.index')->with('success', 'Test drive mis à jour avec succès');
    }

    public function destroy(TestDrive $testDrive)
    {
        $testDrive->delete();
        return redirect()->route('test-drives.index')->with('success', 'Test drive supprimé avec succès');
    }
}
