<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    // 📄 SHOW REGISTER PAGE
    public function create()
    {
        return view('auth.register');
    }

    // 🚀 REGISTER USER
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],

            // ROLE
            'role' => ['required', 'in:user,provider'],

            // SERVICE TYPE (ONLY PROVIDER)
            'service_type' => ['required_if:role,provider', 'in:sitter,walker'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],

            // 🔥 CERTIFICATE (ONLY PROVIDER)
            'certificate' => ['required_if:role,provider', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        $isProvider = $request->role === 'provider';

        // 📸 HANDLE FILE UPLOAD
        $certificatePath = null;

        if ($request->hasFile('certificate')) {
            $certificatePath = $request->file('certificate')
                ->store('certificates', 'public');
        }

        // 💾 CREATE USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'role' => $request->role,
            'service_type' => $isProvider ? $request->service_type : null,
            'status' => $isProvider ? 'pending' : 'approved',
            'mobile_number' => $request->mobile_number,
            'location' => $request->location,

            // 🔥 SAVE FILE PATH
            'certificate' => $certificatePath,
        ]);

        // 🚫 PROVIDER → WAIT APPROVAL
        if ($isProvider) {
            return redirect()->route('approval.pending');
        }

        // ✅ NORMAL USER LOGIN
        Auth::login($user);

        return redirect('/dashboard');
    }
}