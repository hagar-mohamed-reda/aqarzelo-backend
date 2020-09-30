<?php

namespace App\Http\Middleware;
 

use Closure; 
use Illuminate\Http\Request;


class Mobile 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle(Request $request, Closure $next)
    { 
        if (
            (strpos($request->server('HTTP_USER_AGENT'), 'Android') !== false) ||
            (strpos($request->server('HTTP_USER_AGENT'), 'iPhone') !== false) 
            ) {
            return redirect("/phone");
        }
        
        return $next($request);
    }
}
