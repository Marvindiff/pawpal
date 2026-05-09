<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPal Dashboard</title>

    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200 min-h-screen">

    <!-- 🧭 NAVBAR -->
    <div class="w-full bg-white shadow px-6 py-3 flex justify-between items-center">

        <!-- LOGO -->
        <h1 class="font-bold text-indigo-600 text-lg">
            PawPal 🐾
        </h1>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            @auth

             

                <!-- 👤 USER NAME -->
                <div class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </div>

                <!-- 🚪 LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                   <button 
    class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow 
           hover:bg-red-600 transition duration-200">
    Logout
</button>
                </form>

            @else

                <!-- 🔐 GUEST LINKS -->
                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-500">
                    Login
                </a>

                <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-indigo-500">
                    Register
                </a>

            @endauth

        </div>

    </div>

    <!-- 📦 MAIN CONTENT -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>