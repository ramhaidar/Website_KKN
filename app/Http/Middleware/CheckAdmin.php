<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle ( Request $request, Closure $next ) : Response
    {
        if ( Auth::check () && Auth::user ()->admin_id != null )
        {
            return $next ( $request );
        }

        return redirect ()->route ( 'signin' );
    }

}
