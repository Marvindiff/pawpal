<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckServiceType
{
    public function handle(Request $request, Closure $next, $type)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/');
        }

        // 🔥 SAFE NORMALIZATION
        $userType = strtolower(trim($user->service_type ?? ''));

        // ❌ If no service_type → block properly
        if (!$userType) {
            return redirect('/dashboard')
                ->withErrors(['error' => 'Service type not set.']);
        }

        // ❌ Wrong service → redirect to correct dashboard
        if ($userType !== strtolower($type)) {

            if ($userType === 'walker') {
                return redirect()->route('walker.dashboard');
            }

            if ($userType === 'sitter') {
                return redirect()->route('provider.dashboard');
            }

            return redirect('/dashboard');
        }

        return $next($request);
    }
}