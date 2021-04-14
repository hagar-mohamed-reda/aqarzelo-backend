
<span class="hidden">{{ session("dir") }}</span>
<span class="hidden">{{ session()->get('locale') }}</span>
@php

    //if (session("locale") == null)
    //    session(["locale" => "en"]);

    //if (session("direction") == null)
    //    session(["direction" => "ltr"]);

    if (session("locale") == "ar") {
        //session()->put('direction', 'rtl');
        session(["dir" => "rtl"]);
    } else {
       // session()->put('direction', 'ltr');
        session(["dir" => "ltr"]);
    }
@endphp


<link rel="stylesheet" href="{{ url('/website') }}/css/animate.css">

<link rel="stylesheet" href="{{ url('/website') }}/css/iziToast.css">

@if (session("direction") == "rtl")
<link rel="stylesheet" href="{{ url('/website') }}/css/bootstrap.rtl.full.min.css">
@else
<link rel="stylesheet" href="{{ url('/website') }}/css/bootstrap.min.css">
@endif

<link rel="stylesheet" href="{{ url('/website') }}/css/w3.css">

<link rel="stylesheet" href="{{ url('/website') }}/css/app.css">
<!--
<link rel="stylesheet" href="{{ url('/website') }}/css/AdminLTE.css">
-->
<link rel="stylesheet" href="{{ url('/website') }}/css/bootstrap-slider.min.css">

<link rel="stylesheet" href="{{ url('/website') }}/css/owl.carousel.min.css">

<link rel="stylesheet" href="{{ url('/website') }}/css/owl.theme.default.min.css">

<link rel="stylesheet" href="{{ url('/website') }}/css/photo-sphere-viewer.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css?family=Text+Me+One&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Amiri|Cairo|Katibeh|Markazi+Text|Scheherazade&display=swap" rel="stylesheet">

<link rel="icon" href="{{ asset('backend/logopng.ico') }}"  type="image/x-icon">


<style>
    *, .font {
        font-family: 'Cairo', sans-serif;
    }
    #filterToggleSidebarBtn .fa-angle-left {
        font-size:20px !important;
    }
    #filterToggleSidebarBtn .fa-angle-right {
        font-size:20px !important;
    }
    .gmnoprint{
        bottom: 75% !important;
    }
    /*.gm-style .gmnoprint{
        display: none
    }*/
    .gm-svpc{
        top: -40px !important;
        left: 178px !important;
    }
    #map{
        height: 100% !important;
    }
    .gm-style-cc div:first-child() div:nth-child(2){
        display: none
    }
    /*.gmnoprint{
        display: none
    }*/

</style>

<script>
    var public_path = '{{ url("/") }}';
    var TITLE = 'aqar zilo';
    // max uploaded file size
    var MAX_UPLOADED_FILE = 5; // 5 MB

    // max uploaded image size
    var MAX_UPLOADED_IMAGE = 3; // 3 MB

    // langauge of the app
    var LANG = "{{ session('locale') }}";

    // messages
    var LOGIN_FIRST = "{{ __('words.login_first') }}";
    var ARE_YOU_SURE = "{{ __('words.are_you_sure') }}";
</script>
