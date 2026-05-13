<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    // 🔐 SHOW LOGIN PAGE
    public function create()
    {
        return view('auth.login');
    }

    // 🔐 LOGIN LOGIC
   public function store(Request $request)
{
    // ✅ VALIDATE
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // 🔍 FIND USER
    $user = User::where('email', $request->email)->first();

    // ❌ USER NOT FOUND
    if (!$user) {
        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ])->withInput();
    }

    // 🚫 BANNED USER
    if ($user->status === 'banned') {
        return back()->withErrors([
            'email' => '🚫 Your account is banned due to multiple violations.'
        ])->withInput();
    }

    // 🚫 BLOCK PROVIDER IF NOT APPROVED
if ($user->role === 'provider' && $user->status !== 'approved') {

    return back()->withErrors([

        'email' =>
        '⏳ Your account is still waiting for admin approval.'

    ])->withInput();

}

    // 🚫 BLOCK NON-ADMIN ON ADMIN LOGIN
    if ($request->is('admin/*') && $user->role !== 'admin') {
        return back()->withErrors([
            'email' => '🚫 Only admin can login here.'
        ])->withInput();
    }

    // ❌ WRONG PASSWORD
    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ])->withInput();
    }

    // ✅ LOGIN SUCCESS
    $request->session()->regenerate();
    $user = Auth::user();

    // 🔥 PREPARE PENALTY WARNING (AFTER LOGIN)
    $warning = null;

    if ($user->penalty == 1) {
        $warning = '⚠ You have 1 penalty.';
    }

    if ($user->penalty == 2) {
        $warning = '⚠⚠ Final Warning: One more violation will ban your account.';
    }

    // 🧑‍💼 ADMIN
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard')->with('warning', $warning);
    }

  // 🐾 PROVIDER
if ($user->role === 'provider') {

    // 🚶 WALKER
    if ($user->service_type === 'walker') {

        return redirect('/walker/dashboard')
            ->with('warning', $warning);

    }

    // 🐾 SITTER
    if ($user->service_type === 'sitter') {

        return redirect('/provider/dashboard')
            ->with('warning', $warning);

    }

}

    // 👤 USER
    return redirect('/dashboard')->with('warning', $warning);
}

    // 🚪 LOGOUT
    public function destroy(Request $request)
    {
        $user = auth()->user(); // get role before logout

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🧑‍💼 ADMIN → admin login
        if ($user && $user->role === 'admin') {
            return redirect('/admin/login');
        }

        // 👤 USER + 🐾 PROVIDER → landing page
        return redirect('/');
    }
}