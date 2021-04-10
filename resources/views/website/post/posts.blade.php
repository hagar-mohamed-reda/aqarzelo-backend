@extends("website.component.app")
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
@section("css")
<link rel="stylesheet" href="{{ url('/website') }}/css/post.css">
<link rel="stylesheet" href="{{ url('/website') }}/css/select2.min.css">

 <style>
    * {
        direction: ltr!important;
    }
     .tooltip-inner {
        color: #000000!important;
        background-color: white!important;
        box-shadow: 0 0px 2px 0 rgba(0,0,0,0.14), 0 0px 1px -1px rgba(0,0,0,0.12), 0 -3px 5px 0 rgba(0,0,0,0.2)!important;
     }

    .post-icons .w3-col {
        height: 35px!important;
    }

    .post-icons .fa {
        width: 30px;
        font-size: 20px;
        padding: 3px!important;
        margin-right: 2px!important;
    }

    .post-icons .material-icons {
        font-size: 24px;
    }

    @media screen and (max-width: 420px) {
        .filter-sidebar-content {
            width: 300px!important;
        }

        .media-left, .media-right, .media-body {
            display: block!important;
        }

        .media-heading div {
            text-overflow: auto!important;
            white-space: auto!important;
            width: auto!important;
            overflow: auto!important;
        }
    }


 </style>
@endsection()

@section("content")
<div id="map-container" >
    @include("website.post.post")
    @include("website.post.filter")
    @include("website.post.infobox")
    @include("website.post.recommended")


    <div id="map" style="margin-top: 20px"   ></div>

</div>
@endsection

@section("js")

<script src="{{ url('/website') }}/js/Chart.min.js"></script>
<!--
<script src="{{ url('/website') }}/js/watermark.min.js"></script>
-->
<script src="{{ url('/website') }}/js/post.js"></script>
<script src="{{ url('/website') }}/js/select2.min.js"></script>
<script>
    // watermark all images


    //watermark(['http://web.com/a.jpg', public_path+"/website/image/logo.png"], options);

$(document).ready(function(){

@if (isset($_GET['search']))
    setTimeout(function(){
        app.filter.search = '{{ $_GET["search"] }}';
        search();
    }, 3000);
@endif
});

var options = [];
var chartTitle = "{{ __('words.avg_of_meter_in_city') }}";
app = new Vue({
    el: '#map-container',
    data: {
        locale: '{{ session("locale") }}',
        currentPost: null,
        public_path: '{{ url("/") }}',
        counter: 0,
        price: 0,
        space: 0,
        result_message: '',
        loadding360: true,
        recommends: [],
        filter: {
            city_id: null,
            area_id: null,
            category_id: null,
            bedroom_number: 0,
            bathroom_number: 0,
        },
        currentPostId: {{ $post? $post->id : 'null' }},
        posts: []
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
        },
        showPost: showPost
    },
    computed: {
        height: function () {
            return window.innerHeight;
        }
    },
    watch: {
    }
});
function initMap() {
    var locationSearchDiv = document.createElement('div');
    locationSearchDiv.style.width = "200px";
    locationSearchDiv.style.padding = "10px";
    locationSearchDiv.style.paddingTop = "30px";
    $(locationSearchDiv).html($(".search-location-btn").html());
    locationSearchDiv.addEventListener('click', function() {
          searchWithCurrentLocation();
    });
    options = {
        center: {lat: 30.0596185, lng: 31.2884236},
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        scaleControl: true,
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        fullscreenControl: false,
        streetViewControl: true,
        zoom: 12.25,
        maxZoom: 16.25,
        styles: [
                  {
                    "featureType": "poi.attraction",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.business",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.government",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.medical",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.place_of_worship",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  },
                  {
                    "featureType": "poi.sports_complex",
                    "stylers": [
                      {
                        "visibility": "off"
                      }
                    ]
                  }
                ]

    };
    map = new google.maps.Map(document.getElementById('map'), options);
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(locationSearchDiv);


}

$("#map").css("height", (window.innerHeight - 70) + "px");
$(".filter-sidebar-content").css("height", (window.innerHeight - 100) + "px");

$('.select2-filter').select2();

</script>
<script src="{{ url('/website') }}/js/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4ow5PXyqH-gJwe2rzihxG71prgt4NRFQ&callback=initMap"
async defer></script>
@endsection


