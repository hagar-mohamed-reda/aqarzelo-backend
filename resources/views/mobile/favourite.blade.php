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

        .favourite-container {
            overflow: auto;
            padding: 10px;
        }

        .favourite-item {
            border-radius: 6px;
            overflow: hidden;
            background-color: white;
            margin-bottom: 5px; 
        }

        .favourite-li {
            margin: 0px!important;
            padding: 5px!important;
            border: 0px!important;

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
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.favourites') }}</span>
              </a>   
            </div>
        </div>
        <div class="w3-display-container favourite-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            <ul class="w3-ul w3-row">
                <li 
                v-for="post in posts"  
                class="w3-col l6 m6 s6 animated fadeInUp favourite-li"   >
                    <div 
                    onclick="loadPage('phone/post/show?post_id='+$(this).attr('data-id'))" 
                    v-bind:data-id="post.post.id"
                    class=" shadow light-theme-background-hover favourite-item">
                        <img v-if="post.post.images[0]" 
                        height="100px" 
                        width="100%" 
                        v-bind:src="post.post.images[0].image" >
                        <div class="w3-padding" >
                            <div v-html="post.post.title.substring(0, 15) + '..'" ></div>
                            <div v-html="post.post.space + ' M'" class="w3-text-gray w3-tiny" ></div> 
                            <div v-html="format(post.post.price)" class="w3-text-gray w3-tiny" ></div>
                        </div>
                    </div>
                </li>

            </ul>
            
            <!-- application bottom nav -->
            @include("mobile.bottomNav")
        </div>
        
        
        

    </div>

 

    
    <script>  

        function loadPosts() {
            var data = {
                api_token: window.localStorage.getItem("api_token")
            };
            $.get(BASE_URL + "/user/favourite/get?"+$.param(data), function(r){
                page.posts = r.data;
                page.loading = false;
            });
        }

        var page = new Vue({
            el: '#page',
            data: { 
                posts: [],
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
            //
            $(".favourite-bottom-nav-item").addClass("light-theme-color");
        });
    </script>