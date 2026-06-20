<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::latest()->paginate(15);
        return view('admin.employes.index', compact('employes'));
    }

    public function indexReadOnly()
    {
        $employes = Employe::latest()->paginate(15);
        return view('admin.employee.employes.index', compact('employes'));
    }

    public function create()
    {
        return view('admin.employes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes',
            'telephone' => 'required|string|max:20',
            'role' => 'required|in:manager,vendeur,technicien',
            'date_embauche' => 'required|date',
        ]);

        Employe::create($validated);

        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employe $employe)
    {
        return view('admin.employes.edit', compact('employe'));
    }

    public function update(Request $request, Employe $employe)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email,' . $employe->id,
            'telephone' => 'required|string|max:20',
            'role' => 'required|in:manager,vendeur,technicien',
            'date_embauche' => 'required|date',
        ]);

        $employe->update($validated);

        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
