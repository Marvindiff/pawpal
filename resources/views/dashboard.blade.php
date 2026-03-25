                    @extends('layouts.app') {{-- Using traditional layout --}}

                    @section('content')
                    <div class="min-h-screen bg-gray-100 p-6">

                        <!-- Header -->
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
                            <h1 class="text-3xl font-bold text-blue-700">Welcome, {{ Auth::user()->name }}!</h1>
                            <div class="mt-4 md:mt-0">
                                <a href="{{ route('profile.edit') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Edit Profile
                                </a>
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400 transition ml-2">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <!-- Main Dashboard Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <!-- Profile Card -->
                            <div class="bg-white shadow rounded p-6">
                                <h2 class="text-xl font-semibold mb-2 text-blue-700">Profile Info</h2>
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>
                                @if(Auth::user()->role === 'provider')
                                    <p><strong>Service:</strong> {{ ucfirst(str_replace('_',' ', Auth::user()->service_type)) ?? 'N/A' }}</p>
                                    <p><strong>Availability:</strong> 
                                        @if(Auth::user()->is_available)
                                            <span class="text-green-600 font-bold">Available</span>
                                        @else
                                            <span class="text-red-600 font-bold">Not Available</span>
                                        @endif
                                    </p>
                                @endif
                            </div>

                            <!-- Quick Actions Card -->
                            <div class="bg-white shadow rounded p-6">
                                <h2 class="text-xl font-semibold mb-4 text-blue-700">Quick Action</h2>
                                @if(Auth::user()->role === 'provider')
                                    <a href="#" class="block mb-3 bg-yellow-400 text-blue-800 px-4 py-2 rounded hover:bg-yellow-300 hover:text-blue-900 text-center transition">
                                        View Bookings
                                    </a>
                                    <a href="#" class="block mb-3 bg-green-400 text-white px-4 py-2 rounded hover:bg-green-300 text-center transition">
                                        Manage Services
                                    </a>
                                    <form method="POST" action="{{ route('provider.update') }}">
                                        @csrf
                                        <button class="block w-full bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                            Toggle Availability
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('find.providers') }}" class="block mb-3 bg-yellow-400 text-blue-800 px-4 py-2 rounded hover:bg-yellow-300 hover:text-blue-900 text-center transition">
                                        Find Pet Sitters
                                    </a>
                                    <a href="{{ route('bookings.index') }}" class="block mb-3 bg-green-400 text-white px-4 py-2 rounded hover:bg-green-300 text-center transition">
                                        View Bookings
                                    </a>
                                @endif
                            </div>

                            <!-- Contact / Stats Card -->
                            <div class="bg-white shadow rounded p-6">
                                <h2 class="text-xl font-semibold mb-4 text-blue-700">Contact & Stats</h2>
                                @if(Auth::user()->role === 'provider')
                                    <p>Total Bookings: 0</p>
                                    <p>Average Rating: N/A</p>
                                    <p>Contact: provider@example.com</p>
                                @else
                                    <p>Saved Providers: 0</p>
                                    <p>Upcoming Bookings: 0</p>
                                    <p>Support Contact: support@pawpal.com</p>
                                @endif
                            </div>

                        </div>

                        <!-- Optional Providers Grid (for Pet Owners) -->
                        @if(Auth::user()->role === 'user')
                            <div class="mt-8">
                                <h2 class="text-2xl font-bold text-blue-700 mb-4">Available Pet Sitters</h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    @forelse($providers ?? [] as $provider)
                                    <div class="bg-white shadow rounded p-4 flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <img src="{{ $provider->avatar ?? 'https://via.placeholder.com/80' }}" alt="Avatar" class="rounded-full w-16 h-16 mr-3">
                                            <div>
                                                <h3 class="text-lg font-semibold text-blue-700">{{ $provider->name }}</h3>
                                                <p class="text-blue-500">{{ ucfirst(str_replace('_',' ', $provider->service_type)) }}</p>
                                            </div>
                                            @if($provider->is_available)
                                            <span class="ml-auto bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Available Now</span>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 flex-grow">{{ $provider->bio ?? 'No bio available.' }}</p>
                                        <button class="mt-3 bg-yellow-400 text-blue-800 px-4 py-2 rounded hover:bg-yellow-300 hover:text-blue-900 transition">
                                            Contact
                                        </button>
                                    </div>
                                    @empty
                                        <p class="text-gray-600">No providers available at the moment.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                    </div>
                    @endsection