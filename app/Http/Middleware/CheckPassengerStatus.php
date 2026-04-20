<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPassengerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        /** @var \App\Models\Passenger|\App\Models\User|null $user */
        $user = $request->user();

        // Check if the user exists and their status is not 'Active'
        if ($user && $user->status !== 'Active') {
            
            // Revoke all tokens immediately to force logout on mobile
            $user->tokens()->delete();

            return response()->json([
                'status' => 'error',
                'message' => 'Your account is currently ' . ($user->status ?? 'inactive') . '. Please contact support.',
                'account_status' => $user->status
            ], 403);
        }

        return $next($request);
    }
}
