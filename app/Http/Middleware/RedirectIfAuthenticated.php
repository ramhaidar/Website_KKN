<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->admin_id != null ) { $role = 'admin'; }
                elseif ($user->dpl_id != null ) { $role = 'dosen'; }
                else { $role = 'mahasiswa'; }

                $route = sprintf('%s.beranda', $role);

                return redirect()->route($route);
            }
        }

        return $next($request);
    }
}
