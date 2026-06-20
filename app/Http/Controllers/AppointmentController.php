<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show book appointment form
    public function showBook()
    {
        return view('appointment.book');
    }

    // Store appointment
    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'date' => 'required|date|after:today',
        ]);

        return redirect('/')->with('success', 'Appointment booking submitted successfully!');
    }
}
