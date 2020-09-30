<div class="w3-display-bottommiddle w3-block w3-white shadow w3-round recommend-background recommended-post animated" style="z-index: 1!important;height: 300px;width: 70%"  >
    
    <div class="w3-display-topleft w3-padding" style="z-index: 2;top: -38px;left: 30px;" onclick="toggleRecommended()"  >
        <button 
            class="w3-white btn btn-flat animated delay-2s fadeInUp text-capitalize" 
            style="height: 30px;border-radius: 0px!important" 
            id="recommendToggleBtn" >
            <span class="icon" style="margin-right: 4px" >
                <i class="fa fa-angle-up" ></i></span> 
            <b class="w3-text-orange"  >{{ __("words.recommended_posts") }}</b>  
        </button>
    </div>

    <div class="w3-display-container w3-padding" >

        <div class="w3-display-topleft btn" style="top: 40%;padding: 5px" onclick="recommendOwl.trigger('prev.owl');" >
            <span class="fa fa-angle-left light-theme-color w3-xxlarge" ></span>
        </div>
        
        <div class="w3-display-topright btn" style="top: 40%;padding: 5px" onclick="recommendOwl.trigger('next.owl');" >
            <span class="fa fa-angle-right light-theme-color w3-xxlarge" ></span>
        </div>
        
        <div class="owl-carousel owl-theme w3-padding" style="direction: ltr!important" > 
            <div class="item transparent" v-for="post in recommends" style="height: 260px!important;padding-top: 20px"  >
                <div 
                    class="w3-white shadow recommend-item"  
                    v-bind:data-id="post.id"
                    onclick="loadPost($(this).attr('data-id'))" >
                    <img 
                        style="border-top-left-radius: 5px;border-top-right-radius: 5px;height: 120px"
                        v-if="post.images[0]" 
                        v-bind:src="post.images[0].image" > 
                    <div class="w3-padding" >
                        <div class="w3-large" v-html="locale == 'ar'? post.title_ar : post.title" style="width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;direction: {{ session('direction') }}" ></div>
                        <span v-html="post.space" ></span> M 
                        <br>
                        <span v-html="drawStar(5)" class="w3-tiny" ></span> 
                        <div class="w3-right w3-tiny" v-html="post.price + ''" ></div>
                    </div>
                </div>
            </div> 
        </div>

    </div>
</div>