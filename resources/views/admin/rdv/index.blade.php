@extends('layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    body, p { font-family: 'Crimson Text', serif; font-weight: 500; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic; }
    .admin-sidebar { background: linear-gradient(135deg, #701A1A 0%, #8b1f1f 100%); min-height: 100vh; padding: 30px 0; }
    .admin-sidebar nav a { display: block; padding: 15px 25px; color: white; text-decoration: none; border-left: 4px solid transparent; transition: all 0.3s; }
    .admin-sidebar nav a:hover { background-color: rgba(255, 255, 255, 0.1); border-left-color: white; }
    .admin-content { padding: 40px; background-color: #f8f9fa; }
    .users-table { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .users-table table { width: 100%; border-collapse: collapse; }
    .users-table th { background-color: #701A1A; color: white; padding: 20px; text-align: left; font-weight: 600; }
    .users-table td { padding: 15px 20px; border-bottom: 1px solid #eee; }
    .btn-add { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; margin-bottom: 20px; }
    .btn-add:hover { background-color: #218838; }
    .btn-edit { background-color: #007bff; color: white; padding: 5px 15px; border: none; border-radius: 3px; font-size: 12px; cursor: pointer; text-decoration: none; }
    .btn-edit:hover { background-color: #0056b3; }
    .btn-delete { background-color: #dc3545; color: white; padding: 5px 15px; border: none; border-radius: 3px; font-size: 12px; cursor: pointer; margin-left: 5px; }
    .btn-delete:hover { background-color: #c82333; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: white; padding: 20px 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
    .btn-logout { background-color: #d9534f; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    .btn-logout:hover { background-color: #c9302c; }
    .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px; }
</style>

<div class="flex">
    <div class="admin-sidebar w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Management</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="text-white font-semibold">Dashboard</a>
            <a href="{{ route('admin.management') }}" class="text-white font-semibold">Management</a>
            <hr style="border-color: rgba(255,255,255,0.2); margin: 15px 0;">
            <a href="{{ route('admin.employes.index') }}" class="text-white">👥 Employees</a>
            <a href="{{ route('admin.voitures.index') }}" class="text-white">🚗 Cars</a>
            <a href="{{ route('admin.test-drives.index') }}" class="text-white">🏁 Test Drives</a>
            <a href="{{ route('admin.reserves.index') }}" class="text-white">📋 Reservations</a>
            <a href="{{ route('admin.rdv.index') }}" class="text-white font-semibold border-l-4 border-white">📅 Appointments</a>
            <a href="{{ route('admin.ventes.index') }}" class="text-white">💰 Sales</a>
        </nav>
    </div>
    <div class="admin-content flex-1">
        <div class="header-top">
            <h1 class="text-3xl font-bold text-gray-900">Manage Purchase Appointments</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">@csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('admin.rdv.create') }}" class="btn-add">+ Schedule Appointment</a>
        <div class="users-table">
            <h2 class="bg-white px-8 py-6 text-xl font-bold text-gray-900 border-b">Purchase Appointments</h2>
            <table>
                <thead>
                    <tr><th>ID</th><th>Client</th><th>Car</th><th>Date</th><th>Time</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse ($rdvs as $rdv)
                        <tr class="text-gray-900">
                            <td>#{{ $rdv->id }}</td>
                            <td>{{ $rdv->client->nom ?? 'N/A' }}</td>
                            <td>{{ $rdv->voiture->modele ?? 'N/A' }}</td>
                            <td>{{ $rdv->date_rdv->format('M d, Y') }}</td>
                            <td>{{ $rdv->heure_rdv }}</td>
                            <td><span style="padding: 5px 10px; background-color: #e9ecef; border-radius: 3px; font-size: 12px;">{{ ucfirst($rdv->statut) }}</span></td>
                            <td>
                                <a href="{{ route('admin.rdv.edit', $rdv) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.rdv.destroy', $rdv) }}" method="POST" style="display: inline;">@csrf @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-8 text-gray-500">No appointments found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $rdvs->links() }}</div>
    </div>
</div>
@include('components.footer')
@endsection
