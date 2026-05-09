@extends('layouts.app')

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

                    @if($booking->status == 'pending') bg-yellow-100 text-yellow-600
                    @elseif($booking->status == 'approved') bg-green-100 text-green-600
                    @elseif($booking->status == 'completed') bg-blue-100 text-blue-600
                    @elseif($booking->status == 'paid') bg-purple-100 text-purple-600
                    @else bg-red-100 text-red-600
                    @endif">

                    {{ ucfirst(str_replace('_',' ', $booking->status)) }}

                </span>
            </div>

        </div>

        <!-- ⭐ RATE BUTTON (FIXED) -->
        @if($booking->status == 'completed' || $booking->status == 'paid')
            <div class="mt-6 text-center">
                <a href="{{ route('review.create', $booking->id) }}"
                   class="inline-block bg-yellow-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition shadow">
                    ⭐ Rate Walker
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