<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Booking;

class ProviderController extends Controller
{
   public function dashboard()
{
    $provider = Auth::user();

    // get bookings for this provider
    $bookings = Booking::where('provider_id', $provider->id)->get();

    return view('dashboard', compact('provider', 'bookings'));
}
public function bookings()
{
    $provider = Auth::user();

    $bookings = \App\Models\Booking::where('provider_id', $provider->id)->get();

    return view('provider.bookings', compact('bookings'));
}
public function index(Request $request)
    {
        // Only get providers who are available
        $query = User::where('role', 'provider');

        // Optional filters
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('location', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        $providers = $query->get();

        return view('find-providers', compact('providers'));
    }

    public function update(Request $request)
    {
        $provider = Auth::user(); // current provider

        // Validate input
        $request->validate([
            'bio' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'is_available' => 'required|boolean',
        ]);

        // Update provider info
        $provider->bio = $request->bio;
        $provider->location = $request->location;
        $provider->is_available = $request->is_available;
        $provider->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}