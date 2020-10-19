@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<style type="text/css">
    .home {
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width: 100%;
        background: #DEDEDE;
        }

        .w3-modal-content {
            background-color: transparent!important;
        }

        .w3-ul .btn {
            padding: 0px!important;
            margin-bottom: 0px!important;
        }

        .register-item {
            margin-bottom: 15px!important;
        }

        .small-height-item {
            border: 0px!important;
        }

        .application-container {
            overflow: auto!important;
        }

        .small-height-item img {
            width: 10vw!important;
        }

        .notification-container {
            overflow: auto;
            padding: 10px;
        }

        .notification-item {
            border-radius: 1em;
            overflow: hidden;
            background-color: white;
            margin-bottom: 5px;
            padding: 0px!important;
        }


    </style>

    <!-- html content -->
    <div class="home dark-theme-background" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a href="#" class="w3-bar-item btn" onclick="back()" >
                  <span class="fa fa-angle-{{ session("direction")=='rtl'? 'right' : 'left' }} w3-text-white w3-xlarge" ></span>
              </a>
              <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.notifications') }}</span>
              </a>
            </div>
        </div>
        <div class="application-container w3-display-container notification-container" v-bind:style="'height: ' + (height - 90) + 'px'" >
            <ul class="w3-ul">
                <li v-for="notification in notifications"
                    ontouchstart="recordTouch(event)"
                    ontouchmove="remove(event, this)"
                    ontouchend="resetPosition(this)"
                class="animated fadeInUp notification-item shadow light-theme-background-hover"  >
                    <div
                    class="media"
                    onclick="loadPage('phone/post/show?post_id='+$(this).attr('data-id'))"
                    v-bind:data-id="notification.post? notification.post.id : ''"
                    style="padding: 0px!important">
                      <div class="media-left" style="padding: 0px!important" >
                        <a href="#">
                          <img class="media-object" v-if="notification.post" v-bind:src="notification.post.images[0]? notification.post.images[0].image: '{{ url('/images/logo.png') }}'" width="100px" height="90px" alt="...">

                           <img class="media-object" v-if="!notification.post" src="{{ url('/images/logo.png') }}" width="100px" height="90px" alt="...">
                        </a>
                      </div>
                      <div class="media-body w3-padding">
                        <div class="w3-text-gray w3-tiny" v-html="notification.diff_time" ></div>
                        <h6 class="media-heading">
                            <span v-html="notification.title" ></span>
                        </h6>
                        <p class="w3-text-gray" v-html="notification.body" ></p>
                      </div>
                    </div>
                </li>

            </ul>

            <!-- application bottom nav -->
            @include("mobile.bottomNav")
        </div>




    </div>




    <script>
        var x = 0;
        var y = 0;

        function recordTouch(event) {
            x = event.touches[0].clientX;
            y = event.touches[0].clientY;
        }

        function remove(event, element) {
            var dir = (event.touches[0].clientX - x) > 0? 'right' : 'left';
            var deltaX = Math.abs(event.touches[0].clientX - x);
            var deltaY = Math.abs(event.touches[0].clientY - y);

            if (deltaX > deltaY) {
                if (dir == "right") {
                    var margin = parseInt(element.style.marginLeft.replace("px", "")) + "";
                    if (margin == "NaN")
                        margin = 0;

                    margin += 5;
                    element.style.marginLeft = (margin + 5) + "px!important";
                } else {
                    var margin = parseInt(element.style.marginRight.replace("px", "")) + "";
                    if (margin == "NaN")
                        margin = 0;
                    element.style.marginRight = (margin + 5) + "px!important";
                }
                console.log(element.style.margin);
            }
            //console.log(deltaX + " : " + deltaY);
            //console.log(event);
        }

        function resetPosition(element) {

        }

        function loadNotifications() {
            var data = {
                api_token: window.localStorage.getItem("api_token")
            };
            $.get(BASE_URL + "/user/notification/get?"+$.param(data), function(r){
                page.notifications = r.data;
                page.loading = false;
            });
        }

        var page = new Vue({
            el: '#page',
            data: {
                notifications: [],
                loading: true
            },
            methods: {
            },
            computed: {
                height: function () {
                    return window.innerHeight;
                }
            }
        });

        $(document).ready(function(){

              loadNotifications();
            //
            $(".notification-bottom-nav-item").addClass("light-theme-color");
        });
    </script>
