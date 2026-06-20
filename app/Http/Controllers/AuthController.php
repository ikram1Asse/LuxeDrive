<?php

namespace App\Http\Controllers;

use App\Models\ClientAuth;
use App\Models\EmployeAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Store login
    public function storeLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // 1) Client login
        if (Auth::guard('client')->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Login successful!');
        }


        // 2) Admin/Employee login
        if (Auth::guard('admin')->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            $employe = Auth::guard('admin')->user();

            // Admins go to admin dashboard; other employes can still access employee dashboards.
            if ($employe && $employe->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Admin login successful!');
            }

            return redirect()->route('employee.dashboard')->with('success', 'Employee login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show signup form
    public function showSignup()
    {
        return view('auth.signup');
    }

    // Store signup (clients)
    public function storeSignup(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $client = ClientAuth::create([
            'nom' => $validated['nom'],
            'prenom' => $request->input('prenom', ''),
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'adresse' => $request->input('adresse', ''),
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('client')->login($client);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}

