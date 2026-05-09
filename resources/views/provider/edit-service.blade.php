@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6 flex justify-center">

    <div class="bg-white/90 backdrop-blur border border-gray-200 p-6 rounded-2xl shadow-sm w-full max-w-lg">

        <!-- 🔙 BACK -->
        <a href="{{ route('provider.services') }}"
           class="inline-block mb-4 text-sm text-indigo-600 hover:underline">
            ← Back to Services
        </a>

        <!-- HEADER -->
        <h2 class="text-xl font-bold text-indigo-700 mb-1">
            ✏️ Edit Service
        </h2>

        <p class="text-gray-500 mb-4">
            You are editing: <strong>{{ $service->title }}</strong>
        </p>

        <!-- FORM -->
        <form method="POST" action="{{ route('provider.services.update', $service->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- SERVICE NAME -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Service Name
                </label>
                <input type="text" name="title" value="{{ $service->title }}"
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description"
                          class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none">{{ $service->description }}</textarea>
            </div>

            <!-- PRICE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Price (₱)
                </label>
                <input type="number" name="price" value="{{ $service->price }}"
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none">
            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 rounded-lg font-semibold hover:opacity-90 transition">
                💾 Update Service
            </button>

        </form>

    </div>

</div>

@endsection