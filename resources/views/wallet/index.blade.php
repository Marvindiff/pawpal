@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-md">

        <h2 class="text-xl font-bold mb-4">Add Funds</h2>

        <form method="POST" action="{{ route('wallet.add', auth()->id()) }}">
            @csrf

            <input type="number" name="amount" placeholder="Enter amount"
                class="w-full mb-3 p-3 border rounded-lg" required>

            <button class="w-full bg-green-600 text-white py-2 rounded-lg">
                Add Funds
            </button>
        </form>

    </div>
</div>
@endsection