@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');

    :root {
        --primary-red: #701A1A;
    }
    
    body, p { font-family: 'Crimson Text', serif; font-weight: 500;}
    label {font-size:20px;}
    h1 { font-family: 'Italiana', serif; font-weight: 600; letter-spacing: 6px; }
    
    input, textarea { background-color: #fffefe !important; border: 4px solid #4f4e4e !important; color: black; padding: 12px 15px; border-radius: 6px; width:100%;}
    input::placeholder, textarea::placeholder { color: #5b5a5a; }
    input:focus, textarea:focus { border-color: #701A1A !important; outline: none; box-shadow: 0 0 10px rgba(112, 26, 26, 0.3) !important; }

    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }

</style>

@include('components.navbar')

<!-- BOOK TEST DRIVE SECTION -->
<section class="bg-black min-h-screen pt-32 pb-20">
    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-12 items-center px-8 lg:px-0">
        <!-- Image -->
        <div class="hidden lg:block order-2">
            <img src="{{ asset('images/test-drive.jpeg') }}" alt="Test Drive" class="rounded-3xl shadow-2xl w-full h-auto object-cover"/>
        </div>

        <!-- Form -->
        <div class="order-1 lg:order-1">
            <h1 class="text-5xl lg:text-6xl text-white mb-12 leading-tight">
                Book a<br><span style="background: linear-gradient(135deg, #701A1A, #8b1f1f); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Test Drive</span>
            </h1>
            
            <form action="{{ route('testdrive.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-300">Full Name</label>
                    <input 
                        type="text" 
                        name="nom" 
                        placeholder="Your Full Name"
                        required
                        value="{{ old('nom') }}"
                    />
                    @error('nom') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-300">Phone Number</label>
                    <input 
                        type="tel" 
                        name="telephone" 
                        placeholder="Your Phone Number"
                        required
                        value="{{ old('telephone') }}"
                    />
                    @error('telephone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-3 text-gray-300">Preferred Date</label>
                    <input 
                        type="date" 
                        name="date" 
                        required
                        value="{{ old('date') }}"
                    />
                    @error('date') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary hover:bg-red-700 px-8 py-4 rounded-lg text-lg font-semibold mt-8 text-white transition-colors">
                    Book a test Drive
                </button>
                
            </form>
        </div>
    </div>
</section>

@include('components.footer')

@endsection
