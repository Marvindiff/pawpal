<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class TrackingController extends Controller
{
    public function update(Request $request)
    {
        $booking = Booking::find($request->booking_id);

        if ($booking) {

            $booking->latitude = $request->latitude;
            $booking->longitude = $request->longitude;

            $booking->save();
        }

        return response()->json([
            'success' => true
        ]);
    }
    public function getLocation($id)
{
    $booking = Booking::find($id);

    return response()->json([
        'latitude' => $booking->latitude,
        'longitude' => $booking->longitude
    ]);
}
}