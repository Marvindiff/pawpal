@foreach($bookings as $booking)

<div class="bg-white p-4 rounded shadow mb-4 flex justify-between items-center">

    <div>
        <p class="font-bold">👤 {{ $booking->provider->name ?? 'walking' }}</p>
        <p class="text-sm text-gray-500">📅 {{ $booking->date }} {{ $booking->time }}</p>
    </div>

    <div class="text-right">
        <p class="text-blue-600 font-bold">₱{{ $booking->price }}</p>
@if($booking->payment_status == 'refunded')
    <span class="text-blue-600 font-bold">💸 Refunded</span>
@endif
        @if(strtolower($booking->status) === 'paid')
            <span class="bg-green-200 text-green-700 px-2 py-1 rounded text-xs">
                Paid
            </span>
        @else
            <span class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded text-xs">
                Pending
            </span>

           
        @endif

    </div>

</div>

@endforeach