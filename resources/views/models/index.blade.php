@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    body, p, h1 { font-family: 'Italiana', serif;}
    h1 { font-weight: 600; letter-spacing: 6px; }
    body, p { font-weight: bold; letter-spacing: 4px;}
    
    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }
    
    .fade-in { animation: fadeIn 0.8s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    
    .scale-in { animation: scaleIn 0.6s ease-out; }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.08); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); }
    
    .gradient-text { background: linear-gradient(135deg, #701A1A, #8b1f1f); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    
    .nav-link { position: relative; cursor: pointer; transition: color 0.3s ease; }
    .nav-link:hover { color: #701A1A; }
    .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background-color: #701A1A; transition: width 0.3s ease; }
    .nav-link:hover::after { width: 100%; }
    
    .card-hover { transition: all 0.4s; position: relative; overflow: hidden; }
    .card-hover:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2); }
    
    .models-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        padding: 2rem 0;
    }

    @media (max-width: 1024px) {
        .models-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .models-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<!-- MODELS SECTION -->
<section class="bg-black min-h-screen pt-40 pb-20">
    @include('components.navbar')
    <div class="max-w-7xl mx-auto px-8 lg:px-0">
        <!-- Header -->
        <div class="text-center mb-20 fade-in">
            <h1 class="text-5xl lg:text-6xl text-white mb-4 ">
                Our Collection
            </h1>
            <p class="text-gray-300 text-lg">Explore our exclusive selection of premium Audi vehicles</p>
        </div>

        <!-- Cars Grid -->
        @if(!empty($voitures) && $voitures->count() > 0)
            <div class="models-grid">
                @foreach($voitures as $voiture)

                    <div class="shadow-lg overflow-hidden card-hover scale-in hover:shadow-2xl transition-all flex flex-col h-full" style="border-radius: 3rem; background: #f3f3f3;">
                        <!-- Image -->
                        <div class="relative h-40 bg-gray-200 overflow-hidden">
                            <img
                                src="{{ asset('images/cars/' . $voiture->image_principale) }}"
                                alt="{{ $voiture->modele }}"
                                class="w-full h-full object-cover"
                            />
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Model Name -->
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                {{ $voiture->modele }}
                            </h3>

                            <!-- Specs -->
                            <div class="space-y-3 mb-6 text-sm flex-grow">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-semibold">Engine</span>
                                    <span class="text-gray-900">{{ $voiture->carburant }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-semibold">Horsepower</span>
                                    <span class="text-gray-900">{{ $voiture->horsepower ? $voiture->horsepower . ' hp' : 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-semibold">Drivetrain</span>
                                    <span class="text-gray-900">{{ $voiture->drivetrain ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-semibold">Transmission</span>
                                    <span class="text-gray-900">{{ $voiture->transmission }}</span>
                                </div>
                            </div>

                            <!-- Price & Year -->
                            <div class="mb-4 pb-4 border-t">
                                <p class="text-lg font-bold text-red-600 mt-4">${{ number_format($voiture->prix, 0) }}</p>
                                <p class="text-xs text-gray-500">{{ $voiture->annee }} • {{ number_format($voiture->kilometrage) }}km</p>
                            </div>

                            <!-- Button -->
                            <a href="{{ route('models.carDetails', $voiture->id) }}" class="hover:bg-red-700 text-white text-center py-2 rounded-full font-semibold transition-colors text-sm px-10" style="background-color: #701A1A; width: 50%;">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">No vehicles available at the moment.</p>
            </div>
        @endif
    </div>
</section>

@include('components.footer')

@endsection
