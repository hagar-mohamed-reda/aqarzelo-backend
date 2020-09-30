@php

if (session("locale"))
    App()->setLocale(session("locale")); 
else
    App()->setLocale("en"); 

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
