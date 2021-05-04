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
    .help-background {
        background-image: url("{{ url('/website/image/help-background.png')  }}");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .help-video-background {
        background-image: url("{{ url('/website/image/help-background.jpg')  }}");
        background-repeat: no-repeat;
        background-size: contain;
        background-position: bottom;
        height: 300px;
        width: 400px;
        border: 1px solid lightgray;
    }
    .youtube-icon {
        border-top-right-radius: 5em;
        width: 50px;
        height: 50px;
        padding: 15px;
        cursor: pointer;;
    }
    .youtube-video1 {
        width: 100%;
        height: 100%;
        z-index: 3;
        display: none;
    }
    .youtube-video2 {
        width: 100%;
        height: 100%;
        z-index: 3;
        display: none;
    }
</style>
@endsection

@section("content")


<div class="modal show help-background" style="z-index: -1;overflow: auto!important" >
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="w3-modal-content shadow w3-round w3-white w3-display-container" style=";padding: 0px!important" >


        <center>
            <span class="w3-xxxlarge text-uppercase w3-text-gray" >{{ __("words.help") }}</span>
            <div class="dark-theme-color" style="border-bottom: 3px solid #02A2A7!important;width: 150px" ></div>
        </center>
        <br>
        <div class="row" >
            <div class="w3-col l6 m6 s6 w3-padding" >
                <div class="w3-padding" >


                    @if (session('locale') == "en")
                    <div  style="direction: ltr!important" >
                    * General Post  (FAQ) <br>
                        1.	How can I create a post? <br>
                        2.	What are the requirements for uploading a post? <br>
                        3.	Why is my post pending? <br>
                        4.	When my post will be approved? <br>
                        5.	How can I delete my post? <br>
                        6.	Why my photos not uploading? <br>
                        7.	How can I upload 360゜view photo?!!!!!!!!!!!!!!!!!!!!! <br>
                        <br>
                    * Selling with AQARZELO (FAQ) <br>
                    <br>
                        1.	How does AQAEZELO work? <br>
                        2.	What makes AQAEZELO Agents different from other real estate agents? <br>
                        3.	What are the typical steps in the property-selling process? <br>
                        4.	How do I upload my post? <br>
                        5.	How can I delete my post? <br>
                        6.	Do you offer a trail period? <br>
                        7.	Can I contact the buyer through AQARZELO? <br>
                        <br>
                    * Buying with AQARZELO (FAQ) <br>
                    <br>
                        1.	How does AQARZELO work? <br>
                        2.	What makes AQARZELO different from other real estate companies? <br>
                        3.	What should I look for when visiting a home in person? <br>
                        4.	Is there anything I can do to see a home in more detail without visiting in person? <br>
                        5.	What are the typical steps in the home-buying process? <br>
                        6.	Can I contact the owner through AQARZELO? <br>
                    </div>

                    @else
                    <div  style="direction: rtl!important" >
                    * الأسئلة المتكررة حول المنشورات: <br>
                    <br>
                        1. إزاى إنشء منشور؟ <br>
                        2. ايه هي متطلبات المنشور الصحيح؟ <br>
                        3. ليه منشوري مُعلق؟ <br>
                        4. امتى بتٌم الموافقة على منشوري؟ <br>
                        5. إزاى امسح منشوري؟ <br>
                        6. ليه الصور مبتتحملش؟ <br>
                        7. <br>
                        <br>
                    * بيع مع عقار زيلو: <br>
                    <br>
                        1.	ازاى عقار زيلو بيشتغل؟ <br>
                        2.	ايه اللي بيميز عقار زيلو عن باقي منافسيها؟ <br>
                        3.	ايه الخطوات المفروض اعملها عشان ابيع عقار؟ <br>
                        4.	إزاي احمل منشوري؟ <br>
                        5.	إزاي امسح منشوري؟ <br>
                        6.	هل ممكن اتواصل مع المشتري عن طريق عقار زيلو؟ <br>
                        7.	هل عقار زيلو بيوفر فترة تجريبية؟ <br>
                        <br>
                    * إشتري مع عقار زيلو: <br>
                        1.	ازاى عقار زيلو بيشتغل؟ <br>
                        2.	ايه اللي بيميزعقار زيلو عن باقي منافسيها؟ <br>
                        3.	ايه اللي ممكن اعمله عشان اشوف تفاصيل اكتر عن العقار منغير ما أزوره؟ <br>
                        4.	ايه الخطوات المفروض اعملها عشان اشتري عقار؟ <br>
                        5.	هل ممكن اتواصل مع البائع عن طريق عقار زيلو؟ <br>
                        <br>
                    </div>
                    @endif
                </div>
            </div>


            <div class="w3-col l6 m6 s6  w3-padding"  >
                <h3 style="text-align: center"><span class="w3-xlarge text-uppercase w3-text-gray" >{{ __("words.360_degree_view") }}</span></h3>
                <div style="" class="help-video-background w3-display-container animated zoomIn" >
                    <div class="w3-display-bottomleft" >
                        <span class="w3-large fa fa-play youtube-icon w3-red shadow" onclick="openYoutubeVideo1()" ></span>
                    </div>
                    <div class="w3-display-topleft youtube-video1" >
                        <div class="w3-display-topright w3-padding" >
                            <button class="w3-button w3-btn w3-round dark-theme-background" onclick="closeYoutubeVideo1()" >&times</button>
                        </div>
                        {{-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/VsCqEu6CIKg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                        <iframe width="100%" height="100%" src="{{url('/video/360_degree.mp4')}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="w3-col l6 m6 s6  w3-padding"  >
                <h3 style="text-align: center"><span class="w3-xlarge text-uppercase w3-text-gray" >{{ __("words.gps") }}</span></h3>
                <div style="" class="help-video-background w3-display-container animated zoomIn" >
                    <div class="w3-display-bottomleft" >
                        <span class="w3-large fa fa-play youtube-icon w3-red shadow" onclick="openYoutubeVideo2()" ></span>
                    </div>
                    <div class="w3-display-topleft youtube-video2" >
                        <div class="w3-display-topright w3-padding" >
                            <button class="w3-button w3-btn w3-round dark-theme-background" onclick="closeYoutubeVideo2()" >&times</button>
                        </div>
                        {{-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/VsCqEu6CIKg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                        <iframe width="100%" height="100%" src="{{url('/video/gps.mp4')}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>



</div>


@endsection

@section("js")
<script>
    function closeYoutubeVideo1() {
        $(".youtube-video1").fadeOut(600)
    }

    function openYoutubeVideo1() {
        $(".youtube-video1").fadeIn(600)
    }
    function closeYoutubeVideo2() {
        $(".youtube-video2").fadeOut(600)
    }

    function openYoutubeVideo2() {
        $(".youtube-video2").fadeIn(600)
    }

    $(document).ready(function () {
    });
</script>
@endsection


