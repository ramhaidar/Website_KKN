<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMahasiswa
{
    public function handle ( Request $request, Closure $next ) : Response
    {
        if ( Auth::check () && Auth::user ()->mahasiswa_id != null )
        {
            return $next ( $request );
        }

        return redirect ()->route ( 'signin' );
    }

}
