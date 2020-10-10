@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp

@section("css")
<link rel="stylesheet" href="{{ url('/website') }}/css/create-site.css">


@endsection

@section("content")


<div class="modal show login-background" id="siteContainer" style="z-index: -1;padding-top: 70px" >

    <div class="w3-row step step-1" style="overflow: auto" >
        <div class="w3-col l7 m7 s6 w3-padding"   >
            <span class="w3-xxlarge text-uppercase" >{{ __("words.choose_template") }}</span>
            <div class="alert alert-info" >
                {{ __("words.create_template_for_company_only") }}
            </div>
            <br>
            <div style="width: 30%;height: 5px;margin-top: 5px;" class="dark-theme-background w3-border-bottom w3-border-gray" ></div>

            <div id="contentContainer" class="trans3d">
            <center>
                <center id="carouselContainer" class="trans3d">
                    <figure id="item1" class="carouselItem trans3d">
                        <img src="{{ url('/website/image/template1.png') }}" height="250px" onclick="showTemplate(2)" >
                    </figure>

                    <figure id="item1" class="carouselItem trans3d">
                        <img src="{{ url('/website/image/template2.png') }}" height="250px" onclick="showTemplate(3)" >
                    </figure>

                    <figure id="item1" class="carouselItem trans3d">
                        <img src="{{ url('/website/image/template3.png') }}" height="250px;" onclick="showTemplate(4)" >
                    </figure>                 <!--
                <figure id="item2" class="carouselItem trans3d"><div class="carouselItemInner trans3d">2</div></figure>
                <figure id="item3" class="carouselItem trans3d"><div class="carouselItemInner trans3d">3</div></figure>
                -->
                </center>
            </center>
            </div>
            <br> <br>
            <div>
                <button class="fa fa-ellipsis-h float-btn w3-margin shadow" onclick="$('.services-btn').toggle()" ></button>

                <button onclick="window.location='{{ optional(App\Setting::find(9))->value }}'" href="" role="button" class="services-btn fa fa-facebook w3-indigo float-btn w3-margin shadow animated fadeInLeft" style="width: 50px;height: 50px" ></button>
                <button onclick="window.location='{{ optional(App\Setting::find(10))->value }}'" href="" role="button" class="services-btn fa fa-twitter w3-cyan float-btn w3-margin shadow animated fadeInLeft" style="width: 50px;height: 50px" ></button>
                <button onclick="window.location='{{ optional(App\Setting::find(11))->value }}'" href="" role="button" class="services-btn fa fa-youtube-square w3-red float-btn w3-margin shadow animated fadeInLeft" style="width: 50px;height: 50px" ></button>
            </div>
                <center v-if="user" >
                    <button
                        v-if="user.company_id != 1 && user.company_id"
                        class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInRight fa fa-angle-right"
                        style="width: 200px;border: 1px solid #02A2A7;"
                        onclick="gotoStep(2)" > {{ __("words.next") }} </button>
                </center>



        </div>

        <div class="w3-col l5 m5 s5 w3-display-container" style="height: 100%" >
            <div class="w3-display-topleft dark-theme-background template-loader" style="width: 100%;height: 100%" >

                <center style="margin-top: 45%" >
                    <span class="fa fa-spin fa-spinner w3-text-white w3-large" ></span>
                </center>
            </div>
            <iframe v-bind:height="height"  width="100%" src="{{ url('/template2/create/7') }}" onload="$('.template-loader').fadeOut(300)"  class="frame" ></iframe>
        </div>

    </div>

    <div class="step step-2" style="overflow: auto;display: none;" >
         <br><br>
        <div class="w3-modal-content shadow w3-round w3-white w3-padding" >

            <center class="w3-large" >
               {{ __("words.fill_your_data") }}
           </center>
           <form class="form" action="{{ url('/api/user/profile/update') }}" method="post" >

            <input type="hidden" name="api_token" v-model="user.api_token" >

            <div class="w3-row">
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                <label for="name">{{ __('words.name') }}</label>
                <input type="text" class="form-control input-sm" name="name" placeholder="{{ __('words.name') }}" v-model="user.name" >
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="email">{{ __('words.email') }}</label>
                    <input type="text" class="form-control input-sm" name="email" placeholder="{{ __('words.email') }}" v-model="user.email">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="phone">{{ __('words.phone') }}</label>
                    <input type="text" class="form-control input-sm" name="phone" placeholder="{{ __('words.phone') }}" v-model="user.phone">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="address">{{ __('words.address') }}</label>
                    <input type="text" class="form-control input-sm" name="address" placeholder="{{ __('words.address') }}" v-model="user.address">
                </div>

                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="facebook">{{ __('words.facebook') }}</label>
                    <input type="url" class="form-control input-sm" name="facebook" placeholder="{{ __('words.facebook') }}" v-model="user.facebook">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="youtube_link">{{ __('words.youtube_link') }}</label>
                    <input type="url" class="form-control input-sm" name="youtube_link" placeholder="{{ __('words.youtube_link') }}" v-model="user.youtube_link">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="youtube_video">{{ __('words.youtube_video') }}</label>
                    <input type="url" class="form-control input-sm" name="youtube_video" placeholder="{{ __('words.youtube_video') }}" v-model="user.youtube_video">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="twitter">{{ __('words.twitter') }}</label>
                    <input type="url" class="form-control input-sm" name="twitter" placeholder="{{ __('words.twitter') }}" v-model="user.twitter">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="whatsapp">{{ __('words.whatsapp') }}</label>
                    <input type="text" class="form-control input-sm" name="whatsapp" placeholder="{{ __('words.whatsapp') }}" v-model="user.whatsapp">
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="linkedin">{{ __('words.linkedin') }}</label>
                    <input type="url" class="form-control input-sm" name="linkedin" placeholder="{{ __('words.linkedin') }}" v-model="user.linkedin" >
                </div>
                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="website">{{ __('words.website') }}</label>
                    <input type="url" class="form-control input-sm" name="website" placeholder="{{ __('words.website') }}" v-model="user.website">
                </div>

                <div class="form-group w3-col l6 m6 s6 w3-padding">
                    <label for="about">{{ __('words.about') }}</label>
                    <textarea style="resize: vertical;" class="form-control input-sm" name="about" v-model="user.about" placeholder="{{ __('words.about') }}"></textarea>
                </div>
                <br>
                <button class="btn btn-primary w3-block" >{{ __("words.save") }}</button>
                <br>
            </div>
           </form>
                <center>
                    <button
                        class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInLeft fa fa-angle-left"
                        style="width: 200px;border: 1px solid #02A2A7;"
                        onclick="gotoStep(1)" > {{ __("words.back") }} </button>
                    <a
                        class="light-theme-background w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInRight fa fa-send-o"
                        target="_blank"
                        style="width: 200px;border: 1px solid #02A2A7;" v-bind:href="website_link" > {{ __("words.publish") }} </a>
                </center>
        </div>
        <br><br><br>
    </div>



    <div class="step step-3" style="overflow: auto;display: none;" >
         <br><br>
        <div class="w3-modal-content modal-sm shadow w3-round w3-white w3-padding" style="width: 60%" >
            <div class="row">
                <div class="w3-xlarge text-center" >{{ __("words.your_website_published") }}</div>
                <br>
                <center>
                    <img src="{{ url('/website/image/websitebuilderformac.jpg') }}" width="80%" class="animated  shadow w3-round" >
                </center>
                <br>
                <div class="form-inline w3-padding">
                    <label for="email">{{ __('words.your_link') }}</label>
                    <br>
                    <a target="_blank" v-bind:href="website_link" v-html="website_link" ></a>
                </div>
            </div>
        </div>
        <br>
    </div>

