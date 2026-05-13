@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-indigo-950 to-black text-white p-6">

    <div class="max-w-7xl mx-auto">

        <!-- 🔝 HEADER -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-5 mb-10">

            <!-- LEFT -->
            <div>

                <h1 class="text-5xl font-bold">
                    🐾 Pending Providers
                </h1>

                <p class="text-gray-400 mt-3 text-lg">
                    Review and approve new provider registrations
                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex gap-3 flex-wrap">

                <!-- BACK -->
                <a href="{{ route('admin.dashboard') }}"
                   class="bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-3 rounded-2xl transition font-semibold shadow-xl">

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
                    Pending Providers
                </p>

                <h2 class="text-4xl font-bold mt-2 text-indigo-400">
                    {{ $providers->count() }}
                </h2>

            </div>

            <!-- WALKERS -->
            <div class="bg-blue-500/10 border border-blue-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-blue-300 text-sm">
                    Dog Walkers
                </p>

                <h2 class="text-4xl font-bold mt-2 text-blue-400">
                    {{ $providers->where('service_type', 'walker')->count() }}
                </h2>

            </div>

            <!-- SITTERS -->
            <div class="bg-purple-500/10 border border-purple-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-purple-300 text-sm">
                    Pet Sitters
                </p>

                <h2 class="text-4xl font-bold mt-2 text-purple-400">
                    {{ $providers->where('service_type', 'sitter')->count() }}
                </h2>

            </div>

            <!-- CERTIFICATES -->
            <div class="bg-green-500/10 border border-green-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-green-300 text-sm">
                    With Certificates
                </p>

                <h2 class="text-4xl font-bold mt-2 text-green-400">
                    {{ $providers->whereNotNull('certificate')->count() }}
                </h2>

            </div>

        </div>

        <!-- 🔍 SEARCH -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-5 mb-8 shadow-xl">

            <div class="flex flex-col lg:flex-row gap-4">

                <!-- SEARCH -->
                <input type="text"
                       id="searchInput"
                       placeholder="Search provider name, email, service..."

                       class="flex-1 bg-black/20 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400">

                <!-- FILTER -->
                <div class="flex flex-wrap gap-3">

                    <button onclick="filterProviders('all')"
                        class="bg-indigo-500 hover:bg-indigo-600 px-5 py-3 rounded-2xl font-semibold transition">

                        All

                    </button>

                    <button onclick="filterProviders('walker')"
                        class="bg-blue-500 hover:bg-blue-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Walkers

                    </button>

                    <button onclick="filterProviders('sitter')"
                        class="bg-purple-500 hover:bg-purple-600 px-5 py-3 rounded-2xl font-semibold transition">

                        Sitters

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

        <!-- PROVIDERS -->
        <div class="space-y-8">

            @forelse($providers as $provider)

            <div class="provider-card bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden"

                 data-service="{{ $provider->service_type }}"

                 data-search="
                    {{ strtolower($provider->name) }}
                    {{ strtolower($provider->email) }}
                    {{ strtolower($provider->service_type) }}
                 ">

                <div class="p-8">

                    <div class="flex flex-col xl:flex-row gap-8">

                        <!-- LEFT -->
                        <div class="flex-1">

                            <!-- USER -->
                            <div class="flex items-center gap-5">

                                <!-- AVATAR -->
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-3xl font-bold shadow-2xl">

                                    {{ strtoupper(substr($provider->name, 0, 1)) }}

                                </div>

                                <!-- INFO -->
                                <div>

                                    <h2 class="text-3xl font-bold">

                                        {{ $provider->name }}

                                    </h2>

                                    <p class="text-gray-400 mt-1">

                                        {{ $provider->email }}

                                    </p>

                                </div>

                            </div>

                            <!-- DETAILS -->
                            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5 mt-8">

                                <!-- SERVICE -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Service Type
                                    </p>

                                    <h3 class="font-bold text-xl capitalize">

                                        @if($provider->service_type == 'walker')

                                            🐕 Dog Walker

                                        @else

                                            🐾 Pet Sitter

                                        @endif

                                    </h3>

                                </div>

                                <!-- STATUS -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Verification Status
                                    </p>

                                    <span class="bg-yellow-500/20 text-yellow-300 px-4 py-2 rounded-full text-sm font-bold">

                                        ⏳ Pending Approval

                                    </span>

                                </div>
