@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- 🔙 BACK -->
    <a href="{{ route('admin.dashboard') }}"
       class="inline-flex items-center gap-2 mb-4 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
        Back to Dashboard
    </a>

    <!-- 🧑‍💼 TITLE -->
    <h1 class="text-2xl font-bold mb-6 text-indigo-700">
        👥 Manage Users
    </h1>

    <!-- SUCCESS -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl p-4">

        <table class="w-full text-left">

            <!-- HEADER -->
            <thead class="border-b text-gray-600">
                <tr>
                    <th class="p-3">Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Penalty</th> <!-- 🔥 ADDED -->
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>

                @forelse($users as $user)
                <tr class="border-b hover:bg-gray-50 transition">

                    <!-- NAME -->
                    <td class="p-3 font-medium">
                        {{ $user->name }}
                    </td>

                    <!-- EMAIL -->
                    <td>
                        {{ $user->email }}
                    </td>

                    <!-- ROLE -->
                    <td class="capitalize">
                        {{ $user->role }}
                    </td>

                    <!-- STATUS -->
                    <td>
                        @if($user->role === 'admin')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                                Admin
                            </span>

                        @elseif($user->status === 'approved')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                                Approved
                            </span>

                        @elseif($user->status === 'banned')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
                                Banned
                            </span>

                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">
                                Pending
                            </span>
                        @endif
                    </td>

                    <!-- 🔥 PENALTY COLUMN -->
                    <td>
                        @if($user->penalty == 0)
                            <span class="text-gray-500 text-xs">0</span>
                        @elseif($user->penalty == 1)
                            <span class="text-yellow-600 text-xs font-semibold">⚠ 1</span>
                        @elseif($user->penalty == 2)
                            <span class="text-orange-600 text-xs font-semibold">⚠⚠ 2</span>
                        @else
                            <span class="text-red-600 text-xs font-semibold">🚫 3+</span>
                        @endif
                    </td>

                    <!-- ACTIONS -->
                    <td class="text-center">
                        <div class="flex justify-center gap-2">

                            @if($user->id !== auth()->id())

                                {{-- 🚫 BAN --}}
                                @if($user->status !== 'banned' && $user->role !== 'admin')
                                    <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                                        @csrf
                                        <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                            Ban
                                        </button>
                                    </form>
                                @endif

                                {{-- 🔓 UNBAN --}}
                                @if($user->status === 'banned')
                                    <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                                        @csrf
                                        <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                            Unban
                                        </button>
                                    </form>
                                @endif

                                {{-- ✏ EDIT --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">
                                    Edit
                                </a>

                                {{-- 🗑 DELETE --}}
                                @if($user->role !== 'admin')
                                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-gray-700 text-white px-3 py-1 rounded text-xs hover:bg-gray-800">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            @else
                                <span class="text-gray-400 text-xs italic">
                                    You
                                </span>
                            @endif

                        </div>
                    </td>

                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection