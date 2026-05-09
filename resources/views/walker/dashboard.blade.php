@extends('layouts.app')

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-gray-950 via-slate-900 to-black text-white p-6 transition-all duration-500">

    <!-- 🚨 WARNING STATUS -->
    @php
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

    @if($penalty > 0)

    <div class="mb-6 border rounded-3xl p-4 backdrop-blur-xl shadow-lg {{ $bg }}">

        <div class="flex items-center gap-4">

            <div class="text-3xl">
                {{ $icon }}
            </div>

            <div>

                <p class="font-bold text-lg {{ $text }}">
                    {{ $title }}
                </p>

                <p class="text-sm text-gray-300">
                    {{ $message }}
                </p>

            </div>

        </div>

    </div>

    @endif

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold">
                Walker Dashboard 🐕
            </h1>

            <p class="text-gray-400 mt-1">
                Welcome back, {{ auth()->user()->name }} 👋
            </p>

        </div>

        <div class="flex items-center gap-3 mt-5 md:mt-0">

            <!-- 🌙 DARK MODE -->
            <button id="theme-toggle"
                class="bg-white/10 backdrop-blur-xl border border-white/10
                       px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                🌙

            </button>

            <!-- ✏️ EDIT -->
            <a href="{{ route('profile.edit') }}"
               class="bg-indigo-600 hover:bg-indigo-500 px-5 py-3 rounded-2xl font-semibold shadow-lg transition">
                ✏️ Edit
            </a>

            <!-- 🚪 LOGOUT -->
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

        <!-- TOTAL -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Total Walks
            </p>

            <h2 class="text-4xl font-bold text-indigo-400 mt-3">
                {{ $walks->count() ?? 0 }}
            </h2>

        </div>

        <!-- PENDING -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Pending
            </p>

            <h2 class="text-4xl font-bold text-yellow-400 mt-3">
                {{ $walks->where('status','pending')->count() ?? 0 }}
            </h2>

        </div>

        <!-- COMPLETED -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Completed
            </p>

            <h2 class="text-4xl font-bold text-green-400 mt-3">
                {{ $walks->where('status','completed')->count() ?? 0 }}
            </h2>

        </div>

        <!-- RATING -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl text-center">

            <p class="text-gray-400 text-sm">
                Rating
            </p>

            <h2 class="text-4xl font-bold text-yellow-400 mt-3">
                {{ $averageRating ?? '0.0' }} ⭐
            </h2>

            <p class="text-xs text-gray-500 mt-2">
                {{ $reviews->count() }} reviews
            </p>

        </div>

    </div>

    <!-- ⚡ QUICK ACTIONS -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 mb-8 shadow-xl">

        <h2 class="text-xl font-bold mb-6">
            Quick Actions ⚡
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <!-- REPORTS -->
            <a href="{{ route('provider.reports') }}"
               class="bg-red-500 hover:bg-red-600 py-3 rounded-2xl text-center font-semibold transition shadow-lg">
                🚨 Reports
            </a>

            <!-- REQUESTS -->
            <a href="{{ route('walker.walks') }}"
               class="bg-yellow-400 hover:bg-yellow-500 py-3 rounded-2xl text-center font-semibold transition shadow-lg text-black">
                🐕 Requests
            </a>

            <!-- SCHEDULE -->
            <a href="{{ route('walker.schedule') }}"
               class="bg-blue-500 hover:bg-blue-600 py-3 rounded-2xl text-center font-semibold transition shadow-lg">
                📅 Schedule
            </a>

            <!-- MESSAGES -->
            <a href="{{ route('chat.inbox') }}"
               class="bg-purple-500 hover:bg-purple-600 py-3 rounded-2xl text-center font-semibold transition shadow-lg">
                💬 Messages
            </a>

            <!-- ONLINE -->
            <form method="POST" action="{{ route('walker.toggleAvailability') }}">
                @csrf

                <button type="submit"
                    class="w-full py-3 rounded-2xl font-semibold shadow-lg transition

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

    <!-- 💰 EARNINGS -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 mb-8 shadow-xl flex justify-between items-center">

        <div>

            <h2 class="text-xl font-bold">
                Earnings 💰
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Total earnings from completed walks
            </p>

        </div>

        <p class="text-4xl font-bold text-green-400">
            ₱{{ number_format($earnings ?? 0, 2) }}
        </p>

    </div>

    <!-- 📝 REVIEWS -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

        <h2 class="text-xl font-bold mb-6">
            Recent Reviews 📝
        </h2>

        @forelse($reviews->take(5) as $review)

            <div class="border-b border-white/10 py-4 last:border-none">

                <div class="flex justify-between items-center">

                    <p class="font-semibold text-yellow-400">
                        ⭐ {{ $review->rating }}/5
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ $review->created_at->diffForHumans() }}
                    </p>

                </div>

                <p class="text-sm text-gray-300 mt-2">
                    {{ $review->comment ?? 'No comment provided.' }}
                </p>

            </div>

        @empty

            <p class="text-gray-500">
                No reviews yet.
            </p>

        @endforelse

    </div>

</div>

<!-- 🌙 DARK / LIGHT MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// ☀️ LOAD SAVED THEME
if (localStorage.getItem('walker-theme') === 'light') {

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

// 🔄 TOGGLE
toggleBtn.addEventListener('click', () => {

    if (dashboard.classList.contains('from-gray-950')) {

        // ☀️ LIGHT MODE
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

        localStorage.setItem('walker-theme', 'light');

    } else {

        // 🌙 DARK MODE
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

        localStorage.setItem('walker-theme', 'dark');

    }

});

</script>

@endsection