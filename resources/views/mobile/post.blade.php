
@php
$postId = request()->post_id;

$post = App\Post::find($postId);

$relatedPosts = App\Post::where('finishing_type', $post->finishing_type)
                    ->orWhere('bedroom_number', $post->bedroom_number)
                    ->orWhere('bathroom_number', $post->bathroom_number)->take(10)->get();

$c = new App\Http\Controllers\Api\post\MainController;
$recommends = $c->getRecommended(new Illuminate\Http\Request);
@endphp
@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<style type="text/css">
    .page {
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-color: white;
        overflow: auto;
        width: 100%;
    }

    .w3-modal-content, .owl-carousel {
        background-color: transparent!important;
    }

    .post-images-hover {
        height: 140px;
        overflow: hidden;
        background-size: 100% 120px;
        background-position: bottom;
        background-repeat: no-repeat;
        width: 100%;
        z-index: 2;
        background-image: url('{{ url('/mobile/images/post-grad.png') }}');
    }

    .owl-nav {
        position: absolute;
        top: 45%;
        width: 100%;

    }

    .comment-buttons {
        display: none
    }

    .post-reviews {
        display: none
    }


        .result-show {
            background-color: transparent;
            overflow: hidden;
        }

        .result-show-item {
            border-radius: 1em;
            overflow: hidden;
            background-color: white;
        }

        .result-show-item img {
            height: 140px!important;
        }

        .application-grad-back {
            background-image: url({{ url('/mobile/images/back-gradient.png') }});
            background-size: 100%;
            background-position: bottom;
            background-repeat: no-repeat;
            width: 100%;
        }

        .image-viewers .padding-top {
            padding-top: 40%!important;
        }

        .image-viewers .owl-prev {
            position: fixed;
            left: 20px;
            padding: 5px!important;
            font-size: 40px!important;
            background-color: #02A2A7!important;
            color: white!important;
        }

        .image-viewers .owl-next {
            position: fixed;
            right: 20px;
            padding: 5px!important;
            font-size: 40px!important;
            background-color: #02A2A7!important;
            color: white!important;
        }

        .image-viewers .owl-next span, .image-viewers .owl-prev span {
            padding: 5px!important;
        }

</style>


<!-- html content -->
<div class="page" id="page" v-bind:style="'height: ' + height + 'px'" >


<div
class="modal fade image-viewers w3-display-container w3-white"
style="z-index: 999999!important;background-color: #06D9B2!important!important;" >

    <div class="w3-display-topright w3-padding" style="z-index: 99999999;position: fixed!important" onclick="$('.image-viewers').modal('hide')" >
        <span class="fa fa-close w3-xlarge btn dark-theme-background w3-text-white shadow" > </span>
    </div>

    <div class="owl-carousel owl-theme image-viewers-carousel" style="width: 100%;direction: ltr!important" >
                @foreach($post->images as $image)
                <div class="item" >
                    <div class="" >
                        @if ($image->is_360)
                        <iframe
                            allowfullscreen
                            src="https://aqarzelo.com/public/panorama?image={{ $image->image }}"
                            v-bind:height="(height) + 'px'"
                            width="100%" ></iframe>
                        @else
                        <img src="{{ $image->image }}"  class="w3-block" onload="calculateTop(this)" >
                        @endif
                    </div>
                </div>
                @endforeach
    </div>
