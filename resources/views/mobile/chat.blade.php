@php
    $userToId = request()->user_to;
    $userTo = App\User::find(request()->user_to);

@endphp
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

        .chat-top-bar {
            height: 59px;
            border-bottom: 1px solid lightgray;
        }

        .chat-container {
            overflow: auto;
        }

        .w3-ul li {
            border: none!important; 
            margin-bottom: 5px;
        }

        .chat-avatar-from-container {
            top: -12px;
            left: -7px;
        }

        .chat-bottom-bar {

        }

        .chat-btn {
            width: 40px;
            height: 40px;
        }
        
        
    </style>

    <!-- html content -->
    <div class="home dark-theme-background" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a href="#" class="w3-bar-item btn" onclick="back()" >
                  <span class="fa fa-angle-{{ session('direction')=='rtl'? 'right' : 'left' }} w3-text-white w3-xlarge" ></span>
              </a>   
              <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.chat') }}</span>
              </a>   
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            <div class="chat-top-bar w3-padding"  >
                <img src="{{ $userTo->photo_url }}" class="w3-round-large" width="35px" height="35px" >
                <b class="w3-padding w3-large" >{{ $userTo->name }}</b>
            </div>

            <div class="chat-container w3-padding"  v-bind:style="'height: ' + (height - 165) + 'px'" >
                <br> 
                <ul class="w3-ul" > 

                    <li v-for="chat in chats" class="w3-display-container w3-row" >

                        <div  
                        class="animted" 
                        v-bind:class="(chat.user_from == user.id)? 'w3-right fadeInRight' : 'w3-left fadeInLeft' " style="width: 60%" >
                            <div 
                                class="w3-round-large w3-text-gray w3-padding" 
                                style="overflow: hidden;word-break: break-word;" 
                                v-bind:class="(chat.user_from == user.id)? 'light-theme-background' : 'w3-light-gray' " >
                                    <b v-html="chat.message" ></b>

                                    <div v-if="chat.user_from != user.id" class="w3-display-topleft w3-padding chat-avatar-from-container" >
                                        <img v-bind:src="chat.from.photo_url" class="w3-round-large chat-avatar-from-img" width="20px" height="20px"  >
                                    </div>
                                </div>
                                <span class="w3-text-gray w3-tiny" v-html="chat.created_at"  ></span>
                        </div>

                    </li>

                    <li>
                        <a id="bottom-chat" ></a>
                    </li>

                </ul>
            </div>

            <div class="chat-bottom-bar w3-display-bottomleft w3-block w3-padding " >
                <div class="w3-display-container" >
                    <input 
                        type="text" 
                        autocomplete="off" 
                        id="chat-input"
                        v-model="message"
                        v-on:keyup.enter="sendMessage()"
                        class="form-control w3-round-xxlarge w3-light-gray input-lg" 
                        placeholder="{{ __('mobile.send_message') }}" >

                        <div class="w3-display-topright chat-btn-container" style="padding: 3px;" >
                            <button  
                            onclick="sendMessage()" 
                            class="animated bounceIn fa fa-send btn w3-circle light-theme-background w3-text-white chat-btn "   ></button>
                        </div>
                </div>
            </div>
        </div>
        
        
        

    </div>

 

    
    <script> 
        function playChatSound() {
            new Audio("{{ url('/mobile/sound/ping.mp3') }}").play();
        }

        function loadChats() {
            var data = {
                api_token: app.api_token,
                user_to: '{{ $userTo->id }}'
            };

            $.get("{{ url('/api/chat/get') }}?"+$.param(data), function(r){
                page.chats = r.data;
                //
                var $target = $('.chat-container'); 
                $target.animate({scrollTop: page.chats.length * 200}, 1500);
            });
        }


        function sendMessage() { 
            var chatBtn = $(".chat-btn-container").html(); 
            $(".chat-btn-container").html(''); 

            var data = {
                api_token: app.api_token,
                message: page.message,
                user_to: '{{ $userTo->id }}'
            };

            page.message = '';
            $.post("{{ url('/api/chat/send') }}?", $.param(data), function(r){ 
                playChatSound();
                loadChats(); 
                //
            });
                $(".chat-btn-container").html(chatBtn);
        }

        var page = new Vue({
            el: '#page',
            data: { 
                message: '',
                user: JSON.parse(window.localStorage.getItem("user")),
                api_token: window.localStorage.getItem("api_token"),
                name: window.localStorage.getItem("name"),
                photo: window.localStorage.getItem("photo"),
                chats: []
            },
            methods: {
                sendMessage: function(){
                    sendMessage();
                },
            },
            computed: {
                height: function () {
                    return window.innerHeight;
                }
            }
        }); 
        
        $(document).ready(function(){  
             loadChats(); 
        });
    </script>