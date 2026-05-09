@extends('layouts.app')

@section('content')
<div class="p-6 max-w-md mx-auto bg-white rounded shadow">

    <h2 class="text-xl font-bold mb-4">⭐ Rate Walker</h2>

    <form method="POST" action="{{ route('review.store') }}">
        @csrf

        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="provider_id" value="{{ $booking->provider_id }}">

        <label>Rating</label>
        <select name="rating" class="w-full border p-2 rounded mb-3">
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
        </select>

        <label>Comment</label>
        <textarea name="comment" class="w-full border p-2 rounded mb-3"></textarea>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Submit Review
        </button>

    </form>

</div>
@endsection