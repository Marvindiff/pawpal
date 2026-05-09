<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 🔐 Only pet owners
        if ($user->role !== 'user') {
            return redirect()->route('provider.dashboard')
                ->with('error', 'Access denied.');
        }

        // 🔍 FILTER PROVIDERS
        $query = User::where('role', 'provider');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        $providers = $query->get();

        // ⭐ GET ALL REVIEWS GROUPED BY provider_id
        $reviewsGrouped = Review::all()->groupBy('provider_id');

        // ⭐ ATTACH RATINGS TO PROVIDERS
        foreach ($providers as $provider) {

            if (isset($reviewsGrouped[$provider->id])) {

                $providerReviews = $reviewsGrouped[$provider->id];

                $provider->average_rating = round($providerReviews->avg('rating'), 1);
                $provider->total_reviews = $providerReviews->count();

            } else {

                $provider->average_rating = 0;
                $provider->total_reviews = 0;
            }
        }

        // ✅ IMPORTANT: make sure this matches your blade
        return view('dashboard', compact('user', 'providers'));
    }
}