@php

// change language if require
if (request()->lang) {
    session(["locale" => request()->lang]);
	if (request()->lang == "en")
		$direction = "ltr";
	else
		$direction = "rtl";

	session(["direction" => $direction]);
}

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp


@php


    if (!session("locale"))
        session(["locale" => "en"]);

    if (!session("direction"))
        session(["direction" => "ltr"]);

@endphp

<!DOCTYPE html>
<html lang="{{ session('locale')? session('locale'): 'ar' }}" >
    <head>
        @yield("css")
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- css section -->
        @include("mobile.css")

        <title>aqar zelo</title>
            <!-- Compiled and minified CSS -->

        @if (session("locale") == "ar")
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

        <style type="text/css">
            * {
                font-family: 'Cairo', sans-serif;
            }

            .application-container {
                direction: rtl;
                text-align: right;
            }
            .w3-bar .w3-bar-item {
                float: right;
            }

            .w3-col {
                float: right;
            }
            .media {
                direction: rtl;
                text-align: right;
            }

            .w3-ul li div {
                text-align: right;
            }
        </style>
        @endif

        <style type="text/css">
            #page {
                background-image: repeating-linear-gradient(to bottom, #02A2A7 15%, #02A2A7 7%, #06D9B2 30%)!important;
            }

            .application-container {
                border-top-left-radius: 2em;
                border-top-right-radius: 2em;
                background-color: white;
                overflow: hidden;
            }

            .application-header {
                height: 65px;
            }

            .application-header-no-padding  {
                padding: 0px!important;
            }

            .application-bottom-nav {
                border-top-left-radius: 2em;
                border-top-right-radius: 2em;
                background-color: white;
            }

            .bottom-nav-content {
                height: 60px;
                border-radius: 5em;
                /*background-color: #DEDEDE;*/
            }
        </style>

        <script>
            var last_posts = [];
        </script>

    </head>

    <body>
        <div
            class="w3-modal application-loader"
            style="background: rgba(0,0,0,.6);padding-top: 50%!important;z-index: 9999999!important" >

            <center>
            	<img src="{{ url('/mobile/images/logo.png') }}" class="animated bounceIn infinite"  width="60vw" >
            	<br>
            	<br>
            	<b class="w3-large w3-text-shadow w3-text-white" >{{ __('mobile.please_wait') }}..</b>
            </center>
        </div>

        <div id="root" v-html="content" >

        </div>
    </body>

    <!-- css section -->
    @include("website.component.js")

    <!-- Compiled and minified JavaScript -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        var last_path = null;
        var current_path = null;
        var last_paths = [];
        var BASE_URL = "{{ url('/api') }}";

        function loadSplash() {
            $.get("{{ url('/phone/splash') }}", function(r){
                $('#root').html(r);
            });
        }

        function formatCurrency(number) {

        }

        function getLocation(action) {
            var located = false;
            var latLng = {
                lat: 30.0596185,
                lng: 31.1884236
            };

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    located = true;

                    if (action)
                        action({lat: lat, lng: lng});
                });
            }

            if (!located) {
                if (action)
                    action({lat: latLng.lat, lng: latLng.lng});
            }
        }

        function loadPage(path, action) {
            // show loading
            $(".application-loader").show();

            last_paths.push(path);
            current_path = path;
            localStorage.setItem("last_link", path);
            $.get(public_path + "/" + path, function(r){
                $('#root').html(r);
                if (action)
                    action(r);

                // hide loading
                $(".application-loader").hide();
            });
        }

        function loadPage2(path, action) {
            // show loading
            $(".application-loader").show();

            localStorage.setItem("last_link", path);
            $.get(public_path + "/" + path, function(r){
                $('#root').html(r);
                if (action)
                    action(r);

                // hide loading
                $(".application-loader").hide();
            });
        }

        function back() {
            if (last_paths.length > 0) {
                var p = last_paths.pop();

                if (current_path == p)
                        p = last_paths.pop();

                if (last_paths.length > 0) {
                    loadPage2(p);
                }

                return;
            } else {
                return loadPage('phone/home');
            }

            return loadPage('phone/home');
        }

        function errorToast(message, action=null) {
            playSound("not2");

            /*iziToast.show({
                class: 'w3-pale-red shadow izitoast',
                timeout: 2000,
                message: message,
            });*/
            showTast(message, "error", action=null);
        }

        function successToast(message, action=null) {
            playSound("not2");
            /*iziToast.show({
                class: 'w3-green shadow izitoast',
                timeout: 2000,
                message: message,
            });*/
            showTast(message, "success", action=null);
        }

        function showTast(message, type, action=null) {
            // remove old
            $(".mobile-message-dialog").remove();

            var container = document.createElement('div');
            var content = document.createElement('div');
            var body = document.createElement('div');

            var imgUrl = type == 'success'? '{{ url("/images/message-success.gif") }}' :  '{{ url("/images/message-error.gif") }}';

            container.style.zIndex = "9999999999";
            container.className = "w3-modal mobile-message-dialog";
            content.className = "modal-dialog modal-sm w3-display-container";
            body.className = "modal-content w3-padding w3-center text-center w3-animate-zoom";
            content.style.marginTop = "60%";

            body.innerHTML =
                '<img src="'+imgUrl+'" width="130px" > <br> <div class="text-xlarge" >'+message+'</div><br><br>';

            content.appendChild(body);
            container.appendChild(content);

            content.innerHTML +=  '<button onclick="$(\'.mobile-message-dialog\').hide();" style="padding: 8px 16px!important;margin-bottom: -10px" class="w3-display-bottommiddle w3-padding text-capitalize btn light-theme-background w3-large w3-text-white w3-round-xlarge shadow current-location-btn" >{{ __("mobile.ok") }}</button>';

            container.onclick= function(){
                $(".mobile-message-dialog").hide();
            };
            document.body.appendChild(container);
            $(".mobile-message-dialog").show();
            /*
            img = public_path + "/mobile/images/logo.png";

            playSound("not2");
            var html =
                    "<table class='w3-text-white w3-black' style='direction: ltr!important' >" +
                    "<tr>" +
                    "<td><img src='" + img + "' class='w3-' width='30px'  ></td>" +
                    "<td style='padding:7px' class='w3-text-white'  >" +
                    "<p style='margin-top: 5px!important' class='w3-large' ><b>" + message + "</b></p>" +
                    "</td>" +
                    "</tr>" +
                    "</table>";
            $instance = iziToast.show({
                class: 'shadow izitoast w3-black',
                timeout: 4000,
                position: 'bottomCenter',
                message: html,
            });*/
            if (action) {
                action(container);
            }
        }
    </script>
    <script>
        var app = new Vue({
            el: '#root',
            data: {
                api_token: window.localStorage.getItem("api_token"),
                content: ''
            },
            methods: {

            },
            computed: {
                height: function(){
                    return window.innerHeight;
                }
            }
        });

        $(document).ready(function(){
            var lastLink = localStorage.getItem("last_link");
            var postId = '{{ request()->post_id }}';

            if (postId.length > 0) {
                loadPage('phone/post/show?post_id={{ request()->post_id }}');
                return;
            }

            if (lastLink && lastLink != 'undefined') {
                loadPage(lastLink);
                return;
            }

            // set full screen
            //document.documentElement.requestFullscreen();

            // load splash screen
            loadSplash();

        });
    </script>
</html>
