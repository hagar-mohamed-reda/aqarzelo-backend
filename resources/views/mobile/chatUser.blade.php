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

        .application-container {
            overflow: hidden!important;
        }

        .small-height-item img {
            width: 10vw!important;
        }

        .chat-user-container {
            overflow: auto;
        }

        .application-header {
            height: 80px;
        }

        .chat-top-bar {
            height: 59px;
        }

        .search-chat-input {
            width: 0px;
            display: none;
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
              <a class="w3-bar-ite  w3-right"  >
                <input
                type="text"
                v-model="search_value"
                onkeyup="search()"
                placeholder="{{ __('mobile.search') }}.."
                class="form-control search-chat-input w3-round-xxlarge"  >
              </a>

              <div class="w3-display-top{{ session('direction')=='rtl'? 'left' : 'right' }} w3-padding" >
                  <b
                  class="fa fa-search w3-large btn"
                  v-bind:class="searchInputShow==-1? 'w3-text-white' : 'w3-text-gray'"
                  onclick="toggleSearchInput();page.searchInputShow*=-1" ></b>
              </div>
            </div>
        </div>

        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            <div class="chat-top-bar w3-padding"  >
                <b class="w3-padding w3-xlarge text-capitalize" >{{ __('mobile.messages') }}</b>
            </div>


            <div class="chat-user-container w3-padding"  v-bind:style="'height: ' + (height - 140) + 'px'" >
                 <ul class="w3-ul" >
                    <li
                    v-for="user in users"
                    v-bind:data-id="user.id"
                    class="chat-user-item"
                    onclick="loadPage('phone/chat?user_to='+$(this).attr('data-id'))" >
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object w3-round-large animated zoomIn " v-bind:src="user.photo_url"  width="40px" height="40px" >
                            </a>
                          </div>
                          <div class="media-body animated fadeInRight " style="padding: 5px" >
                            <h5 class="media-heading"><b v-html="user.name" ></b></h5>
                            <b class="w3-text-gray" v-html="user.last_message" ></b>
                          </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>





    </div>




    <script>
        function toggleSearchInput() {
            if (page.searchInputShow == -1)
                $('.search-chat-input').animate({
                    width: (window.innerWidth - 100),
                    opacity: 1
                }, 'slow');
            else
                $('.search-chat-input').animate({
                    width: 0,
                    opacity: 0
                }, 'slow');
        }

        function search() {
            if (page.search_value.length <= 0) {
                $(".chat-user-item").show();
                return;
            }

            $(".chat-user-item").hide();
            $(".chat-user-item").each(function() {
                var self = this;
                if ($(this).text().indexOf(page.search_value) >= 0) {
                    $(self).show();
                }
            });
        }

        function loadChatUsers() {
            var data = {
                api_token: app.api_token
            };
            $.get("{{ url('/api/chat/user/get') }}?"+$.param(data), function(response) {
                page.users = response.data;
            })
        }

        var page = new Vue({
            el: '#page',
            data: {
                users: [],
                search_value: '',
                searchInputShow: -1,
                api_token: window.localStorage.getItem("api_token"),
                name: window.localStorage.getItem("name"),
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
            loadChatUsers();

        });
    </script>
