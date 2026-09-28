@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');

    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    h2 {font-family: 'Italiana', serif; font-weight: 600; letter-spacing: 6px; }
    body, p { font-family: 'Crimson Text', serif; font-weight: 500;}
    label {font-size:20px;}
    
    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }
    
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.08); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); }
    
    input { background-color: white !important; border: 1px solid #ddd !important; color: #333; padding: 10px 15px; border-radius: 4px; }
    input:focus { border-color: #701A1A !important; outline: none; box-shadow: 0 0 10px rgba(112, 26, 26, 0.2) !important; }
    input::placeholder { color: #999; }
    .password-field { position: relative; }
    .password-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #701A1A; font-size: 14px; font-weight: 600; cursor: pointer; background: none; border: none; }
</style>

@include('components.navbar')

<!-- LOGIN SECTION -->
<section class="min-h-screen pt-32 pb-20 flex items-center" style="background: url('{{ asset('images/hero-audi.jpeg') }}') no-repeat center/cover;">
    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-12 items-center px-8 lg:px-0">
        <!-- Form -->
        <div class="bg-gray-100 rounded-3xl p-12 shadow-lg">
            <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Login</h2>
            
            <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                @csrf
                
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
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="password-field">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            class="w-full px-4 py-3"
                        />
                        <button type="button" id="password-toggle" class="password-toggle" aria-label="Show password" aria-pressed="false">Show</button>
                    </div>
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <p class="text-center text-sm text-gray-600">
                    Don't have an account? <a href="{{ route('signup.show') }}" class="text-red-600 font-semibold hover:underline">Sign Up</a>
                </p>

                <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white py-3 rounded-full font-semibold transition-colors text-lg">
                    Login
                </button>
            </form>
        </div>

        <!-- Image -->
        <div class="hidden lg:block">
        </div>
    </div>
</section>

<script>
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');

    passwordToggle.addEventListener('click', () => {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        passwordToggle.textContent = isHidden ? 'Hide' : 'Show';
        passwordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        passwordToggle.setAttribute('aria-pressed', String(isHidden));
    });
</script>

@include('components.footer')

@endsection
