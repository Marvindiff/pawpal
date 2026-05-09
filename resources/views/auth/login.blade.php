<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawPal • Login</title>

    @vite('resources/css/app.css')

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }

        .glass{
            backdrop-filter: blur(20px);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
        }

        .floating{
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float{
            0%{
                transform: translateY(0px);
            }
            50%{
                transform: translateY(-12px);
            }
            100%{
                transform: translateY(0px);
            }
        }

        .bg-grid{
            background-image:
                radial-gradient(circle at 1px 1px, rgba(255,255,255,.06) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>

</head>

<body class="bg-black overflow-hidden">

<!-- 🌌 BACKGROUND -->
<div class="fixed inset-0">

    <!-- GRADIENT -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

    <!-- GLOW -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>

    <!-- GRID -->
    <div class="absolute inset-0 bg-grid opacity-30"></div>

</div>

<!-- 🚨 ERRORS -->
@if ($errors->any())

<div class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-[90%] max-w-md">

    <div class="bg-red-500/90 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl">

        @foreach ($errors->all() as $error)

            <div class="text-sm mb-1">
                ⚠ {{ $error }}
            </div>

        @endforeach

    </div>

</div>

@endif

<div class="min-h-screen flex relative z-10">

    <!-- 🐾 LEFT -->
    <div class="hidden lg:flex w-1/2 items-center justify-center p-16">

        <div class="max-w-xl">

            <!-- LOGO -->
            <div class="flex items-center gap-4 mb-8 floating">

                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-2xl text-4xl">
                    🐾
                </div>

                <div>

                    <h1 class="text-5xl font-bold text-white">
                        PawPal
                    </h1>

                    <p class="text-indigo-200 text-lg">
                        Pet Care 
                    </p>

                </div>

            </div>

            <!-- HERO -->
            <h2 class="text-6xl font-bold text-white leading-tight">

                Find Trusted
                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    Sitters
                </span>
                &
                <span class="bg-gradient-to-r from-pink-400 to-yellow-300 bg-clip-text text-transparent">
                    Walkers
                </span>

            </h2>

            <p class="text-gray-300 text-lg mt-8 leading-relaxed">

                Connect with trusted pet sitters and walkers near you.
                Book services, chat instantly, manage payments,
                and keep your pets safe — all in one place.

            </p>

            <!-- FEATURES -->
            <div class="grid grid-cols-2 gap-5 mt-10">

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        💬
                    </div>

                    <h3 class="text-white font-semibold">
                        Live Messaging
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Real-time chat between owners and providers.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        💳
                    </div>

                    <h3 class="text-white font-semibold">
                        Secure Payments
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Wallet & GCash integration with verification.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        ⭐
                    </div>

                    <h3 class="text-white font-semibold">
                        Ratings & Reviews
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Trusted feedback from real pet owners.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        🐶
                    </div>

                    <h3 class="text-white font-semibold">
                        Pet Safety
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Verified providers for peace of mind.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- 🔐 RIGHT -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-md">

            <!-- MOBILE LOGO -->
            <div class="lg:hidden text-center mb-8">

                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-2xl text-4xl mx-auto mb-4">
                    🐾
                </div>

                <h1 class="text-4xl font-bold text-white">
                    PawPal
                </h1>

            </div>

            <!-- CARD -->
            <div class="glass rounded-[2rem] p-8 shadow-2xl">

                <!-- HEADER -->
                <div class="mb-8">

                    <h2 class="text-4xl font-bold text-white">
                        Welcome Back 👋
                    </h2>

                    <p class="text-gray-300 mt-2">
                        Login to continue your PawPal journey
                    </p>

                </div>

                <!-- FORM -->
                <form method="POST"
                      action="{{ route('login') }}"
                      class="space-y-5">

                    @csrf

                    <!-- EMAIL -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"

                               class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition"
                               required>

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Password
                        </label>

                        <div class="relative">

                            <input type="password"
                                   id="loginPassword"
                                   name="password"
                                   placeholder="Enter your password"

                                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition"
                                   required>

                            <!-- 👁 -->
                            <button type="button"
                                onclick="togglePassword('loginPassword', this)"

                                class="absolute right-5 top-4 text-gray-400 hover:text-white transition">

                                👁

                            </button>

                        </div>

                    </div>

                    <!-- REMEMBER -->
                    <div class="flex justify-between items-center text-sm">

                        <label class="flex items-center gap-2 text-gray-300">

                            <input type="checkbox"
                                   name="remember"
                                   class="rounded border-gray-500">

                            Remember me

                        </label>

                        <a href="{{ route('password.request') }}"
                           class="text-indigo-300 hover:text-white transition">

                            Forgot Password?

                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"

                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] transition shadow-2xl">

                        Sign In 🚀

                    </button>

                    <!-- DIVIDER -->
                    <div class="flex items-center gap-3">

                        <div class="flex-1 h-px bg-white/10"></div>

                        <span class="text-gray-400 text-sm">
                            OR
                        </span>

                        <div class="flex-1 h-px bg-white/10"></div>

                    </div>

                    <!-- REGISTER -->
                    <a href="{{ route('register') }}"
                       class="w-full flex items-center justify-center bg-white/10 hover:bg-white/20 text-white py-4 rounded-2xl font-semibold transition">

                        Create New Account

                    </a>

                </form>

            </div>

            <!-- FOOTER -->
            <p class="text-center text-gray-500 text-sm mt-6">

                © {{ date('Y') }} PawPal.
                Made with 🐾 for pet lovers.

            </p>

        </div>

    </div>

</div>

<!-- 👁 PASSWORD -->
<script>

function togglePassword(id, btn) {

    const input = document.getElementById(id);

    if (input.type === "password") {

        input.type = "text";

        btn.innerHTML = '🙈';

    } else {

        input.type = "password";

        btn.innerHTML = '👁';

    }

}

</script>

</body>
</html>