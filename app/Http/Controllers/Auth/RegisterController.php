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

    protected function validator(array $data)
{
    // 🔥 Normalize role BEFORE validating
    $data['role'] = isset($data['role']) && in_array($data['role'], ['user', 'provider'])
        ? $data['role']
        : 'user';

    return \Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',

        'role' => 'required|in:user,provider',
        'service_type' => 'required_if:role,provider|in:sitter,walker',
    ]);
}

    protected function create(array $data)
{
    // same normalization here (safe)
    $role = (isset($data['role']) && in_array($data['role'], ['user','provider']))
        ? $data['role']
        : 'user';

    $isProvider = $role === 'provider';

    return \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => \Hash::make($data['password']),

        'role' => $role,
        'service_type' => $isProvider ? $data['service_type'] : null,
        'status' => $isProvider ? 'pending' : 'approved',
    ]);
}
    protected function registered(Request $request, $user)
    {
        if ($user->role === 'provider') {
            return redirect('/pending-approval');
        }

        return redirect('/dashboard');
    }
}