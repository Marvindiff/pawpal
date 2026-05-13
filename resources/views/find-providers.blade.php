@extends('layouts.app')

@php
use App\Models\Review;
@endphp

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 transition-all duration-500">

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">

        <div>

            <h1 class="text-4xl font-bold text-indigo-700">
                Find Pet {{ request('type') == 'walker' ? 'Walkers 🐕' : 'Sitters 🐾' }}
            </h1>

            <p class="text-gray-500 mt-1">
                Search trusted pet care providers
            </p>

        </div>

        <div class="flex items-center gap-3">

            <!-- 🌙 TOGGLE -->
            <button id="theme-toggle"
                class="bg-white shadow px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                🌙

            </button>

            <!-- 🔙 BACK -->
            <a href="{{ route('dashboard') }}"
               class="bg-indigo-600 text-white px-5 py-3 rounded-2xl shadow hover:bg-indigo-500 transition font-semibold">
                ← Dashboard
            </a>

        </div>

    </div>

    <!-- 🔍 SEARCH -->
    <div class="mb-8">

        <div class="relative">

            <input type="text"
                   id="searchInput"
                   placeholder="Search provider, location, service..."
                   class="w-full bg-white shadow-lg rounded-2xl px-5 py-4 pl-12 outline-none border border-gray-200 focus:ring-2 focus:ring-indigo-400">

            <span class="absolute left-4 top-4 text-gray-400 text-lg">
                🔍
            </span>

        </div>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-2xl mb-6 shadow">
            {{ session('success') }}
        </div>

    @endif

    <!-- PROVIDERS -->
    <div id="providersGrid"
         class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @forelse($providers as $provider)

        @php
            $reviews = Review::where('provider_id', $provider->id)->get();
            $count = $reviews->count();
            $avg = $count > 0 ? round($reviews->avg('rating'), 1) : 0;
        @endphp

        <div class="provider-card bg-white rounded-3xl shadow-lg p-5 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

            <!-- TOP -->
            <div class="flex items-start gap-4 mb-4">

                <!-- AVATAR -->
                <img src="{{ $provider->avatar ?? 'https://via.placeholder.com/80' }}"
                     class="rounded-full w-16 h-16 border-4 border-indigo-100 object-cover">

                <!-- INFO -->
                <div class="flex-1">

                    <h3 class="provider-name text-xl font-bold text-indigo-700">
                        {{ $provider->name }}
                    </h3>

                    <p class="provider-service text-sm text-gray-500">
                        {{ ucfirst(str_replace('_',' ', $provider->service_type)) }}
                    </p>

                    <!-- ⭐ RATING -->
                    <div class="mt-2">

                        <div class="text-yellow-400 text-sm">

                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= floor($avg) ? '⭐' : '☆' }}
                            @endfor

                        </div>

                        <p class="text-xs text-gray-500 mt-1">

                            @if($count > 0)

                                {{ $avg }} / 5 ({{ $count }} reviews)

                            @else

                                No reviews yet

                            @endif

                        </p>

                    </div>

                    <!-- 💰 PRICE -->
                    <p class="text-green-600 font-bold mt-2">
                        💰 ₱{{ $provider->price ?? 'Not set' }} / walk
                    </p>

                </div>

                <!-- STATUS -->
                @if($provider->is_available)

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                        🟢 Available
                    </span>

                @else

                    <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">
                        ⚪ Offline
                    </span>

                @endif

            </div>

            <!-- BIO -->
            <p class="text-gray-600 text-sm mb-4">
                {{ $provider->bio ?? 'No bio available.' }}
            </p>

            <!-- LOCATION -->
<p class="provider-location text-sm text-gray-500 mb-2">
    📍 {{ $provider->location ?? 'Location not set' }}
</p>

<!-- MOBILE -->
<p class="text-sm text-indigo-600 font-semibold mb-4">
    📱 {{ $provider->mobile_number ?? 'No mobile number' }}
