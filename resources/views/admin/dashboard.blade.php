@extends('layouts.app')

@section('content')

<div id="dashboard"
class="min-h-screen transition-all duration-500 bg-gradient-to-br from-slate-100 via-indigo-100 to-purple-100 dark:bg-gradient-to-br dark:from-slate-950 dark:via-indigo-950 dark:to-black text-gray-800 dark:text-white">

<div class="max-w-7xl mx-auto p-6">

    <!-- 🔝 TOP BAR -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-5 mb-10">

        <!-- LEFT -->
        <div>

            <h1 class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Admin Dashboard
            </h1>

            <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">
                Welcome back,
                {{ auth()->user()->name }} 👋
            </p>

        </div>

        <!-- RIGHT -->
        <div class="flex flex-wrap gap-3 items-center">

            <!-- CLOCK -->
            <div class="glass px-5 py-3 rounded-2xl shadow-xl">
                <p id="clock"
                   class="font-bold text-lg"></p>
            </div>

            <!-- DARK MODE -->
            <button id="darkToggle"
                onclick="toggleDarkMode()"

                class="bg-indigo-500 hover:bg-indigo-600 px-5 py-3 rounded-2xl text-white font-semibold shadow-xl transition">

                🌙 Dark Mode

            </button>

        </div>

    </div>

    <!-- 📊 STATS -->
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- USERS -->
        <div class="stat-card">

            <div class="flex justify-between items-start">

                <div>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total Users
                    </p>

                    <h2 class="text-5xl font-black mt-3">
                        {{ $totalUsers }}
                    </h2>

                </div>

                <div class="icon-box bg-blue-500">
                    👥
                </div>

            </div>

        </div>

        <!-- PROVIDERS -->
        <div class="stat-card">

            <div class="flex justify-between items-start">

                <div>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Providers
                    </p>

                    <h2 class="text-5xl font-black mt-3">
                        {{ $totalProviders }}
                    </h2>

                </div>

                <div class="icon-box bg-purple-500">
                    🐾
                </div>

            </div>

        </div>

        <!-- PENDING -->
        <div class="stat-card yellow-card">

            <div class="flex justify-between items-start">

                <div>

                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        Pending Providers
                    </p>

                    <h2 class="text-5xl font-black mt-3">
                        {{ $pendingProviders }}
                    </h2>

                </div>

                <div class="icon-box bg-yellow-500">
                    ⏳
                </div>

            </div>

        </div>

        <!-- APPROVED -->
        <div class="stat-card green-card">

            <div class="flex justify-between items-start">

                <div>

                    <p class="text-sm text-green-700 dark:text-green-300">
                        Approved Providers
                    </p>

                    <h2 class="text-5xl font-black mt-3">
                        {{ $approvedProviders }}
                    </h2>

                </div>

                <div class="icon-box bg-green-500">
                    ✅
                </div>

            </div>

        </div>

    </div>

    <!-- ⚡ QUICK ACTIONS -->
    <div class="glass p-8 rounded-[2rem] shadow-2xl mb-10">

        <div class="flex justify-between items-center mb-8">

            <h2 class="text-3xl font-bold">
                ⚡ Quick Actions
            </h2>

            <span class="text-sm text-gray-500 dark:text-gray-400">
                Manage your platform
            </span>

        </div>

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- 📩 MESSAGES -->
@php
    $unreadMessages =
    \App\Models\ContactMessage::where('is_replied', false)->count();
@endphp

<a href="{{ route('admin.messages') }}"
   class="relative p-5 rounded-2xl bg-gradient-to-r from-indigo-500 to-indigo-700 text-white shadow-xl hover:scale-105 hover:shadow-2xl transition duration-300 overflow-hidden">

    <!-- 🔔 BADGE -->
    @if($unreadMessages > 0)

    <span class="absolute top-3 right-3 bg-white text-indigo-700 text-xs font-bold px-2 py-1 rounded-full animate-pulse shadow">

        {{ $unreadMessages }}

    </span>

    @endif

    <!-- ICON -->
    <div class="text-5xl mb-4">
        📩
    </div>

    <!-- TEXT -->
    <p class="text-sm opacity-80">
        Inbox
    </p>

    <h3 class="text-2xl font-bold mt-1">
        View Messages
    </h3>

    <p class="text-sm opacity-80 mt-2">
        Customer support & replies
    </p>

