<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PawPal • Register</title>

    @vite('resources/css/app.css')

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

        .glass{
            backdrop-filter: blur(18px);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .floating{
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating{

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

    </style>

</head>

<body class="bg-black overflow-x-hidden">

<!-- 🌌 BACKGROUND -->
<div class="fixed inset-0 -z-10">

    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-black"></div>

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-500/20 rounded-full blur-3xl"></div>

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

                Start Your
                <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                    PawPal
                </span>

                Journey
                Today 🚀

            </h2>

            <p class="text-gray-300 text-lg mt-8 leading-relaxed">

                Join PawPal as a pet owner or become a trusted
                pet sitter and walker in your community.

            </p>

            <!-- FEATURES -->
            <div class="grid grid-cols-2 gap-5 mt-10">

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        🐾
                    </div>

                    <h3 class="text-white font-semibold">
                        Trusted Sitters
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Verified pet care providers.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        💬
                    </div>

                    <h3 class="text-white font-semibold">
                        Live Chat
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Instant messaging anytime.
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
                        Wallet & GCash integration.
                    </p>

                </div>

                <div class="glass rounded-3xl p-5">

                    <div class="text-3xl mb-3">
                        ⭐
                    </div>

                    <h3 class="text-white font-semibold">
                        Reviews
                    </h3>

                    <p class="text-sm text-gray-300 mt-1">
                        Trusted community ratings.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- 🔐 RIGHT -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-lg">

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
                        Create Account ✨
                    </h2>

                    <p class="text-gray-300 mt-2">
                        Join PawPal today
                    </p>

                </div>

                <!-- FORM -->
                <form method="POST"
                      action="{{ route('register') }}"
                      enctype="multipart/form-data"
                      class="space-y-5">

                    @csrf

                    <!-- NAME -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Full Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Juan Dela Cruz"

                               class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition"
                               required>

                    </div>

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

                    <!-- ROLE -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-4">
                            Register As
                        </label>

                        <div class="grid grid-cols-2 gap-4">

                            <!-- USER -->
                            <label class="glass rounded-2xl p-5 cursor-pointer hover:scale-[1.02] transition">

                                <input type="radio"
                                       name="role"
                                       value="user"
                                       class="hidden role-radio"

                                       {{ old('role', 'user') === 'user' ? 'checked' : '' }}>

                                <div class="text-center">

                                    <div class="text-4xl mb-3">
                                        👤
                                    </div>

                                    <h3 class="font-bold text-white">
                                        Pet Owner
                                    </h3>

                                </div>

                            </label>

                            <!-- PROVIDER -->
                            <label class="glass rounded-2xl p-5 cursor-pointer hover:scale-[1.02] transition">

                                <input type="radio"
                                       name="role"
                                       value="provider"
                                       class="hidden role-radio"

                                       {{ old('role') === 'provider' ? 'checked' : '' }}>

                                <div class="text-center">

                                    <div class="text-4xl mb-3">
                                        🐾
                                    </div>

                                    <h3 class="font-bold text-white">
                                        Provider
                                    </h3>

                                </div>

                            </label>

                        </div>

                    </div>

                    <!-- SERVICE -->
                    <div id="serviceTypeBox"
                         class="{{ old('role') === 'provider' ? '' : 'hidden' }}">

                        <label class="text-sm text-gray-300 block mb-2">
                            Service Type
                        </label>

                        <select name="service_type"

                            class="w-full bg-white/10 border border-white/10 text-white px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition">

                            <option value="sitter" class="text-black">
                                Pet Sitter
                            </option>

                            <option value="walker" class="text-black">
                                Dog Walker
                            </option>

                        </select>

                    </div>

                    <!-- CERTIFICATE -->
                    <div id="certificateBox"
                         class="{{ old('role') === 'provider' ? '' : 'hidden' }}">

                        <label class="text-sm text-gray-300 block mb-2">
                            Upload Certificate
                        </label>

                        <div class="glass rounded-2xl p-5">

                            <input type="file"
                                   name="certificate"
                                   accept="image/*,application/pdf"

                                   class="w-full text-sm text-gray-300">

                            <p class="text-xs text-gray-400 mt-2">
                                Accepted: JPG, PNG, PDF
                            </p>

                        </div>

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
                                   placeholder="Create password"

                                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition"
                                   required>

                            <button type="button"
                                onclick="togglePassword('password', this)"

                                class="absolute right-5 top-4 text-gray-400 hover:text-white transition">

                                👁

                            </button>

                        </div>

                    </div>

                    <!-- CONFIRM -->
                    <div>

                        <label class="text-sm text-gray-300 block mb-2">
                            Confirm Password
                        </label>

                        <div class="relative">

                            <input type="password"
                                   id="confirmPassword"
                                   name="password_confirmation"
                                   placeholder="Confirm password"

                                   class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-5 py-4 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-400 transition"
                                   required>

                            <button type="button"
                                onclick="togglePassword('confirmPassword', this)"

                                class="absolute right-5 top-4 text-gray-400 hover:text-white transition">

                                👁

                            </button>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"

                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-4 rounded-2xl font-bold text-lg hover:scale-[1.02] transition shadow-2xl">

                        Create Account 🚀

                    </button>

                    <!-- LOGIN -->
                    <div class="text-center text-gray-400 text-sm">

                        Already have an account?

                        <a href="{{ route('login') }}"
                           class="text-indigo-300 hover:text-white transition font-semibold ml-1">

                            Sign In

                        </a>

                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <p class="text-center text-gray-500 text-sm mt-6">

                © {{ date('Y') }} PawPal.
                Built with 🐾 for pet lovers.

            </p>

        </div>

    </div>

</div>

<!-- 🔥 SCRIPT -->
<script>

document.addEventListener('DOMContentLoaded', function () {

    const roleInputs =
        document.querySelectorAll('input[name="role"]');

    const serviceBox =
        document.getElementById('serviceTypeBox');

    const certificateBox =
        document.getElementById('certificateBox');

    function toggleFields() {

        const selectedRole =
            document.querySelector('input[name="role"]:checked')?.value;

        if (selectedRole === 'provider') {

            serviceBox.classList.remove('hidden');
            certificateBox.classList.remove('hidden');

        } else {

            serviceBox.classList.add('hidden');
            certificateBox.classList.add('hidden');

        }

    }

    toggleFields();

    roleInputs.forEach(input => {

        input.addEventListener('change', toggleFields);

    });

});

// 👁 PASSWORD
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