<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review; // ✅ ADD THIS

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

        // ⭐ ATTACH RATINGS TO EACH PROVIDER
        foreach ($providers as $provider) {

            $reviews = Review::where('provider_id', $provider->id)->get();

            $provider->average_rating = $reviews->count() > 0
                ? round($reviews->avg('rating'), 1)
                : 0;

            $provider->total_reviews = $reviews->count();
        }

        return view('home', compact('user', 'providers'));
    }
}