@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-red-950 to-black text-white p-6">

    <div class="max-w-7xl mx-auto">

        <!-- 🔝 HEADER -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-5 mb-10">

            <!-- LEFT -->
            <div>

                <h1 class="text-5xl font-bold text-red-400">
                    🚨 Reports Management
                </h1>

                <p class="text-gray-400 mt-3 text-lg">
                    Manage user and provider reports
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-wrap gap-3">

                <!-- BACK -->
                <a href="{{ route('admin.dashboard') }}"
                   class="bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-3 rounded-2xl transition font-semibold shadow-xl">

                    ← Dashboard

                </a>

                <!-- REFRESH -->
                <button onclick="location.reload()"
                    class="bg-red-500 hover:bg-red-600 px-5 py-3 rounded-2xl font-semibold transition shadow-xl">

                    🔄 Refresh

                </button>

            </div>

        </div>

        <!-- 📊 STATS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

            <!-- TOTAL -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl">

                <p class="text-gray-400 text-sm">
                    Total Reports
                </p>

                <h2 class="text-4xl font-bold mt-2 text-red-400">
                    {{ $reports->total() }}
                </h2>

            </div>

            <!-- PENDING -->
            <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-yellow-300 text-sm">
                    Pending
                </p>

                <h2 class="text-4xl font-bold mt-2 text-yellow-400">
                    {{ $reports->where('status', 'pending')->count() }}
                </h2>

            </div>

            <!-- INVESTIGATING -->
            <div class="bg-blue-500/10 border border-blue-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-blue-300 text-sm">
                    Investigating
                </p>

                <h2 class="text-4xl font-bold mt-2 text-blue-400">
                    {{ $reports->where('status', 'investigating')->count() }}
                </h2>

            </div>

            <!-- HIGH -->
            <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-red-300 text-sm">
                    High Severity
                </p>

                <h2 class="text-4xl font-bold mt-2 text-red-400">
                    {{ $reports->where('severity', 'high')->count() }}
                </h2>

            </div>

        </div>

        <!-- 🔍 SEARCH -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-5 mb-8 shadow-xl">

            <div class="flex flex-col lg:flex-row gap-4">

                <!-- SEARCH -->
                <input type="text"
                       id="searchInput"
                       placeholder="Search reporter, reported, reason..."

                       class="flex-1 bg-black/20 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-red-400">

                <!-- FILTER -->
                <div class="flex flex-wrap gap-3">

                    <a href="?status=all"
                       class="bg-gray-600 hover:bg-gray-700 px-5 py-3 rounded-2xl font-semibold transition">

                        All

                    </a>

                    <a href="?status=pending"
                       class="bg-yellow-500 hover:bg-yellow-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Pending

                    </a>

                    <a href="?status=investigating"
                       class="bg-blue-500 hover:bg-blue-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Investigating

                    </a>

                    <a href="?status=resolved"
                       class="bg-green-500 hover:bg-green-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Resolved

                    </a>

                </div>

            </div>

        </div>

        <!-- REPORTS -->
        <div class="space-y-8">

            @forelse($reports as $report)

            <div class="report-card bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden"

                 data-search="
                    {{ strtolower($report->reporter->name ?? '') }}
                    {{ strtolower($report->reported->name ?? '') }}
                    {{ strtolower($report->reason ?? '') }}
                    {{ strtolower($report->description ?? '') }}
                 ">

                <div class="p-8">

                    <!-- TOP -->
                    <div class="flex flex-col xl:flex-row gap-8">

                        <!-- LEFT -->
                        <div class="flex-1">

                            <!-- USERS -->
                            <div class="grid md:grid-cols-2 gap-5">

                                <!-- REPORTER -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-6">

                                    <p class="text-gray-400 text-sm mb-3">
                                        Reporter
                                    </p>

                                    <div class="flex items-center gap-4">

                                        <div class="w-16 h-16 rounded-2xl bg-indigo-500 flex items-center justify-center text-2xl font-bold">

                                            {{ strtoupper(substr($report->reporter->name ?? 'R',0,1)) }}

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-bold">

                                                {{ $report->reporter->name ?? 'Unknown' }}

                                            </h3>

                                            <p class="text-gray-400 text-sm">
                                                User ID:
                                                {{ $report->user_id }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <!-- REPORTED -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-6">

                                    <p class="text-gray-400 text-sm mb-3">
                                        Reported User
                                    </p>

                                    <div class="flex items-center gap-4">

                                        <div class="w-16 h-16 rounded-2xl bg-red-500 flex items-center justify-center text-2xl font-bold">

                                            {{ strtoupper(substr($report->reported->name ?? 'U',0,1)) }}

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-bold text-red-300">

                                                {{ $report->reported->name ?? 'Unknown' }}

                                            </h3>

                                            <p class="text-gray-400 text-sm">
                                                Reported ID:
                                                {{ $report->reported_id }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- REASON -->
                            <div class="mt-6 bg-black/20 border border-white/10 rounded-3xl p-6">

                                <p class="text-gray-400 text-sm mb-3">
                                    Report Reason
                                </p>

                                <h3 class="text-2xl font-bold text-red-300">

                                    {{ $report->reason }}

                                </h3>

                            </div>

                            <!-- DESCRIPTION -->
                            <div class="mt-6 bg-black/20 border border-white/10 rounded-3xl p-6">

                                <p class="text-gray-400 text-sm mb-3">
                                    Description
                                </p>

                                <p class="text-lg leading-relaxed text-gray-200">

                                    {{ $report->description }}

                                </p>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="xl:w-[340px] space-y-5">

                            <!-- SEVERITY -->
                            <div class="bg-black/20 border border-white/10 rounded-3xl p-6">

                                <p class="text-gray-400 text-sm mb-3">
                                    Severity Level
                                </p>

                                @if($report->severity == 'high')

                                    <span class="bg-red-500/20 text-red-300 px-5 py-3 rounded-full text-sm font-bold">

                                        🔥 HIGH

                                    </span>

                                @elseif($report->severity == 'medium')

                                    <span class="bg-yellow-500/20 text-yellow-300 px-5 py-3 rounded-full text-sm font-bold">

                                        ⚠ MEDIUM

                                    </span>

                                @else

                                    <span class="bg-green-500/20 text-green-300 px-5 py-3 rounded-full text-sm font-bold">

                                        ✅ LOW

                                    </span>

                                @endif

                            </div>

                            <!-- STATUS -->
                            <div class="bg-black/20 border border-white/10 rounded-3xl p-6">

                                <p class="text-gray-400 text-sm mb-3">
                                    Current Status
                                </p>

                                @if($report->status == 'pending')

                                    <span class="bg-yellow-500/20 text-yellow-300 px-5 py-3 rounded-full text-sm font-bold">

                                        ⏳ Pending

                                    </span>

                                @elseif($report->status == 'investigating')

                                    <span class="bg-blue-500/20 text-blue-300 px-5 py-3 rounded-full text-sm font-bold">

                                        🔎 Investigating

                                    </span>

                                @else

                                    <span class="bg-green-500/20 text-green-300 px-5 py-3 rounded-full text-sm font-bold">

                                        ✅ Resolved

                                    </span>

                                @endif

                            </div>

                            <!-- WARNING -->
                            @if($report->severity == 'high')

                            <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6">

                                <div class="text-5xl mb-4 text-center">
                                    ⚠️
                                </div>

                                <h3 class="text-xl font-bold text-red-300 text-center">
                                    Requires Immediate Attention
                                </h3>

                                <p class="text-gray-300 text-center mt-3">

                                    This report is marked as high severity.

                                </p>

                            </div>

                            @endif

                        </div>

                    </div>

                    <!-- UPDATE FORM -->
                    <form action="{{ route('admin.reports.update',$report->id) }}"
                          method="POST"

                          class="mt-8 bg-black/20 border border-white/10 rounded-[2rem] p-6">

                        @csrf

                        <h3 class="text-2xl font-bold mb-6">
                            🛠 Update Report
                        </h3>

                        <div class="grid lg:grid-cols-3 gap-5">

                            <!-- STATUS -->
                            <div>

                                <label class="block text-gray-300 text-sm mb-2">
                                    Status
                                </label>

                                <select name="status"

                                    class="w-full bg-black/30 border border-white/10 text-white px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-red-400">

                                    <option value="pending"
                                        {{ $report->status=='pending' ? 'selected' : '' }}>

                                        Pending

                                    </option>

                                    <option value="investigating"
                                        {{ $report->status=='investigating' ? 'selected' : '' }}>

                                        Investigating

                                    </option>

                                    <option value="resolved"
                                        {{ $report->status=='resolved' ? 'selected' : '' }}>

                                        Resolved

                                    </option>

                                </select>

                            </div>

                            <!-- SEVERITY -->
                            <div>

                                <label class="block text-gray-300 text-sm mb-2">
                                    Severity
                                </label>

                                <select name="severity"

                                    class="w-full bg-black/30 border border-white/10 text-white px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-red-400">

                                    <option value="low"
                                        {{ $report->severity=='low' ? 'selected' : '' }}>

                                        Low

                                    </option>

                                    <option value="medium"
                                        {{ $report->severity=='medium' ? 'selected' : '' }}>

                                        Medium

                                    </option>

                                    <option value="high"
                                        {{ $report->severity=='high' ? 'selected' : '' }}>

                                        High

                                    </option>

                                </select>

                            </div>

                            <!-- BUTTON -->
                            <div class="flex items-end">

                                <button
                                    class="w-full bg-red-500 hover:bg-red-600 py-4 rounded-2xl font-bold text-lg transition shadow-2xl">

                                    💾 Update Report

                                </button>

                            </div>

                        </div>

                        <!-- NOTE -->
                        <div class="mt-5">

                            <label class="block text-gray-300 text-sm mb-2">
                                Admin Notes
                            </label>

                            <textarea name="admin_note"
                                rows="5"
                                placeholder="Write admin notes..."

                                class="w-full bg-black/30 border border-white/10 text-white placeholder-gray-500 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-red-400">{{ $report->admin_note }}</textarea>

                        </div>

                    </form>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] p-20 text-center shadow-2xl">

                <div class="text-8xl mb-6">
                    🎉
                </div>

                <h2 class="text-4xl font-bold mb-3">
                    No Reports Found
                </h2>

                <p class="text-gray-400 text-lg">
                    Everything looks clean right now.
                </p>

            </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-10">

            {{ $reports->links() }}

        </div>

    </div>

</div>

<!-- 🔍 SEARCH -->
<script>

document.getElementById('searchInput')
.addEventListener('keyup', function() {

    const value = this.value.toLowerCase();

    document.querySelectorAll('.report-card')
    .forEach(card => {

        const searchable =
            card.dataset.search;

        if (searchable.includes(value)) {

            card.style.display = 'block';

        } else {

            card.style.display = 'none';

        }

    });

});

</script>

<!-- 🔄 AUTO REFRESH -->
<script>

setInterval(() => {

    location.reload();

}, 30000);

</script>

@endsection