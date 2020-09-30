@php

if (session("locale"))
    App()->setLocale(session("locale")); 
else
    App()->setLocale("ar"); 

@endphp 
<!-- css styles  -->
<style type="text/css">
    .splash {
        background-image: url({{ url('/mobile/images/background.png') }});
        background-size: 100% 100%; 
        background-repeat: no-repeat;
        width: 100%;
        overflow: auto;
        }

        .w3-modal-content {
            background-color: transparent!important;
        }

        .logo-container {
            top: 20vw;
            width: 100%;
        }

        .button-container {
            
        }
        
        .go-location-btn {
            background-color: transparent!important;
            border: 2px solid #02A2A7!important;
        }
  
/* form starting stylings ------------------------------- */
.group            { 
  position:relative;  
  background-color: transparent;
  color: #06D9B2!important;
}
input               {
  font-size:18px;
  padding:10px 10px 10px 5px;
  display:block;
  width: 100%;
  border:none;
  border-bottom:1px solid #06D9B2!important;
  background-color: transparent!important;
  color: white!important;
}
input:focus         { outline:none; }

/* LABEL ======================================= */
label                {
  color:#999; 
  font-size:18px;
  font-weight:normal;
  position:absolute;
  pointer-events:none;
  left:5px;
  top:10px;
  color: white!important;
  transition:0.2s ease all; 
  -moz-transition:0.2s ease all; 
  -webkit-transition:0.2s ease all;
}

/* active state */
input:focus ~ label, input:valid ~ label        {
  top:-20px;
  font-size:14px;
  color:#5264AE;
}

/* BOTTOM BARS ================================= */
.bar    { 
    position:relative; display:block;

  width: 100%;
  color: #06D9B2!important;
     }
.bar:before, .bar:after     {
  content:'';
  height:2px; 
  width:0;
  bottom:1px;  
  position:absolute;
  background: #06D9B2!important;
  transition:0.2s ease all; 
  -moz-transition:0.2s ease all; 
  -webkit-transition:0.2s ease all;
}
.bar:before {
  left:50%;
}
.bar:after {
  right:50%; 
}

/* active state */
input:focus ~ .bar:before, input:focus ~ .bar:after {
  width:50%;
}

/* HIGHLIGHTER ================================== */
.highlight {
  position:absolute;
  height:60%; 
  width:100px; 
  top:25%; 
  left:0;
  pointer-events:none;
  color: #06D9B2!important;
  opacity:0.5;
}

/* active state */
input:focus ~ .highlight {
  -webkit-animation:inputHighlighter 0.3s ease;
  -moz-animation:inputHighlighter 0.3s ease;
  animation:inputHighlighter 0.3s ease;
}

/* ANIMATIONS ================ */
@-webkit-keyframes inputHighlighter {
    from { background:#5264AE; }
  to    { width:0; background:transparent; }
}
@-moz-keyframes inputHighlighter {
    from { background:#5264AE; }
  to    { width:0; background:transparent; }
}
@keyframes inputHighlighter {
    from { background:#5264AE; }
  to    { width:0; background:transparent; }
}
    </style>

    <!-- html content -->
    <div class="splash" id="page" v-bind:style="'height: ' + height + 'px'"
    style="background-image: url({{ url('/mobile/images/background.png') }})" >
        <div class="w3-modal-content" style="padding-top: 15vh" >
            <div class="w3-display-topleft w3-padding">
              <br><br>
                <span class="fa fa-angle-left w3-text-white w3-large" onclick="back()" ></span>
            </div>

            <div class="logo-container text-center" >
                <center>
                    <br>
                    <b class="w3-xlarge text-capitalize w3-text-white" >{{ __('mobile.register') }}</b>
                </center>
            </div>


            <div class="  button-container w3-block w3-padding text-capitalize" >
                 
                <form class="form" action="{{ url('/api/user/register') }}" method="post" >
                  <div class="w3-padding" >
                      <div class="group">      
                        <input type="text" required v-model="form.name" name="name" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('mobile.username') }}</label>
                      </div> 
                      <br> 
                      <div class="group">      
                        <input type="text" required v-model="form.phone" name="phone" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('words.phone') }}</label>
                      </div>
                      <br> 
                      <div class="group">      
                        <input type="email" required v-model="form.email" name="email" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('words.email') }}</label>
                      </div>
                      <br> 
                      <div class="group">      
                        <input type="password" required v-model="form.password" name="password" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('words.password') }}</label>
                      </div>
                      <br> 
                      <div class="group">      
                        <input type="password" required v-model="form.confirm_password" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('mobile.confirm_password') }}</label>
                      </div> 


                  </div>
                  <br>
              
                  <div class="w3-padding" >
                      <button  
                          class="text-capitalize btn light-theme-background w3-block w3-large w3-text-white w3-round-xlarge shadow current-location-btn" >
                          {{ __('mobile.register') }}
                      </button> 
                  </div>

                </form>
 
            </div>

        </div>


    </div>


    <!-- javascript --> 
    <script>  

        var page = new Vue({
            el: '#page',
            data: {
                form: {
                    name: null,
                    phone: null,
                    email: null, 
                    confirm_password: null,
                    password: null,
                }, 
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
                    window.localStorage.setItem("api_token", r.data.api_token);
                    successToast(r.message_en);
                } else {
                    errorToast(r.message_en);
            }
          });
        });
    </script>