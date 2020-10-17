@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<style type="text/css">

    .map {
        background-image: url({{ url('/mobile/images/background.png') }});
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width: 100%;
        }

        .button-container {
            bottom: 5%;
        }

        .current-location-btn {
            width: 60px;
            height: 60px;
            border-radius: 10em;
        }

        .breadcrumb {
            height: 60px;
            padding-top: 20px;
            z-index: 10;
            border-radius: 0px!important;
        }
    </style>

    <!-- html content -->
    <div class="map" id="page" v-bind:style="'height: ' + height + 'px'" >

        <ol class="breadcrumb  w3-display-topleft w3-block light-theme-background shadow">
            <li><a href="#" class="text-uppercase w3-xlarge w3-text-white fa fa-angle-left" onclick="back()" ></a></li>

            <li><a href="#" class="text-uppercase w3-large w3-text-white" >{{ __('mobile.choose_location') }}</a></li>

        </ol>

        <div id="map" class="w3-block" v-bind:style="'height: ' + height + 'px'" ></div>

        <div class="w3-display-bottommiddle button-container w3-block w3-padding text-capitalize" >
            <div style="direction: rtl!important" >
                <button
                    onclick="getCurrentLocation()"
                    style="margin-right: 11px"
                    class="animated fadeInRight text-capitalize btn light-theme-background w3-xlarge w3-text-white shadow current-location-btn" >
                    <span class="material-icons">gps_fixed</span>
                </button>
            </div>
            <br>
            <br>

            <div class="w3-padding" >
                <button
                    onclick="done()"
                    class="animated fadeInUp text-capitalize btn light-theme-background w3-block w3-xlarge w3-text-white w3-round-xlarge shadow done-location-btn" >
                    {{ __('mobile.done_') }}
                </button>
            </div>
        </div>
    </div>


    <!-- javascript -->

    <script>
        var path = "{{ request()->path }}";
        var lat = null
        var lng = null;
        var map;
        var marker = null;
        var placeMarker = null;

        function done() {
            if (!lat && !lng) {
                errorToast('{{ __("mobile.choose_location") }}');
                return;
            }

            loadPage(path + "?lat=" + lat + "&lng=" + lng);
        }

        function getCurrentLocation() {
            getLocation(function(latlng){
                lat=latlng.lat;
                lng = latlng.lng;
                var p = new google.maps.LatLng(lat, lng);
                placeMarker(p, map);
            });
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30.0455965, lng: 31.2387195},
                zoom: 14
            });

            google.maps.event.addListener(map, 'click', function (e) {
                placeMarker(e.latLng, map);
            });

            placeMarker = function(position, map) {
                try {
                    marker.setMap(null);
                } catch (e) {
                }
                marker = new google.maps.Marker({
                    position: position,
                    map: map
                });
                lat = position.lat();
                lng = position.lng();

                map.panTo(position);
            }

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4ow5PXyqH-gJwe2rzihxG71prgt4NRFQ&libraries=places&callback=initMap"
    async defer></script>

    <script>
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
