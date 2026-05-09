@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4 text-blue-700">
        Sitter Verification Requests
    </h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sitters as $user)
                <tr class="border-t">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->role }}</td>

                    <td class="p-3 flex gap-2">
                        <form method="POST" action="{{ route('admin.approve', $user->id) }}">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.reject', $user->id) }}">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Reject
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center">
                        No pending requests
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection