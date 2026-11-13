<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Memastikan akun pengguna sudah disetujui Administrator.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->registration_status !== 'active') {
            $status = $user?->registration_status;

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($status === 'pending') {
                return redirect()
                    ->route('login')
                    ->with('status', 'account-pending');
            }

            return redirect()
                ->route('login')
                ->with('status', 'account-rejected');
        }

        return $next($request);
    }
}