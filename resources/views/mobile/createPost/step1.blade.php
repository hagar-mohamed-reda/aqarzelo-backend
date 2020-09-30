 <div class="step step-1" style="background-image: url({{ url('/mobile/images/create_post.png')  }})" >
                <center>
                     <img src="{{ url('/mobile/images/upload-cloud.png') }}" class="step-1-img animated bounceInDown slow" width="25%" >
                     <br>
                     <div class="text-capitalize w3-text-gray"  >
                         <b>{{ __('mobile.first_image_is_the_master') }}</b>
                     </div>
                     <br>
                     <input 
                     type="file" 
                     onchange="uploadMaster(this)" 
                     class="hidden upload_master_image" 
                     accept="image/*">
                    <div class="w3-padding" style="width: 80%" >
                        <button 
                            onclick="$('.upload_master_image').click()"
                            class="text-capitalize btn w3-light-gray w3-block w3-text-gray w3-round-xlarge shadow current-location-btn animated fadeInUp delay-s1" >
                            {{ __('mobile.upload_master_image') }}
                            <img src="{{ url('/mobile/images/master_btn_icon.png') }}" class="w3-right" width="20px" >
                        </button> 
                        <br>
                        <button 
                            onclick="$('.upload_master_image').click()"
                            class="text-capitalize btn w3-light-gray w3-block w3-text-gray w3-round-xlarge shadow current-location-btn animated fadeInUp delay-s2" >
                            {{ __('mobile.camera') }}
                            <img src="{{ url('/mobile/images/camera_btn_icon.png') }}" class="w3-right" width="20px" >
                        </button> 
                    </div>
                </center>

                @include('mobile.bottomNav')
</div>