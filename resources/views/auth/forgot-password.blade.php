<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - PawPal</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-600 to-indigo-700 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl">

    <!-- HEADER -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-indigo-700">PawPal 🐾</h1>
        <p class="text-gray-500 text-sm mt-1">Recover your account</p>
    </div>

    <!-- TITLE -->
    <h2 class="text-xl font-semibold text-gray-800 text-center mb-3">
        Forgot Your Password?
    </h2>

    <!-- DESCRIPTION -->
    <p class="text-sm text-gray-600 text-center mb-6">
        Enter your email address and we’ll send you a link to reset your password.
    </p>

    <!-- SUCCESS -->
    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- ERRORS -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- EMAIL -->
        <input type="email" name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
            required>

        <!-- BUTTON -->
        <button class="w-full bg-indigo-600 text-white p-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
            📩 Send Reset Link
        </button>
    </form>

    <!-- BACK -->
    <div class="text-center mt-5">
        <a href="/login" class="text-sm text-indigo-600 hover:underline">
            ← Back to Login
        </a>
    </div>

</div>

</body>
</html>