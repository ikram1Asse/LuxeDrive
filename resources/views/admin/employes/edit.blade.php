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
    
    .admin-content {
        padding: 40px;
        background-color: #f8f9fa;
        flex: 1;
    }
    
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: 'Crimson Text', serif;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #701A1A;
        box-shadow: 0 0 0 3px rgba(112, 26, 26, 0.1);
    }
    
    .btn-submit {
        background-color: #007bff;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
        font-weight: bold;
    }
    
    .btn-submit:hover {
        background-color: #0056b3;
    }
    
    .btn-back {
        background-color: #6c757d;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
        margin-left: 10px;
    }
    
    .btn-back:hover {
        background-color: #5a6268;
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

    .alert {
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>



<div class="flex">
    <!-- Sidebar -->
    <div class="admin-sidebar w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Management</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="text-white font-semibold">Dashboard</a>
            <a href="{{ route('admin.management') }}" class="text-white font-semibold">Management</a>
            <hr style="border-color: rgba(255,255,255,0.2); margin: 15px 0;">
            <a href="{{ route('admin.employes.index') }}" class="text-white font-semibold border-l-4 border-white">👥 Employees</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <div class="header-top">
            <h1 class="text-3xl font-bold text-gray-900">Edit Employee</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.employes.update', $employe) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nom">Full Name *</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom', $employe->nom) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $employe->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Phone *</label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $employe->telephone) }}" required>
                </div>

                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="manager" {{ old('role', $employe->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="vendeur" {{ old('role', $employe->role) === 'vendeur' ? 'selected' : '' }}>Sales Person (Vendeur)</option>
                        <option value="technicien" {{ old('role', $employe->role) === 'technicien' ? 'selected' : '' }}>Technician</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_embauche">Hire Date *</label>
                    <input type="date" id="date_embauche" name="date_embauche" value="{{ old('date_embauche', $employe->date_embauche->format('Y-m-d')) }}" required>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn-submit">Update Employee</button>
                    <a href="{{ route('admin.employes.index') }}" class="btn-back">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.footer')

@endsection
