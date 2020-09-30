@php

if (session("locale"))
    App()->setLocale(session("locale")); 
else
    App()->setLocale("ar"); 

@endphp
<!-- css styles  -->
<style type="text/css">
    .splash {
        background-image: url({{ url('/mobile/images/background2.png') }});
        background-size: 100% 100%; 
        background-repeat: no-repeat;
        width: 100%;
        }

        .w3-modal-content {
            background-color: transparent!important;
        }

        .logo-container {
            top: 10vw;
            width: 100%;
        }

        .button-container {
            bottom: 10vh;
        }
        
        .go-location-btn {
            background-color: transparent!important;
            border: 2px solid #02A2A7!important;
        }
    </style>

    <!-- html content -->
    <div class="splash" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="w3-modal-content"  >
            <div class="logo-container w3-display-topmiddle text-center" >
                <img class="logo" src="{{ url('/mobile/images/logo.png') }}" width="65vw" >
                <br>
                <br>
                <br>
                <div class="w3-xxlarge w3-text-white" ><b>AQAR ZELO</b></div> 
            </div>

        </div>

        <div class="w3-display-bottommiddle text-center button-container w3-block w3-padding text-capitalize" >
            <br> 
            <div class="text-capitalize w3-text-white w3-padding w3-" style="width: 90%;margin: auto" >{{ __("mobile.what_do_you_want_the_application_to_open_on_the_map") }}</div>
            <br>
            <div class="w3-padding" >
                <button 
                    onclick="getCurrentLocation()"
                    class="text-capitalize btn light-theme-background w3-block w3-xlarge w3-text-white w3-round-xlarge shadow current-location-btn" >
                    {{ __('mobile.current_location') }}
                </button>
                <br> 
                <button 
                    onclick="goLocation()"
                    class="text-capitalize btn light-theme-background w3-block w3-xlarge w3-text-white w3-round-xlarge shadow go-location-btn" >
                    {{ __('mobile.go_location') }}
                </button>
            </div>
        </div>

    </div>


    <!-- javascript -->
    <script>
        function goLocation() {
            loadPage("phone/map-picker?path=phone/home");
        }
        
        function getCurrentLocation() {
            getLocation(function(latlng) {
                loadPage("phone/home?lat=" + latlng.lat + "&lng=" + latlng.lng);
            }); 
        }
        
        var page = new Vue({
            el: '#page',
            data: {
                content: '',
                h: 100
            },
            methods: {
            },
            computed: {
                height: function () {
                    return window.innerHeight;
                }
            }
        }); 
    </script>