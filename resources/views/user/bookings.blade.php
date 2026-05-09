@extends('layouts.app')

@section('content')

@if(session('success'))

<div class="max-w-6xl mx-auto mt-4 p-4 bg-green-100 text-green-700 rounded-2xl shadow">
    {{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="max-w-6xl mx-auto mt-4 p-4 bg-red-100 text-red-700 rounded-2xl shadow">
    {{ session('error') }}
</div>

@endif

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 transition-all duration-500">

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>

            <h1 class="text-4xl font-bold text-indigo-700">
                🐾 My Bookings
            </h1>

            <p class="text-gray-500 mt-1">
                View and manage your pet bookings
            </p>

        </div>

        <div class="flex items-center gap-3">

            <!-- 🌙 THEME -->
            <button id="theme-toggle"
                class="bg-white shadow-lg px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                🌙

            </button>

            <!-- 🔙 BACK -->
            <a href="{{ route('dashboard') }}"
               class="bg-indigo-600 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-500 transition font-semibold">

                ← Dashboard

            </a>

        </div>

    </div>

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

        <button onclick="sortBookings('paid')"
            class="bg-green-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-green-500 transition">

            💳 Paid

        </button>

        <button onclick="sortBookings('completed')"
            class="bg-blue-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-blue-500 transition">

            🏁 Completed

        </button>

    </div>

    <!-- 📦 BOOKINGS -->
    <div id="bookingContainer"
         class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @forelse($bookings as $booking)

        <div class="booking-card bg-white rounded-3xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300"

             data-date="{{ $booking->created_at }}"
             data-status="{{ $booking->status }}"
             data-payment="{{ $booking->payment_status }}">

            <!-- TOP -->
            <div class="flex justify-between items-start mb-5">

                <!-- LEFT -->
                <a href="{{ route('booking.show', $booking->id) }}"
                   class="flex-1">

                    <h2 class="text-xl font-bold text-gray-800">
                        🧑‍⚕️ {{ $booking->provider->name ?? 'Provider' }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        🐾 Pet Service
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        📅 {{ $booking->schedule ?? 'No schedule' }}
                    </p>

                </a>

                <!-- PRICE -->
                <div class="text-right">

                    <p class="text-2xl font-bold text-indigo-600">
                        ₱{{ number_format($booking->price ?? 0, 2) }}
                    </p>

                </div>

            </div>

            <!-- STATUS -->
            <div class="flex flex-wrap gap-2 mb-5">

                <!-- BOOKING -->
                <span class="px-4 py-2 rounded-full text-xs font-bold

                    @if($booking->status == 'pending')
                        bg-yellow-100 text-yellow-700

                    @elseif($booking->status == 'approved')
                        bg-blue-100 text-blue-700

                    @elseif($booking->status == 'completed')
                        bg-green-100 text-green-700

                    @elseif($booking->status == 'rejected')
                        bg-red-100 text-red-700

                    @else
                        bg-gray-100 text-gray-700
                    @endif">

                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}

                </span>

                <!-- PAYMENT -->
                @if($booking->payment_status == 'paid')

                    <span id="payment-status-{{ $booking->id }}"
                          class="px-4 py-2 rounded-full text-xs font-bold bg-green-100 text-green-700">

                        💳 Payment Approved

                    </span>

                @elseif($booking->payment_status == 'pending')

                    <span id="payment-status-{{ $booking->id }}"
                          class="px-4 py-2 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">

                        ⏳ Waiting Admin Approval

                    </span>

                @elseif($booking->payment_status == 'rejected')

                    <span id="payment-status-{{ $booking->id }}"
                          class="px-4 py-2 rounded-full text-xs font-bold bg-red-100 text-red-700">

                        ❌ Payment Rejected

                    </span>

                @endif

                <!-- REFUND -->
                @if($booking->is_refunded)

                    <span class="px-4 py-2 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                        💸 Refunded
                    </span>

                @endif

            </div>

            <!-- REJECT REASON -->
            @if($booking->status == 'rejected')

            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl text-sm mb-5">

                ❌ <span class="font-semibold">Reason:</span>
                {{ $booking->reject_reason }}

            </div>

            @endif

            <!-- ACTIONS -->
            <div class="space-y-4">

                <!-- PENDING -->
                @if($booking->status == 'pending')

                    <div class="flex items-center justify-between gap-3">

                        <p class="text-yellow-600 text-sm font-semibold">
                            ⏳ Waiting for Provider Approval
                        </p>

                        <a href="{{ route('chat.index', $booking->provider_id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-2xl text-sm font-semibold transition shadow">

                            💬 Message

                        </a>

                    </div>

                <!-- APPROVED -->
                @elseif($booking->status == 'approved')

                    @if(!$booking->payment_status)

                        <div class="flex flex-wrap gap-3">

                            <!-- PAY -->
                            <a href="{{ route('payment.show', $booking->id) }}"
                               class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-2xl text-center font-semibold transition shadow">

                                💳 Pay Now

                            </a>

                            <!-- REPORT -->
                            <button type="button"
                                onclick="toggleReport({{ $booking->id }})"

                                class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl font-semibold transition shadow">

                                🚨 Report

                            </button>

                        </div>

                    @endif

                <!-- COMPLETED -->
                @elseif($booking->status == 'completed')

                    <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-2xl text-sm font-semibold">

                        🏁 Booking Completed Successfully

                    </div>

                @endif

                <!-- REPORT FORM -->
                <div id="reportBox{{ $booking->id }}"
                     class="hidden">

                    <form method="POST"
                          action="{{ route('report.store') }}"
                          class="space-y-3">

                        @csrf

                        <input type="hidden"
                               name="reported_id"
                               value="{{ $booking->provider_id }}">

                        <input type="hidden"
                               name="type"
                               value="provider">

                        <textarea name="reason"
                            required
                            placeholder="Describe the issue..."
                            class="w-full border border-gray-200 rounded-2xl p-4 text-sm outline-none focus:ring-2 focus:ring-red-400"></textarea>

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-semibold transition shadow">

                            🚨 Submit Report

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @empty

        <div class="col-span-2 text-center py-20">

            <div class="text-6xl mb-4">
                🐾
            </div>

            <h2 class="text-2xl font-bold text-gray-600">
                No bookings yet
            </h2>

            <p class="text-gray-500 mt-2">
                Your bookings will appear here.
            </p>

        </div>

        @endforelse

    </div>

</div>

<!-- 🚨 TOGGLE REPORT -->
<script>

function toggleReport(id) {

    document.getElementById('reportBox' + id)
        .classList.toggle('hidden');

}

</script>

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

    else if (type === 'paid') {

        cards.sort((a, b) => {

            return (
                (b.dataset.payment === 'paid') -
                (a.dataset.payment === 'paid')
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

<!-- 🔄 REALTIME PAYMENT -->
<script>

setInterval(() => {

    @foreach($bookings as $booking)

    fetch('/payment-status/{{ $booking->id }}')
        .then(response => response.json())
        .then(data => {

            let statusEl =
                document.getElementById('payment-status-{{ $booking->id }}');

            if (!statusEl) return;

            // ✅ PAID
            if (data.payment_status === 'paid') {

                statusEl.innerHTML =
                    '💳 Payment Approved';

                statusEl.className =
                    'px-4 py-2 rounded-full text-xs font-bold bg-green-100 text-green-700';

            }

            // ⏳ PENDING
            else if (data.payment_status === 'pending') {

                statusEl.innerHTML =
                    '⏳ Waiting Admin Approval';

                statusEl.className =
                    'px-4 py-2 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700';

            }

            // ❌ REJECTED
            else if (data.payment_status === 'rejected') {

                statusEl.innerHTML =
                    '❌ Payment Rejected';

                statusEl.className =
                    'px-4 py-2 rounded-full text-xs font-bold bg-red-100 text-red-700';

            }

        });

    @endforeach

}, 5000);

</script>

<!-- 🌙 DARK MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// LOAD SAVED
if (localStorage.getItem('user-bookings-theme') === 'dark') {

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

        localStorage.setItem('user-bookings-theme', 'light');

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

        localStorage.setItem('user-bookings-theme', 'dark');

    }

});

</script>

@endsection