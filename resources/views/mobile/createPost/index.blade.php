@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp

<!-- css styles  -->
@include("mobile.createPost.styles")
@include("mobile.createPost.loading")

    <!-- html content -->
    <div class="home dark-theme-background create-post-modal" id="page" v-bind:style="'height: ' + height + 'px'" >
        <div class="application-header" >
            <br>
            <div class="w3-bar w3-padding w3-display-container">
              <a
              href="#"
              v-bind:data-step="step>1? (step-1) : '1'"
              onclick="page.step == 1? back() : goto($(this).attr('data-step'))"
              class="w3-bar-item btn"   >
                  <span class="fa fa-angle-{{ session("direction")=='rtl'? 'right' : 'left' }} w3-text-white w3-xlarge" ></span>
              </a>
              <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                  <span class="w3-text-white w3-xlarge" >{{ __('mobile.create_post') }}</span>
              </a>
            </div>
        </div>
        <div class="application-container w3-display-container" v-bind:style="'min-height: ' + (height - 65) + 'px'" >
          <!-- step 1 => upload master image -->
          @include("mobile.createPost.step1")

          <!-- step 2 => upload another images -->
          @include("mobile.createPost.step2")

          <!-- step 3 => fill step1 from post data -->
          @include("mobile.createPost.step3")

          <!-- step 3 => fill step2 from post data -->
          @include("mobile.createPost.step4")

          <!-- step 3 => fill step3 from post data -->
          @include("mobile.createPost.step5")

          <!-- get location from map => map picker -->
          @include("mobile.createPost.getLocation")

          </div>



        </div>




    </div>

 @include("mobile.createPost.scripts")
