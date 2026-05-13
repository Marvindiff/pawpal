@extends('layouts.app')

@section('content')

@php
    use App\Models\Review;
    use App\Models\Booking;

    $unreadCount = $unreadCount ?? 0;

    // ⭐ REVIEWS
    $reviews = Review::where('provider_id', auth()->id())->get();
    $ratingCount = $reviews->count();
    $averageRating = $ratingCount > 0 ? round($reviews->avg('rating'), 1) : 0;

    // 💰 EARNINGS
    $totalIncome = Booking::where('provider_id', auth()->id())
        ->where('status', 'completed')
        ->where('payment_status', 'paid')
        ->sum('price');

    // 🚨 PENALTY STATUS
    $penalty = auth()->user()->penalty ?? 0;

    if ($penalty == 1) {
        $title = 'Warning';
        $icon = '⚠️';
        $bg = 'bg-yellow-500/10 border-yellow-400/30';
        $text = 'text-yellow-300';
        $message = 'Your account received a warning.';
    }

    elseif ($penalty == 2) {
        $title = 'Final Warning';
        $icon = '🚨';
        $bg = 'bg-red-500/10 border-red-400/30';
        $text = 'text-red-300';
        $message = 'Your account is close to suspension.';
    }

    elseif ($penalty >= 3) {
        $title = 'Restricted';
        $icon = '⛔';
        $bg = 'bg-gray-500/10 border-gray-400/30';
        $text = 'text-gray-300';
        $message = 'Your account has been restricted.';
    }
