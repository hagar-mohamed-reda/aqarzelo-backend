
<div class="step step-4" >
  @include("mobile.createPost.stepPostTopbar")
  <!-- Vertical Timeline -->
  <section id="conference-timeline"> 

    <div class="conference-center-line"></div>

    <div class="conference-timeline-content">
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.location') }} * </b>
                <div class="post-timeline-content" >
                    <br>
                    <b class="w3-text-gray" >{{ __('mobile.choose_map_location') }}</b>
                    <br>
                    <button 
                        v-bind:style="post.lat && post.lng? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        
                        onclick="$('#mapPicker').show()"
                        class="text-capitalize btn light-theme-background w3-block w3-text-gray w3-round shadow next-btn" >
                        {{ __('mobile.map') }}
                    </button>
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.lat && post.lng? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/title.png') }}" 
                v-bind:class="post.lat && post.lng? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->  
      
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.city') }} * </b>
                <div class="post-timeline-content" >
                    <br>
                    <b class="w3-text-gray" >{{ __('mobile.choose_city') }}</b>
                    <br>
                     <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg shadow" style="height: 50px;padding-left:25px!important;padding-right:25px!important"  v-model="post.city_id" style="margin-bottom: 7px" > 
                        <option value="null" >{{ __("words.city") }}</option>
                        @foreach(App\City::all() as $city)
                        <option value="{{ $city->id }}" >{{ session("direction")=='rtl'? $city->name_ar : $city->name_en }}</option> 
                        @endforeach
                    </select> 
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.city_id? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/city.png') }}" 
                v-bind:class="post.city_id? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->  
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.area') }} * </b>
                <div class="post-timeline-content" >
                    <br>
                    <b class="w3-text-gray" >{{ __('mobile.choose_area') }}</b>
                    <br>
                    <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg shadow" style="height: 50px;padding-left:25px!important;padding-right:25px!important" v-model="post.area_id" style="margin-bottom: 7px" > 
                        <option value="null" >{{ __("words.area") }}</option>
                        @foreach(App\Area::all() as $area)
                        <option value="{{ $area->id }}" v-if="post.city_id == '{{ $area->city_id }}'" >{{ session("direction")=='rtl'? $area->name_ar : $area->name_en }}</option> 
                        @endforeach
                    </select> 
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.area_id? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/area.png') }}" 
                v-bind:class="post.area_id? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->  
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.address') }}</b>
                <div class="post-timeline-content" >
                    <br>
                    <input type="text" 
                    v-model="post.address"
                    max="199"  
                    class="form-control w3-round" placeholder="{{ __('mobile.write_post_address') }}" >
                    <span v-html="post.address? post.address.length : '0'" ></span> / 199
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.address? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/address.png') }}" 
                v-bind:class="post.address? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.build_number') }}</b> 
                <div class="post-timeline-content" >
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.what_is_build_number') }}</b> 
                    <br>
                    <input type="number" 
                    v-model="post.build_number"
                    max="199"  
                    class="form-control w3-round"  > 
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.build_number> 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/build_number.png') }}" 
                v-bind:class="post.build_number>0? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.build_date') }}</b> 
                <div class="post-timeline-content" >
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.what_is_build_date') }}</b> 
                    <br>
                    <input type="year" 
                    v-model="post.build_date"
                    max="199"  
                    class="form-control w3-round"  > 
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.build_date> 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/build_date.png') }}"  
                v-bind:class="post.build_date>0? 'invert' : ''"
                 class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->
      <!-- Article -->
      <div class="timeline-article">
        <div class="content-left-container">
          <div class="content-right">
            <p>
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.floor_number') }}</b> 
                <div class="post-timeline-content" >
                <b class="w3-text-gray text-capitalize" >{{ __('mobile.floor_number') }}</b> 
                    <br>
                    <input type="number" 
                    v-model="post.floor_number"
                    max="199"  
                    class="form-control w3-round"  > 
                </div>
            </p>
          </div>
          <span class="timeline-author">  </span>
        </div> 
        <div 
        class="meta-date w3-display-container" 
        v-bind:style="post.floor_number> 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
            <div class="w3-display-topmiddle w3-padding" 
            style="z-index: 3;padding-top: 10px!important" 
            >
                <img src="{{ url('/mobile/images/create-post/floor_number.png') }}" 
                v-bind:class="post.floor_number>0? 'invert' : ''"
                  class="icon" width="30px"  >
            </div> 
        </div>
      </div>
      <!-- // Article -->
    </div> 
  </section>
  <!-- // Vertical Timeline -->

                <div class="w3-padding" >
                     <center>   
                            <button 
                                onclick="goto(5)"
                                class="text-capitalize btn light-theme-background w3-large w3-block w3-text-gray w3-round-xlarge shadow next-btn" >
                                {{ __('mobile.next') }}
                            </button>
                        </center>
                </div>
            </div>