<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = Car::all();

        return view('models.index', compact('voitures'));
    }

    public function show(Car $car)
    {
        $car->load('images');
        $voiture = $car;

        return view('models.carDetails', compact('voiture'));
    }
}
