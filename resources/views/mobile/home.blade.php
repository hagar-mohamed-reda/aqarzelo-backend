@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<style type="text/css">
.loading {
    display: block;
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
}

.sk-circle {
    margin: 10% auto;
    width: 40px;
    height: 40px;
    position: relative;
}

.sk-circle .sk-child {
    width: 100%;
    height: 100%;
    position: absolute;
    right: 0;
    top: 0;
}

.sk-circle .sk-child:before {
    content: '';
    display: block;
    margin: 0 auto;
    width: 15%;
    height: 15%;
    background-color: #33b35a;
    border-radius: 100%;
    -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
    animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}

.sk-circle .sk-circle2 {
    -webkit-transform: rotate(30deg);
    transform: rotate(30deg);
}

.sk-circle .sk-circle3 {
    -webkit-transform: rotate(60deg);
    transform: rotate(60deg);
}

.sk-circle .sk-circle4 {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}

.sk-circle .sk-circle5 {
    -webkit-transform: rotate(120deg);
    transform: rotate(120deg);
}

.sk-circle .sk-circle6 {
    -webkit-transform: rotate(150deg);
    transform: rotate(150deg);
}

.sk-circle .sk-circle7 {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}

.sk-circle .sk-circle8 {
    -webkit-transform: rotate(210deg);
    transform: rotate(210deg);
}

.sk-circle .sk-circle9 {
    -webkit-transform: rotate(240deg);
    transform: rotate(240deg);
}

.sk-circle .sk-circle10 {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
}

.sk-circle .sk-circle11 {
    -webkit-transform: rotate(300deg);
    transform: rotate(300deg);
}

.sk-circle .sk-circle12 {
    -webkit-transform: rotate(330deg);
    transform: rotate(330deg);
}

.sk-circle .sk-circle2:before {
    -webkit-animation-delay: -1.1s;
    animation-delay: -1.1s;
}

