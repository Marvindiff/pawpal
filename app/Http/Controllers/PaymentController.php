<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    // 🧾 SHOW PAYMENT SELECTION PAGE
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('payment.select', compact('booking'));
    }

    // 💳 PROCESS PAYMENT METHOD
    public function process(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $method = $request->payment_method;

        $amount = (float) ($booking->amount ?? $booking->price ?? 0);
        $user = auth()->user();

        // 💰 WALLET PAYMENT
        if ($method === 'wallet') {

            if ($amount <= 0) {
                return back()->with('error', 'Invalid booking amount');
            }

            if ($user->wallet_balance < $amount) {
                return back()->with('error', 'Insufficient balance');
            }

            // deduct balance
            $user->wallet_balance -= $amount;
            $user->save();

        $booking->update([

    'payment_method' => 'wallet',

    // ✅ PAYMENT
    'payment_status' => 'paid',

    // ✅ KEEP BOOKING APPROVED
    'status' => 'approved',

]);

            return redirect()->route('bookings.index')
                ->with('success', 'Payment successful!');
        }

        // 📱 GCASH PAYMENT (REDIRECT TO UPLOAD PAGE)
        if ($method === 'gcash') {

            $booking->update([
                'payment_method' => 'gcash',
                'payment_status' => 'pending',
                'status' => 'approved'
            ]);

            // ✅ FIXED: go to SHOW page, not POST route
            return redirect()->route('payment.gcash.show', $booking->id);
        }

        return back()->with('error', 'Please select a payment method');
    }

    // 📱 SHOW GCASH UPLOAD PAGE
    public function showGcash($id)
    {
        $booking = Booking::findOrFail($id);

        return view('payment.gcash', compact('booking'));
    }

    // 📤 PROCESS GCASH UPLOAD
    public function processGcash(Request $request, $id)
{
    $request->validate([
        'proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $booking = \App\Models\Booking::findOrFail($id);

    // 📤 upload proof
    $path = $request->file('proof')->store('gcash_proofs', 'public');

    // ✅ SAVE PAYMENT INFO
    $booking->payment_method = 'gcash';
    $booking->payment_status = 'pending';
    $booking->gcash_proof = $path;

    $booking->save();

    return redirect()->route('user.bookings')
        ->with('success', 'GCash proof uploaded successfully. Waiting for admin approval.');
}

public function checkStatus($id)
{
    $booking = \App\Models\Booking::findOrFail($id);

    return response()->json([
        'payment_status' => $booking->payment_status
    ]);
}
}