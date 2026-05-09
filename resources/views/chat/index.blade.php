@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-3xl bg-white shadow-xl rounded-xl flex flex-col h-[600px]">

        <!-- HEADER -->
        <div class="bg-blue-600 text-white px-4 py-3 rounded-t-xl flex justify-between items-center">
            <h2 class="font-semibold">
                💬 Chat with {{ $receiver->name }}
            </h2>

            <!-- ✅ FIXED BACK BUTTON -->
            <button onclick="goBack()"
                class="text-white bg-blue-700 px-3 py-1 rounded text-sm hover:bg-blue-800 transition">
                ← Back
            </button>
        </div>

        <!-- MESSAGES -->
        <div id="chat-box" class="flex-1 overflow-y-auto p-4 bg-gray-50 space-y-2">

            @foreach($messages as $msg)

                @if($msg->sender_id == auth()->id())
                    <div class="flex justify-end">
                        <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-xs shadow">
                            {{ $msg->message }}
                        </div>
                    </div>
                        <!-- ✅ SEEN / DELIVERED -->
            @if($loop->last)
                <div class="text-xs text-gray-400 mt-1">
                    {{ $msg->is_seen ? 'Seen 👁️' : 'Delivered ✓✓' }}
                </div>
            @endif

                @else
                    <div class="flex justify-start">
                        <div class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg max-w-xs shadow">
                            {{ $msg->message }}
                        </div>
                    </div>
                @endif

            @endforeach

        </div>

        <!-- INPUT -->
        <form method="POST" action="{{ route('chat.send') }}"
              class="p-3 border-t flex gap-2">
            @csrf

            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

            <input type="text" name="message"
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                   placeholder="Type a message..." required>

            <button class="bg-blue-500 text-white px-4 rounded-full hover:bg-blue-600">
                Send
            </button>
        </form>

    </div>

</div>

<!-- ✅ AUTO SCROLL -->
<script>
let chatBox = document.getElementById("chat-box");
if(chatBox){
    chatBox.scrollTop = chatBox.scrollHeight;
}
</script>

<!-- ✅ REAL-TIME CHAT -->
<script>
setInterval(() => {
    fetch(window.location.href)
        .then(res => res.text())
        .then(data => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(data, 'text/html');

            let newChat = doc.getElementById('chat-box').innerHTML;
            document.getElementById('chat-box').innerHTML = newChat;

            let chatBox = document.getElementById("chat-box");
            chatBox.scrollTop = chatBox.scrollHeight;
        });
}, 2000);
</script>

<!-- ✅ SMART BACK BUTTON SCRIPT -->
<script>
function goBack() {
    if (document.referrer && document.referrer !== window.location.href) {
        history.back(); // go to previous page
    } else {
        // fallback if opened directly
        window.location.href = "{{ auth()->user()->role === 'provider' 
            ? route('walker.dashboard') 
            : route('dashboard') }}";
    }
}
</script>

@endsection