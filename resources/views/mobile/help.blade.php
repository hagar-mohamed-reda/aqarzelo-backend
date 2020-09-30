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
              <a href="#" class="w3-bar-item btn" onclick="back()" >
                  <span class="fa fa-angle-left w3-text-white w3-xlarge" ></span>
              </a>   
              <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.help') }}</span>
              </a>   
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'height: ' + (height - 80) + 'px'" >
            <br><br><br><br>
            <center>
                <img src="{{ url('/mobile/images/help-image.png') }}"  width="90%" >
            </center>
            <br>
            <br>
            <div class="w3-padding text-center" style="width: 90%;margin: auto" >
                <b v-html="help" class="w3-large" ></b>
            </div>
        </div>
        
        
        

    </div>

 

    
    <script> 

        function loadHelp() {
            var data = {
                api_token: window.localStorage.getItem("api_token")
            };
            $.get(BASE_URL + "/setting/get?"+$.param(data), function(r){
                var data = r.data;
                page.help = data[1]? data[1].value : '';
            });
        }

        var page = new Vue({
            el: '#page',
            data: { 
                help: ''
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
             loadHelp();
              
        });
    </script>