</div>

    <div class="w3-display-topleft w3-padding" style="z-index: 10" >
        <br>
        <b style='background-color: black !important;font-weight: bolder;' class="fa fa-angle-left btn w3-text-white w3-large" onclick="back('return')" ></b>
    </div>

    <div class="owl-carousel-container w3-display-container" >

        <div class="owl-carousel owl-theme images-carousel" style="width: 100%;direction: ltr!important" >
            @foreach($post->images as $image)
            <div class="item"  onclick="$('.image-viewers').modal('show')"  >
                <div class="" >
                    <img src="{{ $image->image }}" height="300px" class="w3-block" >
                </div>
            </div>
            @endforeach
        </div>
        <br>

        <div class="post-images-hover w3-display-bottomright w3-padding" >
            <br>
            <div class="w3-text-white w3-left"  >
                <b class="w3-xlarge" >{{ $post->title }}</b><br>
                <b class="" >EGP {{ number_format($post->price) }}</b><br>
                <b class="" >{{ $post->space }} M</b><br>
            </div>
            <div class="w3-text-white w3-right" >
                <br>
                <div>
                    @for($i = 0; $i < 5; $i ++)
                    <span class="fa fa-star {{ $i < $post->rate? 'w3-text-orange': 'w3-text-gray' }}" ></span>
                    @endfor
                </div>
                <div>
                    <span>{{ $post->views }}</span> {{ __('mobile.reviews') }}
                </div>
            </div>
        </div>
    </div>

        <div class="w3-display-topmiddle form-inline w3-block" style="top: 280px;z-index: 4" >
            <table class="w3-table" >
                <tr>
                    <td><span style="width: 20px" ></span></td>
                    <td>
                        <input
                        type="text"
                        onclick="showCommentSection()"
                        class="form-control input-sm shadow"
                        placeholder="{{ __('mobile.comment') }}..."
                        id="post-comment-input"
                        style="border-radius: 5em!important;width: 180px;" >
                    </td>
                    <td>
                        <div class="favourite-chat-buttons" >
                            <button class="btn w3-circle btn-sm w3-white shadow" onclick="loadChat()" style="width: 35px;height: 35px;" >
                                <b class="fa fa-commenting w3-text-gray" ></b>
                            </button>
                            <button class="btn w3-circle btn-sm w3-white shadow" onclick="favourite(this)" style="width: 35px;height: 35px;" >
                                <b class="fa fa-heart-o w3-text-pink" ></b>
                            </button>
                        </div>
                        <div class="comment-buttons" >
                            <button
                            class="close-message-button btn w3-circle btn-sm w3-white shadow"
                            onclick="$('.comment-buttons').hide();$('.favourite-chat-buttons').show();$('.post-reviews').hide();$('.post-details').show()"
                            style="width: 35px;height: 35px;" >
                                    <b class="fa fa-close w3-text-gray" ></b>
                            </button>
                            <button
                            class="send-message-button btn w3-circle btn-sm w3-white shadow"
                            onclick="sendComment(this)"
                            style="width: 35px;height: 35px;" >
                                    <b class="fa fa-send w3-text-gray" ></b>
                            </button>
                        </div>
                    </td>
                    <td><span style="width: 20px" ></span></td>
                </tr>
            </table>

        </div>

    <!-- reocommends post
