<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;


class CompanyAuth
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session("company")) {
            return redirect("/company/login");
        }

        return $next($request);
    }
}
