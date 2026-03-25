@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-blue-700 mb-6">Find Pet Sitters & Walkers</h1>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('home') }}" class="mb-8 flex flex-col md:flex-row gap-4 items-center">
        <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}"
            class="w-full md:w-1/2 px-4 py-2 rounded border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <select name="service_type"
            class="w-full md:w-1/4 px-4 py-2 rounded border border-blue-200 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <option value="">All Services</option>
            <option value="pet_sitting" {{ request('service_type')=='pet_sitting' ? 'selected' : '' }}>Pet Sitting</option>
            <option value="dog_walking" {{ request('service_type')=='dog_walking' ? 'selected' : '' }}>Dog Walking</option>
        </select>
        <button type="submit"
            class="bg-yellow-400 text-blue-800 px-6 py-2 rounded font-semibold hover:bg-yellow-300 hover:text-blue-900 transition">
            Search
        </button>
    </form>

    <!-- Providers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($providers as $provider)
        <div class="bg-white rounded shadow p-4 flex flex-col">
            <div class="flex items-center mb-3">
                <img src="{{ $provider->avatar ?? 'https://via.placeholder.com/80' }}" alt="Avatar"
                    class="rounded-full w-16 h-16 mr-3">
                <div>
                    <h2 class="text-xl font-semibold text-blue-700">{{ $provider->name }}</h2>
                    <p class="text-blue-500">{{ ucfirst(str_replace('_', ' ', $provider->service_type)) }}</p>
                </div>
                @if($provider->is_available)
                <span class="ml-auto bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Available Now</span>
                @endif
            </div>
            <p class="text-gray-600 flex-grow">{{ $provider->bio ?? 'No bio available.' }}</p>
        </div>
        @empty
        <p class="text-gray-500">No providers found.</p>
        @endforelse
    </div>
</div>
@endsection