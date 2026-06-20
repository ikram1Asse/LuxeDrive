@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');
    
    :root {
        --primary-red: #701A1A;
    }
    
    body, p, h1, h2, h3, h4, h5, h6 { font-family: 'Italiana', serif;}
    h1, h2, h3, h4, h5, h6 { font-weight: 600; letter-spacing: 6px; }
    body, p { font-weight: bold; letter-spacing: 4px;}
    
    .btn-primary { background-color: #701A1A; color: white; transition: all 0.3s; border: none; cursor: pointer; font-weight: 600; }
    .btn-primary:hover { background-color: #8b1f1f; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(112, 26, 26, 0.4); }
    
    .fade-in { animation: fadeIn 0.8s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    
    .slide-in-left { animation: slideInLeft 1s ease-out 0.2s both; }
    @keyframes slideInLeft { from { opacity: 0; transform: translateX(-80px); } to { opacity: 1; transform: translateX(0); } }
    
    .slide-in-right { animation: slideInRight 1s ease-out 0.2s both; }
    @keyframes slideInRight { from { opacity: 0; transform: translateX(80px); } to { opacity: 1; transform: translateX(0); } }
    
    .hero-text { animation: fadeInUp 0.8s ease-out 0s both; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    
    .hero-heading { animation: fadeInDown 1s ease-out 0.1s both; }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
    
    .hero-cta { animation: scaleInUp 0.7s ease-out 0.5s both; }
    @keyframes scaleInUp { from { opacity: 0; transform: scale(0.9) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    
    .scale-in { animation: scaleIn 0.6s ease-out; }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.08); box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); }
    
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); }
    
    .gradient-text { background: linear-gradient(135deg, #701A1A, #8b1f1f); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    
    .nav-link { position: relative; cursor: pointer; transition: color 0.3s ease; }
    .nav-link:hover { color: #701A1A; }
    .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background-color: #701A1A; transition: width 0.3s ease; }
    .nav-link:hover::after { width: 100%; }
    
    .card-hover { transition: all 0.4s; position: relative; overflow: hidden; }
    .card-hover:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2); }

.collection-card {
        background: #f3f3f3;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 3rem;
        padding: 5.5rem 2.5rem 2.5rem;
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.12);
        overflow: visible;
        position: relative;
        min-height: 27rem;
        width: min(350px, 100%);
        flex-shrink:0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .collection-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.18);
    }
    .collection-card h3 {
        font-size: 2.25rem;
        font-weight: 600;
        letter-spacing: 1px;
        margin-top: 1.25rem;
    }
    .collection-card .card-body {
        margin-top: 1.5rem;
    }
    .collection-image-wrapper {
        position: absolute;
        left: 50%;
        top: -100px;
        transform: translateX(-50%);
        width: 100%;
        max-width: 25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .collection-image-wrapper img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    #q8-img-wrapper{
        top:-120px; 
        max-width: 35rem;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 135%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #q8-img-wrapper img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    @media (max-width: 640px) {
        .collection-card {
            padding: 4.5rem 1.5rem 1.5rem;
            min-height: 22rem;
        }
        .collection-image-wrapper {
            top: -80px;
            max-width: 18rem;
        }
        #q8-img-wrapper {
            top: -90px;
            width: 125%;
        }
    }

</style>



