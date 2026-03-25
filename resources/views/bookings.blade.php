@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-blue-700 mb-6">Your Bookings</h1>

@if(count($bookings) > 0)
    <div class="bg-white shadow rounded p-4">
        @foreach($bookings as $booking)
            <div class="border-b last:border-b-0 p-2">
                <p><strong>Provider:</strong> {{ $booking->provider->name ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $booking->date ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $booking->status ?? 'Pending' }}</p>
            </div>
        @endforeach
    </div>
@else
    <p class="text-gray-600">You have no bookings yet.</p>
@endif
@endsection