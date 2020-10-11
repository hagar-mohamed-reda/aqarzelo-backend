@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp

@section("css")
<style>
    .sign-up-button {
        border: 1px solid white!important;
        color: white!important;
        border-radius: 5em!important;
        width: 200px;
    }
</style>
@endsection

@section("content")


<div class="modal show login-background" style="z-index: -1;" >
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="w3-modal-content shadow w3-round w3-white w3-display-container" style="height: 530px;width: 70%;padding: 0px!important" >


        <div class="row" >
            <div class="w3-col l7 m7 s7" >

                    <div class="w3-padding text-center w3-xxxlarge dark-theme-color text-capitalize" >
                        <span style="font-weight: 500" >{{ __("words.change_your_password") }}</span>
                    </div>
                    <br>

                    <div class="text-center w3-padding" >
                        <img src="{{ $user->photo_url }}" width="50px" height="50px" class="w3-circle" alt="">
                        <br>
                        <span  class="w3-large" >{{ __("words.welcome_back") }} - {{ $user->name }}</span>
                    </div>

                <center class="w3-padding" style="width: 82%;margin: auto">
                    <form  action="{{ url('/change-password') }}" method="post" >
                        <input type="hidden" name="verify_code"  value="{{ $user->verify_code }}" >
                        @csrf
                        <div class="w3-display-container   animated fadeInRight">
                            <span class="w3-display-topleft w3-padding" onclick="$('.password').attr('type') == 'password'? $('.password').attr('type', 'text') :  $('.password').attr('type', 'password')" ><i class="fa fa-eye w3-text-gray w3-large" style="margin-top: 90%" ></i></span>
                            <input type="password" required="" name="password" id='password' class="password w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.password") }}'  >
                        </div>
                        <br>
                        <div class="w3-display-container  animated fadeInLeft">
                            <span class="w3-display-topleft w3-padding" onclick="showPassword(this)" ><i class="fa fa-eye w3-text-gray w3-large" style="margin-top: 90%" ></i></span>
                            <input type="password" required="" name="password2"   class="password w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.repeat_password") }}'  >
                        </div>
                        <br>
                        <center>
                            <button class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp" style="width: 200px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   >{{ __("words.send") }}</button>
                        </center>
                    </form>
                </center>

            </div>


            <div class="w3-col l5 m5 s5 w3-display-container"  >
                <div class="w3-display-topmiddle"  >
                    <div class="text-capitalize w3-xlarge w3-text-white text-center" style="margin-top: 100%" >
                        <b>{{ __("words.hello_friends") }}</b>
                    </div>
                    <br>
                    <div class="text-capitalize w3-text-light-gray text-center" >
                        {{ __("words.enter_your_personal") }}
                    </div>
                    <br>
                    <br>
                    <center>
                        <a href="{{ url('/sign-up') }}" class="w3-btn w3-padding w3-round-xxlarge w3-large sign-up-button"     >{{ __("words.sign_up") }}</a>
                    </center>
                </div>
                <img src="{{ url('/website/image/login.png') }}" class="login-image"  >
            </div>
        </div>
    </div>



</div>


@endsection

@section("js")
<script>

    $(document).ready(function () {
    });
</script>
@endsection


