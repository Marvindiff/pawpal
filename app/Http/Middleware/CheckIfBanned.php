<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ If logged in
        if (Auth::check()) {

            $user = Auth::user();

            // 🚫 If banned → force logout
            if ($user->status === 'banned') {

                Auth::logout();

                return redirect('/login')->withErrors([
                    'email' => '🚫 Your account has been banned. Contact admin.'
                ]);
            }
        }

        return $next($request);
    }
}