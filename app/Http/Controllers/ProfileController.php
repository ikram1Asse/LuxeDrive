<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::guard('client')->user();

        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::guard('client')->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('client')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('clients', 'email')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $nameParts = explode(' ', $validated['name'], 2);

        $payload = [
            'first_name' => $nameParts[0],
            'last_name' => $nameParts[1] ?? $user->last_name,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? $user->phone,
        ];

        if ($request->filled('current_password')) {
            if (! Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            if (! $request->filled('password')) {
                return redirect()->back()->withErrors(['password' => 'New password is required when changing password.']);
            }

            $payload['password'] = $validated['password'];
        }

        $user->update($payload);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}
