@extends('layouts.app')

@section('title', 'My Profile - LuxeDrive')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap');

    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    h1, h2, h3 ,label{font-family: 'Italiana', serif; font-weight: 700; letter-spacing: 6px; }
    body, p { font-family:'Crimson Text', serif; letter-spacing: 4px; font-weight: 500; font-size:18px}

    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }
    
</style>

<div class="min-h-screen bg-black pt-24 pb-12">
    @include('components.navbar')
    <div class="bg-gray-100 rounded-3xl p-12 shadow-lg ">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-black" style="font-family: 'Playfair Display'">My Profile</h1>
            <h3 class="mt-2" style="color: #701A1A;">Manage your account information</h3>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        <!-- Profile Card -->
            <!-- Profile Header -->
            <div class="px-8 py-12">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-12 h-12 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div >
                        <h2 class="text-3xl font-bold text-black" style="font-family: 'Playfair Display'">{{ $user->name }}</h2>
                        <p class="mt-1 text-red capitalize">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="px-8 py-8 text-black">
                <div class="space-y-6">
                    <!-- Email -->
                    <div class="border-b pb-4">
                        <label class="text-sm font-semibold uppercase tracking-wide">Email Address</label>
                        <p class="text-lg mt-2">{{ $user->email }}</p>
                    </div>

                    <!-- Telephone -->
                    <div class="border-b pb-4">
                        <label class="text-sm font-semibold  uppercase tracking-wide">Phone Number</label>
                        <p class="text-lg  mt-2">{{ $user->telephone ?? 'Not provided' }}</p>
                    </div>

                    <!-- Role Badge -->
                    <div class="border-b pb-4">
                        <label class="text-sm font-semibold  uppercase tracking-wide">Account Type</label>
                        <div class="mt-2">
                            @if($user->role === 'admin')
                                <span class="inline-block px-4 py-2 bg-red-300 text-red-700 rounded-full font-semibold text-sm">Administrator</span>
                            @elseif($user->role === 'employee')
                                <span class="inline-block px-4 py-2 bg-blue-300 text-blue-700 rounded-full font-semibold text-sm">Employee</span>
                            @else
                                <span class="inline-block px-4 py-2 bg-gray-900 text-gray-700 rounded-full font-semibold text-sm">User</span>
                            @endif
                        </div>
                    </div>

                    <!-- Member Since -->
                    <div>
                        <label class="text-sm font-semibold  uppercase tracking-wide">Member Since</label>
                        <p class="text-lg  mt-2">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex gap-4 pt-6 border-t sm:flex-row flex-wrap text-white">
                    <a href="{{ route('profile.edit') }}" class=" btn btn-primary flex-1 text-white font-bold py-3 px-6 rounded-lg transition duration-300 text-center">
                        Edit Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button type="submit" class="btn btn-primary text-black font-bold py-3 px-6 rounded-lg transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Info -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-2xl p-6">
            <div class="flex gap-4">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm1 15h-2v-2h2v2zm0-4h-2V7h2v5z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900">Account Security</h3>
                    <p class="text-blue-800 text-sm mt-1">To keep your account secure, periodically update your password in the Edit Profile section.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
