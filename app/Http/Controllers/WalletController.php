<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Models\Booking;

class WalletController extends Controller
{
    // 💰 ADD FUNDS (ADMIN ONLY)
    public function addFunds(Request $request, $user_id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = User::findOrFail($user_id);

        $user->wallet_balance += $request->amount;
        $user->save();

        WalletTransaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'credit',
            'description' => 'Admin added funds'
        ]);

        return redirect('/dashboard')->with('success', 'Funds added successfully!');
    }

    // 💸 PAY USING WALLET
    public function payWithWallet($booking_id)
    {
        $user = auth()->user();
        $booking = Booking::findOrFail($booking_id);

        // ❌ Must be approved
        if ($booking->status !== 'approved') {
            return back()->with('error', 'Booking must be approved first.');
        }

        // ❌ Prevent double payment
        if ($booking->payment_status === 'paid') {
            return back()->with('error', 'Already paid');
        }

        $amount = $booking->price;

        // ❌ Check balance
        if ($user->wallet_balance < $amount) {
            return back()->with('error', 'Insufficient balance');
        }

        // 💸 Deduct from USER
        $user->wallet_balance -= $amount;
        $user->save();

        // 💰 Add to WALKER
        $walker = User::find($booking->provider_id);
        $walker->wallet_balance += $amount;
        $walker->save();

        // 🧾 Log transactions
        WalletTransaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => 'debit',
            'description' => 'Payment for booking #' . $booking->id
        ]);

        WalletTransaction::create([
            'user_id' => $walker->id,
            'amount' => $amount,
            'type' => 'credit',
            'description' => 'Earning from booking #' . $booking->id
        ]);

        // ✅ Mark as paid
        $booking->payment_status = 'paid';
        $booking->save();

        return redirect()->route('dashboard')->with('success', 'Payment successful!');
    }
}