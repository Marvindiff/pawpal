<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // 🔥 ROLE-BASED REDIRECT AFTER LOGIN
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'provider') {
            return redirect('/provider/dashboard');
        }

        return redirect('/dashboard');
    }
}