<!-- HERO SECTION -->
<section class="relative min-h-screen text-black overflow-hidden pt-24" style="background: url('{{ asset('images/hero-audi.jpeg') }}') no-repeat center/cover;">
    @include('components.navbar')
    <div class="absolute inset-0  pointer-events-none"></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen h-full items-center gap-12 px-8 lg:px-0 relative z-10">
        <div class="flex flex-col justify-center items-center lg:items-start px-0 lg:px-16 lg:text-left w-full max-w-4xl mx-auto lg:mx-0">
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black leading-tight mb-6 hero-heading text-black">
                Drive the<br>Experience<br> You Deserve
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-black mb-12 leading-relaxed hero-text max-w-3xl mx-auto lg:mx-0">
                Luxury performance vehicles <br> crafted for modern excellence.
            </p>
            <div class="inline-flex hero-cta justify-center lg:justify-start w-full gap-4 flex-wrap">
                <a href="#collection" class="btn-primary px-8 py-4 rounded-full inline-block">
                    Explore Collection
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="bg-black py-24 lg:py-32 text-white">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center px-8 lg:px-0">
        <div class="fade-in order-2 lg:order-1">
            <img src="{{ asset('images/about-audi.jpeg') }}" class="rounded-3xl shadow-2xl hover-lift"/>
        </div>
        <div class="fade-in order-1 lg:order-2">
            <h2 class="text-5xl lg:text-6xl mb-10 leading-tight">
                Driven by performance,<br>inspired by you.
            </h2>
            <p class="text-gray-300 leading-8 text-lg mb-8">
            LuxeDrive, we bring you the prestige of Audi a brand synonymous with innovation, performance, and timeless design.
            <br><br>
            Our mission is to deliver more than just vehicles; we provide experiences that embody sophistication, advanced technology, and driving pleasure.
            <br><br>
            Every model we showcase reflects Audi’s commitment to excellence, ensuring that your journey is defined by comfort, safety, and unmatched style.
            </p>
            <div class="flex gap-4">
                <div class="flex-1">
                    <h3 class="text-3xl font-bold mb-2" style="color: #8e2424">500+</h3>
                    <p class="text-gray-400">Vehicles Sold</p>
                </div>
                <div class="flex-1">
                    <h3 class="text-3xl font-bold mb-2" style="color: #8e2424">98%</h3>
                    <p class="text-gray-400">Customer Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- COLLECTION SECTION -->
<section id="collection" class="py-24 lg:py-32" style="background-color : #b9b9b9;">
    <div class="max-w-7xl mx-auto px-8 lg:px-0">
        <div class="text-center fade-in" style="margin-bottom: 7rem;">
            <h2 class="text-5xl lg:text-6xl text-black font-medium mb-4">Luxury & Power Collection</h2>
            <p class="text-black text-lg max-w-2xl mx-auto">Explore our exclusive selection of premium Audi vehicles</p>
        </div>

        <div class="flex flex-wrap justify-center gap-12 pt-20">
            <!-- Audi R8 -->
            <div class="collection-card fade-in" style="animation-delay: 0s;">
                <div class="collection-image-wrapper">
                    <img src="{{ asset('images/audi-r8.png') }}" class="drop-shadow-[0_20px_45px_rgba(0,0,0,0.25)]" />
                </div>
                <h3 class="text-2xl text-center text-black mb-6 font-semibold">Audi R8</h3>
                <div class="card-body space-y-3 text-black text-sm leading-relaxed">
                    <div class="flex justify-between gap-4"><span class="font-semibold">Engine</span><span class="text-right">2L V10 NA</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Horsepower</span><span class="text-right">602 hp</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Drivetrain</span><span class="text-right">Quattro AWD</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Transmission</span><span class="text-right">7-speed dual-clutch</span></div>
                </div>
            </div>

            <!-- Audi Q8 -->
            <div class="collection-card fade-in" style="animation-delay: 0.1s;">
                <div class="collection-image-wrapper" id="q8-img-wrapper">
                    <img src="{{ asset('images/audi-q8.png') }}" class="drop-shadow-[0_20px_45px_rgba(0,0,0,0.25)]" />
                </div>
                <h3 class="text-2xl text-center text-black mb-6 font-semibold">Audi Q8</h3>
                <div class="card-body space-y-3 text-black text-sm leading-relaxed">
                    <div class="flex justify-between gap-4"><span class="font-semibold">Engine</span><span class="text-right">3.0L Turbo V6</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Horsepower</span><span class="text-right">335 hp</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Drivetrain</span><span class="text-right">Quattro AWD</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Transmission</span><span class="text-right">8-speed automatic</span></div>
                </div>
            </div>

            <!-- Audi S7 -->
            <div class="collection-card fade-in" style="animation-delay: 0.2s;">
                <div class="collection-image-wrapper">
                    <img src="{{ asset('images/audi-s7.png') }}" class="drop-shadow-[0_20px_45px_rgba(0,0,0,0.25)]" />
                </div>
                <h3 class="text-2xl text-center text-black mb-6 font-semibold">Audi S7</h3>
                <div class="card-body space-y-3 text-black text-sm leading-relaxed">
                    <div class="flex justify-between gap-4"><span class="font-semibold">Engine</span><span class="text-right">2.9L Twin-Turbo V6</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Horsepower</span><span class="text-right">444 hp</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Drivetrain</span><span class="text-right">Quattro AWD</span></div>
                    <div class="flex justify-between gap-4"><span class="font-semibold">Transmission</span><span class="text-right">8-speed automatic</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US SECTION -->