</div>


@endsection

@section("js")
<script src="https://raw.githubusercontent.com/JohnBlazek/codepen-resources/master/3d-carousel/js/libs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
<script src="{{ url('/website') }}/js/create-site.js"></script>

<script>
    function showTemplate(template) {
        app.template = template;
        $('.template-loader').show();
        $(".frame").attr("src", public_path + "/template" + template + "/create/7");
    }

    function _getWebsiteLink() {
        app.website_link = '{{ url("/personal/") }}/' + app.user.name;
    }

    function _updateTemplate() {
        var data = {
            templete_id: app.template,
            api_token: app.user.api_token
        };

        $.post("{{ url('/api/user/profile/update') }}", $.param(data), function(){});
    }

    var app = null;
    formAjax(true);

    $(document).ready(function () {
        setOwlCarousel();
        formAjax(true);

        // load user
        $.get("{{ url('/get-user') }}", function(data){
            app.user = data;
        });
    });

app = new Vue({
    el: '#siteContainer',
    data: {
        template: 2,
        website_link: '',
        user: {}
    },
    methods: {
        drawStar: function (number) {
            var html = "";
            for (var i = 0; i < 5; i++) {
                if (i <= number)
                    html += "<span class='fa fa-star w3-text-orange' ></span>";
                else
                    html += "<span class='fa fa-star w3-text-gray' ></span>";
            }
            return html;
        }
    },
    computed: {
        height: function () {
            return window.innerHeight;
        }
    },
    watch: {
    }
});
</script>
@endsection


