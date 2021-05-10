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
        session(["direction" => "ltr"]);
        if (!session('locale')) {
            session(["locale" => "en"]);
            App()->setLocale("en");
        }

        if (
            (strpos($request->server('HTTP_USER_AGENT'), 'Android') !== false) ||
            (strpos($request->server('HTTP_USER_AGENT'), 'iPhone') !== false)
            ) {
                ?>
    <!-- <html>
    <head>
    <script>
            var url = window.location.href;
            cosnole.log('url')
            if(url.includes('post_id')) {
                var value  = url.match(/post_id=(\d+)/i)[1];
                localStorage.setItem('last_link', 'phone/post/show?post_id='+ value)
                var y = setInterval(() => {
                    var x = localStorage.getItem('last_link')
                    if(x.includes('phone/post/show?post_id=')) {
                        clearInterval(y);
                    }
                }, 100);

            }
        </script>
        </head>
        </html> -->
        <?php
            return redirect("/phone");
        }

        return $next($request);
    }
}
