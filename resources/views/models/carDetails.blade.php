@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    body, p { font-family: 'Crimson Text', serif; font-weight: 500; }
    h2{ font-family: 'Playfair Display', serif; font-weight: 700; font-style: italic; }
    
    input, textarea { background-color: #333 !important; border: 1px solid #555 !important; color: white; padding: 12px 15px; border-radius: 6px; }
    input::placeholder, textarea::placeholder { color: #999; }
    input:focus, textarea:focus { border-color: #701A1A !important; outline: none; box-shadow: 0 0 10px rgba(112, 26, 26, 0.3) !important; }
</style>

@include('components.navbar')

<!-- Car Details SECTION -->
<section class="bg-gradient-to-b from-gray-900 to-black min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-12 items-center px-8 lg:px-0">

        <!-- Image -->
        <div class="hidden lg:block order-1 relative w-full">
            <div id="car-slider" class="relative overflow-hidden rounded-lg">
                @php
                    $images = ($voiture->images ?? collect())->sortBy('ordre')->values();
                @endphp

                @if($images->count() > 0)
                    @foreach($images as $index => $image)
                        <img
                            src="{{ asset('images/cars/' . $image->url) }}"
                            class="car-slide w-full h-[500px] object-cover transition-all duration-300 {{ $index === 0 ? '' : 'hidden' }}"
                            data-index="{{ $index }}"
                            alt="{{ $voiture->modele }}"
                            loading="lazy"
                        >
                    @endforeach
                @else
                    <div class="w-full h-[500px] bg-gray-800 flex items-center justify-center">
                        <p class="text-gray-300">No image available</p>
                    </div>
                @endif
            </div>
            <!-- Buttons -->
            <button
                type="button"
                onclick="prevSlide()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/60 text-white p-3 rounded-full"
                {{ ($images->count() ?? 0) <= 1 ? 'disabled' : '' }}
            >
                ‹
            </button>

            <button
                type="button"
                onclick="nextSlide()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/60 text-white p-3 rounded-full"
                {{ ($images->count() ?? 0) <= 1 ? 'disabled' : '' }}
            >
                ›
            </button>


        </div>

        <!-- Car Details -->
        <div class="order-1 lg:order-2">
            @php
                $modele = $voiture->modele ?? '';
                $carburant = $voiture->carburant ?? '';
                $horsepower = $voiture->horsepower;
                $drivetrain = $voiture->drivetrain ?? '';
                $transmission = $voiture->transmission ?? '';
                $prix = $voiture->prix;
                $annee = $voiture->annee ?? '';
                $kilometrage = $voiture->kilometrage;
            @endphp

            <h2 class="text-5xl lg:text-6xl text-white mb-12 leading-tight">
                {{ $modele }}
            </h2>
            
            <div class="space-y-3 mb-6  flex-grow">

                <div class="flex justify-between">
                    <span class="text-white font-semibold">Engine</span>
                    <span class="text-white">{{ $carburant ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white font-semibold">Horsepower</span>
                    <span class="text-white">{{ $horsepower ? $horsepower . ' hp' : 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white font-semibold">Drivetrain</span>
                    <span class="text-white">{{ $drivetrain ?: 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white font-semibold">Transmission</span>
                    <span class="text-white">{{ $transmission ?: 'N/A' }}</span>
                </div>

            </div>

            <!-- Price & Year -->
                <div class="mb-4 pb-4 border-t">
                    <p class="text-lg font-bold text-red-600 mt-4">{{ $prix !== null ? '$' . number_format($prix, 0) : 'N/A' }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $annee }} • {{ $kilometrage !== null ? number_format($kilometrage) : 'N/A' }}km
                    </p>
                </div>


            <!-- Button -->
                <a href="{{ route('testdrive.book') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors">
                    Book a Test Drive
                </a>
        </div>
    </div>
</section>

<script>
    let currentSlide = 0;

    const sliderEl = document.getElementById('car-slider');
    const slides = sliderEl ? sliderEl.querySelectorAll('.car-slide') : [];

    function showSlide(index) {
        if (!slides || slides.length === 0) return;

        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });
    }

    function nextSlide() {
        if (!slides || slides.length === 0) return;
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        if (!slides || slides.length === 0) return;
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Ensure first image is visible on load
    showSlide(0);
</script>



@include('components.footer')

@endsection