application-grad-back
     -->


    <div class="result-show w3-display-bottomleft w3-block " style="z-index: 10;position: fixed;" >
    <b id='checkDirection' style='background-image: repeating-linear-gradient(to bottom, #02A2A7, #06D9B2) !important;font-weight: bolder;' class="fa fa-angle-down btn w3-text-white w3-large" onclick="hideRecomended()" ></b>
        <div
        class="owl-carousel owl-theme application-grad-back hideRecomended"
        id="recommend-carsousel" style="width: 100%;direction: ltr!important" >
            <div class="item"
            v-for="post in posts"
            onclick="loadPage('phone/post/show?post_id='+$(this).attr('data-id'))" v-bind:data-id="post.id"
            >
                <div class="result-show-item" >
                    <img
                    v-if="post.images[0]"
                    height="80px"
                    class="w3-block"
                    v-bind:src="post.images[0].image" />
                    <div class="w3-padding" >
                        <div class="w3-large" ><b v-html="post.title.substring(0, 10) + '..'" ></b></div>
                        <span v-html="post.price" ></span>
                        <span v-html="post.space" ></span> M
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="application-container w3-display-topleft w3-block" style="top: 300px;z-index: 3;margin: 0px!important" >


        <br>
        <ul class="w3-ul nicescroll w3-block w3-padding post-reviews" >
            @foreach($post->reviews()->get() as $item)
            @if($item->comment)
            <li>
                <div class="media">
                  <div class="media-left">
                    <a>
                      <img
                      class="media-object w3-circle"
                      width="40px"
                      height="40px"
                      src="{{ $item->user()->first()->photo_url }}" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h5 class="media-heading">{{ $item->user()->first()->name }}</h5>
                    <b>
                        {{ $item->comment }}
                    </b>
                  </div>
                </div>
            </li>
            @endif
            @endforeach
        </ul>

        <ul class="w3-ul nicescroll post-content w3-block post-details"  >
            <li class="w3-row" id="information" >
                <a name="information" ></a>
                @if ($post->bedroom_number > 0)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-bed" ></span>
                    <span >{{ $post->bedroom_number }}</span>
                    {{ __("words.rooms") }}
                </div>
                @endif
                @if ($post->bathroom_number > 0)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-bath" ></span>
                    <span  >{{ $post->bathroom_number }}</span>
                    {{ __("words.bathrooms") }}
                </div>
                @endif

                <div class="w3-col l4 m4 s4" >
                    <i class="fa fa-diamond" ></i>
                    <span >{{ __('words.' . $post->finishing_type) }}</span>
                </div>
                @if ($post->furnished)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-map-o" ></span>
                    {{ __("words.furnished") }}
                </div>
                @endif
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-male" ></span>
                    <span>{{ $post->owner_type }}</span>
                </div>
                @if ($post->has_parking)
                <div class="w3-col l4 m4 s4"  >
                    <span class="fa fa-taxi" ></span>
                    {{ __("words.has_parking") }}
                </div>
                @endif
                @if ($post->has_garden)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-leaf" ></span>
                    {{ __("words.has_garden") }}
                </div>
                @endif
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-home" ></span>
                    <span  >{{ $post->type }}</span>
                </div>
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-cc-visa" ></span>
                    <span >{{ $post->payment_method }}</span>
                </div>
                @if ($post->floor_number)
                <div class="w3-col l4 m4 s4"  >
                    <span class="fa fa-building" ></span>
                    {{ __("words.floor_number") }} <span  >{{ $post->floor_number }}</span>
                </div>
                @endif
                @if ($post->build_date)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-calendar" ></span>
                    <span >{{ $post->build_date }}</span>
                </div>
                @endif

                @if ($post->city)
                <div class="w3-col l4 m4 s4"   >
                    <span class="fa fa-globe" ></span>
                    <span>{{ $post->city->name_en }}</span>
                </div>
                @endif

                @if ($post->area)
                <div class="w3-col l4 m4 s4"   >
                    <span class="fa fa-map-marker" ></span>
                    <span  >{{ $post->area->name_en }}</span>
                </div>
                @endif
                @if ($post->category)
                <div class="w3-col l4 m4 s4" >
                    <span class="fa fa-sitemap" ></span>
                    <span  >{{ $post->category->name_en }}</span>
                </div>
                @endif

            </li>
            <li>
                <div class="w3-xlarge text-capitalize" >{{ __("words.description") }}</div>
                <div class="w3-large" >
                    {!! str_replace("\n", "<br/>", $post->description) !!}
                </div>
            </li>
            <li>
                <div class="w3-large" >
                    <a class="fa fa-phone light-theme-background btn w3-text-white w3-btn w3-circle shadow"
                       style="width: 50px;height: 50px;border-radius: 5em!important;line-height: 2"
                       href="tel:{{ $post->contact_phone }}"
                       role="button"
                       ></a>
                    <span class="w3-margin-left contact_phone" >{{ $post->contact_phone }}</span>
                </div>
                <br>
                <div id="map" class="w3-block w3-round" style="height: 200px;width: 100%;" ></div>
            </li>
            <li >
                <b class="w3-large text-capitalize" >{{ __('mobile.related_posts') }}</b>
                <div class="w3-row related-post" style="height: 190px;overflow: auto;">
                    <div class="w3-padding w3-row" style="width: 2300px;height: 190px"  >
                        @foreach($relatedPosts as $p)
                        <div style="padding: 5px;width: 210px;float: left"
                        onclick="loadPage('phone/post/show?post_id={{ $p->id }}')"    >
                            <div class="shadow w3-round w3-white" >
                                <div
                                    style="background-size: cover;background-image: url({{  $p->images[0]? $p->images[0]->image :  url('/mobile/images/image.png') }});width: 100%;height: 110px"
                                 >

                                </div>
                                <br>
                                <div class="w3-padding w3-tiny w3-text-gray" >
                                    <b>{{ substr($p->title, 0, 10) }}..</b>
                                    <br>
                                    EGP {{ number_format($p->price) }}
                                    {{ $p->space }} M
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </li>
            <li>
                <b class="w3-large text-capitalize" >{{ __('mobile.analysis') }}</b>
                <a name="analysis" ></a>
                <div   id="analysis">
                    <canvas id="currentPostChart" width="100%" ></canvas>
                </div>
            </li>
            <li>
                <b class="w3-large text-capitalize" >{{ __('mobile.avg_of_price') }} {{ $post->city->name_en }}</b>
                <br><br>
                <ul class="w3-ul" >
                    @for($i = 0; $i < count($post->chart_data["x"]); $i ++)
                    <li class="w3-round w3-white shadow w3-padding w3-container w3-margin-bottom" >
                        <div class="w3-left" >
                            <b>{{ $post->chart_data["x"][$i] }}</b>
                        </div>
                        <div class="w3-right" >
                            <b>{{ $post->chart_data["y"][$i] }} EGP</b>
                        </div>
                    </li>
                    @endfor
                </ul>
            </li>
        </ul>
    </div>


