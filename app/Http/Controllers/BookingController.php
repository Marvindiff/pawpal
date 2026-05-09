<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->get();
        return view('user.bookings', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'provider'])->findOrFail($id);

        // 🔐 SECURITY
        if (
            $booking->user_id != auth()->id() &&
            $booking->provider_id != auth()->id()
        ) {
            abort(403);
        }

        return view('booking.receipt', compact('booking'));
    }

    public function providerBookings()
    {
        $bookings = Booking::where('provider_id', auth()->id())->get();
        return view('provider.bookings', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provider_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        // 🔥 GET WALKER
        $provider = User::findOrFail($request->provider_id);

        $schedule = $request->date . ' ' . $request->time;

        Booking::create([
            'user_id' => auth()->id(),
            'provider_id' => $provider->id,
            'schedule' => $schedule,

            // ✅ FIX HERE (IMPORTANT)
            'price' => $provider->price,

            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking sent!');
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->provider_id != auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved!');
    }

  public function reject($id)
{
    $booking = \App\Models\Booking::findOrFail($id);

    $user = \App\Models\User::findOrFail($booking->user_id);

    $amount = (float) ($booking->amount ?? $booking->price ?? 0);

    // 🔥 FORCE REFUND (ignore condition)
    $user->wallet_balance += $amount;
    $user->save();

    $booking->update([
        'status' => 'rejected',
        'payment_status' => 'refunded'
    ]);

   return back()->with('success', 'Booking rejected and refunded successfully!');
}

}