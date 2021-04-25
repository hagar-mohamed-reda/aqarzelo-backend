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


<div class="modal show login-background" style="z-index: -1;overflow: auto" >
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="w3-modal-content shadow w3-round w3-white w3-display-container" style="width: 70%;padding: 0px!important" >


        <div class="row" >
            <div class="w3-col l7 m7 s7" >
                <div class="w3-padding text-center w3-xxxlarge dark-theme-color text-capitalize" >
                    <span style="font-weight: 500" >{{ __("words.create_account") }}</span>
                </div>
                <!--
                <center>
                    <button class="w3-circle btn btn-lg w3-white w3-border-gray w3-border" >
                        <i class="fa fa-facebook" ></i>
                    </button>
                    <button class="w3-circle btn btn-lg w3-white w3-border-gray w3-border" >
                        <i class="fa fa-google" ></i>
                    </button>
                </center>
                <center class="w3-large text-center text-capitalize w3-text-gray" >
                    {{ __("words.or_use_your_email_account") }}
                </center>
                -->

                <form action="{{ url('/user/register') }}" method="post" id="userRegister" >
                    <br>
                    <div class="w3-center">
                        <button
                            type="button"
                            onclick="$('.input-radio-owner')[0].checked=true;$('.plans').hide(100);$('.input-radio-plan').removeAttr('required');$('.commercial_no input').removeAttr('required');$('.commercial_no').hide()"
                            class="w3-btn w3-padding w3-round "
                            style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white" >
                            <input type="radio" required="" class="input-radio-owner" name="model_type" value="owner"  >{{ __('owner') }}
                        </button>
                        <button
                            type="button"
                            onclick="$('.input-radio-agent')[0].checked=true;$('.plans').show(100);$('.input-radio-plan').attr('required', 'required');$('.commercial_no input').removeAttr('required');$('.commercial_no').hide()"
                            class="w3-btn w3-padding w3-round "
                            style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white" >
                            <input type="radio" required="" class="input-radio-agent" name="model_type" value="agent"  >{{ __('agent') }}
                        </button>

                        <button
                            type="button"
                            onclick="$('.input-radio-company')[0].checked=true;$('.plans').hide(100);$('.input-radio-plan').removeAttr('required');$('.commercial_no input').attr('required', 'required');$('.commercial_no').show(500)"
                            class="w3-btn w3-padding w3-round "
                            style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white" >
                            <input type="radio" required="" class="input-radio-company" name="model_type" value="company"  >{{ __('developer_brokerage_company ') }}
                        </button>
                    </div>
                    {{ csrf_field() }}
                    <br>
                    <div class="row" style="width: 82%;margin: auto"  >
                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 5px" >
                            <div class="w3-display-container animated fadeInLeft">
                                <span class="w3-display-topleft w3-padding" ><i class="fa fa-user w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                                <input type="text" required="" name="name"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.name") }}'  >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 5px">
                            <div class="w3-display-container  animated fadeInRight">
                                <span class="w3-display-topleft w3-padding" ><i class="fa fa-phone-square w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                                <input type="text" required="" name="phone"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.phone") }}'  >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 5px">
                            <div class="w3-display-container  animated fadeInLeft">
                                <span class="w3-display-topleft w3-padding" ><i class="fa fa-envelope w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                                <input type="text" required="" name="email" id="email"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.email") }}'  >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 5px">
                            <div class="w3-display-container  animated fadeInLeft">
                                <span class="w3-display-topleft w3-padding" onclick="showPassword(this)" ><i class="fa fa-eye w3-text-gray w3-large" style="margin-top: 90%" ></i></span>
                                <input type="password" required="" name="password" id='password' class="password  w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.password") }}'  >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 5px">
                            <div class="w3-display-container  animated fadeInLeft">
                                <span class="w3-display-topleft w3-padding" onclick="showPassword(this)" ><i class="fa fa-eye w3-text-gray w3-large" style="margin-top: 90%" ></i></span>
                                <input type="password" required="" name="password2"   class="password  w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.repeat_password") }}'  >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 commercial_no" style="padding: 5px;display: none">
                            <div class="w3-display-container  animated fadeInLeft">
                                <span class="w3-display-topleft w3-padding" ><i class="fa fa-newspaper-o w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                                <input type="text"  name="commercial_no"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.commercial_no") }}'  >
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12 plans" style="padding: 5px;display: none">
                            <div class="row owl-carousel owl-theme">
                                @foreach($plans as $plan)
                                <div class="item">
                                    <div class="w3-white shadow">
                                        <div
                                        style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"
                                        class="w3-padding text-center">
                                         {{ $plan->name_en }}
                                        </div>
                                        <ul class="w3-ul">
                                            <li class="w3-tiny" >
                                                {{ $plan->description_en }}
                                            </li>
                                            <li>
                                                {{ $plan->cost }} EGP
                                            </li>
                                            <li>
                                                {{ $plan->max_post }} {{ __('Max Post') }}
                                            </li>
                                            <li>
                                                {{ $plan->period }} {{ __('Period') }}
                                            </li>
                                            <li class="w3-center" >
                                            <button
                                                type="button"
                                                onclick="$(this).find('.input-radio-plan')[0].checked=true"
                                                class="w3-btn w3-round"
                                                style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white" >
                                                <input type="radio"  class="input-radio-plan" name="plan_id" value="{{ $plan->id }}"  >
                                                {{ __('select') }}
                                            </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <br>
                    <center>
                        <button class="w3-btn w3-padding w3-round-xxlarge w3-large animated fadeInUp" style="width: 200px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   >{{ __("words.sign_up") }}</button>
                    </center>
                    <br>
                </form>
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
                        <a href="{{ url('/login') }}" class="w3-btn w3-padding w3-round-xxlarge w3-large sign-up-button"     >{{ __("words.login") }}</a>
                    </center>
                </div>
                <img src="{{ url('/website/image/login.png') }}" class="login-image"  >
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>


</div>


@endsection

@section("js")
<script>
    function showPassword(input) {
        if ($(input).parent().find('.password').attr('type') == 'password') {
            $(input).parent().find('.password').attr('type', 'text');
            $(input).children()[0].className = "fa fa-eye-slash w3-text-gray w3-large";
        } else {
            $(input).parent().find('.password').attr('type', 'password');
            $(input).children()[0].className = "fa fa-eye w3-text-gray w3-large";
        }
    }

    function prepRegister(type) {
        $("form").hide();
        if (type == 'COMPANY') {
            $("#companyRegister").show();
        } else {
            $("#userRegister").show();
        }
    }

    $(document).ready(function () {
        $(".login-image").css("min-height", "690px");
        $(".login-image").css("height", $(".modal").css("height"));
    });

    $('.owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
</script>
@endsection


