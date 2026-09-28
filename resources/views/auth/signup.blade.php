@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }

    h2 {font-family: 'Italiana', serif; font-weight: 700; letter-spacing: 6px; }
    body, p, label {font-family: 'Crimson Text', serif; font-weight: 500; font-size: 18px;}

    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }
    
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.08); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); }
    
    input { background-color: white !important; border: 1px solid #ddd !important; color: #333; padding: 10px 15px; border-radius: 4px; }
    input:focus { border-color: #701A1A !important; outline: none; box-shadow: 0 0 10px rgba(112, 26, 26, 0.2) !important; }
    input::placeholder { color: #999; }
</style>

@include('components.navbar')

<!-- SIGNUP SECTION -->
<section class="min-h-screen pt-32 pb-20 flex items-center" style="background: url('{{ asset('images/hero-audi.jpeg') }}') no-repeat center/cover;">
    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-12 items-center px-8 lg:px-0">
        <!-- Form -->
        <div class="bg-gray-100 rounded-3xl p-12 shadow-lg">
            <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Sign Up</h2>
            
            <form action="{{ route('signup.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                    <input
                        type="text"
                        name="nom"
                        id="nom"
                        placeholder="Enter your last name"
                        required
                        class="w-full px-4 py-3"
                        value="{{ old('nom') }}"
                    />
                    @error('nom') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                    <input
                        type="text"
                        name="prenom"
                        id="prenom"
                        placeholder="Enter your first name"
                        required
                        class="w-full px-4 py-3"
                        value="{{ old('prenom') }}"
                    />
                    @error('prenom') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                    <input
                        type="tel"
                        name="telephone"
                        placeholder="Enter your phone number"
                        required
                        class="w-full px-4 py-3"
                        value="{{ old('telephone') }}"
                    />
                    @error('telephone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        class="w-full px-4 py-3"
                        value="{{ old('email') }}"
                    />
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="w-full px-4 py-3"
                    />
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                        class="w-full px-4 py-3"
                    />
                    @error('password_confirmation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <p class="text-center text-sm text-gray-600">
                    Already have an account? <a href="{{ route('login.show') }}" class="text-red-600 font-semibold hover:underline">Login</a>
                </p>

                <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white py-3 rounded-full font-semibold transition-colors text-lg">
                    Sign Up
                </button>
            </form>
        </div>

        <!-- Image -->
        <div class="hidden lg:block">
        </div>
    </div>
</section>

@include('components.footer')

@endsection
