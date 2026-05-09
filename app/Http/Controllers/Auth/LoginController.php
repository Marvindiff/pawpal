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
    }

    // ✅ CLEAN ROLE REDIRECT (ONLY ONE SOURCE OF TRUTH)
    protected function redirectTo()
    {
        $user = auth()->user();

        if (!$user) {
            return '/login';
        }

        if ($user->role === 'provider') {
            return '/provider/dashboard';
        }

        if ($user->role === 'admin') {
            return '/admin/sitter-verifications';
        }
        if ($user->role === 'walker') {
            return '/walker/dashboard';
        }

        return '/dashboard';
    }
}