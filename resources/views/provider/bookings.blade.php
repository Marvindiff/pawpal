<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;

class ProviderController extends Controller
{
    // Provider dashboard
    public function dashboard()
    {
        $provider = auth()->user();

        // Optional: show recent bookings on dashboard
        $bookings = Booking::where('provider_id', $provider->id)->get();

        return view('providers.dashboard', compact('provider', 'bookings'));
    }

    // Toggle availability
    public function toggleAvailability(Request $request)
    {
        $provider = auth()->user();
        $provider->is_available = $request->is_available;
        $provider->save();

        return back()->with('success', 'Availability updated!');
    }

    // Optional: update profile info
    public function update(Request $request)
    {
        $provider = auth()->user();
        $provider->update($request->only(['bio','service_type','location']));
        return back()->with('success', 'Profile updated!');
    }
}