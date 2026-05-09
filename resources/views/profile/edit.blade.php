@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">

    @php
        $user = auth()->user();
        $type = strtolower($user->service_type);
    @endphp

    <!-- 🔝 HEADER -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold text-blue-700">
                Profile Settings ⚙️
            </h1>

            <!-- ROLE BADGE -->
            <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold
                {{ $type === 'walker' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                
                {{ ucfirst($type) }}
            </span>
        </div>

        <!-- Back Button -->
        <a href="{{ $type === 'walker' 
                    ? route('walker.dashboard') 
                    : route('provider.dashboard') }}"
           class="mt-4 md:mt-0 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
            ← Back to Dashboard
        </a>
    </div>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- PROFILE FORM -->
        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- NAME -->
                <div class="mb-4">
                    <label class="text-gray-600">Name</label>
                    <input type="text" name="name"
                        value="{{ $user->name }}"
                        class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200">
                </div>

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="text-gray-600">Email</label>
                    <input type="email" name="email"
                        value="{{ $user->email }}"
                        class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200">
                </div>

                <!-- BIO -->
                <div class="mb-4">
                    <label class="text-gray-600">Bio</label>
                    <textarea name="bio" rows="3"
                        class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200">{{ $user->bio }}</textarea>
                </div>

                <!-- LOCATION -->
                <div class="mb-6">
                    <label class="text-gray-600">Location</label>
                    <input type="text" name="location"
                        value="{{ $user->location }}"
                        class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200">
                </div>
@if(auth()->user()->role === 'provider')
<div class="mt-4">
    <label>Price per Walk (₱)</label>
    <input type="number" name="price"
        value="{{ old('price', auth()->user()->price) }}"
        class="w-full p-3 border rounded-lg"
        placeholder="Enter your price">
</div>
@endif
                <!-- SAVE -->
                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Save Changes 💾
                    </button>
                </div>

            </form>
        </div>

        <!-- SIDE PANEL -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-lg font-bold mb-4">Account Info</h2>

            <!-- STATUS -->
            <p class="mb-2">
                <strong>Status:</strong>
                @if($user->is_available)
                    <span class="text-green-600 font-bold">Available 🟢</span>
                @else
                    <span class="text-red-600 font-bold">Offline 🔴</span>
                @endif
            </p>

            <!-- ROLE -->
            <p class="mb-2">
                <strong>Service Type:</strong>
                {{ ucfirst($type) }}
            </p>

            <!-- EMAIL -->
            <p class="mb-4">
                <strong>Email:</strong>
                {{ $user->email }}
            </p>

            <!-- ROLE BASED INFO -->
            @if($type === 'walker')
                <div class="bg-green-50 p-3 rounded text-sm text-green-700">
                    🚶 You handle dog walking schedules and activities.
                </div>
            @else
                <div class="bg-blue-50 p-3 rounded text-sm text-blue-700">
                    🏠 You provide pet sitting and care services.
                </div>
            @endif

        </div>

    </div>

</div>
@endsection