@endphp

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-gray-950 via-slate-900 to-black text-white p-6 transition-all duration-500">

    <!-- 🚨 WARNING -->
    @if($penalty > 0)

    <div class="mb-6 border rounded-2xl px-5 py-4 backdrop-blur-xl shadow-lg {{ $bg }}">

        <div class="flex items-center gap-4">

            <div class="text-3xl">
                {{ $icon }}
            </div>

            <div>

                <h2 class="font-bold text-lg {{ $text }}">
                    {{ $title }}
                </h2>

                <p class="text-sm text-gray-300">
                    {{ $message }}
                </p>

            </div>

        </div>

    </div>

    @endif

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

        <div>

            <h1 class="text-4xl font-bold">
                Welcome, {{ auth()->user()->name }} 👋
            </h1>

            <p class="text-gray-400 mt-1">
                Here’s your dashboard overview
            </p>

        </div>

        <div class="flex items-center gap-3 mt-5 md:mt-0">

            <!-- 🌙 DARK MODE -->
            <button id="theme-toggle"
                class="bg-white/10 backdrop-blur-xl border border-white/10
                       px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                🌙

            </button>

            <!-- 💬 -->
            <a href="{{ route('chat.inbox') }}"
               class="relative bg-white/10 backdrop-blur-xl border border-white/10 p-3 rounded-2xl hover:scale-105 transition">

                💬

                @if($unreadCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">
                        {{ $unreadCount }}
                    </span>
                @endif

            </a>

            <!-- ✏️ -->
            <a href="{{ route('profile.edit') }}"
               class="bg-indigo-600 hover:bg-indigo-500 px-5 py-3 rounded-2xl font-semibold shadow-lg transition">
                ✏️ Edit
            </a>

            <!-- 🚪 -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="bg-red-500 hover:bg-red-600 px-5 py-3 rounded-2xl font-semibold shadow-lg transition">
                    Logout
                </button>
            </form>

        </div>

    </div>

    <!-- 📊 STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <!-- BOOKINGS -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Total Bookings
            </p>

            <h2 class="text-4xl font-bold text-indigo-400 mt-3">
                {{ $bookings->count() ?? 0 }}
            </h2>

        </div>

        <!-- MESSAGES -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Unread Messages
            </p>

            <h2 class="text-4xl font-bold text-purple-400 mt-3">
                {{ $unreadCount }}
            </h2>

        </div>

        <!-- RATING -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Rating
            </p>

            <div class="mt-3">

                <div class="text-yellow-400 text-2xl">
                    ⭐⭐⭐⭐⭐
                </div>

                <p class="text-sm text-gray-300 mt-1">
                    {{ $averageRating }}/5
                </p>

            </div>

        </div>

        <!-- EARNINGS -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Total Earnings
            </p>

            <h2 class="text-4xl font-bold text-green-400 mt-3">
                ₱{{ number_format($totalIncome, 2) }}
            </h2>

        </div>

    </div>

    <!-- 📦 MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- 👤 PROFILE -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <h2 class="text-xl font-bold mb-5">
                👤 Profile Info
            </h2>

            <div class="space-y-3 text-sm text-gray-300">

                <p>
                    <span class="text-gray-500">Name:</span>
                    {{ auth()->user()->name }}
                </p>

                <p>
                    <span class="text-gray-500">Email:</span>
                    {{ auth()->user()->email }}
                </p>

                <p>
                    <span class="text-gray-500">Role:</span>
                    {{ ucfirst(auth()->user()->role) }}
                </p>

                <p>
                    <span class="text-gray-500">Status:</span>

                    @if(auth()->user()->is_available)
                        <span class="text-green-400 font-semibold">
                            🟢 Online
                        </span>
                    @else
                        <span class="text-gray-400 font-semibold">
                            ⚪ Offline
                        </span>
                    @endif
                </p>

            </div>

        </div>

        <!-- ⚡ QUICK ACTIONS -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <h2 class="text-xl font-bold mb-5">
                ⚡ Quick Actions
            </h2>

            <div class="grid gap-4">

                <a href="{{ route('provider.reports') }}"
                   class="bg-red-500 hover:bg-red-600 py-3 rounded-2xl text-center font-semibold transition">
                    🚨 Reports
                </a>

                <a href="{{ route('provider.bookings') }}"
                   class="bg-yellow-500 hover:bg-yellow-600 py-3 rounded-2xl text-center font-semibold transition text-black">
                    📅 Bookings
                </a>

                <a href="{{ route('provider.services') }}"
                   class="bg-green-500 hover:bg-green-600 py-3 rounded-2xl text-center font-semibold transition">
                    🛠 Services
                </a>

                <a href="{{ route('chat.inbox') }}"
                   class="bg-purple-500 hover:bg-purple-600 py-3 rounded-2xl text-center font-semibold transition">
                    💬 Messages
                </a>

               <form method="POST"
      action="{{ route('provider.toggleAvailability') }}">

    @csrf

    <!-- 🔥 SEND VALUE -->
    <input type="hidden"
           name="is_available"
           value="{{ auth()->user()->is_available ? 0 : 1 }}">

    

                    <button
                        class="w-full py-3 rounded-2xl font-semibold transition

                        {{ auth()->user()->is_available
                            ? 'bg-red-500 hover:bg-red-600'
                            : 'bg-green-600 hover:bg-green-700' }}">

                        {{ auth()->user()->is_available
                            ? '🔴 Go Offline'
                            : '🟢 Go Online' }}

                    </button>

                </form>

            </div>

        </div>

        <!-- 📈 ACCOUNT INFO -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <h2 class="text-xl font-bold mb-5">
                📈 Account Info
            </h2>

            <div class="space-y-3 text-sm text-gray-300">

                <p>
                    <span class="text-gray-500">Email:</span>
                    {{ auth()->user()->email }}
                </p>

                <p>
                    <span class="text-gray-500">Bookings:</span>
                    {{ $bookings->count() ?? 0 }}
                </p>

                <p>
                    <span class="text-gray-500">Rating:</span>
                    {{ $averageRating }}/5
                </p>

                <p>
                    <span class="text-gray-500">Status:</span>

                    @if(auth()->user()->is_available)
                        <span class="text-green-400">
                            Available
                        </span>
                    @else
                        <span class="text-gray-400">
                            Offline
                        </span>
                    @endif

                </p>

            </div>

        </div>

    </div>

</div>

<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// ☀️ LOAD SAVED THEME
if (localStorage.getItem('theme') === 'light') {

    dashboard.classList.remove(
        'from-gray-950',
        'via-slate-900',
        'to-black',
        'text-white'
    );

    dashboard.classList.add(
        'from-indigo-50',
        'via-purple-50',
        'to-pink-50',
        'text-gray-900'
    );

    toggleBtn.innerHTML = '☀️';
}

// 🔄 TOGGLE THEME
toggleBtn.addEventListener('click', () => {

    if (dashboard.classList.contains('from-gray-950')) {

        // ☀️ LIGHT
        dashboard.classList.remove(
            'from-gray-950',
            'via-slate-900',
            'to-black',
            'text-white'
        );

        dashboard.classList.add(
            'from-indigo-50',
            'via-purple-50',
            'to-pink-50',
            'text-gray-900'
        );

        toggleBtn.innerHTML = '☀️';

        localStorage.setItem('theme', 'light');

    } else {

        // 🌙 DARK
        dashboard.classList.remove(
            'from-indigo-50',
            'via-purple-50',
            'to-pink-50',
            'text-gray-900'
        );

        dashboard.classList.add(
            'from-gray-950',
            'via-slate-900',
            'to-black',
            'text-white'
        );

        toggleBtn.innerHTML = '🌙';

        localStorage.setItem('theme', 'dark');

    }

});

</script>

@endsection