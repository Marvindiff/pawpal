<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    // 📋 PAYMENT LIST
    public function index()
    {
        $payments = Booking::where('payment_method', 'gcash')
            ->latest()
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    // ✅ APPROVE PAYMENT
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'payment_status' => 'paid',
            'payment_verified_at' => now(),
        ]);

        return back()->with('success', 'Payment approved successfully.');
    }

    // ❌ REJECT PAYMENT
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'payment_status' => 'rejected',
        ]);

        return back()->with('error', 'Payment rejected.');
    }
}