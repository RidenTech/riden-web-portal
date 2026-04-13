<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminModuleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $module
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $admin = auth()->guard('admin')->user();

        // Dashboard is a global requirement for any logged-in admin
        if ($module === 'Dashboard' && $admin) {
            return $next($request);
        }

        if (!$admin || !$admin->hasModuleAccess($module)) {
            $email = $admin->email ?? 'Unknown';
            \Log::warning("RBAC Denied: Admin [{$email}] tried to access module [{$module}]. Super: " . ($admin && $admin->is_super ? 'Yes' : 'No'));
            
            abort(403, "Unauthorized access to module [{$module}] for account [{$email}].");
        }

        return $next($request);
    }
}
