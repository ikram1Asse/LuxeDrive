@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    body, p { font-family: 'Crimson Text', serif; font-weight: 500; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic; }
    
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
        text-align: center;
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
    
    .management-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 40px;
    }
    
    .management-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s;
    }
    
    .management-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .management-card a {
        display: block;
        text-decoration: none;
        color: #701A1A;
        font-size: 16px;
        font-weight: bold;
    }
    
    .management-card .card-icon {
        font-size: 40px;
        margin-bottom: 10px;
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
</style>


<div class="flex">
    <!-- Sidebar -->
    <div class="admin-sidebar w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Management</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="text-white font-semibold">Dashboard</a>
            <a href="{{ route('admin.management') }}" class="text-white font-semibold border-l-4 border-white">Management</a>
            <hr style="border-color: rgba(255,255,255,0.2); margin: 15px 0;">
            <a href="{{ route('admin.employes.index') }}" class="text-white">👥 Employees</a>
            <a href="{{ route('admin.voitures.index') }}" class="text-white">🚗 Cars</a>
            <a href="{{ route('admin.test-drives.index') }}" class="text-white">🏁 Test Drives</a>
            <a href="{{ route('admin.reserves.index') }}" class="text-white">📋 Reservations</a>
            <a href="{{ route('admin.rdv.index') }}" class="text-white">📅 Appointments</a>
            <a href="{{ route('admin.ventes.index') }}" class="text-white">💰 Sales</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content flex-1">
        <div class="header-top">
            <h1 class="text-3xl font-bold text-gray-900">Management Dashboard</h1>
            <div class="flex gap-3">
                <a href="{{ route('profile.show') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded" title="View your profile">
                    👤 Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['employees'] }}</div>
                <div class="stat-label">Total Employees</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['cars'] }}</div>
                <div class="stat-label">Total Cars</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['available_cars'] }}</div>
                <div class="stat-label">Available Cars</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['test_drives'] }}</div>
                <div class="stat-label">Total Test Drives</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['pending_test_drives'] }}</div>
                <div class="stat-label">Pending Test Drives</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['reserves'] }}</div>
                <div class="stat-label">Total Reservations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['pending_reserves'] }}</div>
                <div class="stat-label">Pending Reservations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['rdv'] }}</div>
                <div class="stat-label">Total Appointments</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['pending_rdv'] }}</div>
                <div class="stat-label">Pending Appointments</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['ventes'] }}</div>
                <div class="stat-label">Total Sales</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $statistics['completed_ventes'] }}</div>
                <div class="stat-label">Completed Sales</div>
            </div>
        </div>

        <!-- Management Actions -->
        <h2 class="text-2xl font-bold text-gray-900 mb-6 mt-10">Quick Actions</h2>
        <div class="management-grid">
            <div class="management-card">
                <div class="card-icon">👥</div>
                <a href="{{ route('admin.employes.index') }}">Manage Employees</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Add, edit, or remove employees</p>
            </div>
            <div class="management-card">
                <div class="card-icon">🚗</div>
                <a href="{{ route('admin.voitures.index') }}">Manage Cars</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Manage vehicle inventory</p>
            </div>
            <div class="management-card">
                <div class="card-icon">🏁</div>
                <a href="{{ route('admin.test-drives.index') }}">Manage Test Drives</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Schedule and track test drives</p>
            </div>
            <div class="management-card">
                <div class="card-icon">📋</div>
                <a href="{{ route('admin.reserves.index') }}">Manage Reservations</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Manage car reservations</p>
            </div>
            <div class="management-card">
                <div class="card-icon">📅</div>
                <a href="{{ route('admin.rdv.index') }}">Manage Appointments</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Schedule purchase appointments</p>
            </div>
            <div class="management-card">
                <div class="card-icon">💰</div>
                <a href="{{ route('admin.ventes.index') }}">Manage Sales</a>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Track all sales transactions</p>
            </div>
        </div>
    </div>
</div>

@include('components.footer')

@endsection
