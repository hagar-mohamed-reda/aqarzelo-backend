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

        .contact-item {
            padding: 10px;
        }


    </style>

    <!-- html content -->
    <div class="home dark-theme-background" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a style='box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);' class="w3-bar-item btn" onclick="back()" >
                  <span class="fa fa-angle-left w3-text-white w3-xlarge" ></span>
              </a>
              <a  class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.contact') }}</span>
              </a>
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            <br><br>
            <center>
                <img src="{{ url('/mobile/images/contact-image.png') }}"  width="60%" >
            </center>

            <div class="w3-padding"  >
                <center>
                    <span class="w3-large" >{{ __('mobile.follow_us') }}</span>
                </center>
                <br>
                <center>
                    <a target="_blank" class="fa fa-youtube-play w3-text-red w3-xxlarge contact-item" v-bind:href="youtube"  ></a>
                    <a target="_blank" class="fa fa-facebook-square w3-text-indigo w3-xxlarge contact-item" v-bind:href="facebook"  ></a>
                    <a target="_blank" class="fa fa-twitter w3-text-cyan w3-xxlarge contact-item" v-bind:href="twitter"  ></a>
                </center>
                <br>
                <center>
                    <span class="w3-large" >{{ __('mobile.contact_us') }}</span>
                </center>
                <br>
                <center>
                    <a  class="contact-item" href="#"  >
                        <button class="text-center fa fa-envelope light-theme-background btn w3-circle"
                        style="width: 30px;height: 30px" ></button>
                        <span v-html="email" ></span>
                    </a>
                    <br>
                    <a  class="contact-item" href="#"  >
                        <button class="text-center fa fa-phone light-theme-background btn w3-circle"
                        style="width: 30px;height: 30px" ></button>
                        <span v-html="phone" ></span>
                    </a>
                </center>
            </div>
        </div>




    </div>




    <script>

        function loadContact() {
            var data = {
                api_token: window.localStorage.getItem("api_token")
            };
            $.get(BASE_URL + "/setting/get?"+$.param(data), function(r){
                var data = r.data;

                page.facebook = data[2]? data[2].value : '#';
                page.youtube = data[3]? data[3].value : '#';
                page.twitter = data[4]? data[4].value : '#';
                page.email = data[6]? data[6].value : 'admin@aqarzelo.com';
                page.phone = data[7]? data[7].value : '011904214';
            });
        }

        var page = new Vue({
            el: '#page',
            data: {
                youtube: '',
                facebook: '',
                twitter: '',
                email: 'admin@aqarzelo.com',
                phone: '011904214'
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
             loadContact();

        });
    </script>
