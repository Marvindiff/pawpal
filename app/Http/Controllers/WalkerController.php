<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\WalletTransaction;
use App\Models\Review;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Models\Report;


class WalkerController extends Controller
{

public function reports()
{
    $reports = Report::where('reported_id', auth()->id())
        ->latest()
        ->get();

    return view('provider.reports', compact('reports'));
}
public function showBooking($id)
{
    $booking = \App\Models\Booking::with('user')->findOrFail($id);

    return view('walker.booking-show', compact('booking'));
}
    // 🏠 DASHBOARD
    public function dashboard()
    {
        $user = auth()->user();

        // bookings
        $walks = Booking::where('provider_id', $user->id)->latest()->get();

        // earnings (only completed)
        $earnings = Booking::where('provider_id', $user->id)
            ->where('status', 'completed')
            ->sum('price');

        // unread messages
        $unreadCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        // ⭐ reviews
        $reviews = Review::where('provider_id', $user->id)->latest()->get();

        // ⭐ average rating
        $averageRating = $reviews->count() > 0
            ? round($reviews->avg('rating'), 1)
            : 0;

        return view('walker.dashboard', compact(
            'walks',
            'earnings',
            'unreadCount',
            'reviews',
            'averageRating'
        ));
    }

    // 📋 WALK LIST
    public function walks()
    {
        $walks = Booking::where('provider_id', auth()->id())
            ->latest()
            ->get();

        return view('walker.walks', compact('walks'));
    }

    // 👁 VIEW BOOKING
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('walker.booking-show', compact('booking'));
    }

    // ✅ APPROVE
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->provider_id != auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Invalid action');
        }

        $booking->status = 'approved';
        $booking->save();

        return back()->with('success', 'Booking approved');
    }

    // ❌ REJECT + REFUND
    public function rejectWalk(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->provider_id != auth()->id()) {
            abort(403);
        }

        if ($booking->status === 'rejected') {
            return back()->with('error', 'Already rejected');
        }

        if ($booking->status === 'completed') {
            return back()->with('error', 'Cannot reject completed booking');
        }

        DB::transaction(function () use ($booking, $request) {

            if ($booking->payment_status === 'paid' && !$booking->is_refunded) {

                $user = User::find($booking->user_id);
                $walker = User::find($booking->provider_id);

                // deduct walker
                $walker->wallet_balance -= $booking->price;
                $walker->save();

                WalletTransaction::create([
                    'user_id' => $walker->id,
                    'amount' => $booking->price,
                    'type' => 'debit',
                    'description' => 'Refund deduction #' . $booking->id,
                ]);

                // refund user
                $user->wallet_balance += $booking->price;
                $user->save();

                WalletTransaction::create([
                    'user_id' => $user->id,
                    'amount' => $booking->price,
                    'type' => 'credit',
                    'description' => 'Refund #' . $booking->id,
                ]);

                $booking->is_refunded = true;
            }

            $booking->status = 'rejected';
            $booking->reject_reason = $request->reject_reason ?? 'Walker rejected';
            $booking->save();
        });

        return back()->with('success', 'Booking rejected + refunded');
    }

    // 🏁 COMPLETE
    public function completeWalk($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->provider_id != auth()->id()) {
            abort(403);
        }

        // support both systems (your current + clean)
        if (
            !(
                ($booking->status == 'approved' && $booking->payment_status == 'paid')
                || $booking->status == 'paid'
            )
        ) {
            return back()->with('error', 'Must be paid first');
        }

        if ($booking->status === 'completed') {
            return back()->with('error', 'Already completed');
        }

        $booking->status = 'completed';
        $booking->save();

        return back()->with('success', 'Walk completed!');
    }

    // 🟢 ONLINE/OFFLINE
    public function toggleAvailability(Request $request)
    {
        $user = auth()->user();

        $user->is_available = ! $user->is_available;
        $user->save();

        return back()->with('success', 'Availability updated!');
    }

    // 📅 SCHEDULE
    public function schedule()
    {
        $walks = Booking::where('provider_id', auth()->id())->get();
        return view('walker.schedule', compact('walks'));
    }
}