</div>


<!-- javascript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30.0455965, lng: 31.2387195},
                disableDefaultUI: false,
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
            /*
            google.maps.event.addListener(map, 'click', function (e) {
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


            var p = new google.maps.LatLng({{ $post->lat }}, {{ $post->lng }});
            placeMarker(p, map);

        }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4ow5PXyqH-gJwe2rzihxG71prgt4NRFQ&libraries=places&callback=initMap"
    async defer></script>

<script>

var chartTitle = "{{ __('words.avg_of_meter_in_city') }}";

    function showCommentSection() {
        $('.comment-buttons').show();$('.favourite-chat-buttons').hide();$('.post-reviews').show();$('.post-details').hide();
        $('.result-show')[0].style.bottom = "-250px";
    }

        function loadPosts() {
            $.get(BASE_URL + "/post/recommended", function(r){
                page.posts = r.data;
                setTimeout(function(){
                    setOwlCarousel2();
                }, 1000);
            });
        }

    function loadChat() {
        if (!app.api_token) {
            Swal.fire({
              icon: 'error',
              title: '{{ __("mobile.error") }}',
              text: '{{ __("mobile.login_first") }}',
            });
            return;
        }
        if (app.api_token == '{{ $post->user->api_token }}') {
            Swal.fire({
              icon: 'error',
              title: '{{ __("mobile.error") }}',
              text: '{{ __("mobile.you_cant_chat_with_your_self") }}',
            });
            return;
        }

        loadPage('phone/chat?user_to={{ $post->user->id }}');
    }

    function favourite(button) {
        if (!app.api_token) {
            Swal.fire({
              icon: 'error',
              title: '{{ __("mobile.error") }}',
              text: '{{ __("mobile.login_first") }}',
            });
            return;
        }
        var data = {
            api_token: app.api_token,
            post_id: '{{ $post->id }}'
        };
        $.post("{{ url('/api/user/favourite/toggle') }}", data, function(r){
            if (r.status == 1) {
                Swal.fire({
                  icon: 'success',
                  title: '{{ __("mobile.done") }}',
                  text: r.message_en,
                });
                $(button).html('<b class="fa fa-heart w3-large w3-text-pink" ></b>')
            }
            else {
                Swal.fire({
                  icon: 'error',
                  title: '{{ __("mobile.error") }}',
                  text: r.message_en,
                });
            }
        });
    }

    function sendComment(button) {
        if (!app.api_token) {
            Swal.fire({
              icon: 'error',
              title: '{{ __("mobile.error") }}',
              text: '{{ __("mobile.login_first") }}',
            });
            return;
        }
        if ($("#post-comment-input").val().length <= 0) {
            Swal.fire({
              icon: 'error',
              title: '{{ __("mobile.error") }}',
              text: '{{ __("mobile.write_comment") }}',
            });
            return;
        }
        var data = {
            api_token: app.api_token,
            post_id: '{{ $post->id }}',
            comment: $("#post-comment-input").val()
        };
        $.post("{{ url('/api/user/review/add') }}", data, function(r){
            if (r.status == 1) {
                Swal.fire({
                  icon: 'success',
                  title: '{{ __("mobile.done") }}',
                  text: r.message_en,
                });
                $(".close-message-button").click();
                loadPage('phone/post/show?post_id={{ $post->id }}');
            }
            else {
                Swal.fire({
                  icon: 'error',
                  title: '{{ __("mobile.error") }}',
                  text: r.message_en,
                });
            }
        });
    }

    function setOwlCarousel() {
        $('.images-carousel').owlCarousel({
            loop: true,
            center: true,
            margin: 10,
            dots: false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    function setOwlCarousel2() {
        $('#recommend-carsousel').owlCarousel({
                loop:true,
                center:true,
                margin:10,
                dots: false,
                items: 2,
                nav:false,
                responsive: {
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

    function setOwlCarousel3() {
        $('.image-viewers-carousel').owlCarousel({
            loop: true,
            center: true,
            margin: 10,
            dots: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    function setCurrentPostChart() {
            var ctx = document.getElementById('currentPostChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: [
                        @foreach($post->chart_data["x"] as $item)
                        '{{ $item }}',
                        @endforeach
                    ],
                    datasets: [{
                            label: '{{ __('mobile.avg_of_price') }} {{ $post->city->name_en }}',
                            backgroundColor: 'rgba(2, 169, 168, 0.5)',
                            borderColor: 'rgb(2, 150, 168)',
                            data: [
                                @foreach($post->chart_data["y"] as $item)
                                {{ $item }},
                                @endforeach
                            ]
                        }]
                },
                // Configuration options go here
                options: {}
            });
    }

    function toggleRecommends(event) {

    }

    function calculateTop(img) {
        img.style.padding = "0px";
        img.style.marginTop = (window.innerHeight / 2) - (img.height / 2) + "px";
    }

    var page = new Vue({
        el: '#page',
        data: {
            posts: [],
        },
        methods: {
        },
        computed: {
            height: function () {
                return window.innerHeight;
            }
        }
    });
    var position = $(window).scrollTop();

    $(document).ready(function () {
        setOwlCarousel();
        setOwlCarousel3();
        setCurrentPostChart();
        loadPosts();
        $(".related-post").css("width", window.innerWidth + "px");


        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var bottom =  parseInt($('.result-show').css("bottom").replace("px", ""));
            var amount = 40;

            //console.log("scroll: "+scroll+"/position: "+position);

            if(scroll > position) {
                if (bottom > -250) {
                    bottom -= amount;
                }
            } else {
                if (bottom < 0) {
                    bottom += amount;
                }

            }

            if (bottom > 0) {
                bottom = 0;
            }
            position = scroll;
            $('.result-show')[0].style.bottom = bottom + "px";
            console.log(bottom);
        });

    });
</script>
