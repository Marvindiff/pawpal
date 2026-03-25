<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // VALIDATION
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // CREATE USER
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            // 🔥 AUTO ROLE
            'role' => !empty($data['service_type']) ? 'provider' : 'user',

            'service_type' => $data['service_type'] ?? null,
        ]);
    }

    // 🔥 ROLE-BASED REDIRECT AFTER REGISTER
    protected function registered(Request $request, $user)
    {
        if ($user->role === 'provider') {
            return redirect('/provider/dashboard');
        }

        return redirect('/dashboard');
    }
}