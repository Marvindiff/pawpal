@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">

    <!-- HEADER -->
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        💳 Choose Payment Method
    </h1>

    @php
        $user = auth()->user();
        $balance = (float) ($user->wallet_balance ?? 0);

        // ✅ FIX: fallback to price if amount is null
        $amount = (float) ($booking->amount ?? $booking->price ?? 0);
    @endphp

    <!-- SUCCESS / ERROR -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payment.process', $booking->id) }}" method="POST">
    @csrf

    <!-- WALLET OPTION -->
    <label class="block border p-4 rounded-lg mb-4 cursor-pointer hover:border-green-500 transition">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <input type="radio"
                       name="payment_method"
                       value="wallet"
                       {{ $balance < $amount ? 'disabled' : '' }}
                       required>

                <div>
                    <p class="font-semibold">💰 Wallet</p>
                    <p class="text-sm text-gray-500">
                        Balance: ₱{{ number_format($balance, 2) }}
                    </p>
                </div>
            </div>

            @if($balance >= $amount && $amount > 0)
                <span class="text-green-600 text-sm font-semibold">✔ Available</span>
            @else
                <span class="text-red-500 text-sm font-semibold">✖ Not enough</span>
            @endif
        </div>
    </label>

    <!-- GCASH OPTION -->
    <label class="block border p-4 rounded-lg mb-4 cursor-pointer hover:border-blue-500 transition">
        <div class="flex items-center gap-3">
            <input type="radio" name="payment_method" value="gcash">
            <div>
                <p class="font-semibold">📱 GCash</p>
                <p class="text-sm text-gray-500">
                    Manual payment (upload proof)
                </p>
            </div>
        </div>
    </label>

    <!-- BUTTON -->
    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full transition font-semibold">
        Proceed Payment
    </button>

    </form>

    <!-- BOOKING INFO -->
    <div class="mt-6 text-sm text-gray-600 text-center font-medium">
        Booking Amount: ₱{{ number_format($amount, 2) }}
    </div>

</div>
@endsection