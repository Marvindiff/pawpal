<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PawPal</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-600 to-indigo-700 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl">

    <!-- LOGO / TITLE -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-indigo-700">PawPal 🐾</h1>
        <p class="text-gray-500 text-sm mt-1">Secure your account</p>
    </div>

    <!-- RESET TITLE -->
    <h2 class="text-xl font-semibold text-gray-800 text-center mb-2">
        Reset Your Password
    </h2>

    <!-- EMAIL DISPLAY -->
    <p class="text-center text-sm text-gray-600 mb-6">
        Resetting password for:
        <span class="font-semibold text-indigo-600">
            {{ request()->email }}
        </span>
    </p>

    <!-- SUCCESS MESSAGE -->
    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- ERROR MESSAGE -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        <!-- TOKEN -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- EMAIL (HIDDEN) -->
        <input type="hidden" name="email" value="{{ request()->email }}">

        <!-- PASSWORD -->
        <div>
            <label class="text-sm text-gray-600">New Password</label>
            <input type="password" name="password"
                placeholder="Enter new password"
                class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                required>
        </div>

        <!-- CONFIRM -->
        <div>
            <label class="text-sm text-gray-600">Confirm Password</label>
            <input type="password" name="password_confirmation"
                placeholder="Confirm password"
                class="w-full mt-1 p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                required>
        </div>

        <!-- BUTTON -->
        <button class="w-full bg-indigo-600 text-white p-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
            🔑 Reset Password
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