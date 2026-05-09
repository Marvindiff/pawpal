<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProviderApprovalController extends Controller
{
   public function index()
{
    $providers = \App\Models\User::where('role', 'provider')
        ->where('status', 'pending')
        ->get();

    return view('admin.pending', compact('providers'));
}

    public function approve($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->status = 'approved';
    $user->save();

    return redirect()->route('admin.providers.pending')
        ->with('success', 'Provider approved!');
}

    public function decline($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->status = 'rejected';
    $user->save();

    return redirect()->route('admin.providers.pending')
        ->with('success', 'Provider declined!');
}
}