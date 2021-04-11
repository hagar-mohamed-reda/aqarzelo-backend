
            <div class="step step-3" >
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
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.write_post_title_en') }} * </b>
                              <div class="post-timeline-content" >
                                  <br>
                                  <input type="text"
                                  v-model="post.title"
                                  max="50"
                                  class="form-control w3-round post-title-input" placeholder="{{ __('mobile.write_post_title_en') }}" >
                                  <span v-html="post.title? post.title.length : '0'" ></span> / 50
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div
                      class="meta-date w3-display-container"
                      v-bind:style="post.title? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding"
                          style="z-index: 3;padding-top: 10px!important"
                          >
                              <img src="{{ url('/mobile/images/create-post/title.png') }}"
                              v-bind:class="post.title? 'invert' : ''"
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
                                <b class="w3-text-gray text-capitalize" >{{ __('mobile.write_post_title_ar') }} * </b>
                                <div class="post-timeline-content" >
                                    <br>
                                    <input type="text"
                                    v-model="post.title_ar"
                                    max="50"
                                    class="form-control w3-round post-title-input" placeholder="{{ __('mobile.write_post_title_ar') }}" >
                                    <span v-html="post.title_ar? post.title_ar.length : '0'" ></span> / 50
                                </div>
                            </p>
                          </div>
                          <span class="timeline-author">  </span>
                        </div>
                        <div
                        class="meta-date w3-display-container"
                        v-bind:style="post.title_ar? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                        onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                            <div class="w3-display-topmiddle w3-padding"
                            style="z-index: 3;padding-top: 10px!important"
                            >
                                <img src="{{ url('/mobile/images/create-post/title.png') }}"
                                v-bind:class="post.title_ar? 'invert' : ''"
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
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.category') }} * </b>
                              <div class="post-timeline-content" >
                                  <b class="w3-text-gray" >{{ __('mobile.what_is_category') }}</b>
                                  <br>
                                  @foreach(App\Category::all() as $item)
                                  <span
                                  class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                  v-bind:class="post.category_id == '{{ $item->id }}'? 'light-theme-background' : ''"
                                  onclick="page.post.category_id = '{{ $item->id }}';showDependOnCategory()"
                                  style="border: 1px solid #00b0bd;margin: 5px" >{{ session("direction")=='rtl'? $item->name_ar : $item->name_en }}</span>
                                  @endforeach
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.category_id? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/category.png') }}"
                              v-bind:class="post.category_id? 'invert' : ''"
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
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.sell_or_rent') }} * </b>
                              <div class="post-timeline-content" >
                                  <b class="w3-text-gray" >{{ __('mobile.what_is_type') }}</b>
                                  <br>
                                  <span
                                  class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                  onclick="page.post.type = 'sale'"
                                  v-bind:class="post.type == 'sale'? 'light-theme-background' : ''"
                                  style="border: 1px solid #00b0bd;margin: 5px" >{{ __('mobile.sell') }}</span>
                                  <span
                                  class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                  onclick="page.post.type = 'rent'"
                                  v-bind:class="post.type == 'rent'? 'light-theme-background' : ''"
                                  style="border: 1px solid #00b0bd;margin: 5px" >{{ __('mobile.rent') }}</span>
                                  <span
                                  class="w3-tag w3-white w3-round-xlarge btn light-theme-background-hover"
                                  onclick="page.post.type = 'sale or rent'"
                                  v-bind:class="post.type == 'saleorrent'? 'light-theme-background' : ''"
                                  style="border: 1px solid #00b0bd;margin: 5px" >{{ __('mobile.sale_or_rent') }}</span>
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.type? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/type.png') }}"
                              v-bind:class="post.type? 'invert' : ''"
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
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.space') }} * </b>
                              <div class="post-timeline-content" >
                                  <br>
                                  <input type="number"
                                  v-model="post.space"
                                  class="form-control w3-round" placeholder="{{ __('mobile.space') }}" >
                                  <span>{{ __('mobile.in_meter') }}</span>
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.space > 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/space.png') }}"
                              v-bind:class="post.space>0? 'invert' : ''"
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
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.price_per_meter') }} * </b>
                              <div class="post-timeline-content" >
                                  <br>
                                  <input type="number"
                                  v-model="post.price_per_meter"
                                  class="form-control w3-round" placeholder="{{ __('mobile.price_per_meter') }}" >
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.price_per_meter > 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/price.png') }}"
                              v-bind:class="post.price_per_meter>0? 'invert' : ''"
                                class="icon" width="30px"  >
                          </div>
                      </div>
                    </div>
                    <!-- Article -->
                    <div class="timeline-article">
                      <div class="content-left-container">
                        <div class="content-right">
                          <p>
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.price') }} * </b>
                              <div class="post-timeline-content" >
                                  <br>
                                  <input type="number"
                                  v-model="post.price"
                                  class="form-control w3-round" placeholder="{{ __('words.price') }}" >
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.price > 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/price.png') }}"
                              v-bind:class="post.price>0? 'invert' : ''"
                                class="icon" width="30px"  >
                          </div>
                      </div>
                    </div>
                    <!-- Article -->
                    <div class="timeline-article bedroom_number_section">
                      <div class="content-left-container">
                        <div class="content-right">
                          <p>
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.bedroom_number') }} * </b>
                              <div class="post-timeline-content" >
                                  <center class="input-group number-bedroom-spinner w3-light-gray  w3-round-xxlarge  " style="width: 130px!important;direction: ltr!important" >
                                          <span class="btn input-group-btn spinner-padding" >
                                              <button class="w3-padding btn  w3-text-gray btn-number-spinner-left w3-circle btn w3-  spinner-btn" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                                          </span>
                                          <input type="text" class="form-control text-center spinner-input input-lg w3-text-gray " v-model="post.bedroom_number" value="1">
                                          <span class="btn input-group-btn spinner-padding"   >
                                              <button class="w3-padding btn w3-text-gray btn-number-spinner-right w3-circle btn w3-  spinner-btn" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                                          </span>
                                      </center>
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.bedroom_number>0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/bedroom.png') }}"
                              v-bind:class="post.bedroom_number? 'invert' : ''"
                                class="icon" width="30px"  >
                          </div>
                      </div>
                    </div>
                    <!-- // Article -->
                    <!-- Article -->
                    <div class="timeline-article bathroom_number_section">
                      <div class="content-left-container">
                        <div class="content-right">
                          <p>
                              <b class="w3-text-gray text-capitalize" >{{ __('mobile.bathroom_number') }} * </b>
                              <div class="post-timeline-content" >
                                  <center class="input-group number-bathroom-spinner w3-light-gray  w3-round-xxlarge  " style="width: 130px!important;direction: ltr!important" >
                                          <span class="btn input-group-btn spinner-padding" >
                                              <button class="w3-padding btn  w3-text-gray btn-number-spinner-left w3-circle btn w3-  spinner-btn" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                                          </span>
                                          <input type="text" class="form-control text-center spinner-input input-lg w3-text-gray " v-model="post.bathroom_number" value="1">
                                          <span class="btn input-group-btn spinner-padding"   >
                                              <button class="w3-padding btn w3-text-gray btn-number-spinner-right w3-circle btn w3-  spinner-btn" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                                          </span>
                                      </center>
                              </div>
                          </p>
                        </div>
                        <span class="timeline-author">  </span>
                      </div>
                      <div class="meta-date w3-display-container"
                          v-bind:style="post.bathroom_number > 0? 'background-color: #06D9B2 !important' : 'background-color: white!important' "
                      onclick="$('.post-timeline-content').hide();$(this).parent().find('.post-timeline-content').toggle()"   >
                          <div class="w3-display-topmiddle w3-padding" style="z-index: 3;padding-top: 10px!important" >
                              <img src="{{ url('/mobile/images/create-post/bathroom.png') }}"
                              v-bind:class="post.bathroom_number? 'invert' : ''"
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
                                onclick="goto(4)"
                                class="text-capitalize btn light-theme-background w3-block w3-text-gray w3-large w3-round-xlarge shadow next-btn" >
                                {{ __('mobile.next') }}
                            </button>
                        </center>
                </div>
            </div>
