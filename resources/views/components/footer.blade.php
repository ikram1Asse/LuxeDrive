
<!-- FOOTER -->
<footer id="footer" class="bg-black border-t border-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <!-- Logo -->
            <div class="text-center lg:text-left">
                <a href="/" class="inline-flex items-center gap-4">
                    <img src="{{ asset('images/logo.png') }}" alt="LuxeDrive" class="h-16" />
                </a>
            </div>

            <!-- Quick Links -->
            <div class="text-center lg:text-left">
                <h4 class="font-semibold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="inline-block border-b border-white hover:border-red-600 hover:text-red-600 transition pb-0.5">Home</a></li>
                    <li><a href="/#about" class="inline-block border-b border-white hover:border-red-600 hover:text-red-600 transition pb-0.5">About Us</a></li>
                    <li><a href="/services" class="inline-block border-b border-white hover:border-red-600 hover:text-red-600 transition pb-0.5">Our Services</a></li>
                    <li><a href="/models" class="inline-block border-b border-white hover:border-red-600 hover:text-red-600 transition pb-0.5">Models</a></li>
                    <li><a href="/test-drive" class="inline-block border-b border-white hover:border-red-600 hover:text-red-600 transition pb-0.5">Book your test drive</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="text-center">
                <h4 class="font-semibold text-lg mb-6">Contact</h4>
                <div class="space-y-4 text-sm">
                    <div class="flex items-center justify-center gap-3">
                        <img src="{{ asset('images/phone.svg') }}" alt="Phone" class="h-6 w-6" />
                        <span>+212 621 345 678</span>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <img src="{{ asset('images/instagram.svg') }}" alt="Instagram" class="h-6 w-6" />
                        <span>@LuxeDrive</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
        <div class="border-t border-gray-800 pt-6">
        <p class="text-center text-gray-400 text-sm tracking-wide px-4">
            © 2026 LuxeDrive
        </p>
    </div>
</footer>

