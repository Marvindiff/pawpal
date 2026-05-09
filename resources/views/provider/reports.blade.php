@extends('layouts.app')

@section('content')

<div class="p-6 max-w-5xl mx-auto">

    <!-- 🔙 BACK BUTTON -->
    <a href="{{ route('provider.dashboard') }}"
       class="inline-flex items-center gap-2 mb-4 px-4 py-2 text-sm font-medium 
              text-indigo-600 bg-white border border-indigo-200 rounded-lg shadow-sm 
              hover:bg-indigo-50 transition">
        ← Back to Dashboard
    </a>

    <h1 class="text-2xl font-bold mb-6 text-red-600">
        🚨 Reports About You
    </h1>

    @forelse($reports as $report)

    <div class="bg-white p-4 rounded-xl shadow mb-4 border-l-4 border-red-400">

        <p class="text-sm text-gray-500">
            Reported by User ID: {{ $report->user_id }}
        </p>

        <p class="mt-2 text-gray-800">
            <strong>Reason:</strong> {{ $report->reason }}
        </p>

        <p class="text-xs mt-2">
            Status:
            @if($report->status == 'pending')
                <span class="text-yellow-500">⏳ Pending</span>
            @else
                <span class="text-green-600">✅ Resolved</span>
            @endif
        </p>

    </div>

    @empty
        <p class="text-gray-500">No reports about you 🎉</p>
    @endforelse

</div>

@endsection