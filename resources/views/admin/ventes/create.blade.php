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
    .form-card { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 24px; }
    .form-row { display: flex; gap: 16px; flex-wrap: wrap; }
    .field { flex: 1; min-width: 220px; margin-bottom: 16px; }
    label { display: block; font-weight: 600; margin-bottom: 8px; }
    input, select, textarea { width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid #d1d5db; outline: none; }
    .btn-save { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; }
    .btn-save:hover { background-color: #218838; }
    .btn-secondary { background-color: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; }
    .btn-secondary:hover { background-color: #5a6268; }
    .text-danger { color: #dc3545; }
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
        <div class="form-card">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Create Sale</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ventes.store') }}" method="POST" class="text-black">
            @csrf

            <div class="form-row">
                <div class="field">
                    <label for="id_client">Client</label>
                    <select name="id_client" id="id_client" required>
                        <option value="" disabled {{ old('id_client') ? '' : 'selected' }}>Select client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id_client }}" {{ old('id_client') == $client->id_client ? 'selected' : '' }}>
                                {{ $client->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="id_voiture">Car</label>
                    <select id="id_voiture" name="id_voiture" class="form-control text-black" required>
                        <option value="" disabled {{ old('id_voiture') ? '' : 'selected' }}>Select a car</option>
                        @foreach($voitures as $voiture)
                            <option value="{{ $voiture->id }}" {{ old('id_voiture') == $voiture->id ? 'selected' : '' }}>
                                {{ $voiture->modele }} ({{ $voiture->annee }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="id_employe">Employee</label>
                    <select name="id_employe" id="id_employe" required>
                        <option value="" disabled {{ old('id_employe') ? '' : 'selected' }}>Select employee</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id_employe }}" {{ old('id_employe') == $employe->id_employe ? 'selected' : '' }}>
                                {{ $employe->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="date_vente">Date</label>
                    <input type="date" name="date_vente" id="date_vente" value="{{ old('date_vente') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="prix_final">Price</label>
                    <input type="number" step="0.01" min="0" name="prix_final" id="prix_final" value="{{ old('prix_final') }}" required>
                </div>

                {{-- 4. FIXED: Changed $key to $value to submit actual words, and fixed old() fallback rule name --}}
                <div class="field">
                    <label for="mode_paiement">Payment Method</label>
                    <select name="mode_paiement" id="mode_paiement" required>
                        <option value="" disabled {{ old('mode_paiement') ? '' : 'selected' }}>Select payment</option>
                        @foreach(['especes' => 'Espèces', 'carte' => 'Carte', 'virement' => 'Virement'] as $value => $label)
                            <option value="{{ $value }}" {{ old('mode_paiement') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                {{-- 5. FIXED: Changed $key to $value to submit strings instead of numbers --}}
                <div class="field">
                    <label for="statut">Status</label>
                    <select name="statut" id="statut" required>
                        <option value="" disabled {{ old('statut') ? '' : 'selected' }}>Select status</option>
                        @foreach(['en_cours' => 'En cours', 'finalise' => 'Finalisé', 'annule' => 'Annulé'] as $value => $label)
                            <option value="{{ $value }}" {{ old('statut') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="commentaire">Comment</label>
                    <textarea name="commentaire" id="commentaire" rows="3">{{ old('commentaire') }}</textarea>
                </div>
            </div>

            <div style="display:flex; gap:12px; align-items:center; margin-top: 10px;">
                <button type="submit" class="btn-save">Save</button>
                <a href="{{ route('admin.ventes.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>

        </div>
    </div>
</div>

@include('components.footer')
@endsection

