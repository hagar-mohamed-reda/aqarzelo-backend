
            <div class="step step-2 w3-padding" >
                <ul class="w3-ul" >
                    <li v-for="image in images" >
                        <div class="media w3-round shadow w3-white" style="overflow: hidden;">
                          <div class="media-left">
                            <a href="#">
                              <img 
                              class="media-object" 
                              onclick="viewImage(this)" 
                              style="width: 150px" 
                              height="80px"  
                              v-bind:src="image.path" >
                            </a>
                          </div>
                          <div class="media-body">
                            <div class="media-heading  w3-padding">
                                <b v-html="image.file.name" ></b>
                            </div>
                            <br>
                            <div class="progress hidden" style="height: 5px!important;width:95%!important" >
                              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Complete (success)</span>
                              </div>
                            </div>
                          </div>
                        </div>
                    </li>

                    <li>
                        <div class="w3-row" >
                            <div class="w3-col l6 m6 s6" style="padding: 5px" >
                                <input type="file" class="hidden upload-noraml-image-input" onchange="uploadImage(this)" accept="image/*" >
                                <center class="upload-image-div w3-border w3-border-gray w3-light-gray w3-round" style="padding: 10px;border-style: dashed!important;"  >
                                    <img 
                                    onclick="$('.upload-noraml-image-input').click()" 
                                    src="{{ url('/mobile/images/upload-cloud.png') }}"  
                                    width="85%" >
                                    <br>
                                    <b class="w3-tiny w3-text-gray" >{{ __('mobile.upload_normal_image') }}</b>
                                </center>
                            </div>
                            <div class="w3-col l6 m6 s6" style="padding: 5px"  >
                                <input type="file" class="hidden upload-360-image-input" onchange="upload360Image(this)" accept="image/*"  >
                                <center class="upload-image-div w3-border w3-border-gray w3-light-gray w3-round" style="padding: 10px;border-style: dashed!important;"  >
                                    <img 
                                    onclick="$('.upload-360-image-input').click()" 
                                    src="{{ url('/mobile/images/upload-cloud.png') }}"  
                                    width="85%" >
                                    <br>
                                    <b class="w3-tiny w3-text-gray" >{{ __('mobile.upload_360_image') }}</b>
                                </center>
                            </div>
                        </div>
                    </li>

                    <li>
                        <center>   
                            <button 
                                onclick="goto(3)"
                                class="text-capitalize btn light-theme-background w3-block w3-text-gray w3-large w3-round-xlarge shadow next-btn" >
                                {{ __('mobile.next') }}
                            </button>
                        </center>
                    </li>
                </ul>

            </div>