@extends('layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

let map;
let marker;
let glowCircle;

document.addEventListener('DOMContentLoaded', () => {

    const button = document.getElementById('showMapBtn');

    if(button){

        button.addEventListener('click', () => {

            document.getElementById('mapContainer')
                .classList.remove('hidden');

            if(!map){

                // DEFAULT LOCATION
                map = L.map('map').setView([15.0343, 120.6840], 15);

                // MAP LAYER
                L.tileLayer(
                    'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        attribution:
                        '&copy; OpenStreetMap contributors'
                    }
                ).addTo(map);

                // 🔵 OUTER GLOW
                glowCircle = L.circle(
                    [15.0343, 120.6840],
                    {
                        radius: 45,
                        color: '#93c5fd',
                        fillColor: '#bfdbfe',
                        fillOpacity: 0.25,
                        weight: 1
                    }
                ).addTo(map);

                // 🔵 INNER BLUE GPS DOT
                marker = L.circleMarker(
                    [15.0343, 120.6840],
                    {
                        radius: 10,
                        color: '#2563eb',
                        fillColor: '#3b82f6',
                        fillOpacity: 1,
                        weight: 3
                    }
                ).addTo(map);

                // LOAD LOCATION
                loadLocation();

                // AUTO REFRESH
                setInterval(loadLocation, 3000);

            }

        });

    }

});

// LOAD GPS LOCATION
function loadLocation(){

    fetch('/booking-location/{{ $booking->id }}')

    .then(response => response.json())

    .then(data => {

        console.log(data);

        if(data.latitude && data.longitude){

            // MOVE BLUE DOT
            marker.setLatLng([
                data.latitude,
                data.longitude
            ]);

            // MOVE GLOW
            glowCircle.setLatLng([
                data.latitude,
                data.longitude
            ]);

            // MOVE MAP
            map.setView([
                data.latitude,
                data.longitude
            ], 16);

        }

    });

}

</script>

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6">

        <!-- HEADER -->
        <h2 class="text-center text-2xl font-bold text-indigo-700 mb-4">
            🧾 Booking Receipt
        </h2>

        <!-- INFO -->
        <div class="space-y-3 text-sm text-gray-700">

        <div class="flex justify-between">
    <span>Mobile Number:</span>

    <span class="font-semibold text-indigo-600">
        📱 {{ $booking->user->mobile_number ?? 'Not provided' }}
    </span>
</div>
            <div class="flex justify-between">
                <span>Customer:</span>

                <span class="font-semibold">
                    {{ $booking->user->name ?? 'N/A' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Provider:</span>

                <span class="font-semibold">
                    {{ $booking->provider->name ?? 'N/A' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Service:</span>

                <span class="font-semibold">
                    Pet Service
                </span>
            </div>

            <div class="flex justify-between">
                <span>Schedule:</span>

                <span class="font-semibold">
                    {{ $booking->schedule ?? 'N/A' }}
                </span>
            </div>

            <hr>

            <div class="flex justify-between text-lg">

                <span>Total:</span>

                <span class="font-bold text-indigo-600">
                    ₱{{ $booking->price }}
                </span>

            </div>

            <!-- STATUS -->
            <div class="text-center mt-3">

                <span class="text-xs px-3 py-1 rounded-full font-semibold

                    @if($booking->status == 'pending')
                        bg-yellow-100 text-yellow-600

                    @elseif($booking->status == 'approved')
                        bg-green-100 text-green-600

                    @elseif($booking->status == 'completed')
                        bg-blue-100 text-blue-600

                    @elseif($booking->status == 'paid')
                        bg-purple-100 text-purple-600

                    @else
                        bg-red-100 text-red-600
                    @endif">

                    {{ ucfirst(str_replace('_',' ', $booking->status)) }}

                </span>

            </div>

        </div>

      <!-- ⭐ RATE PROVIDER -->
@if(
    auth()->user()->role != 'provider' &&
    ($booking->status == 'completed' || $booking->status == 'paid')
)

<div class="mt-6 text-center">

    <a href="{{ route('review.create', $booking->id) }}"
       class="inline-block bg-yellow-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition shadow">

        ⭐ Rate Provider

    </a>

</div>

@endif

        <!-- 🛰 TRACK PROVIDER -->
        @if(auth()->user()->role != 'provider')

        <div class="mt-6 text-center">

            <button id="showMapBtn"
                class="bg-indigo-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow">

                🛰 Track Provider

            </button>

        </div>

        <!-- LIVE TRACKER -->
        <div id="mapContainer" class="hidden mt-6">

            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 rounded-3xl p-4 shadow-lg">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-4">

                    <div>

                        <h3 class="text-xl font-bold text-indigo-700">
                            🛰 Live Provider Tracker
                        </h3>

                        <p class="text-sm text-gray-500">
                            Real-time provider location
                        </p>

                    </div>

                    <!-- LIVE -->
                    <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold animate-pulse">

                        ● LIVE

                    </div>

                </div>

                <!-- MAP -->
                <div id="map"
                     class="rounded-2xl overflow-hidden border border-indigo-100 shadow"
                     style="height:450px;"></div>

                <!-- INFO -->
                <div class="grid grid-cols-2 gap-3 mt-4">

                    <div class="bg-white rounded-2xl p-3 shadow-sm">

                        <p class="text-xs text-gray-400">
                            Provider
                        </p>

                        <p class="font-bold text-indigo-700">
                            {{ $booking->provider->name ?? 'Walker' }}
                        </p>

                    </div>

                    <div class="bg-white rounded-2xl p-3 shadow-sm">

                        <p class="text-xs text-gray-400">
                            Tracking Status
                        </p>

                        <p class="font-bold text-green-600">
                            Active
                        </p>

                    </div>

                </div>

            </div>

        </div>

        @endif

        <!-- 🏠 PICKUP LOCATION -->
        @if(auth()->user()->role == 'provider')

        <div class="mt-4">

            <a target="_blank"
               href="https://www.google.com/maps/search/?api=1&query={{ $booking->customer_latitude }},{{ $booking->customer_longitude }}"

               class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-500 text-white py-3 rounded-xl font-semibold transition shadow">

                🏠 Pickup Location

            </a>

        </div>

        @endif

        <!-- BACK BUTTON -->
        <div class="mt-6 text-center">

            @if(auth()->user()->role == 'provider')

                <a href="{{ route('provider.bookings') }}"
                   class="inline-block text-indigo-600 hover:underline text-sm">

                    ← Back to Client Bookings

                </a>

            @else

                <a href="{{ route('user.bookings') }}"
                   class="inline-block text-indigo-600 hover:underline text-sm">

                    ← Back to My Bookings

                </a>

            @endif

        </div>

    </div>

</div>

@endsection