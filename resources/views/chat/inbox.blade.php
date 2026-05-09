@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 p-6">

   <a href="{{ route('provider.dashboard') }}"
   class="inline-flex items-center gap-2 mb-4 px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-200 rounded-lg shadow-sm hover:bg-indigo-50 transition">

    ← Back to Dashboard
</a>

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-indigo-700">
            💬 Messages
        </h1>

        <span class="text-sm text-gray-500">
            {{ count($conversations) }} conversations
        </span>
    </div>

    <!-- CHAT LIST -->
    <div class="bg-white/80 backdrop-blur border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        @forelse($conversations as $userId => $msgs)

            @php
                $last = $msgs->first();
                $user = \App\Models\User::find($userId);
            @endphp

            <a href="{{ route('chat.index', $userId) }}"
               class="flex items-center gap-4 p-4 hover:bg-indigo-50 transition group">

                <!-- AVATAR -->
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}"
                         class="w-12 h-12 rounded-full border shadow-sm">

                    <!-- 🟢 ONLINE DOT (optional look) -->
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                </div>

                <!-- INFO -->
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center">

                        <p class="font-semibold text-gray-800 truncate">
                            {{ $user->name ?? 'User' }}
                        </p>

                        <span class="text-xs text-gray-400 whitespace-nowrap">
                            {{ $last->created_at->diffForHumans() }}
                        </span>

                    </div>

                    <p class="text-sm text-gray-500 truncate group-hover:text-gray-700">
                        {{ $last->message }}
                    </p>
                </div>

            </a>

        @empty
            <div class="p-10 text-center text-gray-500">
                💬 No conversations yet.
            </div>
        @endforelse

    </div>

</div>

@endsection