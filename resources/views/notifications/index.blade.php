@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

<h1 class="text-xl font-bold mb-4">🔔 Notifications</h1>

@foreach($notifications as $note)
<div class="p-3 mb-2 rounded shadow 
    {{ $note->is_read ? 'bg-gray-100' : 'bg-yellow-100' }}">

    <p class="font-bold">{{ $note->title }}</p>
    <p>{{ $note->message }}</p>

</div>
@endforeach

</div>
@endsection