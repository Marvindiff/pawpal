<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;

class ReviewController extends Controller
{
    // ⭐ SHOW REVIEW FORM
    public function create($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        // 🔐 security
        if ($booking->user_id != auth()->id()) {
            abort(403);
        }

        return view('review.create', compact('booking'));
    }

    // ⭐ SAVE REVIEW
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'provider_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'booking_id' => $request->booking_id,
            'user_id' => auth()->id(),
            'provider_id' => $request->provider_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('dashboard')->with('success', 'Review submitted!');
    }
}