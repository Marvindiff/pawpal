
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6">

    <h2 class="text-lg font-bold mb-3">📱 GCash Payment</h2>

    <p class="mb-3">Send payment to:</p>

    <div class="bg-gray-100 p-3 rounded mb-4">
        09123456789 (Ben Ten)
    </div>

    <!-- 🔥 FIXED FORM -->
    <form method="POST"
          action="{{ route('payment.gcash.upload', $booking->id) }}"
          enctype="multipart/form-data">
        @csrf

        <!-- FILE INPUT -->
        <input type="file" name="proof"
            class="w-full border p-2 rounded mb-3" required>

        <!-- BUTTON -->
        <button class="bg-green-500 text-white px-4 py-2 rounded w-full hover:bg-green-600">
            Submit Proof
        </button>

    </form>

    <p class="text-sm mt-3 text-gray-500 text-center">
        Admin will verify your payment.
    </p>

</div>
@endsection