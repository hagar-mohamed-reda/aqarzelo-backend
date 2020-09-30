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
        
        
    </style>

    <!-- html content -->
    <div class="home dark-theme-background" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a href="#" class="w3-bar-item btn w3-{{ session("direction")=='rtl'? 'right' : 'left' }}" onclick="back()" >
                  <span class="fa fa-angle-{{ session("direction")=='rtl'? 'right' : 'left' }} w3-text-white w3-xlarge" ></span>
              </a>   
              <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.setting') }}</span>
              </a>   
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            
            <ul class="w3-ul" style="padding: 10px" >

                <li class="btn w3-block" onclick="loadPage('phone/login')" v-if='!api_token' >
                    <div class="w3-bar w3-block register-item" >
                        <a class="w3-bar-item w3-text-gray" href="#">
                            <img src="{{ url('/mobile/images/avatar.png') }}" width="55vw" >
                            <b class="text-uppercase w3-large w3-padding" >{{ __('mobile.log_in') }}</b>
                        </a>

                        <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                            <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                        </a>
                    </div>
                </li>

                <li class="btn w3-block" onclick="loadPage('phone/profile')" v-if='api_token' >
                    <div class="w3-bar w3-block register-item" >
                        <a class="w3-bar-item w3-text-gray" href="#">
                            <img v-bind:src='photo' width="55vw" class="w3-circle" >
                            <b class="text-uppercase w3-large w3-padding" >
                                <span v-html='name.substring(0, 10) + ".."' ></span>
                            </b>
                        </a>

                        <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                            <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                        </a>
                    </div>
                </li>
                <!-- chat  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('phone/chat/users')" style="margin-bottom: 20px!important" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/chat.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.chat') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>

                <!-- edit profile  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('phone/profile/edit')" v-if='api_token' >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/edit_profile.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.edit_profile') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>
                <!-- change password  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('phone/change-password')" style="margin-bottom: 20px!important" v-if='api_token' >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/change_password.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.change_password') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>

                <!-- notification  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('/phone/notification')" style="margin-bottom: 20px!important" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/notification.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.notification') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>

                <!-- language  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="showLanguageDailog()" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/lang.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.language') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>
 
                <!-- help  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('/phone/help')" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/help.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.help') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>

                <!-- contact  -->
                <li class="w3-bar btn w3-block small-height-item" onclick="loadPage('/phone/contact')" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/contact.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.contact') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>

                <!-- logout  -->
                <li class="w3-bar btn w3-block small-height-item" v-if="api_token" onclick="logout()" >
                    <a class="w3-bar-item w3-text-gray" href="#">
                        <img src="{{ url('/mobile/images/logout.png') }}" style="margin: 5px" width="30vw" >
                        <b class="text-capitalize w3-  w3-padding" >{{ __('mobile.logout') }}</b>
                    </a>

                    <a class="w3-bar-item w3-{{ session("direction")=='rtl'? 'left' : 'right' }}" href="#">
                        <span class="fa fa-angle-{{ session("direction")=='rtl'? 'left' : 'right' }} w3-xlarge w3-text-gray w3-padding" ></span>
                    </a>
                </li>
            </ul>
        </div>
        
        
        

    </div>

 

    
    <script> 
        function showLanguageDailog() {
            Swal.fire({
              title: '{{ __("mobile.language") }}', 
              //icon: '',
              showCancelButton: true,
              confirmButtonColor: '#02A2A7',
              cancelButtonColor: '#02A2A7',
              confirmButtonText: 'English',
              cancelButtonText: 'عربى',
            }).then((result) => {
                console.log(result);
              if (result.value) {
                window.location = "?lang=en";
              } 
              if (result.dismiss == 'cancel') {
                window.location = "?lang=ar";
              }
            })
        }
        
        function logout() {
            Swal.fire({
              title: '{{ __("mobile.warning") }}?',
              text: "{{ __('mobile.are_you_sure') }} ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '{{ __("mobile.ok") }}',
              cancelButtonText: '{{ __("mobile.cancel") }}',
            }).then((result) => {
              if (result.value) {
                localStorage.clear();
                loadPage('phone/home');
              }
            })
            
        }

        var page = new Vue({
            el: '#page',
            data: { 
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
             
              
        });
    </script>