</p>

            <!-- 💬 CHAT -->
            <a href="{{ route('chat.index', $provider->id) }}"
               class="block bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-2xl text-center font-semibold transition mb-3">
                Message 💬
            </a>

            <!-- 📅 BOOK -->
            @if($provider->price)

                <form method="POST" action="{{ route('booking.store') }}">
    @csrf

    <!-- PROVIDER -->
    <input type="hidden" name="provider_id" value="{{ $provider->id }}">
    <input type="hidden" name="price" value="{{ $provider->price }}">

    <!-- 📍 CUSTOMER GPS -->
    <input type="hidden"
           name="customer_latitude"
           id="customer_latitude">

    <input type="hidden"
           name="customer_longitude"
           id="customer_longitude">

    <!-- DATE -->
    <input type="date"
           name="date"
           required
           class="border border-gray-200 p-3 w-full rounded-2xl mb-3 focus:ring-2 focus:ring-indigo-400 outline-none">

    <!-- TIME -->
    <input type="time"
           name="time"
           required
           class="border border-gray-200 p-3 w-full rounded-2xl mb-3 focus:ring-2 focus:ring-indigo-400 outline-none">

    <!-- 📍 LOCATION BUTTON -->
   <button type="button"
        onclick="getLocation()"

        class="w-full bg-green-600 hover:bg-green-500 text-white py-3 rounded-2xl font-semibold transition mb-3">

    📍 Use Current Location

</button>

<p id="gpsStatus"
   class="text-sm text-green-600 mt-2 text-center"></p>

    <!-- SUBMIT -->
    <button class="w-full bg-yellow-400 hover:bg-yellow-300 text-gray-900 py-3 rounded-2xl font-bold transition">

        Book Now

    </button>

</form>

            @else

                <p class="text-red-500 text-sm text-center mt-3">
                    ⚠️ Price not set by provider
                </p>

            @endif

        </div>

        @empty

            <div class="col-span-3 text-center text-gray-500 text-lg">
                No providers available right now.
            </div>

        @endforelse

    </div>

</div>

<!-- 🔍 LIVE SEARCH -->
<script>

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function() {

    let value = this.value.toLowerCase();

    let cards = document.querySelectorAll('.provider-card');

    cards.forEach(card => {

        let name = card.querySelector('.provider-name')
            .innerText.toLowerCase();

        let service = card.querySelector('.provider-service')
            .innerText.toLowerCase();

        let location = card.querySelector('.provider-location')
            .innerText.toLowerCase();

        if (
            name.includes(value) ||
            service.includes(value) ||
            location.includes(value)
        ) {

            card.style.display = 'block';

        } else {

            card.style.display = 'none';

        }

    });

});

</script>

<!-- 🌙 DARK MODE -->
<script>

const toggleBtn = document.getElementById('theme-toggle');
const dashboard = document.getElementById('dashboard');

// LOAD SAVED
if (localStorage.getItem('provider-search-theme') === 'dark') {

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

        localStorage.setItem('provider-search-theme', 'light');

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

        localStorage.setItem('provider-search-theme', 'dark');

    }

});

</script>
<script>

function getLocation(){

    if (!navigator.geolocation) {

        alert('❌ GPS is not supported.');

        return;

    }

    navigator.geolocation.getCurrentPosition(

        (position) => {

            // 📍 SAVE GPS
            document.getElementById('customer_latitude').value =
                position.coords.latitude;

            document.getElementById('customer_longitude').value =
                position.coords.longitude;

            // 🎯 ACCURACY
            const accuracy =
                Math.round(position.coords.accuracy);

            // ✅ SUCCESS
            document.getElementById('gpsStatus').innerHTML =

                `📍 Accurate GPS locked (${accuracy}m accuracy)`;

            console.log(
                'LAT:',
                position.coords.latitude
            );

            console.log(
                'LONG:',
                position.coords.longitude
            );

            console.log(
                'ACCURACY:',
                accuracy
            );

        },

        (error) => {

            alert(
                '❌ Unable to get accurate GPS location.'
            );

            console.log(error);

        },

        {
            enableHighAccuracy: true,
            timeout: 30000,
            maximumAge: 0
        }

    );

}

</script>
@endsection