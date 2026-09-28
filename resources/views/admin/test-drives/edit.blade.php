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
    .card { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .card-header { background-color: #701A1A; color: white; padding: 20px 30px; font-size: 18px; font-weight: 700; }
    .card-body { padding: 25px 30px; }
    .btn-primary { background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    .btn-primary:hover { background-color: #0056b3; }
    .btn-secondary { background-color: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
    .btn-secondary:hover { background-color: #5a6268; }
    label { font-weight: 600; color: #343a40; }
    .form-control { width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 5px; }
    .form-control:focus { outline: none; border-color: #007bff; box-shadow: 0 0 0 2px rgba(0,123,255,0.25); }
    .text-danger { color: #dc3545; font-size: 12px; margin-top: 6px; display: block; }
    select.form-control { appearance: none; background: #fff; }
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
            <a href="{{ route('admin.test-drives.index') }}" class="text-white font-semibold border-l-4 border-white">🏁 Test Drives</a>
            <a href="{{ route('admin.reserves.index') }}" class="text-white">📋 Reservations</a>
            <a href="{{ route('admin.rdv.index') }}" class="text-white">📅 Appointments</a>
            <a href="{{ route('admin.ventes.index') }}" class="text-white">💰 Sales</a>
        </nav>
    </div>

    <div class="admin-content flex-1">
        <div class="card">
            <div class="card-header">Edit Test Drive #{{ $testDrive->id }}</div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger" style="background:#f8d7da;border:1px solid #f5c2c7;padding:10px 12px;border-radius:6px;margin-bottom:15px;">
                        <ul style="margin:0;padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.test-drives.update', $testDrive) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="client_id">Client</label>
                        <select id="client_id" name="client_id" class="form-control text-black" required>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ (string)$client->id === (string)$testDrive->client_id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>                  
                    </div>

                    <div class="mb-4">
                        <label for="car_id">Car</label>
                        <select id="car_id" name="car_id" class="form-control text-black" required>
                            @foreach ($voitures as $voiture)
                                <option value="{{ $voiture->id }}" {{ (string)$voiture->id === (string)$testDrive->car_id ? 'selected' : '' }}>
                                    {{ $voiture->model }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control text-black" required value="{{ optional($testDrive->date)->format('Y-m-d') }}">
                    </div>

                    <div class="mb-4">
                        <label for="time">Time</label>
                        <input type="time" id="time" name="time" class="form-control text-black" required 
                            value="{{ $testDrive->time ? \Carbon\Carbon::parse($testDrive->time)->format('H:i') : old('time') }}">
                    </div>

                    <div class="mb-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control text-black" required>
                            @foreach (['pending','confirmed','cancelled','completed'] as $status)
                                <option value="{{ $status }}" {{ (string)$testDrive->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="4">{{ $testDrive->notes }}</textarea>
                    </div>

                    <div style="display:flex; gap:10px; align-items:center;">
                        <button type="submit" class="btn-primary">Save Changes</button>
                        <a href="{{ route('admin.test-drives.index') }}" class="btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@include('components.footer')
@endsection

