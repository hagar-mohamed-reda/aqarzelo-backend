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
        overflow: auto!important;
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
        }

        .small-height-item img {
            width: 10vw!important;
        }

        .profile-items li {
            border: none!important;
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
              <a class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.edit_profile') }}</span>
              </a>
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'min-height: ' + (height - 80) + 'px'" >

            <form class="form" method="post" action="{{ url('api/user/profile/update') }}" enctype="multipart/form-data" >
                <input type="hidden" name="api_token" v-model="user.api_token" >
                <ul class="w3-ul profile-items"   >
                    <li>
                        <b>{{ __('mobile.profile_image') }}</b><br>
                        <br>
                        <div class="w3-display-container" >
                            <img  v-bind:src="user.photo_url" width="60px" class="w3-circle" onclick="viewImage(this)" >

                            <b class="light-theme-color w3-{{ session("locale")=='ar'? 'left' : 'right' }} text-capitalize" onclick="$('.image-input').click()" >{{ __('mobile.edit') }}</b>
                            <input type="file"  class="hidden image-input" name="photo">
                        </div>
                    </li>
                    <li class="w3-display-container" >
                        <b>{{ __('mobile.profile_cover') }}</b><br>
                        <b class="light-theme-color w3-{{ session("locale")=='ar'? 'left' : 'right' }} text-capitalize" onclick="$('.cover-input').click()" >{{ __('mobile.edit') }}</b>
                        <br>
                        <div class="w3-display-container" >
                            <img  v-bind:src="user.cover_url" width="100%" class="w3-round" onclick="viewImage(this)" >

                            <input type="file"  class="hidden cover-input" name="cover">
                        </div>
                    </li>
                    <li>
                        <div >
                            <b for="email">{{ __('mobile.email') }}</b>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                v-model="user.email"
                                placeholder="{{ __('mobile.email') }}">
                            </div>
                    </li>
                    <li>
                        <div >
                            <b for="phone">{{ __('mobile.phone') }}</b>
                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                v-model="user.phone"
                                placeholder="{{ __('mobile.phone') }}">
                            </div>
                    </li>
                    <li>
                        <div >
                            <b for="name">{{ __('mobile.name') }}</b>
                            <input
                                type="name"
                                class="form-control"
                                id="name"
                                name="name"
                                v-model="user.name"
                                placeholder="{{ __('mobile.name') }}">
                            </div>
                    </li>
                    <li>
                        <div >
                            <b for="address">{{ __('mobile.address') }}</b>
                            <input
                                type="address"
                                class="form-control"
                                id="address"
                                name="address"
                                v-model="user.address"
                                placeholder="{{ __('mobile.address') }}">
                            </div>
                    </li>
                    <li>
                        <div >
                            <b for="facebook">{{ __('mobile.facebook') }}</b>
                            <input
                                type="facebook"
                                class="form-control"
                                id="facebook"
                                name="facebook"
                                v-model="user.facebook"
                                placeholder="{{ __('mobile.facebook') }}">
                            </div>
                    </li>
                    <li>
                        <button
                            class="text-capitalize btn light-theme-background w3-block w3-large w3-text-white w3-round-xlarge shadow current-location-btn" >
                            {{ __('mobile.save') }}
                        </button>
                    </li>

                </ul>
            </form>
        </div>




    </div>




    <script>
        var page = new Vue({
            el: '#page',
            data: {
                api_token: window.localStorage.getItem("api_token"),
                name: window.localStorage.getItem("name"),
                user: JSON.parse(window.localStorage.getItem("user")),
                photo: window.localStorage.getItem("photo")
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
             formAjax(false, function(r){
                if (r.status == 1) {
                    console.log(r.data);
                    window.localStorage.setItem("api_token", r.data.api_token);
                    window.localStorage.setItem("name", r.data.name);
                    window.localStorage.setItem("email", r.data.email);
                    window.localStorage.setItem("photo", r.data.photo_url);
                    window.localStorage.setItem("email", r.data.email);
                    window.localStorage.setItem("phone", r.data.phone);

                    window.localStorage.setItem("user", JSON.stringify(r.data));


                } else {

                }
             });

        });
    </script>
