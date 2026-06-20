@extends('layouts.app')

@section('title', 'Edit Profile - LuxeDrive')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    body, p, h1, h2, h3, h4, h5, h6 { font-family: 'Italiana', serif;}
    h1, h2, h3, h4, h5, h6 { font-weight: 700; letter-spacing: 6px; }
    body, p { font-weight: bold; letter-spacing: 4px; font-weight: 500;}

</style>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pt-24 pb-12">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900" style="font-family: 'Playfair Display'">Edit Profile</h1>
            <p class="text-gray-600 mt-2">Update your account information</p>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="px-8 py-8">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            required
                        />
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            required
                        />
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telephone Field -->
                    <div>
                        <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input 
                            type="tel" 
                            id="telephone" 
                            name="telephone" 
                            value="{{ old('telephone', $user->telephone) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            placeholder="+1 (555) 123-4567"
                        />
                        @error('telephone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Section -->
                    <div class="border-t pt-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password (Optional)</h3>
                        <p class="text-gray-600 text-sm mb-4">Leave blank if you don't want to change your password</p>

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            />
                            @error('current_password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            />
                            @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-600 text-xs mt-1">Minimum 8 characters</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                            />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-6 border-t">
                        <button 
                            type="submit" 
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300"
                        >
                            Save Changes
                        </button>
                        <a 
                            href="{{ route('profile.show') }}" 
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-3 px-6 rounded-lg transition duration-300 text-center"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-amber-50 border border-amber-200 rounded-2xl p-6">
            <div class="flex gap-4">
                <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm1 15h-2v-2h2v2zm0-4h-2V7h2v5z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-amber-900">Important Notes</h3>
                    <ul class="text-amber-800 text-sm mt-2 space-y-1">
                        <li>• Your email will be used for account recovery</li>
                        <li>• Verify your phone number for added security</li>
                        <li>• All changes are saved immediately</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
