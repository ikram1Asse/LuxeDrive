<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employe;
use App\Models\Voiture;
use App\Models\TestDrive;
use App\Models\Reserve;
use App\Models\RendezVousAchat;
use App\Models\Vente;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $users = User::where('role', 'user')->latest()->paginate(10);

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'users'));
    }

    public function management()
    {
        $statistics = [
            'employees' => Employe::count(),
            'cars' => Voiture::count(),
            'available_cars' => Voiture::where('statut', 'available')->count(),
            'test_drives' => TestDrive::count(),
            'pending_test_drives' => TestDrive::where('statut', 'scheduled')->count(),
            'reserves' => Reserve::count(),
            'pending_reserves' => Reserve::where('statut', 'pending')->count(),
            'rdv' => RendezVousAchat::count(),
            'pending_rdv' => RendezVousAchat::where('statut', 'pending')->count(),
            'ventes' => Vente::count(),
            'completed_ventes' => Vente::where('statut', 'completed')->count(),
        ];

        return view('admin.management', compact('statistics'));
    }

    public function employeeDashboard()
    {
        $statistics = [
            'employees' => Employe::count(),
            'cars' => Voiture::count(),
            'available_cars' => Voiture::where('statut', 'available')->count(),
            'test_drives' => TestDrive::count(),
            'pending_test_drives' => TestDrive::where('statut', 'scheduled')->count(),
            'reserves' => Reserve::count(),
            'pending_reserves' => Reserve::where('statut', 'pending')->count(),
            'rdv' => RendezVousAchat::count(),
            'pending_rdv' => RendezVousAchat::where('statut', 'pending')->count(),
            'ventes' => Vente::count(),
        ];

        return view('admin.employee-dashboard', compact('statistics'));
    }
}