.sk-circle .sk-circle3:before {
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

.sk-circle .sk-circle4:before {
    -webkit-animation-delay: -0.9s;
    animation-delay: -0.9s;
}

.sk-circle .sk-circle5:before {
    -webkit-animation-delay: -0.8s;
    animation-delay: -0.8s;
}

.sk-circle .sk-circle6:before {
    -webkit-animation-delay: -0.7s;
    animation-delay: -0.7s;
}

.sk-circle .sk-circle7:before {
    -webkit-animation-delay: -0.6s;
    animation-delay: -0.6s;
}

.sk-circle .sk-circle8:before {
    -webkit-animation-delay: -0.5s;
    animation-delay: -0.5s;
}

.sk-circle .sk-circle9:before {
    -webkit-animation-delay: -0.4s;
    animation-delay: -0.4s;
}

.sk-circle .sk-circle10:before {
    -webkit-animation-delay: -0.3s;
    animation-delay: -0.3s;
}

.sk-circle .sk-circle11:before {
    -webkit-animation-delay: -0.2s;
    animation-delay: -0.2s;
}

.sk-circle .sk-circle12:before {
    -webkit-animation-delay: -0.1s;
    animation-delay: -0.1s;
}

@-webkit-keyframes sk-circleBounceDelay {
    0%,
    80%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

@keyframes sk-circleBounceDelay {
    0%,
    80%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
    }
}

.spinner {
    margin: 310px auto 0;
    text-align: center;
}

.sk-circle .sk-child:before {
    background-color: white !important;
}
    .home {
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width: 100%;
        background: #DEDEDE;
        }

        .w3-modal-content {
            background-color: transparent!important;
        }


            .application-container {
                border-top-left-radius: 2em;
                border-top-right-radius: 2em;
                background-color: white;
                overflow: hidden;
                background: #DEDEDE;
            }

            .application-header {
                height: 80px;
            }


        .result-show {
            bottom: 80px;
            background-color: transparent;
            overflow-x: auto;
        }

        .result-show-item {
            border-radius: 1em;
            overflow: hidden;
            background-color: white;
        }

        .result-show-item img {
            height: 20vh;
        }

        .application-grad-back {
            background-image: url({{ url('/mobile/images/back-gradient.png') }});
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            width: 100%;
            height: 200px;
        }

        .post-show-image-container {
            background-size: cover;
            width: 200%;
            height: 200px;
        }

    </style>

    <!-- html content -->
    <div class="home dark-theme-background" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <div class="w3-bar w3-padding">
              <a class="w3-bar-item btn" onclick="loadPage('phone/setting')">
                  <span class="fa fa-cog w3-xlarge w3-text-white" ></span>
              </a>
              <a class="w3-bar-item btn w3-{{ session('direction')=='rtl'? 'left' : 'right' }} " onclick="loadPage('phone/filter')" >
                <span class="fa fa-filter w3-xlarge w3-text-white"  ></span>
              </a>
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 60) + 'px'" >
            <div id="map" class="w3-block"  style="height: 100%" ></div>

            <div  class="application-grad-back w3-display-bottommiddle" >

                <!-- application bottom nav -->
                @include("mobile.bottomNav")

                <div class="result-show w3-display-bottomleft w3-block">
                <b id='checkDirection' style='background-image: repeating-linear-gradient(to bottom, #02A2A7, #06D9B2) !important;font-weight: bolder;' class="fa fa-angle-down btn w3-text-white w3-large" onclick="hideRecomended()" ></b>
                    <div class="owl-carousel owl-theme hideRecomended" style="width: 100%;direction: ltr!important" >
                        <div class="item" v-for="post in posts" >
                            <div class="result-show-item shadow" onclick="loadPage('phone/post/show?post_id='+$(this).attr('data-id'))" v-bind:data-id="post.id" >
                                <img v-if="post.images[0]" v-bind:src="post.images[0].image" >
                                <br>
                                <div class="w3-padding" >
                                    <div class="" ><b v-html="post.title.substring(0,15)+'..'" ></b></div>
                                    <span v-html="post.price" ></span>
                                    <span v-html="post.space" ></span> M
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                </div>
            </div>
        </div>





        <!-- post show modal -->
        <div class="modal fade post-show-modal" id="show-post-modal" tabindex="-1" role="dialog" style="z-index: 9999!important">
            <div class="modal-dialog" role="document" style="padding-top: 20%" >

                <div
                v-bind:data-id="currentPost.id"
                onclick="$('.post-show-modal').modal('hide');loadPage('phone/post/show?post_id=' + $(this).attr('data-id'))"
                class="modal-content light-theme-background w3-text-white w3-display-container"
                style="overflow: hidden" >
                    <img
                        v-if="currentPost.images"
                        v-bind:src="currentPost.images? currentPost.images[0].image : '{{ url('/mobile/images/image.png') }}'" class='w3-block hidden' >
                    <div
                        v-bind:style=" 'background-image: url(' + (currentPost.images? currentPost.images[0].image : '{{ url('/mobile/images/image.png') }}') + ')' "
                        class="post-show-image-container" >
                    </div>
                    <div class="modal-body" >
                        <div class="w3-large" >
                            <b class="" v-html='currentPost.title? currentPost.title : ""' ></b>
                        </div>
                        <div>
                            <b class="post-show-price" v-if="currentPost.price" v-html='format(currentPost.price)' ></b>
                            <b class="post-show-space" v-if="currentPost.space" v-html='currentPost.space + " M"' ></b>
                        </div>
                    </div>

                    <div class="w3-display-topright w3-padding" >
                        <img class="w3-circle shadow" width="30px" height="30px" v-if="currentPost.user" v-bind:src="currentPost.user.company.photo_url"   >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="loading">
    <div class="spinner">
        <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
        </div>
    </div>