<!-- MOBILE -->
<div class="bg-black/20 border border-white/10 rounded-3xl p-5">

    <p class="text-gray-400 text-sm mb-2">
        Mobile Number
    </p>

    <h3 class="font-bold text-lg text-green-400">

        📱 {{ $provider->mobile_number ?? 'Not provided' }}

    </h3>

</div>

<!-- LOCATION -->
<div class="bg-black/20 border border-white/10 rounded-3xl p-5">

    <p class="text-gray-400 text-sm mb-2">
        Location
    </p>

    <h3 class="font-bold text-lg text-indigo-300">

        📍 {{ $provider->location ?? 'Not provided' }}

    </h3>

</div>
                                <!-- CERT -->
                                <div class="bg-black/20 border border-white/10 rounded-3xl p-5">

                                    <p class="text-gray-400 text-sm mb-2">
                                        Certificate
                                    </p>

                                    @if($provider->certificate)

                                        <span class="text-green-400 font-semibold">
                                            ✅ Uploaded
                                        </span>

                                    @else

                                        <span class="text-red-400 font-semibold">
                                            ❌ Missing
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="xl:w-[350px]">

                            @if($provider->certificate)

                                <div class="bg-black/20 border border-white/10 rounded-[2rem] p-5">

                                    <div class="flex justify-between items-center mb-4">

                                        <h3 class="font-bold text-lg">
                                            📄 Certificate
                                        </h3>

                                        <a href="{{ asset('storage/' . $provider->certificate) }}"
                                           target="_blank"

                                           class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-xl text-sm font-semibold transition">

                                            View

                                        </a>

                                    </div>

                                    @if(Str::endsWith($provider->certificate, ['jpg','jpeg','png']))

                                        <a href="{{ asset('storage/' . $provider->certificate) }}"
                                           target="_blank">

                                            <img src="{{ asset('storage/' . $provider->certificate) }}"
                                                 class="rounded-3xl border border-white/10 shadow-2xl hover:scale-[1.02] transition cursor-pointer">

                                        </a>

                                    @else

                                        <div class="bg-white/5 border border-white/10 rounded-3xl p-10 text-center">

                                            <div class="text-6xl mb-4">
                                                📄
                                            </div>

                                            <p class="text-gray-300">
                                                PDF Certificate Uploaded
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            @else

                                <div class="bg-red-500/10 border border-red-500/20 rounded-3xl p-6 text-center">

                                    <div class="text-5xl mb-3">
                                        ⚠️
                                    </div>

                                    <p class="text-red-300">
                                        No certificate uploaded.
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="grid md:grid-cols-2 gap-4 mt-8">

                        <!-- APPROVE -->
                        <form method="POST"
                              action="{{ route('admin.providers.approve', $provider->id) }}">

                            @csrf

                            <button
                                onclick="return confirm('Approve this provider?')"

                                class="w-full bg-green-500 hover:bg-green-600 py-4 rounded-2xl font-bold text-lg shadow-2xl transition">

                                ✅ Approve Provider

                            </button>

                        </form>

                        <!-- DECLINE -->
                        <form method="POST"
                              action="{{ route('admin.providers.decline', $provider->id) }}">

                            @csrf

                            <button
                                onclick="return confirm('Decline this provider?')"

                                class="w-full bg-red-500 hover:bg-red-600 py-4 rounded-2xl font-bold text-lg shadow-2xl transition">

                                ❌ Decline Provider

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] p-20 text-center shadow-2xl">

                <div class="text-8xl mb-6">
                    🎉
                </div>

                <h2 class="text-4xl font-bold mb-3">
                    No Pending Providers
                </h2>

                <p class="text-gray-400 text-lg">
                    All providers are already reviewed.
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

    document.querySelectorAll('.provider-card')
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

function filterProviders(type) {

    document.querySelectorAll('.provider-card')
    .forEach(card => {

        if (
            type === 'all'
            || card.dataset.service === type
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