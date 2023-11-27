<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockURLMiddleware
{
    public function handle ( $request, Closure $next )
    {
        $blockedUrls = [ 
            'https://www.google.com',
            'https://www.shadowserver.org',
            'http://www.shadowserver.org',
            'www.shadowserver.org',
        ];

        if ( in_array ( $request->fullUrl (), $blockedUrls ) )
        {
            abort ( 403, 'Access denied.' );
        }

        return $next ( $request );
    }

}
