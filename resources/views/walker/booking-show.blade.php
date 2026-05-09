@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-6">

        <!-- 🧾 TITLE -->
        <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">
            🧾 Booking Receipt
        </h2>

        <!-- 📋 DETAILS -->
        <div class="space-y-3 text-sm text-gray-600">

            <div class="flex justify-between">
                <span>Customer:</span>
                <span class="font-medium text-gray-800">
                    {{ $booking->user->name ?? 'N/A' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Provider:</span>
                <span class="font-medium text-gray-800">
                    {{ $booking->provider->name ?? 'N/A' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Service:</span>
                <span class="font-medium text-gray-800">
                    {{ $booking->service_type ?? 'Pet Service' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Schedule:</span>
                <span class="font-medium text-gray-800">
                    {{ $booking->schedule }}
                </span>
            </div>

        </div>

        <!-- 🔻 DIVIDER -->
        <hr class="my-4">

        <!-- 💰 TOTAL -->
        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-700 font-medium">Total:</span>
            <span class="text-lg font-bold text-indigo-600">
                ₱{{ number_format($booking->total_price ?? $booking->price ?? 0, 2) }}
            </span>
        </div>

        <!-- 📊 STATUS + PAYMENT -->
        <div class="flex justify-center gap-2 flex-wrap">

            <!-- BOOKING STATUS -->
            <span class="px-3 py-1 text-xs rounded-full font-semibold
                @if($booking->status == 'completed') bg-green-100 text-green-700
                @elseif($booking->status == 'approved') bg-blue-100 text-blue-700
                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-700
                @elseif($booking->status == 'rejected') bg-red-100 text-red-700
                @else bg-gray-100 text-gray-700
                @endif">
                {{ ucfirst($booking->status) }}
            </span>

            <!-- 💳 PAYMENT STATUS -->
            @if($booking->payment_status == 'paid')
                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">
                    💳 Paid via {{ ucfirst($booking->payment_method ?? 'N/A') }}
                </span>

            @elseif($booking->payment_status == 'pending')
                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                    ⏳ Waiting for Payment ({{ ucfirst($booking->payment_method ?? 'N/A') }})
                </span>

            @elseif($booking->payment_status == 'refunded')
                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                    💸 Refunded
                </span>
            @endif

        </div>

        <!-- 🔙 BACK BUTTON -->
        <div class="mt-6 text-center">
            <a href="/walker/schedule" class="text-sm text-indigo-500 hover:underline">
                ← Back to Schedule
            </a>
        </div>

    </div>

</div>
@endsection