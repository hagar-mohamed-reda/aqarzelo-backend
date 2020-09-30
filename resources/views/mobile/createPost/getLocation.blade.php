
    <div class="map w3-animate-top" id="mapPicker" v-bind:style="'height: ' + height + 'px'" >
         
        <ol class="breadcrumb  w3-display-topleft w3-block light-theme-background shadow">
            <li><a href="#" class="text-uppercase w3-xlarge w3-text-white fa fa-angle-left" ></a></li>
            
            <li><a href="#" class="text-uppercase w3-large w3-text-white" >{{ __('mobile.choose_location') }}</a></li> 
                  
        </ol> 

        <div id="map" class="w3-block" v-bind:style="'height: ' + height + 'px'" ></div>

        <div class="w3-display-bottommiddle post-button-container w3-block w3-padding text-capitalize" > 
            <div style="direction: rtl!important" >
                <button 
                    onclick="getCurrentLocation()"
                    style="margin-right: 11px"
                    class="animated fadeInRight text-capitalize btn light-theme-background w3-xlarge w3-text-white shadow post-current-location-btn" >
                    <span class="fa fa-arrows" ></span>
                </button> 
            </div>
            <br>
            <br>

            <div class="w3-padding" >
                <button 
                    onclick="done()"
                    class="animated fadeInUp text-capitalize btn light-theme-background w3-block w3-xlarge w3-text-white w3-round-xlarge shadow post-done-location-btn" >
                    {{ __('mobile.done') }}
                </button> 
            </div>
        </div>
    </div>
