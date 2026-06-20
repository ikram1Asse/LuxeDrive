@extends('layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    body, p { font-family: 'Crimson Text', serif; font-weight: 500; }
    h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic; }
    .admin-sidebar { background: linear-gradient(135deg, #701A1A 0%, #8b1f1f 100%); min-height: 100vh; padding: 30px 0; }
    .admin-sidebar nav a { display: block; padding: 15px 25px; color: white; text-decoration: none; border-left: 4px solid transparent; }
    .admin-content { padding: 40px; background-color: #f8f9fa; }
    .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); max-width: 800px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: 'Crimson Text', serif; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #701A1A; box-shadow: 0 0 0 3px rgba(112, 26, 26, 0.1); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    .btn-submit { background-color: #007bff; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    .btn-back { background-color: #6c757d; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px; text-decoration: none; display: inline-block; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: white; padding: 20px 30px; border-radius: 10px; }
    .btn-logout { background-color: #d9534f; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px; }
    .img-preview { max-width: 200px; margin-top: 10px; border-radius: 5px; }
</style>

<div class="flex">
    <div class="admin-sidebar w-64">
        <h2 class="text-white text-xl font-bold px-6 mb-8">Management</h2>
        <nav>
            <a href="{{ route('admin.management') }}" class="text-white">Management</a>
            <a href="{{ route('admin.voitures.index') }}" class="text-white font-semibold border-l-4 border-white">🚗 Cars</a>
        </nav>
    </div>
    <div class="admin-content flex-1">
        <div class="header-top">
            <h1 class="text-3xl font-bold text-black">Edit Car</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">@csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        @if ($errors->any())
            <div class="alert-danger">
                <strong>Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-container">
            <form action="{{ route('admin.voitures.update', $voiture) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label for="modele">Model *</label>
                        <input type="text" id="modele" class="text-black" name="modele" value="{{ old('modele', $voiture->modele) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="annee">Year *</label>
                        <input type="number" id="annee" class="text-black" name="annee" value="{{ old('annee', $voiture->annee) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="prix">Price ($) *</label>
                        <input type="number" id="prix" name="prix" class="text-black" step="0.01" value="{{ old('prix', $voiture->prix) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kilometrage">Kilometers *</label>
                        <input type="number" id="kilometrage"  class="text-black" name="kilometrage" value="{{ old('kilometrage', $voiture->kilometrage) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="carburant">Fuel Type *</label>
                        <select id="carburant" class="text-black" name="carburant" required>
                            <option value="Gasoline" {{ old('carburant', $voiture->carburant) === 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                            <option value="Diesel" {{ old('carburant', $voiture->carburant) === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Hybrid" {{ old('carburant', $voiture->carburant) === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="Electric" {{ old('carburant', $voiture->carburant) === 'Electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horsepower">Horsepower *</label>
                        <input type="number" id="horsepower" class="text-black" name="horsepower" value="{{ old('horsepower', $voiture->horsepower) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="drivetrain">Drivetrain *</label>
                        <select id="drivetrain" class="text-black" name="drivetrain" required>
                            <option value="FWD" {{ old('drivetrain', $voiture->drivetrain) === 'FWD' ? 'selected' : '' }}>Front-Wheel Drive</option>
                            <option value="RWD" {{ old('drivetrain', $voiture->drivetrain) === 'RWD' ? 'selected' : '' }}>Rear-Wheel Drive</option>
                            <option value="AWD" {{ old('drivetrain', $voiture->drivetrain) === 'AWD' ? 'selected' : '' }}>All-Wheel Drive</option>
                            <option value="4WD" {{ old('drivetrain', $voiture->drivetrain) === '4WD' ? 'selected' : '' }}>4-Wheel Drive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transmission">Transmission *</label>
                        <select id="transmission" class="text-black" name="transmission" required>
                            <option value="Manual" {{ old('transmission', $voiture->transmission) === 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="Automatic" {{ old('transmission', $voiture->transmission) === 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="CVT" {{ old('transmission', $voiture->transmission) === 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="couleur">Color *</label>
                        <input type="text" id="couleur" class="text-black" name="couleur" value="{{ old('couleur', $voiture->couleur) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="statut">Status *</label>
                        <select id="statut" class="text-black" name="statut" required>
                            <option value="disponible" {{ old('statut', $voiture->statut) === 'disponible' ? 'selected' : '' }}>Available</option>
                            <option value="reserve" {{ old('statut', $voiture->statut) === 'reserve' ? 'selected' : '' }}>Reserved</option>
                            <option value="vendu" {{ old('statut', $voiture->statut) === 'vendu' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="text-black" name="description" rows="4">{{ old('description', $voiture->description) }}</textarea>
                </div>
                <div class="form-group text-black">
                    <label for="image_principale">Main Image</label>
                    @if($voiture->image_principale)
                        <p>Current: <img src="{{ Storage::url($voiture->image_principale) }}" alt="Car Image" class="img-preview"></p>
                    @endif
                    <input type="file" id="image_principale" class="text-black" name="image_principale" accept="image/*">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn-submit">Update Car</button>
                    <a href="{{ route('admin.voitures.index') }}" class="btn-back">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('components.footer')
@endsection
