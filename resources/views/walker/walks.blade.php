@extends('layouts.app')

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 transition-all duration-500">

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>

            <h1 class="text-4xl font-bold text-green-700">
                Assigned Walks 🐕
            </h1>

            <p class="text-gray-500 mt-1">
                Manage your bookings and schedules
            </p>

        </div>

        <div class="flex items-center gap-3">

            <!-- 🌙 TOGGLE -->
            <button id="theme-toggle"
                class="bg-white shadow px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                🌙

            </button>

            <!-- 🔙 BACK -->
            <button onclick="history.back()"
                class="bg-gray-800 text-white px-5 py-3 rounded-2xl hover:bg-gray-700 transition font-semibold shadow-lg">

                ← Back

            </button>

        </div>

    </div>

    <!-- 🚨 PENALTY -->
    @php
        $penalty = auth()->user()->penalty ?? 0;

        if ($penalty == 1) {

            $title = 'Warning';
            $icon = '⚠️';
            $bg = 'bg-yellow-100 border-yellow-300';
            $text = 'text-yellow-700';
            $message = 'Your account received a warning.';

        }

        elseif ($penalty == 2) {

            $title = 'Final Warning';
            $icon = '🚨';
            $bg = 'bg-red-100 border-red-300';
            $text = 'text-red-700';
            $message = 'Your account is close to suspension.';

        }

        elseif ($penalty >= 3) {

            $title = 'Restricted';
            $icon = '⛔';
            $bg = 'bg-gray-200 border-gray-400';
            $text = 'text-gray-700';
            $message = 'Your account has been restricted.';

        }
    @endphp

    @if($penalty > 0)

    <div class="mb-8 border rounded-3xl p-5 shadow-sm {{ $bg }}">

        <div class="flex items-center gap-4">

            <div class="text-3xl">
                {{ $icon }}
            </div>

            <div>

                <h2 class="font-bold text-lg {{ $text }}">
                    {{ $title }}
                </h2>

                <p class="text-sm text-gray-600">
                    {{ $message }}
                </p>

            </div>

        </div>

    </div>

    @endif

    <!-- 🔍 SORT BAR -->
    <div class="flex flex-wrap gap-3 mb-8 justify-center">

        <button onclick="sortWalks('newest')"
            class="bg-indigo-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-indigo-500 transition">

            🆕 Newest

        </button>

        <button onclick="sortWalks('oldest')"
            class="bg-gray-700 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-gray-600 transition">

            📜 Oldest

        </button>

        <button onclick="sortWalks('pending')"
            class="bg-yellow-400 text-black px-5 py-3 rounded-2xl font-semibold shadow hover:bg-yellow-300 transition">

            ⏳ Pending

        </button>

        <button onclick="sortWalks('completed')"
            class="bg-green-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-green-500 transition">

            ✅ Completed

        </button>

    </div>

    <!-- 📦 WALKS -->
    <div id="walkContainer"
         class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">

        @forelse($walks as $walk)

        <div onclick="window.location='{{ route('receipt.show', $walk->id) }}'"

             class="walk-card w-full bg-white rounded-3xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300 cursor-pointer"

             data-date="{{ $walk->created_at }}"
             data-status="{{ $walk->status }}">

            <!-- TOP -->
            <div class="flex justify-between items-start mb-5">

                <!-- USER -->
                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $walk->user->name }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        📅 {{ $walk->schedule }}
                    </p>
<p class="text-indigo-600 font-semibold mt-2">
    📱 {{ $walk->user->mobile_number ?? 'No mobile number' }}
