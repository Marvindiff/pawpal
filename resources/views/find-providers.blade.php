@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">
            Find Pet Sitters 🐾
        </h1>

        <a href="{{ route('dashboard') }}"
           class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Back to Dashboard
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- PROVIDERS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @forelse($providers as $provider)
        <div class="bg-white shadow-lg rounded-xl p-5 flex flex-col hover:shadow-xl transition">

            <!-- TOP -->
            <div class="flex items-center mb-4">
                <img src="{{ $provider->avatar ?? 'https://via.placeholder.com/80' }}"
                     class="rounded-full w-16 h-16 mr-3 border">

                <div>
                    <h3 class="text-lg font-bold text-blue-700">
                        {{ $provider->name }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ ucfirst(str_replace('_',' ', $provider->service_type)) }}
                    </p>
                </div>

                <!-- AVAILABILITY -->
                @if($provider->is_available)
                    <span class="ml-auto bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                        Available
                    </span>
                @else
                    <span class="ml-auto bg-gray-200 text-gray-600 px-2 py-1 rounded text-xs">
                        Offline
                    </span>
                @endif
            </div>

            <!-- BIO -->
            <p class="text-gray-600 flex-grow text-sm mb-4">
                {{ $provider->bio ?? 'No bio available.' }}
            </p>

            <!-- LOCATION -->
            <p class="text-xs text-gray-500 mb-3">
                📍 {{ $provider->location ?? 'Location not set' }}
            </p>

            <!-- BOOK BUTTON -->
            <form method="POST" action="{{ route('booking.store') }}">
                @csrf
                <input type="hidden" name="provider_id" value="{{ $provider->id }}">

                <button class="w-full bg-yellow-400 text-blue-800 px-4 py-2 rounded font-semibold hover:bg-yellow-300 hover:text-blue-900 transition">
                    Book Now
                </button>
            </form>

        </div>
        @empty
            <div class="col-span-3 text-center text-gray-600">
                No providers available right now.
            </div>
        @endforelse

    </div>

</div>
@endsection