
<span class="hidden">{{ session('direction') }}</span>
@php

    if (session("locale") == null)
        session(["locale" => "en"]);

    if (session("direction") == null)
        session(["direction" => "ltr"]);

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
