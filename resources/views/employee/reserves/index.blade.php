@extends('layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    body, p { font-family: 'Crimson Text', serif; font-weight: 500; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic; }
    .admin-sidebar { background: linear-gradient(135deg, #701A1A 0%, #8b1f1f 100%); min-height: 100vh; padding: 30px 0; }
    .admin-sidebar nav a { display: block; padding: 15px 25px; color: white; text-decoration: none; border-left: 4px solid transparent; }
    .admin-content { padding: 40px; background-color: #f8f9fa; }
    .users-table { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .users-table table { width: 100%; border-collapse: collapse; }
    .users-table th { background-color: #701A1A; color: white; padding: 20px; text-align: left; font-weight: 600; }
    .users-table td { padding: 15px 20px; border-bottom: 1px solid #eee; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: white; padding: 20px 30px; border-radius: 10px; }
    .btn-logout { background-color: #d9534f; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    .alert { padding: 15px 20px; border-radius: 5px; margin-bottom: 20px; background-color: #e2f0f7; border: 1px solid #b3dfe8; }
</style>
@include('components.navbar')
<div class="flex">
    <div class="admin-sidebar w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Employee View</h2>
        <nav>
            <a href="{{ route('employee.dashboard') }}" class="text-white">Dashboard</a>
            <a href="{{ route('employee.reserves.index') }}" class="text-white font-semibold border-l-4 border-white">📋 Reservations</a>
        </nav>
    </div>
    <div class="admin-content flex-1">
        <div class="header-top">
            <h1 class="text-3xl font-bold">View Reservations (Read-Only)</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">@csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <div class="alert">ℹ️ Read-only access</div>
        <div class="users-table">
            <h2 class="bg-white px-8 py-6 text-xl font-bold border-b">Reservations</h2>
            <table>
                <thead>
                    <tr><th>ID</th><th>Client</th><th>Car</th><th>Date</th><th>Time</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse ($reserves as $reserve)
                        <tr>
                            <td>#{{ $reserve->id }}</td>
                            <td>{{ $reserve->client->nom ?? 'N/A' }}</td>
                            <td>{{ $reserve->voiture->modele ?? 'N/A' }}</td>
                            <td>{{ $reserve->date_rdv->format('M d, Y') }}</td>
                            <td>{{ $reserve->heure_rdv }}</td>
                            <td><span style="padding: 5px 10px; background-color: #e9ecef; border-radius: 3px; font-size: 12px;">{{ ucfirst($reserve->statut) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-8 text-gray-500">No reservations</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $reserves->links() }}</div>
    </div>
</div>
@include('components.footer')
@endsection
