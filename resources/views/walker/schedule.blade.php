@extends('layouts.app')

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 transition-all duration-500">

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>

            <h1 class="text-4xl font-bold text-indigo-700">
                My Schedule 📅
            </h1>

            <p class="text-gray-500 mt-1">
                Manage your bookings and appointments
            </p>

        </div>

        <div class="flex items-center gap-3">

            <!-- 🌙 THEME -->
            <button id="theme-toggle"
                class="bg-white shadow-lg px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                🌙

            </button>

            <!-- 🔙 BACK -->
            <a href="/walker/dashboard"
               class="bg-indigo-600 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-500 transition font-semibold">

                ← Dashboard

            </a>

        </div>

    </div>

    <!-- ✅ FLASH -->
    @if(session('success'))

        <div class="mb-6 bg-green-100 text-green-700 px-5 py-4 rounded-2xl shadow">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="mb-6 bg-red-100 text-red-700 px-5 py-4 rounded-2xl shadow">
            {{ session('error') }}
        </div>

    @endif

    <!-- 🔍 SORT -->
    <div class="flex flex-wrap gap-3 mb-8">

        <button onclick="sortBookings('newest')"
            class="bg-indigo-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-indigo-500 transition">

            🆕 Newest

        </button>

        <button onclick="sortBookings('oldest')"
            class="bg-gray-700 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-gray-600 transition">

            📜 Oldest

        </button>

        <button onclick="sortBookings('pending')"
            class="bg-yellow-400 text-black px-5 py-3 rounded-2xl font-semibold shadow hover:bg-yellow-300 transition">

            ⏳ Pending

        </button>

        <button onclick="sortBookings('completed')"
            class="bg-green-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-green-500 transition">

            ✅ Completed

        </button>

    </div>

    <!-- 📦 BOOKINGS -->
    <div id="bookingContainer"
         class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @forelse($walks as $b)

        <div class="booking-card bg-white rounded-3xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300"

             data-date="{{ $b->created_at }}"
             data-status="{{ $b->status }}">

            <!-- TOP -->
            <div class="flex justify-between items-start mb-5">

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        👤 {{ $b->user->name ?? 'Client' }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        📅 {{ $b->schedule }}
                    </p>

                </div>

                <p class="text-2xl font-bold text-indigo-600">
                    ₱{{ number_format($b->price ?? 0, 2) }}
                </p>

            </div>

            <!-- STATUS -->
            <div class="flex flex-wrap gap-2 mb-5">

                <!-- BOOKING STATUS -->
                <span class="px-4 py-2 rounded-full text-xs font-bold

                    @if($b->status == 'completed')
                        bg-green-100 text-green-700

                    @elseif($b->status == 'approved')
                        bg-blue-100 text-blue-700

                    @elseif($b->status == 'pending')
                        bg-yellow-100 text-yellow-700

                    @elseif($b->status == 'rejected')
                        bg-red-100 text-red-700

                    @else
                        bg-gray-100 text-gray-700
                    @endif">

                    {{ ucfirst(str_replace('_', ' ', $b->status)) }}

                </span>

                <!-- PAYMENT -->
                @if($b->payment_status == 'paid')

                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-green-100 text-green-700">
                        💳 Paid via {{ ucfirst($b->payment_method ?? 'N/A') }}
                    </span>

                @elseif($b->payment_status == 'pending')

                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                        ⏳ Waiting Approval
                    </span>

                @elseif($b->payment_status == 'refunded')

                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                        💸 Refunded
                    </span>

                @endif

            </div>

            <!-- ACTIONS -->
            <div class="space-y-4">

                <!-- BUTTONS -->
                <div class="flex gap-3">

                    <!-- 💬 -->
                    <a href="{{ route('chat.index', $b->user_id) }}"
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-2xl text-center font-semibold transition shadow">

                        💬 Message

                    </a>

                    <!-- 🏁 -->
                    @if($b->status == 'approved' && $b->payment_status == 'paid')

                        <form method="POST"
                              action="{{ route('walker.walks.complete', $b->id) }}"
                              class="flex-1">

                            @csrf

                            <button
                                onclick="return confirm('Mark this booking as completed?')"

                                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-semibold transition shadow">

                                🏁 Complete

                            </button>

                        </form>

                    @endif

                </div>

                <!-- ❌ REJECT -->
                @if($b->status != 'rejected' && $b->status != 'completed')

                    <form method="POST"
                          action="{{ route('booking.reject', $b->id) }}"
                          class="space-y-3">

                        @csrf

                        <textarea name="reject_reason"
                            class="w-full border border-gray-200 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-red-400 outline-none"
                            placeholder="Reason for rejection..."
                            required></textarea>

                        <button type="submit"

                            onclick="return confirm('Reject this booking? Refund will be processed.')"

                            class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl font-semibold transition shadow">

                            ❌ Reject Booking

                        </button>

                    </form>

                @endif

            </div>

        </div>

        @empty

        <div class="col-span-2 text-center py-20">

            <div class="text-6xl mb-4">
                📅
            </div>

            <h2 class="text-2xl font-bold text-gray-600">
                No schedule yet
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

function sortBookings(type) {

    const container = document.getElementById('bookingContainer');

    let cards = Array.from(document.querySelectorAll('.booking-card'));

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
if (localStorage.getItem('schedule-theme') === 'dark') {

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
            'to-pink-50'
        );

        toggleBtn.innerHTML = '🌙';

        localStorage.setItem('schedule-theme', 'light');

    } else {

        // 🌙 DARK
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

        localStorage.setItem('schedule-theme', 'dark');

    }

});

</script>

@endsection