@extends('layouts.app')

@php
use App\Models\Review;
use Illuminate\Support\Str;
@endphp

@section('content')

@php

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
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold">
                Welcome, {{ Auth::user()->name }} 👋
            </h1>

            <p class="text-gray-400 mt-1">
                Dashboard overview
            </p>

        </div>

        <div class="flex items-center gap-3 mt-4 md:mt-0">

            <!-- 🌙 TOGGLE -->
            <button id="theme-toggle"
                class="bg-white/10 backdrop-blur-xl border border-white/10
                       px-4 py-3 rounded-2xl hover:bg-white/20 transition">

                🌙

            </button>

            <!-- ✏️ -->
            <a href="{{ route('profile.edit') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg transition">
                ✏️ Edit
            </a>

            <!-- 🚪 -->
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-2xl font-semibold shadow-lg transition">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>

        </div>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

    <div class="mb-6 bg-green-500/10 border border-green-400/30 text-green-300 px-5 py-4 rounded-2xl shadow-lg">

        {{ session('success') }}

    </div>

    @endif

    <!-- 📊 TOP CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- 💳 WALLET -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <p class="text-gray-400 text-sm">
                Wallet Balance
            </p>

            <h2 class="text-4xl font-bold text-green-400 mt-3">
                ₱{{ number_format(Auth::user()->wallet_balance, 2) }}
            </h2>

            <a href="{{ route('wallet.page') }}"
               class="mt-5 block text-center bg-indigo-600 hover:bg-indigo-500 py-3 rounded-2xl font-semibold transition">
                + Add Funds
            </a>

        </div>

        <!-- 👤 PROFILE -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <h2 class="text-xl font-bold mb-5">
                👤 Profile
            </h2>

            <div class="space-y-3 text-sm text-gray-300">

                <p>
                    <span class="text-gray-500">Name:</span>
                    {{ Auth::user()->name }}
                </p>

                <p>
                    <span class="text-gray-500">Email:</span>
                    {{ Auth::user()->email }}
                </p>

                <p>
                    <span class="text-gray-500">Role:</span>
                    {{ ucfirst(Auth::user()->role) }}
                </p>

            </div>

        </div>

        <!-- ⚡ QUICK ACTIONS -->
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-xl">

            <h2 class="text-xl font-bold mb-5">
                ⚡ Quick Actions
            </h2>

            <div class="grid gap-4">

                <a href="{{ route('find.providers', ['type' => 'sitter']) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-black py-3 rounded-2xl text-center font-semibold transition">
                    🐾 Find Sitters
                </a>

                <a href="{{ route('find.providers', ['type' => 'walker']) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-2xl text-center font-semibold transition">
                    🐕 Find Walkers
                </a>

                <a href="{{ route('bookings.index') }}"
                   class="bg-green-500 hover:bg-green-600 text-white py-3 rounded-2xl text-center font-semibold transition">
                    📅 My Bookings
                </a>

                <a href="{{ route('chat.inbox') }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white py-3 rounded-2xl text-center font-semibold transition">
                    💬 Messages
                </a>

            </div>

        </div>

    </div>

    <!-- 🐾 PROVIDERS -->
    @if(Auth::user()->role === 'user')

    <div class="mt-10">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-3xl font-bold">
                Available Providers 🐾
            </h2>

            <p class="text-sm text-gray-400">
                Find trusted sitters & walkers
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @forelse($providers ?? [] as $provider)

            @php
                $reviews = Review::where('provider_id', $provider->id)->get();
                $count = $reviews->count();
                $avg = $count > 0 ? round($reviews->avg('rating'), 1) : 0;
            @endphp

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-5 shadow-xl hover:scale-[1.02] transition">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="text-xl font-bold">
                            {{ $provider->name }}
                        </h3>

                        <p class="text-sm text-gray-400">
                            {{ ucfirst($provider->service_type) }}
                        </p>

                    </div>

                    @if($provider->is_available)

                        <span class="bg-green-500/20 text-green-300 text-xs px-3 py-1 rounded-full">
                            🟢 Online
                        </span>

                    @else

                        <span class="bg-gray-500/20 text-gray-300 text-xs px-3 py-1 rounded-full">
                            ⚪ Offline
                        </span>

                    @endif

                </div>

                <!-- ⭐ REVIEWS -->
                <div class="mt-4">

                    <div class="text-yellow-400 text-lg">

                        @for($i = 1; $i <= 5; $i++)

                            {{ $i <= floor($avg) ? '⭐' : '☆' }}

                        @endfor

                    </div>

                    <p class="text-sm text-gray-400 mt-1">

                        @if($count > 0)

                            {{ $avg }}/5
                            ({{ $count }} {{ Str::plural('review', $count) }})

                        @else

                            No reviews yet

                        @endif

                    </p>

                </div>

                <!-- BUTTON -->
                <a href="{{ route('chat.index', $provider->id) }}"
                   class="mt-5 block bg-indigo-600 hover:bg-indigo-500 py-3 rounded-2xl text-center font-semibold transition">
                    Message 💬
                </a>

            </div>

            @empty

                <p class="text-gray-500">
                    No providers available.
                </p>

            @endforelse

        </div>

    </div>

    @endif

</div>

<!-- 🌙 DARK/LIGHT MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// ☀️ LOAD SAVED
if (localStorage.getItem('user-theme') === 'light') {

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

        localStorage.setItem('user-theme', 'light');

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

        localStorage.setItem('user-theme', 'dark');

    }

});

</script>

@endsection