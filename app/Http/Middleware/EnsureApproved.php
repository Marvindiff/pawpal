<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // 🚫 BLOCK if not approved
        if ($user->status !== 'approved') {
            return redirect('/pending-approval')
                ->withErrors(['error' => '⏳ Waiting for admin approval.']);
        }

        return $next($request);
    }
}