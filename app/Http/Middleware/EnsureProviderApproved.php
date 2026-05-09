<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProviderApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // ✅ Only apply to providers
        if ($user && $user->role === 'provider') {

            // 🔥 FIX: use status instead of is_approved
            if ($user->status !== 'approved') {

                // ✅ Allow safe routes
                if (
                    $request->routeIs('approval.pending') ||
                    $request->is('login') ||
                    $request->is('logout')
                ) {
                    return $next($request);
                }

                return redirect()->route('approval.pending')
                    ->withErrors([
                        'error' => '⏳ Your account is still waiting for admin approval.'
                    ]);
            }
        }

        // ✅ Always allow request if no issues
        return $next($request);
    }
}