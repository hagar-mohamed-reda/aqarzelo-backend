@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp

@section("css")
<style>
    * {
        text-transform: capitalize!important;
    }

</style>

@endsection

@section("content")


<div class="slideshow modal show home-background home-modal" >

    <div class="home-title-hover w3-display-top{{ session("direction") == "ltr"? 'left' : 'right'  }}" style="z-index: 2;padding-{{ session("direction") == "rtl"? 'right' : 'left'  }}: 0px!important;top: 35%;width:500px" >
        <div class="w3-padding animated fadeInLeft" style="height:220px;padding-{{ session("direction") == "ltr"? 'left' : 'right'  }}: 0px!important;background-color: rgba(2, 170, 169, 0.5)" >
            <br>
            <div class="w3-padding w3-jumbo animated fadeInLeft delay-1s" style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"  >
                <span class="w3-margin-left" ><b>AQAR ZELO</b></span>
            </div>
            <br>
            <div class="w3-large w3-text-white" style="padding-{{ session("direction") == "rtl"? 'right' : 'left'  }}: 16px!important;margin: auto;width: 90%;" >
                <span class="home-slide-detail text-capitalize" style=" " >{{ __("words.home_page_slide_title") }}</span>
            </div>
        </div>
        <br>
        <br>
        <div class="w3-padding" >
            <div class=" w3-margin-{{ session("direction") == "ltr"? 'left' : 'right'  }}" >
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.aqarzelo.aqarzelo" role="button" class="w3-btn app-button animated zoomIn" class="shadow" style="margin: 5px"  >
                    <img src="{{ url('/website/icons/google-store.png') }}" width="20px" style="padding-{{ session("direction") == "ltr"? 'left' : 'right'  }}: 5px" >
                    {{ __("words.google_play") }}
                </a>
                <a href="#" role="button" class="w3-btn app-button animated zoomIn delay-1s" class="shadow" style="margin: 5px"  >
                    <img src="{{ url('/website/icons/apple.png') }}"width="20px" style="padding-{{ session("direction") == "rtl"? 'left' : 'right'  }}: 5px" >
                    {{ __("words.app_store") }}
                </a>
            </div>
        </div>
    </div>


    <br>
    <br>
    <br>
    <br>
    <div class="slide-image" style="margin-{{ session("direction") == "ltr"? 'left' : 'right'  }}: 25%;width: 65%;" >

        <div class="search-container" style="" >
            <form action="{{ url('map') }}" id="searchForm" >
                <div class="input-group input-group-lg w3-white w3-round shadow  animated lightSpeedIn slow">
                <span class="input-group-addon transparent"   >
                    <button type="submit" class="input-group-addon transparent"><i class="fa fa-search" ></i></button>
                </span>
                <input required="" type="text" class="form-control transparent text-capitalize" name="search"   placeholder="{{ __('words.search_about_post') }}" >
                <span class="input-group-addon transparent" style="display: none"  >
                    <!--
                    <select class="transparent" style="border-right: 1px solid gray!important" >
                        <option>{{ __("words.city") }}</option>
                    </select>
                    <select class="transparent" style="border-right: 1px solid gray!important" >
                        <option>{{ __("words.sell") }}</option>
                        <option>{{ __("words.rent") }}</option>
                    </select>
                    <select class="transparent" style="border: inherit!important" >
                        <option>{{ __("words.villa") }}</option>
                    </select>
                -->
                </span>
            </div>
            </form>
        </div>
        <br>
        <img src="{{ url('/website/image/home-slide-image.jpg') }}" class="shadow animated fadeInRight slow" width="100%"  height="430px"  >
    </div>
    <br>
    <div class="w3-display-bottommiddle " >
        <div class="modal-content w3-modal-content w3-round w3-padding animated fadeInUp slow">
            <center class="w3-padding" >
                <a target="_blank" href="https://www.facebook.com/Aqar-Zelo-109830420582694" style="padding:5px;" >
                    <i class="fa fa-facebook w3-xlarge" ></i>
                </a>
                <a target="_blank" href="https://www.instagram.com/aqarzelo/" style="padding:5px;" >
                    <i class="fa fa-instagram w3-xlarge" ></i>
                </a>
                <a target="_blank" href="https://twitter.com/AqarZelo" style="padding:5px;" >
                    <i class="fa fa-twitter w3-xlarge" ></i>
                </a>
                <a target="_blank" href="https://www.youtube.com/channel/UC8H3FBqJJhehH55i2hcOsgg/" style="padding:5px;" >
                    <i class="fa fa-youtube-play w3-xlarge" ></i>
                </a>
            </center>
        </div>
    </div>
</div>


@endsection

@section("js")
<script>
    $(document).ready(function () {
        new TypeWriter($(".home-slide-detail")[0], 100);
    });
</script>
@endsection


