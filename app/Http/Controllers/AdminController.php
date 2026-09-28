<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use App\Models\Sale;
use App\Models\TestDrive;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'employee')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $users = User::where('role', 'employee')->latest()->paginate(10);

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'users'));
    }

    public function management()
    {
        $statistics = [
            'employees' => User::where('role', 'employee')->count(),
            'cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'test_drives' => TestDrive::count(),
            'pending_test_drives' => TestDrive::where('status', 'pending')->count(),
            'reserves' => Appointment::where('type', 'general')->count(),
            'pending_reserves' => Appointment::where('type', 'general')->where('status', 'pending')->count(),
            'rdv' => Appointment::where('type', 'purchase')->count(),
            'pending_rdv' => Appointment::where('type', 'purchase')->where('status', 'pending')->count(),
            'ventes' => Sale::count(),
            'completed_ventes' => Sale::where('status', 'completed')->count(),
        ];

        return view('admin.management', compact('statistics'));
    }

    public function employeeDashboard()
    {
        $statistics = [
            'employees' => User::where('role', 'employee')->count(),
            'cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'test_drives' => TestDrive::count(),
            'pending_test_drives' => TestDrive::where('status', 'pending')->count(),
            'reserves' => Appointment::where('type', 'general')->count(),
            'pending_reserves' => Appointment::where('type', 'general')->where('status', 'pending')->count(),
            'rdv' => Appointment::where('type', 'purchase')->count(),
            'pending_rdv' => Appointment::where('type', 'purchase')->where('status', 'pending')->count(),
            'ventes' => Sale::count(),
        ];

        return view('employee.employee-dashboard', compact('statistics'));
    }
}
