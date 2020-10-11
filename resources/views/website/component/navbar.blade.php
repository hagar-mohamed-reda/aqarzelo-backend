@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<nav class="navbar navbar-default shadow w3-white w3-block navbar-fixed" style="z-index: 15;width: 100%!important" >
    <div class="container-fluid w3-block">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('/website/icons/nav-bar-logo.png') }}" class="animated zoomInLeft slow" width="130px"  />
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="padding w3-">
                    <a href="{{ url('/') }}" class="navbar-list-item" ><i class="fa fa-home" style="padding:5px"   ></i> {{ __("words.home") }} </a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/map') }}" class="navbar-list-item" ><i class="fa fa-map-marker"  style="padding:5px"  ></i>{{ __("words.map") }}</a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/create-post') }}" class="navbar-list-item" ><i class="fa fa-bank"  style="padding:5px"  ></i>{{ __("words.create_post") }}</a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/create-website') }}" class="navbar-list-item" ><i class="fa fa-globe"  style="padding:5px"  ></i>{{ __("words.create_website") }}</a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/contact') }}" class="navbar-list-item" ><i class="fa fa-phone-square" style="padding:5px"   ></i>{{ __("words.contact_us") }}</a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/help') }}" class="navbar-list-item" ><i class="fa fa-question-circle" style="padding:5px"   ></i>{{ __("words.help") }}</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!App\Profile::auth())
                <li class="padding w3-">
                    <a href="{{ url('/login') }}" class="navbar-list-item" ><i class="fa fa-user-circle"  style="padding:5px"  ></i>{{ __("words.login") }}</a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/sign-up') }}" class="navbar-list-item" ><i class="fa fa-sign-in"  style="padding:5px"  ></i>{{ __("words.sign_up") }}</a>
                </li>
                @else
                <li class="padding w3-row">
                    <a href="{{ url('/profile') }}" class="navbar-list-item" >

                        <div style="width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" >
                            <img src="{{ App\Profile::auth()->photo_url }}" width="20px" height="20px"  class="w3-circle" > {{ explode(" ", App\Profile::auth()->name)[0] }}</div>
                    </a>
                </li>
                <li class="padding w3-">
                    <a href="{{ url('/logout') }}" class="navbar-list-item" ><i class="fa fa-sign-out" style="padding:5px"  ></i>{{ __("words.sign_out") }}</a>
                </li>
                @endif
                <li class="padding">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"   >

                        <img src="{{ url('/images/egypt.png') }}"   class="fa w3-round" width="25px" >
                        <!--
                            data-toggle="tooltip" data-placement="top" title="{{ __('words.text_appear_in_tooltip') }}"
                       <i class="fa fa-globe" style="font-size: 32px!important;" ></i>
                         <img src="{{ url('/images/world.png') }}" class="fa w3-round" width="30px" >
                        @if(App::getLocale() == "ar")
                        <img src="{{ url('/website/icons/arabic.png') }}" class="fa w3-round" width="30px" >
                        @else
                        <img src="{{ url('/website/icons/english.png') }}" class="fa w3-round" width="30px" >
                        @endif
                        -->
                        <span class="caret"></span>
                    </a>
                  <ul class="dropdown-menu" style="{{ session("direction") == "ltr"? 'right' : 'left'  }}: 0px!important"  >
                    <!--
                    <li class="w3-padding" >
                        {{ __('words.text_appear_in_tooltip_description') }}
                    </li>
                    -->
                    @foreach(App\Country::all() as $item)
                    <li class="w3-display-container" >
                        <a href="#">

                            <img src="{{ url($item->icon) }}" class="fa w3-round w3-left" width="30px" >

                            <span class="w3-right" >{{ session("locale") == "ar"? $item->name_ar : $item->name_en }}</span>
                        </a>
                    </li>
                    @endforeach
                  </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 25%" >

                        <img src="{{ url('/website/icons/lang.png') }}" class="fa w3-round" style="padding-top: 5px!important" width="20px">
                        <!--
                       <i class="fa fa-globe" style="font-size: 32px!important;" ></i>
                         <img src="{{ url('/images/world.png') }}" class="fa w3-round" width="30px" >
                        @if(App::getLocale() == "ar")
                        <img src="{{ url('/website/icons/arabic.png') }}" class="fa w3-round" width="30px" >
                        @else
                        <img src="{{ url('/website/icons/english.png') }}" class="fa w3-round" width="30px" >
                        @endif
                        -->
                        <span class="caret"></span>
                    </a>
                  <ul class="dropdown-menu" style="{{ session("direction") == "ltr"? 'right' : 'left'  }}: 0px!important"  >
                    <li class="w3-display-container" >
                        <a href="{{ url('/locale/ar') }}">

                            <img src="{{ url('/images/egypt.png') }}" class="fa w3-round w3-left" width="30px" >

                            <span class="w3-right" >العربية</span>
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li class="w3-display-container" >
                        <a href="{{ url('/locale/en') }}">

                            <img src="{{ url('/images/english.svg') }}" class="fa w3-round w3-left" width="30px" >

                            <span class="w3-right" >English</span>
                        </a>
                    </li>
                  </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
