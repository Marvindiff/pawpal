<section>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="border w-full p-2">
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="border w-full p-2">
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label>Bio</label>
            <textarea name="bio" class="border w-full p-2">{{ old('bio', auth()->user()->bio) }}</textarea>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', auth()->user()->location) }}" class="border w-full p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</section>