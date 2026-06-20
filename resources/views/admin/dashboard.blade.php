@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    body, p, h1, h2, h3, h4, h5, h6 { font-family: 'Italiana', serif;}
    h1, h2, h3, h4, h5, h6 { font-weight: 700; letter-spacing: 6px; }
    body, p { font-weight: bold; letter-spacing: 4px; font-weight: 500;}
    
    .admin-sidebar {
        background: linear-gradient(135deg, #701A1A 0%, #8b1f1f 100%);
        min-height: 100vh;
        padding: 30px 0;
    }
    
    .admin-sidebar nav a {
        display: block;
        padding: 15px 25px;
        color: white;
        text-decoration: none;
        border-left: 4px solid transparent;
        transition: all 0.3s;
    }
    
    .admin-sidebar nav a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-left-color: white;
    }
    
    .admin-content {
        padding: 40px;
        background-color: #f8f9fa;
    }
    
    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        border-left: 5px solid #701A1A;
    }
    
    .stat-number {
        font-size: 36px;
        font-weight: bold;
        color: #701A1A;
    }
    
    .stat-label {
        font-size: 14px;
        color: #666;
        margin-top: 10px;
    }
    
    .users-table {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .users-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .users-table th {
        background-color: #701A1A;
        color: white;
        padding: 20px;
        text-align: left;
        font-weight: 600;
    }
    

.users-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        color: #000;
    }

    
    .users-table tbody tr:hover {
        background-color: #f5f5f5;
    }
    
    .btn-logout {
        background-color: #d9534f;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
    }
    
    .btn-logout:hover {
        background-color: #c9302c;
    }
    
    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        background: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <div class="admin-sidebar w-full lg:w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Admin Panel</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="text-white font-semibold border-l-4 border-white">Dashboard</a>
            <a href="{{ route('admin.employes.index') }}" class="text-white font-semibold border-l-4 border-transparent hover:border-white">Users</a>
            <a href="{{ route('admin.rdv.index') }}" class="text-white font-semibold border-l-4 border-transparent hover:border-white">Rondez-vous</a>
        </nav>
    </div>

<!-- Main Content -->
    <div class="admin-content flex-1" style="padding-top: 80px;">
        <div class="header-top flex flex-col sm:flex-row gap-4">
            <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ optional(Auth::user())->name ?? 'Admin' }}!</h1>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('profile.show') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" title="View your profile">
                    👤 Profile
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="stat-card">
                <div class="stat-number">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalAdmins }}</div>
                <div class="stat-label">Total Admins</div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="users-table">
            <div class="overflow-x-auto">
            <h2 class="bg-white px-8 py-6 text-xl font-bold text-black border-b border-gray-200">Recent Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                    @forelse ($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telephone ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

@include('components.footer')

@endsection