</p>
                    <p class="text-green-600 font-bold mt-2">
                        💰 ₱{{ number_format($walk->price ?? 100, 2) }}
                    </p>

                </div>

                <!-- STATUS -->
                <div class="flex flex-col items-end gap-2">

                    <span class="px-4 py-1 rounded-full text-xs font-bold

                        @if($walk->status == 'pending')
                            bg-yellow-100 text-yellow-700

                        @elseif($walk->status == 'approved')
                            bg-green-100 text-green-700

                        @elseif($walk->status == 'completed')
                            bg-blue-100 text-blue-700

                        @elseif($walk->status == 'paid')
                            bg-purple-100 text-purple-700

                        @else
                            bg-red-100 text-red-700
                        @endif">

                        {{ ucfirst(str_replace('_', ' ', $walk->status)) }}

                    </span>

                    @if($walk->payment_status == 'paid' || $walk->status == 'paid')

                        <span class="text-green-600 text-xs font-bold">
                            💳 Paid
                        </span>

                    @endif

                    @if($walk->is_refunded)

                        <span class="text-blue-600 text-xs font-bold">
                            💸 Refunded
                        </span>

                    @endif

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="flex flex-wrap gap-3">

                <!-- APPROVE -->
                @if($walk->status == 'pending')

                    <form method="POST"
                          action="{{ route('walker.walks.approve', $walk->id) }}"
                          onclick="event.stopPropagation()">

                        @csrf

                        <button
                            onclick="event.stopPropagation()"

                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-2xl text-sm font-semibold transition shadow">

                            ✅ Approve

                        </button>

                    </form>

                @endif

                <!-- REJECT -->
                @if($walk->status == 'pending' || $walk->status == 'approved')

                    <form method="POST"
                          action="{{ route('walker.walks.reject', $walk->id) }}"
                          onclick="event.stopPropagation()">

                        @csrf

                        <button
                            onclick="event.stopPropagation(); return confirm('Reject this booking?')"

                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-2xl text-sm font-semibold transition shadow">

                            ❌ Reject

                        </button>

                    </form>

                @endif

                <!-- COMPLETE -->
                @if(
                    ($walk->status == 'approved' && $walk->payment_status == 'paid')
                    || $walk->status == 'paid'
                )

                    <form method="POST"
                          action="{{ route('walker.walks.complete', $walk->id) }}"
                          onclick="event.stopPropagation()">

                        @csrf

                        <button
                            onclick="event.stopPropagation()"

                            class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-2xl text-sm font-semibold transition shadow">

                            🏁 Complete

                        </button>

                    </form>

                @endif

            </div>

            <!-- 📍 VIEW PET OWNER LOCATION -->
            @if(true)

            <a target="_blank"
               href="https://www.google.com/maps?q={{ $walk->customer_latitude }},{{ $walk->customer_longitude }}"

               onclick="event.stopPropagation()"

               class="mt-4 flex items-center justify-center gap-2 bg-green-600 hover:bg-green-500 text-white py-3 rounded-2xl font-semibold transition shadow">

                📍 View Pet Owner Location

            </a>

            @endif

            <!-- MESSAGE -->
            <a href="{{ route('chat.index', $walk->user_id) }}"
               onclick="event.stopPropagation()"

               class="mt-5 flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white py-3 rounded-2xl font-semibold transition shadow">

                💬 Message Owner

            </a>

        </div>

        @empty

        <div class="col-span-2 text-center py-20">

            <div class="text-6xl mb-4">
                🐕
            </div>

            <h2 class="text-2xl font-bold text-gray-600">
                No walks assigned
            </h2>

            <p class="text-gray-500 mt-2">
                New bookings will appear here.
            </p>

        </div>

        @endforelse

    </div>

</div>

<!-- 🔄 SORT -->
<script>

function sortWalks(type) {

    const container = document.getElementById('walkContainer');

    let cards = Array.from(document.querySelectorAll('.walk-card'));

    if (type === 'newest') {

        cards.sort((a, b) =>
            new Date(b.dataset.date) - new Date(a.dataset.date)
        );

    }

    else if (type === 'oldest') {

        cards.sort((a, b) =>
            new Date(a.dataset.date) - new Date(b.dataset.date)
        );

    }

    else if (type === 'pending') {

        cards.sort((a, b) => {

            return (
                (b.dataset.status === 'pending') -
                (a.dataset.status === 'pending')
            );

        });

    }

    else if (type === 'completed') {

        cards.sort((a, b) => {

            return (
                (b.dataset.status === 'completed') -
                (a.dataset.status === 'completed')
            );

        });

    }

    cards.forEach(card => container.appendChild(card));

}

</script>

<!-- 🌙 DARK MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// LOAD SAVED
if (localStorage.getItem('walk-theme') === 'dark') {

    dashboard.classList.remove(
        'from-indigo-50',
        'via-purple-50',
        'to-pink-50'
    );

    dashboard.classList.add(
        'from-gray-950',
        'via-slate-900',
        'to-black',
        'text-white'
    );

    toggleBtn.innerHTML = '☀️';
}

// TOGGLE
toggleBtn.addEventListener('click', () => {

    if (dashboard.classList.contains('from-gray-950')) {

        dashboard.classList.remove(
            'from-gray-950',
            'via-slate-900',
            'to-black',
            'text-white'
        );

        dashboard.classList.add(
            'from-indigo-50',
            'via-purple-50',
            'to-pink-50'
        );

        toggleBtn.innerHTML = '🌙';

        localStorage.setItem('walk-theme', 'light');

    } else {

        dashboard.classList.remove(
            'from-indigo-50',
            'via-purple-50',
            'to-pink-50'
        );

        dashboard.classList.add(
            'from-gray-950',
            'via-slate-900',
            'to-black',
            'text-white'
        );

        toggleBtn.innerHTML = '☀️';

        localStorage.setItem('walk-theme', 'dark');

    }

});

</script>

@endsection