<div class="post-show w3-white shadow modal row show w3-display-container" style="z-index: 3!important;" v-if="currentPost != null" >

    <div class="w3-display-topleft w3-padding" style="z-index: 9" >
        <br><br><br>
        <button class="w3-button fa fa-close w3-text-white" onclick="app.currentPost = null" ></button>
    </div>


    <div id="main" class="post-images w3-display-container light-theme-background" style=" padding: 0px!important;float:left" v-bind:style="'height:' + height + 'px;'"  >
        <div class="w3-display-topleft" style="width:100%;background-color: rgba(0,0,0,0.6)" v-if="loadding360" v-bind:style="'height:' + height + 'px;'"  >
            <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
            <center>
                <img
                src="{{ url('/website/image/zelo.png') }}"
                width="60px"
                class="w3-xxlarge light-theme-color animated bounce infinite" >

            </center>
        </div>

        <div class="row">

            <div class="mySlides" v-for="(image, index) in currentPost.images"
            v-bind:id="'slide' + index"
            v-bind:style="'background-image: url(' + image.image + ');background-size:cover;'"
            v-if="!image.is_360" >

                <div class="numbertext"><span v-html="index + 1" ></span> / <span v-html="currentPost.images.length + 1" ></span></div>

                <div cl ></div>
                <center style="background-color: rgba(255,255,255,0.5);" >
                    <img class="shadow wm" v-bind:src="image.image" style="" v-bind:height="height + 'px'" > </center>
            </div>

            <div class="viewer" v-for="image in currentPost.images" v-if="image.is_360" v-bind:id="'viewer-' + image.id"   >
                <iframe
                    allowfullscreen
                    v-in:load="loadding360 = false"
                    v-bind:src="public_path + '/panorama?image=' + image.image"
                    v-bind:height="(height - 63) + 'px'"
                    width="98%" ></iframe>
            </div>
            <div class="prev" >
                <a style="padding-top: 20px!important;padding-bottom: 20px!important" class="w3-padding shadow light-theme-background-hover w3-white w3-round" onclick="plusSlides(-1)">&#10094;</a>
            </div>

            <div class="next" >
                <a style="padding-top: 20px!important;padding-bottom: 20px!important" class="w3-padding shadow light-theme-background-hover w3-white w3-round" onclick="plusSlides(1)">&#10095;</a>
            </div>


        </div>
        <br>

        <div style="text-align:center;background-color: rgba(0,0,0,0.75)" class="w3-block text-center w3-display-bottommiddle w3-padding"  >
            <button
            class="dot w3-circle btn w3-btn w3-animate-zoom"
            style="margin: 5px;padding: 0px!important;width:40px;height: 40px;border-radius: 5em"
            v-for="(image, index) in currentPost.images"
            v-bind:data-id="index"
            v-if="!image.is_360"
            onclick="$('.mySlides').hide();$('#slide'+$(this).attr('data-id')).show()">
                <img v-bind:src="image.image" class="wm" style="border-radius: 5em;width: 40px;height: 40px"   >
            </button>

            <button
                class="dot w3-circle btn w3-btn w3-animate-zoom w3-white"
                style="margin: 5px;padding: 0px!important;width:40px;height: 40px;border-radius: 5em"
                onclick="$('.btn_360').toggle();" >
                360
            </button>

            <button
                class="dot w3-circle btn w3-btn  w3-white animated fadeInLeft btn_360"
                v-for="image in currentPost.images"
                v-if="image.is_360"
                v-bind:data-id="image.id"
                style="margin: 5px;padding: 0px!important;width:35px;height: 35px;border-radius: 5em;display: none"
                onclick="$('.viewer').hide();$('.mySlides').hide();$('#viewer-' + $(this).attr('data-id')).show()" >
                360
            </button>
        </div>



    </div>


    <div class="w3-card w3-animate-right w3-white" style="float:left" id="mySidebar" v-bind:style="'height: ' + height + 'px'" >
        <div class="w3-padding w3-display-container" style="height: 100%" >

            <div class="w3-display-topleft w3-padding" style="z-index: 2;top: 120px;left: -41px;" onclick="togglePostSidebar(this)"  >
                <button class="w3-white shadow btn btn-flat" style="border-radius: 0;width: 10px;height: 60px"   >
                    <i class="fa fa-angle-right " ></i>
                </button>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div
            class="w3-round post-header-background w3-text-white w3-display-container"
            style="overflow: hidden;min-height: 140px!important" >

                <div class="w3-display-topright w3-padding w3-large" >
                    <div v-html="drawStar(currentPost.rate)" ></div>
                    <div class="w3-text-light-gray text-right" >
                        <span v-html="currentPost.views"></span> {{ __("words.reviews") }}
                    </div>
                    <br>
                    <div class="text-right" >
                        <span class="fa fa-heart-o w3-text-pink w3-xlarge favourite-btn" v-bind:class="currentPost.favourite? 'fa-heart': 'fa-heart-o'"  ></span>
                    </div>
                </div>

                <div class="w3-xlarge w3-margin-left text-capitalize" style="width: 70%" v-html="locale == 'ar'? currentPost.title_ar : currentPost.title" >

                </div>

                <div class="w3-xlarge w3-margin-left text-capitalize" style="margin-top: 7px;" >
                    <span v-html="(currentPost.price) + ''" class="w3-margin-right" ></span>
                    <span v-html="currentPost.space + 'M'" class="w3-margin-right" ></span>
                </div>
                <br>
            </div>
            <div style="height: 100%" >
                <ul class="nav nav-tabs w3-ul w3-row">
                    <li class="w3-col" ></li>
                    <li role="presentation" class="w3-border-right w3-border-gray w3-col l3 m3 s3 w3-button" onclick="navigateTo('information')"  >
                        {{ __("words.information") }}
                    </li>
                    <li role="presentation" class="w3-border-right w3-border-gray w3-col l3 m3 s3 w3-button" onclick="navigateTo('analysis')"   >
                        {{ __("words.analysis") }}
                    </li>
                    <li role="presentation" class="w3-border-right w3-border-gray w3-col l3 m3 s3 w3-button" onclick="navigateTo('postContactSection')"  >
                        {{ __("words.contact_us") }}
                    </li>
                    <li role="presentation" class="w3-border-gray w3-col l3 m3 s3 w3-button" onclick="navigateTo('postCommentSection')"  >
                        {{ __("words.comment") }}
                    </li>
                </ul>

                <br>

                <ul class="w3-ul nicescroll post-content"  style="height: 60%"  >
                    <li class="w3-row post-icons" id="information" >
                        <a name="information" ></a>
                        <div class="w3-col l4 m4 s4"  v-if="currentPost.bedroom_number > 0">
                            <span class="fa fa-bed dark-theme-color" ></span>
                            <span v-html="currentPost.bedroom_number" ></span>
                            {{ __("words.rooms") }}
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.bathroom_number > 0" >
                            <span class="fa fa-bath dark-theme-color" ></span>
                            <span v-html="currentPost.bathroom_number" ></span>
                            {{ __("words.bathrooms") }}
                        </div>
                        <div class="w3-col l4 m4 s4" >
                            <i class="fa fa-diamond dark-theme-color" ></i>
                            <span v-html="currentPost.finishing_type" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.furnished == 1" style="height: 5px" >
                            <span class="w3-left dark-theme-color" >
                                <i class="fa material-icons">weekend</i>
                            </span>
                            <span class="w3-left " >{{ __("words.furnished") }}</span>
                        </div>
                        <div class="w3-col l4 m4 s4" >
                            <span class="fa fa-male dark-theme-color" ></span>
                            <span v-html="currentPost.owner_type" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.has_parking == 1"   >
                            <span class="w3-left dark-theme-color" >
                                <i class="fa material-icons">nature_people</i>
                            </span>
                            <span class="w3-left " >{{ __("words.has_parking") }}</span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.has_garden == 1"    >
                            <span class="w3-left dark-theme-color" >
                                <i class="fa material-icons">local_florist</i>
                            </span>
                            <span class="w3-left " >{{ __("words.has_garden") }}</span>
                        </div>
                        <div class="w3-col l4 m4 s4" >
                            <span class="fa fa-home dark-theme-color" ></span>
                            <span v-html="currentPost.type" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" >
                            <span class="fa fa-cc-visa dark-theme-color" ></span>
                            <span v-html="currentPost.payment_method" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.floor_number" >
                            <span class="fa fa-building dark-theme-color" ></span>
                            {{ __("words.floor_number") }} <span v-html="currentPost.floor_number" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.build_date" >
                            <span class="fa fa-calendar dark-theme-color" ></span>
                            <span v-html="currentPost.build_date" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.city"  >
                            <span class="fa fa-globe dark-theme-color" ></span>
                            <span v-html="currentPost.city.name_en" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.area"  >
                            <span class="fa fa-map-marker dark-theme-color" ></span>
                            <span v-html="currentPost.area.name_en" ></span>
                        </div>
                        <div class="w3-col l4 m4 s4" v-if="currentPost.category"  >
                            <span class="fa fa-sitemap dark-theme-color" ></span>
                            <span v-html="currentPost.category.name_en" ></span>
                        </div>

                    </li>
                    <li style="text-align: {{ session('direction') == 'ltr'? 'left' : 'right'  }}!important" >
                        <div class="w3-xlarge text-capitalize">{{ __("words.description") }}</div>
                        <div class="w3-large" v-if="currentPost.description" v-html="currentPost.description.replace(/\n/g, '<br>')" ></div>
                    </li>
                    <li>

                        <a name="analysis" ></a>
                        <div   id="analysis">
                            <canvas id="currentPostChart"></canvas>
                        </div>
                    </li>
                    <li>
                        <div class="w3-large" >
                            <a class="fa fa-phone light-theme-background btn w3-text-white w3-btn w3-circle"
                                    style="width: 50px;height: 50px;border-radius: 5em!important"
                                    v-bind:href="'tel:' + currentPost.contact_phone"
                                    onclick="copyToClipboard($('.contact_phone')[0])"></a>
                            <span class="w3-margin-left contact_phone" v-html="currentPost.contact_phone" ></span>
                        </div>
                        <br>
                        <a name="postContactSection" ></a>
                        <center class="w3-large" >
                            {{ __("words.send_message_to_post_company") }}
                        </center>
                        <form action="{{ url('/post/send-message') }}" method="post" class="form" id="postContactSection" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>{{ __("words.name") }}</label>
                                <input type="text" required="" class="form-control" name="name" value="{{ App\Profile::auth()? App\Profile::auth()->name : '' }}"  placeholder='{{ __("words.name") }}'>
                            </div>
                            <div class="form-group">
                                <label>{{ __("words.phone") }}</label>
                                <input type="text" required="" class="form-control" name="phone" value="{{ App\Profile::auth()? App\Profile::auth()->phone : '' }}"  placeholder='{{ __("words.phone") }}'>
                            </div>
                            <div class="form-group">
                                <label>{{ __("words.email") }}</label>
                                <input type="email" required="" class="form-control" name="email" value="{{ App\Profile::auth()? App\Profile::auth()->email : '' }}"  placeholder='{{ __("words.email") }}'>
                            </div>
                            <div class="form-group">
                                <label>{{ __("words.message") }}</label>
                                <textarea class="form-control" required="" name="message"  placeholder='{{ __("words.message") }}'></textarea>
                            </div>
                            <input type="hidden" name="post_id" v-model="currentPost.id" >
                            <div class="form-group">
                                <button class="w3-btn w3-padding w3-large fa fa-send-o w3-round-xxlarge w3-block" style="background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"   ></button>
                            </div>

                        </form>
                    </li>
                    <!-- <li>
                <div id="map" class="w3-block w3-round" style="height: 200px;width: 100%;" ></div>
            </li> -->

                    <li >
                        <center class="w3-large" >
                            {{ __("words.rate_or_comment_the_post") }}
                        </center>
                        <form action="{{ url('/post/send-comment') }}" method="post" class="form comment-form" >
                            {{ csrf_field() }}
                            <a name="postCommentSection" ></a>
                            <center>
                                <img src="{{ url('/website/image/rate.png') }}" width="80%" />
                            </center>
                            <center class="w3-large rate" >

                            </center>
                            <div class="row" >
                                <div class="form-group w3-col l10 m10 s10">
                                    <input type="text" required="" class="form-control input-lg" style="border-radius: 5em!important" name="comment"  placeholder='{{ __("words.comment") }} ..'>

                                </div>
                                <div class="form-group w3-col l2 m2 s2">
                                    <button class="fa fa-send light-theme-background btn w3-text-white w3-btn w3-circle"
                                            style="width: 50px;height: 50px;border-radius: 5em!important" ></button>
                                </div>
                            </div>
                            <input type="hidden" name="post_id" v-model="currentPost.id" >
                            <input type="hidden" name="rate" class="rate-value" >
                        </form>
                        <ul class="w3-ul" id="postCommentSection">
                            <li class="media w3-padding w3-display-container" v-for="review in currentPost.user_review" >
                                <div class="media-left">
                                    <a href="#" class="" >
                                        <img class="media-object w3-circle animated zoomIn" style="margin: 5px" width="40px" height="40px" v-bind:src="review.user.photo_url"  >
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading font" v-html="review.user.name" ></h5>
                                    <span v-html="review.comment" ></span>
                                </div>
                                <div class="w3-padding w3-display-topright" >
                                    <span class="fa fa-star w3-text-orange" ></span>
                                    <span v-html="review.rate" ></span> / 5
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
