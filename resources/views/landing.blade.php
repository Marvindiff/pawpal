<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPal - Pet Sitting Made Easy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-orange-50">

    <!-- Header / Navbar -->
    <header class="bg-orange-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-yellow-300">PawPal</h1>
            <nav class="space-x-4">
                <a href="#services" class="hover:text-yellow-200 font-semibold">Services</a>
                <a href="#how-it-works" class="hover:text-yellow-200 font-semibold">How It Works</a>

                <!-- Auth Buttons -->
                @guest
                    <a href="{{ route('login') }}" class="font-semibold hover:text-yellow-200">Login</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-orange-800 px-4 py-2 rounded font-semibold shadow-lg hover:bg-yellow-300 hover:text-orange-900 transition">
                        Sign Up
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-yellow-400 text-orange-800 px-4 py-2 rounded font-semibold shadow-lg hover:bg-yellow-300 hover:text-orange-900 transition">
                        Dashboard
                    </a>
                @endguest
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-orange-500 text-white py-24">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6 drop-shadow-lg">Trusted Pet Sitting for Your Furry Friends</h2>
            <p class="text-xl mb-8 drop-shadow-sm">Book reliable pet sitters or offer your sitting services with ease. PawPal keeps pets happy and owners worry-free.</p>

            @guest
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-orange-800 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-300 hover:text-orange-900 transition">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="bg-white text-orange-600 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition">
                        Login
                    </a>
                </div>
            @else
                <a href="{{ route('dashboard') }}" class="bg-yellow-400 text-orange-800 px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-300 hover:text-orange-900 transition">
                    Go to Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-orange-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-12 text-orange-800">Our Services</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-yellow-100 p-6 rounded shadow-lg hover:shadow-xl transition">
                    <h4 class="text-xl font-semibold mb-2 text-orange-900">Pet Sitting</h4>
                    <p>Professional sitters will care for your pets while you're away.</p>
                </div>
                <div class="bg-yellow-100 p-6 rounded shadow-lg hover:shadow-xl transition">
                    <h4 class="text-xl font-semibold mb-2 text-orange-900">Dog Walking</h4>
                    <p>Reliable walkers for daily exercise and fun.</p>
                </div>
                <div class="bg-yellow-100 p-6 rounded shadow-lg hover:shadow-xl transition">
                    <h4 class="text-xl font-semibold mb-2 text-orange-900">Boarding</h4>
                    <p>Safe, comfortable boarding for pets while owners are away.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="bg-orange-50 py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-12 text-orange-800">How It Works</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition">
                    <div class="text-yellow-400 text-4xl mb-4">1</div>
                    <h4 class="font-semibold mb-2 text-orange-700">Sign Up</h4>
                    <p>Create an account as a pet owner or sitter.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition">
                    <div class="text-yellow-400 text-4xl mb-4">2</div>
                    <h4 class="font-semibold mb-2 text-orange-700">Book or Offer Services</h4>
                    <p>Owners can book sitters; sitters can accept requests.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition">
                    <div class="text-yellow-400 text-4xl mb-4">3</div>
                    <h4 class="font-semibold mb-2 text-orange-700">Enjoy</h4>
                    <p>Pets are happy and owners have peace of mind!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-orange-600 text-white shadow-md py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            &copy; {{ date('Y') }} PawPal. All rights reserved.
        </div>
    </footer>

</body>
</html>