@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">Manage Services</h1>

    <!-- Add Service Form -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-3">Add New Service</h2>
        <form method="POST" action="{{ route('provider.services.store') }}" class="flex gap-4 flex-wrap">
            @csrf
            <input type="text" name="name" placeholder="Service Name" class="border p-2 rounded w-1/3">
            <input type="number" name="price" placeholder="Price" class="border p-2 rounded w-1/6">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Add Service
            </button>
        </form>
    </div>

    <!-- Existing Services -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-3">Your Services</h2>
        @forelse($services as $service)
            <div class="flex justify-between items-center border-b py-2">
                <div>
                    <p><strong>{{ $service->name }}</strong> - ${{ number_format($service->price, 2) }}</p>
                </div>
                <form method="POST" action="{{ route('provider.services.destroy', $service->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-600">No services yet.</p>
        @endforelse
    </div>
</div>
@endsection