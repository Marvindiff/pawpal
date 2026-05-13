<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Booking;
use App\Models\Service;
use App\Models\Message; 
use App\Models\Report;


class ProviderController extends Controller
{

public function reports()
{
    $reports = Report::where('reported_id', auth()->id())
        ->latest()
        ->get();

    return view('provider.reports', compact('reports'));
}

    public function dashboard()
    {
        $provider = Auth::user();

        // 📦 BOOKINGS
        $bookings = Booking::where('provider_id', $provider->id)->get();

        // 💬 UNREAD MESSAGES COUNT
        $unreadCount = Message::where('receiver_id', $provider->id)
            ->where('is_read', 0)
            ->count();

        return view('provider.dashboard', compact('provider', 'bookings', 'unreadCount'));
    }

   public function toggleAvailability(Request $request)
{
    $provider = Auth::user();

    // 🔥 FORCE BOOLEAN VALUE
    $provider->is_available =
        $request->has('is_available') ? 1 : 0;

    $provider->save();

    return redirect()->back()->with(
        'success',
        'Availability updated!'
    );
}
    public function services()
    {
        $provider = auth()->user();
        $services = Service::where('provider_id', $provider->id)->get();

        return view('provider.services', compact('services'));
    }

   // ✏️ SHOW EDIT FORM
public function editService($id)
{
    $service = Service::findOrFail($id);
    return view('provider.edit-service', compact('service'));
}

// ✏️ UPDATE SERVICE
public function updateService(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
    ]);

    $service = Service::findOrFail($id);

    $service->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    return redirect()->route('provider.services')->with('success', 'Service updated!');
}

// 🗑 DELETE SERVICE
public function deleteService($id)
{
    $service = Service::findOrFail($id);
    $service->delete();

    return redirect()->back()->with('success', 'Service deleted!');
}

// 🗑 DELETE

    public function storeService(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Service::create([
            'provider_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Service added!');
    }

    public function bookings()
    {
        $provider = Auth::user();

        $bookings = Booking::where('provider_id', $provider->id)->get();

        return view('provider.bookings', compact('bookings'));
    }

    public function index(Request $request)
    {
        // Base query
        $query = User::where('role', 'provider')
                     ->where('is_available', 1);

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('location', 'like', '%'.$request->search.'%');
            });
        }

        // 🔥 TYPE FILTER (BUTTON CLICK)
        if ($request->filled('type')) {
            $query->where('service_type', $request->type);
        }

        // OPTIONAL manual filter
        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        $providers = $query->get();

        return view('find-providers', compact('providers'));
    }

    public function update(Request $request)
    {
        $provider = Auth::user();

        $request->validate([
            'bio' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'is_available' => 'required|boolean',
        ]);

        $provider->bio = $request->bio;
        $provider->location = $request->location;
        $provider->is_available = $request->is_available;
        $provider->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}