<section id="services" class="bg-black py-24 lg:py-32 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center relative z-10 px-8 lg:px-0">
        <div class="fade-in">
            <h2 class="text-5xl lg:text-6xl mb-16 leading-tight">
                Why Choose Us
            </h2>
            <div class="space-y-10">
                <div class="fade-in">
                    <div class="flex gap-4 mb-4">
                        <h3 class="text-2xl font-bold">Financing Options</h3>
                    </div>
                    <p class="text-gray-300 ml-6 leading-relaxed">
                        Flexible plans designed around your lifestyle,
                        making Audi ownership more accessible than ever.
                    </p>
                </div>

                <div class="fade-in">
                    <div class="flex gap-4 mb-4">
                        <h3 class="text-2xl font-bold">Leasing Programs</h3>
                    </div>
                    <p class="text-gray-300 ml-6 leading-relaxed">
                        Drive the latest Audi models with ease through our tailored leasing solutions that fit your needs.
                    </p>
                </div>

                <div class="fade-in">
                    <div class="flex gap-4 mb-4">
                        <h3 class="text-2xl font-bold">Certified Pre-Owned</h3>
                    </div>
                    <p class="text-gray-300 ml-6 leading-relaxed">
                        Every vehicle undergoes rigorous inspections with warranty and confidence of premium quality.
                    </p>
                </div>

                <div class="fade-in">
                    <div class="flex gap-4 mb-4">
                        <h3 class="text-2xl font-bold">Maintenance Packages</h3>
                    </div>
                    <p class="text-gray-300 ml-6 leading-relaxed">
                        Keep your Audi performing at its best with service plans crafted for long‑term reliability and peace of mind.                    </p>
                </div>
            </div>
        </div>

        <div class="slide-in-right hidden lg:block">
            <img src="{{ asset('images/showroom.png') }}" class="rounded-3xl shadow-2xl hover-lift w-full h-full object-cover"/>
        </div>
    </div>
</section>

<!-- BOOK TEST DRIVE SECTION -->
<section class="bg-black py-24 lg:py-32 text-white">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center px-8 lg:px-0">
        <div class="slide-in-left hidden lg:block">
            <img src="{{ asset('images/test-drive.jpeg') }}" class="rounded-3xl shadow-2xl hover-lift w-full h-full object-cover"/>
        </div>
        <div class="slide-in-right">
            <h2 class="text-5xl lg:text-6xl mb-12 leading-tight">
                Book a<br><span class="gradient-text">Test Drive</span>
            </h2>
            <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                Experience the thrill of driving one of our luxury Audi vehicles. Schedule your personalized test drive today and feel the difference.
            </p>
            <a href="/models" class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors">
                Book a Test Drive
            </a>
        </div>
    </div>
</section>

@include('components.footer')

@endsection