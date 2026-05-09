<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProviderApproval
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // ✅ Check if provider
        if ($user && $user->role === 'provider') {

            // ❌ Not approved
            if (!$user->is_approved) {

                // ✅ Prevent redirect loop
                if ($request->routeIs('approval.pending')) {
                    return $next($request);
                }

                return redirect()->route('approval.pending');
            }
        }

        return $next($request);
    }
}