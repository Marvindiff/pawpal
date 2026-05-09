@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-xl font-bold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf

        <!-- NAME -->
        <label class="block text-sm mb-1">Name</label>
        <input type="text" name="name" value="{{ $user->name }}"
               class="w-full p-2 border rounded mb-3">

        <!-- EMAIL -->
        <label class="block text-sm mb-1">Email</label>
        <input type="email" name="email" value="{{ $user->email }}"
               class="w-full p-2 border rounded mb-3">

        <!-- 🔥 PENALTY CONTROL -->
        <label class="block text-sm mb-1">Penalty Count</label>

        <select name="penalty" class="w-full p-2 border rounded mb-3">
            <option value="0" {{ $user->penalty == 0 ? 'selected' : '' }}>0 - No penalty</option>
            <option value="1" {{ $user->penalty == 1 ? 'selected' : '' }}>1 - Warning</option>
            <option value="2" {{ $user->penalty == 2 ? 'selected' : '' }}>2 - Final Warning</option>
            <option value="3" {{ $user->penalty >= 3 ? 'selected' : '' }}>3 - Ban</option>
        </select>

        <!-- CURRENT STATUS -->
        <p class="text-sm mb-4">
            Status:
            <span class="
                {{ $user->status === 'banned' ? 'text-red-500' : 'text-green-600' }}">
                {{ ucfirst($user->status) }}
            </span>
        </p>

        <!-- SAVE -->
        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Save Changes
        </button>

    </form>

</div>

@endsection