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
    .btn-submit { background-color: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    .btn-back { background-color: #6c757d; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px; text-decoration: none; display: inline-block; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: white; padding: 20px 30px; border-radius: 10px; }
    .btn-logout { background-color: #d9534f; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px; }
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
            <h1 class="text-3xl font-bold text-black">Add New Car</h1>
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
        <div class="form-container text-black">
            <form action="{{ route('admin.voitures.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="model">Model *</label>
                        <input type="text" id="model" name="model" value="{{ old('model') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year *</label>
                        <input type="number" id="year" name="year" value="{{ old('year') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="mileage">Kilometers *</label>
                        <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="fuel">Fuel Type *</label>
                        <select id="fuel" name="fuel" required>
                            <option value="">-- Select --</option>
                            <option value="Gasoline" {{ old('fuel') === 'Gasoline' ? 'selected' : '' }}>Gasoline</option>
                            <option value="Diesel" {{ old('fuel') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Hybrid" {{ old('fuel') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="Electric" {{ old('fuel') === 'Electric' ? 'selected' : '' }}>Electric</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horsepower">Horsepower *</label>
                        <input type="number" id="horsepower" name="horsepower" value="{{ old('horsepower') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="drivetrain">Drivetrain *</label>
                        <select id="drivetrain" name="drivetrain" required>
                            <option value="">-- Select --</option>
                            <option value="FWD" {{ old('drivetrain') === 'FWD' ? 'selected' : '' }}>Front-Wheel Drive</option>
                            <option value="RWD" {{ old('drivetrain') === 'RWD' ? 'selected' : '' }}>Rear-Wheel Drive</option>
                            <option value="AWD" {{ old('drivetrain') === 'AWD' ? 'selected' : '' }}>All-Wheel Drive</option>
                            <option value="4WD" {{ old('drivetrain') === '4WD' ? 'selected' : '' }}>4-Wheel Drive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transmission">Transmission *</label>
                        <select id="transmission" name="transmission" required>
                            <option value="">-- Select --</option>
                            <option value="Manual" {{ old('transmission') === 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="Automatic" {{ old('transmission') === 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="CVT" {{ old('transmission') === 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="color">Color *</label>
                        <input type="text" id="color" name="color" value="{{ old('color') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="reserved" {{ old('status') === 'reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="main_image">Main Image</label>
                    <input type="file" id="main_image" name="main_image" accept="image/*">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn-submit">Add Car</button>
                    <a href="{{ route('admin.voitures.index') }}" class="btn-back">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('components.footer')
@endsection
