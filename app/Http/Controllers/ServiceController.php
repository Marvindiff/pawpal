<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // Show all services for logged-in provider
    public function index()
    {
        $provider = Auth::user();
        $services = Service::where('provider_id', $provider->id)->get();

        return view('provider.services', compact('services', 'provider'));
    }

    // Add a new service
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    Service::create([
        'provider_id' => Auth::id(),
        'title' => $request->title,
        'price' => $request->price,
    ]);

    return back()->with('success', 'Service added successfully!');
}

    // Delete a service
    public function destroy($id)
    {
        $service = Service::where('provider_id', Auth::id())->findOrFail($id);
        $service->delete();

        return back()->with('success', 'Service deleted successfully!');
    }

    <?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(
            Service::all()
        );
    }
}
}