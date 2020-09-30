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
    .youtube-video {
        width: 100%;
        height: 100%;
        z-index: 3;
        display: none;
    }
</style>
@endsection

@section("content") 


<div class="modal show help-background" style="z-index: -1;" >
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
                    <table class="w3-table" style="direction: ltr!important;" >
                        <tr>
                            <td>
                                <span class="badge dark-theme-background " >1</span>
                            </td>
                            <td class="w3-text-gray" >
                                Lorem Ipsum is simply dummy text of the printing and typesetting industr.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="badge dark-theme-background " >2</span>
                            </td>
                            <td class="w3-text-gray" >
                                Lorem Ipsum is simply dummy text of the printing and typesetting industr.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="badge dark-theme-background " >3</span>
                            </td>
                            <td class="w3-text-gray" >
                                Lorem Ipsum is simply dummy text of the printing and typesetting industr.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="badge dark-theme-background " >4</span>
                            </td>
                            <td class="w3-text-gray" >
                                Lorem Ipsum is simply dummy text of the printing and typesetting industr.
                            </td>
                        </tr>
                    </table> 
                </div>
            </div>


            <div class="w3-col l6 m6 s6  w3-padding"  >  
                <div style="" class="help-video-background w3-display-container animated zoomIn" >
                    <div class="w3-display-bottomleft" >
                        <span class="w3-large fa fa-play youtube-icon w3-red shadow" onclick="openYoutubeVideo()" ></span>
                    </div>
                    <div class="w3-display-topleft youtube-video" >
                        <div class="w3-display-topright w3-padding" >
                            <button class="w3-button w3-btn w3-round dark-theme-background" onclick="closeYoutubeVideo()" >&times</button>
                        </div>
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/VsCqEu6CIKg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
    function closeYoutubeVideo() {
        $(".youtube-video").fadeOut(600)
    }

    function openYoutubeVideo() {
        $(".youtube-video").fadeIn(600)
    }
    
    $(document).ready(function () { 
    });
</script>
@endsection


