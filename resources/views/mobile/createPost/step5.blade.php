

            <div class="step step-5" >
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
                                <b class="w3-text-gray text-capitalize" >{{ __('mobile.description') }} * </b> 
                                <div class="post-timeline-content" > 
                                    <br>
                                    <textarea  
                                    v-model="post.description"
                                    placeholder="{{ __('mobile.write_the_description') }}" 
                                    max="255"  
                                    class="form-control w3-round"  ></textarea>
                                    <span v-html="post.description? post.description.length : '0'" ></span> / 255
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div> 
                        <div 
                        class="meta-date w3-display-container" 
                        v-bind:style="post.description? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding" 
                            style="z-index: 3;padding-top: 10px!important" 
                            >
                                <img src="{{ url('/mobile/images/create-post/description.png') }}" 
                                v-bind:class="post.description? 'invert' : ''"
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
                                <b class="w3-text-gray text-capitalize" >{{ __('words.owner_type') }} * </b>
                                <div class="post-timeline-content" >
                                    <br>
                                    <b class="w3-text-gray" >{{ __('mobile.what_is_owner_type') }} ?</b>
                                    <br>

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.owner_type == 'owner'? 'light-theme-background' : ''"
                                    onclick="page.post.owner_type = 'owner';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.owner') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.owner_type == 'developer'? 'light-theme-background' : ''"
                                    onclick="page.post.owner_type = 'developer';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.developer') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.owner_type == 'mediator'? 'light-theme-background' : ''"
                                    onclick="page.post.owner_type = 'mediator';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.mediator') }}</span> 
                                     
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div> 
                        <div 
                        class="meta-date w3-display-container" 
                        v-bind:style="post.owner_type? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding" 
                            style="z-index: 3;padding-top: 10px!important" 
                            >
                                <img src="{{ url('/mobile/images/create-post/owner_type.png') }}" 
                                v-bind:class="post.owner_type? 'invert' : ''"
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
                                <b class="w3-text-gray text-capitalize" >{{ __('words.payment_method') }} * </b>
                                <div class="post-timeline-content" >
                                    <br>
                                    <b class="w3-text-gray" >{{ __('mobile.what_is_payment_method') }} ?</b>
                                    <br>

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.payment_method == 'cash'? 'light-theme-background' : ''"
                                    onclick="page.post.payment_method = 'cash';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.cash') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.payment_method == 'installment'? 'light-theme-background' : ''"
                                    onclick="page.post.payment_method = 'installment';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.installment') }}</span> 
                                      
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div> 
                        <div 
                        class="meta-date w3-display-container" 
                        v-bind:style="post.payment_method? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding" 
                            style="z-index: 3;padding-top: 10px!important" 
                            >
                                <img src="{{ url('/mobile/images/create-post/payment_method.png') }}" 
                                v-bind:class="post.payment_method? 'invert' : ''"
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
                                <b class="w3-text-gray text-capitalize" >{{ __('words.finishing_type') }} * </b>
                                <div class="post-timeline-content" >
                                    <br>

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'extra_super_lux'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'extra_super_lux';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.extra_super_lux') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'super_lux'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'super_lux';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.super_lux') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'lux'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'lux';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.lux') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'semi_finished'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'semi_finished';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.semi_finished') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'core&chel'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'core&chel';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.core&chel') }}</span> 

                                    <span 
                                    class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                    v-bind:class="post.finishing_type == 'without_finished'? 'light-theme-background' : ''"
                                    onclick="page.post.finishing_type = 'without_finished';" 
                                    style="border: 1px solid #00b0bd;margin: 5px" >{{ __('words.without_finished') }}</span> 
                 
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div> 
                        <div 
                        class="meta-date w3-display-container" 
                        v-bind:style="post.finishing_type? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding" 
                            style="z-index: 3;padding-top: 10px!important" 
                            >
                                <img src="{{ url('/mobile/images/create-post/finishing_type.png') }}" 
                                v-bind:class="post.finishing_type? 'invert' : ''"
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
                                <b class="w3-text-gray text-capitalize" >{{ __('mobile.more') }}</b>
                                <div class="post-timeline-content" >
                                    <br>
                                    <table class="w3-table" >
                                        <tr>
                                            <td>
                                                <b>{{ __('words.furnished') }}</b> :
                                            </td>
                                            <td>
                                            <label class="switch">
                                              <input type="checkbox" v-model="post.furnished"  >
                                              <span class="slider round"></span>
                                            </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>{{ __('words.has_parking') }}</b> :
                                            </td>
                                            <td>  
                                            <label class="switch">
                                              <input type="checkbox" v-model="post.has_parking"  >
                                              <span class="slider round"></span>
                                            </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>{{ __('words.has_garden') }}</b> :
                                            </td>
                                            <td>
                                            <label class="switch">
                                              <input type="checkbox" v-model="post.has_garden"  >
                                              <span class="slider round"></span>
                                            </label>
                                            </td>
                                        </tr>
                                    </table> 
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div> 
                        <div 
                        class="meta-date w3-display-container" 
                        v-bind:style="(post.furnished || post.has_parking || post.has_garden)? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding" 
                            style="z-index: 3;padding-top: 10px!important" 
                            >
                                <img src="{{ url('/mobile/images/create-post/more.png') }}" 
                                v-bind:class="(post.furnished || post.has_parking || post.has_garden)? 'invert' : ''"
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
                                onclick="sendPost()"
                                class="text-capitalize btn light-theme-background w3-large w3-block w3-text-gray w3-round-xlarge shadow next-btn" >
                                {{ __('mobile.create_post') }}
                            </button>
                    </center>
                </div>

            </div>