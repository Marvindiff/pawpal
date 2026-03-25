@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <h1 class="text-3xl font-bold text-blue-700">Welcome, {{ Auth::user()->name }}!</h1>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('profile.edit') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Edit Profile
            </a>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400 transition ml-2">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Profile Card -->
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-2 text-blue-700">Profile Info</h2>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
            <p><strong>Service:</strong> {{ ucfirst(str_replace('_',' ', Auth::user()->service_type)) ?? 'N/A' }}</p>
            <p><strong>Availability:</strong>
                @if(Auth::user()->is_available)
                    <span class="text-green-600 font-bold">Available</span>
                @else
                    <span class="text-red-600 font-bold">Not Available</span>
                @endif
            </p>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Quick Actions</h2>

            <a href="{{ route('provider.bookings') }}" 
               class="block mb-3 bg-yellow-400 text-blue-800 px-4 py-2 rounded hover:bg-yellow-300 hover:text-blue-900 text-center transition">
                View Bookings
            </a>

            <a href="{{ route('provider.services') }}" 
               class="block mb-3 bg-green-400 text-white px-4 py-2 rounded hover:bg-green-300 text-center transition">
                Manage Services
            </a>

            <form method="POST" action="{{ route('provider.toggleAvailability') }}">
                @csrf
                <input type="hidden" name="is_available" value="{{ Auth::user()->is_available ? 0 : 1 }}">
                <button type="submit" 
                        class="block w-full bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    {{ Auth::user()->is_available ? 'Set Unavailable' : 'Set Available' }}
                </button>
            </form>
        </div>

        <!-- Contact & Stats -->
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Contact & Stats</h2>
            <p><strong>Total Bookings:</strong> {{ $bookings->count() ?? 0 }}</p>
            <p><strong>Average Rating:</strong> {{ Auth::user()->average_rating ?? 'N/A' }}</p>
            <p><strong>Contact:</strong> {{ Auth::user()->email ?? 'provider@example.com' }}</p>
        </div>

    </div>

    <!-- Recent Bookings -->
    <div class="mt-8 bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4 text-blue-700">Recent Bookings</h2>

        @forelse($bookings ?? [] as $booking)
            <div class="border-b py-2 flex justify-between items-center">
                <div>
                    <p><strong>Pet Owner:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Date:</strong> {{ $booking->date ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                </div>

                @if($booking->status == 'pending')
                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('booking.approve', $booking->id) }}">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('booking.reject', $booking->id) }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Reject
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No bookings yet.</p>
        @endforelse
    </div>

</div>
@endsection