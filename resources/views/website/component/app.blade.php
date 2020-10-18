@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("en");

@endphp
@php

    //if (session("locale") == null)
    //    session(["locale" => "en"]);

    //if (session("direction") == null)
    //    session(["direction" => "ltr"]);

    if (session("locale") == "ar") {
        //session()->put('direction', 'rtl');
        session(["dir" => "rtl"]);
        session(["direction" => "rtl"]);
    } else {
       // session()->put('direction', 'ltr');
        session(["dir" => "ltr"]);
        session(["direction" => "ltr"]);
    }
@endphp
<!DOCTYPE html>
<html lang="{{ session('locale')? session('locale'): 'ar' }}" >
    <head>
        @yield("css")
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- css section -->
        @include("website.component.css")

        @include("website.component.loader")

        <title>Aqar Zelo</title>

        @if (session("locale") == "ar")
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <style type="text/css">
            * {
                font-family: 'Cairo', sans-serif;

            }
        </style>
        @endif
    </head>

    <body>
        @include("website.component.navbar")

        <div id="root" >

            @yield("content")

        </div>
    </body>


    <!-- js section -->
    @include("website.component.js")

    @yield("js")

    @include("website.component.notify")

    <script>
        $(document).ready(function(){
            $(".loader").fadeOut();
        });
    </script>
</html>
