<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ✅ Make sure to import User

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Only pet owners can access this
        if ($user->role !== 'user') {
            return redirect()->route('provider.dashboard')->with('error', 'Access denied.');
        }

        // Fetch all providers (sitters & walkers) optionally filter by search
        $query = User::where('role', 'provider');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        $providers = $query->get();

        return view('home', compact('user', 'providers'));
    }
}