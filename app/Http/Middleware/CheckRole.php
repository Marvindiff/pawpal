<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // ❌ If role mismatch
        if (strtolower($user->role) !== strtolower($role)) {

            // 🐾 If provider → send properly
            if ($user->role === 'provider') {

                // ⛔ Not approved
                if (!$user->is_approved) {
                    return redirect()->route('approval.pending');
                }

                // ✅ Approved → go to correct dashboard
                if ($user->service_type === 'walker') {
                    return redirect()->route('walker.dashboard');
                }

                if ($user->service_type === 'sitter') {
                    return redirect()->route('provider.dashboard');
                }
            }

            // 👤 If normal user → allow only user dashboard
            if ($user->role === 'user') {
                return redirect('/dashboard');
            }

            // fallback
            return redirect('/');
        }

        return $next($request);
    }
}