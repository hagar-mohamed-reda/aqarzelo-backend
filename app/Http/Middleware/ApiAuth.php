<?php

namespace App\Http\Middleware;
 

use Closure;
use App\User;
use App\Message;


class ApiAuth 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        if (!User::where("api_token", $request->api_token)->count() <= 0) {
            return Message::error(trans("messages_en.login_first"), trans("messages_ar.login_first"));
        } 
        
        return $next($request);
    }
}
