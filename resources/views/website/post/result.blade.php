<ul class="w3-ul result" style="display: none;direction: ltr!important;"  >
    <li>
        <span class="fa fa-angle-left w3-xlarge w3-button light-theme-color" onclick='$(".result").slideUp(500);$(".filters").slideDown(500);' ></span>
        <span v-html="result_message" class="w3-margin-left"  ></span>
    </li>
    <li class="post-loading-state" >
        <center>
            <br>
            <span class="fa fa-search light-theme-color w3-xlarge animated bounceIn infinite slow" ></span>
            <br>
            <br>
            <span>{{ __("words.please_wait") }}</span>
        </center>
    </li>
    <li class="post-no-found-state" style="display:none" >
        <center>
            <br>
            <span class="fa fa-search light-theme-color w3-xlarge animated bounceIn infinite slow" ></span>
            <br>
            <br>
            <span>{{ __("words.no_result_found") }}</span>
        </center>
    </li>
    <li v-for="post in posts" class="w3-hover-light-grey"
        style="cursor: pointer;padding: 0px!important;padding-bottom: 5px!important;margin-bottom: 6px;"
        v-on:click="showPost(post)"   >
        <div class="media animate zoomIn shadow w3-round-large w3-display-container" style="padding: 0px" >
            <div class="media-left" style="padding: 0px!important" >
                <a href="#" v-if="post.images.length > 0" >
                    <img class="media-object w3-round-large" v-bind:src="post.images[0].image" width="120px" height="90px"  alt="...">
                </a>
            </div>
            <div class="media-body" style="overflow: hidden;width: auto!important" >
                <div class="media-heading"  >
                    <div
                    class="w3-large"
                    v-html="locale == 'ar'? post.title_ar : post.title"
                    data-toggle="tooltip" data-placement="top" v-bind:title="post.title"
                    style="width: 110px;padding: 5px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" >

                    </div>
                    <div style="padding: 5px;" class="w3-display-topright" >
                        <b><span v-html="post.price" ></span></b>
                        <br>
                        <span v-html="drawStar(post.rate)" class="w3-tiny" ></span>
                         (<span v-html="post.views" ></span>)
                    </div>
                </div>
                <div class="w3-row " style="width: 230px"  >
                    <div class="w3-col l4 m4 s4"   >
                     <span v-html="post.space + ' m'" ></span>
                    </div>
                    <div class="w3-col l4 m4 s4" v-if="post.bedroom_number > 0" >
                        <span v-html="post.bedroom_number" ></span>  <span class="fa fa-bed" ></span>
                    </div>
                    <div class="w3-col l4 m4 s4" v-if="post.bathroom_number > 0" >
                     <span v-html="post.bathroom_number" ></span>  <span class="fa fa-bath" ></span>
                    </div>
                </div>

            </div>
        </div>
    </li>
</ul>

