@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-950 via-indigo-950 to-black text-white p-6">

    <div class="max-w-7xl mx-auto">

        <!-- 🔝 HEADER -->
        <div class="flex flex-col lg:flex-row justify-between items-center gap-5 mb-10">

            <!-- LEFT -->
            <div>

                <h1 class="text-5xl font-bold">
                    📩 Customer Support Messages
                </h1>

                <p class="text-gray-400 mt-3 text-lg">
                    Manage and reply to customer concerns
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
                    Total Messages
                </p>

                <h2 class="text-4xl font-bold mt-2 text-indigo-400">
                    {{ $messages->count() }}
                </h2>

            </div>

            <!-- TODAY -->
            <div class="bg-blue-500/10 border border-blue-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-blue-300 text-sm">
                    Today
                </p>

                <h2 class="text-4xl font-bold mt-2 text-blue-400">
                    {{ $messages->where('created_at', '>=', now()->startOfDay())->count() }}
                </h2>

            </div>

            <!-- REPLIED -->
            <div class="bg-green-500/10 border border-green-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-green-300 text-sm">
                    Replied
                </p>

                <h2 class="text-4xl font-bold mt-2 text-green-400">
                    {{ $messages->where('is_replied', true)->count() }}
                </h2>

            </div>

            <!-- PENDING -->
            <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-3xl p-6 shadow-2xl">

                <p class="text-yellow-300 text-sm">
                    Pending Replies
                </p>

                <h2 class="text-4xl font-bold mt-2 text-yellow-400">
                    {{ $messages->where('is_replied', false)->count() }}
                </h2>

            </div>

        </div>

        <!-- 🔍 SEARCH -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-3xl p-5 mb-8 shadow-xl">

            <input type="text"
                   id="searchInput"
                   placeholder="Search name, email, message..."

                   class="w-full bg-black/20 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400">

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="bg-green-500/10 border border-green-500/20 text-green-300 p-5 rounded-3xl mb-6 shadow-xl">

                {{ session('success') }}

            </div>

        @endif

        <!-- 📩 MESSAGES -->
        <div class="space-y-8">

            @forelse($messages as $msg)

            <div class="message-card bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden"

                 data-search="
                    {{ strtolower($msg->name) }}
                    {{ strtolower($msg->email) }}
                    {{ strtolower($msg->message) }}
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

                                    {{ strtoupper(substr($msg->name, 0, 1)) }}

                                </div>

                                <!-- INFO -->
                                <div>

                                    <h2 class="text-3xl font-bold">

                                        {{ $msg->name }}

                                    </h2>

                                    <p class="text-gray-400 mt-1">

                                        📧 {{ $msg->email }}

                                    </p>

                                    <p class="text-gray-500 text-sm mt-1">

                                        🕒 {{ $msg->created_at->diffForHumans() }}

                                    </p>

                                </div>

                            </div>

                            <!-- MESSAGE -->
                            <div class="mt-8 bg-black/20 border border-white/10 rounded-3xl p-6">

                                <p class="text-gray-400 text-sm mb-3">
                                    Customer Message
                                </p>

                                <p class="text-lg leading-relaxed text-gray-200">

                                    {{ $msg->message }}

                                </p>

                            </div>

                            <!-- STATUS -->
                            <div class="mt-5">

                                @if($msg->is_replied)

                                    <span class="bg-green-500/20 text-green-300 px-5 py-2 rounded-full text-sm font-bold">

                                        ✅ Replied

                                    </span>

                                @else

                                    <span class="bg-yellow-500/20 text-yellow-300 px-5 py-2 rounded-full text-sm font-bold">

                                        ⏳ Waiting Reply

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="mt-8">

                        <!-- BUTTON -->
                        <button type="button"
                            onclick="toggleReply({{ $msg->id }})"

                            class="bg-indigo-500 hover:bg-indigo-600 px-6 py-3 rounded-2xl font-semibold transition shadow-xl">

                            💬 Reply to Customer

                        </button>

                        <!-- REPLY FORM -->
                        <form action="{{ route('admin.messages.reply') }}"
                              method="POST"

                              id="reply-{{ $msg->id }}"
                              class="hidden mt-6">

                            @csrf

                            <input type="hidden"
                                   name="email"
                                   value="{{ $msg->email }}">

                            <!-- REPLY BOX -->
                            <div class="bg-black/20 border border-white/10 rounded-[2rem] p-6">

                                <label class="block text-gray-300 font-semibold mb-3">

                                    ✍ Reply Message

                                </label>

                                <textarea name="reply"
                                    rows="6"
                                    required
                                    placeholder="Type your reply to the customer..."

                                    class="w-full bg-black/20 border border-white/10 text-white placeholder-gray-500 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400"></textarea>

                                <!-- BUTTONS -->
                                <div class="flex flex-wrap gap-4 mt-5">

                                    <!-- SEND -->
                                    <button type="submit"

                                        class="bg-green-500 hover:bg-green-600 px-6 py-3 rounded-2xl font-bold transition shadow-xl">

                                        📤 Send Reply

                                    </button>

                                    <!-- CANCEL -->
                                    <button type="button"
                                        onclick="closeReply({{ $msg->id }})"

                                        class="bg-red-500 hover:bg-red-600 px-6 py-3 rounded-2xl font-bold transition shadow-xl">

                                        ❌ Cancel

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-[2rem] p-20 text-center shadow-2xl">

                <div class="text-8xl mb-6">
                    📭
                </div>

                <h2 class="text-4xl font-bold mb-3">
                    No Messages Yet
                </h2>

                <p class="text-gray-400 text-lg">
                    Customer messages will appear here.
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

    document.querySelectorAll('.message-card')
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

<!-- 💬 TOGGLE -->
<script>

function toggleReply(id) {

    // CLOSE OTHERS
    document.querySelectorAll('[id^="reply-"]')
    .forEach(form => {

        form.classList.add('hidden');

    });

    // OPEN TARGET
    document.getElementById('reply-' + id)
    .classList.remove('hidden');

}

function closeReply(id) {

    document.getElementById('reply-' + id)
    .classList.add('hidden');

}

</script>

<!-- 🔄 AUTO REFRESH -->
<script>

setInterval(() => {

    location.reload();

}, 30000);

</script>

@endsection