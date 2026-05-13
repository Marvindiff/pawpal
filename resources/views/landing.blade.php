<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawPal • Pet Care </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

        .glass{
            backdrop-filter: blur(18px);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .floating{
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating{

            0%{
                transform: translateY(0px);
            }

            50%{
                transform: translateY(-15px);
            }

            100%{
                transform: translateY(0px);
            }

        }

        .glow{
            box-shadow:
                0 0 40px rgba(99,102,241,.4),
                0 0 80px rgba(168,85,247,.2);
        }

    </style>

</head>

<body class="bg-black text-white overflow-x-hidden">

<!-- 🌌 BACKGROUND -->
<div class="fixed inset-0 -z-10">

    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-500/20 rounded-full blur-3xl"></div>

</div>

<!-- 🔝 NAVBAR -->
<header class="fixed top-0 left-0 w-full z-50">

    <div class="max-w-7xl mx-auto px-6 py-5">

        <div class="glass rounded-3xl px-6 py-4 flex justify-between items-center shadow-2xl">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-2xl glow">
                    🐾
                </div>

                <div>

                    <h1 class="text-2xl font-bold">
                        PawPal
                    </h1>

                    <p class="text-xs text-gray-300">
                        Pet Care 
                    </p>

                </div>

            </div>

            <!-- NAV -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">

                <a href="#services"
                   class="hover:text-indigo-300 transition">
                    Services
                </a>

                <a href="#features"
                   class="hover:text-indigo-300 transition">
                    Features
                </a>

                <a href="#how"
                   class="hover:text-indigo-300 transition">
                    How it Works
                </a>

                <a href="#contact"
                   class="hover:text-indigo-300 transition">
                    Contact
                </a>

            </nav>

            <!-- BUTTONS -->
            <div class="flex items-center gap-3">

                @guest

                <a href="{{ route('login') }}"
                   class="border border-white/20 hover:bg-white/10 px-5 py-2.5 rounded-2xl transition font-medium">

                    Login

                </a>

                <a href="{{ route('register') }}"
                   class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:scale-105 transition px-5 py-2.5 rounded-2xl font-semibold shadow-xl">

                    Get Started

                </a>

                @else

                <a href="/dashboard-redirect"
   class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:scale-105 transition px-5 py-2.5 rounded-2xl font-semibold shadow-xl">

    Dashboard

</a>

                @endguest

            </div>

        </div>

    </div>

</header>

<!-- 🚀 HERO -->
<section class="min-h-screen flex items-center pt-32 px-6">

    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT -->
        <div>

            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/10 px-5 py-2 rounded-full text-sm mb-8">

                ✨ Trusted by pet owners everywhere

            </div>

            <h1 class="text-6xl lg:text-7xl font-extrabold leading-tight">

                Premium
                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    Pet Care
                </span>

                For Your
                <span class="bg-gradient-to-r from-pink-400 to-yellow-300 bg-clip-text text-transparent">
                    Best Friend
                </span>

            </h1>

            <p class="text-gray-300 text-xl mt-8 leading-relaxed max-w-xl">

                Connect with trusted pet sitters and walkers,
                book services instantly, chat in real-time,
                and keep your pets safe with PawPal.

            </p>

            <!-- BUTTONS -->
            <div class="flex flex-wrap gap-4 mt-10">

                <a href="{{ route('register') }}"
                   class="bg-gradient-to-r from-indigo-500 to-purple-500 px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105 transition shadow-2xl">

                    Get Started 🚀

                </a>

                <a href="#services"
                   class="border border-white/20 hover:bg-white/10 px-8 py-4 rounded-2xl font-semibold transition">

                    Explore Services

                </a>

            </div>

            <!-- STATS -->
            <div class="flex flex-wrap gap-10 mt-14">

                <div>

                    <h2 class="text-4xl font-bold text-indigo-400">
                        500+
                    </h2>

                    <p class="text-gray-400 mt-1">
                        Happy Pets
                    </p>

                </div>

                <div>

                    <h2 class="text-4xl font-bold text-purple-400">
                        100+
                    </h2>

                    <p class="text-gray-400 mt-1">
                        Trusted Providers
                    </p>

                </div>

                <div>

                    <h2 class="text-4xl font-bold text-pink-400">
                        24/7
                    </h2>

                    <p class="text-gray-400 mt-1">
                        Support
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative flex justify-center">

            <!-- MAIN CARD -->
            <div class="glass rounded-[2rem] p-8 w-full max-w-md floating shadow-2xl">

                <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1200&auto=format&fit=crop"
                     class="rounded-3xl h-80 w-full object-cover shadow-xl">

                <div class="mt-6">

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="text-2xl font-bold">
                                Dog Walking
                            </h3>

                            <p class="text-gray-300 text-sm mt-1">
                                Safe daily walks for your dogs
                            </p>

                        </div>

                        <div class="bg-green-500/20 text-green-300 px-4 py-2 rounded-full text-sm font-semibold">
                            🟢 Available
                        </div>

                    </div>

                    <div class="flex justify-between items-center mt-6">

                        <div>

                            <p class="text-gray-400 text-sm">
                                Starting at
                            </p>

                            <h2 class="text-3xl font-bold text-indigo-400">
                                ₱199
                            </h2>

                        </div>

                       <!-- BOOK NOW BUTTON -->
@guest

<a href="{{ route('register') }}"
   class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition shadow-xl">

    Book Now 🚀

</a>

@else

<a href="{{ route('providers.index') }}"
   class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition shadow-xl">

    Book Now 🚀

</a>

@endguest
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- 🛠 SERVICES -->
<section id="services" class="py-28 px-6">

    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-16">

            <h2 class="text-5xl font-bold">
                Our Services 🐾
            </h2>

            <p class="text-gray-400 text-lg mt-4">
                Everything your pets need in one place
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <!-- CARD -->
            <div class="glass rounded-[2rem] p-8 hover:-translate-y-2 transition shadow-2xl">

                <div class="text-5xl mb-6">
                    🐶
                </div>

                <h3 class="text-2xl font-bold mb-3">
                    Dog Walking
                </h3>

                <p class="text-gray-300 leading-relaxed">
                    Professional walkers for safe and healthy outdoor adventures.
                </p>

            </div>

            <!-- CARD -->
            <div class="glass rounded-[2rem] p-8 hover:-translate-y-2 transition shadow-2xl">

                <div class="text-5xl mb-6">
                    🐾
                </div>

                <h3 class="text-2xl font-bold mb-3">
                    Pet Sitting
                </h3>

                <p class="text-gray-300 leading-relaxed">
                    Trusted sitters to care for your pets while you're away.
                </p>

            </div>

            <!-- CARD -->
            <div class="glass rounded-[2rem] p-8 hover:-translate-y-2 transition shadow-2xl">

                <div class="text-5xl mb-6">
                    🏡
                </div>

                <h3 class="text-2xl font-bold mb-3">
                    Boarding
                </h3>

                <p class="text-gray-300 leading-relaxed">
                    Comfortable overnight stays in a safe and loving environment.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- ⭐ FEATURES -->
<section id="features" class="py-28 px-6">

    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-16">

            <h2 class="text-5xl font-bold">
                Why Choose PawPal?
            </h2>

            <p class="text-gray-400 text-lg mt-4">
                Built for pet owners and providers
            </p>

        </div>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="glass rounded-3xl p-6">

                <div class="text-4xl mb-4">
                    💬
                </div>

                <h3 class="font-bold text-xl">
                    Live Chat
                </h3>

                <p class="text-gray-300 text-sm mt-2">
                    Real-time messaging between owners and sitters.
                </p>

            </div>

            <div class="glass rounded-3xl p-6">

                <div class="text-4xl mb-4">
                    💳
                </div>

                <h3 class="font-bold text-xl">
                    Secure Payments
                </h3>

                <p class="text-gray-300 text-sm mt-2">
                    Wallet & GCash integration with verification.
                </p>

            </div>

            <div class="glass rounded-3xl p-6">

                <div class="text-4xl mb-4">
                    ⭐
                </div>

                <h3 class="font-bold text-xl">
                    Reviews
                </h3>

                <p class="text-gray-300 text-sm mt-2">
                    Verified reviews from real pet owners.
                </p>

            </div>

            <div class="glass rounded-3xl p-6">

                <div class="text-4xl mb-4">
                    🛡️
                </div>

                <h3 class="font-bold text-xl">
                    Trusted Providers
                </h3>

                <p class="text-gray-300 text-sm mt-2">
                    Verified pet care professionals near you.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- 🐾 HOW -->
<section id="how" class="py-28 px-6">

    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-20">

            <h2 class="text-5xl font-bold">
                How It Works 🚀
            </h2>

        </div>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="glass rounded-[2rem] p-10 text-center">

                <div class="text-6xl mb-6">
                    1️⃣
                </div>

                <h3 class="text-2xl font-bold">
                    Create Account
                </h3>

                <p class="text-gray-300 mt-4">
                    Sign up as a pet owner or provider.
                </p>

            </div>

            <div class="glass rounded-[2rem] p-10 text-center">

                <div class="text-6xl mb-6">
                    2️⃣
                </div>

                <h3 class="text-2xl font-bold">
                    Book Service
                </h3>

                <p class="text-gray-300 mt-4">
                    Choose trusted sitters and walkers instantly.
                </p>

            </div>

            <div class="glass rounded-[2rem] p-10 text-center">

                <div class="text-6xl mb-6">
                    3️⃣
                </div>

                <h3 class="text-2xl font-bold">
                    Relax
                </h3>

                <p class="text-gray-300 mt-4">
                    Enjoy safe, premium pet care anytime.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- 📩 CONTACT -->
<section id="contact" class="py-28 px-6">

    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT -->
        <div>

            <h2 class="text-5xl font-bold leading-tight">
                Let’s Talk 👋
            </h2>

            <p class="text-gray-300 text-lg mt-6 leading-relaxed">

                Need help or have questions?
                Contact PawPal anytime and we’ll assist you.

            </p>

            <div class="mt-10 space-y-4">

                <p class="text-lg">
                    📧 pawpalsupport@gmail.com
                </p>

                <p class="text-lg">
                    📞 +63 912 345 6789
                </p>

            </div>

        </div>

        <!-- FORM -->
        <form method="POST"
              action="{{ route('contact.send') }}"
              class="glass rounded-[2rem] p-8 shadow-2xl space-y-5">

            @csrf

            <input type="text"
                   name="name"
                   placeholder="Your Name"

                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Your Email"

                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400"
                   required>

            <textarea name="message"
                      rows="5"
                      placeholder="Your Message"

                      class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400"
                      required></textarea>

            <button type="submit"

                class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] transition shadow-2xl">

                Send Message 🚀

            </button>

            @if(session('success'))

                <p class="text-green-400 text-sm text-center">
                    {{ session('success') }}
                </p>

            @endif

        </form>

    </div>

</section>

<!-- FOOTER -->
<footer class="py-10 border-t border-white/10 text-center text-gray-500 text-sm">

    © {{ date('Y') }} PawPal.
    Built with 🐾 for pet lovers.

</footer>

</body>
</html>
