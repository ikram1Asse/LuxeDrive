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

    .card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 25px;
    }

    label { font-weight: 600; }
    input, select, textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 6px;
    }
    textarea { min-height: 100px; }

    .btn-save {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-save:hover { background-color: #218838; }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-cancel:hover { background-color: #5a6268; }

    .form-row { display: flex; gap: 16px; flex-wrap: wrap; }
    .form-col { flex: 1; min-width: 240px; }

    .error-list { color: #dc3545; margin-top: 8px; font-size: 13px; }
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
            <a href="{{ route('admin.rdv.index') }}" class="text-white">📅 Appointments</a>
            <a href="{{ route('admin.ventes.index') }}" class="text-white font-semibold border-l-4 border-white">💰 Sales</a>
        </nav>
    </div>

    <div class="admin-content flex-1">
        <div class="card">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Create Appointment</h1>

            @if ($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rdv.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <label for="id_client">Client</label>
                        <select id="id_client"class="text-black" name="id_client" required>
                            <option value="">Select a client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id_client ?? $client->id }}" {{ old('id_client') == ($client->id_client ?? $client->id) ? 'selected' : '' }}>
                                    {{ $client->nom ?? ($client->name ?? 'Client') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-col">
                        <label for="id_voiture">Car</label>
                        <select id="id_voiture" class="text-black" name="id_voiture" required>
                            <option value="">Select a car</option>
                            @foreach ($voitures as $voiture)
                                <option value="{{ $voiture->id }}" {{ old('id_voiture') == $voiture->id ? 'selected' : '' }}>
                                    {{ $voiture->modele ?? $voiture->nom ?? 'Car' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row" style="margin-top:16px;">
                    <div class="form-col">
                        <label for="date_rdv">Date</label>
                        <input type="date" id="date_rdv" class="text-black" name="date_rdv" value="{{ old('date_rdv') }}" required>
                    </div>

                    <div class="form-col">
                        <label for="heure_rdv">Hour</label>
                        <input type="time" id="heure_rdv" class="text-black" name="heure_rdv" 
                        value="{{ old('heure_rdv') }}" required>
                    </div>
                </div>

                <div class="form-row" style="margin-top:16px;">
                    <div class="form-col">
                        <label for="statut">Status</label>
                        <select id="statut" class="text-black" name="statut" required>
                                @foreach(['en_attente', 'confirme', 'annule', 'effectue'] as $label)
                                    <option value="{{ $label }}" {{ old('statut') === $label ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $label)) }}
                                    </option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-col">
                        <label for="commentaire">Comment</label>
                        <textarea id="commentaire" class="text-black" name="commentaire">{{ old('commentaire') }}</textarea>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:18px;">
                    <button type="submit" class="btn-save">Save</button>
                    <a href="{{ route('admin.rdv.index') }}" class="btn-cancel" style="display:inline-flex; align-items:center; justify-content:center;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.footer')
@endsection

