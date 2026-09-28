<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = User::whereIn('role', ['admin', 'employee'])->latest()->paginate(15);

        return view('admin.employes.index', compact('employes'));
    }

    public function indexReadOnly()
    {
        $employes = User::whereIn('role', ['admin', 'employee'])->latest()->paginate(15);

        return view('employee.employes.index', compact('employes'));
    }

    public function create()
    {
        return view('admin.employes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:admin,employee',
            'job_title' => 'nullable|string|max:255',
            'hired_at' => 'required|date',
            'password' => 'required|string|min:6',
        ]);

        User::create($validated);

        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(User $employe)
    {
        return view('admin.employes.edit', compact('employe'));
    }

    public function update(Request $request, User $employe)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($employe->id)],
            'phone' => 'required|string|max:20',
            'role' => 'required|in:admin,employee',
            'job_title' => 'nullable|string|max:255',
            'hired_at' => 'required|date',
            'password' => 'nullable|string|min:6',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $employe->update($validated);

        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $employe)
    {
        $employe->delete();

        return redirect()->route('admin.employes.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
