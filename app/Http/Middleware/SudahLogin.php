<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SudahLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle( Request $request, Closure $next ) : Response
    {
        if ( Auth::check () )
        {
            $user = Auth::user();
            if ($user->admin_id != null ) { $role = 'admin'; }
            elseif ($user->dpl_id != null ) { $role = 'dpl'; }
            else { $role = 'mahasiswa'; }

            return redirect()->route('beranda_' . $role);
        }

        return $next ( $request );

    }
}
