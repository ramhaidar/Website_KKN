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
    public function handle ( Request $request, Closure $next ) : Response
    {
        if ( Auth::check () )
        {
            if ( Auth::user ()->admin_id != null )
            {
                return redirect ()->route ( 'beranda_admin' );
            }
            elseif ( Auth::user ()->mahasiswa_id != null )
            {
                return redirect ()->route ( 'beranda_mahasiswa' );
            }
            elseif ( Auth::user ()->dpl_id != null )
            {
                return redirect ()->route ( 'beranda_dpl' );
            }
        }

        return $next ( $request );

    }
}
