@extends('layouts.app')

@section('content')

<div id="dashboard"
     class="min-h-screen bg-gradient-to-br from-slate-950 via-indigo-950 to-black text-white p-6">

    <div class="max-w-7xl mx-auto">

        <!-- 🔝 TOP -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-5 mb-10">

            <!-- LEFT -->
            <div>

                <h1 class="text-5xl font-bold">
                    💳 Payment Verification
                </h1>

                <p class="text-gray-400 mt-3 text-lg">
                    Review and verify uploaded payment proofs
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-wrap items-center gap-3">

                <!-- BACK -->
                <a href="{{ route('admin.dashboard') }}"
                   class="bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-3 rounded-2xl transition font-semibold">

                    ← Dashboard

                </a>

                <!-- REFRESH -->
                <button onclick="location.reload()"
                    class="bg-indigo-500 hover:bg-indigo-600 px-5 py-3 rounded-2xl font-semibold transition shadow-xl">

                    🔄 Refresh

                </button>

            </div>

        </div>

        <!-- 📊 STATS -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

            <!-- TOTAL -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-6 shadow-2xl">

                <p class="text-gray-400 text-sm">
                    Total Payments
                </p>

                <h2 class="text-4xl font-bold mt-2 text-indigo-400">
                    {{ $payments->count() }}
                </h2>

            </div>

            <!-- PENDING -->
            <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-yellow-300 text-sm">
                    Pending
                </p>

                <h2 class="text-4xl font-bold mt-2 text-yellow-400">
                    {{ $payments->where('payment_status', 'pending')->count() }}
                </h2>

            </div>

            <!-- APPROVED -->
            <div class="bg-green-500/10 border border-green-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-green-300 text-sm">
                    Approved
                </p>

                <h2 class="text-4xl font-bold mt-2 text-green-400">
                    {{ $payments->where('payment_status', 'paid')->count() }}
                </h2>

            </div>

            <!-- REJECTED -->
            <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-red-300 text-sm">
                    Rejected
                </p>

                <h2 class="text-4xl font-bold mt-2 text-red-400">
                    {{ $payments->where('payment_status', 'rejected')->count() }}
                </h2>

            </div>

        </div>

        <!-- 🔍 SEARCH -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-5 mb-8 shadow-xl">

            <div class="flex flex-col lg:flex-row gap-4">

                <!-- SEARCH -->
                <input type="text"
                       id="searchInput"
                       placeholder="Search user, provider, gcash number..."

                       class="flex-1 bg-black/20 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400">

                <!-- FILTER -->
                <div class="flex flex-wrap gap-3">

                    <button onclick="filterPayments('all')"
                        class="bg-indigo-500 hover:bg-indigo-600 px-5 py-3 rounded-2xl font-semibold transition">

                        All

                    </button>

                    <button onclick="filterPayments('pending')"
                        class="bg-yellow-500 hover:bg-yellow-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Pending

                    </button>

                    <button onclick="filterPayments('paid')"
                        class="bg-green-500 hover:bg-green-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Approved

                    </button>

                    <button onclick="filterPayments('rejected')"
                        class="bg-red-500 hover:bg-red-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Rejected

                    </button>

                </div>

            </div>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="bg-green-500/10 border border-green-500/20 text-green-300 p-5 rounded-3xl mb-6 shadow-xl">

                {{ session('success') }}

            </div>

        @endif

        <!-- ERROR -->
        @if(session('error'))

            <div class="bg-red-500/10 border border-red-500/20 text-red-300 p-5 rounded-3xl mb-6 shadow-xl">

                {{ session('error') }}

            </div>

        @endif

        <!-- 💳 PAYMENTS -->
        <div id="paymentsContainer"
             class="space-y-8">

            @forelse($payments as $payment)

            <div class="payment-card bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden"

                 data-status="{{ $payment->payment_status }}"

                 data-search="
                    {{ strtolower($payment->user->name ?? '') }}
                    {{ strtolower($payment->provider->name ?? '') }}
                    {{ strtolower($payment->provider->phone ?? '') }}
                 ">

                <div class="p-8">

                    <!-- TOP -->
                    <div class="flex flex-col xl:flex-row gap-8">

                        <!-- LEFT -->
                        <div class="flex-1">

                            <!-- USER -->
                            <div class="flex items-center gap-5">

                                <!-- AVATAR -->
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-3xl font-bold shadow-2xl">

                                    {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}

                                </div>

                                <!-- INFO -->
                                <div>

                                    <h2 class="text-3xl font-bold">

                                        {{ $payment->user->name ?? 'User' }}

                                    </h2>

                                    <p class="text-gray-400 mt-1">

                                        Booking #{{ $payment->id }}

                                    </p>

                                </div>

                            </div>

                            <!-- DETAILS -->
                            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5 mt-8">

                                <!-- PROVIDER -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Provider
                                    </p>

                                    <h3 class="font-bold text-lg">
                                        🧑‍⚕️ {{ $payment->provider->name ?? 'N/A' }}
                                    </h3>

                                </div>

                                <!-- GCASH -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Provider GCash
                                    </p>

                                    <h3 class="font-bold text-2xl text-green-400">
                                        📞 {{ $payment->provider->phone ?? 'No Number' }}
                                    </h3>

                                    <p class="text-xs text-gray-500 mt-2">
                                        Verify this number matches the proof.
                                    </p>

                                </div>

                                <!-- METHOD -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Payment Method
                                    </p>

                                    <h3 class="font-bold text-lg">
                                        💳 {{ ucfirst($payment->payment_method ?? 'GCash') }}
                                    </h3>

                                </div>

                                <!-- AMOUNT -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Amount
                                    </p>

                                    <h3 class="font-bold text-3xl text-indigo-400">
                                        ₱{{ number_format($payment->price ?? 0, 2) }}
                                    </h3>

                                </div>

                                <!-- DATE -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Uploaded
                                    </p>

                                    <h3 class="font-semibold">
                                        🕒 {{ $payment->updated_at->format('M d, Y h:i A') }}
                                    </h3>

                                </div>

                                <!-- STATUS -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Status
                                    </p>

                                    <div>

                                        @if($payment->payment_status == 'paid')

                                            <span class="bg-green-500/20 text-green-300 px-4 py-2 rounded-full text-sm font-bold">
                                                ✅ Approved
                                            </span>

                                        @elseif($payment->payment_status == 'pending')

                                            <span class="bg-yellow-500/20 text-yellow-300 px-4 py-2 rounded-full text-sm font-bold">
                                                ⏳ Pending
                                            </span>

                                        @elseif($payment->payment_status == 'rejected')

                                            <span class="bg-red-500/20 text-red-300 px-4 py-2 rounded-full text-sm font-bold">
                                                ❌ Rejected
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="xl:w-[380px]">

                            @if($payment->gcash_proof)

                            <div class="bg-black/20 border border-white/10 rounded-[2rem] p-5">

                                <div class="flex justify-between items-center mb-4">

                                    <h3 class="font-bold text-lg">
                                        📸 Payment Proof
                                    </h3>

                                    <a href="{{ asset('storage/'.$payment->gcash_proof) }}"
                                       target="_blank"

                                       class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-xl text-sm font-semibold transition">

                                        View

                                    </a>

                                </div>

                                <a href="{{ asset('storage/'.$payment->gcash_proof) }}"
                                   target="_blank">

                                    <img src="{{ asset('storage/'.$payment->gcash_proof) }}"
                                         class="rounded-3xl shadow-2xl border border-white/10 hover:scale-[1.02] transition cursor-pointer">

                                </a>

                            </div>

                            @else

                            <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6 text-center">

                                <div class="text-5xl mb-3">
                                    ⚠️
                                </div>

                                <p class="text-red-300">
                                    No payment proof uploaded.
                                </p>

                            </div>

                            @endif

                        </div>

                    </div>

                    <!-- ACTIONS -->
                    @if($payment->payment_status == 'pending')

                    <div class="grid md:grid-cols-2 gap-4 mt-8">

                        <!-- APPROVE -->
                        <form method="POST"
                              action="{{ route('admin.payments.approve', $payment->id) }}">

                            @csrf

                            <button
                                onclick="return confirm('Approve this payment?')"

                                class="w-full bg-green-500 hover:bg-green-600 py-4 rounded-2xl font-bold text-lg shadow-2xl transition">

                                ✅ Approve Payment

                            </button>

                        </form>

                        <!-- REJECT -->
                        <form method="POST"
                              action="{{ route('admin.payments.reject', $payment->id) }}">

                            @csrf

                            <button
                                onclick="return confirm('Reject this payment?')"

                                class="w-full bg-red-500 hover:bg-red-600 py-4 rounded-2xl font-bold text-lg shadow-2xl transition">

                                ❌ Reject Payment

                            </button>

                        </form>

                    </div>

                    @endif

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] p-20 text-center shadow-2xl">

                <div class="text-8xl mb-6">
                    💳
                </div>

                <h2 class="text-4xl font-bold mb-3">
                    No Payments Yet
                </h2>

                <p class="text-gray-400 text-lg">
                    Uploaded payment proofs will appear here.
                </p>

            </div>

            @endforelse

        </div>

    </div>

</div>

<!-- 🔍 SEARCH -->
<script>

document.getElementById('searchInput')
.addEventListener('keyup', function() {

    const value = this.value.toLowerCase();

    document.querySelectorAll('.payment-card')
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

<!-- 🔄 FILTER -->
<script>

function filterPayments(status) {

    document.querySelectorAll('.payment-card')
    .forEach(card => {

        if (
            status === 'all'
            || card.dataset.status === status
        ) {

            card.style.display = 'block';

        } else {

            card.style.display = 'none';

        }

    });

}

</script>

<!-- 🔄 AUTO REFRESH -->
<script>

setInterval(() => {

    location.reload();

}, 30000);

</script>

@endsection