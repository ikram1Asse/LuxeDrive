<!-- NAVBAR -->
<nav class="fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto mt-1 backdrop-blur-md rounded-full shadow-xl px-4 py-4 flex flex-row items-center justify-between gap-4 transition-colors duration-300" style="background-color: #ffffff5a;">
        <!-- Logo + Mobile menu trigger (always in the same row) -->
        <div class="flex items-center gap-3">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="LuxeDrive" class="rounded-full shadow-xl h-12 hover-scale"/>
            </a>

            <!-- Mobile menu trigger -->
            <button id="mobile-nav-toggle" type="button" class="lg:hidden inline-flex flex-col justify-center gap-1.5 p-2 rounded-full hover:bg-gray-100 transition" aria-expanded="false" aria-controls="mobile-nav">
                <span class="block h-0.5 w-6 bg-black"></span>
                <span class="block h-0.5 w-6 bg-black"></span>
                <span class="block h-0.5 w-6 bg-black"></span>
            </button>
        </div>

        <!-- Navigation Links -->
        <ul class="hidden lg:flex gap-8 font-bold text-black flex-1 justify-center">
            <li class="nav-link"><a href="/" class="hover:text-red-600">Home</a></li>
            <li class="nav-link"><a href="/models" class="hover:text-red-600">Models</a></li>
            <li class="nav-link"><a href="/#services" class="hover:text-red-600">Services</a></li>
            <li class="nav-link"><a href="/\#footer" class="hover:text-red-600">Contact</a></li>
        </ul>
        <!-- Profile & Auth -->
        <div class="flex gap-4 items-center lg:justify-end">
            @auth
                <div class="relative group">
                    <a href="/profile"  alt="{{ optional(Auth::user())->name ?? 'Profile' }}">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </a>
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl hidden group-hover:block z-50 py-2">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-red-50 hover:text-red-600 transition">
                            <span class="font-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <hr class="my-2">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                            View Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                            Edit Profile
                        </a>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                            <hr class="my-2">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                                Dashboard
                            </a>
                        @endif
                        <hr class="my-2">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login.show') }}" class="w-10 h-10 hover-scale cursor-pointer flex items-center justify-center transition">
                    <img src="{{ asset('images/profile.svg') }}" alt="Login"/>
                </a>
            @endauth
        </div>

        <!-- Mobile menu -->
        <ul id="mobile-nav" class="lg:hidden hidden absolute left-1/2 -translate-x-1/2 top-full w-[92%] flex-col gap-4 rounded-3xl bg-white/95 px-4 py-4 text-center shadow-xl mt-3">
            <li class="nav-link"><a href="/" class="block py-2 text-black font-semibold">Home</a></li>
            <li class="nav-link"><a href="/models" class="block py-2 text-black font-semibold">Models</a></li>
            <li class="nav-link"><a href="/#services" class="block py-2 text-black font-semibold">Services</a></li>
            <li class="nav-link"><a href="/\#footer" class="block py-2 text-black font-semibold">Contact</a></li>
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('mobile-nav-toggle');
            const mobileNav = document.getElementById('mobile-nav');
            if (!toggle || !mobileNav) return;

            toggle.addEventListener('click', function () {
                const isOpen = mobileNav.classList.toggle('hidden') === false;
                this.setAttribute('aria-expanded', isOpen.toString());
            });

            document.addEventListener('click', function (event) {
                if (!mobileNav.contains(event.target) && !toggle.contains(event.target) && !mobileNav.classList.contains('hidden')) {
                    mobileNav.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        });

    </script>
</nav>

