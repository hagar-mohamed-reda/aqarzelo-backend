@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<style type="text/css">
    .home {
        width: 100%;
        background-size: 100%;
        background-position: top;
        background: white;
        overflow: auto;
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

        .application-header {
            background-size: cover;
        }

        .application-container {
            overflow: hidden;
        }

        .profile-image-container {
            z-index: 10;
            bottom: -50%;
        }

        .profile-image {
            padding: 5px;
            background-color: white;
        }

        .profile-tab-button-posts {
            border-top-left-radius: 5em!important;
            border-bottom-left-radius: 5em!important;
        }
        .profile-tab-button-details {
            border-top-right-radius: 5em!important;
            border-bottom-right-radius: 5em!important;
        }

        .profile-tab-button-edit {
            border-radius: 5em!important;
            margin-left: 5px!important;
            margin-right: 5px!important;
        }

        .tab-item {
            display: none;
        }

        .my-posts {
            display: block;
        }


        .posts-item {
            border-radius: 6px;
            overflow: hidden;
            background-color: white;
            margin-bottom: 5px;
        }

        .posts-li {
            margin: 0px!important;
            padding: 5px!important;
            border: 0px!important;
        }

        .information button {
            width: 50px;
            height: 50px;
        }

        .btn-group button {
            float: none!important;
            margin: 0px!important;
        }
    </style>

    <!-- html content -->
    <div class="home " id="page" v-bind:style="'height: ' + height + 'px;'+'background-image: url(' + user.cover_url + ')'"  >
        <div class="application-header w3-display-container" style="height: 300px;background: transparent;background-image: none"  >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a style='box-shadow: inset 0 3px 5px rgb(0 0 0 / 13%);' class="w3-bar-item btn" onclick="back()" >
                  <span class="fa fa-angle-left w3-text-white w3-xlarge shadow" ></span>
              </a>
            </div>
            <center class="w3-display-bottommiddle profile-image-container w3-block" >
                <img v-bind:src="photo" width="130px" class="w3-circle profile-image" onclick="viewImage(this)" >
                <br>
                <b class="w3-large" v-html="user.name" ></b>
                <br><br><br>
                <div class="w3-center" >
                    <center class="btn-group w3-large w3-block" role="group" aria-label="...">
                      <button
                      type="button"
                      onclick="$('.tab-item').hide();$('.my-posts').slideDown(500)"
                      class="btn btn-default shadow profile-tab-button-posts">{{ __('mobile.posts') }}</button>

                      <button
                      type="button"
                      onclick="$('.tab-item').hide();$('.details').slideDown(500)"
                      class="btn btn-default shadow profile-tab-button-details">{{ __('mobile.details') }}</button>

                      <button
                      type="button"
                      onclick="loadPage('phone/profile/edit')"
                      class="btn btn-default shadow profile-tab-button-edit">
                          <img src="{{ url('/mobile/images/edit_profile_icon.png') }}" width="20px" >
                      </button>
                    </center>
                </div>
            </center>
        </div>
        <div class="application-container w3-display-container"  v-bind:style="'min-height: ' + (height - 300) + 'px'" >
            <br><br><br><br><br><br><br><br>
            <div class="tab-item my-posts w3-padding" >

                <ul class="w3-ul w3-row">
                    <li class="w3-col l12 m12 s12 w3-padding" v-if="loading" >
                        <center>
                            <b class="fa fa-spinner fa-spin" class="w3-large" ></b>
                        </center>
                    </li>

                    <li v-for="post in posts" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 animated fadeInUp posts-li"   >
                        <div class=" shadow light-theme-background-hover posts-item">
                            <img v-if="post"
                            height="100px"
                            width="100%"
                            onclick="loadPage('phone/post/show?post_id='+$(this).attr('data-id'))"
                            v-bind:data-id="post.id"
                            v-bind:src="post.images[0]? post.images[0].image: '{{ url('/mobile/images/image.png') }}'" >
                            <div class="w3-padding" >
                                <div v-html="post.title.substring(0,15)+'..'" ></div>
                                <div v-html="post.space + ' M'" class="w3-text-gray w3-tiny" ></div>
                                <div v-html="format(post.price)" class="w3-text-gray w3-tiny" ></div>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>

            <div class="tab-item details w3-padding" >
                <ul class="w3-ul information" >
                    <li>
                        <button class="w3-circle w3-button dark-theme-background w3-text-white w3-large" >
                            <b class="fa fa-envelope" ></b>
                        </button>
                        <b class="w3-padding w3-large" v-html="user.email" ></b>
                    </li>
                    <li>
                        <button class="w3-circle w3-button dark-theme-background w3-text-white w3-large" >
                            <b class="fa fa-phone" ></b>
                        </button>
                        <b class="w3-padding w3-large" v-html="user.phone" ></b>
                    </li>
                    <li>
                        <button class="w3-circle w3-button dark-theme-background w3-text-white w3-large" >
                            <b class="fa fa-user" ></b>
                        </button>
                        <b class="w3-padding w3-large" v-html="user.name" ></b>
                    </li>
                    <li>
                        <button class="w3-circle w3-button dark-theme-background w3-text-white w3-large" >
                            <b class="fa fa-map-marker" ></b>
                        </button>
                        <b class="w3-padding w3-large" v-html="user.address" ></b>
                    </li>

                    <li  v-if="user.company_id > 1" >
                        <button class="w3-circle w3-button dark-theme-background w3-text-white w3-large" >
                            <b class="fa fa-globe" ></b>
                        </button>
                        <b class="w3-padding w3-large"  >
                            <a v-bind:href="'{{ url('/personal') }}/' + user.name" target="_blank" >{{ __('mobile.your_website') }}</a>
                        </b>
                    </li>
                </ul>
            </div>
        </div>




    </div>




    <script>

        function loadPosts() {
            var data = {
                api_token: page.api_token
            };
            $.get(BASE_URL + "/user/post/get?"+$.param(data), function(r){
                page.posts = r.data;
                page.loading = false;
            });
        }

        var page = new Vue({
            el: '#page',
            data: {
                posts: [],
                api_token: window.localStorage.getItem("api_token"),
                user: JSON.parse(window.localStorage.getItem("user")),
                name: window.localStorage.getItem("name"),
                photo: window.localStorage.getItem("photo"),
                loading: true
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
             loadPosts();

        });
    </script>