</section>


    <!-- javascript -->

    <script>
        var path = "{{ request()->path }}";
        var lat = null
        var lng = null;
        var map;
        var marker = null;
        var markers = [];
        var placeMarker = null;

        function loadPosts() {
            var data = $.param(page.search);
            $.get(BASE_URL + "/post/search?"+data, function(r){
                page.posts = r.data;

                if (r.data.length > 0)
                    last_posts = r.data;

                drawPostsMarkers(page.posts);
                setTimeout(function(){
                    if (page.posts.length > 0)
                        setOwlCarousel();
                }, 1000);

                if (page.posts.length <= 0) {
                //    loadFromLastPosts();
                //} else {

                    var html =
                    "<button class='btn-sm btn light-theme-background w3-text-white' onclick='loadRecommendPosts();$(this).hide(500)' >{{ __('words.recommended_posts') }}</button>";
                    successToast("{{ __('words.no_result_found') }} " + html);
                    $('.mobile-message-dialog button').click(function(){
                        loadRecommendPosts();
                    });
                    // loadRecommendPosts();
                }
            });
        }

        function loadFromLastPosts() {
            page.posts = last_posts;
            drawPostsMarkers(page.posts);
            setTimeout(function(){
                setOwlCarousel();
            }, 1000);
        }

        function loadRecommendPosts() {
            $('.loading').css({display: 'block'});
            //var data = $.param(page.search);
            $.get(BASE_URL + "/post/recommended", function(r){
                page.posts = r.data;
                drawPostsMarkers(page.posts);
                setTimeout(function(){

                    setOwlCarousel();
                }, 1000);
                $('.loading').css({display: 'none'});
            });
        }

        function addMarker(location, label, action, postId) {
            var icon = public_path + "/mobile/images/pin.png";
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.DROP,
                // icon: {
                //   url: icon,
                //   labelOrigin: { x: 12, y: 40}
                // },
                title: label,
                label: { backgroundColor: '#fff', color: 'white', fontWeight: 'bolder', fontSize: '13px', text: label },
                labelInBackground: true
            });


            marker.addListener('click', function () {
                showCurrentPost(page.posts[postId]);
                if (action)
                    action();
            });
            return marker;
        }
        /**
         * set all posts marker on the map
         *
         * @param {Array} posts
         */
        function drawPostsMarkers(posts) {

            for (var i = 0; i < posts.length; i++) {
                var post = posts[i];

                if(post.price > 1000000){
                    var x = post.price/1000000
                    post.price = x.toString() + 'M' ;
                }
                else if(post.price > 1000){
                    var x = post.price/1000
                    post.price = x.toString() + 'K' ;
                }else{
                    post.price = post.price
                }

                var marker = new addMarker({lat: parseFloat(post.lat), lng: parseFloat(post.lng)}, post.price+"", function(){
                   //new showCurrentPost(post);
                   //console.log(post);
                }, i);
                markers.push(marker);
            }
        }

        function showCurrentPost(post) {
            page.currentPost = post;
            $('#show-post-modal').modal('show');
        }


        function setOwlCarousel() {
            $('.owl-carousel').owlCarousel({
                loop:true,
                center:true,
                margin:10,
                dots: false,
                nav:false,
                responsive:{
                    0:{
                        items:2
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    800:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
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
            });

            /*google.maps.event.addListener(map, 'click', function (e) {
                placeMarker(e.latLng, map);
            });*/

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
                currentPost: {},
                posts: [],
                search: {},
                photo: window.localStorage.getItem("photo"),
                api_token: window.localStorage.getItem("api_token"),
                h: 100
            },
            methods: {
                format: function(n) {
                    return n.toLocaleString('en-US', { style: 'currency', currency: 'EGP'});
                }
            },
            computed: {
                height: function () {
                    return window.innerHeight;
                }
            }
        });

        $(document).ready(function(){

            @if (request()->lng && request()->lat)
                page.search.lat = {{ request()->lat }};
                page.search.lng = {{ request()->lng }};
            @elseif (request()->space1 && request()->space2)
                page.search.space1 = {{ request()->space1 }};
                page.search.space2 = {{ request()->space2 }};
            @elseif (request()->price1 && request()->price2)
                page.search.price1 = {{ request()->price1 }};
                page.search.price2 = {{ request()->price2 }};
            @elseif (request()->bedroom_number)
                page.search.bedroom_number = {{ request()->bedroom_number }};
            @elseif (request()->bathroom_number)
                page.search.bathroom_number = {{ request()->bathroom_number }};
            @elseif (request()->city_id)
                page.search.city_id = {{ request()->city_id }};
            @elseif (request()->area_id)
                page.search.area_id = {{ request()->area_id }};
            @elseif (request()->category_id)
                page.search.category_id = {{ request()->category_id }};
            @endif

            loadPosts();
            //
            $(".home-bottom-nav-item").addClass("light-theme-color");
        });
    </script>
