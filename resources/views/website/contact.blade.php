@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp

@section("css")
<style>
    .followers {
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
    <div class="w3-display-topleft w3-padding w3-large followers" style="direction: ltr!important"   >
        <a href="https://www.facebook.com/Aqar-Zelo-109830420582694" target="_blank" class="fa fa-facebook" style="margin: 5px" ></a>
        <a href="https://www.instagram.com/aqarzelo/" target="_blank" class="fa fa-instagram" style="margin: 5px" ></a>
        <a href="https://twitter.com/AqarZelo" target="_blank" class="fa fa-twitter" style="margin: 5px" ></a>
        <a href="https://www.youtube.com/channel/UC8H3FBqJJhehH55i2hcOsgg/" target="_blank" class="fa fa-youtube-play" style="margin: 5px" ></a>
        <span class="light-theme-color" style="margin: 5px" >.................</span>
        <span>{{ __("words.follow_us") }} </span>
    </div>

    <div class="w3-modal-content shadow w3-round w3-white w3-display-container" style="width: 60%;padding: 0px!important" >

        <div class="row" >
            <div class="w3-col l6 m6 s6" >
                <form action="{{ url('/contact/send-message') }}" method="post" class="form" >
                    {{ csrf_field() }}
                    <div class="w3-padding text-center w3-xxlarge dark-theme-color text-capitalize w3-margin-top" >
                        <span style="font-weight: 500" class="dark-theme-color" >{{ __("words.contact_us") }}</span>
                    </div>
                    <div class="w3-large text-center text-capitalize w3-text-gray" >
                        {{ __("words.reach_out_to_us_for_any_inquiry") }}
                    </div>
                    <center class="w3-padding" style="width: 82%;margin: auto"  >

                        <div class="w3-display-container   animated fadeInRight" style="margin-bottom:7px" >
                            <span class="w3-display-topleft w3-padding" ><i class="fa fa-user-circle w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                            <input type="text" required="" name="name" id="fullname"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.fullname") }}'  >
                        </div>
                        <div class="w3-display-container   animated fadeInLeft" style="margin-bottom:7px" >
                            <span class="w3-display-topleft w3-padding" ><i class="fa fa-envelope w3-text-gray w3-large" style="margin-top: 60%" ></i></span>
                            <input type="text" required="" name="email" id="email"  class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.email") }}'  >
                        </div>
                        <div class="w3-display-container   animated fadeInRight" style="margin-bottom:7px" >
                            <span class="w3-display-topleft w3-padding" ><i class="fa fa-send-o w3-text-gray w3-large" style="margin-top: 90%" ></i></span>
                            <textarea type="text" required="" name="message" id='message' class="w3-input w3-light-gray w3-block w3-round input" placeholder='{{ __("words.message") }}'  ></textarea>
                        </div>
                    </center>

                    <center>
                        <button class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp" style="width: 200px;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   >{{ __("words.send") }}</button>
                    </center>
                    <br>
                </form>
            </div>


            <div class="w3-col l6 m6 s6 w3-display-container" style="height: 395px" >
            <iframe class="animated zoomIn" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13814.038494209326!2d31.1989469!3d30.0509233!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xda99ec6899f9af9e!2z2KjYsdisINin2YTZgdik2KfYryDYp9mE2KfYr9in2LHZig!5e0!3m2!1sar!2seg!4v1582116699037!5m2!1s{{ session("locale") == 'en'? 'en' : 'ar' }}!2seg&language={{ session("locale") == 'en'? 'en' : 'ar' }}" width="96%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
             </div>
        </div>
    </div>
    <div class="modal-dialog modal-lg " >
        <div class="w3-row w3-modal-content transparent"  >
            <div class="w3-col l6 m6 s6 transparent" >
                <div class="media animated fadeInUp">
                <div class="media-left">
                  <a href="https://www.google.com/maps?ll=30.00907,31.188283&z=15&t=m&hl=en&gl=EG&mapclient=embed&cid=14447840851503612123" target="_blank" >
                      <img class="media-object" width="50px" src="{{ url('/website/icons/address_location.png') }}" alt="">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">{{ __("words.location") }}</h4>
                    @if (session("locale") == "ar")
                    37 شارع جامعة الدول العربية-برج الفؤاد الإداري(1)
                    <br> الدور 11-المهندسين
                    @else
                    37 Gamaet El Dowal El Arabeya St., El Fouad
                    <br> Building No. (1), 11th floor Mohandessin
                    @endif
                </div>
              </div>
            </div>
            <div class="w3-col l6 m6 s6 transparent" >
                <div class="media animated fadeInUp">
                <div class="media-left">
                  <a href="https://mail.google.com/mail" target="_blank" >
                      <img class="media-object" width="50px" src="{{ url('/website/icons/gmail.png') }}" alt="">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">{{ __("words.email") }}</h4>
                  info@aqarzelo.com
                </div>
              </div>
            </div>
        </div>
    </div>



</div>


@endsection

@section("js")
<script>

    $(document).ready(function () {
        formAjax();
            $(".followers").css("transform", "rotate(-90deg)");
        $(".followers").animate({
            @if(session("direction") == "rtl")
            left: '-100px',
            @else
            left: '-130px',
            @endif
        }, 0, 'linear', function(){
        });
        $(".followers").animate({
            top: '50%',
        }, 1000);

    });
</script>
@endsection