</a>
            <!-- PAYMENTS -->
            @php
                $pendingPayments =
                \App\Models\Booking::where('payment_status', 'pending')->count();
            @endphp

            <a href="{{ route('admin.payments') }}"
               class="quick-card group">

                @if($pendingPayments > 0)

                <span class="badge bg-green-500">

                    {{ $pendingPayments }}

                </span>

                @endif

                <div class="text-5xl mb-5">
                    💳
                </div>

                <h3 class="text-2xl font-bold">
                    Payments
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Verify GCash transactions
                </p>

            </a>

            <!-- PROVIDERS -->
            <a href="{{ route('admin.providers.pending') }}"
               class="quick-card group">

                @if($pendingProviders > 0)

                <span class="badge bg-yellow-500">

                    {{ $pendingProviders }}

                </span>

                @endif

                <div class="text-5xl mb-5">
                    🐾
                </div>

                <h3 class="text-2xl font-bold">
                    Providers
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Approve providers
                </p>

            </a>

            <!-- USERS -->
            <a href="{{ route('admin.users') }}"
               class="quick-card group">

                <div class="text-5xl mb-5">
                    👥
                </div>

                <h3 class="text-2xl font-bold">
                    Users
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Manage accounts
                </p>

            </a>

            <!-- REPORTS -->
            @php
                $pendingReports =
                \App\Models\Report::where('status','pending')->count();

                $totalReports =
                \App\Models\Report::count();
            @endphp

            <a href="{{ route('admin.reports') }}"
               class="quick-card group">

                @if($pendingReports > 0)

                <span class="badge bg-red-500">

                    {{ $pendingReports }}

                </span>

                @endif

                <div class="text-5xl mb-5">
                    🚨
                </div>

                <h3 class="text-2xl font-bold">
                    Reports
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Moderate reports
                </p>

            </a>

        </div>

    </div>

    <!-- 📈 LOWER GRID -->
    <div class="grid xl:grid-cols-3 gap-8">

        <!-- ⭐ TOP PROVIDERS -->
        <div class="glass rounded-[2rem] p-8 shadow-2xl xl:col-span-2">

            <div class="flex justify-between items-center mb-8">

                <h2 class="text-3xl font-bold">
                    ⭐ Top Rated Providers
                </h2>

                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Highest ratings
                </span>

            </div>

            <div class="grid md:grid-cols-2 gap-5">

                @foreach($topProviders as $provider)

                <div class="provider-card">

                    <div class="flex items-center gap-4">

                        <!-- AVATAR -->
                        <div class="avatar">

                            {{ strtoupper(substr($provider->name,0,1)) }}

                        </div>

                        <!-- INFO -->
                        <div>

                            <h3 class="font-bold text-xl">

                                {{ $provider->name }}

                            </h3>

                            <div class="text-yellow-400 mt-1">

                                @for($i=1;$i<=5;$i++)

                                    {{ $i <= floor($provider->average_rating) ? '⭐' : '☆' }}

                                @endfor

                            </div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">

                                {{ $provider->average_rating }}/5
                                •
                                {{ $provider->total_reviews }} reviews

                            </p>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- 📌 SYSTEM STATUS -->
        <div class="glass rounded-[2rem] p-8 shadow-2xl">

            <h2 class="text-3xl font-bold mb-8">
                📌 System Status
            </h2>

            <div class="space-y-5">

                <div class="status-card">

                    <div class="flex justify-between">

                        <span>
                            Server Status
                        </span>

                        <span class="text-green-500 font-bold">
                            🟢 Online
                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="flex justify-between">

                        <span>
                            Pending Reports
                        </span>

                        <span class="text-yellow-500 font-bold">

                            {{ $pendingReports }}

                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="flex justify-between">

                        <span>
                            Pending Payments
                        </span>

                        <span class="text-green-500 font-bold">

                            {{ $pendingPayments }}

                        </span>

                    </div>

                </div>

                <div class="status-card">

                    <div class="flex justify-between">

                        <span>
                            Total Reports
                        </span>

                        <span class="text-red-500 font-bold">

                            {{ $totalReports }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<!-- 🎨 STYLES -->
<style>

.glass{
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
}

.stat-card{
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(20px);
    padding: 30px;
    border-radius: 2rem;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    transition: .3s;
}

.dark .stat-card{
    background: rgba(15,23,42,0.8);
}

.stat-card:hover{
    transform: translateY(-6px);
}

.yellow-card{
    background: rgba(254,240,138,.8);
}

.green-card{
    background: rgba(187,247,208,.8);
}

.icon-box{
    width: 70px;
    height: 70px;
    border-radius: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.quick-card{
    position: relative;
    background: rgba(255,255,255,.8);
    backdrop-filter: blur(20px);
    padding: 30px;
    border-radius: 2rem;
    transition: .3s;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

.dark .quick-card{
    background: rgba(15,23,42,0.8);
}

.quick-card:hover{
    transform: translateY(-8px) scale(1.02);
}

.badge{
    position: absolute;
    top: 15px;
    right: 15px;
    color: white;
    padding: 5px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
    animation: pulse 2s infinite;
}

.provider-card{
    background: rgba(255,255,255,.7);
    padding: 20px;
    border-radius: 1.5rem;
    transition: .3s;
}

.dark .provider-card{
    background: rgba(15,23,42,.7);
}

.provider-card:hover{
    transform: scale(1.02);
}

.avatar{
    width: 60px;
    height: 60px;
    border-radius: 1rem;
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
}

.status-card{
    background: rgba(255,255,255,.08);
    padding: 18px;
    border-radius: 1rem;
}

@keyframes pulse{

    0%{
        transform: scale(1);
    }

    50%{
        transform: scale(1.1);
    }

    100%{
        transform: scale(1);
    }

}

</style>

<!-- 🌙 DARK MODE -->
<script>

function toggleDarkMode() {

    document.documentElement.classList.toggle('dark');

    const isDark =
        document.documentElement.classList.contains('dark');

    localStorage.setItem('darkMode', isDark);

    document.getElementById('darkToggle').innerHTML =
        isDark
        ? '☀ Light Mode'
        : '🌙 Dark Mode';

}

// LOAD
if (localStorage.getItem('darkMode') === 'true') {

    document.documentElement.classList.add('dark');

    document.getElementById('darkToggle').innerHTML =
        '☀ Light Mode';

}

// CLOCK
function updateClock() {

    const now = new Date();

    document.getElementById('clock').innerHTML =
        now.toLocaleTimeString();

}

setInterval(updateClock,1000);

updateClock();

</script>

@endsection