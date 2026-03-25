<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // Pet Owner: view their bookings
    public function index()
    {
        $user = auth()->user(); // logged-in pet owner
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('bookings', compact('bookings')); // your single bookings.blade.php
    }

    // Provider: view bookings assigned to them
    public function providerBookings()
    {
        $provider = auth()->user();
        $bookings = Booking::where('provider_id', $provider->id)->get();

        return view('bookings', compact('bookings')); // same bookings.blade.php
    }

    // Store new booking (pet owner books provider)
    public function store(Request $request)
    {
        Booking::create([
            'user_id' => auth()->id(),
            'provider_id' => $request->provider_id,
            'date' => now(),
            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking sent!');
    }

    // Approve booking (provider)
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved!');
    }

    // Reject booking (provider)
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking rejected!');
    }
}