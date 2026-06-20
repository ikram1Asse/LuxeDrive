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
        overflow: hidden;
    }
    .card-header { background-color: #701A1A; color: white; padding: 20px 30px; font-size: 18px; font-weight: 700; }
    .card-body { padding: 25px 30px; }

    .form-row { display: flex; gap: 16px; flex-wrap: wrap; }
    .field { flex: 1; min-width: 240px; }
    label { display: block; font-weight: 600; margin-bottom: 8px; color: #343a40; }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        outline: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .error-list { color: #dc3545; margin-top: 8px; font-size: 13px; }

    .btn-save {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-save:hover { background-color: #218838; }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-cancel:hover { background-color: #5a6268; }
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
            <a href="{{ route('admin.reserves.index') }}" class="text-white font-semibold border-l-4 border-white">📋 Reservations</a>
            <a href="{{ route('admin.rdv.index') }}" class="text-white">📅 Appointments</a>
            <a href="{{ route('admin.ventes.index') }}" class="text-white">💰 Sales</a>
        </nav>
    </div>

    <div class="admin-content flex-1">
        <div class="card">
            <div class="card-header">Edit Reservation</div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="error-list">
                        <ul style="margin:0;padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.reserves.update', $reserve) }}" class="text-black">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="field">
                            <label for="id_client">Client</label>
                            <select id="id_client" name="id_client" class="form-control" required>
                                <option value="">Select a client</option>
                                @foreach($clients as $client)
                                    @php
                                        $clientId = $client->id_client ?? $client->id;
                                    @endphp
                                    <option value="{{ $clientId }}" {{ (string)old('id_client', $reserve->id_client) === (string)$clientId ? 'selected' : '' }}>
                                        {{ $client->nom ?? ($client->name ?? 'Client') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label for="id_voiture">Car</label>
                            <select id="id_voiture" name="id_voiture" class="form-control" required>
                                <option value="">Select a car</option>
                                @foreach($voitures as $voiture)
                                    <option value="{{ $voiture->id }}" {{ (string)old('id_voiture', $reserve->id_voiture) === (string)$voiture->id ? 'selected' : '' }}>
                                        {{ $voiture->modele ?? $voiture->nom ?? 'Car' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row" style="margin-top: 16px;">
                        <div class="field">
                            <label for="date_rdv">Date</label>
                            <input type="date" id="date_rdv" name="date_rdv" class="form-control"
                                value="{{ old('date_rdv', isset($reserve->date_rdv) ? $reserve->date_rdv->format('Y-m-d') : '') }}" required>
                        </div>

                        <div class="field">
                            <label for="heure_rdv">Time</label>
                            <input type="time" id="heure_rdv" name="heure_rdv" class="form-control"
                                value="{{ $reserve->heure_rdv ? \Carbon\Carbon::parse($reserve->heure_rdv)->format('H:i') : old('heure_rdv') }}" required>
                        </div>
                    </div>

                    <div class="form-row" style="margin-top: 16px;">
                        <div class="field">
                            <label for="statut">Status</label>
                            <select id="statut" name="statut" class="form-control" required>
                                @foreach(['en_attente', 'confirme', 'annule', 'effectue'] as $label)
                                    <option value="{{ $label }}" {{ old('statut', $reserve->statut) === $label ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label for="commentaire">Comment</label>
                            <textarea id="commentaire" name="commentaire" class="form-control" rows="4">{{ old('commentaire', $reserve->commentaire) }}</textarea>
                        </div>
                    </div>

                    <div style="display:flex; gap:12px; margin-top:18px;">
                        <button type="submit" class="btn-save">Update</button>
                        <a href="{{ route('admin.reserves.index') }}" class="btn-cancel">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@include('components.footer')
@endsection

