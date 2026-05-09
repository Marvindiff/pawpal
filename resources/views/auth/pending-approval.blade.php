@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-100">

    <div class="bg-white p-8 rounded-2xl shadow-lg text-center w-full max-w-md">

        <!-- 🐾 TITLE -->
        <h1 class="text-2xl font-bold text-orange-500 mb-4">
            Pending Approval
        </h1>

        <!-- 📩 MESSAGE -->
        <p class="text-gray-600 mb-6">
            Your provider account is currently under review.<br>
            Please wait for admin approval before accessing your dashboard.
        </p>

        <!-- 🔄 OPTIONAL LOADER -->
        <div class="flex justify-center mb-6">
            <div class="w-6 h-6 border-4 border-indigo-500 border-dashed rounded-full animate-spin"></div>
        </div>

        <!-- 🔙 BACK TO LOGIN -->
        <a href="/login"
           class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            Back to Login
        </a>

        <!-- 🔓 LOGOUT BUTTON (RECOMMENDED) -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit"
                class="text-sm text-gray-500 hover:text-red-500">
                Logout instead
            </button>
        </form>

        <!-- 💡 EXTRA INFO -->
        <p class="text-xs text-gray-400 mt-6">
            You will be notified once your account is approved.
        </p>

    </div>

</div>
@endsection