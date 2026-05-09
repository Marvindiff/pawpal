<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PawPal • Admin Portal</title>

@vite('resources/css/app.css')

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

/* 🌌 GLASS */
.glass{
    backdrop-filter: blur(18px);
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
}

/* ✨ FLOATING */
.floating{
    animation: floating 5s ease-in-out infinite;
}

@keyframes floating{

    0%{
        transform: translateY(0px);
    }

    50%{
        transform: translateY(-10px);
    }

    100%{
        transform: translateY(0px);
    }

}

/* 🌟 GLOW */
.glow{
    box-shadow:
        0 0 40px rgba(99,102,241,.4),
        0 0 80px rgba(168,85,247,.2);
}

</style>

</head>

<body class="bg-black text-white">

<!-- 🌌 BACKGROUND -->
<div class="fixed inset-0 -z-10">

    <!-- GRADIENT -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-500/20 rounded-full blur-3xl"></div>

</div>

<!-- 🚨 ERROR -->
@if ($errors->any())

<div class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-[90%] max-w-md">

    <div class="bg-red-500/90 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl text-center">

        ⚠ {{ $errors->first() }}

    </div>

</div>

@endif

<div class="min-h-screen flex items-center justify-center px-6 relative z-10">

    <div class="grid lg:grid-cols-2 gap-14 items-center max-w-7xl w-full">

        <!-- 🐾 LEFT -->
        <div class="hidden lg:block">

            <!-- LOGO -->
            <div class="flex items-center gap-4 mb-8 floating">

                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-2xl text-4xl glow">
                    🛡️
                </div>

                <div>

                    <h1 class="text-5xl font-bold">
                        PawPal
                    </h1>

                    <p class="text-indigo-200 text-lg">
                        Admin Management System
                    </p>

                </div>

            </div>

            <!-- HERO -->
            <h2 class="text-6xl font-bold leading-tight">

                Secure &
                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    Powerful
                </span>

                Admin Portal 🚀

            </h2>

            <p class="text-gray-300 text-lg mt-8 leading-relaxed max-w-xl">

                Manage users, providers, reports,
                bookings, payments, penalties,
                and platform moderation from one dashboard.

            </p>

            <!-- FEATURES -->
            <div class="grid grid-cols-2 gap-5 mt-12">

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        👥
                    </div>

                    <h3 class="text-white font-semibold">
                        User Management
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Manage users and providers.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        💳
                    </div>

                    <h3 class="text-white font-semibold">
                        Payments
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Verify GCash transactions.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        🚨
                    </div>

                    <h3 class="text-white font-semibold">
                        Reports
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Review user complaints instantly.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        🔒
                    </div>

                    <h3 class="text-white font-semibold">
                        Security
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Secure administrator access.
                    </p>

                </div>

            </div>

        </div>

        <!-- 🔐 RIGHT -->
        <div class="w-full max-w-md mx-auto">

            <!-- MOBILE -->
            <div class="lg:hidden text-center mb-8">

                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-2xl text-4xl mx-auto mb-4">
                    🛡️
                </div>

                <h1 class="text-4xl font-bold">
                    PawPal Admin
                </h1>

            </div>

            <!-- CARD -->
            <div class="glass rounded-[2rem] p-8 shadow-2xl">

                <!-- HEADER -->
                <div class="mb-8 text-center">

                    <h2 class="text-4xl font-bold text-white">
                        Admin Login 🔐
                    </h2>

                    <p class="text-gray-300 mt-2">
                        Secure access to the management portal
                    </p>

                </div>

                <!-- FORM -->
                <form method="POST"
                      action="/admin/login"
                      class="space-y-5">

                    @csrf

                    <!-- EMAIL -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               required
                               placeholder="admin@pawpal.com"

                               class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition">

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Password
                        </label>

                        <div class="relative">

                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   placeholder="Enter your password"

                                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition">

                            <!-- 👁 -->
                            <button type="button"
                                onclick="togglePassword()"

                                class="absolute right-5 top-4 text-gray-400 hover:text-white transition">

                                👁

                            </button>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"

                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] transition shadow-2xl">

                        Login to Admin Portal 🚀

                    </button>

                </form>

                <!-- SECURITY -->
                <div class="mt-8 glass rounded-2xl p-4 text-center">

                    <p class="text-sm text-gray-300">
                        🔒 Protected by PawPal Security System
                    </p>

                </div>

            </div>

            <!-- FOOTER -->
            <p class="text-center text-gray-500 text-sm mt-6">

                © {{ date('Y') }} PawPal Admin System

            </p>

        </div>

    </div>

</div>

<!-- 👁 PASSWORD -->
<script>

function togglePassword() {

    const input = document.getElementById('password');

    if (input.type === "password") {

        input.type = "text";

    } else {

        input.type = "password";

    }

}

</script>

</body>
</html>