@extends('layouts.app')

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 transition-all duration-500">

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

        <div>

            <h1 class="text-4xl font-bold text-indigo-700">
                🛠 Manage Services
            </h1>

            <p class="text-gray-500 mt-1">
                Create and manage your pet care services
            </p>

        </div>

        <div class="flex items-center gap-3">

            <!-- 🌙 THEME -->
            <button id="theme-toggle"
                class="bg-white shadow-lg px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                🌙

            </button>

            <!-- 🔙 BACK -->
            <a href="{{ route('provider.dashboard') }}"
               class="bg-indigo-600 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-500 transition font-semibold">

                ← Dashboard

            </a>

        </div>

    </div>

    <!-- ➕ ADD SERVICE -->
    <div class="bg-white/80 backdrop-blur border border-gray-200 p-6 rounded-3xl shadow-lg mb-8">

        <div class="flex items-center gap-3 mb-6">

            <div class="text-3xl">
                ➕
            </div>

            <div>

                <h2 class="text-2xl font-bold text-indigo-700">
                    Add New Service
                </h2>

                <p class="text-sm text-gray-500">
                    Create a new service for your clients
                </p>

            </div>

        </div>

        <form method="POST"
              action="{{ route('provider.services.store') }}"
              class="grid md:grid-cols-3 gap-4">

            @csrf

            <!-- TITLE -->
            <div class="space-y-2">

                <label class="text-sm font-semibold text-gray-700">
                    Service Name
                </label>

                <input type="text"
                       name="title"
                       placeholder="Dog Walking"
                       class="w-full p-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">

            </div>

            <!-- DESCRIPTION -->
            <div class="space-y-2">

                <label class="text-sm font-semibold text-gray-700">
                    Description
                </label>

                <input type="text"
                       name="description"
                       placeholder="30 minutes pet walk"
                       class="w-full p-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">

            </div>

            <!-- PRICE -->
            <div class="space-y-2">

                <label class="text-sm font-semibold text-gray-700">
                    Price
                </label>

                <input type="number"
                       name="price"
                       placeholder="₱500"
                       class="w-full p-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">

            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="md:col-span-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-4 rounded-2xl font-bold hover:scale-[1.01] hover:opacity-90 transition shadow-lg">

                ➕ Add Service

            </button>

        </form>

    </div>

    <!-- 🔍 FILTERS -->
    <div class="flex flex-wrap gap-3 mb-8">

        <button onclick="sortServices('newest')"
            class="bg-indigo-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-indigo-500 transition">

            🆕 Newest

        </button>

        <button onclick="sortServices('oldest')"
            class="bg-gray-700 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-gray-600 transition">

            📜 Oldest

        </button>

        <button onclick="sortServices('highest')"
            class="bg-green-600 text-white px-5 py-3 rounded-2xl font-semibold shadow hover:bg-green-500 transition">

            💰 Highest Price

        </button>

        <button onclick="sortServices('lowest')"
            class="bg-yellow-400 text-black px-5 py-3 rounded-2xl font-semibold shadow hover:bg-yellow-300 transition">

            🪙 Lowest Price

        </button>

    </div>

    <!-- 📦 SERVICES -->
    <div id="servicesContainer"
         class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @forelse($services as $service)

        <div class="service-card bg-white rounded-3xl shadow-lg p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300"

             data-date="{{ $service->created_at }}"
             data-price="{{ $service->price }}">

            <!-- TOP -->
            <div class="flex justify-between items-start mb-5">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $service->title }}
                    </h2>

                    <p class="text-gray-500 mt-2">
                        {{ $service->description ?? 'No description available.' }}
                    </p>

                </div>

                <!-- PRICE -->
                <div class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-2xl font-bold text-lg">

                    ₱{{ number_format($service->price, 2) }}

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="flex flex-wrap gap-3 mt-6">

                <!-- EDIT -->
                <a href="{{ route('provider.services.edit', $service->id) }}"
                   class="flex-1 bg-yellow-400 hover:bg-yellow-300 text-black py-3 rounded-2xl text-center font-semibold transition shadow">

                    ✏️ Edit

                </a>

                <!-- DELETE -->
                <form method="POST"
                      action="{{ route('provider.services.delete', $service->id) }}"
                      class="flex-1"
                      onsubmit="return confirm('Delete this service?')">

                    @csrf
                    @method('DELETE')

                    <button
                        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-2xl font-semibold transition shadow">

                        🗑 Delete

                    </button>

                </form>

            </div>

        </div>

        @empty

        <div class="col-span-2 text-center py-20">

            <div class="text-6xl mb-4">
                🛠
            </div>

            <h2 class="text-2xl font-bold text-gray-600">
                No services yet
            </h2>

            <p class="text-gray-500 mt-2">
                Add your first service to start accepting clients.
            </p>

        </div>

        @endforelse

    </div>

</div>

<!-- 🔄 SORT -->
<script>

function sortServices(type) {

    const container = document.getElementById('servicesContainer');

    let cards = Array.from(document.querySelectorAll('.service-card'));

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

    else if (type === 'highest') {

        cards.sort((a, b) =>
            parseFloat(b.dataset.price) - parseFloat(a.dataset.price)
        );

    }

    else if (type === 'lowest') {

        cards.sort((a, b) =>
            parseFloat(a.dataset.price) - parseFloat(b.dataset.price)
        );

    }

    cards.forEach(card => container.appendChild(card));

}

</script>

<!-- 🌙 DARK MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// LOAD SAVED
if (localStorage.getItem('services-theme') === 'dark') {

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

        localStorage.setItem('services-theme', 'light');

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

        localStorage.setItem('services-theme', 'dark');

    }

});

</script>

@endsection