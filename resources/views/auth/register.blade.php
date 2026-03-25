<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-10 space-y-6 bg-white p-8 rounded shadow-lg">
        @csrf

        <h1 class="text-2xl font-bold text-blue-700 text-center mb-6">Create your PawPal account</h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Service Type -->
        <div>
            <x-input-label for="service_type" :value="__('I want to offer services as')" />
            <select id="service_type" name="service_type" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pet Owner</option>
                <option value="pet_sitting" {{ old('service_type') == 'pet_sitting' ? 'selected' : '' }}>Pet Sitter</option>
                <option value="dog_walking" {{ old('service_type') == 'dog_walking' ? 'selected' : '' }}>Dog Walker</option>
            </select>
            <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4 bg-yellow-400 text-blue-800 hover:bg-yellow-300 hover:text-blue-900 px-4 py-2 rounded font-semibold">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>